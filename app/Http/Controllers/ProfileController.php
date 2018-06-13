<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    
    public function new () {
        return view('dashboard.profile.new');
    }
    public function manage () {
        return view('dashboard.profile.manage');
    }
    public function create (Request $request) {
       
        $profile = \App\Profile::create([
            'user_id'       => session('user')->id,
            'name'          => $request->input('name'),
            'time_start'    => $request->input('time_start'),
            'time_finish'   => $request->input('time_finish'),
            'sleep_start'   => $request->input('sleep_start'),
            'sleep_finish'  => $request->input('sleep_finish'),
            'description'   => $request->input('description'),
            'temperature'   => $request->input('temperature'),
        ]);
        return redirect('/profiles')->with('success', "Se creó el perfil de ". $request->input('name'));
    }
    public function show ($profile_id = null) {
        if (session('user') == null) return view('dashboard.main');
        if($profile_id != null){
            $data['profile'] =  \App\Profile::find($profile_id);
            if($data['profile'] != null)
            return view('dashboard.profile.show', $data);
        }
        return redirect('/')->with('error', "No se encontró el usuario");
    }
    public function edit ($profile_id = null) {
        if (session('user') == null) return view('dashboard.main');
        if($profile_id != null){
            $data['profile'] = \App\Profile::find($profile_id);
            if($data['profile'] != null)
            return view('dashboard.profile.edit', $data);
        }
        return redirect('/')->with('error', "No se encontró el usuario");
    }
    public function update (Request $request) {
        if (session('user') == null) return view('dashboard.main');
        $profile = \App\Profile::find($request->input('id'));
        if($profile != null){
            $profile->name          = $request->input('name');
            $profile->time_start    = $request->input('time_start');
            $profile->time_finish   = $request->input('time_finish');
            $profile->sleep_start   = $request->input('sleep_start');
            $profile->sleep_finish  = $request->input('sleep_finish');
            $profile->description   = $request->input('description');
            $profile->temperature   = $request->input('temperature');
        } else {
            return redirect('/profiles')->with('error', "Perfil no encotrado");
        }
        $profile->update();
        return view('dashboard.profile.manage');
    }
    public function delete (Request $request) {
        if (session('user') == null) return view('dashboard.main');
        $profile = \App\Profile::find($request->input('id'));
        $profile->deleted = true;
        $profile->update();
        return "Perfil eliminado";
    }
}
