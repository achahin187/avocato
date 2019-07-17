@extends('landing::layout.app')

@section('content')

              <div class="container">
                <div class="same-height content-wrapper">
                  <section class="tabs t-tabs" id="fancyTabWidget">
                    <ul class="nav nav-tabs fancyTabs" role="tablist">
                      <li class="tab fancyTab active">
                        <div class="arrow-down">
                          <div class="arrow-down-inner"></div>
                        </div><a id="tab0" href="#tabBody0" role="tab" aria-controls="tabBody0" aria-selected="true" data-toggle="tab" tabindex="0"><span class="fa fa-user"></span><span class="hidden-xs">عميل</span></a>
                        <div class="whiteBlock"></div>
                      </li>
                      <li class="tab fancyTab">
                        <div class="arrow-down">
                          <div class="arrow-down-inner"></div>
                        </div><a id="tab1" href="#tabBody1" role="tab" aria-controls="tabBody1" aria-selected="true" data-toggle="tab" tabindex="0"><span class="fa fa-graduation-cap"></span><span class="hidden-xs">محامي</span></a>
                        <div class="whiteBlock"></div>
                      </li>
                      <li class="tab fancyTab">
                        <div class="arrow-down">
                          <div class="arrow-down-inner"></div>
                        </div><a id="tab2" href="#tabBody2" role="tab" aria-controls="tabBody2" aria-selected="true" data-toggle="tab" tabindex="0"><span class="fa fa-briefcase"></span><span class="hidden-xs">مكتب</span></a>
                        <div class="whiteBlock"></div>
                      </li>
                    </ul>
                    <div class="tab-content fancyTabContent" id="myTabContent" aria-live="polite">
                      <div class="tab-pane fade active in" id="tabBody0" role="tabpanel" aria-labelledby="tab0" aria-hidden="false" tabindex="0">

                        <div class="col-md-3 col-sm-4 col-xs-12">
                          <div class="master_field">
                            <label class="master_label mandatory" for="client_name">اسم العميل</label>
                            <input class="master_input" type="text" placeholder="اسم العميل .." id="client_name">
                          </div>
                        </div>
                        <div class="col-md-3 col-sm-4 col-xs-12">
                          <div class="master_field">
                            <label class="master_label mandatory" for="client_gender">النوع</label>
                            <select class="master_input select2" id="client_gender" style="width:100%;">
                              <option>ذكر</option>
                              <option>انثى</option>
                            </select><span class="master_message color--fadegreen">message</span>
                          </div>
                        </div>
                        <div class="col-md-3 col-sm-4 col-xs-12">
                          <div class="master_field">
                            <label class="master_label mandatory" for="client_job">المسمى الوظيفي </label>
                            <input class="master_input" type="text" placeholder="المسمى الوظيفي  .." id="client_job"><span class="master_message color--fadegreen">message </span>
                          </div>
                        </div>
                        <div class="col-md-3 col-sm-4 col-xs-12">
                          <div class="master_field">
                            <label class="master_label mandatory" for="client_address">عنوان العميل</label>
                            <input class="master_input" type="text" placeholder="عنوان العميل .." id="client_address"><span class="master_message color--fadegreen">message </span>
                          </div>
                        </div>
                        <div class="col-md-3 col-sm-4 col-xs-12">
                          <div class="master_field">
                            <label class="master_label mandatory" for="client_id">الرقم القومى</label>
                            <input class="master_input" type="number" placeholder="الرقم القومى" id="client_id"><span class="master_message color--fadegreen">message</span>
                          </div>
                        </div>
                        <div class="col-md-3 col-sm-4 col-xs-12">
                          <div class="master_field">
                            <label class="master_label mandatory" for="client_nationality">الجنسية </label>
                            <input class="master_input" type="text" placeholder="الجنسية" id="client_nationality"><span class="master_message color--fadegreen">message </span>
                          </div>
                        </div>
                        <div class="col-md-3 col-sm-4 col-xs-12">
                          <div class="master_field">
                            <label class="master_label" for="client_birth">تاريخ الميلاد</label>
                            <input class="datepicker master_input" type="text" placeholder="اكتب تاريخ الميلاد هنا" id="client_birth"><span class="master_message color--fadegreen">message</span>
                          </div>
                        </div>
                        <div class="col-md-3 col-sm-4 col-xs-12">
                          <div class="master_field">
                            <label class="master_label" for="client_tel">رقم الهاتف</label>
                            <input class="master_input" type="number" placeholder="رقم الهاتف" id="client_tel"><span class="master_message color--fadegreen">message</span>
                          </div>
                        </div>
                        <div class="col-md-3 col-sm-4 col-xs-12">
                          <div class="master_field">
                            <label class="master_label mandatory" for="client_mob">رقم الموبايل</label>
                            <input class="master_input" type="number" placeholder="رقم الموبايل" id="client_mob"><span class="master_message color--fadegreen">message</span>
                          </div>
                        </div>
                        <div class="col-md-3 col-sm-4 col-xs-12">
                          <div class="master_field">
                            <label class="master_label" for="client_email">البريد الالكترونى</label>
                            <input class="master_input" type="email" placeholder="البريد الالكترونى" id="client_email"><span class="master_message color--fadegreen">message</span>
                          </div>
                        </div>

                        <div class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2 col-xs-12 col-xs-offset-0">
                          <button class="master-btn undefined btn-block color--main color--gray_d bradius--rounded bshadow--0" type="submit"><span>إرسال</span>
                          </button>
                        </div>
                        <div class="clearfix"></div>
                      </div>
                      <div class="tab-pane fade" id="tabBody1" role="tabpanel" aria-labelledby="tab1" aria-hidden="true" tabindex="0">
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
                            <input class="datepicker master_input" type="text" placeholder="اكتب تاريخ الميلاد هنا" id="lawyer_birth"><span class="master_message color--fadegreen">message</span>
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
                            <label class="master_label mandatory" for="lawyer_mob">رقم الموبايل</label>
                            <input class="master_input" type="number" placeholder="رقم الموبايل" id="lawyer_mob"><span class="master_message color--fadegreen">message</span>
                          </div>
                        </div>
                        <div class="col-md-4 col-sm-6 col-xs-12">
                          <div class="master_field">
                            <label class="master_label" for="lawyer_email">البريد الالكترونى</label>
                            <input class="master_input" type="email" placeholder="البريد الالكترونى" id="lawyer_email"><span class="master_message color--fadegreen">message</span>
                          </div>
                        </div>
                        <div class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2 col-xs-12 col-xs-offset-0">
                          <button class="master-btn undefined btn-block color--main color--gray_d bradius--rounded bshadow--0" type="submit"><span>إرسال</span>
                          </button>
                        </div>
                        <div class="clearfix"></div>
                      </div>
                      <div class="tab-pane fade" id="tabBody2" role="tabpanel" aria-labelledby="tab2" aria-hidden="true" tabindex="0">
                        <div class="col-md-4 col-sm-6 col-xs-12">
                          <div class="master_field">
                            <label class="master_label mandatory" for="office_name">اسم المكتب</label>
                            <input class="master_input" type="text" placeholder="اسم المكتب .." id="office_name"><span class="master_message color--fadegreen">message </span>
                          </div>
                        </div>
                        <div class="col-md-4 col-sm-6 col-xs-12">
                          <div class="master_field">
                            <label class="master_label mandatory" for="office_address">عنوان المكتب</label>
                            <input class="master_input" type="text" placeholder="عنوان المحامى .." id="office_address"><span class="master_message color--fadegreen">message </span>
                          </div>
                        </div>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                          <div class="master_field">
                            <label class="master_label mandatory" for="comp_name">اسم الممثل القانوني</label>
                            <input class="master_input" type="text" placeholder="اسم الممثل القانوني .." id="rep_name">
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
                            <label class="master_label mandatory" for="lawyer_mob">رقم الموبايل</label>
                            <input class="master_input" type="number" placeholder="رقم الموبايل" id="lawyer_mob"><span class="master_message color--fadegreen">message</span>
                          </div>
                        </div>
                        <div class="col-md-4 col-sm-6 col-xs-12">
                          <div class="master_field">
                            <label class="master_label" for="lawyer_email">البريد الالكترونى</label>
                            <input class="master_input" type="email" placeholder="البريد الالكترونى" id="lawyer_email"><span class="master_message color--fadegreen">message</span>
                          </div>
                        </div>
                        <div class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2 col-xs-12 col-xs-offset-0">
                          <button class="master-btn undefined btn-block color--main color--gray_d bradius--rounded bshadow--0" type="submit"><span>إرسال</span>
                          </button>
                        </div>
                        <div class="clearfix"></div>
                      </div>
                    </div>
                  </section>
                </div>
              </div>

@stop
