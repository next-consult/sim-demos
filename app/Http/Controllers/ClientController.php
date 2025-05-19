<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Entreprise;
use App\Models\Devis;
use App\Models\Contact;
use App\Models\Categorie;
use App\Models\File;
use App\Models\ItemFacture;
use App\Models\ItemDevis;
use App\Models\Paiement;
use App\Models\Frais;
use App\Models\Facture;
use App\Models\Notif;
use App\Models\User;
use App\Models\Intervention;
use App\Models\Groupe;
use App\Exports\ClientsExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Session;
use Validator;
use PDF;

class ClientController extends Controller
{
    public function index()
    {
        $clients = Client::orderby('created_at', 'desc')->get();
        $entreprises = Entreprise::all();
        $categories = Categorie::all();

        return view('clients.index')
            ->with(compact('clients', 'entreprises', 'categories'));
    }
	public function indexF()
{
    $clients = Client::orderby('created_at', 'desc')->get();
    $entreprises = Entreprise::all();
    $categories = Categorie::all();
	$intervenant = User::where('role_id',7)->get();
    return response()->json([
        'clients' => $clients,
        'entreprises' => $entreprises,
        'categories' => $categories,
		'intervenant' => $intervenant
    ], 200);
}
	
 public function export()
    {
        return Excel::download(new ClientsExport, 'clients.xlsx');
    }
    public function add()
    {
        $categories = Categorie::all();
		        $users = User::all();

        return view('clients.add')
            ->with(compact('categories','users'));
    }


    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'nom' => 'required',
                'email' => 'required|email|unique:clients,email',
                'telephone' => 'required|numeric|unique:clients,telephone',
                'mf' => 'required|unique:clients,mf',
                'rne' => 'required|unique:clients,rne',
                'adresse' => 'required',
                'type_client' => 'required',
                'categorie' => 'required',
                'code_postal' => 'required|numeric',
            ],
        );

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()]);
        }
        $groupe = Groupe::where('nom', 'client')->first();

        $numero = $groupe->numero();
        if ($numero == false) {
            return response()->json(['error_existe' => "Numéro éxiste déja , changer le numéro prochain dans les parametres"]);
        }

        $client = new client();
        $client->numero = $numero;

        $client->nom = $request->nom;
        $client->email = $request->email;
        $client->telephone = $request->telephone;
        $client->type = $request->type_client;
        $client->status_date = "valide";
        $client->status_montant = "valide";
        $client->user_id = $request->user_id;

        $client->mf = $request->mf;
        $client->mobile = $request->mobile;
        $client->rne = $request->rne;
        $client->raison_social = $request->raison_social;

        $client->fax = $request->fax;
        $client->web = $request->web;

        // $client->solde=-abs($request->solde_avance);
        $client->adresse = $request->adresse;
        $client->categorie_id = $request->categorie;
        $client->code_postal = $request->code_postal;
        if ($request->file('photo') != '') {
            $file = $request->file('photo');
            $extension = $file->getClientOriginalExtension();
            $nom_file = $file->getClientOriginalName() . '.' . $extension;
            $file->move('assets/img/', $nom_file);
            $client->photo = $nom_file;
        }



        $client->save();




        if ($request->file('files') != '') {
            foreach ($request->file('files') as $file) {
                $extension = $file->getClientOriginalExtension();
                $nom_file = $file->getClientOriginalName() . '.' . $extension;
                $file->move('assets/img/', $nom_file);
                File::create([
                    "file" => $nom_file,
                    "client_id" => $client->id,

                ]);
            }
        }
        $contacts = json_decode($request->contacts);
        foreach ($contacts as $contact) {
            Contact::create([
                "fixe" => $contact->autre_telephone,
                "poste" => $contact->poste,
                "nom" => $contact->nom,
                "telephone" => $contact->telephone,
                "email" => $contact->email,
                "client_id" => $client->id,
            ]);
        }
        $groupe->nb_prochain++;
        $groupe->save();
        return response()->json(['success_id' => $client->id]);
    }

    public function update($id)
    {
        $client = Client::find($id);
        $categories = Categorie::all();
		$users = User::all();

        return view('clients.update')->with(compact('client', 'categories' , 'users'));
    }


    public function update_store(Request $request, $id)
    {

        $validator = Validator::make(
            $request->all(),
            [
                'nom' => 'required',
                'email' => 'required|email|unique:clients,email,' . $id,
                'telephone' => 'required|numeric|unique:clients,telephone,' . $id,
                'mf' => 'required|unique:clients,mf,' . $id,
                'rne' => 'required|unique:clients,rne,' . $id,
                'adresse' => 'required',
                'type_client' => 'required',
                'code_postal' => 'required|numeric',
            ],
        );
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()]);
        }
        //delete_items


        $client = Client::find($id);

        $client->nom = $request->nom;
        $client->email = $request->email;
        $client->telephone = $request->telephone;
        $client->type = $request->type_client;


        $client->mf = $request->mf;
        $client->rne = $request->rne;
        $client->raison_social = $request->raison_social;
		 $client->user_id = $request->user_id;
        $client->mobile = $request->mobile;

        $client->fax = $request->fax;
        $client->web = $request->web;
        $client->categorie_id = $request->categorie;

        $client->paye_avance = abs($request->solde_avance);
        // $client->solde=-abs($request->solde_avance);
        $client->adresse = $request->adresse;
        $client->code_postal = $request->code_postal;
        $client->status_date = "valide";
        $client->status_montant = "valide";
        $client->solde();

        if ($request->file('photo') != '') {
            $file = $request->file('photo');
            $extension = $file->getClientOriginalExtension();
            $nom_file = $file->getClientOriginalName() . '.' . $extension;
            $file->move('assets/img/', $nom_file);
            $client->photo = $nom_file;
        }


        $client->update();

        $files_ids = json_decode($request->files_ids);
        $array_ids = [];
        foreach ($files_ids as $item) {
            array_push($array_ids, $item->id);
        }

        File::whereNotIn('id', $array_ids)->where('client_id', $id)->delete();


        if ($request->file('files') != '') {
            foreach ($request->file('files') as $file) {

                $extension = $file->getClientOriginalExtension();
                $nom_file = $file->getClientOriginalName() . '.' . $extension;
                $file->move('assets/img/', $nom_file);
                File::create([
                    "file" => $nom_file,
                    "client_id" => $client->id,

                ]);
            }
        }


        //files


        //contact

        $contacts = json_decode($request->contacts);
        $array_ids = [];
        foreach ($contacts as $item) {
            array_push($array_ids, $item->id);
        }

        Contact::whereNotIn('id', $array_ids)->where('client_id', $id)->delete();
        foreach ($contacts as $contact) {

            if ($contact->id == "new") {

                Contact::create([
                    "nom" => $contact->nom,
                    "fixe" => $contact->autre_telephone,
                    "poste" => $contact->poste,
                    "telephone" => $contact->telephone,
                    "email" => $contact->email,
                    "client_id" => $client->id,
                ]);
            } else if (is_numeric($contact->id)) {

                Contact::where('id', $contact->id)->update([
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


    public function show($id)
    {
        $client = Client::where('id', $id)->first();
        $entreprises = Entreprise::all();

        return view('clients.show')
            ->with(compact('entreprises'))
            ->with(compact('client'));
    }
    public function devis_client($id)
    {

        $devis = Devis::where('client_id', $id)->get();
        return response()->json($devis);
    }
    public function download($id)
    {

        $file = "assets/img/" . $id;

        return response()->download($file);
    }

    public function delete($id)
    {
        $client = Client::find($id);
        $devis = Devis::where('client_id', $id)->get();
        $facutres = Facture::where('client_id', $id)->get();

        foreach ($devis  as $dev) {
            $devis_items = ItemDevis::where('devis_id', $dev->id)->get();
            foreach ($devis_items  as $item) {
                ItemDevis::where('id', $item->id)->delete();
            }
        }
        Devis::where('client_id', $id)->delete();

        foreach ($facutres  as $facture) {
            Paiement::where('facture_id', $facture->id)->delete();
            Notif::where('facture_id', $facture->id)->delete();
            Frais::where('facture_id', $facture->id)->delete();
            $fact_items = ItemFacture::where('facture_id', $facture->id)->get();
            foreach ($fact_items  as $item) {
                ItemFacture::where('id', $item->id)->delete();
            }
        }
        Facture::where('client_id', $id)->delete();
        Intervention::where('client_id', $id)->delete();

        $client->delete();
        return response()->json(200);
    }
}
