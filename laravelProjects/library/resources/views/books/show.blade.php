@extends('layout')

@section('title')
show
@endsection

@section('content')

<div class="container-fluid" style="background-color:#d1e0e0 ;">
    <div class="row p-4 justify-content-around align-items-around ">
        @if ($book!=null)
            <div class="col-12 col-sm-10 col-md-6 ">
                <img src="{{asset('uploads/books')."/$book->img"}}" class="card-img-top ">
            </div>
            <div class="col-12 col-sm-10 col-md-6 ">
                <h5 class="card-title">{{ $book->title }}</ </h3>
                <p class="card-text">{{ $book->desc }} </p>
                <h4>Caterogies:</h4>
                <ul>
                     @foreach ($book->categories as $category)
                         <li>{{$category->name}}</li>
                      @endforeach
                </ul>
                <a href="{{ route('books.index')}}" class="btn btn-primary">Back</a>
                @auth
                    <a href="{{ route('books.edit',$book->id)}}" class="btn btn-info">Edit</a>
                    <a href="{{ route('books.delete',$book->id)}}" class="btn btn-danger">Delete</a>
                @endauth          
            </div>
        @else
            <p class="font-weight-bold">No Products Found </p>
            <a href="{{ route('books.index')}}" class="btn btn-primary">Back</a> 
        @endif
    </div>
</div>

@endsection





