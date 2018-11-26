@extends('layout.app')
@section('content')

<div class="row">
  {{--  Start cover  --}}
  <div class="col-lg-12">
    <div class="cover-inside-container margin--small-top-bottom bradius--small bshadow--1" style="background:  url( '{{asset('img/covers/dummy2.jpg')}}' ) no-repeat center center; background-size:cover;">
      <div class="add-mode">Adding mode</div>
      <div class="row">
        <div class="col-xs-12">
          <div class="text-xs-center">
            <div class="text-wraper">
              <h4 class="cover-inside-title color--gray_d">العملاء <i class="fa fa-chevron-circle-right"></i>
                <h4 class="cover-inside-title color--gray_d">محتوى </h4>
                <h3 class="cover-inside-title color--gray_d">الشركات </h3>
              </h4>
            </div>
          </div>
        </div>
        <div class="cover--actions">
        </div>
      </div>
    </div>
  </div>
  {{--  End cover  --}}

   {{--  Flash messages  --}}
  <div class="col-lg-12">
    {{--  Success  --}}
    @if (Session::has('success'))
      <div class="alert alert-warning text-center">
        <strong>{{ Session::get('success') }}</strong>  
      </div>
    @endif

    {{--  Warning  --}}
    @if (Session::has('warning'))
      <div class="alert alert-warning text-center">
        <strong>{{ Session::get('warning') }}</strong>  
      </div>
    @endif

  </div>

  {{--  Start add company form  --}}
  <form action="{{ route('companies.store') }}" method="POST" enctype="multipart/form-data" >
    {{ csrf_field() }}

    <div class="col-lg-12">
      <div class="cardwrap bgcolor--white bradius--noborder   bshadow--1 padding--small margin--small-top-bottom">
        {{--  Code  --}}
        <div class="col-md-3 col-sm-4 col-xs-12">
          <div class="master_field">
            <label class="master_label" for="comp_code">كود الشركة</label>
            <input name="code" disabled readonly class="master_input" type="text" placeholder="كود الشركة .." id="comp_code">
          </div>
        </div>
        {{--  Password  --}}
        <div class="col-md-3 col-sm-4 col-xs-12">
          <div class="master_field">
            <label class="master_label" for="password">كلمة المرور</label>
            <input name="password" value="{{ $password }}" readonly class="master_input" type="text" placeholder="كلمة المرور .." id="password">
          </div>
        </div>

        {{--  company name  --}}
        <div class="col-md-3 col-sm-4 col-xs-12">
          <div class="master_field">
            <label class="master_label mandatory" for="comp_name">اسم الشركة</label>
            <input name="name" value="{{ old('name') }}"  class="master_input" type="text" placeholder="اسم الشركة .." id="comp_name">
              {{--  Error  --}}
              @if ($errors->has('name'))
                <span class="master_message color--fadegreen">{{ $errors->first('name') }}</span>
              @endif
          </div>

          
        </div>

        {{--  nationality  --}}
        <div class="col-md-3 col-sm-4 col-xs-12">
          <div class="master_field">
            <label class="master_label mandatory" for="license_type">جنسية الشركة</label>
            <select name="nationality" class="master_input select2" id="license_type" style="width:100%;">
                
              @foreach ($nationalities as $nat)
                <option value="{{ $nat->id }}">{{ (Helper::localizations('geo_countries', 'nationality', $nat->id)) ?Helper::localizations('geo_countries', 'nationality', $nat->id) : $nat->nationality}}</option>
              @endforeach
              
            </select>
            {{--  Error  --}}
            @if ($errors->has('nationality'))
              <span class="master_message color--fadegreen">{{ $errors->first('nationality') }}</span>
            @endif
          </div>
          
        </div>

        {{--  address  --}}
        <div class="col-md-3 col-sm-4 col-xs-12">
          <div class="master_field">
            <label class="master_label mandatory" for="comp_address">عنوان الشركة</label>
            <input name="address" value="{{ old('address') }}"  class="master_input" type="text" placeholder="عنوان الشركة .." id="comp_address">
        
          {{--  Error  --}}
          @if ($errors->has('address'))
              <span class="master_message color--fadegreen">{{ $errors->first('address') }}</span>
            @endif
          </div>
        </div>
        
        {{--  commercial registration number  --}}
        <div class="col-md-3 col-sm-4 col-xs-12">
          <div class="master_field">
            <label class="master_label mandatory" for="comp_trade_num">رقم السجل التجارى</label>
            <input name="commercial_registration_number" value="{{ old('commercial_registration_number') }}"  class="master_input" type="text" placeholder="رقم السجل التجارى .." id="comp_trade_num">
          
          {{--  Error  --}}
          @if ($errors->has('commercial_registration_number'))
              <span class="master_message color--fadegreen">{{ $errors->first('commercial_registration_number') }}</span>
            @endif
          </div>
        </div>

        {{--  Phone  --}}
        <div class="col-md-3 col-sm-4 col-xs-12">
          <div class="master_field">
            <label class="master_label mandatory" for="comp_tel">رقم الهاتف</label>
            <input name="phone" value="{{ old('phone') }}"  class="master_input" type="number" placeholder="رقم الهاتف" id="comp_tel">
          
          {{--  Error  --}}
          @if ($errors->has('phone'))
              <span class="master_message color--fadegreen">{{ $errors->first('phone') }}</span>
            @endif
          </div>
        </div>

        {{--  Mobile  --}}
        <div class="col-md-3 col-sm-4 col-xs-12">
          <div class="master_field">
            <label class="master_label mandatory" for="comp_mob">رقم الهاتف الجوال</label>
            <input name="mobile" value="{{ old('mobile') }}"  class="master_input" type="number" placeholder="رقم الهاتف الجوال" id="comp_mob">
            {{--  Error  --}}
          @if ($errors->has('mobile'))
              <span class="master_message color--fadegreen">{{ $errors->first('mobile') }}</span>
            @endif
          </div>
          
        </div>

        {{--  Fax  --}}
        <div class="col-md-3 col-sm-4 col-xs-12">
          <div class="master_field">
            <label class="master_label mandatory" for="fax_num">رقم الفاكس</label>
            <input name="fax" value="{{ old('fax') }}"  class="master_input" type="number" placeholder="رقم الفاكس" id="fax_num">
            {{--  Error  --}}
          @if ($errors->has('fax'))
              <span class="master_message color--fadegreen">{{ $errors->first('fax') }}</span>
            @endif
          </div>
          
        </div>

        {{--  website  --}}
        <div class="col-md-3 col-sm-4 col-xs-12">
          <div class="master_field">
            <label class="master_label mandatory" for="comp_website">موقع الشركة علي الانترنت</label>
            <input name="website" value="{{ old('website') }}"  class="master_input" type="text" placeholder="موقع الشركة على الانترنت .." id="comp_website">
            {{--  Error  --}}
          @if ($errors->has('website'))
              <span class="master_message color--fadegreen">{{ $errors->first('website') }}</span>
            @endif
          </div>
          
        </div>

        {{--  legal representative name  --}}
        <div class="col-md-3 col-sm-4 col-xs-12">
          <div class="master_field">
            <label class="master_label mandatory" for="rep_name">اسم الممثل القانونى للشركة</label>
            <input name="legal_representative_name" value="{{ old('legal_representative_name') }}"  class="master_input" type="text" placeholder="اسم الممثل القانونى للشركة .." id="rep_name">
            {{--  Error  --}}
          @if ($errors->has('legal_representative_name'))
              <span class="master_message color--fadegreen">{{ $errors->first('legal_representative_name') }}</span>
            @endif
          </div>
          
        </div>

        {{--  work sector  --}}
        <div class="col-md-3 col-sm-4 col-xs-12">
          <div class="master_field">
            <label class="master_label mandatory" for="works_field">قطاع الأعمال </label>
            <input name="work_sector" value="{{ old('work_sector') }}"  class="master_input" type="text" placeholder="ادخل قطاع الاعمال.." id="works_field">
            {{--  Error  --}}
          @if ($errors->has('work_sector'))
              <span class="master_message color--fadegreen">{{ $errors->first('work_sector') }}</span>
            @endif
          </div>
          
        </div>

        {{-- legal representative mobile  --}}
        <div class="col-md-3 col-sm-4 col-xs-12">
          <div class="master_field">
            <label class="master_label mandatory" for="rep_tel">رقم تليفون الممثل القانونى للشركة</label>
            <input name="legal_representative_mobile" value="{{ old('legal_representative_mobile') }}"  class="master_input" type="number" placeholder="رقم تليفون الممثل القانونى للشركة" id="rep_tel">
            {{--  Error  --}}
          @if ($errors->has('legal_representative_mobile'))
              <span class="master_message color--fadegreen">{{ $errors->first('legal_representative_mobile') }}</span>
            @endif
          </div>
          
        </div>

        {{--  email  --}}
        <div class="col-md-3 col-sm-4 col-xs-12">
          <div class="master_field">
            <label class="master_label" for="comp_email">البريد الالكترونى</label>
            <input name="email" value="{{ old('email') }}"  class="master_input" type="email" placeholder="البريد الالكترونى" id="comp_email">
          {{--  Error  --}}
          @if ($errors->has('email'))
              <span class="master_message color--fadegreen">{{ $errors->first('email') }}</span>
            @endif
          </div>
          
        </div>

        {{--  Logo  --}}
        <div class="col-md-3 col-sm-4 col-xs-12">
          <div class="master_field">
            <label class="master_label mandatory" for="comp_logo">لوجو الشركة</label>
            <div class="file-upload">
              <div class="file-select">
                <div class="file-select-name" id="noFile">اضغط هنا لرفع اللوجو </div>
                <input name="logo" value="{{ old('logo') }}"  class="chooseFile" type="file" id="comp_logo">
              </div>
            </div>
            {{--  Error  --}}
          @if ($errors->has('logo'))
              <span class="master_message color--fadegreen">{{ $errors->first('logo') }}</span>
            @endif
          </div>
          
        </div>

        {{--  discount precentage  --}}
        <div class="col-xs-3">
          <div class="master_field">
            <label class="master_label mandatory" for="discount">نسبة الخصم </label>
            <input name="discount_percentage" value="{{ old('discount_percentage') }}"  class="master_input" type="number" placeholder="ادخل النسبة المئوية %" id="discount">
            
            @if($errors->has('discount_percentage'))
              <span class="master_message color--fadegreen">{{ $errors->first('discount_percentage') }}</span>
            @endif
          </div>
          
        </div>

        {{--  Activate  --}}
        <div class="col-xs-3">
          <label class="master_label">تفعيل العميل</label>
          <div class="master_field">       
            <input name="activate" class="icon" type="radio" name="icon" id="radbtn_2" value="1" checked="true">
            <label for="radbtn_2">مفعل</label>
            <input name="activate" class="icon" type="radio" name="icon" id="radbtn_3" value="0">
            <label for="radbtn_3">غير مفعل</label>
          </div>
        </div>
        <div class="clearfix"></div>
      </div>
      <div class="main-title-conts">
        <div class="caption">
          <h3>معلومات الباقة</h3>
        </div>
        <div class="actions">
        </div><span class="mainseparator bgcolor--main"></span>
      </div>
      <div class="cardwrap bgcolor--white bradius--noborder   bshadow--1 padding--small margin--small-top-bottom">
        {{--  Start date  --}}
        <div class="col-md-3 col-sm-4 col-xs-12">
          <div class="master_field">
            <label class="master_label mandatory" for="start_date">تاريخ بدء التعاقد</label>
            <input name="start_date" value="{{ old('start_date') }}"  class="datepicker master_input" type="text" placeholder="تاريخ بدء التعاقد" id="start_date">
            {{--  Error  --}}
          @if ($errors->has('start_date'))
              <span class="master_message color--fadegreen">{{ $errors->first('start_date') }}</span>
            @endif
          </div>
          
        </div>

        {{--  End date  --}}
        <div class="col-md-3 col-sm-4 col-xs-12">
          <div class="master_field">
            <label class="master_label mandatory" for="end_date">تاريخ  نهاية التعاقد</label>
            <input name="end_date" value="{{ old('end_date') }}"  class="datepicker master_input" type="text" placeholder="تاريخ  نهاية التعاقد" id="end_date">
            {{--  Error  --}}
          @if ($errors->has('end_date'))
              <span class="master_message color--fadegreen">{{ $errors->first('end_date') }}</span>
            @endif
          </div>
          
        </div>

        {{--  package type  --}}
        <div class="col-md-3 col-sm-4 col-xs-12">
          <div class="master_field">
            <label class="master_label mandatory" for="license_type">نوع الباقة</label>
            <select name="package_type_id" class="master_input select2" id="license_type" style="width:100%;">
                
              @foreach ($subscription_types as $types)
                <option value="{{ $types->id }}">{{ Helper::localizations('package_types', 'name', $types->id) }}</option>
              @endforeach
              
            </select>
            {{--  Error  --}}
          @if ($errors->has('package_type_id'))
              <span class="master_message color--fadegreen">{{ $errors->first('package_type_id') }}</span>
            @endif
          </div>
          
        </div>

        {{--  subscription_subscription_duration  --}}
        <div class="col-md-3 col-sm-4 col-xs-12">
          <div class="master_field">
            <label class="master_label mandatory" for="license_period">مدة التعاقد</label>
            <input name="subscription_duration" value="{{ old('subscription_duration') }}"  class="master_input" type="number" placeholder="0" id="license_period">
            {{--  Error  --}}
          @if ($errors->has('subscription_duration'))
              <span class="master_message color--fadegreen">{{ $errors->first('subscription_duration') }}</span>
            @endif
          </div>
          
        </div>

        {{--  value  --}}
        <div class="col-md-3 col-sm-4 col-xs-12">
          <div class="master_field">
            <label class="master_label mandatory" for="license_fees">قيمة التعاقد</label>
            <input name="subscription_value" value="{{ old('subscription_value') }}"  class="master_input" type="number" placeholder="قيمة التعاقد" id="license_fees">
            {{--  Error  --}}
          @if ($errors->has('subscription_value'))
              <span class="master_message color--fadegreen">{{ $errors->first('subscription_value') }}</span>
            @endif
          </div>
          
        </div>

        {{--  Number of installments  --}}
        <div class="col-md-3 col-sm-4 col-xs-12">
          <div class="master_field">
            <label class="master_label mandatory" for="license_num">عدد الاقساط</label>
            <input name="number_of_payments" value="{{ old('number_of_payments') }}"  class="master_input" type="number" placeholder="عدد الاقساط" id="license_num">
            {{--  Error  --}}
          @if ($errors->has('number_of_payments'))
              <span class="master_message color--fadegreen">{{ $errors->first('number_of_payments') }}</span>
            @endif
          </div>
          
        </div>

        <div class="clearfix"></div>

        {{--  Generated input fields  --}}
        <div id="generated">
        </div>

        <div class="clearfix"></div>
        <div class="col-md-2 col-md-3 col-sm-4 col-xs-12">
          <button class="master-btn undefined btn-block color--white bgcolor--fadepurple bradius--small bshadow--0" type="submit"><i class="fa fa-file"></i><span>حفظ</span>
          </button>
        </div>
        <div class="col-md-2 col-md-3 col-sm-4 col-xs-12">
          <a href="{{ route('companies') }}" class="master-btn undefined btn-block color--white bgcolor--fadeorange bradius--small bshadow--0"><i class="fa fa-times"></i><span>الغاء</span>
          </a>
        </div>
        <div class="clearfix"></div><br>
      </div>
    </div>
  </form>
  {{--  End form  --}}

</div>

  <script>
    $(document).ready(function() {

      // generate number of input fields dynamicly 
      $('#license_num').on("keyup", function() {
        var NumberOfPayments = $('#license_num').val();   // get number of payments

        $('#generated div').each(function() {
          $(this).remove();
        });

        if(NumberOfPayments != '') {
          for(i=0; i<NumberOfPayments; i++) {
            //$('#generated div').remove();
            var j = i+1;
            // payId = payment1, payment2, payment3... || data-id = 1, 2, 3, 4...
            $('#generated').append('<div class="col-md-4 col-xs-12">\
                                      <div class="master_field">\
                                        <label class="master_label mandatory" for="premium1_amount">'+ 'قيمة القسط رقم ' + j + '</label>\
                                        <input required class="master_input disScroll" name="payment['+i+']" data-id="'+ j + '" type="number" placeholder="'+ 'قيمة القسط رقم ' + j + '" id="premium1_amount">\
                                      </div>\
                                      </div>\
                                      <div class="col-md-4 col-xs-12">\
                                        <div class="master_field">\
                                        <label class="master_label mandatory" for="premium1_date">'+ 'تاريخ سداد القسط رقم ' + j + '</label>\
                                          <input required name="payment_date['+i+']" class="datepicker master_input" type="text" placeholder="إختر تاريخ السداد" id="ddate">\
                                        </div>\
                                      </div>\
                                      <div class="col-md-4 col-xs-12">\
                                        <div class="master_field">\
                                        <label class="master_label">'+ 'حالة القسط رقم ' + j + '</label>\
                                      <div class="radio-inline">\
                                        <input type="radio" name="payment_status['+i+']" value="1" >\
                                        <label>نعم</label>\
                                      </div>\
                                      <div class="radio-inline">\
                                        <input type="radio" name="payment_status['+i+']" value="0" checked>\
                                        <label>لا</label>\
                                      </div>\
                                    </div>\
                                  </div>');
          }
        } else {
          $('#generated div').remove();
        }
      });
      
      $(document).on('click', '#ddate', function(){
        $(this).datepicker({
            changeMonth: true,
            changeYear: true,
            dateFormat: "yy-mm-dd"
        }).focus();
        $(this).removeClass('datepicker'); 
      });

        $('.disScroll').on('focus', 'input[type=number]', function (e) {
          $(this).on('mousewheel.disableScroll', function (e) {
            e.preventDefault()
          })
        });

        $('.disScroll').on('blur', 'input[type=number]', function (e) {
          $(this).off('mousewheel.disableScroll')
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