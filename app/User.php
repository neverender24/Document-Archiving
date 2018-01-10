<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Zizaco\Entrust\Traits\EntrustUserTrait;

class User extends Authenticatable
{
    use Notifiable,EntrustUserTrait;

    protected $fillable = [
        'name', 'email', 'password', 'role', 'office_id', 'department_id', 'position'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function documents()
    {
        return $this->hasMany('App\Document');
    }

    public function roles()
    {
        return $this->belongsToMany('App\Role');
    }
}
