
<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-100">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.87.0">
    <title>{{ config('app.name', 'Message card App') }}</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.1/examples/sticky-footer-navbar/">
  
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script&family=Raleway:wght@100&display=swap" rel="stylesheet">
    

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="{{ asset( 'css/app.css' ) }}">


    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
/* 
      li{
        display: inline;
      } */
      
    </style>

    
    <!-- Custom styles for this template -->
    <link href="sticky-footer-navbar.css" rel="stylesheet">
  </head>
  <body class="d-flex flex-column h-100" style="color:#777571; background-color:#FDF2E9;">
    
<header>
  <!-- Fixed navbar -->
  <nav class="navbar navbar-expand-md navbar-light fixed-top" style="background-color:#FADBD8">
    <div class="container-fluid">
      <a class="navbar-brand" href="#" style="color:#777571;">Message card App</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav me-auto mb-2 mb-md-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#">Corporate use</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Personal use</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Privacy Policy</a>
          </li>
          <li class="nav-item dropdown rightli" style="float:right">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Language
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="/en">English</a>
              <a class="dropdown-item" href="/ja">Japanese</a>
              {{--<div class="dropdown-divider"></div>
              <a class="dropdown-item" href="#">Something else here</a>--}}
            </div>
          </li>
        </ul>
      </div>
    </div>
  </nav>
</header>

<!-- Begin page content -->
<main class="flex-shrink-0">
  <div class="container mt-5 pt-5">
  @yield('content')
  </div>
</main>

<footer class="footer mt-auto py-3" style="background-color: #FADBD8">
  <div class="container">
    <span class="text-muted">2021</span>
  </div>
</footer>

<script src="{{ asset( 'js/app.js' ) }}" defer></script>
      
  </body>
</html>
