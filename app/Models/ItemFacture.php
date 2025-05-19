<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemFacture extends Model
{
    use HasFactory;
    protected $table="itemfactures";
    protected $guarded = []; 

    public function facture()
    {
        return $this->belongsTo(Facture::class);
    }
}
