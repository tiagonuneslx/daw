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
                <li><a href="{{action("Store@orders")}}"><i class="fa fa-user-o"></i> Histórico de encomendas</a>
                </li>
                <li><a href="{{action("Store@logout")}}"><i class="fa fa-sign-out"></i>Logout</a></li>
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
                                    <a href="{{action("Store@checkout")}}">Checkout <i
                                                class="fa fa-arrow-circle-right"></i></a>
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

<!-- SECTION -->
<div class="section">
    <!-- container -->
    <div class="container" style="margin-bottom: 25px">
        <div class="row center-block">
            <div class="section-title text-center">
                <h3 class="title">Histórico de Encomendas</h3>
            </div>
        </div>
    </div>
    @foreach($orders as $key=>$order)
        <div class="container" style="margin-bottom: 30px">
            <!-- row -->
            <div class="row center-block">
                <!-- Order Details -->
                <div class="center-block order-details" style="margin: 0 300px">
                    <div class="section-title text-center">
                        <h3 class="title">{{count($orders) - $key}}ª Encomenda: {{$order->created_at}}</h3>
                    </div>
                    <div class="order-summary">
                        <div class="order-col">
                            <div><strong>PRODUTO</strong></div>
                            <div><strong>TOTAL</strong></div>
                        </div>
                        <div class="order-products">
                            @foreach($order->items as $product)
                                <div class="order-col">
                                    <div>{{$product->quantity}}x {{$product->name}}</div>
                                    <div>{{$product->price * $product->quantity}}€</div>
                                </div>
                            @endforeach
                        </div>
                        <div class="order-col">
                            <div>Portes</div>
                            <div><strong>GRÁTIS</strong></div>
                        </div>
                        <div class="order-col">
                            <div><strong>TOTAL</strong></div>
                            <div><strong
                                        class="order-total">{{empty($order->items) ? 0 : array_reduce($order->items, function($carry, $product){return $carry + $product->price * $product->quantity;})}}
                                    €</strong></div>
                        </div>
                    </div>
                </div>
                <!-- /Order Details -->
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    @endforeach
</div>
<!-- /SECTION -->

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
                            <li><a href="{{action("Store@orders")}}">Histórico de encomendas</a></li>
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
