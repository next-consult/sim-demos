<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Heurs_autorisation extends Model
{
    use HasFactory;
    protected $table = "heurs_autorisation";
    protected $fillable = [
        'user_id',
        'heurs_autorisation',
        'month',
        'year',
    ];

    // Si vous avez d'autres champs à définir ou des relations à ajouter, vous pouvez les inclure ici

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'month' => 'integer',
        'year' => 'integer',
    ];

    /**
     * Get the user that owns the heures d'autorisation.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
