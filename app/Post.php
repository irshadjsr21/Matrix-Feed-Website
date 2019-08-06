<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public function slug()
    {
        return urlencode(strtolower($this->title));
    }

    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    public function likes()
    {
        return $this->hasMany('App\Like');
    }

    public function comments()
    {
        return $this->hasMany('App\Comment');
    }

    public function authorObj()
    {
        return $this->belongsTo('App\User', 'author_id');
    }
}
