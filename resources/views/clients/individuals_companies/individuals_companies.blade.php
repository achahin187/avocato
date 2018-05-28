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
            
            {{-- Start filter form --}}
            <form action="{{ route('ind.com.filter') }}" method="POST">
              {{ csrf_field() }}

              <button class="remodal-close" data-remodal-action="close" aria-label="Close"></button>
              <div>
                <h3 id="modal1Title">فلتر</h3>

                {{-- Company Code --}}
                <div class="col-md-6">
                  <div class="master_field">
                    <label class="master_label mandatory" for="license_type">كود الشركة</label>
                    <select name="company_code" class="master_input select2" id="company_code" style="width:100%;">
                      
                      {{-- Defualt useless select option --}}
                      <option value="-1" selected disabled hidden>إختر كود الشركة</option>
        
                      @foreach ($companies as $company)
                        <option id="comcode" value="{{ $company->id }}" data-id="{{ $company->name }}">{{ $company->code }}</option>
                      @endforeach
                      
                    </select>
                    {{--  Error  --}}
                  @if ($errors->has('company_code'))
                      <span class="master_message color--fadegreen">{{ $errors->first('company_code') }}</span>
                    @endif
                  </div>
                  
                </div>

                {{-- Package Type --}}
                <div class="col-md-6">
                  <div class="master_field">
                    <label class="master_label mandatory" for="license_type"> نوع الباقة </label>
                    <select name="package_type[]" class="master_input select2" id="license_type" multiple="multiple" data-placeholder="نوع الباقة" style="width:100%;" ,>
                      @foreach ($packages as $pckg)
                        <option value="{{ $pckg->id }}">{{ Helper::localizations('package_types', 'name', $pckg->id) }}</option>
                      @endforeach
                    </select>
                      @if ($errors->has('package_type'))
                        <span class="master_message color--fadegreen">{{ $errors->first('package_type') }}</span>
                      @endif
                  </div>
                </div>

                {{-- Start Date From --}}
                <div class="col-md-6">
                  <div class="master_field">
                    <label class="master_label mandatory" for="license_start_from">تاريخ بداية النعاقد من</label>
                    <div class="bootstrap-timepicker">
                      <input name="start_date_from" class="datepicker master_input" type="text" placeholder="تاريخ بداية النعاقد" id="license_start_from">
                    </div>
                    @if ($errors->has('start_date_from'))
                      <span class="master_message color--fadegreen">{{ $errors->first('start_date_from') }}</span>
                    @endif
                  </div>
                </div>

                {{-- Start Date To --}}
                <div class="col-md-6">
                  <div class="master_field">
                    <label class="master_label mandatory" for="license_start_to">تاريخ بداية النعاقد الى</label>
                    <div class="bootstrap-timepicker">
                      <input name="start_date_to" class="datepicker master_input" type="text" placeholder="تاريخ بداية النعاقد" id="license_start_to">
                    </div>
                    @if ($errors->has('start_date_to'))
                      <span class="master_message color--fadegreen">{{ $errors->first('start_date_to') }}</span>
                    @endif
                  </div>
                </div>

                {{-- End Date From --}}
                <div class="col-md-6">
                  <div class="master_field">
                    <label class="master_label mandatory" for="license_end_from">تاريخ نهاية التعاقد</label>
                    <div class="bootstrap-timepicker">
                      <input name="end_date_from" class="datepicker master_input" type="text" placeholder="تاريخ نهاية التعاقد" id="license_end_from">
                    </div>
                    @if ($errors->has('end_date_from'))
                      <span class="master_message color--fadegreen">{{ $errors->first('end_date_from') }}</span>
                    @endif
                  </div>
                </div>

                {{-- End Date To --}}
                <div class="col-md-6">
                  <div class="master_field">
                    <label class="master_label mandatory" for="license_end_to">تاريخ نهاية التعاقد الى</label>
                    <div class="bootstrap-timepicker">
                      <input name="end_date_to" class="datepicker master_input" type="text" placeholder="تاريخ نهاية التعاقد" id="license_end_to">
                    </div>
                    @if ($errors->has('end_date_to'))
                      <span class="master_message color--fadegreen">{{ $errors->first('end_date_to') }}</span>
                    @endif
                  </div>
                </div>

                {{-- Nationality --}}
                <div class="col-md-6">
                  <div class="master_field">
                    <label class="master_label mandatory" for="nationality">الجنسية</label>

                    <select name="nationality" class="master_input select2" id="license_type" style="width:100%;">
                
                      <option value="-1" selected disabled hidden>اختر جنسية الشركة</option>

                      @foreach ($nationalities as $nat)
                        <option value="{{ $nat->id }}">{{ Helper::localizations('geo_countries', 'nationality', $nat->id) }}</option>
                      @endforeach
                      
                    </select>  

                  </div>
                </div>

                {{-- Activation --}}
                <div class="col-md-6">
                  <div class="master_field">
                    <label class="master_label mandatory">التفعيل</label>
                    <div class="radiorobo">
                      <input name="activate" value="1" type="radio" id="rad_1" checked>
                      <label for="rad_1">الكل</label>
                    </div>
                    <div class="radiorobo">
                      <input name="activate" value="2" type="radio" id="rad_2">
                      <label for="rad_2">المفعلين</label>
                    </div>
                    <div class="radiorobo">
                      <input name="activate" value="3" type="radio" id="rad_3">
                      <label for="rad_3">غير المفعلين</label>
                    </div>
                  </div>
                </div>

              </div>
              <div class="clearfix"></div>
              <button class="remodal-cancel" data-remodal-action="cancel">الغاء</button>
              <button type="submit" class="remodal-confirm" >فلتر</button>

            </form>
            {{-- End filter form --}}

          </div>
        </div>
        <div class="filter__btns"><a class="master-btn bgcolor--main color--white bradius--small" href="#filterModal_sponsors"><i class="fa fa-filter"></i>filters</a></div>
        <div class="bottomActions__btns">
          <a id="exportSelected" class="master-btn bradius--small padding--small bgcolor--fadeblue color--white" href="#">استخراج اكسيل</a>
          <a id="printSelected" class="master-btn bradius--small padding--small bgcolor--fadepurple color--white" href="#">طباعة</a>
          <a id="deleteSelected" class="master-btn bradius--small padding--small bgcolor--fadebrown color--white btn-warning-cancel" href="#">حذف المحدد</a>
        </div>
        <table class="table-1" id="dataTableTriggerId_001">
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
            
            @if (isset($filters) && !empty($filters))
              @foreach ($filters as $filter)
                <tr data-indcom="{{ $filter->id }}">
                  <td><span class="cellcontent"><input type="checkbox" class="checkboxes  input-in-table" data-id="{{ $filter->id }}" /></span></td>
                  
                  {{-- Company Code --}}
                  <td>
                    <span class="cellcontent">
                      @if (isset($filter->companyParent->code))
                        {{ $filter->companyParent->code }}
                      @else
                        لا يوجد
                      @endif
                    </span>
                  </td>

                  {{-- Company Name --}}
                  <td>
                    <span class="cellcontent">
                      @if (isset($filter->companyParent->name))
                        {{ $filter->companyParent->name }}
                      @else
                        لا يوجد
                      @endif
                    </span>
                  </td>

                  {{-- Individual-Company Code --}}
                  @if ( $filter->code)
                    <td><span class="cellcontent">{{ $filter->code }}</span></td>
                  @else
                      لا يوجد
                  @endif
                  
                  {{-- Full Name --}}
                  @if ( $filter->full_name)
                    <td><span class="cellcontent">{{ $filter->full_name }}</span></td>
                  @else
                      لا يوجد
                  @endif

                  {{-- Address --}}
                  @if ( $filter->address)
                    <td><span class="cellcontent">{{ $filter->address }}</span></td>
                  @else
                      لا يوجد
                  @endif
                  
                  {{-- Mobile --}}
                  @if ( $filter->mobile)
                    <td><span class="cellcontent">{{ $filter->mobile }}</span></td>
                  @else
                      لا يوجد
                  @endif
                  
                  <td>
                    <span class="cellcontent">
                      @if (isset($filter->package_type_id))
                        {{ Helper::localizations('package_types', 'name', $filter->package_type_id) }}
                      @else
                        لا يوجد
                      @endif
                    </span>
                  </td>
                  <td>
                    <span class="cellcontent">
                      @if (isset($filter->end_date))
                        {{ date('Y-m-d', strtotime($filter->end_date)) }}
                      @else
                        لا يوجد
                      @endif
                    </span>
                  </td>
                  <td><span class="cellcontent"><i class="fa {{ $filter->is_active ? ' color--fadegreen fa-check' : ' color--fadebrown fa-times'}}"></i></span></td>
                  <td>
                    <span class="cellcontent">
                      <a href= clients_individuals_companies_view.html ,  class= "action-btn bgcolor--main color--white ">
                        <i class = "fa  fa-eye"></i>
                      </a>
                      <a href="{{ route('ind.com.edit', ['id' => $filter->id]) }}" class= "action-btn bgcolor--fadegreen color--white ">
                        <i class = "fa  fa-pencil"></i>
                      </a>

                      {{--  Delete  --}}
                      <a href="#" class="btn-warning-cancel action-btn bgcolor--fadebrown color--white deleteRecord" data-id="{{ $filter->id }}">
                        <i class="fa fa-trash-o"></i>
                      </a>

                    </span>
                  </td>
                </tr>
              @endforeach
            @else 
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
                  @if ( $ind_com->mobile)
                    <td><span class="cellcontent">{{ $ind_com->mobile }}</span></td>
                  @else
                      لا يوجد
                  @endif
                  
                  <td>
                    <span class="cellcontent">
                      @if (isset($ind_com->subscription->package_type_id))
                        {{ Helper::localizations('package_types', 'name', $ind_com->subscription->package_type_id) }}
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
                      <a href= "{{route('ind.com.show',$ind_com->id)}}" ,  class= "action-btn bgcolor--main color--white ">
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
            @endif
            
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
                      type: 'GET',
                      dataType: "JSON",
                      data: {
                          "ids": ids,
                          "_method": 'GET',
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
                      type: 'GET',
                      dataType: "JSON",
                      data: {
                          "id": id,
                          "_method": 'GET',
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
            var ids = null;
          } else {
            var ids = allVals.join(",");    // join array of IDs into a single variable to explode in controller
          }
          
          $.ajax(
          {
            url: "{{ route('clients.exportXLS') }}",
            type: 'GET',
            data: {
                "ids": ids,
                "userType": 'individuals-Companies',
                "userRule": 10,
                "_method": 'GET',
            },
            success:function(response){
              swal("تمت العملية بنجاح!", "تم استخراج الجدول علي هيئة ملف اكسيل", "success");
              location.href = response;
            }
          });

        });

        $('#printSelected').click(function(){
          var allVals = [];                   // selected IDs
          var token = '{{ csrf_token() }}';

          // push cities IDs selected by user
          $('.checkboxes:checked').each(function() {
            allVals.push($(this).attr('data-id'));
          });

          // check if user selected nothing
          if(allVals.length <= 0) {
            confirm('إختر عميل علي الاقل لتستطيع طبعه');
          } else {
            var ids = allVals.join(",");    // join array of IDs into a single variable to explode in controller
            
            if(ids) {
              window.location = "{{ url('/clients/print') }}" + "/" + ids;
            }
          }
        });

        // hide alert message after 4 seconds => 4000 ms
        window.setTimeout(function() {
            $(".alert").fadeTo(500, 0).slideUp(500, function(){
                $(this).remove(); 
            });
        }, 4000);
    });
  </script>

@endsection