<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table = "users";
    protected $guarded = [];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function notifs()
    {
        return $this->hasMany(Notif::class);
    }
    public function conges()
    {
        return $this->hasMany(Conge::class);
    }
    public function calcule_conge($currentYear)
    {
        return $this->conges()->whereYear('created_at', $currentYear)->whereNotIn('status', ['annuler', 'refuse'])->sum('nb_jours');
    }
    public function notes()
    {
        return $this->hasMany(Note::class);
    }

    public function interventions(): HasMany
    {
        return $this->hasMany(Intervention::class, 'intervenant_id', 'id');
    }
    public function incrementSoldeConge()
    {
        $this->solde_conge += 1.75;
        $this->save();
    }

    public function resetSoldeCongeMaladie()
    {
        $this->solde_maladie  = 6;
        $this->save();
    }
}
