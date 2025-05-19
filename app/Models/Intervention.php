<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
class Intervention extends Model
{
    use HasFactory;
    protected $table = "interventions";

    protected $fillable = [
        'name',
        'client_id',
        'entreprise_id',
        'date',
        'intervenant',
        'description',
        'numero',
        'repeat_type',
        'intervenant_id',
        'description',
        'datedebut',
        'datefin',
        'color',
        'address',
        'status',
		'image'
    ];
   /* public function updateStatus()
    {
        $currentDate = now();

        if ($this->date > $currentDate) {
            $this->status = 'En attente';
        } elseif ($this->date <= $currentDate && ($this->datefin == null || $this->datefin >= $currentDate)) {
            $this->status = 'Démarré';
        } else {
            $this->status = 'Complété';
        }

        $this->save();
    }
    public function getStatusAttribute()
    {
        $currentDate = now();

        if ($this->date > $currentDate) {
            return 'En attente';
        } elseif ($this->datedebut <= $currentDate && ($this->datefin == null || $this->datefin >= $currentDate)) {
            return 'Démarré';
        } else {
            return 'Complété';
        }
    } */


    protected $guarded = [];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function entreprise()
    {
        return $this->belongsTo(Entreprise::class);
    }

    public function intervenant(): BelongsTo
    {
        return $this->belongsTo(User::class, 'intervenant_id');
    }

    public function intervenants()
    {
        return $this->belongsToMany(User::class, 'intervention_user', 'intervention_id', 'user_id');
    }
    public function interventions()
{
    return $this->belongsToMany(Intervention::class, 'intervenant_intervention')->withPivot('color');

}
public function role()
{
    return $this->belongsTo(Role::class);
}

}
