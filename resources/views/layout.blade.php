<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Font -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600%7CUbuntu:300,400,500,700" rel="stylesheet">

    <!-- CSS -->
    <link rel="stylesheet" href="/default/css/bootstrap-reboot.min.css">
    <link rel="stylesheet" href="/default/css/bootstrap-grid.min.css">
    <link rel="stylesheet" href="/default/css/owl.carousel.min.css">
    <link rel="stylesheet" href="/default/css/jquery.mCustomScrollbar.min.css">
    <link rel="stylesheet" href="/default/css/nouislider.min.css">
    <link rel="stylesheet" href="/default/css/ionicons.min.css">
    <link rel="stylesheet" href="/default/css/plyr.css">
    <link rel="stylesheet" href="/default/css/photoswipe.css">
    <link rel="stylesheet" href="/default/css/default-skin.css">
    <link rel="stylesheet" href="/default/css/main.css">

    <!-- Favicons -->
    <link rel="icon" type="image/png" href="/default/icon/favicon-32x32.png" sizes="32x32">
    <link rel="apple-touch-icon" href="/default/icon/favicon-32x32.png">
    <link rel="apple-touch-icon" sizes="72x72" href="/default/icon/apple-touch-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="114x114" href="/default/icon/apple-touch-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="144x144" href="/default/icon/apple-touch-icon-144x144.png">
    <script src="/default/js/jquery-3.3.1.min.js"></script>

    <!-- JavaScript -->
    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
    <!--  -----------------------Alertfy------------------------------------- -->
    <!-- CSS -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>
    <!-- Default theme -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/default.min.css"/>
    <!-- Semantic UI theme -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/semantic.min.css"/>
    <!-- Bootstrap theme -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/bootstrap.min.css"/>
    <!--  -----------------------Alertfy------------------------------------- -->

    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="Dmitry Volkov">
    <title>BayTekSis Sinema Otomasyonu</title>

</head>
<body class="body">

<!-- header -->
<header class="header">
    <div class="header__wrap">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="header__content">
                        <!-- header logo -->
                        <a href="/" class="header__logo">
                            <img src="/default/img/logo.svg" alt="">
                        </a>
                        <!-- end header logo -->

                        <!-- header nav -->
                        <ul class="header__nav">
                            <!-- dropdown -->
                            <li class="header__nav-item">
                                <a href="/" class="header__nav-link">Anasayfa</a>
                            </li>
                            <!-- end dropdown -->
                            <li class="header__nav-item">
                                <a href="/filmler" class="header__nav-link">Filmler</a>
                            </li>
                            <!-- dropdown -->
                            <!-- end dropdown -->



                            <!-- dropdown -->
                            <!-- end dropdown -->
                        </ul>
                        <!-- end header nav -->

                        <!-- header auth -->
                        <div class="header__auth">
                            <button class="header__search-btn" type="button">
                                <i class="icon ion-ios-search"></i>
                            </button>



                            <a href="/login" class="header__sign-in">
                                <i class="icon ion-ios-log-in"></i>
                                <span>Giriş Yap</span>
                            </a>

                        </div>
                        <!-- end header auth -->

                        <!-- header menu btn -->
                        <button class="header__btn" type="button">
                            <span></span>
                            <span></span>
                            <span></span>
                        </button>
                        <!-- end header menu btn -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- header search -->
    <form action="#" class="header__search">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="header__search-content">
                        <input type="text" placeholder="Search for a movie, TV Series that you are looking for">

                        <button type="button">search</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <!-- end header search -->
</header>
<!-- end header -->

<!-- home -->
@yield('index')
@yield('detail')
@yield('films')
@yield('login')
@yield('register')
<!-- end home -->

<!-- content -->
<!-- end content -->

<!-- expected premiere -->
<!-- end expected premiere -->

<!-- partners -->
<!-- end partners -->

<!-- footer -->
<footer class="footer">
    <div class="container">
        <div class="row">

            <!-- footer list -->
            <div class="col-12 col-md-12">
                <a target="_blank" href="https://bayteksis.com/"><h1  style="font-size: 25px;text-align: center;color: whitesmoke"> BAYTEKSİS</h1></a>
            </div>
            <!-- end footer list -->

            <!-- footer list -->
            <!-- end footer list -->

            <!-- footer list -->
            <!-- end footer list -->

            <!-- footer list -->
            <!-- end footer list -->

            <!-- footer copyright -->
            <!-- end footer copyright -->
        </div>
    </div>
</footer>
<!-- end footer -->

<!-- JS -->
<script src="/default/js/bootstrap.bundle.min.js"></script>
<script src="/default/js/owl.carousel.min.js"></script>
<script src="/default/js/jquery.mousewheel.min.js"></script>
<script src="/default/js/jquery.mCustomScrollbar.min.js"></script>
<script src="/default/js/wNumb.js"></script>
<script src="/default/js/nouislider.min.js"></script>
<script src="/default/js/plyr.min.js"></script>
<script src="/default/js/jquery.morelines.min.js"></script>
<script src="/default/js/photoswipe.min.js"></script>
<script src="/default/js/photoswipe-ui-default.min.js"></script>
<script src="/default/js/main.js"></script>
@if(session()->has('success'))
    <script>alertify.success('{{session('success')}}')</script>
@endif

@if(session()->has('error'))
    <script>alertify.error('{{session('error')}}')</script>
@endif
@foreach($errors->all() as $error)
    <script>
        alertify.error('{{$error}}')
    </script>
@endforeach
</body>

</html>
