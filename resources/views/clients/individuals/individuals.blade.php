@extends('layout.app')
@section('content')

<div class="row">
  {{-- Cover --}}
  <div class="col-lg-12">
    <div class="cover-inside-container margin--small-top-bottom bradius--small bshadow--1" style="background:  url( '{{asset('img/covers/dummy2.jpg')}}' ) no-repeat center center; background-size:cover;">
      <div class="row">
        <div class="col-xs-12">
          <div class="text-xs-center">
            <div class="text-wraper">
              <h4 class="cover-inside-title color--gray_d">العملاء <i class="fa fa-chevron-circle-right"></i>
                <h4 class="cover-inside-title color--gray_d">محتوى </h4>
                <h3 class="cover-inside-title color--gray_d">الأفراد </h3>
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

  <div class="col-lg-12">
    @if (Session::has('warning'))
      <div class="alert alert-warning text-center">{{ Session::get('warning') }}</div>
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
            <form action="{{ route('ind.filter') }}" method="POST">
              {{ csrf_field() }}

              <button class="remodal-close" data-remodal-action="close" aria-label="Close"></button>
              <div>
                <h3 id="modal1Title">فلتر</h3>
                {{-- Search --}}
                <div class="col-md-6">
                  <div class="master_field">
                  <label class="master_label mandatory" for="ID_No">  بحث بالاسم اوالكود او رقم التليفون </label>
                    <div class="bootstrap-timepicker">
                      <input name="search" class=" master_input" type="text" placeholder="بحث بالاسم اوالكود" id="search" value="{{ old('search') }}">
                    </div>
          
                    @if ($errors->has('start_date'))
                      <span class="master_message color--fadegreen">{{ $errors->first('search') }}</span>
                    @endif
                  {{--  Start date  --}}
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
                    <label class="master_label mandatory" for="license_end_from">تاريخ نهاية التعاقد من</label>
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
                
                      <option value="-1" selected disabled hidden>اختر جنسية العميل</option>
                      
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
        <div class="filter__btns">
          <a class="master-btn bgcolor--main color--white bradius--small" href="#filterModal_sponsors">
            <i class="fa fa-filter"></i>filters</a></div>
        
        
        <table class="table-1" id="dataTableTriggerId_001">
          <thead>
            <tr class="bgcolor--gray_mm color--gray_d">
            <th><span class="cellcontent">&lt;input type=&quot;checkbox&quot; name=&quot;select-all&quot; id=&quot;select-all&quot; onclick=&quot;checkAll(this)&quot; /&gt;</span></th>              <th><span class="cellcontent">كودالعميل</span></th>
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

            @if (isset($filters) && !empty($filters))
              @foreach ($filters as $filter)
                <tr data-user="{{ $filter->id }}">
                  <td><span class="cellcontent"><input type="checkbox" class="checkboxes input-in-table" data-id="{{ $filter->id }}" /></span></td>
                  
                  {{-- Code --}}
                  @if ( $filter->code )
                    <td><span class="cellcontent">{{ $filter->code }}</span></td>
                  @else
                      لا يوجد
                  @endif
                  
                  {{-- Full Name --}}
                  @if ( $filter->full_name )
                    <td><span class="cellcontent">{{ $filter->full_name }}</span></td>
                  @else 
                    لا يوجد
                  @endif

                  {{-- Address --}}
                  @if ( $filter->address )
                    <td><span class="cellcontent">{{ $filter->address }}</span></td>
                  @else
                    لا يوجد
                  @endif

                  {{-- Mobile --}}
                  @if ( $filter->mobile )
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
                      @if (isset($filter->start_date))
                        {{ date('Y-m-d', strtotime($filter->start_date)) }}
                      @else
                        لا يوجد
                      @endif
                    </span>
                  </td>
                  <td>
                    <span class="cellcontent">
                      @if (isset($filter->end_date))
                        {{  date('Y-m-d', strtotime($filter->end_date)) }}
                      @else
                        لا يوجد
                      @endif
                    </span>
                  </td>
                  <td><span class="cellcontent"><i class = "fa  {{ $filter->is_active ? 'color--fadegreen fa-check' : 'fa-times'}}"></i></span></td>
                  <td>
                    <span class="cellcontent">

                      {{--  Show  --}}
                      <a href= "{{route('ind.show',$filter->id)}}" ,  class= "action-btn bgcolor--main color--white ">
                        <i class = "fa  fa-eye"></i>
                      </a>

                      {{--  Edit  --}}
                      <a href= "{{route('ind.edit', ['id' => $filter->id])}}" ,  class= "action-btn bgcolor--fadegreen color--white ">
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
              {{-- Regular users --}}
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
                    @if(count($user->bouquets) != 0)
                    @foreach($user->bouquets as $bouquet)
                    {{$bouquet->name}}
                    @endforeach
                    @else
                    'لا يوجد'
                    @endif
                    </span>
                  </td>
                  <td>
                    <span class="cellcontent">
                     
                    @if(count($user->bouquets) != 0)
                    @foreach($user->bouquets as $bouquet)
                    {{$bouquet->pivot->start_date}}
                    @endforeach
                    @else
                    'لا يوجد'
                    @endif
                    </span>
                  </td>
                  <td>
                    <span class="cellcontent">
                    @if(count($user->bouquets) != 0)
                    @foreach($user->bouquets as $bouquet)
                    {{$bouquet->pivot->end_date}}
                    @endforeach
                    @else
                    'لا يوجد'
                    @endif
                    </span>
                  </td>
                  <td><span class="cellcontent"><i class = "fa {{ $user->is_active ? ' color--fadegreen fa-check' : 'fa-times  color--fadebrown'}}"></i></span></td>
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
                      <a href= "#lawyer_notification_{{$user->id}}" ,  class= "noti action-btn bgcolor--fadeorange color--white "><i class = "fa  fa-bell"></i></a>
                      {{--  Delete  --}}
                      <a href="#" class="btn-warning-cancel action-btn bgcolor--fadebrown color--white deleteRecord" data-id="{{ $user->id }}">
                        <i class="fa fa-trash-o"></i>
                      </a>

                    </span>
                  </td>
                  <td hidden>       
                    <div class="col-md-2 col-sm-3 colxs-12"><a class="master-btn undefined undefined undefined undefined undefined" href="#lawyer_notification_{{$user->id}}"><span></span></a>
                    <div class="remodal-bg"></div>
                    <div class="remodal" data-remodal-id="lawyer_notification_{{$user->id}}" role="dialog" aria-labelledby="modal1Title" aria-describedby="modal1Desc">
                      <button class="remodal-close" data-remodal-action="close" aria-label="Close"></button>
                      <div>
                        <form role="form" action="{{route('notification_lawyer',$user->id)}}" method="post" enctype="multipart/form-data" accept-charset="utf-8">
                                  <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <div class="row">
                                      <h3>إرسال تنبيه</h3>
                                      <div class="col-xs-12">
                                        <div class="master_field">
                                          <label class="master_label mandatory" for="send_date">تاريخ الإرسال</label>
                                      <div class="bootstrap-timepicker">
                                        <input name="noti_date" class="datepicker master_input" type="text" placeholder="تاريخ الإرسال" id="send_date">
                                      </div><span class="master_message color--fadegreen"></span>
                                    </div>
                                  </div>
                                  <div class="col-xs-12">
                                    <div class="master_field">
                                      <label class="master_label">نص التنبية</label>
                                      <textarea id="nots" name="notific" class="master_input" placeholder="نص التنبية"></textarea>
                                    </div>
                                  </div>
                                  <div class="clearfix"></div>
                                </div>
                              </div><br>
                              <button class="remodal-cancel" data-remodal-action="cancel">إلغاء</button>
                              <button class="remodal-confirm" type="submit">إرسال</button>
                        </form>
                      </div>
                    </div>
                </td>
                </tr>
              @endforeach
            @endif
            
          </tbody>
        </table>

        <div class="bottomActions__btns">
          <br>
          <a id="deleteSelected" class="master-btn bradius--small padding--small bgcolor--fadebrown color--white pull-left" href="#">حذف المحدد</a>
          <a id="printSelected" class="master-btn bradius--small padding--small bgcolor--fadepurple color--white pull-left" href="#">طباعة</a>
          <a id="exportSelected" class="master-btn bradius--small padding--small bgcolor--fadeblue color--white pull-left" href="#">استخراج اكسيل</a>
          <a id="exportPDF" class="master-btn bradius--small padding--small bgcolor--fadeorange color--white pull-left" href="#">استخراج pdf</a>
        </div>

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
<script type="text/javascript">
    $(function () {
      $('.datepicker').datepicker({autoclose: true});
      $(".timepicker").timepicker({showInputs: false});
    });
    
  </script>    
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
            confirm('إختر عميل علي الاقل لتستطيع حذفه');
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
                "userType": 'Individuals',
                
                "userRule": 8,
                "_method": 'GET',
            },
            success:function(response){
              swal("تمت العملية بنجاح!", "تم استخراج الجدول علي هيئة ملف اكسيل", "success");
              location.href = response;
            }
          });

        });

        // Export table as PDF
        $('#exportPDF').click(function(){
          var allVals = [];                   // selected IDs

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
            url: "{{ route('clients.exportPDF') }}",
            type: 'GET',
            data: {
                "ids": ids,
                "userType": 'Individuals',
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
  <script LANGUAGE="JavaScript">
function checkAll(bx) {
var cbs = document.getElementsByClassName('checkboxes');
for(var i=0; i < cbs.length; i++) {
cbs[i].checked = bx.checked;
}
}
</script>
@endsection