@extends('layout.app')
@section('content')
              <!-- =============== Custom Content ===============-->
              <div class="row">
                <div class="col-lg-12">
                  <div class="cover-inside-container margin--small-top-bottom bradius--small bshadow--1" style="background:  url( 'img/covers/dummy2.jpg ' ) no-repeat center center; background-size:cover;">
                    <div class="row">
                      <div class="col-xs-12">
                        @if ( Session::has('success') )
                      <div class="alert alert-success text-center">{{ Session::get('success') }}</div>
                  @endif
              
                  @if ( Session::has('error') )
                      <div class="alert alert-warning text-center">{{ Session::get('error') }}</div>
                  @endif
                        <div class="text-xs-center">
                          <div class="text-wraper">
                            <h4 class="cover-inside-title color--gray_d">القضايا و الخدمات <i class="fa fa-chevron-circle-right"></i>
                              <h4 class="cover-inside-title color--gray_d">القضايا </h4>
                            </h4>
                          </div>
                        </div>
                      </div>
                      <div class="cover--actions"><a class="color--gray_d bordercolor--white bradius--small border-btn master-btn" type="button" href="{{URL('case_edit/'.$case->id)}}">تعديل بيانات القضية</a>
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
                              <div class="col-xs-12"><span class="tiket-data light-color col-md-3 col-sm-6 col-xs-12"> محكمه {{$case->courts->name}}</span><span class="tiket-data right light-color col-md-6 col-sm-6 col-xs-12">
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

                              <div class="tiket-data col-md-6 col-sm-6 col-xs-12"><b class="col-xs-3">اسم الخصم</b>
                                <div class="col-xs-9">{{$case->contender_name}}</div>
                              </div>
                              <div class="tiket-data col-md-6 col-sm-6 col-xs-12"><b class="col-xs-3">صفته</b>
                                <div class="col-xs-9">{{Helper::localizations('case_client_roles','name',$case->contender_case_client_role_id)}}</div>
                              </div>
                              <div class="tiket-data col-md-6 col-sm-6 col-xs-12"><b class="col-xs-3">عنوانه</b>
                                <div class="col-xs-9">{{$case->contender_address}}</div>
                              </div>
                              <div class="tiket-data col-md-6 col-sm-6 col-xs-12"><b class="col-xs-3">محاميه</b>
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
                                &nbsp;<span class="bgcolor--fadegreen color--black bradius--small importance padding--small">
                                  @if($case->archived == 0)
                                  متداوله
                                  @else
                                  مغلقه
                                  @endif
                                </span>
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
                        <form role="form" action="{{URL('change_case_state/'.$case->id)}}" method="post" accept-charset="utf-8">
                          
                          <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <button class="remodal-close" data-remodal-action="close" aria-label="Close"></button>
                        <div>
                          <div class="row">
                            <div class="col-xs-12">
                              <h3>تغيير حالة القضية</h3>
                              <div class="master_field">  
                              @if($case->archived == 0 )     
                                <input class="icon" type="radio" name="case_state" id="status1" checked="true" value="0">
                                <label for="status1">متداولة </label>
                                <input class="icon" type="radio" name="case_state" id="status2" value="1">
                                <label for="status2">مغلقة</label>
                                @else
                                <input class="icon" type="radio" name="case_state" id="status1" value="0">
                                <label for="status1">متداولة </label>
                                <input class="icon" type="radio" name="case_state" id="status2" checked="true" value="1">
                                <label for="status2">مغلقة</label>
                                @endif
                              </div>
                            </div>
                          </div>
                        </div><br>
                        <button class="remodal-cancel" data-remodal-action="cancel">إلغاء</button>
                        <button class="remodal-confirm" type="submit">تغيير حالة القضية</button>
                      </form>
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
                              @foreach($case->case_documents as $document)
                              @foreach($document->case_document_details as $doc)
                                      <li><span class="mailbox-attachment-icon"><i class="fa fa-file-pdf-o"></i></span>

                                        <div class="mailbox-attachment-info"><a class="mailbox-attachment-name" href="{{asset($doc->file)}}"><i class="fa fa-paperclip"></i>&nbsp;
                                            {{$doc->file}}<br></a><span class="mailbox-attachment-size"><a class="pull-right" href="{{URL('download_case_document/'.$doc->id  )}}"><i class="fa fa-cloud-download"></i></a></span></div>
                                      </li>
                                      @endforeach
                                @endforeach
                              </ul>
                            </div>
                          </div>
                        </div><br>
                        <button class="remodal-cancel" data-remodal-action="cancel">إلغاء</button>
                              @if(count($case->case_documents)>0)
                              <a class="remodal-confirm"  href="{{route('download_all_case_documents_all',$case->id)}}">تحميل الكل</a>
                              @endif
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
                          @foreach($case->case_techinical_reports as $document)
                          <div class="row">
                            <div class="col-md-10">
                              <p class="color--gray_d col-md-4 col-md-6 col-sm-6 col-xs-12">
                                بتاريخ
                                {{date('Y-m-d' ,strtotime($document->created_at))}}
                                &nbsp;<i class="fa fa-calendar"></i>
                              </p>
                              <p class="color--gray_d col-md-4 col-md-6 col-sm-6 col-xs-12">
                                القائم بالمهمة
                                &nbsp;<a href="lawyer_view.html">{{$document->lawyer->name}}</a>&nbsp;<i class="fa fa-user"></i>
                              </p>
                              <div class="clearfix"></div>
                              <p class="right-text">{{$document->notes}}</p>
                            </div>
                            <div class="col-md-2"><a class="master-btn color--white bgcolor--main bradius--small bshadow--0 btn-inlineblock" href="#case_documents/{{$document->id}}"><i class="fa fa-paperclip"></i><span>الملفات المرفقة</span></a>
                              <div class="remodal-bg"></div>
                              <div class="remodal" data-remodal-id="case_documents/{{$document->id}}" role="dialog" aria-labelledby="modal1Title" aria-describedby="modal1Desc">
                                 <form action="{{URL('download_all_case_documents/'.$document->id)}}" method="get">
                                <input type="hidden" name="_token" value="{{csrf_token()}}">
                                <button class="remodal-close" data-remodal-action="close" aria-label="Close"></button>
                                <div>
                                  <div class="row">
                                    <div class="col-xs-12">
                                      <h3>الملفات المرفقة للتقرير</h3>
                                      <ul class="mailbox-attachments clearfix right-text">
                                         @foreach($document->case_tachinical_report_documents as $doc)
                                      <li><span class="mailbox-attachment-icon"><i class="fa fa-file-pdf-o"></i></span>

                                        <div class="mailbox-attachment-info"><a class="mailbox-attachment-name" href="{{asset($doc->file)}}"><i class="fa fa-paperclip"></i>&nbsp;
                                            {{$doc->file}}<br></a><span class="mailbox-attachment-size"><a class="pull-right" href="{{URL('download_case_document/'.$doc->id  )}}"><i class="fa fa-cloud-download"></i></a></span></div>
                                      </li>
                                      @endforeach
                                      
                                    </ul>
                                  </div>
                                </div>
                              </div><br>
                              <button class="remodal-cancel" data-remodal-action="cancel">إلغاء</button>
                              @if(count($document->case_tachinical_report_documents)>0)
                              <button class="remodal-confirm" >تحميل الكل</button>
                              @endif
                            </form>
                              </div>
                            </div>
                            <div class="clearfix"></div>
                          </div>
                          <hr>
                          @endforeach
                          <div class="col-md-2 col-sm-3 col-xs-12">
                            <div class="remodal-bg"></div>
                            <div class="remodal" data-remodal-id="add_report" role="dialog" aria-labelledby="modal2Title" aria-describedby="modal2Desc">
                              <button class="remodal-close" data-remodal-action="close" aria-label="Close"></button>
                              <div>
                                <div class="row">
                                  <div class="col-xs-12">
                                    <h3>إضافة تقرير فني</h3>
                                  <form action="{{URL('case_add_report')}}" id="case_add_form" accept-charset="utf-8" enctype="multipart/form-data" method="POST" >
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input type="hidden" name="case_id" value="{{$case->id}}">
                                    <div class="col-md-12">
                                      <div class="master_field">
                                        <label class="master_label mandatory" for="report_desc">وصف التقرير</label>
                                        <textarea class="master_input" name="report_desc" id="report_desc" placeholder="وصف التقرير"></textarea><span class="master_message color--fadegreen">message</span>
                                      </div>
                                    </div>
                                    <div class="col-md-12">
                                      <div class="master_field">
                                        <label class="master_label" for="report_upload">إرفاق ملفات</label>
                                        <div class="file-upload">
                                          <div class="file-select">
                                            <div class="file-select-name" id="noFile">إرفاق ملفات</div>
                                            <input class="chooseFile" type="file" name="report_file" id="report_upload">
                                          </div>
                                        </div><span class="master_message color--fadegreen">message</span>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div><br>
                              <button class="remodal-cancel" data-remodal-action="cancel">إغلاق</button>
                              <button class="remodal-confirm" data-remodal-action="confirm" type="submit" id="case_add_submit">إضافة</button>
                            </div>
                          </div>
                        </form>
                  
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
                                <form method="post" action="{{URL('case_add_session/'.$case->id)}}" enctype="multipart/form-data" accept-charset="utf-8">
                                        {{ csrf_field() }}
                                <button class="remodal-close" data-remodal-action="close" aria-label="Close"></button>
                                <div>

                                  <div class="row">
                                    <div class="col-xs-12">
                                      <h3>إضافة في الأجندة القضائية</h3>
                                      
                                      <div class="col-md-4 col-sm-6 col-xs-12">
                                        <div class="master_field">
                                          <label class="master_label" for="degree">الدرجة</label>
                                          <input class="master_input" type="text" placeholder="الدرجة" id="degree" name="degree"><span class="master_message color--fadegreen">message</span>
                                        </div>
                                      </div>
                                      <div class="col-md-4 col-sm-6 col-xs-12">
                                        <div class="master_field">
                                          <label class="master_label" for="roll">رول</label>
                                          <input class="master_input" type="text" placeholder="رول" id="roll" name="roll"><span class="master_message color--fadegreen">message</span>
                                        </div>
                                      </div>
                                      <div class="col-md-4 col-sm-6 col-xs-12">
                                        <div class="master_field">
                                          <label class="master_label" for="expenses">رسوم الدعوى</label>
                                          <input class="master_input" type="number" placeholder="رسوم" id="expenses" name="expenses"><span class="master_message color--fadegreen">message</span>
                                        </div>
                                      </div>
                                      <div class="col-md-6 col-sm-6 col-xs-12">
                                        <div class="master_field">
                                          <label class="master_label mandatory">تاريخ الجلسة</label>
                                          <div class="bootstrap-timepicker">
                                            <input class="datepicker master_input" type="text" placeholder="تاريخ الجلسة" name="start_datetime">
                                          </div><span class="master_message color--fadegreen">message content</span>
                                        </div>
                                      </div>
                                      <div class="col-md-6 col-sm-6 col-xs-12">
                                        <div class="master_field">
                                          <label class="master_label mandatory">تاريخ الجلسة القادمة</label>
                                          <div class="bootstrap-timepicker">
                                            <input class="datepicker master_input" type="text" placeholder="تاريخ الجلسة لقادمة" name="end_datetime">
                                          </div><span class="master_message color--fadegreen">message content</span>
                                        </div>
                                      </div>
                                      <div class="col-xs-12">
                                        <div class="master_field">
                                          <label class="master_label" for="action_done"> ما تم فيها من دفاع و طلبات</label>
                                          <textarea class="master_input" name="name" id="action_done" placeholder=" ما تم فيها من دفاع و طلبات"></textarea><span class="master_message color--fadegreen">message</span>
                                        </div>
                                      </div>
                                      <div class="col-xs-12">
                                        <div class="master_field">
                                          <label class="master_label" for="decision">القرار</label>
                                          <textarea class="master_input" name="description" id="decision" placeholder=" القرار"></textarea><span class="master_message color--fadegreen">message</span>
                                        </div>
                                      </div>
                                      <div class="clearfix"></div>
                                    
                                    </div>
                                  </div>
                                </div><br>
                                <button class="remodal-cancel" data-remodal-action="cancel">إلغاء</button>
                                <button class="remodal-confirm" type="submit">حفظ</button>
                                </form>
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

                                @foreach($case->tasks as $task)
                                
                                <tr>
                                  <td><span class="cellcontent">{{$task->level}}</span></td>
                                  <td><span class="cellcontent"> {{$task->roll}}</span></td>
                                  <td><span class="cellcontent">{{$task->start_datetime}}</span></td>
                                  <td><span class="cellcontent">{{$task->name}}</span></td>
                                  <td><span class="cellcontent">{{$task->description}}</span></td>
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
                      <li class="tab__content_item"> 
                        <div class="cardwrap bgcolor--white bradius--noborder   bshadow--1 padding--small margin--small-top-bottom">
                          <div class="col-lg-12">
                            <div class="col-md-2 col-sm-3 colxs-12 pull-right"><a class="master-btn color--white bgcolor--main bradius--small bshadow--0 btn-block" href="#new_investigation"><i class="fa fa-plus"></i><span>إضافة</span></a>
                              <div class="remodal-bg"></div>
                              <div class="remodal" data-remodal-id="new_investigation" role="dialog" aria-labelledby="modal1Title" aria-describedby="modal1Desc">
                                <form action="{{URL('case_add_record/'.$case->id)}}" method="post"  enctype="multipart/form-data" accept-charset="utf-8">
                                 <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <button class="remodal-close" data-remodal-action="close" aria-label="Close"></button>
                                <div>
                                  <div class="row">
                                    <div class="col-xs-12">
                                      <h3>إضافة محضر</h3>
                                      <div class="col-xs-4">
                                        <div class="master_field">
                                          <label class="master_label" for="investigation_no">رقم المحضر</label>
                                          <input class="master_input" type="text" placeholder="رقم المحضر" id="investigation_no" name="investigation_no"><span class="master_message color--fadegreen">message</span>
                                        </div>
                                      </div>
                                      <div class="col-xs-4">
                                        <div class="master_field">
                                          <label class="master_label mandatory" for="investigation_type"> نوع المحضر </label>
                                          <select class="master_input select2" id="investigation_type" name="investigation_type" style="width:100%;">
                                            @foreach($cases_record_types as $type)
                                            <option value="{{$type->id}}">{{$type->name_ar}}</option>
                                            @endforeach
                                          </select><span class="master_message color--fadegreen">message</span>
                                        </div>
                                      </div>
                                      <div class="col-md-4">
                                        <div class="master_field">
                                          <label class="master_label mandatory">تاريخ</label>
                                          <div class="bootstrap-timepicker">
                                            <input class="datepicker master_input" type="text" placeholder="تاريخ الاستشارة" name="record_date">
                                          </div><span class="master_message color--fadegreen">message content</span>
                                        </div>
                                      </div>
                                      <div class="col-md-12">
                                        <div class="master_field">
                                          <label class="master_label" for="docs_upload">إرفاق ملفات</label>
                                          <div class="file-upload">
                                            <div class="file-select">
                                              <div class="file-select-name" id="noFile">إرفاق ملفات</div>
                                              <input class="chooseFile" type="file" name="record_documents[]" id="docs_upload" multiple>
                                            </div>
                                          </div><span class="master_message color--fadegreen">message</span>
                                        </div>
                                      </div>
                                      <div class="clearfix"></div>
                                    </div>
                                  </div>
                                </div><br>
                                <button class="remodal-cancel" data-remodal-action="cancel">إلغاء</button>
                                <button class="remodal-confirm" type="submit">حفظ</button>
                              </form>
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
                                @foreach($case->case_records as $record)
                                <tr data-record-id={{$record->id}}>
                                  <td><span class="cellcontent">{{$record->record_number}}</span></td>
                                  <td><span class="cellcontent">{{$record->record_type_id}}</span></td>
                                  <td><span class="cellcontent">{{$record->record_date}}</span></td>
                                  <td><span class="cellcontent"><a href="#investigation_attachment/{{$record->id}}"  ,  class= "action-btn bgcolor--main color--white "> &nbsp; <i class = "fa  fa-paperclip"></i></a></span></td>
                                  <td><span class="cellcontent"><a   class= "btn-warning-cancel action-btn bgcolor--fadebrown color--white "><i class = "fa  fa-trash-o"></i></a></span></td>
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
                              @if(count($record->case_record_documents)>0)
                              <button class="remodal-confirm" >تحميل الكل</button>
                              @endif
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
                            </div>{{-- <a class="master-btn undefined undefined undefined undefined undefined" href="#investigation_attachment"><span></span></a>
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
                       --}}</li>
                    </ul>
                  </div>
                </div>
              </div>
              <!-- =============== PAGE VENDOR Triggers ===============-->
                      @endsection


      @section('js')
      <script type="text/javascript">
        $('.btn-warning-cancel').click(function(){
      var record_id = $(this).closest('tr').attr('data-record-id');
      // var _token = '{{csrf_token()}}';
      swal({
        title: "هل أنت متأكد؟",
        text: "لن تستطيع إسترجاع هذه المعلومة لاحقا",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: '#DD6B55',
        confirmButtonText: 'نعم متأكد!',
        cancelButtonText: "إلغاء",
        closeOnConfirm: false,
        closeOnCancel: false
      },
      function(isConfirm){
        // alert();
        if (isConfirm){
         $.ajax({
           type:'GET',
           url:'{{URL('case_record_destroy/'.$case->id)}}'+'/'+record_id,
           
           success:function(data){
            // alert(1);
            $('tr[data-record-id='+record_id+']').fadeOut();
          }
        });
         swal("تم الحذف!", "تم الحذف بنجاح", "success");
       } else {
        swal("تم الإلغاء", "المعلومات مازالت موجودة :)", "error");
      }
    });
    });

$("#download_all").click(function(){
case_id = $("#download_all").attr('data-id');

$.ajax({
           type:'GET',
           url:'{{URL('download_all_case_documents/'.$case->id)}}',
           
           success:function(data){
          // $('tr[data-record-id='+record_id+']').fadeOut();
          }
        });
});


      </script>

      <script>
       $(document).ready(function(){
         $("#case_add_submit").click(function(){
          //  alert('Test');
          $("#case_add_form").submit();
           
                    });
       });
      </script>
      @endsection