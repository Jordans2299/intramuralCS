<?php

namespace App\Http\Controllers;
use App\Like;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    
    public function __construct()
    {
        //blocks user not logged in from accessing pages like create a new post except for forum page and page for a particular post
        $this->middleware('auth',['except'=>['handleLike','likePost','likeComment']]);
    }
    public function likePost($id)
    {
        // here you can check if post exists or is valid or whatever

        $this->handleLike('App\Post', $id);
        return redirect()->back();
    }
    public function likeComment($id)
    {
        // here you can check if comment exists or is valid or whatever
        $this->handleLike('App\Comment', $id);
        return redirect()->back();
    }

    public function handleLike($type, $id)
    {
        $existing_like = Like::withTrashed()->whereLikeableType($type)->whereLikeableId($id)->whereUserId(Auth::id())->first();

        if (is_null($existing_like)) {
            Like::create([
                'user_id'       => Auth::id(),
                'likeable_id'   => $id,
                'likeable_type' => $type,
            ]);
            //if like hasn't been deleted when clicked again delete it
        } else {
            if (is_null($existing_like->deleted_at)) {
                $existing_like->delete();
            //otherwise when clicked again restore it
            } else {
                $existing_like->restore();
            }
        }
    }
}
