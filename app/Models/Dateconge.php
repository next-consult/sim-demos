<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dateconge extends Model
{
    use HasFactory;
    protected $table = "datesconges";
    protected $guarded = [];
    public function conge()
    {
        return $this->belongsTo(Conge::class);
    }
}
