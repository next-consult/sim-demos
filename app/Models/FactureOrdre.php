<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FactureOrdre extends Model
{
    use HasFactory;
    protected $table="factures_ordres";
    protected $guarded = []; 
}
