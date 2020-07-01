@extends('layouts.app')

@section('content')
    <a href="/posts" class="prev_btn">Previous</a>
    <h1>Edit Comment</h1>
    <br>
    <form method="post" action="{{ route('comments.update',$comment->id) }}"  enctype="multipart/form-data">
            <div class="form-group">
                {{ method_field('PUT') }}
                {{csrf_field()}}  
                <label for="body">Body</label>
                <textarea class="form-control" id="post_body" name="body" cols="30" rows="10" placeholder="Body Text"></textarea>
            </div>
            {{-- <input type="hidden" name="post_id" value="{{$_GET['post_id']}}" /> --}}
            <div class="form-group">
                <input type="file" name="image">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>

@endsection