<?php

namespace App\Http\Controllers;

use App\Models\Dateconge;
use App\Models\Conge;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use App\Models\Notif;

use Validator;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('users.index')->with(compact('users'));
    }
    public function add()
    {
        $roles = Role::where('nom', '!=', 'Administrateur')->get();
        return view('users.add')->with(compact('roles'));
    }
    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required',
                'roles' => 'required',
                'telephone' => 'required|unique:users,telephone',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|min:8|confirmed',
            ],
        );

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()]);
        }

        $user = User::create([
            "name" => $request->name,
            "role_id" => $request->roles,
            "telephone" => $request->telephone,
            "type" => "user",
            "email" => $request->email,
            "password" => Hash::make($request->password),
        ]);


        return response()->json(["success_id" => $user->id]);
    }
    public function update($id)
    {
        $user = User::find($id);
        if ($user->type == "admin") {
            $roles = Role::where('nom', 'Administrateur')->get();
        } else {
            $roles = Role::where('nom', '!=', 'Administrateur')->get();
        }
        return view('users.update')
            ->with(compact('roles'))
            ->with(compact('user'));
    }

    public function store_update($id, Request $request)
    {
        // Validate the request data
        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required',
                'roles' => 'required',
                'telephone' => 'required',
                'email' => 'required|email|unique:users,email,' . $id,
                'password' => 'nullable|min:8|confirmed',
                'solde_conge' => 'required|min:0',
                'solde_maladie' => 'required|min:0',
            ]
        );
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()]);
        }

        // Prepare the update data
        $updateData = [
            "name" => $request->name,
            "telephone" => $request->telephone,
            "email" => $request->email,
            "role_id" => $request->roles,
            "solde_conge" => $request->solde_conge,
            "solde_maladie" => $request->solde_maladie,
        ];

        // Conditionally add password if it is present
        if ($request->filled('password')) {
            $updateData["password"] = Hash::make($request->password);
        }

        // Perform the update
        User::where('id', $id)->update($updateData);

        return response()->json(["success_id" => $id]);
    }



    public function delete($id)
    {

        User::where('id', $id)->delete();
        Notif::where('user_id', $id)->delete();
        $conge = Conge::where('user_id', $id)->first();
        Dateconge::where('user_id', $id)->delete();
        $conge->delete();
        return response()->json(200);
    }
}
