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
                      <div class="cover--actions"><a class="color--gray_d bordercolor--white bradius--small border-btn master-btn" type="button" href="{{route('case_add')}}">اضافة قضية جديدة </a>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-lg-12">
                  @if ( Session::has('success') )
                      <div class="alert alert-success text-center">{{ Session::get('success') }}</div>
                  @endif
              
                  @if ( Session::has('warning') )
                      <div class="alert alert-warning text-center">{{ Session::get('warning') }}</div>
                  @endif
                  <div class="cardwrap bgcolor--white bradius--noborder   bshadow--1 padding--small margin--small-top-bottom">
                    <div class="tabs--wrapper">
                      <div class="clearfix"></div>
                      <ul id="head-ul"  class="tabs">
                        <li>القضايا المتداولة </li>
                        <li class="@if(isset($tab)) @if($tab == 2) active   @endif @endif">الأرشيف </li>
                      </ul>
                      <ul class="tab__content">
                        <li class="tab__content_item @if(isset($tab))  @if($tab == 1) active @endif  @else active @endif ">
                          <div class="full-table hide-datatable-pagination">
                            <div class="remodal-bg">
                              <div class="remodal" data-remodal-id="filterModal_cases" role="dialog" aria-labelledby="modal1Title" aria-describedby="modal1Desc">
                                 <form action="{{route('filter_cases')}}" method="post"  enctype="multipart/form-data" accept-charset="utf-8">
                                 <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <button class="remodal-close" data-remodal-action="close" aria-label="Close"></button>
                                <div>
                                  <h2 id="modal1Title">فلتر</h2>
                                  <div class="col-md-4">
                                    <div class="master_field">
                                      <label class="master_label mandatory" for="case_type"> نوع القضية </label>
                                      <select class="master_input select2" id="case_type" name="case_type" style="width:100%;">
                                        @foreach($types as $type)
                                        <option value="{{$type->id}}">{{$type->name}}</option>
                                        @endforeach
                                      </select><span class="master_message color--fadegreen">message</span>
                                    </div>
                                  </div>
                                  <div class="col-md-4">
                                    <div class="master_field">
                                      <label class="master_label mandatory" for="court_name">المحكمة </label>
                                      <select class="master_input select2" id="court_name" name="court_name" style="width:100%;">
                                        @foreach($courts as $court)
                                        <option value="{{$court->id}}">{{$court->name}}</option>
                                        @endforeach
                                      </select> 
                                      <span class="master_message color--fadegreen">message</span>
                                    </div>
                                  </div>
                                  <div class="col-md-4">
                                    <div class="master_field">
                                      <label class="master_label mandatory" for="circle">الدائرة</label>
                                      <input class="master_input " id="circle" name="circle" style="width:100%;">
                                      <span class="master_message color--fadegreen">message</span>
                                    </div>
                                  </div>
                                  <div class="col-md-6">
                                    <div class="master_field">
                                      <label class="master_label mandatory" for="year_from">من سنة</label>
                                      <input class="master_input" type="number" placeholder="من سنة" id="year_from" name="year_from"><span class="master_message color--fadegreen">message</span>
                                    </div>
                                  </div>
                                  <div class="col-md-6">
                                    <div class="master_field">
                                      <label class="master_label mandatory" for="year_to">حتى سنة</label>
                                      <input class="master_input" type="number" placeholder="حتى سنة" id="year_to" name="year_to"><span class="master_message color--fadegreen">message</span>
                                    </div>
                                  </div>
                                  <div class="col-md-6">
                                    <div class="master_field">
                                      <label class="master_label mandatory" for="case_date_from">تاريخ قيد الدعوى من</label>
                                      <div class="bootstrap-timepicker">
                                        <input class="datepicker master_input" type="text" placeholder="تاريخ قيد الدعوى من" id="case_date_from" name="case_date_from">
                                      </div><span class="master_message color--fadegreen">message</span>
                                    </div>
                                  </div>
                                  <div class="col-md-6">
                                    <div class="master_field">
                                      <label class="master_label mandatory" for="case_date_to">تاريخ قيد الدعوى الى</label>
                                      <div class="bootstrap-timepicker">
                                        <input class="datepicker master_input" type="text" placeholder="تاريخ قيد الدعوى الى" id="case_date_to" name="case_date_to">
                                      </div><span class="master_message color--fadegreen">message</span>
                                    </div>
                                  </div>
                                </div>
                                <div class="clearfix"></div>
                                <button class="remodal-cancel" data-remodal-action="cancel">الغاء</button>
                                <button class="remodal-confirm" type="submit">فلتر</button>
                              </form>
                              </div>
                            </div>
                            <div class="filter__btns"><a class="master-btn bgcolor--main color--white bradius--small" href="#filterModal_cases"><i class="fa fa-filter"></i>filters</a></div>
                            <div class="bottomActions__btns"><a class="excel-btn master-btn bradius--small padding--small bgcolor--fadeblue color--white" href="#" >استخراج اكسيل</a><a class="master-btn bradius--small padding--small bgcolor--fadebrown color--white btn-warning-cancel-all" href="#">حذف المحدد</a>
                             @if($cases instanceof \Illuminate\Pagination\LengthAwarePaginator)
                              {{$cases->appends(Request::except('page'))->links()}}
                              @endif
                            </div>
                            <table class="table-1 cases_1 hide-datatable-pagination" id="dataTableTriggerId_001" >
                              <thead>
                                <tr class="bgcolor--gray_mm color--gray_d" >
                                  <th><span class="cellcontent">&lt;input type=&quot;checkbox&quot; name=&quot;select-all&quot; id=&quot;select-all&quot; /&gt;</span></th>
                                  <th><span class="cellcontent">نوع القضية</span></th>
                                  <th><span class="cellcontent">المحكمة</span></th>
                                  <th><span class="cellcontent">الدائرة</span></th>
                                  <th><span class="cellcontent">رقم الدعوى</span></th>
                                  <th><span class="cellcontent">السنة</span></th>
                                  <th><span class="cellcontent">تاريخ قيد الدعوة</span></th>
                                  <th><span class="cellcontent">رقم الملف بالمكتب</span></th>
                                  <th><span class="cellcontent">الإجراءات</span></th>
                                </tr>
                              </thead>
                              <tbody>
                               
                                @foreach($cases as $case)
                                @if($case->archived == 0)
                                <tr data-case-id="{{$case->id}}">
                                  <td><span class="cellcontent"><input type="checkbox" class="checkboxes input-in-table" /></span></td>
                                  <td><span class="cellcontent">{{$case->case_types->name or ''}}</span></td>
                                  <td><span class="cellcontent">{{$case->courts->name or ''}}</span></td>
                                  <td><span class="cellcontent">{{$case->region}}</span></td>
                                  <td><span class="cellcontent">{{$case->claim_number}}</span></td>
                                  <td><span class="cellcontent">{{$case->claim_year}}</span></td>
                                  <td><span class="cellcontent">{{$case->claim_date}}</span></td>
                                  <td><span class="cellcontent">{{$case->office_file_number}}</span></td>
                                  <td><span class="cellcontent"><a href= "{{URL('case_view/'.$case->id)}}" ,  class= "action-btn bgcolor--main color--white "><i class = "fa  fa-eye"></i></a><a href= "{{URL('case_edit/'.$case->id)}}" ,  class= "action-btn bgcolor--fadegreen color--white "><i class = "fa  fa-pencil"></i></a><a href="#"  class= "btn-warning-cancel action-btn bgcolor--fadebrown color--white "><i class = "fa  fa-trash-o"></i></a></span></td>
                                </tr>
                                @endif
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
                        </li>
                        <li  class="tab__content_item @if(isset($tab)) @if($tab == 2) active @endif @endif">
                          <div class="full-table">
                            <div class="remodal-bg">
                              <div class="remodal" data-remodal-id="filterModal_archive" role="dialog" aria-labelledby="modal1Title" aria-describedby="modal1Desc">
                              <form action="{{route('filter_cases')}}" method="post"  enctype="multipart/form-data" accept-charset="utf-8">
                                 <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <button class="remodal-close" data-remodal-action="close" aria-label="Close"></button>
                                <div>
                                  <h2 id="modal1Title">فلتر</h2>
                                  <div class="col-md-4">
                                    <div class="master_field">
                                      <label class="master_label mandatory" for="case_type"> نوع القضية </label>
                                      <select class="master_input select2" id="case_type" name="case_type" style="width:100%;">
                                        @foreach($types as $type)
                                        <option value="{{$type->id}}">{{$type->name}}</option>
                                        @endforeach
                                      </select><span class="master_message color--fadegreen">message</span>
                                    </div>
                                  </div>
                                  <div class="col-md-4">
                                    <div class="master_field">
                                      <label class="master_label mandatory" for="court_name">المحكمة </label>
                                      <select class="master_input select2" id="court_name" name="court_name" style="width:100%;">
                                        @foreach($courts as $court)
                                        <option value="{{$court->id}}">{{$court->name}}</option>
                                        @endforeach
                                      </select> 
                                      <span class="master_message color--fadegreen">message</span>
                                    </div>
                                  </div>
                                  <div class="col-md-4">
                                    <div class="master_field">
                                      <label class="master_label mandatory" for="circle">الدائرة</label>
                                      <input class="master_input " id="circle" name="circle" style="width:100%;">
                                      <span class="master_message color--fadegreen">message</span>
                                    </div>
                                  </div>
                                  <div class="col-md-6">
                                    <div class="master_field">
                                      <label class="master_label mandatory" for="year_from">من سنة</label>
                                      <input class="master_input" type="number" placeholder="من سنة" id="year_from" name="year_from"><span class="master_message color--fadegreen">message</span>
                                    </div>
                                  </div>
                                  <div class="col-md-6">
                                    <div class="master_field">
                                      <label class="master_label mandatory" for="year_to">حتى سنة</label>
                                      <input class="master_input" type="number" placeholder="حتى سنة" id="year_to" name="year_to"><span class="master_message color--fadegreen">message</span>
                                    </div>
                                  </div>
                                  <div class="col-md-6">
                                    <div class="master_field">
                                      <label class="master_label mandatory" for="case_date_from">تاريخ قيد الدعوى من</label>
                                      <div class="bootstrap-timepicker">
                                        <input class="datepicker master_input" type="text" placeholder="تاريخ قيد الدعوى من" id="case_date_from" name="case_date_from">
                                      </div><span class="master_message color--fadegreen">message</span>
                                    </div>
                                  </div>
                                  <div class="col-md-6">
                                    <div class="master_field">
                                      <label class="master_label mandatory" for="case_date_to">تاريخ قيد الدعوى الى</label>
                                      <div class="bootstrap-timepicker">
                                        <input class="datepicker master_input" type="text" placeholder="تاريخ قيد الدعوى الى" id="case_date_to" name="case_date_to">
                                      </div><span class="master_message color--fadegreen">message</span>
                                    </div>
                                  </div>
                                </div>
                                <div class="clearfix"></div>
                                <button class="remodal-cancel" data-remodal-action="cancel">الغاء</button>
                                <button class="remodal-confirm" type="submit">فلتر</button>
                              </form>
                              </div>
                            </div>
                            <div class="filter__btns"><a class="master-btn bgcolor--main color--white bradius--small" href="#filterModal_archive"><i class="fa fa-filter"></i>filters</a></div>
                            <div class="bottomActions__btns"><a class=" excel-btn-1 master-btn bradius--small padding--small bgcolor--fadeblue color--white" href="#" >استخراج اكسيل</a><a class="master-btn bradius--small padding--small bgcolor--fadebrown color--white btn-warning-cancel-all" href="#">حذف المحدد</a>
                            </div>
                            <table class="table-1 cases_2" id="dataTableTriggerId_001">
                              <thead>
                                <tr class="bgcolor--gray_mm color--gray_d">
                                  <th><span class="cellcontent">&lt;input type=&quot;checkbox&quot; name=&quot;select-all&quot; id=&quot;select-all&quot; /&gt;</span></th>
                                  <th><span class="cellcontent">نوع القضية</span></th>
                                  <th><span class="cellcontent">المحكمة</span></th>
                                  <th><span class="cellcontent">الدائرة</span></th>
                                  <th><span class="cellcontent">رقم الدعوى</span></th>
                                  <th><span class="cellcontent">السنة</span></th>
                                  <th><span class="cellcontent">تاريخ قيد الدعوة</span></th>
                                  <th><span class="cellcontent">رقم الملف بالمكتب</span></th>
                                  <th><span class="cellcontent">رقم التوكيل</span></th>
                                  <th><span class="cellcontent">الإجراءات</span></th>
                                </tr>
                              </thead>
                              <tbody>
                                @foreach($cases as $case)
                                @if($case->archived == 1)
                                <tr  data-case-id="{{$case->id}}">
                                  <td><span class="cellcontent"><input type="checkbox" class="checkboxes input-in-table" /></span></td>
                                  <td><span class="cellcontent">{{$case->case_types->name}}</span></td>
                                  <td><span class="cellcontent">{{$case->courts->name}}</span></td>
                                  <td><span class="cellcontent">{{$case->region}}</span></td>
                                  <td><span class="cellcontent">{{$case->claim_number}}</span></td>
                                  <td><span class="cellcontent">{{$case->claim_year}}</span></td>
                                  <td><span class="cellcontent">{{$case->claim_date}}</span></td>
                                  <td><span class="cellcontent">{{$case->office_file_number}}</span></td>
                                  <td><span class="cellcontent">{{$case->office_file_number}}</span></td>
                                  <td><span class="cellcontent"><a href="{{URL('case_archive_view/'.$case->id)}}" ,  class= "action-btn bgcolor--main color--white "><i class = "fa  fa-eye"></i></a><a href="#"  class= "btn-warning-cancel action-btn bgcolor--fadebrown color--white "><i class = "fa  fa-trash-o"></i></a></span></td>
                                </tr>
                                @endif
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
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
              <!-- =============== PAGE VENDOR Triggers ===============-->
                       @endsection
                       @section('js')

                        <script>
                          window.setTimeout(function() {
           $(".alert").fadeTo(500, 0).slideUp(500, function(){
               $(this).remove();
           });
       }, 4000);
        function exportExcel_1() {
                              alasql('SELECT * INTO XLSX("cases.xlsx",{headers:true}) \
                                          FROM HTML(".cases_1",{headers:true})');
                              
                          }
     function exportExcel_2() {
                              alasql('SELECT * INTO XLSX("cases.xlsx",{headers:true}) \
                                          FROM HTML(".cases_2",{headers:true})');
                              
                          }
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
            swal("تم الحذف!", "تم الحذف بنجاح", "success");
          }
        });
         
       } else {
        swal("تم الإلغاء", "المعلومات مازالت موجودة :)", "error");
      }
    });
    });


    $('.btn-warning-cancel-all').click(function(){
      var selectedIds = $("input:checkbox:checked").map(function(){
        return $(this).closest('tr').attr('data-case-id');
      }).get();
      if(selectedIds.length == 0 )
      {
        swal("خطأ", "من فضلك اختر استشاره :)", "error");
      }
      else
      {
        // alert(selectedIds);
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
           url:'{{url('case_destroy_all')}}',
           data:{ids:selectedIds,_token:_token},
           success:function(data){
            $.each( selectedIds, function( key, value ) {
              $('tr[data-case-id='+value+']').fadeOut();
            });
            swal("تم الحذف!", "تم الحذف بنجاح", "success");
          }
        });
         
       } else {
        swal("تم الإلغاء", "المعلومات مازالت موجودة :)", "error");
      }
    });
    }
    });

 $('.excel-btn').click(function(){
    // alert('1');
     var filter='@if(\session('filter_ids')){{json_encode(\session('filter_ids'))}}@endif';
     var selectedIds = $("input:checkbox:checked").map(function(){
      return $(this).closest('tr').attr('data-case-id');
    }).get();
     $.ajax({
       type:'GET',
       url:'{{route('cases_excel')}}',
       data:{ids:selectedIds,filters:filter,type:0},
       success:function(response){
        // alert(2);
        location.href = response;
        swal("تمت العملية بنجاح!", "تم استخراج الجدول علي هيئة ملف اكسيل", "success");
        // var a = document.createElement("a");
        // a.href = response.file; 
        // a.download = response.name+'.xlsx';
        // document.body.appendChild(a);
        // a.click();
        // a.remove();
       
      }
    });
   });
 $('.excel-btn-1').click(function(){
    // alert('1');
     var filter='@if(\session('filter_ids')){{json_encode(\session('filter_ids'))}}@endif';
     var selectedIds = $("input:checkbox:checked").map(function(){
      return $(this).closest('tr').attr('data-case-id');
    }).get();
     $.ajax({
       type:'GET',
       url:'{{route('cases_excel')}}',
       data:{ids:selectedIds,filters:filter,type:1},
       success:function(response){
        // alert(2);
        swal("تمت العملية بنجاح!", "تم استخراج الجدول علي هيئة ملف اكسيل", "success");
        // var a = document.createElement("a");
        // a.href = response.file; 
        // a.download = response.name+'.xlsx';
        // document.body.appendChild(a);
        // a.click();
        // a.remove();
        location.href = response;
      }
    });
   });

  });
</script>

<script>
$(document).ready(function(){
    @if(isset($tab)) 
      @if($tab != 1)
        $("#head-ul>li:first").removeClass("active");
      @endif
    @endif
   });
</script>

                       @endsection