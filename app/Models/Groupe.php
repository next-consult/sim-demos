<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Client;
use App\Models\Devis;
use App\Models\Intervention;
use App\Models\Facture;

class Groupe extends Model
{
    protected $table = "groupes";
    protected $guarded = [];

    public function elements()
    {
        return $this->hasMany(Elementgroupe::class);
    }
    use HasFactory;

    public function numero()
    {
        $numero = $this->format;
        $updated_at = date('Y-m-d', strtotime($this->date_increment));

        if (date('m-d') == "01-1" && $updated_at != date('Y-m-d') && $this->renist == "year") {
            $this->nb_prochain = 1;
            $this->date_increment = date('Y-m-d');
        }

        if (date('d') == "01" && date('m-d') == "01-01" && $updated_at != date('Y-m-d') && $this->renist == "month") {
            $this->nb_prochain = 1;
            $this->date_increment = date('Y-m-d');
        }


        foreach ($this->elements as $element) {
            // rénistialisation
            if ($element->nom == "YEAR") {
                $nom = Date('Y');
            } else if ($element->nom == "YY") {
                $nom = Date('y');
            } else if ($element->nom == "MONTH") {
                $nom = Date('m');
            } else if ($element->nom == "NUMBER") {
                $nom = str_pad(intval($this->nb_prochain), $this->nb_left, '0', STR_PAD_LEFT);
            }
            // rénistialisation

            $numero .= $nom;
        }

        if ($this->nom == 'devis') {
            $test = Devis::where('numero', $numero)->exists();
        } elseif ($this->nom == 'facture') {
            $test = Facture::where('type', 'client')->where('numero', $numero)->exists();
        } elseif ($this->nom == 'depense') {
            $test = Facture::where('type', 'fournisseur')->where('numero', $numero)->exists();
        } elseif ($this->nom == 'intervention') {
            $test = Intervention::where('numero', $numero)->exists();
        } elseif ($this->nom == 'client') {
            $test = Client::where('numero', $numero)->exists();
        } elseif ($this->nom == 'produit') {
            $test = Catalogue::where('numero', $numero)->exists();
        } elseif ($this->nom == 'bonlivraison') {
            $test = Catalogue::where('numero', $numero)->exists();
        } elseif ($this->nom == 'boncommande') {
            $test = Catalogue::where('numero', $numero)->exists();
        } elseif ($this->nom == 'fournisseur') {
            $test = Fournisseur::where('numero', $numero)->exists();
        } elseif ($this->nom == 'contact-crm') {
            $test = ContactCrm::where('numero', $numero)->exists();
        } elseif ($this->nom == 'contrat') {
            $test = Contrat::where('numero', $numero)->exists();
        }
        elseif ($this->nom == 'opportunite') {
            $test = Oportunity::where('numero', $numero)->exists();
        }

        if ($test) {
            return false;
        }

        return   $numero;
    }
}
