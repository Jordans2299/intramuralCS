<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    //
    protected $table='comments';
    public $primaryKey='id';
    public $timestamps= true;

    public function post(){
        return $this->belongsTo('App\Post');
    }
    
    public function user(){
        return $this->belongsTo('App\User');
    }
        //retrieves all users that have liked the comment
        public function likes()
        {
            return $this->morphToMany('App\User', 'likeable')->whereDeletedAt(null);
        }
        //checks if current user has liked the comment
        public function getIsLikedAttribute()
        {
            $like = $this->likes()->whereUserId(Auth::id())->first();
            return (!is_null($like)) ? true : false;
        }

}