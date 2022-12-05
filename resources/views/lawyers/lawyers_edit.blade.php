@extends('layout.app')
@section('content')

<script> $(document).ready(function(){
        window.setTimeout(function() {
            $(".alert").fadeTo(500, 0).slideUp(500, function(){
                $(this).remove(); 
            });
        }, 4000);
  });</script>
        {{\Session::put('AppLocale', 1)}}
              <div class="row">
                <div class="col-lg-12">
                  <div class="cover-inside-container margin--small-top-bottom bradius--small bshadow--1" style="background:  url( '{{asset('img/covers/dummy2.jpg')}}' ) no-repeat center center; background-size:cover;">
                    <div class="edit-mode">Editing mode</div>
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
              <form role="form" action="{{route('lawyers_update',$lawyer->id)}}" method="post" enctype="multipart/form-data" accept-charset="utf-8">
                {{csrf_field()}}
                    <div class="cardwrap bgcolor--white bradius--noborder   bshadow--1 padding--small margin--small-top-bottom">
                      <div class="col-md-4 col-sm-6 col-xs-12">
                        <div class="master_field">
                          <label class="master_label" for="lawyer_code">كود المحامى</label>
                          <input value="{{$lawyer->code}}" class="master_input" type="text" placeholder="كود المحامى .." id="lawyer_code" disabled="true">
                        </div>
                      </div>
                      @if(!Helper::is_lawyer_mobile($lawyer->id))
                      <div class="col-md-4 col-sm-6 col-xs-12">
                        <div class="master_field">
                          <label class="master_label" for="password">كلمة المرور</label>
                          <input value="{{$lawyer->client_password->password}}" class="master_input" type="text" placeholder="كلمة المرور .." id="password" disabled="true">
                        </div>
                      </div>
                      @endif
                      <div class="col-md-4 col-sm-6 col-xs-12">
                        <div class="master_field">
                          <label class="master_label mandatory" for="lawyer_name">اسم المحامى</label>
                          <input value="{{$lawyer->full_name}}" name="lawyer_name" class="master_input" type="text" placeholder="اسم المحامى .." id="lawyer_name"><span class="master_message color--fadegreen">
                                    @if ($errors->has('lawyer_name'))
                                    {{ $errors->first('lawyer_name')}}
                                    @endif</span> </span>
                        </div>
                      </div>
                      <div class="col-md-4 col-sm-6 col-xs-12">
                        <div class="master_field">
                          <label class="master_label mandatory" for="lawyer_address">عنوان المحامى</label>
                          <input value="{{$lawyer->address}}" name="address" class="master_input" type="text" placeholder="عنوان المحامى .." id="lawyer_address"><span class="master_message color--fadegreen"> 
                                    @if ($errors->has('address'))
                                    {{ $errors->first('address')}}
                                    @endif </span>
                        </div>
                      </div>
                      <div class="col-md-4 col-sm-6 col-xs-12">
                        <div class="master_field">
                          <label class="master_label mandatory" for="lawyer_id">الرقم القومى</label>
                          <input value="{{$lawyer->user_detail->national_id}}" name="national_id" class="master_input" type="text" placeholder="الرقم القومى" id="lawyer_id"><span class="master_message color--fadegreen">            
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
                            <option {{$lawyer->user_detail->nationality->id==$nationality->item_id ?'selected' : ''}} value="{{$nationality->item_id}}">{{$nationality->value}}</option>
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
                          <input value="{{date('m/d/Y', strtotime($lawyer->birthdate))}}" name="birthdate" class="datepicker master_input" type="text" placeholder="اكتب تاريخ الميلاد هنا" id="lawyer_birth"><span class="master_message color--fadegreen">
                                    @if ($errors->has('birthdate'))
                                    {{ $errors->first('birthdate')}}
                                    @endif </span>
                        </div>
                      </div>
                      <div class="col-md-4 col-sm-6 col-xs-12">
                        <div class="master_field">
                          <label class="master_label " for="lawyer_tel">رقم الهاتف</label>
                          <input value="{{$lawyer->phone}}" name="phone" class="master_input" type="text" placeholder="رقم الهاتف" id="lawyer_tel"><span class="master_message color--fadegreen">
                                   @if ($errors->has('phone'))
                                    {{ $errors->first('phone')}}
                                    @endif </span>
                        </div>
                      </div>
                      <div class="col-md-4 col-sm-6 col-xs-12">
                        <div class="master_field">
                          <label class="master_label mandatory" for="lawyer_mob">رقم الهاتف الجوال</label>
                          <div class="col-md-4">
                          <select  name="tele_code" class="master_input select2" id="tele_code"  style="width:100%;" >
                          <option value="choose" selected disabled>اختر الكود</option>
                            @foreach($codes as $code)
                            @if($lawyer->tele_code == $code->tele_code)
                            <option value="{{$code->tele_code}}" selected>{{$code->tele_code}}</option>

                            @else
                            <option value="{{$code->tele_code}}">{{$code->tele_code}}</option>

                            @endif
                              @endforeach
                          </select>
                          </div>
                          <div class="col-md-8">
                          <input name="cellphone" value="{{ $lawyer->cellphone }}" class="master_input" type="number" placeholder="1200000000" id="lawyer_mob">
                          <span class="master_message color--fadegreen">
                              @if ($errors->has('cellphone'))
                                {{ $errors->first('cellphone')}}
                              @endif
                          </span>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-4 col-sm-6 col-xs-12">
                        <div class="master_field">
                          <label class="master_label" for="lawyer_email">البريد الالكترونى</label>
                          <input value="{{$lawyer->email}}" name="email" class="master_input" type="email" placeholder="البريد الالكترونى" id="lawyer_email"><span class="master_message color--fadegreen">
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
                          <input name="is_active" value="1" class="icon" type="radio" name="icon" id="radbtn_2" {{$lawyer->is_active ? 'checked':''}}>
                          <label for="radbtn_2">مفعل</label>
                          <input name="is_active" value="0" class="icon" type="radio" name="icon" id="radbtn_3" {{!$lawyer->is_active ? 'checked':''}}>
                          <label for="radbtn_3">غير مفعل</label>
                        </div>
                      </div>

                      <div class="col-md-8 col-sm-12 col-xs-12">
                        <div class="master_field">
                          <label class="master_label" for="lawyer_info">نبذة عن المحامي</label>
                          <textarea class="master_input" name="note" id="lawyer_info" placeholder="نبذة">{{$lawyer->note}}</textarea>
                          <span class="master_message color--fadegreen">
                                  @if ($errors->has('note'))
                                    {{ $errors->first('note')}}
                                    @endif</span>
                        </div>
                      </div>

                      <div class="col-md-4 col-sm-6 col-xs-12">
                        <div class="master_field">
                          <label class="master_label mandatory" for="order">الترتيب</label>
                          <input name="order" value="{{$lawyer->order}}" class="master_input" type="number" min="1" placeholder="ترتيب المحامي" id="lawyer_order">
                            <span class="master_message color--fadegreen">
                              @if ($errors->has('order'))
                                {{ $errors->first('order')}}
                              @endif
                            </span> 
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
                    {{-- <div class="cardwrap bgcolor--white bradius--noborder   bshadow--1 padding--small margin--small-top-bottom"> --}}
                      
                      <div class="col-md-4 col-sm-6 col-xs-12">
                        <div class="master_field">
                          <label class="master_label mandatory" for="lawyer_type"> التخصص</label>
                          <select name="work_sector[]" class="master_input select2" id="lawyer_type" multiple="multiple" data-placeholder="التخصص" style="width:100%" >
                            @foreach($work_sectors as $work_sector)
                            <option  
                            @foreach($lawyer->specializations as $spec)
                            @if($spec->id == $work_sector->id)
                            {!!'selected'!!}
                            @endif
                            @endforeach
                            value="{{$work_sector->id}}">{{$work_sector->name}}</option>
                            @endforeach
                          </select><span class="master_message color--fadegreen">
                                  @if ($errors->has('work_sector'))
                                    {{ $errors->first('work_sector')}}
                                    @endif</span>
                        </div>
                      </div>

                      {{-- </div> --}}
                    <div class="col-md-4 col-sm-6 col-xs-12">
                        <div class="master_field">
                        <label class="master_label mandatory" for="lawyer_spec">الإختصاص المكاني </label>
                        <select name="work_sector_area" class="master_input select2">
                          <option value="choose" selected disabled>اختر التخصص المكانى</option>
                          @foreach($work_sector_areas as $area)
                          <option 
                          @if($lawyer->user_detail->work_sector_area_id == $area->id)
                          {!!'selected'!!}
                          @endif
                           value="{{$area->id}}">{{$area->name}}</option>
                          @endforeach
                        </select><span class="master_message color--fadegreen">                                        
                                  @if ($errors->has('work_sector_area'))
                                    {{ $errors->first('work_sector_area')}}
                                    @endif</span>
                        </div>
                      </div>

                      <div class="col-md-4 col-sm-6 col-xs-12">
                        <div class="master_field">
                          <label class="master_label mandatory" for="lawyer_degrees">درجة التقاضي</label>
                          <input value="{{$lawyer->user_detail->litigation_level}}" name="litigation_level" class="master_input" type="text" placeholder="درجة التقاضي.." id="lawyer_degrees"><span class="master_message color--fadegreen">
                                  @if ($errors->has('litigation_level'))
                                    {{ $errors->first('litigation_level')}}
                                    @endif</span>
                        </div>
                      </div>
                      <div class="col-md-4 col-sm-6 col-xs-12">
                        <div class="master_field">
                          <label class="master_label " for="work_start">تاريخ الالتحاق بالعمل</label>
                          <input  readonly value="{{$lawyer->user_detail->join_date}}" name="join_date" class="datepicker master_input" type="text" placeholder="اكتب تاريخ الالتحاق بالعمل هنا" id="work_start"><span class="master_message color--fadegreen">
                                  @if ($errors->has('join_date'))
                                    {{ $errors->first('join_date')}}
                                    @endif </span>
                        </div>
                      </div>
                      <div class="col-md-4 col-sm-6 col-xs-12">
                        <div class="master_field">
                          <label class="master_label" for="work_end"> تاريخ انتهاء العمل بالشركة</label>
                          <input readonly value="{{$lawyer->user_detail->resign_date}}" name="resign_date" class="datepicker master_input" type="text" placeholder="اكتب تاريخ انتهاء العمل بالشركة هنا" id="work_end"><span class="master_message color--fadegreen">
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
                            <option
                          
                             @foreach($lawyer->rules as $rule)
                            {{$rule->id==$type->id ? 'selected':''}}
                            
                            @endforeach
                            @if($type->id == 14 )
                            @if(Helper::is_lawyer_mobile($lawyer->id))
                            value="{{$type->id}}">{{$type->name_ar}}
                            @endif
                            @else
                            value="{{$type->id}}">{{$type->name_ar}}
                            @endif
                            </option>
                            @endforeach
                          </select><span class="master_message color--fadegreen">
                                  @if ($errors->has('work_type'))
                                    {{ $errors->first('work_type')}}
                                    @endif</span>
                        </div>
                      </div>

                    <div class="col-md-4 col-sm-6 col-xs-12">
                        <div class="master_field">
                          <label class="master_label" for="year_experience">سنوات الخبرة</label>
                          <input value="{{$lawyer->user_detail->experience}}" name="experience" class="master_input" type="number" placeholder="سنوات الخبرة" id="year_experience">
                        </div>
                      </div>
                      <div class="col-md-4 col-sm-6 col-xs-12">
                        <div class="master_field">
                          <label class="master_label mandatory" for="degree_id">الدرجة العلميه</label>
                          <select name="degree_id" class="master_input select2" id="degree_id" data-placeholder="الدرجة العلميه " style="width:100%;" ,>
                          <option value="choose" selected disabled>اختر الدرجة العلميه</option>
                          @foreach($academic_degrees as $academic_degree)
                            <option value="{{$academic_degree->id}}" @if ($academic_degree->id == $lawyer->degree_id) selected @endif>{{$academic_degree->title }} ({{ $academic_degree->from }} - {{ $academic_degree->to }})</option>
                          @endforeach
                          </select><span class="master_message color--fadegreen">
                            @if ($errors->has('degree_id'))
                              {{ $errors->first('degree_id')}}
                            @endif
                          </span>
                        </div>
                      </div>
                      <div class="col-md-2 col-sm-6 col-xs-6">
                        <div class="master_field">
                          <label class="master_label mandatory" for="consultation_cost">سعر الإستشارة</label>
                          <input value="{{$lawyer->user_detail->consultation_price}}" name="consultation_price" class="master_input" type="number" placeholder="سعر الإستشارة" id="consultation_cost"><span class="master_message color--fadegreen">
                                @if ($errors->has('consultation_price'))
                                    {{ $errors->first('consultation_price')}}
                                    @endif</span>
                        </div>
                      </div>
                      <div class="col-md-2 col-sm-6 col-xs-6">
                        <div class="master_field">
                          <label class="master_label mandatory" for="currency">العملة</label>
                          <select name="currency_id" class="master_input" id="currency">
                            @foreach($currencies as $currency)
                            <option @if($currency->id == $lawyer->user_detail->currency_id) selected @endif value="{{$currency->id}}">{{$currency->currency}}</option>
                            @endforeach
                          </select>
                          <span class="master_message color--fadegreen">
                            @if ($errors->has('currency_id'))
                                    {{ $errors->first('currency_id')}}
                            @endif
                          </span>
                        </div>
                      </div>
                      <div class="clearfix"></div>
                    <div class="col-md-4 col-sm-6 col-xs-12">
                        <div class="master_field">
                          <label class="master_label">مدرج بجدول محكمي وزارة العدل؟</label>
                          <div class="funkyradio">
                            <input {{$lawyer->user_detail->is_international_arbitrator ? 'checked' : ''}} value="1" name="is_international_arbitrator" type="checkbox" name="radio" id="is_judge">
                            <label for="is_judge">مدرج</label>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-8 col-sm-6 col-xs-12">
                        <div class="master_field">
                          <label class="master_label" for="judge_res">التخصص كمحكم في وزارة العدل</label>
                          <input value="{{$lawyer->user_detail->international_arbitrator_specialization}}" name="international_arbitrator_specialization" class="master_input" type="text" placeholder="التخصص كمحكم في وزارة العدل " id="judge_res"><span class="master_message color--fadegreen"> </span>
                        </div>
                      </div>

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
                         <select name="syndicate_level_id" class="master_input" id="syndicate_level_id">
                          <option value="choose" selected disabled>اختر درجه القيد بالنقابه</option>
                          @foreach($syndicate_levels as $syndicate)
                          <option @if($lawyer->user_detail->syndicate_level_id == $syndicate->id)
                          selected @endif value="{{$syndicate->id}}">{{$syndicate->name}}</option>
                          @endforeach
                          </select><span class="master_message color--fadegreen">
                                  @if ($errors->has('syndicate_level_id'))
                                    {{ $errors->first('syndicate_level_id')}}
                                    @endif</span>
                        </div>
                      </div>

                      <div class="col-md-4 col-sm-6 col-xs-12">
                        <div class="master_field">
                          <label class="master_label mandatory" for="lawyer_card">صورة كارنيه النقابة</label>
                          <div class="file-upload">
                            <div class="file-select">
                              <div class="file-select-name" id="noFile">اضغط هنا لرفع صورة كارنية النقابة</div>
                              <input value="{{$lawyer->user_detail->syndicate_copy}}" name="syndicate_copy" class="chooseFile" type="file" name="chooseFile" id="lawyer_card">
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
                       <a href="{{route('lawyers_follow')}}"> <button class="master-btn undefined btn-block color--white bgcolor--fadebrown bradius--small bshadow--0" type="button"><i class="fa fa-times"></i><span>الغاء</span>
                        </button></a>
                      </div>
                    </form>
                      <div class="clearfix"></div><br>
                    </div>
                  </div>
                </div>
              </div>
@endsection