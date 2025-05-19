<?php

namespace App\Http\Controllers\crm;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Groupe;
use App\Imports\ContactCrmImport;
use App\Models\Oportunity;
use App\Models\ContactCrm;
use App\Models\Reunion;
use Validator;
use Excel;
use exception;
use App\Models\OportunityDevis;
use App\Models\OportunityFacture;
use App\Models\Souscontact;
use Illuminate\Support\Facades\Storage;
use App\Models\Note;
use App\Models\Filesopp;

class ContactController extends Controller
{
    public function index()
    {

        $contactcrms = ContactCrm::all();
        return view('contactcrms.index')
            ->with(compact('contactcrms'));
    }
    public function add()
    {
        return view('contactcrms.add');
    }

    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'raison' => 'required',
            ],
        );
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()]);
        }
        $groupe = Groupe::where('nom', 'contact-crm')->first();

        $numero = $groupe->numero();
        if ($numero == false) {
            return response()->json(['error_existe' => "Numéro éxiste déja , changer le numéro prochain dans les parametres"]);
        }
        $groupe->nb_prochain++;
        $groupe->save();
        $photo = null;
        if ($request->file('photo') != '') {
            $file = $request->file('photo');
            $nom_file = time() . '_' . $file->getClientOriginalName();
            $file->move('assets/img/', $nom_file);
            $photo = $nom_file;
        }


        $contactcrm = ContactCrm::create([
            "numero" => $numero,
            "raison_social" => $request->raison,
            "nom" => $request->nom,
            "prenom" => $request->prenom,
            "email" => $request->email,
            "telephone" => $request->telephone,
            "mobile" => $request->mobile,
            "secteur" => $request->secteur,
            "mf" => $request->mf,

            "adresse" => $request->adresse,
            "web" => $request->web,
            "fax" => $request->fax,
            "code_postal" => $request->code_postal,
            "poste" => $request->poste,

            "linkedin" => $request->linkedin,
            "facebook" => $request->facebook,
            "instagram" => $request->instagram,
            "comentaire" => $request->comentaire,
            "photo" => $photo,
        ]);
        $contacts = json_decode($request->contacts);
        foreach ($contacts as $contact) {
            Souscontact::create([
                "fixe" => $contact->autre_telephone,
                "poste" => $contact->poste,
                "nom" => $contact->nom,
                "telephone" => $contact->telephone,
                "email" => $contact->email,
                "contactcrm_id" => $contactcrm->id,
            ]);
        }
        return response()->json(200);
    }

    public function update_contactcrm($id)
    {

        $contactcrm = ContactCrm::find($id);
        return view('contactcrms.update')->with(compact('contactcrm'));
    }

    public function update_store(Request $request, $id)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'raison' => 'required'
            ],
        );
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()]);
        }

        $contact = ContactCrm::find($id);
        $photo = $contact->photo;
        if ($request->file('photo') != '') {
            $old_file = 'assets/img/' .  $photo;
            $file = $request->file('photo');
            $nom_file = time() . '_' . $file->getClientOriginalName();
            if (Storage::exists($old_file)) {
                Storage::delete($old_file);
            }
            $file->move('assets/img/', $nom_file);
            $photo =  $nom_file;
        }









        ContactCrm::where('id', $id)->update([
            "raison_social" => $request->raison,
            "nom" => $request->nom,
            "prenom" => $request->prenom,
            "email" => $request->email,
            "telephone" => $request->telephone,
            "mobile" => $request->mobile,
            "secteur" => $request->secteur,
            "mf" => $request->mf,
            "adresse" => $request->adresse,
            "web" => $request->web,
            "fax" => $request->fax,
            "code_postal" => $request->code_postal,
            "poste" => $request->poste,
            "linkedin" => $request->linkedin,
            "facebook" => $request->facebook,
            "instagram" => $request->instagram,
            "comentaire" => $request->comentaire,
            "photo" => $photo,
        ]);
        $contacts = json_decode($request->contacts);
        $array_ids = [];
        foreach ($contacts as $item) {
            array_push($array_ids, $item->id);
        }
        Souscontact::whereNotIn('id', $array_ids)->where('contactcrm_id', $id)->delete();
        foreach ($contacts as $contact) {
            if ($contact->id == "new") {
                Souscontact::create([
                    "nom" => $contact->nom,
                    "fixe" => $contact->autre_telephone,
                    "poste" => $contact->poste,
                    "telephone" => $contact->telephone,
                    "email" => $contact->email,
                    "contactcrm_id" => $id,
                ]);
            } else if (is_numeric($contact->id)) {
                Souscontact::where('id', $contact->id)->update([
                    "fixe" => $contact->autre_telephone,
                    "poste" => $contact->poste,
                    "nom" => $contact->nom,
                    "telephone" => $contact->telephone,
                    "email" => $contact->email,
                ]);
            }
        }

        return response()->json(200);
    }
    public function delete($id)
    {
        ContactCrm::where('id', $id)->delete();
        Souscontact::where('contactcrm_id', $id)->delete();
        $opps = Oportunity::where('contactcrm_id', $id)->get();
        if (count($opps) > 0) {
            foreach ($opps as $opp) {
                Reunion::where('oportunity_id', $opp->id)->delete();
                OportunityDevis::where('oportunity_id', $opp->id)->delete();
                OportunityFacture::where('oportunity_id', $opp->id)->delete();

                Oportunity::where('contactcrm_id', $id)->delete();
                Reunion::where('oportunity_id', $opp->id)->delete();
                OportunityDevis::where('oportunity_id', $opp->id)->delete();
                OportunityFacture::where('oportunity_id', $opp->id)->delete();
                Note::where('oportunity_id', $opp->id)->delete();

                $file_opp = Filesopp::where('oportunity_id', $opp->id)->first();
                if ($file_opp) {
                    $old_file = 'assets/img/' . $file_opp->fichier;
                    if (Storage::exists($old_file)) {
                        Storage::delete($old_file);
                    }
                }

                $file_opp->delete();
            }
        }

        return response()->json(200);
    }
    public function import(Request $request)
    {
		//dd($request);
        $request->validate([
            'file' => 'required|mimes:xlsx'
        ]);
        Excel::import(new ContactCrmImport, $request->file);
    return redirect()->route('crm.contact.index')->with('success', 'Contacts imported successfully!');
    }
    public function download()
    {

        $file = "assets/files/modele_import_crm.xlsx";
        return response()->download($file);
    }
}
