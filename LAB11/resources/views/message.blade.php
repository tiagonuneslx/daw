<!doctype html>
<html lang="pt-pt">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1, shrink-to-fit=no" name="viewport">
    <meta http-equiv="refresh" content="5; url={{action("Store@index")}}"/>

    <!-- Bootstrap CSS -->
    <link crossorigin="anonymous" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" rel="stylesheet">

    <title>TechTo - {{$message}}</title>
</head>
<body>
<div class="content">
    <div class="row d-flex justify-content-center">
        <div class="col-sm-9 alert alert-warning text-center m-3" role="alert">
            {{$message}}
        </div>
        <small>Deverá ser redirecionado para a página principal em poucos segundos. Senão, clique
            <a href="{{action("Store@index")}}">aqui</a>
        </small>
    </div>
</div>
</body>