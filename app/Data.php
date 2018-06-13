<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Data extends Model
{
    protected $fillable = ['profile_name', 'profile_description', 'profile_time_start', 'profile_time_finish', 'profile_sleep_start', 'profile_sleep_finish', 'profile_temperature', 'mod_user', 'mod_date', 'mod_hour'];
}
