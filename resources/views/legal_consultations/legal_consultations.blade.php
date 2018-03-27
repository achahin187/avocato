@extends('layout.app')
@section('content')
    
            
              <!-- =============== Custom Content ===============-->
              <div class="row">
                <div class="col-lg-12">
                  <div class="cover-inside-container margin--small-top-bottom bradius--small bshadow--1" style="background:  url( '../img/covers/dummy2.jpg ' ) no-repeat center center; background-size:cover;">
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
                  <div class="cardwrap bgcolor--white bradius--noborder   bshadow--1 padding--small margin--small-top-bottom">
                    <div class="full-table">
                      <div class="remodal-bg">
                        <div class="remodal" data-remodal-id="filterModal_sponsors" role="dialog" aria-labelledby="modal1Title" aria-describedby="modal1Desc">
                          <button class="remodal-close" data-remodal-action="close" aria-label="Close"></button>
                          <div>
                            <h2 id="modal1Title">فلتر</h2>
                            <div class="col-md-6">
                              <div class="master_field">
                                <label class="master_label mandatory" for="consultation_cat">التصنيف</label>
                                <select class="master_input select2" id="consultation_cat" multiple="multiple" data-placeholder="التصنيف" style="width:100%;" ,>
                                  <option>تصنيف 1</option>
                                  <option>تصنيف2</option>
                                </select><span class="master_message color--fadegreen">message content</span>
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="master_field">
                                <label class="master_label mandatory" for="consultation_type"> النوع</label>
                                <select class="master_input select2" id="consultation_type" multiple="multiple" data-placeholder="النوع" style="width:100%;" ,>
                                  <option>مدفوع</option>
                                  <option>مجانية</option>
                                </select><span class="master_message color--fadegreen">message content</span>
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="master_field">
                                <label class="master_label mandatory" for="consultation_date_from">تاريخ الاستشارة من</label>
                                <div class="bootstrap-timepicker">
                                  <input class="datepicker master_input" type="text" placeholder="تاريخ الاستشارة" id="consultation_date_from">
                                </div><span class="master_message color--fadegreen">message content</span>
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="master_field">
                                <label class="master_label mandatory" for="consultation_date_to">تاريخ الاستشارة الى</label>
                                <div class="bootstrap-timepicker">
                                  <input class="datepicker master_input" type="text" placeholder="تاريخ الاستشارة" id="consultation_date_to">
                                </div><span class="master_message color--fadegreen">message content</span>
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="master_field">
                                <label class="master_label mandatory">الحالة</label>
                                <div class="radiorobo">
                                  <input type="radio" id="rad_1">
                                  <label for="rad_1">الكل</label>
                                </div>
                                <div class="radiorobo">
                                  <input type="radio" id="rad_2">
                                  <label for="rad_2">تم الرد</label>
                                </div>
                                <div class="radiorobo">
                                  <input type="radio" id="rad_3">
                                  <label for="rad_3">لم يتم الرد</label>
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
                      <div class="bottomActions__btns"><a class="master-btn bradius--small padding--small bgcolor--fadeblue color--white" href="#" onclick="return exportExcel();">استخراج اكسيل</a><a class="master-btn bradius--small padding--small bgcolor--fadebrown color--white btn-warning-cancel" href="#">حذف المحدد</a>
                      </div>
                      <table class="table-1" id="consultation_table">
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
                          <tr class="bgcolor--gray_mm color--gray_d">
                            <td><span class="cellcontent"><input type="checkbox" class="checkboxes" /></span></td>
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
                            <td><span class="cellcontent"><i class = "fa color--fadegreen fa-times"></i></span></td>
                            @endif
                            <td><span class="cellcontent"><a href= "{{URL('legal_consultation_view/'.$consultation->id)}}" ,  class= "action-btn bgcolor--main color--white "><i class = "fa  fa-eye"></i></a><a href= "{{URL('legal_consultation_edit/'.$consultation->id)}}" ,  class= "action-btn bgcolor--fadegreen color--white "><i class = "fa  fa-pencil"></i></a><a href="{{URL('legal_consultation_destroy/'.$consultation->id)}}"  class= "btn-warning-cancel action-btn bgcolor--fadebrown color--white "><i class = "fa  fa-trash-o"></i></a></span></td>
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
   <script src="https://cdnjs.cloudflare.com/ajax/libs/alasql/0.3.7/alasql.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.9.2/xlsx.core.min.js"></script>
 <script type="text/javascript">
  function exportExcel() {
        alasql('SELECT * INTO XLSX("consultations.xlsx",{headers:true}) \
                    FROM HTML("#consultation_table",{headers:true})');
    }
   function fnExcelReport()
{
    var tab_text="<table border='2px'><tr bgcolor='#87AFC6'>";
    var textRange; var j=0;
    tab = document.getElementById('consultation_table'); // id of table

    for(j = 0 ; j < tab.rows.length ; j++) 
    {     
        tab_text=tab_text+tab.rows[j].innerHTML+"</tr>";
        //tab_text=tab_text+"</tr>";
    }

    tab_text=tab_text+"</table>";
     tab_text= tab_text.replace(/<A[^>]*>|<\/A>/g, "");//remove if u want links in your table
     tab_text= tab_text.replace(/<img[^>]*>/gi,""); // remove if u want images in your table
     tab_text= tab_text.replace(/<input[^>]*>|<\/input>/gi, ""); // reomves input params

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