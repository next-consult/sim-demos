<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Facture;
use App\Models\Client; 
use App\Models\Paiement;

use App\Models\Entreprise;

class ChiffreaffaireController extends Controller
{
    public function index(Request $request){
        // Set default dates if not provided
        $date_debut = $request->date_debut ?? Date('Y').'-01-01';
        $date_fin = $request->date_fin ?? Date('Y').'-12-31';

        // Start with a base query
        $query = Facture::where('type', 'client')
            ->whereBetween('date', [
                date("Y-m-d 00:00:00", strtotime($date_debut)),
                date("Y-m-d 23:59:59", strtotime($date_fin))
            ]);

        // Apply client filter if selected
        if ($request->filled('client_id')) {
            $query->where('client_id', $request->client_id);
        }

        // Apply tax type filter if selected
        if ($request->filled('tax_type')) {
            switch($request->tax_type) {
                case 'with_tva':
                    $query->where('facture_tva', '>', 0);
                    break;
                case 'without_tva':
                    $query->where('facture_tva', 0);
                    break;
                case 'with_timbre':
                    $query->where('timbre', '>', 0);
                    break;
                case 'without_timbre':
                    $query->where('timbre', 0);
                    break;
            }
        }

        // Apply payment status filter if selected
        if ($request->filled('payment_status')) {
            if ($request->payment_status === 'paid') {
                $query->where('facture_solde', 0); // Factures payées (solde = 0)
            } elseif ($request->payment_status === 'unpaid') {
                $query->where('facture_solde', '>', 0); // Factures non payées (solde > 0)
            }
        }

        // Get filtered factures
        $factures = $query->with(['client', 'entreprise'])->get();

        // Calculate totals based on filtered data
        $total_ht = $factures->sum('facture_ht');
        $total_tva = $factures->sum('facture_tva');
        $total_ttc = $factures->sum('facture_ttc');

        // Calculer le total des paiements (somme de facture_paye)
        $paiements = $factures->sum('facture_paye');

        // Le reste à payer est la somme des soldes
        $paiementsnonpaye = $factures->sum('facture_solde');

        // Get all clients for the dropdown
        $clients = Client::all();
        $entreprises = Entreprise::all();

        // Debug: Ajouter ces lignes pour vérifier les valeurs
        \Log::info('Détails des calculs:', [
            'factures' => $factures->map(function($f) {
                return [
                    'numero' => $f->numero,
                    'ttc' => $f->facture_ttc,
                    'paye' => $f->facture_paye,
                    'solde' => $f->facture_solde
                ];
            }),
            'total_paiements' => $paiements
        ]);

        return view('chiffreaffaire.index', compact(
            'factures',
            'total_ht',
            'total_tva',
            'total_ttc',
            'paiements',
            'paiementsnonpaye',
            'clients',
            'entreprises',
            'date_debut',
            'date_fin'
        ));
    }

    public function filtre(Request $request)
    {
        $client_id = $request->client_id;
        $entreprise_id = $request->entreprise_id;
        $date_debut = date("Y-m-d 00:00", strtotime($request->date_debut));
        $date_fin = date("Y-m-d 23:59", strtotime($request->date_fin));

        // Fetch factures based on filters
        $factures = Facture::when($client_id != null, function ($query) use ($client_id) {
                $query->where('client_id', $client_id);
            })
            ->when($entreprise_id != null, function ($query) use ($entreprise_id) {
                $query->where('entreprise_id', $entreprise_id);
            })
            ->whereBetween('date', [$date_debut, $date_fin])
            ->with(['client', 'entreprise'])
            ->get();

        // Calculate totals
        $total_ht = $factures->sum('facture_ht');
        $total_tva = $factures->sum('facture_tva');
        $total_ttc = $factures->sum('facture_ttc');

        // total des paiements reçus
        $paiements = $factures->sum(function($facture) {
            return round($facture->facture_paye, 3);
        });

        //  montant restant à payer
        $paiementsnonpaye = $factures->sum(function($facture) {
            return round($facture->facture_solde, 3);
        });

        return response()->json([
            "data" => $factures,
            "total_ht" => round($total_ht, 3),
            "total_tva" => round($total_tva, 3),
            "total_ttc" => round($total_ttc, 3),
            "paiements" => round($paiements, 3),
            "paiementsnonpaye" => round($paiementsnonpaye, 3),
        ]);
    }
}
