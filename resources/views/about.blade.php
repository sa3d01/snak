<!doctype html>
<html class="no-js" lang="">

<head>
  <meta charset="utf-8">
  <title></title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <meta property="og:title" content="">
  <meta property="og:type" content="">
  <meta property="og:url" content="">
  <meta property="og:image" content="">

  <link rel="manifest" href="site.webmanifest">
  <link rel="apple-touch-icon" href="icon.png">
  <!-- Place favicon.ico in the root directory -->

  <link rel="stylesheet" href="css/main.css">

  <meta name="theme-color" content="#FFECCE">
</head>

<body>
  <div class="text-center">
    <h1>About snackyards</h1>

      <a href="{{route('home')}}">
          <img src="images/snackyards-logo.png" class="logo text-center" alt="snackyards-logo">
      </a>
{{--    <img src="images/snackyards-logo.png" class="logo text-center text-center" alt="snackyards-logo">--}}
  </div>

  <div class="content">
    <p>
        {{\App\Setting::value('about')['ar']}}
    </p>
  </div>

  <div class="row  app-store-container">
    <a href='{{\App\Setting::value('app_links')['android']}}'>
      <img
        height="50"
        alt='Get it on Google Play'
        src='images/google-play.png'/>
    </a>

    <a href='{{\App\Setting::value('app_links')['ios']}}'>
      <img
          height="50"
          alt='Get it on app store'
          src='images/Download_on_the_App_Store_Badge_US-UK_RGB_blk_092917.svg'/>
    </a>


    <div class="nav-links">
        <a href='{{route('about')}}'>
            About
        </a>
        <a href='{{route('privacy')}}'>
            Privacy
        </a>
    </div>
  </div>


  <!-- Google Analytics: change UA-XXXXX-Y to be your site's ID. -->
  <script>
    window.ga = function () { ga.q.push(arguments) }; ga.q = []; ga.l = +new Date;
    ga('create', 'UA-XXXXX-Y', 'auto'); ga('set', 'anonymizeIp', true); ga('set', 'transport', 'beacon'); ga('send', 'pageview')
  </script>
  <script src="https://www.google-analytics.com/analytics.js" async></script>
</body>

</html>
