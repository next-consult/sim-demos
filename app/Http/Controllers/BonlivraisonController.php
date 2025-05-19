<?php

namespace App\Http\Controllers;

use App\Models\Stock;
use Illuminate\Http\Request;
use App\Models\Bonlivraison;
use App\Models\Groupe;
use App\Models\Entreprise;
use App\Models\Client;
use App\Models\Catalogue;
use App\Models\ItemBonlivraison;
use Illuminate\Support\Facades\Log;
use Session;
use Validator;
use PDF;

class BonlivraisonController extends Controller
{
    public function index()
    {
        $livraison_array = Bonlivraison::all();
        $entreprises = Entreprise::all();
        $clients = Client::all();
        return view('bonlivraisons.index')
            ->with(compact('entreprises'))
            ->with(compact('clients'))
            ->with(compact('livraison_array'));
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
        $groupe_bonlivraisons = Groupe::where('nom', 'bonlivraison')->first();
        $numero_bonlivraisons = $groupe_bonlivraisons->numero();
        if ($numero_bonlivraisons == false) {
            return response()->json(['error_existe' => "Numéro éxiste déja , changer le numéro prochain dans les parametres"]);
        }

        $bonlivraisons = Bonlivraison::create([
            "numero" => $numero_bonlivraisons,
            "status" => 'en cours',
            "client_id" => $client_id,
            "entreprise_id" => $request->entreprise_id,
            "date" => $date,
        ]);
        $groupe_bonlivraisons->nb_prochain++;
        $groupe_bonlivraisons->save();
        return response()->json(['success_id' => $bonlivraisons->id]);
    }

    public function update($id)
    {
        $bonlivraison = Bonlivraison::where('id', $id)->first();
        $catalogues = Catalogue::all();
        $clients = Client::all();

        return view('bonlivraisons.update')
            ->with(compact('catalogues'))
            ->with(compact('clients'))
            ->with(compact('bonlivraison'));
    }
    
	
	
	   public function store_update(Request $request, $id)
    {
        $items_json = json_decode($request->items);

        foreach ($items_json as $item) {
            $stock = Stock::where('catalogue_id', $item->id)->first();
            if ($stock && $item->quantites > $stock->qte) {
                return response()->json(['error' => ['stock_insuffisant' => 'Stock insuffisant pour le produit ' . $item->produit]], 422);
            }
        }

        $existingItems = ItemBonlivraison::where('bonlivraison_id', $id)->get()->keyBy('produit_id');

        $updateItems = [];
        $createItems = [];

        foreach ($items_json as $item) {
            if (isset($existingItems[$item->id])) {
                $updateItems[] = $item;
            } else {
                $createItems[] = $item;
            }
        }

        foreach ($updateItems as $item) {
            ItemBonlivraison::where('bonlivraison_id', $id)
                ->where('produit_id', $item->id)
                ->update([
                    'produit' => $item->produit,
                    'quantites' => $item->quantites,
                    'description' => trim(strip_tags($item->description)),
                    'bonlivraison_id' => $id,
                ]);
                  // Décrémente la quantité en stock
            $stock = Stock::where('catalogue_id', $item->id)->first();
            if ($stock) {
                $stock->decrement('qte', $item->quantites);
            }
        }

      foreach ($createItems as $item) {
    ItemBonlivraison::create([
        'produit' => $item->produit,
        'quantites' => $item->quantites,
        'description' => trim(strip_tags($item->description)),
        'bonlivraison_id' => $id,
        'produit_id' => is_numeric($item->id) ? (int) $item->id : null, // Ensure it's an integer
    ]);

    // Decrease stock quantity
    $stock = Stock::where('catalogue_id', $item->id)->first();
    if ($stock) {
        $stock->decrement('qte', $item->quantites);
    }
}


        $bonlivraison = Bonlivraison::find($id);
        $bonlivraison->condition = $request->condition;
        $bonlivraison->footer = $request->footer;
        $bonlivraison->status = $request->status;
        $bonlivraison->date = $request->date_bonlivraison;
        $bonlivraison->client_id = $request->client_id;
        $bonlivraison->save();

        if ($request->status === 'valide') {
            foreach ($items_json as $item) {
                $stock = Stock::where('catalogue_id', $item->id)->first();
                if ($stock) {
                    $newQuantity = $stock->qte - $item->quantites;
                    $stock->update(['qte' => $newQuantity]);
                }
            }
        }

        return response()->json(200);
    }




    public function print($id)
    {

        $bonlivraison = Bonlivraison::where('id', $id)->first();
        $photo = "assets/img/" . $bonlivraison->entreprise->photo;
        $pdf = PDF::loadView('bonlivraisons.print', compact('bonlivraison', 'photo'));
        $nom_bonlivraison = $bonlivraison->numero . ".pdf";
        return $pdf->download($nom_bonlivraison);
    }
    public function delete($id)
    {
        ItemBonlivraison::where('bonlivraison_id', $id)->delete();
        Bonlivraison::where('id', $id)->delete();
        return response()->json(200);
    }
}
