@extends('layout.app')
@section('content')


              <div class="row">
                <div class="col-lg-12">
                  <div class="cover-inside-container margin--small-top-bottom bradius--small bshadow--1" style="background:  url( '{{asset('img/covers/dummy2.jpg')}}' ) no-repeat center center; background-size:cover;">
                    <div class="row">
                      <div class="col-xs-12">
                        <div class="text-xs-center">
                          <div class="text-wraper">
                            <h4 class="cover-inside-title color--gray_d">العملاء <i class="fa fa-chevron-circle-right"></i>
                              <h4 class="cover-inside-title color--gray_d">الشكاوى و الاستفسارات </h4>
                            </h4>
                          </div>
                        </div>
                      </div>
                      <div class="cover--actions">
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="cardwrap bgcolor--white bradius--noborder   bshadow--1 padding--small margin--small-top-bottom">
                    <div class="cardwrap bgcolor--gray_l bradius--noborder   bshadow--1 padding--small margin--small-top-bottom">
                      <div class="col-md-12">
                        <div class="pull-left">
                          اسم العميل
                          &nbsp;<b><a href="lawyer_view.html">محمد محسن</a></b>
                        </div>
                        <div class="pull-right">
                          بتاريخ
                          10/10/2018
                          &nbsp;<i class="fa fa-calendar"></i>
                        </div>
                      </div>
                      <div class="clearfix"></div>
                      <hr>
                      <div class="col-md-12"><b>نص الشكوى :</b>&nbsp;
                        وريم ايبسوم دولار سيت أميت ,كونسيكتيتور أدايبا يسكينج أليايت,سيت دو أيوسمود تيمبور أنكايديديونتيوت لابوري ات دولار ماجنا أليكيوا . يوت انيم أد مينيم فينايم,كيواس نوستريد أكسير سيتاشن يللأمكو
                      </div>
                      <div class="clearfix"></div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="cardwrap bgcolor--white bradius--noborder   bshadow--1 padding--small margin--small-top-bottom">
                      <div class="col-xs-12">
                        <div class="pull-left">
                          تم الرد على الشكوى بواسطة
                          &nbsp;<b><a href="lawyer_view.html">محمد محسن</a></b>&nbsp;<i class="fa fa-user"></i>&nbsp; &nbsp;
                        </div>
                        <div class="pull-right">
                          بتاريخ
                          10/10/2018
                          &nbsp;<i class="fa fa-calendar"></i>
                        </div>
                      </div>
                      <div class="clearfix"></div>
                      <hr>
                      <div class="col-md-12">
                        <p></p>لوريم ايبسوم دولار سيت أميت ,كونسيكتيتور أدايبا يسكينج أليايت,سيت دو أيوسمود تيمبور أنكايديديونتيوت لابوري ات دولار ماجنا أليكيوا . يوت انيم أد مينيم فينايم,كيواس نوستريد أكسير سيتاشن يللأمكو لابورأس نيسي يت أليكيوب أكس أيا كوممودو كونسيكيوات . ديواس أيوتي أريري دولار إن ريبريهينديرأيت فوليوبتاتي فيلايت أيسسي كايلليوم دولار أيو فيجايت نيولا باراياتيور. أيكسسيبتيور ساينت أوككايكات كيوبايداتات نون بروايدينت ,سيونت ان كيولبا كيو أوفيسيا ديسيريونتموليت انيم أيدي ايست لابوريوم
                      </div>
                      <div class="clearfix"></div>
                    </div>
                    <div class="cardwrap bgcolor--white bradius--noborder   bshadow--1 padding--small margin--small-top-bottom">
                      <div class="col-xs-12">
                        <div class="master_field">
                          <label class="master_label mandatory" for="compain_reply">نص الرد</label>
                          <textarea class="master_input" name="textarea" id="compain_reply" placeholder="نص الرد"></textarea><span class="master_message color--fadegreen">message</span>
                        </div>
                      </div>
                      <div class="col-lg-2 col-md-2 col-sm-6 col-xs-6">
                        <button class="master-btn undefined btn-block color--white bgcolor--fadeorange bradius--small bshadow--0" type="submit"><i class="fa fa-envelope"></i><span>إرسال</span>
                        </button>
                      </div>
                      <div class="col-lg-2 col-md-2 col-sm-6 col-xs-6">
                        <button class="master-btn undefined btn-block color--white bgcolor--fadebrown bradius--small bshadow--0" type="submit"><span>إلغاء</span>
                        </button>
                      </div>
                      <div class="clearfix"></div>
                    </div>
                    <div class="clearfix"></div>
                  </div>
                </div>
              </div>

@endsection