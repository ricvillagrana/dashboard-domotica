<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable
{
    use Notifiable;
    
    /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
    protected $fillable = [
    'username', 'name', 'lastname', 'password', 'superuser',
    ];
    
    public static function auth (User $user) {
        $credentials = ['username' => $user->username, 'password' => $user->password];
        if (Auth::attempt($credentials)) {
            $userLogged = \App\User::where(['username' => $user->username])->get();
            session(['user' => $userLogged[0]]);
                return true;
        }
        
        return false;
    }
    
    public static function logout () {
        if(session(['user' => null])){
            return true;
        }
        return false;
    }
    
    /**
    * The attributes that should be hidden for arrays.
    *
    * @var array
    */
    protected $hidden = [
    'password', 'remember_token',
    ];
}
