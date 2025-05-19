<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Souscontact extends Model
{
    use HasFactory;
    protected $table = "souscontacts";
    protected $guarded = [];

    public function contactcrm()
    {
        return $this->belongsTo(Contactcrm::class,'contactcrm_id');
    }
}
