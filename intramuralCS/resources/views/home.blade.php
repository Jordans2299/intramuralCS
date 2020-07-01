@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    Hi {{$user->name}}!
                    <br>
                    <div >
                            <img src="/storage/images/{{$user->image}}" alt="" class="profileImg">
                    </div>
                    <form action="{{action('HomeController@profileImg')}}" method="POST" enctype="multipart/form-data">
                        {{ method_field('PUT') }}  
                        {{csrf_field()}}        
                        <div class="form-group">
                            <label for="">Update Profile Pic: </label>
                            <input type="file" name="image">
                            <button type="submit" class="">upload</button>
                        </div>
                        
                     </form>
                    
                    <hr>
                    <a href="/posts/create" class="btn btn-primary">Create Post</a>
                    <br>
                    <br>
                    <h3>Your Posts</h3>
                    
                    <table class="table table-striped">
                        <tr>
                            <th>Title</th>
                            <th></th>
                            <th></th>
                        </tr>
                        @foreach ($posts as $post)
                            <tr>
                                <th><a href={{route('posts.show',$post->id)}} id=stanLink>{{$post->title}}</a></th>
                                <th><a href="/posts/{{$post->id}}/edit" class="btn btn-info">Edit</a></th>
                                <th>    <form action="{{ route('posts.destroy',$post->id) }}" method="POST">
                                        {{csrf_field()}}  
                                        {{ method_field('DELETE') }}
                                        <button type="submit" class="btn btn-danger float-right">Delete</button>
                                </form></th>
                            </tr>
                        @endforeach
                    </table>
                    <h3>Your Comments</h3>
                    
                    <table class="table table-striped">
                        <tr>
                            <th>Title</th>
                            <th></th>
                            <th></th>
                        </tr>
                        @foreach ($comments as $comment)
                            <tr>
                                <?php 
                                    $commentTitle = $comment->body;
                                    //gets rid of the html tags from the comment
                                    $commentTitle = strip_tags($commentTitle);
                                    if(strlen($commentTitle)>15){ 
                                        //$shrunkTitle = substr($commentTitle,0,5);
                                        // echo substr($commentTitle,0,5).'...';
                                ?>
                                <th><a href={{route('posts.show',$comment->post_id)}} id=stanLink>{{substr($commentTitle,0,15).'...'}}</a></th>
                                <?php }
                                else{
                                ?>
                                <th><a href={{route('posts.show',$comment->post_id)}} id=stanLink>{!!$comment->body!!}</a></th>
                                <?php } ?>
                                <th><a href="/comments/{{$comment->id}}/edit" class="btn btn-info">Edit</a></th>
                                <th>    <form action="{{ route('comments.destroy',$comment->id) }}" method="POST">
                                        {{csrf_field()}}  
                                        {{ method_field('DELETE') }}
                                        <button type="submit" class="btn btn-danger float-right">Delete</button>
                                </form></th>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection