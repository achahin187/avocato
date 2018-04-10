<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- =====================================================-->
    <!-- ==================HEAD=============================-->
    <!-- =====================================================-->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="description" content="Vapulus">
    <meta name="keywords" content="Vapulus">
    <!-- =============== APP FAVICON ===============-->
    <link rel="apple-touch-icon" sizes="180x180" href="{{asset('land/img/favicon/apple-touch-icon.png')}}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{asset('land/img/favicon/favicon-32x32.png')}}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('land/img/favicon/favicon-16x16.png')}}">
    <link rel="manifest" href="{{asset('land/img/favicon/manifest.json')}}">
    <link rel="mask-icon" href="{{asset('land/img/favicon/safari-pinned-tab.svg')}}" color="#22b681">
    <meta name="msapplication-TileColor" content="#22b681">
    <meta name="msapplication-TileImage" content="{{asset('land/mstile-144x144.png')}}">
    <meta name="theme-color" content="#1c5ba8">
    <!-- =============== APP TITLE ===============-->
    <title>Avocato</title>
    <!-- =============== APP STYLES ===============-->
    <link rel="stylesheet" href="{{asset('land/css/style__ltr.css')}}">
    <!-- =============== APP SCRIPT ===============-->
    <script src="{{asset('land/js/modernizr.js')}}"></script>
  </head>
  <body style="background:#f7f7f7 url( 'land/img/cover_bgs/dummy.jpg') no-repeat center center; background-size:cover;">
    <div class="layout_covered">
      <div class="wrapper">
        <!-- top navbar-->
        <header class="topnavbar-wrapper">
          <nav class="top-navbar navbar-expand-lg bgcolor--gray_m color--gray_d bradius--noborder bshadow--1 ">
            <div class="container-fluid">
              <div class="pull-left">
                <ul class="actionsbar topsocial">
                  <li><a href="#" style="color: #0084B4; font-size:16px;"><i class="fa fa-facebook"></i></a></li>
                  <li><a href="#" style="color: #3cf; font-size:16px;"><i class="fa fa-twitter"></i></a></li>
                  <li><a href="#" style="color: red; font-size:16px;"><i class="fa fa-instagram"></i></a></li>
                </ul>
              </div>
              <div class="pull-right">
                <ul class="navbar-nav">
                  <li><a class="bgcolor--fadeorange color--white bradius--small importance padding--small" href="{{route('landing','ar')}}">العربية</a></li>
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
                    <div class="center-logo"><img class="className" id="IdName" src="{{asset('land/img/logo.png')}}" alt="Image Title"></div><br>
                    <h4 class="color--main_d text-center col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2 col-xs-12 col-xs-offset-0">Lorem ipsum dolor sit amet, consectetur adipiscing elit, magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</h4>
                    <div class="clearfix"></div><br><br>
                    <div class="text-center"><span class="bgcolor--fadeblue color--white bradius--small padding--small">Hotline:	&nbsp; 19534</span></div>
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
              <div class="container">
                <div class="same-height content-wrapper">
                  <section class="tabs t-tabs" id="fancyTabWidget">
                    <ul class="nav nav-tabs fancyTabs" role="tablist">
                      <li class="tab fancyTab active">
                        <div class="arrow-down">
                          <div class="arrow-down-inner"></div>
                        </div><a id="tab0" href="#tabBody0" role="tab" aria-controls="tabBody0" aria-selected="true" data-toggle="tab" tabindex="0"><span class="fa fa-user"></span><span class="hidden-xs">Client</span></a>
                        <div class="whiteBlock"></div>
                      </li>
                      <li class="tab fancyTab">
                        <div class="arrow-down">
                          <div class="arrow-down-inner"></div>
                        </div><a id="tab1" href="#tabBody1" role="tab" aria-controls="tabBody1" aria-selected="true" data-toggle="tab" tabindex="0"><span class="fa fa-graduation-cap"></span><span class="hidden-xs">Lawyer</span></a>
                        <div class="whiteBlock"></div>
                      </li>
                      <li class="tab fancyTab">
                        <div class="arrow-down">
                          <div class="arrow-down-inner"></div>
                        </div><a id="tab2" href="#tabBody2" role="tab" aria-controls="tabBody2" aria-selected="true" data-toggle="tab" tabindex="0"><span class="fa fa-briefcase"></span><span class="hidden-xs">Office</span></a>
                        <div class="whiteBlock"></div>
                      </li>
                    </ul>
                    <div class="tab-content fancyTabContent" id="myTabContent" aria-live="polite">
                      <div class="tab-pane fade active in" id="tabBody0" role="tabpanel" aria-labelledby="tab0" aria-hidden="false" tabindex="0">
                  @if(\session('success'))
                  <div class="alert alert-success">
                  {{\session('success')}}
                  </div>
                  @endif
              <form role="form" action="{{route('landing.ind')}}" method="post" enctype="multipart/form-data" accept-charset="utf-8">
                {{csrf_field()}}
                        <div class="col-md-3 col-sm-4 col-xs-12">
                          <div class="master_field">
                            <label class="master_label mandatory" for="client_name">Client Name</label>
                            <input name="ind_name" value="{{ old('ind_name') }}" class="master_input" type="text" placeholder="Client Name.." id="client_name">
                          </div><span class="master_message color--fadegreen">
                                  @if ($errors->has('ind_name'))
                                    {{ $errors->first('ind_name')}}
                                    @endif</span>
                        </div>
                        <div class="col-md-3 col-sm-4 col-xs-12">
                          <div class="master_field">
                            <label class="master_label mandatory" for="client_gender">Gender</label>
                            <select name="gender" class="master_input select2" id="client_gender" style="width:100%;">
                            @foreach($genders_en as $gender_en)
                              <option value="{{$gender_en->id}}"> {{$gender_en->name}} </option>
                              @endforeach
                            </select><span class="master_message color--fadegreen">
                              @if ($errors->has('gender'))
                                    {{ $errors->first('gender')}}
                                    @endif</span>
                          </div>
                        </div>
                        <div class="col-md-3 col-sm-4 col-xs-12">
                          <div class="master_field">
                            <label class="master_label mandatory" for="client_job">Title </label>
                            <input name="job" value="{{ old('job') }}" class="master_input" type="text" placeholder="Title .." id="client_job"><span class="master_message color--fadegreen">
                                  @if ($errors->has('job'))
                                    {{ $errors->first('job')}}
                                    @endif </span>
                          </div>
                        </div>
                        <div class="col-md-3 col-sm-4 col-xs-12">
                          <div class="master_field">
                            <label class="master_label mandatory" for="client_address">Address</label>
                            <input name="address" value="{{ old('address') }}" class="master_input" type="text" placeholder="Address .." id="client_address"><span class="master_message color--fadegreen">
                                @if ($errors->has('address'))
                                    {{ $errors->first('address')}}
                                    @endif </span>
                          </div>
                        </div>
                        <div class="col-md-3 col-sm-4 col-xs-12">
                          <div class="master_field">
                            <label class="master_label mandatory" for="client_id">ID</label>
                            <input name="national_id" value="{{ old('national_id') }}" class="master_input" type="text" placeholder="ID number" id="client_id"><span class="master_message color--fadegreen">
                                @if ($errors->has('national_id'))
                                    {{ $errors->first('national_id')}}
                                    @endif</span>
                          </div>
                        </div>
                        <div class="col-md-3 col-sm-4 col-xs-12">
                        <div class="master_field">
                          <label class="master_label mandatory" for="work_type">Nationality</label>
                          <select name="nationality" class="master_input select2"  data-placeholder="نوع العمل " style="width:100%;" ,>
                          <option value="choose" selected disabled>Choose Nationality</option>
                          @foreach($nationalities_en as $nationality_en)
                            <option value="{{$nationality_en->id}}">{{$nationality_en->nationality}}</option>
                            @endforeach
                          </select><span class="master_message color--fadegreen">
                                  @if ($errors->has('nationality'))
                                    {{ $errors->first('nationality')}}
                                    @endif</span>
                        </div>
                        </div>
                        <div class="col-md-3 col-sm-4 col-xs-12">
                          <div class="master_field">
                            <label class="master_label mandatory" for="client_birth">Birth Date</label>
                            <input name="birthdate" value="{{ old('birthdate') }}" class="datepicker-popup master_input" type="text" placeholder="Birth Date" id="client_birth"><span class="master_message color--fadegreen">
                                  @if ($errors->has('birthdate'))
                                    {{ $errors->first('birthdate')}}
                                    @endif</span>
                          </div>
                        </div>
                        <div class="col-md-3 col-sm-4 col-xs-12">
                          <div class="master_field">
                            <label class="master_label mandatory" for="client_tel">Tel</label>
                            <input name="phone" value="{{ old('phone') }}" class="master_input" type="text" placeholder="Tel" id="client_tel"><span class="master_message color--fadegreen">
                              @if ($errors->has('phone'))
                                    {{ $errors->first('phone')}}
                                    @endif</span>
                          </div>
                        </div>
                        <div class="col-md-3 col-sm-4 col-xs-12">
                          <div class="master_field">
                            <label class="master_label mandatory" for="client_mob">Mobile</label>
                            <input name="mobile" value="{{ old('mobile') }}" class="master_input" type="text" placeholder="Mobile" id="client_mob"><span class="master_message color--fadegreen">
                                    @if ($errors->has('mobile'))
                                    {{ $errors->first('mobile')}}
                                    @endif</span>
                          </div>
                        </div>
                        <div class="col-md-3 col-sm-4 col-xs-12">
                          <div class="master_field">
                            <label class="master_label" for="client_email">Email</label>
                            <input name="email" value="{{ old('email') }}" class="master_input" type="email" placeholder="Email" id="client_email"><span class="master_message color--fadegreen">
                                  @if ($errors->has('email'))
                                    {{ $errors->first('email')}}
                                    @endif</span>
                          </div>
                        </div>
                        <div class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2 col-xs-12 col-xs-offset-0">
                          <button class="master-btn undefined btn-block color--main color--gray_d bradius--rounded bshadow--0" type="submit"><span>Send</span>
                          </button>
                        </div>
                        <div class="clearfix"></div>
                      </form>
                      </div>
                      <div class="tab-pane fade" id="tabBody1" role="tabpanel" aria-labelledby="tab1" aria-hidden="true" tabindex="0">
                  <form role="form" action="{{route('landing.lawyer')}}" method="post" enctype="multipart/form-data" accept-charset="utf-8">
                      {{csrf_field()}}
                        <div class="col-md-4 col-sm-6 col-xs-12">
                          <div class="master_field">
                            <label class="master_label mandatory" for="lawyer_name">Lawyer Name</label>
                            <input name="lawyer_name" value="{{ old('lawyer_name') }}" class="master_input" type="text" placeholder="Lawyer Name .." id="lawyer_name"><span class="master_message color--fadegreen">
                                  @if ($errors->has('lawyer_name'))
                                    {{ $errors->first('lawyer_name')}}
                                        @endif </span>
                          </div>
                        </div>
                        <div class="col-md-4 col-sm-6 col-xs-12">
                          <div class="master_field">
                            <label class="master_label mandatory" for="lawyer_address">Lawyer Address</label>
                            <input name="address" value="{{ old('address') }}" class="master_input" type="text" placeholder="Lawyer Address .." id="lawyer_address"><span class="master_message color--fadegreen">
                                  @if ($errors->has('address'))
                                    {{ $errors->first('address')}}
                                        @endif </span>
                          </div>
                        </div>
                        <div class="col-md-4 col-sm-6 col-xs-12">
                          <div class="master_field">
                            <label class="master_label mandatory" for="lawyer_id">ID</label>
                            <input name="national_id" value="{{ old('national_id') }}" class="master_input" type="text" placeholder="ID Number" id="lawyer_id"><span class="master_message color--fadegreen">
                                @if ($errors->has('national_id'))
                                    {{ $errors->first('national_id')}}
                                        @endif</span>
                          </div>
                        </div>
                        <div class="col-md-4 col-sm-6 col-xs-12">
                        <div class="master_field">
                          <label class="master_label mandatory" for="work_type">Nationality</label>
                          <select name="nationality" class="master_input select2"  data-placeholder="نوع العمل " style="width:100%;" ,>
                          <option value="choose" selected disabled>Choose Nationality</option>
                          @foreach($nationalities_en as $nationality_en)
                            <option value="{{$nationality_en->id}}">{{$nationality_en->nationality}}</option>
                            @endforeach
                          </select><span class="master_message color--fadegreen">
                                  @if ($errors->has('nationality'))
                                    {{ $errors->first('nationality')}}
                                    @endif</span>
                        </div>
                        </div>
                        <div class="col-md-4 col-sm-6 col-xs-12">
                          <div class="master_field">
                            <label class="master_label mandatory" for="lawyer_birth">Birth Date</label>
                            <input name="birthdate" value="{{ old('birthdate') }}" class="datepicker-popup master_input" type="text" placeholder="Birth Date" id="lawyer_birth"><span class="master_message color--fadegreen">
                              @if ($errors->has('birthdate'))
                                    {{ $errors->first('birthdate')}}
                                    @endif</span>
                          </div>
                        </div>
                        <div class="col-md-4 col-sm-6 col-xs-12">
                          <div class="master_field">
                            <label class="master_label mandatory" for="lawyer_tel">Tel</label>
                            <input name="phone" value="{{ old('phone') }}" class="master_input" type="text" placeholder="Tel" id="lawyer_tel"><span class="master_message color--fadegreen">
                                @if ($errors->has('phone'))
                                    {{ $errors->first('phone')}}
                                    @endif</span>
                          </div>
                        </div>
                        <div class="col-md-4 col-sm-6 col-xs-12">
                          <div class="master_field">
                            <label class="master_label mandatory" for="lawyer_mob">Mobile</label>
                            <input name="mobile" value="{{ old('mobile') }}" class="master_input" type="text" placeholder="Mobile Number" id="lawyer_mob"><span class="master_message color--fadegreen">
                                  @if ($errors->has('mobile'))
                                    {{ $errors->first('mobile')}}
                                    @endif</span>
                          </div>
                        </div>
                        <div class="col-md-4 col-sm-6 col-xs-12">
                          <div class="master_field">
                            <label class="master_label" for="lawyer_email">Email</label>
                            <input name="email" value="{{ old('email') }}" class="master_input" type="email" placeholder="Email" id="lawyer_email"><span class="master_message color--fadegreen">
                                @if ($errors->has('email'))
                                    {{ $errors->first('email')}}
                                    @endif</span>
                          </div>
                        </div>
                        <div class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2 col-xs-12 col-xs-offset-0">
                          <button class="master-btn undefined btn-block color--main color--gray_d bradius--rounded bshadow--0" type="submit"><span>Send</span>
                          </button>
                        </div>
                        <div class="clearfix"></div>
                      </form>
                      </div>
                      <div class="tab-pane fade" id="tabBody2" role="tabpanel" aria-labelledby="tab2" aria-hidden="true" tabindex="0">
                    <form role="form" action="{{route('landing.company')}}" method="post" enctype="multipart/form-data" accept-charset="utf-8">
                      {{csrf_field()}}
                        <div class="col-md-4 col-sm-6 col-xs-12">
                          <div class="master_field">
                            <label class="master_label mandatory" for="office_name">Office Name</label>
                            <input name="company_name" value="{{ old('company_name') }}" class="master_input" type="text" placeholder="Office Name .." id="office_name"><span class="master_message color--fadegreen">
                                  @if ($errors->has('company_name'))
                                    {{ $errors->first('company_name')}}
                                    @endif </span>
                          </div>
                        </div>
                        <div class="col-md-4 col-sm-6 col-xs-12">
                          <div class="master_field">
                            <label class="master_label mandatory" for="office_address">Office Address</label>
                            <input name="address" value="{{ old('address') }}" class="master_input" type="text" placeholder="Office Address .." id="office_address"><span class="master_message color--fadegreen">
                                @if ($errors->has('address'))
                                    {{ $errors->first('address')}}
                                    @endif </span>
                          </div>
                        </div>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                          <div class="master_field">
                            <label class="master_label mandatory" for="rep_name">Representative Name</label>
                            <input name="legal_representative_name" value="{{ old('legal_representative_name') }}" class="master_input" type="text" placeholder="Representative Name.." id="rep_name"><span class="master_message color--fadegreen"> 
                                  @if ($errors->has('legal_representative_name'))
                                    {{ $errors->first('legal_representative_name')}}
                                    @endif </span>
                          </div>
                        </div>
                        <div class="col-md-4 col-sm-6 col-xs-12">
                          <div class="master_field">
                            <label class="master_label mandatory" for="lawyer_tel">Tel</label>
                            <input name="phone" value="{{ old('phone') }}" class="master_input" type="text" placeholder="Tel" id="lawyer_tel"><span class="master_message color--fadegreen">
                                  @if ($errors->has('phone'))
                                    {{ $errors->first('phone')}}
                                    @endif</span>
                          </div>
                        </div>
                        <div class="col-md-4 col-sm-6 col-xs-12">
                          <div class="master_field">
                            <label class="master_label mandatory" for="lawyer_mob">Mobile</label>
                            <input name="mobile" value="{{ old('mobile') }}" class="master_input" type="text" placeholder="Mobile Number" id="lawyer_mob"><span class="master_message color--fadegreen">
                                  @if ($errors->has('mobile'))
                                    {{ $errors->first('mobile')}}
                                    @endif</span>
                          </div>
                        </div>
                        <div class="col-md-4 col-sm-6 col-xs-12">
                          <div class="master_field">
                            <label class="master_label" for="lawyer_email">Email</label>
                            <input name="email" value="{{ old('email') }}" class="master_input" type="email" placeholder="Email" id="lawyer_email"><span class="master_message color--fadegreen">
                                  @if ($errors->has('email'))
                                    {{ $errors->first('email')}}
                                    @endif</span>
                          </div>
                        </div>
                        <div class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2 col-xs-12 col-xs-offset-0">
                          <button class="master-btn undefined btn-block color--main color--gray_d bradius--rounded bshadow--0" type="submit"><span>Send</span>
                          </button>
                        </div>
                        <div class="clearfix"></div>
                      </form>
                      </div>
                    </div>
                  </section>
                </div>
              </div>
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
              <p>Powered by Pentavalue<img src="{{asset('land/img/powered.png')}}" alt="pentavalue" height="20">-<a href="http://pentavalue.com/en" target="_blank"></a>All rights reserved  ©<span class="cp bgcolor--sec color--white bradius--small bshadow--0">Avocato</span>2018</p>
            </div>
          </footer>
        </div>
      </div>
    </div>
    <!-- =============== APP MAIN SCRIPTS ===============-->
    <script type="text/javascript" src="{{asset('land/js/scripts.js')}}"></script>
    <!-- =============== PAGE VENDOR SCRIPTS ===============-->

    <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
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
