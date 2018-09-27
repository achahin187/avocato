 @extends('layout.app')             
 @section('content')

              <div class="row">
                <div class="col-lg-12">
                  <div class="cover-inside-container margin--small-top-bottom bradius--small bshadow--1" style="background:  url( '{{asset('img/covers/dummy2.jpg ' )}}') no-repeat center center; background-size:cover">
                    <div class="add-mode">Adding mode</div>
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
              <form role="form" action="{{route('offices_store')}}" method="post" enctype="multipart/form-data" accept-charset="utf-8">
                {{csrf_field()}}
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
                          <input class="master_input" type="text" placeholder="اسم المكتب .." id="office_name" name="office_name"><span class="master_message color--fadegreen">message </span>
                        </div>
                      </div>
                      <div class="col-md-4 col-sm-6 col-xs-12">
                        <div class="master_field">
                          <label class="master_label mandatory" for="office_address">عنوان المكتب</label>
                          <input class="master_input" type="text" placeholder="عنوان المكتب .." id="office_address"><span class="master_message color--fadegreen">message </span>
                        </div>
                      </div>
                      <div class="col-md-4 col-sm-6 col-xs-12">
                        <div class="master_field">
                          <label class="master_label mandatory" for="office_city">المدينة </label>
                          <input class="master_input" type="text" placeholder="المدينة .." id="office_city"><span class="master_message color--fadegreen">message </span>
                        </div>
                      </div>
                      <div class="col-md-4 col-sm-6 col-xs-12">
                        <div class="master_field">
                          <label class="master_label mandatory" for="office_tel">رقم الهاتف</label>
                          <input class="master_input" type="number" placeholder="رقم الهاتف" id="office_tel"><span class="master_message color--fadegreen">message</span>
                        </div>
                      </div>
                      <div class="col-md-4 col-sm-6 col-xs-12">
                        <div class="master_field">
                          <label class="master_label" for="office_email">البريد الالكترونى</label>
                          <input class="master_input" type="email" placeholder="البريد الالكترونى" id="office_email"><span class="master_message color--fadegreen">message</span>
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
                              <input name="attorney_form" class="chooseFile" type="file" name="chooseFile" id="lawyer_authorization">
                            </div>
                          </div><span class="master_message color--fadegreen">
                                    @if ($errors->has('attorney_form'))
                                    {{ $errors->first('attorney_form')}}
                                    @endif</span>
                        </div>
                      </div>
                      <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="master_field">
                          <label class="master_label" for="office_info">نبذة عن المكتب</label>
                          <textarea class="master_input" name="textarea" id="office_info" placeholder="نبذة"></textarea><span class="master_message color--fadegreen">message</span>
                        </div>
                      </div>
                      <div class="col-md-4 col-sm-6 col-xs-12">
                        <div class="master_field">
                          <label class="master_label mandatory">تفعيل المكتب</label>
                          <input class="icon" type="radio" name="icon" id="active_1" checked="true">
                          <label for="active_1">مفعل</label>
                          <input class="icon" type="radio" name="icon" id="active_2">
                          <label for="active_2">غير مفعل</label>
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
                          <input class="master_input" type="text" placeholder="اسم الممثل القانوني" id="rep_name"><span class="master_message color--fadegreen">message </span>
                        </div>
                      </div>
                      <div class="col-md-4 col-sm-6 col-xs-12">
                        <div class="master_field">
                          <label class="master_label mandatory" for="rep_birth">تاريخ الميلاد</label>
                          <input class="datepicker-popup master_input" type="text" placeholder="placeholder" id="rep_birth"><span class="master_message color--fadegreen">message</span>
                        </div>
                      </div>
                      <div class="col-md-4 col-sm-6 col-xs-12">
                        <div class="master_field">
                          <label class="master_label mandatory" for="rep_id">رقم البطاقة</label>
                          <input class="master_input" type="number" placeholder="رقم بطاقة الممثل القانوني" id="rep_id"><span class="master_message color--fadegreen">message </span>
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
                      </div>
                      <div class="col-md-4 col-sm-6 col-xs-12">
                        <div class="master_field">
                          <label class="master_label mandatory" for="rep_type"> التخصص</label>
                          <select class="master_input select2" id="rep_type" multiple="multiple" data-placeholder="التخصص" style="width:100%" >
                            <option>تعويضات</option>
                            <option>تخصص اخر</option>
                          </select><span class="master_message color--fadegreen">message</span>
                        </div>
                      </div>
                      <div class="col-md-4 col-sm-6 col-xs-12">
                        <div class="master_field">
                          <label class="master_label mandatory" for="rep_spec">الإختصاص المكاني </label>
                          <input class="master_input" type="text" placeholder="الإختصاص المكاني" id="rep_spec"><span class="master_message color--fadegreen">message </span>
                        </div>
                      </div>
                      <div class="col-md-4 col-sm-6 col-xs-12">
                        <div class="master_field">
                          <label class="master_label mandatory" for="rep_degrees">درجة التقاضي</label>
                          <input class="master_input" type="text" placeholder="درجة التقاضي.." id="rep_degrees"><span class="master_message color--fadegreen">message</span>
                        </div>
                      </div>
                      <div class="col-md-4 col-sm-6 col-xs-12">
                        <div class="master_field">
                          <label class="master_label mandatory" for="office_card">صورة كارنيه النقابة</label>
                          <div class="file-upload">
                            <div class="file-select">
                              <div class="file-select-name" id="noFile">اضغط هنا لرفع صورة كارنية النقابة</div>
                              <input class="chooseFile" type="file" name="chooseFile" id="office_card">
                            </div>
                          </div><span class="master_message color--fadegreen">message</span>
                        </div>
                      </div>
                      <div class="col-md-4 col-sm-6 col-xs-12">
                        <div class="master_field">
                          <label class="master_label mandatory" for="rep_img">صورة</label>
                          <div class="file-upload">
                            <div class="file-select">
                              <div class="file-select-name" id="noFile">اضغط هنا لرفع صورة للممثل القانوني</div>
                              <input class="chooseFile" type="file" name="chooseFile" id="rep_img">
                            </div>
                          </div><span class="master_message color--fadegreen">message</span>
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
                        <div class="col-md-4 col-sm-6 col-xs-12">
                          <div class="master_field">
                            <label class="master_label mandatory" for="branch_name">اسم الفرع</label>
                            <input class="master_input" type="text" placeholder="اسم الفرع..." id="branch_name"><span class="master_message color--fadegreen">message </span>
                          </div>
                        </div>
                        <div class="col-md-4 col-sm-6 col-xs-12">
                          <div class="master_field">
                            <label class="master_label mandatory" for="branch_address">عنوان الفرع</label>
                            <input class="master_input" type="text" placeholder="عنوان الفرع..." id="branch_address"><span class="master_message color--fadegreen">message </span>
                          </div>
                        </div>
                        <div class="col-md-4 col-sm-6 col-xs-12">
                          <div class="master_field">
                            <label class="master_label mandatory" for="lawyer_type">الدولة</label>
                            <select class="master_input" id="lawyer_type">
                              <option>القاهرة</option>
                              <option>الأسكندرية</option>
                            </select><span class="master_message color--fadegreen">message</span>
                          </div>
                        </div>
                        <div class="col-md-4 col-sm-6 col-xs-12">
                          <div class="master_field">
                            <label class="master_label mandatory" for="branch_city">المدينة </label>
                            <input class="master_input" type="text" placeholder="المدينة .." id="branch_city"><span class="master_message color--fadegreen">message </span>
                          </div>
                        </div>
                        <div class="col-md-4 col-sm-6 col-xs-12">
                          <div class="master_field">
                            <label class="master_label mandatory" for="branch_tel">رقم الهاتف</label>
                            <input class="master_input" type="number" placeholder="رقم الهاتف" id="branch_tel"><span class="master_message color--fadegreen">message</span>
                          </div>
                        </div>
                        <div class="col-md-4 col-sm-6 col-xs-12">
                          <div class="master_field">
                            <label class="master_label" for="branch_email">البريد الالكترونى</label>
                            <input class="master_input" type="email" placeholder="البريد الالكترونى" id="branch_email"><span class="master_message color--fadegreen">message</span>
                          </div>
                        </div>
                      </div>
                      <div id="branches"></div>
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


 @endsection