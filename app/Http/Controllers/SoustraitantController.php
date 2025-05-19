<?php

namespace App\Http\Controllers;
use App\Models\Chauffeur;
use Session;
use Validator;
use PDF;
use Illuminate\Http\Request;

class SoustraitantController extends Controller
{
    public function index()
    {
        $chauffeurs = Chauffeur::where('type_chauffeur','externe')->get();
      return view('sous_traitants.index')
      ->with(compact('chauffeurs'));
    }
    public function add()
    {
      return view('sous_traitants.add');
    }
    public function store(Request $request)
    {
      $validator =Validator::make(
        $request->all(),
        [   
          'nom' => 'required',
          'prenom' => 'required',
          'email' => 'required|email|unique:chauffeurs,email',
          'telephone' => 'required|numeric|unique:chauffeurs,telephone',
          'cin' => 'required|unique:chauffeurs,cin',
          'date_cin' => 'required',
          'date_naissance' => 'required',
          'date_permis' => 'required',
          'type_permis' => 'required',
          'code_postal' => 'required',
          'adresse' => 'required',
        ],
    );
  
      if ($validator->fails()) {
        return response()->json(['error' => $validator->errors()]);
    } 
      $chauffeur = new Chauffeur();
  
      if ($request->file('photo') != '') {
        $file = $request->file('photo');
        $extension = $file->getClientOriginalExtension();
        $photo = time() . rand() . '.' . $extension;
        $file->move('assets/img/', $photo);
        $chauffeur->photo = $photo;
      }
  
      $chauffeur->nom = $request->nom;
      $chauffeur->prenom = $request->prenom;
      $chauffeur->email = $request->email;
      $chauffeur->telephone = $request->telephone;
      $chauffeur->cin = $request->cin;
      $chauffeur->date_cin = $request->date_cin;
      $chauffeur->type_permis = $request->type_permis;
      $chauffeur->type_chauffeur = 'externe';
      $chauffeur->mf_externe = $request->mf_externe;
      $chauffeur->nom_entreprise = $request->entreprise;
      $chauffeur->date_naissance = $request->date_naissance;
      $chauffeur->date_permis = $request->date_permis;
      $chauffeur->code_postal = $request->code_postal;
      $chauffeur->adresse = $request->adresse;
      $chauffeur->save();
        return response()->json(['success_id' => $chauffeur->id]);
    }
    public function update($id)
    {
      $chauffeur=Chauffeur::where('id',$id)->first();
      return view('sous_traitants.update')->with(compact('chauffeur'));
    }

    public function store_update(Request $request,$id)
    {
      $validator =Validator::make(
        $request->all(),
        [   
          'nom' => 'required',
          'prenom' => 'required',
          'email' => 'required|email|unique:chauffeurs,email,'.$id,
          'telephone' => 'required|numeric|unique:chauffeurs,telephone,'.$id,
          'cin' => 'required|unique:chauffeurs,cin,'.$id,
          'date_cin' => 'required',
          'date_naissance' => 'required',
          'date_permis' => 'required',
          'type_permis' => 'required',
          'code_postal' => 'required',
          'adresse' => 'required',
        ],
    );
  
      if ($validator->fails()) {
        return response()->json(['error' => $validator->errors()]);
    } 
      $chauffeur = Chauffeur::where('id',$id)->first();
  
      if ($request->file('photo') != '') {
        $file = $request->file('photo');
        $extension = $file->getClientOriginalExtension();
        $photo = time() . rand() . '.' . $extension;
        $file->move('assets/img/', $photo);
        $chauffeur->photo = $photo;
      }
  
      $chauffeur->nom = $request->nom;
      $chauffeur->prenom = $request->prenom;
      $chauffeur->email = $request->email;
      $chauffeur->telephone = $request->telephone;
      $chauffeur->cin = $request->cin;
      $chauffeur->date_cin = $request->date_cin;
      $chauffeur->type_permis = $request->type_permis;
      $chauffeur->type_chauffeur = 'externe';
      $chauffeur->mf_externe = $request->mf_externe;
      $chauffeur->nom_entreprise = $request->nom_entreprise;
      $chauffeur->date_naissance = $request->date_naissance;
      $chauffeur->date_permis = $request->date_permis;
      $chauffeur->code_postal = $request->code_postal;
      $chauffeur->adresse = $request->adresse;
      $chauffeur->update();
        return response()->json(['success_id' => $chauffeur->id]);
    }
}
