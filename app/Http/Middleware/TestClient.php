<?php

namespace App\Http\Middleware;

use Auth;
use Closure;
use Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Notifications\CamionNotif;
use App\Models\User;
use App\Models\Client;
use App\Models\Facture;
use App\Models\Notif;
use Carbon\Carbon;

class TestClient
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {

        $now = Carbon::now()->format('Y-m-d');
        $factures=Facture::all();
        $clients=Client::all();
        $date_now=strtotime($now);
        $user=User::where('type','admin')->first();

        if (Auth::check())
        {

            // foreach($factures as $facture){

            //     $notif_last_today=DB::table('customnotifs')->where('user_id',$user->id)
            //     ->where('created_at','>',now()->subDays(1)->format('Y-m-d H:i:s'))
            //     ->where('client_id',$facture->devis->dossier->client->id)
            //     ->where('facture_id',$facture->id)
            //     ->where('type_notif','client_date_bientot_epuise')
            //     ->get();

            //     $notif_epuise=DB::table('customnotifs')->where('user_id',$user->id)
            //     ->where('created_at','>',now()->subDays(1)->format('Y-m-d H:i:s'))
            //     ->where('client_id',$facture->devis->dossier->client->id)
            //     ->where('facture_id',$facture->id)
            //     ->where('type_notif','client_date_epuise')
            //     ->get();


            //     if($date_now==strtotime($facture->date_paiement) && $notif_last_today->isEmpty())
            //     {
             
            //     Notif::create([
            //             "user_id"=>$user->id,
            //             "description"=>"Aujourd'hui c'est la date limite pour payer la facture <b>".$facture->numero."</b> du client <b>".$facture->devis->dossier->client->nom."</b>",
            //             "facture_id"=>$facture->id,
            //             "client_id"=>$facture->devis->dossier->client->id,
            //             "type_notif"=>'client_date_bientot_epuise',
            //        ]);         
            //     }
                
            //     if($date_now>strtotime($facture->date_paiement) && $notif_epuise->isEmpty()){
            //         $paiement = new Carbon($facture->date_paiement);
            //         $now = Carbon::now();
            //         $difference = (intval($paiement->diffInDays($now)))." jours";
                 
                 
            //         Notif::create([
            //             "user_id"=>$user->id,
            //             "description"=>"la facture <b>".$facture->numero."</b> du client <b>".$facture->devis->dossier->client->nom."</b> a dépassé la date du paiement <b>".$difference." </b>",
            //             "client_id"=>$facture->devis->dossier->client->id,
            //             "facture_id"=>$facture->id,
            //             "type_notif"=>'client_date_epuise',
            //        ]);    
            //        Client::where('id',$facture->devis->dossier->client->id)->update(["status_date"=>"invalide"]);
            //     }
                
                
                
            //     else{
            //        Client::where('id',$facture->devis->dossier->client->id)->update(["status_date"=>"valide"]);

            //     }
            // }

            // foreach($clients as $client)
            // {
            // $solde=$client->solde;
            // $plafond=$client->categorie->montant;

            // $notif_plafond=DB::table('customnotifs')->where('user_id',$user->id)
            // ->where('created_at','>',now()->subDays(1)->format('Y-m-d H:i:s'))
            // ->where('client_id',$client->id)
            // ->where('type_notif','client_montant_epuise')
            // ->get();

            // if($solde==$plafond && $notif_plafond->isEmpty()){
            //     Notif::create([
            //           "user_id"=>$user->id,
            //           "description"=>"Le client <b>".$client->nom."</b> a atteint le solde plafond",
            //           "client_id"=>$client->id,
            //           "type_notif"=>'client_montant_epuise',
            //      ]);
            //      Client::where('id',$client->id)->update(["status_montant"=>"invalide"]);
             
            //   }



            //   elseif($solde>$plafond && $notif_plafond->isEmpty()){

            //     Notif::create([
            //         "user_id"=>$user->id,
            //         "description"=>"Le client <b>".$client->nom."</b> a dépassé le solde plafond",
            //         "client_id"=>$client->id,
            //         "type_notif"=>'client_montant_epuise',
            //    ]);
            //    Client::where('id',$client->id)->update(["status_montant"=>"invalide"]);


            //   }
            //   else{
            //   Client::where('id',$client->id)->update(["status_montant"=>"valide"]);

            //   }






            
            // }





        }
        return $next($request);
    }
}
