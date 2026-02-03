<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Login extends Authenticatable
{
    protected $table = 'logins';

    protected $fillable = [
        'email',
        'password',
        'last_login_at',
    ];

    protected $hidden = [
        'password',
    ];
}
