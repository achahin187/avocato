@extends('layout.app')
@section('content')



              
              <!-- =============== Custom Content ===============-->
              <div class="row">
                <div class="col-lg-12">
                @if(\session('success'))
                  <div class="alert alert-success">
                  {{\session('success')}}
                  </div>
                  @endif
                  <div class="coverglobal text-center bshadow--2" style="background:#000 url({{asset('img/covers/dummy2.jpg')}}') no-repeat center center; background-size:cover;"><span></span>
                    <div class="container">
                      <div class="row">
                        <div class="col-xs-12">
                          <div class="text-xs-center"><a href="#"><img class="coverglobal__avatar" src="{{asset(''.$lawyer->image)}}">
                              <h3 class="coverglobal__title color--gray_d">{{$lawyer->full_name or ''}}</h3><small class="coverglobal__slogan color--gray_d">{{$lawyer->is_active ? 'مفعل':'غير مفعل'}}</small></a></div>
                          <div class="coverglobal__actions">{{-- <a class="color--gray_d bordercolor-gray_d bradius--small border-btn master-btn" type="button" href="assign_lawyer_task.html">تعيين مهمة للمحامي</a> --}}<a class="color--gray_d bordercolor-gray_d bradius--small border-btn master-btn" type="button" href="{{route('lawyers_edit',$lawyer->id)}}">تعديل البيانات</a><a class="exclude color--gray_d bordercolor-gray_d bradius--small border-btn master-btn" type="button" href="#">استبعاد المحامي</a>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-lg-12">
                  <div class="cardwrap bgcolor--white bradius--noborder   bshadow--1 padding--small margin--small-top-bottom">
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <div class="row"><b class="col-xs-3">عنوان المحامى </b>
                        <div class="col-xs-9"> {{$lawyer->address}}</div>
                      </div>
                      <div class="row"><b class="col-xs-3">الرقم القومى </b>
                        <div class="col-xs-9">{{$lawyer->user_detail->national_id}}</div>
                      </div>
                      <div class="row"><b class="col-xs-3">الجنسية</b>
                        <div class="col-xs-9">
                 @foreach($nationalities as $nationality)
                  @if($lawyer->user_detail->nationality->id == $nationality->item_id)
                  {{$nationality->value}}
                  @endif
                  @endforeach</div>
                      </div>
                      <div class="row"><b class="col-xs-3">تاريخ الميلاد </b>
                        <div class="col-xs-9">{{$lawyer->birthdate}}</div>
                      </div>
                      <div class="row"><b class="col-xs-3">رقم الهاتف</b>
                        <div class="col-xs-9">{{$lawyer->phone}}</div>
                      </div>
                      <div class="row"><b class="col-xs-3">رقم الموبايل</b>
                        <div class="col-xs-9">{{$lawyer->mobile}}</div>
                      </div>
                      <div class="row"><b class="col-xs-3">البريد الالكترونى </b>
                        <div class="col-xs-9">{{$lawyer->email}}</div>
                      </div>
                      <div class="row"><b class="col-md-3 col-sm-5 col-xs-12">المحامي لديه مكتب</b>
                        <div class="col-md-9 col-sm-7 col-xs-12">
                          {!!$lawyer->user_detail->has_office ? '<i class="fa fa color--fadegreen fa-check"></i>' : '<i class="fa fa color--black fa-times"></i>'!!}
                          
                          </div>
                      </div>
                      <div class="row"><b class="col-md-3 col-sm-5 col-xs-12">سنوات الخبرة</b>
                        <div class="col-md-9 col-sm-7 col-xs-12">{{$lawyer->user_detail->experience}} سنوات</div>
                      </div>
                      <div class="row"><b class="col-md-3 col-sm-5 col-xs-12">سعر الإستشارة</b>
                        <div class="col-md-9 col-sm-7 col-xs-12">{{$lawyer->user_detail->consultation_price}} مصرى</div>
                      </div>
                      <div class="row"><b class="col-md-3 col-sm-5 col-xs-12">نبذة عن المحامي</b>
                        <div class="col-md-9 col-sm-7 col-xs-12">{{$lawyer->note}} </div>
                      </div>
                      <div class="row"><b class="col-md-3 col-sm-5 col-xs-12"> تاريخ التسجيل </b>
                        <div class="col-md-9 col-sm-7 col-xs-12">{{$lawyer->created_at}} </div>
                      </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      {{-- <img class="img-responsive" src="https://www.taitradio.com/__data/assets/image/0016/114910/location-sol-header.jpg" height="140" width="450"> --}}
                      <div id="map_subscribtion" hidden style="color:red;"> لقد تم انتهاء اشتراكك فى خرائط جوجل برجاء تجديد الاشتراك</div>
                      <div id="map" style="height: 140px;width:600px;"></div>
                    </div>
                    <div class="clearfix"></div>
                  </div>
                  <div class="tabs--wrapper">
                    <div class="clearfix"></div>
                    <ul class="tabs">
                      <li>معلومات أخري</li>
                      <li>جدول المهام الأسبوعي</li>
                      <li>القضايا</li>
                      <li>الخدمات</li>
                      <li>المصاريف</li>
                      <li>تقييم العملاء</li>
                      <li>تقييم الإدارة</li>
                    </ul>
                    <ul class="tab__content">
                      <li class="tab__content_item active">
                        <div class="cardwrap bgcolor--white bradius--noborder   bshadow--1 padding--small margin--small-top-bottom">
{{--                           <div class="row">
                            <div class="col-xs-6"><b class="col-xs-4">التخصص </b>
                              <div class="col-xs-8"> @foreach($lawyer->specializations as $spec){{$spec->name}}-@endforeach</div>
                            </div>
                            <div class="col-xs-6"><b class="col-xs-4">الاختصاص المكاني</b>
                              <div class="col-xs-8">{{$lawyer->user_detail->city->name or ''}}</div>
                            </div>
                            <div class="col-xs-6"><b class="col-xs-4">تاريخ الإتحاق بالعمل بالشركة</b>
                              <div class="col-xs-8">{{$lawyer->user_detail->join_date}}</div>
                            </div>
                            <div class="col-xs-6"><b class="col-xs-4">تاريخ انتهاء العمل بالشركة</b>
                              <div class="col-xs-8">{{$lawyer->user_detail->resign}}</div>
                            </div>
                             <div class="col-xs-6"><b class="col-xs-4">درجه التقاضي </b>
                              <div class="col-xs-8">{{($lawyer->user_detail->syndicate_levela) ? $lawyer->user_detail->syndicate_levela->name : 'لا يوجد'}}</div>
                            </div>
                          </div> --}}
                          <div class="row">
                            <div class="col-xs-6"><b class="col-xs-4">الاختصاص المكاني</b>
                              <div class="col-xs-8">{{$lawyer->user_detail->city->name ?? ''}} </div>
                            </div>
                            <div class="col-xs-6"><b class="col-xs-4">التخصص</b>
                              <div class="col-xs-8"> 
                                @foreach($lawyer->specializations as $spec)
                                - {{$spec->name}}  
                                @endforeach
                              </div>
                            </div>
                            <div class="col-xs-6"><b class="col-md-4 col-sm-5 col-xs-12">درجة القيد بالنقابة</b>
                              <div class="col-md-8 col-sm-7 col-xs-12">{{$lawyer->user_detail->syndicate_levela->name}}</div>
                            </div>
                            <div class="col-xs-6"><b class="col-md-4 col-sm-5 col-xs-12">درجة التقاضي</b>
                              <div class="col-md-8 col-sm-7 col-xs-12">{{$lawyer->user_detail->litigation_level}}</div>
                            </div>
                            <div class="col-xs-6"><b class="col-md-4 col-sm-5 col-xs-12">مدرج بجدول محكمي وزارة العدل</b>
                              <div class="col-md-8 col-sm-7 col-xs-12">
                                @if($lawyer->user_detail->is_international_arbitrator)<i class="fa fa color--fadegreen fa-check"></i>@else<i class="fa fa color--black fa-times"></i>@endif
                              </div>
                            </div>
                            <div class="col-xs-6"><b class="col-md-4 col-sm-5 col-xs-12">التخصص كمحكم في وزارة العدل</b>
                              <div class="col-md-8 col-sm-7 col-xs-12">{{$lawyer->user_detail->international_arbitrator_specialization}}</div>
                            </div>
                            <div class="col-xs-6"><b class="col-xs-4">تاريخ الإتحاق بالعمل بالشركة</b>
                              <div class="col-xs-8">{{$lawyer->user_detail->join_date}}</div>
                            </div>
                            <div class="col-xs-6"><b class="col-xs-4">تاريخ انتهاء العمل بالشركة</b>
                              <div class="col-xs-8">{{$lawyer->user_detail->resign_date}}</div>
                            </div>
                          </div>

                          <div class="col-sm-6">
                            <div class="cardwrap bgcolor--white bradius--noborder   bshadow--1 padding--small margin--small-top-bottom">
                              <div class="card--1"><a class="color--main"><img class="img-responsive bradius--noborder  " src="{{asset(''.$lawyer->user_detail->syndicate_copy)}}">
                                  <h4 class="text-center">كارنيه النقابة</h4></a></div>
                            </div>
                            <div class="clearfix"></div>
                          </div>
                          <div class="col-sm-6">
                            <div class="cardwrap bgcolor--white bradius--noborder   bshadow--1 padding--small margin--small-top-bottom">
                              <div class="card--1"><a class="color--main"><img class="img-responsive bradius--noborder  " src="{{asset(''.$lawyer->user_detail->authorization_copy)}}">
                                  <h4 class="text-center">صوره التوكيل</h4></a></div>
                            </div>
                            <div class="clearfix"></div>
                          </div>
                          <div class="clearfix"></div>
                        </div>
                      </li>
                      <li class="tab__content_item">
                          @foreach($tasks_months as $month=>$tasks)
                          <div class="col-lg-12">
                            <div class="panel panel-default">
                              <div class="panel-heading" id="heading-1{{$month}}" role="tab">
                                <h4 class="panel-title bgcolor--main_l bradius--noborder bshadow--1 padding--small margin--small-top-bottom"><a class="trigger color--white" role="button" data-toggle="collapse" href="#collapse-1{{$month}}" aria-expanded="true" aria-controls="collapse-1">
                                  <div class="col-xs-11">{{$month}}<span class="pull-right color--fadeorange">مهمات {{count($tasks)}}</span></div>
                                  <div class="clearfix"></div></a></h4>
                                </div>
                              </div>

                              <div class="panel-collapse collapse" id="collapse-1{{$month}}" role="tabpanel" aria-labelledby="heading-1" aria-expanded="true">
                                <div class="panel-body bgcolor--white bradius--noborder bshadow--1 padding--small margin--small-top-bottom">
                                  @foreach($tasks as $task)
                                  <div class="col-md-12 right-text"><span class="bgcolor--main_l color--white bradius--small importance padding--small">{{Helper::localizations('task_types','name',$task['task_type_id'])}}</span> &nbsp;<a href="case_view.html">{{$task['name']}} </a>
                                    <div class="pull-right">
                                      <label class="data-label-round bgcolor--fadegreen color--white">@isset($task['start_datetime'])
                                        {{$task['start_datetime']->format('Y - m - d')}}@endisset</label>
                                    </div>
                                  </div>
                                  <div class="clearfix"></div>
                                  <hr>
                                  @endforeach
                                </div>
                              </div>
                            </div>
                            @endforeach
                      </li>
                      <li class="tab__content_item">
                        <div class="cardwrap bgcolor--white bradius--noborder   bshadow--1 padding--small margin--small-top-bottom">
                          <table class="table-1">
                            <thead>
                              <tr class="bgcolor--gray_mm color--gray_d">
                                <th><span class="cellcontent">&lt;input type=&quot;checkbox&quot; name=&quot;select-all&quot; id=&quot;select-all&quot; /&gt;</span></th>
                                <th><span class="cellcontent">نوع القضية</span></th>
                                <th><span class="cellcontent">المحكمة</span></th>
                                <th><span class="cellcontent">الدائرة</span></th>
                                <th><span class="cellcontent">رقم الدعوة</span></th>
                                <th><span class="cellcontent">لسنة</span></th>
                                <th><span class="cellcontent">تاريخ قيد الدعوة</span></th>
                                <th><span class="cellcontent">رقم الملف بالمكتب</span></th>
                                <th><span class="cellcontent">الإجراءات</span></th>
                              </tr>
                            </thead>
                            <tbody>
                              @foreach($cases as $case)
                              <tr data-case-id="{{$case->id}}">
                                <td><span class="cellcontent"><input type="checkbox" class="checkboxes" /></span></td>
                                <td><span class="cellcontent">{{$case->case_types->name}}</span></td>
                                <td><span class="cellcontent">{{$case->courts->name}}</span></td>
                                <td><span class="cellcontent">{{$case->region}}</span></td>
                                <td><span class="cellcontent">{{$case->claim_number}}</span></td>
                                <td><span class="cellcontent">{{$case->year}}</span></td>
                                <td><span class="cellcontent">{{$case->date}}</span></td>
                                <td><span class="cellcontent">{{$case->office_file_number}}</span></td>
                                <td><span class="cellcontent"><a href= "{{route('case_view',$case->id)}}" ,  class= "action-btn bgcolor--main color--white "><i class = "fa  fa-eye"></i></a><a href= "{{route('case_edit',$case->id)}}" ,  class= "action-btn bgcolor--fadegreen color--white "><i class = "fa  fa-pencil"></i></a><a href="#"  class= "btn-warning-cancel action-btn bgcolor--fadebrown color--white "><i class = "fa  fa-trash-o"></i></a></span></td>
                              </tr>
                              @endforeach
                            </tbody>
                          </table>
                        </div>
                      </li>
                      <li class="tab__content_item">
                        <div class="cardwrap bgcolor--white bradius--noborder   bshadow--1 padding--small margin--small-top-bottom">
                          <table class="table-1">
                            <thead>
                              <tr class="bgcolor--gray_mm color--gray_d">
                                <th><span class="cellcontent">&lt;input type=&quot;checkbox&quot; name=&quot;select-all&quot; id=&quot;select-all&quot; /&gt;</span></th>
                                <th><span class="cellcontent">كودالعميل</span></th>
                                <th><span class="cellcontent">اسم العميل</span></th>
                                <th><span class="cellcontent">عنوان العميل</span></th>
                                <th><span class="cellcontent">نوع الخدمة</span></th>
                                <th><span class="cellcontent">الحالة</span></th>
                                <th><span class="cellcontent">الإجراءات</span></th>
                              </tr>
                            </thead>
                            <tbody>
                              @foreach($services as $service)
                              <tr data-service-id="{{$service->id}}">
                                <td><span class="cellcontent"><input type="checkbox" class="checkboxes" /></span></td>
                                <td><span class="cellcontent">{{$service->client->code}}</span></td>
                                <td><span class="cellcontent">{{$service->client->full_name}}</span></td>
                                <td><span class="cellcontent">{{$service->client->address}}</span></td>
                                <td><span class="cellcontent">@foreach($types as $type)
                              @if($service->task_payment_status_id == $type->item_id)
                              {{$type->value}}
                              @endif
                            @endforeach</span></td>
                          <td><span class="cellcontent">@foreach($statuses as $status)
                    @if($status->item_id == $service->task_status_id)
                    {{$status->value}}
                    @endif
                  @endforeach</span></td>
{{--                                 <td><span class="cellcontent"><i class = "fa color--fadegreen fa-check"></i></span></td> --}}
                                <td><span class="cellcontent"><a href= "{{route('services_show',$service->id)}}" ,  class= "action-btn bgcolor--main color--white "><i class = "fa  fa-eye"></i></a><a href="{{route('services_edit',$service->id)}}" ,  class= "action-btn bgcolor--fadegreen color--white "><i class = "fa  fa-pencil"></i></a><a href="#"  class= "btn-warning-cancel-service action-btn bgcolor--fadebrown color--white "><i class = "fa  fa-trash-o"></i></a></span></td>
                              </tr>
                              @endforeach
                            </tbody>
                          </table>
                        </div>
                      </li>
                      <li class="tab__content_item">
                        <div class="cardwrap bgcolor--white bradius--noborder   bshadow--1 padding--small margin--small-top-bottom">
                          <table class="table-1">
                            <thead>
                              <tr class="bgcolor--gray_mm color--gray_d">
                                <th><span class="cellcontent">التاريخ</span></th>
                                <th><span class="cellcontent"> اجمالى المصروفات</span></th>
                                <th><span class="cellcontent">وصف المصروفات</span></th>
                              </tr>
                            </thead>
                            <tbody>
                              @foreach($expenses as $expense)
                              <tr>
                                <td><span class="cellcontent">@if(!empty($expense->expensed_at)){{$expense->expensed_at->format('Y - m - d')}} @endif</span></td>
                                <td><span class="cellcontent">{{$expense->amount}}</span></td>
                                <td><span class="cellcontent">{{$expense->description}} </span></td>
                              </tr>
                              @endforeach
                            </tbody>
                          </table>
                        </div>
                      </li>
                      <li class="tab__content_item">
                        <div class="cardwrap bgcolor--white bradius--noborder   bshadow--1 padding--small margin--small-top-bottom">
                          <table class="table-1">
                            <thead>
                              <tr class="bgcolor--gray_mm color--gray_d">
                                <th><span class="cellcontent">اسم العميل</span></th>
                                <th><span class="cellcontent">التقييم</span></th>
                                <th><span class="cellcontent">ملاحظات العميل</span></th>
                                <th><span class="cellcontent">التاريخ</span></th>
                                <th><span class="cellcontent">الاجراءات</span></th>
                              </tr>
                            </thead>
                            <tbody>
                              @foreach($rates_user as $rate)
                              @foreach($rate->rules as $rule)
                              @if(isset($rule['pivot']))
                              @if($rule->pivot->rule_id==6)
                              <tr data-rate-id="{{rate->pivot->id}}">
                                <td><span class="cellcontent">{{$rate->name}}</span></td>
                                <td><span class="cellcontent"><span class= stars , data-rating= "{{$rate->pivot->rate_id}}" ,  data-num-stars=5 ></span></span></td>
                                <td><span class="cellcontent">{{$rate->pivot->notes}}</span></td>
                                <td><span class="cellcontent">
                                @if($rate->pivot["created_at"] != null)
                                {{$rate->pivot->created_at->format('Y - m - d')}}
                                @else
                                ..
                                @endif

                                </span></td>
                                <td><span class="cellcontent">
                                
                                <a href="{{route('notes_edit',$rate->pivot->id)}}" ,  class= "action-btn bgcolor--fadegreen color--white ">
                                <i class = "fa  fa-check"></i></a>
                                <a  href="#"  class= "btn-warning-cancel-rate action-btn bgcolor--fadebrown color--white ">
                                <i class = "fa  fa-trash-o"></i></a></span></td>

                              </tr>
                              @endif
                              @endif
                              @endforeach
                              @endforeach
                            </tbody>
                          </table>
                        </div>
                      </li>
                      <li class="tab__content_item">
                        <div class="cardwrap bgcolor--white bradius--noborder   bshadow--1 padding--small margin--small-top-bottom">
                          <div class="col-md-2 col-sm-3 col-xs-12 pull-right"><a class="master-btn color--white bgcolor--fadeblue bradius--small bshadow--0 btn-block" href="#add_evaluation"><i class="fa fa-plus"></i><span>إضافة تقييم</span></a>
                            <div class="remodal-bg"></div>
                            <div class="remodal" data-remodal-id="add_evaluation" role="dialog" aria-labelledby="modal2Title" aria-describedby="modal2Desc">
                    <form role="form" action="{{route('lawyers_rate',$lawyer->id)}}" method="post" accept-charset="utf-8">
                        {{csrf_field()}}
                              <button class="remodal-close" data-remodal-action="close" aria-label="Close"></button>
                              <div>
                                <div class="row">
                                  <div class="col-xs-12">
                                    <h3>إضافة تقييم</h3>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                      <div class="master_field">
                                        <label class="master_label mandatory" for="backend_evaluation_date">التاريخ</label>
                                        <div class="bootstrap-timepicker">
                                          <input name="date" class="datepicker master_input" type="text" placeholder="التاريخ" id="backend_evaluation_date">
                                        </div><span class="master_message color--fadegreen">
                                    @if ($errors->has('date'))
                                    {{ $errors->first('date')}}
                                    @endif</span>
                                      </div>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                      <div class="master_field">
                                        <label class="master_label mandatory" for="backend_evaluation_lawyer_evaluation">التقييم </label>
                                        <select name="rate" class="master_input select2" id="backend_evaluation_lawyer_evaluation" style="width:100%;">
                                          <option selected disabled >اختر التقييم</option>
                                          @foreach($rates as $rate)
                                          <option value="{{$rate->item_id}}" >{{$rate->value}}</option>
                                          @endforeach
                                        </select><span class="master_message color--fadegreen">
                                    @if ($errors->has('rate'))
                                    {{ $errors->first('rate')}}
                                    @endif</span>
                                      </div>
                                    </div>
                                    <div class="col-xs-12">
                                      <div class="master_field">
                                        <label class="master_label mandatory" for="backend_evaluation_notes">ملاحظات الإدارة</label>
                                        <textarea name="notes" class="master_input" name="textarea" id="backend_evaluation_notes" placeholder="ملاحظات الإدارة"></textarea><span class="master_message color--fadegreen">
                                    @if ($errors->has('notes'))
                                    {{ $errors->first('notes')}}
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
                                <th><span class="cellcontent">التقييم</span></th>
                                <th><span class="cellcontent">ملاحظات الإدارة</span></th>
                                <th><span class="cellcontent">التاريخ</span></th>
                                <th><span class="cellcontent">الاجراءات</span></th>
                              </tr>
                            </thead>
                            <tbody>
                              @foreach($rates_user as $rate)
                              @foreach($rate->rules as $rule)
                              @if($rule->pivot->rule_id==13)
                              <tr data-rate-id="{{$rate->pivot->id}}">
                                <td><span class="cellcontent">{{Helper::localizations('rates','name',$rate->pivot->rate_id)}}</span></td>
                                <td><span class="cellcontent">{{$rate->pivot->notes}}</span></td>
                                <td><span class="cellcontent">{{$rate->pivot->created_at->format('Y - m - d')}}</span></td>
                                <td><span class="cellcontent">
                                
                                <a href="{{route('notes_edit',$rate->pivot->id)}}" ,  class= "action-btn bgcolor--fadegreen color--white ">
                                <i class = "fa  fa-pencil"></i></a>
                                <a  href="#"  class= "btn-warning-cancel-rate action-btn bgcolor--fadebrown color--white ">
                                <i class = "fa  fa-trash-o"></i></a></span></td>
                              </tr>
                              @endif
                              @endforeach
                              @endforeach
                            </tbody>
                          </table>
                        </div>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
  
@endsection
@section('js')
<script>
  $(document).ready(function(){

    $('.btn-warning-cancel').click(function(){
      var case_id = $(this).closest('tr').attr('data-case-id');
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
           type:'GET',
           url:'{{url('case_destroy')}}'+'/'+case_id,
           data:{_token:_token},
           success:function(data){
            $('tr[data-case-id='+case_id+']').fadeOut();
          }
        });
         swal("تم الحذف!", "تم الحذف بنجاح", "success");
       } else {
        swal("تم الإلغاء", "المعلومات مازالت موجودة :)", "error");
      }
    });
    });
 

     $('.btn-warning-cancel-service').click(function(){
      var service_id = $(this).closest('tr').attr('data-service-id');
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
           url:'{{url('services_destroy')}}'+'/'+service_id,
           data:{_token:_token},
           success:function(data){
            $('tr[data-service-id='+service_id+']').fadeOut();
          }
        });
         swal("تم الحذف!", "تم الحذف بنجاح", "success");
       } else {
        swal("تم الإلغاء", "المعلومات مازالت موجودة :)", "error");
      }
    });
    });

    $('.btn-warning-cancel-rate').click(function(){
      var rate_id = $(this).closest('tr').attr('data-rate-id');
      var _token = '{{csrf_token()}}';
      alert(rate_id);
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
           url:'{{url('rate_delete')}}'+'/'+ rate_id,
           data:{_token:_token},
           success:function(data){
            $('tr[data-rate-id='+ rate_id +']').fadeOut();
            swal("تم الحذف!", "تم الحذف بنجاح", "success");
          }
        });
         
       } else {
        swal("تم الإلغاء", "المعلومات مازالت موجودة :)", "error");
      }
    });
    });

  });

</script>
<script type="text/javascript">

  var latitude ='{{$lawyer->latitude or ''}}';
  var longtuide  ='{{$lawyer->longtuide or ''}}';
function initMap() {
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
<!-- <script async defer
src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAlXHCCfSGKzPquzvLKcFB37DBoPudNqgU&callback=initMap&language=ar">
</script> -->

<script type="text/javascript">
    $(document).ready(function(){

    $('.exclude').click(function(){
      var lawyer_id = '{{$lawyer->id or ''}}';
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
           url:'{{url('lawyers_destroy_post')}}'+'/'+lawyer_id,
           data:{_token:_token},
           success:function(data){
            // $('tr[data-lawyer-id='+lawyer_id+']').fadeOut();
            location.href= '{{route('lawyers')}}';
          }
        });
         swal("تم الحذف!", "تم الحذف بنجاح", "success");
       } else {
        swal("تم الإلغاء", "المعلومات مازالت موجودة :)", "error");
      }
    });
    });

});

</script>
@endsection