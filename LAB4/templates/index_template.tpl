<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1, shrink-to-fit=no" name="viewport">

    <!-- Bootstrap CSS -->
    <link crossorigin="anonymous" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" rel="stylesheet">

    <!-- Custom Styling -->
    <style>
        .carousel-item img {
            max-height: 200px;
            object-fit: cover;
        }
    </style>

    <title>Sup Dude Forum</title>
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
    <a class="navbar-brand" href="index_template.html">Sup Dude Forum</a>
    <button aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation" class="navbar-toggler"
            data-target="#navbarColor01" data-toggle="collapse" type="button">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
            </li>
        </ul>
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="#">New Post</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="login_template.html">Logout</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Welcome Tiago Nunes</a>
            </li>
        </ul>
    </div>
</nav>
<div class="container">
    <div class="row py-3">
        <div class="col carousel slide" data-ride="carousel" id="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img alt="First slide" class="d-block w-100"
                         src="img/img1.jpg">
                </div>
                <div class="carousel-item">
                    <img alt="Second slide" class="d-block w-100"
                         src="img/img2.jpg">
                </div>
            </div>
            <a class="carousel-control-prev" data-slide="prev" href="#carousel" role="button">
                <span aria-hidden="true" class="carousel-control-prev-icon"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" data-slide="next" href="#carousel" role="button">
                <span aria-hidden="true" class="carousel-control-next-icon"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>
    {foreach $posts as $post}
    <div class="row mb-3">
        <div class="col border shadow-sm py-3 bg-white rounded">
            <div class="row">
                <div class="ml-4 col-3 post-info">
                    <div style="border: 1px solid steelblue; border-radius: 2%;">
                        <div class="text-white text-center" style="background-color: steelblue">
                            <p class="p-2">{$post["user_name"]}</p>
                        </div>
                        <div class="px-3 pb-3">
                            <p>Last Modified: {$post["updated_at"]}</p>
                            <p>Date of Creation: {$post["created_at"]}</p>
                            <a href="#">Update post</a>
                        </div>
                    </div>
                </div>
                <div class="col px-5 py-1">
                    <p>{$post["content"]}</p>
                </div>
            </div>
        </div>
    </div>
    {/foreach}
</div>
<footer class="page-footer py-4 bg-dark text-white row m-0 mt-3">
    <div class="col-6 text-right">
        <small>2019 &copy; Desenvolvimento de Aplicações Web</small><br>
        <small>FCT - Universidade do Algarve</small>
    </div>
    <div class="col-auto pr-5">
        <small>Aluno Tiago Nunes nº 61271</small><br>
        <small>Licenciatura de Engenharia Informática</small>
    </div>
</footer>
</body>
</html>