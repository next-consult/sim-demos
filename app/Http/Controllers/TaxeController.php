<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Taxe;
use Session;
use Validator;
use App\Events\UserActionEvent;
use PDF;

class TaxeController extends Controller
{
    public function index(){
    
        $taxes = Taxe::all();
        return view('taxes.index')
            ->with(compact('taxes'));

    }

    public function store(Request $request)
    {
        $validator =Validator::make(
            $request->all(),
            [
                'nom' => 'required',
                'pourcentage' => 'required',
            ],
        );
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()]);
        }
        Taxe::create([
            "nom" => $request->nom,
            "pourcentage" => $request->pourcentage,
        ]);
        event(new UserActionEvent(auth()->id(), 'ajout taxe', \now()));
        return response()->json(200);
    }

    public function one_taxe($id){
    
        $taxe = Taxe::find($id);
        return response()->json($taxe );

    }

    public function update(Request $request,$id)
    {
        $validator =Validator::make(
            $request->all(),
            [
                'nom' => 'required|unique:destinations,nom,'.$id,
                'pourcentage' => 'required',
            ],
        );
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()]);
        }
        Taxe::where('id',$id)->update([
            "nom" => $request->nom,
            "pourcentage" => $request->pourcentage,
        ]);

        return response()->json(200);
    }
    public function delete($id){
        Taxe::where('id',$id)->delete();
		event(new UserActionEvent(auth()->id(), 'delete taxe', \now()));

        return response()->json(200);
   
    }
}
