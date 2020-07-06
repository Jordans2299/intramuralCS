@extends('layouts.app')
@section('content')
    <div>
        <br>
        <h1 style='margin-left: 20px'>{{$topic->name}}</h1>
        <br>
    </div>
    @if (count($posts)>0)
    <table id="topicTable" class="table table-striped"> 
        <tr>
            <th>Questions</th>
            <th></th>
            <th></th>
        </tr>
        @foreach ($posts as $post)
            <tr>
                <th><a href={{route('posts.show',$post->id)}} id=stanLink>{{$post->title}}</a></th>
                <th><a href="/posts/{{$post->id}}/edit" class="editBtn">Edit</a></th>
                <th>    <form action="{{ route('posts.destroy',$post->id) }}" method="POST">
                        {{csrf_field()}}  
                        {{ method_field('DELETE') }}
                        <button type="submit" class="btn btn-danger float-right">Delete</button>
                </form></th>
            </tr>
        @endforeach
    </table>
    @else
        <p> There are no post for this topic</p>
    @endif
@endsection