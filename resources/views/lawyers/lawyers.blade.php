@extends('layout.app')
@section('content')
<script>
  $(document).ready(function(){

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
    <div class="cover-inside-container margin--small-top-bottom bradius--small bshadow--1" style="background:  url( '{{asset('img/covers/dummy2.jpg')}}' ) no-repeat center center; background-size:cover;">
      <div class="row">
        <div class="col-xs-12">
          <div class="text-xs-center">
            <div class="text-wraper">
              <h4 class="cover-inside-title color--gray_d">السادة المحامين</h4>
            </div>
          </div>
        </div>
        <div class="cover--actions"><a class="color--gray_d bordercolor--gray_d bradius--small border-btn master-btn" type="button" href="{{route('lawyers_create')}}">إضافة محامي</a><a class="color--gray_d bordercolor--gray_d bradius--small border-btn master-btn" type="button" href="lawyers_follow.html">متابعة أماكن المحامين</a>
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
                    <input name="work_sector" class="master_input" type="text" placeholder="التخصص .." id="work_sector">
                  </div>
                </div>
                <div class="col-md-4 col-sm-6 col-xs-12">
                  <div class="master_field">
                    <label class="master_label" for="lawyer_degree_in">درجة القيد بالنقابة</label>
                    <input name="syndicate_level" class="master_input" type="text" placeholder="درجة القيد بالنقابة .." id="lawyer_degree_in">
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
                      <input name="date_from" class="datepicker master_input" type="text" placeholder="تاريخ الالتحاق" id="work_from">
                    </div><span class="master_message color--fadegreen"></span>
                  </div>
                </div>
                <div class="col-md-4 col-sm-6 col-xs-12">
                  <div class="master_field">
                    <label class="master_label mandatory" for="work_to">تاريخ الالتحاق الى</label>
                    <div class="bootstrap-timepicker">
                      <input name="date_to" class="datepicker master_input" type="text" placeholder="تاريخ الالتحاق" id="work_to">
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
          <div class="bottomActions__btns"><a class="master-btn bradius--small padding--small bgcolor--fadeorange color--white" href="#">ارسال تنبية</a><a class="excel-btn master-btn bradius--small padding--small bgcolor--fadeblue color--white" href="#">استخراج اكسيل</a><a class="master-btn bradius--small padding--small bgcolor--fadebrown color--white btn-warning-cancel-all" href="#">حذف المحدد</a>
          </div>
          <table class="table-1">
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
              </tr>
            </thead>
            <tbody>
              @foreach($lawyers as $lawyer)
              <tr data-lawyer-id="{{$lawyer->id}}">
                <td><span class="cellcontent"><input type="checkbox" class="checkboxes" /></span></td>
                <td><span class="cellcontent">{{$lawyer->code}}</span></td>
                <td><span class="cellcontent">{{$lawyer->full_name}}</span></td>
                <td><span class="cellcontent">                              @foreach($lawyer->rules as $rule)
                  {{$rule->name_ar}}
                @endforeach</span></td>
                <td><span class="cellcontent">{{$lawyer->user_detail->national_id}}</span></td>
                <td><span class="cellcontent">{{$lawyer->user_detail->work_sector}}</span></td>
                <td><span class="cellcontent">{{$lawyer->user_detail->syndicate_level}}</span></td>
                <td><span class="cellcontent">{{$lawyer->address}}</span></td>
                <td><span class="cellcontent">{{$lawyer->mobile}}</span></td>
                <td><span class="cellcontent">{{$lawyer->user_detail->join_date}}</span></td>
                <td><span class="cellcontent">
                  @foreach($nationalities as $nationality)
                  @if($lawyer->user_detail->nationality->id == $nationality->item_id)
                  {{$nationality->value}}
                  @endif
                  @endforeach
                </span></td>
                <td><span class="cellcontent">@if($lawyer->is_active==1)<i class = "fa color--fadegreen fa-check"></i>@else <i class = "fa color--fadegreen fa-check"> @endif</span></td>
                  <td><span class="cellcontent"><a href= "{{route('lawyers_show',$lawyer->id)}}" ,  class= "action-btn bgcolor--main color--white "><i class = "fa  fa-eye"></i></a><a href= #lawyer_notification ,  class= "action-btn bgcolor--fadeorange color--white "><i class = "fa  fa-envelope"></i></a><a href= "{{route('lawyers_edit',$lawyer->id)}}" ,  class= "action-btn bgcolor--fadegreen color--white "><i class = "fa  fa-pencil"></i></a><a href="#"  class= "btn-warning-cancel action-btn bgcolor--fadebrown color--white "><i class = "fa  fa-trash-o"></i></a></span></td>
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
                        <input class="datepicker master_input" type="text" placeholder="تاريخ الإرسال" id="send_date">
                      </div><span class="master_message color--fadegreen">message</span>
                    </div>
                  </div>
                  <div class="col-xs-12">
                    <div class="master_field">
                      <label class="master_label">نص التنبية</label>
                      <textarea class="master_input" name="textarea" placeholder="نص التنبية"></textarea>
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


    @endsection