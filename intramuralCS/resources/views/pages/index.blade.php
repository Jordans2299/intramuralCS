@extends('layouts/app')

@section('content')
        <div class="infoBox">
            <div class="dialog">
                <div class="infoHead">
                    Join the Community.
                </div>
                <div class="infoBody">
                    Intramural CS is a place where college students can collaborate and ask questions regarding
                    the CS curriculum or just personal projects. Create an account to connect with other students
                    from your university or connect with the global community. 
                </div>
            </div>
            @guest 
            <div class="signUpBox">
                <p>
                    <a href="{{ route('register') }}">Sign Up
                    <i class="fas fa-sign-in-alt"></i> </a>
                </p>
            </div>
            @else
            <div class="signUpBox">
                <p>
                    <a href="/posts">Forum
                    <i class="fas fa-sign-in-alt"></i> </a>
                </p>
            </div>
            @endguest
        </div>

        <div class="topQuestions">
            <div class="tqHead">
                Top Questions
            </div>

            <div class="postBody">
                @if (count($posts)>0)
                @foreach ($posts as $post)
                <br>
                <div class="well">
                    <div class="col-md-8 col-sm-8">
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
                            <div class='postSummary'>
                                <h3><a id="postTitle" href="/posts/{{$post->id}}">{{$post->title}}</a></h3>
                                @if ($post->image!='noImageUpload.jpg')
                                <div class="row">
                                    <div class="col-md-8">
                                        <img src="/storage/images/{{$post->image}}" alt="" class="postImageThumb">
                                    </div>
                                </div>
                                <br>
                                @endif
                                <p style="font-style: italic">Topic: {{$post->topic->name}}</p>
                                <small>Written by {{$post->user->name}} on {{$post->created_at}}</small>
                            </div>
                        </div>
                </div>
                <hr>
                @endforeach
                {{$posts ->links("pagination::bootstrap-4") }}
            @else
                <p>No posts found :(</p>
            @endif
            </div>
        </div>
        </div>
@endsection
