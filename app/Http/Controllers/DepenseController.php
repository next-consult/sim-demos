<?php

namespace App\Http\Controllers;

use App\Models\Depense;
use App\Models\Client;
use App\Models\Entreprise;
use App\Models\Fournisseur;
use App\Models\Facture;
use App\Models\File;
use Illuminate\Http\Request;
use Validator;
use App\Exports\DepenseExport;
use Excel;

class DepenseController extends Controller
{
    public function index()
    {

        $factures = Facture::where('type', 'fournisseur')->get();
        $entreprises = Entreprise::all();
        $fournisseurs = Fournisseur::all();
        return view('depenses.index')
            ->with(compact('entreprises'))
            ->with(compact('fournisseurs'))
            ->with(compact('factures'));
    }

    public function create()
    {
        $clients = Client::all();
        $fournisseurs = Fournisseur::all();
        $entreprises = Entreprise::all();

        return view('depenses.add')
            ->with(compact('clients'))
            ->with(compact('fournisseurs'))
            ->with(compact('entreprises'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'entreprise_id' => 'required',
                'client_id' => ['required_if:categorie,==,client'],
                'fournisseur_id' => ['required_if:categorie,==,fournisseur'],
                'date' => 'required',
                'montant' => 'required',
                'categorie' => 'required',
                'taxe' => 'required',
                'description' => 'required',
            ],
        );
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()]);
        }


        $depense = Depense::create([
            "entreprise_id" => $request->entreprise_id,
            "fournisseur_id" => $request->fournisseur_id,
            "client_id" => $request->client_id,
            "date" => $request->date,
            "montant" => $request->montant,
            "taxe" => $request->taxe,
            "categorie" => $request->categorie,
            "description" => $request->description,
        ]);

        if ($request->file('files') != '') {
            foreach ($request->file('files') as $file) {
                $extension = $file->getClientOriginalExtension();
                $nom_file = $file->getClientOriginalName() . '.' . $extension;
                $file->move('assets/img/', $nom_file);
                File::create([
                    "file" => $nom_file,
                    "depense_id" => $depense->id,
                ]);
            }
        }

        return response()->json(200);
    }

    public function one_depense($id)
    {

        $depense = Depense::find($id);
        return response()->json($depense);
    }
    public function update($id)
    {
        $depense = Depense::find($id);
        $clients = Client::all();
        $fournisseurs = Fournisseur::all();
        $entreprises = Entreprise::all();
        return view('depenses.update')
            ->with(compact('depense'))
            ->with(compact('clients'))
            ->with(compact('fournisseurs'))
            ->with(compact('entreprises'));
    }

    public function store_update(Request $request, $id)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'entreprise_id' => 'required',
                'client_id' => ['required_if:categorie,==,client'],
                'fournisseur_id' => ['required_if:categorie,==,fournisseur'],
                'date' => 'required',
                'montant' => 'required',
                'categorie' => 'required',
                'taxe' => 'required',
                'description' => 'required',
            ],
        );
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()]);
        }
        Depense::where('id', $id)->update([
            "entreprise_id" => $request->entreprise_id,
            "fournisseur_id" => $request->fournisseur_id,
            "client_id" => $request->client_id,
            "date" => $request->date,
            "montant" => $request->montant,
            "taxe" => $request->taxe,
            "categorie" => $request->categorie,
            "description" => $request->description,

        ]);
        $files_ids = json_decode($request->files_ids);
        $array_ids = [];
        foreach ($files_ids as $item) {
            array_push($array_ids, $item->id);
        }

        File::whereNotIn('id', $array_ids)->where('depense_id', $id)->delete();
        if ($request->file('files') != '') {
            foreach ($request->file('files') as $file) {
                $extension = $file->getClientOriginalExtension();
                $nom_file = $file->getClientOriginalName() . '.' . $extension;
                $file->move('assets/img/', $nom_file);
                File::create([
                    "file" => $nom_file,
                    "depense_id" => $id,
                ]);
            }
        }

        return response()->json(200);
    }
    public function delete($id)
    {
        Depense::where('id', $id)->delete();
        return response()->json(200);
    }
    public function export($date_debut, $date_fin)
    {
        return Excel::download(new DepenseExport($date_debut, $date_fin), 'Dépenses.xlsx');
    }
}
