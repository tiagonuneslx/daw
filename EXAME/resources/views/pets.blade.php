<!DOCTYPE html>
<html lang="zxx" class="no-js">
<head>
    <!-- Mobile Specific Meta -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Favicon-->
    <link rel="shortcut icon" href="{{asset("assets/img/fav.png")}}">
    <!-- Author Meta -->
    <meta name="author" content="codepixer">
    <!-- Meta Description -->
    <meta name="description" content="">
    <!-- Meta Keyword -->
    <meta name="keywords" content="">
    <!-- meta character set -->
    <meta charset="UTF-8">
    <!-- Site Title -->
    <title>Animal Shelter : pets</title>

    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,400,300,500,600,700" rel="stylesheet">
    <!--
    CSS
    ============================================= -->
    <link rel="stylesheet" href="{{asset("assets/css/linearicons.css")}}">
    <link rel="stylesheet" href="{{asset("assets/css/font-awesome.min.css")}}">
    <link rel="stylesheet" href="{{asset("assets/css/bootstrap.css")}}">
    <link rel="stylesheet" href="{{asset("assets/css/magnific-popup.css")}}">
    <link rel="stylesheet" href="{{asset("assets/css/nice-select.css")}}">
    <link rel="stylesheet" href="{{asset("assets/css/animate.min.css")}}">
    <link rel="stylesheet" href="{{asset("assets/css/owl.carousel.css")}}">
    <link rel="stylesheet" href="{{asset("assets/css/main.css")}}">
</head>
<body>
<header id="header" id="home">
    <div class="container main-menu">
        <div class="row align-items-center justify-content-between d-flex">
            <div id="logo">
                <a href="{{action('Shelter@home')}}"><img src="{{asset("assets/img/logo.png")}}" alt="" title=""/></a>
            </div>
            <nav id="nav-menu-container">
                <ul class="nav-menu">
                    <li><a href="{{action('Shelter@pets')}}">All</a>
                    </li>
                    @foreach($categories as $category)
                        <li><a href="{{action('Shelter@pets', ['cat_id' => $category->id])}}">{{$category->name}}</a>
                        </li>
                    @endforeach
                    @if($user_id)
                        <li><a href="{{action('Shelter@mypets')}}">My pets</a></li>
                        <li><a href="{{action('Shelter@logout')}}">Logout</a></li>
                        <li><a href="">Welcome {{$user_name}}</a></li>
                    @else
                        <li><a href="{{action('Shelter@register')}}">Register</a></li>
                        <li><a href="{{action('Shelter@login')}}">Login</a></li>
                    @endif
                </ul>
            </nav><!-- #nav-menu-container -->
        </div>
    </div>
</header><!-- #header -->

<!-- start banner Area -->
<section class="banner-area relative" id="home">
    <div class="overlay overlay-bg"></div>
    <div class="container">
        <div class="row d-flex align-items-center justify-content-center">
            <div class="about-content col-lg-12">
                <h1 class="text-white">
                    @if($cat_id)
                        {{array_first(array_filter($categories, function($category) use($cat_id) {return $category->id === $cat_id;}))->name}}
                    @else
                        All
                    @endif
                </h1>
            </div>
        </div>
    </div>
</section>
<!-- End banner Area -->

<!-- Start pet-list Area -->
<section class="cat-list-area section-gap">
    <div class="container">
        <div class="row">
            @if(empty($pets))
                <div class="text-center">
                    <p>All pets have been adopted 😊</p>
                </div>
            @endif
            @foreach($pets as $pet)
                <div class="col-lg-3 col-md-6">
                    <div class="single-cat-list">
                        <img src="{{asset("assets/img/$pet->image")}}" alt="" class="img-fluid">
                        <div class="overlay">
                            <div class="text">
                                <p>{{$pet->name}}</p>
                                @if($user_id)
                                    <p><a href="{{action('Shelter@adopt', ['pet_id' => $pet->id])}}"
                                          style="color: white"><u>Adopt me!</u></a></p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
<!-- End pet-list Area -->


<!-- start footer Area -->
<footer class="footer-area">
    <div class="copyright-text">
        <div class="container">
            <div class="row footer-bottom d-flex justify-content-between">
                <p class="col-lg-8 col-sm-6 footer-text m-0 text-white">
                    <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                    Copyright &copy;<script>document.write(new Date().getFullYear());</script>
                    All rights reserved | This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by
                    <a href="https://colorlib.com" target="_blank">Colorlib</a>
                    <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p>
                <div class="col-lg-4 col-sm-6 footer-social">
                    <a href="#"><i class="fa fa-facebook"></i></a>
                    <a href="#"><i class="fa fa-twitter"></i></a>
                    <a href="#"><i class="fa fa-dribbble"></i></a>
                    <a href="#"><i class="fa fa-behance"></i></a>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- End footer Area -->

<script src="{{asset("assets/js/vendor/jquery-2.2.4.min.js")}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
<script src="{{asset("assets/js/vendor/bootstrap.min.js")}}"></script>
<script type="text/javascript"
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBhOdIF3Y9382fqJYt5I_sswSrEw5eihAA"></script>
<script src="{{asset("assets/js/easing.min.js")}}"></script>
<script src="{{asset("assets/js/hoverIntent.js")}}"></script>
<script src="{{asset("assets/js/superfish.min.js")}}"></script>
<script src="{{asset("assets/js/jquery.ajaxchimp.min.js")}}"></script>
<script src="{{asset("assets/js/jquery.magnific-popup.min.js")}}"></script>
<script src="{{asset("assets/js/owl.carousel.min.js")}}"></script>
<script src="{{asset("assets/js/jquery.nice-select.min.js")}}"></script>
<script src="{{asset("assets/js/mail-script.js")}}"></script>
<script src="{{asset("assets/js/main.js")}}"></script>
</body>
</html>