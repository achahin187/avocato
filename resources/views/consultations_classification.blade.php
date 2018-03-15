@extends('layout.app')
@section('content')

<div class="row">
{{--  Start Header  --}}
  <div class="col-lg-12">
    <div class="cover-inside-container margin--small-top-bottom bradius--small bshadow--1" style="background:  url( '../img/covers/dummy2.jpg ' ) no-repeat center center; background-size:cover;">
      <div class="row">
        <div class="col-xs-12">
          <div class="text-xs-center">
            <div class="text-wraper">
              <h4 class="cover-inside-title color--gray_d">البيانات الأساسية <i class="fa fa-chevron-circle-right"></i>
                <h4 class="cover-inside-title color--gray_d">تصنيف الاستشارات </h4>
              </h4>
            </div>
          </div>
        </div>
        <div class="cover--actions"><span></span>
        </div>
      </div>
    </div>
  </div>
{{--  End Header  --}}

{{-- Start alert messages --}}
<div class="col-lg-12">
  @if (Session::has('success'))
    <div class="alert alert-success text-center">{{ Session::get('success') }}</div>
  @endif
</div>
{{-- End alert --}}

{{--  Start content  --}}
  <div class="col-lg-12">
    <div class="cardwrap bgcolor--white bradius--noborder   bshadow--1 padding--small margin--small-top-bottom">
      <div class="col-md-2 col-sm-3 colxs-12 pull-right"><a class="master-btn color--white bgcolor--main bradius--small bshadow--0 btn-block" href="#popupModal_1"><i class="fa fa-plus"></i><span>إضافة</span></a>
        <div class="remodal-bg"></div>

          <div class="remodal" data-remodal-id="popupModal_1" role="dialog" aria-labelledby="modal1Title" aria-describedby="modal1Desc">
            <button class="remodal-close" data-remodal-action="close" aria-label="Close"></button>
            {{--  Start Form  --}}
            <form action="{{ route('consult.store') }}" method="POST">
              {{ csrf_field() }}
            <div>
              <div class="row">
                <div class="col-xs-12">
                  <h3>إضافة</h3>
                  <div class="col-xs-12">
                    <div class="master_field">
                      <label class="master_label" for="ID_No">ادخال تصنيف جديد للاستشارات القانونية</label>
                      <input name="consult_name" class="master_input" type="text" placeholder="نصنيف جديد" id="ID_No" value="{{ old('consult_name') }}">

                      @if ($errors->has('consult_name'))
                        <span class="master_message color--fadegreen">{{ $errors->first('consult_name') }}</span>
                      @endif
                      
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <br>
            <button class="remodal-cancel" data-remodal-action="cancel">إلغاء</button>
            <button type="submit" class="remodal-confirm">حفظ</button>
            </form>
          </div>
        {{--  End Form  --}}

      </div>
      <div class="full-table">
        <div class="remodal-bg">
          <div class="remodal" data-remodal-id="filterModal_sponsors" role="dialog" aria-labelledby="modal1Title" aria-describedby="modal1Desc">
            <button class="remodal-close" data-remodal-action="close" aria-label="Close"></button>
            <div>
              <h2 id="modal1Title">فلتر</h2>
              <div class="col-md-6">
                <div class="master_field">
                  <label class="master_label mandatory" for="ID_No">التصنيف الرئيسى</label>
                  <input class="master_input" type="text" placeholder="التصنيف الرئيسى" id="ID_No"><span class="master_message color--fadegreen">message</span>
                </div>
              </div>
              <div class="col-md-6">
                <div class="master_field">
                  <label class="master_label mandatory" for="ID_No">التصنيف الفرعى</label>
                  <input class="master_input" type="text" placeholder="التصنيف الفرعى" id="ID_No"><span class="master_message color--fadegreen">message</span>
                </div>
              </div>
            </div>
            <div class="clearfix"></div>
            <button class="remodal-cancel" data-remodal-action="cancel">الغاء</button>
            <button class="remodal-confirm" data-remodal-action="confirm">فلتر</button>
          </div>
        </div>
        <div class="bottomActions__btns">
          {{--  Excel button  --}}
          <a id="exportSelected" class="master-btn bradius--small padding--small bgcolor--fadeblue color--white" href="#">استخراج اكسيل</a>

          {{--  Multi deletion  --}}
          <a id="deleteSelected" class="master-btn bradius--small padding--small bgcolor--fadebrown color--white btn-warning-cancel" href="#">حذف المحدد</a>

        </div>
        <table class="table-1">
          <thead>
            <tr class="bgcolor--gray_mm color--gray_d">
              <th><span class="cellcontent">&lt;input type=&quot;checkbox&quot; name=&quot;select-all&quot; id=&quot;select-all&quot; /&gt;</span></th>
              <th><span class="cellcontent">التصنيف</span></th>
              <th><span class="cellcontent">الاجراءات</span></th>
            </tr>
          </thead>
          <tbody>
            
            {{--  Start rendering data  --}}
            @foreach ($consultations as $consult)
              <tr data-consult="{{ $consult->id }}">
                <td>
                  <span class="cellcontent">
                    <input type="checkbox" class="checkboxes" data-id="{{ $consult->id }}" />
                  </span>
                </td>
                <td><span class="cellcontent">
                  {{ $consult->name }}
                </span></td>
                <td>
                  <span class="cellcontent">
                    <a href="#"  class= "btn-warning-cancel action-btn bgcolor--fadebrown color--white deleteRecord" data-id="{{ $consult->id }}">
                    <i class = "fa  fa-trash-o"></i>
                  </a></span>
                </td>
              </tr>
            @endforeach
            {{--  End rendering data  --}}

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
        <div class="clearfix"></div>
      </div>
    </div>
  </div>
{{--  End content  --}}
</div>

<script>

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
                  url: "/consultations_classification/destroySelected",
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
                        $('tr[data-consult='+value+']').fadeOut();
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
                  url: "/consultations_classification/destroy/"+id,
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
                      $('tr[data-consult='+id+']').fadeOut();
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
        url: "{{ route('consult.exportXLS') }}",
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
  </script>

@endsection
            