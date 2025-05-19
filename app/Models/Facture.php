<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Client;

class Facture extends Model
{
  use HasFactory;
  protected $table = "factures";
  protected $guarded = [];

  public function devis()
  {
    return $this->belongsTo(Devis::class);
  }
  public function client()
  {
    return $this->belongsTo(Client::class);
  }

  public function fournisseur()
  {
    return $this->belongsTo(Fournisseur::class);
  }

  public function entreprise()
  {
    return $this->belongsTo(Entreprise::class);
  }

  public function frais()
  {
    return $this->hasMany(Frais::class);
  }

  public function produits()
  {
    return $this->hasMany(Catalogue::class);
  }

  public function paiements()
  {
    return $this->hasMany(Paiement::class);
  }
  public function items()
  {
    return $this->hasMany(ItemFacture::class);
  }

  public function ordres()
  {
    return $this->belongsToMany(Ordre::class, 'factures_ordres');
  }
  public function oportunity()
  {
    return $this->belongsToMany(Oportunity::class, 'oportunitys_factures');
  }

  //relationsip between contrat and facture month
  public function contrat()
  {
    return $this->belongsToMany(Contrat::class, 'contrats_factures');
  }
	
  public function avoir()
  {
    return $this->hasOne(Avoir::class);
  }

  public function calcule()
  {
    $somme_tva = 0;
    $somme_remise = 0;
    $somme_ttc = 0;
    $somme_ht = 0;
    $somme_paiement = 0;

    foreach ($this->items as $item) {
      $somme_tva += $item->total_tva;
      $somme_ht += $item->total_ht;
      $somme_remise += $item->total_remise;
      $somme_ttc += $item->total_ttc;
    }
    $somme_debour = 0;

    foreach ($this->frais as $frais) {
      $somme_debour += $frais->montant;
    }

    foreach ($this->paiements as $paiement) {
      $somme_paiement += $paiement->montant;
    }

    $this->facture_debour = $somme_debour;
    $this->facture_remise = $somme_remise;
    $this->facture_ht = $somme_ht;
    $this->facture_tva = $somme_tva;
    $this->facture_ttc = $somme_ttc + $somme_debour + $this->timbre;
    $this->facture_retenu = 0;
    $this->retenu = 0;
    $this->facture_paye = $somme_paiement;
	  
	$montant_avoir = $this->avoir ? $this->avoir->montant_ttc : 0;
	$this->facture_solde = round($this->facture_ttc, 3) - round($this->facture_paye, 3) - round($montant_avoir, 3);

    //if ($this->facture_solde == 0) {
    //  $this->status = 'paye';
    //}
	
	if ($this->facture_solde <= 0) {
      $this->status = 'paye';
      $this->facture_solde = 0;
    } else if ($this->facture_paye > 0 || $montant_avoir > 0) {
      $this->status = 'paye_partielle';
    }  
  }
}
