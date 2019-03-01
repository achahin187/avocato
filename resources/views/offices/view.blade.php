 @extends('layout.app')             
 @section('content')
     <div class="row">
                <div class="col-lg-12">
                  <div class="coverglobal text-center bshadow--2" style="background:#000 url( {{asset('img/covers/dummy2.jpg')}} ) no-repeat center center; background-size:cover">
                    <div class="container">
                      <div class="row">
                        <div class="col-xs-12">
                          <div class="text-xs-center">
                            <a href="#">
                              <img class="coverglobal__avatar" @if($office->image) src="{{asset(''.$office->image)}}" @endif>
                              <h3 class="coverglobal__title color--gray_d">{{$office->name}}</h3><small class="coverglobal__slogan color--gray_d">{{$office->is_active ? 'مفعل':'غير مفعل'}}</small></a></div>
                          <div class="coverglobal__actions">{{-- <a class="color--gray_d bordercolor-gray_d bradius--small border-btn master-btn" type="button" href="assign_lawyer_task.html">تعيين مهمة للمكتب</a> --}}<a class="color--gray_d bordercolor-gray_d bradius--small border-btn master-btn" type="button" href="{{route('offices_edit',$office->id)}}">تعديل البيانات</a><a class="exclude color--gray_d bordercolor-gray_d bradius--small border-btn master-btn" type="button" href="#">استبعاد المكتب</a>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-lg-12">
                  <div class="cardwrap bgcolor--white bradius--noborder   bshadow--1 padding--small margin--small-top-bottom">
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <!-- <div class="row"><b class="col-md-3 col-sm-5 col-xs-12"></b>
                        <div class="col-md-9 col-sm-7 col-xs-12">{{$office->address}}</div>
                      </div> -->
                      <div class="row"><b class="col-md-3 col-sm-5 col-xs-12">تليفون</b>
                        <div class="col-md-9 col-sm-7 col-xs-12">{{$office->mobile}}</div>
                      </div>
                      <div class="row"><b class="col-md-3 col-sm-5 col-xs-12">البريد الالكترونى</b>
                        <div class="col-md-9 col-sm-7 col-xs-12">{{$office->email}}</div>
                      </div>
                      <div class="row"><b class="col-md-3 col-sm-5 col-xs-12">العنوان</b>
                        <div class="col-md-9 col-sm-7 col-xs-12">{{$office->address}}</div>
                      </div>
                      <!-- <div class="row"><b class="col-md-3 col-sm-5 col-xs-12">المدينة</b> -->
                        <!-- <div class="col-md-9 col-sm-7 col-xs-12">{{($office->user_detail->city)?$office->user_detail->city->name:''}}</div> -->
                      <!-- </div> -->
                      <div class="row"><b class="col-md-3 col-sm-5 col-xs-12">نبذة عن المكتب</b>
                        <div class="col-md-9 col-sm-7 col-xs-12">{{$office->note}}</div>
                      </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <img class="img-responsive" src="https://www.taitradio.com/__data/assets/image/0016/114910/location-sol-header.jpg" height="140" width="450">
                    </div>
                    <div class="clearfix"></div>
                  </div>
                  <div class="tabs--wrapper">
                    <div class="clearfix"></div>
                    <ul class="tabs">
                      <li>معلومات أخري</li>
                      <li>فروع المكتب</li>
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
                          <div class="row">
                            <div class="col-md-2 col-sm-3 text-center">
                              <img class="coverglobal__avatar img-responsive" @if($representative->image) src="{{asset(''.$representative->image)}}" @endif></div>
                            <div class="col-md-10 col-sm-9">
                              <div class="col-xs-6"><b class="col-xs-4">اسم الممثل القانوني</b>
                                <div class="col-xs-8"> {{$representative->name}}</div>
                              </div>
                              <div class="col-xs-6"><b class="col-xs-4"> تاريخ الميلاد</b>
                                <div class="col-xs-8">{{$representative->birthdate}}</div>
                              </div>
                              <div class="col-xs-6"><b class="col-xs-4">الرقم القومي</b>
                                <div class="col-xs-8">{{$representative->user_detail->national_id}}</div>
                              </div>
                              <div class="col-xs-6"><b class="col-xs-4">الجنسية</b>
                                <div class="col-xs-8">{{$representative->user_detail->nationality->name}}</div>
                              </div>
                              <div class="col-xs-6"><b class="col-xs-4"> العنوان</b>
                                <div class="col-xs-8">{{$representative->address}}</div>
                              </div>
                              <div class="col-xs-6"><b class="col-xs-4">الاختصاص المكاني</b>
                                <div class="col-xs-8">{{($representative->user_detail->city)?$representative->user_detail->city->name:''}}</div>
                              </div>
                              <div class="col-xs-6"><b class="col-xs-4">التخصص</b>
                              	@foreach($representative->specializations as $spec)
                                <div class="col-xs-8">{{$spec->name}}</div>
                                @endforeach
                              </div>
                              <div class="col-xs-6"><b class="col-xs-4">درجة القيد بالنقابة</b>
                                <div class="col-xs-8">{{ ($representative->user_detail->syndicate_levela) ? $representative->user_detail->syndicate_levela->name }</div>
                              </div>
                            </div>
                          </div>
                          <div class="col-sm-6">
                            <div class="cardwrap bgcolor--white bradius--noborder   bshadow--1 padding--small margin--small-top-bottom">
                              <div class="card--1"><a class="color--main">
                                <img class="img-responsive bradius--noborder" @if($representative->user_detail->syndicate_copy) src="{{asset(''.$representative->user_detail->syndicate_copy)}}" @endif>
                                  <h4 class="text-center">كارنيه النقابة</h4></a></div>
                            </div>
                            <div class="clearfix"></div>
                          </div>
                          <div class="col-sm-6">
                            <div class="cardwrap bgcolor--white bradius--noborder   bshadow--1 padding--small margin--small-top-bottom">
                              <div class="card--1"><a class="color--main">
                                <img class="img-responsive bradius--noborder" @if($office->user_detail->authorization_copy) src="{{asset(''.$office->user_detail->authorization_copy)}}" @endif>
                                  <h4 class="text-center">صورة التوكيل</h4></a></div>
                            </div>
                            <div class="clearfix"></div>
                          </div>
                          <div class="clearfix"></div>
                        </div>
                      </li>
                      <li class="tab__content_item">
                        <div class="cardwrap bgcolor--white bradius--noborder   bshadow--1 padding--small margin--small-top-bottom">
                          <div class="col-md-2 col-sm-3 col-xs-12 pull-right"><a class="master-btn color--white bgcolor--fadeblue bradius--small bshadow--0 btn-block" href="#add_branch"><i class="fa fa-plus"></i><span>إضافه فرع</span></a>
                            <div class="remodal-bg"></div>
                            <div class="remodal" data-remodal-id="add_branch" role="dialog" aria-labelledby="modal3Title" aria-describedby="modal3Desc">
                              <button class="remodal-close" data-remodal-action="close" aria-label="Close"></button>
                              <div>
                                <div class="row">
                                  <div class="col-xs-12">
                              <form role="form" action="{{route('branches_store')}}" method="post" enctype="multipart/form-data" accept-charset="utf-8">
                                   {{csrf_field()}}
                                    <input type="hidden"  name="office_id" value="{{$office->id}}">                
                                    <h3>اضافة فرع</h3>
                                    <div class="col-md-4 col-sm-6 col-xs-12">
                                      <div class="master_field">
                                        <label class="master_label mandatory" for="branch_name">اسم الفرع</label>
                                        <input class="master_input" type="text" placeholder="اسم الفرع..." id="branch_name" name="branch_name">
                                        <span class="master_message color--fadegreen">
                                            @if($errors->has('branch_name'))
                                              {{ $errors->first('branch_name') }}
                                            @endif
                                        </span>
                                      </div>
                                    </div>
                                    <div class="col-md-4 col-sm-6 col-xs-12">
                                      <div class="master_field">
                                        <label class="master_label mandatory" for="branch_address">عنوان الفرع</label>
                                        <input class="master_input" type="text" placeholder="عنوان الفرع..." id="branch_address" name="branch_address">
                                        <span class="master_message color--fadegreen">
                                            @if($errors->has('branch_address'))
                                              {{ $errors->first('branch_address') }}
                                            @endif
                                        </span>
                                      </div>
                                    </div>
                                    <div class="col-md-4 col-sm-6 col-xs-12">
                                      <div class="master_field">
                                        <label class="master_label mandatory" for="lawyer_type">الدولة</label>
                                        <select class="master_input" id="lawyer_type" name="branch_country">
                           @foreach($countries as $nationality)
                            <option value="{{$nationality->id}}">{{$nationality->name}}</option>
                            @endforeach
                                        </select>
                                        <span class="master_message color--fadegreen">
                                          @if($errors->has('branch_country'))
                                            {{ $errors->first('branch_country') }}
                                          @endif
                                        </span>
                                      </div>
                                    </div>
                                    <div class="col-md-4 col-sm-6 col-xs-12">
                                      <div class="master_field">
                                        <label class="master_label mandatory" for="branch_city">المدينة </label>
                                        <select name="branch_city"  class="master_input select2" id="office_city" data-placeholder="المدينة" style="width:100%;" ,>
                                        <option value="choose" selected disabled>اختر المدينة</option>
                                          @foreach($work_sector_areas as $city)
                                            <option value="{{$city->id}}">{{$city->name}}</option>
                                          @endforeach
                                        </select>
                                        <span class="master_message color--fadegreen">
                                          @if ($errors->has('branch_city'))
                                            {{ $errors->first('branch_city')}}
                                          @endif
                                        </span>
                                      </div>
                                    </div>
                                    <div class="col-md-4 col-sm-6 col-xs-12">
                                      <div class="master_field">
                                        <label class="master_label mandatory" for="branch_tel">رقم الهاتف</label>
                                        <input class="master_input" type="number" placeholder="رقم الهاتف" id="branch_tel" name="branch_phone">
                                        <span class="master_message color--fadegreen"> 
                                          @if ($errors->has('branch_phone'))
                                          {{ $errors->first('branch_phone')}}
                                          @endif</span>
                                      </div>
                                    </div>
                                    <div class="col-md-4 col-sm-6 col-xs-12">
                                      <div class="master_field">
                                        <label class="master_label" for="branch_email">البريد الالكترونى</label>
                                        <input class="master_input" type="email" placeholder="البريد الالكترونى" id="branch_email" name="branch_email">
                                        <span class="master_message color--fadegreen">
                                          @if ($errors->has('branch_email'))
                                          {{ $errors->first('branch_email')}}
                                          @endif</span>
                                      </div>
                                    </div>
                                    
                                  </div>
                                </div>
                              </div><br>
                              <button class="remodal-cancel"  data-remodal-action="cancel">إغلاق</button>
                              <button class="remodal-confirm" type="submit" >إضافة</button>
                            </div>
                            </form>
                          </div>
                          <table class="table-1">
                            <thead>
                              <tr class="bgcolor--gray_mm color--gray_d">
                                <th><span class="cellcontent">اسم الفرع</span></th>
                                <th><span class="cellcontent">تليفون</span></th>
                                <th><span class="cellcontent">ايميل </span></th>
                                <th><span class="cellcontent">عنوان </span></th>
                                <th><span class="cellcontent">الدولة</span></th>
                                <th><span class="cellcontent">المدينة</span></th>
                                <th><span class="cellcontent">الإجراءات</span></th>
                              </tr>
                            </thead>
                            <tbody>
                            @if(!empty($branches))
                                @foreach($branches as $branch)
                                  <tr data-branch-id="{{$branch->id}}">
                                    <td><span class="cellcontent">{{$branch->name}}</span></td>
                                    <td><span class="cellcontent"> {{$branch->phone}} </span></td>
                                    <td><span class="cellcontent">{{$branch->email}}</span></td>
                                    <td><span class="cellcontent">{{$branch->address}}</span></td>
                                    <td><span class="cellcontent">{{($branch->country)?$branch->country->name:''}}</span></td>
                                    <td><span class="cellcontent">{{($branch->city)?$branch->city->name:''}}</span></td>
                                    <td><span class="cellcontent"><a href= #edit_branch ,  class= "action-btn bgcolor--fadegreen color--white editBranchBtn "
                                      data-branch-id="{{$branch->id}}"
                                      data-branch-name="{{$branch->name}}"
                                      data-branch-phone="{{$branch->phone}}"
                                      data-branch-email="{{$branch->email}}"
                                      data-branch-address="{{$branch->address}}"
                                      data-branch-country="{{($branch->country)?$branch->country->id:0}}"
                                      data-branch-city="{{($branch->city)?$branch->city->id:0}}"><i class = "fa  fa-pencil"></i></a><a href="#"  class= "btn-warning-cancel action-btn bgcolor--fadebrown color--white"
                                    ><i class = "fa  fa-trash-o"></i></a></span></td>
                                  </tr>
                                @endforeach
                              @endif
                            </tbody>
                          </table>
                        </div>
                      </li>
                      {{-- //tasks --}}
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
                      {{-- //end of tasks --}}

                      {{-- cases --}}
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
                      {{-- end of cases --}}
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
                          <td>
                            <span class="cellcontent">@foreach($statuses as $status)
                                @if($status->item_id == $service->task_status_id)
                                {{$status->value}}
                                @endif
                              @endforeach
                            </span></td>
                          <td>
                            <span class="cellcontent">
                              <a href= "{{route('services_show',$service->id)}}" ,  class= "action-btn bgcolor--main color--white ">
                                <i class = "fa  fa-eye"></i>
                              </a>
                              <a href="{{route('services_edit',$service->id)}}" ,  class= "action-btn bgcolor--fadegreen color--white ">
                                <i class = "fa  fa-pencil"></i>
                              </a>
                              <a href="#"  class= "btn-warning-cancel-service action-btn bgcolor--fadebrown color--white ">
                                <i class = "fa  fa-trash-o"></i>
                              </a>
                            </span>
                          </td>
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
                              </tr>
                            </thead>
                            <tbody>
                              @foreach($rates_user as $rate)
                                @foreach($rate->rules as $rule)
                                  @if($rule->pivot->rule_id==6)
                                  <tr>
                                    <td><span class="cellcontent">{{$rate->full_name}}</span></td>
                                    <td><span class="cellcontent"><span class= stars , data-rating= {{$rate->pivot->rate_type->rate}} ,  data-num-stars=5 ></span></span></td>
                                    <td><span class="cellcontent">{{$rate->pivot->notes}}</span></td>
                                    <td><span class="cellcontent">{{$rate->pivot->created_at->format('Y - m - d')}}</span></td>
                                  </tr>
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
                    <form role="form" action="{{route('lawyers_rate',$office->id)}}" method="post" accept-charset="utf-8">
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
                                        </div>
                                        <span class="master_message color--fadegreen">
                                            @if ($errors->has('date'))
                                              {{ $errors->first('date')}}
                                            @endif
                                        </span>
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
                                        </select>
                                        <span class="master_message color--fadegreen">
                                          @if ($errors->has('rate'))
                                            {{ $errors->first('rate')}}
                                          @endif
                                        </span>
                                      </div>
                                    </div>
                                    <div class="col-xs-12">
                                      <div class="master_field">
                                        <label class="master_label mandatory" for="backend_evaluation_notes">ملاحظات الإدارة</label>
                                        <textarea name="notes" class="master_input" name="textarea" id="backend_evaluation_notes" placeholder="ملاحظات الإدارة"></textarea>
                                        <span class="master_message color--fadegreen">
                                            @if ($errors->has('notes'))
                                               {{ $errors->first('notes')}}
                                            @endif
                                        </span>
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
                              </tr>
                            </thead>
                            <tbody>
                              @foreach($rates_user as $rate)
                              @foreach($rate->rules as $rule)
                              @if($rule->pivot->rule_id==13)
                              <tr>
                                <td><span class="cellcontent">{{Helper::localizations('rates','name',$rate->pivot->rate_id)}}</span></td>
                                <td><span class="cellcontent">{{$rate->pivot->notes}}</span></td>
                                <td><span class="cellcontent">{{$rate->pivot->created_at->format('Y - m - d')}}</span></td>
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

      <!-- Edit Modal  -->
        @if(!empty($branches))
               <div class="remodal" data-remodal-id="edit_branch" role="dialog" aria-labelledby="modal3Title" aria-describedby="modal3Desc">
                              <button class="remodal-close" data-remodal-action="close" aria-label="Close"></button>
                              <div>
                                <div class="row">
                                  <div class="col-xs-12">
                              <form role="form" action="{{route('branches_edit')}}" method="post" enctype="multipart/form-data" accept-charset="utf-8">
                                   {{csrf_field()}}
                                  <input type="hidden" id="branch_id_edit" name="branch_id_edit">
                                  <input type="hidden"  name="office_id" value="{{$office->id}}">               
                                    <h3> تعديل فرع</h3>
                                    <div class="col-md-4 col-sm-6 col-xs-12">
                                      <div class="master_field">
                                        <label class="master_label mandatory" for="branch_name">اسم الفرع</label>
                                        <input class="master_input" type="text" placeholder="اسم الفرع..." id="branch_name_edit" name="branch_name_edit">
                                        <span class="master_message color--fadegreen">
                                          @if($errors->has('branch_name_edit'))
                                            {{$errors->first('branch_name_edit')}}
                                          @endif
                                        </span>
                                      </div>
                                    </div>
                                    <div class="col-md-4 col-sm-6 col-xs-12">
                                      <div class="master_field">
                                        <label class="master_label mandatory" for="branch_address">عنوان الفرع</label>
                                        <input class="master_input" type="text" placeholder="عنوان الفرع..." id="branch_address_edit" name="branch_address_edit">
                                        <span class="master_message color--fadegreen">
                                          @if($errors->has('branch_address_edit'))
                                            {{$errors->first('branch_address_edit')}}
                                          @endif   
                                        </span>
                                      </div>
                                    </div>
                                    <div class="col-md-4 col-sm-6 col-xs-12">
                                      <div class="master_field">
                                        <label class="master_label mandatory" for="lawyer_type">الدولة</label>
                                        <select class="master_input" id="branch_country_edit" name="branch_country_edit">
                                          @foreach($countries as $nationality)
                                            <option value="{{$nationality->id}}" @if($branch->country_id == $nationality->id){!!'selected'!!}
                                            @endif
                                              >{{$nationality->name}}</option>
                                          @endforeach
                                        </select>
                                        <span class="master_message color--fadegreen">
                                            @if($errors->has('branch_country_edit'))
                                              {{ $errors->first('branch_country_edit') }}
                                            @endif
                                        </span>
                                      </div>
                                    </div>
                                    <div class="col-md-4 col-sm-6 col-xs-12">
                                      <div class="master_field">
                                        <label class="master_label mandatory" for="branch_city">المدينة </label>
                                      <select name="branch_city_edit"  class="master_input select2" id="branch_city_edit" data-placeholder="المدينة" style="width:100%;" ,>
                                      <option value="choose" selected disabled>اختر المدينة</option>
                                      @foreach($work_sector_areas as $city)
                                        <option value="{{$city->id}}"
                                        @if($branch->city_id == $city->id){!!'selected'!!} @endif
                                          >{{$city->name}}</option>
                                        @endforeach
                                       </select>
                                      <span class="master_message color--fadegreen">
                                          @if ($errors->has('branch_city_edit'))
                                            {{ $errors->first('branch_city_edit')}}
                                          @endif
                                      </span>
                                      </div>
                                    </div>
                                    <div class="col-md-4 col-sm-6 col-xs-12">
                                      <div class="master_field">
                                        <label class="master_label mandatory" for="branch_tel">رقم الهاتف</label>
                                        <input class="master_input" type="number" placeholder="رقم الهاتف" id="branch_phone_edit" name="branch_phone_edit">
                                        <span class="master_message color--fadegreen"> 
                                          @if ($errors->has('branch_phone_edit'))
                                            {{ $errors->first('branch_phone_edit')}}
                                          @endif
                                        </span>
                                      </div>
                                    </div>
                                    <div class="col-md-4 col-sm-6 col-xs-12">
                                      <div class="master_field">
                                        <label class="master_label" for="branch_email">البريد الالكترونى</label>
                                        <input class="master_input" type="email" placeholder="البريد الالكترونى" id="branch_email_edit" name="branch_email_edit">
                                        <span class="master_message color--fadegreen">
                                          @if ($errors->has('branch_email_edit'))
                                            {{ $errors->first('branch_email_edit')}}
                                          @endif
                                        </span>
                                      </div>
                                    </div>
                                    
                                  </div>
                                </div>
                              </div><br>
                              <button class="remodal-cancel"  data-remodal-action="cancel">إغلاق</button>
                              <button class="remodal-confirm" type="submit" >إضافة</button>
                            </div>
                            </form>
                          </div>
                          @endif

  <script type="text/javascript">
  $(document).ready(function(){
    $(".editBranchBtn").click(function(){
      var branchId      = $(this).data("branch-id");
      var branchName     = $(this).data("branch-name");
      var branchAddress = $(this).data("branch-address");
      var branchCountry  = $(this).data("branch-country");
      var branchCity      = $(this).data("branch-city");
      var branchPhone     = $(this).data("branch-phone");
      var branchEmail     = $(this).data("branch-email");
      $("#branch_id_edit").val(branchId);
      $("#branch_name_edit").val(branchName);
      $("#branch_address_edit").val(branchAddress);
      $('#branch_country_edit option[value='+branchCountry+']').attr('selected', 'selected');
      $('#branch_city_edit option[value='+branchCity+']').attr('selected', 'selected');
      $("#branch_phone_edit").val(branchPhone);
      $("#branch_email_edit").val(branchEmail);
    });
  });
</script>

       <script type="text/javascript">
      $('.btn-warning-cancel').click(function(){
      var branch_id = $(this).closest('tr').attr('data-branch-id');
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
           url:'{{url('branches_delete')}}'+'/'+branch_id,
           data:{_token:_token},
           success:function(data){
            $('tr[data-branch-id='+branch_id+']').fadeOut();
          }
        });
         swal("تم الحذف!", "تم الحذف بنجاح", "success");
       } else {
        swal("تم الإلغاء", "المعلومات مازالت موجودة :)", "error");
      }
    });
    });
  </script>

<script type="text/javascript">
  $(document).ready(function(){

  $('.exclude').click(function(){
    var office_id = '{{$office->id or ''}}';
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
         url:'{{url('offices_destroy_post')}}'+'/'+office_id,
         data:{_token:_token},
         success:function(data){
          // $('tr[data-lawyer-id='+lawyer_id+']').fadeOut();
          location.href= '{{route('offices')}}';
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

 