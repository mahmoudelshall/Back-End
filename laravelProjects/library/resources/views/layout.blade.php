<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">Library</a>


        <div class="collapse navbar-collapse" id="navbarToggleExternalContent">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="{{route('books.index')}}">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('books.index')}}">All Books</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('categories.index')}}">Categories</a>
                </li>

            </ul>

        </div>
      
        @auth
        <span class="disabled mr-3 text-light">{{auth()->user()->name}}</span>
        <a href="{{route('auth.logout')}}" class="btn btn-outline-danger my-2 my-sm-0" type="submit">logout</a>
        @endauth
      
        @guest
        <a href="{{route('auth.login')}}" class="btn btn-outline-primary my-2 my-sm-0" type="submit">login</a>
        <a href="{{route('auth.register')}}" class="btn btn-outline-success my-2 my-sm-0 ml-2" type="submit">Register</a>  
        @endguest
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarToggleExternalContent" aria-controls="navbarToggleExternalContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
    </nav>
    
     @yield('content')
       
    <script src="{{asset('js/jquery-3.6.0.min.js')}}"></script>
    <script src="{{asset('js/bootstrap.bundle.min.js')}}"></script>
    @yield('scripts')
</body>
</html>