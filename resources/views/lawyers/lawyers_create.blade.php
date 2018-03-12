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
                            <h4 class="cover-inside-title color--gray_d">السادة المحامين</h4>
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
                        <input class="master_input" type="text" placeholder="اسم المحامى .." id="lawyer_name"><span class="master_message color--fadegreen">message </span>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6 col-xs-12">
                      <div class="master_field">
                        <label class="master_label mandatory" for="lawyer_address">عنوان المحامى</label>
                        <input class="master_input" type="text" placeholder="عنوان المحامى .." id="lawyer_address"><span class="master_message color--fadegreen">message </span>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6 col-xs-12">
                      <div class="master_field">
                        <label class="master_label mandatory" for="lawyer_id">الرقم القومى</label>
                        <input class="master_input" type="number" placeholder="الرقم القومى" id="lawyer_id"><span class="master_message color--fadegreen">message</span>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6 col-xs-12">
                      <div class="master_field">
                        <label class="master_label mandatory" for="lawyer_nationality">الجنسية </label>
                        <input class="master_input" type="text" placeholder="الجنسية" id="lawyer_nationality"><span class="master_message color--fadegreen">message </span>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6 col-xs-12">
                      <div class="master_field">
                        <label class="master_label mandatory" for="lawyer_birth">تاريخ الميلاد</label>
                        <input class="datepicker-popup master_input" type="text" placeholder="placeholder" id="lawyer_birth"><span class="master_message color--fadegreen">message</span>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6 col-xs-12">
                      <div class="master_field">
                        <label class="master_label mandatory" for="lawyer_tel">رقم الهاتف</label>
                        <input class="master_input" type="number" placeholder="رقم الهاتف" id="lawyer_tel"><span class="master_message color--fadegreen">message</span>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6 col-xs-12">
                      <div class="master_field">
                        <label class="master_label mandatory" for="lawyer_mob">رقم الهاتف الجوال</label>
                        <input class="master_input" type="number" placeholder="رقم الهاتف الجوال" id="lawyer_mob"><span class="master_message color--fadegreen">message</span>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6 col-xs-12">
                      <div class="master_field">
                        <label class="master_label" for="lawyer_email">البريد الالكترونى</label>
                        <input class="master_input" type="email" placeholder="البريد الالكترونى" id="lawyer_email"><span class="master_message color--fadegreen">message</span>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6 col-xs-12">
                      <div class="master_field">
                        <label class="master_label mandatory" for="lawyer_img">صورة شخصية</label>
                        <div class="file-upload">
                          <div class="file-select">
                            <div class="file-select-name" id="noFile">اضغط هنا لرفع الصورة الشخصية للمحامى</div>
                            <input class="chooseFile" type="file" name="chooseFile" id="lawyer_img">
                          </div>
                        </div><span class="master_message color--fadegreen">message</span>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6 col-xs-12">
                      <div class="master_field">
                        <label class="master_label mandatory">تفعيل المحامي</label>
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
                      <h3>معلومات العمل</h3>
                    </div>
                    <div class="actions">
                    </div><span class="mainseparator bgcolor--main"></span>
                  </div>
                  <div class="cardwrap bgcolor--white bradius--noborder   bshadow--1 padding--small margin--small-top-bottom">
                    <div class="col-md-4 col-sm-6 col-xs-12">
                      <div class="master_field">
                        <label class="master_label mandatory" for="lawyer_type"> التخصص</label>
                        <select class="master_input select2" id="lawyer_type" multiple="multiple" data-placeholder="التخصص" style="width:100%;" ,>
                          <option>تعويضات</option>
                          <option>تخصص اخر</option>
                        </select><span class="master_message color--fadegreen">message</span>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6 col-xs-12">
                      <div class="master_field">
                        <label class="master_label mandatory" for="lawyer_spec">الإختصاص المكاني </label>
                        <input class="master_input" type="text" placeholder="الإختصاص المكاني" id="lawyer_spec"><span class="master_message color--fadegreen">message </span>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6 col-xs-12">
                      <div class="master_field">
                        <label class="master_label mandatory" for="work_start">تاريخ الالتحاق بالعمل</label>
                        <input class="datepicker-popup master_input" type="text" placeholder="placeholder" id="work_start"><span class="master_message color--fadegreen">message</span>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6 col-xs-12">
                      <div class="master_field">
                        <label class="master_label mandatory" for="work_end"> تاريخ انتهاء العمل بالشركة</label>
                        <input class="datepicker-popup master_input" type="text" placeholder="placeholder" id="work_end"><span class="master_message color--fadegreen">message</span>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6 col-xs-12">
                      <div class="master_field">
                        <label class="master_label mandatory" for="work_type">نوع العمل</label>
                        <select class="master_input select2" id="work_type" multiple="multiple" data-placeholder="نوع العمل " style="width:100%;" ,>
                          <option>معين بالمكتب</option>
                          <option>Freelancer</option>
                        </select><span class="master_message color--fadegreen">message</span>
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
                            <input class="chooseFile" type="file" name="chooseFile" id="lawyer_authorization">
                          </div>
                        </div><span class="master_message color--fadegreen">message</span>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6 col-xs-12">
                      <div class="master_field">
                        <label class="master_label mandatory" for="lawyer_degree_in">درجة القيد بالنقابة </label>
                        <input class="master_input" type="text" placeholder="درجة القيد بالنقابة .." id="lawyer_degree_in"><span class="master_message color--fadegreen">message</span>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6 col-xs-12">
                      <div class="master_field">
                        <label class="master_label mandatory" for="lawyer_card">صورة كارنيه النقابة</label>
                        <div class="file-upload">
                          <div class="file-select">
                            <div class="file-select-name" id="noFile">اضغط هنا لرفع صورة كارنية النقابة</div>
                            <input class="chooseFile" type="file" name="chooseFile" id="lawyer_card">
                          </div>
                        </div><span class="master_message color--fadegreen">message</span>
                      </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="col-md-2 col-md-4 col-sm-6 col-xs-12">
                      <button class="master-btn undefined btn-block color--white bgcolor--fadepurple bradius--small bshadow--0" type="submit"><i class="fa fa-save"></i><span>حفظ</span>
                      </button>
                    </div>
                    <div class="col-md-2 col-md-4 col-sm-6 col-xs-12">
                      <button class="master-btn undefined btn-block color--white bgcolor--fadebrown bradius--small bshadow--0" type="submit"><i class="fa fa-times"></i><span>الغاء</span>
                      </button>
                    </div>
                    <div class="clearfix"></div><br>
                  </div>
                </div>
              </div>

@endsection