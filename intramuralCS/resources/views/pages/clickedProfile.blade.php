@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <h4>{{$user->name}}'s Profile</h4>
                    <br>
                    @if ($user->image != NULL)
                        <div >
                            <img src="/storage/images/{{$user->image}}" alt="" class="profileImg">
                        </div>
                    @else 
                    <div >
                        <img src="/Images/noLoggedIn.jpeg" alt="" class="profileImg">
                    </div>
                    @endif
                    <br>
                    <?php $posts = $user->posts ?>
                    @if (count($posts)>0)
                    <h3>Questions Asked</h3>
                    <table class="table table-striped">

                        @foreach ($posts as $post)
                            <tr>
                                <th><a href={{route('posts.show',$post->id)}} id=stanLink>{{$post->title}}</a></th>
                            </tr>
                        @endforeach
                    </table>
                    @endif
                    <?php $comments = $user->comments ?>
                    @if (count($comments)>0)
                    <h3>Answers</h3>
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