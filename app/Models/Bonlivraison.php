<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bonlivraison extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function entreprise()
    {
        return $this->belongsTo(Entreprise::class);
    }
    public function client()
    {
        return $this->belongsTo(Client::class);
    }
    public function items()
    {
        return $this->hasMany(ItemBonlivraison::class);
    }
    public function devis()
    {
        return $this->belongsTo(Devis::class);
    }
}
