@extends('layout')

@section('title')
Edit Category  - {{$category->name}}
@endsection

@section('content')
<div class="m-4">
 @include('inc.errors')
    <form method="POST" action="{{route('categories.update',$category->id)}}">
        @csrf
    <div class="form-group">
        <label for="name">Category name </label>
        <input type="text" name="name" class="form-control" id="name" value="{{old('name') ?? $category->name}}">
    </div>
    
    <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
@endsection     