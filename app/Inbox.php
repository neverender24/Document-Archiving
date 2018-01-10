<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inbox extends Model
{
    protected $fillable = ['sender_id', 'document_id', 'receiver_id', 'received_at'];

    public function documents()
    {
        return $this->hasMany('App\Document', 'document_id');
    }

}
