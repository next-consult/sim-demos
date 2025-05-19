<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paiement extends Model
{
    use HasFactory;
    protected $table="paiements";
    protected $guarded = []; 


    public function facture()
    {
        return $this->belongsTo(Facture::class);
    }
}
