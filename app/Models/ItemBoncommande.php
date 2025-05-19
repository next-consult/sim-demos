<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemBoncommande extends Model
{
    use HasFactory;
    protected $table = "itemsboncommandes";
    protected $guarded = [];
}
