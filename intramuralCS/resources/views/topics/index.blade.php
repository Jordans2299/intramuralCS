@extends('layouts.app')

@section('content')
    <h1 id="topicsTitle">Topics</h1>
    <br>
    @auth
    <a href="/topics/create" id="newTopic">Create New Topic</a>
    <br>
    <br>
    @endauth

    @if (count($topics)>0)
        @foreach ($topics as $topic)
            <div class="topicList">
                <a href="/topics/{{$topic->id}}" class="topicName">{{$topic->name}}</a> 
            </div>
        @endforeach
        {{$topics->links()}}
    @else
        No topics were found :(
    @endif
    

@endsection