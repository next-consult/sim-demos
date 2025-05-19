<?php

namespace App\Http\Controllers;

use App\Models\Entreprise;
use App\Models\Facture;
use App\Models\Client;
use App\Models\Ordre;
use App\Models\FactureOrdre;
use App\Models\Frais;
use App\Models\Dossier;
use App\Models\Devis;
use App\Models\ItemFacture;
use App\Models\Taxe;
use App\Models\Paiement;
use App\Models\Catalogue;
use App\Models\Fournisseur;
use App\Models\Groupe;
use App\Models\Oemparametre;
use Illuminate\Http\Request;
use Session;
use Validator;
use App\Events\UserActionEvent;

use PDF;
use Carbon\Carbon;
use App\Models\Devise;
use App\Models\Contrat;
use App\Models\ContratFacture;

class FactureController extends Controller
{
    public function index()
    {

        $entreprises = Entreprise::all();
        $clients = Client::all();
        $factures = Facture::where('type', 'client')->get();
		//dd( $factures);
        return view('factures.index')
            ->with(compact('entreprises'))
            ->with(compact('clients'))
            ->with(compact('factures'));
    }

    public function store(Request $request)
    {

        $validator = Validator::make(
            $request->all(),
            [
                'entreprise_id' => 'required',
                'client_id' => ['required_if:type,==,client'],
                'fournisseur_id' => ['required_if:type,==,fournisseur'],
            ],
        );
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()]);
        }

        $date = date('Y-m-d');
        $date_paiement = date('Y-m-d', strtotime($date));


        //facture client



        if ($request->type == "client") {
            $groupe = Groupe::where('nom', 'facture')->first();

            $numero = $groupe->numero();
            if ($numero == false) {
                return response()->json(['error_existe' => "Numéro éxiste déja , changer le numéro prochain dans les parametres"]);
            }

            $client_mf = Client::where('id', $request->client_id)->first()->mf;
            if ($client_mf == null) {
                return response()->json(['error_mf' => 'Le champ matricule fiscale est vide']);
            }
            $nb_jours_clients = Client::where('id', $request->client_id)->first()->categorie->nb_jours;
            $date_paiement = Carbon::parse($date)->addDays($nb_jours_clients)->format('Y-m-d');
            $facture = Facture::create([
                "numero" => $numero,
                "status" => 'en cours',
                "date" => $date,
                "client_id" => $request->client_id,
                "entreprise_id" => $request->entreprise_id,
                "date_paiement" => $date_paiement,
                "type" => $request->type,
            ]);
            $facture_calcule = Facture::find($facture->id);
            $facture_calcule->calcule();
            $facture_calcule->save();
            $client = Client::where('id', $request->client_id)->first();
            $client->solde();
            $client->save();
            $groupe->nb_prochain++;
            $groupe->save();
        }

        //facture fournisseur
        else {
            $groupe = Groupe::where('nom', 'depense')->first();

            $numero = $groupe->numero();
            if ($numero == false) {
                return response()->json(['error_existe' => "Numéro éxiste déja , changer le numéro prochain dans les parametres"]);
            }

            $facture = Facture::create([
                "numero" => $numero,
                "status" => 'en cours',
                "date" => date('Y-m-d'),
                "fournisseur_id" => $request->fournisseur_id,
                "entreprise_id" => $request->entreprise_id,
                "date_paiement" => date('Y-m-d'),
                "type" => $request->type,
            ]);
            $facture_calcule = Facture::find($facture->id);
            $facture_calcule->calcule();
            $facture_calcule->save();
            $groupe->nb_prochain++;
            $groupe->save();
        }
event(new UserActionEvent(auth()->id(), 'ajout Facture', \now()));
        return response()->json(['success_id' => $facture->id]);
    }
    public function test_cles($quantites, $id)
    {
        $produits_test = Catalogue::where('categorie', 'Clés_OEM')->where('status', 'en_stock')->count();
        $produit_fact = Catalogue::where('facture_id', $id)->count();
        $test = $produits_test + $produit_fact;
        if ($test < $quantites) {
            return response()->json(['erreur_stock' => 1, 'message' => "Erreur stock , Lés clés réstants " . $test, 'quantites_restant' => $test]);
        }
        return response()->json(200);
    }

    public function update($id)
    {
        $facture = Facture::where('id', $id)->first();
        $catalogues_vendu = Catalogue::where('facture_id', $id)->get();
        $taxes = Taxe::all();
        $catalogues = $facture->type == "client" ? Catalogue::all() : Catalogue::where('fournisseur_id', $facture->fournisseur_id)->get();
        $devises = Devise::all();
        $contrats = Contrat::all();
        $parametre = Oemparametre::first();
        $test_quantites = Catalogue::where('status', 'en_stock')->count();
        $clients = Client::all();
        $fournisseurs = Fournisseur::all();

        return view('factures.update')
            ->with(compact('taxes'))
            ->with(compact('devises'))
            ->with(compact('catalogues'))
            ->with(compact('contrats'))
            ->with(compact('parametre'))
            ->with(compact('test_quantites'))
            ->with(compact('catalogues_vendu'))
            ->with(compact('clients'))
            ->with(compact('fournisseurs'))
            ->with(compact('facture'));
    }
    public function get_ordres(Request $request)
    {

        $ordres_ids = json_decode($request->ordres);
        $ordres = Ordre::whereIn('id', $ordres_ids)->with('factures')->with('items.item_devis')->get();
        return response()->json(["ordres" => $ordres]);
    }

    private function change_produits($categorie, $quantites, $id)
    {
        if ($categorie == "oem") {
            $catalogues = Catalogue::where('status', 'en_stock')->where('facture_id', null)->get();
            for ($i = 0; $i < $quantites; $i++) {
                Catalogue::where('id', $catalogues[$i]->id)->update(
                    [
                        "facture_id" => $id,
                        "status" => "vendu",

                    ]
                );
            }
        }
    }

    public function save(Request $request, $id)
    {
        $frais_items = json_decode($request->frais);

        //delete_frais_ordres
        $array_ids = [];
        if ($frais_items) {
            foreach ($frais_items as $item) {
                if ($item->id != "new") {
                    array_push($array_ids, $item->id);
                }
            }

            Frais::whereNotIn('id', $array_ids)->where('facture_id', $id)->delete();
        } else {
            Frais::where('facture_id', $id)->delete();
        }
        $items_json = json_decode($request->items);

        //delete_items
        $array_ids = [];
        foreach ($items_json as $item) {
            array_push($array_ids, $item->id);
        }

        ItemFacture::whereNotIn('id', $array_ids)->where('facture_id', $id)->delete();
        Catalogue::where('facture_id', $id)->update(["facture_id" => null, "status" => "en_stock"]);

        foreach ($items_json as $item) {

            if ($item->id == "new") {

                ItemFacture::create([
                    'produit' => $item->produit,
                    'quantites' => $item->quantites,
                    'description' => trim(strip_tags($item->description)),
                    'prix_ht' => $item->prix_ht,
                    'tva' => $item->tva,
                    'total_remise' => $item->total_remise,
                    'type_remise' => $item->type_remise,
                    'total_ht' => $item->total_ht,
                    'total_tva' => $item->total_tva,
                    'total_ttc' => $item->total_ttc,
                    'facture_id' => $id,
                    'remise' => $item->remise,
                    'categorie' => $item->categorie,

                ]);
                $this->change_produits($item->categorie, $item->quantites, $id);
            } else if (is_numeric($item->id)) {
                // $old_quantites = ItemFacture::where('id', $item->id)->first()->quantites;

                ItemFacture::where('id', $item->id)->update([
                    'produit' => $item->produit,
                    'quantites' => $item->quantites,
                    'description' => trim(strip_tags($item->description)),
                    'prix_ht' => $item->prix_ht,
                    'tva' => $item->tva,
                    'total_remise' => $item->total_remise,
                    'type_remise' => $item->type_remise,
                    'total_ht' => $item->total_ht,
                    'total_tva' => $item->total_tva,
                    'total_ttc' => $item->total_ttc,
                    'facture_id' => $id,
                    'remise' => $item->remise,
                    'categorie' => $item->categorie,
                ]);
                // $quant = $item->quantites != $old_quantites ? $item->quantites - $old_quantites : $old_quantites;
                // $this->change_produits($item->categorie,  $quant, $id);
                $this->change_produits($item->categorie, $item->quantites, $id);
            }
        }
        $facture = Facture::find($id);
        $facture->footer = $request->footer;
		$facture->condition = $request->condition;
        $facture->status = $request->status;
        $facture->timbre = $request->timbre;
        $facture->devise = $request->devise;
        $facture->retenu = 0;
        $facture->facture_retenu = 0;
        $facture->date = $request->date_facture;
		if ($facture->type == "client") {
        $facture->client_id = $request->client_id;
		}
		else{
        $facture->fournisseur_id = $request->fournisseur_id;
		
		}
        $facture->calcule();
        $facture->save();
        if ($facture->type == "client") {
            $client_id = $facture->client->id;
            $client = Client::where('id', $client_id)->first();
			
            $client->solde();
            $client->save();
        }
		event(new UserActionEvent(auth()->id(), 'update Facture', \now()));
        return response()->json(200);
    }
    public function active_retenu(Request $request, $id)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'valeur_retenu' => 'required |numeric|min:1',
            ],
        );
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()]);
        }
        $facture = Facture::find($id);
        $facture->retenu = $request->valeur_retenu;
        $facture->calcule();
        $facture->save();
        return response()->json(200);
    }

    public function desactive_retenu($id)
    {

        $facture = Facture::find($id);
        $facture->retenu = 0;
        $facture->calcule();
        $facture->save();
        return redirect()->back();
    }


    public function facture_liaison(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'facture_id' => 'required',
                'contrat_id' => 'required',
            ],
        );
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()]);
        }
        ContratFacture::where('facture_id', $request->facture_id)->delete();
        if ($request->contrat_id != "sans_contrat") {
            ContratFacture::firstOrCreate([
                'facture_id' => $request->facture_id
            ], [
                "contrat_id" => $request->contrat_id,

            ]);
        }


        return response()->json(200);
    }










    //     public function save(Request $request,$id)
    //     {
    //         $facture=Facture::find($id);
    //         $count = count($facture->paiements);
    //         if ($count==0) {
    //         $validator =Validator::make(
    //             $request->all(),
    //             [
    //                 'date' => 'required|date',
    //                 'date_paiement' => 'required|date',
    //                 'numero' => 'required|unique:factures,numero,' . $id,
    //             ],
    //         );
    //         if ($validator->fails()) {
    //             return response()->json(['error' => $validator->errors()]);
    //         }

    //      $frais_items=json_decode($request->frais);
    //      $ordres_json = json_decode($request->ordres);
    //      foreach($ordres_json as $item)
    //      {
    //      $ordre=Ordre::find($item);
    //      $facture_ordre_test=FactureOrdre::where('facture_id','!=',$id)->where('ordre_id',$ordre->id)->exists();
    //           if(count($ordre->factures)>0 && $facture_ordre_test==true){
    //             return response()->json(['error_duplicate' => 'Un erreur dans la facture,un ordre existe dans une autre facture']);
    //           }

    //      }

    //      //delete_frais_ordres
    //      $array_ids = [];
    //      if($frais_items){
    //      foreach ($frais_items as $item) {
    //             if($item->id!="new"){
    //          array_push($array_ids,$item->id);

    //             }
    //      }

    //      Frais::whereNotIn('id',$array_ids)->where('facture_id',$id)->delete();
    //     }
    //     else{
    //         Frais::where('facture_id',$id)->delete();
    //     }
    //     $array_facutres=[];
    //     $array_ids=[];
    //     foreach ($ordres_json as $ordre) {
    //      array_push($array_ids,$ordre);
    //      }

    //    FactureOrdre::whereNotIn('ordre_id',$array_ids)->where('facture_id',$id)->delete();

    //      //add frais_ordres

    //      if($frais_items){
    //         foreach($frais_items as $frais)
    //             {


    //                if ($frais->id == "new") {
    //                    Frais::create([
    //                       "nom"=>$frais->nom,
    //                        "montant"=>$frais->montant,
    //                        "facture_id"=>$id,
    //                   ]);
    //                }

    //                  else if (is_numeric($frais->id)){

    //                    Frais::where('id',$frais->id)->update([
    //                         "nom"=>$frais->nom,
    //                          "montant"=>$frais->montant,
    //                   ]);

    //                 }

    //             }
    //         }

    //         foreach($ordres_json as $item)
    //         {
    //         $ordre=Ordre::find($item);
    //         $facture_ordre_test=FactureOrdre::where('facture_id',$id)->where('ordre_id',$ordre->id)->exists();
    //              if($facture_ordre_test==false){
    //                 FactureOrdre::create([
    //                     "facture_id"=>$id,
    //                     "ordre_id"=>$ordre->id,
    //                   ]);
    //              }


    //         }


    //     $facture=Facture::find($id);
    //     $facture->footer=$request->footer;
    //     $facture->numero=$request->numero;
    //     $facture->date_paiement=$request->date_paiement;
    //     $facture->status=$request->status;
    //     $facture->date=$request->date;
    //     $facture->timbre=$request->timbre;
    //     $facture->retenu= $request->retenu;
    //     $facture->calcule();
    //     $facture->save();
    //     $client_id=$facture->ordres[0]->devis->dossier->client->id;
    //     $client=Client::where('id', $client_id)->first();
    //     $client->solde();
    //     $client->save();
    //     return response()->json(200);
    //     }
    //     else{
    //     return response()->json(-1);

    //     }


    //     }

 public function print($id)
    {
        $facture = Facture::findOrFail($id);
        $photo = "assets/img/" . $facture->entreprise->photo;
        
        $pdf = PDF::loadView('factures.print', compact('facture', 'photo'));
        
        // Configuration de base
        $pdf->setPaper('A4');
        $pdf->setOption('enable_php', true);
        $pdf->setOption('isPhpEnabled', true);
        $pdf->setOption('isRemoteEnabled', true);
        
        // Définir les marges
        $pdf->setOption('margin-top', 30);
        $pdf->setOption('margin-bottom', 30);
        $pdf->setOption('margin-left', 15);
        $pdf->setOption('margin-right', 15);
        
        $nom_facture = $facture->numero . ".pdf";
        return $pdf->download($nom_facture);
    }


    public function paiementfacture($id)
    {
        $factures = Facture::where('client_id', $id)->where('status', '!=', 'paye')->where('status', '!=', 'annuler')->get();
        return response()->json($factures);
    }

    public function ordre_facture($id)
    {
        $facture = Facture::find($id);


        $ordre = Ordre::create([
            "numero" => rand(10000, 100000),
            "status" => 'en attente',
            "type_ordre" => 'sans_devis',
            "user_id" => Auth()->user()->id,
            "client_id" => $facture->client_id,
            "entreprise_id" => $facture->entreprise_id,

        ]);
        ItemOrdre::create([
            "ordre_id" => $ordre->id,
            "adress_livraison" => $ordre->client->adresse,
            "nom_livraison" => $ordre->client->nom . " " . $ordre->client->prenom,

        ]);


        Session::flash('status', "Ordre de travail ajouté avec succés");
event(new UserActionEvent(auth()->id(), 'ordre_facture', \now()));
        return redirect()->route('ordres.update', ['id' => $ordre->id]);
    }

    public function changestatus(Request $request, $id)
    {

        Facture::where('id', $id)->update([
            "status" => $request->status
        ]);
event(new UserActionEvent(auth()->id(), 'changestatus Facture', \now()));
        return response()->json(200);
    }
    public function one_facture($id)
    {
        return response()->json(Facture::find($id));
    }

    public function delete($id)
    {

        $facture = Facture::find($id);
        $type = $facture->type;
        $client = Client::find($facture->client_id);
        ItemFacture::where('facture_id', $id)->delete();
        Paiement::where('facture_id', $id)->delete();
        Frais::where('facture_id', $id)->delete();
        $facture->delete();
        if ($type == "client") {
            $client->solde();
            $client->update();
        }
        ContratFacture::where('facture_id', $id)->delete();

        // $factures_all = Facture::where('created_at', $facture_test->created_at)->get();
        // foreach ($factures_all as $facture) {



        // }
event(new UserActionEvent(auth()->id(), 'delete Facture', \now()));
        return response()->json(200);
    }

    public function retenu($id)
    {

        $facture = Facture::where('id', $id)->first();
        $pdf = PDF::loadView('factures.retenu', compact('facture'));
        $numero = "Retenu-" . $facture->numero . ".pdf";
        return $pdf->download($numero);
    }
}
