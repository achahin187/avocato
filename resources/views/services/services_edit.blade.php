@extends('layout.app')
@section('content')


              <div class="row">
                <div class="col-lg-12">
                  <div class="cover-inside-container margin--small-top-bottom bradius--small bshadow--1" style="background:  url( '{{asset('img/covers/dummy2.jpg')}}' ) no-repeat center center; background-size:cover;">
                    <div class="edit-mode">Editing mode</div>
                    <div class="row">
                      <div class="col-xs-12">
                        <div class="text-xs-center">
                          <div class="text-wraper">
                            <h4 class="cover-inside-title color--gray_d">القضايا و الخدمات <i class="fa fa-chevron-circle-right"></i>
                              <h4 class="cover-inside-title color--gray_d">الخدمات </h4>
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
                        <label class="master_label mandatory" for="client_cade">كود العميل</label>
                        <input class="master_input" type="text" placeholder="كود العميل .." id="client_cade"><span class="master_message color--fadegreen">message</span>
                      </div>
                    </div>
                    <div class="col-xs-6">
                      <div class="master_field">
                        <label class="master_label mandatory" for="client_name">اسم العميل</label>
                        <input class="master_input" type="text" placeholder="اسم العميل .." id="client_name"><span class="master_message color--fadegreen">message</span>
                      </div>
                    </div>
                    <div class="col-xs-6">
                      <div class="master_field">
                        <label class="master_label mandatory" for="client_name">الرقم القومي</label>
                        <input class="master_input" type="number" placeholder="الرقم القومي .." id="client_name"><span class="master_message color--fadegreen">message</span>
                      </div>
                    </div>
                    <div class="col-xs-6">
                      <div class="master_field">
                        <label class="master_label mandatory" for="client_address">عنوان العميل</label>
                        <input class="master_input" type="text" placeholder="عنوان العميل .." id="client_address"><span class="master_message color--fadegreen">message</span>
                      </div>
                    </div>
                    <div class="col-xs-6">
                      <div class="master_field">
                        <label class="master_label mandatory" for="service_type">نوع الخدمة</label>
                        <select class="master_input select2" id="service_type" style="width:100%;">
                          <option>نوع 1</option>
                          <option> نوع 2</option>
                          <option>نوع 3</option>
                        </select><span class="master_message color--fadegreen">message</span>
                      </div>
                    </div>
                    <div class="col-xs-6">
                      <div class="master_field">
                        <label class="master_label mandatory" for="fees">رسوم الخدمة</label>
                        <input class="master_input" type="number" placeholder="رسوم الدعوى" id="fees"><span class="master_message color--fadegreen">message</span>
                      </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="col-md-2 col-xs-6">
                      <button class="master-btn undefined btn-block color--white bgcolor--fadepurple bradius--small bshadow--0" type="submit"><i class="fa fa-save"></i><span>حفظ</span>
                      </button>
                    </div>
                    <div class="col-md-2 col-xs-6">
                      <button class="master-btn undefined btn-block color--white bgcolor--fadebrown bradius--small bshadow--0" type="submit"><i class="fa fa-times"></i><span>الغاء</span>
                      </button>
                    </div>
                    <div class="clearfix"></div><br>
                  </div>
                </div>
              </div>


@endsection