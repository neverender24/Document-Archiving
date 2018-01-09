<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attachment extends Model
{
    protected $fillable = ['name', 'document_id'];

    public function document()
    {
    	return $this->belongsTo('App\Document');
    }
}
