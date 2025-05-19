<?php

namespace App\Http\Controllers\crm;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Oportunity;
use App\Models\noteCrm;
use App\Models\Reunion;
use Validator;
use App\Models\Devis;
use App\Models\Groupe;
use Carbon\Carbon;
use App\Models\Client;
use App\Models\Entreprise;
use App\Models\OportunityDevis;
use App\Models\OportunityFacture;
use App\Models\Facture;
use App\Models\Note;
use App\Models\Filesopp;
use Illuminate\Support\Facades\Storage;

class OpportunityController extends Controller
{
    public function index()
    {
        $oportunitys = Oportunity::orderby('updated_at', 'desc')->get();
        $notes = noteCrm::get();
        return view('crm.index')
            ->with(compact('notes'))
            ->with(compact('oportunitys'));
    }
    public function new_index()
    {
        $oportunitys = Oportunity::orderby('updated_at', 'desc')->get();
        return view('crm.new_index')
            ->with(compact('oportunitys'));
    }

    public function one_opp($id)
    {
        $oportunity = Oportunity::where('id', $id)->with('notes.user')->with('contact.contacts')


            ->with('devis')

            ->with('devis_files')

            ->with('facture')

            ->with('facture_files')

            ->first();
        return response()->json($oportunity);
    }
    public function delete_file($id)
    {
        $file_opp = Filesopp::find($id);
        $old_file = 'assets/img/' . $file_opp->fichier;
        if (Storage::exists($old_file)) {
            Storage::delete($old_file);
        }
        return response()->json(200);
    }

    public function update_file($id)
    {
        $file = Filesopp::find($id);
        return view('crm.update_file')->with(compact('file'));
    }
    public function update_store_file(Request $request, $id)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'montant' => 'required',
                'date' => 'required_if:type,facture',
            ],
        );
        $file_opp = Filesopp::find($id);
        if ($request->file('file') != '') {
            $old_file = 'assets/img/' . $file_opp->fichier;
            $file = $request->file('file');
            $nom_file = $file->getClientOriginalName();
            if (Storage::exists($old_file)) {
                Storage::delete($old_file);
            }

            $file->move('assets/img/', $nom_file);
            $file_opp->fichier = $nom_file;
        }
        $file_opp->montant = $request->montant;
        $file_opp->date = $request->date;
        $file_opp->update();
        return redirect()->route('crm.index_new')->with('status', 'Fichier modifié avec success!');;
    }



    public function save_profil(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'date_deal' => 'required',
                'type_projet' => 'required',
                'revenu' => 'required',
                'rating_value' => 'required',
            ],
        );
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()]);
        }
        //opp
        Oportunity::where('id', $request->id)
            ->update([
                "rating" => $request->rating_value,
                "expected_revenue" => $request->revenu,
                "date_deal" => $request->date_deal,
                "type_projet" => $request->type_projet,
            ]);
        return response()->json(200);
    }


    public function save_notes(Request $request)
    {

        //notes
        $notes = json_decode($request->notes);
        if (count($notes) == 0) {
            Note::where('oportunity_id', $request->id)->delete();
        } else {
            $array_ids = [];
            foreach ($notes as $item) {
                array_push($array_ids, $item->id);
            }
            Note::whereNotIn('id', $array_ids)->where('oportunity_id', $request->id)->delete();
            foreach ($notes as $note) {
                if ($note->id == "new") {
                    Note::create([
                        "objet" => $note->objet,
                        "description" => $note->description,
                        "user_id" => auth()->user()->id,
                        "oportunity_id" => $request->id,
                    ]);
                } else if (is_numeric($note->id)) {
                    Note::where('id', $note->id)->update([
                        "objet" => $note->objet,
                        "description" => $note->description,
                    ]);
                }
            }
        }

        return response()->json(200);
    }

    public function leads(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'date_deal' => 'required',
                'revenu' => 'required',
                'type_projet' => 'required',
                'rating_value' => 'required',
            ],
        );
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()]);
        }
        $groupe = Groupe::where('nom', 'opportunite')->first();

        $numero = $groupe->numero();
        if ($numero == false) {
            return response()->json(['error_existe' => "Numéro éxiste déja , changer le numéro prochain dans les parametres"]);
        }
        Oportunity::create([
            "numero" => $numero,
            "step" => 1,
            "rating" => $request->rating_value,
            "expected_revenue" => $request->revenu,
            "date_deal" => $request->date_deal,
            "type_projet" => $request->type_projet,
            "contactcrm_id" => $request->contact_id,
        ]);
        $groupe->nb_prochain++;
        $groupe->save();
        return response()->json(200);
    }

    public function devis_manuelle(Request $request)
    {

        $validator = Validator::make(
            $request->all(),
            [
                'file' => 'required_if:type_devis,autre',
                'montant' => 'required_if:type_devis,autre',
            ],
        );
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()]);
        }
        if ($request->type_devis == "interne") {
            $result = $this->create_devis($request);
        } else if ($request->type_devis == "autre") {
            $result = $this->create_file($request);
        }
        return response()->json(['success' => 200, 'type_result' => $request->type_devis, 'success_id' => $result->id]);
    }

    public function facture_manuelle(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'file' => 'required_if:type_facture,autre',
                'montant' => 'required_if:type_facture,autre',
                'date' => 'required_if:type_facture,autre',
            ],
        );
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()]);
        }

        if ($request->type_facture == "interne") {
            $result = $this->create_facture($request);
        } else if ($request->type_facture == "autre") {
            $result = $this->create_file($request);
        }
        return response()->json(['success' => 200, 'type_result' => $request->type_facture, 'success_id' => $result->id]);
    }


    public function create_document(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'file' => 'required',
            ],
        );
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()]);
        }
        $this->create_file($request);
        return response()->json(200);
    }


    private function create_file($request)
    {
        $file = $request->file('file');
        $nom_file =  time() . '_' . $file->getClientOriginalName();
        $file->move('assets/img/', $nom_file);
        $file = Filesopp::create([
            "fichier" => $nom_file,
            "type" => $request->type_file,
            "montant" => $request->montant,
            "date" => $request->date,
            "oportunity_id" => $request->id,
        ]);
        return $file;
    }

    public function change_right(Request $request)
    {
        $new_step = $request->step + 1;
        if ($request->step == 1) {
            $result = $this->create_devis($request);
            $type_result = 'devis';
        } else if ($request->step == 2) {
            $result = $this->create_facture($request);
            $type_result = 'facture';
        }
        Oportunity::where('id', $request->id)->update(["step" => $new_step]);
        return response()->json(['type_result' => $type_result, 'success_id' => $result->id]);
    }

    public function create_devis($request)
    {
        $entreprise = Entreprise::first();
        $opportunite = Oportunity::find($request->id);

        $client_test = Client::where('email', $opportunite->contact->email)->first();
        $date = date('Y-m-d');

        if (!$client_test) {
            $groupe = Groupe::where('nom', 'client')->first();
            $numero = $groupe->numero();
            if ($numero == false) {
                return response()->json(['error_existe' => "Numéro éxiste déja , changer le numéro prochain dans les parametres"]);
            }
            $client = Client::create([
                "numero" => $numero,
                "nom" => $opportunite->contact->raison_social,
                "adresse" => $opportunite->contact->adresse,
                "email" => $opportunite->contact->email,
                "telephone" => $opportunite->contact->telephone,
                "categorie_id" => 1,
                "type" => 'avec_taxe',
                "status_date" => "valide",
                "status_montant" => "valide",
            ]);
            $groupe->nb_prochain++;
            $groupe->save();
        } else {
            $client = $client_test;
        }
        $groupe_devis = Groupe::where('nom', 'devis')->first();
        $numero_devis = $groupe_devis->numero();
        $devis = Devis::create([
            "numero" => $numero_devis,
            "status" => 'en cours',
            "client_id" => $client->id,
            "entreprise_id" => $entreprise->id,
            "date" => $date,
            "type" => null,
        ]);
        $groupe_devis->nb_prochain++;
        $groupe_devis->save();
        OportunityDevis::create(["oportunity_id" => $request->id, "devis_id" => $devis->id]);
        return $devis;
    }
    public function create_facture($request)
    {
        $entreprise = Entreprise::first();
        $opportunite = Oportunity::find($request->id);

        $client_test = Client::where('email', $opportunite->contact->email)->first();
        $date = date('Y-m-d');

        if (!$client_test) {
            $groupe = Groupe::where('nom', 'client')->first();
            $numero = $groupe->numero();
            if ($numero == false) {
                return response()->json(['error_existe' => "Numéro éxiste déja , changer le numéro prochain dans les parametres"]);
            }
            $client = Client::create([
                "numero" => $numero,
                "nom" => $opportunite->contact->raison_social,
                "adresse" => $opportunite->contact->adresse,
                "email" => $opportunite->contact->email,
                "telephone" => $opportunite->contact->telephone,
                "categorie_id" => 1,
                "type" => 'avec_taxe',
                "status_date" => "valide",
                "status_montant" => "valide",
            ]);
            $groupe->nb_prochain++;
            $groupe->save();
        } else {
            $client = $client_test;
        }

        $groupe_facture = Groupe::where('nom', 'facture')->first();

        $numero_facture = $groupe_facture->numero();
        if ($numero_facture == false) {
            return response()->json(['error_existe' => "Numéro éxiste déja , changer le numéro prochain dans les parametres"]);
        }
        $nb_jours_clients = $client->categorie->nb_jours;
        $date_paiement = Carbon::parse($date)->addDays($nb_jours_clients)->format('Y-m-d');
        $facture = Facture::create([
            "numero" => $numero_facture,
            "status" => 'en cours',
            "date" => $date,
            "client_id" => $client->id,
            "entreprise_id" => $entreprise->id,
            "date_paiement" => $date_paiement,
            "type" => "client",
        ]);
        $facture_calcule = Facture::find($facture->id);
        $facture_calcule->calcule();
        $facture_calcule->save();
        $client->solde();
        $client->save();
        $groupe_facture->nb_prochain++;
        $groupe_facture->save();
        OportunityFacture::create(["oportunity_id" => $request->id, "facture_id" => $facture->id]);
        return $facture;
    }
    public function devis_opp($id)
    {
        return redirect()->route('crm.index_new')->with('opp_id', $id);
    }





    //old_version
    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'etape' => 'required',
                'client_id' => 'required',
                'opportunite' => 'required',
                'email' => 'required',
                'telephone' => 'required',
                'revenu' => 'required',
            ],
        );
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()]);
        }
        Oportunity::create([
            "step" => $request->etape,
            "notecrm_id" => $request->client_id,
            "email" => $request->email,
            "telephone" => $request->telephone,
            "expected_revenue" => $request->revenu,
            "status" => "en cours",
            "titre" => $request->opportunite
        ]);
        return response()->json(200);
    }

    public function store_update(Request $request, $id)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'client_id' => 'required',
                'opportunite' => 'required',
                'email' => 'required',
                'telephone' => 'required',
                'revenu' => 'required',
            ],
        );
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()]);
        }
        Oportunity::where('id', $id)->update([
            "notecrm_id" => $request->client_id,
            "email" => $request->email,
            "telephone" => $request->telephone,
            "expected_revenue" => $request->revenu,
            "status" => "en cours",
            "titre" => $request->opportunite
        ]);
        return response()->json(200);
    }



    public function oneopportunite($id)
    {
        $opportunite = Oportunity::where('id', $id)->with('reunions')->with('devis')->with('facture')->first();
        return response()->json($opportunite);
    }
    public function delete($id)
    {
        Oportunity::where('id', $id)->delete();
        Reunion::where('oportunity_id', $id)->delete();
        OportunityDevis::where('oportunity_id', $id)->delete();
        OportunityFacture::where('oportunity_id', $id)->delete();
        Note::where('oportunity_id', $id)->delete();
        $file_opp = Filesopp::where('oportunity_id', $id)->first();
        if ($file_opp) {
            $old_file = 'assets/img/' . $file_opp->fichier;
            if (Storage::exists($old_file)) {
                Storage::delete($old_file);
            }
            $file_opp->delete();
        }

        return response()->json(200);
    }


    public function en_attente($id)
    {
        Oportunity::where('id', $id)->update(["step" => "step1"]);
        return response()->json(200);
    }
}
