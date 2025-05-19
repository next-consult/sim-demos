<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contrat extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function facture()
    {
        return $this->hasOne(Facturecontrat::class);
    }
    public function client()
    {
        return $this->belongsTo(Client::class);
    }
    public function entreprise()
    {
        return $this->belongsTo(Entreprise::class);
    }
    public function facture_month()
    {
      return $this->belongsToMany(Facture::class, 'contrats_factures');
    }
}
