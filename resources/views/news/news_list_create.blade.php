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
                            <h4 class="cover-inside-title color--gray_d">الاخبار</h4>
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
                    <div class="col-xs-12">
                      <div class="col-md-6 col-xs-12">
                        <div class="master_field">
                          <label class="master_label mandatory" for="ID_No">عنوان الخبر</label>
                          <input class="master_input" type="text" placeholder="عنوان الخبر ..." id="ID_No" value="value"><span class="master_message color--fadegreen">message</span>
                        </div>
                      </div>
                      <div class="col-md-4 col-xs-8">
                        <div class="master_field">
                          <label class="master_label mandatory" for="ID_No">صورة الخبر </label>
                          <div class="file-upload">
                            <div class="file-select">
                              <div class="file-select-name" id="noFile">اضغط لرفع الصورة الرئيسية للخبر</div>
                              <input class="chooseFile" type="file" name="chooseFile" id="ID_No">
                            </div>
                          </div><span class="master_message color--fadegreen">message</span>
                        </div>
                      </div>
                      <div class="col-md-2 col-xs-4">
                        <div class="master_field">
                          <label class="master_label" for="sitch_1">تفعيل </label>
                          <input class="make-switch" type="checkbox" checked data-on-text="نعم" data-off-text="لا"><span class="master_message color--fadegreen">message</span>
                        </div>
                      </div>
                      <div class="col-xs-12">
                        <div class="main-title-conts">
                          <div class="caption">
                            <h3>تفاصيل الخبر</h3>
                          </div>
                          <div class="actions">
                          </div><span class="mainseparator bgcolor--main"></span>
                        </div><img class="img-responsive" src="https://documentation.thoughtfarmer.com/imagethumb/223316470000/13627/0x0/False/RTE.png">
                      </div>
                    </div>
                    <div class="clearfix"></div>
                    <hr>
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