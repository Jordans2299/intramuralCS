@extends('layouts.app')

@section('content')
<br>
<div class="topQuestions">
    <a href="/posts" class="back_btn"><i class="fas fa-chevron-left"></i>Go Back</a>
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
    @if ($post->image != 'noImageUpload.jpg')
    <div class="imageBorder">
        <img src="/storage/images/{{$post->image}}" alt="" class="postImageFull">
    </div>
    <br>
    <br>
    @endif
    @if ($post->user->image == NULL)
        {{-- <div class="uploaderDiv"> --}}
            <a href="{{route('pages.clickedProfile',$post->user->id)}}" class="userPost"><img src="/Images/noLoggedIn.jpeg" alt="" class="postProfileImg"> {{$post->user->name}} 
            on {{$post->created_at}} </a>
        {{-- </div>         --}}
    @else
        {{-- <div class="uploaderDiv"> --}}
            <a href='{{route('pages.clickedProfile',$post->user->id)}}' class="userPost"><img src="/storage/images/{{$post->user->image}}" alt="" class="postProfileImg"> {{$post->user->name}} 
            on {{$post->created_at}} </a>
        {{-- </div> --}}
    @endif

    {{-- <a href="/posts/{{$post->id}}/edit" class="btn btn default">Edit</a> --}}

@if (!Auth::guest() && Auth::user()->id==$post->user_id)
<br>
<div class="editDeleteLinks">
        <!-- edit button -->
    <a href="{{route('posts.edit', $post->id)}}" class="editBtn float-left">Edit</a>
        <!-- delete button -->
    <form action="{{ route('posts.destroy',$post->id) }}" method="POST">
        {{ method_field('DELETE') }}
        {{csrf_field()}}   
            {{-- @method('DELETE') --}}
            <button type="submit" class="btn btn-danger float-right">Delete</button>
    </form>
</div>
<br>
<br>
@endif

<hr>
<br>
<div id="answerHeadDiv">
    <h3 id="answerHeading">{{count($comments)}} Answers</h3>
    <a id="answerQuestion" href="/comments/create?post_id={{$post->id}}">Answer Question</a>
</div>
<div class="tqBody">
        @if (count($comments)>0)
        @foreach ($comments as $comment)
            <div class="postTop">
                <br>
                <div class="likeCounterDiv">
                <h1 class='likesCount' style="padding-top: 12px"> {{$comment->likes()->count()}} </h1>
                @if (!Auth::guest())
                    @if ($comment->isLiked)
                    <form action="{{ route('comment.like', $comment->id) }}" method="get">
                        <button type="submit" class="likeBtn" id="likeBtnClicked"><i class="fas fa-thumbs-up"></i></button>
                    </form>
                    @else
                        <form action="{{ route('comment.like', $comment->id) }}" method="get">
                            <button type="submit" class="likeBtn" id="likeBtnUnClicked"><i class="far fa-thumbs-up"></i></button>
                        </form>
                    @endif
                @else
                    <form action="/login" method="get">
                        <button type="submit" class="likeBtn" id="likeBtnUnClicked"><i class="far fa-thumbs-up"></i></button>
                    </form>
                @endif
            </div>
                <div class="commentsDiv">
                    <p>{!!$comment->body!!}</p> 
                        @if ($comment->image!='noImageUpload.jpg')
                        <div>
                            <img src="/storage/images/{{$comment->image}}" alt="" class="postImageThumb">
                        </div>
                        <br>
                        @endif        
                    @if ($comment->user->image == NULL)
                        {{-- <div class="uploaderDiv"> --}}
                        <a href="{{route('pages.clickedProfile',$comment->user->id)}}" class="userComment"><img src="/Images/noLoggedIn.jpeg" alt="" class="postProfileImg"> {{$comment->user->name}} 
                         on {{$comment->created_at}}</a>
                        {{-- </div>         --}}
                    @else
                        {{-- <div class="uploaderDiv"> --}}
                        <a href="{{route('pages.clickedProfile',$comment->user->id)}}" class="userComment"><img src="/storage/images/{{$comment->user->image}}" alt="" class="postProfileImg"> {{$comment->user->name}} 
                        on {{$comment->created_at}} </a>
                        {{-- </div> --}}
                    @endif
                    <br>
                @if (!Auth::guest() && Auth::user()->id==$comment->user_id)
                <!-- edit button -->
                    <a href="{{route('comments.edit', $comment->id)}}" class="editBtn float-left">Edit</a>
                <!-- delete button -->
                <form action="{{ route('comments.destroy',$comment->id) }}" method="POST">
                    {{ method_field('DELETE') }}
                    {{csrf_field()}}  
                    <button type="submit" class="btn btn-danger float-right">Delete</button>
                </form>
            <br><br>
        @endif
                </div>
            </div>
        @endforeach
        {{-- {{$posts->links()}} --}}
    @else
        <p>No comments found :(</p>
    @endif
    </div>
</div>
@endsection
