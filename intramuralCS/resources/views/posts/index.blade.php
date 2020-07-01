@extends('layouts.app')

@section('content')

<div class="topQuestions">
    <div class="tqHead">
        Question Board
    </div>
    <div class="Dropdown">

    {{-- <form action="{{ action('PostsController@orderSelect')}}" method="GET">
        <select id='orderSelect' name="order">
            @if ($order =='asc')
            <option value="asc" selected>Old to New</option>
            <option  value="desc" >Most Recent</option>
            @else 
            <option value="asc" >Old to New</option>
            <option  value="desc" selected>Most Recent</option>
            @endif
            }
        </select>
        <input type="submit" value="Reorder">
    </form> --}}
    <div class="sortLinksDrop" id='sortLinksDrop'>
        <button id="sortLinkBtn" onclick="sortDropDown()" class="sortLinkBtn">Sort By <i class="fas fa-caret-down"></i></button>
        <div class="sortDropContent" id="sortDropContent">
            <a href="{{ route('posts.orderSelect','desc')}}">Most Recent</a>
            <a href="{{ route('posts.orderSelect','asc')}}">Oldest</a>
            <a href="{{ route('posts.orderSelect','fav')}}">Favorites</a>
            {{-- <a class="order" href="">Most Recent</a>
            <a class="order" href="">Oldest</a>
            <a class="order" href="">Favorites</a> --}}
        </div>
    </div>
        <a id="askQuestion" href="/posts/create">Ask a Question</a>
    </div>
    <br>
    <form action="/search" method="POST" role="search">
        {{ csrf_field() }}
        <div class="input-group">
            <input type="text" class="form-control" name="query"
                placeholder="Search posts"> <span class="input-group-btn">
                <button type="submit" class="btn btn-default">
                    <span class="glyphicon glyphicon-search"></span>
                </button>
            </span>
        </div>
    </form>
    @if(isset($details))
        <p>Here are your search results for {{$query}}:   </p>
        @foreach ($details as $post)
        <div class="postBody">
        <div class="well">
            <div class="col-md-8 col-sm-8">
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
        
    @elseif(isset($message))
        <p>{{$message}}</p>
    @else
        
    
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
                                <button class="likeBtn" id="likeBtnUnClicked"><i class="far fa-thumbs-up"></i></button>
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
            </div>
            <hr>
        @endforeach
        {{$posts ?? ''->links()}}
        @else
            <p>No posts found :(</p>
        @endif
    </div>
</div>
@endif

{{-- <script>
    function sortDropDown(){
        document.getElementById('sortDropContent').classList.toggle('show');
    }
    window.onclick = function(event) {
        if (!event.target.matches('.sortLinkBtn')) {
        var dropdowns = document.getElementsByClassName("sortDropContent");
        var i;
        for (i = 0; i < dropdowns.length; i++) {
          var openDropdown = dropdowns[i];
          if (openDropdown.classList.contains('show')) {
            openDropdown.classList.remove('show');
          }
        }
      }
    }
</script> --}}

@endsection