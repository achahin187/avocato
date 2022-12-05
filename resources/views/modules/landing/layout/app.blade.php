<!DOCTYPE html>
<html lang="ar">
  <head>
    <!-- =====================================================-->
    <!-- ==================HEAD=============================-->
    <!-- =====================================================-->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="description" content="Vapulus">
    <meta name="keywords" content="Vapulus">
    <!-- =============== APP FAVICON ===============-->
    <link rel="apple-touch-icon" sizes="180x180" href="img/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="img/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="img/favicon/favicon-16x16.png">
    <link rel="manifest" href="img/favicon/manifest.json">
    <link rel="mask-icon" href="img/favicon/safari-pinned-tab.svg" color="#22b681">
    <meta name="msapplication-TileColor" content="#22b681">
    <meta name="msapplication-TileImage" content="/mstile-144x144.png">
    <meta name="theme-color" content="#1c5ba8">
    <!-- =============== APP TITLE ===============-->
    <title>Avocato</title>
    <!-- =============== APP STYLES ===============-->
    <link rel="stylesheet" href="{{asset('css/style__rtl.css')}}">
    <!-- =============== APP SCRIPT ===============-->
    <script src="js/modernizr.js"></script>
  </head>
  <body style="background:#f7f7f7 url( 'img/cover_bgs/dummy.jpg') no-repeat center center; background-size:cover;">
    <div class="layout_covered">
      <div class="wrapper">
        <!-- top navbar-->
        <header class="topnavbar-wrapper">
          <nav class="top-navbar navbar-expand-lg bgcolor--gray_m color--gray_d bradius--noborder bshadow--1 ">
            <div class="container-fluid">
              <div class="pull-left">
                <ul class="actionsbar">
                  <li><a href="#" style="color: #0084B4; font-size:16px;"><i class="fa fa-facebook"></i></a></li>
                  <li><a href="#" style="color: #3cf; font-size:16px;"><i class="fa fa-twitter"></i></a></li>
                  <li><a href="#" style="color: red; font-size:16px;"><i class="fa fa-instagram"></i></a></li>
                </ul>
              </div>
              <div class="pull-right">
                <ul class="navbar-nav">
                  <li><a class="bgcolor--fadeorange color--white bradius--small importance padding--small" href="index-en.html">en</a></li>
                </ul>
              </div>
            </div>
          </nav>
        </header>
        <div class="full-body-covered">
          <div class="cover-main">
            <div class="coverglobal text-center">
              <div class="container">
                <div class="row">
                  <div class="col-xs-12">
                    <div class="text-xs-center"></div>
                    <div class="center-logo"><img class="className" id="IdName" src="img/logo.png" alt="Image Title"></div><br>
                    <h4 class="color--main_d text-center col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2 col-xs-12 col-xs-offset-0">خلافاَ للاعتقاد السائد فإن لوريم إيبسوم ليس نصاَ عشوائياً، بل إن له جذور في الأدب اللاتيني الكلاسيكي منذ العام 45 قبل الميلاد، مما يجعله أكثر من 2000 عام في القدم.</h4>
                    <div class="clearfix"></div><br><br>
                    <div class="text-center"><span class="bgcolor--fadeblue color--white bradius--small padding--small">الخط الساخن:	&nbsp; 19534</span></div>
                    <div class="clearfix"></div><br><br>
                    <div class="text-center col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2 col-xs-12 col-xs-offset-0">
                      <div class="chevron"></div>
                      <div class="chevron"></div>
                      <div class="chevron"></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- Page content-->
            <div class="content-wrapper same-height">
              <!-- =============== Custom Content ===============-->
              @yield('content')
              <!-- =============== PAGE VENDOR Triggers ===============-->
            </div>
          </div>
        </div>
        <!-- Page footer-->
        <div class="container">
          <footer>
            <!-- =====================================================-->
            <!-- ==================FOOTER=============================-->
            <!-- =====================================================-->
            <div class="clear-fix"></div>
            <div class="footer--1 text-center  color--main bradius--noborder bshadow--0">
              <p>Powered by Pentavalue<img src="img/powered.png" alt="pentavalue" height="20">-<a href="http://pentavalue.com/en" target="_blank"></a>All rights reserved  ©<span class="cp bgcolor--sec color--white bradius--small bshadow--0">Avocato</span>2018</p>
            </div>
          </footer>
        </div>
      </div>
    </div>
    <!-- =============== APP MAIN SCRIPTS ===============-->
    <script type="text/javascript" src="js/scripts.js"></script>
    <!-- =============== PAGE VENDOR SCRIPTS ===============-->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script type="text/javascript">
      $(document).ready(function() {
        var numItems = $('li.fancyTab').length;
          if (numItems == 12){
            $("li.fancyTab").width('8.3%');
          }
          if (numItems == 11){
            $("li.fancyTab").width('9%');
          }
          if (numItems == 10){
            $("li.fancyTab").width('10%');
          }
          if (numItems == 9){
            $("li.fancyTab").width('11.1%');
          }
          if (numItems == 8){
            $("li.fancyTab").width('12.5%');
          }
          if (numItems == 7){
            $("li.fancyTab").width('14.2%');
          }
          if (numItems == 6){
            $("li.fancyTab").width('16.666666666666667%');
          }
          if (numItems == 5){
            $("li.fancyTab").width('20%');
          }
          if (numItems == 4){
            $("li.fancyTab").width('25%');
          }
          if (numItems == 3){
            $("li.fancyTab").width('33.3%');
          }
          if (numItems == 2){
            $("li.fancyTab").width('50%');
          }

        });
    </script>
    <script type="text/javascript"></script>
  </body>
</html>
