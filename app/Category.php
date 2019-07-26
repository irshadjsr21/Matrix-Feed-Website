<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public function slug()
    {
        return urlencode(strtolower($this->name));
    }

    public function posts()
    {
        return $this->hasMany('App\Post');
    }
}
