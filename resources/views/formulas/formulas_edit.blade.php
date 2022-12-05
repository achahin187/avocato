@extends('layout.app')
@section('content')
<script>
  $(document).ready(function(){


$("select[name='mains']").change(function () {
var contract_sub= '{{$contract->sub->id}}';
var main_id = $("select[name='mains']").val();
if (main_id !== '' && main_id !== null) {
$("select[name='subs']").prop('disabled',
false).find('option[value]').remove();
$.ajax({
type: 'GET',
url: '{{url('formulas_get_sub')}}', // do not forget to register your route
data: {id: main_id },
}).done(function (data) {
$.each(data, function (key, value) {
 if(contract_sub == key)
{
 $("select[name='subs']")
.append($("<option></option>")
.attr("value", key).attr("selected","selected")
.text(value)); 
}
else{
   $("select[name='subs']")
.append($("<option></option>")
.attr("value", key)
.text(value)); 
}
});
}).fail(function(jqXHR, textStatus){
console.log(jqXHR);
});
} else {
$("select[name='subs']").prop('disabled',
true).find("option[value]").remove();
}
});
$("select[name='mains']").trigger("change");



  });
</script>

{{\Session::put('AppLocale', 1)}}
              <div class="row">
                <div class="col-lg-12">
                  <div class="cover-inside-container margin--small-top-bottom bradius--small bshadow--1" style="background:  url( '{{asset('img/covers/dummy2.jpg')}}' ) no-repeat center center; background-size:cover;">
                    <div class="edit-mode">Editing mode</div>
                    <div class="row">
                      <div class="col-xs-12">
                        <div class="text-xs-center">
                          <div class="text-wraper">
                            <h4 class="cover-inside-title color--gray_d">العقود و الصيغ</h4>
                          </div>
                        </div>
                      </div>
                      <div class="cover--actions">
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-lg-12">
                <form role="form" action="{{route('formulas_update',$contract->id)}}" method="post" enctype="multipart/form-data" accept-charset="utf-8">
                  {{csrf_field()}}
                  <div class="container" >

                    <label class="master_label mandatory" for="is_contract">النوع</label>
                    <div class="radio">
                      <label><input type="radio" value="1" name="is_contract" {{$contract->is_contract ? 'checked' :''}} >عقد</label>
                    </div>
                    <div class="radio">
                      <label><input type="radio" value="0" {{!$contract->is_contract ? 'checked' :''}} name="is_contract">صيغه</label>
                    </div>
                    <span class="master_message color--fadegreen">
                      @if ($errors->has('is_contract'))
                      {{ $errors->first('is_contract')}}
                    @endif</span>
                  </div>
                  <div class="cardwrap bgcolor--white bradius--noborder   bshadow--1 padding--small margin--small-top-bottom">
                    <div class="col-xs-6">
                      <div class="master_field">
                        <label class="master_label mandatory" for="contract_name">اسم العقد / الصيغة </label>
                        <input name="contract_name" value="{{$contract->name}}" class="master_input" type="text" placeholder="اسم العقد / الصيغة .." id="contract_name"><span class="master_message color--fadegreen">
                                    @if ($errors->has('contract_name'))
                                    {{ $errors->first('contract_name')}}
                                    @endif</span>
                      </div>
                    </div>
                    <div class="col-xs-6">
                      <div class="master_field">
                        <label class="master_label mandatory" for="contract_upload">صورة العقد / الصيغة </label>
                        <div class="file-upload">
                          <div class="file-select">
                            <div class="file-select-name" id="noFile">اضغط هنا لرفع صورة العقد / الصيغة</div>
                            <input name="file" class="chooseFile" accept="application/pdf" type="file" name="chooseFile" id="contract_upload">
                          </div>
                        </div><span class="master_message color--fadegreen"></span>
                      </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-xs-12">
                      <div class="master_field">
                        <label class="master_label mandatory" for="main_type">التصنيف الرئيسي</label>
                        <select name="mains" class="master_input select2" id="main_type" data-placeholder="اختر التصنيف الرئيسي" style="width:100%;" ,>
                          <option value="choose" disabled>اختر تصنيف رئيسي</option>
                        @foreach($main_contracts as $main_contract)
                        @if($contract->sub->parent->id == $main_contract->id)
                        <option selected  value="{{$main_contract->id}}">{{$main_contract->name}}</option>
                         @else
                         <option value="{{$main_contract->id}}">{{$main_contract->name}}</option>
                        @endif
                        @endforeach
                        </select>
                        <span class="master_message color--fadegreen">
                          @if ($errors->has('mains'))
                            {{ $errors->first('mains')}}
                          @endif
                        </span>
                      </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-xs-12">
                      <div class="master_field">
                        <label class="master_label mandatory" for="sec_type">التصنيف الفرعي</label>
                        <select name="subs" class="master_input select2" id="sec_type" data-placeholder="اختر التصنيف الفرعي" style="width:100%;" ,>
                        <option value="choose" disabled>اختر تصنيف فرعي</option>
                        </select>
                          <span class="master_message color--fadegreen">
                            @if ($errors->has('subs'))
                              {{ $errors->first('subs')}}
                            @endif
                          </span>
                      </div>
                    </div>

      <!--  <div class="col-md-2 col-xs-4">
          <div class="master_field">
            <label class="master_label" for="sitch_1">اللغه</label>
                  <select name="language" class="master_input select2" id="type" data-placeholder="اللغع" style="width:100%;" ,>
                    @foreach($languages as $language)
                    <option {{$contract->lang_id ==$language->id ? 'selected' :''}} value="{{$language->id}}" >{{$language->name}}</option>
                    @endforeach
                  </select>
              
              @if ($errors->has('language'))
                <span class="master_message color--fadegreen">{{ $errors->first('language') }}</span>
              @endif
              
          </div>
        </div> -->

                    <div class="clearfix"></div>
                    <div class="col-md-2 col-xs-6">
                      <button class="master-btn undefined btn-block color--white bgcolor--fadepurple bradius--small bshadow--0" type="submit"><i class="fa fa-save"></i><span>حفظ</span>
                      </button>
                    </div>
                    <div class="col-md-2 col-xs-6">
                      <button class="master-btn undefined btn-block color--white bgcolor--fadeorange bradius--small bshadow--0" type="submit"><i class="fa fa-times"></i><span>الغاء</span>
                      </button>
                    </div>
                    <div class="clearfix"></div><br>
                  </div>
                </form>
                </div>
              </div>

@endsection