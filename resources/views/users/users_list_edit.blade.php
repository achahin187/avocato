 @extends('layout.app')             
 @section('content')

              <div class="row">
                <div class="col-lg-12">
                  <div class="cover-inside-container margin--small-top-bottom bradius--small bshadow--1" style="background:  url( '../img/covers/dummy2.jpg ' ) no-repeat center center; background-size:cover;">
                    <div class="edit-mode">Editing mode</div>
                    <div class="row">
                      <div class="col-xs-12">
                        <div class="text-xs-center">
                          <div class="text-wraper">
                            <h4 class="cover-inside-title color--gray_d">المستخدمين</h4>
                          </div>
                        </div>
                      </div>
                      <div class="cover--actions">
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-12">
                    <div class="cardwrap bgcolor--white bradius--noborder   bshadow--1 padding--small margin--small-top-bottom">
                      <div class="col-md-4 col-xs-6">
                        <div class="master_field">
                          <label class="master_label mandatory" for="client_name">اسم المستخدم</label>
                          <input class="master_input" type="text" placeholder="اسم المستخدم" id="client_name"><span class="master_message color--fadegreen">message</span>
                        </div>
                      </div>
                      <div class="col-md-4 col-xs-6">
                        <div class="master_field">
                          <label class="master_label mandatory" for="client_full_name">الاسم بالكامل</label>
                          <input class="master_input" type="text" placeholder="الاسم بالكامل" id="client_full_name"><span class="master_message color--fadegreen">message</span>
                        </div>
                      </div>
                      <div class="col-md-4 col-xs-6">
                        <div class="master_field">
                          <label class="master_label mandatory" for="user_position">دور المستخدم</label>
                          <select class="master_input select2" id="user_position" style="width:100%;">
                            <option>ادمن</option>
                            <option>خدمة عملاء</option>
                          </select><span class="master_message color--fadegreen">message</span>
                        </div>
                      </div>
                      <div class="col-md-4 col-xs-6">
                        <div class="master_field">
                          <label class="master_label mandatory">صورة المستخدم</label>
                          <div class="file-upload">
                            <div class="file-select">
                              <div class="file-select-name" id="noFile">صورة المستخدم</div>
                              <input class="chooseFile" type="file" name="chooseFile">
                            </div>
                          </div><span class="master_message color--fadegreen">message</span>
                        </div>
                      </div>
                      <div class="col-md-4 col-xs-6">
                        <div class="master_field">
                          <label class="master_label mandatory" for="client_email">البريد الالكترونى</label>
                          <input class="master_input" type="email" placeholder="ex:mail@mail.com" id="client_email"><span class="master_message color--fadegreen">message</span>
                        </div>
                      </div>
                      <div class="col-md-4 col-xs-6">
                        <div class="master_field">
                          <label class="master_label mandatory" for="phone">هاتف</label>
                          <input class="master_input" type="number" placeholder="مثال : 0123456789" id="phone"><span class="master_message color--fadegreen">message</span>
                        </div>
                      </div>
                      <div class="col-md-4 col-xs-6">
                        <div class="master_field">
                          <label class="master_label mandatory" for="mob">موبايل</label>
                          <input class="master_input" type="number" placeholder="مثال : 0123456789" id="mob"><span class="master_message color--fadegreen">message</span>
                        </div>
                      </div>
                      <div class="col-md-4 col-xs-6">
                        <div class="master_field">
                          <label class="master_label mandatory">كلمة المرور</label>
                          <input class="master_input" type="password" placeholder="كلمة المرور"><span class="master_message color--fadegreen">message</span>
                        </div>
                      </div>
                      <div class="col-md-4 col-xs-6">
                        <div class="master_field">
                          <label class="master_label mandatory">اعادة كتابة كلمة المرور</label>
                          <input class="master_input" type="password" placeholder="اعادة كتابة كلمة المرور"><span class="master_message color--fadegreen">message</span>
                        </div>
                      </div>
                      <div class="clearfix"></div>
                      <div class="col-md-4 col-xs-6">
                        <label class="master_label">تفعيل المستخدم</label>
                        <div class="master_field">       
                          <input class="icon" type="radio" name="icon" id="radbtn_2" checked="true">
                          <label for="radbtn_2">مفعل</label>
                          <input class="icon" type="radio" name="icon" id="radbtn_3">
                          <label for="radbtn_3">غير مفعل</label>
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
                      <div class="clearfix"></div>
                    </div>
                  </div>
                </div>
                </div>
            

 @endsection