@extends('layout.app')
@section('content')
<!-- =============== Custom Content ===============-->
<div class="row">
                <div class="col-lg-12">
                  <div class="cover-inside-container margin--small-top-bottom bradius--small bshadow--1" style="background:  url( '{{asset('img/covers/dummy2.jpg')}}' ) no-repeat center center; background-size:cover">
                    <div class="row">
                      <div class="col-xs-12">
                        <div class="text-xs-center">
                          <div class="text-wraper">
                            <h4 class="cover-inside-title color--gray_d">المهام <i class="fa fa-chevron-circle-right"></i>
                              <h4 class="cover-inside-title color--gray_d">طلبات الإنابة </h4>
                            </h4>
                          </div>
                        </div>
                      </div>
                      <div class="cover--actions"><span></span>
                      </div>
                    </div>
                  </div>
                </div>
                {{--  Flash messages  --}}
  <div class="col-lg-12">
    {{--  Success  --}}
    @if (Session::has('success'))
      <div class="alert alert-warning text-center">
        <strong>{{ Session::get('success') }}</strong>  
      </div>
    @endif

    {{--  Warning  --}}
    @if (Session::has('warning'))
      <div class="alert alert-warning text-center">
        <strong>{{ Session::get('warning') }}</strong>  
      </div>
    @endif
  </div>
                <div class="col-lg-12">
                  <div class="cardwrap bgcolor--white bradius--noborder   bshadow--1 padding--small margin--small-top-bottom">
                    <div class="full-table">
                      <div class="remodal-bg">
                        <div class="remodal" data-remodal-id="filterModal_sponsors" role="dialog" aria-labelledby="modal1Title" aria-describedby="modal1Desc">
                          <button class="remodal-close" data-remodal-action="close" aria-label="Close"></button>
                          <div>
                            <h2 id="modal1Title">فلتر</h2>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                              <div class="master_field">
                                <label class="master_label mandatory" for="date_from">التاريخ من</label>
                                <div class="bootstrap-timepicker">
                                  <input class="datepicker master_input" type="text" placeholder="التاريخ" id="date_from">
                                </div><span class="master_message color--fadegreen">message content</span>
                              </div>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                              <div class="master_field">
                                <label class="master_label mandatory" for="date_to">التاريخ الى</label>
                                <div class="bootstrap-timepicker">
                                  <input class="datepicker master_input" type="text" placeholder="التاريخ" id="date_to">
                                </div><span class="master_message color--fadegreen">message content</span>
                              </div>
                            </div>
                            <div class="col-md-12 col-sm-12 col-xs-12">
                              <div class="master_field">
                                <label class="master_label mandatory">الحالة</label>
                                <div class="radiorobo">
                                  <input type="radio" id="status_rad_1">
                                  <label for="status_rad_1">الكل</label>
                                </div>
                                <div class="radiorobo">
                                  <input type="radio" id="status_rad_2">
                                  <label for="status_rad_2">تمت المهمة</label>
                                </div>
                                <div class="radiorobo">
                                  <input type="radio" id="status_rad_3">
                                  <label for="status_rad_3">لم تتم المهمة</label>
                                </div>
                              </div>
                            </div>
                            <div class="col-md-12 col-sm-6 col-xs-12">
                              <div class="master_field">
                                <label class="master_label mandatory">تحديد المحامي</label>
                                <div class="radiorobo">
                                  <input type="radio" id="lawyer_rad_1">
                                  <label for="lawyer_rad_1">الكل</label>
                                </div>
                                <div class="radiorobo">
                                  <input type="radio" id="lawyer_rad_2">
                                  <label for="lawyer_rad_2">تم تحديد محامي</label>
                                </div>
                                <div class="radiorobo">
                                  <input type="radio" id="lawyer_rad_3">
                                  <label for="lawyer_rad_3">لم يتم تحديد محامي</label>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="clearfix"></div>
                          <button class="remodal-cancel" data-remodal-action="cancel">الغاء</button>
                          <button class="remodal-confirm" data-remodal-action="confirm">فلتر</button>
                        </div>
                      </div>
                      <div class="filter__btns"><a class="master-btn bgcolor--main color--white bradius--small" href="#filterModal_sponsors"><i class="fa fa-filter"></i>filters</a></div>
                      <div class="bottomActions__btns"><a class="excel-btn master-btn bradius--small padding--small bgcolor--fadeblue color--white" href="#">استخراج اكسيل</a><a class="master-btn bradius--small padding--small bgcolor--fadebrown color--white btn-warning-cancel" href="#">حذف المحدد</a>
                      </div>
                      <table class="table-1">
                        <thead>
                          <tr class="bgcolor--gray_mm color--gray_d" >
                            <th><span class="cellcontent">&lt;input type=&quot;checkbox&quot; name=&quot;select-all&quot; id=&quot;select-all&quot; /&gt;</span></th>
                            <th><span class="cellcontent">كودالمحامي</span></th>
                            <th><span class="cellcontent">اسم المحامي</span></th>
                            <th><span class="cellcontent">نوع الإنابة</span></th>
                            <th><span class="cellcontent">تاريخ</span></th>
                            <th><span class="cellcontent">المحكمة</span></th>
                            <th><span class="cellcontent">الدائرة</span></th>
                            <th><span class="cellcontent">الحالة</span></th>
                            <th><span class="cellcontent">المحامي المحدد</span></th>
                            <th><span class="cellcontent">الاجراءات</span></th>
                          </tr>
                        </thead>
                        <tbody>
                        @foreach($substitutions as $substitution)
                          <tr data-task-id="{{$substitution->id}}">
                            <td><span class="cellcontent"><input type="checkbox" class="checkboxes" /></span></td>
                            <td><span class="cellcontent">{{$substitution->lawyer_substitution->code}}</span></td>
                            <td><span class="cellcontent"><a href="{{route('lawyers_show',$substitution->lawyer_substitution->id)}}"> {{$substitution->lawyer_substitution->full_name}} </a></span></td>
                            <td><span class="cellcontent">{{($substitution->substitution) ?$substitution->substitution->type->name : 'لا يوجد'}}</span></td>
                            <td><span class="cellcontent">{{ ($substitution->substitution) ?$substitution->substitution->date : "لا يوجد"}}</span></td>
                            <td><span class="cellcontent">{{ ($substitution->substitution) ? $substitution->substitution->court : "لا يوجد"}}</span></td>
                            <td><span class="cellcontent">{{($substitution->substitution) ? $substitution->substitution->region : "لا يوجد"}}</span></td>
                            <td><span class="cellcontent"><label class= "data-label bgcolor--fadegreen color--white  ">@if($substitution->task_status_id == 1) لم يتم @else تم @endif</label></span></td>
                            <td><span class="cellcontent"><a @if($substitution->lawyer()->count() != 0 )href="{{route('lawyers_show',$substitution->lawyer->id)}}" @endif> @if($substitution->lawyer()->count() != 0 )  {{$substitution->lawyer->full_name}}  @else 'لم يتم تحديد محامى' @endif </a></span></td>
                            <td><span class="cellcontent"><a href={{route('substitutions.view',$substitution->id)}} , title="مشاهدة" ,  class= "action-btn bgcolor--main color--white "><i class = "fa  fa-eye"></i></a><a href="{{route('substitutions.assign',$substitution->id)}}" , title="تعيين محامي",  class= "action-btn bgcolor--fadepurple  color--white "><i class = "fa  fa-edit"></i></a><a href="#"  class= "btn-warning-cancel action-btn bgcolor--fadebrown color--white "><i class = "fa  fa-trash-o"></i></a></span></td>
                          </tr>
                       @endforeach
                        </tbody>
                      </table>
                      <div class="remodal log-custom" role="dialog" aria-labelledby="modal1Title" aria-describedby="modal1Desc">
                        <button class="remodal-close" data-remodal-action="close" aria-label="Close"></button>
                        <div>
                          <h2 class="title">title of the changing log in</h2>
                          <div class="log-content">
                            <div class="log-container">
                              <table class="log-table">
                                <tr class="log-row" data-link="https://www.google.com.eg/">
                                  <th>log title</th>
                                  <th>user</th>
                                  <th>time</th>
                                </tr>
                                <tr class="log-row" data-link="https://www.google.com.eg/">
                                  <td>January</td>
                                  <td>$100</td>
                                  <td>$100</td>
                                </tr>
                                <tr class="log-row" data-link="https://www.google.com.eg/">
                                  <td>February</td>
                                  <td>$80</td>
                                  <td>$80</td>
                                </tr>
                                <tr class="log-row" data-link="https://www.google.com.eg/">
                                  <td>January</td>
                                  <td>$100</td>
                                  <td>$100</td>
                                </tr>
                                <tr class="log-row" data-link="https://www.google.com.eg/">
                                  <td>February</td>
                                  <td>$80</td>
                                  <td>$80</td>
                                </tr>
                                <tr class="log-row" data-link="https://www.google.com.eg/">
                                  <td>January</td>
                                  <td>$100</td>
                                  <td>$100</td>
                                </tr>
                                <tr class="log-row" data-link="https://www.google.com.eg/">
                                  <td>February</td>
                                  <td>$80</td>
                                  <td>$80</td>
                                </tr>
                                <tr class="log-row" data-link="https://www.google.com.eg/">
                                  <td>January</td>
                                  <td>$100</td>
                                  <td>$100</td>
                                </tr>
                                <tr class="log-row" data-link="https://www.google.com.eg/">
                                  <td>February</td>
                                  <td>$80</td>
                                  <td>$80</td>
                                </tr>
                                <tr class="log-row" data-link="https://www.google.com.eg/">
                                  <td>January</td>
                                  <td>$100</td>
                                  <td>$100</td>
                                </tr>
                                <tr class="log-row" data-link="https://www.google.com.eg/">
                                  <td>February</td>
                                  <td>$80</td>
                                  <td>$80</td>
                                </tr>
                                <tr class="log-row" data-link="https://www.google.com.eg/">
                                  <td>January</td>
                                  <td>$100</td>
                                  <td>$100</td>
                                </tr>
                                <tr class="log-row" data-link="https://www.google.com.eg/">
                                  <td>February</td>
                                  <td>$80</td>
                                  <td>$80</td>
                                </tr>
                                <tr class="log-row" data-link="https://www.google.com.eg/">
                                  <td>January</td>
                                  <td>$100</td>
                                  <td>$100</td>
                                </tr>
                                <tr class="log-row" data-link="https://www.google.com.eg/">
                                  <td>February</td>
                                  <td>$80</td>
                                  <td>$80</td>
                                </tr>
                                <tr class="log-row" data-link="https://www.google.com.eg/">
                                  <td>January</td>
                                  <td>$100</td>
                                  <td>$100</td>
                                </tr>
                                <tr class="log-row" data-link="https://www.google.com.eg/">
                                  <td>February</td>
                                  <td>$80</td>
                                  <td>$80</td>
                                </tr>
                                <tr class="log-row" data-link="https://www.google.com.eg/">
                                  <td>January</td>
                                  <td>$100</td>
                                  <td>$100</td>
                                </tr>
                                <tr class="log-row" data-link="https://www.google.com.eg/">
                                  <td>February</td>
                                  <td>$80</td>
                                  <td>$80</td>
                                </tr>
                                <tr class="log-row" data-link="https://www.google.com.eg/">
                                  <td>January</td>
                                  <td>$100</td>
                                  <td>$100</td>
                                </tr>
                                <tr class="log-row" data-link="https://www.google.com.eg/">
                                  <td>February</td>
                                  <td>$80</td>
                                  <td>$80</td>
                                </tr>
                                <tr class="log-row" data-link="https://www.google.com.eg/">
                                  <td>January</td>
                                  <td>$100</td>
                                  <td>$100</td>
                                </tr>
                                <tr class="log-row" data-link="https://www.google.com.eg/">
                                  <td>February</td>
                                  <td>$80</td>
                                  <td>$80</td>
                                </tr>
                                <tr class="log-row" data-link="https://www.google.com.eg/">
                                  <td>January</td>
                                  <td>$100</td>
                                  <td>$100</td>
                                </tr>
                                <tr class="log-row" data-link="https://www.google.com.eg/">
                                  <td>February</td>
                                  <td>$80</td>
                                  <td>$80</td>
                                </tr>
                                <tr class="log-row" data-link="https://www.google.com.eg/">
                                  <td>January</td>
                                  <td>$100</td>
                                  <td>$100</td>
                                </tr>
                                <tr class="log-row" data-link="https://www.google.com.eg/">
                                  <td>February</td>
                                  <td>$80</td>
                                  <td>$80</td>
                                </tr>
                                <tr class="log-row" data-link="https://www.google.com.eg/">
                                  <td>January</td>
                                  <td>$100</td>
                                  <td>$100</td>
                                </tr>
                                <tr class="log-row" data-link="https://www.google.com.eg/">
                                  <td>February</td>
                                  <td>$80</td>
                                  <td>$80</td>
                                </tr>
                              </table>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- =============== PAGE VENDOR Triggers ===============-->
@endsection
@section('js')
<script>
 $('.btn-warning-cancel').click(function(){
          var task_id = $(this).closest('tr').attr('data-task-id');
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
               url:'{{url('substitutions_delete')}}'+'/'+task_id,
               data:{_token:_token},
               success:function(data){
                $('tr[data-task-id='+task_id+']').fadeOut();
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
            return $(this).closest('tr').attr('data-task-id');
          }).get();
          if(selectedIds.length == 0 )
          {
            swal("خطأ", "من فضلك اختر باقه :)", "error");
          }
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
               url:'{{route('substitutions.delete_all')}}',
               data:{ids:selectedIds,_token:_token},
               success:function(data){
                $.each( selectedIds, function( key, value ) {
                  $('tr[data-task-id='+value+']').fadeOut();
                });
                swal("تم الحذف!", "تم الحذف بنجاح", "success");
               }
            });
            
            } else {
              swal("تم الإلغاء", "المعلومات مازالت موجودة :)", "error");
            }
          });
        });

        $('.excel-btn').click(function(){
    // alert('1');
     var filter='@if(\session('filter_ids')){{json_encode(\session('filter_ids'))}}@endif';
     var selectedIds = $("input:checkbox:checked").map(function(){
      return $(this).closest('tr').attr('data-task-id');
    }).get();
     $.ajax({
       type:'GET',
       url:'{{route('substitutions.excel')}}',
       data:{ids:selectedIds,filters:filter},
       success:function(response){
        // alert(2);
        location.href = response;
        swal("تمت العملية بنجاح!", "تم استخراج الجدول علي هيئة ملف اكسيل", "success");
        // var a = document.createElement("a");
        // a.href = response.file; 
        // a.download = response.name+'.xlsx';
        // document.body.appendChild(a);
        // a.click();
        // a.remove();
       
      }
    });
   });


        
  
        
  
</script>
@endsection