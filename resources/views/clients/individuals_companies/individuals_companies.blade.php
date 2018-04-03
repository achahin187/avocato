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
                <h3 class="cover-inside-title color--gray_d">افراد - شركات </h3>
              </h4>
            </div>
          </div>
        </div>
        <div class="cover--actions">
          <a class="color--gray_d bordercolor--gray_d bradius--small border-btn master-btn" type="button" href="{{ route('ind.com.create') }}">اضافة عميل أفراد-شركات جديد </a>
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
                  <label class="master_label mandatory" for="comp_code">كود الشركة</label>
                  <input class="master_input" type="number" placeholder="كود الشركة" id="comp_code"><span class="master_message color--fadegreen">message</span>
                </div>
              </div>
              <div class="col-md-6">
                <div class="master_field">
                  <label class="master_label mandatory" for="comp_name">اسم الشركة</label>
                  <input class="master_input" type="text" placeholder="اسم الشركة" id="comp_name"><span class="master_message color--fadegreen">message</span>
                </div>
              </div>
              <div class="col-md-6">
                <div class="master_field">
                  <label class="master_label mandatory" for="start_date_from">تاريخ بداية النعاقد من</label>
                  <div class="bootstrap-timepicker">
                    <input class="datepicker master_input" type="text" placeholder="تاريخ بداية النعاقد" id="start_date_from">
                  </div><span class="master_message color--fadegreen">message content</span>
                </div>
              </div>
              <div class="col-md-6">
                <div class="master_field">
                  <label class="master_label mandatory" for="start_date_to">تاريخ بداية النعاقد الى</label>
                  <div class="bootstrap-timepicker">
                    <input class="datepicker master_input" type="text" placeholder="تاريخ بداية النعاقد" id="start_date_to">
                  </div><span class="master_message color--fadegreen">message content</span>
                </div>
              </div>
              <div class="col-md-6">
                <div class="master_field">
                  <label class="master_label mandatory" for="end_date_from">تاريخ نهاية التعاقد من</label>
                  <div class="bootstrap-timepicker">
                    <input class="datepicker master_input" type="text" placeholder="تاريخ نهاية التعاقد" id="end_date_from">
                  </div><span class="master_message color--fadegreen">message content</span>
                </div>
              </div>
              <div class="col-md-6">
                <div class="master_field">
                  <label class="master_label mandatory" for="end_date_to">تاريخ نهاية التعاقد الى</label>
                  <div class="bootstrap-timepicker">
                    <input class="datepicker master_input" type="text" placeholder="تاريخ نهاية التعاقد" id="end_date_to">
                  </div><span class="master_message color--fadegreen">message content</span>
                </div>
              </div>
              <div class="col-md-6">
                <div class="master_field">
                  <label class="master_label mandatory" for="comp_nationality">الجنسية</label>
                  <input class="master_input" type="text" placeholder="الجنسية" id="comp_nationality"><span class="master_message color--fadegreen">message</span>
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
          <a id="exportSelected" class="master-btn bradius--small padding--small bgcolor--fadeblue color--white" href="#">استخراج اكسيل</a>
          <a class="master-btn bradius--small padding--small bgcolor--fadepurple color--white" href="#">طباعة كارت العميل</a>
          <a id="deleteSelected" class="master-btn bradius--small padding--small bgcolor--fadebrown color--white btn-warning-cancel" href="#">حذف المحدد</a>
        </div>
        <table class="table-1">
          <thead>
            <tr class="bgcolor--gray_mm color--gray_d">
              <th><span class="cellcontent">&lt;input type=&quot;checkbox&quot; name=&quot;select-all&quot; id=&quot;select-all&quot; /&gt;</span></th>
              <th><span class="cellcontent">كودالشركة</span></th>
              <th><span class="cellcontent">اسم الشركة</span></th>
              <th><span class="cellcontent">كودالعميل</span></th>
              <th><span class="cellcontent">اسم العميل</span></th>
              <th><span class="cellcontent">عنوان العميل</span></th>
              <th><span class="cellcontent">هاتف</span></th>
              <th><span class="cellcontent">نوع الباقة</span></th>
              <th><span class="cellcontent">نهاية التعاقد</span></th>
              <th><span class="cellcontent">تفعيل</span></th>
              <th><span class="cellcontent">الإجراءات</span></th>
            </tr>
          </thead>
          <tbody>
            
            @foreach ($ind_coms as $ind_com)
              <tr data-indcom="{{ $ind_com->id }}">
                <td><span class="cellcontent"><input type="checkbox" class="checkboxes" data-id="{{ $ind_com->id }}" /></span></td>
                
                {{-- Company Code --}}
                <td>
                  <span class="cellcontent">
                    @if (isset($ind_com->companyParent->code))
                      {{ $ind_com->companyParent->code }}
                    @else
                      لا يوجد
                    @endif
                  </span>
                </td>

                {{-- Company Name --}}
                <td>
                  <span class="cellcontent">
                    @if (isset($ind_com->companyParent->name))
                      {{ $ind_com->companyParent->name }}
                    @else
                      لا يوجد
                    @endif
                  </span>
                </td>

                {{-- Individual-Company Code --}}
                @if ( $ind_com->code)
                  <td><span class="cellcontent">{{ $ind_com->code }}</span></td>
                @else
                    لا يوجد
                @endif
                
                {{-- Full Name --}}
                @if ( $ind_com->full_name)
                  <td><span class="cellcontent">{{ $ind_com->full_name }}</span></td>
                @else
                    لا يوجد
                @endif

                {{-- Address --}}
                @if ( $ind_com->address)
                  <td><span class="cellcontent">{{ $ind_com->address }}</span></td>
                @else
                    لا يوجد
                @endif
                
                {{-- Mobile --}}
                @if ( $ind_com->address)
                  <td><span class="cellcontent">{{ $ind_com->mobile }}</span></td>
                @else
                    لا يوجد
                @endif
                
                <td>
                  <span class="cellcontent">
                    @if (isset($ind_com->companyParent->name))
                      {{ Helper::localizations('package_types', 'name', $ind_com->subscription->package_type->id) }}
                    @else
                      لا يوجد
                    @endif
                  </span>
                </td>
                <td>
                  <span class="cellcontent">
                    @if (isset($ind_com->subscription->end_date))
                      {{ $ind_com->subscription->end_date->format('d - m - Y') }}
                    @else
                      لا يوجد
                    @endif
                  </span>
                </td>
                <td><span class="cellcontent"><i class="fa color--fadegreen {{ $ind_com->is_active ? 'fa-check' : 'fa-times'}}"></i></span></td>
                <td>
                  <span class="cellcontent">
                    <a href= clients_individuals_companies_view.html ,  class= "action-btn bgcolor--main color--white ">
                      <i class = "fa  fa-eye"></i>
                    </a>
                    <a href="{{ route('ind.com.edit', ['id' => $ind_com->id]) }}" class= "action-btn bgcolor--fadegreen color--white ">
                      <i class = "fa  fa-pencil"></i>
                    </a>

                    {{--  Delete  --}}
                    <a href="#" class="btn-warning-cancel action-btn bgcolor--fadebrown color--white deleteRecord" data-id="{{ $ind_com->id }}">
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
            confirm('إختر مدينة علي الاقل لتستطيع حذفها');
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
                      url: "{{ route('ind.com.destroySelected') }}",
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
                            $('tr[data-indcom='+value+']').fadeOut();
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
                      url: "{{ url('/individuals_companies/destroy') }}" +"/"+ id,
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
                          $('tr[data-indcom='+id+']').fadeOut();
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