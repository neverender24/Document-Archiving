<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    protected $fillable = ['subject','content','user_id','drawer_id','is_private'];

    public function drawer()
    {
    	return $this->belongsTo('App\Drawer');
    }

    public function user()
    {
    	return $this->belongsTo('App\User');
    }

    public function attachments()
    {
        return $this->hasMany('App\Attachment');
    }

    public function inbox()
    {
        return $this->belongsTo('App\Inbox', 'document_id');
    }

}
