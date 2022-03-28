@extends('layout')

@section('title')
Edit Book  - {{$book->title}}
@endsection

@section('content')
<div class="m-4">
 @include('inc.errors')
    <form method="POST" action="{{route('books.update',$book->id)}}" enctype="multipart/form-data">
        @csrf
    <div class="form-group">
        <label for="Title">Book Title</label>
        <input type="text" name="title" class="form-control" id="Title" value="{{old('title') ?? $book->title}}">
    </div>
    <div class="form-group">
        <label for="Description">Book Description</label>
        <textarea name="desc" rows="3"  class="form-control" id="Description">{{old('desc') ??$book->desc}}</textarea> 
    </div>
     <div class="form-group">
       <input type="file" name="img" class="form-control-file">
    </div>
    
    <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
@endsection