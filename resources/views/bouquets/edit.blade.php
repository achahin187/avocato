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
                              <h4 class="cover-inside-title color--gray_d">تعريف الباقات </h4>
                            </h4>
                          </div>
                        </div>
                      </div>
                      <div class="cover--actions"><span></span>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-lg-12">
                  <div class="cardwrap bgcolor--white bradius--noborder   bshadow--1 padding--small margin--small-top-bottom">
                    <div class="col-md-7 col-xs-12 no-padding">
                      <div class="col-md-3 col-sm-3 col-xs-4">
                        <div class="master_field">
                          <label class="master_label mandatory" for="lang_list">اختار اللغة</label>
                          <select class="master_input" id="lang_list">
                            <option>العربية</option>
                            <option>English</option>
                            <option>French</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-md-9 col-sm-9 col-xs-8">
                        <div class="master_field">
                          <label class="master_label" for="package_name">اسم الباقة</label>
                          <input class="master_input" type="text" placeholder="اسم الباقة" id="package_name"><span class="master_message color--fadegreen">message</span>
                        </div>
                      </div>
                      <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="main-title-conts">
                          <div class="caption">
                            <h3>مواصفات الباقة</h3>
                          </div>
                          <div class="actions">
                          </div><span class="mainseparator bgcolor--main"></span>
                        </div>
                        <table class="table text-left bgcolor--gray_l">
                          <tbody>
                            <tr>
                              <td>
                                <div class="funkyradio">
                                  <input type="checkbox" name="radio" id="p1_feature_1" checked="true">
                                  <label for="p1_feature_1">تفعيل</label>
                                </div>
                              </td>
                              <td>
                                <input class="master_input" type="number" id="feature_count1" placeholder="عدد" value="40" mandatory>
                              </td>
                              <td><b>الإستشارات القانونية</b></td>
                            </tr>
                            <tr>
                              <td>
                                <div class="funkyradio">
                                  <input type="checkbox" name="radio" id="p1_feature_2" checked="true">
                                  <label for="p1_feature_2">تفعيل</label>
                                </div>
                              </td>
                              <td>
                                <input class="master_input" type="number" id="feature_count2" placeholder="عدد" value="60" mandatory>
                              </td>
                              <td><b>حالات طارئة</b></td>
                            </tr>
                            <tr>
                              <td>
                                <div class="funkyradio">
                                  <input type="checkbox" name="radio" id="p1_feature_3" checked="true">
                                  <label for="p1_feature_3">تفعيل</label>
                                </div>
                              </td>
                              <td>
                                <input class="master_input" type="number" id="feature_count3" placeholder="عدد" value="50" mandatory>
                              </td>
                              <td><b>العقود والصيع</b></td>
                            </tr>
                            <tr>
                              <td>
                                <div class="funkyradio">
                                  <input type="checkbox" name="radio" id="p1_feature_4" checked="true">
                                  <label for="p1_feature_4">تفعيل</label>
                                </div>
                              </td>
                              <td>
                                <input class="master_input" type="number" id="feature_count4" placeholder="عدد" value="25" mandatory>
                              </td>
                              <td><b>الفيتشر الرابعة</b></td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                    </div>
                    <div class="col-md-5 col-xs-12 no-padding">
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <div class="master_field">
                          <label class="master_label mandatory" for="payment">دفع القسط</label>
                          <select class="master_input select2" id="payment" multiple="multiple" data-placeholder="" style="width:100%" >
                            <option>شهري</option>
                            <option>ربع سنوي</option>
                            <option>نصف سنوي</option>
                            <option>سنوي</option>
                          </select><span class="master_message color--fadegreen">message content</span>
                        </div>
                      </div>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <label class="master_label mandatory">نوع العميل</label><input class="icon" type="radio" name="client_type" value="company" id="client_2">
<label for="client_2">شركة</label>
<input class="icon" type="radio" name="client_type" value="individual" id="client_1" checked="true">
<label for="client_1">عميل فرد</label>
                      </div>
                      <div class="clearfix"></div>
                      <div class="col-md-12 col-sm-12 col-xs-12" id="cost_individual">
                        <div class="main-title-conts">
                          <div class="caption">
                            <h3>سعر الباقة</h3>
                          </div>
                          <div class="actions">
                          </div><span class="mainseparator bgcolor--main"></span>
                        </div>
                        <input class="master_input" type="number" id="cost" placeholder="سعر الباقة" value="500" mandatory>
                      </div>
                      <div class="col-md-12 col-sm-12 col-xs-12" id="cost_company" style="display:none;">
                        <div class="main-title-conts">
                          <div class="caption">
                            <h3>سعر الباقة طبقا لعدد أفراد الشركة</h3>
                          </div>
                          <div class="actions">
                          </div><span class="mainseparator bgcolor--main"></span>
                        </div>
                        <table class="table text-left bgcolor--gray_l">
                          <tbody id="more_cost">
                            <tr>
                              <td></td>
                              <td> سعر الباقة</td>
                              <td> عدد الأفراد الى</td>
                              <td> عدد الأفراد من</td>
                            </tr>
                            <tr>
                              <td></td>
                              <td>
                                <input class="master_input" type="number" id="cost1" placeholder="سعر الباقة" value="500" mandatory>
                              </td>
                              <td>
                                <input class="master_input" type="number" id="cost1_to" placeholder="عدد الأفراد الى" value="50" mandatory>
                              </td>
                              <td>
                                <input class="master_input" type="number" id="cost1_from" placeholder="عدد الأفراد من" value="0" mandatory>
                              </td>
                            </tr>
                          </tbody>
                        </table>
                        <div class="col-md-12 text-right no-padding">
                          <button class="input-btn" id="add_cost"><b>إضافة نطاق</b><i class="fa fa-plus-circle"></i></button>
                        </div>
                      </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="col-md-2 col-sm-3 col-xs-3">
                      <div class="master_field">
                        <label class="master_label mandatory" for="lang_list">اختار اللغة</label>
                        <select class="master_input" id="lang_list">
                          <option>العربية</option>
                          <option>English</option>
                          <option>French</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-10 col-sm-9 col-xs-9">
                      <div class="master_field">
                        <label class="master_label mandatory" for="package_deac">وصف الباقة</label>
                        <textarea class="master_input" name="textarea" id="package_deac" placeholder="وصف الباقة"></textarea><span class="master_message color--fadegreen">message</span>
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
@section('js')
<script type="text/javascript">
      $('.tree ul').fadeIn();
        $(document).on('click', '.tree span', function(e) {
          $(this).next('ul').fadeToggle();
          e.stopPropagation();
        });
        $(document).on('change', '.tree input[type=checkbox]', function(e) {
          $(this).siblings('ul').find("input[type='checkbox']").prop('checked', this.checked);
          $(this).parentsUntil('.tree').children("input[type='checkbox']").prop('checked', this.checked);
          e.stopPropagation();
        });
    </script>
    <script type="text/javascript">
      $(document).ready(function(){
          $('input[type="radio"]').click(function(){
          	  var demovalue = $(this).val();
              if (demovalue == 'individual') {
                $("#cost_individual").show();
                $("#cost_company").hide();
              }
      
              else if (demovalue == 'company') {
                $("#cost_individual").hide();
                $("#cost_company").show();
              }
          });
      });
      
    </script>
    <script type="text/javascript">
      var i=1;
      $("#add_cost").click(function(){
        i+=1;
        $("#more_cost").append(`
          <tr>
            <td>
              <button class="del-btn" id="del_cost" onclick="getElementById('cost`+i+`').parentElement.parentElement.remove()">
                <i class="fa fa-times-circle"></i>
              </button>
            </td>
            <td>
              <input class="master_input" type="number" id="cost`+i+`" placeholder="سعر الباقة" mandatory="">
            </td>
            <td>
              <input class="master_input" type="number" id="cost`+i+`_to" placeholder="عدد الأفراد الى" mandatory="">
            </td>
            <td>
              <input class="master_input" type="number" id="cost`+i+`_from" placeholder="عدد الأفراد من" mandatory="">
            </td>
          </tr>
        `);
      });
      
    </script>
@endsection