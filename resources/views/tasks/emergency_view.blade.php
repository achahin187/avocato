@extends('layout.app')             
 @section('content')
              <!-- ============== Custom Content ===============-->
              <div class="row">
                <div class="col-lg-12">
                  <div class="cover-inside-container margin--small-top-bottom bradius--small bshadow--1" style="background:  url( '../img/covers/dummy2.jpg ' ) no-repeat center center; background-size:cover;">
                    <div class="row">
                      <div class="col-xs-12">
                        <div class="text-xs-center">
                          <div class="text-wraper">
                            <h4 class="cover-inside-title color--gray_d">المهام <i class="fa fa-chevron-circle-right"></i>
                              <h4 class="cover-inside-title color--gray_d">الحالات الطارئة </h4>
                            </h4>
                          </div>
                        </div>
                      </div>
                      <div class="cover--actions"><a class="color--gray_d bordercolor--white bradius--small border-btn master-btn" type="button" href="assign_known_task.html">تعيين محامي للمهمة</a>
                      </div>
                    </div>
                  </div>
                  <div class="cardwrap bgcolor--white bradius--noborder   bshadow--1 padding--small margin--small-top-bottom">
                    <div class="col-md-1"><img class="full-width bradius--circle" src="../img/avaters/male.jpg"></div>
                    <div class="col-md-2">
                      <div class="right-text margin--medium-top-bottom"><b>المحامي المسئول</b></div><a href="lawyer_view.html">محمد احمد</a>
                    </div>
                    <div class="col-md-12"><br>
                      <div class="ticket-container">
                        <div class="clearfix">
                          <div class="layer clearfix">
                            <div class="tck-info col-xs-12">
                              <div class="col-xs-12"><span class="tiket-data light-color col-md-4 col-xs-6">اسم العميل: <a href="clients_compaines_view.html">محمد احمد</a>&nbsp;<span class="color--sec">(عميل أفراد)</span></span><span class="tiket-data right light-color col-md-5">
                                  <div class="pull-right">
                                    التاريخ
                                    10/10/2018
                                    &nbsp;<i class="fa fa-calendar"></i>
                                  </div>
                                  <div class="pull-right">
                                    الوقت
                                    2:00 مساء
                                    &nbsp;<i class="fa fa-clock"></i>&nbsp; &nbsp;
                                  </div></span><span class="tiket-data light-color col-md-2"><span class="color--sec">كود (13213546546)</span></span></div>
                              <div class="clearfix"></div>
                              <hr><span class="tiket-data col-xs-12"><b class="col-md-12">تفاصيل الحالة الطارئة :</b>
                                <div class="col-md-6"> {{$task->techinical_reports->item_id}}</div>
                                <div class="col-md-6"><img src="https://www.taitradio.com/__data/assets/image/0016/114910/location-sol-header.jpg" height="140" width="450"></div></span>
                              <div class="clearfix"></div>
                              <hr><span class="tiket-data col-md-6"><i class="fa fa-map-marker"></i><b>العنوان :</b>4شارع التحرير الدقى القاهرة</span><span class="tiket-data col-md-6"><i class="fa fa-phone"></i><b>التليفون :</b>0123456789</span>
                            </div>
                            <div class="status-bar">
                              <div class="status">
                                الحالة
                                &nbsp;<span class="bgcolor--fadegreen color--black bradius--small importance padding--small">تم</span>
                              </div>
                            </div>
                            <div class="clearfix">       </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="col-md-2 col-sm-5 col-xs-12"><a class="master-btn color--black bgcolor--fadegreen bradius--rounded bshadow--0 btn-block" href="#popupModal_1"><i class="fa fa-tag"></i><span>تغيير الحالة</span></a>
                      <div class="remodal-bg"></div>
                      <div class="remodal" data-remodal-id="popupModal_1" role="dialog" aria-labelledby="modal1Title" aria-describedby="modal1Desc">
                        <button class="remodal-close" data-remodal-action="close" aria-label="Close"></button>
                        <div>
                          <div class="row">
                            <div class="col-xs-12">
                              <h3>تغيير حالة المهمة</h3>
                              <div class="master_field">       
                                <input class="icon" type="radio" name="icon" id="radbtn_2" checked="true">
                                <label for="radbtn_2">تمت المهمة</label>
                                <input class="icon" type="radio" name="icon" id="radbtn_3">
                                <label for="radbtn_3">لم تتم المهمة</label>
                              </div>
                            </div>
                          </div>
                        </div><br>
                        <button class="remodal-cancel" data-remodal-action="cancel">إلغاء</button>
                        <button class="remodal-confirm" data-remodal-action="confirm">تغيير حالة المهمة</button>
                      </div>
                    </div>
                    <div class="clearfix"></div><br>
                  </div>
                </div>
              </div>
              <!-- =============== PAGE VENDOR Triggers ===============-->
            @endsection