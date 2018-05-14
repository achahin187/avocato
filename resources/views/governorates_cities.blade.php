@extends('layout.app')
@section('content')
  <div class="row">
    {{-- Start cover --}}
    <div class="col-lg-12">
      <div class="cover-inside-container margin--small-top-bottom bradius--small bshadow--1" style="background:  url( '{{ asset('img/covers/dummy2.jpg') }}' ) no-repeat center center; background-size:cover;">
        <div class="row">
          <div class="col-xs-12">
            <div class="text-xs-center">
              <div class="text-wraper">
                <h4 class="cover-inside-title color--gray_d">البيانات الأساسية <i class="fa fa-chevron-circle-right"></i>
                  <h4 class="cover-inside-title color--gray_d">المدن و المحافظات </h4>
                </h4>
              </div>
            </div>
          </div>
          <div class="cover--actions"><span></span>
          </div>
        </div>
      </div>
    </div>
    {{-- End cover --}}

    {{-- Start alert messages --}}
    <div class="col-lg-12">
      @if (Session::has('success'))
        <div class="alert alert-success text-center">{{ Session::get('success') }}</div>
      @endif
    </div>
    {{-- End alert --}}

    <div class="col-lg-12">
      <div class="cardwrap bgcolor--white bradius--noborder   bshadow--1 padding--small margin--small-top-bottom">
        <div class="col-md-2 col-sm-3 colxs-12 pull-right">

          {{-- Start Add button --}}
          <a class="master-btn color--white bgcolor--main bradius--small bshadow--0 btn-block" href="#popupModal_1">
            <i class="fa fa-plus"></i><span>إضافة</span>
          </a>
          {{-- End add button --}}
          
          <div class="remodal-bg"></div>

          {{-- Start Add modal forms --}}
          <div class="remodal" data-remodal-id="popupModal_1" role="dialog" aria-labelledby="modal1Title" aria-describedby="modal1Desc">
              <button class="remodal-close" data-remodal-action="close" aria-label="Close"></button>
              <div>
                <div class="row">
                  <div class="col-xs-12">
                    <h3>إضافة</h3>
                    <div class="tabs--wrapper">
                      <div class="clearfix"></div>
                      <ul class="tabs">
                        <li>المحافظات </li>
                        <li>المدن</li>
                      </ul>
                      <ul class="tab__content">

                      {{-- Start Add government form --}}
                      <li class="tab__content_item {{ !$errors->has('city_name') ? 'active' : ''}}" id="right_form">
                        <form action="{{ route('governoratesCities.addGovernment') }}" method="POST" class="resetForm">
                          {{-- Cross Site Request Forgery field --}}
                          {{ csrf_field() }}
                            <div class="col-xs-12">        
                              <div class="master_field">
                                <label class="master_label mandatory" for="gov2">اسم المحافظة</label>
                                <input name="gov_name" class="master_input" type="text" placeholder="اسم المحافظة" id="gov2" value="{{ old('gov_name') }}" required>

                                {{-- Error message --}}
                                @if ($errors->has('gov_name'))
                                  <span class="master_message color--fadegreen">{{ $errors->first('gov_name') }}</span>
                                @endif
                                
                              </div>
                            </div>
                          
                          <br>
                          <button class="remodal-cancel" data-remodal-action="cancel" type="reset">إلغاء</button>
                          <button type="submit" class="remodal-confirm">حفظ</button>
                        </form>
                      </li>
                      {{-- End Add government form --}}

                        {{-- Start Add cities "المدن" --}}
                        <li class="tab__content_item {{ ($errors->has('government_name') || $errors->has('city_name')) ? 'active' : '' }}" id="left_form">
                          <form action="{{ route('governoratesCities.addCity') }}" method="POST" class="resetForm">
                            {{ csrf_field() }}

                            <div class="col-lg-12">
                            <div class="master_field">

                              {{-- Government name --}}
                              <label class="master_label mandatory" for="gov3">المحافظة </label>
                              <select name="government_id" class="master_input select2" id="gov3" style="width:100%;">
                                
                                @foreach ($governments as $government)
                                  <option value="{{ $government->id }}">{{ $government->name }}</option>
                                @endforeach
                                
                              </select><span class="master_message color--fadegreen">
                                {{-- Error message --}}
                                @if ($errors->has('government_id'))
                                  {{ $errors->first('government_id') }}
                                @endif
                              </span>
                            </div>
                            </div>
                            <div class="col-xs-12">
                              <div class="master_field">

                                {{-- City name --}}
                                <label class="master_label mandatory" for="city3">اسم المدينة</label>
                                <input name="city_name" class="master_input" type="text" placeholder="اسم المدينة" id="city3" value="{{ old('city_name') }}" required>
                                
                                <span class="master_message color--fadegreen">
                                  {{-- Error message --}}
                                  @if ($errors->has('city_name'))
                                    <span class="master_message color--fadegreen">{{ $errors->first('city_name') }}</span>
                                  @endif
                                </span>
                              </div>
                            </div>
                            <div class="col-md-3 col-sm-6 col-xs-12">
                              <button class="master-btn undefined btn-inlineblock color--white bgcolor--fadepurple bradius--small bshadow--0" type="submit" value="addMore" name="addMore"><span>حفظ واضافة المزيد</span>
                              </button>
                            </div>
                            <button class="remodal-cancel" data-remodal-action="cancel" type="reset">إلغاء</button>
                            <button type="submit" class="remodal-confirm">حفظ</button>
                          </form>
                        </li>
                        {{-- End Modal left side --}}
                      </ul>
                    </div>
                    <div class="clearfix"></div>
                  </div>
                </div>
              </div>
            </div>
          {{-- End add modal forms --}}

        </div>
        <div class="full-table">
          <div class="remodal-bg">
            <div class="remodal" data-remodal-id="filterModal_sponsors" role="dialog" aria-labelledby="modal1Title" aria-describedby="modal1Desc">
              <button class="remodal-close" data-remodal-action="close" aria-label="Close"></button>
              <div>
                <h2 id="modal1Title">فلتر</h2>
                <div class="col-md-6">
                  <div class="master_field">
                    <label class="master_label mandatory" for="city">المدينة</label>
                    <select class="master_input select2" id="city" multiple="multiple" data-placeholder="المدينة" style="width:100%;" ,>
                      <option>مدينة 1</option>
                      <option>مدينة 2</option>
                    </select><span class="master_message color--fadegreen">message content</span>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="master_field">
                    <label class="master_label mandatory" for="gov"> المحافظة </label>
                    <select class="master_input select2" id="gov" multiple="multiple" data-placeholder="المحافظة" style="width:100%;" ,>
                      <option>القاهرة</option>
                      <option>الجيزة</option>
                    </select><span class="master_message color--fadegreen">message content</span>
                  </div>
                </div>
              </div>
              <div class="clearfix"></div>
              <button class="remodal-cancel" data-remodal-action="cancel">الغاء</button>
              <button class="remodal-confirm" data-remodal-action="confirm">فلتر</button>
            </div>
          </div>

          {{-- Buttons - extract excel & delete --}}
          <div class="bottomActions__btns">
            <a id="exportSelected" class="master-btn bradius--small padding--small bgcolor--fadeblue color--white" href="#">استخراج اكسيل</a>
            <a id="deleteSelected" class="master-btn bradius--small padding--small bgcolor--fadebrown color--white btn-warning-cancel" href="#">حذف المحدد</a>
          </div>
          {{-- End buttons --}}

          {{-- Start cities, government and procedures table --}}
          <table class="table-1">
            <thead>
              <tr class="bgcolor--gray_mm color--gray_d">
                <th><span class="cellcontent">&lt;input type=&quot;checkbox&quot; name=&quot;select-all&quot; id=&quot;select-all&quot; /&gt;</span></th>
                <th><span class="cellcontent">المدينة</span></th>
                <th><span class="cellcontent">المحافظة</span></th>
                <th><span class="cellcontent">الاجراءات</span></th>
              </tr>
            </thead>
            <tbody>
              
              @if ( isset($cities) && !empty($cities) )
                @foreach ($cities as $city)
                  <tr data-city="{{ $city->id }}">
                    <td>
                      <span class="cellcontent">
                        <input type="checkbox" class="checkboxes" data-id="{{ $city->id }}" />
                      </span>
                    </td>
                    <td><span class="cellcontent">{{ $city->name ? $city->name : 'لا يوجد' }}</span></td>
                    <td><span class="cellcontent">{{ $city->governorate ? $city->governorate->name : 'لا يوجد' }}</span></td>
                    <td>
                      <span class="cellcontent"> 
                        <button class="btn-warning-cancel action-btn bgcolor--fadebrown color--white deleteRecord" data-id="{{ $city->id }}">
                          <i class="fa fa-trash-o"></i>
                        </button>
                      </span>
                    </td>
                  </tr>
                @endforeach
              @endif
            </tbody>
          </table>
          {{-- End table --}}

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
                      url: "{{ route('governorates_cities.destroySelected') }}",
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
                            $('tr[data-city='+value+']').fadeOut();
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
                      url: "{{ url('/governorates_cities/destroy') }}" +"/"+ id,
                      type: 'GET',
                      dataType: "JSON",
                      data: {
                          "id": id,
                          "_method": 'GET',
                      },
                      success: function ()
                      {
                          swal("تم الحذف!", "تم الحذف بنجاح", "success");
                          $('tr[data-city='+id+']').fadeOut();
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
            url: "{{ route('governorates_cities.exportXLS') }}",
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


        // Reset a form inside Bootstrap3 modal...
        // There is 2 form in the modal so index [0] for 1st form and index[1] is for 2nd form obviosuly... xD
        $('.remodal-cancel').click(function() {
          $('.resetForm')[0].reset();   // reset 1st form (right form)
          $('.resetForm')[1].reset();   // reset 2nd form (left form)
        });
    });
  </script>
@endsection