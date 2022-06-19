<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Viewer extends Authenticatable
{
    use HasFactory,Notifiable;
    protected $guard = 'cus';

    public $timestamps = false;
    protected $table = 'viewers';
    protected $fillable = [
        'name',
        'email',
        'password',
        'status',
        
    ];
    protected $hidden = [
        'password', 'remember_token',
    ];
}
