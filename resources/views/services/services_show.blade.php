@extends('layout.app')
@section('content')

<script >
  $(document).ready(function(){

    $('.btn-warning-cancel').click(function(){
      var charge_id = $(this).closest('tr').attr('data-charge-id');
      var _token = '{{csrf_token()}}';
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
        if (isConfirm){
         $.ajax({
           type:'POST',
           url:'{{url('charge_destroy')}}'+'/'+charge_id,
           data:{_token:_token},
           success:function(data){
            $('tr[data-charge-id='+charge_id+']').fadeOut();
          }
        });
         swal("تم الحذف!", "تم الحذف بنجاح", "success");
       } else {
        swal("تم الإلغاء", "المعلومات مازالت موجودة :)", "error");
      }
    });
    });

  });
        window.setTimeout(function() {
            $(".alert").fadeTo(500, 0).slideUp(500, function(){
                $(this).remove(); 
            });
        }, 4000);
</script>
 <script>
    $(document).ready(function(){
      $("#service_add_submit").click(function(){
       //  alert('Test');
       $("#service_add_form").submit();
        
                 });
    });
   </script>


<!-- =============== Custom Content ===============-->
<div class="row">
  <div class="col-lg-12">
    <div class="cover-inside-container margin--small-top-bottom bradius--small bshadow--1" style="background:  url( '{{asset('img/covers/dummy2.jpg')}} ' ) no-repeat center center; background-size:cover;">
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
        <div class="cover--actions"><a class="color--gray_d bordercolor--white bradius--small border-btn master-btn" type="button" href="{{route('services_lawyer',$service->id)}}">تغيير المحامي</a>
        </div>
      </div>
    </div>
  </div>
  <div class="col-lg-12">
    <div class="cardwrap bgcolor--white bradius--noborder   bshadow--1 padding--small margin--small-top-bottom">
    @if(isset($service->lawyer) && !empty($service->lawyer))
      @if($service->lawyer->name)
      <div class="col-md-1 col-xs-2"><img class="full-width bradius--circle" src="{{asset(''.$service->lawyer->image)}}"></div>
      <div class="col-md-2 col-xs-3">
        <div class="right-text margin--medium-top-bottom"><b>القائم بالإجراء</b></div><a href="">{{$service->lawyer ? $service->lawyer->full_name : 'لا يوجد'}}</a>
      </div>
      @endif
    @endif
      <div class="clearfix"></div>
      <div class="col-lg-12"><br>
        <div class="ticket-container">
          <div class="clearfix">
            <div class="layer clearfix">
              <div class="tck-info col-xs-12"><span class="tiket-data right light-color col-md-2 col-xs-6">
                <div class="pull-right">         
                  {{$service->created_at->format('Y - m - d')}}
                  &nbsp;<i class="fa fa-calendar"></i>
                </div></span><span class="tiket-data light-color col-md-4 col-xs-6"> اسم العميل: <a href="">{{$service->client ? $service->client->full_name : 'لا يوجد'}}</a>&nbsp;<span class="color--sec">(
                  
                  @if(isset($service->client) && !empty($service->client))
                    @foreach($service->client->rules as $rule)
                      @switch($rule->pivot->rule_id)
                        @case(7)
                        {{$rule->name_ar}}
                        @break
                        @case(8)
                        {{$rule->name_ar}}
                        @break
                        @case(9)
                        {{$rule->name_ar}}
                        @break
                        @case(10)
                        {{$rule->name_ar}}
                        @break
                      @endswitch
                    @endforeach
                  @endif

                )</span></span>
                <div class="clearfix"></div>
                <hr><span class="tiket-data col-md-12"><i class="fa fa-map-marker"></i><b>عنوان العميل: </b>{{$service->client ? $service->client->address : 'لا يوجد'}}</span>
                <div class="clearfix"></div>
                <hr><span class="tiket-data light-color col-md-12"><span>نوع الخدمة</span>&nbsp;<span class="bgcolor--fadepurple color--white bradius--small importance padding--small">
                @if(isset($types) && !empty($types))
                  @foreach($types as $type)
                    @if($service->task_payment_status_id == $type->item_id)
                    {{$type->value}}
                    @endif
                  @endforeach
                @endif
              </span></span>
              </div>
              <div class="status-bar">
                <div class="status">
                  الحالة
                  &nbsp;<span class="bgcolor--fadegreen color--black bradius--small importance padding--small">@foreach($statuses as $status)
                    @if($status->item_id == $service->task_status_id)
                    {{$status->value}}
                    @endif
                  @endforeach</span>
                </div>
              </div>
              <div class="clearfix"></div>
            </div>
          </div>
        </div>
      </div>
      <div class="clearfix"></div>
      @if(\session('success'))
      <div class="alert alert-success">
        {{\session('success')}}
      </div>
      @endif
      <div class="col-md-2 col-sm-5 col-xs-12"><a class="master-btn color--black bgcolor--fadegreen bradius--rounded bshadow--0 btn-block" href="#popupModal_1"><i class="fa fa-tag"></i><span>تغيير الحالة</span></a>
        <div class="remodal-bg"></div>
        <div class="remodal" data-remodal-id="popupModal_1" role="dialog" aria-labelledby="modal1Title" aria-describedby="modal1Desc">
          <form role="form" action="{{route('services_status',$service->id)}}" method="post" accept-charset="utf-8">
            {{csrf_field()}}
            <button class="remodal-close" data-remodal-action="close" aria-label="Close"></button>
            <div>
              <div class="row">
                <div class="col-xs-12">
                  <h3>تغيير حالة الخدمة</h3>
                  <div class="master_field">
                    @if($service->task_status_id == 2)       
                    <input class="icon" type="radio" name="service_status" value="2" id="radbtn_2" checked="true">
                    <label for="radbtn_2">تمت المهمة</label>
                    <input class="icon" type="radio" name="service_status" value="1" id="radbtn_3">
                    <label for="radbtn_3">لم تتم المهمة</label>
                    @elseif($service->task_status_id == 1) 
                    <input class="icon" type="radio" name="service_status" value="2" id="radbtn_2" >
                    <label for="radbtn_2">تمت المهمة</label>
                    <input class="icon" type="radio" name="service_status" value="1" id="radbtn_3" checked="true">
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
                <p class="color--gray_d col-md-4 col-md-6 col-sm-6 col-xs-12"><a href="">{{$service->name}}</a>&nbsp;<i class="fa fa-user"></i></p>
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
                        <a href="{{route('report_download_all_documents',$service->id)}}"><button class="remodal-confirm">تحميل الكل</button></a>
                      </div>
                    </div>
                    <div class="clearfix"></div>
                    @endforeach
                  {{-- </div> --}}
                        <div class="col-md-2">
                          <a class="master-btn color--white bgcolor--fadeblue bradius--small bshadow--0 btn-block" href="#add_report"><i class="fa fa-plus"></i><span>إضافة تقرير</span></a>
                          <div class="remodal-bg"></div>
                          <div class="remodal" data-remodal-id="add_report" role="dialog" aria-labelledby="modal2Title" aria-describedby="modal2Desc">
                            <button class="remodal-close" data-remodal-action="close" aria-label="Close"></button>
                            <div>
                              <div class="row">
                                <div class="col-xs-12">
                                  <h3>إضافة تقرير فني</h3>
                                  <form action="{{URL('service_add_report')}}" id="service_add_form" accept-charset="utf-8" enctype="multipart/form-data" method="POST" >                              
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input type="hidden" name="service_id" value="{{$service->id}}">
                                    <div class="col-md-12">
                                    <div class="master_field">
                                      <label class="master_label mandatory" for="report_desc">وصف التقرير</label>
                                      <textarea class="master_input" name="report_desc" id="report_desc" placeholder="وصف التقرير"></textarea><span class="master_message color--fadegreen">message</span>
                                    </div>
                                  </div>
                                  <div class="col-md-12">
                                    <div class="master_field">
                                      <label class="master_label" for="docs_upload">إرفاق ملفات</label>
                                      <div class="file-upload">
                                        <div class="file-select">
                                          <div class="file-select-name" id="noFile">إرفاق ملفات</div>
                                          <input class="chooseFile" type="file" name="report_file" id="docs_upload">
                                        </div>
                                      </div><span class="master_message color--fadegreen">message</span>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div><br>
                            <button class="remodal-cancel" data-remodal-action="cancel">إغلاق</button>
                            <button class="remodal-confirm" data-remodal-action="confirm" id="service_add_submit">إضافة</button>
                          </div>
                        </div>
                      </form>
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
                      <form role="form" action="{{route('services_charge',$service->id)}}" method="post" accept-charset="utf-8">
                        {{csrf_field()}}
                        <button class="remodal-close" data-remodal-action="close" aria-label="Close"></button>
                        <div>
                          <div class="row">
                            <div class="col-xs-12">
                              <h3>إضافة رسوم</h3>
                              <div class="col-md-4 col-sm-6 col-xs-12">
                                <div class="master_field">
                                  <label class="master_label" for="payment_amount">المبلغ</label>
                                  <input name="amount" value="{{ old('amount') }}" class="master_input" type="text" placeholder="المبلغ" id="payment_amount"><span class="master_message color--fadegreen">
                                    @if ($errors->has('amount'))
                                    {{ $errors->first('amount')}}
                                  @endif</span>
                                </div>
                              </div>
                              <div class="col-md-4 col-sm-6 col-xs-12">
                                <div class="master_field">
                                  <label class="master_label mandatory">تاريخ الخدمة</label>
                                  <div class="bootstrap-timepicker">
                                    <input name="service_date" value="{{ old('service_date') }}"  class="datepicker master_input" type="text" placeholder="تاريخ">
                                  </div><span class="master_message color--fadegreen">
                                    @if ($errors->has('service_date'))
                                    {{ $errors->first('service_date')}}
                                  @endif</span>
                                </div>
                              </div>
                              <div class="col-md-4 col-sm-6 col-xs-12">
                                <div class="master_field">
                                  <label class="master_label mandatory" for="payment_status">حالة السداد</label>
                                  <select name="is_paid" class="master_input select2" id="payment_status" style="width:100%;">
                                    <option value="0">لم يتم</option>
                                    <option value="1">تم</option>
                                  </select><span class="master_message color--fadegreen">
                                    @if ($errors->has('is_paid'))
                                    {{ $errors->first('is_paid')}}
                                  @endif</span>
                                </div>
                              </div>
                              <div class="col-md-12">
                                <div class="master_field">
                                  <label class="master_label mandatory" for="payment_desc">السبب</label>
                                  <textarea name="reason" value="{{ old('reason') }}" class="master_input" name="textarea" id="payment_desc" placeholder="السبب "></textarea><span class="master_message color--fadegreen">
                                    @if ($errors->has('reason'))
                                    {{ $errors->first('reason')}}
                                  @endif</span>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div><br>
                        <button class="remodal-cancel" data-remodal-action="cancel">إغلاق</button>
                        <button class="remodal-confirm" type="submit">إضافة</button>
                      </form>
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
                      @foreach($charges as $charge)
                      <tr data-charge-id="{{$charge->id}}">
                        <td><span class="cellcontent">{{$charge->date->format('d - m - Y')}}</span></td>
                        <td><span class="cellcontent">{{$charge->reason}}</span></td>
                        <td><span class="cellcontent">{{$charge->amount}}</span></td>
                        <td><span class="cellcontent"><i class = "fa {{$charge->is_paid ? 'color--fadegreen fa-check' : 'color--fadebrown fa-times' }}"></i></span></td>
                        <td><span class="cellcontent"><a href= "#fees{{$charge->id}}" ,  class= "action-btn bgcolor--fadegreen color--white "><i class = "fa  fa-pencil"></i></a><a href="#"  class= "btn-warning-cancel action-btn bgcolor--fadebrown color--white "><i class = "fa  fa-trash-o"></i></a></span></td>
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
                  <div class="col-md-2"><a class="master-btn undefined undefined undefined undefined undefined" href="#fees"><span></span></a>
                    <div class="remodal-bg"></div>
                    @foreach($charges as $charge)
                    <div class="remodal" data-remodal-id="fees{{$charge->id}}" role="dialog" aria-labelledby="modal2Title" aria-describedby="modal2Desc">
                      <form role="form" action="{{route('charge_status',$charge->id)}}" method="post" accept-charset="utf-8">
                        {{csrf_field()}}
                        <button class="remodal-close" data-remodal-action="close" aria-label="Close"></button>
                        <div>
                          <div class="row">
                            <div class="col-xs-12">
                              <h3>تغيير حالة سداد الرسوم</h3>
                              <div class="master_field">       
                                <input class="icon" type="radio" name="is_paid" value="1" id="done{{$charge->id}}" {{$charge->is_paid ? 'checked':''}}>
                                <label for="done{{$charge->id}}">تم</label>
                                <input class="icon" type="radio" name="is_paid" value="0" id="not_done{{$charge->id}}" {{$charge->is_paid ? '':'checked'}}>
                                <label for="not_done{{$charge->id}}">لم يتم</label>
                              </div>
                            </div>
                          </div>
                        </div><br>
                        <button class="remodal-cancel" data-remodal-action="cancel">إغلاق</button>
                        <button class="remodal-confirm" type="submit">تعديل</button>
                      </form>
                    </div>
                    @endforeach
                  </div>
                  <div class="clearfix"></div>
                </div>
              </div>
            </div>
            <!-- =============== PAGE VENDOR Triggers ===============-->
            


            @endsection