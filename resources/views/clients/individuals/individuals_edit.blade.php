@extends('layout.app')
@section('content')

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
  
  <div class="col-lg-12">

    <form action="{{ route('ind.update', ['id' => $user->id]) }}" method="POST" enctype="multipart/form-data">

      {{ csrf_field() }}

      {{--  Client info  --}}
      <div class="cardwrap bgcolor--white bradius--noborder   bshadow--1 padding--small margin--small-top-bottom">
        
        {{--  Code  --}}
        <div class="col-md-3 col-sm-4 col-xs-12">
          <div class="master_field">
            <label class="master_label" for="client_code">كود العميل</label>
            <input name="code" value="{{ $user->code }}" class="master_input" type="text" placeholder="كود العميل .." id="client_code" readonly>
          </div>
        </div>

        {{--  Password  --}}
        <div class="col-md-3 col-sm-4 col-xs-12">
          <div class="master_field">
            <label class="master_label" for="password">كلمة المرور</label>
            <input name="password" value={{ $user->password }} class="master_input" type="text" placeholder="كلمة المرور .." id="password" readonly>
          </div>
        </div>

        {{--  Name  --}}
        <div class="col-md-3 col-sm-4 col-xs-12">
          <div class="master_field">
            <label class="master_label mandatory" for="client_name">اسم العميل</label>
            <input name="name" value="{{ $user->name }}" class="master_input" type="text" placeholder="اسم العميل .." id="client_name">
              
              @if ($errors->has('name'))
                <span class="master_message color--fadegreen">{{ $errors->first('name') }}</span>
              @endif
              
          </div>
        </div>

        {{--  Gender  --}}
        <div class="col-md-3 col-sm-4 col-xs-12">    
          <div class="master_field">
            <label class="master_label mandatory" for="client_type">النوع</label>
            <select name="gender" class="master_input select2" id="client_type" style="width:100%;">
              <option value="1" {{ ($user->user_detail->gender_id == 1) ? 'selected': '' }}>ذكر</option>
              <option value="2" {{ ($user->user_detail->gender_id == 2) ? 'selected': '' }}>انثى</option>
            </select>
            
            @if ($errors->has('gender'))
              <span class="master_message color--fadegreen">{{ $errors->first('gender') }}</span>
            @endif
            
          </div>
        </div>

        {{--  Job  --}}
        <div class="col-md-3 col-sm-4 col-xs-12">
          <div class="master_field">
            <label class="master_label mandatory" for="client_job">المسمى الوظيفي </label>
            <input name="job" value="{{ $user->user_detail->job_title }}" class="master_input" type="text" placeholder="المسمى الوظيفي  .." id="client_job">
            
              @if ($errors->has('job'))
                <span class="master_message color--fadegreen">{{ $errors->first('job') }}</span>
              @endif
          </div>
        </div>

        {{--  Address  --}}
        <div class="col-md-3 col-sm-4 col-xs-12">
          <div class="master_field">
            <label class="master_label mandatory" for="client_address">عنوان العميل</label>
            <input name="address" value="{{ $user->address }}" class="master_input" type="text" placeholder="عنوان العميل .." id="client_address">
            
              @if ($errors->has('address'))
                <span class="master_message color--fadegreen">{{ $errors->first('address') }}</span>
              @endif
          </div>
        </div>

        {{--  National ID  --}}
        <div class="col-md-3 col-sm-4 col-xs-12">
          <div class="master_field">
            <label class="master_label mandatory" for="client_id">الرقم القومى</label>
            <input name="national_id" value="{{ $user->user_detail->national_id }}" class="master_input disScroll" type="number" placeholder="الرقم القومى" id="client_id">
            
              @if ($errors->has('national_id'))
                <span class="master_message color--fadegreen">{{ $errors->first('national_id') }}</span>
              @endif
          </div>
        </div>

        {{--  Birthday  --}}
        <div class="col-md-3 col-sm-4 col-xs-12">
          <div class="master_field">
            <label class="master_label mandatory" for="client_birth">تاريخ الميلاد</label>
            <input name="birthday" value="{{ $user->birthdate }}" class="datepicker master_input" type="text" placeholder="إدخل تاريخ الميلاد" id="client_birth">
            
              @if ($errors->has('birthday'))
                <span class="master_message color--fadegreen">{{ $errors->first('birthday') }}</span>
              @endif
          </div>
        </div>

        {{--  Nationality  --}}
        {{--  nationality  --}}
        <div class="col-md-3 col-sm-4 col-xs-12">
          <div class="master_field">
            <label class="master_label mandatory" for="license_type">جنسية الشركة</label>
            <select name="nationality" class="master_input select2" id="license_type" style="width:100%;">
                
              @foreach ($nationalities as $nat)
                <option value="{{ $nat->item_id }}" {{ ($nat->item_id == $user->user_detail->nationality_id) ? 'selected' : '' }}>{{ $nat->value }}</option>
              @endforeach
              
            </select>
            {{--  Error  --}}
          @if ($errors->has('nationality'))
              <span class="master_message color--fadegreen">{{ $errors->first('nationality') }}</span>
            @endif
          </div>
          
        </div>

        {{--  landline phone  --}}
        <div class="col-md-3 col-sm-4 col-xs-12">
          <div class="master_field">
            <label class="master_label mandatory" for="client_tel">رقم الهاتف</label>
            <input name="phone" value="{{ $user->phone }}" min="0" class="master_input disScroll" type="number" placeholder="رقم الهاتف" id="client_tel">
            
              @if ($errors->has('phone'))
                <span class="master_message color--fadegreen">{{ $errors->first('phone') }}</span>
              @endif
          </div>
        </div>

        {{--  Mobile phone  --}}
        <div class="col-md-3 col-sm-4 col-xs-12">
          <div class="master_field">
            <label class="master_label mandatory" for="client_mob">رقم الهاتف الجوال</label>
            <input name="mobile" value="{{ $user->mobile }}" min="0" class="master_input disScroll" type="number" placeholder="رقم الهاتف الجوال" id="client_mob">
            
              @if ($errors->has('mobile'))
                <span class="master_message color--fadegreen">{{ $errors->first('mobile') }}</span>
              @endif
          </div>
        </div>

        {{--  Email  --}}
        <div class="col-md-3 col-sm-4 col-xs-12">
          <div class="master_field">
            <label class="master_label" for="client_email">البريد الالكترونى</label>
            <input name="email" value="{{ $user->email }}" class="master_input" type="email" placeholder="البريد الالكترونى" id="client_email">
          </div>
        </div>

        {{--  Work  --}}
        <div class="col-md-3 col-sm-4 col-xs-12">
          <div class="master_field">
            <label class="master_label mandatory" for="works">قطاع الأعمال </label>
            <input name="work" value="{{ $user->user_detail->work_sector }}" class="master_input" type="text" placeholder="  .." id="works">
            
              @if ($errors->has('work'))
                <span class="master_message color--fadegreen">{{ $errors->first('work') }}</span>
              @endif
          </div>
        </div>
        
        {{--  Work type  --}}
        <div class="col-md-3 col-sm-4 col-xs-12">
          <div class="master_field">
            <label class="master_label mandatory" for="works_types">نوع قطاع الأعمال </label>
            <input name="work_type" value="{{ $user->user_detail->work_sector_type }}" class="master_input" type="text" placeholder="  .." id="works_types">

            @if ($errors->has('work_type'))
                <span class="master_message color--fadegreen">{{ $errors->first('work_type') }}</span>
              @endif

          </div>
        </div>

        {{--  Personal image  --}}
        <div class="col-md-3 col-sm-4 col-xs-12">
          <div class="master_field">
            <label class="master_label mandatory" for="client_img">صورة شخصية</label>
            <div class="file-upload">
              <div class="file-select">
                <div class="file-select-name" id="noFile">اضغط هنا لرفع الصورة الشخصية للعميل </div>
                <input class="chooseFile" type="file" name="personal_image" id="client_img">
              </div>
            </div>
          </div>
        </div>

        {{--  Discount rate  --}}
        <div class="col-md-3 col-sm-4 col-xs-12">
          <div class="master_field">
            <label class="master_label mandatory" for="client_discount">نسبة الخصم </label>
            <input name="discount_rate" value="{{ $user->user_detail->discount_percentage }}" min="0" class="master_input disScroll" type="number" placeholder="%" id="client_discount">
            
              @if ($errors->has('discount_rate'))
                <span class="master_message color--fadegreen">{{ $errors->first('discount_rate') }}</span>
              @endif
          </div>
        </div>

        {{--  Activation  --}}
        <div class="col-md-3 col-sm-4 col-xs-12">
          <label class="master_label">تفعيل العميل</label>
          <div class="master_field">       
            <input class="icon" type="radio" name="activate" value="1" id="radbtn_2" {{ ($user->is_active == 1) ? 'checked' : ''  }}>
            <label for="radbtn_2">مفعل</label>
            <input class="icon" type="radio" name="activate" value="0" id="radbtn_3" {{ ($user->is_active == 0) ? 'checked' : ''  }}>
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
              <input name="start_date" value="{{ $user->subscription->start_date }}" class="datepicker master_input" type="text" placeholder="إختر تاريخ بدأ التعاقد" id="license_start_date">
              
              @if ($errors->has('start_date'))
                <span class="master_message color--fadegreen">{{ $errors->first('start_date') }}</span>
              @endif
              
            </div>
          </div>

          {{--  End date  --}}
          <div class="col-md-3 col-sm-4 col-xs-12">
            <div class="master_field">
              <label class="master_label mandatory" for="license_end_date">تاريخ  نهاية التعاقد</label>
              <input name="end_date" value="{{ $user->subscription->end_date }}" class="datepicker master_input" type="text" placeholder="إختر تاريخ نهاية التعاقد" id="license_end_date">
              
              @if ($errors->has('end_date'))
                <span class="master_message color--fadegreen">{{ $errors->first('end_date') }}</span>
              @endif
              
            </div>
          </div>

          {{--  Subscriptions type  --}}
          <div class="col-md-3 col-sm-4 col-xs-12">
            <div class="master_field">
              <label class="master_label mandatory" for="license_type">نوع التعاقد</label>
              <select name="subscription_type" class="master_input select2" id="license_type" style="width:100%;">
                
                @foreach ($subscription_types as $types)
                  <option value="{{ $types->id }}" {{ ($types->id == $user->subscription->package_type_id) ? 'selected' : '' }}>{{ $types->name }}</option>
                @endforeach
                
              </select>
              
              @if ($errors->has('subscription_type'))
                <span class="master_message color--fadegreen">{{ $errors->first('subscription_type') }}</span>
              @endif
              
            </div>
          </div>

          {{--  Subscriptions duration  --}}
          <div class="col-md-3 col-sm-4 col-xs-12">
            <div class="master_field">
              <label class="master_label mandatory" for="license_period">مدة التعاقد</label>
              <input name="subscription_duration" value="{{ $user->subscription->duration }}" min="0" class="master_input disScroll" type="number" placeholder="0" id="license_period">
            
              @if ($errors->has('subscription_duration'))
                <span class="master_message color--fadegreen">{{ $errors->first('subscription_duration') }}</span>
              @endif
              
            </div>
          </div>

          {{--  Subscribtion value  --}}
          <div class="col-md-3 col-sm-4 col-xs-12">
            <div class="master_field">
              <label class="master_label mandatory" for="license_fees">قيمة التعاقد</label>
              <input name="subscription_value" value="{{ $user->subscription->value }}" min="0" class="master_input disScroll" type="number" placeholder="قيمة التعاقد" id="license_fees">
              
              @if ($errors->has('subscription_value'))
                <span class="master_message color--fadegreen">{{ $errors->first('subscription_value') }}</span>
              @endif
              
            </div>
          </div>

          {{--  Number of payments  --}}
          <div class="col-md-3 col-sm-4 col-xs-12">
            <div class="master_field">
              <label class="master_label mandatory" for="license_num">عدد الاقساط</label>
              <input name="number_of_payments" value="{{ $user->subscription->number_of_installments }}" min="0" class="master_input disScroll" type="number" placeholder="عدد الاقساط" id="license_num" required>

                @if ($errors->has('number_of_payments'))
                  <span class="master_message color--fadegreen">{{ $errors->first('number_of_payments') }}</span>
                @endif
            </div>
          </div>
          <div class="clearfix"></div>

          {{--  Generated input fields  --}}
          <div id="generated">
              @for ($i = 0; $i < $user->subscription->number_of_installments; $i++)
              <?php $j = $i+1; ?>
              <div class="col-md-4 col-xs-12">
                  <div class="master_field">
                    <label class="master_label mandatory" for="premium1_amount">{{ 'رقم القسط رقم ' . $j }}</label>
                    <input class="master_input disScroll" name="payment[{{ $i }}]" type="number" placeholder="قيمة القسط رقم {{ $j }}" id="premium1_amount" value="{{ $installments[$i]->value }}">
                  </div>
                  </div>
                  <div class="col-md-4 col-xs-12">
                    <div class="master_field">
                    <label class="master_label mandatory" for="premium1_date">تاريخ سداد القسط رقم {{ $j }} </label>
                      <input name="payment_date[{{ $i }}]" class="datepicker master_input" type="text" placeholder="إختر تاريخ السداد" id="ddate" value="{{ $installments[$i]->payment_date }}">
                    </div>
                  </div>
                  <div class="col-md-4 col-xs-12">
                    <div class="master_field">
                    <label class="master_label">حالة القسط رقم {{ $j }}</label>
                  <div class="radiorobo 123">
                    <input type="radio" name="payment_status[{{ $i }}][0]" id="rad_{{ $i }}">
                    <label for="rad_1">نعم</label>
                  </div>
                  <div class="radiorobo 456">
                    <input type="radio" name="payment_status[{{ $i }}][1]" id="rad_{{ $j+1 }}"checked>
                    <label for="rad_2">لا</label>
                  </div>
                </div>
              </div>
              @endfor
          </div>
          
          <div class="clearfix"></div>
          <div class="col-md-2 col-xs-6">
            <button id="submit_button" class="master-btn undefined btn-block color--white bgcolor--fadepurple bradius--small bshadow--0" type="submit"><i class="fa fa-save"></i><span>حفظ</span>
            </button>
          </div>
          <div class="col-md-2 col-xs-6">
            <a href="{{ route('ind') }}" class="master-btn undefined btn-block color--white bgcolor--fadebrown bradius--small bshadow--0"><i class="fa fa-times"></i><span>الغاء</span>
            </a>
          </div>
          <div class="clearfix"></div><br>

      </div>
    </form>

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
                                        <label class="master_label mandatory" for="premium1_amount">'+ 'رقم القسط رقم ' + j + '</label>\
                                        <input class="master_input disScroll" name="payment['+i+']" data-id="'+ j + '" type="number" placeholder="'+ 'قيمة القسط رقم ' + j + '" id="premium1_amount">\
                                      </div>\
                                      </div>\
                                      <div class="col-md-4 col-xs-12">\
                                        <div class="master_field">\
                                        <label class="master_label mandatory" for="premium1_date">'+ 'تاريخ سداد القسط رقم ' + j + '</label>\
                                          <input name="payment_date['+i+']" class="datepicker master_input" type="text" placeholder="إختر تاريخ السداد" id="ddate">\
                                        </div>\
                                      </div>\
                                      <div class="col-md-4 col-xs-12">\
                                        <div class="master_field">\
                                        <label class="master_label">'+ 'حالة القسط رقم ' + j + '</label>\
                                      <div class="radiorobo 123">\
                                        <input type="radio" name="payment_status['+i+'][0]" id="rad_'+i+'" >\
                                        <label for="rad_1">نعم</label>\
                                      </div>\
                                      <div class="radiorobo 456">\
                                        <input type="radio" name="payment_status['+i+'][1]" id="rad_'+j+1+'"checked>\
                                        <label for="rad_2">لا</label>\
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

    });

    

  </script>
@endsection