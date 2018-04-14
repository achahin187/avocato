 @extends('layout.app')             
 @section('content')

 <script>
  $(document).ready(function(){

    $('.btn-warning-cancel').click(function(){
      var service_id = $(this).closest('tr').attr('data-service-id');
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
           url:'{{url('services_destroy')}}'+'/'+service_id,
           data:{_token:_token},
           success:function(data){
            $('tr[data-service-id='+service_id+']').fadeOut();
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
        return $(this).closest('tr').attr('data-service-id');
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
           url:'{{route('services_destroy_all')}}',
           data:{ids:selectedIds,_token:_token},
           success:function(data){
            $.each( selectedIds, function( key, value ) {
              $('tr[data-service-id='+value+']').fadeOut();
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
      return $(this).closest('tr').attr('data-service-id');
    }).get();
     $.ajax({
       type:'GET',
       url:'{{route('services_excel2')}}',
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


  });
</script>

              <div class="row">
                <div class="col-lg-12">
                  <div class="cover-inside-container margin--small-top-bottom bradius--small bshadow--1" style="background:  url( 'img/covers/dummy2.jpg ' ) no-repeat center center; background-size:cover;">
                    <div class="row">
                      <div class="col-xs-12">
                        <div class="text-xs-center">
                          <div class="text-wraper">
                            <h4 class="cover-inside-title color--gray_d">المهام <i class="fa fa-chevron-circle-right"></i>
                              <h4 class="cover-inside-title color--gray_d">المهام العادية </h4>
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
                  <div class="tabs--wrapper">
                    <div class="clearfix"></div>
                    <ul class="tabs">
                      <li>الأجندة القضائية</li>
                      <li>الخدمات</li>
                    </ul>
                    <ul class="tab__content">
                      <li class="tab__content_item active">
                        <div class="cardwrap bgcolor--white bradius--noborder   bshadow--1 padding--small margin--small-top-bottom">
                          <div class="full-table">
                            <div class="remodal-bg">
                              <div class="remodal" data-remodal-id="filterModal_agenda" role="dialog" aria-labelledby="modal1Title" aria-describedby="modal1Desc">
                                <button class="remodal-close" data-remodal-action="close" aria-label="Close"></button>
                                <div>
                                  <h2 id="modal1Title">فلتر</h2>
                                  <div class="col-md-4 col-sm-6 col-xs-12">
                                    <div class="master_field">
                                      <label class="master_label mandatory" for="agenda_date_from">تاريخ الجلسة من</label>
                                      <div class="bootstrap-timepicker">
                                        <input class="datepicker master_input" type="text" placeholder="التاريخ من" id="agenda_date_from">
                                      </div><span class="master_message color--fadegreen">message</span>
                                    </div>
                                  </div>
                                  <div class="col-md-4 col-sm-6 col-xs-12">
                                    <div class="master_field">
                                      <label class="master_label mandatory" for="agenda_date_to">تاريخ الجلسة الى</label>
                                      <div class="bootstrap-timepicker">
                                        <input class="datepicker master_input" type="text" placeholder="التاريخ الى" id="agenda_date_to">
                                      </div><span class="master_message color--fadegreen">message</span>
                                    </div>
                                  </div>
                                  <div class="col-md-4 col-sm-6 col-xs-12">
                                    <div class="master_field">
                                      <label class="master_label mandatory" for="agenda_client">اسم العميل</label>
                                      <input class="master_input" type="text" placeholder="اسم العميل (الموكل)" id="agenda_client"><span class="master_message color--fadegreen">message</span>
                                    </div>
                                  </div>
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="master_field">
                                      <label class="master_label mandatory" for="case_court2">المحكمة </label>
                                      <select class="master_input select2" id="case_court2" multiple="multiple" data-placeholder="المحكمة" style="width:100%;" ,>
                                        <option>محكمة شرق القاهرة</option>
                                        <option>محكمة غرب القاهرة</option>
                                        <option>محكمة جنوب القاهرة </option>
                                        <option>محكمة الجيزة</option>
                                      </select><span class="master_message color--fadegreen">message</span>
                                    </div>
                                  </div>
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="master_field">
                                      <label class="master_label mandatory" for="case_type2">الدائرة</label>
                                      <select class="master_input select2" id="case_type2" multiple="multiple" data-placeholder="الدائرة" style="width:100%;" ,>
                                        <option>دائرة العباسية</option>
                                        <option>دائرة الدقي</option>
                                      </select><span class="master_message color--fadegreen">message</span>
                                    </div>
                                  </div>
                                  <div class="col-md-12">
                                    <div class="master_field">
                                      <label class="master_label mandatory">الحالة</label>
                                      <div class="radiorobo">
                                        <input type="radio" id="services_rad_1">
                                        <label for="services_rad_1">الكل</label>
                                      </div>
                                      <div class="radiorobo">
                                        <input type="radio" id="services_rad_2">
                                        <label for="services_rad_2">تم تحديد محامي</label>
                                      </div>
                                      <div class="radiorobo">
                                        <input type="radio" id="services_rad_3">
                                        <label for="services_rad_3">لم يتم تحديد محامي</label>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="master_field">
                                      <label class="master_label mandatory" for="next_date_from">تاريخ الجلسة القادمة من</label>
                                      <div class="bootstrap-timepicker">
                                        <input class="datepicker master_input" type="text" placeholder="التاريخ من" id="next_date_from">
                                      </div><span class="master_message color--fadegreen">message</span>
                                    </div>
                                  </div>
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="master_field">
                                      <label class="master_label mandatory" for="next_date_to">تاريخ الجلسة القادمة الى</label>
                                      <div class="bootstrap-timepicker">
                                        <input class="datepicker master_input" type="text" placeholder="التاريخ الى" id="next_date_to">
                                      </div><span class="master_message color--fadegreen">message</span>
                                    </div>
                                  </div>
                                </div>
                                <div class="clearfix"></div>
                                <button class="remodal-cancel" data-remodal-action="cancel">الغاء</button>
                                <button class="remodal-confirm" data-remodal-action="confirm">فلتر</button>
                              </div>
                            </div>
                            <div class="filter__btns"><a class="master-btn bgcolor--main color--white bradius--small" href="#filterModal_agenda"><i class="fa fa-filter"></i>filters</a></div>
                            <div class="bottomActions__btns"><a class="master-btn bradius--small padding--small bgcolor--fadeblue color--white" href="#">استخراج اكسيل</a><a class="master-btn bradius--small padding--small bgcolor--fadebrown color--white btn-warning-cancel" href="#">حذف المحدد</a>
                            </div>
                            <table class="table-1">
                              <thead>
                                <tr class="bgcolor--gray_mm color--gray_d">
                                  <th><span class="cellcontent">&lt;input type=&quot;checkbox&quot; name=&quot;select-all&quot; id=&quot;select-all&quot; /&gt;</span></th>
                                  <th><span class="cellcontent">تاريخ الجلسة</span></th>
                                  <th><span class="cellcontent">المحكمة/الدائرة </span></th>
                                  <th><span class="cellcontent">رقم الدعوى</span></th>
                                  <th><span class="cellcontent">الموكل و صفته</span></th>
                                  <th><span class="cellcontent">الخصم و صفته</span></th>
                                  <th><span class="cellcontent">ما تم فيها من دفاع وقرارات</span></th>
                                  <th><span class="cellcontent">القرار</span></th>
                                  <th><span class="cellcontent">تاريخ الجلسة القادمة</span></th>
                                  <th><span class="cellcontent">المحامي المحدد</span></th>
                                  <th><span class="cellcontent">الاجراءات</span></th>
                                </tr>
                              </thead>
                              <tbody>
                                <tr>
                                  <td><span class="cellcontent"><input type="checkbox" class="checkboxes" /></span></td>
                                  <td><span class="cellcontent">10-9-2019</span></td>
                                  <td><span class="cellcontent">محكمة جنايات القاهرة</span></td>
                                  <td><span class="cellcontent">234234324</span></td>
                                  <td><span class="cellcontent">محمد احمد المجنى عليه</span></td>
                                  <td><span class="cellcontent">حسن علي  الجانى</span></td>
                                  <td><span class="cellcontent">بعض النص بعض النص</span></td>
                                  <td><span class="cellcontent">تم تاجيل النطق بالحكم </span></td>
                                  <td><span class="cellcontent">10-9-2019</span></td>
                                  <td><span class="cellcontent">ابراهيم السيد</span></td>
                                  <td><span class="cellcontent"><a href= assign_known_task.html ,  class= "action-btn bgcolor--fadepurple  color--white "><i class = "fa  fa-edit"></i></a><a href="#"  class= "btn-warning-cancel action-btn bgcolor--fadebrown color--white "><i class = "fa  fa-trash-o"></i></a></span></td>
                                </tr>
                                <tr>
                                  <td><span class="cellcontent"><input type="checkbox" class="checkboxes" /></span></td>
                                  <td><span class="cellcontent">10-9-2019</span></td>
                                  <td><span class="cellcontent">محكمة جنايات القاهرة</span></td>
                                  <td><span class="cellcontent">234234324</span></td>
                                  <td><span class="cellcontent">محمد احمد المجنى عليه</span></td>
                                  <td><span class="cellcontent">حسن علي  الجانى</span></td>
                                  <td><span class="cellcontent">بعض النص بعض النص</span></td>
                                  <td><span class="cellcontent">تم تاجيل النطق بالحكم </span></td>
                                  <td><span class="cellcontent">10-9-2019</span></td>
                                  <td><span class="cellcontent">ابراهيم السيد</span></td>
                                  <td><span class="cellcontent"><a href= assign_known_task.html ,  class= "action-btn bgcolor--fadepurple  color--white "><i class = "fa  fa-edit"></i></a><a href="#"  class= "btn-warning-cancel action-btn bgcolor--fadebrown color--white "><i class = "fa  fa-trash-o"></i></a></span></td>
                                </tr>
                                <tr>
                                  <td><span class="cellcontent"><input type="checkbox" class="checkboxes" /></span></td>
                                  <td><span class="cellcontent">10-9-2019</span></td>
                                  <td><span class="cellcontent">محكمة جنايات القاهرة</span></td>
                                  <td><span class="cellcontent">234234324</span></td>
                                  <td><span class="cellcontent">محمد احمد المجنى عليه</span></td>
                                  <td><span class="cellcontent">حسن علي  الجانى</span></td>
                                  <td><span class="cellcontent">بعض النص بعض النص</span></td>
                                  <td><span class="cellcontent">تم تاجيل النطق بالحكم </span></td>
                                  <td><span class="cellcontent">10-9-2019</span></td>
                                  <td><span class="cellcontent">ابراهيم السيد</span></td>
                                  <td><span class="cellcontent"><a href= assign_known_task.html ,  class= "action-btn bgcolor--fadepurple  color--white "><i class = "fa  fa-edit"></i></a><a href="#"  class= "btn-warning-cancel action-btn bgcolor--fadebrown color--white "><i class = "fa  fa-trash-o"></i></a></span></td>
                                </tr>
                                <tr>
                                  <td><span class="cellcontent"><input type="checkbox" class="checkboxes" /></span></td>
                                  <td><span class="cellcontent">10-9-2019</span></td>
                                  <td><span class="cellcontent">محكمة جنايات القاهرة</span></td>
                                  <td><span class="cellcontent">234234324</span></td>
                                  <td><span class="cellcontent">محمد احمد المجنى عليه</span></td>
                                  <td><span class="cellcontent">حسن علي  الجانى</span></td>
                                  <td><span class="cellcontent">بعض النص بعض النص</span></td>
                                  <td><span class="cellcontent">تم تاجيل النطق بالحكم </span></td>
                                  <td><span class="cellcontent">10-9-2019</span></td>
                                  <td><span class="cellcontent">ابراهيم السيد</span></td>
                                  <td><span class="cellcontent"><a href= assign_known_task.html ,  class= "action-btn bgcolor--fadepurple  color--white "><i class = "fa  fa-edit"></i></a><a href="#"  class= "btn-warning-cancel action-btn bgcolor--fadebrown color--white "><i class = "fa  fa-trash-o"></i></a></span></td>
                                </tr>
                                <tr>
                                  <td><span class="cellcontent"><input type="checkbox" class="checkboxes" /></span></td>
                                  <td><span class="cellcontent">10-9-2019</span></td>
                                  <td><span class="cellcontent">محكمة جنايات القاهرة</span></td>
                                  <td><span class="cellcontent">234234324</span></td>
                                  <td><span class="cellcontent">محمد احمد المجنى عليه</span></td>
                                  <td><span class="cellcontent">حسن علي  الجانى</span></td>
                                  <td><span class="cellcontent">بعض النص بعض النص</span></td>
                                  <td><span class="cellcontent">تم تاجيل النطق بالحكم </span></td>
                                  <td><span class="cellcontent">10-9-2019</span></td>
                                  <td><span class="cellcontent">ابراهيم السيد</span></td>
                                  <td><span class="cellcontent"><a href= assign_known_task.html ,  class= "action-btn bgcolor--fadepurple  color--white "><i class = "fa  fa-edit"></i></a><a href="#"  class= "btn-warning-cancel action-btn bgcolor--fadebrown color--white "><i class = "fa  fa-trash-o"></i></a></span></td>
                                </tr>
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
                      </li>
                      <li class="tab__content_item">
                        <div class="cardwrap bgcolor--white bradius--noborder   bshadow--1 padding--small margin--small-top-bottom">
                          <div class="full-table">
                            <div class="remodal-bg">
                              <div class="remodal" data-remodal-id="filterModal_services" role="dialog" aria-labelledby="modal1Title" aria-describedby="modal1Desc">
                                <button class="remodal-close" data-remodal-action="close" aria-label="Close"></button>
                                <div>
                                  <h2 id="modal1Title">فلتر</h2>
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="master_field">
                                      <label class="master_label mandatory" for="service_date_from">التاريخ من</label>
                                      <div class="bootstrap-timepicker">
                                        <input class="datepicker master_input" type="text" placeholder="التاريخ من" id="service_date_from">
                                      </div><span class="master_message color--fadegreen">message</span>
                                    </div>
                                  </div>
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="master_field">
                                      <label class="master_label mandatory" for="service_date_to">التاريخ الى</label>
                                      <div class="bootstrap-timepicker">
                                        <input class="datepicker master_input" type="text" placeholder="التاريخ الى" id="service_date_to">
                                      </div><span class="master_message color--fadegreen">message</span>
                                    </div>
                                  </div>
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="master_field">
                                      <label class="master_label mandatory" for="ID_No">اسم العميل</label>
                                      <input class="master_input" type="text" placeholder="اسم العميل (الموكل)" id="ID_No"><span class="master_message color--fadegreen">message</span>
                                    </div>
                                  </div>
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="master_field">
                                      <label class="master_label mandatory">الحالة</label>
                                      <div class="radiorobo">
                                        <input type="radio" id="services_rad_1">
                                        <label for="services_rad_1">الكل</label>
                                      </div>
                                      <div class="radiorobo">
                                        <input type="radio" id="services_rad_2">
                                        <label for="services_rad_2">تم</label>
                                      </div>
                                      <div class="radiorobo">
                                        <input type="radio" id="services_rad_3">
                                        <label for="services_rad_3">لم يتم</label>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="master_field">
                                      <label class="master_label mandatory">تحديد المحامي</label>
                                      <div class="radiorobo">
                                        <input type="radio" id="services_rad_1">
                                        <label for="services_rad_1">الكل</label>
                                      </div>
                                      <div class="radiorobo">
                                        <input type="radio" id="services_rad_2">
                                        <label for="services_rad_2">تم تحديد محامي</label>
                                      </div>
                                      <div class="radiorobo">
                                        <input type="radio" id="services_rad_3">
                                        <label for="services_rad_3">لم يتم تحديد محامي</label>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <div class="clearfix"></div>
                                <button class="remodal-cancel" data-remodal-action="cancel">الغاء</button>
                                <button class="remodal-confirm" data-remodal-action="confirm">فلتر</button>
                              </div>
                            </div>
                            <div class="filter__btns"><a class="master-btn bgcolor--main color--white bradius--small" href="#filterModal_services"><i class="fa fa-filter"></i>filters</a></div>
                            <div class="bottomActions__btns"><a class="excel-btn master-btn bradius--small padding--small bgcolor--fadeblue color--white" href="#">استخراج اكسيل</a><a class="master-btn bradius--small padding--small bgcolor--fadebrown color--white btn-warning-cancel-all" href="#">حذف المحدد</a>
                            </div>
                            <table class="table-1" id="dataTableTriggerId_001">
                              <thead>
                                <tr class="bgcolor--gray_mm color--gray_d">
                                  <th><span class="cellcontent">&lt;input type=&quot;checkbox&quot; name=&quot;select-all&quot; id=&quot;select-all&quot; /&gt;</span></th>
                                  <th><span class="cellcontent">اسم الخدمة</span></th>
                                  <th><span class="cellcontent">اسم العميل</span></th>
                                  <th><span class="cellcontent">العنوان</span></th>
                                  <th><span class="cellcontent">التاريخ</span></th>
                                  <th><span class="cellcontent">الحالة</span></th>
                                  <th><span class="cellcontent">الاجراءات</span></th>
                                </tr>
                              </thead>
                              <tbody>
                                @foreach($services as $service)
                                <tr data-service-id="{{$service->id}}">
                                  <td><span class="cellcontent"><input type="checkbox" class="checkboxes input-in-table" /></span></td>
                                  <td><span class="cellcontent">{{$service->name}}</span></td>
                                  <td><span class="cellcontent">{{$service->client->full_name}}</span></td>
                                  <td><span class="cellcontent">{{$service->client->address}}</span></td>
                                  <td><span class="cellcontent">{{$service->start_datetime->format('Y - m - d')}}</span></td>
                                  <td><span class="cellcontent">
                  @foreach($statuses as $status)
                    @if($status->item_id == $service->task_status_id)
                    {{$status->value}}
                    @endif
                  @endforeach</span></td>
                                  <td><span class="cellcontent"><a href="{{route('services_show',$service->id)}}" ,  class= "action-btn bgcolor--main color--white "><i class = "fa  fa-eye"></i></a><a href= "{{route('services_edit',$service->id)}}" ,  class= "action-btn bgcolor--fadepurple  color--white "><i class = "fa  fa-edit"></i></a><a href="#"  class= "btn-warning-cancel action-btn bgcolor--fadebrown color--white "><i class = "fa  fa-trash-o"></i></a></span></td>
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
                            <div class="clearfix"></div>
                          </div>
                        </div>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>

 @endsection