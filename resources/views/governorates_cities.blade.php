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
        <div class="tabs--wrapper">
          <div class="clearfix"></div>
          <ul class="tabs">
            <li>المحافظات</li>
            <li>المدن</li>
          </ul>
          <ul class="tab__content">
            <li class="tab__content_item active">
            <div class="col-md-2 col-sm-3 colxs-12 pull-right"><a class="master-btn color--white bgcolor--main bradius--small bshadow--0 btn-block" href="#add_govenment"><i class="fa fa-plus"></i><span>إضافة</span></a>
                <div class="remodal-bg"></div>
                <div class="remodal" data-remodal-id="add_govenment" role="dialog" aria-labelledby="modal1Title" aria-describedby="modal1Desc">
                  <button class="remodal-close" data-remodal-action="close" aria-label="Close"></button>
                  <div>
                    <form action="{{route('governoratesCities.addGovernment')}}" method="POST">
                      {{csrf_field()}}
                      <div class="row">
                        <div class="col-xs-12">
                          <h3>اضافة</h3>
                        </div>
                        <div class="col-xs-12">
                          <div class="master_field">
                            <label class="master_label mandatory" for="gov_name">المحافظة</label>
                            <input class="master_input" type="text" placeholder="المحافظة" id="gov_name" name="gov_name" required> 
                              <span class="master_message color--fadegreen">
                                @if ($errors->has('gov_name'))
                                  {{ $errors->first('gov_name')}}
                                @endif
                              </span>
                          </div>
                        </div>
                        <div class="clearfix"></div><br>
                        <div class="text-center">
                          <button class="remodal-cancel" data-remodal-action="cancel">إلغاء</button>
                          <button class="remodal-confirm" type="submit">حفظ</button>
                        </div>
                      </div>
                    </form>
                    <div class="clearfix"></div>
                  </div>
                </div>

              </div>
              <div class="full-table">
                <div class="bottomActions__btns"><a class="master-btn bradius--small padding--small bgcolor--fadeblue color--white" href="#">استخراج اكسيل</a><a class="master-btn bradius--small padding--small bgcolor--fadebrown color--white btn-warning-cancel" href="#">حذف المحدد</a>
                </div>
                <div class="quick_filter">
                  <div class="dropdown quickfilter_dropb">
                    <button class="dropdown-toggle color--white bgcolor--main bradius--small bshadow--0" type="button" data-toggle="dropdown" id="quick_Filters_2">
                      <small>اللغات  &nbsp;</small><i class="fa fa-angle-down"></i>
                    </button>
                    <div class="dropdown-menu" role="menu" aria-labelledby="quick_Filters_2">
                      <div class="quick-filter-title">
                        <p><b>اختار</b></p>
                      </div>
                      <div class="quick-filter-content">
                      @foreach($languages as $lang)
                        @if($lang->id != \Session::get('AppLocale'))
                        <div class="radiorobo">
                          <input type="radio" id="lang_{{$lang->id}}" name="lang_id" value="{{$lang->id}}" onclick="ChangeLang({{$lang->id}})">
                          <label for="lang_{{$lang->id}}">{{$lang->name}}</label>
                        </div>
                        @endif
                      @endforeach
                      </div>
                    </div>
                  </div>
                </div>
                <table class="table-1">
                  <thead>
                    <tr class="bgcolor--gray_mm color--gray_d">
                      <th><span class="cellcontent">&lt;input type=&quot;checkbox&quot; name=&quot;select-all&quot; id=&quot;select-all&quot; /&gt;</span></th>
                      <th><span class="cellcontent">اسم المحافظة</span></th>
                      <th><span class="cellcontent">الإجراءات</span></th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($governments as $government)
                      @if($government->name != '')
                      <tr data-government-id="{{$government->id}}">
                        <td><span class="cellcontent"><input type="checkbox" class="checkboxes" /></span></td>
                        <td><span class="cellcontent">{{$government->name}}</span></td>
                        <td>
                          <span class="cellcontent">
                            <a href= #lang1 class= "action-btn bgcolor--main color--white ">
                              <i class = "fa  fa-book"></i> &nbsp; اللغات</a>
                            <a href="#" class= "btn-warning-cancel action-btn bgcolor--fadebrown color--white ">
                              <i class = "fa  fa-trash-o"></i>
                            </a>
                          </span>
                        </td>
                      </tr>
                      @endif
                    @endforeach
                  </tbody>
                </table>
              </div>
            </li>
            <li class="tab__content_item">
            
                <div class="col-md-2 col-sm-3 colxs-12 pull-right">

                  {{-- Start Add button --}}
                  <a class="master-btn color--white bgcolor--main bradius--small bshadow--0 btn-block" href="#add_city">
                    <i class="fa fa-plus"></i><span>إضافة</span>
                  </a>
                  {{-- End add button --}}
                  
                  <div class="remodal-bg"></div>

                  {{-- Start Add modal forms --}}
                  <div class="remodal" data-remodal-id="add_city" role="dialog" aria-labelledby="modal1Title" aria-describedby="modal1Desc">
                      <button class="remodal-close" data-remodal-action="close" aria-label="Close"></button>
                      <div>
                      <form action="{{route('governoratesCities.addCity')}}" method="POST">
                        {{csrf_field()}}
                        <div class="row">
                          <div class="col-xs-12">
                            <h3>اضافة</h3>
                          </div>
                          <div class="col-lg-12">
                            <div class="master_field">
                              <label class="master_label mandatory" for="government_id">المحافظة </label>
                              <select class="master_input select2" id="government_id" name="government_id" style="width:100%">
                                @foreach ($governments as $government)
                                  @if($government->name != '')
                                    <option value="{{$government->id}}">{{$government->name}}</option>
                                  @endif
                                @endforeach
                              </select>
                              <span class="master_message color--fadegreen">
                                @if($errors->has('government_id'))
                                  {{$errors->first('government_id')}}
                                @endif
                              </span>
                            </div>
                          </div>
                          <div class="col-xs-12">
                            <div class="master_field">
                              <label class="master_label mandatory" for="add_city">اسم المدينة</label>
                              <input class="master_input" type="text" placeholder="اسم المدينة" id="add_city" name="add_city">
                              <span class="master_message color--fadegreen">
                                  @if($errors->has('add_city'))
                                    {{$errors->first('add_city')}}
                                  @endif
                              </span>
                            </div>
                          </div>
                          <div class="col-md-3 col-sm-6 col-xs-12">
                            <button class="master-btn undefined btn-inlineblock color--white bgcolor--fadepurple bradius--small bshadow--0" type="submit"><span>حفظ واضافة المزيد</span>
                            </button>
                          </div>
                          <div class="clearfix"></div><br>
                          <div class="text-center">
                            <button class="remodal-cancel" data-remodal-action="cancel">إلغاء</button>
                            <button class="remodal-confirm" type="submit">حفظ</button>
                          </div>
                          <div class="clearfix"></div>
                        </div>
                      </form>
                      </div>
                    </div>
                       

                  {{--localization modal --}} 
                  <div id="localization_modal" class="remodal" data-remodal-id="lang" role="dialog" aria-labelledby="modal1Title" aria-describedby="modal1Desc">
                      <form role="form" action="{{route('governorates_cities_add_localization')}}" method="post">
                        {{csrf_field()}}
                      <button class="remodal-close" data-remodal-action="close" aria-label="Close"></button>
                        <div>
                          <div class="row">
                            <h4>ادخال اسم المدينة باللغات</h4><br>
                            <input type="hidden" id="city_id" name="city_id">
                            <div class="col-sm-5">
                              <div class="master_field">
                                <label class="master_label mandatory" for="lang_id">اختار اللغة</label>
                                <select class="master_input" id="lang_id" name="lang_id">
                                  @foreach($languages as $lang)
                                    @if($lang->id != 1)
                                    <option value="{{$lang->id}}">{{$lang->name}}</option>
                                    @endif
                                  @endforeach
                                </select>
                              </div>
                            </div>
                            <div class="col-sm-7">
                              <div class="master_field">
                                <label class="master_label mandatory" for="city_name">ادخال اسم المدينة باللغة المختاره</label>
                                <input class="master_input" type="text" placeholder="اسم المدينة" id="city_name" name="city_name">
                                <span class="master_message color--fadegreen">
                                  @if($errors->has('city_name'))
                                    {{$errors->first('city_name')}}
                                  @endif
                                </span>
                              </div>
                            </div>
                            <div class="clearfix"></div>
                          </div>
                          </div><br>
                          <button class="remodal-cancel" data-remodal-action="cancel">إلغاء</button>
                          <button class="remodal-confirm" remodal-action="confirm" type="submit">حفظ</button>
                        </form>
                      </div>  
                      {{-- End localization modal --}}


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

                  {{-- Language filter --}}
                  <div class="quick_filter">
                      <div class="dropdown quickfilter_dropb">
                        <button class="dropdown-toggle color--white bgcolor--main bradius--small bshadow--0" type="button" data-toggle="dropdown" id="quick_Filters_2">
                          <small>اللغات  &nbsp;</small>
                          <i class="fa fa-angle-down"></i>
                        </button>
                        <div class="dropdown-menu" role="menu" aria-labelledby="quick_Filters_2" id="lang_filter">
                          <div class="quick-filter-title"><p><b>اختار</b></p></div>
                          <div class="quick-filter-content">
                          @foreach($languages as $lang)
                            @if($lang->id != \Session::get('AppLocale'))
                            <div class="radiorobo">
                              <input type="radio" id="lang_{{$lang->id}}" name="lang_id" value="{{$lang->id}}" onclick="ChangeLang({{$lang->id}})">
                              <label for="lang_{{$lang->id}}">{{$lang->name}}</label>
                            </div>
                            @endif
                          @endforeach
                          </div>
                        </div>
                      </div>
                    </div>
                  {{-- End Language filter--}}

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
                          @if($city->name != '')
                          <tr data-city_id="{{ $city->id }}">
                            <td>
                              <span class="cellcontent">
                                <input type="checkbox" class="checkboxes input-in-table"  data-id="{{ $city->id }}" />
                              </span>
                            </td>
                            <td><span class="cellcontent">{{ $city->name ? $city->name : '' }}</span></td>
                            <td><span class="cellcontent">{{ $city->governorate ? $city->governorate->name : '' }}</span></td>
                            <td>
                              <span class="cellcontent">
                                <a id="add_localization" data-city_id="{{$city->id}}" class= "action-btn bgcolor--main color--white add_localization">
                                  <i class = "fa fa-book"></i> &nbsp; اللغات
                                </a>
                                <a href="#" class= "btn-warning-cancel action-btn bgcolor--fadebrown color--white ">
                                  <i class = "fa fa-trash-o"></i>
                                </a>
                              </span>
                            </td>
                          </tr>
                          @endif
                        @endforeach
                      @endif
                    </tbody>
                  </table>
                  {{-- End table --}}
                </div>
                <div class="clearfix"></div>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>

  <script>

      $(document).ready(function(){
              $('.btn-warning-cancel').click(function(){
                var city_id = $(this).closest('tr').attr('data-city_id');
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
                     url:'{{route('governorates_cities.destroy')}}',
                     data:{
                          _token:_token,
                          id:city_id
                       },
                      success:function(data){
                        $('tr[data-city_id='+city_id+']').fadeOut();
                      },error:function(response){
                        console.log(response);
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
                  return $(this).closest('tr').attr('data-city_id');
                }).get();
                var _token = '{{csrf_token()}}';
                console.log(selectedIds);
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
                      url:'{{route('governorates_cities.destroyAll')}}',
                      data:{
                        ids:selectedIds,
                        _token:_token},
                      success:function(data){
                        $.each( selectedIds, function( key, value ) {
                          $('tr[data-city_id='+value+']').fadeOut();
                        });
                      }
                    });
                    swal("تم الحذف!", "تم الحذف بنجاح", "success");
                  }else{
                    swal("تم الإلغاء", "المعلومات مازالت موجودة :)", "error");
                  }
                });
              });
        
        // Export table as Excel file
        $('#exportSelected').click(function(){
          var allVals = [];                   // selected IDs

          // push cities IDs selected by user
          $('.checkboxes:checked').each(function() {
            allVals.push($(this).attr('data-city_id'));
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
    //language filter
    $('#quick_Filters_2').click( function(){
        $('#lang_filter').toggle();
      });

      // add localization
      $('.add_localization').click( function(){
          var localization_modal = $('#localization_modal');
          localization_modal.find('#city_id').val($(this).data('city_id'));
          $('#localization_modal').remodal().open();
      });

      //change lang
      function ChangeLang(id){
        $.ajax({
              url: '{{ route("change.language") }}',
              type: 'POST',
              dataType: "JSON",
              data: {
                  _token: '{{ csrf_token() }}',
                  locale: id,
                  method: 'POST',
              },
              success: function (response) {
                window.location.href = '{{ Request::url() }}';
              },
              error: function(response) {
                console.log(response);
              }
          });
      }
  </script>
@endsection