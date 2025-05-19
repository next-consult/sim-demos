<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContratFacture extends Model
{
    use HasFactory;
    protected $table = "contrats_factures";
    protected $guarded = [];

}
