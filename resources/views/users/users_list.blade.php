 @extends('layout.app')             
 @section('content')
 <script>
  $(document).ready(function(){

    $('.btn-warning-cancel').click(function(){
      var user_id = $(this).closest('tr').attr('data-user-id');
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
           url:'{{url('users_list_destroy_post')}}'+'/'+user_id,
           data:{_token:_token},
           success:function(data){
            $('tr[data-user-id='+user_id+']').fadeOut();
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
        return $(this).closest('tr').attr('data-user-id');
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
           url:'{{route('users_list_destroy_all')}}',
           data:{ids:selectedIds,_token:_token},
           success:function(data){
            $.each( selectedIds, function( key, value ) {
              $('tr[data-user-id='+value+']').fadeOut();
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
      return $(this).closest('tr').attr('data-user-id');
    }).get();
     $.ajax({
       type:'GET',
       url:'{{route('users_list_excel')}}',
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
              <h4 class="cover-inside-title color--gray_d">المستخدمين</h4>
            </div>
          </div>
        </div>
        <div class="cover--actions"><a class="color--gray_d bordercolor--gray_d bradius--small border-btn master-btn" type="button" href="{{route('users_list_create')}}">اضافة مستخدم </a>
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
        <div class="filter__btns"><a class="master-btn bgcolor--main color--white bradius--small" href="#filterModal_client_list"><i class="fa fa-filter"></i>filters</a></div>
        <div class="bottomActions__btns"><a class="excel-btn master-btn bradius--small padding--small bgcolor--fadeblue color--white " href="#">استخراج اكسيل</a><a class="master-btn bradius--small padding--small bgcolor--fadebrown color--white btn-warning-cancel-all" href="#">حذف المحدد</a>
        </div>
        <div class="remodal" data-remodal-id="filterModal_client_list" role="dialog" aria-labelledby="modal1Title" aria-describedby="modal1Desc">
      <form role="form" action="{{route('users_list_filter')}}" method="post" accept-charset="utf-8">
          {{csrf_field()}}
          <button class="remodal-close" data-remodal-action="close" aria-label="Close"></button>
          <div>
            <h3 id="modal1Title">فلتر</h3>
            <div class="row">
              <div class="col-xs-6">
                <div class="master_field">
                  <label class="master_label" for="type">نوع العضوية</label>
                  <select name="roles[]" class="master_input select2" id="type" multiple="multiple" data-placeholder="نوع العضوية" style="width:100%;" ,>
                    @foreach($roles as $role)
                    @if($role->id!=1)
                    <option value="{{$role->name}}" >{{$role->name_ar}}</option>
                    @endif
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="col-md-6">
                <div class="master_field">
                  <label class="master_label mandatory">التفعيل</label>
                  <div class="radiorobo">
                    <input name="active" value="2" type="radio" id="rad_1" checked>
                    <label for="rad_1">الكل</label>
                  </div>
                  <div class="radiorobo">
                    <input name="active" value="1" type="radio" id="rad_2">
                    <label for="rad_2">المفعلين</label>
                  </div>
                  <div class="radiorobo">
                    <input name="active" value="0" type="radio" id="rad_3">
                    <label for="rad_3">غير المفعلين</label>
                  </div>
                </div>
              </div>
              <div class="col-xs-12">
                <label class="master_label mandatory">فترة تاريخ اخر مشاركة</label>
              </div>
              <div class="col-xs-6">
                <div class="master_field">
                  <label class="master_label" for="last_activity-filter_from">من</label>
                  <input name="date_from" class="datepicker master_input" type="text" placeholder="تاريخ اخر مشاركة" id="last_activity-filter_from">
                </div>
              </div>
              <div class="col-xs-6">
                <div class="master_field">
                  <label class="master_label" for="last_activity-filter_to">الى</label>
                  <input name="date_to" class="datepicker master_input" type="text" placeholder="تاريخ اخر مشاركة" id="last_activity-filter_to">
                </div>
              </div>
            </div>
          </div><br>
          <button class="remodal-cancel" data-remodal-action="cancel">إلغاء</button>
          <button class="remodal-confirm"  type="submit">تطبيق الفلاتر</button>
        </form>
        </div>
        <table class="table-1" id="dataTableTriggerId_001">
          <thead>
            <tr class="bgcolor--gray_mm color--gray_d">
              <th><span class="cellcontent">&lt;input type=&quot;checkbox&quot; name=&quot;select-all&quot; id=&quot;select-all&quot; /&gt;</span></th>
              <th><span class="cellcontent">م</span></th>
              <th><span class="cellcontent">اسم الموظف</span></th>
              <th><span class="cellcontent">البريد الالكترونى</span></th>
              <th><span class="cellcontent">نوع العضوية</span></th>
              <th><span class="cellcontent">هاتف</span></th>
              <th><span class="cellcontent">فعال</span></th>
              <th><span class="cellcontent">تاريخ التسجيل</span></th>
              <th><span class="cellcontent">اخر مشاركة</span></th>
              <th><span class="cellcontent">الإجراءات</span></th>
            </tr>
          </thead>
          <tbody>
            @foreach($users as $user)
            <tr data-user-id="{{$user->id}}">
              <td><span class="cellcontent"><input type="checkbox" class=" input-in-table " /></span></td>
              <td><span class="cellcontent">{{$user->id}}</span></td>
              <td><span class="cellcontent">{{$user->name}}</span></td>
              <td><span class="cellcontent">{{$user->email}}</span></td>
              <td><span class="cellcontent">
                @foreach($user->rules as $rule)
                @if($rule->id!=13)
                {{$rule->name_ar}}
                @endif
                @endforeach
              </span></td>
              <td><span class="cellcontent">{{$user->phone}}</span></td>
              <td><span class="cellcontent">@if($user->is_active==1)<i class = "fa color--fadegreen fa-check"></i>@else <i class = "fa color--fadebrown fa-times"> @endif</span></td>
                <td><span class="cellcontent">{{$user->created_at}}</span></td>
                <td><span class="cellcontent">{{$user->last_login}}</span></td>
                <td><span class="cellcontent"><a href= "{{route('user_profile',$user->id)}}" ,  class= "action-btn bgcolor--main color--white "><i class = "fa  fa-eye"></i></a><a href= "{{route('users_list_edit',$user->id)}}" ,  class= "action-btn bgcolor--fadegreen color--white "><i class = "fa  fa-pencil"></i></a><a href="#"  class= "btn-warning-confirm btn-warning-cancel action-btn bgcolor--fadebrown color--white "><i class = "fa  fa-trash-o"></i></a></span></td>
              </tr>
              @endforeach
            </tbody>
          </table>
          <div class="remodal log-custom" data-remodal-id="log_link" role="dialog" aria-labelledby="modal1Title" aria-describedby="modal1Desc">
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


  @endsection