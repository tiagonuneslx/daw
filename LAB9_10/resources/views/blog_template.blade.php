<!doctype html>
<html lang="pt-pt">
<head>
    <!-- Required meta tags -->
    <meta charset="iso-8859-1">
    <meta content="width=device-width, initial-scale=1, shrink-to-fit=no" name="viewport">

    <!-- Bootstrap CSS -->
    <link crossorigin="anonymous" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" rel="stylesheet">

    <title>New Post - Sup Dude Forum</title>
</head>
<body>
<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script crossorigin="anonymous"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script crossorigin="anonymous"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script crossorigin="anonymous"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

<!-- Top bar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="{{route('home')}}"><img src="{{url('img/lebowski.png')}}" alt=""
                                                          style="max-height: 70px; object-fit: cover; margin: -13px 10px -13px 0;"/>Sup
        Dude Forum</a>
    <button aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation" class="navbar-toggler"
            data-target=".navbar-collapse" data-toggle="collapse" type="button">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="{{route('home')}}">Home</a>
            </li>
        </ul>
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link active" href="{{route('post')}}">New Post</a>
            </li>
        </ul>
    </div>
</nav>
<div class="content">
    <div class="row d-flex justify-content-center m-0 mt-5">
        <div class="col-sm-8 text-center">
            <h2>Edit/Create Post</h2>
        </div>
    </div>
    <form class="p-4"
          @if ($blog_id)
          action="{{route('post_action', ['blog_id' => $blog_id])}}"
          @else
          action="{{route('post_action')}}"
          @endif
          method="post">
        {{csrf_field()}}
        <div class="row d-flex justify-content-center">
            <div class="col-sm-8">
                <textarea class="form-control" name="content" rows="7">{{$content}}</textarea>
            </div>
        </div>
        <div class="row d-flex justify-content-center mt-3 pb-5">
            <div class="col-sm-1" style="margin-right: 30px;">
                <button class="btn btn-primary px-4" type="submit">Submit</button>
            </div>
            <div class="col-sm-1">
                <button class="btn btn-secondary px-4" type="reset">Clear</button>
            </div>
        </div>
    </form>
</div>
<footer class="page-footer py-4 bg-dark text-white row m-0 mt-3">
    <div class="col-6 text-right">
        <small>2019 &copy; Desenvolvimento de Aplicações Web</small><br>
        <small>FCT - Universidade do Algarve</small>
    </div>
    <div class="col-auto pr-5">
        <small>Aluno Tiago Nunes</small><br>
        <small>Licenciatura de Engenharia Informática</small>
    </div>
</footer>
</body>