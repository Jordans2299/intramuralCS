<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user_id = auth()->user()->id;
        $user = User::find($user_id);
        return view('home')->with('posts',$user->posts)->with('user',$user)->with('comments',$user->comments);
    }

    public function profileImg(Request $request)
    {
        $this->validate($request, [
            'image'=>'image|max:1999' //file must be an image and less than 2mbs 
        ]);
        if($request->hasFile('image')){
            $filenameWithExt = $request->file('image')->getClientOriginalName();
            //just file name
            $filename= pathinfo($filenameWithExt,PATHINFO_FILENAME);
            $extension = $request->file('image')->getClientOriginalExtension();
            $fileNameToStore=$filename.'_'.time().'.'.$extension;
            $path = $request->file('image')->storeAs('public/images',$fileNameToStore);

        } 
        else{
            $fileNameToStore = 'noImageUpload.jpg';
        }

        //Uploading profile Image
        $user=auth()->user();
        $user->image= $fileNameToStore;
        $user->save();

        return redirect('/home')->with('success','Profile Updated');
    }
}
