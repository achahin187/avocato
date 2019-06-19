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
                      <div class="cover--actions"><a class="color--gray_d bordercolor--white bradius--small border-btn master-btn" type="button" href="{{URL('assign_emergency_task/'.$task->id)}}">تعيين محامي للمهمة</a>
                      </div>
                    </div>
                  </div>
                  <div class="cardwrap bgcolor--white bradius--noborder   bshadow--1 padding--small margin--small-top-bottom">
                    @if(!is_null($task->assigned_lawyer_id ))
                    <div class="col-md-1"><img class="full-width bradius--circle" src=" {{asset($task->lawyer->image)}}"></div>
                    <div class="col-md-2">
                      <div class="right-text margin--medium-top-bottom"><b>المحامي المسئول</b></div><a href="lawyer_view.html">
                        
                        {{$task->lawyer->name or ''}}
                      
                    </a>
                    </div>
                    @endif
                    <div class="col-md-12"><br>
                      <div class="ticket-container">
                        <div class="clearfix">
                          <div class="layer clearfix">
                            <div class="tck-info col-xs-12">
                              <div class="col-xs-12"><span class="tiket-data light-color col-md-4 col-xs-6">اسم العميل: 
                               @if(isset($task->client))
                            @if(Helper::is_client_individual($task->client->id))
                            <a href="{{route('ind.show',$task->client->id)}}">{{($task->client)?$task->client->name:''}}</a>
                            @elseif(Helper::is_client_company($task->client->id))
                            <a href="{{route('companies.show',$task->client->id)}}">{{($task->client)?$task->client->name:''}}</a>
                            @elseif(Helper::is_client_individual_company($task->client->id))
                            <a href="{{route('ind.com.show',$task->client->id)}}">{{($task->client)?$task->client->name:''}}</a>
                            @elseif(Helper::is_client_mobile($task->client->id))
                            <a href="{{route('mobile.show',$task->client->id)}}">{{($task->client)?$task->client->name:''}}</a>
                            @else
                            <a href="#">{{($task->client)?$task->client->name:''}}</a>
                            @endif
                            @endif
                              &nbsp;
                              <span class="color--sec">(
                              @if($task->client != null) 
                                @foreach($task->client->rules as $rule)
                                {{$rule->name_ar or ''}}
                                @endforeach
                                @endif
                              )</span></span><span class="tiket-data right light-color col-md-5">
                                  <div class="pull-right">
                                    التاريخ
                                    {{date('d-m-Y', strtotime($task->start_datetime ))}}
                                    &nbsp;<i class="fa fa-calendar"></i>
                                  </div>
                                  <div class="pull-right">
                                    الوقت
                                    {{date('h:i A', strtotime($task->start_datetime))}}
                                    &nbsp;<i class="fa fa-clock"></i>&nbsp; &nbsp;
                                  </div></span><span class="tiket-data light-color col-md-2"><span class="color--sec">كود ({{$task->client->code or ''}})</span></span></div>
                              <div class="clearfix"></div>
                              <hr><span class="tiket-data col-xs-12"><b class="col-md-12">تفاصيل الحالة الطارئة :</b>
                                <div class="col-md-6"> {{$task->description or ''}}</div>
                                <div class="col-md-6">
                                  <div id="map" style="height: 140px;width:500px;">
                                    
                                  </div></div></span>
                              <div class="clearfix"></div>
                              <hr><span class="tiket-data col-md-6 " ><i class="fa fa-map-marker"></i><b>العنوان :</b><p id="client_address"></p></span><span class="tiket-data col-md-6"><i class="fa fa-phone"></i><b>التليفون :</b>{{$task->client->mobile or ''}}</span>
                            </div>
                            <div class="status-bar">
                              <div class="status">
                                الحالة
                                &nbsp;<span class="bgcolor--fadegreen color--black bradius--small importance padding--small">
                                  @if($task->task_status_id ==2)
                                  تم
                                  @else
                                  لم يتم 
                                  @endif
                                </span>
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
                        <form role="form" action="{{URL('change_task_state/'.$task->id)}}" method="post" accept-charset="utf-8">
                          
                          <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <button class="remodal-close" data-remodal-action="close" aria-label="Close"></button>
                        <div>
                          <div class="row">
                            <div class="col-xs-12">
                              <h3>تغيير حالة المهمة</h3>
                              <div class="master_field">   
                              @if($task->task_status_id == 2)    
                                <input class="icon" type="radio" name="task_satuts" id="radbtn_2" checked="true" value="2">
                                <label for="radbtn_2">تمت المهمة</label>
                                <input class="icon" type="radio" name="task_satuts" id="radbtn_3" value="1">
                                <label for="radbtn_3">لم تتم المهمة</label>
                                @else
                                 <input class="icon" type="radio" name="task_satuts" id="radbtn_2" value="2">
                                <label for="radbtn_2">تمت المهمة</label>
                                <input class="icon" type="radio" name="task_satuts" id="radbtn_3" checked="true" value="1">
                                <label for="radbtn_3">لم تتم المهمة</label>
                                @endif
                              </div>
                            </div>
                          </div>
                        </div><br>
                        <button class="remodal-cancel" data-remodal-action="cancel">إلغاء</button>
                        <button class="remodal-confirm" type="submit">تغيير حالة المهمة</button>
                      </form>
                      </div>
                    </div>
                    <div class="clearfix"></div><br>
                    <div class="clearfix"></div><br>
      <div class="col-md-12">
        <div class="panel panel-default">
          <div class="panel-heading" id="heading-1" role="tab">
            <h4 class="panel-title bgcolor--fadeblue bradius--noborder bshadow--1 padding--small margin--small-top-bottom"><a class="trigger color--white" role="button" data-toggle="collapse" href="#collapse-1" aria-expanded="true" aria-controls="collapse-1">التقرير الفني</a></h4>
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
              <div class="col-md-2"><a class="master-btn color--white bgcolor--main bradius--small bshadow--0 btn-inlineblock" href="#report_attachment1"><i class="fa fa-paperclip"></i><span>الملفات المرفقة</span></a>
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
                   <!-- new added -->
                  <div class="col-md-2 col-sm-3 col-xs-12">
                              <a class="master-btn color--white bgcolor--fadeblue bradius--small bshadow--0 btn-block" href="#add_report"><i class="fa fa-plus"></i><span>إضافة تقرير</span></a>
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
                  </div>
                </div>
              </div>
              <!-- =============== PAGE VENDOR Triggers ===============-->
            @endsection

            @section('js')
            <script async defer
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAlXHCCfSGKzPquzvLKcFB37DBoPudNqgU&callback=initMap&language=ar">
            </script>
            <script type="text/javascript">

              var latitude ='{{$task->client_latitude}}';
              var longtuide  ='{{$task->client_longitude}}';
               function initMap() {
                   var geocoder = new google.maps.Geocoder;
      geocoder.geocode({'location': new google.maps.LatLng({{$task->client_latitude}},{{$task->client_longitude}})}, function(results, status) {
        // console.log(results.formatted_address);
      $('#client_address').text(results[0].formatted_address);
      });
              var uluru = {lat: Number(latitude) , lng: Number(longtuide)};
              var map = new google.maps.Map(document.getElementById('map'), {
                zoom: 20,
                center: uluru
              });
              var marker = new google.maps.Marker({
                position: uluru,
                map: map
              });
            }
         

            </script>
            
            @endsection