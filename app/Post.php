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
}
