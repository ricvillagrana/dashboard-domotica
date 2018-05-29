<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    public function auth (Request $request) {
        $user = new User;
        $user->username = $request->input('username');
        $user->password = ($request->input('password'));
        $result = User::auth($user);
        return redirect('/')->with('error', "Credenciales incorrectas.");
    }

    public function logout () {
        User::logout();
        return redirect('/')->with('error', "Cerraste sesión.");
    }
    public function show ($username = null) {
        if($username != null){
            $data['user'] = User::where('username', '=', $username)->first();
            if($data['user'] != null)
                return view('dashboard.user.show', $data);
        }
        return redirect('/')->with('error', "No se encontró el usuario");
    }
}
