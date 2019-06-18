@extends('layout.app')

@section('content')
<style>
        /* Always set the map height explicitly to define the size of the div
         * element that contains the map. */
        #map {
          height: 100% !important;
        }
        #description {
            font-family: Roboto;
            font-size: 15px;
            font-weight: 300;
          }
    
          #infowindow-content .title {
            font-weight: bold;
          }
    
          #infowindow-content {
            display: none;
          }
    
          #map #infowindow-content {
            display: inline;
          }
    
          .pac-card {
            margin: 10px 10px 0 0;
            border-radius: 2px 0 0 2px;
            box-sizing: border-box;
            -moz-box-sizing: border-box;
            outline: none;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
            background-color: #fff;
            font-family: Roboto;
          }
    
          #pac-container {
            padding-bottom: 12px;
            margin-right: 12px;
          }
    
          .pac-controls {
            display: inline-block;
            padding: 5px 11px;
          }
    
          .pac-controls label {
            font-family: Roboto;
            font-size: 13px;
            font-weight: 300;
          }
    
          #pac-input {
            background-color: #fff;
            font-family: Roboto;
            font-size: 15px;
            font-weight: 300;
            margin-left: 12px;
            padding: 0 11px 0 13px;
            text-overflow: ellipsis;
            width: 400px;
          }
    
          #pac-input:focus {
            border-color: #4d90fe;
          }
    
          #title {
            color: #fff;
            background-color: #4d90fe;
            font-size: 25px;
            font-weight: 500;
            padding: 6px 12px;
          }
          #target {
            width: 345px;
          }
      </style>

<div class="row">
        <div class="col-lg-12">
          <div class="cover-inside-container margin--small-top-bottom bradius--small bshadow--1" style="background:  url( '../img/covers/dummy2.jpg ' ) no-repeat center center; background-size:cover">
            <div class="edit-mode">Editing mode</div>
            <div class="row">
              <div class="col-xs-12">
                <div class="text-xs-center">
                  <div class="text-wraper">
                    <h4 class="cover-inside-title color--gray_d">البيانات الأساسية <i class="fa fa-chevron-circle-right"></i>
                      <h4 class="cover-inside-title color--gray_d">اللينكات  </h4>
                    </h4>
                  </div>
                </div>
              </div>
              <div class="cover--actions">
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-12">
          <div class="tabs--wrapper">
            <div class="clearfix"></div>
            <ul class="tabs">
              <!-- <li>بيانات اتصل بنا</li> -->
              <li>لينكات التواصل الاجتماعي</li>
              <li>لينكات التطبيق</li>
            </ul>
            <form method="POST" action="{{action('CompanyContactInfoController@index')}}" enctype="multipart/form-data" id="main_form">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <ul class="tab__content">
              <!-- <li class="tab__content_item active">
                <div class="cardwrap bgcolor--white bradius--noborder   bshadow--1 padding--small margin--small-top-bottom">
                  <div class="col-lg-12">
                    <div class="master_field">
                      <label class="master_label mandatory" for="lang_list">اختار اللغة</label>
                      <select class="master_input" id="lang_list" name="lang_id"> 
                        <option id="lang_2"  class="lang_option" VALUE="2" data-selected="2">English</option>
                        <option id="lang_1" class="lang_option"  value="1" data-selected="1">العربية</option>
                        <option id="lang_3"  class="lang_option" value="3" data-selected="3">French</option>
                      </select>
                    </div>
                    <div class="row">
                      <div class="col-md-6 col-xs-12">
                        <div class="master_field">
                          <label class="master_label mandatory" for="email">الايميل</label>
                          <input class="master_input" type="email" placeholder="الايميل..." id="email" name="email" value="{{$data->email}}"><span class="master_message color--fadegreen">message</span>
                        </div>
                      </div>
                      <div class="col-md-6 col-xs-12">
                        <div class="master_field">
                          <label class="master_label mandatory" for="tel">التليفون</label>
                          <input class="master_input" type="number" placeholder="التليفون..." id="tel" name="mobile" value="{{$data->mobile}}"><span class="master_message color--fadegreen">message</span>
                        </div>
                      </div>
                      <div class="col-md-12 col-xs-12">
                        <div class="master_field">
                          <label class="master_label mandatory" for="address">العنوان</label>
                          <input class="master_input" type="text" placeholder="العنوان..." id="address" name="address" value="{{$data->address}}"><span class="master_message color--fadegreen">message</span>
                        </div>
                      </div>
                      <div class="col-md-12 col-xs-12">
                        <div class="main-title-conts">
                          <div class="caption">
                            <h3>الموقع</h3>
                          </div>
                          <div class="actions">
                          </div><span class="mainseparator bgcolor--white"></span>
                          <input id="pac-input" class="controls" type="text" placeholder="Search Box">
                          <div id="map" style="width: 100%; height: 400px !important;"></div>
                            <input type="hidden" name="lat" id="lat" >
                            <input type="hidden" name="lng" id="lng" >
                        </div><br>
                        {{--  <img class="img-responsive" src="../img/map2.jpg" width="1150">  --}}
                        
              
                      </div>
                    </div>
                  </div>
                  <div class="clearfix"></div><br>
                  <div class="col-md-2 col-xs-6">
                    <button class="master-btn undefined btn-block color--white bgcolor--fadepurple bradius--small bshadow--0" id="submit_main_form" type="submit"><i class="fa fa-save"></i><span>حفظ</span>
                    {{--  <button class="" id="submit_main_form" type="submit"><i class="fa fa-save"></i><span>حفظ</span>  --}}
                    </button>
                  </div>
                  <div class="col-md-2 col-xs-6">
                    <button class="master-btn undefined btn-block color--white bgcolor--fadebrown bradius--small bshadow--0"><i class="fa fa-times"></i><span>الغاء</span>
                    </button>
                  </div>
                  <div class="clearfix"></div>
                </div>
              </li> -->
              <li class="tab__content_item active">
                <div class="cardwrap bgcolor--white bradius--noborder   bshadow--1 padding--small margin--small-top-bottom">
                  <div class="full-table">
                    <table class="table dataTable no-footer">
                      <thead>
                        <tr>
                          <th>ايكون</th>
                          <th>رابط الموقع</th>
                          <th>الاجراءات</th>
                        </tr>
                      </thead>
                      <tbody>
                          @foreach ($social_accounts as $social_account)
                        <tr data-id="{{$social_account->id}}">
                          <td><i class="{{$social_account->icon}}"></i></td>
                          <td>{{$social_account->url}}</td>
                         <td><a class="btn-warning-cancel action-btn bgcolor--fadebrown color--white" onclick="delete_btn({{$social_account->id}})"><i class="delete-icon fa fa-trash" id="delete_button"></i></a></td>
                                              
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                  <div class="col-md-2 col-sm-3 colxs-12 pull-right"><a class="master-btn color--white bgcolor--main bradius--small bshadow--0 btn-block" href="#popupModal_gov"><i class="fa fa-plus"></i><span>إضافة</span></a>
                    <div class="remodal-bg"></div>
                    <div class="remodal" data-remodal-id="popupModal_gov" role="dialog" aria-labelledby="modal1Title" aria-describedby="modal1Desc">
                      <button class="remodal-close" data-remodal-action="close" aria-label="Close"></button>
                      <div class="row">
                        <h3>إضافة</h3>
                      </div>


                      <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="master_field">
                          <label class="master_label mandatory" for="website_link">رابط الموقع</label>
                          <input class="master_input" type="text" placeholder="رابط الموقع" id="website_link" name="website_link">
                          
                        </div>
                      <div class="row">  
                          
                          </div>
                          <div class="col-lg-12">
                            <div class="main-title-conts">
                              <div class="caption">
                                <h3 class="color--main">الايكون</h3>
                              </div>
                              <div class="actions">
                              </div><span class="mainseparator bgcolor--main"></span>
                            </div>
                          </div>
                          <div class="col-xs-12 text-right">
                            <div class="col-md-1 col-sm-2 col-xs-4 text-center">
                              <label for="facebook"><i class="fa fa-facebook"></i></label>
                              <div class="radiorobo">
                                <input type="radio" id="facebook" name="social_icon" value="fa fa-facebook">
                                <label for="facebook"></label>
                              </div>
                            </div>
                            <div class="col-md-1 col-sm-2 col-xs-4text-center">
                              <label for="twitter"><i class="fa fa-twitter"></i></label>
                              <div class="radiorobo">
                                <input type="radio" id="twitter" name="social_icon" value="fa fa-twitter">
                                <label for="twitter"></label>
                              </div>
                            </div>
                            <div class="col-md-1 col-sm-2 col-xs-4 text-center">
                              <label for="instagram"><i class="fa fa-instagram"></i></label>
                              <div class="radiorobo">
                                <input type="radio" id="instagram" name="social_icon" value="fa fa-instagram">
                                <label for="instagram"></label>
                              </div>
                            </div>
                            <div class="col-md-1 col-sm-2 col-xs-4 text-center">
                              <label for="youtube"><i class="fa fa-youtube"></i></label>
                              <div class="radiorobo">
                                <input type="radio" id="youtube" name="social_icon" value="fa fa-youtube">
                                <label for="youtube"></label>
                              </div>
                            </div>
                            <div class="col-md-1 col-sm-2 col-xs-4 text-center">
                              <label for="linkedin"><i class="fa fa-linkedin"></i></label>
                              <div class="radiorobo">
                                <input type="radio" id="linkedin" name="social_icon" value="fa fa-linkedin">
                                <label for="linkedin"></label>
                              </div>
                            </div>
                            <div class="col-md-1 col-sm-2 col-xs-4 text-center">
                              <label for="google-plus"><i class="fa fa-google-plus"></i></label>
                              <div class="radiorobo">
                                <input type="radio" id="google-plus" name="social_icon" value="fa fa-google-plus">
                                <label for="google-plus"></label>
                              </div>
                            </div>
                            <div class="col-md-1 col-sm-2 col-xs-4 text-center">
                              <label for="pinterest"><i class="fa fa-pinterest"></i></label>
                              <div class="radiorobo">
                                <input type="radio" id="pinterest" name="social_icon" value="fa fa-pinterest">
                                <label for="pinterest"></label>
                              </div>
                            </div>
                            <div class="col-md-1 col-sm-2 col-xs-4 text-center">
                              <label for="quora"><i class="fa fa-quora"></i></label>
                              <div class="radiorobo">
                                <input type="radio" id="quora" name="social_icon" value="fa fa-quora">
                                <label for="quora"></label>
                              </div>
                            </div>
                          </div>
                          <div class="clearfix"></div>
                          <div class="clearfix"></div>
                        </form>
                      </div>
                      <div class="clearfix"></div><br>
                      <div class="text-center">
                        <button class="remodal-cancel" data-remodal-action="cancel">إلغاء</button>
                        <button class="remodal-confirm" data-remodal-action="confirm" id="social_submit_button">حفظ</button>
                      </div>
                    </div>
                    <div class="clearfix"></div>
                  </div>
                  <div class="clearfix"></div>
                </div>
              </li>
              <li class="tab__content_item">
                <div class="cardwrap bgcolor--white bradius--noborder   bshadow--1 padding--small margin--small-top-bottom">
                  <div class="col-xs-12">
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <div class="master_field">
                        <label class="master_label mandatory" for="android_link">App link in Android</label>
                        <input class="master_input" type="text" placeholder="App link in Android .." id="android_link" name="android_link" value="{{$data->android_app_url}}"><span class="master_message color--fadegreen">message </span>
                      </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <div class="master_field">
                        <label class="master_label mandatory" for="apple_link">App link in Apple store</label>
                        <input class="master_input" type="text" placeholder="App link in Apple store .." id="apple_link" name="apple_link" value="{{$data->apple_app_url}}"><span class="master_message color--fadegreen">message </span>
                      </div>
                    </div>
                  </div>
                  <div class="clearfix"></div>
                </div>
              </li>
            </ul>
          </div>
        </div>
      </div>
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
      <script type="text/javascript">
        var form = $("#horizontal-pill-steps").show();
        form.steps({
          headerTag: "h3",
          bodyTag: "fieldset",
          transitionEffect: "slideLeft",
          });
          
          
        var form = $("#horizontal-tabs-steps").show();
        form.steps({
          headerTag: "h3",
          bodyTag: "fieldset",
          transitionEffect: "slideLeft",
          enableFinishButton: false,
          enablePagination: false,
          enableAllSteps: true,
          titleTemplate: "#title#",
          cssClass: "tabcontrol"
          });
        
      </script>
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
        
          $('.btn-warning-cancel').click(function(){
            swal({
              title: "هل أنت متأكد؟",
              text: "لن تستطيع إسترجاع هذه المعلومة لاحقا",
              type: "warning",
              showCancelButton: true,
              confirmButtonColor: '#DD6B55',
              confirmButtonText: 'نعم متأكد!',
              cancelButtonText: "إلغاء",
              closeOnConfirm: false,
              closeOnCancel: false
            },
            function(isConfirm){
              if (isConfirm){
                swal("تم الحذف!", "تم الحذف بنجاح", "success");
              } else {
                swal("تم الإلغاء", "المعلومات مازالت موجودة :)", "error");
              }
            });
          });
        
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
            $(".table-1").DataTable({
              dom: '   <"row"    <" filterbar" flr + <"sortingr__btns_cont"  >> <"filter__btns_cont"  >    >  <"row"   <"col-xs-12"  t>    >  <"row"<"tableActions__btns_cont"> <"viewing-pagination"pi>  > ' ,
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
                "zeroRecords":    "لا توجد نتائج مطابخة",
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
          } else {
            $(".table-1").DataTable({
              dom: '   <"row"    <" filterbar" f + <"quick_filter_cont"  > + lr + <"sortingr__btns_cont"  >> <"filter__btns_cont"  >    >  <"row"   <"col-xs-12"  t>    >  <"row"<"tableActions__btns_cont"> <"viewing-pagination"pi>  > ' ,
              "language": {
                "search": "dd",
                "sLengthMenu": "Entries _MENU_  ",
                search: " Search _INPUT_",
                searchPlaceholder: "Search table ..."
              }
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
      <script type="text/javascript">
       $("#submit_main_form").on('click',function(){
          $("#main_form").submit();
       });

        $("#social_submit_button").on('click',function(){
           console.log($("#website_link").val());
          console.log($(".radiorobo :checked").val());
          var weblink = $("#website_link").val();
          var iconcode=$(".radiorobo :checked").val();
          var social_data={website_link: weblink,icon_code: iconcode};
          
          $.ajax({ 
            type: 'POST',
            url : '{{route("add_social_account")}}',
            data : {
              "social_data": social_data,
              "_token": "{{ csrf_token() }}"
            },
            success: function(){
              //console.log('success');
             $(".full-table").load(" .full-table");
            },
            error: function(){
              console.log('error');
            }
          });


        });



    </script>
    <script type="text/javascript">
   
      function delete_btn(id){
        $.ajax({ 
          type: 'POST',
          url : '{{route("delete_social_account")}}',
          data : {
            "id": id,
            "_token": "{{ csrf_token() }}"
          },
          success: function(){
            //console.log('success');

            $("tr[data-id="+id+"]").fadeOut();
          },
          error: function(){
            console.log('error');
          }

        });
      }
       
    </script> 


    <script>
     
    
     $(document).on('change','#lang_list',function(){
      var selected_lang=$("#lang_list").val();
      

      $.ajax({ 
        type: 'POST',
        url : '{{route("get_localization")}}',
        data : {
          "selected_lang":selected_lang,
          "_token": "{{ csrf_token() }}"
        },
        success: function(response){
        var address = response['address'];
        $("#address").val(address);
        console.log(address);
        },
        error: function(){
          console.log('error');
        }
      });
      });
    </script>

@endsection

