@extends('layout.app')
@section('content')

<div class="col-lg-12">
    <div class="cover-inside-container margin--small-top-bottom bradius--small bshadow--1" style="background:  url( '{{asset('img/covers/dummy2.jpg')}}' ) no-repeat center center; background-size:cover;">
      <div class="edit-mode">Editing mode</div>
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

<form action="{{ route('ind.com.update', ['id'=>$user->id]) }}" method="POST" enctype="multipart/form-data">
    {{ csrf_field() }}

    <div class="row">

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
                    @if ($user->companyParent)
                        <option id="comcode" value="{{ $company->id }}" data-id="{{ $company->name }}" {{ ($company->id == $user->companyParent->id) ? 'selected' : '' }}>{{ $company->code }}</option>
                    @else
                        <option id="comcode" value="{{ $company->id }}" data-id="{{ $company->name }}">{{ $company->code }}</option>
                    @endif
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
                @if ($user->companyParent)
                    <input name="company_name" value="{{ $user->companyParent->name }}" class="master_input" type="text" readonly placeholder="اسم الشركة .." id="company_name">            
                @else
                    <input name="company_name" value="{{ old('company_name') }}" class="master_input" type="text" readonly placeholder="اسم الشركة .." id="company_name">            
                @endif
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
                <input name="ind_code" value="{{ $user->code }}" class="master_input" type="text" placeholder="كود العميل .." id="client_code" disabled="true">
            </div>
            </div>

            {{--  Individual Name  --}}
            <div class="col-md-3 col-sm-4 col-xs-12">
            <div class="master_field">
                <label class="master_label" for="client_name">اسم العميل</label>
                <input name="ind_name" value="{{ $user->full_name }}" class="master_input" type="text" placeholder="اسم العميل .." id="client_name">
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
                    <option value="1" {{ ($user->user_detail->gender_id == 1) ? 'selected': '' }}>ذكر</option>
                    <option value="2" {{ ($user->user_detail->gender_id == 2) ? 'selected': '' }}>انثى</option>
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
                <input name="job" value="{{ $user->user_detail->job_title }}" class="master_input" type="text" placeholder="المسمى الوظيفي  .." id="client_job">             
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
                <input name="address" value="{{ $user->address }}" class="master_input" type="text" placeholder="عنوان العميل .." id="client_address">             
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
                <input name="national_id" value="{{ $user->user_detail->national_id }}" class="master_input" type="number" placeholder="الرقم القومى" id="client_id">             
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
                    <option value="{{ $nat->id }}" {{ ($nat->id == $user->user_detail->nationality_id) ? 'selected' : '' }}>{{ Helper::localizations('geo_countries', 'nationality', $nat->id) }}</option> {{ $nat->id }}
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
                <input name="birthday" value="{{ $user->birthdate }}" class="datepicker master_input" type="text" placeholder="ادخل تاريخ الميلاد" id="client_birth">             
                {{--  Error  --}}            
                @if ($errors->has('birthday'))              
                <span class="master_message color--fadegreen">{{ $errors->first('birthday') }}</span>        
                    @endif
            </div>
            </div>

            {{--  Phone  --}}
            <div class="col-md-3 col-sm-4 col-xs-12">
            <div class="master_field">
                <label class="master_label mandatory" for="client_tel">رقم الهاتف</label>
                <input name="phone" value="{{ $user->phone }}" class="master_input" type="number" placeholder="رقم الهاتف" id="client_tel">          
                {{--  Error  --}}         
                @if ($errors->has('phone'))          
                    <span class="master_message color--fadegreen">{{ $errors->first('phone') }}</span>      
                @endif
            </div>
            </div>

            {{--  Mobile  --}}
            <div class="col-md-3 col-sm-4 col-xs-12">
            <div class="master_field">
                <label class="master_label mandatory" for="client_mob">رقم الهاتف الجوال</label>
                <input name="mobile" value="{{ $user->mobile }}"  class="master_input" type="number" placeholder="رقم الهاتف الجوال" id="client_mob">             
                {{--  Error  --}}             
                @if ($errors->has('mobile'))               
                <span class="master_message color--fadegreen">{{ $errors->first('mobile') }}</span>             
                @endif
            </div>
            </div>

            {{--  email  --}}
            <div class="col-md-3 col-sm-4 col-xs-12">
            <div class="master_field">
                <label class="master_label" for="client_email">البريد الالكترونى</label>
                <input name="email" value="{{ $user->email }}"  class="master_input" type="email" placeholder="البريد الالكترونى" id="client_email">             
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
                <label class="master_label mandatory" for="discount">نسبة الخصم </label>
                <input name="discount_percentage" value="{{ $user->user_detail->discount_percentage }}"  class="master_input" type="number" placeholder="%" id="discount">             
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
        <div class="cardwrap bgcolor--white bradius--noborder   bshadow--1 padding--small margin--small-top-bottom">

            {{--  Start date  --}}
            <div class="col-md-3 col-sm-4 col-xs-12">
            <div class="master_field">
                <label class="master_label mandatory" for="license_start_date">تاريخ بدء التعاقد</label>
                <input name="start_date" value="{{ $user->subscription ? $user->subscription->start_date->format('m/d/Y') : '' }}"  class="datepicker master_input" type="text" placeholder="placeholder" id="license_start_date">             
                {{--  Error  --}}             
                @if ($errors->has('start_date'))               
                <span class="master_message color--fadegreen">{{ $errors->first('start_date') }}</span>             
                @endif
            </div>
            </div>

            {{--  End date  --}}
            <div class="col-md-3 col-sm-4 col-xs-12">
            <div class="master_field">
                <label class="master_label mandatory" for="license_end_date">تاريخ  نهاية التعاقد</label>
                <input name="end_date" value="{{ $user->subscription ? $user->subscription->end_date->format('m/d/Y') : '' }}"  class="datepicker master_input" type="text" placeholder="placeholder" id="license_end_date">             
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
                    <option value="{{ $types->id }}" {{ ($types->id == ($user->subscription ? $user->subscription->package_type_id : 0) )? 'selected' : '' }}>{{ Helper::localizations('package_types', 'name', $types->id) }}</option>
                @endforeach
                
                </select>
                {{--  Error  --}}
            @if ($errors->has('package_type_id'))
                <span class="master_message color--fadegreen">{{ $errors->first('package_type_id') }}</span>
                @endif
            </div>
            
            </div>

            {{--  subscriptioin duration  --}}
            <div class="col-md-3 col-sm-4 col-xs-12">
            <div class="master_field">
                <label class="master_label mandatory" for="license_period">مدة التعاقد</label>
                <input name="duration" value="{{ $user->subscription ? $user->subscription->duration : 0 }}" class="master_input" type="number" placeholder="0" id="license_period">             
                {{--  Error  --}}             
                @if ($errors->has('duration'))               
                <span class="master_message color--fadegreen">{{ $errors->first('duration') }}</span>             
                @endif
            </div>
            </div>

            {{--  value  --}}
            <div class="col-md-3 col-sm-4 col-xs-12">
            <div class="master_field">
                <label class="master_label mandatory" for="license_amount">قيمة التعاقد</label>
                <input name="value" value="{{ $user->subscription ? $user->subscription->value : '' }}"  class="master_input" type="number" placeholder="قيمة التعاقد" id="license_amount">             
                {{--  Error  --}}             
                @if ($errors->has('value'))               
                <span class="master_message color--fadegreen">{{ $errors->first('value') }}</span>             
                @endif
            </div>
            </div>

            {{--  number of payments  --}}
            <div class="col-md-3 col-sm-4 col-xs-12">
            <div class="master_field">
                <label class="master_label mandatory" for="license_num">عدد الاقساط</label>
            <input name="number_of_payments" min="0" value="{{ $user->subscription ? $user->subscription->number_of_installments : 0 }}" class="master_input" type="number" placeholder="عدد الاقساط" id="license_num">             
                {{--  Error  --}}             
                @if ($errors->has('number_of_payments'))               
                <span class="master_message color--fadegreen">{{ $errors->first('number_of_payments') }}</span>             
                @endif
            </div>
            </div>
            <div class="clearfix"></div>

          {{--  Generated input fields  --}}
          @if($user->subscription)
          <div id="generated">
              @for ($i = 0; $i < $user->subscription->number_of_installments; $i++)
              <?php $j = $i+1; ?>
              <div class="col-md-4 col-xs-12">
                  <div class="master_field">
                    <label class="master_label mandatory" for="premium1_amount">{{ 'قيمة القسط رقم ' . $j }}</label>
                    <input required class="master_input disScroll" name="payment[{{ $i }}]" type="number" placeholder="قيمة القسط رقم {{ $j }}" id="premium1_amount" value="{{ $installments[$i]->value }}">
                  </div>
                  </div>
                  <div class="col-md-4 col-xs-12">
                    <div class="master_field">
                    <label class="master_label mandatory" for="premium1_date">تاريخ سداد القسط رقم {{ $j }} </label>
                      <input required name="payment_date[{{ $i }}]" class="datepicker master_input" type="text" placeholder="إختر تاريخ السداد" id="ddate" value="{{ $installments[$i]->payment_date->format('m/d/Y') }}">
                    </div>
                  </div>
                  <div class="col-md-4 col-xs-12">
                    <div class="master_field">
                    <label class="master_label">حالة القسط رقم {{ $j }}</label>
                  <div class="radio-inline">
                    <input type="radio" name="payment_status[{{ $i }}]" value="1" {{ ($installments[$i]->is_paid == 1) ? 'checked' : '' }} >
                    <label>نعم</label>
                  </div>
                  <div class="radio-inline">
                    <input type="radio" name="payment_status[{{ $i }}]" value="0" {{ ($installments[$i]->is_paid == 0) ? 'checked' : '' }} >
                    <label>لا</label>
                  </div>
                </div>
              </div>
              @endfor
          </div>
          @endif

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
    </div>
</form>

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
              $('#company_code').change(function(){
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
    
@endsection