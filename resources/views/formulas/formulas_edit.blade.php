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
                            <h4 class="cover-inside-title color--gray_d">العقود و الصيغ</h4>
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
                        <label class="master_label mandatory" for="contract_name">اسم العقد / الصيغة </label>
                        <input class="master_input" type="text" placeholder="اسم العقد / الصيغة .." id="contract_name"><span class="master_message color--fadegreen">message</span>
                      </div>
                    </div>
                    <div class="col-xs-6">
                      <div class="master_field">
                        <label class="master_label mandatory" for="contract_upload">صورة العقد / الصيغة </label>
                        <div class="file-upload">
                          <div class="file-select">
                            <div class="file-select-name" id="noFile">اضغط هنا لرفع صورة العقد / الصيغة</div>
                            <input class="chooseFile" type="file" name="chooseFile" id="contract_upload">
                          </div>
                        </div><span class="master_message color--fadegreen">message</span>
                      </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-xs-12">
                      <div class="master_field">
                        <label class="master_label mandatory" for="main_type">التصنيف الرئيسي</label>
                        <select class="master_input select2" id="main_type" multiple="multiple" data-placeholder="اختر التصنيف الرئيسي" style="width:100%;" ,>
                          <option>نوع 1</option>
                          <option> نوع 2</option>
                          <option>نوع 3</option>
                        </select><span class="master_message color--fadegreen">message</span>
                      </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-xs-12">
                      <div class="master_field">
                        <label class="master_label mandatory" for="sec_type">التصنيف الفرعي</label>
                        <select class="master_input select2" id="sec_type" multiple="multiple" data-placeholder="اختر التصنيف الفرعي" style="width:100%;" ,>
                          <option>نوع 1</option>
                          <option> نوع 2</option>
                          <option>نوع 3</option>
                        </select><span class="master_message color--fadegreen">message</span>
                      </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="col-md-2 col-xs-6">
                      <button class="master-btn undefined btn-block color--white bgcolor--fadepurple bradius--small bshadow--0" type="submit"><i class="fa fa-save"></i><span>حفظ</span>
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