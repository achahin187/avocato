 @extends('layout.app')             
 @section('content')

<div class="row">
  <div class="col-lg-12">
    <div class="cover-inside-container margin--small-top-bottom bradius--small bshadow--1" style="background:  url({{ asset('/img/covers/dummy2.jpg' ) }}) no-repeat center center; background-size:cover;">
      <div class="row">
        <div class="col-xs-12">
          <div class="text-xs-center">
            <div class="text-wraper">
              <h4 class="cover-inside-title color--gray_d">الاخبار</h4>
            </div>
          </div>
        </div>
        <div class="cover--actions">
          <a class="color--gray_d bordercolor--white bradius--small border-btn master-btn" type="button" href="{{ route('news_list_create') }}">اضافة خبر </a>
        </div>
      </div>
    </div>
  </div>
  <div class="col-lg-12">
    <div class="cardwrap bgcolor--white bradius--noborder   bshadow--1 padding--small margin--small-top-bottom">
      <div class="full-table">

        <div class="remodal-bg">
          <div class="remodal" data-remodal-id="filterModal_sponsors" role="dialog" aria-labelledby="modal1Title" aria-describedby="modal1Desc">
          <form action="{{ route('news.filter') }}" method="POST">

            {{ csrf_field() }}  
            <button class="remodal-close" data-remodal-action="close" aria-label="Close"></button>
            <div>
              <h2 id="modal1Title">فلتر</h2>
              <div class="col-md-6">
                <div class="master_field">
                {{--  Start date  --}}
                  <label class="master_label mandatory" for="ID_No">تاريخ النشر من </label>
                  <div class="bootstrap-timepicker">
                    <input name="start_date" class="datepicker master_input" type="text" placeholder="تاريخ النشر" id="ID_No" value="{{ old('start_date') }}">
                  </div>
        
                  @if ($errors->has('start_date'))
                    <span class="master_message color--fadegreen">{{ $errors->first('start_date') }}</span>
                  @endif
                {{--  Start date  --}}
                </div>
              </div>
              <div class="col-md-6">

              {{--  End date  --}}
                <div class="master_field">
                  <label class="master_label mandatory" for="ID_No">تاريخ النشر الى </label>
                  <div class="bootstrap-timepicker">
                    <input name="end_date" class="datepicker master_input" type="text" placeholder="تاريخ النشر" id="ID_No" value="{{ old('end_date') }}">
                  </div>
                  
                  @if ($errors->has('end_date'))
                    <span class="master_message color--fadegreen">{{ $errors->first('end_date') }}</span>
                  @endif
                  
                </div>
              {{--  End date  --}}
              
              </div>
              <div class="col-md-6">
                <div class="master_field">
                  <label class="master_label mandatory">الحالة</label>
                  <div class="radiorobo">
                    <input type="radio" id="rad_1" name="condition" value="1" checked>
                    <label for="rad_1">الكل</label>
                  </div>
                  <div class="radiorobo">
                    <input type="radio" id="rad_2" name="condition" value="2">
                    <label for="rad_2">مفعل</label>
                  </div>
                  <div class="radiorobo">
                    <input type="radio" id="rad_3" name="condition" value="3">
                    <label for="rad_3">غير مفعل</label>
                  </div>
                </div>
              </div>
            </div>
            <div class="clearfix"></div>
            <button class="remodal-cancel" data-remodal-action="cancel">الغاء</button>
            <button class="remodal-confirm" type="submit" >فلتر</button>
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
              <th><span class="cellcontent">م</span></th>
              <th><span class="cellcontent">عنوان الخبر</span></th>
              <th><span class="cellcontent">تاريخ النشر</span></th>
              <th><span class="cellcontent">مفعل</span></th>
              <th><span class="cellcontent">الاجراءات</span></th>
            </tr>
          </thead>
          <tbody>
            
            @foreach ($news as $new)
              <tr data-news="{{ $new->id }}">
                <td><span class="cellcontent"><input type="checkbox" class="checkboxes" data-id="{{ $new->id }}" /></span></td>
                <td><span class="cellcontent">215</span></td>
                <td><span class="cellcontent">{{ $new->name ? $new->name : 'لا يوجد اسم' }}</span></td>
                <td><span class="cellcontent">{{ $new->published_at ? $new->published_at : 'لم يتم النشر بعد' }}</span></td>
                <td><span class="cellcontent"><i class = "fa {{ $new->is_active ? 'color--fadegreen fa-check' : 'fa-times' }}"></i></span></td>
                <td>
                  <span class="cellcontent">
                    <a href="{{ route('news.view', ['id' => $new->id]) }}" class= "action-btn bgcolor--main color--white "><i class = "fa  fa-eye"></i></a>
                    <a href="{{ route('news.edit', ['id' => $new->id]) }}" class= "action-btn bgcolor--fadegreen color--white "><i class = "fa  fa-pencil"></i></a>
                    <a class= "btn-warning-cancel action-btn bgcolor--fadebrown color--white deleteRecord" data-id="{{ $new->id }}"><i class = "fa  fa-trash-o"></i></a>
                  </span>
                </td>
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
          confirm('إختر خبر علي الاقل لتستطيع حذفه');
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
                    url: "{{ route('news_destroySelected') }}",
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
                          $('tr[data-news='+value+']').fadeOut();
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
                    url: "{{ url('/news_list/destroy') }}" +"/"+ id,
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
                        $('tr[data-news='+id+']').fadeOut();
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
          url: "{{ route('news.exportXLS') }}",
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

      // hide alert message after 4 seconds => 4000 ms
      window.setTimeout(function() {
            $(".alert").fadeTo(500, 0).slideUp(500, function(){
                $(this).remove(); 
            });
        }, 4000);

    });
  </script>

 @endsection