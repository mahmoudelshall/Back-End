@extends('layout')

@section('title')
Login
@endsection

@section('content')
<div class="m-4">
   @include('inc.errors')
    <form method="POST" action="{{route('auth.handleLogin')}}">
        @csrf
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