<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Validator;
use App\Events\UserActionEvent;
use PDF;
use App\Models\Paiement;
use App\Models\Facture;
use App\Models\Client;
class PaiementController extends Controller
{
    public function index()
    {
    
     $paiements = Paiement::orderby('created_at', 'desc')->get();
     $factures = Facture::where('status','!=','paye')->where('type','client')->get();
        return view('paiements.index')
        ->with(compact('factures'))
        ->with(compact('paiements'));
    }

    public function save(Request $request,$id)
    {

        $validator =Validator::make(
            $request->all(),
            [
                'date' => 'required|date',
                'montant' => 'required|numeric',
                'method' => 'required',
            ],
        );
        $facture=Facture::find($id);
        
        $solde_restant=$facture->facture_solde;


        if($request->montant>$solde_restant){
            $erreur="Erreur,le solde restant a payer :".round($solde_restant,3);
            return response()->json(['error_montant' => $erreur]);
        }





        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()]);
        }
        if($facture->facture_solde==0){
            $erreur="La facture est déja payé";
            return response()->json(['error_montant' => $erreur]);
            
        }
       

        $client_id=$facture->client->id;    
        $client=Client::where('id', $client_id)->first();
        $paiement=Paiement::create([
            "date" => $request->date,
            "facture_id" => $id,
            "user_id" => Auth()->user()->id,
            "method" => $request->method,
            "montant" => $request->montant,
            "note" => $request->note,
        ]);
        
    $facture->calcule();
    $facture->save();
 
    $client->solde();
    $client->save();
    
    $facture_test=Facture::where('id',$id)->first();
    //test status retenu
    if($request->status_retenu=="desactive" && $facture_test->retenu>0 && ($facture_test->status!="paye" ||$facture_test->status!="paye_partielle")  ){
        $facture_test->facture_ttc+=round($facture_test->facture_retenu,3);
        $facture_test->facture_solde+=$facture_test->facture_retenu;
        $facture_test->retenu=0;
        $facture_test->facture_retenu=0;
        $facture_test->save();
    }


    if($facture_test->facture_solde==0){
        $facture_test->status='paye';
        $facture_test->save();


    }
    else {

      $facture_test->status='paye_partielle';
      $facture_test->save();
      

    }
	event(new UserActionEvent(auth()->id(), 'ajout Paiement', \now()));

     return response()->json(200);
    }
    public function update($id){
    $paiement=Paiement::where('id',$id)->with('facture')->first();
    return response()->json($paiement);

    }
    
    public function save_update(Request $request,$id)
    {

        $validator =Validator::make(
            $request->all(),
            [
                'date' => 'required|date',
                'montant' => 'required',
                'method' => 'required',
            ],
        );
        $paiement=Paiement::find($id);
        $reste=floatval($paiement->facture->facture_solde)+floatval($paiement->montant);
        if($request->montant>$reste){
            $erreur="Aprés la modification,le solde restant a payer :".$reste;
            return response()->json(['error_montant' => $erreur]);
        }          
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()]);
        }
      
        Paiement::where('id',$id)->update([
            "date" => $request->date,
            "method" => $request->method,
            "montant" => $request->montant,
            "note" => $request->note,
        ]);
        
        $facture=Facture::where('id',$paiement->facture_id)->first();
        $facture->calcule();
        $facture->save();
        
        $facture_test=Facture::where('id',$paiement->facture_id)->first();
        if($facture_test->facture_solde==0){
        $facture_test->status='paye';
        $facture_test->save();
        }

        $client=Client::where('id', $facture->client_id)->first();
        $client->solde();
        $client->save();
    event(new UserActionEvent(auth()->id(), 'update Paiement', \now()));
     return response()->json(200);
    }
    public function delete ($id)
    {
       
        $paiement=Paiement::where('id',$id)->first();
        $facture_test=Facture::where('id',$paiement->facture_id)->first();
        $facture_id=$paiement->facture_id;
        $paiement->delete();
        $facture_test->calcule();
        $facture_test->update();
        
        $facture=Facture::where('id',$facture_id)->first();

        if($facture->facture_solde==0){
        $facture->status='paye';
        $facture->update();
        }
        else if($facture->facture_solde==$facture->facture_ttc) {
        $facture->status='en cours';
        $facture->update();
        }
        else{
        $facture->status='paye_partielle';
        $facture->update();

        }
        $client=Client::where('id',$facture->client->id)->first();
        $client->solde();
        $client->update();
		event(new UserActionEvent(auth()->id(), 'delete Paiement', \now()));
        return response()->json(200);
    }

   
}
