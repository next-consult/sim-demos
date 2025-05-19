<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class FlutterLoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */
    public function login(Request $req)
    {
        // validate inputs
        $rules = [
            'password' => 'required',
            'email' => 'required',
        ];
        $req->validate($rules);
        // find user email in users table

        $user = User::where('email', $req->email)->first();
        // if user email found and password is correct
        if ($user) {
			if (Hash::check($req->password, $user->password)) {
			
					$token = $user->createToken('Personal Access Token')->plainTextToken;
            $response = $user;
            return response()->json($user, 200);
				
			}else{
			        $response ='password incorrect';}
        }else{
        $response =  'aucun utilisateur inscrit avec cette email!';}
        return response()->json($response, 400);
    }
    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
