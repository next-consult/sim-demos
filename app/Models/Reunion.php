<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reunion extends Model
{
    use HasFactory;
    protected $table = "reunions";
    protected $guarded = [];

    public function opportunite()
    {
        return $this->belongsTo(Oportunity::class, 'oportunity_id');
    }
}
