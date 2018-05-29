<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
use Illuminate\Http\Request;

Route::get('/', function () {
    if(session('user') != null)
        return view('dashboard.main');
    return view('login');
});
Route::get('/register', function () {
    if(session('user') != null)
        return view('dashboard');
    return view('register');
});
Route::post('/auth', 'UserController@auth');
Route::get('/logout', 'UserController@logout');
Route::post('/user/create', function(Request $request){
    if($request->input('password') == $request->input('password_confirm')){
        \App\User::create([
            'username'      => $request->input('username'),
            'name'          => $request->input('name'),
            'lastname'      => $request->input('lastname'),
            'password'      => Hash::make($request->input('password')),
        ]);
    }
    return redirect('/');
});
Route::get('/user/{username}', 'UserController@show');

Route::get('/profile/new', 'ProfileController@new');


//Auth::routes();

