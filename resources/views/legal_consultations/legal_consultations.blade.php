@extends('layout.app')
@section('content')
  <script>
  $(document).ready(function(){

    $('.btn-warning-cancel').click(function(){
      var consultation_id = $(this).closest('tr').attr('data-consultation-id');
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
           url:'{{url('legal_consultation_destroy')}}'+'/'+consultation_id,
           data:{_token:_token},
           success:function(data){
            $('tr[data-consultation-id='+consultation_id+']').fadeOut();
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
        return $(this).closest('tr').attr('data-consultation-id');
      }).get();
      if(selectedIds.length == 0 )
      {
        swal("خطأ", "من فضلك اختر استشاره :)", "error");
      }
      else
      {
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
           url:'{{url('legal_consultation_destroy_all')}}',
           data:{ids:selectedIds,_token:_token},
           success:function(data){
            $.each( selectedIds, function( key, value ) {
              $('tr[data-consultation-id='+value+']').fadeOut();
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

 
var table = $('#dataTableTriggerId_001').DataTable();
  var delete_selected_button = document.getElementById('delete_selected');
 if ( ! table.data().any() ) {

    delete_selected_button.style.pointerEvents="none";
}
else
{
 delete_selected_button.style.pointerEvents="auto";
  
}
  $('.excel-btn').click(function(){
    // alert('1');
     var filter='@if(\session('filter_ids')){{json_encode(\session('filter_ids'))}}@endif';
     var selectedIds = $("input:checkbox:checked").map(function(){
      return $(this).closest('tr').attr('data-consultation-id');
    }).get();
     $.ajax({
       type:'GET',
       url:'{{route('consultations_excel')}}',
       data:{ids:selectedIds,filters:filter},
       success:function(response){
        // alert(2);
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
            
              <!-- =============== Custom Content ===============-->
              <div class="row">
                <div class="col-lg-12">
                  <div class="cover-inside-container margin--small-top-bottom bradius--small bshadow--1" style="background:  url( 'img/covers/dummy2.jpg ' ) no-repeat center center; background-size:cover;">
                    <div class="row">
                      <div class="col-xs-12">
                        <div class="text-xs-center">
                          <div class="text-wraper">
                            <h4 class="cover-inside-title color--gray_d">الاستشارات القانونية</h4>
                          </div>
                        </div>
                      </div>
                      <div class="cover--actions"><a class="color--gray_d bordercolor--white bradius--small border-btn master-btn" type="button" href="{{route('legal_consultation_add')}}">إضافة</a>
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
                    <div class="full-table hide-datatable-pagination">
                      <div class="remodal-bg">
                        <div class="remodal" data-remodal-id="filterModal_sponsors" role="dialog" aria-labelledby="modal1Title" aria-describedby="modal1Desc">
                          <form role="form" action="{{route('legal_consultation_filter')}}" method="post" accept-charset="utf-8">
          {{csrf_field()}}
                          <button class="remodal-close" data-remodal-action="close" aria-label="Close"></button>
                          <div>
                            <h2 id="modal1Title">فلتر</h2>
                            <div class="col-md-6">
                              <div class="master_field">
                                <label class="master_label mandatory" for="consultation_cat">التصنيف</label>
                                <select class="master_input select2" id="consultation_cat" name="consultation_cat[]" multiple="multiple" data-placeholder="التصنيف" style="width:100%;" ,>
                                   @foreach($consultation_types as $type)
                                    <option value="{{$type->id}}">{{$type->name}}</option>
                                    @endforeach
                                </select><span class="master_message color--fadegreen">message content</span>
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="master_field">
                                <label class="master_label mandatory" for="consultation_type"> النوع</label>
                                <select class="master_input select2" id="consultation_type" name="consultation_type[]" multiple="multiple" data-placeholder="النوع" style="width:100%;" ,>
                                  <option value="1">مدفوعة</option>
                                  <option value="0">مجانية</option>
                                </select><span class="master_message color--fadegreen">message content</span>
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="master_field">
                                <label class="master_label mandatory" for="consultation_date_from">تاريخ الاستشارة من</label>
                                <div class="bootstrap-timepicker">
                                  <input class="datepicker master_input" type="text" placeholder="تاريخ الاستشارة" id="consultation_date_from" name="consultation_date_from">
                                </div><span class="master_message color--fadegreen">message content</span>
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="master_field">
                                <label class="master_label mandatory" for="consultation_date_to">تاريخ الاستشارة الى</label>
                                <div class="bootstrap-timepicker">
                                  <input class="datepicker master_input" type="text" placeholder="تاريخ الاستشارة" id="consultation_date_to" name="consultation_date_to">
                                </div><span class="master_message color--fadegreen">message content</span>
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="master_field">
                                <label class="master_label mandatory">الحالة</label>
                                <div class="radiorobo">
                                  <input type="radio" id="rad_1" name="is_replied" value="2">
                                  <label for="rad_1">الكل</label>
                                </div>
                                <div class="radiorobo">
                                  <input type="radio" id="rad_2" name="is_replied" value="1">
                                  <label for="rad_2">تم الرد</label>
                                </div>
                                <div class="radiorobo">
                                  <input type="radio" id="rad_3" name="is_replied" value="0">
                                  <label for="rad_3">لم يتم الرد</label>
                                </div>
                              </div>
                            </div>

                            <div class="col-md-2 col-xs-4">
          <div class="master_field">
            <label class="master_label" for="sitch_1">اللغه</label>
                  <select name="language" class="master_input select2" id="type" data-placeholder="اللغة" >
                    <option value="" selected>اختر اللغة</option>
                    @foreach($languages as $language)
                    <option value="{{$language->id}}" >{{$language->name}}</option>
                    @endforeach
                  </select>
              
              @if ($errors->has('language'))
                <span class="master_message color--fadegreen">{{ $errors->first('language') }}</span>
              @endif
              
          </div>
                          </div>
                          <div class="clearfix"></div>
                          <button class="remodal-cancel" data-remodal-action="cancel">الغاء</button>
                          <button class="remodal-confirm"  type="submit">فلتر</button>
                          </form>
                        </div>
                      </div>
                      <div class="filter__btns"><a class="master-btn bgcolor--main color--white bradius--small" href="#filterModal_sponsors"><i class="fa fa-filter"></i>filters</a></div>
                      <div class="bottomActions__btns"><a class="excel-btn master-btn bradius--small padding--small bgcolor--fadeblue color--white" >استخراج اكسيل</a><a class="master-btn bradius--small padding--small bgcolor--fadebrown color--white btn-warning-cancel-all" href="#" id="delete_selected">حذف المحدد</a>
                      {{$consultations->links()}}
                      </div>
                      <table class="table-1 hide-datatable-pagination"  id="dataTableTriggerId_001">
                        <thead>
                          <tr class="bgcolor--gray_mm color--gray_d">
                            <th><span class="cellcontent">&lt;input type=&quot;checkbox&quot; name=&quot;select-all&quot; id=&quot;select-all&quot; /&gt;</span></th>
                            <th><span class="cellcontent">كود</span></th>
                            <th><span class="cellcontent">تصنيف</span></th>
                            <th><span class="cellcontent">سؤال الاستشارة</span></th>
                            <th><span class="cellcontent">تاريخ الاستشارة</span></th>
                            <th><span class="cellcontent">النوع</span></th>
                            <th><span class="cellcontent">تم الرد</span></th>
                            <th><span class="cellcontent">الاجراءات</span></th>
                          </tr>
                        </thead>
                        <tbody>
                           @foreach($consultations as $consultation)
                          <tr  data-consultation-id="{{$consultation->id}}">
                            <td><span class="cellcontent"><input type="checkbox" class="checkboxes input-in-table" /></span></td>
                             <td><span class="cellcontent">{{$consultation->code}}</span></td>
                            <td><span class="cellcontent">{{$consultation->consultation_type}}</span></td>
                            <td><span class="cellcontent">{{$consultation->question}}</span></td>
                            <td><span class="cellcontent">{{$consultation->created_at}}</span></td>
                            @if($consultation->is_paid)
                            <td><span class="cellcontent"><label class= "data-label bgcolor--fadepurple color--white  ">مدفوعه</label></span></td>
                            @else
                            <td><span class="cellcontent"><label class= "data-label bgcolor--fadepurple color--white  ">مجانيه</label></span></td>
                            @endif
                            @if($consultation->is_replied)
                            <td><span class="cellcontent"><i class = "fa color--fadegreen fa-check"></i></span></td>
                            @else
                            <td><span class="cellcontent"><i class = "fa color--fadebrown fa-times"></i></span></td>
                            @endif
                            <td><span class="cellcontent">
                            <a href= "{{URL('legal_consultation_view/'.$consultation->id)}}" ,  class= "action-btn bgcolor--main color--white "><i class = "fa  fa-eye"></i></a>
                            @if($consultation->direct_assigned == 0)
                            <a href= "{{URL('legal_consultation_edit/'.$consultation->id)}}" ,  class= "action-btn bgcolor--fadegreen color--white "><i class = "fa  fa-pencil"></i></a>
                            @endif
                            <a  class= "btn-warning-cancel action-btn bgcolor--fadebrown color--white "><i class = "fa  fa-trash-o"></i></a></span></td>
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
  
 <script type="text/javascript">

window.setTimeout(function() {
           $(".alert").fadeTo(500, 0).slideUp(500, function(){
               $(this).remove();
           });
       }, 4000);

  function exportExcel() {
        alasql('SELECT * INTO XLSX("consultations.xlsx",{headers:true}) \
                    FROM HTML("#dataTableTriggerId_001",{headers:true})');
        
    }
   function fnExcelReport()
{
    var tab_text="<table border='2px'><tr bgcolor='#87AFC6'>";
    var textRange; var j=0;
    tab = document.getElementById('dataTableTriggerId_001'); // id of table

    for(j = 0 ; j < tab.rows.length ; j++) 
    {     
        tab_text=tab_text+tab.rows[j].innerHTML+"</tr>";
        //tab_text=tab_text+"</tr>";
    }

    tab_text=tab_text+"</table>";
     tab_text= tab_text.replace(/<A[^>]*>|<\/A>/g, "");//remove if u want links in your table
     tab_text= tab_text.replace(/<img[^>]*>/gi,""); // remove if u want images in your table
     // tab_text= tab_text.replace(/<input[^>]*>|<\/input>/gi, ""); // reomves input params

    var ua = window.navigator.userAgent;
    var msie = ua.indexOf("MSIE "); 

    if (msie > 0 || !!navigator.userAgent.match(/Trident.*rv\:11\./))      // If Internet Explorer
    {
        txtArea1.document.open("txt/html","replace");
        txtArea1.document.write(tab_text);
        txtArea1.document.close();
        txtArea1.focus(); 
        sa=txtArea1.document.execCommand("SaveAs",true,"Say Thanks to Sumit.xls");
    }  
    else                 //other browser not tested on IE 11
        sa = window.open('data:application/vnd.ms-excel,' + encodeURIComponent(tab_text));  

    return (sa);
}
 </script>