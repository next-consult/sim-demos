<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;
use App\Models\Contrat;
use App\Models\Facture;
use App\Models\Groupe;
use App\Models\ContratFacture;
use App\Models\ItemFacture;
use App\Models\Client;
use Carbon\Carbon;

class CheckContrat
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    private function traduireMois($moisEnAnglais)
    {
        switch (strtolower($moisEnAnglais)) {
            case 'january':
                return 'janvier';
                break;
            case 'february':
                return 'février';
                break;
            case 'march':
                return 'mars';
                break;
            case 'april':
                return 'avril';
                break;
            case 'may':
                return 'mai';
                break;
            case 'june':
                return 'juin';
                break;
            case 'july':
                return 'juillet';
                break;
            case 'august':
                return 'août';
                break;
            case 'september':
                return 'septembre';
                break;
            case 'october':
                return 'octobre';
                break;
            case 'november':
                return 'novembre';
                break;
            case 'december':
                return 'décembre';
                break;
            default:
                return '';
                break;
        }
    }
    private function test_date($date, $contrat_id)
    {
        $now = Carbon::now()->format('Y-m-d');
        $date_now = Carbon::createFromFormat('Y-m-d', $date);
        $month = $date_now->month;
        $test_contrat = Facture::whereMonth('date', $month)->whereHas('contrat', function ($query) use ($contrat_id) {
            return $query->where('contrat_id', $contrat_id);
        })->with('contrat')->exists();
        $final_result = ($test_contrat == false && $now == $date) ? false : true;

        return $final_result;
    }
    public function handle(Request $request, Closure $next)
    {
        $now = Carbon::now()->format('Y-m-d');
        $contrats = Contrat::orderby('id', 'desc')->get();
        foreach ($contrats as $contrat) {
            $array_date = [];
            for ($i = 0; $i <= intval($contrat->nb_mois); $i++) {
                array_push($array_date, Carbon::parse($contrat->date_debut)->addMonths($i)->format('Y-m-d'));
            }
            $dates_filtrees = array_filter($array_date, function ($date) {
                return strtotime($date) <= time();
            });
            foreach ($dates_filtrees as $date_now) {
                if (!$this->test_date($date_now, $contrat->id)) {
                    $groupe = Groupe::where('nom', 'facture')->first();
                    $numero = $groupe->numero();
                    $facture = Facture::create([
                        "numero" => $numero,
                        "status" => 'en cours',
                        "date" => $now,
                        "client_id" => $contrat->client_id,
                        "entreprise_id" => $contrat->entreprise_id,
                        "date_paiement" => $now,
                        "type" => 'client',
                    ]);
                    foreach ($contrat->facture->items as $item) {
                        Carbon::setLocale(config('app.locale'));
                        ItemFacture::create([
                            'produit' => $item->produit,
                            'quantites' => $item->quantites,
                            'description' => $item->description . " " . $this->traduireMois(Carbon::now()->formatLocalized('%B')),
                            'prix_ht' => $item->prix_ht,
                            'tva' => $item->tva,
                            'total_remise' => $item->total_remise,
                            'type_remise' => $item->type_remise,
                            'total_ht' => $item->total_ht,
                            'total_tva' => $item->total_tva,
                            'total_ttc' => $item->total_ttc,
                            'facture_id' => $facture->id,
                            'remise' => $item->remise,
                        ]);
                    }
                    ContratFacture::create([
                        "facture_id" => $facture->id,
                        "contrat_id" => $contrat->id,
                    ]);
                    $facture_calcule = Facture::find($facture->id);
                    $facture_calcule->calcule();
                    $facture_calcule->save();
                    $groupe->nb_prochain++;
                    $groupe->save();
                    $client_id = $facture->client->id;
                    $client = Client::where('id', $client_id)->first();
                    $client->solde();
                    $client->save();
                }
            }
        }

        return $next($request);
    }
}
