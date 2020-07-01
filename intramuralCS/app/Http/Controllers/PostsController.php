<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;
use App\Post;
use App\Topic;
use Illuminate\Support\Facades\Storage;
class PostsController extends Controller
{
        /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //blocks user not logged in from accessing pages like create a new post except for forum page and page for a particular post
        $this->middleware('auth',['except'=>['index','show','orderSelect']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        //$posts = Post::orderBy('title','asc')->get();
        $posts = Post::orderBy('created_at','desc')->paginate(10);
        // $order = 'desc';
        return view('posts.index')->with('posts',$posts);
    }
    public function orderSelect($order)
    {
        //
        if($order=='fav'){
            $unsortedPosts = Post::all();
            $sortedPosts= $unsortedPosts->sortByDesc(function ($post,$key){
                return $post->likes()->count();
            });
            $posts = $sortedPosts->values()->paginate( 10 );
        }
        else{
            $posts = Post::orderBy('created_at',$order)->paginate(10);
        }
        
        return view('posts.index')->with('posts',$posts)->with('order',$order);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $topics = Topic::all()->toArray();
        return view('posts.create')->with('topics',$topics);
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
            'title'=> 'required',
            'body'=> 'required',
            'image'=>'image|max:1999' //file must be an image and less than 2mbs 
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
        else{
            $fileNameToStore = 'noImageUpload.jpg';
        }
        //getting topic id from the topic name in the form
        $topic= Topic::where('name',$request->input('myTopic'))->first();
        $topicId = $topic->id;
        //creating post
        $post = new Post;
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        $post->user_id = auth()->user()->id;
        $post->image= $fileNameToStore;
        $post->topic_id = $topicId;
        $post->save();

        return redirect('/posts')->with('success','Post Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post= Post::find($id);
        //$post_id =$id;
        // $comments = $post->comments()->get();
        //does the same thing as the line above but the hasMany model relationship
        //essentially does the same thing so the line below isn't needed
        $comments = Comment::where('post_id',$id)->get();
        return view('posts.show')->with('post',$post)->with('comments',$comments);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);
        if(auth()->user()->id!=$post->user_id){
            return redirect('/posts')->with('error', "Unauthorized Page!");
        }
        return view('posts.edit')->with('post',$post);
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
            'title'=> 'required',
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
        $post = Post::find($id);
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        if($request->hasFile('image')){
            $post->image = $fileNameToStore;
        }

        $post->save();
        $comments = Comment::where('post_id',$id)->get();
        return view('posts.show')->with('success','Post Updated!')->with('post',$post)->with('comments',$comments);
        // return redirect('/posts')->with('success','Post Updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        if(auth()->user()->id!=$post->user_id){
            return redirect('/posts')->with('error', "Unauthorized Page!");
        }
        if($post->image!='noImageUpload.jpg'||$post->image!='NULL'){
            Storage::delete('public/images/'.$post->image);
        }
        $post->delete();
        return redirect('/posts')->with('success', 'Post has been deleted!');
    }
}
