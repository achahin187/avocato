@extends('layout.app')
@section('content')
    <link rel="stylesheet" href="https://atfawry.fawrystaging.com/atfawry/plugin/assets/payments/css/fawrypay-payments.css">
    <!-- FawryPay Checkout Button -->
    <button type="image" onclick="checkout()" alt="pay-using-fawry" id="fawry-payment-btn">Pay by fawry</button>
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
                chargeItems: [
                    {
                        itemId: '1222',
                        description: 'FAWRYTEST',
                        price: 10,
                        quantity: 1,
                        imageUrl: 'https://www.atfawry.com/ECommercePlugin/resources/images/atfawry-ar-logo.png'
                    }
                ],


                paymentMethod: '',
                returnUrl: 'http://localhost:8000/payment-result',
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
@endsection