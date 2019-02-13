@extends('layout.app')
@section('content')
<div class="row">
  <div class="col-lg-12">
    <div class="cover-inside-container margin--small-top-bottom bradius--small bshadow--1" style="background:  url( '{{asset('img/covers/dummy2.jpg')}}' ) no-repeat center center; background-size:cover;">
      <div class="row">
        <div class="col-xs-12">
          <div class="text-xs-center">
            <div class="text-wraper">
              <h4 class="cover-inside-title color--gray_d">السادة المحامين</h4>
            </div>
          </div>
        </div>
        <div class="cover--actions"><a class="color--gray_d bordercolor--gray_d bradius--small border-btn master-btn" type="button" href="{{route('lawyers_create')}}">إضافة محامي</a><a class="color--gray_d bordercolor--gray_d bradius--small border-btn master-btn" type="button" href="{{route('lawyers_follow')}}">متابعة أماكن المحامين</a>
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
    <div class="cardwrap bgcolor--white bradius--noborder   bshadow--1 padding--small margin--small-top-bottom">
      <div class="full-table">
        <div class="remodal-bg">
          <div class="remodal" data-remodal-id="filterModal_sponsors" role="dialog" aria-labelledby="modal1Title" aria-describedby="modal1Desc">
            <form role="form" action="{{route('lawyers_filter')}}" method="post" accept-charset="utf-8">
              {{csrf_field()}}
              <button class="remodal-close" data-remodal-action="close" aria-label="Close"></button>
              <div>
                <h2 id="modal1Title">فلتر</h2>
                <div class="col-md-4 col-sm-6 col-xs-12">
                  <div class="master_field">
                    <label class="master_label" for="work_sector">التخصص</label>
                  <select name="work_sector[]" class="master_input select2" id="lawyer_type" multiple="multiple" data-placeholder="التخصص" style="width:100%" >
                  <option value="0">choose Speification ..</option>
                            @foreach($work_sectors as $work_sector)
                            <option value="{{$work_sector->id}}">{{$work_sector->name}}</option>
                            @endforeach
                          </select>
                  </div>
                </div>
                <div class="col-md-4 col-sm-6 col-xs-12">
                  <div class="master_field">
                    <label class="master_label" for="work_sector">التخصص المكانى </label>
                  <select name="work_sector_area_id" class="master_input select2" id="lawyer_type" multiple="multiple" data-placeholder=" التخصص لمكانى" style="width:100%" >
                           <option value="0">choose city ..</option>
                            @foreach($cities as $city)
                            <option value="{{$city->id}}">{{$city->name}}</option>
                            @endforeach
                          </select>
                  </div>
                </div>
                <div class="col-md-4 col-sm-6 col-xs-12">
                  <div class="master_field">
                    <label class="master_label" for="lawyer_degree_in">درجة القيد بالنقابة</label>
                 <select name="syndicate_level_id" class="master_input" id="syndicate_level_id">
                          <option value="choose" selected disabled>اختر درجه القيد بالنقابه</option>
                          @foreach($syndicate_levels as $syndicate)
                          <option value="{{$syndicate->id}}">{{$syndicate->name}}</option>
                          @endforeach
                          </select>
                  </div>
                </div>
                <div class="col-md-4 col-sm-6 col-xs-12">
                  <div class="master_field">
                    <label class="master_label mandatory" for="nationality">الجنسيه</label>
                    <select name="nationalities" class="master_input select2" id="nationality" data-placeholder="نوع العمل " style="width:100%;" ,>
                      <option value="0" selected="selected">الكل</option>
                      @foreach($nationalities as $nationality)
                      <option value="{{$nationality->item_id}}">{{$nationality->value}}</option>
                      @endforeach
                    </select><span class="master_message color--fadegreen"></span>
                  </div>
                </div>
                <div class="col-md-4 col-sm-6 col-xs-12">
                  <div class="master_field">
                    <label class="master_label mandatory" for="work_from">تاريخ الالتحاق من</label>
                    <div class="bootstrap-timepicker">
                      <input name="date_from" class="datepicker master_input" type="date" placeholder="تاريخ الالتحاق" id="work_from">
                    </div><span class="master_message color--fadegreen"></span>
                  </div>
                </div>
                <div class="col-md-4 col-sm-6 col-xs-12">
                  <div class="master_field">
                    <label class="master_label mandatory" for="work_to">تاريخ الالتحاق الى</label>
                    <div class="bootstrap-timepicker">
                      <input name="date_to" class="datepicker master_input" type="date" placeholder="تاريخ الالتحاق" id="work_to">
                    </div><span class="master_message color--fadegreen"></span>
                  </div>
                </div>
                <div class="col-md-4 col-sm-6 col-xs-12">
                  <div class="master_field">
                    <label class="master_label mandatory" for="work_to">  سنوات الخبره</label>
                    <div class="bootstrap-timepicker">
                      <input name="experience" class=" master_input" type="number" placeholder=" سنوات الخبره" id="work_to">
                    </div><span class="master_message color--fadegreen"></span>
                  </div>
                </div>
                <div class="col-md-4 col-sm-6 col-xs-12">
                  <div class="master_field">
                    <label class="master_label mandatory" for="work_to">  سعر الاستشاره</label>
                    <div class="bootstrap-timepicker">
                      <input name="consultation_cost" class=" master_input" type="number" placeholder=" سعر الاستشاره" id="work_to">
                    </div><span class="master_message color--fadegreen"></span>
                  </div>
                </div>
                <div class="col-md-4 col-sm-6 col-xs-12">
                  <div class="master_field">
                    <label class="master_label mandatory" for="work_type">نوع العمل</label>
                    <select name="types" class="master_input select2" id="work_type" data-placeholder="نوع العمل " style="width:100%;" ,>
                      <option value="0" selected="selected">الكل</option>
                      @foreach($types as $type)
                      <option value="{{$type->id}}">{{$type->name_ar}}</option>
                      @endforeach
                    </select><span class="master_message color--fadegreen"></span>
                  </div>
                </div>
              </div>
              <div class="clearfix"></div>
              <button class="remodal-cancel" data-remodal-action="cancel">الغاء</button>
              <button class="remodal-confirm"  type="submit">فلتر</button>
            </form>
            </div>
          </div>
          <div class="filter__btns"><a class="master-btn bgcolor--main color--white bradius--small" href="#filterModal_sponsors"><i class="fa fa-filter"></i>filters</a></div>
          <div class="bottomActions__btns"><a class="noti-all master-btn bradius--small padding--small bgcolor--fadeorange color--white" >ارسال تنبية</a><a class="excel-btn master-btn bradius--small padding--small bgcolor--fadeblue color--white" >استخراج اكسيل</a><a class="master-btn bradius--small padding--small bgcolor--fadebrown color--white btn-warning-cancel-all" >حذف المحدد</a>
          </div>
          <table class="table-1" id="dataTableTriggerId_001">
            <thead>
              <tr class="bgcolor--gray_mm color--gray_d">
                <th><span class="cellcontent">&lt;input type=&quot;checkbox&quot; name=&quot;select-all&quot; id=&quot;select-all&quot; /&gt;</span></th>
                <th><span class="cellcontent">كود المحامي</span></th>
                <th><span class="cellcontent">الاسم</span></th>
                <th><span class="cellcontent">نوع العمل</span></th>
                <th><span class="cellcontent">الرقم القومي</span></th>
                <th><span class="cellcontent">التخصص</span></th>
                <th><span class="cellcontent">درجة القيد بالنقابة</span></th>
                <th><span class="cellcontent">عنوان</span></th>
                <th><span class="cellcontent">رقم الموبايل</span></th>
                <th><span class="cellcontent">تاريخ الإلتحاق</span></th>
                <th><span class="cellcontent">الجنسية</span></th>
                <th><span class="cellcontent">تفعيل</span></th>
                <th><span class="cellcontent">الاجراءات</span></th>
                <th hidden> Notification</th>
              </tr>
            </thead>
            <tbody>
              @foreach($lawyers as $lawyer)
              <tr data-lawyer-id="{{$lawyer->id}}">
                <td><span class="cellcontent"><input type="checkbox" class="checkboxes input-in-table" /></span></td>
                <td><span class="cellcontent">{{$lawyer->code}}</span></td>
                <td><span class="cellcontent">{{$lawyer->full_name}}</span></td>
                <td><span class="cellcontent">
                  @foreach($lawyer->rules as $rule)
                  @if($rule->id !=5)
                  {{$rule->name_ar}}
                  @endif
                @endforeach</span></td>
                <td><span class="cellcontent">{{$lawyer->user_detail->national_id or ''}}</span></td>
                <td><span class="cellcontent">@foreach($lawyer->specializations as $spec){{$spec->name}}-@endforeach</span></td>
                <td><span class="cellcontent">{{$lawyer->user_detail->syndicate_levela->name or ''}}</span></td>
                <td><span class="cellcontent">{{$lawyer->address or ''}}</span></td>
                <td><span class="cellcontent">{{$lawyer->mobile or ''}}</span></td>
                <td><span class="cellcontent">@isset($lawyer->user_detail->join_date){{$lawyer->user_detail->join_date->format('Y - m - d')}}@endisset</span></td>
                <td><span class="cellcontent">
                  @isset($lawyer->user_detail->nationality->id)
                  @foreach($nationalities as $nationality)
                  @if($lawyer->user_detail->nationality->id == $nationality->item_id)
                  {{$nationality->value}}
                  @endif
                  @endforeach
                  @endisset
                </span></td>
                <td><span class="cellcontent">@if($lawyer->is_active==1)<i class = "fa color--fadegreen fa-check"></i>@else <i class = "fa color--fadebrown fa-times"> @endif</span></td>
                  <td><span class="cellcontent"><a href= "{{route('lawyers_show',$lawyer->id)}}" ,  class= "action-btn bgcolor--main color--white "><i class = "fa  fa-eye"></i></a><a href= "#lawyer_notification_{{$lawyer->id}}" ,  class= "noti action-btn bgcolor--fadeorange color--white "><i class = "fa  fa-bell"></i></a><a href= "{{route('lawyers_edit',$lawyer->id)}}" ,  class= "action-btn bgcolor--fadegreen color--white "><i class = "fa  fa-pencil"></i></a><a   class= "btn-warning-cancel action-btn bgcolor--fadebrown color--white "><i class = "fa  fa-trash-o"></i></a></span></td>
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
                </div></td>
                      </tr>
                
                @endforeach
              </tbody>
            </table>
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

    <script>
      $(document).ready(function(){
    
        $('.noti').click(function(){
          // var lawyer_id = $(this).closest('tr').attr('data-lawyer-id');
          // var _token = '{{csrf_token()}}';
          $('[data-remodal-id=lawyer_notification]').remodal().open();
          // alert(lawyer_id);
    // $(document).on('confirmation', '.remodal', function () {
    //         var noti = $('#nots').val(); 
    //         var time = $("input[name=date]").val();
    //          $.ajax({
    //            type:'POST',
    //            url:'{{url('notification_lawyer')}}'+'/'+lawyer_id,
    //            data:{notific:noti,noti_date:time,_token:_token},
    //            success:function(data){
    //             // alert(data);
    //             location.reload();
    //           }
    //         });
    
    // });
              });
    
            $('.noti-all').click(function(){
          var selectedIds = $("input:checkbox:checked").map(function(){
            return $(this).closest('tr').attr('data-lawyer-id');
          }).get();
          if(selectedIds.length <= 0) {
            confirm('إختر محامى على الأقل لإرسال تنبيه');
          }
          else{
            
          var _token = '{{csrf_token()}}';
          $('[data-remodal-id=lawyer_notifications]').remodal().open();
          $(document).on('confirmation', '#two', function () {
          // alert(selectedIds);
            var noti = $('#nots2').val(); 
            var time = $("input[name=date2]").val();
             $.ajax({
               type:'POST',
               url:'{{url('notification_for_lawyers')}}',
               data:{ids:selectedIds,notific:noti,noti_date:time,_token:_token},
               success:function(data){
                // alert(data);
                location.reload();
              }
            });
    
        });
          }
              });
    
    
        $('.btn-warning-cancel').click(function(){
          var lawyer_id = $(this).closest('tr').attr('data-lawyer-id');
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
                $('tr[data-lawyer-id='+lawyer_id+']').fadeOut();
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
            return $(this).closest('tr').attr('data-lawyer-id');
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
               url:'{{route('lawyers_destroy_all')}}',
               data:{ids:selectedIds,_token:_token},
               success:function(data){
                $.each( selectedIds, function( key, value ) {
                  $('tr[data-lawyer-id='+value+']').fadeOut();
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
         var filter='@if(\session('filter_ids')){{json_encode(\session('filter_ids'))}}@endif';
         var selectedIds = $("input:checkbox:checked").map(function(){
          return $(this).closest('tr').attr('data-lawyer-id');
        }).get();
         $.ajax({
           type:'GET',
           url:'{{route('lawyers_excel')}}',
           data:{ids:selectedIds,filters:filter},
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
    
            window.setTimeout(function() {
                $(".alert").fadeTo(500, 0).slideUp(500, function(){
                    $(this).remove(); 
                });
            }, 4000);
    
      });
    </script>
    @endsection