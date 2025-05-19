<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Facturecontrat extends Model
{
    use HasFactory;
    protected $guarded = [];


    public function contrat()
    {
        return $this->belongsTo(Contrat::class);
    }
    public function items()
    {
        return $this->hasMany(Itemsfacturecontrat::class);
    }
    public function calcule()
    {
        $somme_tva = 0;
        $somme_remise = 0;
        $somme_ttc = 0;
        $somme_ht = 0;

        foreach ($this->items as $item) {
            $somme_tva += $item->total_tva;
            $somme_ht += $item->total_ht;
            $somme_remise += $item->total_remise;
            $somme_ttc += $item->total_ttc;
        }
        $this->facture_remise = $somme_remise;
        $this->facture_ht = $somme_ht;
        $this->facture_tva = $somme_tva;
        $this->facture_ttc = $somme_ttc  + $this->timbre;
    }
}
