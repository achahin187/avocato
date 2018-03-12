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
                <div class="col-lg-12">
                  <div class="cardwrap bgcolor--white bradius--noborder   bshadow--1 padding--small margin--small-top-bottom">
                    <div class="col-xs-6">
                      <div class="master_field">
                        <label class="master_label mandatory" for="ID_No">رقم الاعلان</label>
                        <input class="master_input" type="number" placeholder="رقم الاعلان" id="ID_No">
                      </div>
                    </div>
                    <div class="col-xs-6">
                      <div class="master_field">
                        <label class="master_label mandatory" for="ID_No">قلم المحضرين</label>
                        <input class="master_input" type="text" placeholder="قلم المحضرين" id="ID_No">
                      </div>
                    </div>
                    <div class="col-xs-6">
                      <div class="master_field">
                        <label class="master_label mandatory" for="ID_No">اسم الموكل</label>
                        <input class="master_input" type="text" placeholder="اسم الموكل" id="ID_No">
                      </div>
                    </div>
                    <div class="col-xs-6">
                      <div class="master_field">
                        <label class="master_label mandatory" for="ID_No">تاريخ التسليم</label>
                        <input class="datepicker-popup master_input" type="text" placeholder="تاريخ التسليم" id="ID_No">
                      </div>
                    </div>
                    <div class="col-xs-6">
                      <div class="master_field">
                        <label class="master_label mandatory" for="ID_No">تاريخ التسلم</label>
                        <input class="datepicker-popup master_input" type="text" placeholder="تاريخ التسلم" id="ID_No">
                      </div>
                    </div>
                    <div class="col-xs-6">
                      <div class="master_field">
                        <label class="master_label mandatory" for="ID_No">تاريخ الجلسة</label>
                        <input class="datepicker-popup master_input" type="text" placeholder="تاريخ الجلسة" id="ID_No">
                      </div>
                    </div>
                    <div class="col-xs-6">
                      <div class="master_field">
                        <label class="master_label mandatory" for="ID_No">ملاحظات</label>
                        <textarea class="master_input" name="textarea" id="ID_No" placeholder="ملاحظات"></textarea>
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
