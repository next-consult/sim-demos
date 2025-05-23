<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fournisseur extends Model
{
    use HasFactory;
    protected $table = "fournisseurs";
    protected $guarded = [];

    public function items()
    {
        return $this->hasMany(Catalogue::class);
    }
    public function boncommande()
    {
        return $this->hasMany(Boncommande::class);
    }
}
