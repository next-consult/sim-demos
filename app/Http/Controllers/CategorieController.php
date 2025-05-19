<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categorie;
use App\Models\Client;
use Session;
use Validator;
use PDF;
class CategorieController extends Controller
{
    public function index(){
    
        $categories = Categorie::all();
        return view('categories.index')
            ->with(compact('categories'));

    }
    public function store(Request $request)
    {
        $validator =Validator::make(
            $request->all(),
            [
                'nom' => 'required',
                'montant' => 'required',
                'nb_jours' => 'required',
                'couleur' => 'required|unique:categories,couleur',
            ],
        );
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()]);
        }
        Categorie::create([
            "nom" => $request->nom,
            "montant" => $request->montant,
            "couleur" => $request->couleur,
            "nb_jours" => $request->nb_jours,

        ]);

        return response()->json(200);
    }

    public function one_categorie($id){
    
        $categorie = Categorie::find($id);
        return response()->json($categorie);

    }

    public function update(Request $request,$id)
    {
        $validator =Validator::make(
            $request->all(),
            [
                'nom' => 'required',
                'montant' => 'required',
                'nb_jours' => 'required',
                'couleur' => 'required|unique:categories,couleur,'.$id,   
            ],
        );
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()]);
        }
        Categorie::where('id',$id)->update([
            "nom" => $request->nom,
            "montant" => $request->montant,
            "couleur" => $request->couleur,
            "nb_jours" => $request->nb_jours,
        ]);

        return response()->json(200);
    }
    public function delete($id){
    
        $categorie = Categorie::find($id);
        $client=Client::where('categorie_id',$id)->exists();
        if($client==true){
        return response()->json(-1);
        }
        
        $categorie->delete();
        return response()->json(200);

    }
}
