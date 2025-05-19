<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\Entreprise;
use App\Models\Devis;
use App\Models\Dossier;
use App\Models\ItemDevis;
use App\Models\Catalogue;
use App\Models\Taxe;
use App\Models\ItemFacture;
use App\Models\Facture;
use App\Models\Groupe;
use App\Models\Bonlivraison;
use App\Models\Devise;
use App\Models\ItemBonlivraison;
use App\Models\Oemparametre;
use Carbon\Carbon;

use Session;
use Validator;
use PDF;

class DevisController extends Controller
{
    public function index()
    {

        $clients = Client::all();

        $devis_array = Devis::all();
        $entreprises = Entreprise::all();
        return view('devis.index')
            ->with(compact('clients'))
            ->with(compact('entreprises'))
            ->with(compact('devis_array'));
    }

    public function update($id)
    {
        $devis = Devis::where('id', $id)->first();
        $catalogues = Catalogue::all();
        $taxes = Taxe::all();
        $devises = Devise::all();
        $parametre = Oemparametre::first();
        $clients = Client::all();

        return view('devis.update')
            ->with(compact('catalogues'))
            ->with(compact('taxes'))
            ->with(compact('devises'))
            ->with(compact('parametre'))
            ->with(compact('clients'))
            ->with(compact('devis'));
    }

    public function store(Request $request)
    {

        $validator = Validator::make(
            $request->all(),
            [
                'client_id' => 'required',
                'entreprise_id' => 'required',
            ],
        );
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()]);
        }

        if ($request->new_client != null) {
            $groupe = Groupe::where('nom', 'client')->first();

            $numero = $groupe->numero();
            if ($numero == false) {
                return response()->json(['error_existe' => "Numéro éxiste déja , changer le numéro prochain dans les parametres"]);
            }
            $clients = json_decode($request->new_client);
            $client_new = Client::create([
                "numero" => $numero,
                "nom" => $clients[0]->nom,
                "adresse" => $clients[0]->adresse,
                "email" => $clients[0]->email,
                "telephone" => $clients[0]->telephone,
                "categorie_id" => 1,
                "type" => 'avec_taxe',
                "status_date" => "valide",
                "status_montant" => "valide",
            ]);
            $groupe->nb_prochain++;
            $groupe->save();
            $client_id = $client_new->id;
        } else {
            $client_id = $request->client_id;
        }
        $date = date('Y-m-d');
        $groupe_devis = Groupe::where('nom', 'devis')->first();

        $numero_devis = $groupe_devis->numero();
        if ($numero_devis == false) {
            return response()->json(['error_existe' => "Numéro éxiste déja , changer le numéro prochain dans les parametres"]);
        }

        $devis = Devis::create([
            "numero" => $numero_devis,
            "status" => 'en cours',
            "client_id" => $client_id,
            "entreprise_id" => $request->entreprise_id,
            "date" => $date,
            "type" => $request->type,
        ]);
        $groupe_devis->nb_prochain++;
        $groupe_devis->save();
        return response()->json(['success_id' => $devis->id]);
    }

    public function update_store(Request $request, $id)
    {
        // $validator =Validator::make(
        //     $request->all(),
        //     [
        //         'numero_devis' => 'required|unique:devis,numero,' . $id,
        //         'date_devis' => 'required|date',
        //     ],
        // );
        // if ($validator->fails()) {
        //     return response()->json(['error' => $validator->errors()]);
        // }

        $items_json = json_decode($request->items);

        //delete_items
        $array_ids = [];
        foreach ($items_json as $item) {
            array_push($array_ids, $item->id);
        }

        ItemDevis::whereNotIn('id', $array_ids)->where('devis_id', $id)->delete();

        //updateoradditem

        foreach ($items_json as $item) {

            if ($item->id == "new") {

                ItemDevis::create([
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
                    'devis_id' => $id,
                    'remise' => $item->remise,

                ]);
            } else if (is_numeric($item->id)) {

                ItemDevis::where('id', $item->id)->update([
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
                    'devis_id' => $id,
                    'remise' => $item->remise,

                ]);
            }
        }
        $devis = Devis::find($id);
        $devis->calcule_ht();
        $devis->condition = $request->condition;
        $devis->footer = $request->footer;
        $devis->status = $request->status;
        $devis->devise = $request->devise;
        $devis->date = $request->date_devis;
        $devis->client_id = $request->client_id;
        $devis->save();
        return response()->json(200);
    }

    public function print($id)
    {
		

        $devis = Devis::where('id', $id)->first();
		
        $photo = "assets/img/" . $devis->entreprise->photo;
        $pdf = PDF::loadView('devis.print', compact('devis', 'photo'));
        $nom_devis = $devis->numero . ".pdf";
		
        return $pdf->download($nom_devis);
    }

    public function delete($id)
    {

        ItemDevis::where('devis_id', $id)->delete();
        Devis::where('id', $id)->delete();
        Facture::where('devis_id', $id)->update(["devis_id" => null]);
        return response()->json(200);
    }
    public function generate_facture($id)
    {
        $devis = Devis::find($id);
        $date = date('Y-m-d');
        $date_paiement = date('Y-m-d', strtotime($date));

        $nb_jours_clients = Client::where('id', $devis->client_id)->first()->categorie->nb_jours;
        $date_paiement = Carbon::parse($date)->addDays($nb_jours_clients)->format('Y-m-d');
        $groupe = Groupe::where('nom', 'facture')->first();

        $numero = $groupe->numero();
        if ($numero == false) {
            return response()->json(['error_existe' => "Numéro éxiste déja , changer le numéro prochain dans les parametres"]);
        }
        $facture = Facture::create([
            "numero" => $numero,
            "status" => 'en cours',
            "date" => $date,
            "client_id" => $devis->client_id,
            "entreprise_id" => $devis->entreprise_id,
            "date_paiement" => $date_paiement,
            "footer" => $devis->footer,
            "type" => "client",
        ]);
        $groupe->nb_prochain++;
        $groupe->save();
        foreach ($devis->items as $item) {
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
                'facture_id' => $facture->id,
                'remise' => $item->remise,
            ]);
        }
        $facture_calcule = Facture::find($facture->id);
        $facture_calcule->calcule();

        $facture_calcule->devis_id = $devis->id;
        $facture_calcule->save();
        $client = Client::where('id', $facture_calcule->client_id)->first();
        $client->solde();
        $client->save();
        $devis->status = "converti_facture";
        $devis->save();
        return response()->json(['success_id' => $facture_calcule->id]);
    }
    public function bon_livraison(Request $request, $id)
    {
        $devis = Devis::find($id);
        $date = date('Y-m-d');
        $groupe_bonlivraisons = Groupe::where('nom', 'bonlivraison')->first();
        $numero_bonlivraisons = $groupe_bonlivraisons->numero();
        if ($numero_bonlivraisons == false) {
            return response()->json(['error_existe' => "Numéro éxiste déja , changer le numéro prochain dans les parametres"]);
        }
        $bonlivraisons = Bonlivraison::create([
            "numero" => $numero_bonlivraisons,
            "status" => 'en cours',
            "client_id" => $devis->client->id,
            "entreprise_id" => $devis->entreprise->id,
            "date" => $date,
            "devis_id" => $devis->id,
        ]);
        $groupe_bonlivraisons->nb_prochain++;
        $groupe_bonlivraisons->save();
        foreach ($devis->items as $item) {
            ItemBonlivraison::create([
                'produit' => $item->produit,
                'quantites' => $item->quantites,
                'description' => trim(strip_tags($item->description)),
                'bonlivraison_id' => $bonlivraisons->id,
            ]);
        }
        return response()->json(['success_id' => $bonlivraisons->id]);
    }
}
