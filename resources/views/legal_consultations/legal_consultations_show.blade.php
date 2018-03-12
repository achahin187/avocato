@extends('layout.app')
@section('content')

              <div class="row">
                <div class="col-lg-12">
                  <div class="cover-inside-container margin--small-top-bottom bradius--small bshadow--1" style="background:  url( '{{asset('img/covers/dummy2.jpg')}}' ) no-repeat center center; background-size:cover;">
                    <div class="row">
                      <div class="col-xs-12">
                        <div class="text-xs-center">
                          <div class="text-wraper">
                            <h4 class="cover-inside-title color--gray_d">الاستشارات القانونية</h4>
                          </div>
                        </div>
                      </div>
                      <div class="cover--actions"><a class="color--gray_d bordercolor--white bradius--small border-btn master-btn" type="button" href="{{route('legal_consultations_assign')}}">ارسال الإستشارة لمحامي</a>
                      </div>
                    </div>
                  </div>
                  <div class="cardwrap bgcolor--white bradius--noborder   bshadow--1 padding--small margin--small-top-bottom">
                    <div class="main-title-conts">
                      <div class="caption">
                        <h3>كود الإستشارة: 0890807</h3>
                      </div>
                      <div class="actions"><a class="color--white bgcolor--fadegreen bradius--small bshadow--0 master-btn" type="button" href="{{route('legal_consultations_edit')}}">تعديل</a>
                      </div><span class="mainseparator bgcolor--main"></span>
                    </div>
                    <div class="col-md-12">
                      <div class="cardwrap bgcolor--gray_l bradius--noborder   bshadow--1 padding--small margin--small-top-bottom">
                        <div class="col-md-12"><span class="pull-left"><b>نص السؤال :</b>&nbsp;
                            وريم ايبسوم دولار سيت أميت ,كونسيكتيتور أدايبا يسكينج أليايت,سيت دو أيوسمود تيمبور أنكايديديونتيوت لابوري ات دولار ماجنا أليكيوا . يوت انيم أد مينيم فينايم,كيواس نوستريد أكسير سيتاشن يللأمكو</span>
                          <div class="pull-right">
                            بتاريخ
                            10/10/2018
                            &nbsp;<i class="fa fa-calendar"></i>
                          </div>
                        </div>
                        <div class="clearfix"></div>
                      </div>
                      <div class="cardwrap bgcolor--white bradius--noborder   bshadow--1 padding--small margin--small-top-bottom">
                        <div class="col-md-12">
                          <div class="pull-left">
                            رد المحامي
                            &nbsp;<b><a href="{{route('lawyers_show')}}">محمد محسن</a></b>&nbsp;<i class="fa fa-user"></i>&nbsp; &nbsp;
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
                          <p><b>الرد :</b>لوريم ايبسوم دولار سيت أميت ,كونسيكتيتور أدايبا يسكينج أليايت,سيت دو أيوسمود تيمبور أنكايديديونتيوت لابوري ات دولار ماجنا أليكيوا . يوت انيم أد مينيم فينايم,كيواس نوستريد أكسير سيتاشن يللأمكو لابورأس نيسي يت أليكيوب أكس أيا كوممودو كونسيكيوات . ديواس أيوتي أريري دولار إن ريبريهينديرأيت فوليوبتاتي فيلايت أيسسي كايلليوم دولار أيو فيجايت نيولا باراياتيور. أيكسسيبتيور ساينت أوككايكات كيوبايداتات نون بروايدينت ,سيونت ان كيولبا كيو أوفيسيا ديسيريونتموليت انيم أيدي ايست لابوريوم</p>
                        </div>
                        <div class="col-md-8 col-sm-8 col-xs-12 color--fadebrown bold">
                          <div class="radiorobo">
                            <input type="radio" id="perfect1">
                            <label for="perfect1">الرد الأمثل</label>
                          </div>
                        </div>
                        <div class="col-lg-2 col-md-2 col-sm-6 col-xs-6">
                          <button class="master-btn undefined btn-block color--white bgcolor--fadegreen bradius--small bshadow--0" type="submit"><i class="fa fa-edit"></i><span>تعديل</span>
                          </button>
                        </div>
                        <div class="col-lg-2 col-md-2 col-sm-6 col-xs-6">
                          <button class="master-btn undefined btn-block color--white bgcolor--fadebrown bradius--small bshadow--0" type="submit"><i class="fa fa-trash"></i><span>حذف</span>
                          </button>
                        </div>
                        <div class="clearfix"></div>
                      </div>
                      <div class="cardwrap bgcolor--white bradius--noborder   bshadow--1 padding--small margin--small-top-bottom">
                        <div class="col-xs-12">
                          <div class="pull-left">
                            رد المحامي
                            &nbsp;<b><a href="{{route('lawyers_show')}}">محمد محسن</a></b>&nbsp;<i class="fa fa-user"></i>&nbsp; &nbsp;
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
                          <p><b>الرد :</b>لوريم ايبسوم دولار سيت أميت ,كونسيكتيتور أدايبا يسكينج أليايت,سيت دو أيوسمود تيمبور أنكايديديونتيوت لابوري ات دولار ماجنا أليكيوا . يوت انيم أد مينيم فينايم,كيواس نوستريد أكسير سيتاشن يللأمكو لابورأس نيسي يت أليكيوب أكس أيا كوممودو كونسيكيوات . ديواس أيوتي أريري دولار إن ريبريهينديرأيت فوليوبتاتي فيلايت أيسسي كايلليوم دولار أيو فيجايت نيولا باراياتيور. أيكسسيبتيور ساينت أوككايكات كيوبايداتات نون بروايدينت ,سيونت ان كيولبا كيو أوفيسيا ديسيريونتموليت انيم أيدي ايست لابوريوم</p>
                        </div>
                        <div class="col-md-8 col-sm-8 col-xs-12 color--fadebrown bold">
                          <div class="radiorobo">
                            <input type="radio" id="perfect2">
                            <label for="perfect2">الرد الأمثل</label>
                          </div>
                        </div>
                        <div class="col-lg-2 col-md-2 col-sm-6 col-xs-6">
                          <button class="master-btn undefined btn-block color--white bgcolor--fadegreen bradius--small bshadow--0" type="submit"><i class="fa fa-edit"></i><span>تعديل</span>
                          </button>
                        </div>
                        <div class="col-lg-2 col-md-2 col-sm-6 col-xs-6">
                          <button class="master-btn undefined btn-block color--white bgcolor--fadebrown bradius--small bshadow--0" type="submit"><i class="fa fa-trash"></i><span>حذف</span>
                          </button>
                        </div>
                        <div class="clearfix"></div>
                      </div>
                      <div class="col-lg-2 col-md-2 col-sm-6 col-xs-6">
                        <button class="master-btn undefined btn-block color--white bgcolor--fadepurple bradius--small bshadow--0" type="submit"><i class="fa fa-save"></i><span>حفظ</span>
                        </button>
                      </div>
                      <div class="col-lg-2 col-md-2 col-sm-6 col-xs-6">
                        <button class="master-btn undefined btn-block color--white bgcolor--fadebrown bradius--small bshadow--0" type="submit"><i class="fa fa-times"></i><span>إلغاء</span>
                        </button>
                      </div>
                    </div>
                    <div class="clearfix"></div><a class="master-btn undefined undefined undefined undefined undefined" href="#edit_reply"><span></span></a>
                    <div class="remodal-bg"></div>
                    <div class="remodal" data-remodal-id="edit_reply" role="dialog" aria-labelledby="modal1Title" aria-describedby="modal1Desc">
                      <button class="remodal-close" data-remodal-action="close" aria-label="Close"></button>
                      <div>
                        <div class="row">
                          <h3>تعديل رد على الإستشارة</h3>
                          <div class="col-xs-12">
                            <div class="master_field">
                              <label class="master_label">نص الرد</label>
                              <textarea class="master_input" name="textarea" placeholder="نص الرد"></textarea>
                            </div>
                          </div>
                          <div class="clearfix"></div>
                        </div>
                      </div><br>
                      <button class="remodal-cancel" data-remodal-action="cancel">إلغاء</button>
                      <button class="remodal-confirm" data-remodal-action="confirm">حفظ</button>
                    </div>
                  </div>
                </div>
              </div>

@endsection