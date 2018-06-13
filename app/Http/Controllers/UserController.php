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
        if (session('user') == null) return view('dashboard.main');
        if($username != null){
            $data['user'] = User::where('username', '=', $username)->first();
            if($data['user'] != null)
            return view('dashboard.user.show', $data);
        }
        return redirect('/')->with('error', "No se encontró el usuario");
    }
    public function create (Request $request) {
        if($request->input('password') == $request->input('password_confirm')){
            \App\User::create([
            'username'      => $request->input('username'),
            'name'          => $request->input('name'),
            'lastname'      => $request->input('lastname'),
            'password'      => \Hash::make($request->input('password')),
            ]);
        }
        return redirect('/');
    }
    public function edit ($username = null) {
        if (session('user') == null) return view('dashboard.main');
        if($username != null){
            $data['user'] = User::where('username', '=', $username)->first();
            if($data['user'] != null)
            return view('dashboard.user.edit', $data);
        }
        return redirect('/')->with('error', "No se encontró el usuario");
    }
    public function update (Request $request) {
        if (session('user') == null) return view('dashboard.main');
        $user = User::where('username', $request->input('username'))->first();
        if($user != null){
            $user->name = $request->input('name');
            $user->lastname = $request->input('lastname');
        } else {
            return redirect('/users')->with('error', "Usuario no encotrado");
        }
        $user->update();
        return view('dashboard.user.manage');
    }
    public function delete (Request $request) {
        if (session('user') == null) return view('dashboard.main');
        $user = User::where('username', $request->input('username'))->first();
        $user->delete();
        return view('dashboard.user.manage');
    }
    public function manage () {
        if (session('user') == null) return view('dashboard.main');
        return view('dashboard.user.manage');
    }
}
