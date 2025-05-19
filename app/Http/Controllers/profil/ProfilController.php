<?php

namespace App\Http\Controllers\profil;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class ProfilController extends Controller
{
    public function update()
    {
        return view('profil.update');
    }
    public function store_update(Request $request)
    {
        $user = User::find(auth()->user()->id);

        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required',
                'telephone' => 'required|unique:users,telephone,' . $user->id,
                'email' => 'required|email|unique:users,email,' . $user->id,
                'password' => 'nullable|min:8|confirmed',
                'photo' => "nullable|image|max:5000",
                'old_password' => 'required'
            ],
        );
        $test = true;
        if (Hash::check($request->old_password, $user->password) == false) {
            $test = false;
        }

        if ($validator->fails() || $test == false) {
            if ($test == false) {
                $validator->getMessageBag()->add('old_password', 'Vérifier votre mot de passe');
            }
            return response()->json(['error' => $validator->errors()]);
        }

        if ($request->hasFile('photo')) {
            if ($user->photo != "user.png") {
                @unlink('assets/img/' . $user->photo);
            }
            $file = $request->file('photo');
            $extension = $file->getClientOriginalExtension();
            $photo = time() . rand() . '.' . $extension;
            $file->move('assets/img', $photo);
            $user->photo = $photo;
        }
        $user->name = $request->name;
        $user->telephone = $request->telephone;
        $user->email = $request->email;
        if ($request->password != null) {
            $user->password = Hash::make($request->password);
        }
        $user->update();
        return response()->json(200);
    }
}
