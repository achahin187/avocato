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
    <link rel="apple-touch-icon" sizes="180x180" href="{{asset('img/favicon/apple-touch-icon.png')}}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{asset('img/favicon/favicon-32x32.png')}}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('img/favicon/favicon-16x16.png')}}">
    <link rel="manifest" href="img/favicon/manifest.json">
    <link rel="mask-icon" href="img/favicon/safari-pinned-tab.svg" color="#22b681">
    <meta name="msapplication-TileColor" content="#22b681">
    <meta name="msapplication-TileImage" content="/mstile-144x144.png">
    <meta name="theme-color" content="#1c5ba8">
    <!-- =============== APP TITLE ===============-->
    <title>Choose Country</title>
    <!-- =============== APP STYLES ===============-->
    <link rel="stylesheet" href="{{asset('css/style__rtl.css')}}">
    <!-- =============== APP SCRIPT ===============-->
    <script src="{{asset('/js/modernizr.js')}}"></script>
  </head>
  <body>
    <div class="layout_page">
 <div class="wrapper">
 @if (Session::has('error'))
          <div class="alert alert-warning text-center">{{ Session::get('error') }}</div>
          @endif
          @if (Session::has('success'))
          <div class="success success-info text-center">{{ Session::get('success') }}</div>
          @endif
        <!-- =============== Custom Content ===============-->
        <div class="login--page" style="background: url(https://source.unsplash.com/collection/141056) center center ; background-size: cover ; ">
          <div class="row">
            <div class="col-lg-4 col-lg-offset-4 col-md-4 col-md-offset-4 col-sm-10 col-sm-offset-1 col-xs-12">
              <div class="login--form"></div>
              <div class="login-page">
                <div class="form-login bgcolor--gray_l bradius--small bshadow--2 "><img class="logo" src="{{asset('img/logo/logo__dark.png')}}" alt="جسر الأمان"><br>
                  <form class="login-form" action="{{route('choose.country.info')}}" method="post">
                    {{csrf_field()}}
                    <div class="master_field">
                      <label class="master_label" for="country">اختار الدولة </label>
                      <select class="master_input" id="country" name="country">
                        @foreach($countries as $country)
                        <option value="{{$country['id']}}">{{$country['name']}}</option>
                        @endforeach
                      </select>
                    </div><button class="color--white bgcolor--main bradius--small bshadow--1" type="submit">الدخول</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- =============== PAGE VENDOR Triggers ===============-->
      </div>
      </div>
    <!-- =============== APP MAIN SCRIPTS ===============-->
    <script type="text/javascript" src="js/scripts.js"></script>
    <!-- =============== PAGE VENDOR SCRIPTS ===============-->
    
    <script type="text/javascript"></script>
  </body>
</html>