<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemBonlivraison extends Model
{
    use HasFactory;
    protected $table = "itembonlivraisons";
    protected $guarded = [];

    public function bonlivraison()
    {
        return $this->belongsTo(itembonlivraisons::class);
    }
}
