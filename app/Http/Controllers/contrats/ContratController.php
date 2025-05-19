<?php

namespace App\Http\Controllers\contrats;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contrat;
use App\Models\Client;
use App\Models\Entreprise;
use App\Models\Taxe;
use App\Models\Groupe;
use App\Models\Facturecontrat;
use App\Models\Itemsfacturecontrat;
use App\Models\ContratFacture;
use App\Models\Facture;
use Carbon\Carbon;
use App\Models\Devise;

class ContratController extends Controller
{
    public function index()
    {
        $contrats = Contrat::all();
        return view('contrats.index')->with(compact('contrats'));
    }
    public function create()
    {
        $clients = Client::all();
        $entreprises = Entreprise::all();
        $taxes = Taxe::all();
        $devises = Devise::all();
        return view('contrats.create')
            ->with(compact('clients'))
            ->with(compact('taxes'))
            ->with(compact('devises'))
            ->with(compact('entreprises'));
    }
    public function store(Request $request)
    {
        $items_json = json_decode($request->items);
        $groupe = Groupe::where('nom', 'contrat')->first();
        $numero = $groupe->numero();
        if ($numero == false) {
            return response()->json(['error_existe' => "Numéro éxiste déja , changer le numéro prochain dans les parametres"]);
        }
        $carbon_date = Carbon::parse($request->date_fin);
        $date_fin = $carbon_date->addMonths(intval($request->nb_mois));
        $contrat = Contrat::create([
            "numero" => $numero,
            "date_debut" => $request->date_debut,
            "nb_mois" => $request->nb_mois,
            "client_id" => $request->client_id,
            "entreprise_id" => $request->entreprise_id,
            "date_fin" => $date_fin,
            "timbre" => $request->timbre_value,
            "devise" => $request->devise
        ]);
        $groupe->nb_prochain++;
        $groupe->save();
        $facture = Facturecontrat::create([
            "contrat_id" => $contrat->id,
            "timbre" => $request->timbre_value,
            "devise" => $request->devise

        ]);
        foreach ($items_json as $item) {
            Itemsfacturecontrat::create([
                'produit' => $item->produit,
                'quantites' => $item->quantites,
                'description' => $item->description,
                'prix_ht' => $item->prix_ht,
                'tva' => $item->tva,
                'total_remise' => $item->total_remise,
                'type_remise' => $item->type_remise,
                'total_ht' => $item->total_ht,
                'total_tva' => $item->total_tva,
                'total_ttc' => $item->total_ttc,
                'facturecontrat_id' => $facture->id,
                'remise' => $item->remise,
            ]);
        }
        $facture_calcule = Facturecontrat::find($facture->id);
        $facture_calcule->calcule();
        $facture_calcule->save();
        return response()->json(200);
    }
    public function update($id)
    {
        $clients = Client::all();
        $entreprises = Entreprise::all();
        $taxes = Taxe::all();
        $contrat = Contrat::find($id);
        $devises = Devise::all();

        return view('contrats.update')
            ->with(compact('clients'))
            ->with(compact('contrat'))
            ->with(compact('devises'))
            ->with(compact('taxes'))
            ->with(compact('entreprises'));
    }
    public function update_store($id, Request $request)
    {
        $contrat = Contrat::find($id);
        $contrat->devise = $request->devise;
		
		//update dates 
		$contrat->date_debut = Carbon::parse($request->date_debut)->format('Y-m-d');
		$contrat->date_fin = Carbon::parse($request->date_fin)->format('Y-m-d');
		$contrat->nb_mois = $request->nb_mois;
        $contrat->update();
		
        $items_json = json_decode($request->items);
        //delete_items
        $array_ids = [];
        foreach ($items_json as $item) {
            array_push($array_ids, $item->id);
        }
        Itemsfacturecontrat::whereNotIn('id', $array_ids)->where('facturecontrat_id', $id)->delete();
        foreach ($items_json as $item) {

            if ($item->id == "new") {

                Itemsfacturecontrat::create([
                    'produit' => $item->produit,
                    'quantites' => $item->quantites,
                    'description' => $item->description,
                    'prix_ht' => $item->prix_ht,
                    'tva' => $item->tva,
                    'total_remise' => $item->total_remise,
                    'type_remise' => $item->type_remise,
                    'total_ht' => $item->total_ht,
                    'total_tva' => $item->total_tva,
                    'total_ttc' => $item->total_ttc,
                    'facturecontrat_id' => $contrat->facture->id,
                    'remise' => $item->remise,

                ]);
            } else if (is_numeric($item->id)) {

                Itemsfacturecontrat::where('id', $item->id)->update([
                    'produit' => $item->produit,
                    'quantites' => $item->quantites,
                    'description' => $item->description,
                    'prix_ht' => $item->prix_ht,
                    'tva' => $item->tva,
                    'total_remise' => $item->total_remise,
                    'type_remise' => $item->type_remise,
                    'total_ht' => $item->total_ht,
                    'total_tva' => $item->total_tva,
                    'total_ttc' => $item->total_ttc,
                    'facturecontrat_id' => $contrat->facture->id,
                    'remise' => $item->remise,

                ]);
            }
        }
        $facture_calcule = Facturecontrat::find($contrat->facture->id);
        $facture_calcule->calcule();
        $facture_calcule->timbre = $request->timbre_value;
        $facture_calcule->devise = $request->devise;
        $facture_calcule->save();
        return response()->json(200);
    }
    public function delete($id)
    {
		$contrat = Contrat::find($id);
        Itemsfacturecontrat::where('facturecontrat_id', $contrat->id)->delete();
        Facturecontrat::where('contrat_id', $contrat->facture->id)->delete();
        ContratFacture::where('contrat_id', $id)->delete();
        $contrat->delete();
        return response()->json(200);
    }
    public function one_contrat($id)
    {
        $contrat = Contrat::where('id', $id)->with('facture_month')->first();
        return response()->json($contrat);
    }
	public function liaison($id_old,$id_new)
	{
		$facture = Facture::where('id', $old_id)->first();
		ContratFacture::where('facture_id',$id_old)->update(["facture_id",$id_new]);
		return response()->json(200);
	}

    public function getContractDates($clientId)
    {
        $contrat = Contrat::where('client_id', $clientId)->first();
        $start_date = Carbon::parse($contrat->date_debut)->format('Y-m-d');
        $end_date = Carbon::parse($contrat->date_fin)->format('Y-m-d');
        if ($contrat) {
            return response()->json([
                'start_date' => $start_date,
                'end_date' => $end_date,
            ], 200);
        }
        return response()->json(['error' => 'Contract not found for the selected client'], 404);
    }
}
