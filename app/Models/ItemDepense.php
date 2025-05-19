<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemDepense extends Model
{
    use HasFactory;
    protected $table="itemdepenses";
    protected $guarded = []; 
}
