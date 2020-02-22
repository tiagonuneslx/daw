<!doctype html>
<html lang="pt-pt">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1, shrink-to-fit=no" name="viewport">

    <!-- Bootstrap CSS -->
    <link crossorigin="anonymous" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" rel="stylesheet">

    <title>Login - Sup Dude Forum</title>
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
    <a class="navbar-brand" href="index.php"><img src="img/lebowski.png" alt="" style="max-height: 70px; object-fit: cover; margin: -13px 10px -13px 0;"/>Sup Dude Forum</a>
    <button aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation" class="navbar-toggler"
            data-target=".navbar-collapse" data-toggle="collapse" type="button">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="index.php">Home</a>
            </li>
        </ul>
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link active" href="login.php">Login</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="register.php">Register</a>
            </li>
        </ul>
    </div>
</nav>
<div class="container">
    <h2 class="text-center mt-5">Login</h2>
    <form action="login_action.php" method="post" class="p-3">
        {if $message}
            <div class="row d-flex justify-content-center">
                <div class="col-sm-9 alert alert-danger text-center" role="alert">
                    {$message}
                </div>
            </div>
        {/if}
        <div class="form-group row d-flex justify-content-center {if !$message}mt-5{/if} mt-4">
            <label class="col-sm-1 col-form-label" for="inputEmail">Email</label>
            <div class="col-sm-6">
                <input class="form-control" id="inputEmail" placeholder="Email" type="email" name="user_email"
                       value="{$user_email}">
            </div>
        </div>
        <div class="form-group row d-flex justify-content-center">
            <label class="col-sm-1 col-form-label" for="inputPassword">Password</label>
            <div class="col-sm-6">
                <input class="form-control" id="inputPassword" placeholder="Password" type="password" name="user_pass">
            </div>
        </div>
        <div class="form-group row d-flex justify-content-end">
            <div class="col-sm-7">
                <input class="ml-3 mr-1" id="rememberMe" type="checkbox" name="auto_login" value="1">
                <label class="pr-5" for="rememberMe">Remember Me</label>
                <a class="pl-5" href="password_reset.php">Forgot password?</a>
            </div>
        </div>
        <div class="form-group row d-flex justify-content-center mb-5">
            <div class="col-sm-1" style="padding: 0">
                <button class="btn btn-primary px-4" type="submit">Login</button>
            </div>
        </div>
    </form>
</div>
<br><br>
<footer class="page-footer py-4 bg-dark text-white row m-0">
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
