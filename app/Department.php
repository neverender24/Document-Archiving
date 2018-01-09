<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $fillable = ['description', 'prefix', 'college_id'];

    public function college()
    {
    	return $this->belongsTo('App\College');
    }
}
