<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PostRequest extends Model
{
    const STATUS_PROCESS = 'process';
    const STATUS_ACCEPTED = 'accepted';
    const STATUS_REJECTED = 'rejected';

    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
