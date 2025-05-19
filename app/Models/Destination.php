<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Destination extends Model
{
    use HasFactory;
    protected $table = "destinations";
    protected $guarded = [];

    public function frais()
    {
        return $this->hasMany(Frais::class);
    }
   
    public function catalogue()
    {
        return $this->hasone(Destination::class);
    }
}
