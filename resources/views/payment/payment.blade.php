@extends('layout.app')
@section('content')
    <link rel="stylesheet" href="https://atfawry.fawrystaging.com/atfawry/plugin/assets/payments/css/fawrypay-payments.css">
    <!-- FawryPay Checkout Button -->
    <div class="col-md-9">
        <div class="row">
            <button type="image" onclick="checkout()" alt="pay-using-fawry" id="fawry-payment-btn"
                class="noti action-btn bgcolor--fadeorange color--white ">Pay by fawry</button>

        </div>
    </div>
    <div class="remodal-bg">
        <div class="remodal" data-remodal-id="filterModal_sponsors" role="dialog" aria-labelledby="modal1Title"
            aria-describedby="modal1Desc">

            {{-- Start filter form --}}
            <form action="{{ route('pay.filter') }}" method="POST">
                {{ csrf_field() }}

                <button class="remodal-close" data-remodal-action="close" aria-label="Close"></button>
                <div>
                    <h3 id="modal1Title">فلتر</h3>
                    {{-- Search --}}
                    <div class="col-md-6">
                        <div class="master_field">
                            <label class="master_label mandatory" for="ID_No"> بحث بالاسم اوالكود او رقم التليفون
                            </label>
                            <div class="bootstrap-timepicker">
                                <input name="search" class=" master_input" type="text" placeholder="بحث بالاسم اوالكود"
                                    id="search" value="{{ old('search') }}">
                            </div>

                            @if ($errors->has('start_date'))
                                <span class="master_message color--fadegreen">{{ $errors->first('search') }}</span>
                            @endif
                            {{--  Start date  --}}
                        </div>
                    </div>



                    {{-- Nationality --}}
                    <div class="col-md-6">
                        <div class="master_field">
                            <label class="master_label mandatory" for="nationality">الجنسية</label>

                            <select name="nationality" class="master_input select2" id="license_type" style="width:100%;">

                                <option value="-1" selected disabled hidden>اختر جنسية العميل</option>

                                @foreach ($nationalities as $nat)
                                    <option value="{{ $nat->id }}">
                                        {{ Helper::localizations('geo_countries', 'nationality', $nat->id) }}</option>
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
                <button type="submit" class="remodal-confirm">فلتر</button>

            </form>
            {{-- End filter form --}}

        </div>
    </div>
    <div class="filter__btns">
        <a class="master-btn bgcolor--main color--white bradius--small" href="#filterModal_sponsors">
            <i class="fa fa-filter"></i>filters</a>
    </div>


    <table class="table-1" id="dataTableTriggerId_001">
        <thead>
            <tr class="bgcolor--gray_mm color--gray_d">
                <th><span class="cellcontent">&lt;input type=&quot;checkbox&quot; name=&quot;select-all&quot;
                        id=&quot;select-all&quot; onclick=&quot;checkAll(this)&quot; /&gt;</span></th>
                <th><span class="cellcontent"> رقم المرجع</span></th>
                <th><span class="cellcontent"> الاسم</span></th>
                <th><span class="cellcontent"> هاتف</span></th>
                <th><span class="cellcontent">البريد الالكترونى</span></th>
                <th><span class="cellcontent">قيمه الطلب </span></th>
                <th><span class="cellcontent">قيمه الدفع</span></th>
                <th><span class="cellcontent"> طريقه الدفع</span></th>
                <th><span class="cellcontent">الحاله</span></th>
                <th><span class="cellcontent">الإجراءات</span></th>
            </tr>
        </thead>
        <tbody>

            @if (isset($filters) && !empty($filters))
                @foreach ($filters as $filter)
                    <tr data-user="{{ $filter->id }}">
                        <td><span class="cellcontent"><input type="checkbox" class="checkboxes input-in-table"
                                    data-id="{{ $filter->id }}" /></span></td>



                        {{-- Full Name --}}
                        @if ($filter->full_name)
                            <td><span class="cellcontent">{{ $filter->full_name }}</span></td>
                        @else
                            لا يوجد
                        @endif



                        {{-- Mobile --}}
                        @if ($filter->mobile)
                            <td><span class="cellcontent">{{ $filter->mobile }}</span></td>
                        @else
                            لا يوجد
                        @endif

                        <td><span class="cellcontent"><i
                                    class="fa  {{ $filter->is_active ? 'color--fadegreen fa-check' : 'fa-times' }}"></i></span>
                        </td>
                        <td>
                            <span class="cellcontent">

                                {{--  Show  --}}
                                <a href="{{ route('ind.show', $filter->id) }}" ,
                                    class="action-btn bgcolor--main color--white ">
                                    <i class="fa  fa-eye"></i>
                                </a>

                                {{--  Edit  --}}
                                <a href="{{ route('ind.edit', ['id' => $filter->id]) }}" ,
                                    class="action-btn bgcolor--fadegreen color--white ">
                                    <i class="fa  fa-pencil"></i>
                                </a>

                                {{--  Delete  --}}
                                <a href="#"
                                    class="btn-warning-cancel action-btn bgcolor--fadebrown color--white deleteRecord"
                                    data-id="{{ $filter->id }}">
                                    <i class="fa fa-trash-o"></i>
                                </a>

                            </span>
                        </td>
                    </tr>
                @endforeach
            @else
                {{-- Regular payments --}}
                @foreach ($payments as $payment)
                    <tr data-payment="{{ $payment->id }}">
                        <td><span class="cellcontent"><input type="checkbox" class="checkboxes"
                                    data-id="{{ $payment->id }}" /></span></td>

                        {{-- referenceNumber --}}
                        @if ($payment->referenceNumber)
                            <td><span class="cellcontent">{{ $payment->referenceNumber ?? '' }}</span></td>
                        @else
                            لا يوجد
                        @endif

                        {{-- Full Name --}}
                        @if ($payment->name)
                            <td><span class="cellcontent">{{ $payment->name ?? '' }}</span></td>
                        @else
                            لا يوجد
                        @endif

                        {{-- mobile --}}
                        @if ($payment->Mobile)
                            <td><span class="cellcontent">{{ $payment->Mobile }}</span></td>
                        @else
                            لا يوجد
                        @endif

                        {{-- Mail --}}
                        @if ($payment->Mail)
                            <td><span class="cellcontent">{{ $payment->Mail }}</span></td>
                        @else
                            لا يوجد
                        @endif
                        {{-- orderAmount --}}
                        @if ($payment->orderAmount)
                            <td><span class="cellcontent">{{ $payment->orderAmount ?? '' }}</span></td>
                        @else
                            لا يوجد
                        @endif
                        {{-- paymentAmount --}}
                        @if ($payment->paymentAmount)
                            <td><span class="cellcontent">{{ $payment->paymentAmount ?? '' }}</span></td>
                        @else
                            لا يوجد
                        @endif
                        {{-- paymentMethod --}}
                        @if ($payment->paymentMethod)
                            <td><span class="cellcontent">{{ $payment->paymentMethod ?? '' }}</span></td>
                        @else
                            لا يوجد
                        @endif



                        <td><span class="cellcontent"><i
                                    class="fa {{ $payment->statusCode ? ' color--fadegreen fa-check' : 'fa-times  color--fadebrown' }}"></i></span>
                        </td>
                        <td>
                            <span class="cellcontent">

                                {{--  Show  --}}
                                <a href="#" class="action-btn bgcolor--main color--white ">
                                    <i class="fa  fa-eye"></i>
                                </a>

                                {{--  Edit  --}}

                                {{--  Delete  --}}
                                <a href="#"
                                    class="btn-warning-cancel action-btn bgcolor--fadebrown color--white deleteRecord"
                                    data-id="{{ $payment->id }}">
                                    <i class="fa fa-trash-o"></i>
                                </a>

                            </span>
                        </td>

                    </tr>
                @endforeach
            @endif

        </tbody>
    </table>

    <div id="fawry-UAT"></div>
    <script src="https://atfawry.fawrystaging.com/atfawry/plugin/assets/payments/js/fawrypay-payments.js"></script>

    <script>
        function checkout() {
            const configuration = {
                locale: "en", //default en, allowed [ar, en]
                divSelector: 'fawry-UAT', //required and you can change it as desired
                mode: DISPLAY_MODE.SEPARATED, //required, allowd values [POPUP, INSIDE_PAGE, SIDE_PAGE, SEPARATED]
                onSuccess: successCallBack, //optional and not supported with separated display mode
                onFailure: failureCallBack, //optional and not supported with separated display mode
            };

            FawryPay.checkout(buildChargeRequest(), configuration);
        }

        function buildChargeRequest() {
            const chargeRequest = {
                merchantCode: 'rDCrFqHNLYI=', // the merchant account number in Fawry
                merchantRefNum: 'TEST012555Y', // order refrence number from merchant side
                customerMobile: '',
                customerEmail: '',
                customerName: 'Mohammed Hamdy',
                paymentExpiry: '16723331',
                customerProfileId: '1', // in case merchant has customer profiling then can send profile id to attach it with order as reference
                chargeItems: [{
                    itemId: '1222',
                    description: 'FAWRYTEST',
                    price: 10,
                    quantity: 1,
                    imageUrl: 'https://www.atfawry.com/ECommercePlugin/resources/images/atfawry-ar-logo.png'
                }],


                paymentMethod: '',
                returnUrl: 'https://avocatoapp.net/avocato/backend/public/payment/store_data',
                signature: '1d5efd50aed5768c1883411c6f8d4feecee5d4ad7d02a8de8d47330c4745aa40'
            };

            return chargeRequest;
        }

        function successCallBack(data) {
            console.log('handle success call back as desired, data', data);
            document.getElementById('fawryPayPaymentFrame')?.remove();
        }

        function failureCallBack(data) {
            console.log('handle failure call back as desired, data', data);
            document.getElementById('fawryPayPaymentFrame')?.remove();
        }
    </script>
    <script type="text/javascript">
        $(function() {
            $('.datepicker').datepicker({
                autoclose: true
            });
            $(".timepicker").timepicker({
                showInputs: false
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            // Delete selected checkboxes
            $('#deleteSelected').click(function() {
                var allVals = []; // selected IDs
                var token = '{{ csrf_token() }}';

                // push cities IDs selected by user
                $('.checkboxes:checked').each(function() {
                    allVals.push($(this).attr('data-id'));
                });

                // check if user selected nothing
                if (allVals.length <= 0) {
                    confirm('إختر عميل علي الاقل لتستطيع حذفه');
                } else {
                    var ids = allVals.join(
                        ","); // join array of IDs into a single variable to explode in controller

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
                        function(isConfirm) {
                            if (isConfirm) {
                                $.ajax({
                                    url: "{{ route('pay.destroySelected') }}",
                                    type: 'GET',
                                    dataType: "JSON",
                                    data: {
                                        "ids": ids,
                                        "_method": 'GET',
                                        "_token": token,
                                    },
                                    success: function() {
                                        swal("تم الحذف!", "تم الحذف بنجاح", "success");

                                        // fade out selected checkboxes after deletion
                                        $.each(allVals, function(index, value) {
                                            $('tr[data-payment=' + value + ']')
                                                .fadeOut();
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
            $('.deleteRecord').click(function() {

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
                    function(isConfirm) {
                        if (isConfirm) {
                            $.ajax({
                                url: "{{ url('/payment/destroy') }}" + "/" + id,
                                type: 'GET',
                                dataType: "JSON",
                                data: {
                                    "id": id,
                                    "_method": 'GET',
                                    "_token": token,
                                },
                                success: function() {
                                    swal("تم الحذف!", "تم الحذف بنجاح", "success");
                                    $('tr[data-payment=' + id + ']').fadeOut();
                                }
                            });

                        } else {
                            swal("تم الإلغاء", "المعلومات مازالت موجودة :)", "error");
                        }
                    });
            });


            // hide alert message after 4 seconds => 4000 ms
            window.setTimeout(function() {
                $(".alert").fadeTo(500, 0).slideUp(500, function() {
                    $(this).remove();
                });
            }, 4000)

        });
    </script>

    <script LANGUAGE="JavaScript">
        function checkAll(bx) {
            var cbs = document.getElementsByClassName('checkboxes');
            for (var i = 0; i < cbs.length; i++) {
                cbs[i].checked = bx.checked;
            }
        }
    </script>
@endsection
