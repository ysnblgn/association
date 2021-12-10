<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="{{$description}}">
    <meta name="author" content="">

    <title>@yield('title')</title>

    <!-- Bootstrap core CSS -->
    <link href="/frontend/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="/frontend/css/modern-business.css" rel="stylesheet">

    <style>
        .dropdown:hover .dropdown-menu{
            display: block;
        }
        .dropdown-menu{
            margin-top: 0;
        }
    </style>
    <script>
        $(document).ready(function(){
            $(".dropdown").hover(function(){
                var dropdownMenu = $(this).children(".dropdown-menu");
                if(dropdownMenu.is(":visible")){
                    dropdownMenu.parent().toggleClass("open");
                }
            });
        });
    </script>
</head>

<body>

<!-- Navigation -->

<nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark fixed-top">

    <div class="container">


        <a class="navbar-brand" href="{{route('home.Index')}}">YB YAZILIM DERNEK PROJESİ</a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse"
                data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false"
                aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{route('home.Index')}}">Anasayfa</a>
                </li>
                <li class="nav-item active dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                        <span data-hover="Hakkımızda">Hakkımızda</span>
                    </a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownBlog">
                        @foreach($data['about'] as $about)
                            @if($about->about_slug == "about title 03" )
                                <a class="dropdown-item" href="{{route('about.Detail',$about->about_slug)
                        }}">{{$about->about_title}}</a>
                            @endif
                            <a class="dropdown-item" href="{{route('about.Detail',$about->about_slug)
                        }}">{{$about->about_title}}</a>
                        @endforeach
                    </div>
                </li>



                <li class="nav-item">
                    <a class="nav-link" href="{{route('activity.Index')}}">Etkinliklerimiz</a>
                </li>

{{--                @auth('user_role'== ['yönetici','üye'])--}}
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('contact.Detail')}}">İletişim</a>
                    </li>
{{--                @endauth--}}

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>
                <ul class="navbar-nav ml-auto">
                    <!-- Authentication Links -->
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">Giriş Yap</a>
                        </li>
                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">Kayıt Ol</a>
                            </li>
                        @endif
                    @else


                        <li class="nav-item dropdown">
                            <a href="{{route('home.Index')}}" class="nav-link dropdown-toggle" data-toggle="dropdown">
                                <span data-hover="">{{ Auth::user()->name }}</span>
                            </a>


                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{route('fee.Index',Auth::user()->id)}}">
                                    Aidat Sorgulama
                                </a>

                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    Çıkış Yap
                                </a>


                                <form id="logout-form" action="{{ route('logout')}}" method="POST" style="display:
                                none;" >
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                </ul>
                </div>
            </ul>
        </div>

    </div>
</nav>

@yield('content')

<!-- Footer -->
<footer class="py-5 bg-dark">
    <div class="container">
        <p class="m-0 text-center text-white">{{$footer}}</p>
    </div>
    <!-- /.container -->
</footer>

<!-- Bootstrap core JavaScript -->
<script src="/frontend/vendor/jquery/jquery.min.js"></script>
<script src="/frontend/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="/js/custom.js"></script>
</body>

</html>
