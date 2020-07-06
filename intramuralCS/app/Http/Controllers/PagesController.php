<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\User;

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
    public function blog1(){
        return view('pages/blog1');
    }
    public function blog2(){
        return view('pages/blog2');
    }
    public function blog3(){
        return view('pages/blog3');
    }
    public function clickedProfile($user_id){
        $user = User::find($user_id);
        return view('pages/clickedProfile')->with('user',$user);
    }
}