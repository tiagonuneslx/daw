<!DOCTYPE html>
<html lang="pt-pt">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <title>TechTo - Portáteis</title>

    <!-- Google font -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,700" rel="stylesheet">

    <!-- Bootstrap -->
    <link type="text/css" rel="stylesheet" href="{{url("assets/css/bootstrap.min.css")}}"/>

    <!-- Slick -->
    <link type="text/css" rel="stylesheet" href="{{url("assets/css/slick.css")}}"/>
    <link type="text/css" rel="stylesheet" href="{{url("assets/css/slick-theme.css")}}"/>

    <!-- nouislider -->
    <link type="text/css" rel="stylesheet" href="{{url("assets/css/nouislider.min.css")}}"/>

    <!-- Font Awesome Icon -->
    <link rel="stylesheet" href="{{url("assets/css/font-awesome.min.css")}}">

    <!-- Custom stlylesheet -->
    <link type="text/css" rel="stylesheet" href="{{url("assets/css/style.css")}}"/>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <style>
        .hoverable:hover {
            cursor: pointer;
        }
    </style>

</head>
<body>
<!-- HEADER -->
<header>
    <!-- TOP HEADER -->
    <div id="top-header">
        <div class="container">
            <ul class="header-links pull-left">
                <li><a href="#"><i class="fa fa-phone"></i> +351 934 014 801</a></li>
                <li><a href="#"><i class="fa fa-envelope-o"></i> suporte@techto.com</a></li>
                <li><a href="#"><i class="fa fa-map-marker"></i> 1734 Rua Loures</a></li>
            </ul>
            <ul class="header-links pull-right">
                <li><a href="{{action("Store@login")}}"><i class="fa fa-user-o"></i> Entrar</a></li>
                <li><a href="{{action("Store@register")}}"><i class="fa fa-user-circle-o"></i> Criar conta</a></li>
            </ul>
        </div>
    </div>
    <!-- /TOP HEADER -->

    <!-- MAIN HEADER -->
    <div id="header">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <!-- LOGO -->
                <div class="col-md-3">
                    <div class="header-logo">
                        <a href="{{action("Store@index")}}" class="logo">
                            <img src="{{url("assets/img/logo.png")}}" alt="" height="35" style="margin-top: 15px">
                        </a>
                    </div>
                </div>
                <!-- /LOGO -->

                <!-- ACCOUNT -->
                <div class="col-md-auto clearfix">
                    <div class="header-ctn">

                        <!-- Cart -->
                        <div class="dropdown">
                            <a class="dropdown-toggle hoverable" data-toggle="dropdown" aria-expanded="true">
                                <i class="fa fa-shopping-cart"></i>
                                <span>Seu Carrinho</span>
                                @if(!empty($cart))
                                    <div class="qty">{{count($cart)}}</div>@endif
                            </a>
                            <div class="cart-dropdown">
                                <div class="cart-list">
                                    @foreach($cart as $product)
                                        <div class="product-widget">
                                            <div class="product-img">
                                                <img src="{{url("assets/img/$product->image")}}" alt="">
                                            </div>
                                            <div class="product-body">
                                                <h3 class="product-name">{{$product->name}}</h3>
                                                <h4 class="product-price"><span
                                                            class="qty">{{$product->quantity}}x</span>{{$product->price}}
                                                    €
                                                </h4>
                                            </div>
                                            <a href="{{action("Store@cartItemRemove", ["id" => $product->id])}}">
                                                <button class="delete"><i class="fa fa-close"></i></button>
                                            </a>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="cart-summary">
                                    <small>{{count($cart)}} Item(s) selecionados</small>
                                    <h5>
                                        TOTAL: {{empty($cart) ? 0 : array_reduce($cart, function($carry, $product){return $carry + $product->price * $product->quantity;})}}
                                        €</h5>
                                </div>
                                <div class="cart-btns">
                                    <a href="{{action("Store@cartRemove")}}">Limpar</a>
                                    <a href="{{action("Store@checkout")}}">Checkout <i class="fa fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                        </div>
                        <!-- /Cart -->
                    </div>
                </div>
                <!-- /ACCOUNT -->
            </div>
            <!-- row -->
        </div>
        <!-- container -->
    </div>
    <!-- /MAIN HEADER -->
</header>
<!-- /HEADER -->

<div class="section" style="margin-bottom: 40px">
    <div class="container">
        <h2 class="text-center" style="margin: 20px 0">Entrar</h2>
        <form action="{{action("Store@loginAction")}}" method="post" class="p-2 mb-4"
              style="margin-left: 120px; text-align: right">
            {{csrf_field()}}
            @if (count($errors))
                <div class="row d-flex justify-content-center" style="margin-left: 100px;">
                    <div class="col-sm-9 alert alert-danger text-center" role="alert">
                        {{$errors->first()}}
                    </div>
                </div>
            @endif
            <div class="form-group row d-flex justify-content-center">
                <label class="col-sm-2 col-form-label" for="inputEmail">Email</label>
                <div class="col-sm-7">
                    <input class="form-control" id="inputEmail" placeholder="Email" type="email" name="email"
                           value="{{old('email')}}">
                </div>
            </div>
            <div class="form-group row d-flex justify-content-center">
                <label class="col-sm-2 col-form-label" for="inputPassword">Password</label>
                <div class="col-sm-7">
                    <input class="form-control" id="inputPassword" placeholder="Password" type="password"
                           name="password">
                </div>
            </div>
            <div style="margin-left: 160px">
                <div class="col-sm-1" style="margin-right: 18px; text-align: center">
                    <button class="btn btn-primary px-4" type="submit">Entrar</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- FOOTER -->
<footer id="footer">
    <!-- top footer -->
    <div class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <div class="col-md-3 col-xs-6">
                    <div class="footer">
                        <h3 class="footer-title">Sobre nós</h3>
                        <p>Somos só uma loja de eletrónica.</p>
                        <ul class="footer-links">
                            <li><a href="#"><i class="fa fa-map-marker"></i>1734 Rua Loures</a></li>
                            <li><a href="#"><i class="fa fa-phone"></i>+351 934 014 801</a></li>
                            <li><a href="#"><i class="fa fa-envelope-o"></i>suporte@techto.com</a></li>
                        </ul>
                    </div>
                </div>

                <div class="col-md-3 col-xs-6">
                    <div class="footer">
                        <h3 class="footer-title">Categorias</h3>
                        <ul class="footer-links">
                            @foreach($categories as $category)
                                <li><a href="{{action("Store@index", ['id' => $category->id])}}">{{$category->name}}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>

                <div class="clearfix visible-xs"></div>

                <div class="col-md-3 col-xs-6">
                    <div class="footer">
                        <h3 class="footer-title">Serviços</h3>
                        <ul class="footer-links">
                            <li><a href="{{action("Store@checkout")}}">Ver carrinho</a></li>
                            <li><a href="{{action("Store@login")}}">Entrar</a></li>
                            <li><a href="{{action("Store@register")}}">Criar conta</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /top footer -->

    <!-- bottom footer -->
    <div id="bottom-footer" class="section">
        <div class="container">
            <!-- row -->
            <div class="row">
                <div class="col-md-12 text-center">
                    <span class="copyright">
								<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
								Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i
                                class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com"
                                                                                    target="_blank">Colorlib</a>
                        <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
							</span>
                </div>
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /bottom footer -->
</footer>
<!-- /FOOTER -->

<!-- jQuery Plugins -->
<script src="{{url("assets/js/jquery.min.js")}}"></script>
<script src="{{url("assets/js/bootstrap.min.js")}}"></script>
<script src="{{url("assets/js/slick.min.js")}}"></script>
<script src="{{url("assets/js/nouislider.min.js")}}"></script>
<script src="{{url("assets/js/jquery.zoom.min.js")}}"></script>
<script src="{{url("assets/js/main.js")}}"></script>
</body>
</html>
