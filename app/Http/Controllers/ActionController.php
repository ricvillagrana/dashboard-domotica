<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ActionController extends Controller
{
    public function view ($slug = null) {
        if(session('user') == null) return redirect('/');
        if($slug == null) return redirect('/')->with('error', "Slug no existente.");

        $data['action'] = \App\Actions::where('slug', $slug)->first();

        if($slug == "temperature"){
            $data['logs'] = \App\TemperatureLog::orderBy('created_at')->get();
        }

        return view('actions.view', $data);
    }
}
