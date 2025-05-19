<?php

// app/Models/Emplacement.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Emplacement extends Model
{
    protected $fillable = ['id','nom', 'description'];

    // Define the relationship with Stock
    public function stocks()
    {
        return $this->hasMany(Stock::class, 'emplacement_id');
    }
}
