@extends('layout.app')
@section('content')
    <!-- =============== Custom Content ===============-->
    <div class="row">
                <div class="col-lg-12">
                  <div class="cover-inside-container margin--small-top-bottom bradius--small bshadow--1" style="background:  url( '../img/covers/dummy2.jpg ' ) no-repeat center center; background-size:cover">
                    <div class="row">
                      <div class="col-xs-12">
                        <div class="text-xs-center">
                          <div class="text-wraper">
                            <h4 class="cover-inside-title color--gray_d">البيانات الأساسية <i class="fa fa-chevron-circle-right"></i>
                              <h4 class="cover-inside-title color--gray_d">اتصل بنا </h4>
                            </h4>
                          </div>
                        </div>
                      </div>
                      <div class="cover--actions"><a class="color--gray_d bordercolor--white bradius--small border-btn master-btn" type="button" href="{{route('contactus_add')}}">اضافة</a>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-lg-12">
                @if ( Session::has('success') )
                      <div class="alert alert-success text-center">{{ Session::get('success') }}</div>
                  @endif
              
                  @if ( Session::has('error') )
                      <div class="alert alert-warning text-center">{{ Session::get('error') }}</div>
                  @endif
                  <div class="cardwrap bgcolor--white bradius--noborder   bshadow--1 padding--small margin--small-top-bottom">
                    <div class="full-table">
                      <div class="filter__btns"><a class="master-btn bgcolor--main color--white bradius--small" href="#filterModal_sponsors"><i class="fa fa-filter"></i>filters</a></div>
                      <div class="bottomActions__btns"><a class="master-btn bradius--small padding--small bgcolor--fadebrown color--white btn-warning-cancel-all" href="#">حذف المحدد</a>
                      </div>
                      <div class="quick_filter">
                        <div class="dropdown quickfilter_dropb">
                          <button class="dropdown-toggle color--white bgcolor--main bradius--small bshadow--0" type="button" data-toggle="dropdown" id="quick_Filters_2"><small>اللغات  &nbsp;</small><i class="fa fa-angle-down"></i></button>
                          <div class="dropdown-menu" role="menu" aria-labelledby="quick_Filters_2">
                            <div class="quick-filter-title">
                              <p><b>اختار</b></p>
                            </div>
                            <div class="quick-filter-content">
                              <div class="radiorobo">
                                <input type="radio" id="english">
                                <label for="english">English</label>
                              </div>
                              <div class="radiorobo">
                                <input type="radio" id="english">
                                <label for="english">French</label>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <table class="table-1">
                        <thead>
                          <tr class="bgcolor--gray_mm color--gray_d">
                            <th><span class="cellcontent">&lt;input type=&quot;checkbox&quot; name=&quot;select-all&quot; id=&quot;select-all&quot; /&gt;</span></th>
                            <th><span class="cellcontent">اسم الفرع</span></th>
                            <th><span class="cellcontent">تليفون</span></th>
                            <th><span class="cellcontent">ايميل</span></th>
                            <th><span class="cellcontent">العنوان</span></th>
                            <th><span class="cellcontent">فرع رئيسي</span></th>
                            <th><span class="cellcontent">الإجراءات</span></th>
                          </tr>
                        </thead>
                        <tbody>
                        @foreach($branches as $branch)
                          <tr data-branch-id="{{$branch['id']}}">
                            <td><span class="cellcontent"><input type="checkbox" class="checkboxes" /></span></td>
                            <td><span class="cellcontent">{{$branch['name']}} </span></td>
                            <td><span class="cellcontent">
                            @if(count($branch['contact_detail']) > 0)
                            @foreach($branch['contact_detail'] as $mobile)
                            @if($mobile['pivot']['contact_detail_type'] == 1)
                            {{$mobile['pivot']['code'].$mobile['pivot']['value']}}-
                            @endif
                            @endforeach
                            @endif
                            </span></td>
                            <td><span class="cellcontent">
                            @if(count($branch['contact_detail']) > 0)
                            @foreach($branch['contact_detail'] as $email)
                            @if($email['pivot']['contact_detail_type'] == 3)
                            {{$email['pivot']['value']}}-
                            @endif
                            @endforeach
                            @endif
                            </span></td>
                            <td><span class="cellcontent">{{$branch['address']}}</span></td>
                            <td><span class="cellcontent">
                            
                            @if($branch['is_main'])
                            <i class = "fa color--black fa-check"></i>
                            @else
                            <i class = "fa color--black fa-times"></i>
                            @endif
                            </span></td>
                            <td><span class="cellcontent">
                            <a id="add_localization" data-consult-id="" class= "action-btn bgcolor--main color--white add_localization">
                              <i class = "fa fa-book"></i> &nbsp; اللغات
                            </a>
                            <a href="{{route('contactus_edit',$branch['id'])}}" ,  class= "action-btn bgcolor--fadegreen color--white "><i class = "fa  fa-pencil"></i></a>
                            <a href="#"  class= "btn-warning-cancel action-btn bgcolor--fadebrown color--white "><i class = "fa  fa-trash-o"></i></a></span>
                            </td>
                          </tr>
                         @endforeach
                         
                        </tbody>
                      </table>
                      {{--localization modal --}} 
                    <div id="localization_modal" class="remodal" data-remodal-id="lang" role="dialog" aria-labelledby="modal1Title" aria-describedby="modal1Desc">
                        <form role="form" action="{{route('consultations_classification_add_localization')}}" method="post">
                        <button class="remodal-close" data-remodal-action="close" aria-label="Close"></button>
                          <div>
                            <div class="row">
                              <h4>ادخال اسم الفرع بلغات متعددة</h4><br>
                              <input type="hidden" id="consult_id" name="consult_id">
                              <div class="col-sm-5">
                                <div class="master_field">
                                  <label class="master_label mandatory" for="lang_id">اختار اللغة</label>
                                  <select class="master_input" id="lang_id" name="lang_id">
                                      <option value="">English</option>
                                      <option value="">French</option>
                                  </select>
                                </div>
                              </div>
                              <div class="col-sm-7">
                                <div class="master_field">
                                  <label class="master_label mandatory" for="consult_name">ادخال اسم الفرع باللغة المختاره</label>
                                  <input class="master_input" type="text" placeholder="اسم الفرع" id="consult_name" name="consult_name">
                                  <span class="master_message color--fadegreen">
                                    
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
      
                    </div>
                  </div>
                </div>
              </div>
              <!-- =============== PAGE VENDOR Triggers ===============-->
@endsection
@section('js')
<script>
$(document).ready(function(){

$('.btn-warning-cancel').click(function(){
  var branch_id = $(this).closest('tr').attr('data-branch-id');
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
       type:'GET',
       url:'{{url("contactus/delete")}}'+'/'+branch_id,
       data:{_token:_token},
       success:function(data){
        $('tr[data-branch-id='+branch_id+']').fadeOut();
        swal("تم الحذف!", "تم الحذف بنجاح", "success");
      }
    });
     
   } else {
    swal("تم الإلغاء", "المعلومات مازالت موجودة :)", "error");
  }
});
});

$('.btn-warning-cancel-all').click(function(){
      var selectedIds = $("input:checkbox:checked").map(function(){
        return $(this).closest('tr').attr('data-branch-id');
      }).get();
      if(selectedIds.length == 0 )
      {
        swal("خطأ", "من فضلك اختر فرع :)", "error");
      }
      else
      {
        // alert(selectedIds);
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
           url:'{{url("/contactus/delete_all")}}',
           data:{ids:selectedIds,_token:_token},
           success:function(data){
            $.each( selectedIds, function( key, value ) {
              $('tr[data-branch-id='+value+']').fadeOut();
            });
            swal("تم الحذف!", "تم الحذف بنجاح", "success");
          }
        });
         
       } else {
        swal("تم الإلغاء", "المعلومات مازالت موجودة :)", "error");
      }
    });
    }
    });
});
//language filter
$('#quick_Filters_2').click( function(){
        $('#lang_filter').toggle();
    });

    // add localization
    $('.add_localization').click( function(){
        var localization_modal = $('#localization_modal');
        var id = $(this).closest('tr').attr('data-consult');
        console.log(id);
        $('#branch_id').val(id);
        $('#localization_modal').remodal().open();
    });
</script>
@endsection