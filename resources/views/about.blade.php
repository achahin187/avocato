 @extends('layout.app')             
 @section('content')
 <div class="container-fluid">
    <div class="row">
      <div class="col-lg-12">
        <div class="cover-inside-container margin--small-top-bottom bradius--small bshadow--1" style="background:  url( '../img/covers/dummy2.jpg ' ) no-repeat center center; background-size:cover">
          <div class="row">
            <div class="col-xs-12">
              <div class="text-xs-center">
                <div class="text-wraper">
                  <h4 class="cover-inside-title color--gray_d">البيانات الأساسية <i class="fa fa-chevron-circle-right"></i>
                    <h4 class="cover-inside-title color--gray_d">عن جسر الأمان </h4>
                  </h4>
                </div>
              </div>
            </div>
          <div class="cover--actions"><a class="color--gray_d bordercolor--white bradius--small border-btn master-btn" type="button" href="{{route('about_edit')}}">تعديل </a>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-12">
        <div class="cardwrap bgcolor--white bradius--noborder   bshadow--1 padding--small margin--small-top-bottom">
          <div class="tabs--wrapper">
            <div class="clearfix"></div>
            <ul class="tabs">                     
              @foreach($about as $tab)
                <li {!!$tab->id==1 ? 'class="test"':''!!} >{{$tab->name}}</li>
              @endforeach
            </ul>
            <ul class="tab__content">
                @foreach($about as $tab_content)
                <li class="tab__content_item @if($tab_content->id == 1) active @endif">
                  <div class="panel panel-default">
                    <div class="panel-heading" id="heading-1" role="tab">
                      <h4 class="panel-title bgcolor--fadered bradius--noborder bshadow--1 padding--small margin--small-top-bottom about-lang">
                        <a class="trigger color--white" role="button" data-toggle="collapse" href="#{{str_replace(' ', '', $tab_content->name)}}_collapse-1" aria-expanded="true" aria-controls="collapse-1">
                          English
                        </a>
                      </h4>
                    </div>
                  </div>
                  <div class="panel-collapse collapse" id="{{str_replace(' ', '', $tab_content->name)}}_collapse-1" role="tabpanel" aria-labelledby="heading-1" aria-expanded="true">
                    <div class="panel-body bgcolor--white bradius--noborder bshadow--1 padding--small margin--small-top-bottom">
                      <div class="row">
                        <div class="col-lg-12">
                          <p>
                              {{\Helper::localizations('fixed_pages' , 'content' , $tab_content->id, 2)}}
                          </p>
                        </div>
                      </div>
                    </div>
                    <div class="clearfix"></div>
                  </div>
                  <div class="panel panel-default">
                    <div class="panel-heading" id="heading-2" role="tab">
                      <h4 class="panel-title bgcolor--fadeblue bradius--noborder bshadow--1 padding--small margin--small-top-bottom">
                        <a class="trigger color--white" role="button" data-toggle="collapse" href="#{{ str_replace(' ', '', $tab_content->name)}}_collapse-2" aria-expanded="true" aria-controls="collapse-2">
                          اللغة العربية
                        </a>
                      </h4>
                    </div>
                  </div>
                  <div class="panel-collapse collapse" id="{{str_replace(' ', '', $tab_content->name)}}_collapse-2" role="tabpanel" aria-labelledby="heading-2" aria-expanded="true">
                    <div class="panel-body bgcolor--white bradius--noborder bshadow--1 padding--small margin--small-top-bottom">
                      <div class="row">
                        <div class="col-lg-12">
                          <p>
                              {!! $tab_content->content !!}
                          </p>
                        </div>
                      </div>
                    </div>
                    <div class="clearfix"></div>
                  </div>
                  <div class="panel panel-default">
                    <div class="panel-heading" id="heading-3" role="tab">
                      <h4 class="panel-title bgcolor--fadegreen bradius--noborder bshadow--1 padding--small margin--small-top-bottom">
                        <a class="trigger color--white" role="button" data-toggle="collapse" href="#{{str_replace(' ', '', $tab_content->name)}}_collapse-3" aria-expanded="true" aria-controls="collapse-3">
                          French
                        </a>
                      </h4>
                    </div>
                  </div>
                  <div class="panel-collapse collapse" id="{{str_replace(' ', '', $tab_content->name)}}_collapse-3" role="tabpanel" aria-labelledby="heading-3" aria-expanded="true">
                    <div class="panel-body bgcolor--white bradius--noborder bshadow--1 padding--small margin--small-top-bottom">
                      <div class="row">
                        <div class="col-lg-12">
                          <p>
                            {{ \Helper::localizations('fixed_pages' , 'content' , $tab_content->id, 3) }}
                            </p>
                          </div>
                        </div>
                      </div>
                    </div>
                </li>         
                @endforeach   
            </ul>
          </div>
        </div>
      </div>
    </div>
    <!-- =============== PAGE VENDOR Triggers ===============-->
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
    // var form = $("#horizontal-pill-steps").show();
    // form.steps({
    //   headerTag: "h3",
    //   bodyTag: "fieldset",
    //   transitionEffect: "slideLeft",
    //   });
      
      
    // var form = $("#horizontal-tabs-steps").show();
    // form.steps({
    //   headerTag: "h3",
    //   bodyTag: "fieldset",
    //   transitionEffect: "slideLeft",
    //   enableFinishButton: false,
    //   enablePagination: false,
    //   enableAllSteps: true,
    //   titleTemplate: "#title#",
    //   cssClass: "tabcontrol"
    //   });
    
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
    
@endsection