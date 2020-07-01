<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;
use Illuminate\Support\Facades\Storage;

class CommentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        //blocks user not logged in from accessing pages like create a new post except for forum page
        $this->middleware('auth',['except'=>['index','show']]);
    }
    public function index()
    {
        $comments = Comment::orderBy('created_at','desc')->paginate(10);
        return view('comments.index')->with('comments',$comments);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('comments.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'body'=> 'required',
            'image'=>'image|max:1999'
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

        $comment = new Comment;
        $comment->body=$request->input('body');
        $comment->user_id=auth()->user()->id;
        $comment->post_id = $request->input('post_id');
        $comment->image=$fileNameToStore;
        $comment->save();
        return redirect('/posts'.'/'.$comment->post_id)->with('success','Comment Created!');
    }
 
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $comment = Comment::find($id);
        return view('comments.show')->with('comment',$comment);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $comment = Comment::find($id);
        if(auth()->user()->id!=$comment->user_id){
            return redirect('/posts')->with('error', "Unauthorized Page!");
        }
        return view('comments.edit')->with('comment',$comment);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'body'=> 'required',
            'image'=>'image|max:1999'
        ]);

        //file upload
        if($request->hasFile('image')){
            $filenameWithExt = $request->file('image')->getClientOriginalName();
            //just file name
            $filename= pathinfo($filenameWithExt,PATHINFO_FILENAME);
            $extension = $request->file('image')->getClientOriginalExtension();
            $fileNameToStore=$filename.'_'.time().'.'.$extension;
            $path = $request->file('image')->storeAs('public/images',$fileNameToStore);
        } 
        //creating post
        $comment = Comment::find($id);
        $comment->body = $request->input('body');
        if($request->hasFile('image')){
            $comment->image = $fileNameToStore;
        }

        $comment->save();

        return redirect('/posts/'.$comment->post_id)->with('success','Comment Updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $comment = Comment::find($id);
        if(auth()->user()->id!=$comment->user_id){
            return redirect('/posts')->with('error', "Unauthorized Page!");
        }
        if($comment->image!='noImageUpload.jpg'||$comment->image!='NULL'){
            Storage::delete('public/images/'.$comment->image);
        }
        $comment->delete();
        return redirect('/posts/'.$comment->post_id)->with('success', 'Comment has been deleted!');
    }
}

