<?php

namespace App\Http\Controllers;
use App\Models\Entreprise;
use App\Models\Dossier;
use App\Models\Client;
use App\Models\Devis;

use Illuminate\Http\Request;
use Session;
use Validator;
use PDF;
class DossierController extends Controller
{
    public function index(){
    $dossiers=Dossier::all();
    $entreprises = Entreprise::orderby('created_at', 'asc')->get();
    $clients=Client::whereDoesntHave('dossier')->get();
    return view('dossiers.index')
    ->with(compact('entreprises'))
    ->with(compact('clients'))
    ->with(compact('dossiers'));
    }
    public function store(Request $request){
        $validator =Validator::make(
            $request->all(),
            [
                'entreprise_id' => 'required',
                'client_id' => 'required',

            ],
        );
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()]);
        }
        $client=Client::find($request->client_id);
        $dossier=Dossier::create([
            "numero" => $client->nom.$client->prenom."-". rand(10000, 100000),
            "entreprise_id" => $request->entreprise_id,
            "client_id" => $client->id,
            "user_id" =>auth()->user()->id,
        ]);
        return response()->json(['success_id' => $dossier->id]);
    }
    
    
    public function update($id)
    {
        $entreprises = Entreprise::orderby('created_at', 'asc')->get();
        $dossier = Dossier::where('id', $id)->first();
        return view('dossiers.update')
        ->with(compact('entreprises'))
        ->with(compact('dossier'));

    }
    public function store_update(Request $request,$id){
        $validator =Validator::make(
            $request->all(),
            [
                'entreprise_id' => 'required',
            ],
        );
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()]);
        }
        Dossier::where('id',$id)->update([
            "entreprise_id" => $request->entreprise_id,
            "user_id" =>auth()->user()->id,
        ]);
        return response()->json(200);
    }    
    
    public function store_devis(Request $request,$id)
    {
        $validator =Validator::make(
            $request->all(),
            [
                'entreprise_id' => 'required',
            ],
        );
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()]);
        }
       $date = date('Y-m-d');


        if(count(Devis::all())==0){
            $number=str_pad(1, 4, '0', STR_PAD_LEFT); 
        }
        else{
            $devis=Devis::orderby('id','desc')->first();
            $number=$devis->numero;
            $number = substr($number, 3);
            $number = substr($number, 4);

            if($number>=9999){
                $number=intval($number)+1;
            }
            else{
            $number=str_pad(intval($number)+1, 4, '0', STR_PAD_LEFT); 
            }
        }
       $devis = Devis::create([
            "numero" => "DEV".Date('y').Date('m').$number,
            "status" => 'en cours',
            "entreprise_id" => $request->entreprise_id,
            "dossier_id" => $id,
            "user_id" => Auth()->user()->id,
            "date" => $date,
            "type" => $request->type,
        ]);


        return response()->json(['success_id' => $devis->id]);
    }
    

}
