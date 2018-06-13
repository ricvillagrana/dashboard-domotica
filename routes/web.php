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

Route::post('/user/create', 'UserController@create');
Route::get('/user/{username}', 'UserController@show');
Route::get('/user/edit/{username}', 'UserController@edit');
Route::post('/user/update', 'UserController@update');
Route::post('/user/delete', 'UserController@delete');
Route::get('/users', 'UserController@manage');

Route::post('/user/profiles/update', function (Request $request) {
    //dd($request);
    if($request->input('active') == "true"){
        DB::insert('insert into user_profiles (user_id, profile_id) values (?, ?)', [$request->input('user_id'), $request->input('profile_id')]);
    }else{
        DB::insert('delete from user_profiles where user_id = ? and profile_id =  ?', [$request->input('user_id'), $request->input('profile_id')]);
    }
});

Route::get('/profile/new', 'ProfileController@new');
Route::post('/profile/create', 'ProfileController@create');
Route::get('/profiles', 'ProfileController@manage');
Route::get('/profile/{profile_id}', 'ProfileController@show');
Route::get('/profile/edit/{profile_id}', 'ProfileController@edit');
Route::post('/profile/update', 'ProfileController@update');
Route::post('/profile/delete', 'ProfileController@delete');
Route::post('/profile/active', function (Request $request) {
    if($request->input('profile_id') != null){
        \App\ProfileLog::create([
        'profile_id'    => $request->input('profile_id'),
        'user_id'       => session('user')->id,
        ]);
        return \App\Profile::find($request->input('profile_id'))->name;
    }
    return "error";
});

Route::get('/actions/{slug}', 'ActionController@view');

Route::get('/data', function () {
    $profile = \App\Profile::find(\App\ProfileLog::all()->sortByDesc('created_at')->first()->profile_id);
    $user = \App\User::find(\App\ProfileLog::all()->sortByDesc('created_at')->first()->user_id);
    $full_date = \App\ProfileLog::all()->sortByDesc('created_at')->first()->created_at;
    $full_date_exploded = explode(" ", $full_date);
    $date = \App\Misc::fancy_date($full_date_exploded[0]);
    $time = \App\Misc::fancy_time($full_date_exploded[1]);
    $data = [
    'profile_name'          => $profile->name,
    'profile_description'   => $profile->description,
    'profile_time_start'    => $profile->time_start,
    'profile_time_finish'   => $profile->time_finish,
    'profile_sleep_start'   => $profile->sleep_start,
    'profile_sleep_finish'  => $profile->sleep_finish,
    'profile_temperature'  => $profile->temperature,
    'mod_user'              => $user->username,
    'mod_date'              => $full_date_exploded[0],
    'mod_hour'              => $full_date_exploded[1],
    ];
    \App\Data::create($data);
    return json_encode([
    'profile_name'          => $profile->name,
    'profile_description'   => $profile->description,
    'profile_time_start'    => \App\Misc::fancy_time($profile->time_start),
    'profile_time_finish'   => \App\Misc::fancy_time($profile->time_finish),
    'profile_sleep_start'   => \App\Misc::fancy_time($profile->sleep_start),
    'profile_sleep_finish'  => \App\Misc::fancy_time($profile->sleep_finish),
    'profile_temperature'  => $profile->temperature,
    'mod_user'              => $user->username,
    'mod_date'              => $date,
    'mod_hour'              => $time,
    ]);
});

//Auth::routes();



Route::get('/leds', function () {
    return view('leds.manage');
});


Route::get('/led/blue', function () {
    $led_s = DB::select('select led_1 from leds')[0]->led_1;
    DB::update('update public.leds set led_1 = ?',[!$led_s]);
    return "".DB::select('select led_1 from leds')[0]->led_1;
});
Route::get('/led/blue/get', function () {
    return "".DB::select('select led_1 from leds')[0]->led_1;
});
Route::get('/led/red', function () {
    $led_s = DB::select('select led_2 from leds')[0]->led_2;
    DB::update('update public.leds set led_2 = ?',[!$led_s]);
    return "".DB::select('select led_2 from leds')[0]->led_2;
});
Route::get('/led/red/get', function () {
    return "".DB::select('select led_2 from leds')[0]->led_2;
});