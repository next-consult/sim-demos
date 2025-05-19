<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Avoir extends Model
{
    use HasFactory;
    
    protected $guarded = [];
    
    public function facture()
    {
        return $this->belongsTo(Facture::class);
    }
} 