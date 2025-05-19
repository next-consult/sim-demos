<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Intervention;
use App\Models\Client;
use App\Models\Entreprise;
use App\Models\Groupe;
use App\Models\User;
use App\Models\Contrat;
use Firebase\JWT\JWT;
use App\Services\FirebaseService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;
use Carbon\Carbon;

use Log;
use Session;

use PDF;

class InterventionController extends Controller
{
    protected $FirebaseService;

    public function __construct(FirebaseService $FirebaseService)
    {
        $this->FirebaseService = $FirebaseService;
    }
    public function index(): View
    {
        $interventions = Intervention::with('client', 'entreprise', 'intervenants')->get();

        return view('interventions.index', compact('interventions'));
    }

    /**
     * create
     *
     * @param Request request
     *
     * @return View
     */
    public function create(Request $request): View
    {
        $date = $request->query('date');
        $clients = Client::with('contrat')->get();
        $entreprises = Entreprise::all();
        $intervenants = User::whereHas('role', function ($query) {
            $query->whereIn('nom', ['Technique', 'Superviseur']);
        })->get();

        if ($date) {
            return view('interventions.create', compact('intervenants', 'clients', 'entreprises', 'date'));
        } else {
            return view('interventions.create', compact('intervenants', 'clients', 'entreprises'));
        }
    }
    public function add(): View
    {
        $clients = Client::all();
        $entreprises = Entreprise::all();
        $intervenants = User::whereHas('role', function ($query) {
            $query->where('nom', 'Tchnique');
        })->get();
        // return view('interventions.create', compact('intervenants', 'clients', 'entreprises'));
        return view('interventions.add', compact('intervenants', 'clients', 'entreprises'));
    }

    public function store(Request $request): JsonResponse
    {
        $validator = Validator::make(
            $request->all(),
            [
                'date' => 'required|date',
                'client_id' => 'required',
                'entreprise_id' => 'required',
                'datedebut' => 'nullable|date',
                'datefin' => 'nullable|date',
                'repeat_type' => 'sometimes',
                'color' => 'sometimes',
                'address' => 'required',
                'intervenant_ids' => 'required|array|min:1',
                'intervenant_ids.*' => 'exists:users,id'
            ],
        );

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()]);
        }

        $groupe = Groupe::where('nom', 'intervention')->first();
        $numero = $groupe->numero();

        if ($numero == false) {
            return response()->json(['error_existe' => "Numéro éxiste déja , changer le numéro prochain dans les parametres"]);
        }

        $groupe->increment('nb_prochain');
        $groupe->save();

        // Create a single intervention
        $intervention = Intervention::create([
            'numero' => $numero,
            'date' => $request->date,
            'client_id' => $request->client_id,
            'entreprise_id' => $request->entreprise_id,
            'description' => $request->description,
            'datedebut' => $request->datedebut,
            'datefin' => $request->datefin,
            'repeat_type' => $request->repeat_type,
            'color' => $request->color,
            'address' => $request->address,
            'intervenant_id' => $request->intervenant_ids[0], // Set the primary intervenant as the first one
        ]);

        // Attach all intervenants to the intervention
        $intervention->intervenants()->attach($request->intervenant_ids);

        return response()->json(['success' => true, 'message' => 'Intervention created successfully'], 200);
    }

    // Show the update form
    public function edit($id): View
    {
        // Fetch all clients and enterprises
        $clients = Client::all();
        $entreprises = Entreprise::all();

        // Fetch intervenants based on roles
        $intervenants = User::whereHas('role', function ($query) {
            $query->whereIn('nom', ['Technique', 'Superviseur']);
        })->get();

        // Fetch the intervention record to be edited
        $intervention = Intervention::with('client', 'entreprise')->find($id);

        // Check if the intervention exists
        if (!$intervention) {
            abort(404, 'Intervention not found');
        }

        // Return the view for editing, with all required data
        return view('interventions.update', compact('intervention', 'clients', 'entreprises', 'intervenants'));
    }



    // Process the form submission
    public function update(Request $request, $id)
    {
        $request->validate([
            'date' => 'required|date',
            'intervenant_id' => 'required|exists:users,id',
            'client_id' => 'required|exists:clients,id', // Added validation for client
            'entreprise_id' => 'required|exists:entreprises,id', // Added validation for entreprise
            'address' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        // Find the intervention or return 404
        $intervention = Intervention::findOrFail($id);

        // Update the intervention
        $intervention->update($request->only('date', 'intervenant_id', 'client_id', 'entreprise_id', 'address', 'description'));

        return response()->json(['success' => 'Intervention updated successfully.']);
    }


    public function store_update($id, Request $request): JsonResponse
    {
        $validator = Validator::make(
            $request->all(),
            [
                'date' => 'required',
                //'entreprise_id' => 'required',
                'intervenant_id' => 'required',
                //'repeat_type' => 'nullable|in:daily,weekly,monthly,yearly',
                'color' => 'sometimes',
                'address' => 'required'
            ],
        );
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()]);
        }
        Intervention::where('id', $id)->update([
            "date" => $request->date,
            'intervenant_id' => $request->intervenant_id,
            "description" => $request->description,
            //"repeat_type" => $request->repeat_type,
            'color' => $request->color ? $request->color : null,
            'address' => $request->address,
        ]);
        $intervention = Intervention::find($id);
        if ($request->has('intervenant_ids')) {
            $intervention->intervenants()->sync($request->intervenant_ids);
        }
        return response()->json(['success' => true, 'message' => 'Intervention updated successfully']);
    }

    public function delete($id): JsonResponse
    {
        Intervention::where('id', $id)->delete();
        return response()->json(200);
    }
    public function getContracts($clientId)
    {
        $client = Client::find($clientId);

        if (!$client) {
            return response()->json(['error' => 'Client not found'], 404);
        }

        $contracts = Contrat::where('client_id', $clientId)->get();

        return response()->json([
            'contracts' => $contracts,
            'client' => [
                'adresse' => $client->adresse
            ]
        ]);
    }

    public function getContractDates($contractId)
    {
        $contract = Contrat::find($contractId);

        if (!$contract) {
            return response()->json(['error' => 'Contract not found'], 404);
        }

        return response()->json([
            'start_date' => $contract->date_debut,
            'end_date' => $contract->date_fin
        ]);
    }

    public function print($id)
    {
        $intervention = Intervention::where('id', $id)->first();
        $photo = "assets/img/LOGO NEXT blue-01.png";
        $logo_client = "assets/img/" . $intervention->client->photo;
        $pdf = PDF::loadView('interventions.print', compact('intervention', 'photo', 'logo_client'));
        $nom_intervention = $intervention->numero . ".pdf";
        return $pdf->download($nom_intervention);
    }
    public function updateDate(Request $request, $id)
    {
        $validated = $request->validate([
            'date' => 'required|date_format:Y-m-d H:i:s',  // Ensure the date format matches
        ]);

        $intervention = Intervention::findOrFail($id);
        $intervention->date = Carbon::parse($validated['date'])->toDateTimeString();
        $intervention->save();

        return response()->json(['success' => true]);
    }

    /////////////////Mbile///////////////////////////
    public function indexF()
    {
        // Fetch interventions with specific client fields (name, phone, adresse, email) and intervenant data
        $interventions = Intervention::with(['intervenants', 'client' => function ($query) {
            $query->select('id', 'nom', 'telephone', 'adresse', 'email'); // Select only the necessary fields
        }])->get();

        // Return the interventions data in JSON format
        return response()->json(['interventions' => $interventions], 200);
    }


    public function createF(Request $request)
    {
        $date = $request->query('date');
        $clients = Client::with('contrat')->get();
        $entreprises = Entreprise::all();
        $intervenants = User::whereHas('role', function ($query) {
            $query->where('nom', 'Tchnique');
        })->get();

        $response = [
            'intervenants' => $intervenants,
            'clients' => $clients,
            'entreprises' => $entreprises,
        ];

        if ($date) {
            $response['date'] = $date;
        }

        return response()->json($response, 200);
    }

    public function addF()
    {
        $clients = Client::all();
        $entreprises = Entreprise::all();
        $intervenants = User::whereHas('role', function ($query) {
            $query->where('nom', 'Tchnique');
        })->get();

        return response()->json([
            'intervenants' => $intervenants,
            'clients' => $clients,
            'entreprises' => $entreprises
        ], 200);
    }

    public function storeF(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'date' => 'required|date',
                'client_id' => 'required',
                'entreprise_id' => 'required',
                'intervenant_ids' => 'required|array|min:1',
                'intervenant_ids.*' => 'exists:users,id',
                'count' => 'nullable|integer',
                'datedebut' => 'nullable|date',
                'datefin' => 'nullable|date',
                'repeat_type' => 'sometimes|in:oneshot,daily,weekly,biweekly,monthly,bimonthly,yearly',
                'color' => 'sometimes',
            ]
        );

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $groupe = Groupe::where('nom', 'intervention')->first();
        $numero = $groupe->numero();

        if ($numero === false) {
            return response()->json(['error_existe' => "Numéro existe déjà, changer le numéro prochain dans les paramètres"], 400);
        }

        $groupe->increment('nb_prochain');
        $groupe->save();

        // Assign the created intervention to a variable
        $intervention = Intervention::create([
            "numero" => $numero,
            "date" => $request->date,
            "client_id" => $request->client_id,
            "count" => $request->count ?? null,
            "entreprise_id" => $request->entreprise_id,
            'intervenant_id' => $request->intervenant_ids[0], // Set the primary intervenant as the first one
            "description" => $request->description,
            "datedebut" => $request->datedebut,
            "datefin" => $request->datefin,
            "repeat_type" => $request->repeat_type,
            'color' => $request->color ?? null,
        ]);
        foreach ($request->intervenant_ids as $intervenant_id) {
            $deviceToken = User::find($intervenant_id)->remember_token;
            if ($deviceToken) {
                $this->sendNotificationV1($request, $intervention);
            }
        }
        $intervention->intervenants()->attach($request->intervenant_ids);

        // Now you can use $intervention
        return response()->json(['success' => true, 'message' => 'Intervention created successfully'], 200);
    }


    public function updateF($id, Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'date' => 'required|date',
                'intervenant_ids' => 'required|array|min:1',
                'intervenant_ids.*' => 'exists:users,id',
                'count' => 'nullable|integer',
                'datedebut' => 'nullable|date',
                'datefin' => 'nullable|date',
                'repeat_type' => 'sometimes|in:oneshot,daily,weekly,biweekly,monthly,bimonthly,yearly',
                'description' => 'nullable|string',
            ]
        );

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $intervention = Intervention::findOrFail($id);

        // Update the intervention
        $intervention->update([
            "date" => $request->date,
            "description" => $request->description,
            "datedebut" => $request->datedebut,
            "datefin" => $request->datefin,
            "repeat_type" => $request->repeat_type,
            'intervenant_id' => $request->intervenant_ids[0] // Set the primary intervenant as the first one
        ]);

        // Sync the intervenants
        $intervention->intervenants()->sync($request->intervenant_ids);

        // Send notifications to all intervenants
        foreach ($request->intervenant_ids as $intervenant_id) {
            $deviceToken = User::find($intervenant_id)->remember_token;
            if ($deviceToken) {
                $this->sendNotificationV1($intervention);
            }
        }

        return response()->json(['success' => true, 'message' => 'Intervention updated successfully'], 200);
    }
    public function cloture($id,$status)
    {
        try {
            // Validate status input
            if (!in_array($status, ['En attente', 'Démarré', 'Complété'])) {
                return response()->json([
                    'success' => false,
                    'message' => 'Invalid status provided'
                ], 400);
            }

            $intervention = Intervention::find($id);
            
            // Handle case where intervention is not found
            if (!$intervention) {
                return response()->json([
                    'success' => false,
                    'message' => 'Intervention not found'
                ], 404);
            }

            // Update the intervention status
            $updateResult = $intervention->update([
                "status" => $status,
            ]);

            // Handle update failure
            if (!$updateResult) {
                return response()->json([
                    'success' => false,
                    'message' => 'Failed to update intervention status'
                ], 500);
            }

            // Get intervenant IDs safely
            $intervenantIds = $intervention->intervenants->pluck('id')->toArray();

            // Send notifications to all intervenants
            $notificationResults = [];
            foreach ($intervenantIds as $intervenant_id) {
                $user = User::find($intervenant_id);
                if ($user && $user->remember_token) {
                    $notificationSent = $this->sendNotificationV1($intervention);
                    $notificationResults[] = $notificationSent;
                }
            }

            // Check if any notifications failed to send
            if (in_array(false, $notificationResults, true)) {
                return response()->json([
                    'success' => true,
                    'message' => 'Intervention updated but some notifications failed to send'
                ], 200);
            }

            return response()->json([
                'success' => true,
                'message' => 'Intervention updated successfully'
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while processing the request',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    public function deleteF($id)
    {
        Intervention::where('id', $id)->delete();
        return response()->json(['success' => true, 'message' => 'Intervention deleted successfully'], 200);
    }

    public function printF($id)
    {
        $intervention = Intervention::where('id', $id)->first();
        $photo = "assets/img/" . $intervention->entreprise->photo;
        $logo_client = "assets/img/" . $intervention->client->photo;

        // Assuming this is for generating a PDF file for intervention details
        $pdfContent = view('interventions.print', compact('intervention', 'photo', 'logo_client'))->render();

        return response()->json([
            'pdf_content' => base64_encode($pdfContent),
            'file_name' => $intervention->numero . ".pdf"
        ], 200);
    }
    public function uploadImage(Request $request, $id)
    {
        try {
            $intervention = Intervention::find($id);
            if (!$intervention) {
                return response()->json([
                    'message' => 'Intervention not found',
                    'id' => $id,
                ], 404);
            }

            // Debugging: Log all incoming files
            \Log::info('Request files: ' . json_encode($request->allFiles()));


            $image_name = $request->file('image')->getClientOriginalName();
            $path = $request->file('image')->move('assets/img/', $image_name);
            $image_url = url('assets/img/' . $image_name);
            $intervention->image = $image_url;
            $intervention->status = 'Complété';
            $intervention->save();

            return response()->json([
                'message' => 'Intervention updated successfully',
                'path' => $path,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'An unexpected error occurred',
                'error' => $e->getMessage(),
            ], 500);
        }
    }



    //notification pour le ajouter de intervention 
    public function sendNotificationV1($intervention)
    {

        $deviceToken = User::find($intervention->intervenant_id)->remember_token;

        $notificationData = [
            "message" => [
                "token" => $deviceToken,
                "notification" => [
                    "title" => "Nouvelle intervention créée",
                    "body" => "Intervention #" . $intervention->numero . " a été assignée.",
                ],
                "data" => [
                    "intervention_id" => strval($intervention->id),
                    "intervenant_id" => strval($intervention->intervenant_id),
                    "entreprise_id" => strval($intervention->entreprise_id),
                    "date" => strval($intervention->date),
                ]
            ]
        ];



        $client = new \GuzzleHttp\Client();

        $accessToken = $this->FirebaseService->getAccessToken();
        $response = $client->post('https://fcm.googleapis.com/v1/projects/sim-next/messages:send', [
            'headers' => [
                'Authorization' => 'Bearer ' . $accessToken,
                'Content-Type' => 'application/json',
            ],
            'json' => $notificationData // Directly pass the corrected structure
        ]);

        if ($response->getStatusCode() !== 200) {
            Log::error("Erreur lors de l'envoi de la notification : " . $response->getBody());
        }
    }
    // notification pour le update de l'image
    protected function sendNotificationToUsersWithRole($roleId, $intervention)
    {
        // Retrieve users with the specified role
        $users = User::where('role_id', $roleId)->get();

        foreach ($users as $user) {
            if ($user->remember_token) { // Check if the user has a device token
                // Prepare notification data
                $notificationData = [
                    'title' => 'Intervention Complétée',
                    'body' => "L'intervention #" . $intervention->numero . " a été mise à jour.",
                    'intervention_id' => strval($intervention->id),
                    'intervenant_id' => strval($intervention->intervenant_id),
                    'entreprise_id' => strval($intervention->entreprise_id),
                    'date' => strval($intervention->date),
                ];

                // Send the notification using your existing notification method
                $this->sendNotificationToUser($user->remember_token, $notificationData);
            }
        }
    }
    protected function sendNotificationToUser($deviceToken, $notificationData)
    {
        // Here, you can call your existing sendNotificationV1 method or implement sending logic
        $client = new \GuzzleHttp\Client();
        $accessToken = $this->FirebaseService->getAccessToken();

        $message = [
            'message' => [
                'token' => $deviceToken,
                'notification' => [
                    'title' => $notificationData['title'],
                    'body' => $notificationData['body'],
                ],
                'data' => [
                    'intervention_id' => $notificationData['intervention_id'],
                    'intervenant_id' => $notificationData['intervenant_id'],
                    'entreprise_id' => $notificationData['entreprise_id'],
                    'date' => $notificationData['date'],
                ],
            ],
        ];

        $response = $client->post('https://fcm.googleapis.com/v1/projects/sim-next/messages:send', [
            'headers' => [
                'Authorization' => 'Bearer ' . $accessToken,
                'Content-Type' => 'application/json',
            ],
            'json' => $message,
        ]);

        if ($response->getStatusCode() !== 200) {
            Log::error("Erreur lors de l'envoi de la notification : " . $response->getBody());
        }
    }
}
