<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ordre extends Model
{
    use HasFactory;
    protected $table = "ordres";
    protected $guarded = [];


    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function entreprise()
    {
        return $this->belongsTo(Entreprise::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function items()
    {
        return $this->hasOne(ItemOrdre::class);
    }



    public function devis()
    {
        return $this->belongsTo(Devis::class);
    }


    public function factures()
    {
        return $this->belongsToMany(Facture::class,'factures_ordres');
    }
    
    public function livraisons()
    {
        return $this->hasMany(Bonlivraison::class);
    }

}
