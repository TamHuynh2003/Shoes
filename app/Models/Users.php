<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Users extends Authenticatable
{
    use HasFactory;

    protected $table = 'users';

    protected $fillable = [
        'fullname',
        'email',
        'address',
        'phone_number',
        'password',
        'google_id',
    ];

    public function roles()
    {
        return $this->belongsTo(Roles::class);
    }

    public function genders()
    {
        return $this->belongsTo(Genders::class);
    }

    public function status()
    {
        return $this->belongsTo(UserStates::class);
    }
}
