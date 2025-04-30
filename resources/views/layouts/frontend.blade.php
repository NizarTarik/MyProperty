<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8" />
    <meta name="description" content="Ogani Template" />
    <meta name="keywords" content="Ogani, unica, creative, html" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>My Property</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;600;900&display=swap"
        rel="stylesheet" />

    <!-- Css Styles -->
    <link rel="stylesheet" href="{{ asset('frontend/css/bootstrap.min.css') }}" type="text/css" />
    <link rel="stylesheet" href="{{ asset('frontend/css/font-awesome.min.css') }}" type="text/css" />
    <link rel="stylesheet" href="{{ asset('frontend/css/elegant-icons.css') }}" type="text/css" />
    <link rel="stylesheet" href="{{ asset('frontend/css/nice-select.css') }}" type="text/css" />
    <link rel="stylesheet" href="{{ asset('frontend/css/jquery-ui.min.css') }}" type="text/css" />
    <link rel="stylesheet" href="{{ asset('frontend/css/owl.carousel.min.css') }}" type="text/css" />
    <link rel="stylesheet" href="{{ asset('frontend/css/slicknav.min.css') }}" type="text/css" />
    <link rel="stylesheet" href="{{ asset('frontend/css/style.css') }}" type="text/css" />
</head>

<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    <!-- Humberger Begin -->
    <div class="humberger__menu__overlay"></div>
    <div class="humberger__menu__wrapper">
        <div class="humberger__menu__logo">
            <a href="#"><img src="{{ asset('frontend/img/logo.png') }}" alt="" /></a>
        </div>
        <div class="humberger__menu__cart">
            <div class="header__cart__price"></div>
        </div>
        <div class="humberger__menu__widget">
            @guest
                <div class="header__top__right__language">
                    <div class="header__top__right__auth">
                        <a href="{{ route('login') }}"><i class="fa fa-user"></i> Login</a>
                    </div>
                </div>
                <div class="header__top__right__auth" style="margin-left: 20px">
                    <a href="{{ route('register') }}"><i class="fa fa-user"></i> Register</a>
                </div>
            @else
                <div class="header__top__right__language">
                    <div class="header__top__right__auth">
                        <a href=""><i class="fa fa-user"></i> {{ auth()->user()->username }}</a>
                    </div>
                </div>
                <div class="header__top__right__auth" style="margin-left: 20px">
                    <a href="#" onclick="event.preventDefault();document.getElementById('logout-form').submit();"><i
                            class="fa fa-user"></i> Logout</a>
                    <form action="{{ route('logout') }}" id="logout-form" method="post">
                        @csrf
                    </form>
                </div>
            @endguest
        </div>
        <nav class="humberger__menu__nav mobile-menu">
            <ul>
                <li @if (request()->route()->named('homepage')) class="active" @endif>
                    <a href="/">Home</a>
                </li>
                <li @if (request()->route()->named('properties')) class="active" @endif>
                    <a href="{{ route('properties') }}">Properties</a>
                </li>
                <li>
                    <a href="{{ route('aboutUs') }}">About us</a>
                </li>

                <li><a href="#">Contact Us</a></li>
            </ul>
        </nav>
        <div id="mobile-menu-wrap"></div>
        <div class="header__top__right__social">
            <a href="#"><i class="fa fa-facebook"></i></a>
            <a href="#"><i class="fa fa-twitter"></i></a>
            <a href="#"><i class="fa fa-linkedin"></i></a>
            <a href="#"><i class="fa fa-pinterest-p"></i></a>
        </div>
        <div class="humberger__menu__contact">
            <ul>
                <li><i class="fa fa-envelope"></i>@auth
                        {{ auth()->user()->email }}
                    @endauth



                </li>
                <li>Find All Properties and Apartment you need now!</li>
            </ul>
        </div>
    </div>
    <!-- Humberger End -->

    <!-- Header Section Begin -->
    <header class="header">
        <div class="header__top">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <div class="header__top__left">
                            <ul>
                                <li><i class="fa fa-envelope"></i>@auth
                                        {{ auth()->user()->email }}
                                    @endauth
                                </li>
                                <li>Find All Properties and Apartment you need now!</li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        @guest
                            <div class="header__top__right">
                                <div class="header__top__right__language header__top__right__auth">
                                    <a class="d-inline" href="{{ route('login') }}"><i class="fa fa-user"></i> Login</a>
                                </div>
                                <div class="header__top__right__auth">
                                    <a href="{{ route('register') }}"><i class="fa fa-user"></i> Register</a>
                                </div>
                            </div>
                        @else
                            <div class="header__top__right">
                                <div class="header__top__right__language header__top__right__auth">
                                    <a class="d-inline" href="#"><i class="fa fa-user"></i>
                                        {{ auth()->user()->username }}</a>

                                </div>
                                <div class="header__top__right__auth">
                                    <a href="#"
                                        onclick="event.preventDefault();document.getElementById('logout-form').submit()"><i
                                            class="fa fa-user"></i> Logout</a>
                                    <form action="{{ route('logout') }}" id="logout-form" method="post">
                                        @csrf
                                    </form>
                                </div>
                            </div>
                        @endguest
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="header__logo">
                        <a href="/"><img src="{{ asset('frontend/img/logo.jpeg') }}" width="160"
                                alt="" /></a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <nav class="header__menu">
                        <ul>
                            <li @if (request()->route()->named('homepage')) class="active" @endif><a href="/">Home</a></li>
                            <li @if (request()->route()->named('properties')) class="active" @endif><a
                                    href="{{ route('properties') }}">Properties</a></li>
                            <li @if (request()->route()->named('showBookMark')) class="active" @endif><a
                                    href="{{ route('showBookMark') }}">Book
                                    Marks</a>
                            </li>
                            <li>
                                <a href="{{ route('aboutUs') }}">About us </a>

                            </li>



                        </ul>
                    </nav>
                </div>
                <div class="col-lg-3">
                    <div class="header__cart">
                        <ul>
                            <li>


                                <a href="{{ empty(auth()->user()->id)
                                    ? route('register')
                                    : (auth()->user()->isOwner
                                        ? route('postProperty')
                                        : route('becomeOwner')) }}"
                                    class="primary-btn">
                                    {{ empty(auth()->user()->id) ? 'Become A Seller' : (auth()->user()->isOwner ? 'Sell A Property' : 'Become A Seller') }}
                                </a>



                            </li>






                            </li>

                        </ul>
                        <div class="header__cart__price"></div>
                    </div>
                </div>
            </div>
            <div class="humberger__open">
                <i class="fa fa-bars"></i>
            </div>
        </div>
    </header>
    <!-- Header Section End -->

    <!-- Hero Section Begin -->
    <section class="hero">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="hero__search">
                        <!--<div class="hero__search__form">
                            <form action="#">
                                <input type="text" placeholder="Enter Your Email" />
                                <button type="submit" class="site-btn">Contact Us</button>
                            </form>-->
                        @auth

                            @if (auth()->user()->isOwner)
                                <a href="{{ route('showMyPostedProperties', ['ownerId' => auth()->user()->id]) }}"
                                    class="site-btn">My Posted Properties</a>
                            @endif

                        @endauth

                    </div>


                </div>
            </div>
        </div>
        </div>
    </section>
    <!-- Hero Section End -->

    @yield('content')

    <!-- Footer Section Begin -->
    <footer class="footer spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="footer__about">
                        <div class="footer__about__logo">
                            <a href="/"><img src="{{ asset('frontend/img/logo.jpeg') }}" alt=""
                                    width="120" /></a>
                        </div>
                        <ul>
                            <li>Address: Bayti Sakan IM 89 APT 3 Témara, Marokko
                            </li>
                            <li>Email: nizartarik994@gmail.com</li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 offset-lg-1">
                    <div class="footer__widget">
                        <h6>Useful Links</h6>
                        <ul>
                            <li><a href="#">About Us</a></li>
                        </ul>

                    </div>
                </div>
                <div class="col-lg-4 col-md-12">
                    <div class="footer__widget">


                        <div class="hero__search__phone">
                            <div class="hero__search__phone__icon">
                                <i class="fa fa-phone"></i>
                            </div>
                            <div class="hero__search__phone__text">
                                <h5>+212 642621383</h5>
                            </div>
                        </div>
                        <div class="footer__widget__social">
                            <a href="#"><i class="fa fa-facebook"></i></a>
                            <a href="#"><i class="fa fa-instagram"></i></a>
                            <a href="#"><i class="fa fa-twitter"></i></a>
                            <a href="#"><i class="fa fa-pinterest"></i></a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </footer>

    <script src="{{ asset('frontend/js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('frontend/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('frontend/js/jquery.nice-select.min.js') }}"></script>
    <script src="{{ asset('frontend/js/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('frontend/js/jquery.slicknav.js') }}"></script>
    <script src="{{ asset('frontend/js/mixitup.min.js') }}"></script>
    <script src="{{ asset('frontend/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('frontend/js/main.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>
</body>

</html>
