<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Client extends Model
{
    use HasFactory;
    protected $table = "clients";
    protected $guarded = [];

    public function factures()
    {
        return $this->hasMany(Facture::class);
    }

    public function contrat()
    {
        return $this->hasMany(Contrat::class);
    }

    public function devis()
    {
        return $this->hasMany(Devis::class);
    }


    public function facture()
    {
        return $this->hasMany(Facture::class);
    }
    public function ordres()
    {
        return $this->hasMany(Ordre::class);
    }
    public function contacts()
    {
        return $this->hasMany(Contact::class);
    }

    public function categorie()
    {
        return $this->belongsTo(Categorie::class);
    }

    public function files()
    {
        return $this->hasMany(File::class);
    }

    public function notifs()
    {
        return $this->hasMany(Notif::class);
    }

    public function interventions()
    {
        return $this->hasMany(Intervention::class);
    }
    public function livraison()
    {
        return $this->hasOne(Bonlivraison::class);
    }


    public function solde()
    {

        $somme_paye = 0;
        $somme_solde = 0;
        $somme_total = 0;
        $array_factures = [];
        foreach ($this->factures as $facture) {
            $somme_paye += round($facture->facture_paye, 3);
            $somme_solde += round($facture->facture_solde, 3);
            $somme_total += round($facture->facture_ttc, 3);
        }



        $this->paye_factures = $somme_paye;
        $this->paye_total = $this->paye_factures;
        $this->total = $somme_total;
        $this->solde = $this->total - $this->paye_total;
        $this->solde = round($this->solde, 3);
        $solde = $this->solde;
        $plafond = $this->categorie->montant;

        $user = User::where('type', 'admin')->first();

        $notif_plafond = DB::table('customnotifs')->where('user_id', $user->id)
            ->where('created_at', '>', now()->subDays(1)->format('Y-m-d H:i:s'))
            ->where('client_id', $this->id)
            ->where('type_notif', 'client_montant_epuise')
            ->get();


        if ($solde == $plafond && $notif_plafond->isEmpty()) {
            Notif::create([
                "user_id" => $user->id,
                "description" => "Le client <b>" . $this->nom . "</b> a atteint le solde plafond",
                "client_id" => $this->id,
                "type_notif" => 'client_montant_epuise',
            ]);
            $this->status_montant = "invalide";
        } elseif ($solde > $plafond && $notif_plafond->isEmpty()) {

            Notif::create([
                "user_id" => $user->id,
                "description" => "Le client <b>" . $this->nom . "</b> a dépassé le solde plafond",
                "client_id" => $this->id,
                "type_notif" => 'client_montant_epuise',
            ]);
            $this->status_montant = "invalide";
        } else {
            $this->status_montant = "valide";
        }
    }
}
