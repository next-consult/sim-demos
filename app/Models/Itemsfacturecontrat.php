<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Itemsfacturecontrat extends Model
{
    use HasFactory;
    protected $table = "itemsfacturecontrats";
    protected $guarded = [];

    public function facture()
    {
        return $this->belongsTo(Facturecontrat::class);
    }
}
