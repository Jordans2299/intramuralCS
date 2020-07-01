<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //change table name
    protected $table = 'posts';
    //primary key
    protected $primaryKey='id';
    //timestamps
    public $timestamps = true;
    

    public function user(){
        return $this->belongsTo('App\User');
    }
    public function comments(){
        return $this->hasMany('App\Comment');
    }
    public function topic(){
        return $this->belongsTo('App\Topic');
    }
    //retrieves all users that have liked the post
    public function likes()
    {
        return $this->morphToMany('App\User', 'likeable')->whereDeletedAt(null);
    }
    //checks if current user has liked post
    public function getIsLikedAttribute()
    {
        $like = $this->likes()->whereUserId(auth()->user()->id)->first();
        return (!is_null($like)) ? true : false;
    }

}