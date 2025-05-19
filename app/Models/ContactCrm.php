<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactCrm extends Model
{
    protected $table = "contactscrm";
    protected $guarded = [];
    use HasFactory;

    public function contacts()
    {
        return $this->hasMany(Souscontact::class,'contactcrm_id');
    }
}
