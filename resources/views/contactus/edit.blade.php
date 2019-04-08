@extends('layout.app')
@section('content')
  <!-- =============== Custom Content ===============-->
  <div class="row">
                <div class="col-lg-12">
                  <div class="cover-inside-container margin--small-top-bottom bradius--small bshadow--1" style="background:  url( '../img/covers/dummy2.jpg ' ) no-repeat center center; background-size:cover">
                    <div class="edit-mode">Editing mode</div>
                    <div class="row">
                      <div class="col-xs-12">
                        <div class="text-xs-center">
                          <div class="text-wraper">
                            <h4 class="cover-inside-title color--gray_d">البيانات الأساسية <i class="fa fa-chevron-circle-right"></i>
                              <h4 class="cover-inside-title color--gray_d">اتصل بنا </h4>
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
                    <div class="row">
                      <div class="col-xs-12">
                        <div class="main-title-conts">
                          <div class="caption">
                            <h3>بيانات الفرع</h3>
                          </div>
                          <div class="actions">
                          </div><span class="mainseparator bgcolor--main"></span>
                        </div>
                      </div>
                      <div class="col-md-4 col-sm-12" id="right">
                        <div class="col-md-10 col-xs-12">
                          <div class="master_field">
                            <label class="master_label mandatory" for="lang_list">اختار اللغة</label>
                            <select class="master_input" id="lang_list">
                              <option>العربية</option>
                              <option>English</option>
                              <option>French</option>
                            </select>
                          </div>
                        </div>
                        <div class="col-md-10 col-xs-10 has-add">
                          <div class="master_field">
                            <label class="master_label mandatory" for="branch_name">اسم الفرع</label>
                            <input class="master_input" type="text" placeholder="اسم الفرع..." id="branch_name" value="value"><span class="master_message color--fadegreen">message</span>
                          </div>
                        </div>
                        <div class="has-add">
                          <div class="col-md-10 col-xs-10 has-add">
                            <div class="master_field">
                              <label class="master_label mandatory" for="email1">الايميل</label>
                              <input class="master_input" type="email" placeholder="الايميل..." id="email1" value="value"><span class="master_message color--fadegreen">message</span>
                            </div>
                            <div id="more_email"></div>
                          </div>
                          <div class="col-md-2 col-xs-2">
                            <button class="input-btn" id="add_email"><i class="fa fa-plus-circle"></i></button>
                          </div>
                        </div>
                        <div class="has-add">
                          <div class="col-md-10 col-xs-10">
                            <div class="master_field">
                              <label class="master_label mandatory" for="tel1">التليفون</label>
                              <input class="master_input" type="number" placeholder="التليفون..." id="tel1" value="value"><span class="master_message color--fadegreen">message</span>
                            </div>
                            <div id="more_tel"></div>
                          </div>
                          <div class="col-md-2 col-xs-2">
                            <button class="input-btn" id="add_tel"><i class="fa fa-plus-circle"></i></button>
                          </div>
                        </div>
                        <div class="col-md-10 col-xs-12"><br>
                          <div class="funkyradio">
                            <input type="checkbox" name="radio" id="main_branch">
                            <label for="main_branch">الفرع الرئيسي</label>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-8 col-sm-12">
                        <div class="col-md-6 col-xs-12">
                          <div class="master_field">
                            <label class="master_label mandatory" for="address">العنوان</label>
                            <input class="master_input" type="text" placeholder="العنوان..." id="address" value="value"><span class="master_message color--fadegreen">message</span>
                          </div>
                        </div>
                        <div class="col-md-6 col-xs-12">
                          <div class="master_field">
                            <label class="master_label" for="address">الموقع</label>
                            <input class="master_input" type="text" placeholder="اختر الموقع من الخريطة..." id="address">
                          </div>
                        </div><br>
                        <div class="col-xs-12"><img class="img-responsive" id="left" src="../img/map2.jpg"></div>
                      </div>
                    </div>
                    <div class="clearfix"></div><br>
                    <div class="col-md-2 col-xs-6">
                      <button class="master-btn undefined btn-block color--white bgcolor--fadepurple bradius--small bshadow--0" type="submit"><i class="fa fa-save"></i><span>حفظ</span>
                      </button>
                    </div>
                    <div class="col-md-2 col-xs-6">
                      <button class="master-btn undefined btn-block color--white bgcolor--fadebrown bradius--small bshadow--0" type="submit"><i class="fa fa-times"></i><span>الغاء</span>
                      </button>
                    </div>
                    <div class="clearfix"></div>
                  </div>
                </div>
              </div>
              <!-- =============== PAGE VENDOR Triggers ===============-->
@endsection