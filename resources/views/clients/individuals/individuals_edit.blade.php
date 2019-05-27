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
              </h4>
            </div>
          </div>
        </div>
        <div class="cover--actions">
        </div>
      </div>
    </div>
  </div>

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
            <input name="password" value="{{ $password }}" class="master_input" type="text" placeholder="كلمة المرور الجديدة .." id="password">

            @if ($errors->has('password'))
              <span class="master_message color--fadegreen">{{ $errors->first('password') }}</span>
            @endif

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
        <div class="col-md-3 col-sm-4 col-xs-12">
          <div class="master_field">
            <label class="master_label mandatory" for="license_type">جنسية الشركة</label>
            <select name="nationality" class="master_input select2" id="license_type" style="width:100%;">
                
              @foreach ($nationalities as $nat)
                <option value="{{ $nat->id }}" {{ ($nat->id == $user->user_detail->nationality_id) ? 'selected' : '' }}>{{ Helper::localizations('geo_countries', 'nationality', $nat->id) }}</option>
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
            <input name="phone" value="{{ $user->phone }}" min="0" class="master_input disScroll" type="number" placeholder="0212345678" id="client_tel">
            
              @if ($errors->has('phone'))
                <span class="master_message color--fadegreen">{{ $errors->first('phone') }}</span>
              @endif
          </div>
        </div>

        {{--  Mobile phone  --}}
        <div class="col-md-3 col-sm-4 col-xs-12">
          <div class="master_field">
            <label class="master_label mandatory" for="client_mob">رقم الهاتف الجوال</label>
            <div class="col-md-3">
              <select name="tele_code" class="master_input select2" id="tele_code"  style="width:100%;">
            @foreach($nationalities as $code)
            @if($user->tele_code == $code['tele_code'])
            <option value="{{$code['tele_code']}}" selected>{{$code['tele_code']}}</option>
            @else
            <option value="{{$code['tele_code']}}">{{$code['tele_code']}}</option>
            @endif
            @endforeach
            </select>
            </div>
            <div class="col-md-9">
            <input name="cellphone"  class="master_input" type="number" placeholder="1234567890" id="mob" value="{{$user->cellphone}}"><span class="master_message color--fadegreen">
            @if ($errors->has('cellphone'))
            {{ $errors->first('cellphone')}}
            @endif</span>
            </div>
          </div>
        </div>

        {{--  Email  --}}
        <div class="col-md-3 col-sm-4 col-xs-12">
          <div class="master_field">
            <label class="master_label" for="client_email">البريد الالكترونى</label>
            <input name="email" value="{{ $user->email }}" class="master_input" type="email" placeholder="البريد الالكترونى" id="client_email">
            @if ($errors->has('email'))
              <span class="master_message color--fadegreen">{{ $errors->first('email') }}</span>
            @endif
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
       @foreach($user->bouquets as $bouquet)
          {{--  Start date  --}}
          <div class="col-md-3 col-sm-4 col-xs-12">
            <div class="master_field">
              <label class="master_label mandatory" for="license_start_date">تاريخ بدء التعاقد</label>
              <input name="start_date" value="{{ $bouquet->pivot->start_date }}" class=" master_input" type="text" placeholder="إختر تاريخ بدأ التعاقد" id="ddate">
              
              @if ($errors->has('start_date'))
                <span class="master_message color--fadegreen">{{ $errors->first('start_date') }}</span>
              @endif
              
            </div>
          </div>

          {{--  End date  --}}
          <div class="col-md-3 col-sm-4 col-xs-12">
            <div class="master_field">
              <label class="master_label mandatory" for="license_end_date">تاريخ  نهاية التعاقد</label>
              <input name="end_date" value="{{ $bouquet->pivot->end_date }}" class=" master_input" type="text" placeholder="إختر تاريخ نهاية التعاقد" id="ddate">
              
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
                  <option value="{{ $types->id }}" @if($types->id == $bouquet->id) selected @endif>{{$types->name}}</option>
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
              <input name="duration" value="{{ $bouquet->pivot->duration }}" min="0" class="master_input disScroll" type="number" placeholder="0" id="license_period">
            
              @if ($errors->has('duration'))
                <span class="master_message color--fadegreen">{{ $errors->first('duration') }}</span>
              @endif
              
            </div>
          </div>

          {{--  Subscribtion value  --}}
          <div class="col-md-3 col-sm-4 col-xs-12">
            <div class="master_field">
              <label class="master_label mandatory" for="license_fees">قيمة التعاقد</label>
              <input name="value" value="{{ $bouquet->value }}" min="0" class="master_input disScroll" type="number" placeholder="قيمة التعاقد" id="license_fees" >
              
              @if ($errors->has('value'))
                <span class="master_message color--fadegreen">{{ $errors->first('value') }}</span>
              @endif
              
            </div>
          </div>

          {{--  Number of payments  --}}
          <div class="col-md-3 col-sm-4 col-xs-12">
            <div class="master_field">
              <label class="master_label mandatory" for="number_of_installments">عدد الاقساط</label>
            <input name="number_of_installments" value="{{$bouquet->pivot->number_of_installments}}" min="0" class="master_input disScroll" type="number" placeholder="عدد الاقساط" id="number_of_installments" required readonly>

                @if ($errors->has('number_of_installments'))
                  <span class="master_message color--fadegreen">{{ $errors->first('number_of_installments') }}</span>
                @endif
            </div>
          </div>

          <div class="col-md-3 col-sm-4 col-xs-12">
            <div class="master_field">
              <label class="master_label mandatory" for="payment_method_id">طريقه الدفع</label>
            <select name="payment_method" class="master_input disScroll"  required id="payment_method_id" required>
               @foreach($payment_methods as $method)
               <option value="{{$method->payment->id}}" @if($bouquet->pivot->payment_method_id == $method->payment->id) selected @endif>{{$method->payment->name}}</option>
               @endforeach

               </select>
               @if ($errors->has('payment_method'))
                <span class="master_message color--fadegreen">{{ $errors->first('payment_method') }}</span>
              @endif
            </div>
          </div>
          @endforeach
          <div class="clearfix"></div>

          {{--  Generated input fields  --}}
          @if( $user->bouquet_payment )
          <div id="generated">
              @for ($i = 0; $i < $user->bouquet_payment()->count(); $i++)
              <?php $j = $i+1; ?>
              <div class="col-md-4 col-xs-12">
                  <div class="master_field">
                    <label class="master_label mandatory" for="premium1_amount">{{ 'قيمة القسط رقم ' . $j }}</label>
                    <input required class="master_input disScroll" name="payment[{{ $i }}][price]" type="number" placeholder="قيمة القسط رقم {{ $j }}" id="premium1_amount" value="{{  $user->bouquet_payment[$i]->pivot->price  }}">
                  </div>
                  </div>
                  <div class="col-md-4 col-xs-12">
                    <div class="master_field">
                    <label class="master_label mandatory" for="premium1_date">تاريخ سداد القسط رقم {{ $j }} </label>
                      <input required name="payment[{{ $i }}][actuall_start_date]" class="datepicker master_input" type="text" placeholder="إختر تاريخ السداد" id="ddate" value="{{ $user->bouquet_payment[$i]->pivot->actuall_start_date }}">
                    </div>
                  </div>
                  <div class="col-md-4 col-xs-12">
                    <div class="master_field">
                    <label class="master_label">حالة القسط رقم {{ $j }}</label>
                  <div class="radio-inline">
                    <input type="radio" name="payment[{{ $i }}][payment_status]" value="1" {{  $user->bouquet_payment[$i]->pivot->payment_status == 1 ? 'checked' : '' }} >
                    <label>نعم</label>
                  </div>
                  <div class="radio-inline">
                    <input type="radio" name="payment[{{ $i }}][payment_status]" value="0" {{ $user->bouquet_payment[$i]->pivot->payment_status == 0 ? 'checked' : '' }} >
                    <label>لا</label>
                  </div>
                </div>
              </div>
              @endfor
          </div>
          @else
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
          <div class="clearfix"></div>

        
          @endif

          @if ( !$user->subscription )
              <div id="generated"></div>
          @endif

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


  @endsection
 @section('js')
<script>
  function get_payment_method(id)
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
                var options = '<option selected disabled>select payment method..</option>';
                  $.each(data, function( index, value ) {
                    options +='<option value="'+value["payment"]["id"]+'">'+value["payment"]["name"]+'</option>';
                    //  alert(index);
                    });
              
              $('#payment_method_id').find('option').remove().end().append(options);
              
              set_license_fees(id);
                
              }
          });
    }

  }
  function set_license_fees(id)
  {
    var discount = $('#client_discount').val();
    // var id = $('#bouquet_id').val();
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
  // $('#bouquet_id').on("change", payment_method);

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
