@extends('layout')

@section('title')
Register
@endsection

@section('content')
<div class="m-4">
   @include('inc.errors')
    <form method="POST" action="{{route('auth.handleRegister')}}">
        @csrf
    <div class="form-group">
        <label for="name"> User Name</label>
        <input type="text" name="name" class="form-control" id="name" value="{{old('name')}}">
    </div>
    <div class="form-group">
        <label for="email"> User Email</label>
        <input type="email" name="email" class="form-control" id="email" value="{{old('email')}}">
    </div>
    <div class="form-group">
        <label for="password"> User Password</label>
        <input type="password" name="password" class="form-control" id="password" value="{{old('password')}}">
    </div>

    <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
@endsection