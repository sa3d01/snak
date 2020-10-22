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
    <p>We are an online food ordering service for school students you can place your order with an option of online payment or cash on delivery. We offer our services through desktops and mobile apps for iPhone, Android, iPad and windows.</p>

    <p>Snackyards was founded in 2020 by a group of young entrepreneurs who took advantage of the online food ordering opportunity that existed in the Egypt market. later, we became a pioneer in the online food ordering service in the region.</p>

    <p>We are based in Egypt operating across 7 countries: Egypt, Kingdom of Saudi Arabia, United Arab Emirates, Oman, Bahrain, Qatar and Jordan.</p>

      <p>Our main aim is to become and remain the market leader in the MENA region by diversifying our services portfolio and providing best-in-class customer experience.;</p>
  </div>

  <div class="row  app-store-container">
    <a href='https://play.google.com/store/?pcampaignid=pcampaignidMKT-Other-global-all-co-prtnr-py-PartBadge-Mar2515-1'>
      <img
        height="50"
        alt='Get it on Google Play'
        src='images/google-play.png'/>
    </a>

    <a href='https://www.apple.com/shop'>
      <img height="50"
      alt='Get it on Google Play' src='images/Download_on_the_App_Store_Badge_US-UK_RGB_blk_092917.svg'/>
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
