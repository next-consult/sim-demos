<?php

namespace App\Http\Controllers;

use App\Models\Fournisseur;
use App\Models\Catalogue;
use App\Models\Groupe;
use App\Models\Facture;
use Illuminate\Http\Request;
use Validator;

class FournisseurController extends Controller
{
    public function index()
    {

        $fournisseurs = Fournisseur::all();
        return view('fournisseurs.index')
            ->with(compact('fournisseurs'));
    }

    public function create()
    {
        return view('fournisseurs.add');
    }

    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'nom' => 'required',
                'email' => 'required|email|unique:fournisseurs,email',
                'telephone' => 'required|numeric|unique:fournisseurs,telephone',
                'adresse' => 'required',
                'code_postal' => 'required',
                'mf' => 'required|unique:fournisseurs,mf',
            ],
        );
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()]);
        }

        $date = date('Y-m-d');
        $groupe = Groupe::where('nom', 'fournisseur')->first();

        $numero = $groupe->numero();
        if ($numero == false) {
            return response()->json(['error_existe' => "Numéro éxiste déja , changer le numéro prochain dans les parametres"]);
        }



        Fournisseur::create([
            "numero" => $numero,
            "nom" => $request->nom,
            "email" => $request->email,
            "telephone" => $request->telephone,
            "adresse" => $request->adresse,
            "code_postal" => $request->code_postal,
            "mf" => $request->mf,
        ]);
        $groupe->nb_prochain++;
        $groupe->save();
        return response()->json(200);
    }

    public function one_fournisseur($id)
    {

        $fournisseur = Fournisseur::find($id);
        return response()->json($fournisseur);
    }
    public function update($id)
    {
        $fournisseur = Fournisseur::find($id);
        return view('fournisseurs.update')->with(compact('fournisseur'));
    }

    public function store_update(Request $request, $id)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'nom' => 'required',
                'email' => 'required|email|unique:fournisseurs,email,' . $id,
                'telephone' => 'required|numeric|unique:fournisseurs,telephone,' . $id,
                'adresse' => 'required',
                'code_postal' => 'required',
                'mf' => 'required|unique:fournisseurs,mf,' . $id,

            ],
        );
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()]);
        }
        Fournisseur::where('id', $id)->update([
            "nom" => $request->nom,
            "email" => $request->email,
            "telephone" => $request->telephone,
            "adresse" => $request->adresse,
            "mf" => $request->mf,
            "code_postal" => $request->code_postal,

        ]);

        return response()->json(200);
    }
    public function delete($id)
    {
        $facture = Facture::where('fournisseur_id', $id)->exists();
        if ($facture) {
            return response()->json(-1);
        }
        Fournisseur::where('id', $id)->delete();
        Catalogue::where('fournisseur_id', $id)->delete();
        return response()->json(200);
    }
}
