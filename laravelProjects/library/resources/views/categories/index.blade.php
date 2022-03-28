@extends('layout')
@section('title')
All Categories
@endsection

@section('content')

<div class="container-fluid" style="background-color:#d1e0e0 ;">
    <div class="row p-4 justify-content-around align-items-around ">
        <h1>All Categories </h1>
        <a href="{{route('categories.create')}}" class="btn btn-success p-3">Add </a>
        
    </div>
</div>

<div class="container-fluid" style="background-color:#d1e0e0 ;">
    <div class="row p-4 justify-content-around align-items-around ">
        
        @foreach ($categories as $category)
            <div class="col-12 col-md-6 col-lg-4 ">

                <div class="card p-2 shadow m-1 mt-3">
                    <div class="card-body">
                        <h5 class="card-title">{{ $category->name }} </h5>
                        <a href="{{route('categories.show',$category->id)}}" class="btn btn-primary">Show</a>
                        @auth
                        <a href="{{ route('categories.edit',$category->id)}}" class="btn btn-info">Edit</a>
                        <a href="{{ route('categories.delete',$category->id)}}" class="btn btn-danger">Delete</a>
                    @endauth     
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

  

@endsection


