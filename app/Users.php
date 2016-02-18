<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
/*use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Auth\Passwords\CanResetPassword;*/

class Users extends Model
{
    //

    protected $table = 'users';

    public $timestamps = false;
}
