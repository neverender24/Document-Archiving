<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Drawer extends Model
{
    protected $fillable = ['description', 'prefix', 'subject', 'category_id', 'user_id', 'department_id', 'office_id'];

    public function category()
    {
    	return $this->belongsTo('App\Category');
    }

    public function documents()
    {
    	return $this->hasMany('App\Document');
    }
}
