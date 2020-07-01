<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

class PagesController extends Controller
{
    public function index(){
        $unsortedPosts = Post::all();
        $sortedPosts= $unsortedPosts->sortByDesc(function ($post,$key){
            return $post->likes()->count();
        });
        $posts = $sortedPosts->values()->paginate( 10 );
        return view('pages.index')->with('posts',$posts);
    }
    public function schools(){
        return view('pages/schools');
    }
    public function courses(){
        return view('pages/topics');
    }
    public function resources(){
        return view('pages/resources');
    }
}