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
                              <h4 class="cover-inside-title color--gray_d">القضايا </h4>
                            </h4>
                          </div>
                        </div>
                      </div>
                      <div class="cover--actions"><span></span>
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
                    <div class="col-md-9 col-xs-6">
                      <h4 class="right-text">الدعوى رقم {{$case->claim_number}}</h4><b>لسنة {{$case->claim_year}}</b>
                    </div>
                    <div class="col-md-1 col-xs-2"><img class="full-width bradius--circle" src="../img/avatars/male.jpg"></div>
                    <div class="col-md-2 col-xs-3">
                      <div class="right-text margin--medium-top-bottom"><b>المحامي المسئول</b></div>
                      @foreach($case->lawyers as $lawyer)
                      <a href="{{URL('lawyers_show/'.$lawyer->id)}}">
                        
                        {{$lawyer->name}} &
                        
                      </a>
                      @endforeach
                    </div>
                    <div class="clearfix"></div>
                    <div class="col-lg-12"><br>
                      <div class="ticket-container">
                        <div class="clearfix">
                          <div class="layer clearfix">
                            <div class="tck-info col-xs-12">
                              <div class="col-xs-12"><span class="tiket-data light-color col-md-3"> محكمة {{$case->courts->name}}</span><span class="tiket-data right light-color col-md-5">
                                  <div class="pull-right">
                                    تاريخ قيد الدعوى
                                    {{$case->claim_date}}
                                    &nbsp;<i class="fa fa-calendar"></i>
                                  </div></span></div>
                              <div class="clearfix"></div>
                              <?php $i=1; ?>
                              @foreach($case->clients as $client)
                              <hr>
                              <div class="tiket-data col-md-6 col-sm-6 col-xs-12"><b class="col-xs-3">اسم الموكل ({{$i}})</b>
                                <div class="col-xs-9">{{$client->name}}</div>
                              </div>
                              <div class="tiket-data col-md-6 col-sm-6 col-xs-12"><b class="col-xs-3">صفته</b>
                                <div class="col-xs-9">{{Helper::localizations('case_client_roles','name',$client->pivot->case_client_role_id)}}</div>
                              </div>
                              <div class="tiket-data col-md-6 col-sm-6 col-xs-12"><b class="col-xs-3">عنوانه</b>
                                <div class="col-xs-9">{{$client->address}}</div>
                              </div>
                              <div class="tiket-data col-md-6 col-sm-6 col-xs-12"><b class="col-xs-3">هاتف</b>
                                <div class="col-xs-9">{{$client->mobile}}</div>
                              </div>
                              <div class="clearfix"></div>
                              <hr>
                              {{$i++}}
                             @endforeach
                              <div class="tiket-data col-xs-6"><b class="col-xs-3">اسم الخصم</b>
                                <div class="col-xs-9">{{$case->contender_name}}</div>
                              </div>
                              <div class="tiket-data col-xs-6"><b class="col-xs-3">صفته</b>
                                <div class="col-xs-9">{{Helper::localizations('case_client_roles','name',$case->contender_case_client_role_id)}}</div>
                              </div>
                              <div class="tiket-data col-xs-6"><b class="col-xs-3">عنوانه</b>
                                <div class="col-xs-9">{{$case->contender_address}}</div>
                              </div>
                              <div class="tiket-data col-xs-6"><b class="col-xs-3">محاميه</b>
                                <div class="col-xs-9">{{$case->contender_laywer}}</div>
                              </div>
                              <div class="clearfix"></div>
                              <hr><span class="tiket-data col-xs-12"><b>الموضوع:</b>&nbsp;
                                 {{$case->case_body}}
                               </span>
                              <div class="clearfix"></div>
                              <hr><span class="tiket-data col-md-4 col-sm-6 col-xs-12"><b>رقم الملف بالمكتب</b>&nbsp;
                                {{$case->office_file_number}}</span><span class="tiket-data col-md-4 col-sm-6 col-xs-12"><b>رقم التوكيل</b>&nbsp;
                                12334</span><span class="tiket-data col-md-4 col-sm-6 col-xs-12"><b>رسوم الدعوى</b>&nbsp;
                               {{$case->claim_expenses}} جنية</span>
                            </div>
                            <div class="status-bar">
                              <div class="status">
                                الحالة
                                &nbsp;<span class="bgcolor--fadeblack color--white bradius--small importance padding--small">
                                  @if($case->archived == 0)
                                  متداوله
                                  @else
                                  مغلقه
                                  @endif</span>
                              </div>
                            </div>
                            <div class="clearfix"></div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="col-md-2 col-sm-6 col-xs-12 pull-right"><a class="master-btn color--white bgcolor--fadered bradius--small bshadow--0 btn-block" href="#case_attachment"><i class="fa fa-file"></i><span>صور مستندات القضية</span></a>
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
                              <p class="color--gray_d col-md-4 col-xs-6">
                                بتاريخ
                                10/10/2018
                                &nbsp;<i class="fa fa-calendar"></i>
                              </p>
                              <p class="color--gray_d col-md-4 col-xs-6">
                                القائم بالمهمة
                                &nbsp;<a href="lawyer_view.html">محمد احمد</a>&nbsp;<i class="fa fa-user"></i>
                              </p>
                              <div class="clearfix"></div>
                              <p class="right-text">لوريم ايبسوم دولار سيت أميت ,كونسيكتيتور أدايبا يسكينج أليايت,سيت دو أيوسمود تيمبورأنكايديديونتيوت لابوري ات دولار ماجنا أليكيوا . يوت انيم أد مينيم فينايم,كيواس نوستريد أكسير سيتاشن يللأمكو لابورأس نيسي يت أليكيوب أكس أيا كوممودو كونسيكيوات . ديواس أيوتي أريري دولار إن ريبريهينديرأيت فوليوبتاتي فيلايت أيسسي كايلليوم دولار أيو فيجايت نيولا باراياتيور. أيكسسيبتيور ساينت أوككايكات كيوبايداتات نون بروايدينت ,سيونت ان كيولباكيو أوفيسيا ديسيريونتموليت انيم أيدي ايست لابوريوم.</p>
                            </div>
                          </div>
                          <hr>
                          <div class="row">
                            <div class="col-md-10">
                              <p class="color--gray_d col-md-4 col-xs-6">
                                بتاريخ
                                10/10/2018
                                &nbsp;<i class="fa fa-calendar"></i>
                              </p>
                              <p class="color--gray_d col-md-4 col-xs-6">
                                القائم بالمهمة
                                &nbsp;<a href="lawyer_view.html">محمد احمد</a>&nbsp;<i class="fa fa-user"></i>
                              </p>
                              <div class="clearfix"></div>
                              <p class="right-text">لوريم ايبسوم دولار سيت أميت ,كونسيكتيتور أدايبا يسكينج أليايت,سيت دو أيوسمود تيمبورأنكايديديونتيوت لابوري ات دولار ماجنا أليكيوا . يوت انيم أد مينيم فينايم,كيواس نوستريد أكسير سيتاشن يللأمكو لابورأس نيسي يت أليكيوب أكس أيا كوممودو كونسيكيوات . ديواس أيوتي أريري دولار إن ريبريهينديرأيت فوليوبتاتي فيلايت أيسسي كايلليوم دولار أيو فيجايت نيولا باراياتيور. أيكسسيبتيور ساينت أوككايكات كيوبايداتات نون بروايدينت ,سيونت ان كيولباكيو أوفيسيا ديسيريونتموليت انيم أيدي ايست لابوريوم.</p>
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
                        </div>
                      </div>
                    </div>
                    <div class="clearfix"></div>
                  </div>
                  <div class="tabs--wrapper">
                    <div class="clearfix"></div>
                    <ul class="tabs">
                      <li>التحقيقات </li>
                      <li>جدول الجلسات</li>
                    </ul>
                    <ul class="tab__content">
                      <li class="tab__content_item active">
                        <div class="cardwrap bgcolor--white bradius--noborder   bshadow--1 padding--small margin--small-top-bottom">
                          <div class="col-lg-12">
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

                                @foreach($case->case_records as $record)
                                <tr data-record-id={{$record->id}}>
                                  <td><span class="cellcontent">{{$record->record_number}}</span></td>
                                  <td><span class="cellcontent">{{$record->record_type_id}}</span></td>
                                  <td><span class="cellcontent">{{$record->record_date}}</span></td>
                                  <td><span class="cellcontent"><a href="#investigation_attachment/{{$record->id}}"  ,  class= "action-btn bgcolor--main color--white "> &nbsp; <i class = "fa  fa-paperclip"></i></a></span></td>
                                  <td><span class="cellcontent"><a href="#"  class= "btn-warning-cancel action-btn bgcolor--fadebrown color--white "><i class = "fa  fa-trash-o"></i></a></span></td>
                                  <a class="master-btn undefined undefined undefined undefined undefined" href="#investigation_attachment/{{$record->id}}" style="display: none;"><span></span></a>
                            <div class="remodal-bg"></div>
                            <div class="remodal" data-remodal-id="investigation_attachment/{{$record->id}}" role="dialog" aria-labelledby="modal1Title" aria-describedby="modal1Desc">
                              <form action="{{URL('download_all_documents/'.$record->id)}}" method="get">
                                <input type="hidden" name="_token" value="{{csrf_token()}}">
                              <button class="remodal-close" data-remodal-action="close" aria-label="Close"></button>
                              <div>
                                <div class="row">
                                  <div class="col-xs-12">
                                    <h3>الملفات المرفقة للتحقيق بتاريخ 12/12/2018</h3>
                                    <ul class="mailbox-attachments clearfix right-text">
                                      @foreach($record->case_record_documents as $document)
                                      <li><span class="mailbox-attachment-icon"><i class="fa fa-file-pdf-o"></i></span>

                                        <div class="mailbox-attachment-info"><a class="mailbox-attachment-name" href="{{asset($document->file)}}"><i class="fa fa-paperclip"></i>&nbsp;
                                            {{$document->name}}<br></a><span class="mailbox-attachment-size"><a class="pull-right" href="{{URL('download_document/'.$document->id  )}}'"><i class="fa fa-cloud-download"></i></a></span></div>
                                      </li>
                                      @endforeach
                                      
                                    </ul>
                                  </div>
                                </div>
                              </div><br>
                              <button class="remodal-cancel" data-remodal-action="cancel">إلغاء</button>
                              <button class="remodal-confirm" >تحميل الكل</button>
                            </form>
                            </div>
                          
                          
                                </tr>
                                @endforeach
                                
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
                      <li class="tab__content_item">
                        <div class="cardwrap bgcolor--white bradius--noborder   bshadow--1 padding--small margin--small-top-bottom">
                          <div class="col-lg-12">
                            <table class="table-1">
                              <thead>
                                <tr class="bgcolor--gray_mm color--gray_d">
                                  <th><span class="cellcontent">الدرجة</span></th>
                                  <th><span class="cellcontent"> رول</span></th>
                                  <th><span class="cellcontent"> تاريخ الجلسة</span></th>
                                  <th><span class="cellcontent"> ما تم فيها من دفاع و طلبات</span></th>
                                  <th><span class="cellcontent"> القرار</span></th>
                                  <th><span class="cellcontent"> رسوم الدعوي </span></th>
                                </tr>
                              </thead>
                              <tbody>

                                
                               @foreach($case->tasks as $task)
                                
                                <tr>
                                  <td><span class="cellcontent">{{$task->level}}</span></td>
                                  <td><span class="cellcontent"> {{$task->roll}}</span></td>
                                  <td><span class="cellcontent">{{$task->start_datetime}}</span></td>
                                  <td><span class="cellcontent">{{$task->name}}</span></td>
                                  <td><span class="cellcontent">{{$task->description}} النص</span></td>
                                  <td><span class="cellcontent">{{$task->expenses}}</span></td>
                                  <td><span class="cellcontent">{{$task->next_datetime}}</span></td>
                                </tr>
                                
                               @endforeach
                                
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
                    </ul>
                  </div>
                </div>
              </div>
              <!-- =============== PAGE VENDOR Triggers ===============-->
            @endsection