<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Frais extends Model
{
    protected $table="frais";
    protected $guarded = []; 
    use HasFactory;

    public function facture()
    {
        return $this->belongsTo(Facture::class);
    }
    
}
