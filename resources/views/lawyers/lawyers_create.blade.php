@extends('layout.app')
@section('content')
<script > $(document).ready(function(){
        window.setTimeout(function() {
            $(".alert").fadeTo(500, 0).slideUp(500, function(){
                $(this).remove(); 
            });
        }, 4000);
  });</script>

              <div class="row">
                <div class="col-lg-12">
                  <div class="cover-inside-container margin--small-top-bottom bradius--small bshadow--1" style="background:  url( '{{asset('img/covers/dummy2.jpg')}}' ) no-repeat center center; background-size:cover;">
                    <div class="add-mode">Adding mode</div>
                    <div class="row">
                      <div class="col-xs-12">
                        <div class="text-xs-center">
                          <div class="text-wraper">
                            <h4 class="cover-inside-title color--gray_d">السادة المحامين</h4>
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
              <form role="form" action="{{route('lawyers_store')}}" method="post" enctype="multipart/form-data" accept-charset="utf-8">
                {{csrf_field()}}
                    <div class="cardwrap bgcolor--white bradius--noborder   bshadow--1 padding--small margin--small-top-bottom">
                      <div class="col-md-4 col-sm-6 col-xs-12">
                        <div class="master_field">
                          <label class="master_label" for="lawyer_code">كود المحامى</label>
                          <input class="master_input" type="text" placeholder="كود المحامى .." id="lawyer_code" disabled="true">
                        </div>
                      </div>
                      <div class="col-md-4 col-sm-6 col-xs-12">
                        <div class="master_field">
                          <label class="master_label" for="password">كلمة المرور</label>
                          <input class="master_input" type="text" placeholder="كلمة المرور .." id="password" disabled="true">
                        </div>
                      </div>
                      <div class="col-md-4 col-sm-6 col-xs-12">
                        <div class="master_field">
                          <label class="master_label mandatory" for="lawyer_name">اسم المحامى</label>
                          <input name="lawyer_name" value="{{ old('lawyer_name') }}" class="master_input" type="text" placeholder="اسم المحامى .." id="lawyer_name"><span class="master_message color--fadegreen">
                                    @if ($errors->has('lawyer_name'))
                                    {{ $errors->first('lawyer_name')}}
                                    @endif</span> </span>
                        </div>
                      </div>
                      <div class="col-md-4 col-sm-6 col-xs-12">
                        <div class="master_field">
                          <label class="master_label mandatory" for="lawyer_address">عنوان المحامى</label>
                          <input name="address" value="{{ old('address') }}" class="master_input" type="text" placeholder="عنوان المحامى .." id="lawyer_address"><span class="master_message color--fadegreen"> 
                                    @if ($errors->has('address'))
                                    {{ $errors->first('address')}}
                                    @endif </span>
                        </div>
                      </div>
                      <div class="col-md-4 col-sm-6 col-xs-12">
                        <div class="master_field">
                          <label class="master_label mandatory" for="lawyer_id">الرقم القومى</label>
                          <input name="national_id" value="{{ old('national_id') }}" class="master_input" type="text" placeholder="الرقم القومى" id="lawyer_id"><span class="master_message color--fadegreen">            
                                    @if ($errors->has('national_id'))
                                    {{ $errors->first('national_id')}}
                                    @endif</span>
                        </div>
                      </div>
                      <div class="col-md-4 col-sm-6 col-xs-12">
                        <div class="master_field">
                          <label class="master_label mandatory" for="work_type">الجنسيه</label>
                          <select name="nationality" name="work_type" class="master_input select2" id="work_type" data-placeholder="نوع العمل " style="width:100%;" ,>
                          <option value="choose" selected disabled>اختر الجنسيه</option>
                          @foreach($nationalities as $nationality)
                            <option value="{{$nationality->item_id}}">{{$nationality->value}}</option>
                            @endforeach
                          </select><span class="master_message color--fadegreen">
                                  @if ($errors->has('nationality'))
                                    {{ $errors->first('nationality')}}
                                    @endif</span>
                        </div>

{{--                         <div class="master_field">
                          <label class="master_label mandatory" for="lawyer_nationality">الجنسية </label>
                          <input name="nationality" class="master_input" type="text" placeholder="الجنسية" id="lawyer_nationality"><span class="master_message color--fadegreen">         
                                    @if ($errors->has('nationality'))
                                    {{ $errors->first('nationality')}}
                                    @endif </span>
                        </div> --}}
                      </div>
                      <div class="col-md-4 col-sm-6 col-xs-12">
                        <div class="master_field">
                          <label class="master_label mandatory" for="lawyer_birth">تاريخ الميلاد</label>
                          <input name="birthdate" value="{{ old('birthdate') }}" class="datepicker master_input" type="text" placeholder="اكتب تاريخ الميلاد هنا" id="lawyer_birth"><span class="master_message color--fadegreen">
                                    @if ($errors->has('birthdate'))
                                    {{ $errors->first('birthdate')}}
                                    @endif </span>
                        </div>
                      </div>
                      <div class="col-md-4 col-sm-6 col-xs-12">
                        <div class="master_field">
                          <label class="master_label mandatory" for="lawyer_tel">رقم الهاتف</label>
                          <input name="phone" value="{{ old('phone') }}" class="master_input" type="text" placeholder="رقم الهاتف" id="lawyer_tel"><span class="master_message color--fadegreen">
                                   @if ($errors->has('phone'))
                                    {{ $errors->first('phone')}}
                                    @endif </span>
                        </div>
                      </div>
                      <div class="col-md-4 col-sm-6 col-xs-12">
                        <div class="master_field">
                          <label class="master_label mandatory" for="lawyer_mob">رقم الهاتف الجوال</label>
                          <input name="mobile" value="{{ old('mobile') }}" class="master_input" type="text" placeholder="رقم الهاتف الجوال" id="lawyer_mob"><span class="master_message color--fadegreen">
                                  @if ($errors->has('mobile'))
                                    {{ $errors->first('mobile')}}
                                    @endif</span>
                        </div>
                      </div>
                      <div class="col-md-4 col-sm-6 col-xs-12">
                        <div class="master_field">
                          <label class="master_label mandatory" for="lawyer_email">البريد الالكترونى</label>
                          <input name="email" value="{{ old('email') }}" class="master_input" type="email" placeholder="البريد الالكترونى" id="lawyer_email"><span class="master_message color--fadegreen">
                                  @if ($errors->has('email'))
                                    {{ $errors->first('email')}}
                                    @endif</span>
                        </div>
                      </div>
                      <div class="col-md-4 col-sm-6 col-xs-12">
                        <div class="master_field">
                          <label class="master_label mandatory" for="lawyer_img">صورة شخصية</label>
                          <div class="file-upload">
                            <div class="file-select">
                              <div class="file-select-name" id="noFile">اضغط هنا لرفع الصورة الشخصية للمحامى</div>
                              <input name="image" class="chooseFile" type="file" name="chooseFile" id="lawyer_img">
                            </div>
                          </div><span class="master_message color--fadegreen">
                                  @if ($errors->has('image'))
                                    {{ $errors->first('image')}}
                                    @endif</span>
                        </div>
                      </div>
                      <div class="col-md-4 col-sm-6 col-xs-12">
                        <div class="master_field">
                          <label class="master_label mandatory">تفعيل المحامي</label>
                          <input name="is_active" value="1" class="icon" type="radio" name="icon" id="radbtn_2" checked="true">
                          <label for="radbtn_2">مفعل</label>
                          <input name="is_active" value="0" class="icon" type="radio" name="icon" id="radbtn_3">
                          <label for="radbtn_3">غير مفعل</label>
                        </div>
                      </div>
                      <div class="clearfix"></div>
                    </div>
                    <div class="main-title-conts">
                      <div class="caption">
                        <h3>معلومات العمل</h3>
                      </div>
                      <div class="actions">
                      </div><span class="mainseparator bgcolor--main"></span>
                    </div>
                    <div class="cardwrap bgcolor--white bradius--noborder   bshadow--1 padding--small margin--small-top-bottom">
                      <div class="col-md-4 col-sm-6 col-xs-12">

                        <div class="master_field">
                          <label class="master_label" for="lawyer_email">التخصص</label>
                          <input name="work_sector" value="{{ old('work_sector') }}" class="master_input" type="text" placeholder="التخصص" id="lawyer_work_sector"><span class="master_message color--fadegreen">
                                  @if ($errors->has('work_sector'))
                                    {{ $errors->first('work_sector')}}
                                    @endif</span>
                        </div>
                      </div>
                      <div class="col-md-4 col-sm-6 col-xs-12">
                        <div class="master_field">
                          <label class="master_label mandatory" for="lawyer_spec">الإختصاص المكاني </label>
                          <input name="work_sector_type" value="{{ old('work_sector_type') }}" class="master_input" type="text" placeholder="الإختصاص المكاني" id="lawyer_spec"><span class="master_message color--fadegreen">
                                  @if ($errors->has('work_sector_type'))
                                    {{ $errors->first('work_sector_type')}}
                                    @endif </span>
                        </div>
                      </div>
                      <div class="col-md-4 col-sm-6 col-xs-12">
                        <div class="master_field">
                          <label class="master_label mandatory" for="lawyer_degrees">درجة التقاضي</label>
                          <input name="litigation_level" value="{{ old('litigation_level') }}" class="master_input" type="text" placeholder="درجة التقاضي.." id="lawyer_degrees"><span class="master_message color--fadegreen">
                                  @if ($errors->has('litigation_level'))
                                    {{ $errors->first('litigation_level')}}
                                    @endif</span>
                        </div>
                      </div>
                      <div class="col-md-4 col-sm-6 col-xs-12">
                        <div class="master_field">
                          <label class="master_label mandatory" for="work_start">تاريخ الالتحاق بالعمل</label>
                          <input name="join_date" value="{{ old('join_date') }}" class="datepicker master_input" readonly type="text" placeholder="اكتب تاريخ الالتحاق بالعمل هنا" id="work_start"><span class="master_message color--fadegreen">
                                  @if ($errors->has('join_date'))
                                    {{ $errors->first('join_date')}}
                                    @endif </span>
                        </div>
                      </div>
                      <div class="col-md-4 col-sm-6 col-xs-12">
                        <div class="master_field">
                          <label class="master_label" for="work_end"> تاريخ انتهاء العمل بالشركة</label>
                          <input name="resign_date" value="{{ old('resign_date') }}" class="datepicker master_input" readonly type="text" placeholder="اكتب تاريخ انتهاء العمل بالشركة هنا" id="work_end"><span class="master_message color--fadegreen">
                                    @if ($errors->has('resign_date'))
                                    {{ $errors->first('resign_date')}}
                                    @endif</span>
                        </div>
                      </div>
                      <div class="col-md-4 col-sm-6 col-xs-12">
                        <div class="master_field">
                          <label class="master_label mandatory" for="work_type">نوع العمل</label>
                          <select name="work_type" class="master_input select2" id="work_type" data-placeholder="نوع العمل " style="width:100%;" ,>
                          <option value="choose" selected disabled>اختر نوع العمل</option>
                          @foreach($types as $type)
                            <option value="{{$type->id}}">{{$type->name_ar}}</option>
                            @endforeach
                          </select><span class="master_message color--fadegreen">
                                  @if ($errors->has('work_type'))
                                    {{ $errors->first('work_type')}}
                                    @endif</span>
                        </div>
                      </div>
                      <div class="clearfix"></div>
                    </div>
                    <div class="main-title-conts">
                      <div class="caption">
                        <h3>مستندات المحامي</h3>
                      </div>
                      <div class="actions">
                      </div><span class="mainseparator bgcolor--main"></span>
                    </div>
                    <div class="cardwrap bgcolor--white bradius--noborder   bshadow--1 padding--small margin--small-top-bottom">
                      <div class="col-md-4 col-sm-6 col-xs-12">
                        <div class="master_field">
                          <label class="master_label mandatory" for="lawyer_authorization">صورة التوكيل</label>
                          <div class="file-upload">
                            <div class="file-select">
                              <div class="file-select-name" id="noFile">اضغط هنا لرفع صورة التوكيل</div>
                              <input name="authorization_copy" class="chooseFile" type="file" name="chooseFile" id="lawyer_authorization">
                            </div>
                          </div><span class="master_message color--fadegreen">
                                    @if ($errors->has('authorization_copy'))
                                    {{ $errors->first('authorization_copy')}}
                                    @endif</span>
                        </div>
                      </div>
                      <div class="col-md-4 col-sm-6 col-xs-12">
                        <div class="master_field">
                          <label class="master_label mandatory" for="lawyer_degree_in">درجة القيد بالنقابة </label>
                          <input name="syndicate_level" value="{{ old('syndicate_level') }}" class="master_input" type="text" placeholder="درجة القيد بالنقابة .." id="lawyer_degree_in"><span class="master_message color--fadegreen">
                                  @if ($errors->has('syndicate_level'))
                                    {{ $errors->first('syndicate_level')}}
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
                      <div class="clearfix"></div>
                      <div class="col-md-2 col-sm-6 col-xs-6">
                        <button class="master-btn undefined btn-block color--white bgcolor--fadepurple bradius--small bshadow--0" type="submit"><i class="fa fa-save"></i><span>حفظ</span>
                        </button>
                      </div>
                      <div class="col-md-2 col-sm-6 col-xs-6">
                        <a href="{{route('lawyers')}}"><button class="master-btn undefined btn-block color--white bgcolor--fadebrown bradius--small bshadow--0" type="button"><i class="fa fa-times"></i><span>الغاء</span>
                        </button></a>
                      </div>
                    </form>
                      <div class="clearfix"></div><br>
                    </div>
                  </div>
                </div>
              </div>
@endsection