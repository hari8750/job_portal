<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    use Notifiable;

    // Fillable fields jo tum register karna chahte ho
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'status',
    ];

    // Hidden fields
    protected $hidden = [
        'password',
        'remember_token',
    ];
}
