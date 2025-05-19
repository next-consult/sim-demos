<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class IntervenantController extends Controller
{
    public function getColor($id)
    {
        $user = User::find($id);

        if ($user && $user->couleur) {
            return response()->json(['color' => $user->couleur]);
        } else {
            return response()->json(['color' => '#ff0000']); // Fallback color
        }
    }


}
