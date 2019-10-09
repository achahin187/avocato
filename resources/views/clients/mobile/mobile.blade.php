@extends('layout.app')
@section('content')

<div class="row">
  <div class="col-lg-12">
    <div class="cover-inside-container margin--small-top-bottom bradius--small bshadow--1" style="background:  url( '{{asset('img/covers/dummy2.jpg')}}' ) no-repeat center center; background-size:cover;">
        <div class="row">
          <div class="col-xs-12">
            <div class="text-xs-center">
              <div class="text-wraper">
                <h4 class="cover-inside-title color--gray_d">العملاء <i class="fa fa-chevron-circle-right"></i>
                  <h4 class="cover-inside-title color--gray_d">محتوى </h4>
                  <h3 class="cover-inside-title color--gray_d">مشتركين بواسطة الموبايل </h3>
                </h4>
              </div>
            </div>
          </div>
        </div>
      </div> 
    </div>
  </div>

  {{-- Start alert messages --}}
  <div class="col-lg-12">
      @if (Session::has('success'))
        <div class="alert alert-success text-center">{{ Session::get('success') }}</div>
      @endif

      @if (Session::has('warning'))
        <div class="alert alert-warning text-center">{{ Session::get('warning') }}</div>
      @endif

    </div>
    {{-- End alert --}}

  <div class="">
    <div class="cardwrap bgcolor--white bradius--noborder   bshadow--1 padding--small margin--small-top-bottom">
      <div class="clearfix"></div>
      <div class="full-table hide-datatable-pagination">
        <div class="remodal-bg">
          <div class="remodal" data-remodal-id="filterModal_sponsors" role="dialog" aria-labelledby="modal1Title" aria-describedby="modal1Desc">
            
            <form action="{{ route('mobile.filter') }}" method="POST">
              {{ csrf_field() }}
              <button class="remodal-close" data-remodal-action="close" aria-label="Close"></button>
              <div>
                <h3 id="modal1Title">فلتر</h3>
                {{-- Search --}}
                <div class="col-md-6">
                  <div class="master_field">
                    <label class="master_label mandatory" for="ID_No">بحث بالاسم اوالكود </label>
                    <div class="bootstrap-timepicker">
                      <input name="search" class=" master_input" type="text" placeholder="بحث بالاسم اوالكود" id="search" value="{{ old('search') }}">
                    </div>
          
                    @if ($errors->has('start_date'))
                      <span class="master_message color--fadegreen">{{ $errors->first('search') }}</span>
                    @endif
                  {{--  Start date  --}}
                  </div>
                </div>
                {{-- Start date --}}
                <div class="col-md-6">
                  <div class="master_field">
                    <label class="master_label mandatory" for="ID_No">تاريخ التسجيل من </label>
                    <div class="bootstrap-timepicker">
                      <input name="start_date" class="datepicker master_input" type="text" placeholder="تاريخ بداية التعاقد" id="ID_No" value="{{ old('start_date') }}">
                    </div>
          
                    @if ($errors->has('start_date'))
                      <span class="master_message color--fadegreen">{{ $errors->first('start_date') }}</span>
                    @endif
                  {{--  Start date  --}}
                  </div>
                </div>

                {{-- End date --}}
                <div class="col-md-6">
                  <div class="master_field">
                    <label class="master_label mandatory" for="ID_No">تاريخ التسجيل الى </label>
                    <div class="bootstrap-timepicker">
                      <input name="end_date" class="datepicker master_input" type="text" placeholder="تاريخ نهاية التعاقد" id="ID_No" value="{{ old('end_date') }}">
                    </div>
                    
                    @if ($errors->has('end_date'))
                      <span class="master_message color--fadegreen">{{ $errors->first('end_date') }}</span>
                    @endif
                    
                  </div>
                
                </div>

                <div class="col-md-6">
                  <div class="master_field">
                    <label class="master_label mandatory">التفعيل</label>
                    <div class="radiorobo">
                      <input name="activate" value="1" type="radio" id="rad_1" checked>
                      <label for="rad_1">الكل</label>
                    </div>
                    <div class="radiorobo">
                      <input name="activate" value="2" type="radio" id="rad_2">
                      <label for="rad_2">المفعلين</label>
                    </div>
                    <div class="radiorobo">
                      <input name="activate" value="3" type="radio" id="rad_3">
                      <label for="rad_3">غير المفعلين</label>
                    </div>
                  </div>
                </div>
              </div>
              <div class="clearfix"></div>
              <button class="remodal-cancel" data-remodal-action="cancel">الغاء</button>
              <button class="remodal-confirm" type="submit">فلتر</button>
            </form>

          </div>
        </div>
        <div class="filter__btns"><a class="master-btn bgcolor--main color--white bradius--small" href="#filterModal_sponsors"><i class="fa fa-filter"></i>filters</a></div>
        <div class="bottomActions__btns">
          <a id="exportSelected" class="master-btn bradius--small padding--small bgcolor--fadeblue color--white" href="#">استخراج اكسيل</a>
          <a id="deleteSelected" class="master-btn bradius--small padding--small bgcolor--fadebrown color--white btn-warning-cancel" href="#">حذف المحدد</a>
         @if($users instanceof \Illuminate\Pagination\LengthAwarePaginator)
          {{$users->appends(Request::except('page'))->links()}}
          @endif
        </div>
        <table class="table-1 hide-datatable-pagination" id="dataTableTriggerId_001">
          <thead>
            <tr class="bgcolor--gray_mm color--gray_d">
            <th><span class="cellcontent">&lt;input type=&quot;checkbox&quot; name=&quot;select-all&quot; id=&quot;select-all&quot; onclick=&quot;checkAll(this)&quot; /&gt;</span></th>             
              <th><span class="cellcontent">كودالعميل</span></th>
              <th><span class="cellcontent">اسم العميل</span></th>
              <th><span class="cellcontent">عنوان العميل</span></th>
              <th><span class="cellcontent">هاتف</span></th>
              <th><span class="cellcontent">تفعيل</span></th>
              <th><span class="cellcontent">الإجراءات</span></th>
            </tr>
          </thead>
          <tbody>
            
            @foreach ($users as $user)
              <tr data-user="{{ $user->id }}">
                <td><span class="cellcontent"><input type="checkbox" class="checkboxes" data-id="{{ $user->id }}" /></span></td>
                <td><span class="cellcontent">
                  @if (isset($user->code))
                    {{ $user->code }}
                  @else
                    لا يوجد
                  @endif
                </span></td>
                <td><span class="cellcontent">
                  @if(isset($user->name))
                  {{ $user->name }}
                  @else
                    لا يوجد
                  @endif
                </span></td>
                <td><span class="cellcontent">{{ $user->address }}</span></td>
                <td><span class="cellcontent">{{ $user->mobile }}</span></td>
                <td><span class="cellcontent"><i class = "fa {{ $user->is_active ? 'color--fadegreen fa-check' : 'color--fadebrown fa-times'}}"></i></span></td>
                <td>
                  <span class="cellcontent">
                    <a href="{{ route('mobile.show', $user->id) }}"  class= "action-btn bgcolor--main color--white ">
                      <i class = "fa  fa-eye"></i>
                    </a>
                    <a href= "#lawyer_notification_{{$lawyer->id}}" ,  class= "noti action-btn bgcolor--fadeorange color--white "><i class = "fa  fa-bell"></i></a>
                    {{--  Delete  --}}
                    <a href="#" class= "btn-warning-cancel action-btn bgcolor--fadebrown color--white deleteRecord" data-id="{{ $user->id }}">
                      <i class = "fa fa-trash-o"></i>
                    </a>

                  </span>
                </td>
                <td hidden>       
                    <div class="col-md-2 col-sm-3 colxs-12"><a class="master-btn undefined undefined undefined undefined undefined" href="#lawyer_notification_{{$lawyer->id}}"><span></span></a>
                    <div class="remodal-bg"></div>
                    <div class="remodal" data-remodal-id="lawyer_notification_{{$lawyer->id}}" role="dialog" aria-labelledby="modal1Title" aria-describedby="modal1Desc">
                      <button class="remodal-close" data-remodal-action="close" aria-label="Close"></button>
                      <div>
                        <form role="form" action="{{route('notification_lawyer',$lawyer->id)}}" method="post" enctype="multipart/form-data" accept-charset="utf-8">
                                  <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <div class="row">
                                      <h3>إرسال تنبيه</h3>
                                      <div class="col-xs-12">
                                        <div class="master_field">
                                          <label class="master_label mandatory" for="send_date">تاريخ الإرسال</label>
                                      <div class="bootstrap-timepicker">
                                        <input name="noti_date" class="datepicker master_input" type="text" placeholder="تاريخ الإرسال" id="send_date">
                                      </div><span class="master_message color--fadegreen"></span>
                                    </div>
                                  </div>
                                  <div class="col-xs-12">
                                    <div class="master_field">
                                      <label class="master_label">نص التنبية</label>
                                      <textarea id="nots" name="notific" class="master_input" placeholder="نص التنبية"></textarea>
                                    </div>
                                  </div>
                                  <div class="clearfix"></div>
                                </div>
                              </div><br>
                              <button class="remodal-cancel" data-remodal-action="cancel">إلغاء</button>
                              <button class="remodal-confirm" type="submit">إرسال</button>
                        </form>
                      </div>
                    </div>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<script>

    $(document).ready(function() {
      // Delete selected checkboxes
        $('#deleteSelected').click(function(){
          var allVals = [];                   // selected IDs
          var token = '{{ csrf_token() }}';

          // push cities IDs selected by user
          $('.checkboxes:checked').each(function() {
            allVals.push($(this).attr('data-id'));
          });

          // check if user selected nothing
          if(allVals.length <= 0) {
            confirm('إختر مستخدم علي الاقل لتستطيع حذفه');
          } else {
            var ids = allVals.join(",");    // join array of IDs into a single variable to explode in controller
            
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
                  $.ajax(
                  {
                      url: "{{ route('mobile.destroySelected') }}",
                      type: 'GET',
                      dataType: "JSON",
                      data: {
                          "ids": ids,
                          "_method": 'GET',
                          "_token": token,
                      },
                      success: function (ids)
                      {
                          swal("تم الحذف!", "تم الحذف بنجاح", "success");

                          // fade out selected checkboxes after deletion
                          $.each(allVals, function( index, value ) {
                            $('tr[data-user='+value+']').fadeOut();
                          });
                      }
                  });
                
              } else {
                swal("تم الإلغاء", "المعلومات مازالت موجودة :)", "error");
              }
            });
          }
        });

        // delete a row
        $('.deleteRecord').click(function(){
          
          var id = $(this).data("id");
          var token = '{{ csrf_token() }}';

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
                  $.ajax(
                  {
                      url: "{{ url('/mobile/destroy') }}" +"/"+ id,
                      type: 'GET',
                      dataType: "JSON",
                      data: {
                          "id": id,
                          "_method": 'GET',
                          "_token": token,
                      },
                      success: function ()
                      {
                          swal("تم الحذف!", "تم الحذف بنجاح", "success");
                          $('tr[data-user='+id+']').fadeOut();
                      }
                  });
              
            } else {
              swal("تم الإلغاء", "المعلومات مازالت موجودة :)", "error");
            }
          });
        });
        
        // Export table as Excel file
        $('#exportSelected').click(function(){
          var allVals = [];                   // selected IDs
          var token = '{{ csrf_token() }}';

          // push cities IDs selected by user
          $('.checkboxes:checked').each(function() {
            allVals.push($(this).attr('data-id'));
          });
          
          // check if user selected nothing
          if(allVals.length <= 0) {
            var ids = null;
          } else {
            var ids = allVals.join(",");    // join array of IDs into a single variable to explode in controller
          }
          
          $.ajax(
          {
            url: "{{ route('clients.exportXLS') }}",
            type: 'GET',
            data: {
                "ids": ids,
                "userType": "Mobile",
                "is_report":2,
                "userRule": 7,
                "_method": 'GET',
            },
            success:function(response){
              swal("تمت العملية بنجاح!", "تم استخراج الجدول علي هيئة ملف اكسيل", "success");
              location.href = response;
            }
          });

        });

      // hide alert message after 4 seconds => 4000 ms
      window.setTimeout(function() {
            $(".alert").fadeTo(500, 0).slideUp(500, function(){
                $(this).remove(); 
            });
        }, 4000);
    });
  </script>
<script LANGUAGE="JavaScript">
function checkAll(bx) {
var cbs = document.getElementsByClassName('checkboxes');
for(var i=0; i < cbs.length; i++) {
cbs[i].checked = bx.checked;
}
}
</script>
@endsection