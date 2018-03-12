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
                <div class="col-lg-12">
                  <div class="cardwrap bgcolor--white bradius--noborder   bshadow--1 padding--small margin--small-top-bottom">
                    <div class="col-xs-6">
                      <div class="master_field">
                        <label class="master_label mandatory" for="client_code">كود العميل</label>
                        <input class="master_input" type="text" placeholder="كود العميل .." id="client_code"><span class="master_message color--fadegreen">message</span>
                      </div>
                    </div>
                    <div class="col-xs-6">
                      <div class="master_field">
                        <label class="master_label mandatory" for="password">كلمة المرور</label>
                        <input class="master_input" type="text" placeholder="كلمة المرور .." id="password"><span class="master_message color--fadegreen">message </span>
                      </div>
                    </div>
                    <div class="col-xs-6">
                      <div class="master_field">
                        <label class="master_label mandatory" for="client_name">اسم العميل</label>
                        <input class="master_input" type="text" placeholder="اسم العميل .." id="client_name"><span class="master_message color--fadegreen">message </span>
                      </div>
                    </div>
                    <div class="col-xs-6">     
                      <div class="master_field">
                        <label class="master_label mandatory" for="client_type">النوع</label>
                        <select class="master_input select2" id="client_type" style="width:100%;">
                          <option>ذكر</option>
                          <option>انثى</option>
                        </select><span class="master_message color--fadegreen">message</span>
                      </div>
                    </div>
                    <div class="col-xs-6">
                      <div class="master_field">
                        <label class="master_label mandatory" for="client_job">المسمى الوظيفي </label>
                        <input class="master_input" type="text" placeholder="المسمى الوظيفي  .." id="client_job"><span class="master_message color--fadegreen">message </span>
                      </div>
                    </div>
                    <div class="col-xs-6">
                      <div class="master_field">
                        <label class="master_label mandatory" for="client_address">عنوان العميل</label>
                        <input class="master_input" type="text" placeholder="عنوان العميل .." id="client_address"><span class="master_message color--fadegreen">message </span>
                      </div>
                    </div>
                    <div class="col-xs-6">
                      <div class="master_field">
                        <label class="master_label mandatory" for="client_id">الرقم القومى</label>
                        <input class="master_input" type="number" placeholder="الرقم القومى" id="client_id"><span class="master_message color--fadegreen">message</span>
                      </div>
                    </div>
                    <div class="col-xs-6">
                      <div class="master_field">
                        <label class="master_label mandatory" for="client_birth">تاريخ الميلاد</label>
                        <input class="datepicker-popup master_input" type="text" placeholder="placeholder" id="client_birth"><span class="master_message color--fadegreen">message</span>
                      </div>
                    </div>
                    <div class="col-xs-6">
                      <div class="master_field">
                        <label class="master_label mandatory" for="client_nationality">الجنسية </label>
                        <input class="master_input" type="text" placeholder="الجنسية" id="client_nationality"><span class="master_message color--fadegreen">message </span>
                      </div>
                    </div>
                    <div class="col-xs-6">
                      <div class="master_field">
                        <label class="master_label mandatory" for="client_tel">رقم الهاتف</label>
                        <input class="master_input" type="number" placeholder="رقم الهاتف" id="client_tel"><span class="master_message color--fadegreen">message</span>
                      </div>
                    </div>
                    <div class="col-xs-6">
                      <div class="master_field">
                        <label class="master_label mandatory" for="client_mob">رقم الهاتف الجوال</label>
                        <input class="master_input" type="number" placeholder="رقم الهاتف الجوال" id="client_mob"><span class="master_message color--fadegreen">message</span>
                      </div>
                    </div>
                    <div class="col-xs-6">
                      <div class="master_field">
                        <label class="master_label" for="client_email">البريد الالكترونى</label>
                        <input class="master_input" type="email" placeholder="البريد الالكترونى" id="client_email"><span class="master_message color--fadegreen">message</span>
                      </div>
                    </div>
                    <div class="col-xs-6">
                      <div class="master_field">
                        <label class="master_label mandatory" for="works">قطاع الأعمال </label>
                        <input class="master_input" type="text" placeholder="  .." id="works"><span class="master_message color--fadegreen">message </span>
                      </div>
                    </div>
                    <div class="col-xs-6">
                      <div class="master_field">
                        <label class="master_label mandatory" for="works_types">نوع قطاع الأعمال </label>
                        <input class="master_input" type="text" placeholder="  .." id="works_types"><span class="master_message color--fadegreen">message </span>
                      </div>
                    </div>
                    <div class="col-xs-6">
                      <div class="master_field">
                        <label class="master_label mandatory" for="client_img">صورة شخصية</label>
                        <div class="file-upload">
                          <div class="file-select">
                            <div class="file-select-name" id="noFile">اضغط هنا لرفع الصورة الشخصية للعميل </div>
                            <input class="chooseFile" type="file" name="chooseFile" id="client_img">
                          </div>
                        </div><span class="master_message color--fadegreen">message</span>
                      </div>
                    </div>
                    <div class="col-xs-3">
                      <div class="master_field">
                        <label class="master_label mandatory" for="client_discount">نسبة الخصم </label>
                        <input class="master_input" type="number" placeholder="%" id="client_discount"><span class="master_message color--fadegreen">message</span>
                      </div>
                    </div>
                    <div class="col-xs-3">
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
                    <div class="col-xs-6">
                      <div class="master_field">
                        <label class="master_label mandatory" for="license_start_date">تاريخ بدء التعاقد</label>
                        <input class="datepicker-popup master_input" type="text" placeholder="placeholder" id="license_start_date"><span class="master_message color--fadegreen">message</span>
                      </div>
                    </div>
                    <div class="col-xs-6">
                      <div class="master_field">
                        <label class="master_label mandatory" for="license_end_date">تاريخ  نهاية التعاقد</label>
                        <input class="datepicker-popup master_input" type="text" placeholder="placeholder" id="license_end_date"><span class="master_message color--fadegreen">message</span>
                      </div>
                    </div>
                    <div class="col-xs-6">
                      <div class="master_field">
                        <label class="master_label mandatory" for="license_type">نوع التعاقد</label>
                        <select class="master_input select2" id="license_type" style="width:100%;">
                          <option>فضى</option>
                          <option>ذهبى</option>
                          <option>بلاتينى</option>
                        </select><span class="master_message color--fadegreen">message</span>
                      </div>
                    </div>
                    <div class="col-xs-6">
                      <div class="master_field">
                        <label class="master_label mandatory" for="license_period">مدة التعاقد</label>
                        <input class="master_input" type="number" placeholder="0" id="license_period"><span class="master_message color--fadegreen">message</span>
                      </div>
                    </div>
                    <div class="col-xs-6">
                      <div class="master_field">
                        <label class="master_label mandatory" for="license_fees">قيمة التعاقد</label>
                        <input class="master_input" type="number" placeholder="قيمة التعاقد" id="license_fees"><span class="master_message color--fadegreen">message</span>
                      </div>
                    </div>
                    <div class="col-xs-6">
                      <div class="master_field">
                        <label class="master_label mandatory" for="license_num">عدد الاقساط</label>
                        <input class="master_input" type="number" placeholder="عدد الاقساط" id="license_num"><span class="master_message color--fadegreen">message</span>
                      </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="col-xs-4">
                      <div class="master_field">
                        <label class="master_label mandatory" for="premium1_amount">قيمة القسط الاول</label>
                        <input class="master_input" type="number" placeholder="قيمة القسط الاول" id="premium1_amount"><span class="master_message color--fadegreen">message</span>
                      </div>
                    </div>
                    <div class="col-xs-4">
                      <div class="master_field">
                        <label class="master_label mandatory" for="premium1_date">تاريخ  سداد القسط الاول</label>
                        <input class="datepicker-popup master_input" type="text" placeholder="placeholder" id="premium1_date"><span class="master_message color--fadegreen">message</span>
                      </div>
                    </div>
                    <div class="col-xs-4">
                      <div class="master_field">
                        <label class="master_label">حالة السداد للقسط الاول</label>
                        <div class="radiorobo">
                          <input type="radio" id="rad_1">
                          <label for="rad_1">نعم</label>
                        </div>
                        <div class="radiorobo">
                          <input type="radio" id="rad_2">
                          <label for="rad_2">لا</label>
                        </div><span class="master_message color--fadegreen">message</span>
                      </div>
                    </div>
                    <div class="col-xs-4">
                      <div class="master_field">
                        <label class="master_label mandatory" for="premium2_amount">قيمة القسط الثانى</label>
                        <input class="master_input" type="number" placeholder="قيمة القسط الثانى" id="premium2_amount"><span class="master_message color--fadegreen">message</span>
                      </div>
                    </div>
                    <div class="col-xs-4">
                      <div class="master_field">
                        <label class="master_label mandatory" for="premium2_date">تاريخ  سداد القسط الثانى</label>
                        <input class="datepicker-popup master_input" type="text" placeholder="placeholder" id="premium2_date"><span class="master_message color--fadegreen">message</span>
                      </div>
                    </div>
                    <div class="col-xs-4">
                      <div class="master_field">
                        <label class="master_label">حالة السداد للقسط الثانى</label>
                        <div class="radiorobo">
                          <input type="radio" id="rad_4">
                          <label for="rad_4">نعم</label>
                        </div>
                        <div class="radiorobo">
                          <input type="radio" id="rad_5">
                          <label for="rad_5">لا</label>
                        </div><span class="master_message color--fadegreen">message</span>
                      </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="col-md-2 col-xs-6">
                      <button class="master-btn undefined btn-block color--white bgcolor--fadeblue bradius--small bshadow--0" type="submit"><i class="fa fa-file"></i><span>حفظ</span>
                      </button>
                    </div>
                    <div class="col-md-2 col-xs-6">
                      <button class="master-btn undefined btn-block color--white bgcolor--fadeorange bradius--small bshadow--0" type="submit"><i class="fa fa-times"></i><span>الغاء</span>
                      </button>
                    </div>
                    <div class="clearfix"></div><br>
                  </div>
                </div>
              </div>


@endsection