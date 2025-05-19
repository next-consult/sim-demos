<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    protected $fillable = [
        'idcategorie',
        'category_name',
        'nom',
        'date_start',
        'date_expiration',
        'qte',
        'emplacement_id',
        'catalogue_id',
		'code',
    ];

    // Define the relationship with CategoriesProduit
    public function category()
    {
        return $this->belongsTo(CategoriesProduit::class, 'idcategorie', 'id');
    }

    public function emplacement()
    {
        return $this->belongsTo(Emplacement::class, 'emplacement_id');
    }

    public function catalogue()
    {
        return $this->belongsTo(Catalogue::class, 'catalogue_id', 'id');
    }
}