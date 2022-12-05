@extends('layout.app')
@section('content')
    <!-- ============== Custom Content ===============-->
    <div class="row">
                <div class="col-lg-12">
                  <div class="cover-inside-container margin--small-top-bottom bradius--small bshadow--1" style="background:  url( '{{asset('img/covers/dummy2.jpg')}}' ) no-repeat center center; background-size:cover">
                    <div class="row">
                      <div class="col-xs-12">
                        <div class="text-xs-center">
                          <div class="text-wraper">
                            <h4 class="cover-inside-title color--gray_d">المهام <i class="fa fa-chevron-circle-right"></i>
                              <h4 class="cover-inside-title color--gray_d">طلبات الإنابة </h4>
                            </h4>
                          </div>
                        </div>
                      </div>
                      <div class="cover--actions"><a class="color--gray_d bordercolor--white bradius--small border-btn master-btn" type="button" href="{{route('substitutions.assign',$substitution->id)}}">تعيين محامي للمهمة</a>
                      </div>
                    </div>
                  </div>
                  <div class="cardwrap bgcolor--white bradius--noborder   bshadow--1 padding--small margin--small-top-bottom">
                    <div class="col-md-1"><img class="full-width bradius--circle" src="../img/avaters/male.jpg"></div>
                    <div class="col-md-2">
                      <div class="right-text margin--medium-top-bottom"><b>المحامي المسئول</b></div> <a @if($substitution->lawyer_substitution != null)href="{{route('lawyers_show',$substitution->lawyer_substitution->id)}}" @endif> {{$substitution->lawyer_substitution->full_name}}</a>
                    </div>
                    {{--  Flash messages  --}}
                  <div class="col-lg-12">
                    {{--  Success  --}}
                    @if (Session::has('success'))
                      <div class="alert alert-warning text-center">
                        <strong>{{ Session::get('success') }}</strong>  
                      </div>
                    @endif

                    {{--  Warning  --}}
                    @if (Session::has('warning'))
                      <div class="alert alert-warning text-center">
                        <strong>{{ Session::get('warning') }}</strong>  
                      </div>
                    @endif
                  </div>
                    <div class="col-md-12"><br>
                      <div class="ticket-container">
                        <div class="clearfix">
                          <div class="layer clearfix">
                            <div class="tck-info col-xs-12">
                              <div class="col-xs-12"><span class="tiket-data light-color col-md-4 col-xs-6 bold">نوع الإنابة: <b class="color--sec">{{($substitution->substitution) ?$substitution->substitution->type->name : 'لا يوجد'}}</b></span><span class="tiket-data light-color col-md-4 col-xs-6">
                                  اسم المحامي الأساسي&nbsp;<a class="light-color" href="{{route('lawyers_show',$substitution->lawyer_substitution->id)}}">{{$substitution->lawyer_substitution->full_name}}</a></span><span class="tiket-data light-color col-md-4 col-xs-6"> <i class="fa fa-map-marker"> </i>{{($substitution->substitution != null) ? $substitution->substitution->court: "لا يوجد"}}
                                  &nbsp;<span class="color--sec">( {{($substitution->substitution != null) ? $substitution->substitution->region : "لا يوجد"}})</span></span><span class="tiket-data light-color col-md-4 col-xs-6">
                                  في الدعوى رقم: {{($substitution->substitution != null) ? $substitution->substitution->roll : "لا يوجد"}}
                                  &nbsp;<span class="color--sec">لسنة(2019)</span></span><span class="tiket-data light-color col-md-4 col-xs-6"><i class="fa fa-calendar"></i>المحدد لها جلسة: 
                                  &nbsp;
                                  {{($substitution->substitution != null) ? $substitution->substitution->date : "لا يوجد"}}</span></div>
                              <div class="clearfix"></div>
                              <hr>
                              <div class="col-xs-12"><span class="tiket-data col-md-4 col-sm-6 col-xs-12"><i class="fa fa-user"></i><b>الموكل :</b>&nbsp;<span class="color--sec">{{($substitution->substitution != null) ? $substitution->substitution->client_name  : "لا يوجد" }}</span>&nbsp;
                                  وصفته
                                  &nbsp;<span class="color--sec"> {{($substitution->substitution != null) ? $substitution->substitution->client_character  : "لا يوجد"}}</span></span><span class="tiket-data col-md-4 col-sm-6 col-xs-12"><i class="fa fa-user"></i><b>يحضر عنه :</b>&nbsp;<span class="color--sec">{{($substitution->substitution != null) ? $substitution->substitution->client_lawyer : "لا يوجد "}}</span>&nbsp;
                                  بتوكيل
                                  &nbsp;<span class="color--sec"> {{($substitution->substitution != null) ?   $substitution->substitution->client_procuration  : "لا يوجد"}}</span></span><span class="tiket-data col-md-4 col-sm-6 col-xs-12"><i class="fa fa-user"></i><b>الخصم :</b>&nbsp;<span class="color--sec">{{($substitution->substitution != null) ? $substitution->substitution->contender: "لا يوجد "}}</span>&nbsp;
                                  وصفته
                                  &nbsp;<span class="color--sec">{{($substitution->substitution != null) ? $substitution->substitution->contender_character : "لا يوجد"}}</span></span></div>
                              <div class="clearfix"></div>
                              <hr><span class="tiket-data col-xs-12"><b class="col-md-12">موضوع الدعوى :</b>
                                <div class="col-md-12">{{($substitution->substitution != null) ? $substitution->substitution->description : "لا يوجد"}}</div>
                                <div class="clearfix"></div>
                                <hr><b class="col-md-12">الطلبات :</b>
                                <div class="col-md-12"> {{($substitution->substitution != null) ? $substitution->substitution->requests : "لا يوجد"}}</div>
                                <div class="clearfix"></div>
                                <hr><b class="col-md-12">القرار :</b>
                                <div class="col-md-12">{{($substitution->substitution != null) ? $substitution->substitution->decisions : "لا يوجد" }} </div>
                                <div class="clearfix"></div>
                                <hr><b class="col-md-12">ملاحظات :</b>
                                <div class="col-md-12">{{($substitution->substitution != null) ? $substitution->substitution->notes  : "لا يوجد" }}</div>
                                <div class="clearfix"></div></span>
                            </div>
                            <div class="status-bar">
                              <div class="status">
                                الحالة
                                &nbsp;<span class="bgcolor--fadegreen color--black bradius--small importance padding--small">@if($substitution->task_status_id == 2)تم @else لم يتم @endif</span>
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
                      <form role="form" action="{{route('services_status',$substitution->id)}}" method="post" accept-charset="utf-8">
                        {{csrf_field()}}
                        <button class="remodal-close" data-remodal-action="close" aria-label="Close"></button>
                        <div>
                          <div class="row">
                            <div class="col-xs-12">
                              <h3>تغيير حاله  المهمه</h3>
                              <div class="master_field">       
                              @if($substitution->task_status_id == 2)       
                              <input class="icon" type="radio" name="service_status" value="2" id="radbtn_2" checked="true">
                              <label for="radbtn_2">تمت المهمة</label>
                              <input class="icon" type="radio" name="service_status" value="1" id="radbtn_3">
                              <label for="radbtn_3">لم تتم المهمة</label>
                              @elseif($substitution->task_status_id == 1) 
                              <input class="icon" type="radio" name="service_status" value="2" id="radbtn_2" >
                              <label for="radbtn_2">تمت المهمة</label>
                              <input class="icon" type="radio" name="service_status" value="1" id="radbtn_3" checked="true">
                              <label for="radbtn_3">لم تتم المهمة</label>
                              @endif
                              </div>
                            </div>
                          </div>
                        </div><br>
                        <button class="remodal-cancel" data-remodal-action="cancel">إغلاق</button>
                        <button class="remodal-confirm" type="submit">تعديل</button>
                      </form>
                      </div>
                    </div>
                    <div class="clearfix"></div><br>
                    <div class="col-md-12">
                      <div class="panel panel-default">
                        <div class="panel-heading" id="heading-1" role="tab">
                          <h4 class="panel-title bgcolor--main_l bradius--noborder bshadow--1 padding--small margin--small-top-bottom"><a class="trigger color--white" role="button" data-toggle="collapse" href="#collapse-1" aria-expanded="true" aria-controls="collapse-1">التقرير الفني</a></h4>
                        </div>
                      </div>
                      <div class="panel-collapse collapse" id="collapse-1" role="tabpanel" aria-labelledby="heading-1" aria-expanded="true">
                        <div class="panel-body bgcolor--white bradius--noborder bshadow--1 padding--small margin--small-top-bottom">
                        @foreach($reports as $report)
                        <div class="row">
                          <div class="col-md-10">
                            <p class="color--gray_d col-md-4 col-md-6 col-sm-6 col-xs-12">
                              بتاريخ
                              {{$report->created_at->format('Y - m - d')}}
                              &nbsp;<i class="fa fa-calendar"></i>
                            </p>
                            <p class="color--gray_d col-md-4 col-md-6 col-sm-6 col-xs-12"><a href="">{{$report->lawyer->full_name}}</a>&nbsp;<i class="fa fa-user"></i></p>
                            <p class="right-text">{{$report->body}}</p>
                          </div>
                          <div class="col-md-2">
                          <a class="master-btn color--white bgcolor--main bradius--small bshadow--0 btn-inlineblock" href="#report_attachment1"><i class="fa fa-paperclip"></i><span>الملفات المرفقة</span></a>
                            <div class="remodal-bg"></div>
                            <div class="remodal" data-remodal-id="report_attachment1" role="dialog" aria-labelledby="modal1Title" aria-describedby="modal1Desc">
                              <button class="remodal-close" data-remodal-action="close" aria-label="Close"></button>
                              <div>
                                <div class="row">
                                  <div class="col-xs-12">
                                    <h3>الملفات المرفقة للتقرير بتاريخ {{$report->created_at->format('Y - m - d')}}</h3>
                                    <ul class="mailbox-attachments clearfix right-text">
                                      @foreach($report->case_tachinical_report_documents as $document)
                                      <li><span class="mailbox-attachment-icon"><i class="fa fa-file-pdf-o"></i></span>
                                        <div class="mailbox-attachment-info"><a class="mailbox-attachment-name" href="{{asset($document->file)}}"><i class="fa fa-paperclip"></i>&nbsp;
                                          {{substr($document->file, strrpos($document->file, '/')+1)}}<br></a><span class="mailbox-attachment-size">1,245 KB<a class="pull-right" href="{{route('report_download_document',$document->id)}}"><i class="fa fa-cloud-download"></i></a></span></div>
                                        </li>
                                        @endforeach

                                          </ul>
                                        </div>
                                      </div>
                                    </div><br>
                                    <button class="remodal-cancel" data-remodal-action="cancel">إلغاء</button>
                                    <a href="{{route('report_download_all_documents',$report->id)}}"><button class="remodal-confirm">تحميل الكل</button></a>
                                  </div>
                                </div>
                                <div class="clearfix"></div>
                    </div>
                    @endforeach
                         
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
                    <div class="clearfix"></div>
                    <div class="col-md-2 col-xs-6">
                      <button class="master-btn undefined btn-block color--white bgcolor--fadepurple bradius--small bshadow--0" type="submit"><i class="fa fa-save"></i><span>حفظ</span>
                      </button>
                    </div>
                    <div class="col-md-2 col-xs-6">
                      <button class="master-btn undefined btn-block color--white bgcolor--fadebrown bradius--small bshadow--0" type="submit"><i class="fa fa-times"></i><span>الغاء</span>
                      </button>
                    </div>
                    <div class="clearfix"></div>
                  </div>
                </div>
              </div>
              <!-- =============== PAGE VENDOR Triggers ===============-->
@endsection