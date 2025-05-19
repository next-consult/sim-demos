<?php

namespace App\Http\Controllers;

use App\Mail\CongeRequestCreated;
use App\Mail\CongeStatusChanged;
use App\Models\Notif;
use DatePeriod;
use DB;
use Illuminate\Http\Request;
use App\Models\Conge;
use App\Models\User;
use App\Models\Dateconge;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Log;
use Mail;

class CongeController extends Controller
{
    // Helper function to add at the top of the class
    private function countWorkingDays($startDate, $endDate)
    {
        $workingDays = 0;
        $start = Carbon::parse($startDate);
        $end = Carbon::parse($endDate);

        while ($start->lte($end)) {
            // Check if it's not Saturday (6) and not Sunday (0)
            if ($start->dayOfWeek !== 6 && $start->dayOfWeek !== 0) {
                $workingDays++;
            } else {
            }
            $start->addDay();
        }

        return $workingDays;
    }

    //flutter functions
    public function getConges()
    {
        $conges = Conge::with("user")->orderBy('created_at', 'desc')->get();
        return response()->json($conges);
    }
    /**
     * Handles the creation of a new leave request.
     *
     * This function validates the request fields, checks the remaining leave balance,
     * and ensures there are no existing leave requests in the selected period.
     * If all checks pass, it creates the leave request and saves each leave date.
     *
     * @param Request $request The incoming request object
     * @throws \Illuminate\Validation\ValidationException if the request fields are invalid
     * @throws \Exception if the remaining leave balance is insufficient or a leave request already exists
     * @return \Illuminate\Http\JsonResponse a JSON response indicating success or failure
     */
    public function storeConges(Request $request)
    {
        // Validate the request fields
        $validator = Validator::make($request->all(), [
            'type' => 'required',
            'dure' => 'required',
            'date_jour' => 'required_if:dure,one_journe,heures|date',
            'date_debut' => 'required_if:dure,many_journes|date|before:date_fin',
            'date_fin' => 'required_if:dure,many_journes|date|after:date_debut',
            'nb_heures' => 'required_if:dure,heures',
        ]);

        // Return validation errors if any
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Initialize variables
        $dates_intervales = [];
        $nb_jours = 0;
        $nb_hours = 0;
        $date_debut = $request->date_jour;

        // Calculate number of days and hours based on the 'dure' field
        switch ($request->dure) {
            case 'one_journe':
                $nb_jours = 1;
                $nb_hours = 8;
                $dates_intervales[] = $request->date_jour;
                break;

            case 'many_journes':
                $date1 = Carbon::parse($request->date_debut);
                $date2 = Carbon::parse($request->date_fin);
                $nb_jours = $this->countWorkingDays($date1, $date2);
                $nb_hours = $nb_jours * 8;
                $date_debut = $request->date_debut;
                $dates_intervales = iterator_to_array(new DatePeriod($date1, new \DateInterval('P1D'), $date2->addDay()));
                break;

            case 'heures':
                $nb_hours = $request->nb_heures;
                $nb_jours = $nb_hours / 8;
                $dates_intervales[] = $request->date_jour;
                break;
        }

        // Retrieve the user and their leave balance
        $user = User::find($request->user_id);
        $solde_restant = $user->solde_conge;

        // Check if the remaining leave balance is sufficient
        if ($nb_jours > $solde_restant) {
            return response()->json(['error' => "Le solde restant est insuffisant: $solde_restant jours (" . ($solde_restant * 8) . " heures)"], 400);
        }

        // Check if there's already a leave request in the selected period
        $congeExists = Conge::where('user_id', $request->user_id)
            ->whereYear('created_at', Carbon::now()->year)
            ->whereHas('dates', function ($query) use ($dates_intervales) {
                $query->whereIn('date', $dates_intervales);
            })
            ->exists();

        if ($congeExists) {
            return response()->json(['error' => "Vous avez déjà un congé prévu pour cette période."], 400);
        }

        // Create the leave request
        $conge = Conge::create([
            'user_id' => $request->user_id,
            'type' => $request->type,
            'dure' => $request->dure,
            'status' => 'en_attente',
            'date_jour' => $request->date_jour,
            'date_debut' => $date_debut,
            'date_fin' => $request->date_fin,
            'nb_heures' => round($nb_hours, 3),
            'nb_jours' => round($nb_jours, 3),
            'raison' => $request->raison
        ]);

        // Save each leave date
        Dateconge::insert(array_map(function ($date) use ($conge) {
            return [
                'date' => $date,
                'conge_id' => $conge->id,
            ];
        }, $dates_intervales));

        // Return success response
        return response()->json(['success' => true], 200);
    }

    /**
     * Handles the index view for conges.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $conges = Conge::where('user_id', auth()->user()->id)->orderby('created_at', 'desc')->get();
        return view('conges.index')
            ->with(compact('conges'));
    }
    /**
     * Handles the admin dashboard view for conges.
     *
     * @return \Illuminate\View\View
     */
    public function admin()
    {
        $conges = Conge::orderby('created_at', 'desc')->get();
        return view('conges.admin')
            ->with(compact('conges'));
    }

    /**
     * Display the form to create a new conge.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('conges.add');
    }
    /**
     * Store a newly created conge in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate the request fields
        $validator = Validator::make(
            $request->all(),
            [
                'type' => 'required',
                'dure' => 'required',
                'raison' => 'nullable',
                'date_jour' => 'required_if:dure,one_journe,heures|date',
                'date_debut' => 'required_if:dure,many_journes|date|before:date_fin',
                'date_fin' => 'required_if:dure,many_journes|date|after:date_debut',
                'nb_heures' => 'required_if:dure,heures',
            ]
        );

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $user = User::find(auth()->user()->id);
        $year_value = Carbon::parse($request->date_jour)->year;

        if ($request->type === 'autorisation') {
            $hoursRequested = $request->nb_heures_autorisation;

            // Calculate total "Autorisation" hours used this month
            $currentMonthHours = Conge::where('user_id', $user->id)
                ->where('type', 'autorisation')
                ->where('status', 'accepte')
                ->whereMonth('created_at', Carbon::now()->month)
                ->sum('nb_heures');

            if ($currentMonthHours + $hoursRequested > 2) {
                return response()->json(['errors' => ['nb_heures_autorisation' => ['Vous ne pouvez pas dépasser 2 heures par mois pour les autorisations.']]], 422);
            }

            // Save the autorisation leave request
            Conge::create([
                'user_id' => $user->id,
                'type' => 'autorisation',
                'nb_heures' => $hoursRequested,
                'status' => 'en_attente',
                'dure' => 'one_journe',
                'date_jour' => $request->date_jour,
                'date_debut' => $request->date_jour,
            ]);
            return response()->json(['success' => true], 200);
        }

        // Initialize variables
        $dates_intervales = [];
        $nb_jours = 0;
        $nb_hours = 0;

        switch ($request->dure) {
            case 'one_journe':
                $nb_jours = 1;
                $nb_hours = 8;
                $dates_intervales = [$request->date_jour];
                break;
            case 'many_journes':
                $date1 = Carbon::parse($request->date_debut);
                $date2 = Carbon::parse($request->date_fin);
                $nb_jours = $this->countWorkingDays($date1, $date2);
                $nb_hours = $nb_jours * 8;
                $dates_intervales = iterator_to_array(new DatePeriod($date1, new \DateInterval('P1D'), $date2->addDay()));
                break;
            case 'heures':
                $nb_hours = $request->nb_heures;
                $nb_jours = $nb_hours / 8;
                $dates_intervales = [$request->date_jour];
                break;
            default:
                return response()->json(['errors' => ['type' => ['Le type de congé est obligatoire']]], 422);
        }

        // Check for overlapping leaves
        $conges = Conge::where('user_id', auth()->user()->id)
            ->whereYear('created_at', $year_value)
            ->whereHas('dates', function ($query) use ($dates_intervales) {
                $query->whereIn('date', $dates_intervales);
            })
            ->exists();

        if ($conges) {
            return response()->json(['errors' => ['conge' => ['Vous avez déjà un congé planifié pendant cette période.']]], 400);
        }

        try {
            DB::beginTransaction();
            $validationLevel = in_array(intval(auth()->user()->role_id), [3, 7]) ? 'niveau2' : 'niveau1';

            $conge = Conge::create([
                "user_id" => auth()->user()->id,
                "type" => $request->type,
                "dure" => $request->dure,
                "status" => "en_attente",
                "validation_level" => $validationLevel,
                "date_jour" => $request->date_jour,
                "date_debut" => $dates_intervales[0],
                "date_fin" => end($dates_intervales),
                "nb_heures" => round($nb_hours, 3),
                "nb_jours" => round($nb_jours, 3),
            ]);

            Dateconge::insert(
                array_map(function ($date) use ($conge) {
                    return [
                        "date" => $date,
                        "conge_id" => $conge->id,
                    ];
                }, $dates_intervales)
            );

            $firstValidator = User::find(20);
            if ($firstValidator) {
                Notif::create([
                    'user_id' => 20,
                    'description' => "Nouvelle demande de congé de " . auth()->user()->name . " à valider",
                    'type_notif' => 'conge_niveau1',
                    'conge_id' => $conge->id
                ]);
            }
            $email = null;
            switch ($user->role_id) {
                case 13:
                    $email = 'n.timoumi@next.tn';
                    break;
                case 3:
                    $email = 's.slimani@next.tn';
                    break;
                case 7:
                    $email = 'n.timoumi@next.tn';
                    break;
            }

            if ($email) {
                Mail::to($email)->cc(['n.timoumi@next.tn', 's.slimani@next.tn', 'k.euchi@next.tn'])->send(new CongeRequestCreated($user, $conge));
            }
            DB::commit();
            return response()->json(['success' => true], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Handles the change of status for a conge.
     *
     * @param Request $request The incoming request object containing the conge id and new status
     * @return \Illuminate\Http\JsonResponse a JSON response indicating success
     */
    public function change_status(Request $request)
    {
        $conge = Conge::find($request->id);

        if (!$conge) {
            return response()->json(['error' => 'Conge not found'], 404);
        }

        $user = User::find($conge->user_id);

        // Start transaction
        DB::beginTransaction();

        try {
            // Handle status change
            switch ($request->status) {
                case 'accepte':
                    if ($conge->type === 'maladie') {
                        $solde_maladie = $user->solde_maladie;
                        $solde_conge = $user->solde_conge;
                        $nb_jours = $conge->nb_jours;

                        if ($solde_maladie >= $nb_jours) {
                            // If solde_maladie is sufficient, use it entirely
                            $user->solde_maladie -= $nb_jours;
                        } else {
                            // If solde_maladie is insufficient, use remaining balance from solde_conge
                            $remaining_days = $nb_jours - $solde_maladie;
                            $user->solde_maladie = 0;
                            $user->solde_conge -= $remaining_days;
                        }
                        $user->save();
                    } else {
                        $solde_restant = $user->solde_conge;

                        if ($conge->nb_jours > $solde_restant) {
                            // Allow leave even if balance goes negative
                            $user->solde_conge -= $conge->nb_jours;
                            $user->save();
                        } else {
                            // Deduct leave normally if balance is sufficient
                            $user->solde_conge -= $conge->nb_jours;
                            $user->save();
                        }
                    }
                    break;

                case 'valide':
                    // Change validation level to niveau2 when status is set to valide
                    $conge->validation_level = 'niveau2';
                    $conge->save();
                    break;

                case 'autorisation':
                    // Handle 'autorisation' logic if needed
                    break;

                case 'accepte_force':
                    // Force accept even if solde_conge is insufficient
                    $user->solde_conge -= $conge->nb_jours;
                    $user->save();
                    $request->status = 'accepte';
                    break;

                case 'refuse':
                case 'annuler':
                    // Handle refused or canceled requests if needed
                    break;

                default:
                    return response()->json(['error' => 'Statut invalide'], 400);
            }

            // Update the leave request status
            $conge->update([
                "status" => $request->status,
            ]);

            // Clear notifications for this leave request
            Notif::where('conge_id', $conge->id)
                ->where('type_notif', 'conge_en_attente')
                ->delete();


            if ($request->status === 'accepte' || $request->status === 'refuse') {
                try {
                    Mail::to($user->email)->cc(['n.timoumi@next.tn', 'k.euchi@next.tn'])->send(new CongeStatusChanged($user, $conge, $request->status));
                } catch (\Exception $e) {
                    Log::error("Error sending email notification to user " . $user->id . " for leave request " . $conge->id . ": " . $e->getMessage());
                }
            }

            // Commit transaction
            DB::commit();

            return response()->json(['success' => true], 200);
        } catch (\Exception $e) {
            // Rollback transaction if something goes wrong
            DB::rollBack();
            Log::error("Error while updating leave request " . $conge->id . ": " . $e->getMessage());
            return response()->json(['error' => 'Une erreur est survenue lors du traitement de la demande.'], 500);
        }
    }

    /**
     * Deletes a conge by its ID.
     *
     * @param int $id The ID of the conge to delete
     * @return \Illuminate\Http\JsonResponse A JSON response indicating success
     */
    public function delete($id)
    {
        Conge::where('id', $id)->delete();
        return response()->json(200);
    }

    // Méthode pour la validation/refus par le premier validateur
    public function validateFirstLevel(Request $request, $id)
    {
        if (auth()->id() != 20) {
            return response()->json(['error' => 'Non autorisé'], 403);
        }

        $conge = Conge::findOrFail($id);

        if ($request->action === 'valider') {
            // Mettre directement le statut à 'valide'
            $conge->update([
                'status' => 'valide',
                'validation_level' => 'niveau2'
            ]);

            // Notifier uniquement le second validateur (ID=27)
            Notif::create([
                'user_id' => 27,
                'description' => "Une demande de congé a été validée par le premier niveau",
                'type_notif' => 'conge_info',
                'conge_id' => $conge->id
            ]);
        } else {
            // Si refusé
            $conge->update([
                'status' => 'refuse',
                'validation_level' => 'refuse'
            ]);

            // Notifier l'employé uniquement en cas de refus
            Notif::create([
                'user_id' => $conge->user_id,
                'description' => "Votre demande de congé a été refusée",
                'type_notif' => 'conge_refuse',
                'conge_id' => $conge->id
            ]);
        }

        return response()->json(['success' => true]);
    }

    // Méthode pour obtenir les congés à valider pour le premier validateur
    public function getFirstLevelConges()
    {
        if (auth()->id() != 20) {
            return response()->json(['error' => 'Non autorisé'], 403);
        }

        $conges = Conge::where('validation_level', 'niveau1')
            ->where('status', 'en_attente')
            ->with('user')
            ->get();

        return response()->json($conges);
    }

    // Méthode pour obtenir les congés à valider pour le second validateur
    public function getSecondLevelConges()
    {
        if (auth()->id() != 27) {
            return response()->json(['error' => 'Non autorisé'], 403);
        }

        $conges = Conge::where('validation_level', 'niveau2')
            ->where('status', 'valide')
            ->with('user')
            ->get();

        return response()->json($conges);
    }
}
