@extends('layout.app')
@section('content')

<div class="row">

  {{--  Start Form  --}}

  <form action="{{ route('ind.com.store') }}" method="POST">
    {{ csrf_field() }}

    <div class="col-lg-12">
      <div class="cover-inside-container margin--small-top-bottom bradius--small bshadow--1" style="background:  url( '../img/covers/dummy2.jpg ' ) no-repeat center center; background-size:cover;">
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
    <div class="col-lg-12">
      <div class="cardwrap bgcolor--white bradius--noborder   bshadow--1 padding--small margin--small-top-bottom">
        
        {{--  Company Code  --}}
        <div class="col-md-3 col-sm-4 col-xs-12">
          <div class="master_field">
            <label class="master_label mandatory" for="license_type">كود الشركة</label>
            <select name="company_code" class="master_input select2" id="company_code" style="width:100%;">
                
              @foreach ($companies as $company)
                <option id="comcode" value="{{ $company->id }}" data-id="{{ $company->name }}">{{ $company->code }}</option>
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
              @if ($errors->has('package_type_id'))             
                <span class="master_message color--fadegreen">{{ $errors->first('package_type_id') }}</span>       
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
          </div>
        </div>

        {{--  Password  --}}
        <div class="col-md-3 col-sm-4 col-xs-12">
          <div class="master_field">
            <label class="master_label mandatory" for="password">كلمة المرور</label>
            <input name="password" value="{{ old('password') }}" class="master_input" type="text" placeholder="كلمة المرور .." id="password" disabled="true">             
            {{--  Error  --}}            
             @if ($errors->has('package_type_id'))               
             <span class="master_message color--fadegreen">{{ $errors->first('package_type_id') }}</span>             
             @endif
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
            @if ($errors->has('package_type_id'))               
              <span class="master_message color--fadegreen">{{ $errors->first('package_type_id') }}</span>             
            @endif
          </div>
        </div>

        {{--  Job  --}}
        <div class="col-md-3 col-sm-4 col-xs-12">
          <div class="master_field">
            <label class="master_label mandatory" for="client_job">المسمى الوظيفي </label>
            <input name="job" value="{{ old('job') }}" class="master_input" type="text" placeholder="المسمى الوظيفي  .." id="client_job">             
            {{--  Error  --}}             
            @if ($errors->has('package_type_id'))               
              <span class="master_message color--fadegreen">{{ $errors->first('package_type_id') }}</span>             
            @endif
          </div>
        </div>

        {{--  Address  --}}
        <div class="col-md-3 col-sm-4 col-xs-12">
          <div class="master_field">
            <label class="master_label mandatory" for="client_address">عنوان العميل</label>
            <input class="master_input" type="text" placeholder="عنوان العميل .." id="client_address">             
            {{--  Error  --}}             
            @if ($errors->has('package_type_id'))               
            <span class="master_message color--fadegreen">{{ $errors->first('package_type_id') }}</span>             
            @endif
          </div>
        </div>

        {{--  National id  --}}
        <div class="col-md-3 col-sm-4 col-xs-12">
          <div class="master_field">
            <label class="master_label mandatory" for="client_id">الرقم القومى</label>
            <input class="master_input" type="number" placeholder="الرقم القومى" id="client_id">             
            {{--  Error  --}}             
            @if ($errors->has('package_type_id'))               
            <span class="master_message color--fadegreen">{{ $errors->first('package_type_id') }}</span>             
            @endif
          </div>
        </div>

        {{--  Nationality  --}}
        <div class="col-md-3 col-sm-4 col-xs-12">
          <div class="master_field">
            <label class="master_label mandatory" for="license_type">جنسية الشركة</label>
            <select name="nationality" class="master_input select2" id="license_type" style="width:100%;">
                
              @foreach ($nationalities as $nat)
                <option value="{{ $nat->item_id }}">{{ $nat->value }}</option>
              @endforeach
              
            </select>
            {{--  Error  --}}
          @if ($errors->has('package_type_id'))
              <span class="master_message color--fadegreen">{{ $errors->first('package_type_id') }}</span>
            @endif
          </div>
          
        </div>

        <div class="col-md-3 col-sm-4 col-xs-12">
          <div class="master_field">
            <label class="master_label mandatory" for="client_birth">تاريخ الميلاد</label>
            <input class="datepicker-popup master_input" type="text" placeholder="placeholder" id="client_birth">             
            {{--  Error  --}}            
             @if ($errors->has('package_type_id'))              
              <span class="master_message color--fadegreen">{{ $errors->first('package_type_id') }}</span>        
                   @endif
          </div>
        </div>
        <div class="col-md-3 col-sm-4 col-xs-12">
          <div class="master_field">
            <label class="master_label mandatory" for="client_tel">رقم الهاتف</label>
            <input class="master_input" type="number" placeholder="رقم الهاتف" id="client_tel">          
               {{--  Error  --}}         
                   @if ($errors->has('package_type_id'))          
                    <span class="master_message color--fadegreen">{{ $errors->first('package_type_id') }}</span>      
                           @endif
          </div>
        </div>
        <div class="col-md-3 col-sm-4 col-xs-12">
          <div class="master_field">
            <label class="master_label mandatory" for="client_mob">رقم الهاتف الجوال</label>
            <input class="master_input" type="number" placeholder="رقم الهاتف الجوال" id="client_mob">             {{--  Error  --}}             @if ($errors->has('package_type_id'))               <span class="master_message color--fadegreen">{{ $errors->first('package_type_id') }}</span>             @endif
          </div>
        </div>
        <div class="col-md-3 col-sm-4 col-xs-12">
          <div class="master_field">
            <label class="master_label" for="client_email">البريد الالكترونى</label>
            <input class="master_input" type="email" placeholder="البريد الالكترونى" id="client_email">             {{--  Error  --}}             @if ($errors->has('package_type_id'))               <span class="master_message color--fadegreen">{{ $errors->first('package_type_id') }}</span>             @endif
          </div>
        </div>
        <div class="col-md-3 col-sm-4 col-xs-12">
          <div class="master_field">
            <label class="master_label mandatory" for="client_photo">صورة شخصية</label>
            <div class="file-upload">
              <div class="file-select">
                <div class="file-select-name" id="noFile">اضغط هنا لرفع الصورة الشخصية للعميل </div>
                <input class="chooseFile" type="file" name="chooseFile" id="client_photo">
              </div>
            </div>             {{--  Error  --}}             @if ($errors->has('package_type_id'))               <span class="master_message color--fadegreen">{{ $errors->first('package_type_id') }}</span>             @endif
          </div>
        </div>
        <div class="col-md-3 col-sm-4 col-xs-12">
          <div class="master_field">
            <label class="master_label mandatory" for="discount">نسبة الخصم </label>
            <input class="master_input" type="number" placeholder="%" id="discount">             {{--  Error  --}}             @if ($errors->has('package_type_id'))               <span class="master_message color--fadegreen">{{ $errors->first('package_type_id') }}</span>             @endif
          </div>
        </div>
        <div class="col-md-3 col-sm-4 col-xs-12">
          <label class="master_label">تفعيل العميل</label>
          <div class="master_field">       
            <input class="icon" type="radio" name="icon" id="radbtn_2" checked="true">
            <label for="radbtn_2">مفعل</label>
            <input class="icon" type="radio" name="icon" id="radbtn_3">
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
        <div class="col-md-3 col-sm-4 col-xs-12">
          <div class="master_field">
            <label class="master_label mandatory" for="license_start_date">تاريخ بدء التعاقد</label>
            <input class="datepicker-popup master_input" type="text" placeholder="placeholder" id="license_start_date">             {{--  Error  --}}             @if ($errors->has('package_type_id'))               <span class="master_message color--fadegreen">{{ $errors->first('package_type_id') }}</span>             @endif
          </div>
        </div>
        <div class="col-md-3 col-sm-4 col-xs-12">
          <div class="master_field">
            <label class="master_label mandatory" for="license_end_date">تاريخ  نهاية التعاقد</label>
            <input class="datepicker-popup master_input" type="text" placeholder="placeholder" id="license_end_date">             {{--  Error  --}}             @if ($errors->has('package_type_id'))               <span class="master_message color--fadegreen">{{ $errors->first('package_type_id') }}</span>             @endif
          </div>
        </div>
        <div class="col-md-3 col-sm-4 col-xs-12">     
          <div class="master_field">
            <label class="master_label mandatory" for="license_type">نوع الباقة </label>
            <select class="master_input select2" id="license_type" style="width:100%;">
              <option>ذهبي</option>
              <option>بلاتيني</option>
              <option>فضي</option>
            </select>             {{--  Error  --}}             @if ($errors->has('package_type_id'))               <span class="master_message color--fadegreen">{{ $errors->first('package_type_id') }}</span>             @endif
          </div>
        </div>
        <div class="col-md-3 col-sm-4 col-xs-12">
          <div class="master_field">
            <label class="master_label mandatory" for="license_period">مدة التعاقد</label>
            <input class="master_input" type="number" placeholder="0" id="license_period">             {{--  Error  --}}             @if ($errors->has('package_type_id'))               <span class="master_message color--fadegreen">{{ $errors->first('package_type_id') }}</span>             @endif
          </div>
        </div>
        <div class="col-md-3 col-sm-4 col-xs-12">
          <div class="master_field">
            <label class="master_label mandatory" for="license_amount">قيمة التعاقد</label>
            <input class="master_input" type="number" placeholder="قيمة التعاقد" id="license_amount">             {{--  Error  --}}             @if ($errors->has('package_type_id'))               <span class="master_message color--fadegreen">{{ $errors->first('package_type_id') }}</span>             @endif
          </div>
        </div>
        <div class="col-md-3 col-sm-4 col-xs-12">
          <div class="master_field">
            <label class="master_label mandatory" for="license_num">عدد الاقساط</label>
            <input class="master_input" type="number" placeholder="عدد الاقساط" id="license_num">             {{--  Error  --}}             @if ($errors->has('package_type_id'))               <span class="master_message color--fadegreen">{{ $errors->first('package_type_id') }}</span>             @endif
          </div>
        </div>
        <div class="clearfix"></div>
        <div class="col-md-4 col-xs-12">
          <div class="master_field">
            <label class="master_label mandatory" for="premium1_amount">قيمة القسط الاول</label>
            <input class="master_input" type="number" placeholder="قيمة القسط الاول" id="premium1_amount">             {{--  Error  --}}             @if ($errors->has('package_type_id'))               <span class="master_message color--fadegreen">{{ $errors->first('package_type_id') }}</span>             @endif
          </div>
        </div>
        <div class="col-md-4 col-xs-12">
          <div class="master_field">
            <label class="master_label mandatory" for="license_date">تاريخ  سداد القسط الاول</label>
            <input class="datepicker-popup master_input" type="text" placeholder="placeholder" id="license_date">             {{--  Error  --}}             @if ($errors->has('package_type_id'))               <span class="master_message color--fadegreen">{{ $errors->first('package_type_id') }}</span>             @endif
          </div>
        </div>
        <div class="col-md-4 col-xs-12">
          <div class="master_field">
            <label class="master_label">حالة السداد للقسط الاول</label>
            <div class="radiorobo">
              <input type="radio" id="rad_1">
              <label for="rad_1">نعم</label>
            </div>
            <div class="radiorobo">
              <input type="radio" id="rad_2">
              <label for="rad_2">لا</label>
            </div>             {{--  Error  --}}             @if ($errors->has('package_type_id'))               <span class="master_message color--fadegreen">{{ $errors->first('package_type_id') }}</span>             @endif
          </div>
        </div>
        <div class="col-md-4 col-xs-12">
          <div class="master_field">
            <label class="master_label mandatory" for="premium2_amount">قيمة القسط الثانى</label>
            <input class="master_input" type="number" placeholder="قيمة القسط الثانى" id="premium2_amount">             {{--  Error  --}}             @if ($errors->has('package_type_id'))               <span class="master_message color--fadegreen">{{ $errors->first('package_type_id') }}</span>             @endif
          </div>
        </div>
        <div class="col-md-4 col-xs-12">
          <div class="master_field">
            <label class="master_label mandatory" for="premium2_date">تاريخ  سداد القسط الثانى</label>
            <input class="datepicker-popup master_input" type="text" placeholder="placeholder" id="premium2_date">             {{--  Error  --}}             @if ($errors->has('package_type_id'))               <span class="master_message color--fadegreen">{{ $errors->first('package_type_id') }}</span>             @endif
          </div>
        </div>
        <div class="col-md-4 col-xs-12">
          <div class="master_field">
            <label class="master_label">حالة السداد للقسط الثانى</label>
            <div class="radiorobo">
              <input type="radio" id="rad_1">
              <label for="rad_1">نعم</label>
            </div>
            <div class="radiorobo">
              <input type="radio" id="rad_2">
              <label for="rad_2">لا</label>
            </div>             {{--  Error  --}}             @if ($errors->has('package_type_id'))               <span class="master_message color--fadegreen">{{ $errors->first('package_type_id') }}</span>             @endif
          </div>
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
      
      $(function() {
          $('#company_code').change(function(){
            $('#company_name').val('..' + $('#company_code option:selected').data('id'));
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

    });

    

  </script>

@endsection