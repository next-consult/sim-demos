<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ordre;
use App\Models\Client;
use App\Models\Entreprise;
use App\Models\Devis;
use App\Models\Chauffeur;
use App\Models\Camion;
use App\Models\ItemOrdre;
use Session;
use Validator;
use PDF;
use DateTime;
class OrdreController extends Controller
{
    public function index()
    {
      $clients = Client::all();
      $entreprises = Entreprise::all();
      $devis = Devis::where('status',"!=","converti_ordres")->get();
       
      $ordres = Ordre::get();
      
      return view('ordres.index')
      ->with(compact('entreprises'))
      ->with(compact('clients'))
      ->with(compact('devis'))
      ->with(compact('ordres'));
    }

    public function store(Request $request)
    {
            $validator =Validator::make(
                $request->all(),
                [
                    'devis_id' => 'required',
                ],
            );
            if ($validator->fails()) {
                return response()->json(['error' => $validator->errors()]);
            }
        $devis=Devis::find($request->devis_id);
        if(count($devis->items)==0){
            return response()->json(['error_vide' => "Devis vide"]);

        }

 
            


        foreach($devis->items as $item)
        {
        if(count(Ordre::all())==0){
                $number=str_pad(1, 4, '0', STR_PAD_LEFT); 
            }
            else{
                $ordre=Ordre::orderby('id','desc')->first();
                $number=$ordre->numero;
                if($number>=9999){
                    $number=intval($number)+1;
                }
                else{
                $number=str_pad(intval($number)+1, 4, '0', STR_PAD_LEFT); 
                }
        }
        
        $ordre=Ordre::create([
                "numero" => $number,
                "status" => 'en attente',
                "user_id" => Auth()->user()->id,
                "devis_id"=>$devis->id,

       ]); 
       
        ItemOrdre::create([
                "ordre_id"=>$ordre->id,
                "adress_enlev"=>$item->catalogue->destination->enlevement,
                "adress_livraison"=>$item->catalogue->destination->livraison,
                "no_dossier"=>$devis->dossier->numero,
                "nom_livraison"=>$devis->dossier->client->nom ." ".$devis->dossier->client->prenom,
                "itemdevis_id"=> $item->id,
         ]);
        }
        $devis->status="converti_ordres";
        $devis->update();
        return response()->json(['success_id' => $devis->id]);
    }
    
    public function update($id,$all)
    {
     $previous=$all;
     $devis=Devis::find($id);
     $ordres=Ordre::where('devis_id','=',$id)->whereDoesntHave('factures')->get();
      $chauffeurs=Chauffeur::with("camions")->get();
      $camions=Camion::all();
      return view('ordres.update')
      ->with(compact('chauffeurs'))
      ->with(compact('camions'))
      ->with(compact('ordres'))
      ->with(compact('previous'))
       ->with(compact('devis'));
    }


    public function config(Request $request,$id){
        // $validator = Validator::make($request->all(),
        //     [
        //       'adress_enlev' => 'required',
        //       'date_enlev'=> 'required|date',
        //       'nom_enlev'=> 'required',

        //       'adress_livraison'=> 'required' ,
        //       'date_livraison'=> "required|after_or_equal:.$request->date_enlev" ,
        //       'nom_livraison'=> 'required',

        //       'nb_coliss'=> 'required|numeric|gte:0' ,
        //       'nature'=> 'required' ,
        //       'volume'=> 'required|numeric|gte:0' ,
        //       'poids'=> 'required|numeric|gte:0' ,
        //       'specif'=> 'required' ,
              
        //       'no_dossier'=> 'required',
        //      'prix_achat'=> 'required|numeric|gte:0',
        //      'prix_vente'=> 'required|numeric|gte:0' ,
        //       'chauffeur_id'=> 'required' ,
        //       'camion_id'=> 'required' ,
      
        //     ],
        //   );

    
        //   if ($validator->fails()) 
        //   {
           
        //     return response()->json([
        //                 'error' => $validator->errors()
        //             ]);
        
        // }

        $test=ItemOrdre::where('ordre_id',$id)->update([
          'date_enlev'=> $request->date_enlev,
          'nom_enlev'=> $request->nom_enlev,
          'date_livraison'=>  $request->date_livraison,
          'nom_livraison'=>$request->nom_livraison ,
          'nb_coliss'=> $request->nb_coliss,
          'nature'=>$request->nature,
          'volume'=>$request->volume ,
          'poids'=> $request->poids ,
          'specif'=>$request->specif,
          'prix_achat'=>$request->prix_achat,
          'prix_vente'=>$request->prix_vente ,
          'chauffeur_id'=>$request->chauffeur_id  ,
          'camion_id'=>$request->camion_id  ,
          'matricule_camion'=>Camion::where('id',$request->camion_id)->first()->matricule,
          'evaluation'=> $request->evaluation ,
          'remarques'=>$request->remarques,
        ]);    
         return response()->json(200);

    }
    public function print ($id)
    {

    $ordre=Ordre::where('id',$id)->first(); 
    $photo = "assets/img/".$ordre->devis->entreprise->photo;
    $pdf = PDF::loadView('ordres.print', compact('ordre','photo'));
    $nom_devis="Ordre-".$ordre->numero.".pdf";
    return $pdf->download($nom_devis);

    }
    public function ordre_devis($id){

        $ordres=Ordre::where('devis_id',$id)->whereDoesntHave('factures')->with('items.item_devis.catalogue.destination')->get();
        return response()->json($ordres);
     }

    
    




}
