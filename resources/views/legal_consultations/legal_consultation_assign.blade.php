@extends('layout.app')
@section('content')
  <script>
  $(document).ready(function(){

 $('.send_consultation_to_all_lawyers').click(function(){
      var selectedIds = $("input:checkbox:checked").map(function(){
        return $(this).closest('tr').attr('data-lawyer-id');
      }).get();
      var _token = '{{csrf_token()}}';
      swal({
        title: "هل أنت متأكد؟",
        text: "سوف يتم ارسال الاستشاره الى المحامين المحددين",
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
           url:'{{url('send_consultation_to_all_lawyers')}}'+'/'+{{$consultation->id}},
           data:{ids:selectedIds,_token:_token},
           success:function(data){
            // alert('done');
          }
        });
         swal("تم الارسال!", "تم الارسال بنجاح", "success");
       } else {
        swal("تم الإلغاء", "لم يتم ارسال الاستشاره :)", "error");
      }
    });
    });

  var table = $('#example').DataTable();
 if ( ! table.data().any() ) {
    alert( 'Empty table' );
}
if ( table.rows( '.selected' ).any() ) {
    alert( 'Rows are selected' );
}

  });

</script>
              <!-- =============== Custom Content ===============-->
              <div class="row">
                <div class="col-lg-12">
                  <div class="cover-inside-container margin--small-top-bottom bradius--small bshadow--1" style="background:  url( '../img/covers/dummy2.jpg ' ) no-repeat center center; background-size:cover;">
                    <div class="add-mode">Adding mode</div>
                    <div class="row">
                      <div class="col-xs-12">
                        <div class="text-xs-center">
                          <div class="text-wraper">
                            <h4 class="cover-inside-title color--gray_d">الاستشارات القانونية</h4>
                          </div>
                        </div>
                      </div>
                      <div class="cover--actions">
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-lg-12">
                  <div class="cardwrap bgcolor--white bradius--noborder   bshadow--1 padding--small margin--small-top-bottom">
                    <div class="cardwrap bgcolor--gray_l bradius--noborder   bshadow--1 padding--small margin--small-top-bottom">
                      <div class="col-md-12"><span class="pull-left"><b>نص سؤال الإستشارة المطلوب إرسالها</b>
                          <div class="pull-right">
                            بتاريخ
                            {{$consultation->created_at}}
                            &nbsp;<i class="fa fa-calendar"></i>
                          </div>
                          <hr>
                          <p>{{$consultation->question}}</p></span></div>
                      <div class="clearfix"></div>
                    </div>
                    <div class="full-table">
                      <div class="remodal-bg">
                        <div class="remodal" data-remodal-id="filterModal_sponsors" role="dialog" aria-labelledby="modal1Title" aria-describedby="modal1Desc">
                          <button class="remodal-close" data-remodal-action="close" aria-label="Close"></button>
                          <div>
                            <h2 id="modal1Title">فلتر</h2>
                            <div class="col-md-6">
                              <div class="master_field">
                                <label class="master_label mandatory" for="lawyer_code">كود المحامى</label>
                                <input class="master_input" type="number" placeholder="كود المحامى" id="lawyer_code"><span class="master_message color--fadegreen">message</span>
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="master_field">
                                <label class="master_label mandatory" for="lawyer_name">اسم المحامى</label>
                                <input class="master_input" type="text" placeholder="اسم المحامى" id="lawyer_name"><span class="master_message color--fadegreen">message</span>
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="master_field">
                                <label class="master_label mandatory" for="lawyer_id">الرقم القومي</label>
                                <input class="master_input" type="number" placeholder="الرقم القومي" id="lawyer_id"><span class="master_message color--fadegreen">message</span>
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="master_field">
                                <label class="master_label mandatory" for="lawyer_nationality">الجنسية</label>
                                <input class="master_input" type="text" placeholder="الجنسية" id="lawyer_nationality"><span class="master_message color--fadegreen">message</span>
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="master_field">
                                <label class="master_label mandatory" for="lawyer_spec"> التخصص</label>
                                <select class="master_input select2" id="lawyer_spec" multiple="multiple" data-placeholder="التخصص" style="width:100%;" ,>
                                  <option>تعويضات</option>
                                  <option>تخصص اخر</option>
                                </select><span class="master_message color--fadegreen">message content</span>
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="master_field">
                                <label class="master_label mandatory" for="lawyer_degree">درجة التقاضي</label>
                                <select class="master_input select2" id="lawyer_degree" multiple="multiple" data-placeholder="درجة التقاضي" style="width:100%;" ,>
                                  <option>محامى تحت التمرين</option>
                                  <option>محامي متمرس</option>
                                </select><span class="master_message color--fadegreen">message content</span>
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="master_field">
                                <label class="master_label mandatory" for="lawyer_tel">الهاتف</label>
                                <input class="master_input" type="number" placeholder="الهاتف" id="lawyer_tel"><span class="master_message color--fadegreen">message</span>
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="master_field">
                                <label class="master_label mandatory" for="start_date">تاريخ الالتحاق</label>
                                <div class="bootstrap-timepicker">
                                  <input class="datepicker master_input" type="text" placeholder="تاريخ الالتحاق" id="start_date">
                                </div><span class="master_message color--fadegreen">message content</span>
                              </div>
                            </div>
                          </div>
                          <div class="clearfix"></div>
                          <button class="remodal-cancel" data-remodal-action="cancel">الغاء</button>
                          <button class="remodal-confirm" data-remodal-action="confirm">فلتر</button>
                        </div>
                      </div>
                      <div class="filter__btns"><a class="master-btn bgcolor--main color--white bradius--small" href="#filterModal_sponsors"><i class="fa fa-filter"></i>filters</a></div>
                      <div class="bottomActions__btns"><a class="master-btn bradius--small padding--small bgcolor--fadeblue color--white send_consultation_to_all_lawyers" href="#">إرسال الإستشارة للمحامي المحدد</a>
                      </div>
                      <table class="table-1" id="example">
                        <thead>
                          <tr class="bgcolor--gray_mm color--gray_d ">
                            <th><span class="cellcontent">&lt;input type=&quot;checkbox&quot; name=&quot;select-all&quot; id=&quot;select-all&quot; /&gt;</span></th>
                            <th><span class="cellcontent">كود المحامي</span></th>
                            <th><span class="cellcontent">الاسم</span></th>
                            <th><span class="cellcontent">الرقم القومي</span></th>
                            <th><span class="cellcontent">الجنسية</span></th>
                            <th><span class="cellcontent">التخصص</span></th>
                            <th><span class="cellcontent">درجة التقاضى</span></th>
                            <th><span class="cellcontent">عنوان</span></th>
                            <th><span class="cellcontent">هاتف</span></th>
                            <th><span class="cellcontent">تاريخ الإلتحاق</span></th>
                            <th><span class="cellcontent">تفعيل</span></th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach($lawyers as $lawyer)
                          <tr data-lawyer-id="{{$lawyer->id}}">
                            @if($lawyer->assigned)
                            <td><span class="cellcontent"><input type="checkbox" checked="yes" class="checkboxes" /></span></td>
                            @else
                            <td><span class="cellcontent"><input type="checkbox"  class="checkboxes" /></span></td>
                            @endif
                            <td><span class="cellcontent">{{$lawyer->code}}</span></td>
                            <td><span class="cellcontent">{{$lawyer->name}}</span></td>
                            <td><span class="cellcontent">{{$lawyer->user_detail->national_id}}</span></td>
                            <td><span class="cellcontent">{{$lawyer->nationality}}</span></td>
                            <td><span class="cellcontent">{{$lawyer->user_detail->work_sector}}</span></td>
                            <td><span class="cellcontent">{{$lawyer->user_detail->litigation_level}}</span></td>
                            <td><span class="cellcontent">{{$lawyer->address}}</span></td>
                            <td><span class="cellcontent">{{$lawyer->mobile}}</span></td>
                            <td><span class="cellcontent">{{$lawyer->user_detail->join_date}}</span></td>
                            @if($lawyer->is_active)
                            <td><span class="cellcontent"><i class = "fa color--fadegreen fa-check"></i></span></td>
                            @else
                            <td><span class="cellcontent"><i class = "fa color--fadegreen fa-times"></i></span></td>
                            @endif
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
              <!-- =============== PAGE VENDOR Triggers =================-->
         @endsection