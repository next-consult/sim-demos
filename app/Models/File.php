<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;
    protected $table = "files";
    protected $guarded = [];


    public function client()
    {
        return $this->belongsTo(Client::class);
    }
    public function depense()
    {
        return $this->belongsTo(Depense::class);
    }
}
