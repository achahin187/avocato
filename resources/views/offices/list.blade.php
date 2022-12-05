 @extends('layout.app')             
 @section('content')

 <script type="text/javascript">
  $(document).ready(function(){

       $('.noti').click(function(){
      var lawyer_id = $(this).closest('tr').attr('data-office-id');
      var _token = '{{csrf_token()}}';
      $('[data-remodal-id=lawyer_notification]').remodal().open();
      
$(document).on('confirmation', '.remodal', function () {
        var noti = $('#nots').val(); 
        var time = $("input[name=date]").val();
         $.ajax({
           type:'POST',
           url:'{{url('notification_lawyer')}}'+'/'+lawyer_id,
           data:{notific:noti,noti_date:time,_token:_token},
           success:function(data){
            location.reload();
          }
        });

});
          });

        $('.noti-all').click(function(){
      var selectedIds = $("input:checkbox:checked").map(function(){
        return $(this).closest('tr').attr('data-office-id');
      }).get();
      if(selectedIds.length <= 0) {
        confirm('إختر محامى على الأقل لإرسال تنبيه');
      }
      else{
        
      var _token = '{{csrf_token()}}';
      $('[data-remodal-id=lawyer_notifications]').remodal().open();
$(document).on('confirmation', '#two', function () {
  
        var noti = $('#nots2').val(); 
        var time = $("input[name=date2]").val();
         $.ajax({
           type:'POST',
           url:'{{url('notification_for_lawyers')}}',
           data:{ids:selectedIds,notific:noti,noti_date:time,_token:_token},
           success:function(data){
              location.reload();
          }
        });

});
      }
          });
        });

 </script>
              <div class="row">
                <div class="col-lg-12">
                  <div class="cover-inside-container margin--small-top-bottom bradius--small bshadow--1" style="background:  url( '{{asset('img/covers/dummy2.jpg ')}}' ) no-repeat center center; background-size:cover">
                    <div class="row">
                      <div class="col-xs-12">
                        <div class="text-xs-center">
                          <div class="text-wraper">
                            <h4 class="cover-inside-title color--gray_d">مكاتب المحاماه</h4>
                          </div>
                        </div>
                      </div>
                      <div class="cover--actions"><a class="color--gray_d bordercolor--gray_d bradius--small border-btn master-btn" type="button" href="{{route('offices_create')}}">اضافة مكتب</a>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-lg-12">
                  @if ( Session::has('success') )
                  <div class="alert alert-success text-center">{{ Session::get('success') }}</div>
                  @endif
              
                  @if ( Session::has('warning') )
                      <div class="alert alert-warning text-center">{{ Session::get('warning') }}</div>
                  @endif
                <div class="col-lg-12">
                  <div class="cardwrap bgcolor--white bradius--noborder   bshadow--1 padding--small margin--small-top-bottom">
                    <div class="full-table hide-datatable-pagination">
                    {{-- <form role="form" action="{{route('offices_city_filter')}}" method="POST" enctype="multipart/form-data"> --}}
                      <div class="remodal-bg">
                        <div class="remodal" data-remodal-id="filterModal_sponsors" role="dialog" aria-labelledby="modal1Title" aria-describedby="modal1Desc">
                          <button class="remodal-close" data-remodal-action="close" aria-label="Close"></button>
                          <div>
                            <h2 id="modal1Title">فلتر</h2>
                            <form role="form" action="{{ action('OfficesController@cityFilter') }}" method="POST" enctype="multipart/form-data">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                              <div class="master_field">
                                <label class="master_label mandatory" for="ID_No">بحث  </label>
                                <div class="bootstrap-timepicker">
                                  <input name="search" class=" master_input" type="text" placeholder=" بحث بالاسم اوالكود او رقم الهاتف" id="search" value="{{ old('search') }}">
                                </div>
                      
                                @if ($errors->has('start_date'))
                                  <span class="master_message color--fadegreen">{{ $errors->first('search') }}</span>
                                @endif
                              {{--  Start date  --}}
                              </div>
                            <div class="col-md-12 col-sm-12 col-xs-12">
                            {{-- Search --}}
             
                              <div class="master_field">
                                <label class="master_label mandatory" for="office_address">المدينة</label>
                                {{-- <input class="master_input" type="text" placeholder="المدينة" id="office_address"><span class="master_message color--fadegreen">message</span> --}}
                                
                               
                                  <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
                                  <select class="master_input" name="office_city" id="office_address">
                                  <option value="">اختر المدينة</option>
                                @foreach($cities as $city)
                                <option value="{{$city->id}}">{{$city->name}}</option>
                                @endforeach  
                                </select>
                                <span class="master_message color--fadegreen">message</span>
                                <div class="clearfix"></div>
                               <button class="remodal-cancel" data-remodal-action="cancel">الغاء</button>
                               <button class="remodal-confirm" type="submit">فلتر</button>
                        </form>
                              </div>
                            </div>
                          </div>
                          {{-- <div class="clearfix"></div>
                          <button class="remodal-cancel" data-remodal-action="cancel">الغاء</button>
                          <button class="remodal-confirm" type="submit" data-remodal-action="confirm">فلتر</button>
                        </form> --}}
                        </div>
                      </div>
                      <div class="filter__btns"><a class="master-btn bgcolor--main color--white bradius--small" href="#filterModal_sponsors"><i class="fa fa-filter"></i>filters</a></div>
                      <div class="bottomActions__btns"><a class="noti-all master-btn bradius--small padding--small bgcolor--fadeorange color--white" href="#">ارسال تنبية</a><a class="excel-btn master-btn bradius--small padding--small bgcolor--fadeblue color--white" href="#">استخراج اكسيل</a><a class="master-btn bradius--small padding--small bgcolor--fadebrown color--white btn-warning-cancel-all" href="#">حذف المحدد</a>
                       @if($offices instanceof \Illuminate\Pagination\LengthAwarePaginator)
                        {{$offices->appends(Request::except('page'))->links()}}
                        @endif
                      </div>
                      <table class="table-1 hide-datatable-pagination">
                        <thead>
                          <tr class="bgcolor--gray_mm color--gray_d">
                            <th><span class="cellcontent">&lt;input type=&quot;checkbox&quot; name=&quot;select-all&quot; id=&quot;select-all&quot; /&gt;</span></th>
                            <th><span class="cellcontent">كود المكتب</span></th>
                            <th><span class="cellcontent">الاسم</span></th>
                            <th><span class="cellcontent">عنوان</span></th>
                            <th><span class="cellcontent">رقم الهاتف</span></th>
                            <th><span class="cellcontent">تفعيل</span></th>
                            <th><span class="cellcontent">الاجراءات</span></th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach($offices as $office)
                            <tr  data-office-id="{{$office->id}}">
                              <td><span class="cellcontent"><input type="checkbox" class="checkboxes" /></span></td>
                              <td><span class="cellcontent">{{$office->code}}</span></td>
                              <td><span class="cellcontent">{{$office->name}}</span></td>
                              <td><span class="cellcontent">{{$office->address}}</span></td>
                              <td><span class="cellcontent">{{$office->mobile}}</span></td>
                              <td><a href="{{route('lawyers_activate',$office->id)}}"><span class="cellcontent">@if($office->is_active==1)<i class = "fa color--fadegreen fa-check"></i>@else <i class = "fa color--fadebrown fa-times"> @endif</a></span></td>
                              <td><span class="cellcontent"><a href= {{route('offices_show',$office->id)}} ,  class= "action-btn bgcolor--main color--white "><i class = "fa  fa-eye"></i></a><a href= "#" ,  class= "noti action-btn bgcolor--fadeorange color--white "><i class = "fa  fa-envelope"></i></a><a href= {{route('offices_edit',$office->id)}} ,  class= "action-btn bgcolor--fadegreen color--white "><i class = "fa  fa-pencil"></i></a><a href="#"  class= "btn-warning-cancel action-btn bgcolor--fadebrown color--white "><i class = "fa  fa-trash-o"></i></a></span></td>
                            </tr>
                          @endforeach
                        </tbody>
                      </table>
                    </div>

      <div class="col-md-2 col-sm-3 colxs-12"><a class="master-btn undefined undefined undefined undefined undefined" href="#lawyer_notification"><span></span></a>
            <div class="remodal-bg"></div>
            <div class="remodal" data-remodal-id="lawyer_notification" role="dialog" aria-labelledby="modal1Title" aria-describedby="modal1Desc">
              <button class="remodal-close" data-remodal-action="close" aria-label="Close"></button>
              <div>
                <div class="row">
                  <h3>إرسال تنبيه</h3>
                  <div class="col-xs-12">
                    <div class="master_field">
                      <label class="master_label mandatory" for="send_date">تاريخ الإرسال</label>
                      <div class="bootstrap-timepicker">
                        <input name="date" class="datepicker master_input" type="text" placeholder="تاريخ الإرسال" id="send_date">
                      </div><span class="master_message color--fadegreen"></span>
                    </div>
                  </div>
                  <div class="col-xs-12">
                    <div class="master_field">
                      <label class="master_label">نص التنبية</label>
                      <textarea id="nots" name="noti_text" class="master_input" placeholder="نص التنبية"></textarea>
                    </div>
                  </div>
                  <div class="clearfix"></div>
                </div>
              </div><br>
              <button class="remodal-cancel" data-remodal-action="cancel">إلغاء</button>
              <button class="remodal-confirm" data-remodal-action="confirm">إرسال</button>
            </div>
          </div>

          <div class="col-md-2 col-sm-3 colxs-12"><a class="master-btn undefined undefined undefined undefined undefined" href="#lawyer_notifications"><span></span></a>
            <div class="remodal-bg"></div>
            <div class="remodal" id="two" data-remodal-id="lawyer_notifications" role="dialog" aria-labelledby="modal1Title" aria-describedby="modal1Desc">
              <button class="remodal-close" data-remodal-action="close" aria-label="Close"></button>
              <div>
                <div class="row">
                  <h3>إرسال تنبيه</h3>
                  <div class="col-xs-12">
                    <div class="master_field">
                      <label class="master_label mandatory" for="send_date">تاريخ الإرسال</label>
                      <div class="bootstrap-timepicker">
                        <input name="date2" class="datepicker master_input" type="text" placeholder="تاريخ الإرسال" id="send_date">
                      </div><span class="master_message color--fadegreen"></span>
                    </div>
                  </div>
                  <div class="col-xs-12">
                    <div class="master_field">
                      <label class="master_label">نص التنبية</label>
                      <textarea id="nots2" name="noti_text2" class="master_input" placeholder="نص التنبية"></textarea>
                    </div>
                  </div>
                  <div class="clearfix"></div>
                </div>
              </div><br>
              <button class="remodal-cancel" data-remodal-action="cancel">إلغاء</button>
              <button class="remodal-confirm" data-remodal-action="confirm">إرسال</button>
            </div>
          </div>
                  </div>
                </div>
              </div>

       <script type="text/javascript">
      $('.btn-warning-cancel').click(function(){
      var lawyer_id = $(this).closest('tr').attr('data-office-id');
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
           url:'{{url('lawyers_destroy_post')}}'+'/'+lawyer_id,
           data:{_token:_token},
           success:function(data){
            $('tr[data-office-id='+lawyer_id+']').fadeOut();
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
        return $(this).closest('tr').attr('data-office-id');
      }).get();
      var _token = '{{csrf_token()}}';
       if (selectedIds === undefined || selectedIds.length == 0) {
    // array empty or does not exist
    swal("@lang('رجاء قم بتحديد البيانات المراد حذفها')");
          } else{
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
           url:'{{route('lawyers_destroy_all')}}',
           data:{ids:selectedIds,_token:_token},
           success:function(data){
            $.each( selectedIds, function( key, value ) {
              $('tr[data-office-id='+value+']').fadeOut();
            });
          }
        });
         swal("تم الحذف!", "تم الحذف بنجاح", "success");
       } else {
        swal("تم الإلغاء", "المعلومات مازالت موجودة :)", "error");
      }
    });
    }
      });
      $('.excel-btn').click(function(){
         var filter='@if(\session('filter_ids')){{json_encode(\session('filter_ids'))}}@endif';
         var selectedIds = $("input:checkbox:checked").map(function(){
          return $(this).closest('tr').attr('data-office-id');
        }).get();
         $.ajax({
           type:'GET',
           url:'{{route('lawyers_excel')}}',
           data:{
             ids:selectedIds,
             is_report:2,
             filters:filter},
           success:function(response){
            swal("تمت العملية بنجاح!", "تم استخراج الجدول علي هيئة ملف اكسيل", "success");
            // var a = document.createElement("a");
            // a.href = response.file; 
            // a.download = response.name+'.xlsx';
            // document.body.appendChild(a);
            // a.click();
            // a.remove();
            location.href = response;
          }
        });
       });
     </script>

@endsection