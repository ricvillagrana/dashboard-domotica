<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProfileLog extends Model
{
    protected $fillable = ['user_id', 'profile_id'];
}
