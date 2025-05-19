<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Boncommande extends Model
{
    use HasFactory;
    protected $table = "boncommandes";
    protected $guarded = [];

    public function items()
    {
        return $this->hasMany(ItemBoncommande::class);
    }
    public function entreprise()
    {
        return $this->belongsTo(Entreprise::class);
    }
    public function fournisseur()
    {
        return $this->belongsTo(Fournisseur::class);
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
        $this->commande_remise = $somme_remise;
        $this->commande_ht = round($somme_ht, 3);
        $this->commande_tva = $somme_tva;
        $this->commande_ttc = $somme_ttc;
    }
}
