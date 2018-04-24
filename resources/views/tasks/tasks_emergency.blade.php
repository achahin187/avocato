 @extends('layout.app')             
 @section('content')

 <div class="row">
                <div class="col-lg-12">
                  <div class="cover-inside-container margin--small-top-bottom bradius--small bshadow--1" style="background:  url( 'img/covers/dummy2.jpg ' ) no-repeat center center; background-size:cover;">
                    <div class="row">
                      <div class="col-xs-12">
                        <div class="text-xs-center">
                          <div class="text-wraper">
                            <h4 class="cover-inside-title color--gray_d">المهام <i class="fa fa-chevron-circle-right"></i>
                              <h4 class="cover-inside-title color--gray_d">الحالات الطارئة </h4>
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
                @if ($errors->has('lawyer'))
                <div class="alert alert-danger">
                {{ $errors->first('lawyer')}}
                </div>
                @endif
                  <div class="cardwrap bgcolor--white bradius--noborder   bshadow--1 padding--small margin--small-top-bottom">
                    <div class="full-table">
                      <div class="remodal-bg">
                        <div class="remodal" data-remodal-id="filterModal_sponsors" role="dialog" aria-labelledby="modal1Title" aria-describedby="modal1Desc">
                          <button class="remodal-close" data-remodal-action="close" aria-label="Close"></button>
                          <div>
                            <h2 id="modal1Title">فلتر</h2>
                            <div class="col-md-3 col-sm-6 col-xs-12">
                              <div class="master_field">
                                <label class="master_label mandatory" for="date_from">التاريخ من</label>
                                <div class="bootstrap-timepicker">
                                  <input class="datepicker master_input" type="text" placeholder="التاريخ" id="date_from">
                                </div><span class="master_message color--fadegreen">message content</span>
                              </div>
                            </div>
                            <div class="col-md-3 col-sm-6 col-xs-12">
                              <div class="master_field">
                                <label class="master_label mandatory" for="date_to">التاريخ الى</label>
                                <div class="bootstrap-timepicker">
                                  <input class="datepicker master_input" type="text" placeholder="التاريخ" id="date_to">
                                </div><span class="master_message color--fadegreen">message content</span>
                              </div>
                            </div>
                            <div class="col-md-3 col-sm-6 col-xs-12">
                              <div class="master_field">
                                <label class="master_label mandatory" for="time_from">الوقت من</label>
                                <div class="bootstrap-timepicker">
                                  <input class="timepicker master_input" type="text" placeholder="الوقت" id="time_from">
                                </div><span class="master_message color--fadegreen">message content</span>
                              </div>
                            </div>
                            <div class="col-md-3 col-sm-6 col-xs-12">
                              <div class="master_field">
                                <label class="master_label mandatory" for="time_to">الوقت الى</label>
                                <div class="bootstrap-timepicker">
                                  <input class="timepicker master_input" type="text" placeholder="الوقت" id="time_to">
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
                      <div class="bottomActions__btns"><a class="master-btn bradius--small padding--small bgcolor--fadeblue color--white" href="#" onclick="return exportExcel();">استخراج اكسيل</a><a class="master-btn bradius--small padding--small bgcolor--fadebrown color--white btn-warning-cancel-all" href="#">حذف المحدد</a>
                      </div>
                      <table class="table-1" id="dataTableTriggerId_001">
                        <thead>
                          <tr class="bgcolor--gray_mm color--gray_d">
                            <th><span class="cellcontent">&lt;input type=&quot;checkbox&quot; name=&quot;select-all&quot; id=&quot;select-all&quot; /&gt;</span></th>
                            <th><span class="cellcontent">كودالعميل</span></th>
                            <th><span class="cellcontent">اسم العميل</span></th>
                            <th><span class="cellcontent">نوع العميل</span></th>
                            <th><span class="cellcontent">هاتف</span></th>
                            <th><span class="cellcontent">عنوان</span></th>
                            <th><span class="cellcontent"> التاريخ</span></th>
                            <th><span class="cellcontent">الوقت</span></th>
                            <th><span class="cellcontent">الحالة</span></th>
                            <th><span class="cellcontent">المحامي المحدد</span></th>
                            <th><span class="cellcontent">الاجراءات</span></th>
                          </tr>
                        </thead>
                        <tbody>



                          @foreach($tasks as $task)
                          <tr data-task-id={{$task->id}}>
                            <?php
                              $timestamp=strtotime($task->start_datetime);
                              $date = date('d-m-Y', $timestamp);
                            $time = date('h:i', $timestamp);
                          ?>
                            <td><span class="cellcontent"><input type="checkbox" class="checkboxes input-in-table" /></span></td>
                            <td><span class="cellcontent">{{$task->client->code or ''}}</span></td>
                            <td><span class="cellcontent">{{$task->client->name or ''}}</span></td>
                            <td><span class="cellcontent">افراد</span></td>
                            <td><span class="cellcontent">{{$task->client->mobile or ''}}</span></td>
                            <td><span class="cellcontent">{{$task->client->address or ''}}</span></td>
                            <td><span class="cellcontent">{{$date}}</span></td>
                            <td><span class="cellcontent">{{$time}}</span></td>
                            <td><span class="cellcontent"><label class= "data-label bgcolor--fadegreen color--white  ">
                              @if($task->task_status_id == 2)
                              تم
                              @else
                              لم يتم
                              @endif
                            </label></span></td>
                            <td><span class="cellcontent">{{$task->lawyer->name or ''}}</span></td>
                            <td><span class="cellcontent"><a href="{{URL('task_emergency_view/'.$task->id)}}" ,  class= "action-btn bgcolor--main color--white "><i class = "fa  fa-eye"></i></a><a href= "{{URL('assign_emergency_task/'.$task->id)}}" ,  class= "action-btn bgcolor--fadepurple  color--white "><i class = "fa  fa-edit"></i></a><a href="#"  class= "btn-warning-cancel action-btn bgcolor--fadebrown color--white "><i class = "fa  fa-trash-o"></i></a></span></td>
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
                    <div class="col-md-2 col-sm-3 colxs-12"><a class="master-btn color--white bgcolor--main bradius--small bshadow--0 btn-block" href="#add_task_service"><i class="fa fa-plus"></i><span>إضافة حالة طارئة</span></a>
                      <div class="remodal-bg"></div>
                      <div class="remodal" data-remodal-id="add_task_service" role="dialog" aria-labelledby="modal1Title" aria-describedby="modal1Desc">
                        <form action="{{ route('add_emergency_task') }}" method="post" enctype="multipart/form-data" accept-charset="utf-8">
                   <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <button class="remodal-close" data-remodal-action="close" aria-label="Close"></button>
                        <div>
                          <div class="row">
                            <div class="col-xs-12">
                              <h3>إضافة حالة طارئة</h3>
                              <div class="col-md-4 col-sm-6 col-xs-12">
                                <div class="master_field">
                                  <label class="master_label mandatory" for="client_code">كود العميل</label>
                                  <input class="master_input" type="number" placeholder="كود العميل" id="client_code"><span class="master_message color--fadegreen">message</span>
                                </div>
                              </div>
                              <div class="col-md-4 col-sm-6 col-xs-12">
                                <div class="master_field">
                                  <label class="master_label mandatory" for="client_name">اسم العميل</label>
                                  <input class="master_input" type="text" placeholder="اسم العميل" id="client_name"><span class="master_message color--fadegreen">message</span>
                                </div>
                              </div>
                              <div class="col-md-4 col-sm-6 col-xs-12">
                                <div class="master_field">
                                  <label class="master_label mandatory" for="client_tel">تليفون</label>
                                  <input class="master_input" type="number" placeholder="تليفون العميل" id="client_tel"><span class="master_message color--fadegreen">message</span>
                                </div>
                              </div>
                              <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="master_field">
                                  <label class="master_label mandatory" for="client_address">عنوان العميل </label>
                                  <input class="master_input" type="text" placeholder="عنوان العميل" id="client_address"><span class="master_message color--fadegreen">message</span>
                                </div>
                              </div>
                              <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="master_field">
                                  <label class="master_label mandatory" for="governorate">نوع إشتراك العميل</label>
                                  <select class="master_input select2" id="governorate" multiple="multiple" data-placeholder="نوع العميل" style="width:100%;" ,>
                                    <option>أفراد - شركات</option>
                                    <option>شركات</option>
                                    <option>أفراد</option>
                                  </select><span class="master_message color--fadegreen">message</span>
                                </div>
                              </div>
                              <div class="col-xs-12">
                                <div class="master_field">
                                  <label class="master_label">تفاصيل الحالة الطارئة</label>
                                  <textarea class="master_input" name="body" placeholder="تفاصيل الحالة الطارئة"></textarea>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div><br>
                        <button class="remodal-cancel" data-remodal-action="cancel">إلغاء</button>
                        <button class="remodal-confirm" type="submit">حفظ</button>
                      </form>
                      </div>
                    </div>
                    <div class="clearfix"></div>
                  </div>
                </div>
              </div>
 
 @endsection
 @section('js')
                        <script>
                           function exportExcel() {
        alasql('SELECT * INTO XLSX("emergency_tasks.xlsx",{headers:true}) \
                    FROM HTML("#dataTableTriggerId_001",{headers:true})');
        
    }
  $(document).ready(function(){

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
           url:'{{url('task_destroy')}}'+'/'+task_id,
           data:{_token:_token},
           success:function(data){
            $('tr[data-task-id='+task_id+']').fadeOut();
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
        return $(this).closest('tr').attr('data-task-id');
      }).get();
      if(selectedIds.length == 0 )
      {
        swal("خطأ", "من فضلك اختر استشاره :)", "error");
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
           url:'{{url('task_destroy_all')}}',
           data:{ids:selectedIds,_token:_token},
           success:function(data){
            $.each( selectedIds, function( key, value ) {
              $('tr[data-task-id='+value+']').fadeOut();
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

 

  });
</script>
                       @endsection