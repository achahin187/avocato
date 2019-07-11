@extends('layout.app')
@section('content')

<div class="col-lg-12">
  <div class="cover-inside-container margin--small-top-bottom bradius--small bshadow--1" style="background:  url( '{{asset('img/covers/dummy2.jpg')}}' ) no-repeat center center; background-size:cover;">
    <div class="add-mode">Adding mode</div>
    <div class="row">
      <div class="col-xs-12">
        <div class="text-xs-center">
          <div class="text-wraper">
            <h4 class="cover-inside-title color--gray_d">العملاء <i class="fa fa-chevron-circle-right"></i>
              <h4 class="cover-inside-title color--gray_d">محتوى </h4>
              <h3 class="cover-inside-title color--gray_d">افراد - شركات </h3>
            </h4>
          </div>
        </div>
      </div>
      <div class="cover--actions">
      </div>
    </div>
  </div>
</div>

<div class="row">

  {{--  Start Form  --}}

  <form action="{{ route('ind.com.store') }}" method="POST" enctype="multipart/form-data">
    {{ csrf_field() }}

    {{-- Start alert messages --}}
    <div class="col-lg-12">
      @if (Session::has('success'))
        <div class="alert alert-success text-center">{{ Session::get('success') }}</div>
      @endif

      @if (Session::has('warning'))
        <div class="alert alert-warning text-center">{{ Session::get('warning') }}</div>
      @endif

    </div>

    <div class="col-lg-12">
      <div class="cardwrap bgcolor--white bradius--noborder   bshadow--1 padding--small margin--small-top-bottom">
        
        {{--  Company Code  --}}
        <div class="col-md-3 col-sm-4 col-xs-12">
          <div class="master_field">
            <label class="master_label mandatory" for="license_type">كود الشركة</label>
            <select name="company_code" class="master_input select2" id="company_code" style="width:100%;">
              
              {{-- Defualt useless select option --}}
              <option value="-1" selected disabled hidden>إختر كود الشركة</option>

              @foreach ($companies as $company)
                <option id="comcode" value="{{ $company->id }}" data-id="{{ $company->name }}">{{ $company->full_name .' - '. $company->code }}</option>
              @endforeach
              
            </select>
            {{--  Error  --}}
            @if ($errors->has('company_code'))
              <span class="master_message color--fadegreen">{{ $errors->first('company_code') }}</span>
            @endif
          </div>
          
        </div>

        {{--  Name  --}}
        <div class="col-md-3 col-sm-4 col-xs-12">
          <div class="master_field">
            <label class="master_label mandatory" for="comp_name">اسم الشركة</label>
            <input name="company_name" value="{{ old('company_name') }}" class="master_input" type="text" readonly placeholder="اسم الشركة .." id="company_name">            
             {{--  Error  --}}            
              @if ($errors->has('company_name'))             
                <span class="master_message color--fadegreen">{{ $errors->first('company_name') }}</span>       
              @endif
          </div>
        </div>

        {{--  Individual Code  --}}
        <div class="col-md-3 col-sm-4 col-xs-12">
          <div class="master_field">
            <label class="master_label" for="client_code">كود العميل</label>
            <input name="ind_code" value="{{ old('ind_code') }}" class="master_input" type="text" placeholder="كود العميل .." id="client_code" disabled="true">
          </div>
        </div>

        {{--  Individual Name  --}}
        <div class="col-md-3 col-sm-4 col-xs-12">
          <div class="master_field">
            <label class="master_label" for="client_name">اسم العميل</label>
            <input name="ind_name" value="{{ old('ind_name') }}" class="master_input" type="text" placeholder="اسم العميل .." id="client_name">
            {{--  Error  --}}            
              @if ($errors->has('ind_name'))             
                <span class="master_message color--fadegreen">{{ $errors->first('ind_name') }}</span>       
              @endif
          </div>
        </div>

        {{--  Password  --}}
        <div class="col-md-3 col-sm-4 col-xs-12">
          <div class="master_field">
            <label class="master_label mandatory" for="password">كلمة المرور</label>
            <input name="password" value="{{ $password }}" class="master_input" type="text" placeholder="كلمة المرور .." id="password" readonly>             
            
          </div>
        </div>

        {{--  Gender  --}}
        <div class="col-md-3 col-sm-4 col-xs-12">     
          <div class="master_field">
            <label class="master_label mandatory" for="client_gender">النوع</label>
            <select name="gender" class="master_input select2" id="client_gender" style="width:100%;">
              <option value="1">ذكر</option>
              <option value="2">انثى</option>
            </select>             
            {{--  Error  --}}             
            @if ($errors->has('gender'))               
              <span class="master_message color--fadegreen">{{ $errors->first('gender') }}</span>             
            @endif
          </div>
        </div>

        {{--  Job  --}}
        <div class="col-md-3 col-sm-4 col-xs-12">
          <div class="master_field">
            <label class="master_label mandatory" for="client_job">المسمى الوظيفي </label>
            <input name="job" value="{{ old('job') }}" class="master_input" type="text" placeholder="المسمى الوظيفي  .." id="client_job">             
            {{--  Error  --}}             
            @if ($errors->has('job'))               
              <span class="master_message color--fadegreen">{{ $errors->first('job') }}</span>             
            @endif
          </div>
        </div>

        {{--  Address  --}}
        <div class="col-md-3 col-sm-4 col-xs-12">
          <div class="master_field">
            <label class="master_label mandatory" for="client_address">عنوان العميل</label>
            <input name="address" value="{{ old('address') }}" class="master_input" type="text" placeholder="عنوان العميل .." id="client_address">             
            {{--  Error  --}}             
            @if ($errors->has('address'))               
            <span class="master_message color--fadegreen">{{ $errors->first('address') }}</span>             
            @endif
          </div>
        </div>

        {{--  National id  --}}
        <div class="col-md-3 col-sm-4 col-xs-12">
          <div class="master_field">
            <label class="master_label mandatory" for="client_id">الرقم القومى</label>
            <input name="national_id" value="{{ old('national_id') }}" class="master_input" type="number" placeholder="الرقم القومى" id="client_id">             
            {{--  Error  --}}             
            @if ($errors->has('national_id'))               
            <span class="master_message color--fadegreen">{{ $errors->first('national_id') }}</span>             
            @endif
          </div>
        </div>

        {{--  Nationality  --}}
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

        {{--  Birthday  --}}
        <div class="col-md-3 col-sm-4 col-xs-12">
          <div class="master_field">
            <label class="master_label mandatory" for="client_birth">تاريخ الميلاد</label>
            <input name="birthday" value="{{ old('birthday') }}" class="datepicker master_input" type="text" placeholder="ادخل تاريخ الميلاد" id="client_birth">             
            {{--  Error  --}}            
             @if ($errors->has('birthday'))              
              <span class="master_message color--fadegreen">{{ $errors->first('birthday') }}</span>        
                   @endif
          </div>
        </div>

        {{--  Phone  --}}
        <div class="col-md-3 col-sm-4 col-xs-12">
          <div class="master_field">
            <label class="master_label" for="client_tel">رقم الهاتف</label>
            <input name="phone" value="{{ old('phone') }}" class="master_input" type="number" placeholder="0212345678" id="client_tel">          
              {{--  Error  --}}         
              @if ($errors->has('phone'))          
                <span class="master_message color--fadegreen">{{ $errors->first('phone') }}</span>      
              @endif
          </div>
        </div>

        {{--  Mobile  --}}
        <div class="col-md-6 col-sm-4 col-xs-12">
          <div class="master_field">
            <label class="master_label mandatory" for="client_mob">رقم الهاتف الجوال</label>
            <div class="col-md-3">
            <select name="tele_code" class="master_input select2" id="tele_code"  style="width:100%;">
            @foreach($nationalities as $code)
            
            <option value="{{$code['tele_code']}}">{{$code['tele_code']}}</option>
            
            @endforeach
            </select>
            </div>
            <div class="col-md-9">
            <input name="cellphone" value="{{ old('cellphone') }}" class="master_input" type="number" placeholder="1234567890" id="mob"><span class="master_message color--fadegreen">
                        @if ($errors->has('cellphone'))
                        {{ $errors->first('cellphone')}}
                        @endif</span>
            </div>
          </div>
        </div>

        {{--  email  --}}
        <div class="col-md-3 col-sm-4 col-xs-12">
          <div class="master_field">
            <label class="master_label" for="client_email">البريد الالكترونى</label>
            <input name="email" value="{{ old('email') }}"  class="master_input" type="email" placeholder="البريد الالكترونى" id="client_email">             
            {{--  Error  --}}             
              @if ($errors->has('email'))               
                <span class="master_message color--fadegreen">{{ $errors->first('email') }}</span>             
              @endif
          </div>
        </div>

        {{--  Personal Image  --}}
        <div class="col-md-3 col-sm-4 col-xs-12">
          <div class="master_field">
            <label class="master_label mandatory" for="client_photo">صورة شخصية</label>
            <div class="file-upload">
              <div class="file-select">
                <div class="file-select-name" id="noFile">اضغط هنا لرفع الصورة الشخصية للعميل </div>
                <input class="chooseFile" type="file" name="personal_image" id="client_photo">
              </div>
            </div>             
            {{--  Error  --}}             
            @if ($errors->has('personal_image'))               
              <span class="master_message color--fadegreen">{{ $errors->first('personal_image') }}</span>             
            @endif
          </div>
        </div>

        {{--  discount percentage  --}}
        <div class="col-md-3 col-sm-4 col-xs-12">
          <div class="master_field">
            <label class="master_label" for="discount">نسبة الخصم </label>
            <input name="discount_percentage" value="{{ old('discount_percentage') }}"  class="master_input" type="number" placeholder="%" id="discount">             
            {{--  Error  --}}             
            @if ($errors->has('discount_percentage'))               
              <span class="master_message color--fadegreen">{{ $errors->first('discount_percentage') }}</span>             
            @endif
          </div>
        </div>

        {{--  Activation  --}}
        <div class="col-md-3 col-sm-4 col-xs-12">
          <label class="master_label">تفعيل العميل</label>
          <div class="master_field">       
            <input class="icon" type="radio" name="activate" id="radbtn_2" value="1" checked="true">
            <label for="radbtn_2">مفعل</label>
            <input class="icon" type="radio" name="activate" id="radbtn_3" value="0">
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
        {{--  Package info  --}}
      <div class="cardwrap bgcolor--white bradius--noborder   bshadow--1 padding--small margin--small-top-bottom">

          {{--  Start date  --}}
          <div class="col-md-3 col-sm-4 col-xs-12">
            <div class="master_field">
              <label class="master_label mandatory" for="license_start_date">تاريخ بدء التعاقد</label>
              <input name="start_date" value="{{ old('start_date') }}" class=" master_input" type="text" placeholder="إختر تاريخ بدأ التعاقد" id="ddate">
              
              @if ($errors->has('start_date'))
                <span class="master_message color--fadegreen">{{ $errors->first('start_date') }}</span>
              @endif
              
            </div>
          </div>

          {{--  End date  --}}
          <div class="col-md-3 col-sm-4 col-xs-12">
            <div class="master_field">
              <label class="master_label mandatory" for="license_end_date">تاريخ  نهاية التعاقد</label>
              <input name="end_date" value="{{ old('end_date') }}" class=" master_input" type="text" placeholder="إختر تاريخ نهاية التعاقد" id="ddate">
              
              @if ($errors->has('end_date'))
                <span class="master_message color--fadegreen">{{ $errors->first('end_date') }}</span>
              @endif
              
            </div>
          </div>

          {{--  Subscriptions type  --}}
          <div class="col-md-3 col-sm-4 col-xs-12">
            <div class="master_field">
              <label class="master_label mandatory" for="license_type">نوع التعاقد</label>
              <select name="bouquet_id" class="master_input select2" id="license_type" style="width:100%;" id="bouquet_id" onchange="get_payment_method(this.value)">
                  <option selected disabled>اختر الباقه</option>
                @foreach ($bouquets as $types)
                  <option value="{{ $types->id }}">{{$types->name}}</option>
                @endforeach
                
              </select>
              
              @if ($errors->has('bouquet_id'))
                <span class="master_message color--fadegreen">{{ $errors->first('bouquet_id') }}</span>
              @endif
              
            </div>
          </div>

          {{--  Subscriptions duration  --}}
          <div class="col-md-3 col-sm-4 col-xs-12">
            <div class="master_field">
              <label class="master_label mandatory" for="license_period">مدة التعاقد</label>
              <input name="duration" value="{{ old('duration') ? old('duration') : '0' }}" min="0" class="master_input disScroll" type="number" placeholder="0" id="license_period">
            
              @if ($errors->has('duration'))
                <span class="master_message color--fadegreen">{{ $errors->first('duration') }}</span>
              @endif
              
            </div>
          </div>

          {{--  Subscribtion value  --}}
          <div class="col-md-3 col-sm-4 col-xs-12">
            <div class="master_field">
              <label class="master_label mandatory" for="license_fees">قيمة التعاقد</label>
              <input name="value" value="{{ old('value') ? old('value') : '0' }}" min="0" class="master_input disScroll" type="number" placeholder="قيمة التعاقد" id="license_fees" >
              
              @if ($errors->has('value'))
                <span class="master_message color--fadegreen">{{ $errors->first('value') }}</span>
              @endif
              
            </div>
          </div>

          {{--  Number of payments  --}}
          <div class="col-md-3 col-sm-4 col-xs-12">
            <div class="master_field">
              <label class="master_label mandatory" for="number_of_installments">عدد الاقساط</label>
            <input name="number_of_installments" value="0" min="0" class="master_input disScroll" type="number" placeholder="عدد الاقساط" id="number_of_installments" required readonly>

                @if ($errors->has('number_of_installments'))
                  <span class="master_message color--fadegreen">{{ $errors->first('number_of_installments') }}</span>
                @endif
            </div>
          </div>

          <div class="col-md-3 col-sm-4 col-xs-12">
            <div class="master_field">
              <label class="master_label mandatory" for="payment_method_id">طريقه الدفع</label>
            <select name="payment_method" class="master_input disScroll"  required id="payment_method_id" required>

               </select>
               @if ($errors->has('payment_method'))
                <span class="master_message color--fadegreen">{{ $errors->first('payment_method') }}</span>
              @endif
            </div>
          </div>
          <div class="col-md-3 col-sm-4 col-xs-12" id="company_count" hidden>
            <div class="master_field">
              <label class="master_label mandatory" for="payment_method_id">عدد الشركه </label>
            <select name="price_method" class="master_input disScroll"  required id="price_method_id" required >

               </select>
               @if ($errors->has('price_method'))
                <span class="master_message color--fadegreen">{{ $errors->first('price_method') }}</span>
              @endif
            </div>
          </div>
          <div class="clearfix"></div>

        {{--  Generated input fields  --}}
        <div id="generated">
        </div>


        <div class="clearfix"></div>
        <div class="col-md-2 col-md-3 col-sm-4 col-xs-12">
          <button class="master-btn undefined btn-block color--white bgcolor--fadepurple bradius--small bshadow--0" type="submit"><i class="fa fa-save"></i><span>حفظ</span>
          </button>
        </div>
        <div class="col-md-2 col-md-3 col-sm-4 col-xs-12">
          <button class="master-btn undefined btn-block color--white bgcolor--fadebrown bradius--small bshadow--0" type="submit"><i class="fa fa-times"></i><span>الغاء</span>
          </button>
        </div>
        <div class="clearfix"></div><br>
      </div>
    </div>
  </form>
  {{--  End Form  --}}

</div>

  <!-- <script>
    $(document).ready(function() {
      
      // get number of payments if page reloaded
      var NumberOfPayments = $('#license_num').val();  

        if(NumberOfPayments != '') {
          for(i=0; i<NumberOfPayments; i++) {

            var j = i+1;
            // payId = payment1, payment2, payment3... || data-id = 1, 2, 3, 4...
            $('#generated').append('<div class="col-md-4 col-xs-12">\
                                      <div class="master_field">\
                                        <label class="master_label mandatory" for="premium1_amount">'+ 'قيمة القسط رقم ' + j + '</label>\
                                        <input class="master_input disScroll" name="payment['+i+']" data-id="'+ j + '" type="number" placeholder="'+ 'قيمة القسط رقم ' + j + '" id="premium1_amount">\
                                      </div>\
                                      </div>\
                                      <div class="col-md-4 col-xs-12">\
                                        <div class="master_field">\
                                        <label class="master_label mandatory" for="premium1_date">'+ 'تاريخ سداد القسط رقم ' + j + '</label>\
                                          <input name="payment_date['+i+']" class="datepicker master_input" type="text" placeholder="إختر تاريخ السداد" id="ddate" required>\
                                        </div>\
                                      </div>\
                                      <div class="col-md-4 col-xs-12">\
                                        <div class="master_field">\
                                        <label class="master_label">'+ 'حالة القسط رقم ' + j + '</label>\
                                      <div class="radio-inline">\
                                        <input type="radio" name="payment_status['+i+']" value="1">\
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

      // generate number of input fields dynamicly 
      $('#license_num').on("keyup change", function() {
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
                                        <input class="master_input disScroll" name="payment['+i+']" data-id="'+ j + '" type="number" placeholder="'+ 'قيمة القسط رقم ' + j + '" id="premium1_amount">\
                                      </div>\
                                      </div>\
                                      <div class="col-md-4 col-xs-12">\
                                        <div class="master_field">\
                                        <label class="master_label mandatory" for="premium1_date">'+ 'تاريخ سداد القسط رقم ' + j + '</label>\
                                          <input name="payment_date['+i+']" class="datepicker master_input" type="text" placeholder="إختر تاريخ السداد" id="ddate" required>\
                                        </div>\
                                      </div>\
                                      <div class="col-md-4 col-xs-12">\
                                        <div class="master_field">\
                                        <label class="master_label">'+ 'حالة القسط رقم ' + j + '</label>\
                                      <div class="radio-inline">\
                                        <input type="radio" name="payment_status['+i+']" value="1">\
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
      
      $(function() {
          $('#company_code').on('change click', function(){
            $('#company_name').val($('#company_code option:selected').data('id'));
          });
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
  <script>
  $(document).ready(function() {
        $('#license_start_date').datepicker({
          onSelect: function(dateText, inst){
              $('#license_end_date').datepicker('option', 'minDate', new Date(dateText));
          },
      });

      $('#license_end_date').datepicker({
          onSelect: function(dateText, inst){
              $('#license_start_date').datepicker('option', 'maxDate', new Date(dateText));
          }
      });
  });
  </script> -->

@endsection
@section('js')
<script>
function get_price_method(id)
  {
    // var id = $('#bouquet_id').val();
    // alert(id);
    $('#company_count').show();
    if(id != -1)
    {
      $.ajax(
          {
              url: "{{ url('/bouquet_price') }}" +"/"+ id,
              type: 'GET',
              dataType: "JSON",
              data: {
                  "id": id,
                  "_method": 'GET',
              },
              success: function (data)
              {
                var options = '<option selected disabled>select price method..</option>';
                  $.each(data, function( index, value ) {
                    options +='<option value="'+value["id"]+'">'+value["count_from"]+'to'+value["count_to"]+'</option>';
                    //  alert(index);
                    });
              
              $('#price_method_id').find('option').remove().end().append(options);
              
              // set_license_fees(id);
                
              }
          });
    }

  }
  function bouquet_type(id)
  {
    // alert(id);
    $.ajax(
          {
              url: "{{ url('/bouquet_type') }}" +"/"+ id,
              type: 'GET',
              dataType: "JSON",
              data: {
                  "id": id,
                  "_method": 'GET',
              },
              success: function (data)
              {
                if(data == 0)
                {
                  set_license_fees_ind();
                }
                else
                {
                  get_price_method(id);
                }
              
              // set_license_fees(id);
              }
          }); 
  }
  function get_payment_method(id )
  {
    // var id = $('#bouquet_id').val();
    // alert(id);
    if(id != -1)
    {
      $.ajax(
          {
              url: "{{ url('/bouquet_payment') }}" +"/"+ id,
              type: 'GET',
              dataType: "JSON",
              data: {
                  "id": id,
                  "_method": 'GET',
              },
              success: function (data)
              {
                // alert(id);
                bouquet_type(id);
                var options = '<option selected disabled>select payment method..</option>';
                  $.each(data, function( index, value ) {
                    options +='<option value="'+value["payment"]["id"]+'">'+value["payment"]["name"]+'</option>';
                    //  alert(index);
                    });
              
              $('#payment_method_id').find('option').remove().end().append(options);
              
              }
          });
    }

  }
 
  function set_license_fees()
  {
    var discount = $('#client_discount').val();
    var price = $('#price_method_id').val();
    var id = $('#bouquet_id').val();
                //  alert(discount);

    $.ajax(
    {
        url: "{{ url('/bouquet_price_value') }}" +"/"+ id + "/" + discount +"/" + price,
        type: 'GET',
        dataType: "JSON",
        data: {
            // "id": id,
            // "_method": 'GET',
        },
        success: function (data)
        {
          // alert(data);
          $('#license_fees').val(data);
          // console.log(data);
        }
        });
}

function set_license_fees_ind()
  {
    var discount = $('#client_discount').val();
    // var price = $('#price_method_id').val();
    var id = $('#bouquet_id').val();
                //  alert(discount);

    $.ajax(
    {
        url: "{{ url('/bouquet_payment_value') }}" +"/"+ id + "/" + discount ,
        type: 'GET',
        dataType: "JSON",
        data: {
            // "id": id,
            // "_method": 'GET',
        },
        success: function (data)
        {
          // alert(data);
          $('#license_fees').val(data);
          // console.log(data);
        }
        });
}
   $('#price_method_id').on("change", function(){
       set_license_fees();
   });

  </script>
  <script>

    $(document).ready(function() {
      var NumberOfPayments ;
      var numberOfInstallment ; 
      $('#payment_method_id').change( function(){
        var payment_method = $(this).find(":selected").val();
        var duration = $('#license_period').val();
        // alert(duration);
        if(payment_method == 1)
        {
          numberOfInstallment = duration * 12 ;
          // alert(numberOfInstallment);
          $('#number_of_installments').val(numberOfInstallment); 
        }
        else if(payment_method == 2)
        {
          numberOfInstallment = duration * 4 ;
          $('#number_of_installments').val(numberOfInstallment); 
        }
        else if(payment_method == 3)
        {
          numberOfInstallment = duration * 2 ;
          $('#number_of_installments').val(numberOfInstallment); 
        }
        else
        {
          numberOfInstallment = duration  ;
          $('#number_of_installments').val(numberOfInstallment);  
        }
        set_number_of_installment();
        set_price_for_each_installment();
      });
       //all installments price value should be equal to value of bouquet 
       $('#license_fees').on("keyup", function() {
         set_price_for_each_installment();
       });
       function set_price_for_each_installment()
       {
        var price_for_each_installment = $('#license_fees').val() / numberOfInstallment ; 
        
         for(i= 0 ; i < numberOfInstallment ; i++)
         {
          // alert('#payment['+i+'][price]');
           $('#payment['+i+'][price]').val(price_for_each_installment);
         }
       }
       function set_number_of_installment()
       {
        NumberOfPayments = $('#number_of_installments').val();   // get number of payments

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
                                        <input required class="master_input disScroll" name="payment['+i+'][price]" data-id="'+ j + '" type="number" placeholder="'+ 'قيمة القسط رقم ' + j + '" id="payment['+i+'][price]">\
                                      </div>\
                                      </div>\
                                      <div class="col-md-4 col-xs-12">\
                                        <div class="master_field">\
                                        <label class="master_label mandatory" for="premium1_date">'+ 'تاريخ سداد القسط رقم ' + j + '</label>\
                                          <input required name="payment['+i+'][actuall_start_date]" class="datepicker master_input" type="text" placeholder="إختر تاريخ السداد" id="ddate">\
                                        </div>\
                                      </div>\
                                      <div class="col-md-4 col-xs-12">\
                                        <div class="master_field">\
                                        <label class="master_label">'+ 'حالة القسط رقم ' + j + '</label>\
                                      <div class="radio-inline">\
                                        <input type="radio" name="payment['+i+'][payment_status]" value="1" >\
                                        <label>نعم</label>\
                                      </div>\
                                      <div class="radio-inline">\
                                        <input type="radio" name="payment['+i+'][payment_status]" value="0" checked>\
                                        <label>لا</label>\
                                      </div>\
                                    </div>\
                                  </div>');
          }
        } else {
          $('#generated div').remove();
        }
       }
      // generate number of input fields dynamicly 
      // $('#number_of_installments').on("keyup", function() {
        
      // });
      
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
  <script type="text/javascript">
 
      $(function(){
        dateRange('start_date','end_date')
      })
  </script>
  

@endsection