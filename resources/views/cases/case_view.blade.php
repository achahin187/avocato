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
                            <h4 class="cover-inside-title color--gray_d">القضايا و الخدمات <i class="fa fa-chevron-circle-right"></i>
                              <h4 class="cover-inside-title color--gray_d">القضايا </h4>
                            </h4>
                          </div>
                        </div>
                      </div>
                      <div class="cover--actions"><a class="color--gray_d bordercolor--white bradius--small border-btn master-btn" type="button" href="case_edit.html">تعديل بيانات القضية</a>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-lg-12">
                  <div class="main-title-conts">
                    <div class="caption">
                      <h3 class="color--main">القضية</h3>
                    </div>
                    <div class="actions">
                    </div><span class="mainseparator bgcolor--main"></span>
                  </div>
                  <div class="cardwrap bgcolor--white bradius--noborder   bshadow--1 padding--small margin--small-top-bottom">
                    <div class="col-md-9 col-md-6 col-sm-6 col-xs-12">
                      <h4 class="right-text">الدعوى رقم 13265</h4><b>لسنة 2018</b>
                    </div>
                    <div class="col-md-1 col-xs-2"><img class="full-width bradius--circle" src="../img/avaters/male.jpg"></div>
                    <div class="col-md-2 col-xs-3">
                      <div class="right-text margin--medium-top-bottom"><b>المحامي المسئول</b></div><a href="lawyer_view.html">محمد احمد</a>
                    </div>
                    <div class="clearfix"></div>
                    <div class="col-lg-12"><br>
                      <div class="ticket-container">
                        <div class="clearfix">
                          <div class="layer clearfix">
                            <div class="tck-info col-xs-12">
                              <div class="col-xs-12"><span class="tiket-data light-color col-md-3 col-sm-6 col-xs-12"> محكمة شمال القاهرة</span><span class="tiket-data right light-color col-md-6 col-sm-6 col-xs-12">
                                  <div class="pull-right">
                                    تاريخ قيد الدعوى
                                    10/10/2018
                                    &nbsp;<i class="fa fa-calendar"></i>
                                  </div></span></div>
                              <div class="clearfix"></div>
                              <hr>
                              <div class="tiket-data col-md-6 col-sm-6 col-xs-12"><b class="col-xs-3">اسم الموكل (1)</b>
                                <div class="col-xs-9">محمد محسن عبدالشافي</div>
                              </div>
                              <div class="tiket-data col-md-6 col-sm-6 col-xs-12"><b class="col-xs-3">صفته</b>
                                <div class="col-xs-9">دكتور عظام بمستشفى أبو الريش</div>
                              </div>
                              <div class="tiket-data col-md-6 col-sm-6 col-xs-12"><b class="col-xs-3">عنوانه</b>
                                <div class="col-xs-9">3 شارع الثورة - القاهرة</div>
                              </div>
                              <div class="tiket-data col-md-6 col-sm-6 col-xs-12"><b class="col-xs-3">هاتف</b>
                                <div class="col-xs-9">0123456789</div>
                              </div>
                              <div class="clearfix"></div>
                              <hr>
                              <div class="tiket-data col-md-6 col-sm-6 col-xs-12"><b class="col-xs-3">اسم الموكل (2)</b>
                                <div class="col-xs-9">محمد محسن عبدالشافي</div>
                              </div>
                              <div class="tiket-data col-md-6 col-sm-6 col-xs-12"><b class="col-xs-3">صفته</b>
                                <div class="col-xs-9">دكتور عظام بمستشفى أبو الريش</div>
                              </div>
                              <div class="tiket-data col-md-6 col-sm-6 col-xs-12"><b class="col-xs-3">عنوانه</b>
                                <div class="col-xs-9">3 شارع الثورة - القاهرة</div>
                              </div>
                              <div class="tiket-data col-md-6 col-sm-6 col-xs-12"><b class="col-xs-3">هاتف</b>
                                <div class="col-xs-9">0123456789</div>
                              </div>
                              <div class="clearfix"></div>
                              <hr>
                              <div class="tiket-data col-md-6 col-sm-6 col-xs-12"><b class="col-xs-3">اسم الخصم</b>
                                <div class="col-xs-9">محمد على صابر</div>
                              </div>
                              <div class="tiket-data col-md-6 col-sm-6 col-xs-12"><b class="col-xs-3">صفته</b>
                                <div class="col-xs-9">دكتور عظام بمستشفى أبو الريش</div>
                              </div>
                              <div class="tiket-data col-md-6 col-sm-6 col-xs-12"><b class="col-xs-3">عنوانه</b>
                                <div class="col-xs-9">3 شارع الثورة - القاهرة</div>
                              </div>
                              <div class="tiket-data col-md-6 col-sm-6 col-xs-12"><b class="col-xs-3">محاميه</b>
                                <div class="col-xs-9">ثابت ثروت</div>
                              </div>
                              <div class="clearfix"></div>
                              <hr><span class="tiket-data col-xs-12"><b>الموضوع:</b>&nbsp;
                                 لوريم ايبسوم دولار سيت أميت ,كونسيكتيتور أدايبا يسكينج أليايت,سيت دو أيوسمود تيمبورأنكايديديونتيوت لابوري ات دولار ماجنا أليكيوا . يوت انيم أد مينيم فينايم,كيواس نوستريد أكسير سيتاشن يللأمكو لابورأس نيسي يت أليكيوب أكس أيا كوممودو كونسيكيوات . ديواس أيوتي أريري دولار إن ريبريهينديرأيت فوليوبتاتي فيلايت أيسسي كايلليوم دولار أيو فيجايت نيولا باراياتيور. أيكسسيبتيور ساينت أوككايكات كيوبايداتات نون بروايدينت ,سيونت ان كيولباكيو أوفيسيا ديسيريونتموليت انيم أيدي ايست لابوريوم.</span>
                              <div class="clearfix"></div>
                              <hr><span class="tiket-data col-md-4 col-sm-6 col-xs-12"><b>رقم الملف بالمكتب</b>&nbsp;
                                12334</span><span class="tiket-data col-md-4 col-sm-6 col-xs-12"><b>رقم التوكيل</b>&nbsp;
                                12334</span><span class="tiket-data col-md-4 col-sm-6 col-xs-12"><b>رسوم الدعوى</b>&nbsp;
                                12333 جنية</span>
                            </div>
                            <div class="status-bar">
                              <div class="status">
                                الحالة
                                &nbsp;<span class="bgcolor--fadegreen color--black bradius--small importance padding--small">متداولة</span>
                              </div>
                            </div>
                            <div class="clearfix"></div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="col-md-2 col-sm-6 col-xs-12"><a class="master-btn color--black bgcolor--fadegreen bradius--rounded bshadow--0 btn-block" href="#popupModal_1"><i class="fa fa-tag"></i><span>تغيير الحالة</span></a>
                      <div class="remodal-bg"></div>
                      <div class="remodal" data-remodal-id="popupModal_1" role="dialog" aria-labelledby="modal1Title" aria-describedby="modal1Desc">
                        <button class="remodal-close" data-remodal-action="close" aria-label="Close"></button>
                        <div>
                          <div class="row">
                            <div class="col-xs-12">
                              <h3>تغيير حالة القضية</h3>
                              <div class="master_field">       
                                <input class="icon" type="radio" name="icon" id="status1" checked="true">
                                <label for="status1">متداولة </label>
                                <input class="icon" type="radio" name="icon" id="status2">
                                <label for="status2">مغلقة</label>
                              </div>
                            </div>
                          </div>
                        </div><br>
                        <button class="remodal-cancel" data-remodal-action="cancel">إلغاء</button>
                        <button class="remodal-confirm" data-remodal-action="confirm">تغيير حالة القضية</button>
                      </div>
                    </div>
                    <div class="col-md-2 col-sm-6 col-xs-12 pull-right"><a class="master-btn color--white bgcolor--fadered bradius--small bshadow--0 btn-block" href="#case_attachment"><i class="fa fa-file"></i><span>عرض مستندات القضية</span></a>
                      <div class="remodal-bg"></div>
                      <div class="remodal" data-remodal-id="case_attachment" role="dialog" aria-labelledby="modal1Title" aria-describedby="modal1Desc">
                        <button class="remodal-close" data-remodal-action="close" aria-label="Close"></button>
                        <div>
                          <div class="row">
                            <div class="col-xs-12">
                              <h3>صور مستندات القضية</h3>
                              <ul class="mailbox-attachments clearfix right-text">
                                <li><span class="mailbox-attachment-icon"><i class="fa fa-file-pdf-o"></i></span>
                                  <div class="mailbox-attachment-info"><a class="mailbox-attachment-name" href="#"><i class="fa fa-paperclip"></i>&nbsp;
                                      report.pdf<br></a><span class="mailbox-attachment-size">1,245 KB<a class="pull-right" href="#"><i class="fa fa-cloud-download"></i></a></span></div>
                                </li>
                                <li><span class="mailbox-attachment-icon"><i class="fa fa-file-word-o"></i></span>
                                  <div class="mailbox-attachment-info"><a class="mailbox-attachment-name" href="#"><i class="fa fa-paperclip"></i>&nbsp;
                                      App_Desc.docx<br></a><span class="mailbox-attachment-size">1,245 KB<a class="pull-right" href="#"><i class="fa fa-cloud-download"></i></a></span></div>
                                </li>
                                <li><span class="mailbox-attachment-icon has-img"><img src="https://unsplash.it/300/300/?random" alt="Attachment"></span>
                                  <div class="mailbox-attachment-info"><a class="mailbox-attachment-name" href="#"><i class="fa fa-camera"></i>&nbsp;
                                      photo1.png<br></a><span class="mailbox-attachment-size">2.67 MB<a class="pull-right" href="#"><i class="fa fa-cloud-download"></i></a></span></div>
                                </li>
                              </ul>
                            </div>
                          </div>
                        </div><br>
                        <button class="remodal-cancel" data-remodal-action="cancel">إلغاء</button>
                        <button class="remodal-confirm" data-remodal-action="confirm">تحميل الكل</button>
                      </div>
                    </div>
                    <div class="clearfix"></div>
                    <hr>
                    <div class="col-md-12">
                      <div class="panel panel-default">
                        <div class="panel-heading" id="heading-1" role="tab">
                          <h4 class="panel-title bgcolor--fadeblue bradius--noborder bshadow--1 padding--small margin--small-top-bottom"><a class="trigger color--white" role="button" data-toggle="collapse" href="#collapse-1" aria-expanded="true" aria-controls="collapse-1">التقرير الفني</a></h4>
                        </div>
                      </div>
                      <div class="panel-collapse collapse" id="collapse-1" role="tabpanel" aria-labelledby="heading-1" aria-expanded="true">
                        <div class="panel-body bgcolor--white bradius--noborder bshadow--1 padding--small margin--small-top-bottom">
                          <div class="row">
                            <div class="col-md-10">
                              <p class="color--gray_d col-md-4 col-md-6 col-sm-6 col-xs-12">
                                بتاريخ
                                10/10/2018
                                &nbsp;<i class="fa fa-calendar"></i>
                              </p>
                              <p class="color--gray_d col-md-4 col-md-6 col-sm-6 col-xs-12">
                                القائم بالمهمة
                                &nbsp;<a href="lawyer_view.html">محمد احمد</a>&nbsp;<i class="fa fa-user"></i>
                              </p>
                              <div class="clearfix"></div>
                              <p class="right-text">لوريم ايبسوم دولار سيت أميت ,كونسيكتيتور أدايبا يسكينج أليايت,سيت دو أيوسمود تيمبورأنكايديديونتيوت لابوري ات دولار ماجنا أليكيوا . يوت انيم أد مينيم فينايم,كيواس نوستريد أكسير سيتاشن يللأمكو لابورأس نيسي يت أليكيوب أكس أيا كوممودو كونسيكيوات . ديواس أيوتي أريري دولار إن ريبريهينديرأيت فوليوبتاتي فيلايت أيسسي كايلليوم دولار أيو فيجايت نيولا باراياتيور. أيكسسيبتيور ساينت أوككايكات كيوبايداتات نون بروايدينت ,سيونت ان كيولباكيو أوفيسيا ديسيريونتموليت انيم أيدي ايست لابوريوم.   </p>
                            </div>
                            <div class="col-md-2"><a class="master-btn color--white bgcolor--main bradius--small bshadow--0 btn-inlineblock" href="#report_attachment2"><i class="fa fa-paperclip"></i><span>الملفات المرفقة</span></a>
                              <div class="remodal-bg"></div>
                              <div class="remodal" data-remodal-id="report_attachment2" role="dialog" aria-labelledby="modal1Title" aria-describedby="modal1Desc">
                                <button class="remodal-close" data-remodal-action="close" aria-label="Close"></button>
                                <div>
                                  <div class="row">
                                    <div class="col-xs-12">
                                      <h3>الملفات المرفقة للتقرير بتاريخ 12/12/2018</h3>
                                      <ul class="mailbox-attachments clearfix right-text">
                                        <li><span class="mailbox-attachment-icon"><i class="fa fa-file-pdf-o"></i></span>
                                          <div class="mailbox-attachment-info"><a class="mailbox-attachment-name" href="#"><i class="fa fa-paperclip"></i>&nbsp;
                                              report.pdf<br></a><span class="mailbox-attachment-size">1,245 KB<a class="pull-right" href="#"><i class="fa fa-cloud-download"></i></a></span></div>
                                        </li>
                                        <li><span class="mailbox-attachment-icon"><i class="fa fa-file-word-o"></i></span>
                                          <div class="mailbox-attachment-info"><a class="mailbox-attachment-name" href="#"><i class="fa fa-paperclip"></i>&nbsp;
                                              App_Desc.docx<br></a><span class="mailbox-attachment-size">1,245 KB<a class="pull-right" href="#"><i class="fa fa-cloud-download"></i></a></span></div>
                                        </li>
                                        <li><span class="mailbox-attachment-icon has-img"><img src="https://unsplash.it/300/300/?random" alt="Attachment"></span>
                                          <div class="mailbox-attachment-info"><a class="mailbox-attachment-name" href="#"><i class="fa fa-camera"></i>&nbsp;
                                              photo1.png<br></a><span class="mailbox-attachment-size">2.67 MB<a class="pull-right" href="#"><i class="fa fa-cloud-download"></i></a></span></div>
                                        </li>
                                      </ul>
                                    </div>
                                  </div>
                                </div><br>
                                <button class="remodal-cancel" data-remodal-action="cancel">إلغاء</button>
                                <button class="remodal-confirm" data-remodal-action="confirm">تحميل الكل</button>
                              </div>
                            </div>
                            <div class="clearfix"></div>
                          </div>
                          <hr>
                          <div class="row">
                            <div class="col-md-10 col-sm-12 col-xs-12">
                              <p class="color--gray_d col-md-4 col-md-6 col-sm-6 col-xs-12">
                                بتاريخ
                                10/10/2018
                                &nbsp;<i class="fa fa-calendar"></i>
                              </p>
                              <p class="color--gray_d col-md-4 col-md-6 col-sm-6 col-xs-12">
                                القائم بالمهمة
                                &nbsp;<a href="lawyer_view.html">محمد احمد</a>&nbsp;<i class="fa fa-user"></i>
                              </p>
                              <div class="clearfix"></div>
                              <p class="right-text">لوريم ايبسوم دولار سيت أميت ,كونسيكتيتور أدايبا يسكينج أليايت,سيت دو أيوسمود تيمبورأنكايديديونتيوت لابوري ات دولار ماجنا أليكيوا . يوت انيم أد مينيم فينايم,كيواس نوستريد أكسير سيتاشن يللأمكو لابورأس نيسي يت أليكيوب أكس أيا كوممودو كونسيكيوات . ديواس أيوتي أريري دولار إن ريبريهينديرأيت فوليوبتاتي فيلايت أيسسي كايلليوم دولار أيو فيجايت نيولا باراياتيور. أيكسسيبتيور ساينت أوككايكات كيوبايداتات نون بروايدينت ,سيونت ان كيولباكيو أوفيسيا ديسيريونتموليت انيم أيدي ايست لابوريوم.   </p>
                            </div>
                            <div class="col-md-2 col-sm-12 col-xs-12"><a class="master-btn color--white bgcolor--main bradius--small bshadow--0 btn-inlineblock" href="#report_attachment2"><i class="fa fa-paperclip"></i><span>الملفات المرفقة</span></a>
                              <div class="remodal-bg"></div>
                              <div class="remodal" data-remodal-id="report_attachment2" role="dialog" aria-labelledby="modal1Title" aria-describedby="modal1Desc">
                                <button class="remodal-close" data-remodal-action="close" aria-label="Close"></button>
                                <div>
                                  <div class="row">
                                    <div class="col-xs-12">
                                      <h3>الملفات المرفقة للتقرير بتاريخ 12/12/2018</h3>
                                      <ul class="mailbox-attachments clearfix right-text">
                                        <li><span class="mailbox-attachment-icon"><i class="fa fa-file-pdf-o"></i></span>
                                          <div class="mailbox-attachment-info"><a class="mailbox-attachment-name" href="#"><i class="fa fa-paperclip"></i>&nbsp;
                                              report.pdf<br></a><span class="mailbox-attachment-size">1,245 KB<a class="pull-right" href="#"><i class="fa fa-cloud-download"></i></a></span></div>
                                        </li>
                                        <li><span class="mailbox-attachment-icon"><i class="fa fa-file-word-o"></i></span>
                                          <div class="mailbox-attachment-info"><a class="mailbox-attachment-name" href="#"><i class="fa fa-paperclip"></i>&nbsp;
                                              App_Desc.docx<br></a><span class="mailbox-attachment-size">1,245 KB<a class="pull-right" href="#"><i class="fa fa-cloud-download"></i></a></span></div>
                                        </li>
                                        <li><span class="mailbox-attachment-icon has-img"><img src="https://unsplash.it/300/300/?random" alt="Attachment"></span>
                                          <div class="mailbox-attachment-info"><a class="mailbox-attachment-name" href="#"><i class="fa fa-camera"></i>&nbsp;
                                              photo1.png<br></a><span class="mailbox-attachment-size">2.67 MB<a class="pull-right" href="#"><i class="fa fa-cloud-download"></i></a></span></div>
                                        </li>
                                      </ul>
                                    </div>
                                  </div>
                                </div><br>
                                <button class="remodal-cancel" data-remodal-action="cancel">إلغاء</button>
                                <button class="remodal-confirm" data-remodal-action="confirm">تحميل الكل</button>
                              </div>
                            </div>
                            <div class="clearfix"></div>
                          </div>
                          <div class="col-md-2 col-sm-3 col-xs-12"><a class="master-btn color--white bgcolor--fadeblue bradius--small bshadow--0 btn-block" href="#add_report"><i class="fa fa-plus"></i><span>إضافة تقرير</span></a>
                            <div class="remodal-bg"></div>
                            <div class="remodal" data-remodal-id="add_report" role="dialog" aria-labelledby="modal2Title" aria-describedby="modal2Desc">
                              <button class="remodal-close" data-remodal-action="close" aria-label="Close"></button>
                              <div>
                                <div class="row">
                                  <div class="col-xs-12">
                                    <h3>إضافة تقرير فني</h3>
                                    <div class="col-md-12">
                                      <div class="master_field">
                                        <label class="master_label mandatory" for="report_desc">وصف التقرير</label>
                                        <textarea class="master_input" name="textarea" id="report_desc" placeholder="وصف التقرير"></textarea><span class="master_message color--fadegreen">message</span>
                                      </div>
                                    </div>
                                    <div class="col-md-12">
                                      <div class="master_field">
                                        <label class="master_label" for="report_upload">إرفاق ملفات</label>
                                        <div class="file-upload">
                                          <div class="file-select">
                                            <div class="file-select-name" id="noFile">إرفاق ملفات</div>
                                            <input class="chooseFile" type="file" name="chooseFile" id="report_upload">
                                          </div>
                                        </div><span class="master_message color--fadegreen">message</span>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div><br>
                              <button class="remodal-cancel" data-remodal-action="cancel">إغلاق</button>
                              <button class="remodal-confirm" data-remodal-action="confirm">إضافة</button>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="clearfix"></div>
                  </div>
                  <div class="tabs--wrapper">
                    <div class="clearfix"></div>
                    <ul class="tabs">
                      <li>الجلسات</li>
                      <li>التحقيقات </li>
                    </ul>
                    <ul class="tab__content">
                      <li class="tab__content_item active">
                        <div class="cardwrap bgcolor--white bradius--noborder   bshadow--1 padding--small margin--small-top-bottom">
                          <div class="col-lg-12">
                            <div class="col-md-2 col-sm-3 colxs-12 pull-right"><a class="master-btn color--white bgcolor--main bradius--small bshadow--0 btn-block" href="#popupModal_3"><i class="fa fa-plus"></i><span>إضافة</span></a>
                              <div class="remodal-bg"></div>
                              <div class="remodal" data-remodal-id="popupModal_3" role="dialog" aria-labelledby="modal1Title" aria-describedby="modal1Desc">
                                <button class="remodal-close" data-remodal-action="close" aria-label="Close"></button>
                                <div>
                                  <div class="row">
                                    <div class="col-xs-12">
                                      <h3>إضافة في الأجندة القضائية</h3>
                                      <div class="col-md-4 col-sm-6 col-xs-12">
                                        <div class="master_field">
                                          <label class="master_label" for="degree">الدرجة</label>
                                          <input class="master_input" type="text" placeholder="الدرجة" id="degree"><span class="master_message color--fadegreen">message</span>
                                        </div>
                                      </div>
                                      <div class="col-md-4 col-sm-6 col-xs-12">
                                        <div class="master_field">
                                          <label class="master_label" for="role">رول</label>
                                          <input class="master_input" type="number" placeholder="رول" id="role"><span class="master_message color--fadegreen">message</span>
                                        </div>
                                      </div>
                                      <div class="col-md-4 col-sm-6 col-xs-12">
                                        <div class="master_field">
                                          <label class="master_label" for="fees">رسوم الدعوى</label>
                                          <input class="master_input" type="number" placeholder="رسوم" id="fees"><span class="master_message color--fadegreen">message</span>
                                        </div>
                                      </div>
                                      <div class="col-md-6 col-sm-6 col-xs-12">
                                        <div class="master_field">
                                          <label class="master_label mandatory">تاريخ الجلسة</label>
                                          <div class="bootstrap-timepicker">
                                            <input class="datepicker master_input" type="text" placeholder="تاريخ الجلسة">
                                          </div><span class="master_message color--fadegreen">message content</span>
                                        </div>
                                      </div>
                                      <div class="col-md-6 col-sm-6 col-xs-12">
                                        <div class="master_field">
                                          <label class="master_label mandatory">تاريخ الجلسة القادمة</label>
                                          <div class="bootstrap-timepicker">
                                            <input class="datepicker master_input" type="text" placeholder="تاريخ الجلسة لقادمة">
                                          </div><span class="master_message color--fadegreen">message content</span>
                                        </div>
                                      </div>
                                      <div class="col-xs-12">
                                        <div class="master_field">
                                          <label class="master_label" for="action_done"> ما تم فيها من دفاع و طلبات</label>
                                          <textarea class="master_input" name="textarea" id="action_done" placeholder=" ما تم فيها من دفاع و طلبات"></textarea><span class="master_message color--fadegreen">message</span>
                                        </div>
                                      </div>
                                      <div class="col-xs-12">
                                        <div class="master_field">
                                          <label class="master_label" for="decision">القرار</label>
                                          <textarea class="master_input" name="textarea" id="decision" placeholder=" القرار"></textarea><span class="master_message color--fadegreen">message</span>
                                        </div>
                                      </div>
                                      <div class="clearfix"></div>
                                    </div>
                                  </div>
                                </div><br>
                                <button class="remodal-cancel" data-remodal-action="cancel">إلغاء</button>
                                <button class="remodal-confirm" data-remodal-action="confirm">حفظ</button>
                              </div>
                            </div>
                            <table class="table-1">
                              <thead>
                                <tr class="bgcolor--gray_mm color--gray_d">
                                  <th><span class="cellcontent">الدرجة</span></th>
                                  <th><span class="cellcontent"> رول</span></th>
                                  <th><span class="cellcontent"> تاريخ الجلسة</span></th>
                                  <th><span class="cellcontent"> ما تم فيها من دفاع و طلبات</span></th>
                                  <th><span class="cellcontent"> القرار</span></th>
                                  <th><span class="cellcontent"> رسوم الدعوي </span></th>
                                  <th><span class="cellcontent">تاريخ الجلسة القادمة</span></th>
                                </tr>
                              </thead>
                              <tbody>
                                <tr>
                                  <td><span class="cellcontent">درجة اولى</span></td>
                                  <td><span class="cellcontent"> 34</span></td>
                                  <td><span class="cellcontent">10-10-2010</span></td>
                                  <td><span class="cellcontent">بعض النص بعض النص بعض النص</span></td>
                                  <td><span class="cellcontent">بعض النص بعض النص بعض النص</span></td>
                                  <td><span class="cellcontent">10920</span></td>
                                  <td><span class="cellcontent">12-12-2018</span></td>
                                </tr>
                                <tr>
                                  <td><span class="cellcontent">درجة اولى</span></td>
                                  <td><span class="cellcontent"> 34</span></td>
                                  <td><span class="cellcontent">10-10-2010</span></td>
                                  <td><span class="cellcontent">بعض النص بعض النص بعض النص</span></td>
                                  <td><span class="cellcontent">بعض النص بعض النص بعض النص</span></td>
                                  <td><span class="cellcontent">10920</span></td>
                                  <td><span class="cellcontent">12-12-2018</span></td>
                                </tr>
                                <tr>
                                  <td><span class="cellcontent">درجة اولى</span></td>
                                  <td><span class="cellcontent"> 34</span></td>
                                  <td><span class="cellcontent">10-10-2010</span></td>
                                  <td><span class="cellcontent">بعض النص بعض النص بعض النص</span></td>
                                  <td><span class="cellcontent">بعض النص بعض النص بعض النص</span></td>
                                  <td><span class="cellcontent">10920</span></td>
                                  <td><span class="cellcontent">12-12-2018</span></td>
                                </tr>
                                <tr>
                                  <td><span class="cellcontent">درجة اولى</span></td>
                                  <td><span class="cellcontent"> 34</span></td>
                                  <td><span class="cellcontent">10-10-2010</span></td>
                                  <td><span class="cellcontent">بعض النص بعض النص بعض النص</span></td>
                                  <td><span class="cellcontent">بعض النص بعض النص بعض النص</span></td>
                                  <td><span class="cellcontent">10920</span></td>
                                  <td><span class="cellcontent">12-12-2018</span></td>
                                </tr>
                                <tr>
                                  <td><span class="cellcontent">درجة اولى</span></td>
                                  <td><span class="cellcontent"> 34</span></td>
                                  <td><span class="cellcontent">10-10-2010</span></td>
                                  <td><span class="cellcontent">بعض النص بعض النص بعض النص</span></td>
                                  <td><span class="cellcontent">بعض النص بعض النص بعض النص</span></td>
                                  <td><span class="cellcontent">10920</span></td>
                                  <td><span class="cellcontent">12-12-2018</span></td>
                                </tr>
                                <tr>
                                  <td><span class="cellcontent">درجة اولى</span></td>
                                  <td><span class="cellcontent"> 34</span></td>
                                  <td><span class="cellcontent">10-10-2010</span></td>
                                  <td><span class="cellcontent">بعض النص بعض النص بعض النص</span></td>
                                  <td><span class="cellcontent">بعض النص بعض النص بعض النص</span></td>
                                  <td><span class="cellcontent">10920</span></td>
                                  <td><span class="cellcontent">12-12-2018</span></td>
                                </tr>
                                <tr>
                                  <td><span class="cellcontent">درجة اولى</span></td>
                                  <td><span class="cellcontent"> 34</span></td>
                                  <td><span class="cellcontent">10-10-2010</span></td>
                                  <td><span class="cellcontent">بعض النص بعض النص بعض النص</span></td>
                                  <td><span class="cellcontent">بعض النص بعض النص بعض النص</span></td>
                                  <td><span class="cellcontent">10920</span></td>
                                  <td><span class="cellcontent">12-12-2018</span></td>
                                </tr>
                                <tr>
                                  <td><span class="cellcontent">درجة اولى</span></td>
                                  <td><span class="cellcontent"> 34</span></td>
                                  <td><span class="cellcontent">10-10-2010</span></td>
                                  <td><span class="cellcontent">بعض النص بعض النص بعض النص</span></td>
                                  <td><span class="cellcontent">بعض النص بعض النص بعض النص</span></td>
                                  <td><span class="cellcontent">10920</span></td>
                                  <td><span class="cellcontent">12-12-2018</span></td>
                                </tr>
                                <tr>
                                  <td><span class="cellcontent">درجة اولى</span></td>
                                  <td><span class="cellcontent"> 34</span></td>
                                  <td><span class="cellcontent">10-10-2010</span></td>
                                  <td><span class="cellcontent">بعض النص بعض النص بعض النص</span></td>
                                  <td><span class="cellcontent">بعض النص بعض النص بعض النص</span></td>
                                  <td><span class="cellcontent">10920</span></td>
                                  <td><span class="cellcontent">12-12-2018</span></td>
                                </tr>
                                <tr>
                                  <td><span class="cellcontent">درجة اولى</span></td>
                                  <td><span class="cellcontent"> 34</span></td>
                                  <td><span class="cellcontent">10-10-2010</span></td>
                                  <td><span class="cellcontent">بعض النص بعض النص بعض النص</span></td>
                                  <td><span class="cellcontent">بعض النص بعض النص بعض النص</span></td>
                                  <td><span class="cellcontent">10920</span></td>
                                  <td><span class="cellcontent">12-12-2018</span></td>
                                </tr>
                                <tr>
                                  <td><span class="cellcontent">درجة اولى</span></td>
                                  <td><span class="cellcontent"> 34</span></td>
                                  <td><span class="cellcontent">10-10-2010</span></td>
                                  <td><span class="cellcontent">بعض النص بعض النص بعض النص</span></td>
                                  <td><span class="cellcontent">بعض النص بعض النص بعض النص</span></td>
                                  <td><span class="cellcontent">10920</span></td>
                                  <td><span class="cellcontent">12-12-2018</span></td>
                                </tr>
                                <tr>
                                  <td><span class="cellcontent">درجة اولى</span></td>
                                  <td><span class="cellcontent"> 34</span></td>
                                  <td><span class="cellcontent">10-10-2010</span></td>
                                  <td><span class="cellcontent">بعض النص بعض النص بعض النص</span></td>
                                  <td><span class="cellcontent">بعض النص بعض النص بعض النص</span></td>
                                  <td><span class="cellcontent">10920</span></td>
                                  <td><span class="cellcontent">12-12-2018</span></td>
                                </tr>
                              </tbody>
                            </table>
                            <div class="remodal log-custom" role="dialog" aria-labelledby="modal1Title" aria-describedby="modal1Desc">
                              <button class="remodal-close" data-remodal-action="close" aria-label="Close"></button>
                              <div>
                                <h2 class="title">title of the changing log in</h2>
                                <div class="log-content">
                                  <div class="log-container">
                                    <table class="log-table">
                                      <tr class="log-row" data-link="https://www.google.com.eg/">
                                        <th>log title</th>
                                        <th>user</th>
                                        <th>time</th>
                                      </tr>
                                      <tr class="log-row" data-link="https://www.google.com.eg/">
                                        <td>January</td>
                                        <td>$100</td>
                                        <td>$100</td>
                                      </tr>
                                      <tr class="log-row" data-link="https://www.google.com.eg/">
                                        <td>February</td>
                                        <td>$80</td>
                                        <td>$80</td>
                                      </tr>
                                      <tr class="log-row" data-link="https://www.google.com.eg/">
                                        <td>January</td>
                                        <td>$100</td>
                                        <td>$100</td>
                                      </tr>
                                      <tr class="log-row" data-link="https://www.google.com.eg/">
                                        <td>February</td>
                                        <td>$80</td>
                                        <td>$80</td>
                                      </tr>
                                      <tr class="log-row" data-link="https://www.google.com.eg/">
                                        <td>January</td>
                                        <td>$100</td>
                                        <td>$100</td>
                                      </tr>
                                      <tr class="log-row" data-link="https://www.google.com.eg/">
                                        <td>February</td>
                                        <td>$80</td>
                                        <td>$80</td>
                                      </tr>
                                      <tr class="log-row" data-link="https://www.google.com.eg/">
                                        <td>January</td>
                                        <td>$100</td>
                                        <td>$100</td>
                                      </tr>
                                      <tr class="log-row" data-link="https://www.google.com.eg/">
                                        <td>February</td>
                                        <td>$80</td>
                                        <td>$80</td>
                                      </tr>
                                      <tr class="log-row" data-link="https://www.google.com.eg/">
                                        <td>January</td>
                                        <td>$100</td>
                                        <td>$100</td>
                                      </tr>
                                      <tr class="log-row" data-link="https://www.google.com.eg/">
                                        <td>February</td>
                                        <td>$80</td>
                                        <td>$80</td>
                                      </tr>
                                      <tr class="log-row" data-link="https://www.google.com.eg/">
                                        <td>January</td>
                                        <td>$100</td>
                                        <td>$100</td>
                                      </tr>
                                      <tr class="log-row" data-link="https://www.google.com.eg/">
                                        <td>February</td>
                                        <td>$80</td>
                                        <td>$80</td>
                                      </tr>
                                      <tr class="log-row" data-link="https://www.google.com.eg/">
                                        <td>January</td>
                                        <td>$100</td>
                                        <td>$100</td>
                                      </tr>
                                      <tr class="log-row" data-link="https://www.google.com.eg/">
                                        <td>February</td>
                                        <td>$80</td>
                                        <td>$80</td>
                                      </tr>
                                      <tr class="log-row" data-link="https://www.google.com.eg/">
                                        <td>January</td>
                                        <td>$100</td>
                                        <td>$100</td>
                                      </tr>
                                      <tr class="log-row" data-link="https://www.google.com.eg/">
                                        <td>February</td>
                                        <td>$80</td>
                                        <td>$80</td>
                                      </tr>
                                      <tr class="log-row" data-link="https://www.google.com.eg/">
                                        <td>January</td>
                                        <td>$100</td>
                                        <td>$100</td>
                                      </tr>
                                      <tr class="log-row" data-link="https://www.google.com.eg/">
                                        <td>February</td>
                                        <td>$80</td>
                                        <td>$80</td>
                                      </tr>
                                      <tr class="log-row" data-link="https://www.google.com.eg/">
                                        <td>January</td>
                                        <td>$100</td>
                                        <td>$100</td>
                                      </tr>
                                      <tr class="log-row" data-link="https://www.google.com.eg/">
                                        <td>February</td>
                                        <td>$80</td>
                                        <td>$80</td>
                                      </tr>
                                      <tr class="log-row" data-link="https://www.google.com.eg/">
                                        <td>January</td>
                                        <td>$100</td>
                                        <td>$100</td>
                                      </tr>
                                      <tr class="log-row" data-link="https://www.google.com.eg/">
                                        <td>February</td>
                                        <td>$80</td>
                                        <td>$80</td>
                                      </tr>
                                      <tr class="log-row" data-link="https://www.google.com.eg/">
                                        <td>January</td>
                                        <td>$100</td>
                                        <td>$100</td>
                                      </tr>
                                      <tr class="log-row" data-link="https://www.google.com.eg/">
                                        <td>February</td>
                                        <td>$80</td>
                                        <td>$80</td>
                                      </tr>
                                      <tr class="log-row" data-link="https://www.google.com.eg/">
                                        <td>January</td>
                                        <td>$100</td>
                                        <td>$100</td>
                                      </tr>
                                      <tr class="log-row" data-link="https://www.google.com.eg/">
                                        <td>February</td>
                                        <td>$80</td>
                                        <td>$80</td>
                                      </tr>
                                      <tr class="log-row" data-link="https://www.google.com.eg/">
                                        <td>January</td>
                                        <td>$100</td>
                                        <td>$100</td>
                                      </tr>
                                      <tr class="log-row" data-link="https://www.google.com.eg/">
                                        <td>February</td>
                                        <td>$80</td>
                                        <td>$80</td>
                                      </tr>
                                    </table>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="clearfix"></div>
                        </div>
                      </li>
                      <li class="tab__content_item">
                        <div class="cardwrap bgcolor--white bradius--noborder   bshadow--1 padding--small margin--small-top-bottom">
                          <div class="col-lg-12">
                            <div class="col-md-2 col-sm-3 colxs-12 pull-right"><a class="master-btn color--white bgcolor--main bradius--small bshadow--0 btn-block" href="#new_investigation"><i class="fa fa-plus"></i><span>إضافة</span></a>
                              <div class="remodal-bg"></div>
                              <div class="remodal" data-remodal-id="new_investigation" role="dialog" aria-labelledby="modal1Title" aria-describedby="modal1Desc">
                                <button class="remodal-close" data-remodal-action="close" aria-label="Close"></button>
                                <div>
                                  <div class="row">
                                    <div class="col-xs-12">
                                      <h3>إضافة محضر</h3>
                                      <div class="col-xs-4">
                                        <div class="master_field">
                                          <label class="master_label" for="investigation_no">رقم المحضر</label>
                                          <input class="master_input" type="text" placeholder="رقم المحضر" id="investigation_no"><span class="master_message color--fadegreen">message</span>
                                        </div>
                                      </div>
                                      <div class="col-xs-4">
                                        <div class="master_field">
                                          <label class="master_label mandatory" for="investigation_type"> نوع المحضر </label>
                                          <select class="master_input select2" id="investigation_type" style="width:100%;">
                                            <option>شرطة</option>
                                            <option>نيابة</option>
                                          </select><span class="master_message color--fadegreen">message</span>
                                        </div>
                                      </div>
                                      <div class="col-md-4">
                                        <div class="master_field">
                                          <label class="master_label mandatory">تاريخ</label>
                                          <div class="bootstrap-timepicker">
                                            <input class="datepicker master_input" type="text" placeholder="تاريخ الاستشارة">
                                          </div><span class="master_message color--fadegreen">message content</span>
                                        </div>
                                      </div>
                                      <div class="col-md-12">
                                        <div class="master_field">
                                          <label class="master_label" for="docs_upload">إرفاق ملفات</label>
                                          <div class="file-upload">
                                            <div class="file-select">
                                              <div class="file-select-name" id="noFile">إرفاق ملفات</div>
                                              <input class="chooseFile" type="file" name="chooseFile" id="docs_upload">
                                            </div>
                                          </div><span class="master_message color--fadegreen">message</span>
                                        </div>
                                      </div>
                                      <div class="clearfix"></div>
                                    </div>
                                  </div>
                                </div><br>
                                <button class="remodal-cancel" data-remodal-action="cancel">إلغاء</button>
                                <button class="remodal-confirm" data-remodal-action="confirm">حفظ</button>
                              </div>
                            </div>
                            <table class="table-1">
                              <thead>
                                <tr class="bgcolor--gray_mm color--gray_d">
                                  <th><span class="cellcontent">رقم المحضر</span></th>
                                  <th><span class="cellcontent">نوع المحضر</span></th>
                                  <th><span class="cellcontent">تاريخ المحضر</span></th>
                                  <th><span class="cellcontent">الملفات المرفقة</span></th>
                                  <th><span class="cellcontent">الإجراءات</span></th>
                                </tr>
                              </thead>
                              <tbody>
                                <tr>
                                  <td><span class="cellcontent">4255</span></td>
                                  <td><span class="cellcontent">محضر شرطة</span></td>
                                  <td><span class="cellcontent">10-10-2010</span></td>
                                  <td><span class="cellcontent"><a href= #investigation_attachment ,  class= "action-btn bgcolor--main color--white "> الملفات المرفقة &nbsp; <i class = "fa  fa-paperclip"></i></a></span></td>
                                  <td><span class="cellcontent"><a href="#"  class= "btn-warning-cancel action-btn bgcolor--fadebrown color--white "><i class = "fa  fa-trash-o"></i></a></span></td>
                                </tr>
                                <tr>
                                  <td><span class="cellcontent">4255</span></td>
                                  <td><span class="cellcontent">محضر شرطة</span></td>
                                  <td><span class="cellcontent">10-10-2010</span></td>
                                  <td><span class="cellcontent"><a href= #investigation_attachment ,  class= "action-btn bgcolor--main color--white "> الملفات المرفقة &nbsp; <i class = "fa  fa-paperclip"></i></a></span></td>
                                  <td><span class="cellcontent"><a href="#"  class= "btn-warning-cancel action-btn bgcolor--fadebrown color--white "><i class = "fa  fa-trash-o"></i></a></span></td>
                                </tr>
                                <tr>
                                  <td><span class="cellcontent">4255</span></td>
                                  <td><span class="cellcontent">محضر شرطة</span></td>
                                  <td><span class="cellcontent">10-10-2010</span></td>
                                  <td><span class="cellcontent"><a href= #investigation_attachment ,  class= "action-btn bgcolor--main color--white "> الملفات المرفقة &nbsp; <i class = "fa  fa-paperclip"></i></a></span></td>
                                  <td><span class="cellcontent"><a href="#"  class= "btn-warning-cancel action-btn bgcolor--fadebrown color--white "><i class = "fa  fa-trash-o"></i></a></span></td>
                                </tr>
                                <tr>
                                  <td><span class="cellcontent">4255</span></td>
                                  <td><span class="cellcontent">محضر شرطة</span></td>
                                  <td><span class="cellcontent">10-10-2010</span></td>
                                  <td><span class="cellcontent"><a href= #investigation_attachment ,  class= "action-btn bgcolor--main color--white "> الملفات المرفقة &nbsp; <i class = "fa  fa-paperclip"></i></a></span></td>
                                  <td><span class="cellcontent"><a href="#"  class= "btn-warning-cancel action-btn bgcolor--fadebrown color--white "><i class = "fa  fa-trash-o"></i></a></span></td>
                                </tr>
                                <tr>
                                  <td><span class="cellcontent">4255</span></td>
                                  <td><span class="cellcontent">محضر شرطة</span></td>
                                  <td><span class="cellcontent">10-10-2010</span></td>
                                  <td><span class="cellcontent"><a href= #investigation_attachment ,  class= "action-btn bgcolor--main color--white "> الملفات المرفقة &nbsp; <i class = "fa  fa-paperclip"></i></a></span></td>
                                  <td><span class="cellcontent"><a href="#"  class= "btn-warning-cancel action-btn bgcolor--fadebrown color--white "><i class = "fa  fa-trash-o"></i></a></span></td>
                                </tr>
                                <tr>
                                  <td><span class="cellcontent">4255</span></td>
                                  <td><span class="cellcontent">محضر شرطة</span></td>
                                  <td><span class="cellcontent">10-10-2010</span></td>
                                  <td><span class="cellcontent"><a href= #investigation_attachment ,  class= "action-btn bgcolor--main color--white "> الملفات المرفقة &nbsp; <i class = "fa  fa-paperclip"></i></a></span></td>
                                  <td><span class="cellcontent"><a href="#"  class= "btn-warning-cancel action-btn bgcolor--fadebrown color--white "><i class = "fa  fa-trash-o"></i></a></span></td>
                                </tr>
                                <tr>
                                  <td><span class="cellcontent">4255</span></td>
                                  <td><span class="cellcontent">محضر شرطة</span></td>
                                  <td><span class="cellcontent">10-10-2010</span></td>
                                  <td><span class="cellcontent"><a href= #investigation_attachment ,  class= "action-btn bgcolor--main color--white "> الملفات المرفقة &nbsp; <i class = "fa  fa-paperclip"></i></a></span></td>
                                  <td><span class="cellcontent"><a href="#"  class= "btn-warning-cancel action-btn bgcolor--fadebrown color--white "><i class = "fa  fa-trash-o"></i></a></span></td>
                                </tr>
                                <tr>
                                  <td><span class="cellcontent">4255</span></td>
                                  <td><span class="cellcontent">محضر شرطة</span></td>
                                  <td><span class="cellcontent">10-10-2010</span></td>
                                  <td><span class="cellcontent"><a href= #investigation_attachment ,  class= "action-btn bgcolor--main color--white "> الملفات المرفقة &nbsp; <i class = "fa  fa-paperclip"></i></a></span></td>
                                  <td><span class="cellcontent"><a href="#"  class= "btn-warning-cancel action-btn bgcolor--fadebrown color--white "><i class = "fa  fa-trash-o"></i></a></span></td>
                                </tr>
                                <tr>
                                  <td><span class="cellcontent">4255</span></td>
                                  <td><span class="cellcontent">محضر شرطة</span></td>
                                  <td><span class="cellcontent">10-10-2010</span></td>
                                  <td><span class="cellcontent"><a href= #investigation_attachment ,  class= "action-btn bgcolor--main color--white "> الملفات المرفقة &nbsp; <i class = "fa  fa-paperclip"></i></a></span></td>
                                  <td><span class="cellcontent"><a href="#"  class= "btn-warning-cancel action-btn bgcolor--fadebrown color--white "><i class = "fa  fa-trash-o"></i></a></span></td>
                                </tr>
                                <tr>
                                  <td><span class="cellcontent">4255</span></td>
                                  <td><span class="cellcontent">محضر شرطة</span></td>
                                  <td><span class="cellcontent">10-10-2010</span></td>
                                  <td><span class="cellcontent"><a href= #investigation_attachment ,  class= "action-btn bgcolor--main color--white "> الملفات المرفقة &nbsp; <i class = "fa  fa-paperclip"></i></a></span></td>
                                  <td><span class="cellcontent"><a href="#"  class= "btn-warning-cancel action-btn bgcolor--fadebrown color--white "><i class = "fa  fa-trash-o"></i></a></span></td>
                                </tr>
                                <tr>
                                  <td><span class="cellcontent">4255</span></td>
                                  <td><span class="cellcontent">محضر شرطة</span></td>
                                  <td><span class="cellcontent">10-10-2010</span></td>
                                  <td><span class="cellcontent"><a href= #investigation_attachment ,  class= "action-btn bgcolor--main color--white "> الملفات المرفقة &nbsp; <i class = "fa  fa-paperclip"></i></a></span></td>
                                  <td><span class="cellcontent"><a href="#"  class= "btn-warning-cancel action-btn bgcolor--fadebrown color--white "><i class = "fa  fa-trash-o"></i></a></span></td>
                                </tr>
                                <tr>
                                  <td><span class="cellcontent">4255</span></td>
                                  <td><span class="cellcontent">محضر شرطة</span></td>
                                  <td><span class="cellcontent">10-10-2010</span></td>
                                  <td><span class="cellcontent"><a href= #investigation_attachment ,  class= "action-btn bgcolor--main color--white "> الملفات المرفقة &nbsp; <i class = "fa  fa-paperclip"></i></a></span></td>
                                  <td><span class="cellcontent"><a href="#"  class= "btn-warning-cancel action-btn bgcolor--fadebrown color--white "><i class = "fa  fa-trash-o"></i></a></span></td>
                                </tr>
                              </tbody>
                            </table>
                            <div class="remodal log-custom" role="dialog" aria-labelledby="modal1Title" aria-describedby="modal1Desc">
                              <button class="remodal-close" data-remodal-action="close" aria-label="Close"></button>
                              <div>
                                <h2 class="title">title of the changing log in</h2>
                                <div class="log-content">
                                  <div class="log-container">
                                    <table class="log-table">
                                      <tr class="log-row" data-link="https://www.google.com.eg/">
                                        <th>log title</th>
                                        <th>user</th>
                                        <th>time</th>
                                      </tr>
                                      <tr class="log-row" data-link="https://www.google.com.eg/">
                                        <td>January</td>
                                        <td>$100</td>
                                        <td>$100</td>
                                      </tr>
                                      <tr class="log-row" data-link="https://www.google.com.eg/">
                                        <td>February</td>
                                        <td>$80</td>
                                        <td>$80</td>
                                      </tr>
                                      <tr class="log-row" data-link="https://www.google.com.eg/">
                                        <td>January</td>
                                        <td>$100</td>
                                        <td>$100</td>
                                      </tr>
                                      <tr class="log-row" data-link="https://www.google.com.eg/">
                                        <td>February</td>
                                        <td>$80</td>
                                        <td>$80</td>
                                      </tr>
                                      <tr class="log-row" data-link="https://www.google.com.eg/">
                                        <td>January</td>
                                        <td>$100</td>
                                        <td>$100</td>
                                      </tr>
                                      <tr class="log-row" data-link="https://www.google.com.eg/">
                                        <td>February</td>
                                        <td>$80</td>
                                        <td>$80</td>
                                      </tr>
                                      <tr class="log-row" data-link="https://www.google.com.eg/">
                                        <td>January</td>
                                        <td>$100</td>
                                        <td>$100</td>
                                      </tr>
                                      <tr class="log-row" data-link="https://www.google.com.eg/">
                                        <td>February</td>
                                        <td>$80</td>
                                        <td>$80</td>
                                      </tr>
                                      <tr class="log-row" data-link="https://www.google.com.eg/">
                                        <td>January</td>
                                        <td>$100</td>
                                        <td>$100</td>
                                      </tr>
                                      <tr class="log-row" data-link="https://www.google.com.eg/">
                                        <td>February</td>
                                        <td>$80</td>
                                        <td>$80</td>
                                      </tr>
                                      <tr class="log-row" data-link="https://www.google.com.eg/">
                                        <td>January</td>
                                        <td>$100</td>
                                        <td>$100</td>
                                      </tr>
                                      <tr class="log-row" data-link="https://www.google.com.eg/">
                                        <td>February</td>
                                        <td>$80</td>
                                        <td>$80</td>
                                      </tr>
                                      <tr class="log-row" data-link="https://www.google.com.eg/">
                                        <td>January</td>
                                        <td>$100</td>
                                        <td>$100</td>
                                      </tr>
                                      <tr class="log-row" data-link="https://www.google.com.eg/">
                                        <td>February</td>
                                        <td>$80</td>
                                        <td>$80</td>
                                      </tr>
                                      <tr class="log-row" data-link="https://www.google.com.eg/">
                                        <td>January</td>
                                        <td>$100</td>
                                        <td>$100</td>
                                      </tr>
                                      <tr class="log-row" data-link="https://www.google.com.eg/">
                                        <td>February</td>
                                        <td>$80</td>
                                        <td>$80</td>
                                      </tr>
                                      <tr class="log-row" data-link="https://www.google.com.eg/">
                                        <td>January</td>
                                        <td>$100</td>
                                        <td>$100</td>
                                      </tr>
                                      <tr class="log-row" data-link="https://www.google.com.eg/">
                                        <td>February</td>
                                        <td>$80</td>
                                        <td>$80</td>
                                      </tr>
                                      <tr class="log-row" data-link="https://www.google.com.eg/">
                                        <td>January</td>
                                        <td>$100</td>
                                        <td>$100</td>
                                      </tr>
                                      <tr class="log-row" data-link="https://www.google.com.eg/">
                                        <td>February</td>
                                        <td>$80</td>
                                        <td>$80</td>
                                      </tr>
                                      <tr class="log-row" data-link="https://www.google.com.eg/">
                                        <td>January</td>
                                        <td>$100</td>
                                        <td>$100</td>
                                      </tr>
                                      <tr class="log-row" data-link="https://www.google.com.eg/">
                                        <td>February</td>
                                        <td>$80</td>
                                        <td>$80</td>
                                      </tr>
                                      <tr class="log-row" data-link="https://www.google.com.eg/">
                                        <td>January</td>
                                        <td>$100</td>
                                        <td>$100</td>
                                      </tr>
                                      <tr class="log-row" data-link="https://www.google.com.eg/">
                                        <td>February</td>
                                        <td>$80</td>
                                        <td>$80</td>
                                      </tr>
                                      <tr class="log-row" data-link="https://www.google.com.eg/">
                                        <td>January</td>
                                        <td>$100</td>
                                        <td>$100</td>
                                      </tr>
                                      <tr class="log-row" data-link="https://www.google.com.eg/">
                                        <td>February</td>
                                        <td>$80</td>
                                        <td>$80</td>
                                      </tr>
                                      <tr class="log-row" data-link="https://www.google.com.eg/">
                                        <td>January</td>
                                        <td>$100</td>
                                        <td>$100</td>
                                      </tr>
                                      <tr class="log-row" data-link="https://www.google.com.eg/">
                                        <td>February</td>
                                        <td>$80</td>
                                        <td>$80</td>
                                      </tr>
                                    </table>
                                  </div>
                                </div>
                              </div>
                            </div><a class="master-btn undefined undefined undefined undefined undefined" href="#investigation_attachment"><span></span></a>
                            <div class="remodal-bg"></div>
                            <div class="remodal" data-remodal-id="investigation_attachment" role="dialog" aria-labelledby="modal1Title" aria-describedby="modal1Desc">
                              <button class="remodal-close" data-remodal-action="close" aria-label="Close"></button>
                              <div>
                                <div class="row">
                                  <div class="col-xs-12">
                                    <h3>الملفات المرفقة للتحقيق بتاريخ 12/12/2018</h3>
                                    <ul class="mailbox-attachments clearfix right-text">
                                      <li><span class="mailbox-attachment-icon"><i class="fa fa-file-pdf-o"></i></span>
                                        <div class="mailbox-attachment-info"><a class="mailbox-attachment-name" href="#"><i class="fa fa-paperclip"></i>&nbsp;
                                            report.pdf<br></a><span class="mailbox-attachment-size">1,245 KB<a class="pull-right" href="#"><i class="fa fa-cloud-download"></i></a></span></div>
                                      </li>
                                      <li><span class="mailbox-attachment-icon"><i class="fa fa-file-word-o"></i></span>
                                        <div class="mailbox-attachment-info"><a class="mailbox-attachment-name" href="#"><i class="fa fa-paperclip"></i>&nbsp;
                                            App_Desc.docx<br></a><span class="mailbox-attachment-size">1,245 KB<a class="pull-right" href="#"><i class="fa fa-cloud-download"></i></a></span></div>
                                      </li>
                                      <li><span class="mailbox-attachment-icon has-img"><img src="https://unsplash.it/300/300/?random" alt="Attachment"></span>
                                        <div class="mailbox-attachment-info"><a class="mailbox-attachment-name" href="#"><i class="fa fa-camera"></i>&nbsp;
                                            photo1.png<br></a><span class="mailbox-attachment-size">2.67 MB<a class="pull-right" href="#"><i class="fa fa-cloud-download"></i></a></span></div>
                                      </li>
                                    </ul>
                                  </div>
                                </div>
                              </div><br>
                              <button class="remodal-cancel" data-remodal-action="cancel">إلغاء</button>
                              <button class="remodal-confirm" data-remodal-action="confirm">تحميل الكل</button>
                            </div>
                          </div>
                          <div class="clearfix"></div>
                        </div>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
              <!-- =============== PAGE VENDOR Triggers ===============-->
                      @endsection