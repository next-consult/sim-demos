<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoriesProduit extends Model
{
    use HasFactory;
    protected $table = "categories_produit";
    protected $guarded = [];
    protected $fillable = ['nom'];

    public function stocks()
    {
        return $this->hasMany(Stock::class, 'idcategorie', 'id');
    }



}
