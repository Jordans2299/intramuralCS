@extends('layouts.app')

@section('content')
    <h1>Comments</h1>
    @if (count($comments)>0)
        @foreach ($comments as $comment)
            <div class='commentBody'>
                <h3> <a href="/comments/{{$comment->id}}">{!!$comment->body!!}</a> </h3>
                
                <hr>
            </div>
        @endforeach
        {{$comments->links()}}
    @else
        <p>No Comments found :( </p>
    @endif
    

@endsection