<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemDevis extends Model
{
    use HasFactory;
    protected $table="itemdevis";
    protected $guarded = []; 



    public function devis()
    {
        return $this->belongsTo(Devis::class);
    }
    public function catalogue()
    {
        return $this->belongsTo(Catalogue::class);
    }

    public function item_ordre()
    {
        return $this->hasOne(ItemOrdre::class,'itemdevis_id');
    }
}
