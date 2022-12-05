@extends('layout.app')
@section('content')
  <div class="row">
      <div class="col-lg-12">
        <div class="cover-inside-container margin--small-top-bottom bradius--small bshadow--1" style="background:  url( '{{asset('img/covers/dummy2.jpg')}} ' ) no-repeat center center; background-size:cover;">
          <div class="row">
            <div class="col-xs-12">
              <div class="text-xs-center">
                <div class="text-wraper">
                  <h4 class="cover-inside-title color--gray_d">البيانات الأساسية <i class="fa fa-chevron-circle-right"></i>
                    <h4 class="cover-inside-title color--gray_d">الدرجات العلمية </h4>
                  </h4>
                </div>
              </div>
            </div>
            <div class="cover--actions"></div>
          </div>
        </div>
      </div>
      <div class="col-lg-12">
        @if(\session('success'))
          <div class="alert alert-success">
            {{\session('success')}}
          </div>
        @endif
        <div class="cardwrap bgcolor--white bradius--noborder bshadow--1 padding--small margin--small-top-bottom">
          <div class="col-md-2 col-sm-3 colxs-12 pull-right">
            <a class="master-btn color--white bgcolor--main bradius--small bshadow--0 btn-block" href="#popupModal_1">
              <i class="fa fa-plus"></i>
              <span>إضافة</span>
            </a>
            <div class="remodal-bg"></div>
            <div class="remodal" data-remodal-id="popupModal_1" role="dialog" aria-labelledby="modal1Title" aria-describedby="modal1Desc">
              <form role="form" action="{{route('degrees.store')}}" method="post">
              {{ csrf_field() }}
                <button class="remodal-close" data-remodal-action="close" aria-label="Close"></button>
                <div>
                  <div class="row">
                    <div class="col-xs-12">
                      <h3>إضافة</h3>
                      <div class="col-xs-12">
                        <div class="master_field">
                          <label class="master_label" for="ID_No">العنوان</label>
                          <input name="title" value="{{ old('title') }}" class="master_input" type="text" placeholder="عنوان الدرجة" id="ID_No"><span class="master_message color--fadegreen">
                            @if ($errors->has('title'))
                              {{ $errors->first('title')}}
                            @endif
                          </span>
                        </div>
                      </div>
                      <div class="col-xs-6">
                        <div class="master_field">
                          <label class="master_label mandatory" for="gover2">من </label>
                          <input name="from" value="{{ old('from') }}" class="master_input" type="number" placeholder="سنوات الخبره من" id="ID_No" min="1">
                          <span class="master_message color--fadegreen">
                            @if ($errors->has('from'))
                              {{ $errors->first('from')}}
                            @endif
                          </span>
                        </div>
                      </div>
                    <div class="col-xs-6">
                      <div class="master_field">
                        <label class="master_label mandatory" for="city2">إلى </label>
                        <input name="to" value="{{ old('to') }}" class="master_input" type="number" placeholder="سنوات الخبرة حتى" id="ID_No" min="1">
                        <span class="master_message color--fadegreen">
                          @if ($errors->has('to'))
                          {{ $errors->first('to')}}
                          @endif
                        </span>
                      </div>
                    </div>
                    <div class="clearfix"></div>
                  </div>
                </div>
              </div>
              <br>
              <button class="remodal-cancel" data-remodal-action="cancel">إلغاء</button>
              <button class="remodal-confirm" type="submit">حفظ</button>
              </form>
            </div>
          </div>
  
          {{--localization modal --}} 
          <div id="localization_modal" class="remodal" data-remodal-id="lang" role="dialog" aria-labelledby="modal1Title" aria-describedby="modal1Desc">
              <form role="form" action="{{route('degrees.add_localization')}}" method="post">
                {{csrf_field()}}
              <button class="remodal-close" data-remodal-action="close" aria-label="Close"></button>
                <div>
                  <div class="row">
                    <h4>ادخال عنوان الدرجة بلغات متعددة</h4><br>
                    <input type="hidden" id="academic_degree_id" name="academic_degree_id">
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
                        <label class="master_label mandatory" for="academic_degree_name">ادخال النوع باللغة المختاره</label>
                        <input class="master_input" type="text" placeholder="عنوان الدرجة الأكاديميه" id="academic_degree_name" name="academic_degree_name">
                        <span class="master_message color--fadegreen">
                          @if($errors->has('academic_degree_name'))
                            {{$errors->first('academic_degree_name')}}
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
          <div class="full-table">
            <div class="remodal-bg">
              <div class="remodal" data-remodal-id="filterModal_sponsors" role="dialog" aria-labelledby="modal1Title" aria-describedby="modal1Desc">
                <button class="remodal-close" data-remodal-action="close" aria-label="Close"></button>
                <div>
                  <h2 id="modal1Title">فلتر</h2>
                  <div class="col-md-6">
                    <div class="master_field">
                      <label class="master_label mandatory" for="academic_degree_name">الاسم</label>
                      <input class="master_input" type="text" placeholder="الاسم" id="academic_degree_name"><span class="master_message color--fadegreen">message</span>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="master_field">
                      <label class="master_label mandatory" for="city">المدينة</label>
                      <select class="master_input select2" id="city" multiple="multiple" data-placeholder="المدينة" style="width:100%;" ,>
                        <option>مدينة 1</option>
                        <option>مدينة 2</option>
                      </select><span class="master_message color--fadegreen">message content</span>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="master_field">
                      <label class="master_label mandatory" for="gover"> المحافظة </label>
                      <select class="master_input select2" id="gover" multiple="multiple" data-placeholder="المحافظة" style="width:100%;" ,>
                        <option>القاهرة</option>
                        <option>الجيزة</option>
                      </select><span class="master_message color--fadegreen">message content</span>
                    </div>
                  </div>
                </div>
                <div class="clearfix"></div>
                <button class="remodal-cancel" data-remodal-action="cancel">الغاء</button>
                <button class="remodal-confirm" data-remodal-action="confirm">فلتر</button>
              </div>
            </div>
            {{-- Language filter --}}
            <div class="quick_filter">
              <div class="dropdown quickfilter_dropb">
                <button class="dropdown-toggle color--black bgcolor--main bradius--small bshadow--0 lang-btn" type="button" data-toggle="dropdown" id="quick_Filters_2">
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
          </div>
    
            {{-- End Language filter--}}
            
            <div class="full-table">
              <div class="bottomActions__btns"><a id="exportXLS" class="excel-btn master-btn bradius--small padding--small bgcolor--fadeblue color--white" href="#">استخراج اكسيل</a><a class="master-btn bradius--small padding--small bgcolor--fadebrown color--white btn-warning-cancel-all" href="#">حذف المحدد</a>
              </div>
            <table class="table-1" id="dataTableTriggerId_001">
              <thead>
                <tr class="bgcolor--gray_mm color--gray_d">
                  <th><span class="cellcontent">&lt;input type=&quot;checkbox&quot; name=&quot;select-all&quot; id=&quot;select-all&quot; /&gt;</span></th>
                  <th><span class="cellcontent">العنوان</span></th>
                  <th><span class="cellcontent">سنوات الخبرة من</span></th>
                  <th><span class="cellcontent">سنوات الخبرة حتى</span></th>
                  <th><span class="cellcontent">الاجراءات</span></th>
                </tr>
              </thead>
              <tbody>
                @foreach($academic_degrees as $academic_degree)
                  @if($academic_degree->title != '')
                  <tr class="academic_degree" data-academic_degree-id="{{$academic_degree->id}}">
                    <td>
                      <span class="cellcontent"><input data-id="{{ $academic_degree->id }}" type="checkbox" class="checkboxes input-in-table" /></span></td>
                    <td>
                      <span class="cellcontent">{{$academic_degree->title}}</span></td>
                    <td>
                      <span class="cellcontent">{{$academic_degree->from}} سنة/سنين</span></td>
                    <td>
                      <span class="cellcontent">{{$academic_degree->to}} سنين</span></td>
                    <td>
                      <span class="cellcontent">   
                        <a id="add_localization" data-city_id="{{$academic_degree->id}}" class= "action-btn bgcolor--main color--white add_localization">
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


<script>
$(document).ready(function(){  
  $("select[name='govs']").change(function () {
  var gov_id = $("select[name='govs']").val();
  if (gov_id !== '' && gov_id !== null) {
  $("select[name='cities']").prop('disabled',
  false).find('option[value]').remove();
  $.ajax({
  type: 'GET',
  url: '{{url('academic_degrees_get_city')}}', // do not forget to register your route
  data: {id: gov_id },
  }).done(function (data) {
  $.each(data, function (key, value) {
  $("select[name='cities']")
  .append($("<option></option>")
  .attr("value", key)
  .text(value));
  });
  }).fail(function(jqXHR, textStatus){
  console.log(jqXHR);
  });
  } else {
  $("select[name='cities']").prop('disabled',
  true).find("option[value]").remove();
  }
  });
  
          $('.btn-warning-cancel').click(function(){
            var academic_degree_id = $(this).closest('tr').attr('data-academic_degree-id');
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
                 url:'{{url('academic_degrees/destroy/')}}'+'/'+academic_degree_id,
                 data:{_token:_token},
                 success:function(data){
                  $('tr[data-academic_degree-id='+academic_degree_id+']').fadeOut();
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
              return $(this).closest('tr').attr('data-academic_degree-id');
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
                 url:'{{url('academic_degrees/destroyall/')}}',
                 data:{ids:selectedIds,_token:_token},
                 success:function(data){
                  $.each( selectedIds, function( key, value ) {
                    $('tr[data-academic_degree-id='+value+']').fadeOut();
                  });
                 }
              });
                swal("تم الحذف!", "تم الحذف بنجاح", "success");
              } else {
                swal("تم الإلغاء", "المعلومات مازالت موجودة :)", "error");
              }
            });
          });
  
          // Export table as Excel file
          $('#exportXLS').click(function(){
            var allVals = [];                   // selected IDs
  
            // push cities IDs selected by user
            $('.checkboxes:checked').each(function() {
              allVals.push($(this).attr('data-id'));
            });
            
            // check if user selected nothing
            if(allVals.length <= 0) {
              // push all IDs
              $('.checkboxes').each(function() {
                allVals.push($(this).attr('data-id'));
              });
            }
            
            var ids = allVals.join(",");    // join array of IDs into a single variable to explode in controller
             var _token = '{{csrf_token()}}';
  
            $.ajax(
            {
              url: "{{ route('degrees.store') }}",
              type: 'POST',
              data: {
                  "ids": ids,
                  "_method": 'POST',
                    "_token":_token
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

      // add localization
      $('.add_localization').click( function(){
          var localization_modal = $('#localization_modal');
          var id = $(this).closest('tr').attr('data-academic_degree-id');
          console.log(id);
          $('#academic_degree_id').val(id);
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