 @extends('layout.app')             
 @section('content')
    <div class="row">
      <div class="col-lg-12">
        <div class="cover-inside-container margin--small-top-bottom bradius--small bshadow--1" style="background:  url( '{{asset('img/covers/dummy2.jpg')}}' )no-repeat center center; background-size:cover;">
          <div class="row">
            <div class="col-xs-12">
              <div class="text-xs-center">
                <div class="text-wraper">
                  <h4 class="cover-inside-title color--gray_d">البيانات الأساسية <i class="fa fa-chevron-circle-right"></i>
                    <h4 class="cover-inside-title color--gray_d">انواع القضايا </h4>
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
    <div class="col-md-2 col-sm-3 colxs-12 pull-right"><a class="master-btn color--white bgcolor--main bradius--small bshadow--0 btn-block" href="#popupModal_1">
      <i class="fa fa-plus"></i><span>إضافة</span></a>
        <div class="remodal-bg"></div>
        <div class="remodal" data-remodal-id="popupModal_1" role="dialog" aria-labelledby="modal1Title" aria-describedby="modal1Desc">
        <form role="form" action="{{route('issues_types_store')}}" method="post">
          {{csrf_field()}}
          <button class="remodal-close" data-remodal-action="close" aria-label="Close"></button>
          <div>
            <div class="row">
              <div class="col-xs-12">
                <h3>إضافة</h3>
                  <div class="col-sm-12">
                  <div class="master_field">
                    <label class="master_label" for="case_type_new">ادخال نوع جديد من انواع القضايا</label>
                    <input class="master_input" type="text" placeholder="نوع جديد" id="case_type_new" value="{{ old('new_type') }}" name="new_type">
                    <span class="master_message color--fadegreen">
                      @if(count($errors) > 0)
                        @foreach($errors->all() as $error)
                        {{$error}}
                        @endforeach
                      @endif
                      @if(\session('error'))
                        {{\session('error')}}
                      @endif
                    </span>
                  </div>
                </div>
              <div class="clearfix"></div>
            </div>
          </div>
        </div><br>
        <button class="remodal-cancel" data-remodal-action="cancel">إلغاء</button>
        <button class="remodal-confirm" type="submit" >حفظ</button>
      </form>
      </div>
    </div>
    <div id="localization_modal" class="remodal" data-remodal-id="lang" role="dialog" aria-labelledby="modal1Title" aria-describedby="modal1Desc">
      <form role="form" action="{{route('issues_types_add_localization')}}" method="post">
        {{csrf_field()}}
      <button class="remodal-close" data-remodal-action="close" aria-label="Close"></button>
        <div>
          <div class="row">
            <h4>ادخال نوع القضية "النوع" باللغات</h4><br>
            <input type="hidden" id="issue_id" name="issue_id">
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
                <label class="master_label mandatory" for="case_type">ادخال النوع باللغة المختاره</label>
                <input class="master_input" type="text" placeholder="نوع جديد" id="case_type" name="case_type">
                <span class="master_message color--fadegreen">
                  @if($errors->has('case_type'))
                    {{$errors->first('case_type')}}
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
    <div class="full-table">
      <div class="remodal-bg">
        <div class="remodal" data-remodal-id="filterModal_sponsors" role="dialog" aria-labelledby="modal1Title" aria-describedby="modal1Desc">
          <button class="remodal-close" data-remodal-action="close" aria-label="Close"></button>
          <div>
            <h2 id="modal1Title">فلتر</h2>
            <div class="col-md-6">
              <div class="master_field">
                <label class="master_label mandatory" for="case_type"> النوع</label>
                <select class="master_input select2" id="case_type" multiple="multiple" data-placeholder=" النوع" style="width:100%;" ,>
                  <option>جنايات</option>
                  <option>جنح</option>
                </select><span class="master_message color--fadegreen">message content</span>
              </div>
            </div>
                  <div class="col-md-6">
                    <div class="master_field">
                      <label class="master_label mandatory" for="min_num">اقل عددالملفات </label>
                      <input class="master_input" type="number" placeholder="اقل عدد الملفات " id="min_num"><span class="master_message color--fadegreen">message</span>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="master_field">
                      <label class="master_label mandatory" for="max_num">اقصى عدد ملفات</label>
                      <input class="master_input" type="number" placeholder="اقصى عدد ملفات" id="max_num"><span class="master_message color--fadegreen">message</span>
                    </div>
                  </div>
                </div>
                <div class="clearfix"></div>
                <button class="remodal-cancel" data-remodal-action="cancel">الغاء</button>
                <button class="remodal-confirm" data-remodal-action="confirm">فلتر</button>
              </div>
            </div>
            <div class="bottomActions__btns"><a class="excel-btn master-btn bradius--small padding--small bgcolor--fadeblue color--white" href="#">استخراج اكسيل</a><a class="master-btn bradius--small padding--small bgcolor--fadebrown color--white btn-warning-cancel-all" href="#">حذف المحدد</a>
            </div>
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
            <table class="table-1" id="dataTableTriggerId_001">
              <thead>
                <tr class="bgcolor--gray_mm color--gray_d">
                  <th><span class="cellcontent">&lt;input type=&quot;checkbox&quot; name=&quot;select-all&quot; id=&quot;select-all&quot; /&gt;</span></th>
                  <th><span class="cellcontent">النوع</span></th>
                  <th><span class="cellcontent">الاجراءات</span></th>
                </tr>
              </thead>
              <tbody>
                @foreach($issues as $issue)
                  @if($issue->name != '')
                  <tr class="issue" data-issue-id="{{$issue->id}}">
                    <td><span class="cellcontent"><input type="checkbox" class="checkboxes input-in-table" /></span></td>
                    <td><span class="cellcontent">{{$issue->name}}</span></td>
                    <td>
                      <span class="cellcontent">
                        <a id="add_localization" data-issue_id="{{$issue->id}}" class= "action-btn bgcolor--main color--white add_localization">
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
            <div class="clearfix"></div>
          </div>
        </div>
      </div>
    </div>
    <script>
        $(document).ready(function(){
              $('.btn-warning-cancel').click(function(){
                var issue_id = $(this).closest('tr').attr('data-issue-id');
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
                     url:'{{url('issues_types_destroy')}}'+'/'+issue_id,
                     data:{_token:_token},
                     success:function(data){
                      $('tr[data-issue-id='+issue_id+']').fadeOut();
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
                  return $(this).closest('tr').attr('data-issue-id');
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
                     url:'{{url('issues_types_destroy_all')}}',
                     data:{ids:selectedIds,_token:_token},
                     success:function(data){
                      $.each( selectedIds, function( key, value ) {
                        $('tr[data-issue-id='+value+']').fadeOut();
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
                  return $(this).closest('tr').attr('data-issue-id');
                }).get();
                 console.log(selectedIds);
                $.ajax({
                 type:'GET',
                 url:'{{url('issues_types_excel')}}',
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
      $('#quick_Filters_2').click( function(){
        $('#lang_filter').toggle();
      });

      // add localization
      $('.add_localization').click( function(){
          var localization_modal = $('#localization_modal');
          localization_modal.find('#issue_id').val($(this).data('issue_id'));
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