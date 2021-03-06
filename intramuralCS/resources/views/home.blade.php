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

                    <h4>Hi {{$user->name}}!</h4>
                    <br>
                    @if ($user->image != NULL)
                        <div >
                            <img src="/storage/images/{{$user->image}}" alt="" class="profileImg">
                        </div>
                    @endif
                    <form action="{{action('HomeController@profileImg')}}" method="POST" enctype="multipart/form-data">
                        {{ method_field('PUT') }}  
                        {{csrf_field()}}  
                        <br>      
                        <div class="form-group">
                            <label for="">Update Profile Picture:</label> <br>
                            <input type="file" name="image">
                            <button type="submit" class="submitBtn"> <i class="fas fa-upload"></i> upload</button>
                        </div>
                        
                     </form>
                    
                    <hr>
                    <br>
                    <a href="/posts/create" id="askQuestion">Ask Question</a>
                    <br>
                    <br>
                    @if (count($posts)>0)
                    <h3>Your Questions</h3>
                    <table class="table table-striped">

                        @foreach ($posts as $post)
                            <tr>
                                <th><a href={{route('posts.show',$post->id)}} id=stanLink>{{$post->title}}</a></th>
                                <th><a href="/posts/{{$post->id}}/edit" class="editBtn float-left">Edit</a></th>
                                <th>    <form action="{{ route('posts.destroy',$post->id) }}" method="POST">
                                        {{csrf_field()}}  
                                        {{ method_field('DELETE') }}
                                        <button type="submit" class="btn btn-danger float-right">Delete</button>
                                </form></th>
                            </tr>
                        @endforeach
                    </table>
                    @endif
                    
                    @if (count($comments)>0)
                    <h3>Your Answers</h3>
                    <table class="table table-striped">
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
                                <th><a href="/comments/{{$comment->id}}/edit" class="editBtn float-left">Edit</a></th>
                                <th>    <form action="{{ route('comments.destroy',$comment->id) }}" method="POST">
                                        {{csrf_field()}}  
                                        {{ method_field('DELETE') }}
                                        <button type="submit" class="btn btn-danger float-right">Delete</button>
                                </form></th>
                            </tr>
                        @endforeach
                    </table>
                    @endif
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection