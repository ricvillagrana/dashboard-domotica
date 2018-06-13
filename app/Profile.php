<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = ['user_id', 'name', 'time_start', 'time_finish', 'sleep_start', 'sleep_finish', 'temperature', 'description'];

    public static function ofUser ($user_id) {
        return \DB::table('users')
            ->join('user_profiles', 'users.id', '=', 'user_profiles.user_id')
            ->join('profiles', 'profiles.id', '=', 'user_profiles.profile_id')
            ->select('profiles.*')
            ->where('users.id', $user_id);
    }
}
