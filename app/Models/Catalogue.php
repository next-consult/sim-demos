<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Catalogue extends Model
{
    use HasFactory;
    protected $table = "catalogues";
    protected $guarded = [];

    // protected $casts = [
    //     'date_debut' => 'date',
    //     'date_fin' => 'date'
    // ];

    public function stock()
    {
        return $this->belongsTo(Stock::class);
    }
    public function stocks()
    {
        return $this->hasOne(Stock::class, 'catalogue_id', 'id');
    }

    public function categorie()
    {
        return $this->belongsTo(Categorie::class, 'categorie', 'id', 'categorie');
    }



    public function items()
    {
        return $this->hasOne(ItemDevis::class);
    }

    public function fournisseur()
    {
        return $this->belongsTo(Fournisseur::class);
    }
    public function facture()
    {
        return $this->belongsTo(Facture::class);
    }
}
