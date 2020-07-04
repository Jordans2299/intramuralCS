@extends('layouts.app')

@section('content')
<br>
<div class="topQuestions">
    <a href="/posts" class="back_btn">Go Back</a>
    <br>
    <br>
    <div class="postTop">
        <div class="likeCounterDiv">
        <h1 class='likesCount'> {{$post->likes()->count()}} </h1>
        @if (!Auth::guest())
            @if ($post->isLiked)
            <form action="{{ route('post.like', $post->id) }}" method="get">
                <button type="submit" class="likeBtn" id="likeBtnClicked"><i class="fas fa-thumbs-up"></i></button>
            </form>
            @else
                <form action="{{ route('post.like', $post->id) }}" method="get">
                    <button type="submit" class="likeBtn" id="likeBtnUnClicked"><i class="far fa-thumbs-up"></i></button>
                </form>
            @endif
        @else
            <form action="/login" method="get">
                <button type="submit" class="likeBtn" id="likeBtnUnClicked"><i class="far fa-thumbs-up"></i></button>
            </form>
        @endif
        </div>
        <div class="titleAndBody">
            <h1 class="postTitle"> {{$post->title}}</h1>
            <div>
                {!!$post->body!!}
            </div>
        </div>
    </div>
    <div class="imageBorder">
        <img src="/storage/images/{{$post->image}}" alt="" class="postImageFull">
    </div>
    <hr>
    <small>Written by {{$post->user->name}} on {{$post->created_at}}</small>
    <br>
    <br>
    
    <hr>

    {{-- <a href="/posts/{{$post->id}}/edit" class="btn btn default">Edit</a> --}}

@if (!Auth::guest() && Auth::user()->id==$post->user_id)

<div class="editDeleteLinks">
        <!-- edit button -->
    <a href="{{route('posts.edit', $post->id)}}" class="btn btn-info float-left">Edit</a>
        <!-- delete button -->
    <form action="{{ route('posts.destroy',$post->id) }}" method="POST">
        {{ method_field('DELETE') }}
        {{csrf_field()}}   
            {{-- @method('DELETE') --}}
            <button type="submit" class="btn btn-danger float-right">Delete</button>
    </form>
</div>
@endif
<br>
<br>
<br>
<a id="askQuestion" href="/comments/create?post_id={{$post->id}}">Answer Question</a>
<br>
<br>
<h3>{{count($comments)}} Answers</h3>
<div class="tqBody">
        @if (count($comments)>0)
        @foreach ($comments as $comment)
            <div class="well">
                <div class="row">
                    <div class="col-md-4 col-sm-4">
                        <img src="/storage/images/{{$comment->image}}" alt="" class="postImageThumb">
                    </div>
                </div>
                <div class="col-md-8 col-sm-8">
                    <p>{!!$comment->body!!}</p>
                    <small>Written by {{$comment->user->name}} on {{$comment->created_at}}</small>
                </div>
                @if (!Auth::guest() && Auth::user()->id==$comment->user_id)
                <!-- edit button -->
                    <a href="{{route('comments.edit', $comment->id)}}" class="btn btn-info float-left">Edit</a>
                <!-- delete button -->
                <form action="{{ route('comments.destroy',$comment->id) }}" method="POST">
                    {{ method_field('DELETE') }}
                    {{csrf_field()}}  
                    <button type="submit" class="btn btn-danger float-right">Delete</button>
                </form>
            <br><br>
        @endif
            </div>
        @endforeach
        {{-- {{$posts->links()}} --}}
    @else
        <p>No comments found :(</p>
    @endif
    </div>
</div>
@endsection
