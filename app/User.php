<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'firstName', 'lastName', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'type', 'facebook_id', 'social_email',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    const ADMIN_TYPE = 'admin';
    const AUTHOR_TYPE = 'author';
    const DEFAULT_TYPE = 'default';

    const AVATARS = [
        '/static images/avatars/avat1.png',
        '/static images/avatars/avat2.png',
        '/static images/avatars/avat3.png',
        '/static images/avatars/avat4.png',
        '/static images/avatars/avat5.png',
        '/static images/avatars/avat6.png',
        '/static images/avatars/avat7.png',
        '/static images/avatars/avat8.png'
    ];

    public static function getDefaultAvatar()
    {
        $len = sizeof(self::AVATARS);
        $random = rand(0, $len - 1);
        return self::AVATARS[$random];
    }

    public function isAdmin()
    {
        return $this->type === self::ADMIN_TYPE;
    }

    public function isAuthor()
    {
        return $this->type === self::AUTHOR_TYPE;
    }

    public function likes()
    {
        return $this->hasMany('App\Like');
    }

    public function comments()
    {
        return $this->hasMany('App\Comment');
    }

    public function postRequests()
    {
        return $this->hasMany('App\PostRequest');
    }
}
