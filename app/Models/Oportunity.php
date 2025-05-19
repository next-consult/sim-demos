<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Oportunity extends Model
{
    use HasFactory;
    protected $table = "oportunitys";
    protected $guarded = [];


    public function contact()
    {
        return $this->belongsTo(ContactCrm::class, 'contactcrm_id');
    }
    public function reunions()
    {
        return $this->hasMany(Reunion::class);
    }
    public function devis()
    {
        return $this->belongsToMany(Devis::class, 'oportunitys_devis');
    }
    public function facture()
    {
        return $this->belongsToMany(Facture::class, 'oportunitys_factures');
    }
    public function notes()
    {
        return $this->hasMany(Note::class);
    }
    public function devis_files()
    {
        return $this->hasMany(Filesopp::class);
    }
    public function facture_files()
    {
        return $this->hasMany(Filesopp::class);
    }
}
