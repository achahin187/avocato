@extends('layout.app')
@section('content')

    <div class="row">
        {{--  Start Header  --}}
        <div class="col-lg-12">
            <div class="cover-inside-container margin--small-top-bottom bradius--small bshadow--1"
                 style="background:  url( {{asset('img/covers/dummy2.jpg')}} ) no-repeat center center; background-size:cover;">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="text-xs-center">
                            <div class="text-wraper">
                                <h4 class="cover-inside-title color--gray_d">البيانات الأساسية <i
                                            class="fa fa-chevron-circle-right"></i>
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
                <div class="col-md-2 col-sm-3 colxs-12 pull-right">
                    <a class="master-btn color--white bgcolor--main bradius--small bshadow--0 btn-block"
                       href="#popupModal_1"><i class="fa fa-plus"></i><span>إضافة تصنيف رئيسي</span></a>
                    <a class="master-btn color--white bgcolor--main bradius--small bshadow--0 btn-block"
                       href="#popupModal_2"><i class="fa fa-plus"></i><span>إضافة تصنيف فرعي</span></a>

                    <div class="remodal-bg"></div>

                    <div class="remodal" data-remodal-id="popupModal_1" role="dialog" aria-labelledby="modal1Title"
                         aria-describedby="modal1Desc">
                        <button class="remodal-close" data-remodal-action="close" aria-label="Close"></button>
                        {{--  Start Form  --}}
                        <form action="{{ route('consult.store') }}" method="POST" class="resetForm" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div>
                                <div class="row">
                                    <div class="col-xs-12">
                                        <h3>إضافة</h3>
                                        <div class="col-xs-12">
                                            <div class="master_field">
                                                <label class="master_label" for="ID_No">ادخال تصنيف جديد للاستشارات
                                                    القانونية</label>
                                                <input name="consult_name" class="master_input" type="text"
                                                       placeholder="نصنيف جديد" id="ID_No"
                                                       value="{{ old('consult_name') }}">

                                                @if ($errors->has('consult_name'))
                                                    <span class="master_message color--fadegreen">{{ $errors->first('consult_name') }}</span>
                                                @endif

                                            </div>
                                            <div class="master_field">
                                                <input name="image" class="master_input" type="file"

                                                     required  >

                                                @if ($errors->has('image'))
                                                    <span class="master_message color--fadegreen">{{ $errors->first('image') }}</span>
                                                @endif

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <button type="reset" class="remodal-cancel" data-remodal-action="cancel">إلغاء</button>
                            <button type="submit" class="remodal-confirm">حفظ</button>
                        </form>
                    </div>
                    {{--  End Form  --}}
                    <div class="remodal" data-remodal-id="popupModal_2" role="dialog" aria-labelledby="modal1Title"
                         aria-describedby="modal1Desc">
                        <button class="remodal-close" data-remodal-action="close" aria-label="Close"></button>
                        {{--  Start Form  --}}
                        <form action="{{ route('consult.store') }}" method="POST" class="resetForm">
                            {{ csrf_field() }}
                            <div>
                                <div class="row">
                                    <div class="col-xs-12">
                                        <h3>إضافة تصنيف فرعي</h3>
                                        <div class="col-xs-12">
                                            <div class="master_field">
                                                <select class="master_input" name="parent_id">
                                                    <option value="null" selected>
                                                        اختر التصنيف الرئيسي
                                                    </option>
                                                    @foreach($mainTypes as $type)
                                                        <option value="{{$type->id}}">
                                                            {{$type->name}}
                                                        </option>
                                                    @endforeach
                                                </select>

                                                @if ($errors->has('consult_name'))
                                                    <span class="master_message color--fadegreen">{{ $errors->first('consult_name') }}</span>
                                                @endif

                                            </div>

                                            <div class="master_field">
                                                <label class="master_label" for="ID_No">ادخل التصنيف جديد
                                                </label>
                                                <input name="consult_name" class="master_input" type="text"
                                                       placeholder="نصنيف جديد" id="ID_No"
                                                       value="{{ old('consult_name') }}">

                                                @if ($errors->has('consult_name'))
                                                    <span class="master_message color--fadegreen">{{ $errors->first('consult_name') }}</span>
                                                @endif

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <button type="reset" class="remodal-cancel" data-remodal-action="cancel">إلغاء</button>
                            <button type="submit" class="remodal-confirm">حفظ</button>
                        </form>
                    </div>

                    {{--localization modal --}}
                    <div id="localization_modal" class="remodal" data-remodal-id="lang" role="dialog"
                         aria-labelledby="modal1Title" aria-describedby="modal1Desc">
                        <form role="form" action="{{route('consultations_classification_add_localization')}}"
                              method="post">
                            {{csrf_field()}}
                            <button class="remodal-close" data-remodal-action="close" aria-label="Close"></button>
                            <div>
                                <div class="row">
                                    <h4>ادخال اسم التصنيف بلغات متعددة</h4><br>
                                    <input type="hidden" id="consult_id" name="consult_id">
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
                                            <label class="master_label mandatory" for="consult_name">ادخال التصنيف
                                                باللغة المختاره</label>
                                            <input class="master_input" type="text" placeholder="اسم التصنيف"
                                                   id="consult_name" name="consult_name">
                                            <span class="master_message color--fadegreen">
                          @if($errors->has('consult_name'))
                                                    {{$errors->first('consult_name')}}
                                                @endif
                        </span>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                            <br>
                            <button class="remodal-cancel" data-remodal-action="cancel">إلغاء</button>
                            <button class="remodal-confirm" remodal-action="confirm" type="submit">حفظ</button>
                        </form>
                    </div>
                    {{-- End localization modal --}}
                </div>
                <div class="full-table">
                    <div class="remodal-bg">
                        <div class="remodal" data-remodal-id="filterModal_sponsors" role="dialog"
                             aria-labelledby="modal1Title" aria-describedby="modal1Desc">
                            <button class="remodal-close" data-remodal-action="close" aria-label="Close"></button>
                            <div>
                                <h2 id="modal1Title">فلتر</h2>
                                <div class="col-md-6">
                                    <div class="master_field">
                                        <label class="master_label mandatory" for="ID_No">التصنيف الرئيسى</label>
                                        <input class="master_input" type="text" placeholder="التصنيف الرئيسى"
                                               id="ID_No"><span class="master_message color--fadegreen">message</span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="master_field">
                                        <label class="master_label mandatory" for="ID_No">التصنيف الفرعى</label>
                                        <input class="master_input" type="text" placeholder="التصنيف الفرعى" id="ID_No"><span
                                                class="master_message color--fadegreen">message</span>
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
                            <button class="dropdown-toggle color--black bgcolor--main bradius--small bshadow--0 lang-btn"
                                    type="button" data-toggle="dropdown" id="quick_Filters_2">
                                <small>اللغات &nbsp;</small>
                                <i class="fa fa-angle-down"></i>
                            </button>
                            <div class="dropdown-menu" role="menu" aria-labelledby="quick_Filters_2" id="lang_filter">
                                <div class="quick-filter-title"><p><b>اختار</b></p></div>
                                <div class="quick-filter-content">
                                    @foreach($languages as $lang)
                                        @if($lang->id != \Session::get('AppLocale'))
                                            <div class="radiorobo">
                                                <input type="radio" id="lang_{{$lang->id}}" name="lang_id"
                                                       value="{{$lang->id}}" onclick="ChangeLang({{$lang->id}})">
                                                <label for="lang_{{$lang->id}}">{{$lang->name}}</label>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- End Language filter--}}
                    <div class="bottomActions__btns">
                        {{--  Excel button  --}}
                        <a id="exportSelected"
                           class="master-btn bradius--small padding--small bgcolor--fadeblue color--white" href="#">استخراج
                            اكسيل</a>

                        {{--  Multi deletion  --}}
                        <a id="deleteSelected"
                           class="master-btn bradius--small padding--small bgcolor--fadebrown color--white btn-warning-cancel"
                           href="#">حذف المحدد</a>

                    </div>
                    <table class="table-1">
                        <thead>
                        <tr class="bgcolor--gray_mm color--gray_d">
                            <th><span class="cellcontent">&lt;input type=&quot;checkbox&quot; name=&quot;select-all&quot; id=&quot;select-all&quot; /&gt;</span>
                            </th>
                            <th><span class="cellcontent">التصنيف</span></th>
                            <th><span class="cellcontent">الاجراءات</span></th>
                        </tr>
                        </thead>
                        <tbody>
                        {{--  Start rendering data  --}}
                        @if ( isset($consultations) && !empty($consultations) )
                            @foreach ($consultations as $consult)
                                @if($consult->name != '')
                                    <tr data-consult="{{ $consult->id }}">
                                        <td>
                      <span class="cellcontent">
                        <input type="checkbox" class="checkboxes" data-id="{{ $consult->id }}"/>
                      </span>
                                        </td>
                                        <td>
                      <span class="cellcontent">
                        {{ $consult->name ? $consult->name : 'لا يوجد' }}
                      </span>
                                        </td>
                                        <td>
                      <span class="cellcontent">   
                        <a id="add_localization" data-consult-id="{{$consult->id}}"
                           class="action-btn bgcolor--main color--white add_localization">
                          <i class="fa fa-book"></i> &nbsp; اللغات
                        </a>
                        <a class="btn-warning-cancel action-btn bgcolor--fadebrown color--white deleteRecord">
                          <i class="fa fa-trash-o"></i>
                        </a>
                      </span>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        @endif
                        {{--  End rendering data  --}}
                        </tbody>
                    </table>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
        {{--  End content  --}}
    </div>

    <script>

        $(document).ready(function () {
            // hide alert message after 4 seconds => 4000 ms
            window.setTimeout(function () {
                $(".alert").fadeTo(500, 0).slideUp(500, function () {
                    $(this).remove();
                });
            }, 4000);

            // Delete selected checkboxes
            $('#deleteSelected').click(function () {
                var allVals = [];                   // selected IDs

                // push cities IDs selected by user
                $('.checkboxes:checked').each(function () {
                    allVals.push($(this).attr('data-id'));
                });

                // check if user selected nothing
                if (allVals.length <= 0) {
                    confirm('إختر مدينة علي الاقل لتستطيع حذفها');
                } else {
                    var ids = allVals;    // join array of IDs into a single variable to explode in controller
                    var _token = "{{csrf_token()}}"
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
                        function (isConfirm) {
                            if (isConfirm) {
                                $.ajax(
                                    {
                                        url: "{{ route('consult.destroySelected') }}",
                                        type: 'POST',
                                        dataType: "JSON",
                                        data: {
                                            ids: ids,
                                            _token: _token
                                        },
                                        success: function () {
                                            swal("تم الحذف!", "تم الحذف بنجاح", "success");

                                            // fade out selected checkboxes after deletion
                                            $.each(allVals, function (index, value) {
                                                $('tr[data-consult=' + value + ']').fadeOut();
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
            $('.deleteRecord').click(function () {
                var id = $(this).closest('tr').attr('data-consult');
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
                    function (isConfirm) {
                        if (isConfirm) {
                            $.ajax(
                                {
                                    url: "{{ url('/consultations_classification/destroy') }}" + "/" + id,
                                    type: 'GET',
                                    dataType: "JSON",
                                    data: {
                                        "id": id,
                                        "_method": 'GET',
                                    },
                                    success: function () {
                                        swal("تم الحذف!", "تم الحذف بنجاح", "success");
                                        $('tr[data-consult=' + id + ']').fadeOut();
                                    }
                                });

                        } else {
                            swal("تم الإلغاء", "المعلومات مازالت موجودة :)", "error");
                        }
                    });
            });

            // Export table as Excel file
            $('#exportSelected').click(function () {
                var allVals = [];                   // selected IDs

                // push cities IDs selected by user
                $('.checkboxes:checked').each(function () {
                    allVals.push($(this).attr('data-id'));
                });

                // check if user selected nothing
                if (allVals.length <= 0) {
                    // push all IDs
                    $('.checkboxes').each(function () {
                        allVals.push($(this).attr('data-id'));
                    });
                }

                var ids = allVals.join(",");    // join array of IDs into a single variable to explode in controller

                $.ajax(
                    {
                        url: "{{ route('consult.exportXLS') }}",
                        type: 'GET',
                        data: {
                            "ids": ids,
                            "_method": 'GET',
                        },
                        success: function (response) {
                            swal("تمت العملية بنجاح!", "تم استخراج الجدول علي هيئة ملف اكسيل", "success");
                            location.href = response;
                        }
                    });
            });
            // Reset a form inside Bootstrap3 modal...
            $('.remodal-cancel').click(function () {
                $('.resetForm')[0].reset();   // reset 1st form (right form)
            });
        });

        //language filter
        $('#quick_Filters_2').click(function () {
            $('#lang_filter').toggle();
        });

        // add localization
        $('.add_localization').click(function () {
            var localization_modal = $('#localization_modal');
            var id = $(this).closest('tr').attr('data-consult');
            console.log(id);
            $('#consult_id').val(id);
            $('#localization_modal').remodal().open();
        });

        //change lang
        function ChangeLang(id) {
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
                error: function (response) {
                    console.log(response);
                }
            });
        }
    </script>

@endsection
            