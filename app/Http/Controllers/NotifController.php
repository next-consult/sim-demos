<?php

namespace App\Http\Controllers;

use App\Models\Conge;
use Illuminate\Http\Request;
use App\Models\Notif;
use App\Models\User;

class NotifController extends Controller
{
    public function read_notifs()
    {
        $user = User::where('type', 'admin')->first();
        $now = date('Y-m-d H:i:s');
        Notif::where('user_id', auth()->user()->id)->update(["read_at" => $now]);
        return response()->json(200);

    }
    // Method to fetch notifications related to pending leave requests
    public function pending_conge_notifications()
    {
        $pendingConge = Conge::where('status', 'en_attente')->get();

        // Fetch all admins
        $adminUsers = User::whereIn('role_id', [15, 12, 1, 9, 14])->get();

        foreach ($pendingConge as $conge) {
            $congeuser = User::find($conge->user_id);

            foreach ($adminUsers as $adminUser) {
                // Check if a notification already exists for this admin and this leave request
                $existingNotif = Notif::where('user_id', $adminUser->id)
                    ->where('type_notif', 'conge_en_attente')
                    ->where('description', "Une nouvelle demande de congé attend votre approbation pour l'utilisateur " . $congeuser->name . ".")
                    ->first();

                if (!$existingNotif) {
                    $notif = new Notif();
                    $notif->user_id = $adminUser->id; // Set to the current admin's ID
                    $notif->description = "Une nouvelle demande de congé attend votre approbation pour l'utilisateur " . $congeuser->name . ".";
                    $notif->type_notif = 'conge_en_attente';
                    $notif->save();
                }
            }
        }

        return response()->json(['success' => true], 200);
    }





}
