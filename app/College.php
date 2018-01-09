<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class College extends Model
{
    protected $fillable = ['description', 'prefix'];

    public function departments()
    {
        return $this->hasMany('App\Departments');
    }
}
