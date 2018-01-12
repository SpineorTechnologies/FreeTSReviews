<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <meta name="robots" content="noindex,nofollow">
    <meta name="google-site-verification" content="hHaKf_2no3taPYfBJcx15_RO1r45pFGFq8lBL4-uJE0" />
    <link rel="shortcut icon" type="image/png" href="{{asset('images/ts-favicon.ico')}}"/>
    <title>@yield('title')</title>
    <!-- css -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/chosen.css') }}">
    <!-- Fonts -->
     <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <script src="https://use.fontawesome.com/0d04cdc9e3.js"></script>
    
  </head>
  <body>
    <main>
        @include('global/header')
        <div class="container">
          @yield('content')
        </div>  
        @include('global/footer')
    </main>  

    <script src="{{asset('js/jquery.min.js')}}"></script>
     <script src="{{ asset('js/bootstrap.min.js') }}"></script> 
    <script defer type="text/javascript" src="{{ asset('js/js.cookie.js')}}"></script>
    <script defer type="text/javascript" src="{{ asset('js/pu.js')}}"></script>
    <script async src="//a.chriver.com/www/delivery/asyncjs.php"></script>
    <!-- <script src="{{ asset('js/chosen.jquery.min.js') }}"></script>
     -->


    <script>
      (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
      (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
      m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
      })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');
      ga('create', 'UA-105103462-1', 'auto');
      ga('send', 'pageview');
    </script>
    <script defer  src="{{ asset('js/main.js') }}"></script> 
    <!-- Start of StatCounter Code for Default Guide -->
    <script type="text/javascript">
    var sc_project=11427818; 
    var sc_invisible=1; 
    var sc_security="50fd3c4b"; 
    var sc_https=1; 
    var scJsHost = (("https:" == document.location.protocol) ?
    "https://secure." : "http://www.");
    document.write("<sc"+"ript type='text/javascript' src='" +
    scJsHost+
    "statcounter.com/counter/counter.js'></"+"script>");
    </script>
    <noscript><div class="statcounter"><a title="free hit
    counter" href="http://statcounter.com/" target="_blank"><img
    class="statcounter"
    src="//c.statcounter.com/11427818/0/50fd3c4b/1/" alt="free
    hit counter"></a></div></noscript>
    <!-- End of StatCounter Code for Default Guide -->
    <style>
      div.ad-tile {
        text-align: center;
        margin-bottom: 20px;
      }
    </style>

  </body>
</html>
