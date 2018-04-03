@extends('layout.app')
@section('content')

<div class="row">
  <div class="col-lg-12">
    <div class="cover-inside-container margin--small-top-bottom bradius--small bshadow--1" style="background:  url( '{{asset('img/covers/dummy2.jpg')}}' ) no-repeat center center; background-size:cover;">
      <div class="row">
        <div class="col-xs-12">
          <div class="text-xs-center">
            <div class="text-wraper">
              <h4 class="cover-inside-title color--gray_d">العملاء <i class="fa fa-chevron-circle-right"></i>
                <h4 class="cover-inside-title color--gray_d">محتوى </h4>
              </h4>
            </div>
          </div>
        </div>
        <div class="cover--actions"><a class="color--gray_d bordercolor--gray_d bradius--small border-btn master-btn" type="button" href="{{route('ind.create')}}">اضافة عميل أفراد جديد </a>
        </div>
      </div>
    </div>
  </div>

{{-- Start alert messages --}}
    <div class="col-lg-12">
      @if (Session::has('success'))
        <div class="alert alert-success text-center">{{ Session::get('success') }}</div>
      @endif
    </div>
    {{-- End alert --}}

  <div class="col-lg-12">
    <div class="cardwrap bgcolor--white bradius--noborder   bshadow--1 padding--small margin--small-top-bottom">
      <div class="clearfix"></div>
      <div class="full-table">
        <div class="remodal-bg">
          <div class="remodal" data-remodal-id="filterModal_sponsors" role="dialog" aria-labelledby="modal1Title" aria-describedby="modal1Desc">
            <button class="remodal-close" data-remodal-action="close" aria-label="Close"></button>
            <div>
              <h3 id="modal1Title">فلتر</h3>
              <div class="col-md-6">
                <div class="master_field">
                  <label class="master_label mandatory" for="license_type"> نوع الباقة </label>
                  <select class="master_input select2" id="license_type" multiple="multiple" data-placeholder="نوع الباقة" style="width:100%;" ,>
                    <option>ذهبى</option>
                    <option>برونزي</option>
                  </select><span class="master_message color--fadegreen">message content</span>
                </div>
              </div>
              <div class="col-md-6">
                <div class="master_field">
                  <label class="master_label mandatory" for="license_start_from">تاريخ بداية النعاقد من</label>
                  <div class="bootstrap-timepicker">
                    <input class="datepicker master_input" type="text" placeholder="تاريخ بداية النعاقد" id="license_start_from">
                  </div><span class="master_message color--fadegreen">message content</span>
                </div>
              </div>
              <div class="col-md-6">
                <div class="master_field">
                  <label class="master_label mandatory" for="license_start_to">تاريخ بداية النعاقد الى</label>
                  <div class="bootstrap-timepicker">
                    <input class="datepicker master_input" type="text" placeholder="تاريخ بداية النعاقد" id="license_start_to">
                  </div><span class="master_message color--fadegreen">message content</span>
                </div>
              </div>
              <div class="col-md-6">
                <div class="master_field">
                  <label class="master_label mandatory" for="license_end_from">تاريخ نهاية التعاقد</label>
                  <div class="bootstrap-timepicker">
                    <input class="datepicker master_input" type="text" placeholder="تاريخ نهاية التعاقد" id="license_end_from">
                  </div><span class="master_message color--fadegreen">message content</span>
                </div>
              </div>
              <div class="col-md-6">
                <div class="master_field">
                  <label class="master_label mandatory" for="license_end_to">تاريخ نهاية التعاقد الى</label>
                  <div class="bootstrap-timepicker">
                    <input class="datepicker master_input" type="text" placeholder="تاريخ نهاية التعاقد" id="license_end_to">
                  </div><span class="master_message color--fadegreen">message content</span>
                </div>
              </div>
              <div class="col-md-6">
                <div class="master_field">
                  <label class="master_label mandatory" for="nationality">الجنسية</label>
                  <input class="master_input" type="text" placeholder="الجنسية" id="nationality"><span class="master_message color--fadegreen">message</span>
                </div>
              </div>
              <div class="col-md-6">
                <div class="master_field">
                  <label class="master_label mandatory">التفعيل</label>
                  <div class="radiorobo">
                    <input type="radio" id="rad_1">
                    <label for="rad_1">الكل</label>
                  </div>
                  <div class="radiorobo">
                    <input type="radio" id="rad_2">
                    <label for="rad_2">المفعلين</label>
                  </div>
                  <div class="radiorobo">
                    <input type="radio" id="rad_3">
                    <label for="rad_3">غير المفعلين</label>
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
        <div class="bottomActions__btns">
          <a id="deleteSelected" class="master-btn bradius--small padding--small bgcolor--fadeorange color--white" href="#">حذف المحدد</a>
          <a class="master-btn bradius--small padding--small bgcolor--fadepurple color--white" href="#">طباعة</a>
          <a id="exportSelected" class="master-btn bradius--small padding--small bgcolor--fadeblue color--white" href="#">استخراج اكسيل</a>
          <a class="master-btn bradius--small padding--small bgcolor--fadegreen color--white" href="#">استخراج pdf</a>
        </div>
        
        <table class="table-1">
          <thead>
            <tr class="bgcolor--gray_mm color--gray_d">
              <th><span class="cellcontent">&lt;input type=&quot;checkbox&quot; name=&quot;select-all&quot; id=&quot;select-all&quot; /&gt;</span></th>
              <th><span class="cellcontent">كودالعميل</span></th>
              <th><span class="cellcontent">اسم العميل</span></th>
              <th><span class="cellcontent">عنوان العميل</span></th>
              <th><span class="cellcontent">هاتف</span></th>
              <th><span class="cellcontent">نوع الباقة</span></th>
              <th><span class="cellcontent">بداية التعاقد</span></th>
              <th><span class="cellcontent">نهاية التعاقد</span></th>
              <th><span class="cellcontent">تفعيل</span></th>
              <th><span class="cellcontent">الإجراءات</span></th>
            </tr>
          </thead>
          <tbody>
            
            @foreach ($users as $user)
              <tr data-user="{{ $user->id }}">
                <td><span class="cellcontent"><input type="checkbox" class="checkboxes" data-id="{{ $user->id }}" /></span></td>
                
                {{-- Code --}}
                @if ( $user->code )
                  <td><span class="cellcontent">{{ $user->code }}</span></td>
                @else
                    لا يوجد
                @endif
                
                {{-- Full Name --}}
                @if ( $user->full_name )
                  <td><span class="cellcontent">{{ $user->full_name }}</span></td>
                @else 
                  لا يوجد
                @endif

                {{-- Address --}}
                @if ( $user->address )
                  <td><span class="cellcontent">{{ $user->address }}</span></td>
                @else
                  لا يوجد
                @endif

                {{-- Mobile --}}
                @if ( $user->mobile )
                  <td><span class="cellcontent">{{ $user->mobile }}</span></td>
                @else
                    لا يوجد
                @endif
                <td>
                  <span class="cellcontent">
                    @if (isset($user->subscription->package_type->name))
                      {{ Helper::localizations('package_types', 'name', $user->subscription->package_type->id) }}
                    @else
                      لا يوجد
                    @endif
                  </span>
                </td>
                <td>
                  <span class="cellcontent">
                    @if (isset($user->subscription->start_date))
                      {{ $user->subscription->start_date->format('d - m - Y') }}
                    @else
                      لا يوجد
                    @endif
                  </span>
                </td>
                <td>
                  <span class="cellcontent">
                    @if (isset($user->subscription->end_date))
                      {{ $user->subscription->end_date->format('d - m - Y') }}
                    @else
                      لا يوجد
                    @endif
                  </span>
                </td>
                <td><span class="cellcontent"><i class = "fa color--fadegreen {{ $user->is_active ? ' fa-check' : 'fa-times'}}"></i></span></td>
                <td>
                  <span class="cellcontent">

                    {{--  Show  --}}
                    <a href= "{{route('ind.show',$user->id)}}" ,  class= "action-btn bgcolor--main color--white ">
                      <i class = "fa  fa-eye"></i>
                    </a>

                    {{--  Edit  --}}
                    <a href= "{{route('ind.edit', ['id' => $user->id])}}" ,  class= "action-btn bgcolor--fadegreen color--white ">
                      <i class = "fa  fa-pencil"></i>
                    </a>

                    {{--  Delete  --}}
                    <a href="#" class="btn-warning-cancel action-btn bgcolor--fadebrown color--white deleteRecord" data-id="{{ $user->id }}">
                      <i class="fa fa-trash-o"></i>
                    </a>

                  </span>
                </td>
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
      <div class="clearfix"></div>
    </div>
  </div>
</div>
        
  <script>

    $(document).ready(function() {
      // Delete selected checkboxes
        $('#deleteSelected').click(function(){
          var allVals = [];                   // selected IDs
          var token = '{{ csrf_token() }}';

          // push cities IDs selected by user
          $('.checkboxes:checked').each(function() {
            allVals.push($(this).attr('data-id'));
          });

          // check if user selected nothing
          if(allVals.length <= 0) {
            confirm('إختر عميل علي الاقل لتستطيع حذفها');
          } else {
            var ids = allVals.join(",");    // join array of IDs into a single variable to explode in controller

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
                  $.ajax(
                  {
                      url: "{{ route('ind.destroySelected') }}",
                      type: 'DELETE',
                      dataType: "JSON",
                      data: {
                          "ids": ids,
                          "_method": 'DELETE',
                          "_token": token,
                      },
                      success: function ()
                      {
                          swal("تم الحذف!", "تم الحذف بنجاح", "success");

                          // fade out selected checkboxes after deletion
                          $.each(allVals, function( index, value ) {
                            $('tr[data-user='+value+']').fadeOut();
                          });
                      }
                  });
                
              } else {
                swal("تم الإلغاء", "المعلومات مازالت موجودة :)", "error");
              }
            });
          }
        });

        // delete a row
        $('.deleteRecord').click(function(){
          
          var id = $(this).data("id");
          var token = '{{ csrf_token() }}';

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
                  $.ajax(
                  {
                      url: "{{ url('/individuals/destroy') }}" +"/"+ id,
                      type: 'DELETE',
                      dataType: "JSON",
                      data: {
                          "id": id,
                          "_method": 'DELETE',
                          "_token": token,
                      },
                      success: function ()
                      {
                          swal("تم الحذف!", "تم الحذف بنجاح", "success");
                          $('tr[data-user='+id+']').fadeOut();
                      }
                  });
              
            } else {
              swal("تم الإلغاء", "المعلومات مازالت موجودة :)", "error");
            }
          });
        });
        
        // Export table as Excel file
        $('#exportSelected').click(function(){
          var allVals = [];                   // selected IDs
          var token = '{{ csrf_token() }}';

          // push cities IDs selected by user
          $('.checkboxes:checked').each(function() {
            allVals.push($(this).attr('data-id'));
          });
          
          // check if user selected nothing
          if(allVals.length <= 0) {
            // push all IDs
            $('.checkboxes').each(function() {
              allVals.push($(this).attr('data-id'));
            });
          }
          
          var ids = allVals.join(",");    // join array of IDs into a single variable to explode in controller
          $.ajax(
          {
            cache: false,
            url: "{{ route('governorates_cities.exportXLS') }}",
            type: 'POST',
            dataType: "JSON",
            data: {
                "ids": ids,
                "_method": 'POST',
                "_token": token,
            },
            success: function (response, textStatus, request)
            {
              swal("تمت العملية بنجاح!", "تم استخراج الجدول علي هيئة ملف اكسيل", "success");
              var a = document.createElement("a");
              a.href = response.file; 
              a.download = response.name+".xlsx";
              document.body.appendChild(a);
              a.click();
              a.remove();
            },
            error: function (ajaxContext) {
              console.log(ajaxContext.responseText);
            }
          });

        });
    });
  </script>
@endsection