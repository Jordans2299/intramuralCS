<?php
//tutorial on like/unlike model etc: https://mydnic.be/post/the-perfect-like-system-for-laravel
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Like extends Model
{
    //softdeletes prevents like from actually being deleted from database when unliked
    use SoftDeletes;

    protected $table = 'likeables';

    protected $fillable = [
        'user_id',
        'likeable_id',
        'likeable_type',
    ];

    /**
     * Get all of the Comments that are assigned this like.
     */
    public function comments()
    {
        return $this->morphedByMany('App\Comment', 'likeable');
    }

    /**
     * Get all of the posts that are assigned this like.
     */
    public function posts()
    {
        return $this->morphedByMany('App\Post', 'likeable');
    }
}
