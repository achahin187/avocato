@extends('layout.app')
@section('content')
<script type="text/javascript">

 $(document).ready(function(){
  var test='@if(\session('tab')){{\session('tab')}}@endif';
  if(test !== ''){
    $('#f-tab,#first-tab').removeClass("active");
    $('#s-tab,#second-tab').addClass("active");
  }

  $('.btn-warning-cancel').click(function(){
    var sub_id = $(this).closest('tr').attr('data-sub-id');
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
         url:'{{url('contracts_formulas_types_destroy')}}'+'/'+sub_id,
         data:{_token:_token},
         success:function(data){
          $('tr[data-sub-id='+sub_id+']').fadeOut();
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
            return $(this).closest('tr').attr('data-sub-id');
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
               url:'{{url('contracts_formulas_types_destroy_all')}}',
               data:{ids:selectedIds,_token:_token},
               success:function(data){
                $.each( selectedIds, function( key, value ) {
                  $('tr[data-sub-id='+value+']').fadeOut();
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
              return $(this).closest('tr').attr('data-sub-id');
            }).get();
            $.ajax({
             type:'GET',
             url:'{{url('contracts_formulas_types_excel')}}',
             data:{ids:selectedIds},
             success:function(response){
              var a = document.createElement("a");
              a.href = response.file; 
              a.download = response.name+'.xlsx';
              document.body.appendChild(a);
              a.click();
              a.remove();
            }
          });
          });

});

</script>
<div class="row">
                <div class="col-lg-12">
                  <div class="cover-inside-container margin--small-top-bottom bradius--small bshadow--1" style="background:  url( '{{asset('img/covers/dummy2.jpg')}}') no-repeat center center; background-size:cover;">
                    <div class="row">
                      <div class="col-xs-12">
                        <div class="text-xs-center">
                          <div class="text-wraper">
                            <h4 class="cover-inside-title color--gray_d">البيانات الأساسية <i class="fa fa-chevron-circle-right"></i>
                              <h4 class="cover-inside-title color--gray_d">انواع الصيغ و العقود </h4>
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
                        <button class="remodal-close" data-remodal-action="close" aria-label="Close"></button>
                        <div>
                          <div class="row">
                            <div class="col-xs-12">
                              <h3>إضافة</h3>
                              <div class="tabs--wrapper">
                                <div class="clearfix"></div>
                                <ul class="tabs">
                                  <li id="f-tab">التصنيفات الرئيسية</li>
                                  <li id="s-tab">التصنيفات الفرعية</li>
                                </ul>
                                <ul class="tab__content">

                                  <li class="tab__content_item active" id="first-tab">
                                  <form role="form" action="{{route('contracts_formulas_types_store')}}" method="post">
                                  {{ csrf_field() }}
                                    <div class="col-xs-12">
                                      <div class="master_field">
                                        <label class="master_label mandatory" for="type">تصنيف الصيغة/ العقد</label>
                                        <input name="main" class="master_input" type="text" placeholder="تصنيف الصيغة / العقد" id="type"><span class="master_message color--fadegreen">               
                                    @if ($errors->has('main'))
                                    {{ $errors->first('main')}}
                                    @endif</span>
                                      </div>
                                    </div>
                                    <div class="clearfix"></div><br>
                                    <div class="text-center">
                                      <button class="remodal-cancel" data-remodal-action="cancel">إلغاء</button>
                                      <button class="remodal-confirm" type="submit">حفظ</button>
                                    </div>
                                  </form>
                                  </li>


                                  <li class="tab__content_item" id="second-tab">
                                  <form role="form" action="{{route('contracts_formulas_types_store_sub')}}" method="post">
                                    {{ csrf_field() }}
                                    <div class="col-lg-12">
                                      <div class="master_field">
                                        <label class="master_label mandatory" for="main_type">التصنيف الرئيسي للصيغة / العقد</label>
                                        <select name="mains" class="master_input select2" id="main_type" style="width:100%;">
                                          <option value="choose" selected disabled>اختر تصنيف رئيسي</option>
                                          @foreach($main_contracts as $main_contract)
                                          <option value="{{$main_contract->id}}">{{$main_contract->name}}</option>
                                          @endforeach
                                        </select><span class="master_message color--fadegreen">
                                    @if ($errors->has('mains'))
                                    {{ $errors->first('mains')}}
                                    @endif</span>
                                      </div>
                                    </div>
                                    <div class="col-xs-12">
                                      <div class="master_field">
                                        <label class="master_label mandatory" for="type_main">التصنيف الفرعي للصيغة / العقد</label>
                                        <input name="sub" class="master_input" type="text" placeholder="نوع الصيغة / العقد" id="type_main"><span class="master_message color--fadegreen"> 
                                    @if ($errors->has('sub'))
                                    {{ $errors->first('sub')}}
                                    @endif</span>
                                      </div>
                                    </div>
                                    <div class="col-md-3 col-sm-6 col-xs-12">
                                      <button name="action" value="more" class="master-btn undefined btn-inlineblock color--white bgcolor--fadepurple bradius--small bshadow--0" type="submit"><span>حفظ واضافة المزيد</span>
                                      </button>
                                          @if(\session('success_more'))
                                          <div class="alert alert-success">
                                          {{\session('success_more')}}
                                          </div>
                                          @endif
                                    </div>
                                    <div class="clearfix"></div><br>
                                    <div class="text-center">
                                      <button class="remodal-cancel" data-remodal-action="cancel">إلغاء</button>
                                      <button name="action" value="one" class="sotre-sub remodal-confirm" type="submit">حفظ</button>
                                    </div>
                                </form>
                                  </li>
                                  <div class="clearfix"></div>
                                </ul>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="full-table">
                      <div class="bottomActions__btns"><a class="excel-btn master-btn bradius--small padding--small bgcolor--fadeblue color--white" href="#">استخراج اكسيل</a><a class="master-btn bradius--small padding--small bgcolor--fadebrown color--white btn-warning-cancel-all" href="#">حذف المحدد</a>
                      </div>
                      <table class="table-1">
                        <thead>
                          <tr class="bgcolor--gray_mm color--gray_d">
                            <th><span class="cellcontent">&lt;input type=&quot;checkbox&quot; name=&quot;select-all&quot; id=&quot;select-all&quot; /&gt;</span></th>
                            <th><span class="cellcontent">التصنيف الرئيسي</span></th>
                            <th><span class="cellcontent"> التصنيف الفرعي</span></th>
                            <th><span class="cellcontent">الإجراءات</span></th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach($subs as $sub)
                          <tr data-sub-id="{{$sub->id}}">
                            <td><span class="cellcontent"><input type="checkbox" class="checkboxes" /></span></td>
                            <td><span class="cellcontent">{{$sub->parent->name}}</span></td>
                            <td><span class="cellcontent">{{$sub->name}}</span></td>
                            <td><span class="cellcontent"><a href="#"  class= "btn-warning-cancel action-btn bgcolor--fadebrown color--white "><i class = "fa  fa-trash-o"></i></a></span></td>
                          </tr>
                          @endforeach
<!--                           <tr>
                            <td><span class="cellcontent"><input type="checkbox" class="checkboxes" /></span></td>
                            <td><span class="cellcontent">اسم التصنيف</span></td>
                            <td><span class="cellcontent"> اسم التصنيف</span></td>
                            <td><span class="cellcontent"><a href="#"  class= "btn-warning-cancel action-btn bgcolor--fadebrown color--white "><i class = "fa  fa-trash-o"></i></a></span></td>
                          </tr>
                          <tr>
                            <td><span class="cellcontent"><input type="checkbox" class="checkboxes" /></span></td>
                            <td><span class="cellcontent">اسم التصنيف</span></td>
                            <td><span class="cellcontent"> اسم التصنيف</span></td>
                            <td><span class="cellcontent"><a href="#"  class= "btn-warning-cancel action-btn bgcolor--fadebrown color--white "><i class = "fa  fa-trash-o"></i></a></span></td>
                          </tr>
                          <tr>
                            <td><span class="cellcontent"><input type="checkbox" class="checkboxes" /></span></td>
                            <td><span class="cellcontent">اسم التصنيف</span></td>
                            <td><span class="cellcontent"> اسم التصنيف</span></td>
                            <td><span class="cellcontent"><a href="#"  class= "btn-warning-cancel action-btn bgcolor--fadebrown color--white "><i class = "fa  fa-trash-o"></i></a></span></td>
                          </tr>
                          <tr>
                            <td><span class="cellcontent"><input type="checkbox" class="checkboxes" /></span></td>
                            <td><span class="cellcontent">اسم التصنيف</span></td>
                            <td><span class="cellcontent"> اسم التصنيف</span></td>
                            <td><span class="cellcontent"><a href="#"  class= "btn-warning-cancel action-btn bgcolor--fadebrown color--white "><i class = "fa  fa-trash-o"></i></a></span></td>
                          </tr>
                          <tr>
                            <td><span class="cellcontent"><input type="checkbox" class="checkboxes" /></span></td>
                            <td><span class="cellcontent">اسم التصنيف</span></td>
                            <td><span class="cellcontent"> اسم التصنيف</span></td>
                            <td><span class="cellcontent"><a href="#"  class= "btn-warning-cancel action-btn bgcolor--fadebrown color--white "><i class = "fa  fa-trash-o"></i></a></span></td>
                          </tr>
                          <tr>
                            <td><span class="cellcontent"><input type="checkbox" class="checkboxes" /></span></td>
                            <td><span class="cellcontent">اسم التصنيف</span></td>
                            <td><span class="cellcontent"> اسم التصنيف</span></td>
                            <td><span class="cellcontent"><a href="#"  class= "btn-warning-cancel action-btn bgcolor--fadebrown color--white "><i class = "fa  fa-trash-o"></i></a></span></td>
                          </tr>
                          <tr>
                            <td><span class="cellcontent"><input type="checkbox" class="checkboxes" /></span></td>
                            <td><span class="cellcontent">اسم التصنيف</span></td>
                            <td><span class="cellcontent"> اسم التصنيف</span></td>
                            <td><span class="cellcontent"><a href="#"  class= "btn-warning-cancel action-btn bgcolor--fadebrown color--white "><i class = "fa  fa-trash-o"></i></a></span></td>
                          </tr>
                          <tr>
                            <td><span class="cellcontent"><input type="checkbox" class="checkboxes" /></span></td>
                            <td><span class="cellcontent">اسم التصنيف</span></td>
                            <td><span class="cellcontent"> اسم التصنيف</span></td>
                            <td><span class="cellcontent"><a href="#"  class= "btn-warning-cancel action-btn bgcolor--fadebrown color--white "><i class = "fa  fa-trash-o"></i></a></span></td>
                          </tr>
                          <tr>
                            <td><span class="cellcontent"><input type="checkbox" class="checkboxes" /></span></td>
                            <td><span class="cellcontent">اسم التصنيف</span></td>
                            <td><span class="cellcontent"> اسم التصنيف</span></td>
                            <td><span class="cellcontent"><a href="#"  class= "btn-warning-cancel action-btn bgcolor--fadebrown color--white "><i class = "fa  fa-trash-o"></i></a></span></td>
                          </tr>
                          <tr>
                            <td><span class="cellcontent"><input type="checkbox" class="checkboxes" /></span></td>
                            <td><span class="cellcontent">اسم التصنيف</span></td>
                            <td><span class="cellcontent"> اسم التصنيف</span></td>
                            <td><span class="cellcontent"><a href="#"  class= "btn-warning-cancel action-btn bgcolor--fadebrown color--white "><i class = "fa  fa-trash-o"></i></a></span></td>
                          </tr>
                          <tr>
                            <td><span class="cellcontent"><input type="checkbox" class="checkboxes" /></span></td>
                            <td><span class="cellcontent">اسم التصنيف</span></td>
                            <td><span class="cellcontent"> اسم التصنيف</span></td>
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