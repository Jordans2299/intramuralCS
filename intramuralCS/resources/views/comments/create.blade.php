@extends('layouts.app')

@section('content')
    <div id="createCommSect">
        <a href="/posts" class="back_btn"><i class="fas fa-chevron-left"></i>Go Back</a>
        <br>
        <br>
        <h1>Answer Question</h1>
        <br>
        <form method="post" action="{{ route('comments.store') }}" enctype="multipart/form-data" >
            <div class="form-group">
                {{csrf_field()}}  
                <label for="body">Body</label>
                <textarea class="form-control" id="post_body" name="body" cols="30" rows="10" placeholder="Body Text"></textarea>
            </div>
            <input type="hidden" name="post_id" value="{{$_GET['post_id']}}" />
            <div class="form-group">
                <input type="file" name="image">
            </div>
            <button type="submit" class="submitBtn">Submit</button>
        </form>
        {{-- {{ $_GET['post_id'] }} --}}
    </div>
@endsection