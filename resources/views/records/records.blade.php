@extends('layout.app')
@section('content')

<div class="row">
    {{-- Cover --}}
    <div class="col-lg-12">
        <div class="cover-inside-container margin--small-top-bottom bradius--small bshadow--1" style="background:  url( '../img/covers/dummy2.jpg ' ) no-repeat center center; background-size:cover;">
        <div class="row">
            <div class="col-xs-12">
            <div class="text-xs-center">
                <div class="text-wraper">
                <h4 class="cover-inside-title color--gray_d">دفتر المحضرين</h4>
                </div>
            </div>
            </div>
            <div class="cover--actions">
                <a class="color--gray_d bordercolor--white bradius--small border-btn master-btn" type="button" href="{{ route('records.add') }}">اضافة</a>
            </div>
        </div>
        </div>
    </div>

    <div class="col-lg-12">
        @if (Session::has('success'))
            <div class="alert alert-success text-center">
                {{ Session::get('success') }}
            </div>
        @endif

        @if (Session::has('warning'))
            <div class="alert alert-warning text-center">
                {{ Session::get('warning') }}
            </div>
        @endif
    </div>

    {{-- Main content --}}
    <div class="col-lg-12">
        <div class="cardwrap bgcolor--white bradius--noborder   bshadow--1 padding--small margin--small-top-bottom">
        <div class="full-table">

                <div class="remodal-bg">
                <div class="remodal" data-remodal-id="filterModal_sponsors" role="dialog" aria-labelledby="modal1Title" aria-describedby="modal1Desc">
                    <button class="remodal-close" data-remodal-action="close" aria-label="Close"></button>
                    <div>
                        {{-- Filter form --}}
                        <form action="{{ route('records.filter') }}" method="POST">
                            {{ csrf_field() }}
                            
                            <h2 id="modal1Title">فلتر</h2>

                            {{-- Pen --}}
                            <div class="col-md-3 col-sm-6 col-xs-12">
                                <div class="master_field">
                                    <label class="master_label mandatory" for="record_pen"> قلم المحضرين </label>
                                    <select name="pen[]" class="master_input select2" id="record_pen" multiple="multiple" data-placeholder="قلم المحضرين " style="width:100%;" ,>
                                        
                                        @if (isset($pens) && !empty($pens))
                                            @foreach ($pens as $pen)
                                                <option value="{{ $pen->pen }}">{{ $pen->pen }}</option>
                                            @endforeach
                                        @endif

                                    </select>
                                    @if ($errors->has('pen'))
                                        <span class="master_message color--fadegreen">{{ $errors->first('pen') }}</span>
                                    @endif
                                </div>
                            </div>

                            {{-- Name --}}
                            <div class="col-md-3 col-sm-6 col-xs-12">
                                <div class="master_field">
                                    <label class="master_label mandatory" for="client_name">اسم الموكل</label>
                                    <input name="name" value="{{ old('name') }}" class="master_input" type="text" placeholder="اسم الموكل" id="client_name">
                                    
                                    @if($errors->has('name'))
                                        <span class="master_message color--fadegreen">{{ $errors->first('name') }}</span>
                                    @endif
                                </div>
                            </div>

                            {{-- Delivery date from --}}
                            <div class="col-md-3 col-sm-6 col-xs-12">
                                <div class="master_field">
                                    <label class="master_label mandatory" for="date_from">تاريخ التسليم من</label>
                                    <div class="bootstrap-timepicker">
                                        <input name="dd_from" value="{{ old('dd_from') }}" class="datepicker master_input" type="text" placeholder="تاريخ التسليم" id="date_from">
                                    </div>

                                    @if($errors->has('dd_from'))
                                        <span class="master_message color--fadegreen">{{ $errors->first('dd_from') }}</span>
                                    @endif
                                </div>
                            </div>

                            {{-- Delivery date to --}}
                            <div class="col-md-3 col-sm-6 col-xs-12">
                                <div class="master_field">
                                    <label class="master_label mandatory" for="date_to">تاريخ التسلم الى</label>
                                    <div class="bootstrap-timepicker">
                                        <input name="dd_to" value="{{ old('dd_to') }}" class="datepicker master_input" type="text" placeholder="تاريخ التسلم" id="date_to">
                                    </div>

                                    @if($errors->has('dd_to'))
                                        <span class="master_message color--fadegreen">{{ $errors->first('dd_to') }}</span>
                                    @endif
                                </div>
                            </div>

                            {{-- Session date from --}}
                            <div class="col-md-3 col-sm-6 col-xs-12">
                                <div class="master_field">
                                    <label class="master_label mandatory" for="session_date_from">تاريخ الجلسة من</label>
                                    <div class="bootstrap-timepicker">
                                        <input name="sd_from" value="{{ old('sd_from') }}" class="datepicker master_input" type="text" placeholder="تاريخ الجلسة" id="session_date_from">
                                    </div>

                                    @if($errors->has('sd_from'))
                                        <span class="master_message color--fadegreen">{{ $errors->first('sd_from') }}</span>
                                    @endif
                                </div>
                            </div>

                            {{-- Session date to --}}
                            <div class="col-md-3 col-sm-6 col-xs-12">
                                <div class="master_field">
                                    <label class="master_label mandatory" for="session_date_to">تاريخ الجلسة الى</label>
                                    <div class="bootstrap-timepicker">
                                        <input name="sd_to" value="{{ old('sd_to') }}" class="datepicker master_input" type="text" placeholder="تاريخ الجلسة" id="session_date_to">
                                    </div>

                                    @if($errors->has('sd_to'))
                                        <span class="master_message color--fadegreen">{{ $errors->first('sd_to') }}</span>
                                    @endif
                                </div>
                            </div>

                            {{-- Delivered-at from --}}
                            <div class="col-md-3 col-sm-6 col-xs-12">
                                <div class="master_field">
                                    <label class="master_label mandatory" for="delivery_date_from">تاريخ الإستلام من</label>
                                    <div class="bootstrap-timepicker">
                                        <input name="da_from" value="{{ old('da_from') }}" class="datepicker master_input" type="text" placeholder="تاريخ التسليم" id="delivery_date_from">
                                    </div>

                                    @if($errors->has('da_from'))
                                        <span class="master_message color--fadegreen">{{ $errors->first('da_from') }}</span>
                                    @endif
                                </div>
                            </div>

                            {{-- Delivered-at to --}}
                            <div class="col-md-3 col-sm-6 col-xs-12">
                                <div class="master_field">
                                    <label class="master_label mandatory" for="delivery_date_to">تاريخ الإستلام الى</label>
                                    <div class="bootstrap-timepicker">
                                        <input name="da_to" value="{{ old('da_to') }}" class="datepicker master_input" type="text" placeholder="تاريخ التسلم" id="delivery_date_to">
                                    </div>

                                    @if($errors->has('da_to'))
                                        <span class="master_message color--fadegreen">{{ $errors->first('da_to') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <button class="remodal-cancel" data-remodal-action="cancel">الغاء</button>
                            <button type="submit" class="remodal-confirm">فلتر</button>
                        </form>
                        {{-- End filter form --}}

                    </div>
                </div>
            

            <div class="filter__btns">
                <a class="master-btn bgcolor--main color--white bradius--small" href="#filterModal_sponsors"><i class="fa fa-filter"></i>filters</a>
            </div>
            
            
            <div class="bottomActions__btns">
                <a id="exportSelected" class="master-btn bradius--small padding--small bgcolor--fadeblue color--white" href="#">استخراج اكسيل</a>
                <a id="deleteSelected" class="master-btn bradius--small padding--small bgcolor--fadebrown color--white btn-warning-cancel" href="#">حذف المحدد</a>
            </div>
            <table class="table-1" id="dataTableTriggerId_001">
            <thead>
                <tr class="bgcolor--gray_mm color--gray_d">
                <th><span class="cellcontent">&lt;input type=&quot;checkbox&quot; name=&quot;select-all&quot; id=&quot;select-all&quot; /&gt;</span></th>
                <th><span class="cellcontent">رقم الاعلان</span></th>
                <th><span class="cellcontent">قلم المحضرين</span></th>
                <th><span class="cellcontent">اسم الموكل</span></th>
                <th><span class="cellcontent">تاريخ التسليم</span></th>
                <th><span class="cellcontent">تاريخ التسلم</span></th>
                <th><span class="cellcontent">تاريخ الجلسة</span></th>
                <th><span class="cellcontent">ملاحظات</span></th>
                <th><span class="cellcontent">الإجراءات</span></th>
                </tr>
            </thead>
            <tbody>

                @if (isset($records) && !empty($records))
                    @foreach ($records as $record)
                        <tr data-record="{{ $record->id }}">
                            <td><span class="cellcontent"><input type="checkbox" class="checkboxes input-in-table" data-id="{{ $record->id }}" /></span></td>
                            <td><span class="cellcontent">{{ isset($record->number) ? $record->number : 'لا يوجد' }}</span></td>
                            <td><span class="cellcontent">{{ isset($record->pen) ? $record->pen : 'لا يوجد' }}</span></td>
                            <td><span class="cellcontent">{{ isset($record->client_id) ? Helper::getUserDetails($record->client_id)->full_name : 'لا يوجد' }}</span></td>
                            <td><span class="cellcontent">{{ isset($record->delivery_date) ? $record->delivery_date->format('m-Y') : 'لا يوجد'}}</span></td>
                            <td><span class="cellcontent">{{ isset($record->delivered_at) ? $record->delivered_at->format('m-Y') : 'لا يوجد' }}</span></td>
                            <td><span class="cellcontent">{{ isset($record->session_date) ? $record->session_date->format('m-Y') : 'لا يوجد' }}</span></td>
                            <td><span class="cellcontent">{{ isset($record->notes) ? $record->notes : 'لا يوجد' }}</span></td>
        
                            <td>
                                <span class="cellcontent">
                                    <a href="#"  class= "btn-warning-cancel action-btn bgcolor--fadebrown color--white deleteRecord" data-id="{{ $record->id }}"><i class = "fa  fa-trash-o"></i></a>
                                </span>
                            </td>
                        </tr>
                    @endforeach
                @endif

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

            // push cities IDs selected by user
            $('.checkboxes:checked').each(function() {
            allVals.push($(this).attr('data-id'));
            });

            // check if user selected nothing
            if(allVals.length <= 0) {
            confirm('إختر دفتر علي الاقل لتستطيع حذفه');
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
                        url: "{{ route('records.destroySelected') }}",
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
                            $('tr[data-record='+value+']').fadeOut();
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
                        url: "{{ url('/records/destroy') }}" +"/"+ id,
                        type: 'GET',
                        dataType: "JSON",
                        data: {
                            "id": id,
                            "_method": 'GET',
                        },
                        success: function ()
                        {
                            swal("تم الحذف!", "تم الحذف بنجاح", "success");
                            $('tr[data-record='+id+']').fadeOut();
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
            url: "{{ route('records.exportXLS') }}",
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