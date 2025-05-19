<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemOrdre extends Model
{
    use HasFactory;
    protected $table="itemordres";
    protected $guarded = []; 



    public function ordres()
    {
        return $this->belongsTo(Ordre::class);
    }

    public function chauffeur()
    {
        return $this->belongsTo(Chauffeur::class);
    }

    public function camion()
    {
        return $this->belongsTo(Camion::class);
    }

    public function item_devis()
    {
        return $this->belongsTo(ItemDevis::class,'itemdevis_id');
    }
}
