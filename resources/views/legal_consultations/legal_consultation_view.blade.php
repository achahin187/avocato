@extends('layout.app')
@section('content')
              <!-- =============== Custom Content ===============-->
              <div class="row">
                <div class="col-lg-12">
                  <div class="cover-inside-container margin--small-top-bottom bradius--small bshadow--1" style="background:  url( '../img/covers/dummy2.jpg ' ) no-repeat center center; background-size:cover;">
                    <div class="row">
                      <div class="col-xs-12">
                        <div class="text-xs-center">
                          <div class="text-wraper">
                            <h4 class="cover-inside-title color--gray_d">الاستشارات القانونية</h4>
                          </div>
                        </div>
                      </div>
                      <div class="cover--actions"><a class="color--gray_d bordercolor--white bradius--small border-btn master-btn" type="button" href="{{route('legal_consultation_assign')}}">ارسال الإستشارة لمحامي</a>
                      </div>
                    </div>
                  </div>
                  <div class="cardwrap bgcolor--white bradius--noborder   bshadow--1 padding--small margin--small-top-bottom">
                    <div class="main-title-conts">
                      <div class="caption">
                        <h3>كود الإستشارة: {{$consultation->code}}</h3>
                      </div>
                      <div class="actions"><a class="color--white bgcolor--fadegreen bradius--small bshadow--0 master-btn" type="button" href="legal_consultation_edit.html">تعديل</a>
                      </div><span class="mainseparator bgcolor--main"></span>
                    </div>
                    <div class="col-md-12">
                      <div class="cardwrap bgcolor--gray_l bradius--noborder   bshadow--1 padding--small margin--small-top-bottom">
                        <div class="col-md-12"><span class="pull-left"><b>نص السؤال :</b>&nbsp;
                            {{$consultation->question}}</span>
                          <div class="pull-right">
                            بتاريخ
                            {{$consultation->created_at}}
                            &nbsp;<i class="fa fa-calendar"></i>
                          </div>
                        </div>
                        <div class="clearfix"></div>
                      </div>
                      @foreach($consultation->consultation_reply as $lawyer_reply)
                      <div class="cardwrap bgcolor--white bradius--noborder   bshadow--1 padding--small margin--small-top-bottom">
                        <div class="col-md-12">
                          <div class="pull-left">
                            رد المحامي
                            &nbsp;<b><a href="lawyer_view.html">{{$lawyer_reply->lawyer_id}}</a></b>&nbsp;<i class="fa fa-user"></i>&nbsp; &nbsp;
                          </div>
                          <div class="pull-right">
                            بتاريخ
                            {{$lawyer_reply->created_at}}
                            &nbsp;<i class="fa fa-calendar"></i>
                          </div>
                        </div>
                        <div class="clearfix"></div>
                        <hr>
                        <div class="col-md-12">
                          <p><b>الرد :</b>{{$lawyer_reply->reply}}</p>
                        </div>
                        <div class="col-md-8 col-sm-8 col-xs-12 color--fadebrown bold">
                          <div class="radiorobo">
                            @if($lawyer_reply->is_perfect_answer)
                            <input type="radio"  checked name="perfect_answer" id="{{$lawyer_reply->lawyer_id}}">
                            <label for="{{$lawyer_reply->lawyer_id}}">الرد الأمثل</label>
                            @else
                            <input type="radio"   name="perfect_answer" id="{{$lawyer_reply->lawyer_id}}">
                            <label for="{{$lawyer_reply->lawyer_id}}">الرد الأمثل</label>
                            @endif
                            
                          </div>
                        </div>
                        <div class="col-lg-2 col-md-2 col-sm-6 col-xs-6"><a class="master-btn color--white bgcolor--fadegreen bradius--small bshadow--0 btn-block" href="#edit_individual_reply1"><i class="fa fa-edit"></i><span>تعديل الرد</span></a>
                          <div class="remodal-bg"></div>
                          <div class="remodal" data-remodal-id="edit_individual_reply1" role="dialog" aria-labelledby="modal2Title" aria-describedby="modal2Desc">
                            <button class="remodal-close" data-remodal-action="close" aria-label="Close"></button>
                            <div>
                              <div class="row">
                                <div class="col-xs-12">
                                  <h3>تعديل رد المحامي </h3><a href="lawyer_view.html">{{$lawyer_reply->lawyer_id}}</a>
                                  <div class="col-xs-12">
                                    <div class="master_field">
                                      <label class="master_label mandatory" for="individual_reply1">نص الرد</label>
                                      <textarea class="master_input" name="textarea" id="individual_reply1" placeholder="نص الرد"></textarea><span class="master_message color--fadegreen">message</span>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div><br>
                            <button class="remodal-cancel" data-remodal-action="cancel">إغلاق</button>
                            <button class="remodal-confirm" data-remodal-action="confirm">إضافة</button>
                          </div>
                        </div>
                        <div class="col-lg-2 col-md-2 col-sm-6 col-xs-6">
                          <button class="master-btn undefined btn-block color--white bgcolor--fadebrown bradius--small bshadow--0" type="submit"><i class="fa fa-trash"></i><span>حذف</span>
                          </button>
                        </div>
                        <div class="clearfix"></div>
                      </div>
                      @endforeach
                      {{-- <div class="cardwrap bgcolor--white bradius--noborder   bshadow--1 padding--small margin--small-top-bottom">
                        <div class="col-xs-12">
                          <div class="pull-left">
                            رد المحامي
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
                          <p><b>الرد :</b>لوريم ايبسوم دولار سيت أميت ,كونسيكتيتور أدايبا يسكينج أليايت,سيت دو أيوسمود تيمبور أنكايديديونتيوت لابوري ات دولار ماجنا أليكيوا . يوت انيم أد مينيم فينايم,كيواس نوستريد أكسير سيتاشن يللأمكو لابورأس نيسي يت أليكيوب أكس أيا كوممودو كونسيكيوات . ديواس أيوتي أريري دولار إن ريبريهينديرأيت فوليوبتاتي فيلايت أيسسي كايلليوم دولار أيو فيجايت نيولا باراياتيور. أيكسسيبتيور ساينت أوككايكات كيوبايداتات نون بروايدينت ,سيونت ان كيولبا كيو أوفيسيا ديسيريونتموليت انيم أيدي ايست لابوريوم</p>
                        </div>
                        <div class="col-md-8 col-sm-8 col-xs-12 color--fadebrown bold">
                          <div class="radiorobo">
                            <input type="radio" id="perfect2">
                            <label for="perfect2">الرد الأمثل</label>
                          </div>
                        </div>
                        <div class="col-lg-2 col-md-2 col-sm-6 col-xs-6"><a class="master-btn color--white bgcolor--fadegreen bradius--small bshadow--0 btn-block" href="#edit_individual_reply2"><i class="fa fa-edit"></i><span>تعديل الرد</span></a>
                          <div class="remodal-bg"></div>
                          <div class="remodal" data-remodal-id="edit_individual_reply2" role="dialog" aria-labelledby="modal2Title" aria-describedby="modal2Desc">
                            <button class="remodal-close" data-remodal-action="close" aria-label="Close"></button>
                            <div>
                              <div class="row">
                                <div class="col-xs-12">
                                  <h3>تعديل رد المحامي </h3><a href="lawyer_view.html">محمد محسن</a>
                                  <div class="col-xs-12">
                                    <div class="master_field">
                                      <label class="master_label mandatory" for="individual_reply2">نص الرد</label>
                                      <textarea class="master_input" name="textarea" id="individual_reply2" placeholder="نص الرد"></textarea><span class="master_message color--fadegreen">message</span>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div><br>
                            <button class="remodal-cancel" data-remodal-action="cancel">إغلاق</button>
                            <button class="remodal-confirm" data-remodal-action="confirm">إضافة</button>
                          </div>
                        </div>
                        <div class="col-lg-2 col-md-2 col-sm-6 col-xs-6">
                          <button class="master-btn undefined btn-block color--white bgcolor--fadebrown bradius--small bshadow--0" type="submit"><i class="fa fa-trash"></i><span>حذف</span>
                          </button>
                        </div>
                        <div class="clearfix"></div>
                      </div> --}}
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
              <!-- =============== PAGE VENDOR Triggers ===============-->
           @endsection