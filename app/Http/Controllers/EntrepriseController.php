<?php

namespace App\Http\Controllers;

use App\Models\Entreprise;

use Illuminate\Http\Request;
use App\Models\ItemOrdre;
use App\Models\Ordre;
use App\Models\Devis;
use App\Models\ItemDevis;
use App\Models\ItemFacture;
use App\Models\Facture;
use App\Models\FactureOrdre;
use App\Models\Paiement;
use App\Models\Notif;
use App\Models\Frais;
use App\Models\Intervention;

class EntrepriseController extends Controller
{
  public function index()
  {
    $entreprises = Entreprise::orderby('created_at', 'desc')->get();
    return view('entreprises.index')->with(compact('entreprises'));
  }


  public function add()
  {
    return view('entreprises.add');
  }

  public function store(Request $request)
  {
    $request->validate(
      [
        'nom' => 'required',
        'email' => 'required|email|unique:entreprises,email',
        'telephone' => 'required|numeric|unique:entreprises,telephone',
        'mf' => 'required|unique:entreprises,mf',
        'rne' => 'required|unique:entreprises,rne',
        'adresse' => 'required',
        'rib' => 'nullable',
        'iban' => 'nullable',
      ],
    );

    $entreprise = new Entreprise();

    if ($request->file('photo') != '') {
      $file = $request->file('photo');
      $extension = $file->getClientOriginalExtension();
      $photo = time() . rand() . '.' . $extension;
      $file->move('assets/img/', $photo);
      $entreprise->photo = $photo;
    }

    $entreprise->nom = $request->nom;
    $entreprise->email = $request->email;
    $entreprise->telephone = $request->telephone;
    $entreprise->mf = $request->mf;
    $entreprise->rne = $request->rne;
    $entreprise->adresse = $request->adresse;
    $entreprise->timbre = $request->timbre;
    $entreprise->web = $request->web;
    $entreprise->condition = $request->condition;
    $entreprise->footer = $request->footer;
    $entreprise->rib = $request->rib;
    $entreprise->iban = $request->iban;
    $entreprise->save();

    return redirect()->route('entreprises.index')->with('status', 'Entreprise ajouté avec success!');
  }

  public function update($id)
  {
    $entreprise = Entreprise::find($id);
    return view('entreprises.update')->with(compact('entreprise'));
  }



  public function update_store(Request $request, $id)
  {

    $request->validate(
      [
        'nom' => 'required',
        'email' => 'required|email|unique:entreprises,email,' . $id,
        'telephone' => 'required|numeric|unique:entreprises,telephone,' . $id,
        'mf' => 'required|unique:entreprises,mf,' . $id,
        'rne' => 'required|unique:entreprises,rne,' . $id,
        'adresse' => 'required',
        'rib' => 'nullable',
        'iban' => 'nullable',
      ],
    );
    $entreprise = Entreprise::find($id);

    if ($request->file('photo') != '') {

      if ($entreprise->photo != ''  && $entreprise->photo != null) {
        $file_old = 'assets/img/' . $entreprise->photo;
        unlink($file_old);
      }

      $file = $request->file('photo');
      $imageName = $file->getClientOriginalName();
      $file->move('assets/img/', $imageName);

      $entreprise->photo = $imageName;
    }
    $entreprise->nom = $request->nom;
    $entreprise->email = $request->email;
    $entreprise->telephone = $request->telephone;
    $entreprise->mf = $request->mf;
    $entreprise->rne = $request->rne;
    $entreprise->adresse = $request->adresse;
    $entreprise->timbre = $request->timbre;
    $entreprise->web = $request->web;
    $entreprise->condition = $request->condition;
    $entreprise->footer = $request->footer;
    $entreprise->rib = $request->rib;
    $entreprise->iban = $request->iban;
    $entreprise->update();
    return redirect()->route('entreprises.index')->with('status', 'Entreprise modifié avec success!');
  }

  public function delete($id)
  {
    $entreprise = Entreprise::find($id);
    $devis = Devis::where('entreprise_id',$id)->get();
    $facutres=Facture::where('entreprise_id',$id)->get();

    foreach($devis  as $dev){
      $devis_items=ItemDevis::where('devis_id',$dev->id)->get();
      foreach($devis_items  as $item){
       ItemDevis::where('id',$item->id)->delete();
      }
    }
    Devis::where('entreprise_id',$id)->delete();

    foreach($facutres  as $facture){
      Paiement::where('facture_id',$facture->id)->delete();
      Notif::where('facture_id',$facture->id)->delete();
      Frais::where('facture_id',$facture->id)->delete();
      $fact_items=ItemFacture::where('facture_id',$facture->id)->get();
      foreach($fact_items  as $item){
        ItemFacture::where('id',$item->id)->delete();
      }
    }
    Facture::where('entreprise_id',$id)->delete();
    Intervention::where('entreprise_id',$id)->delete();

    $entreprise->delete();
    return response()->json(200);
  }

  









}
