<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Groupe;
use App\Models\Facture;
use App\Models\Devis;
use App\Models\Intervention;
use App\Models\Elementgroupe;
use Validator;
class GroupeController extends Controller
{
    public function index(){
    
        $groupes = Groupe::all();
        return view('groupes.index')
            ->with(compact('groupes'));

    }

    public function create(){
        return view('groupes.add');
    }

    public function store(Request $request)
    {
        $validator =Validator::make(
            $request->all(),
            [
                "nom" => 'required|unique:groupes',
                "format" =>'required' ,
                "nb_prochain" =>'required',
                "nb_left" =>'required' ,
                "renist" =>'required',
            ],
        );
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()]);
        }
        $elements=json_decode($request->elements);

        $groupe=Groupe::create([
            "nom" => $request->nom,
            "format" => $request->format,
            "nb_prochain" => $request->nb_prochain,
            "nb_left" => $request->nb_left,
            "renist" => $request->renist,
        ]);
        foreach($elements as $key=>$elem){
            Elementgroupe::create([
                "nom" => $elem,
                "ordre" => $key+1,
                "groupe_id" => $groupe->id,
            ]);
        }

        return response()->json(200);
    }

    public function one_groupe($id){
    
        $groupe = Groupe::find($id);
        return response()->json($groupe );

    }
    public function update($id){
        $groupe = Groupe::find($id);
        return view('groupes.update')->with(compact('groupe'));

    }
    
    public function store_update(Request $request,$id)
    {
        $validator =Validator::make(
            $request->all(),
            [
                "nom" => 'required|unique:groupes,nom,'.$id,
                "format" =>'required' ,
                "nb_prochain" =>'required',
                "nb_left" =>'required' ,
                "renist" =>'required',
            ],
        );
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()]);
        }

        $groupe=Groupe::find($id);
        $groupe->nb_prochain=$request->nb_prochain;
        $numero=$groupe->numero();
        if($numero==false){
            return response()->json(['error_existe' => "Numéro éxiste déja , changer le numéro prochain"]);
        }

        Groupe::where('id',$id)->update([
            "nom" => $request->nom,
            "format" => $request->format,
            "nb_prochain" => $request->nb_prochain,
            "nb_left" => $request->nb_left,
            "renist" => $request->renist,
        ]);
        Elementgroupe::where('groupe_id',$id)->delete();
        $elements=json_decode($request->elements);
        foreach($elements as $key=>$elem){
            Elementgroupe::create([
                "nom" => $elem,
                "ordre" => $key+1,
                "groupe_id" => $id,
            ]);
        }
     
        return response()->json(200);
    }
    public function delete($id){
        
        $facture=Facture::where('groupe_id',$id)->exists();
        $devis=Devis::where('groupe_id',$id)->exists();
        $intervention=Intervention::where('groupe_id',$id)->exists();
        if($facture || $devis || $intervention){
            return response()->json(-1);
        }
        Groupe::where('id',$id)->delete();
        Elementgroupe::where('groupe_id',$id)->delete();
        return response()->json(200);
    }
}
