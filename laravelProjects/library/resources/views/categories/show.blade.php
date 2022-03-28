@extends('layout')

@section('title')
show
@endsection

@section('content')
<div class="container-fluid" style="background-color:#d1e0e0 ;">
    <div class="row p-4 justify-content-around align-items-around ">
        <h3>{{$category->name}} category</h3>
        <a href="{{route('categories.index')}}" class="btn btn-primary">Back</a>
    </div>
    <div class="row p-4 justify-content-around align-items-around ">
        <h4>Books:</h4>
    </div>
   
</div>
<div class="container-fluid" style="background-color:#d1e0e0 ;">
    <div class="row p-4 justify-content-around align-items-around ">
     
        @foreach ($category->books as $book)
        
            <div class="col-12 col-md-6 col-lg-4 ">

                <div class="card p-2 shadow m-1 mt-3">
                    <img src="{{asset('uploads/books')."/$book->img"}}" class="card-img-top img">
                    <div class="card-body">
                        <h5 class="card-title">{{ $book->title }} </h5>
                        <a href="{{route('books.show',$book->id)}}" class="btn btn-primary">Show</a>
                        @auth
                        <a href="{{ route('books.edit',$book->id)}}" class="btn btn-info">Edit</a>
                        <a href="{{ route('books.delete',$book->id)}}" class="btn btn-danger">Delete</a>
                    @endauth     
                    </div>
                </div>
            </div>  
            @endforeach
        
       
    </div>
</div>
@endsection