@extends('layout.app')
@section('content')
    <div class="row">
      <div class="col-lg-12">
        <div class="cover-inside-container margin--small-top-bottom bradius--small bshadow--1" style="background:  url( '{{asset('img/covers/dummy2.jpg')}}') no-repeat center center; background-size:cover;">
          <div class="row">
            <div class="col-xs-12">
              <div class="text-xs-center">
                <div class="text-wraper">
                  <h4 class="cover-inside-title color--gray_d">البيانات الأساسية <i class="fa fa-chevron-circle-right"></i>
                    <h4 class="cover-inside-title color--gray_d">انواع الصيغ و العقود </h4>
                  </h4>
                </div>
              </div>
            </div>
            <div class="cover--actions"><span></span>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-12">
        @if(\session('success'))
        <div class="alert alert-success">
        {{\session('success')}}
        </div>
        @endif
        <div class="cardwrap bgcolor--white bradius--noborder   bshadow--1 padding--small margin--small-top-bottom">
          <div class="col-md-2 col-sm-3 colxs-12 pull-right"><a class="master-btn color--white bgcolor--main bradius--small bshadow--0 btn-block" href="#popupModal_1"><i class="fa fa-plus"></i><span>إضافة</span></a>
            <div class="remodal-bg"></div>
            <div class="remodal" data-remodal-id="popupModal_1" role="dialog" aria-labelledby="modal1Title" aria-describedby="modal1Desc">
              <button class="remodal-close" data-remodal-action="close" aria-label="Close"></button>
              <div>
                <div class="row">
                  <div class="col-xs-12">
                    <h3>إضافة</h3>
                    <div class="tabs--wrapper">
                      <div class="clearfix"></div>
                      <ul class="tabs">
                        <li id="f-tab">التصنيفات الرئيسية</li>
                        <li id="s-tab">التصنيفات الفرعية</li>
                      </ul>
                      <ul class="tab__content">

                        <li class="tab__content_item active" id="first-tab">
                        <form role="form" action="{{route('contracts_formulas_types_store')}}" method="post">
                        {{ csrf_field() }}
                          <div class="col-xs-12">
                            <div class="master_field">
                              <label class="master_label mandatory" for="type">تصنيف الصيغة/ العقد</label>
                              <input name="main" value="{{ old('main') }}" class="master_input" type="text" placeholder="تصنيف الصيغة / العقد" id="type"><span class="master_message color--fadegreen">               
                          @if ($errors->has('main'))
                          {{ $errors->first('main')}}
                          @endif</span>
                            </div>
                          </div>
                          <div class="clearfix"></div><br>
                          <div class="text-center">
                            <button class="remodal-cancel" data-remodal-action="cancel">إلغاء</button>
                            <button class="remodal-confirm" type="submit">حفظ</button>
                          </div>
                        </form>
                        </li>


                        <li class="tab__content_item" id="second-tab">
                        <form role="form" action="{{route('contracts_formulas_types_store_sub')}}" method="post">
                          {{ csrf_field() }}
                          <div class="col-lg-12">
                            <div class="master_field">
                              <label class="master_label mandatory" for="main_type">التصنيف الرئيسي للصيغة / العقد</label>
                              <select name="mains" class="master_input select2" id="main_type" style="width:100%;">
                                <option value="choose" selected disabled>اختر تصنيف رئيسي</option>
                                @foreach($main_contracts as $main_contract)
                                  @if($main_contract->name != '')
                                    <option value="{{$main_contract->id}}">{{$main_contract->name}}</option>
                                  @endif
                                @endforeach
                              </select><span class="master_message color--fadegreen">
                          @if ($errors->has('mains'))
                          {{ $errors->first('mains')}}
                          @endif</span>
                            </div>
                          </div>
                          <div class="col-xs-12">
                            <div class="master_field">
                              <label class="master_label mandatory" for="type_main">التصنيف الفرعي للصيغة / العقد</label>
                              <input name="sub" value="{{ old('sub') }}" class="master_input" type="text" placeholder="نوع الصيغة / العقد" id="type_main"><span class="master_message color--fadegreen"> 
                          @if ($errors->has('sub'))
                          {{ $errors->first('sub')}}
                          @endif</span>
                            </div>
                          </div>
                          <div class="col-md-3 col-sm-6 col-xs-12">
                            <button name="action" value="more" class="master-btn undefined btn-inlineblock color--white bgcolor--fadepurple bradius--small bshadow--0" type="submit"><span>حفظ واضافة المزيد</span>
                            </button>
                                @if(\session('success_more'))
                                <div class="alert alert-success">
                                {{\session('success_more')}}
                                </div>
                                @endif
                          </div>
                          <div class="clearfix"></div><br>
                          <div class="text-center">
                            <button class="remodal-cancel" data-remodal-action="cancel">إلغاء</button>
                            <button name="action" value="one" class="sotre-sub remodal-confirm" type="submit">حفظ</button>
                          </div>
                      </form>
                        </li>
                        <div class="clearfix"></div>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          {{--localization modal --}} 
          <div id="localization_modal" class="remodal" data-remodal-id="lang" role="dialog" aria-labelledby="modal1Title" aria-describedby="modal1Desc">
              <form role="form" action="{{route('contracts_formulas_types_add_localization')}}" method="post">
                {{csrf_field()}}
              <button class="remodal-close" data-remodal-action="close" aria-label="Close"></button>
                <div>
                  <div class="row">
                    <h4>ادخال اسم التصنيف بلغات متعددة</h4><br>
                    <input type="hidden" id="sub_id" name="sub_id">
                    <div class="col-sm-5">
                      <div class="master_field">
                        <label class="master_label mandatory" for="lang_id">اختار اللغة</label>
                        <select class="master_input" id="lang_id" name="lang_id">
                          @foreach($languages as $lang)
                            @if($lang->id != 1)
                            <option value="{{$lang->id}}">{{$lang->name}}</option>
                            @endif
                          @endforeach
                        </select>
                      </div>
                    </div>
                    <div class="col-sm-7">
                      <div class="master_field">
                        <label class="master_label mandatory" for="sub_name">ادخال التصنيف باللغة المختاره</label>
                        <input class="master_input" type="text" placeholder="اسم التصنيف" id="sub_name" name="sub_name">
                        <span class="master_message color--fadegreen">
                          @if($errors->has('sub_name'))
                            {{$errors->first('sub_name')}}
                          @endif
                        </span>
                      </div>
                    </div>
                    <div class="clearfix"></div>
                  </div>
                  </div><br>
                  <button class="remodal-cancel" data-remodal-action="cancel">إلغاء</button>
                  <button class="remodal-confirm" remodal-action="confirm" type="submit">حفظ</button>
                </form>
              </div>  
              {{-- End localization modal --}}
                {{-- Language filter --}}
                <div class="quick_filter">
                  <div class="dropdown quickfilter_dropb">
                    <button class="dropdown-toggle color--white bgcolor--main bradius--small bshadow--0" type="button" data-toggle="dropdown" id="quick_Filters_2">
                      <small>اللغات  &nbsp;</small>
                      <i class="fa fa-angle-down"></i>
                    </button>
                    <div class="dropdown-menu" role="menu" aria-labelledby="quick_Filters_2" id="lang_filter">
                      <div class="quick-filter-title"><p><b>اختار</b></p></div>
                      <div class="quick-filter-content">
                      @foreach($languages as $lang)
                        @if($lang->id != \Session::get('AppLocale'))
                        <div class="radiorobo">
                          <input type="radio" id="lang_{{$lang->id}}" name="lang_id" value="{{$lang->id}}" onclick="ChangeLang({{$lang->id}})">
                          <label for="lang_{{$lang->id}}">{{$lang->name}}</label>
                        </div>
                        @endif
                      @endforeach
                      </div>
                    </div>
                  </div>
                </div>
                {{-- End Language filter--}}
                <div class="full-table">
                  <div class="bottomActions__btns"><a class="excel-btn master-btn bradius--small padding--small bgcolor--fadeblue color--white" href="#">استخراج اكسيل</a><a class="master-btn bradius--small padding--small bgcolor--fadebrown color--white btn-warning-cancel-all" href="#">حذف المحدد</a>
                  </div>
                  <table class="table-1" id="dataTableTriggerId_001">
                    <thead>
                      <tr class="bgcolor--gray_mm color--gray_d">
                        <th><span class="cellcontent">&lt;input type=&quot;checkbox&quot; name=&quot;select-all&quot; id=&quot;select-all&quot; /&gt;</span></th>
                        <th><span class="cellcontent">التصنيف الرئيسي</span></th>
                        <th><span class="cellcontent"> التصنيف الفرعي</span></th>
                        <th><span class="cellcontent">الإجراءات</span></th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($subs as $sub)
                        @if($sub->name != '')
                        <tr data-sub-id="{{$sub->id}}">
                          <td><span class="cellcontent"><input type="checkbox" class="checkboxes input-in-table" /></span></td>
                          <td><span class="cellcontent">{{$sub->parent->name}}</span></td>
                          <td><span class="cellcontent">{{$sub->name}}</span></td>
                          <td> 
                            <span class="cellcontent">   
                              <a id="add_localization" data-sub-id="{{$sub->id}}" class= "action-btn bgcolor--main color--white add_localization">
                                <i class = "fa fa-book"></i> &nbsp; اللغات
                              </a>
                              <a href="#" class= "btn-warning-cancel action-btn bgcolor--fadebrown color--white ">
                                <i class = "fa fa-trash-o"></i>
                              </a>
                            </span>
                          </td>
                        </tr>
                        @endif
                      @endforeach
                    </tbody>
                  </table>
                    </div>
                    <div class="clearfix"></div>
                  </div>
                </div>
              </div>
              <script type="text/javascript">

                $(document).ready(function(){
                 var test='@if(\session('tab')){{\session('tab')}}@endif';
                 if(test !== ''){
                   $('#f-tab,#first-tab').removeClass("active");
                   $('#s-tab,#second-tab').addClass("active");
                 }
               
                 $('.btn-warning-cancel').click(function(){
                   var sub_id = $(this).closest('tr').attr('data-sub-id');
                   var _token = '{{csrf_token()}}';
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
                      $.ajax({
                        type:'POST',
                        url:'{{url('contracts_formulas_types_destroy')}}'+'/'+sub_id,
                        data:{_token:_token},
                        success:function(data){
                         $('tr[data-sub-id='+sub_id+']').fadeOut();
                       }
                     });
                      swal("تم الحذف!", "تم الحذف بنجاح", "success");
                    } else {
                     swal("تم الإلغاء", "المعلومات مازالت موجودة :)", "error");
                   }
                 });
                 });
               
                         $('.btn-warning-cancel-all').click(function(){
                         var selectedIds = $("input:checkbox:checked").map(function(){
                           return $(this).closest('tr').attr('data-sub-id');
                         }).get();
                         var _token = '{{csrf_token()}}';
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
                            $.ajax({
                              type:'POST',
                              url:'{{url('contracts_formulas_types_destroy_all')}}',
                              data:{ids:selectedIds,_token:_token},
                              success:function(data){
                               $.each( selectedIds, function( key, value ) {
                                 $('tr[data-sub-id='+value+']').fadeOut();
                               });
                              }
                           });
                             swal("تم الحذف!", "تم الحذف بنجاح", "success");
                           } else {
                             swal("تم الإلغاء", "المعلومات مازالت موجودة :)", "error");
                           }
                         });
                       });
               
                         $('.excel-btn').click(function(){
                           var selectedIds = $("input:checkbox:checked").map(function(){
                             return $(this).closest('tr').attr('data-sub-id');
                           }).get();
                           $.ajax({
                            type:'GET',
                            url:'{{url('contracts_formulas_types_excel')}}',
                            data:{ids:selectedIds},
                            success:function(response){
                             swal("تمت العملية بنجاح!", "تم استخراج الجدول علي هيئة ملف اكسيل", "success");
                             location.href = response;
                           }
                         });
                         });
               
                       window.setTimeout(function() {
                           $(".alert").fadeTo(500, 0).slideUp(500, function(){
                               $(this).remove(); 
                           });
                       }, 4000);
                       
               });
               
        //language filter
        $('#quick_Filters_2').click( function(){
            $('#lang_filter').toggle();
          });
    
          // add localization
          $('.add_localization').click( function(){
              var localization_modal = $('#localization_modal');
              var id = $(this).closest('tr').attr('data-sub-id');
              $('#sub_id').val(id);
              $('#localization_modal').remodal().open();
          });
    
          //change lang
          function ChangeLang(id){
            $.ajax({
                  url: '{{ route("change.language") }}',
                  type: 'POST',
                  dataType: "JSON",
                  data: {
                      _token: '{{ csrf_token() }}',
                      locale: id,
                      method: 'POST',
                  },
                  success: function (response) {
                    window.location.href = '{{ Request::url() }}';
                  },
                  error: function(response) {
                    console.log(response);
                  }
              });
          }
          </script>

@endsection