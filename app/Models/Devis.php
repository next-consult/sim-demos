<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ItemDevis;

class Devis extends Model
{
    use HasFactory;
    protected $table = "devis";
    protected $guarded = [];


    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function items()
    {
        return $this->hasMany(ItemDevis::class);
    }

    public function ordres()
    {
        return $this->hasMany(Ordre::class);
    }
    public function entreprise()
    {
        return $this->belongsTo(Entreprise::class);
    }
    public function facture()
    {
        return $this->hasOne(Facture::class);
    }

    public function bonlivraison()
    {
        return $this->hasOne(Bonlivraison::class);
    }


    public function oportunity()
    {
        return $this->belongsToMany(Oportunity::class, 'oportunitys_devis');
    }


    public function calcule_ht()
    {
        $items = $this->items;
        $somme_ht = 0;
        $somme_tva = 0;
        $somme_ttc = 0;
        $somme_remise = 0;

        foreach ($items as $item) {
            $somme_ht += floatval($item->total_ht);
            $somme_tva += floatval($item->total_tva);
            $somme_remise += floatval($item->total_remise);
            $somme_ttc += floatval($item->total_ttc);
        }
        $this->devis_remise = $somme_remise;

        $this->devis_ht = round($somme_ht, 3);

        $this->devis_tva = $somme_tva;
        $this->devis_ttc = $somme_ttc;
    }
}
