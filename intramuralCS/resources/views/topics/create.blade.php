@extends('layouts.app')

@section('content')
    <div id="createCommSect">
        <a href="/posts/create" class="back_btn"><i class="fas fa-chevron-left"></i>Go Back</a>
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
            <button type="submit" class="submitBtn">Submit</button>
        </form>
    </div>
@endsection