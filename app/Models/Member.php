<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;


class Member extends Authenticatable
{
    use HasFactory;
    use Notifiable;

    public $timestamps = false;
    protected $fillable = [
        'userid', 'password',
    ];

    protected $hidden = [
        'password',
    ];


}
