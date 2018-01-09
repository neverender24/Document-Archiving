<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['description', 'prefix'];

    public function user()
    {
    	return $this->belongsTo('App\User');
    }

    public function documents()
    {
        return $this->hasManyThrough('App\Document', 'App\Drawer');
    }

    public function drawers()
    {
    	return $this->hasMany('App\Drawer');
    }
}
