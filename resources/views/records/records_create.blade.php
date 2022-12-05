@extends('layout.app')
@section('content')

<div class="row">
  <div class="col-lg-12">
    <div class="cover-inside-container margin--small-top-bottom bradius--small bshadow--1" style="background:  url( '{{asset('img/covers/dummy2.jpg')}}' ) no-repeat center center; background-size:cover;">
      <div class="add-mode">Adding mode</div>
      <div class="row">
        <div class="col-xs-12">
          <div class="text-xs-center">
            <div class="text-wraper">
              <h4 class="cover-inside-title color--gray_d">دفتر المحضرين</h4>
            </div>
          </div>
        </div>
        <div class="cover--actions">
        </div>
      </div>
    </div>
  </div>

  <form action="{{ route('record.store') }}" method="POST">
    {{ csrf_field() }}

    <div class="col-lg-12">
      <div class="cardwrap bgcolor--white bradius--noborder   bshadow--1 padding--small margin--small-top-bottom">
        
        {{-- Number --}}
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="master_field">
            <label class="master_label mandatory" for="ID_No">رقم الاعلان</label>
            <input name="number" value="{{ old('number') }}" class="master_input" type="number" placeholder="رقم الاعلان" id="ID_No">

            {{--  Error  --}}
            @if ($errors->has('number'))
              <span class="master_message color--fadegreen">{{ $errors->first('number') }}</span>
            @endif
          </div>
        </div>

        {{-- Pen --}}
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="master_field">
            <label class="master_label mandatory" for="ID_No">قلم المحضرين</label>
            <input name="pen" value="{{ old('pen') }}" class="master_input" type="text" placeholder="قلم المحضرين" id="ID_No">

            {{--  Error  --}}
            @if ($errors->has('pen'))
              <span class="master_message color--fadegreen">{{ $errors->first('pen') }}</span>
            @endif
          </div>
        </div>

        {{-- Code --}}
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="master_field">
            <label class="master_label mandatory" for="client_cade">كود العميل</label>
            <select name="code" class="master_input select2" id="code" style="width:100%;">
                
              {{-- Defualt useless select option --}}
              <option value="-1" selected disabled hidden>إختر كود العميل</option>

              @if(isset($clients) && !empty($clients))
                @foreach ($clients as $client)
                  <option value="{{ $client->id }}" data-id="{{ $client->name }}">{{ $client->name .' - '. $client->code }}</option>
                @endforeach
              @endif

            </select>
            {{--  Error  --}}
            @if ($errors->has('code'))
              <span class="master_message color--fadegreen">{{ $errors->first('code') }}</span>
            @endif
          </div>
        </div>

        {{-- Name --}}
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="master_field">
            <label class="master_label mandatory" for="ID_No">اسم الموكل</label>
            <input name="name" value="{{ old('name') }}" class="master_input" type="text" readonly placeholder="اسم العميل .." id="name">            
              
              {{--  Error  --}}            
                @if ($errors->has('name'))             
                  <span class="master_message color--fadegreen">{{ $errors->first('name') }}</span>       
                @endif
          </div>
        </div>

        {{-- delivery date --}}
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="master_field">
            <label class="master_label mandatory" for="ID_No">تاريخ التسليم</label>
            <input name="delivery_date" value="{{ old('delivery_date') }}" class="datepicker master_input" type="text" placeholder="تاريخ التسليم" id="ID_No">

            {{--  Error  --}}            
            @if ($errors->has('delivery_date'))             
              <span class="master_message color--fadegreen">{{ $errors->first('delivery_date') }}</span>       
            @endif
          </div>
        </div>

        {{-- delivered at --}}
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="master_field">
            <label class="master_label mandatory" for="ID_No">تاريخ التسلم</label>
            <input name="delivered_at" value="{{ old('delivered_at') }}" class="datepicker master_input" type="text" placeholder="تاريخ التسلم" id="ID_No">
            
            {{--  Error  --}}            
            @if ($errors->has('delivered_at'))             
              <span class="master_message color--fadegreen">{{ $errors->first('delivered_at') }}</span>       
            @endif
          </div>
        </div>

        {{-- Session date --}}
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="master_field">
            <label class="master_label mandatory" for="ID_No">تاريخ الجلسة</label>
            <input name="session_date" value="{{ old('session_date') }}" class="datepicker master_input" type="text" placeholder="تاريخ الجلسة" id="ID_No">

            {{--  Error  --}}            
            @if ($errors->has('session_date'))             
              <span class="master_message color--fadegreen">{{ $errors->first('session_date') }}</span>       
            @endif
          </div>
        </div>

        {{-- Notes --}}
        <div class="col-xs-12">
          <div class="master_field">
            <label class="master_label" for="ID_No">ملاحظات</label>
            <textarea name="notes" class="master_input" name="textarea" id="ID_No" placeholder="ملاحظات">{{ old('notes') }}</textarea>

            {{--  Error  --}}            
            @if ($errors->has('notes'))             
              <span class="master_message color--fadegreen">{{ $errors->first('notes') }}</span>       
            @endif
          </div>
        </div>
        <div class="clearfix"></div>
        <div class="col-md-2 col-md-3 col-sm-6 col-xs-12">
          <button class="master-btn undefined btn-block color--white bgcolor--fadepurple bradius--small bshadow--0" type="submit"><i class="fa fa-save"></i><span>حفظ</span>
          </button>
        </div>
        <div class="col-md-2 col-md-3 col-sm-6 col-xs-12">
          <a href="{{ route('records') }}" class="master-btn undefined btn-block color--white bgcolor--fadebrown bradius--small bshadow--0"><i class="fa fa-times"></i><span>الغاء</span>
          </a>
        </div>
        <div class="clearfix"></div><br>
      </div>
    </div>
    
  </form>

</div>

<script>
  $(document).ready(function() {
    $(function() {
          $('#code').change(function(){
            $('#name').val($('#code option:selected').data('id'));
          });
      });
  });
</script>

@endsection
