<!DOCTYPE html>
<html lang="{{app()->getLocale()}}">
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
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <!-- =============== APP TITLE ===============-->
  <title>{{config('app.name')}}</title>
  <!-- =============== APP STYLES ===============-->
  <link rel="stylesheet" href="{{asset('css/style__rtl.css')}}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.css">
  <!-- =============== APP SCRIPT ===============-->
  <script src="{{asset('js/jquery-3.3.1.min.js')}}"></script>
  <script src="{{asset('js/modernizr.js')}}"></script>
</head>
<body>
  <div class="toggled" id="wrapper">
    <div class="layout_sidebar">
      <div class="wrapper">
        <!-- top navbar-->
        <header class="topnavbar-wrapper">
          <nav class="top-navbar navbar-expand-lg bgcolor--gray_m color--gray_d bradius--noborder bshadow--1 ">
            <div class="container-fluid"><span></span>
              <ul class="actionsbar moile-view hidden-lg hidden-md hidden-sm">
                <li class="dropdowny"><a class="dropdowny-toggle color--gray_d" href="#"><i class="fa fa-bell"></i></a>
                  <ul class="dropdowny-menu" role="menu">
                    <li><a href="#">
                      <div class="icon-container"><i class="fa fa-volume-up"></i></div>
                      <p>lorem ipsum dollar lorem ipsum dollarss</p><span class="notification_date"><i class="fa fa-clock-o"></i>5/11/2015
                      11:00:00AM</span></a></li>
                      <li><a href="#">
                        <div class="icon-container"><i class="fa fa-volume-up"></i></div>
                        <p>lorem ipsum dollar lorem ipsum</p><span class="notification_date"><i class="fa fa-clock-o"></i>5/11/2015
                        11:00:00AM</span></a></li>
                        <li><a href="#">
                          <div class="icon-container"><i class="fa fa-volume-up"></i></div>
                          <p>lorem ipsum dollar lorem ipsum dollarss</p><span class="notification_date"><i class="fa fa-clock-o"></i>5/11/2015
                          11:00:00AM</span></a></li>
                          <li><a href="#">
                            <div class="icon-container"><i class="fa fa-volume-up"></i></div>
                            <p>lorem ipsum dollar lorem ipsum</p><span class="notification_date"><i class="fa fa-clock-o"></i>5/11/2015
                            11:00:00AM</span></a></li>
                            <li><a href="#">
                              <div class="icon-container"><i class="fa fa-volume-up"></i></div>
                              <p>lorem ipsum dollar lorem ipsum dollarss</p><span class="notification_date"><i class="fa fa-clock-o"></i>5/11/2015
                              11:00:00AM</span></a></li>
                              <li><a href="#">
                                <div class="icon-container"><i class="fa fa-volume-up"></i></div>
                                <p>lorem ipsum dollar lorem ipsum</p><span class="notification_date"><i class="fa fa-clock-o"></i>5/11/2015
                                11:00:00AM</span></a></li>
                              </ul>
                            </li>
                          </ul>
                          <div class="collapse navbar-collapse nav pull-right bgcolor--gray_m" id="navbarSupportedContent">
                            <ul class="navbar-nav">
                              <li class="nav-item"><a class="nav-link   color--gray_d" href=" .html " title=" "> </a></li>
                            </ul>
                            <ul class="actionsbar desktop-view hidden-xs">
                              <li class="dropdowny"><a class="dropdowny-toggle color--gray_d" href="#"><i class="fa fa-bell"></i><span class="badge badge-default"> {{$counter}}</span></a>
                                <ul class="dropdowny-menu" role="menu">
                                  @foreach($notes as $note)
                                  <li @if($note->is_read==1)class="read" @endif data-notification-id={{$note->id}}><a class="notification" @if($note->url != null || $note->url != '') href="{{route($note->url,$note->item_id)}}" @endif >
                                    <div class="icon-container"><i class="fa fa-volume-up"></i></div>
                                    <p>{{$note->msg . $note->item_name}}</p>
                                    <span class="notification_date"><i class="fa fa-clock-o"></i>{{$note->created_at}}</span>
                                    </a>
                                    </li>
                                    @endforeach
                                        </ul>
                                      </li>
                                      <li><a class="color--gray_d" href="{{route('logout')}}" onclick="event.preventDefault();
                                      document.getElementById('logout-form').submit();"><i class="fa fa-sign-out"></i></a></li>
                                      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                      </form>
                                    </ul>
                                  </div>
                                </div>
                              </nav>
                            </header>
                            <div class="full-body">
                              <div class="overlay-toggle-up"></div>
                              <!-- sidebar-->
                              <!-- ==============================================================-->
                              <!-- ============================SIDEBAR==============================-->
                              <!-- ==============================================================-->
                              <!-- Sidebar-->
                              <nav class="navbar navbar-fixed-top bgcolor--gray_m bshadow--0 bradius--noborder " id="sidebar-wrapper" role="navigation">
                                <ul class="sidebar-navigation">
                                  <li class="brand bgcolor--gray_m bshadow--0"><a href="{{route('home')}}"> <img src="{{asset('img/logo/logo__light.png')}}" alt="جسر الأمان"></a></li>
                                </ul>
                                <div class="coverglobal text-center bshadow--2" style="background:#f7f7f7  ;">
                                  <button class="hamburger is-closed" type="button" data-toggle="offcanvas"><span class="hamb-top bgcolor--main_d"></span><span class="hamb-middle bgcolor--main_d"></span><span class="hamb-bottom bgcolor--main_d"></span></button>
                                  <div class="text-center">
                                  @if(Helper::is_admin_superadmin(\Auth::user()->id))
                                  <a href="#">
                                  <img class="coverglobal__avatar bradius--circle" @if (\Auth::check())src="{{asset(''.\Auth::user()->image)}}" @endif>
                                    <h3 class="coverglobal__title color--gray_d">{{\Auth::user()->name}}</h3>
                                    <small class="coverglobal__slogan color--gray_d"></small>
                                    </a>
                                    @else
                                    <a href="{{route('user_profile',\Auth::user()->id)}}">
                                  <img class="coverglobal__avatar bradius--circle" @if (\Auth::check())src="{{asset(''.\Auth::user()->image)}}" @endif>
                                    <h3 class="coverglobal__title color--gray_d">{{\Auth::user()->name}}</h3>
                                    <small class="coverglobal__slogan color--gray_d"></small>
                                    </a>
                                    @endif
                                    </div>
                                  </div>

                                  <div class="side">
                                    <ul class="side-menu" id="menu">
                        @if(auth()->user()->getRole()==1 or auth()->user()->getRole()==2 or auth()->user()->getRole()==3)
                                      <li class="side__list"> <a class="side__item side__item--sub color--gray_d bgcolor--gary_m ">البيانات الأساسية</a>
                                        <ul class="side__submenu" id="sub_menu">
                                          <li class="side__sublist"><a class="side__subitem color--gray_d bgcolor--gray_l" href="{{route('issues_types')}}">انواع القضايا</a></li>
                                           <li class="side__sublist"><a class="side__subitem color--gray_d bgcolor--gray_l" href="{{route('specializations')}}">التخصصات</a></li>
                                          <li class="side__sublist"><a class="side__subitem color--gray_d bgcolor--gray_l" href="{{route('governorates_cities')}}">المدن و المحافظات</a></li>
                                          <li class="side__sublist"><a class="side__subitem color--gray_d bgcolor--gray_l" href="{{route('courts_list')}}">اسماء المحاكم</a></li>
                                          <li class="side__sublist"><a class="side__subitem color--gray_d bgcolor--gray_l" href="{{route('contracts_formulas_types')}}">انواع الصيغ و العقود</a></li>
                                          <li class="side__sublist"><a class="side__subitem color--gray_d bgcolor--gray_l" href="{{route('consultations_classification')}}">تصنيف الاستشارات</a></li>
                                          <li class="side__sublist"><a class="side__subitem color--gray_d bgcolor--gray_l" href="{{route('about')}}">عن جسر الأمان</a></li>
                                          <li class="side__sublist"><a class="side__subitem color--gray_d bgcolor--gray_l" href="{{route('contact_us')}}"> اللينكات </a></li>
                                          <li class="side__sublist"><a class="side__subitem color--gray_d bgcolor--gray_l" href="{{route('contactus_index')}}">اتصل بنا</a></li>
                                          <li class="side__sublist"><a class="side__subitem color--gray_d bgcolor--gray_l" href="{{route('terms_conditions')}}">الشروط و الأحكام</a></li>
                                          <li class="side__sublist"><a class="side__subitem color--gray_d bgcolor--gray_l" href="{{route('privacy')}}">سياسة الخصوصية</a></li>
                                          <li class="side__sublist"><a class="side__subitem color--gray_d bgcolor--gray_l" href="{{route('bouquets')}}">تعريف الباقات</a></li>
                                        </ul>
                                      </li>
                                      
                                      <li class="side__list"> <a class="side__item color--gray_d bgcolor--gray_m" href="{{route('formulas')}}">العقود و الصيغ</a>
                                      </li>
                                      
                                      @endif

                        @if(auth()->user()->getRole()==1)
                                      
                                      <li class="side__list"> <a class="side__item color--gray_d bgcolor--gray_m" href="{{route('users_list')}}">المستخدمين</a>
                                      </li>
                                      
                                      @endif
                              @if(auth()->user()->getRole()==1 or auth()->user()->getRole()==2)
                                      
                                      <li class="side__list"> <a class="side__item color--gray_d bgcolor--gray_m" href="{{route('news_list')}}">الاخبار</a>
                                      </li>
                                      
                                      @endif
                                      <li class="side__list"> <a class="side__item side__item--sub color--gray_d bgcolor--gary_m ">العملاء</a>
                                        <ul class="side__submenu">
                      @if(auth()->user()->getRole()==1 or auth()->user()->getRole()==2)
                                          <li class="side__sublist"><a class="side__subitem color--gray_d bgcolor--gray_l" href="{{route('clients')}}">محتوى</a></li>
                                      
                                          <li class="side__sublist"><a class="side__subitem color--gray_d bgcolor--gray_l" href="{{route('notifications')}}">التنبيهات</a></li>
                                      
                                      @endif
                            @if(auth()->user()->getRole()==1 or auth()->user()->getRole()==2 or auth()->user()->getRole()==3 or auth()->user()->getRole()==4)
                                      
                                          <li class="side__sublist"><a class="side__subitem color--gray_d bgcolor--gray_l" href="{{route('complains')}}">الشكاوى و الاستفسارات</a></li>
                                      
                                      @endif
                                        </ul>
                                      </li>
                        @if(auth()->user()->getRole()==1 or auth()->user()->getRole()==2 or auth()->user()->getRole()==3)
                                      
                                      <li class="side__list"> <a class="side__item color--gray_d bgcolor--gray_m" href="{{route('lawyers')}}">السادة المحامين</a>
                                      </li>
                                       <li class="side__list"> <a class="side__item color--gray_d bgcolor--gray_m" href="{{route('offices')}}">مكاتب المحاماة</a>
                                      </li>
                                      
                                      @endif
                      @if(auth()->user()->getRole()==1 or auth()->user()->getRole()==2)
                                      
                                      <li class="side__list"> <a class="side__item color--gray_d bgcolor--gray_m" href="{{route('legal_consultations')}}">الاستشارات القانونية</a>
                                      </li>
                                      
                                      @endif
                              @if(auth()->user()->getRole()==1 or auth()->user()->getRole()==2 or auth()->user()->getRole()==3)
                                      
                                      <li class="side__list"> <a class="side__item side__item--sub color--gray_d bgcolor--gary_m ">القضايا و الخدمات</a>
                                        <ul class="side__submenu">
                                          <li class="side__sublist"><a class="side__subitem color--gray_d bgcolor--gray_l" href="{{route('cases')}}">القضايا</a></li>
                                          <li class="side__sublist"><a class="side__subitem color--gray_d bgcolor--gray_l" href="{{route('services')}}">الخدمات</a></li>
                                        </ul>
                                      </li>
                                      
                                      @endif
                          @if(auth()->user()->getRole()==1 or auth()->user()->getRole()==2 or auth()->user()->getRole()==4)
                                      
                                      <li class="side__list"> <a class="side__item side__item--sub color--gray_d bgcolor--gary_m ">المهام</a>
                                        <ul class="side__submenu">
                                      
                                      @endif
                            @if(auth()->user()->getRole()==1 or auth()->user()->getRole()==2)
                                      
                                          <li class="side__sublist"><a class="side__subitem color--gray_d bgcolor--gray_l" href="{{route('tasks_normal')}}">المهام العادية</a></li>
                                      
                                      @endif
                        @if(auth()->user()->getRole()==1 or auth()->user()->getRole()==2 or auth()->user()->getRole()==4)
                                      
                                          <li class="side__sublist"><a class="side__subitem color--gray_d bgcolor--gray_l" href="{{route('tasks_emergency')}}">الحالات الطارئة</a></li>
                                          <li class="side__sublist"><a class="side__subitem color--gray_d bgcolor--gray_l" href="{{route('substitutions')}}">طلبات الانابه </a></li>
                                      @endif
                                        </ul>
                                      </li>
                              @if(auth()->user()->getRole()==1)
                                      
                                      <li class="side__list"> <a class="side__item color--gray_d bgcolor--gray_m" href="{{route('reports_statistics')}}">تقارير و احصائيات</a>
                                      </li>
                                      
                                      @endif
                                      @if(auth()->user()->getRole()==1 or auth()->user()->getRole()==2 or auth()->user()->getRole()==3 or auth()->user()->getRole()==4)

                                      <li class="side__list"> <a class="side__item color--gray_d bgcolor--gray_m" href="{{route('records')}}">دفتر المحضرين</a>
                                      </li>
                                      
                                      @endif
                                    </ul>
                                  </div>
                                </nav>
                                <!-- Page content-->
                                <div class="container-fluid">
                                  <!-- =============== Custom Content ===============-->
                                  @yield('content')
                                  <!-- =============== PAGE VENDOR Triggers ===============-->
                                </div>
                              </div>
                              <!-- Page footer-->
                              <footer>
                                <!-- =====================================================-->
                                <!-- ==================FOOTER=============================-->
                                <!-- =====================================================-->
                                <div class="clear-fix"></div>
                                <div class="footer--1 text-center bgcolor--white color--main bradius--noborder bshadow--3">
                                  <p>
                                   بنتافاليو<img src="{{ asset('img/powered.png') }}" alt="pentavalue" height="20">-<a href="http://pentavalue.com/en" target="_blank"></a>جميع الحقوق محفوظة  ©<span class="cp bgcolor--sec color--white bradius--small bshadow--0">جسر الأمان</span>2018</p>
                                 </div>
                               </footer>
                             </div>
                           </div>
                         </div>
                         <!-- =============== APP MAIN SCRIPTS ===============-->
                         <script type="text/javascript" src="{{ asset('js/scripts.js') }}"></script>
                 <script type="text/javascript">
                           $(document).ready(function(){
                            var path = window.location.href;
                         
                              var target = $('#menu li a[href="'+path+'"]');
                              var sub_target = $('#menu li ul li a[href="'+path+'"]');
                            

                                    target.removeClass( "bgcolor--gray_m" ).addClass('bgcolor--sec');

                                     sub_target.removeClass( "color--gray_d" ).addClass('color--sec');
                                     
                                    sub_target.parent().parent().parent().removeClass( "bgcolor--gray_m" ).addClass('bgcolor--sec').addClass('openedmenu').addClass('opened-sublist');
                              
                             


                        });
                         </script>
                         <!-- =============== PAGE VENDOR SCRIPTS ===============-->
                         <script type="text/javascript">
                          $(function() {
                            $('input, select').on('change', function(event) {
                              var $element = $(event.target),
                              $container = $element.closest('.example');

                              if (!$element.data('tagsinput'))
                                return;

                              var val = $element.val();
                              if (val === null)
                                val = "null";
                              $('code', $('pre.val', $container)).html( ($.isArray(val) ? JSON.stringify(val) : "\"" + val.replace('"', '\\"') + "\"") );
                              $('code', $('pre.items', $container)).html(JSON.stringify($element.tagsinput('items')));
                            }).trigger('change');
                          });

                        </script>
                        <script type="text/javascript">
                          $(function($) {
                            $(".knob").knob({
                              change : function (value) {
            //console.log("change : " + value);
          },
          release : function (value) {
            //console.log(this.$.attr('value'));
            console.log("release : " + value);
          },
          cancel : function () {
            console.log("cancel : ", this);
          },
          /*format : function (value) {
            return value + '%';
          },*/
          draw : function () {

            // "tron" case
            if(this.$.data('skin') == 'tron') {

              this.cursorExt = 0.3;

              var a = this.arc(this.cv)  // Arc
                , pa                   // Previous arc
                , r = 1;

                this.g.lineWidth = this.lineWidth;

                if (this.o.displayPrevious) {
                  pa = this.arc(this.v);
                  this.g.beginPath();
                  this.g.strokeStyle = this.pColor;
                  this.g.arc(this.xy, this.xy, this.radius - this.lineWidth, pa.s, pa.e, pa.d);
                  this.g.stroke();
                }

                this.g.beginPath();
                this.g.strokeStyle = r ? this.o.fgColor : this.fgColor ;
                this.g.arc(this.xy, this.xy, this.radius - this.lineWidth, a.s, a.e, a.d);
                this.g.stroke();

                this.g.lineWidth = 2;
                this.g.beginPath();
                this.g.strokeStyle = this.o.fgColor;
                this.g.arc( this.xy, this.xy, this.radius - this.lineWidth + 1 + this.lineWidth * 2 / 3, 0, 2 * Math.PI, false);
                this.g.stroke();

                return false;
              }
            }
          });

        // Example of infinite knob, iPod click wheel
        var v, up=0,down=0,i=0
        ,$idir = $("div.idir")
        ,$ival = $("div.ival")
        ,incr = function() { i++; $idir.show().html("+").fadeOut(); $ival.html(i); }
        ,decr = function() { i--; $idir.show().html("-").fadeOut(); $ival.html(i); };
        $("input.infinite").knob(
        {
          min : 0
          , max : 20
          , stopper : false
          , change : function () {
            if(v > this.cv){
              if(up){
                decr();
                up=0;
              }else{up=1;down=0;}
            } else {
              if(v < this.cv){
                if(down){
                  incr();
                  down=0;
                }else{down=1;up=0;}
              }
            }
            v = this.cv;
          }
        });
      });

    </script>
    {{-- <script type="text/javascript">
      var form = $("#horizontal-pill-steps").show();
      form.steps({
        headerTag: "h3",
        bodyTag: "fieldset",
        transitionEffect: "slideLeft",
        onFinishing: function (event, currentIndex)
        {
           // alert("Submitted!");
           
            var form = $(this);

             form.submit();
        },
        onFinished: function (event, currentIndex) {
            // bodyTag: "fieldset"
            // alert("Finish button was clicked");
            }
        });
        
      var form = $("#horizontal-tabs-steps").show();
      form.children("div").steps({
        headerTag: "h3",
        bodyTag: "fieldset",
        transitionEffect: "slideLeft",
        // enableFinishButton: false,
        enablePagination: false,
        enableAllSteps: true,
        titleTemplate: "#title#",
        cssClass: "tabcontrol",
 
  onStepChanging: function (event, currentIndex, newIndex)
            {
if (currentIndex === 5) { //if last step
   //remove default #finish button
   $('#wizard').find('a[href="#finish"]').remove(); 
   //append a submit type button
   $('#wizard .actions li:last-child').append('<button type="submit" id="submit" class="btn-large"><span class="fa fa-chevron-right"></span></button>');
}
                
            },
        onFinishing: function (event, currentIndex)
        {
           alert("Submitted!");
            // var form = $(this);

            //  form.submit();
        },
        onFinished: function (event, currentIndex) {
            // bodyTag: "fieldset"
            alert("Finish button was clicked");
            }
        });

      
      </script> --}}
      <script type="text/javascript">
        $(document).ready(function(){
          "use strict";

          $('.btn-message').click(function(){
            swal("Here's a message!");
          });

          $('.btn-title-text').click(function(){
            swal("Here's a message!", "It's pretty, isn't it?")
          });

          $('.btn-timer').click(function(){
            swal({
              title: "Auto close alert!",
              text: "I will close in 2 seconds.",
              timer: 2000,
              showConfirmButton: false
            });
          });

          $('.btn-success').click(function(){
            swal("Good job!", "You clicked the button!", "success");
          });

          $('.btn-warning-confirm').click(function(){
            swal({
              title: "هل أنت متأكد؟",
              text: "لن تستطيع إسترجاع هذه المعلومة لاحقا",
              type: "warning",
              showCancelButton: true,
              confirmButtonColor: '#4f5c6b',
              confirmButtonText: 'نعم متأكد',
              closeOnConfirm: false
            },
            function(){
              swal("تم الحذف!", "تم الحذف بنجاح", "success");
            });
          });

        // $('.btn-warning-cancel').click(function(){
        //   swal({
        //     title: "هل أنت متأكد؟",
        //     text: "لن تستطيع إسترجاع هذه المعلومة لاحقا",
        //     type: "warning",
        //     showCancelButton: true,
        //     confirmButtonColor: '#DD6B55',
        //     confirmButtonText: 'نعم متأكد!',
        //     cancelButtonText: "إلغاء",
        //     closeOnConfirm: false,
        //     closeOnCancel: false
        //   },
        //   function(isConfirm){
        //     if (isConfirm){

        //       swal("تم الحذف!", "تم الحذف بنجاح", "success");
        //     } else {
        //       swal("تم الإلغاء", "المعلومات مازالت موجودة :)", "error");
        //     }
        //   });
        // });

        $('.btn-custom-icon').click(function(){
          swal({
            title: "Sweet!",
            text: "Here's a custom image.",
            imageUrl: 'img/favicon/apple-touch-icon-152x152.png'
          });
        });

        $('.btn-message-html').click(function(){
          swal({
            title: "HTML <small>Title</small>!",
            text: 'A custom <span style="color:#F8BB86">html<span> message.',
            html: true
          });
        });

        $('.btn-input').click(function(){
          swal({
            title: "An input!",
            text: 'Write something interesting:',
            type: 'input',
            showCancelButton: true,
            closeOnConfirm: false,
            animation: "slide-from-top",
            inputPlaceholder: "Write something",
          },
          function(inputValue){
            if (inputValue === false) return false;

            if (inputValue === "") {
              swal.showInputError("You need to write something!");
              return false;
            }

            swal("Nice!", 'You wrote: ' + inputValue, "success");

          });
        });

        $('.btn-theme').click(function(){
          swal({
            title: "Themes!",
            text: "Here's the Twitter theme for SweetAlert!",
            confirmButtonText: "Cool!",
            customClass: 'twitter'
          });
        });

        $('.btn-ajax').click(function(){
          swal({
            title: 'Ajax request example',
            text: 'Submit to run ajax request',
            type: 'info',
            showCancelButton: true,
            closeOnConfirm: false,
            showLoaderOnConfirm: true,
          }, function(){
            setTimeout(function() {
              swal('Ajax request finished!');
            }, 2000);
          });
        });

      });

    </script>
    <script type="text/javascript">
      $.fn.stars = function () {
        return $(this).each(function () {
          var rating = $(this).data("rating");
          var numStars = $(this).data("numStars");
          var fullStar = new Array(Math.floor(rating + 1)).join('<i class="fa fa-star"></i>');
          var halfStar = ((rating % 1) !== 0) ? '<i class="fa fa-star-half-empty"></i>' : '';
          var noStar = new Array(Math.floor(numStars + 1 - rating)).join('<i class="fa fa-star-o"></i>');
          $(this).html(fullStar + halfStar + noStar);
        });
      }
      $('.stars').stars();
      
    </script>
    <script type="text/javascript">
      var swiper = new Swiper('.slider .swiper-container', {
        pagination: '.swiper-pagination',
        paginationClickable: true,
        nextButton: '.swiper-button-next',
        prevButton: '.swiper-button-prev',
        autoplay: 2500,
        keyboardControl: true,
        loop: true,
        autoplayDisableOnInteraction: false,
        mousewheelControl: false,
      });
      var swiper = new Swiper('.slidespercolumn .swiper-container', {
        slidesPerView: 3,
        slidesPerColumn: 2,
        paginationClickable: true,
        spaceBetween: 5,
        autoplay: 2500,
        keyboardControl: true,
        loop: false,
        autoplayDisableOnInteraction: false,
        mousewheelControl: false,

      });
      
      var swiper = new Swiper('.slideperview .swiper-container', {
        pagination: '.swiper-pagination',
        slidesPerView: 4,
        paginationClickable: true,
        spaceBetween: 5,
        nextButton: '.swiper-button-next',
        prevButton: '.swiper-button-prev',
        autoplay: 2500,
        keyboardControl: true,
        loop: true,
        autoplayDisableOnInteraction: false,
        mousewheelControl: false,

      });
      
      var galleryTop = new Swiper('.gallery-swiper-slider .gallery-top', {
        nextButton: '.swiper-button-next',
        prevButton: '.swiper-button-prev',
        spaceBetween: 10,
        loop:true,
        loopedSlides: 5,
        mousewheelControl: false,

      });
      var galleryThumbs = new Swiper('.gallery-swiper-slider .gallery-thumbs', {
        spaceBetween: 10,
        slidesPerView: 4,
        touchRatio: 0.2,
        loop:true,
        loopedSlides: 5,
        slideToClickedSlide: true,
        mousewheelControl: false,

      });
      galleryTop.params.control = galleryThumbs;
      galleryThumbs.params.control = galleryTop;
      
    </script>

    <script type="text/javascript">
      $(document).ready(function(){
        if ( $('html').attr('lang') == 'ar' ) {
          var datatable_one =  $(".table-1").DataTable({
            'columnDefs': [{
              'targets': 0,
              'searchable':true,
              'orderable':false,
              'className': 'this-include-check'
              
            }],   
            'order': [1, 'asc'],

            // dom: '   <"row"    <" filterbar" flr + <"sortingr__btns_cont"  >> <"filter__btns_cont"  >    >  <"row"   <"col-xs-12"  t>    >  <"row"<"tableActions__btns_cont"> <"viewing-pagination"pi>  > ' ,
            dom: '   <"row"    <" filterbar" flr + <"sortingr__btns_cont"  >> <"filter__btns_cont"  >    >  <"row"   <"col-xs-12"  t>    >  <"row"<"tableActions__btns_cont"> <"viewing-pagination">  > ' ,
            "language": {
              "search": "dd",
              "sLengthMenu": "عرض _MENU_  ",
              search: " البحث _INPUT_",
              searchPlaceholder: "ابحث فى الجدول"          ,

              "emptyTable":     "لا توجد بيانات متاحه فى الجدول",
              "info":           "عرض _START_ إلى _END_ من أصل _TOTAL_ مُدخل",
              "infoEmpty":      " عرض  0 to 0 of 0 مُدخل",
              "infoFiltered":   "(filtered from _MAX_ total entries)",

              "loadingRecords": "جارى التحميل...",
              "processing":     "جارى المعالجة...",
              "zeroRecords":    "لا توجد نتائج مطابقة",
              "paginate": {
                "first":      "الاول",
                "last":       "الاخير",
                "next":       "التالى",
                "previous":   "السابق"
              },
              "aria": {
                "sortAscending":  ": رتب تصاعدياً",
                "sortDescending": ": رتب تنازلياً"
              }


            }
          });


          //-trigger check all 
          $('#dataTableTriggerId_001 #select-all').on('click', function(){
          // Check/uncheck all checkboxes in the table
          var rows = datatable_one.rows().nodes();
          $('input.input-in-table' , rows).prop('checked', this.checked);
        });


        } else {
          var datatable_one = $("#dataTableTriggerId_001").DataTable({
            'columnDefs': [{
              'targets': 0,
              'searchable':true,
              'orderable':false,
              'className': 'this-include-check'
              
            }],   
            'order': [1, 'asc'],

            dom: '   <"row"    <" filterbar" f + <"quick_filter_cont"  > + lr + <"sortingr__btns_cont"  >> <"filter__btns_cont"  >    >  <"row"   <"col-xs-12"  t>    >  <"row"<"tableActions__btns_cont"> <"viewing-pagination"pi>  > ' ,
            "language": {
              "search": "dd",
              "sLengthMenu": "Entries _MENU_  ",
              search: " Search _INPUT_",
              searchPlaceholder: "Search table ..."
            }
          });
           //-trigger check all 
           $('#dataTableTriggerId_001 #select-all').on('click', function(){
          // Check/uncheck all checkboxes in the table
          var rows = datatable_one.rows().nodes();
          $('input.input-in-table' , rows).prop('checked', this.checked);
        });
         }


         $('.table-2').DataTable({
          "paging": true,
          "lengthChange": false,
          "searching": false,
          "ordering": true,
          "info": true,
          "autoWidth": false
        });

         $(".full-table").each(function() {
          $(this).find(".filter__btns").appendTo($(this).find(".filter__btns_cont"));
          $(this).find(".sortingr__btns").appendTo($(this).find(".sortingr__btns_cont"));
          $(this).find(".bottomActions__btns").appendTo($(this).find(".tableActions__btns_cont"));
          $(this).find(".quick_filter").appendTo($(this).find(".quick_filter_cont"));
          $(this).find(".view_options").appendTo($(this).find(".view_options_cont"));

        });

       });
      
     </script>
     <script type="text/javascript">
      $(function () {
        $('.date_range_picker').daterangepicker();
        $('.date_time_range_picker').daterangepicker({timePicker: true, timePickerIncrement: 30, format: 'MM/DD/YYYY h:mm A'});
      });
      
      $(function () {
        $('.reservation').daterangepicker();
        $('.reservationtime').daterangepicker({timePicker: true, timePickerIncrement: 30, format: 'MM/DD/YYYY h:mm A'});
      });
      
    </script>
    <script type="text/javascript">
      $(function () {
        $().bootstrapSwitch && $(".make-switch").bootstrapSwitch();
      });
      
    </script>
    <script type="text/javascript">
      $(function () {
        $('.datepicker-popup').pickadate();
        $('.timepicker-popup').pickatime();
      });
      
    </script>
    <script type="text/javascript">
      $(function () {
        $('.datepicker').datepicker({autoclose: true});
        $(".timepicker").timepicker({showInputs: false});
      });
      
    </script>
    <script type="text/javascript">
      $(function () {
        $(".select2").select2();
      });
      
    </script>
    <script type="text/javascript">
      (function(){
        var options = {};
        $('.js-uploader__box').uploader(options);
      }());
      
    </script>
    <script type="text/javascript">
      $('.tree ul').fadeIn();
      $(document).on('click', '.tree span', function(e) {
        $(this).next('ul').fadeToggle();
        e.stopPropagation();
      });
      $(document).on('change', '.tree input[type=checkbox]', function(e) {
        $(this).siblings('ul').find("input[type='checkbox']").prop('checked', this.checked);
        $(this).parentsUntil('.tree').children("input[type='checkbox']").prop('checked', this.checked);
        e.stopPropagation();
      });
    </script>
    <script type="text/javascript"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/alasql/0.3.7/alasql.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.9.2/xlsx.core.min.js"></script>
        <script type="text/javascript">
      $('.notification').click(function(){
          var _token = '{{csrf_token()}}';
          var notification_id = $(this).parent().attr('data-notification-id');
     $.ajax({
       type:'POST',
       url:'{{url('notifications_change')}}'+'/'+notification_id,
       data:{_token:_token},
       success:function(response){
      }
    });

   });

    </script>


    {{-- Google maps API key --}}
  <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCknR0jhKTIB33f2CLFhBzgp0mj2Tn2q5k&libraries=places&callback=initMap&language=ar" type="text/javascript"></script>
  
  {{-- Map script --}}
   <script>
      var map;
      function initMap() {
        @if( isset($data->latitude) && isset($data->longitude) ) 
        var myLatlng = {lat: {{ $data->latitude }}, lng: {{ $data->longitude }} };
        @else 
          var myLatlng = {lat: 30.042701, lng: 31.432662};
        @endif  

        var geocoder = new google.maps.Geocoder;
        map = new google.maps.Map(document.getElementById('map'), {
          center: new google.maps.LatLng(myLatlng),
          zoom: 14,
          mapTypeId: 'roadmap'
        });
        var marker = new google.maps.Marker({
            position: myLatlng,
            map: map,
             draggable: true,
            title: 'Click to zoom'
          });
          google.maps.event.addListener(map, 'click', function(event) {
              placeMarker(event.latLng);
              
              document.getElementById("lat").value = event.latLng.lat();
              document.getElementById("lng").value = event.latLng.lng();
              geocoder.geocode({'latLng': event.latLng}, function(results, status) {
                if (status == google.maps.GeocoderStatus.OK) {
                  
                  if (results[0]) {
                    document.getElementById("address").value = results[0].formatted_address;
                    
                  }
                }
              });
          });
          function placeMarker(location) {
            if (marker == undefined){
                marker = new google.maps.Marker({
                    position: location,
                    map: map, 
                    animation: google.maps.Animation.DROP,
                });
            }
            else{
                marker.setPosition(location);
            }
            map.setCenter(location);
          }
      }
  </script> 
  

<script>
/* script */
function initMap() {
      @if( isset($data->latitude) && isset($data->longitude) ) 
        var latlng = {lat: {{ $data->latitude }}, lng: {{ $data->longitude }} };
      @else 
        var latlng = {lat: 30.042701, lng: 31.432662};
        
      @endif
      
   // var latlng = new google.maps.LatLng(28.5355161,77.39102649999995);
    var map = new google.maps.Map(document.getElementById('map'), {
      center: latlng,
      zoom: 13
    });
    var marker = new google.maps.Marker({
      map: map,
      position: latlng,
      draggable: true,
      anchorPoint: new google.maps.Point(0, -29)
   });
  //  var input = document.getElementById('searchInput');
    var input = document.getElementById('pac-input');
    // map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);
    var geocoder = new google.maps.Geocoder();
    var autocomplete = new google.maps.places.Autocomplete(input);
    autocomplete.bindTo('bounds', map);
    var infowindow = new google.maps.InfoWindow();   
    autocomplete.addListener('place_changed', function() {
        infowindow.close();
        marker.setVisible(false);
        var place = autocomplete.getPlace();
        if (!place.geometry) {
            window.alert("Autocomplete's returned place contains no geometry");
            return;
        }
        // If the place has a geometry, then present it on a map.
        if (place.geometry.viewport) {
            map.fitBounds(place.geometry.viewport);
        } else {
            map.setCenter(place.geometry.location);
            map.setZoom(17);
        }
       
        marker.setPosition(place.geometry.location);
        marker.setVisible(true);          
    
        bindDataToForm(place.formatted_address,place.geometry.location.lat(),place.geometry.location.lng());
        infowindow.setContent(place.formatted_address);
        infowindow.open(map, marker);
       
    });
    // this function will work on marker move event into map 
    google.maps.event.addListener(marker, 'dragend', function() {
        geocoder.geocode({'latLng': marker.getPosition()}, function(results, status) {
        if (status == google.maps.GeocoderStatus.OK) {
          if (results[0]) {        
              bindDataToForm(results[0].formatted_address,marker.getPosition().lat(),marker.getPosition().lng());
              infowindow.setContent(results[0].formatted_address);
              infowindow.open(map, marker);
          }
        }
        });
    });
}
function bindDataToForm(address,lat,lng){
//  document.getElementById('searchInput').value = address;
   document.getElementById('pac-input').value = address;
   document.getElementById('lat').value = lat;
   document.getElementById('lng').value = lng;
}
// google.maps.event.addDomListener(window, 'load', initialize);
</script>





    @yield('js')
  </body>
  </html>