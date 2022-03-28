@extends('layout')

@section('title')
Create Book
@endsection

@section('content')
<div class="m-4">
   @include('inc.errors')
    <form method="POST" action="{{route('books.store')}}" enctype="multipart/form-data">
        @csrf
    <div class="form-group">
        <label for="Title">Book Title</label>
        <input type="text" name="title" class="form-control" id="Title" value="{{old('title')}}">
    </div>
    <div class="form-group">
        <label for="Description">Book Description</label>
        <textarea name="desc" rows="3"  class="form-control" id="Description">{{old('desc')}}</textarea>
    </div>
     <div class="form-group">
       <input type="file" name="img" class="form-control-file">
    </div>
    <h3> Select Categories:</h3>
    @foreach ($categories as $category)
       <div class="form-check">
         <input class="form-check-input" type="checkbox" name="category_ids[]" value="{{$category->id}}" id="defaultCheck1">
         <label class="form-check-label" for="defaultCheck1">
           {{$category->name}}
         </label>
       </div> 
    @endforeach

<br>
    
    <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
@endsection