<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    //change table name
    protected $table = 'topics';
    //primary key
    protected $primaryKey='id';
    //timestamps
    public $timestamps = true;

    public function user(){
        return $this->belongsTo('App\User');
    }
    public function posts(){
        return $this->hasMany('App\Post');
    }
}
