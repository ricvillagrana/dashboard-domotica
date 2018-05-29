<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    
    public function new () {
        return view('dashboard.profile.new');
    }
}
