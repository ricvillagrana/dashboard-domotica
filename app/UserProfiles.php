<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserProfiles extends Model
{
    protected $fillable = ['user_id', 'profile_id'];

    public static function check ($user_id, $profile_id) {
        $profile_user = \App\UserProfiles::where('user_id', $user_id)->where('profile_id', $profile_id)->first();
        if($profile_user != null)
            return true;
        return false;
    }
}
