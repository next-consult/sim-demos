<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Fournisseur;
use App\Models\Entreprise;
use App\Models\Boncommande;
use App\Models\ItemBoncommande;
use App\Models\Taxe;
use App\Models\Catalogue;
use App\Models\Groupe;
use App\Models\Client;
use App\Models\Devise;
use Validator;
use PDF;

class BoncommandeController extends Controller
{
    public function index()
    {

        $fournisseurs = Fournisseur::all();

        $boncommande_array = Boncommande::all();
        $entreprises = Entreprise::all();
        return view('boncommande.index')
            ->with(compact('fournisseurs'))
            ->with(compact('entreprises'))
            ->with(compact('boncommande_array'));
    }
    public function update($id)
    {
        $boncommande = Boncommande::where('id', $id)->first();
        $catalogues = Catalogue::all();
        $taxes = Taxe::all();
        $devises = Devise::all();
        $fournisseurs = Fournisseur::all();

        return view('boncommande.update')
            ->with(compact('catalogues'))
            ->with(compact('taxes'))
            ->with(compact('devises'))
            ->with(compact('fournisseurs'))
            ->with(compact('boncommande'));
    }
    public function store(Request $request)
    {


        $validator = Validator::make(
            $request->all(),
            [
                'fournisseur_id' => 'required',
                'entreprise_id' => 'required',
            ],
        );
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()]);
        }

        if ($request->new_fournisseur != null) {
            $groupe = Groupe::where('nom', 'fournisseur')->first();

            $numero = $groupe->numero();
            if ($numero == false) {
                return response()->json(['error_existe' => "Numéro éxiste déja , changer le numéro prochain dans les parametres"]);
            }
            $fournisseurs = json_decode($request->new_fournisseur);
            $fournisseur_new = fournisseur::create([
                "numero" => $numero,
                "nom" => $fournisseurs[0]->nom,
                "adresse" => $fournisseurs[0]->adresse,
                "email" => $fournisseurs[0]->email,
                "telephone" => $fournisseurs[0]->telephone,
            ]);

            $groupe->nb_prochain++;
            $groupe->save();
            $fournisseur_id = $fournisseur_new->id;
        } else {
            $fournisseur_id = $request->fournisseur_id;
        }


        $date = date('Y-m-d');
        $groupe_boncommande = Groupe::where('nom', 'boncommande')->first();
        $numero_boncommande = $groupe_boncommande->numero();
        if ($numero_boncommande == false) {
            return response()->json(['error_existe' => "Numéro éxiste déja , changer le numéro prochain dans les parametres"]);
        }

        $boncommande = Boncommande::create([
            "numero" => $numero_boncommande,
            "status" => 'en cours',
            "fournisseur_id" => $fournisseur_id,
            "entreprise_id" => $request->entreprise_id,
            "date" => $date,
            "type" => $request->type,
        ]);
        $groupe_boncommande->nb_prochain++;
        $groupe_boncommande->save();
        return response()->json(['success_id' => $boncommande->id]);
    }
    public function update_store(Request $request, $id)
    {
        // $validator =Validator::make(
        //     $request->all(),
        //     [
        //         'numero_boncommande' => 'required|unique:boncommande,numero,' . $id,
        //         'date_boncommande' => 'required|date',
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

        Itemboncommande::whereNotIn('id', $array_ids)->where('boncommande_id', $id)->delete();

        //updateoradditem

        foreach ($items_json as $item) {

            if ($item->id == "new") {

                Itemboncommande::create([
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
                    'boncommande_id' => $id,
                    'remise' => $item->remise,

                ]);
            } else if (is_numeric($item->id)) {

                Itemboncommande::where('id', $item->id)->update([
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
                    'boncommande_id' => $id,
                    'remise' => $item->remise,

                ]);
            }
        }
        $boncommande = Boncommande::find($id);
        $boncommande->calcule_ht();
        $boncommande->condition = $request->condition;
        $boncommande->footer = $request->footer;
        $boncommande->status = $request->status;
        $boncommande->devise = $request->devise;
        $boncommande->date = $request->date_boncommande;
        $boncommande->fournisseur_id = $request->fournisseur_id;
        $boncommande->save();
        return response()->json(200);
    }
    public function print($id)
    {

        $boncommande = Boncommande::where('id', $id)->first();
        $photo = "assets/img/" . $boncommande->entreprise->photo;
        $pdf = PDF::loadView('boncommande.print', compact('boncommande', 'photo'));
        $nom_boncommande = $boncommande->numero . ".pdf";
        return $pdf->download($nom_boncommande);
    }
    public function delete($id)
    {

        Itemboncommande::where('boncommande_id', $id)->delete();
        Boncommande::where('id', $id)->delete();
        return response()->json(200);
    }
}
