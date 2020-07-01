@extends('layouts.app')

@section('content')
    <div id="createCommSect">
        <a href="/posts" class="prev_btn">Previous</a>
        <br>
        <br>
        <h1>Create New Topic</h1>
        <br>
        <form method="post" action="{{ route('topics.store') }}">
            <div class="form-group">
                {{csrf_field()}}  
                <label for="body">Name: </label>
                <input type="text" id="topicName" name="myTopic">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection