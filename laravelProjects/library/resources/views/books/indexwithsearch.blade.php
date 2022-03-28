@extends('layout')
@section('title')
All Books
@endsection

@section('content')
    <input type="text" id="keyword">
    <h1>All Books </h1>

    <a href="{{route('books.create')}}" class="btn btn-success">Add </a>
<div id="allBooks">
    @foreach ($books as $book)

    <h3>{{ $book->title }}</h3>
    <p>{{$book->desc}}</p>

@endforeach
</div>
@endsection


@section('scripts')
<script>
$('#keyword').keyup(function(){
    let keyword = $(this).val()
    let url = "{{route('books.search')}}"+"?keyword="+keyword
    $.ajax({
        type:"GET",
        url:url,
        contentType:false,
        processData:false,
        success: function(data)
        {
            $('#allBooks').empty()
            for (book of data){
                $('#allBooks').append(`
                <h3>${book.title}</h3>
                <p>${book.desc}</p>
                `) 
            }
        }
    })

})
</script>  
@endsection