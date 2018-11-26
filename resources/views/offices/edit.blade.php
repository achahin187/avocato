 @extends('layout.app')             
 @section('content')

              <div class="row">
                <div class="col-lg-12">
                  <div class="cover-inside-container margin--small-top-bottom bradius--small bshadow--1" style="background:  url( '{{asset('img/covers/dummy2.jpg ' )}}') no-repeat center center; background-size:cover">
                    <div class="add-mode">Editing mode</div>
                    <div class="row">
                      <div class="col-xs-12">
                        <div class="text-xs-center">
                          <div class="text-wraper">
                            <h4 class="cover-inside-title color--gray_d">مكاتب المحاماه</h4>
                          </div>
                        </div>
                      </div>
                      <div class="cover--actions">
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-12">
                  @if(\session('success'))
                  <div class="alert alert-success">
                  {{\session('success')}}
                  </div>
                  @endif
              <form role="form" action="{{route('offices_update',$office->id)}}" method="post" enctype="multipart/form-data" accept-charset="utf-8">
                {{csrf_field()}}
                <input type="hidden" id="office_id" name="office_id" value="{{$office->id}}">
                    <div class="cardwrap bgcolor--white bradius--noborder   bshadow--1 padding--small margin--small-top-bottom">
                      <div class="col-md-4 col-sm-6 col-xs-12">
                        <div class="master_field">
                          <label class="master_label" for="office_code">كود المحامى</label>
                          <input class="master_input" type="text" placeholder="كود المكتب .." id="office_code" disabled="true">
                        </div>
                      </div>
                      <div class="col-md-4 col-sm-6 col-xs-12">
                        <div class="master_field">
                          <label class="master_label" for="password">كلمة المرور</label>
                          <input class="master_input" type="text" placeholder="كلمة المرور .." id="password" disabled="true">
                        </div>
                      </div>
                      <div class="clearfix"></div>
                      <div class="col-md-4 col-sm-6 col-xs-12">
                        <div class="master_field">
                          <label class="master_label mandatory" for="office_name">اسم المكتب</label>
                          <input class="master_input" type="text" placeholder="اسم المكتب .." id="office_name" name="office_name" value="{{$office->name}}"><span class="master_message color--fadegreen">message </span>
                        </div>
                      </div>
                      <div class="col-md-4 col-sm-6 col-xs-12">
                        <div class="master_field">
                          <label class="master_label mandatory" for="office_address">عنوان المكتب</label>
                          <input class="master_input" type="text" placeholder="عنوان المكتب .." id="office_address" name="office_address" value="{{$office->address}}"><span class="master_message color--fadegreen">message </span>
                        </div>
                      </div>
                      <div class="col-md-4 col-sm-6 col-xs-12">
                        <div class="master_field">
                          <label class="master_label mandatory" for="office_city">المدينة </label>
                          <select name="office_city"  class="master_input select2" id="office_city" data-placeholder="المدينة" style="width:100%;" ,>
                          <option value="choose" >ختيار المدينة</option>
                          @foreach($work_sector_areas as $city)
                            <option value="{{$city->id}}" @if($office->user_detail->work_sector_area_id == $city->id) {!!'selected'!!} @endif>{{$city->name}}</option>
                            @endforeach
                          </select><span class="master_message color--fadegreen">
                                  @if ($errors->has('nationality'))
                                    {{ $errors->first('nationality')}}
                                    @endif</span>
                        </div>
                      </div>
                     <div class="col-md-4 col-sm-6 col-xs-12">
                        <div class="master_field">
                          <label class="master_label mandatory" for="office_tel">رقم الهاتف</label>
                          <input name="office_phone" value="{{$office->phone}}"  class="master_input" type="text" placeholder="رقم الهاتف" id="office_tel"><span class="master_message color--fadegreen" >
                                   @if ($errors->has('office_phone'))
                                    {{ $errors->first('office_phone')}}
                                    @endif </span>
                        </div>
                      </div>
                       <div class="col-md-4 col-sm-6 col-xs-12">
                        <div class="master_field">
                          <label class="master_label mandatory" for="office_email">البريد الالكترونى</label>
                          <input name="office_email" value="{{$office->email}}" class="master_input" type="email" placeholder="البريد الالكترونى" id="office_email"><span class="master_message color--fadegreen" >
                                  @if ($errors->has('office_email'))
                                    {{ $errors->first('office_email')}}
                                    @endif</span>
                        </div>
                      </div>
                      <div class="col-md-4 col-sm-6 col-xs-12">
                        <div class="master_field">
                          <label class="master_label mandatory" for="office_img">صورة المكتب</label>
                          <div class="file-upload">
                            <div class="file-select">
                              <div class="file-select-name" id="noFile">اضغط هنا لرفع صورة للمكتب</div>
                             <input name="office_image" class="chooseFile" type="file" name="chooseFile" id="office_img">
                            </div>
                          </div><span class="master_message color--fadegreen">
                                  @if ($errors->has('image'))
                                    {{ $errors->first('image')}}
                                    @endif</span>
                        </div>
                      </div>
                      <div class="col-md-4 col-sm-6 col-xs-12">
                        <div class="master_field">
                          <label class="master_label mandatory" for="cer_img">صورة التوكيل</label>
                          <div class="file-upload">
                            <div class="file-select">
                              <input name="attorney_form" class="chooseFile" type="file" id="attorney_form" >
                            </div>
                          </div><span class="master_message color--fadegreen">
                                    @if ($errors->has('attorney_form'))
                                    {{ $errors->first('attorney_form')}}
                                    @endif</span>
                        </div>
                      </div>
                          <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="master_field">
                          <label class="master_label mandatory" for="office_info">نبذة عن المكتب</label>
                          <textarea value="{{ old('note') }}" class="master_input" name="note" id="office_info" placeholder="نبذة">{{$office->note}}</textarea><span class="master_message color--fadegreen">
                                  @if ($errors->has('note'))
                                    {{ $errors->first('note')}}
                                    @endif</span>
                        </div>
                      </div>
                      <div class="col-md-4 col-sm-6 col-xs-12">
                        <div class="master_field">
                          <label class="master_label mandatory">تفعيل المكتب</label>
                          <input name="is_active" value="1" class="icon" type="radio" name="icon" id="radbtn_2" @if($office->is_active == 1)checked="true" @endif>
                          <label for="radbtn_2">مفعل</label>
                          <input name="is_active" value="0" class="icon" type="radio" name="icon" id="radbtn_3" @if($office->is_active == 0)checked="true" @endif>
                          <label for="radbtn_3">غير مفعل</label>
                        </div>
                      </div>
                      <div class="clearfix"></div>
                    </div>
                    <div class="main-title-conts">
                      <div class="caption">
                        <h3>معلومات الممثل القانوني للمكتب</h3>
                      </div>
                      <div class="actions">
                      </div><span class="mainseparator bgcolor--main"></span>
                    </div>
                    <div class="cardwrap bgcolor--white bradius--noborder   bshadow--1 padding--small margin--small-top-bottom">
                      <div class="col-md-4 col-sm-6 col-xs-12">
                        <div class="master_field">
                          <label class="master_label mandatory" for="rep_name">اسم الممثل القانوني</label>
                          <input class="master_input" type="text" placeholder="اسم الممثل القانوني" id="rep_name" name="rep_name" value="{{$representative->name}}"><span class="master_message color--fadegreen">message </span>
                        </div>
                      </div>
                      <div class="col-md-4 col-sm-6 col-xs-12">
                        <div class="master_field">
                          <label class="master_label mandatory" for="rep_birth">تاريخ الميلاد</label>
                          <input name="rep_birthdate" value="{{$representative->birthdate}}" class="datepicker master_input" type="text" placeholder="اكتب تاريخ الميلاد هنا" id="rep_birth"><span class="master_message color--fadegreen">
                                    @if ($errors->has('rep_birthdate'))
                                    {{ $errors->first('rep_birthdate')}}
                                    @endif </span>
                        </div>
                      </div>
                      <div class="col-md-4 col-sm-6 col-xs-12">
                        <div class="master_field">
                          <label class="master_label mandatory" for="rep_id">رقم البطاقة</label>
                          <input class="master_input" type="number" placeholder="رقم بطاقة الممثل القانوني" id="rep_id" name="rep_nid" value="{{$representative->user_detail->national_id}}"><span class="master_message color--fadegreen">message </span>
                        </div>
                      </div>
                      <div class="col-md-4 col-sm-6 col-xs-12">
                        <div class="master_field">
                          <label class="master_label mandatory" for="work_type">الجنسيه</label>
                          <select name="rep_nationality"  class="master_input select2" id="work_type" data-placeholder="نوع العمل " style="width:100%;" ,>
                          <option value="choose" selected disabled>اختر الجنسيه</option>
                          @foreach($nationalities as $nationality)
                            <option value="{{$nationality->item_id}}" @if($representative->user_detail->nationality_id == $nationality->item_id ) selected @endif>{{$nationality->value}}</option>
                            @endforeach
                          </select><span class="master_message color--fadegreen">
                                  @if ($errors->has('nationality'))
                                    {{ $errors->first('nationality')}}
                                    @endif</span>
                        </div>
                      </div>
                     <div class="col-md-4 col-sm-6 col-xs-12">
                        <div class="master_field">
                          <label class="master_label mandatory" for="lawyer_type"> التخصص</label>
                          <select name="specializations[]" class="master_input select2" id="lawyer_type" multiple="multiple" data-placeholder="التخصص" style="width:100%" >
                            @foreach($work_sectors as $work_sector)
                            <option 
                            @foreach($representative->specializations as $spec)
                            @if($spec->id == $work_sector->id)
                            {!!'selected'!!}
                            @endif
                            @endforeach
                            value="{{$work_sector->id}}" >{{$work_sector->name}}</option>
                            @endforeach
                            
                          </select><span class="master_message color--fadegreen">
                                  @if ($errors->has('work_sector'))
                                    {{ $errors->first('work_sector')}}
                                    @endif</span>
                        </div>
                      </div>
                      <div class="col-md-4 col-sm-6 col-xs-12">
                        <div class="master_field">
                          <label class="master_label mandatory" for="rep_spec">الإختصاص المكاني </label>
                         <select name="rep_spec"  class="master_input select2" id="rep_spec" data-placeholder="المدينة" style="width:100%;" ,>
                          <option value="choose" selected disabled>ختيار المدينة</option>
                          @foreach($work_sector_areas as $city)
                            <option  @if($representative->user_detail->work_sector_area_id == $city->id)
                          {!!'selected'!!}
                          @endif
                           value="{{$city->id}}"
                             value="{{$city->id}}" >{{$city->name}}</option>
                            @endforeach
                          </select><span class="master_message color--fadegreen">message </span>
                        </div>
                      </div>
                      <div class="col-md-4 col-sm-6 col-xs-12">
                        <div class="master_field">
                          <label class="master_label mandatory" for="rep_litigation_level">درجة التقاضي</label>
                          <input class="master_input" type="text" placeholder="درجة التقاضي.." id="rep_litigation_level" name="rep_litigation_level" value="{{$representative->user_detail->litigation_level}}"><span class="master_message color--fadegreen">
                                  @if ($errors->has('rep_litigation_level'))
                                    {{ $errors->first('rep_litigation_level')}}
                                    @endif</span>
                        </div>
                      </div>
                     <div class="col-md-4 col-sm-6 col-xs-12">
                        <div class="master_field">
                          <label class="master_label mandatory" for="lawyer_card">صورة كارنيه النقابة</label>
                          <div class="file-upload">
                            <div class="file-select">
                              <div class="file-select-name" id="noFile">اضغط هنا لرفع صورة كارنية النقابة</div>
                              <input name="syndicate_copy" class="chooseFile" type="file" name="chooseFile" id="lawyer_card">
                            </div>
                          </div><span class="master_message color--fadegreen">
                                  @if ($errors->has('syndicate_copy'))
                                    {{ $errors->first('syndicate_copy')}}
                                    @endif</span>
                        </div>
                      </div>
                      <div class="col-md-4 col-sm-6 col-xs-12">
                        <div class="master_field">
                          <label class="master_label mandatory" for="rep_img">صورة</label>
                          <div class="file-upload">
                            <div class="file-select">
                              <div class="file-select-name" id="noFile">اضغط هنا لرفع صورة للممثل القانوني</div>
                              <input class="chooseFile" type="file" name="rep_img" id="rep_img">
                            </div>
                          </div><span class="master_message color--fadegreen">
                                  @if ($errors->has('rep_img'))
                                    {{ $errors->first('rep_img')}}
                                    @endif</span>
                        </div>
                      </div>
                      <div class="clearfix"></div>
                    </div>
                    <div class="main-title-conts">
                      <div class="caption">
                        <h3>فروع المكتب</h3>
                      </div>
                      <div class="actions">
                      </div><span class="mainseparator bgcolor--main"></span>
                    </div>
                    <div class="cardwrap bgcolor--white bradius--noborder   bshadow--1 padding--small margin--small-top-bottom">
                      <div class="more-branches">
                        @foreach($branches as $branch)
                        <div class="col-md-4 col-sm-6 col-xs-12">
                          <div class="master_field">
                            <label class="master_label mandatory" for="branch_name">اسم الفرع</label>
                            <input class="master_input" type="text" placeholder="اسم الفرع..." id="branch_name"  name="branches[branch_name][]" value="{{$branch->name}}"><span class="master_message color--fadegreen">@if ($errors->has('branch_name'))
                                    {{ $errors->first('branch_name')}}
                                    @endif</span>
                          </div>
                        </div>
                        <div class="col-md-4 col-sm-6 col-xs-12">
                          <div class="master_field">
                            <label class="master_label mandatory" for="branch_address">عنوان الفرع</label>
                            <input class="master_input" type="text" placeholder="عنوان الفرع..." id="branch_address" name="branches[branch_address][]"  value="{{$branch->address}}""><span class="master_message color--fadegreen">
                            	   @if ($errors->has('branch_address'))
                                    {{ $errors->first('branch_address')}}
                                    @endif</span>
                          </div>
                        </div>
                        <div class="col-md-4 col-sm-6 col-xs-12">
                          <div class="master_field">
                            <label class="master_label mandatory" for="lawyer_type">الدولة</label>
                             <select name="branches[branch_country][]"  class="master_input select2" id="work_type" data-placeholder="نوع العمل " style="width:100%;" ,>
                          <option value="choose" selected disabled>اختر الدولة</option>
                          @foreach($countries as $nationality)
                            <option
                             @if($branch->country_id == $nationality->id)
                          {!!'selected'!!}
                          @endif
                             value="{{$nationality->id}}">{{$nationality->name}}</option>
                            @endforeach
                          </select><span class="master_message color--fadegreen">@if ($errors->has('branches[branch_country][]'))
                                    {{ $errors->first('branches[branch_country][]')}}
                                    @endif</span>
                          </div>
                        </div>
                        <div class="col-md-4 col-sm-6 col-xs-12">
                          <div class="master_field">
                            <label class="master_label mandatory" for="branch_city">المدينة </label>
                             <select name="branches[branch_city][]"  class="master_input select2" id="office_city" data-placeholder="المدينة" style="width:100%;" ,>
                          <option value="choose" selected disabled>ختيار المدينة</option>
                          @foreach($work_sector_areas as $city)
                            <option value="{{$city->id}}" @if($branch->city_id == $city->id)
                          {!!'selected'!!}
                          @endif >{{$city->name}}</option>
                            @endforeach
                          </select><span class="master_message color--fadegreen">
                                  @if ($errors->has('branches[branch_city][]'))
                                    {{ $errors->first('branches[branch_city][]')}}
                                    @endif</span>
                          </div>
                        </div>
                        <div class="col-md-4 col-sm-6 col-xs-12">
                          <div class="master_field">
                            <label class="master_label mandatory" for="branch_tel">رقم الهاتف</label>
                            <input class="master_input" type="number" placeholder="رقم الهاتف" id="branch_tel" name="branches[branch_phone][]" value="{{$branch->phone}}"><span class="master_message color--fadegreen">@if ($errors->has('branch_phone'))
                                    {{ $errors->first('branch_phone')}}
                                    @endif</span>
                          </div>
                        </div>
                        <div class="col-md-4 col-sm-6 col-xs-12">
                          <div class="master_field">
                            <label class="master_label" for="branch_email">البريد الالكترونى</label>
                            <input class="master_input" type="email" placeholder="البريد الالكترونى" id="branch_email" name="branches[branch_email][]" value="{{$branch->email}}"><span class="master_message color--fadegreen">
                            	  @if($errors->has('branch_email'))
                                    {{ $errors->first('branch_email')}}
                                    @endif</span>
                          </div>
                        </div>
                      </div>
                      @endforeach
                      <div id="branches"></div>
                     <!--  <input type="hidden" id="branchNo" name="branchNo" value="0"> -->
                      <div class="col-md-12">
                        <button class="btn" id="add_more_btn" type="button">إضافة فرع<i class="fa fa-plus">&nbsp;</i></button>
                      </div>
                      <div class="clearfix"></div><br>
                      <div class="col-md-2 col-sm-6 col-xs-6">
                        <button class="master-btn undefined btn-block color--white bgcolor--fadepurple bradius--small bshadow--0" type="submit"><i class="fa fa-save"></i><span>حفظ</span>
                        </button>
                      </div>
                      <div class="col-md-2 col-sm-6 col-xs-6">
                        <a href="{{route('offices')}}"><button class="master-btn undefined btn-block color--white bgcolor--fadebrown bradius--small bshadow--0" type="submit"><i class="fa fa-times"></i><span>الغاء</span>
                        </button></a>
                      </div>
                         </form>
                      <div class="clearfix"></div><br>
                    </div>
                  </div>
                </div>
              </div>


<script>
var i=0;
var branchNo = 0;

 $("#branches").append('<input type="hidden" id="branchNo" name="branchNo" >');
      $('#add_more_btn').click(function(){
       
//  $("#branches").append('<input type="text" name="questions['+i+']" >'
//    + ' <select name="charactersy'+i+'">'
//   @foreach($countries as $country)
// +'<option value="{{$country->id}}">{{$country->name}}</option>'
// @endforeach +'</select>'
// + ' <select name="charactersy'+i+'">'
//   @foreach($work_sector_areas as $key => $city)
//   +'<option value="{{$city->id}}">{{$city->name}}</option>'
//     @endforeach+'</select>'

//             );
        i++;
        var branchNo = i+1;

$("#branches").append('<div class="more-branches">'
	                +'<h3> فرع رقم '+branchNo+'</h3>'
	                +'<div class="col-md-4 col-sm-6 col-xs-12">'
                    +' <div class="master_field">'
                    +'<label class="master_label mandatory" for="branch_name">اسم الفرع</label>'
      +'<input class="master_input" type="text" placeholder="اسم الفرع..." id="branch_name"  name="branches[branch_name][]"><span class="master_message color--fadegreen">'
                                         +'</div></div>'

        +'<div class="col-md-4 col-sm-6 col-xs-12">'
         +'<div class="master_field">'
          +'<label class="master_label mandatory" for="branch_address">عنوان الفرع</label>'
     +'<input class="master_input" type="text" placeholder="عنوان الفرع..." id="branch_address" name="branches[branch_address][]">'
                          +'</div> </div> '  
                            +'</div> ' 
           +'<div class="col-md-4 col-sm-6 col-xs-12">'
                          +'<div class="master_field">'
                            +'<label class="master_label mandatory" for="lawyer_type">الدولة</label>'
                    +'<select name="branches[branch_country][]"  class="master_input select2" id="work_type" data-placeholder="نوع العمل " style="width:100%;" onchange="get_cities(this.value , '+branchNo+' )">'
                         +' <option value="choose" selected disabled>اختر الدولة</option>'
                          @foreach($countries as $nationality)
                           +' <option value="{{$nationality->id}}">{{$nationality->name}}</option>'
                            @endforeach
                           + ' </select></div></div>  ' 
                          +' <div class="col-md-4 col-sm-6 col-xs-12">'
                          +'<div class="master_field">'
                          +'<label class="master_label mandatory" for="branch_city">المدينة </label>'
                      +' <select name="branches[branch_city][]"  class="master_input select2" id="branch_city_'+branchNo+'" data-placeholder="المدينة" style="width:100%;" ,>'
                         +' <option value="choose" selected disabled>ختيار المدينة</option>'
                          @foreach($work_sector_areas as $city)
                          +'  <option value="{{$city->id}}">{{$city->name}}</option>'
                            @endforeach
                          +'</select></div></div> '
                          +'<div class="col-md-4 col-sm-6 col-xs-12">'
                         +'<div class="master_field">'
                         +'<label class="master_label mandatory" for="branch_tel">رقم الهاتف</label>'
                         +' <input class="master_input" type="number" placeholder="رقم الهاتف" id="branch_tel" name="branches[branch_phone][]">'
                          +'</div></div>'
                       +' <div class="col-md-4 col-sm-6 col-xs-12">'
                       +'<div class="master_field">'
                       +' <label class="master_label" for="branch_email">البريد الالكترونى</label>'
                       +' <input class="master_input" type="email" placeholder="البريد الالكترونى" id="branch_email" name="branches[branch_email][]">'
                       +'</div></div>'                                           
                                           );

       $("#branchNo").val(branchNo);
 
      });
     
    </script>
       <script>
 function get_cities(val , branch_city)
 {
  $.ajax({
           type:'GET',
           url:"{{url('get_cities')}}"+'/'+val,
           data_type:JSON,
           data:{},
           success:function(data){
            var options = '<option selected disabled>select city ..</option>';
            $.each(data, function( index, value ) {
              options +='<option value="'+index+'">'+value["name"]+'</option>';
              //  alert(index);
              });
              // alert(options);
              $('#branch_city_'+branch_city).find('option').remove().end().append(options);
              
        // $this.html(data);
      // alert(data);
          },
           error: function (jqXHR, exception) {
        var msg = '';
        if (jqXHR.status === 0) {
            msg = 'Not connect.\n Verify Network.';
        } else if (jqXHR.status == 404) {
            msg = 'Requested page not found. [404]';
        } else if (jqXHR.status == 500) {
            msg = 'Internal Server Error [500].';
        } else if (exception === 'parsererror') {
            msg = 'Requested JSON parse failed.';
        } else if (exception === 'timeout') {
            msg = 'Time out error.';
        } else if (exception === 'abort') {
            msg = 'Ajax request aborted.';
        } else {
            msg = 'Uncaught Error.\n' + jqXHR.responseText;
        }
        $('#post').html(msg);
    },
        });
 }
    </script>

 @endsection