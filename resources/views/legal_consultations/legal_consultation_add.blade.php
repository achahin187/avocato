@extends('layout.app')
@section('content')
              <!-- =============== Custom Content ===============-->
              <div class="row">
                <div class="col-lg-12">
                  <div class="cover-inside-container margin--small-top-bottom bradius--small bshadow--1" style="background:  url( 'img/covers/dummy2.jpg ' ) no-repeat center center; background-size:cover;">
                    <div class="add-mode">Adding mode</div>
                    <div class="row">
                      <div class="col-xs-12">
                        <div class="text-xs-center">
                          <div class="text-wraper">
                            <h4 class="cover-inside-title color--gray_d">الاستشارات القانونية</h4>
                          </div>
                        </div>
                      </div>
                      <div class="cover--actions">
                      </div>
                    </div>
                  </div>
                </div>
                <form role="form" action="{{route('legal_consultation_store')}}" method="post">
                <div class="col-lg-12">
                  <div class="cardwrap bgcolor--white bradius--noborder   bshadow--1 padding--small margin--small-top-bottom">
                    <div class="col-md-4 col-sm-6 col-xs-12">
                      <div class="master_field">
                        <label class="master_label" for="consultation_code">كود الإستشارة</label>
                        <input class="master_input" type="text" placeholder="كود الإستشارة .." id="consultation_code" disabled="true" name="consultation_code" value="">
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6 col-xs-12">
                      <div class="master_field">
                        <label class="master_label mandatory" for="consultation_cat">تصنيف الاستشارة</label>
                        <select class="master_input select2" id="consultation_cat"  data-placeholder="اختر التصنيف الرئيسي للاستشارات القانونية" style="width:100%;" name="consultation_cat">
                          @foreach($consultation_types as $type)
                          <option value="{{$type->name}}">{{$type->name}}</option>
                          @endforeach
                        </select><span class="master_message color--fadegreen">message content</span>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6 col-xs-12">
                      <div class="master_field">
                        <label class="master_label">نوع الاستشارة</label>
                        <div class="radiorobo">
                          <input type="radio" id="rad_1" name="consultation_type" value="0">
                          <label for="rad_1">مجانية</label>
                       
                          <input type="radio" id="rad_2" name="consultation_type" value="1">
                          <label for="rad_2">مدفوع</label>
                        </div><span class="master_message color--fadegreen">message</span>
                      </div>
                    </div>
                    <div class="col-xs-12">
                      <div class="master_field">
                        <label class="master_label mandatory" for="consultation_question">نص السؤال</label>
                        <input class="master_input" type="text" placeholder="نص السؤال .." id="consultation_question" name="consultation_question"><span class="master_message color--fadegreen">يجب ادخال  نص السؤال</span>
                      </div>
                    </div>
                    <div class="col-xs-12">
                      <div class="master_field">
                        <label class="master_label mandatory" for="consultation_answer">نص الاجابة</label>
                        <textarea class="master_input" name="consultation_answer" id="consultation_answer" placeholder="نص الاجابة "></textarea><span class="master_message color--fadegreen">message</span>
                      </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="col-md-2 col-xs-6">
                      <button class="master-btn undefined btn-block color--white bgcolor--fadepurple bradius--small bshadow--0" type="submit"><i class="fa fa-save"></i><span>حفظ</span>
                      </button>
                    </div>
                    <div class="col-md-2 col-xs-6">
                      <a href="{{route('legal_consultations')}}"><button class="master-btn undefined btn-block color--white bgcolor--fadebrown bradius--small bshadow--0" ><i class="fa fa-times"></i><span>الغاء</span>
                      </button></a>
                    </div>
                    <div class="clearfix"></div><br>
                  </div>
                </div>
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
              </form>
              </div>
              <!-- =============== PAGE VENDOR Triggers ===============-->
           @endsection