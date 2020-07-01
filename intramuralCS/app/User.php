<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
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
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    //Built in Eloquent relationship function automatically finds the posts,comments,topics
    //that have been created by the user (by default it searches for user_id table)
    public function posts(){
        return $this->hasMany('App\Post');
    }
    public function comments(){
        return $this->hasMany('App\Comment');
    }
    public function topics(){
        return $this->hasMany('App\Topic');
    }
    public function likedPosts()
{
    return $this->morphedByMany('App\Post', 'likeable')->whereDeletedAt(null);
}
public function likedComments()
{
    return $this->morphedByMany('App\Comment', 'likeable')->whereDeletedAt(null);
}
}
