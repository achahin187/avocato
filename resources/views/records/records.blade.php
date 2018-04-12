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

    {{-- Main content --}}
    <div class="col-lg-12">
        <div class="cardwrap bgcolor--white bradius--noborder   bshadow--1 padding--small margin--small-top-bottom">
        <div class="full-table">
            <div class="remodal-bg">
            <div class="remodal" data-remodal-id="filterModal_sponsors" role="dialog" aria-labelledby="modal1Title" aria-describedby="modal1Desc">
                <button class="remodal-close" data-remodal-action="close" aria-label="Close"></button>
                <div>
                <h2 id="modal1Title">فلتر</h2>
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="master_field">
                    <label class="master_label mandatory" for="record_pen"> قلم المحضرين </label>
                    <select class="master_input select2" id="record_pen" multiple="multiple" data-placeholder="قلم المحضرين " style="width:100%;" ,>
                        <option>عابدين</option>
                        <option>الدقى</option>
                    </select><span class="master_message color--fadegreen">message content</span>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="master_field">
                    <label class="master_label mandatory" for="client_name">اسم الموكل</label>
                    <input class="master_input" type="text" placeholder="اسم الموكل" id="client_name"><span class="master_message color--fadegreen">message</span>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="master_field">
                    <label class="master_label mandatory" for="date_from">تاريخ التسليم من</label>
                    <div class="bootstrap-timepicker">
                        <input class="datepicker master_input" type="text" placeholder="تاريخ التسليم" id="date_from">
                    </div><span class="master_message color--fadegreen">message content</span>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="master_field">
                    <label class="master_label mandatory" for="date_to">تاريخ التسلم الى</label>
                    <div class="bootstrap-timepicker">
                        <input class="datepicker master_input" type="text" placeholder="تاريخ التسلم" id="date_to">
                    </div><span class="master_message color--fadegreen">message content</span>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="master_field">
                    <label class="master_label mandatory" for="session_date_from">تاريخ الجلسة من</label>
                    <div class="bootstrap-timepicker">
                        <input class="datepicker master_input" type="text" placeholder="تاريخ الجلسة" id="session_date_from">
                    </div><span class="master_message color--fadegreen">message content</span>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="master_field">
                    <label class="master_label mandatory" for="session_date_to">تاريخ الجلسة الى</label>
                    <div class="bootstrap-timepicker">
                        <input class="datepicker master_input" type="text" placeholder="تاريخ الجلسة" id="session_date_to">
                    </div><span class="master_message color--fadegreen">message content</span>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="master_field">
                    <label class="master_label mandatory" for="delivery_date_from">تاريخ الإستلام من</label>
                    <div class="bootstrap-timepicker">
                        <input class="datepicker master_input" type="text" placeholder="تاريخ التسليم" id="delivery_date_from">
                    </div><span class="master_message color--fadegreen">message content</span>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="master_field">
                    <label class="master_label mandatory" for="delivery_date_to">تاريخ الإستلام الى</label>
                    <div class="bootstrap-timepicker">
                        <input class="datepicker master_input" type="text" placeholder="تاريخ التسلم" id="delivery_date_to">
                    </div><span class="master_message color--fadegreen">message content</span>
                    </div>
                </div>
                </div>
                <div class="clearfix"></div>
                <button class="remodal-cancel" data-remodal-action="cancel">الغاء</button>
                <button class="remodal-confirm" data-remodal-action="confirm">فلتر</button>
            </div>
            </div>
            <div class="filter__btns"><a class="master-btn bgcolor--main color--white bradius--small" href="#filterModal_sponsors"><i class="fa fa-filter"></i>filters</a></div>
            <div class="bottomActions__btns"><a class="master-btn bradius--small padding--small bgcolor--fadeblue color--white" href="#">استخراج اكسيل</a><a class="master-btn bradius--small padding--small bgcolor--fadebrown color--white btn-warning-cancel" href="#">حذف المحدد</a>
            </div>
            <table class="table-1">
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
                            <td><span class="cellcontent"><input type="checkbox" class="checkboxes" data-id="{{ $record->id }}" /></span></td>
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

        // hide alert message after 4 seconds => 4000 ms
        window.setTimeout(function() {
            $(".alert").fadeTo(500, 0).slideUp(500, function(){
                $(this).remove(); 
            });
        }, 4000);
    });
    
</script>

@endsection