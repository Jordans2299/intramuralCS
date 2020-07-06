@extends('layouts.app')

@section('content')
    <div class="editDiv">
    <a href="/posts/{{$post->id}}" class="back_btn"><i class="fas fa-chevron-left"></i>Go Back</a>
    <br>
    <br>
    <h1>Edit Post</h1>
    <form action="{{ route('posts.update',$post->id) }}" method="POST" enctype="multipart/form-data">
            <div class="form-group">
            {{ method_field('PUT') }}
            {{csrf_field()}}          
                <label for="title">Title</label>
                <input type="text" class="formInput" value="{{ $post->title }}" name="title" placeholder="Title"/>
            </div>
            <div class="form-group">
                <label for="body">Body</label>
                <textarea id="post_body" class="form-control" name="body" cols="30" rows="10" placeholder="Detail">{{ $post->body }}</textarea>
            </div>
            <div class="form-group">
                <input type="file" name="image">
            </div>
            <button type="submit" class="submitBtn">Submit</button>
     </form>
    </div>
@endsection