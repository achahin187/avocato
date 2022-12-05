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
    <link rel="manifest" href="{{asset('img/favicon/manifest.json')}}">
    <link rel="mask-icon" href="{{asset('img/favicon/safari-pinned-tab.svg')}}" color="#22b681">
    <meta name="msapplication-TileColor" content="#22b681">
    <meta name="msapplication-TileImage" content="/mstile-144x144.png">
    <meta name="theme-color" content="#1c5ba8">
    <!-- =============== APP TITLE ===============-->
    <title>Secure Bridge</title>
    <!-- =============== APP STYLES ===============-->
    <link rel="stylesheet" href="{{asset('css/style__rtl.css')}}">
    <!-- =============== APP SCRIPT ===============-->
    <script src="{{asset('js/modernizr.js')}}"></script>
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
        <div class="login--page" style="background:  center center ; background-size: cover ; ;">
        <div class="login--page" style="background: url(https://source.unsplash.com/collection/141056) center center ; background-size: cover ; ;">
          <div class="row">
            <div class="col-lg-4 col-lg-offset-4 col-md-4 col-md-offset-4 col-sm-10 col-sm-offset-1 col-xs-12">
              <div class="login--form">
                <div class="login-page">
                  <div class="form-login bgcolor--gray_l bradius--small bshadow--2 "><img class="logo" src="img/logo/logo__dark.png" alt="جسر الأمان">
                    <form class="login-form form-horizontal" method="POST" action="{{ route('auth.login') }}">
                       {{ csrf_field() }}

                        @if(\session('error'))
                            <div class="alert alert-danger">
                            {{\session('error')}}
                            </div>
                        @endif
                        
                      <input name="user_name" class="color--black bgcolor--white bradius--small bshadow--1" type="text" placeholder="اسم المستخدم" value="{{ old('user_name') }}">
                              @if ($errors->has('user_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('user_name') }}</strong>
                                    </span>
                                @endif
                      <input name="password" class="color--black bgcolor--white bradius--small bshadow--1" type="password" placeholder="كلمة المرور">
                                  @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                                <button type="submit" class="color--white bgcolor--main bradius--small bshadow--1">الدخول</button>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- =============== PAGE VENDOR Triggers ===============-->
      </div>
    </div>
    <!-- =============== APP MAIN SCRIPTS ===============-->
    <script type="text/javascript" src="{{asset('js/scripts.js')}}"></script>
    <!-- =============== PAGE VENDOR SCRIPTS ===============-->
    
    <script type="text/javascript"></script>
  </body>
</html>

<!-- <div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Login</div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                                    </label>
                                </div>
                            </div>
                        </div>

                        {{-- <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Login
                                </button>

                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    Forgot Your Password?
                                </a>
                            </div> --}}
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> -->

