<!doctype html>

<html lang="en">
<head>
  <meta charset="utf-8">

  <title>ZoneMinder - @yield('title')</title>
  <meta name="description" content="The HTML5 Herald">
  <meta name="author" content="SitePoint">

  <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700|Lobster+Two" rel="stylesheet">
  <link rel="stylesheet" href="css/app.css?v=1.0">

  <!--[if lt IE 9]>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.js"></script>
  <![endif]-->
</head>

<body>
    <div class="container">
        <div id="app">
        
            
            @include('components/sidebar')

            <div id="content" class="">
                <div class="title-bar">
                    <h1>@yield('title')</h1>
                </div>
                @yield('content')
            </div>

            <div id="rightbar">
                <div class="title-bar">
                    <span class="app-name">Argus</span> <span class="app-version">v1.0</span>
                </div>

            </div>
        </div>
    </div>
  <!--<script src="js/scripts.js"></script>-->
</body>
</html>