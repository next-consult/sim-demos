<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entreprise extends Model
{
    use HasFactory;

    public function devis()
    {
        return $this->hasOne(Devis::class);
    }
    public function livraison()
    {
        return $this->hasOne(Bonlivraison::class);
    }

    public function contrat()
    {
        return $this->hasMany(Contrat::class);
    }
    public function ordres()
    {
        return $this->hasOne(Ordre::class);
    }
    public function facture()
    {
        return $this->hasOne(Facture::class);
    }
    public function interventions()
    {
        return $this->hasMany(Intervention::class);
    }
    public function boncommande()
    {
        return $this->hasMany(Boncommande::class);
    }
}
