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
          <div class="tabs--wrapper">
              <div class="clearfix"></div>
              <ul class="tabs">
                <li>التصنيفات الرئيسية</li>
                <li>التصنيفات الفرعية</li>
              </ul>
              <ul class="tab__content">
                <li class="tab__content_item active">
                <div class="col-md-2 col-sm-3 colxs-12 pull-right">
                  <a class="master-btn color--white bgcolor--main bradius--small bshadow--0 btn-block" href="#add_main_contract">
                    <i class="fa fa-plus"></i><span>إضافة</span>
                  </a>
                    <div class="remodal-bg"></div>
                      <div class="remodal" data-remodal-id="add_main_contract" role="dialog" aria-labelledby="modal1Title" aria-describedby="modal1Desc">
                        <button class="remodal-close" data-remodal-action="close" aria-label="Close"></button>
                        <div>
                          <form action="{{route('contracts_formulas_types_store')}}" method="POST">
                            {{csrf_field()}}
                            <div class="row">
                              <div class="col-xs-12">
                                <h3>إضافة</h3>
                              </div>
                              <div class="col-xs-12">
                                <div class="master_field">
                                  <label class="master_label mandatory" for="contract_main_type_name">تصنيف الصيغة/ العقد</label>
                                  <input class="master_input" type="text" placeholder="تصنيف الصيغة / العقد" id="contract_main_type_name" name="contract_main_type_name">
                                  <span class="master_message color--fadegreen">
                                    @if($errors->has('contract_main_type_name'))
                                      {{$errors->first('contract_main_type_name')}}
                                    @endif
                                  </span>
                                </div>
                              </div>
                              <div class="clearfix"></div><br>
                              <div class="text-center">
                                <button class="remodal-cancel" data-remodal-action="cancel">إلغاء</button>
                                <button class="remodal-confirm" type="submit">حفظ</button>
                              </div>
                            </div>
                            <div class="clearfix"></div>
                          </form>   
                        </div>
                      </div>
                    </div>
                          <div class="full-table">
                            <div class="bottomActions__btns">
                              <a class="excel-main-btn master-btn bradius--small padding--small bgcolor--fadeblue color--white">استخراج اكسيل</a>
                              <a class="master-btn bradius--small padding--small bgcolor--fadebrown color--white contracts_formulas_main_type_destroyAll">حذف المحدد</a>
                            </div>
                            <div class="quick_filter">
                              <div class="dropdown quickfilter_dropb">
                                <button class="dropdown-toggle color--white bgcolor--main bradius--small bshadow--0" type="button" data-toggle="dropdown" id="quick_Filters_2"><small>اللغات  &nbsp;</small><i class="fa fa-angle-down"></i></button>
                                <div class="dropdown-menu" role="menu" aria-labelledby="quick_Filters_2">
                                  <div class="quick-filter-title">
                                    <p><b>اختار</b></p>
                                  </div>
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
                            <table class="table-1">
                              <thead>
                                <tr class="bgcolor--gray_mm color--gray_d">
                                  <th><span class="cellcontent">&lt;input type=&quot;checkbox&quot; name=&quot;select-all&quot; id=&quot;select-all&quot; /&gt;</span></th>
                                  <th><span class="cellcontent">التصنيف الرئيسي</span></th>
                                  <th><span class="cellcontent">الإجراءات</span></th>
                                </tr>
                              </thead>
                              <tbody>
                                @foreach($main_contracts as $main_contract)
                                  @if($main_contract->name != '')
                                    <tr data-main_contract="{{$main_contract->id}}">
                                      <td><span class="cellcontent"><input type="checkbox" class="checkboxes"/></span></td>
                                      <td><span class="cellcontent">{{$main_contract->name}}</span></td>
                                      <td>
                                        <span class="cellcontent">
                                          <a data-main_contract="{{$main_contract->id}}" class= "action-btn bgcolor--main color--white main_type_localization">  
                                            <i class = "fa fa-book"></i> &nbsp; اللغات
                                          </a>
                                          <a data-main_contract="{{$main_contract->id}}" class= "btn-warning-cancel action-btn bgcolor--fadebrown color--white main_type_destroy">
                                            <i class = "fa fa-trash-o"></i>
                                          </a>
                                        </span>
                                      </td>
                                    </tr>
                                  @endif
                                @endforeach
                              </tbody>
                            </table>
                            
                            <div class="remodal-bg"></div>
                            <div id="main_type_localization" class="remodal" data-remodal-id="main_type_localization" role="dialog" aria-labelledby="modal1Title" aria-describedby="modal1Desc">
                              <button class="remodal-close" data-remodal-action="close" aria-label="Close"></button>
                              <div>
                              <form action="{{route('contracts_formulas_main_type_localization')}}" method="POST">
                                {{csrf_field()}}
                                <input type="hidden" name="main_type_localization_id" id="main_type_localization_id">
                                <div class="row">
                                  <h4>ادخال التصنيف الاساسي باللغات</h4><br>
                                  <div class="col-sm-5">
                                    <div class="master_field">
                                      <label class="master_label mandatory" for="main_type_localization_lang">اختار اللغة</label>
                                      <select class="master_input" id="main_type_localization_lang" name="main_type_localization_lang">
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
                                      <label class="master_label mandatory" for="main_type_localization_name">ادخال الاسم باللغة المختاره</label>
                                      <input class="master_input" type="text" placeholder="اسم التصنيف" id="main_type_localization_name" name="main_type_localization_name">
                                      <span class="master_message color--fadegreen">
                                        @if($errors->has('main_type_localization_name'))
                                          {{$errors->first('main_type_localization_name')}}
                                        @endif
                                      </span>
                                    </div>
                                  </div>
                                  <div class="clearfix"></div>
                                </div><br>
                              <button class="remodal-cancel" data-remodal-action="cancel">إلغاء</button>
                              <button class="remodal-confirm" type="submit">حفظ</button>
                            </div>
                            </form>
                          </div>
                        </div>
                </li>
                <li class="tab__content_item">
                  <div class="col-md-2 col-sm-3 colxs-12 pull-right"><a class="master-btn color--white bgcolor--main bradius--small bshadow--0 btn-block" href="#add_sub_contract"><i class="fa fa-plus"></i><span>إضافة</span></a>
                    <div class="remodal-bg"></div>
                    <div class="remodal" data-remodal-id="add_sub_contract" role="dialog" aria-labelledby="modal1Title" aria-describedby="modal1Desc">
                      <button class="remodal-close" data-remodal-action="close" aria-label="Close"></button>
                      <div>
                      <form action="{{route('contracts_formulas_types_store_sub')}}" method="POST">
                        {{csrf_field()}}
                        <div class="row">
                          <div class="col-xs-12">
                            <h3>اضافة</h3>
                          </div>
                          <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="master_field">
                              <label class="master_label mandatory" for="main_type_id">التصنيف الرئيسي للصيغة / العقد</label>
                              <select class="master_input select2" id="main_type_id" name="main_type_id" style="width:100%">
                                @foreach ($main_contracts as $main_contract)
                                  @if($main_contract->name != '')
                                    <option value="{{$main_contract->id}}">{{$main_contract->name}}</option>
                                  @endif
                                @endforeach
                              </select>
                              <span class="master_message color--fadegreen">
                                @if($errors->has('main_type_id'))
                                  {{$errors->first('main_type_id')}}
                                @endif
                              </span>
                            </div>
                          </div>
                          <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="master_field">
                              <label class="master_label mandatory" for="sub_type_name">التصنيف الفرعي للصيغة / العقد</label>
                              <input class="master_input" type="text" placeholder="نوع الصيغة / العقد" id="sub_type_name" name="sub_type_name">
                              <span class="master_message color--fadegreen">
                                  @if($errors->has('sub_type_name'))
                                    {{$errors->first('sub_type_name')}}
                                  @endif
                              </span>
                            </div>
                          </div>
                          <div class="col-md-3 col-sm-6 col-xs-12">
                            <button class="master-btn undefined btn-inlineblock color--white bgcolor--fadepurple bradius--small bshadow--0" type="submit">
                              <span>حفظ واضافة المزيد</span>
                            </button>
                          </div>
                          <div class="clearfix"></div><br>
                          <div class="text-center">
                            <button class="remodal-cancel" data-remodal-action="cancel">إلغاء</button>
                            <button class="remodal-confirm" type="submit">حفظ</button>
                          </div>
                          <div class="clearfix"></div>
                        </div>
                      </form>
                      </div>
                    </div>
                  </div>
                  {{--localization modal --}} 
                  <div id="sub_type_localization" class="remodal" data-remodal-id="sub_type_localization" role="dialog" aria-labelledby="modal1Title" aria-describedby="modal1Desc">
                      <form role="form" action="{{route('contracts_formulas_sub_type_localization')}}" method="post">
                      {{csrf_field()}}
                      <button class="remodal-close" data-remodal-action="close" aria-label="Close"></button>
                        <div>
                          <div class="row">
                            <h4>ادخال اسم التصنيف بلغات متعددة</h4><br>
                            <input type="hidden" id="sub_type_localization_id" name="sub_type_localization_id">
                            <div class="col-sm-5">
                              <div class="master_field">
                                <label class="master_label mandatory" for="sub_type_localization_lang">اختار اللغة</label>
                                <select class="master_input" id="sub_type_localization_lang" name="sub_type_localization_lang">
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
                                <label class="master_label mandatory" for="sub_type_localization_name">ادخال التصنيف باللغة المختاره</label>
                                <input class="master_input" type="text" placeholder="اسم التصنيف" id="sub_type_localization_name" name="sub_type_localization_name">
                                <span class="master_message color--fadegreen">
                                  @if($errors->has('sub_type_localization_name'))
                                    {{$errors->first('sub_type_localization_name')}}
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
                          <div class="bottomActions__btns">
                            <a class="excel-sub-btn master-btn bradius--small padding--small bgcolor--fadeblue color--white">استخراج اكسيل</a>
                            <a class="master-btn bradius--small padding--small bgcolor--fadebrown color--white contracts_formulas_sub_type_destroyAll">حذف المحدد</a>
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
                                <tr data-sub_id="{{$sub->id}}">
                                  <td><span class="cellcontent"><input type="checkbox" class="checkboxes input-in-table" /></span></td>
                                  <td><span class="cellcontent">{{isset($sub->parent->name) ? $sub->parent->name : ''}}</span></td>
                                  <td><span class="cellcontent">{{$sub->name}}</span></td>
                                  <td> 
                                    <span class="cellcontent">   
                                      <a data-sub_id="{{$sub->id}}" class="action-btn bgcolor--main color--white sub_type_localization">
                                        <i class = "fa fa-book"></i> &nbsp; اللغات
                                      </a>
                                      <a data-sub_id="{{$sub->id}}" class="btn-warning-cancel action-btn bgcolor--fadebrown color--white sub_type_destroy">
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
                </li>
              </ul>
            </div>

<script type="text/javascript">

    $('.main_type_localization').click( function(){
      let id = $(this).data('main_contract');
      $('#main_type_localization_id').val(id);
      $('#main_type_localization').remodal().open();
    });

    // add localization
    $('.sub_type_localization').click( function(){
      let id = $(this).data('sub_id');
      $('#sub_type_localization_id').val(id);
      $('#sub_type_localization').remodal().open();
    });

    $(document).ready(function(){
      var test='@if(\session('tab')){{\session('tab')}}@endif';
      if(test !== ''){
        $('#f-tab,#first-tab').removeClass("active");
        $('#s-tab,#second-tab').addClass("active");
      }
    
      $('.main_type_destroy').click(function(){
          var id = $(this).data('main_contract');
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
              url:'{{url('contracts_formulas_main_type_destroy')}}'+'/'+id,
              data:{_token:_token},
              success:function(data){
                $('tr[data-main_contract='+id+']').fadeOut();
              }
            });
            swal("تم الحذف!", "تم الحذف بنجاح", "success");
          } else {
            swal("تم الإلغاء", "المعلومات مازالت موجودة :)", "error");
          }
        });
      });
    
    $('.sub_type_destroy').click(function(){
        var id = $(this).data('sub_id');
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
            url:'{{url('contracts_formulas_sub_type_destroy')}}'+'/'+id,
            data:{_token:_token},
            success:function(data){
              $('tr[data-sub_id='+id+']').fadeOut();
            }
          });
          swal("تم الحذف!", "تم الحذف بنجاح", "success");
        } else {
          swal("تم الإلغاء", "المعلومات مازالت موجودة :)", "error");
        }
      });
    });
    
          $('.contracts_formulas_main_type_destroyAll').click(function(){
              var selectedIds = $("input:checkbox:checked").map(function(){
                return $(this).closest('tr').data('main_contract');
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
                  url:'{{url('contracts_formulas_main_type_destroyAll')}}',
                  data:{ids:selectedIds,_token:_token},
                  success:function(data){
                    $.each( selectedIds, function( key, value ) {
                      $('tr[data-main_contract='+value+']').fadeOut();
                    });
                  }
                });
                  swal("تم الحذف!", "تم الحذف بنجاح", "success");
                } else {
                  swal("تم الإلغاء", "المعلومات مازالت موجودة :)", "error");
                }
              });
            });
            $('.contracts_formulas_sub_type_destroyAll').click(function(){
              var selectedIds = $("input:checkbox:checked").map(function(){
                return $(this).closest('tr').data('sub_id');
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
                  url:'{{url('contracts_formulas_sub_type_destroyAll')}}',
                  data:{ids:selectedIds,_token:_token},
                  success:function(data){
                    $.each( selectedIds, function( key, value ) {
                      $('tr[data-sub_id='+value+']').fadeOut();
                    });
                  }
                });
                  swal("تم الحذف!", "تم الحذف بنجاح", "success");
                } else {
                  swal("تم الإلغاء", "المعلومات مازالت موجودة :)", "error");
                }
              });
            });
    
    
              $('.excel-sub-btn').click(function(){
                var selectedIds = $("input:checkbox:checked").map(function(){
                  return $(this).closest('tr').attr('data-sub_id');
                }).get();
                $.ajax({
                type:'GET',
                url:'{{route('contracts_formulas_types_sub_excel')}}',
                data:{ids:selectedIds},
                success:function(response){
                  swal("تمت العملية بنجاح!", "تم استخراج الجدول علي هيئة ملف اكسيل", "success");
                  location.href = response;
                }
              });
            });
    
          $('.excel-main-btn').click(function(){
              var _token = '{{csrf_token()}}';
            var selectedIds = $("input:checkbox:checked").map(function(){
              return $(this).closest('tr').attr('data-main_contract');
            }).get();
            console.log(selectedIds);
            $.ajax({
              type:'POST',
              url:'{{route('contracts_formulas_types_main_excel')}}',
              data:{
                _token:_token,
                ids:selectedIds
              },
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