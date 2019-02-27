@extends('layout.app')
@section('content')

<div class="row">
  <div class="col-lg-12">
    <div class="cover-inside-container margin--small-top-bottom bradius--small bshadow--1" style="background:  url( '../img/covers/dummy2.jpg ' ) no-repeat center center; background-size:cover;">
      <div class="row">
        <div class="col-xs-12">
          <div class="text-xs-center">
            <div class="text-wraper">
              <h4 class="cover-inside-title color--gray_d">العملاء <i class="fa fa-chevron-circle-right"></i>
                <h4 class="cover-inside-title color--gray_d">الشكاوى و الاستفسارات </h4>
              </h4>
            </div>
          </div>
        </div>
        <div class="cover--actions">
        </div>
      </div>
    </div>
  </div>

    {{-- Start alert messages --}}
    <div class="col-lg-12">
      @if(Session::has('message'))
      <div class="alert alert-warning text-center">{{ Session::get('message') }}</div>
      @endif
      @if (Session::has('success'))
        <div class="alert alert-success text-center">{{ Session::get('success') }}</div>
      @endif

      @if (Session::has('warning'))
        <div class="alert alert-warning text-center">{{ Session::get('warning') }}</div>
      @endif
    </div>
    {{-- End alert --}}

  <div class="col-lg-12">
    <div class="cardwrap bgcolor--white bradius--noborder   bshadow--1 padding--small margin--small-top-bottom">
      <div class="full-table">
        <div class="remodal-bg">

          <div class="remodal" data-remodal-id="filterModal_sponsors" role="dialog" aria-labelledby="modal1Title" aria-describedby="modal1Desc">
            <form action="{{ route('complains.filter') }}" method="POST">
              {{ csrf_field() }}

              <button class="remodal-close" data-remodal-action="close" aria-label="Close"></button>
              <div>
                <h2 id="modal1Title">فلتر</h2>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <div class="master_field">
                    <label class="master_label mandatory" for="ID_No">كودالعميل</label>
                    <input name="code" value="{{ old('code') }}" class="master_input" type="number" placeholder="كودالعميل" id="ID_No">
                      @if ($errors->has('code'))
                        <span class="master_message color--fadegreen">{{ $errors->first('code') }}</span>
                      @endif
                  </div>
                </div>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <div class="master_field">
                    <label class="master_label mandatory" for="ID_No">اسم العميل</label>
                    <input name="name" value="{{ old('name') }}" class="master_input" type="text" placeholder="اسم العميل" id="ID_No">
                      @if ($errors->has('name'))
                        <span class="master_message color--fadegreen">{{ $errors->first('name') }}</span>
                      @endif  
                  </div>
                </div>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <div class="master_field">
                    <label class="master_label mandatory" for="complain_date_from">تاريخ من</label>
                    <div class="bootstrap-timepicker">
                      <input name="date_from" value="{{ old('date_from') }}" class="datepicker master_input" type="text" placeholder="تاريخ من" id="complain_date_from">
                      @if ($errors->has('date_from'))
                        <span class="master_message color--fadegreen">{{ $errors->first('date_from') }}</span>
                      @endif
                    </div>
                  </div>
                </div>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <div class="master_field">
                    <label class="master_label mandatory" for="complain_date_to">تاريخ الى </label>
                    <div class="bootstrap-timepicker">
                      <input name="date_to" value="{{ old('date_to') }}" class="datepicker master_input" type="text" placeholder="تاريخ الى" id="complain_date_to">
                      @if ($errors->has('date_to'))
                        <span class="master_message color--fadegreen">{{ $errors->first('date_to') }}</span>
                      @endif
                  </div>
                </div>
                </div>

                <div class="col-md-12">
                  <div class="master_field">
                    <label class="master_label mandatory">حالة الشكوى</label>
                    <div class="radiorobo">
                      <input name="activate" value="1" type="radio" id="status_1" checked>
                      <label for="status_1">الكل</label>
                    </div>
                    <div class="radiorobo">
                      <input name="activate" value="2" type="radio" id="status_2">
                      <label for="status_2">تم حلها</label>
                    </div>
                    <div class="radiorobo">
                      <input name="activate" value="3" type="radio" id="status_3">
                      <label for="status_3">لم يتم حلها</label>
                    </div>
                  </div>
                </div>
              </div>
              <div class="clearfix"></div>
              <button class="remodal-cancel" data-remodal-action="cancel">الغاء</button>
              <button class="remodal-confirm">فلتر</button>
            </form>
          </div>
         
        </div>
        <div class="filter__btns"><a class="master-btn bgcolor--main color--white bradius--small" href="#filterModal_sponsors"><i class="fa fa-filter"></i>filters</a></div>
        <div class="bottomActions__btns">
          <a id="exportSelected" class="master-btn bradius--small padding--small bgcolor--fadeblue color--white" href="#">استخراج اكسيل</a>
          <a id="deleteSelected" class="master-btn bradius--small padding--small bgcolor--fadebrown color--white btn-warning-cancel" href="#">حذف المحدد</a>
        </div>
        <table class="table-1">
          <thead>
            <tr class="bgcolor--gray_mm color--gray_d">
              <th><span class="cellcontent">&lt;input type=&quot;checkbox&quot; name=&quot;select-all&quot; id=&quot;select-all&quot; /&gt;</span></th>
              <th><span class="cellcontent">كود العميل </span></th>
              <th><span class="cellcontent">اسم العميل</span></th>
              <th><span class="cellcontent">نص الشكوى</span></th>
              <th><span class="cellcontent">تاريخ الشكوى</span></th>
              <th><span class="cellcontent">تم الرد</span></th>
              <th><span class="cellcontent">الاجراءات</span></th>
            </tr>
          </thead>
          <tbody>
              @if (isset($complains) && !empty($complains))
                @foreach ($complains as $complain)
                  <tr data-com="{{ $complain->id }}">
                    <td><span class="cellcontent"><input type="checkbox" class="checkboxes" data-id="{{ $complain->id }}"/></span></td>
                    <td><span class="cellcontent">
                      {{ $complain->code ? $complain->code : 'لا يوجد' }}
                    </span></td>
                    <td><span class="cellcontent">
                      {{ $complain->user_id ? (Helper::getUserDetails($complain->user_id) ? Helper::getUserDetails($complain->user_id)->full_name : 'لا يوجد') : $complain->name }}
                    </span></td> 
                    <td><span class="cellcontent">
                      {{ $complain->body ? str_limit($complain->body, 70, '..') : 'لا يوجد' }}
                    </span></td>
                    <td><span class="cellcontent">
                      {{ $complain->created_at ? $complain->created_at->format('d/m/Y') : 'لا يوجد' }}
                    </span></td>
                    <td><span class="cellcontent"><i class = "fa {{ $complain->is_replied ? 'color--fadegreen fa-check' : ' color--fadebrown fa-times' }}"></i></span></td>
                    <td>
                      <span class="cellcontent">

                        {{-- Edit link --}}
                        <a href="{{ route('complains.edit', $complain->id) }}"  class= "action-btn bgcolor--fadegreen color--white ">
                          <i class = "fa  fa-pencil"></i>
                        </a>

                        {{-- Delete link --}}
                        <a href="#"  class= "btn-warning-cancel action-btn bgcolor--fadebrown color--white deleteRecord" data-id="{{ $complain->id }}">
                          <i class = "fa  fa-trash-o" ></i>
                        </a>
                      </span>
                    </td>
                  </tr>
                @endforeach
              @endif
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<script>

    $(document).ready(function() {
        // Delete selected checkboxes
        $('#deleteSelected').click(function(){
            var allVals = [];                   // selected IDs

            // push cities IDs selected by user
            $('.checkboxes:checked').each(function() {
            allVals.push($(this).attr('data-id'));
            });

            // check if user selected nothing
            if(allVals.length <= 0) {
            confirm('إختر شكوي علي الاقل لتستطيع حذفه');
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
                        url: "{{ route('complains.destroySelected') }}",
                        type: 'GET',
                        dataType: "JSON",
                        data: {
                            "ids": ids,
                            "_method": 'GET',
                        },
                        success: function ()
                        {
                            swal("تم الحذف!", "تم الحذف بنجاح", "success");

                            // fade out selected checkboxes after deletion
                            $.each(allVals, function( index, value ) {
                            $('tr[data-com='+value+']').fadeOut();
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
                        url: "{{ url('/complains/destroy') }}" +"/"+ id,
                        type: 'GET',
                        dataType: "JSON",
                        data: {
                            "id": id,
                            "_method": 'GET',
                        },
                        success: function ()
                        {
                            swal("تم الحذف!", "تم الحذف بنجاح", "success");
                            $('tr[data-com='+id+']').fadeOut();
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
            url: "{{ route('complains.exportXLS') }}",
            type: 'GET',
            data: {
                "ids": ids,
                "_method": 'GET',
            },
            success:function(response){
              swal("تمت العملية بنجاح!", "تم استخراج الجدول علي هيئة ملف اكسيل", "success");
              location.href = response;
            }
          });

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