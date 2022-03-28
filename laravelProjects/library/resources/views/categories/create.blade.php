@extends('layout')

@section('title')
Create category
@endsection

@section('content')
<div class="m-4">
   @include('inc.errors')
    <form method="POST" action="{{route('categories.store')}}">
        @csrf
    <div class="form-group">
        <label for="name"> category name</label>
        <input type="text" name="name" class="form-control" id="name" value="{{old('name')}}">
    </div>

    <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
@endsection