<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Filesopp extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function oportunity()
    {
        return $this->belongsTo(Oportunity::class);
    }
}
