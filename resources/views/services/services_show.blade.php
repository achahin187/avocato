@extends('layout.app')
@section('content')


              
              <!-- =============== Custom Content ===============-->
              <div class="row">
                <div class="col-lg-12">
                  <div class="cover-inside-container margin--small-top-bottom bradius--small bshadow--1" style="background:  url( 'img/covers/dummy2.jpg ' ) no-repeat center center; background-size:cover;">
                    <div class="row">
                      <div class="col-xs-12">
                        <div class="text-xs-center">
                          <div class="text-wraper">
                            <h4 class="cover-inside-title color--gray_d">القضايا و الخدمات <i class="fa fa-chevron-circle-right"></i>
                              <h4 class="cover-inside-title color--gray_d">الخدمات </h4>
                            </h4>
                          </div>
                        </div>
                      </div>
                      <div class="cover--actions"><a class="color--gray_d bordercolor--white bradius--small border-btn master-btn" type="button" href="assign_known_task.html">تغيير المحامي</a>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-lg-12">
                  <div class="cardwrap bgcolor--white bradius--noborder   bshadow--1 padding--small margin--small-top-bottom">
                    <div class="col-md-1 col-xs-2"><img class="full-width bradius--circle" src="{{asset(''.$service->client->image)}}"></div>
                    <div class="col-md-2 col-xs-3">
                      <div class="right-text margin--medium-top-bottom"><b>القائم بالإجراء</b></div><a href="lawyer_view.html">محمد احمد</a>
                    </div>
                    <div class="clearfix"></div>
                    <div class="col-lg-12"><br>
                      <div class="ticket-container">
                        <div class="clearfix">
                          <div class="layer clearfix">
                            <div class="tck-info col-xs-12"><span class="tiket-data right light-color col-md-2 col-xs-6">
                                <div class="pull-right">
                                  تاريخ
                                  10/10/2018
                                  &nbsp;<i class="fa fa-calendar"></i>
                                </div></span><span class="tiket-data light-color col-md-4 col-xs-6"> اسم العميل: <a href="clients_compaines_view.html">محمد احمد</a>&nbsp;<span class="color--sec">(عميل أفراد)</span></span>
                              <div class="clearfix"></div>
                              <hr><span class="tiket-data col-md-12"><i class="fa fa-map-marker"></i><b>عنوان العميل: </b>4شارع التحرير الدقى القاهرة</span>
                              <div class="clearfix"></div>
                              <hr><span class="tiket-data light-color col-md-12"><span>نوع الخدمة</span>&nbsp;<span class="bgcolor--fadepurple color--white bradius--small importance padding--small">مجانية</span></span>
                            </div>
                            <div class="status-bar">
                              <div class="status">
                                الحالة
                                &nbsp;<span class="bgcolor--fadegreen color--black bradius--small importance padding--small">تم</span>
                              </div>
                            </div>
                            <div class="clearfix"></div>
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
                              <h3>تغيير حالة الخدمة</h3>
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
                              <p class="color--gray_d col-md-4 col-md-6 col-sm-6 col-xs-12"><a href="lawyer_view.html">محمد احمد</a>&nbsp;<i class="fa fa-user"></i></p>
                              <p class="right-text">لوريم ايبسوم دولار سيت أميت ,كونسيكتيتور أدايبا يسكينج أليايت,سيت دو أيوسمود تيمبورأنكايديديونتيوت لابوري ات دولار ماجنا أليكيوا . يوت انيم أد مينيم فينايم,كيواس نوستريد أكسير سيتاشن يللأمكو لابورأس نيسي يت أليكيوب أكس أيا كوممودو كونسيكيوات . ديواس أيوتي أريري دولار إن ريبريهينديرأيت فوليوبتاتي فيلايت أيسسي كايلليوم دولار أيو فيجايت نيولا باراياتيور. أيكسسيبتيور ساينت أوككايكات كيوبايداتات نون بروايدينت ,سيونت ان كيولباكيو أوفيسيا ديسيريونتموليت انيم أيدي ايست لابوريوم.   </p>
                            </div>
                            <div class="col-md-2"><a class="master-btn color--white bgcolor--main bradius--small bshadow--0 btn-inlineblock" href="#report_attachment1"><i class="fa fa-paperclip"></i><span>الملفات المرفقة</span></a>
                              <div class="remodal-bg"></div>
                              <div class="remodal" data-remodal-id="report_attachment1" role="dialog" aria-labelledby="modal1Title" aria-describedby="modal1Desc">
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
                          <div class="row">
                            <div class="col-md-10">
                              <p class="color--gray_d col-md-4 col-md-6 col-sm-6 col-xs-12">
                                بتاريخ
                                10/10/2018
                                &nbsp;<i class="fa fa-calendar"></i>
                              </p>
                              <p class="color--gray_d col-md-4 col-md-6 col-sm-6 col-xs-12"><a href="lawyer_view.html">محمد احمد</a>&nbsp;<i class="fa fa-user"></i></p>
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
                          <div class="col-md-2"><a class="master-btn color--main bgcolor--fadegreen bradius--small bshadow--0 btn-block" href="#popupModal_2"><i class="fa fa-plus"></i><span>إضافة تقرير</span></a>
                            <div class="remodal-bg"></div>
                            <div class="remodal" data-remodal-id="popupModal_2" role="dialog" aria-labelledby="modal2Title" aria-describedby="modal2Desc">
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
                                        <label class="master_label" for="docs_upload">إرفاق ملفات</label>
                                        <div class="file-upload">
                                          <div class="file-select">
                                            <div class="file-select-name" id="noFile">إرفاق ملفات</div>
                                            <input class="chooseFile" type="file" name="chooseFile" id="docs_upload">
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
                          <div class="clearfix"></div>
                        </div>
                      </div>
                    </div>
                    <div class="clearfix"></div><br>
                  </div>
                  <div class="cardwrap bgcolor--white bradius--noborder   bshadow--1 padding--small margin--small-top-bottom">
                    <div class="main-title-conts">
                      <div class="caption">
                        <h3>رسوم الخدمة</h3>
                      </div>
                      <div class="actions"><a class="color--white bgcolor--main_l bradius--small undefined master-btn" type="button" href="#add_fees">إضافة رسوم</a>
                      </div><span class="mainseparator bgcolor--main"></span>
                    </div>
                    <div class="col-md-2 col-sm-12 col-xs-12 pull-right"><a class="master-btn undefined undefined undefined undefined undefined" href="#add_fees"><span></span></a>
                      <div class="remodal-bg"></div>
                      <div class="remodal" data-remodal-id="add_fees" role="dialog" aria-labelledby="modal2Title" aria-describedby="modal2Desc">
                        <button class="remodal-close" data-remodal-action="close" aria-label="Close"></button>
                        <div>
                          <div class="row">
                            <div class="col-xs-12">
                              <h3>إضافة رسوم</h3>
                              <div class="col-md-4 col-sm-6 col-xs-12">
                                <div class="master_field">
                                  <label class="master_label" for="payment_amount">المبلغ</label>
                                  <input class="master_input" type="text" placeholder="المبلغ" id="payment_amount"><span class="master_message color--fadegreen">message</span>
                                </div>
                              </div>
                              <div class="col-md-4 col-sm-6 col-xs-12">
                                <div class="master_field">
                                  <label class="master_label mandatory">تاريخ الخدمة</label>
                                  <div class="bootstrap-timepicker">
                                    <input class="datepicker master_input" type="text" placeholder="تاريخ">
                                  </div><span class="master_message color--fadegreen">message content</span>
                                </div>
                              </div>
                              <div class="col-md-4 col-sm-6 col-xs-12">
                                <div class="master_field">
                                  <label class="master_label mandatory" for="payment_status">حالة السداد</label>
                                  <select class="master_input select2" id="payment_status" style="width:100%;">
                                    <option>لم يتم</option>
                                    <option>تم</option>
                                  </select><span class="master_message color--fadegreen">message</span>
                                </div>
                              </div>
                              <div class="col-md-12">
                                <div class="master_field">
                                  <label class="master_label mandatory" for="payment_desc">السبب</label>
                                  <textarea class="master_input" name="textarea" id="payment_desc" placeholder="السبب "></textarea><span class="master_message color--fadegreen">message</span>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div><br>
                        <button class="remodal-cancel" data-remodal-action="cancel">إغلاق</button>
                        <button class="remodal-confirm" data-remodal-action="confirm">إضافة</button>
                      </div>
                    </div>
                    <table class="table-1">
                      <thead>
                        <tr class="bgcolor--gray_mm color--gray_d">
                          <th><span class="cellcontent"> تاريخ</span></th>
                          <th><span class="cellcontent"> السبب</span></th>
                          <th><span class="cellcontent"> المبلغ</span></th>
                          <th><span class="cellcontent">حالة السداد</span></th>
                          <th><span class="cellcontent">الإجراءات</span></th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td><span class="cellcontent">10-10-2010</span></td>
                          <td><span class="cellcontent">بعض النص بعض النص</span></td>
                          <td><span class="cellcontent">1020</span></td>
                          <td><span class="cellcontent"><i class = "fa color--fadegreen fa-check"></i></span></td>
                          <td><span class="cellcontent"><a href= #fees ,  class= "action-btn bgcolor--fadegreen color--white "><i class = "fa  fa-pencil"></i></a><a href="#"  class= "btn-warning-cancel action-btn bgcolor--fadebrown color--white "><i class = "fa  fa-trash-o"></i></a></span></td>
                        </tr>
                        <tr>
                          <td><span class="cellcontent">10-10-2010</span></td>
                          <td><span class="cellcontent">بعض النص بعض النص</span></td>
                          <td><span class="cellcontent">1020</span></td>
                          <td><span class="cellcontent"><i class = "fa color--fadegreen fa-check"></i></span></td>
                          <td><span class="cellcontent"><a href= #fees ,  class= "action-btn bgcolor--fadegreen color--white "><i class = "fa  fa-pencil"></i></a><a href="#"  class= "btn-warning-cancel action-btn bgcolor--fadebrown color--white "><i class = "fa  fa-trash-o"></i></a></span></td>
                        </tr>
                        <tr>
                          <td><span class="cellcontent">10-10-2010</span></td>
                          <td><span class="cellcontent">بعض النص بعض النص</span></td>
                          <td><span class="cellcontent">1020</span></td>
                          <td><span class="cellcontent"><i class = "fa color--fadegreen fa-check"></i></span></td>
                          <td><span class="cellcontent"><a href= #fees ,  class= "action-btn bgcolor--fadegreen color--white "><i class = "fa  fa-pencil"></i></a><a href="#"  class= "btn-warning-cancel action-btn bgcolor--fadebrown color--white "><i class = "fa  fa-trash-o"></i></a></span></td>
                        </tr>
                        <tr>
                          <td><span class="cellcontent">10-10-2010</span></td>
                          <td><span class="cellcontent">بعض النص بعض النص</span></td>
                          <td><span class="cellcontent">1020</span></td>
                          <td><span class="cellcontent"><i class = "fa color--fadegreen fa-check"></i></span></td>
                          <td><span class="cellcontent"><a href= #fees ,  class= "action-btn bgcolor--fadegreen color--white "><i class = "fa  fa-pencil"></i></a><a href="#"  class= "btn-warning-cancel action-btn bgcolor--fadebrown color--white "><i class = "fa  fa-trash-o"></i></a></span></td>
                        </tr>
                        <tr>
                          <td><span class="cellcontent">10-10-2010</span></td>
                          <td><span class="cellcontent">بعض النص بعض النص</span></td>
                          <td><span class="cellcontent">1020</span></td>
                          <td><span class="cellcontent"><i class = "fa color--fadegreen fa-check"></i></span></td>
                          <td><span class="cellcontent"><a href= #fees ,  class= "action-btn bgcolor--fadegreen color--white "><i class = "fa  fa-pencil"></i></a><a href="#"  class= "btn-warning-cancel action-btn bgcolor--fadebrown color--white "><i class = "fa  fa-trash-o"></i></a></span></td>
                        </tr>
                        <tr>
                          <td><span class="cellcontent">10-10-2010</span></td>
                          <td><span class="cellcontent">بعض النص بعض النص</span></td>
                          <td><span class="cellcontent">1020</span></td>
                          <td><span class="cellcontent"><i class = "fa color--fadegreen fa-check"></i></span></td>
                          <td><span class="cellcontent"><a href= #fees ,  class= "action-btn bgcolor--fadegreen color--white "><i class = "fa  fa-pencil"></i></a><a href="#"  class= "btn-warning-cancel action-btn bgcolor--fadebrown color--white "><i class = "fa  fa-trash-o"></i></a></span></td>
                        </tr>
                        <tr>
                          <td><span class="cellcontent">10-10-2010</span></td>
                          <td><span class="cellcontent">بعض النص بعض النص</span></td>
                          <td><span class="cellcontent">1020</span></td>
                          <td><span class="cellcontent"><i class = "fa color--fadegreen fa-check"></i></span></td>
                          <td><span class="cellcontent"><a href= #fees ,  class= "action-btn bgcolor--fadegreen color--white "><i class = "fa  fa-pencil"></i></a><a href="#"  class= "btn-warning-cancel action-btn bgcolor--fadebrown color--white "><i class = "fa  fa-trash-o"></i></a></span></td>
                        </tr>
                        <tr>
                          <td><span class="cellcontent">10-10-2010</span></td>
                          <td><span class="cellcontent">بعض النص بعض النص</span></td>
                          <td><span class="cellcontent">1020</span></td>
                          <td><span class="cellcontent"><i class = "fa color--fadegreen fa-check"></i></span></td>
                          <td><span class="cellcontent"><a href= #fees ,  class= "action-btn bgcolor--fadegreen color--white "><i class = "fa  fa-pencil"></i></a><a href="#"  class= "btn-warning-cancel action-btn bgcolor--fadebrown color--white "><i class = "fa  fa-trash-o"></i></a></span></td>
                        </tr>
                        <tr>
                          <td><span class="cellcontent">10-10-2010</span></td>
                          <td><span class="cellcontent">بعض النص بعض النص</span></td>
                          <td><span class="cellcontent">1020</span></td>
                          <td><span class="cellcontent"><i class = "fa color--fadegreen fa-check"></i></span></td>
                          <td><span class="cellcontent"><a href= #fees ,  class= "action-btn bgcolor--fadegreen color--white "><i class = "fa  fa-pencil"></i></a><a href="#"  class= "btn-warning-cancel action-btn bgcolor--fadebrown color--white "><i class = "fa  fa-trash-o"></i></a></span></td>
                        </tr>
                        <tr>
                          <td><span class="cellcontent">10-10-2010</span></td>
                          <td><span class="cellcontent">بعض النص بعض النص</span></td>
                          <td><span class="cellcontent">1020</span></td>
                          <td><span class="cellcontent"><i class = "fa color--fadegreen fa-check"></i></span></td>
                          <td><span class="cellcontent"><a href= #fees ,  class= "action-btn bgcolor--fadegreen color--white "><i class = "fa  fa-pencil"></i></a><a href="#"  class= "btn-warning-cancel action-btn bgcolor--fadebrown color--white "><i class = "fa  fa-trash-o"></i></a></span></td>
                        </tr>
                        <tr>
                          <td><span class="cellcontent">10-10-2010</span></td>
                          <td><span class="cellcontent">بعض النص بعض النص</span></td>
                          <td><span class="cellcontent">1020</span></td>
                          <td><span class="cellcontent"><i class = "fa color--fadegreen fa-check"></i></span></td>
                          <td><span class="cellcontent"><a href= #fees ,  class= "action-btn bgcolor--fadegreen color--white "><i class = "fa  fa-pencil"></i></a><a href="#"  class= "btn-warning-cancel action-btn bgcolor--fadebrown color--white "><i class = "fa  fa-trash-o"></i></a></span></td>
                        </tr>
                        <tr>
                          <td><span class="cellcontent">10-10-2010</span></td>
                          <td><span class="cellcontent">بعض النص بعض النص</span></td>
                          <td><span class="cellcontent">1020</span></td>
                          <td><span class="cellcontent"><i class = "fa color--fadegreen fa-check"></i></span></td>
                          <td><span class="cellcontent"><a href= #fees ,  class= "action-btn bgcolor--fadegreen color--white "><i class = "fa  fa-pencil"></i></a><a href="#"  class= "btn-warning-cancel action-btn bgcolor--fadebrown color--white "><i class = "fa  fa-trash-o"></i></a></span></td>
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
                    <div class="col-md-2"><a class="master-btn undefined undefined undefined undefined undefined" href="#fees"><span></span></a>
                      <div class="remodal-bg"></div>
                      <div class="remodal" data-remodal-id="fees" role="dialog" aria-labelledby="modal2Title" aria-describedby="modal2Desc">
                        <button class="remodal-close" data-remodal-action="close" aria-label="Close"></button>
                        <div>
                          <div class="row">
                            <div class="col-xs-12">
                              <h3>تغيير حالة سداد الرسوم</h3>
                              <div class="master_field">       
                                <input class="icon" type="radio" name="icon" id="payment_status1" checked="true">
                                <label for="payment_status1">تم</label>
                                <input class="icon" type="radio" name="icon" id="payment_status2">
                                <label for="payment_status2">لم يتم</label>
                              </div>
                            </div>
                          </div>
                        </div><br>
                        <button class="remodal-cancel" data-remodal-action="cancel">إغلاق</button>
                        <button class="remodal-confirm" data-remodal-action="confirm">تعديل</button>
                      </div>
                    </div>
                    <div class="clearfix"></div>
                  </div>
                </div>
              </div>
              <!-- =============== PAGE VENDOR Triggers ===============-->
            


@endsection