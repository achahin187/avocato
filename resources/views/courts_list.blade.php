@extends('layout.app')
@section('content')

<script>
  $(document).ready(function(){


$("select[name='govs']").change(function () {
var gov_id = $("select[name='govs']").val();
if (gov_id !== '' && gov_id !== null) {
$("select[name='cities']").prop('disabled',
false).find('option[value]').remove();
$.ajax({
type: 'GET',
url: '{{url('courts_get_city')}}', // do not forget to register your route
data: {id: gov_id },
}).done(function (data) {
$.each(data, function (key, value) {
$("select[name='cities']")
.append($("<option></option>")
.attr("value", key)
.text(value));
});
}).fail(function(jqXHR, textStatus){
console.log(jqXHR);
});
} else {
$("select[name='cities']").prop('disabled',
true).find("option[value]").remove();
}
});

        $('.btn-warning-cancel').click(function(){
          var court_id = $(this).closest('tr').attr('data-court-id');
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
               url:'{{url('courts_list_destroy')}}'+'/'+court_id,
               data:{_token:_token},
               success:function(data){
                $('tr[data-court-id='+court_id+']').fadeOut();
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
            return $(this).closest('tr').attr('data-court-id');
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
               url:'{{url('courts_list_destroy_all')}}',
               data:{ids:selectedIds,_token:_token},
               success:function(data){
                $.each( selectedIds, function( key, value ) {
                  $('tr[data-court-id='+value+']').fadeOut();
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
          var selectedIds = $("input:checkbox:checked").map(function(){
            return $(this).closest('tr').attr('data-court-id');
          }).get();
          $.ajax({
           type:'GET',
           url:'{{url('courts_list_excel')}}',
           data:{ids:selectedIds},
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
                  <div class="cover-inside-container margin--small-top-bottom bradius--small bshadow--1" style="background:  url( '{{asset('img/covers/dummy2.jpg')}} ' ) no-repeat center center; background-size:cover;">
                    <div class="row">
                      <div class="col-xs-12">
                        <div class="text-xs-center">
                          <div class="text-wraper">
                            <h4 class="cover-inside-title color--gray_d">البيانات الأساسية <i class="fa fa-chevron-circle-right"></i>
                              <h4 class="cover-inside-title color--gray_d">اسماء المحاكم </h4>
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
                  <div class="cardwrap bgcolor--white bradius--noborder   bshadow--1 padding--small margin--small-top-bottom">
                    <div class="col-md-2 col-sm-3 colxs-12 pull-right"><a class="master-btn color--white bgcolor--main bradius--small bshadow--0 btn-block" href="#popupModal_1"><i class="fa fa-plus"></i><span>إضافة</span></a>
                      <div class="remodal-bg"></div>
                      <div class="remodal" data-remodal-id="popupModal_1" role="dialog" aria-labelledby="modal1Title" aria-describedby="modal1Desc">
                     <form role="form" action="{{route('courts_list_store')}}" method="post">
                      {{ csrf_field() }}
                        <button class="remodal-close" data-remodal-action="close" aria-label="Close"></button>
                        <div>
                          <div class="row">
                            <div class="col-xs-12">
                              <h3>إضافة</h3>
                              <div class="col-xs-12">
                                <div class="master_field">
                                  <label class="master_label" for="ID_No">اسم المحكمة</label>
                                  <input name="court" value="{{ old('court') }}" class="master_input" type="text" placeholder="اسم المحكمة" id="ID_No"><span class="master_message color--fadegreen">
                                    @if ($errors->has('court'))
                                    {{ $errors->first('court')}}
                                    @endif

                                  </span>
                                </div>
                              </div>
                              <div class="col-xs-6">
                                <div class="master_field">
                                  <label class="master_label mandatory" for="gover2">اسم المحافطة </label>
                                  <select name="govs" class="master_input select2" id="gover2" data-placeholder="اختر المحافظة" style="width:100%;" ,>
                                    <option value="choose" selected disabled>اختر المحافظه</option>
                                  @foreach($govs as $gov)
                                    <option value="{{$gov->id}}">{{$gov->name}}</option>
                                    @endforeach
                                  </select><span class="master_message color--fadegreen">
                                    @if ($errors->has('govs'))
                                    {{ $errors->first('govs')}}
                                    @endif
                                  </span>
                                </div>
                              </div>
                              <div class="col-xs-6">
                                <div class="master_field">
                                  <label class="master_label mandatory" for="city2">اسم المدينة </label>
                                  <select name="cities" class="master_input select2" id="city2" data-placeholder="اختر المدينة" style="width:100%;" ,>
                                  </select><span class="master_message color--fadegreen">
                                    @if ($errors->has('cities'))
                                    {{ $errors->first('cities')}}
                                    @endif
                                  </span>
                                </div>
                              </div>
                              <div class="clearfix"></div>
                            </div>
                          </div>
                        </div><br>
                        <button class="remodal-cancel" data-remodal-action="cancel">إلغاء</button>
                        <button class="remodal-confirm" type="submit">حفظ</button>
                            </form>
                      </div>
                    </div>
                    <div class="full-table">
                      <div class="remodal-bg">
                        <div class="remodal" data-remodal-id="filterModal_sponsors" role="dialog" aria-labelledby="modal1Title" aria-describedby="modal1Desc">
                          <button class="remodal-close" data-remodal-action="close" aria-label="Close"></button>
                          <div>
                            <h2 id="modal1Title">فلتر</h2>
                            <div class="col-md-6">
                              <div class="master_field">
                                <label class="master_label mandatory" for="court_name">الاسم</label>
                                <input class="master_input" type="text" placeholder="الاسم" id="court_name"><span class="master_message color--fadegreen">message</span>
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="master_field">
                                <label class="master_label mandatory" for="city">المدينة</label>
                                <select class="master_input select2" id="city" multiple="multiple" data-placeholder="المدينة" style="width:100%;" ,>
                                  <option>مدينة 1</option>
                                  <option>مدينة 2</option>
                                </select><span class="master_message color--fadegreen">message content</span>
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="master_field">
                                <label class="master_label mandatory" for="gover"> المحافظة </label>
                                <select class="master_input select2" id="gover" multiple="multiple" data-placeholder="المحافظة" style="width:100%;" ,>
                                  <option>القاهرة</option>
                                  <option>الجيزة</option>
                                </select><span class="master_message color--fadegreen">message content</span>
                              </div>
                            </div>
                          </div>
                          <div class="clearfix"></div>
                          <button class="remodal-cancel" data-remodal-action="cancel">الغاء</button>
                          <button class="remodal-confirm" data-remodal-action="confirm">فلتر</button>
                        </div>
                      </div>
                      <div class="bottomActions__btns"><a class="excel-btn master-btn bradius--small padding--small bgcolor--fadeblue color--white" href="#">استخراج اكسيل</a><a class="master-btn bradius--small padding--small bgcolor--fadebrown color--white btn-warning-cancel-all" href="#">حذف المحدد</a>
                      </div>
                      <table class="table-1" id="dataTableTriggerId_001">
                        <thead>
                          <tr class="bgcolor--gray_mm color--gray_d">
                            <th><span class="cellcontent">&lt;input type=&quot;checkbox&quot; name=&quot;select-all&quot; id=&quot;select-all&quot; /&gt;</span></th>
                            <th><span class="cellcontent">الاسم</span></th>
                            <th><span class="cellcontent">المدينة</span></th>
                            <th><span class="cellcontent">المحافظة</span></th>
                            <th><span class="cellcontent">الاجراءات</span></th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach($courts as $court)
                          <tr class="court" data-court-id="{{$court->id}}">
                            <td><span class="cellcontent"><input type="checkbox" class="checkboxes input-in-table" /></span></td>
                            <td><span class="cellcontent">{{$court->name}}</span></td>
                            <td><span class="cellcontent">@isset($court->city->name){{$court->city->name}}@endisset</span></td>
                            <td><span class="cellcontent">@isset($court->city->governorate->name){{$court->city->governorate->name}}@endisset</span></td>
                            <td><span class="cellcontent"><a href="#"  class= "btn-warning-cancel action-btn bgcolor--fadebrown color--white "><i class = "fa  fa-trash-o"></i></a></span></td>
                          </tr>
                          @endforeach
<!--                           <tr>
                            <td><span class="cellcontent"><input type="checkbox" class="checkboxes" /></span></td>
                            <td><span class="cellcontent">اسم المحكمة</span></td>
                            <td><span class="cellcontent">اسم المدينة</span></td>
                            <td><span class="cellcontent">اسم المحافظة</span></td>
                            <td><span class="cellcontent"><a href="#"  class= "btn-warning-cancel action-btn bgcolor--fadebrown color--white "><i class = "fa  fa-trash-o"></i></a></span></td>
                          </tr>
                          <tr>
                            <td><span class="cellcontent"><input type="checkbox" class="checkboxes" /></span></td>
                            <td><span class="cellcontent">اسم المحكمة</span></td>
                            <td><span class="cellcontent">اسم المدينة</span></td>
                            <td><span class="cellcontent">اسم المحافظة</span></td>
                            <td><span class="cellcontent"><a href="#"  class= "btn-warning-cancel action-btn bgcolor--fadebrown color--white "><i class = "fa  fa-trash-o"></i></a></span></td>
                          </tr>
                          <tr>
                            <td><span class="cellcontent"><input type="checkbox" class="checkboxes" /></span></td>
                            <td><span class="cellcontent">اسم المحكمة</span></td>
                            <td><span class="cellcontent">اسم المدينة</span></td>
                            <td><span class="cellcontent">اسم المحافظة</span></td>
                            <td><span class="cellcontent"><a href="#"  class= "btn-warning-cancel action-btn bgcolor--fadebrown color--white "><i class = "fa  fa-trash-o"></i></a></span></td>
                          </tr>
                          <tr>
                            <td><span class="cellcontent"><input type="checkbox" class="checkboxes" /></span></td>
                            <td><span class="cellcontent">اسم المحكمة</span></td>
                            <td><span class="cellcontent">اسم المدينة</span></td>
                            <td><span class="cellcontent">اسم المحافظة</span></td>
                            <td><span class="cellcontent"><a href="#"  class= "btn-warning-cancel action-btn bgcolor--fadebrown color--white "><i class = "fa  fa-trash-o"></i></a></span></td>
                          </tr>
                          <tr>
                            <td><span class="cellcontent"><input type="checkbox" class="checkboxes" /></span></td>
                            <td><span class="cellcontent">اسم المحكمة</span></td>
                            <td><span class="cellcontent">اسم المدينة</span></td>
                            <td><span class="cellcontent">اسم المحافظة</span></td>
                            <td><span class="cellcontent"><a href="#"  class= "btn-warning-cancel action-btn bgcolor--fadebrown color--white "><i class = "fa  fa-trash-o"></i></a></span></td>
                          </tr>
                          <tr>
                            <td><span class="cellcontent"><input type="checkbox" class="checkboxes" /></span></td>
                            <td><span class="cellcontent">اسم المحكمة</span></td>
                            <td><span class="cellcontent">اسم المدينة</span></td>
                            <td><span class="cellcontent">اسم المحافظة</span></td>
                            <td><span class="cellcontent"><a href="#"  class= "btn-warning-cancel action-btn bgcolor--fadebrown color--white "><i class = "fa  fa-trash-o"></i></a></span></td>
                          </tr>
                          <tr>
                            <td><span class="cellcontent"><input type="checkbox" class="checkboxes" /></span></td>
                            <td><span class="cellcontent">اسم المحكمة</span></td>
                            <td><span class="cellcontent">اسم المدينة</span></td>
                            <td><span class="cellcontent">اسم المحافظة</span></td>
                            <td><span class="cellcontent"><a href="#"  class= "btn-warning-cancel action-btn bgcolor--fadebrown color--white "><i class = "fa  fa-trash-o"></i></a></span></td>
                          </tr>
                          <tr>
                            <td><span class="cellcontent"><input type="checkbox" class="checkboxes" /></span></td>
                            <td><span class="cellcontent">اسم المحكمة</span></td>
                            <td><span class="cellcontent">اسم المدينة</span></td>
                            <td><span class="cellcontent">اسم المحافظة</span></td>
                            <td><span class="cellcontent"><a href="#"  class= "btn-warning-cancel action-btn bgcolor--fadebrown color--white "><i class = "fa  fa-trash-o"></i></a></span></td>
                          </tr>
                          <tr>
                            <td><span class="cellcontent"><input type="checkbox" class="checkboxes" /></span></td>
                            <td><span class="cellcontent">اسم المحكمة</span></td>
                            <td><span class="cellcontent">اسم المدينة</span></td>
                            <td><span class="cellcontent">اسم المحافظة</span></td>
                            <td><span class="cellcontent"><a href="#"  class= "btn-warning-cancel action-btn bgcolor--fadebrown color--white "><i class = "fa  fa-trash-o"></i></a></span></td>
                          </tr>
                          <tr>
                            <td><span class="cellcontent"><input type="checkbox" class="checkboxes" /></span></td>
                            <td><span class="cellcontent">اسم المحكمة</span></td>
                            <td><span class="cellcontent">اسم المدينة</span></td>
                            <td><span class="cellcontent">اسم المحافظة</span></td>
                            <td><span class="cellcontent"><a href="#"  class= "btn-warning-cancel action-btn bgcolor--fadebrown color--white "><i class = "fa  fa-trash-o"></i></a></span></td>
                          </tr>
                          <tr>
                            <td><span class="cellcontent"><input type="checkbox" class="checkboxes" /></span></td>
                            <td><span class="cellcontent">اسم المحكمة</span></td>
                            <td><span class="cellcontent">اسم المدينة</span></td>
                            <td><span class="cellcontent">اسم المحافظة</span></td>
                            <td><span class="cellcontent"><a href="#"  class= "btn-warning-cancel action-btn bgcolor--fadebrown color--white "><i class = "fa  fa-trash-o"></i></a></span></td>
                          </tr> -->
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
                    <div class="clearfix"></div>
                  </div>
                </div>
              </div>
@endsection