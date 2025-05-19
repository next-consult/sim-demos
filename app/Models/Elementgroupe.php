<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Elementgroupe extends Model
{
    use HasFactory;
    protected $table = "elementgroupes";
    protected $guarded = [];



    public function groupe()
    {
        return $this->belongsTo(Groupe::class);
    }
}
