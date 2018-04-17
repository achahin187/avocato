@extends('layout.app')
@section('content')


              <div class="row">
                <div class="col-lg-12">
                  <div class="cover-inside-container margin--small-top-bottom bradius--small bshadow--1" style="background:  url( '{{asset('img/covers/dummy2.jpg')}}' ) no-repeat center center; background-size:cover;">
                    <div class="row">
                      <div class="col-xs-12">
                        <div class="text-xs-center">
                          <div class="text-wraper">
                            <h4 class="cover-inside-title color--gray_d">تقارير و احصائيات</h4>
                          </div>
                        </div>
                      </div>
                      <div class="cover--actions">
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-lg-3">
                  <div class="stat-box stat-box-3 margin--small-top-bottom bgcolor--white bshadow--1 bradius--small">
                    <div class="c100 p{{ $percentage_individuals }} rad_progress_size_small"><span>{{ $percentage_individuals }}%</span>
                      <div class="slice">
                        <div class="bar"></div>
                        <div class="fill"></div>
                      </div>
                    </div>
                    <div class="stat-box-content color--fadeblue"><span class="stat-box-text">عملاء افراد</span><span class="stat-box-number">{{ $count_individuals }}</span></div>
                  </div>
                </div>
                <div class="col-lg-3">
                  <div class="stat-box stat-box-3 margin--small-top-bottom bgcolor--white bshadow--1 bradius--small">
                    <div class="c100 p{{ $percentage_companies }} rad_progress_size_small"><span>{{ $percentage_companies }}%</span>
                      <div class="slice">
                        <div class="bar"></div>
                        <div class="fill"></div>
                      </div>
                    </div>
                    <div class="stat-box-content color--fadeblue"><span class="stat-box-text">عملاء شركات</span><span class="stat-box-number">{{ $count_companies }}</span></div>
                  </div>
                </div>
                <div class="col-lg-3">
                  <div class="stat-box stat-box-3 margin--small-top-bottom bgcolor--white bshadow--1 bradius--small">
                    <div class="c100 p{{ $percentage_indcom }} rad_progress_size_small"><span>{{ $percentage_indcom }}%</span>
                      <div class="slice">
                        <div class="bar"></div>
                        <div class="fill"></div>
                      </div>
                    </div>
                    <div class="stat-box-content color--fadeblue"><span class="stat-box-text">عملاء افراد - شركات</span><span class="stat-box-number">{{ $count_indcom }}</span></div>
                  </div>
                </div>
                <div class="col-lg-3">
                  <div class="stat-box stat-box-3 margin--small-top-bottom bgcolor--white bshadow--1 bradius--small">
                    <div class="c100 p{{ $percentage_mobile }} rad_progress_size_small"><span>{{ $percentage_mobile }}%</span>
                      <div class="slice">
                        <div class="bar"></div>
                        <div class="fill"></div>
                      </div>
                    </div>
                    <div class="stat-box-content color--fadeblue"><span class="stat-box-text">عملاء استشارات عبر التطبيق</span><span class="stat-box-number">{{ $count_mobile }}</span></div>
                  </div>
                </div>
                <div class="col-lg-4">
                  <div class="stat-box margin--small-top-bottom bgcolor--white bshadow--1 bradius--small"><span class="stat-box-icon bgcolor--fadeorange color--white"><i class="fa fa fa-gavel"></i></span>
                    <div class="stat-box-content color--fadeorange"><span class="stat-box-text">عدد القضايا</span><span class="stat-box-number">{{ $count_case }}</span></div>
                  </div>
                </div>
                <div class="col-lg-4">
                  <div class="stat-box margin--small-top-bottom bgcolor--white bshadow--1 bradius--small"><span class="stat-box-icon bgcolor--gray_d color--white"><i class="fa fa fa-tag"></i></span>
                    <div class="stat-box-content color--gray_d"><span class="stat-box-text">عدد الخدمات المدفوعة</span><span class="stat-box-number">{{ $count_paid_services }}</span></div>
                  </div>
                </div>
                <div class="col-lg-4">
                  <div class="stat-box margin--small-top-bottom bgcolor--white bshadow--1 bradius--small"><span class="stat-box-icon bgcolor--fadebrown color--white"><i class="fa fa fa-gift"></i></span>
                    <div class="stat-box-content color--fadebrown"><span class="stat-box-text">عدد الخدمات المجانية</span><span class="stat-box-number">{{ $count_free_services }}</span></div>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="tabs--wrapper">
                    <div class="clearfix"></div>
                    <ul class="tabs">
                      <li>القضايا</li>
                      <li>المحاميين</li>
                      <li>الشركات</li>
                      <li>الاقساط</li>
                      <li>الطوارئ</li>
                      <li>الأماكن</li>
                      <li>المهام</li>
                    </ul>
                    <ul class="tab__content">
                      <li class="tab__content_item active" id="tab1">
                        <div class="cardwrap bgcolor--white bradius--noborder   bshadow--1 padding--small margin--small-top-bottom">
                          <div class="full-table">
                            <div class="remodal-bg">
                              <div class="remodal" data-remodal-id="filtertab1" role="dialog" aria-labelledby="modal1Title" aria-describedby="modal1Desc">
                                <button class="remodal-close" data-remodal-action="close" aria-label="Close"></button>
                                <div>
                                  <h2 id="modal1Title">فلتر</h2>
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="master_field">
                                      <label class="master_label mandatory" for="govern">المحافظة</label>
                                      <select class="master_input select2" id="govern" multiple="multiple" data-placeholder="المحافظة" style="width:100%;" ,>
                                        <option>المحافظة 1</option>
                                        <option>المحافظة 2</option>
                                      </select><span class="master_message color--fadegreen">message</span>
                                    </div>
                                  </div>
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="master_field">
                                      <label class="master_label mandatory" for="city">المدينة</label>
                                      <select class="master_input select2" id="city" multiple="multiple" data-placeholder="المدينة" style="width:100%;" ,>
                                        <option>مدينة 1</option>
                                        <option>مدينة 2</option>
                                      </select><span class="master_message color--fadegreen">message</span>
                                    </div>
                                  </div>
                                </div>
                                <div class="clearfix"></div>
                                <button class="remodal-cancel" data-remodal-action="cancel">الغاء</button>
                                <button class="remodal-confirm" data-remodal-action="confirm">فلتر</button>
                              </div>
                            </div>
                            <div class="filter__btns"><a class="master-btn bgcolor--main color--white bradius--small" href="#filtertab1"><i class="fa fa-filter"></i>filters</a></div>
                            <div class="bottomActions__btns"><a class="master-btn bradius--small padding--small bgcolor--fadeblue color--white" href="#">استخراج اكسيل</a><a class="master-btn bradius--small padding--small bgcolor--fadebrown color--white" href="#">حذف المحدد</a>
                            </div>
                            <table class="table-1">
                              <thead>
                                <tr class="bgcolor--gray_mm color--gray_d">
                                  <th><span class="cellcontent">&lt;input type=&quot;checkbox&quot; name=&quot;select-all&quot; id=&quot;select-all&quot; /&gt;</span></th>
                                  <th><span class="cellcontent">المحافظة</span></th>
                                  <th><span class="cellcontent">المدينة</span></th>
                                  <th><span class="cellcontent">إجمالي عدد القضايا</span></th>
                                </tr>
                              </thead>
                              <tbody>
                                @if (isset($cases) && !empty($cases))
                                  @foreach ($cases as $case)
                                    <tr data-case="{{ $case->id }}">
                                      <td><span class="cellcontent"><input type="checkbox" class="checkboxes" data-id="{{ $case->id }}" /></span></td>
                                      <td><span class="cellcontent">{{ $case->cities->governorate->name }}</span></td>
                                      <td><span class="cellcontent">{{ $case->cities->name }}</span></td>
                                      <td><span class="cellcontent">{{ Helper::countCases($case->cities->id, $case->cities->governorate->id) }}</span></td>
                                    </tr>
                                  @endforeach
                                @endif
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
                        </div>
                      </li>
                      <li class="tab__content_item" id="tab2">
                        <div class="cardwrap bgcolor--white bradius--noborder   bshadow--1 padding--small margin--small-top-bottom">
                          <div class="full-table">
                            <div class="remodal-bg">
                              <div class="remodal" data-remodal-id="filtertab2" role="dialog" aria-labelledby="modal1Title" aria-describedby="modal1Desc">
                                <button class="remodal-close" data-remodal-action="close" aria-label="Close"></button>
                                <div>
                                  <h2 id="modal1Title">فلتر</h2>
                                  <div class="col-md-4">
                                    <div class="master_field">
                                      <label class="master_label mandatory" for="case_type2"> نوع القضية </label>
                                      <select class="master_input select2" id="case_type2" multiple="multiple" data-placeholder=" نوع القضية" style="width:100%;" ,>
                                        <option>جنايات</option>
                                        <option>جنح</option>
                                        <option>رشوة</option>
                                      </select><span class="master_message color--fadegreen">message</span>
                                    </div>
                                  </div>
                                  <div class="col-md-4">
                                    <div class="master_field">
                                      <label class="master_label mandatory" for="case_court2">المحكمة </label>
                                      <select class="master_input select2" id="case_court2" multiple="multiple" data-placeholder="المحكمة" style="width:100%;" ,>
                                        <option>محكمة شرق القاهرة</option>
                                        <option>محكمة غرب القاهرة</option>
                                        <option>محكمة جنوب القاهرة </option>
                                        <option>محكمة الجيزة</option>
                                      </select><span class="master_message color--fadegreen">message</span>
                                    </div>
                                  </div>
                                  <div class="col-md-4">
                                    <div class="master_field">
                                      <label class="master_label mandatory" for="case_type2">الدائرة</label>
                                      <select class="master_input select2" id="case_type2" multiple="multiple" data-placeholder="الدائرة" style="width:100%;" ,>
                                        <option>دائرة العباسية</option>
                                        <option>دائرة الدقي</option>
                                      </select><span class="master_message color--fadegreen">message</span>
                                    </div>
                                  </div>
                                  <div class="col-md-4 col-sm-6 col-xs-12">
                                    <div class="master_field">
                                      <label class="master_label mandatory" for="lawyer_spec"> تخصص المحامي</label>
                                      <select class="master_input select2" id="lawyer_spec" multiple="multiple" data-placeholder="التخصص" style="width:100%;" ,>
                                        <option>تعويضات</option>
                                        <option>تخصص اخر</option>
                                      </select><span class="master_message color--fadegreen">Message</span>
                                    </div>
                                  </div>
                                  <div class="col-md-4 col-sm-6 col-xs-12">
                                    <div class="master_field">
                                      <label class="master_label mandatory" for="lawyer_degree_in">درجة القيد بالنقابة </label>
                                      <select class="master_input select2" id="lawyer_degree_in" multiple="multiple" data-placeholder="درجة التقاضي" style="width:100%;" ,>
                                        <option>محامى تحت التمرين</option>
                                        <option>محامي متمرس</option>
                                      </select><span class="master_message color--fadegreen">Message</span>
                                    </div>
                                  </div>
                                  <div class="col-md-4 col-sm-6 col-xs-12">
                                    <div class="master_field">
                                      <label class="master_label mandatory" for="lawyer_nationality">الجنسية</label>
                                      <input class="master_input" type="text" placeholder="الجنسية" id="lawyer_nationality"><span class="master_message color--fadegreen">message</span>
                                    </div>
                                  </div>
                                  <div class="col-md-4 col-sm-6 col-xs-12">
                                    <div class="master_field">
                                      <label class="master_label mandatory" for="work_from">تاريخ الالتحاق من</label>
                                      <div class="bootstrap-timepicker">
                                        <input class="datepicker master_input" type="text" placeholder="تاريخ الالتحاق" id="work_from">
                                      </div><span class="master_message color--fadegreen">Message</span>
                                    </div>
                                  </div>
                                  <div class="col-md-4 col-sm-6 col-xs-12">
                                    <div class="master_field">
                                      <label class="master_label mandatory" for="work_to">تاريخ الالتحاق الى</label>
                                      <div class="bootstrap-timepicker">
                                        <input class="datepicker master_input" type="text" placeholder="تاريخ الالتحاق" id="work_to">
                                      </div><span class="master_message color--fadegreen">Message</span>
                                    </div>
                                  </div>
                                  <div class="col-md-4 col-sm-6 col-xs-12">
                                    <div class="master_field">
                                      <label class="master_label mandatory" for="work_type">نوع العمل</label>
                                      <select class="master_input select2" id="work_type" multiple="multiple" data-placeholder="نوع العمل " style="width:100%;" ,>
                                        <option>الكل</option>
                                        <option>معين بالمكتب</option>
                                        <option>Freelancer</option>
                                      </select><span class="master_message color--fadegreen">Message</span>
                                    </div>
                                  </div>
                                </div>
                                <div class="clearfix"></div>
                                <button class="remodal-cancel" data-remodal-action="cancel">الغاء</button>
                                <button class="remodal-confirm" data-remodal-action="confirm">فلتر</button>
                              </div>
                            </div>
                            <div class="filter__btns"><a class="master-btn bgcolor--main color--white bradius--small" href="#filtertab2"><i class="fa fa-filter"></i>filters</a></div>
                            <div class="bottomActions__btns"><a class="master-btn bradius--small padding--small bgcolor--fadeblue color--white" href="#">استخراج اكسيل</a><a class="master-btn bradius--small padding--small bgcolor--fadebrown color--white" href="#">حذف المحدد</a>
                            </div>
                            <table class="table-1">
                              <thead>
                                <tr class="bgcolor--gray_mm color--gray_d">
                                  <th><span class="cellcontent">&lt;input type=&quot;checkbox&quot; name=&quot;select-all&quot; id=&quot;select-all&quot; /&gt;</span></th>
                                  <th><span class="cellcontent">نوع القضية</span></th>
                                  <th><span class="cellcontent">المحكمة</span></th>
                                  <th><span class="cellcontent">الدائرة</span></th>
                                  <th><span class="cellcontent">عدد المحامين</span></th>
                                </tr>
                              </thead>
                              <tbody>
                                <tr>
                                  <td><span class="cellcontent"><input type="checkbox" class="checkboxes" /></span></td>
                                  <td><span class="cellcontent">جنايات</span></td>
                                  <td><span class="cellcontent">اسم المحكمة</span></td>
                                  <td><span class="cellcontent">اسم الدائرة</span></td>
                                  <td><span class="cellcontent">332</span></td>
                                </tr>
                                <tr>
                                  <td><span class="cellcontent"><input type="checkbox" class="checkboxes" /></span></td>
                                  <td><span class="cellcontent">جنايات</span></td>
                                  <td><span class="cellcontent">اسم المحكمة</span></td>
                                  <td><span class="cellcontent">اسم الدائرة</span></td>
                                  <td><span class="cellcontent">332</span></td>
                                </tr>
                                <tr>
                                  <td><span class="cellcontent"><input type="checkbox" class="checkboxes" /></span></td>
                                  <td><span class="cellcontent">جنايات</span></td>
                                  <td><span class="cellcontent">اسم المحكمة</span></td>
                                  <td><span class="cellcontent">اسم الدائرة</span></td>
                                  <td><span class="cellcontent">332</span></td>
                                </tr>
                                <tr>
                                  <td><span class="cellcontent"><input type="checkbox" class="checkboxes" /></span></td>
                                  <td><span class="cellcontent">جنايات</span></td>
                                  <td><span class="cellcontent">اسم المحكمة</span></td>
                                  <td><span class="cellcontent">اسم الدائرة</span></td>
                                  <td><span class="cellcontent">332</span></td>
                                </tr>
                                <tr>
                                  <td><span class="cellcontent"><input type="checkbox" class="checkboxes" /></span></td>
                                  <td><span class="cellcontent">جنايات</span></td>
                                  <td><span class="cellcontent">اسم المحكمة</span></td>
                                  <td><span class="cellcontent">اسم الدائرة</span></td>
                                  <td><span class="cellcontent">332</span></td>
                                </tr>
                                <tr>
                                  <td><span class="cellcontent"><input type="checkbox" class="checkboxes" /></span></td>
                                  <td><span class="cellcontent">جنايات</span></td>
                                  <td><span class="cellcontent">اسم المحكمة</span></td>
                                  <td><span class="cellcontent">اسم الدائرة</span></td>
                                  <td><span class="cellcontent">332</span></td>
                                </tr>
                                <tr>
                                  <td><span class="cellcontent"><input type="checkbox" class="checkboxes" /></span></td>
                                  <td><span class="cellcontent">جنايات</span></td>
                                  <td><span class="cellcontent">اسم المحكمة</span></td>
                                  <td><span class="cellcontent">اسم الدائرة</span></td>
                                  <td><span class="cellcontent">332</span></td>
                                </tr>
                                <tr>
                                  <td><span class="cellcontent"><input type="checkbox" class="checkboxes" /></span></td>
                                  <td><span class="cellcontent">جنايات</span></td>
                                  <td><span class="cellcontent">اسم المحكمة</span></td>
                                  <td><span class="cellcontent">اسم الدائرة</span></td>
                                  <td><span class="cellcontent">332</span></td>
                                </tr>
                                <tr>
                                  <td><span class="cellcontent"><input type="checkbox" class="checkboxes" /></span></td>
                                  <td><span class="cellcontent">جنايات</span></td>
                                  <td><span class="cellcontent">اسم المحكمة</span></td>
                                  <td><span class="cellcontent">اسم الدائرة</span></td>
                                  <td><span class="cellcontent">332</span></td>
                                </tr>
                                <tr>
                                  <td><span class="cellcontent"><input type="checkbox" class="checkboxes" /></span></td>
                                  <td><span class="cellcontent">جنايات</span></td>
                                  <td><span class="cellcontent">اسم المحكمة</span></td>
                                  <td><span class="cellcontent">اسم الدائرة</span></td>
                                  <td><span class="cellcontent">332</span></td>
                                </tr>
                                <tr>
                                  <td><span class="cellcontent"><input type="checkbox" class="checkboxes" /></span></td>
                                  <td><span class="cellcontent">جنايات</span></td>
                                  <td><span class="cellcontent">اسم المحكمة</span></td>
                                  <td><span class="cellcontent">اسم الدائرة</span></td>
                                  <td><span class="cellcontent">332</span></td>
                                </tr>
                                <tr>
                                  <td><span class="cellcontent"><input type="checkbox" class="checkboxes" /></span></td>
                                  <td><span class="cellcontent">جنايات</span></td>
                                  <td><span class="cellcontent">اسم المحكمة</span></td>
                                  <td><span class="cellcontent">اسم الدائرة</span></td>
                                  <td><span class="cellcontent">332</span></td>
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
                      <li class="tab__content_item" id="tab3">
                        <div class="cardwrap bgcolor--white bradius--noborder   bshadow--1 padding--small margin--small-top-bottom">
                          <div class="full-table">
                            <div class="remodal-bg">
                              <div class="remodal" data-remodal-id="filtertab3" role="dialog" aria-labelledby="modal1Title" aria-describedby="modal1Desc">
                                <button class="remodal-close" data-remodal-action="close" aria-label="Close"></button>
                                <div>
                                  <h3 id="modal1Title">فلتر</h3>
                                  <div class="col-md-4 col-sm-6 col-xs-12">
                                    <div class="master_field">
                                      <label class="master_label mandatory" for="license_code">الكود</label>
                                      <input class="master_input" type="number" placeholder="الكود" id="license_code"><span class="master_message color--fadegreen">message</span>
                                    </div>
                                  </div>
                                  <div class="col-md-4 col-sm-6 col-xs-12">
                                    <div class="master_field">
                                      <label class="master_label mandatory" for="company_name">اسم الشركة</label>
                                      <input class="master_input" type="text" placeholder="اسم الشركة" id="company_name"><span class="master_message color--fadegreen">message</span>
                                    </div>
                                  </div>
                                  <div class="col-md-4 col-sm-6 col-xs-12">
                                    <div class="master_field">
                                      <label class="master_label mandatory" for="license_type"> نوع التعاقد </label>
                                      <select class="master_input select2" id="license_type" multiple="multiple" data-placeholder="نوع التعاقد" style="width:100%;" ,>
                                        <option>ذهبى</option>
                                        <option>برونزي</option>
                                      </select><span class="master_message color--fadegreen">Message</span>
                                    </div>
                                  </div>
                                  <div class="col-md-4 col-sm-6 col-xs-12">
                                    <div class="master_field">
                                      <label class="master_label mandatory">التفعيل</label>
                                      <div class="radiorobo">
                                        <input type="radio" id="rad_1">
                                        <label for="rad_1">الكل</label>
                                      </div>
                                      <div class="radiorobo">
                                        <input type="radio" id="rad_2">
                                        <label for="rad_2">المفعلين</label>
                                      </div>
                                      <div class="radiorobo">
                                        <input type="radio" id="rad_3">
                                        <label for="rad_3">غير المفعلين</label>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <div class="clearfix"></div>
                                <button class="remodal-cancel" data-remodal-action="cancel">الغاء</button>
                                <button class="remodal-confirm" data-remodal-action="confirm">فلتر</button>
                              </div>
                            </div>
                            <div class="filter__btns"><a class="master-btn bgcolor--main color--white bradius--small" href="#filtertab3"><i class="fa fa-filter"></i>filters</a></div>
                            <div class="bottomActions__btns"><a class="master-btn bradius--small padding--small bgcolor--fadeblue color--white" href="#">استخراج اكسيل</a><a class="master-btn bradius--small padding--small bgcolor--fadebrown color--white" href="#">حذف المحدد</a><a class="master-btn bradius--small padding--small bgcolor--fadepurple color--white" href="#">طباعة</a><a class="master-btn bradius--small padding--small bgcolor--fadegreen color--white" href="#">استخراج pdf</a>
                            </div>
                            <table class="table-1">
                              <thead>
                                <tr class="bgcolor--gray_mm color--gray_d">
                                  <th><span class="cellcontent">&lt;input type=&quot;checkbox&quot; name=&quot;select-all&quot; id=&quot;select-all&quot; /&gt;</span></th>
                                  <th><span class="cellcontent">كودالشركة</span></th>
                                  <th><span class="cellcontent">اسم الشركة</span></th>
                                  <th><span class="cellcontent">نوع التعاقد</span></th>
                                  <th><span class="cellcontent">عدد العملاء</span></th>
                                  <th><span class="cellcontent">عدد القضايا</span></th>
                                </tr>
                              </thead>
                              <tbody>
                                <tr>
                                  <td><span class="cellcontent"><input type="checkbox" class="checkboxes" /></span></td>
                                  <td><span class="cellcontent">2012</span></td>
                                  <td><span class="cellcontent">اسم الشركة</span></td>
                                  <td><span class="cellcontent">بلاتيني</span></td>
                                  <td><span class="cellcontent">342</span></td>
                                  <td><span class="cellcontent">343</span></td>
                                </tr>
                                <tr>
                                  <td><span class="cellcontent"><input type="checkbox" class="checkboxes" /></span></td>
                                  <td><span class="cellcontent">2012</span></td>
                                  <td><span class="cellcontent">اسم الشركة</span></td>
                                  <td><span class="cellcontent">بلاتيني</span></td>
                                  <td><span class="cellcontent">342</span></td>
                                  <td><span class="cellcontent">343</span></td>
                                </tr>
                                <tr>
                                  <td><span class="cellcontent"><input type="checkbox" class="checkboxes" /></span></td>
                                  <td><span class="cellcontent">2012</span></td>
                                  <td><span class="cellcontent">اسم الشركة</span></td>
                                  <td><span class="cellcontent">بلاتيني</span></td>
                                  <td><span class="cellcontent">342</span></td>
                                  <td><span class="cellcontent">343</span></td>
                                </tr>
                                <tr>
                                  <td><span class="cellcontent"><input type="checkbox" class="checkboxes" /></span></td>
                                  <td><span class="cellcontent">2012</span></td>
                                  <td><span class="cellcontent">اسم الشركة</span></td>
                                  <td><span class="cellcontent">بلاتيني</span></td>
                                  <td><span class="cellcontent">342</span></td>
                                  <td><span class="cellcontent">343</span></td>
                                </tr>
                                <tr>
                                  <td><span class="cellcontent"><input type="checkbox" class="checkboxes" /></span></td>
                                  <td><span class="cellcontent">2012</span></td>
                                  <td><span class="cellcontent">اسم الشركة</span></td>
                                  <td><span class="cellcontent">بلاتيني</span></td>
                                  <td><span class="cellcontent">342</span></td>
                                  <td><span class="cellcontent">343</span></td>
                                </tr>
                                <tr>
                                  <td><span class="cellcontent"><input type="checkbox" class="checkboxes" /></span></td>
                                  <td><span class="cellcontent">2012</span></td>
                                  <td><span class="cellcontent">اسم الشركة</span></td>
                                  <td><span class="cellcontent">بلاتيني</span></td>
                                  <td><span class="cellcontent">342</span></td>
                                  <td><span class="cellcontent">343</span></td>
                                </tr>
                                <tr>
                                  <td><span class="cellcontent"><input type="checkbox" class="checkboxes" /></span></td>
                                  <td><span class="cellcontent">2012</span></td>
                                  <td><span class="cellcontent">اسم الشركة</span></td>
                                  <td><span class="cellcontent">بلاتيني</span></td>
                                  <td><span class="cellcontent">342</span></td>
                                  <td><span class="cellcontent">343</span></td>
                                </tr>
                                <tr>
                                  <td><span class="cellcontent"><input type="checkbox" class="checkboxes" /></span></td>
                                  <td><span class="cellcontent">2012</span></td>
                                  <td><span class="cellcontent">اسم الشركة</span></td>
                                  <td><span class="cellcontent">بلاتيني</span></td>
                                  <td><span class="cellcontent">342</span></td>
                                  <td><span class="cellcontent">343</span></td>
                                </tr>
                                <tr>
                                  <td><span class="cellcontent"><input type="checkbox" class="checkboxes" /></span></td>
                                  <td><span class="cellcontent">2012</span></td>
                                  <td><span class="cellcontent">اسم الشركة</span></td>
                                  <td><span class="cellcontent">بلاتيني</span></td>
                                  <td><span class="cellcontent">342</span></td>
                                  <td><span class="cellcontent">343</span></td>
                                </tr>
                                <tr>
                                  <td><span class="cellcontent"><input type="checkbox" class="checkboxes" /></span></td>
                                  <td><span class="cellcontent">2012</span></td>
                                  <td><span class="cellcontent">اسم الشركة</span></td>
                                  <td><span class="cellcontent">بلاتيني</span></td>
                                  <td><span class="cellcontent">342</span></td>
                                  <td><span class="cellcontent">343</span></td>
                                </tr>
                                <tr>
                                  <td><span class="cellcontent"><input type="checkbox" class="checkboxes" /></span></td>
                                  <td><span class="cellcontent">2012</span></td>
                                  <td><span class="cellcontent">اسم الشركة</span></td>
                                  <td><span class="cellcontent">بلاتيني</span></td>
                                  <td><span class="cellcontent">342</span></td>
                                  <td><span class="cellcontent">343</span></td>
                                </tr>
                                <tr>
                                  <td><span class="cellcontent"><input type="checkbox" class="checkboxes" /></span></td>
                                  <td><span class="cellcontent">2012</span></td>
                                  <td><span class="cellcontent">اسم الشركة</span></td>
                                  <td><span class="cellcontent">بلاتيني</span></td>
                                  <td><span class="cellcontent">342</span></td>
                                  <td><span class="cellcontent">343</span></td>
                                </tr>
                              </tbody>
                            </table>
                            <div class="remodal log-custom" data-remodal-id="log_link" role="dialog" aria-labelledby="modal1Title" aria-describedby="modal1Desc">
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
                            <div class="clearfix"></div>
                          </div>
                        </div>
                      </li>
                      <li class="tab__content_item" id="tab4">
                        <div class="cardwrap bgcolor--white bradius--noborder   bshadow--1 padding--small margin--small-top-bottom">
                          <div class="full-table">
                            <div class="remodal-bg">
                              <div class="remodal" data-remodal-id="filtertab4" role="dialog" aria-labelledby="modal1Title" aria-describedby="modal1Desc">
                                <button class="remodal-close" data-remodal-action="close" aria-label="Close"></button>
                                <div>
                                  <h2 id="modal1Title">فلتر</h2>
                                  <div class="col-md-4 col-sm-6 col-xs-12">
                                    <div class="master_field">
                                      <label class="master_label mandatory" for="ID_No">كود العميل</label>
                                      <input class="master_input" type="number" placeholder="الكود" id="ID_No"><span class="master_message color--fadegreen">message</span>
                                    </div>
                                  </div>
                                  <div class="col-md-4 col-sm-6 col-xs-12">
                                  </div>
                                  <div class="col-md-4 col-sm-6 col-xs-12">
                                    <div class="master_field">
                                      <label class="master_label mandatory" for="license_date">التاريخ</label>
                                      <div class="bootstrap-timepicker">
                                        <input class="datepicker master_input" type="text" placeholder="تاريخ بداية النعاقد" id="license_date">
                                      </div><span class="master_message color--fadegreen">Message</span>
                                    </div>
                                  </div>
                                  <div class="col-md-4 col-sm-6 col-xs-12">
                                    <div class="master_field">
                                      <label class="master_label mandatory">حالة الدفع</label>
                                      <div class="radiorobo">
                                        <input type="radio" id="payment_all">
                                        <label for="payment_all">الكل</label>
                                      </div>
                                      <div class="radiorobo">
                                        <input type="radio" id="payment_true">
                                        <label for="payment_true">تم دفعه</label>
                                      </div>
                                      <div class="radiorobo">
                                        <input type="radio" id="payment_false">
                                        <label for="payment_false">لم يتم دفعه</label>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <div class="clearfix"></div>
                                <button class="remodal-cancel" data-remodal-action="cancel">الغاء</button>
                                <button class="remodal-confirm" data-remodal-action="confirm">فلتر</button>
                              </div>
                            </div>
                            <div class="filter__btns"><a class="master-btn bgcolor--main color--white bradius--small" href="#filtertab4"><i class="fa fa-filter"></i>filters</a></div>
                            <div class="bottomActions__btns"><a class="master-btn bradius--small padding--small bgcolor--fadeblue color--white" href="#">استخراج اكسيل</a><a class="master-btn bradius--small padding--small bgcolor--fadebrown color--white" href="#">حذف المحدد</a>
                            </div>
                            <table class="table-1">
                              <thead>
                                <tr class="bgcolor--gray_mm color--gray_d">
                                  <th><span class="cellcontent">&lt;input type=&quot;checkbox&quot; name=&quot;select-all&quot; id=&quot;select-all&quot; /&gt;</span></th>
                                  <th><span class="cellcontent">كود العميل </span></th>
                                  <th><span class="cellcontent">نوع التعاقد</span></th>
                                  <th><span class="cellcontent">ترتيب القسط</span></th>
                                  <th><span class="cellcontent">التاريخ</span></th>
                                  <th><span class="cellcontent">القيمة</span></th>
                                  <th><span class="cellcontent">حالة الدفع</span></th>
                                </tr>
                              </thead>
                              <tbody>
                                <tr>
                                  <td><span class="cellcontent"><input type="checkbox" class="checkboxes" /></span></td>
                                  <td><span class="cellcontent"> 60040</span></td>
                                  <td><span class="cellcontent">برونزي</span></td>
                                  <td><span class="cellcontent">الثاني</span></td>
                                  <td><span class="cellcontent">9-10-2017</span></td>
                                  <td><span class="cellcontent">70050</span></td>
                                  <td><span class="cellcontent"><label class= "data-label bgcolor--fadegreen color--white  ">تم</label></span></td>
                                </tr>
                                <tr>
                                  <td><span class="cellcontent"><input type="checkbox" class="checkboxes" /></span></td>
                                  <td><span class="cellcontent"> 60040</span></td>
                                  <td><span class="cellcontent">برونزي</span></td>
                                  <td><span class="cellcontent">الثاني</span></td>
                                  <td><span class="cellcontent">9-10-2017</span></td>
                                  <td><span class="cellcontent">70050</span></td>
                                  <td><span class="cellcontent"><label class= "data-label bgcolor--fadegreen color--white  ">تم</label></span></td>
                                </tr>
                                <tr>
                                  <td><span class="cellcontent"><input type="checkbox" class="checkboxes" /></span></td>
                                  <td><span class="cellcontent"> 60040</span></td>
                                  <td><span class="cellcontent">برونزي</span></td>
                                  <td><span class="cellcontent">الثاني</span></td>
                                  <td><span class="cellcontent">9-10-2017</span></td>
                                  <td><span class="cellcontent">70050</span></td>
                                  <td><span class="cellcontent"><label class= "data-label bgcolor--fadegreen color--white  ">تم</label></span></td>
                                </tr>
                                <tr>
                                  <td><span class="cellcontent"><input type="checkbox" class="checkboxes" /></span></td>
                                  <td><span class="cellcontent"> 60040</span></td>
                                  <td><span class="cellcontent">برونزي</span></td>
                                  <td><span class="cellcontent">الثاني</span></td>
                                  <td><span class="cellcontent">9-10-2017</span></td>
                                  <td><span class="cellcontent">70050</span></td>
                                  <td><span class="cellcontent"><label class= "data-label bgcolor--fadegreen color--white  ">تم</label></span></td>
                                </tr>
                                <tr>
                                  <td><span class="cellcontent"><input type="checkbox" class="checkboxes" /></span></td>
                                  <td><span class="cellcontent"> 60040</span></td>
                                  <td><span class="cellcontent">برونزي</span></td>
                                  <td><span class="cellcontent">الثاني</span></td>
                                  <td><span class="cellcontent">9-10-2017</span></td>
                                  <td><span class="cellcontent">70050</span></td>
                                  <td><span class="cellcontent"><label class= "data-label bgcolor--fadegreen color--white  ">تم</label></span></td>
                                </tr>
                                <tr>
                                  <td><span class="cellcontent"><input type="checkbox" class="checkboxes" /></span></td>
                                  <td><span class="cellcontent"> 60040</span></td>
                                  <td><span class="cellcontent">برونزي</span></td>
                                  <td><span class="cellcontent">الثاني</span></td>
                                  <td><span class="cellcontent">9-10-2017</span></td>
                                  <td><span class="cellcontent">70050</span></td>
                                  <td><span class="cellcontent"><label class= "data-label bgcolor--fadegreen color--white  ">تم</label></span></td>
                                </tr>
                                <tr>
                                  <td><span class="cellcontent"><input type="checkbox" class="checkboxes" /></span></td>
                                  <td><span class="cellcontent"> 60040</span></td>
                                  <td><span class="cellcontent">برونزي</span></td>
                                  <td><span class="cellcontent">الثاني</span></td>
                                  <td><span class="cellcontent">9-10-2017</span></td>
                                  <td><span class="cellcontent">70050</span></td>
                                  <td><span class="cellcontent"><label class= "data-label bgcolor--fadegreen color--white  ">تم</label></span></td>
                                </tr>
                                <tr>
                                  <td><span class="cellcontent"><input type="checkbox" class="checkboxes" /></span></td>
                                  <td><span class="cellcontent"> 60040</span></td>
                                  <td><span class="cellcontent">برونزي</span></td>
                                  <td><span class="cellcontent">الثاني</span></td>
                                  <td><span class="cellcontent">9-10-2017</span></td>
                                  <td><span class="cellcontent">70050</span></td>
                                  <td><span class="cellcontent"><label class= "data-label bgcolor--fadegreen color--white  ">تم</label></span></td>
                                </tr>
                                <tr>
                                  <td><span class="cellcontent"><input type="checkbox" class="checkboxes" /></span></td>
                                  <td><span class="cellcontent"> 60040</span></td>
                                  <td><span class="cellcontent">برونزي</span></td>
                                  <td><span class="cellcontent">الثاني</span></td>
                                  <td><span class="cellcontent">9-10-2017</span></td>
                                  <td><span class="cellcontent">70050</span></td>
                                  <td><span class="cellcontent"><label class= "data-label bgcolor--fadegreen color--white  ">تم</label></span></td>
                                </tr>
                                <tr>
                                  <td><span class="cellcontent"><input type="checkbox" class="checkboxes" /></span></td>
                                  <td><span class="cellcontent"> 60040</span></td>
                                  <td><span class="cellcontent">برونزي</span></td>
                                  <td><span class="cellcontent">الثاني</span></td>
                                  <td><span class="cellcontent">9-10-2017</span></td>
                                  <td><span class="cellcontent">70050</span></td>
                                  <td><span class="cellcontent"><label class= "data-label bgcolor--fadegreen color--white  ">تم</label></span></td>
                                </tr>
                                <tr>
                                  <td><span class="cellcontent"><input type="checkbox" class="checkboxes" /></span></td>
                                  <td><span class="cellcontent"> 60040</span></td>
                                  <td><span class="cellcontent">برونزي</span></td>
                                  <td><span class="cellcontent">الثاني</span></td>
                                  <td><span class="cellcontent">9-10-2017</span></td>
                                  <td><span class="cellcontent">70050</span></td>
                                  <td><span class="cellcontent"><label class= "data-label bgcolor--fadegreen color--white  ">تم</label></span></td>
                                </tr>
                                <tr>
                                  <td><span class="cellcontent"><input type="checkbox" class="checkboxes" /></span></td>
                                  <td><span class="cellcontent"> 60040</span></td>
                                  <td><span class="cellcontent">برونزي</span></td>
                                  <td><span class="cellcontent">الثاني</span></td>
                                  <td><span class="cellcontent">9-10-2017</span></td>
                                  <td><span class="cellcontent">70050</span></td>
                                  <td><span class="cellcontent"><label class= "data-label bgcolor--fadegreen color--white  ">تم</label></span></td>
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
                            <div class="clearfix"></div>
                          </div>
                        </div>
                      </li>
                      <li class="tab__content_item" id="tab5">
                        <div class="cardwrap bgcolor--white bradius--noborder   bshadow--1 padding--small margin--small-top-bottom">
                          <div class="full-table">
                            <div class="remodal-bg">
                              <div class="remodal" data-remodal-id="filtertab5" role="dialog" aria-labelledby="modal1Title" aria-describedby="modal1Desc">
                                <button class="remodal-close" data-remodal-action="close" aria-label="Close"></button>
                                <div>
                                  <h3 id="modal1Title">فلتر</h3>
                                  <div class="col-md-4 col-sm-6 col-xs-12">
                                    <div class="master_field">
                                      <label class="master_label mandatory" for="client_cade">كود العميل</label>
                                      <input class="master_input" type="number" placeholder=" كود العميل" id="client_cade"><span class="master_message color--fadegreen">message</span>
                                    </div>
                                  </div>
                                  <div class="col-md-4 col-sm-6 col-xs-12">
                                    <div class="master_field">
                                      <label class="master_label mandatory" for="client_name">اسم العميل</label>
                                      <input class="master_input" type="text" placeholder="اسم العميل" id="client_name"><span class="master_message color--fadegreen">message</span>
                                    </div>
                                  </div>
                                  <div class="col-md-4 col-sm-6 col-xs-12">
                                    <div class="master_field">
                                      <label class="master_label mandatory" for="client_type"> نوع العميل</label>
                                      <select class="master_input select2" id="client_type" multiple="multiple" data-placeholder="نوع العميل" style="width:100%;" ,>
                                        <option>شركات</option>
                                        <option>افراد</option>
                                        <option>شركات-أفراد</option>
                                        <option>موبايل</option>
                                      </select><span class="master_message color--fadegreen">Message</span>
                                    </div>
                                  </div>
                                  <div class="col-md-4 col-sm-6 col-xs-12">
                                    <div class="master_field">
                                      <label class="master_label mandatory" for="date">التاريخ</label>
                                      <div class="bootstrap-timepicker">
                                        <input class="datepicker master_input" type="text" placeholder="التاريخ" id="date">
                                      </div><span class="master_message color--fadegreen">Message</span>
                                    </div>
                                  </div>
                                  <div class="col-md-4 col-sm-6 col-xs-12">
                                    <div class="master_field">
                                      <label class="master_label mandatory" for="time">الوقت</label>
                                      <div class="bootstrap-timepicker">
                                        <input class="timepicker master_input" type="text" placeholder="الوقت" id="time">
                                      </div><span class="master_message color--fadegreen">Message</span>
                                    </div>
                                  </div>
                                </div>
                                <div class="clearfix"></div>
                                <button class="remodal-cancel" data-remodal-action="cancel">الغاء</button>
                                <button class="remodal-confirm" data-remodal-action="confirm">فلتر</button>
                              </div>
                            </div>
                            <div class="filter__btns"><a class="master-btn bgcolor--main color--white bradius--small" href="#filtertab5"><i class="fa fa-filter"></i>filters</a></div>
                            <div class="bottomActions__btns"><a class="master-btn bradius--small padding--small bgcolor--fadeblue color--white" href="#">استخراج اكسيل</a><a class="master-btn bradius--small padding--small bgcolor--fadebrown color--white" href="#">حذف المحدد</a><a class="master-btn bradius--small padding--small bgcolor--fadepurple color--white" href="#">طباعة</a><a class="master-btn bradius--small padding--small bgcolor--fadegreen color--white" href="#">استخراج pdf</a>
                            </div>
                            <table class="table-1">
                              <thead>
                                <tr class="bgcolor--gray_mm color--gray_d">
                                  <th><span class="cellcontent">&lt;input type=&quot;checkbox&quot; name=&quot;select-all&quot; id=&quot;select-all&quot; /&gt;</span></th>
                                  <th><span class="cellcontent">كودالعميل</span></th>
                                  <th><span class="cellcontent">اسم العميل</span></th>
                                  <th><span class="cellcontent">نوع العميل</span></th>
                                  <th><span class="cellcontent"> التاريخ</span></th>
                                  <th><span class="cellcontent">الوقت</span></th>
                                  <th><span class="cellcontent">عدد حالات الطوارئ</span></th>
                                </tr>
                              </thead>
                              <tbody>
                                <tr>
                                  <td><span class="cellcontent"><input type="checkbox" class="checkboxes" /></span></td>
                                  <td><span class="cellcontent">20122</span></td>
                                  <td><span class="cellcontent">محمد محمود السيد</span></td>
                                  <td><span class="cellcontent">افراد</span></td>
                                  <td><span class="cellcontent">10-9-2019</span></td>
                                  <td><span class="cellcontent">10:10</span></td>
                                  <td><span class="cellcontent">343</span></td>
                                </tr>
                                <tr>
                                  <td><span class="cellcontent"><input type="checkbox" class="checkboxes" /></span></td>
                                  <td><span class="cellcontent">20122</span></td>
                                  <td><span class="cellcontent">محمد محمود السيد</span></td>
                                  <td><span class="cellcontent">افراد</span></td>
                                  <td><span class="cellcontent">10-9-2019</span></td>
                                  <td><span class="cellcontent">10:10</span></td>
                                  <td><span class="cellcontent">343</span></td>
                                </tr>
                                <tr>
                                  <td><span class="cellcontent"><input type="checkbox" class="checkboxes" /></span></td>
                                  <td><span class="cellcontent">20122</span></td>
                                  <td><span class="cellcontent">محمد محمود السيد</span></td>
                                  <td><span class="cellcontent">افراد</span></td>
                                  <td><span class="cellcontent">10-9-2019</span></td>
                                  <td><span class="cellcontent">10:10</span></td>
                                  <td><span class="cellcontent">343</span></td>
                                </tr>
                                <tr>
                                  <td><span class="cellcontent"><input type="checkbox" class="checkboxes" /></span></td>
                                  <td><span class="cellcontent">20122</span></td>
                                  <td><span class="cellcontent">محمد محمود السيد</span></td>
                                  <td><span class="cellcontent">افراد</span></td>
                                  <td><span class="cellcontent">10-9-2019</span></td>
                                  <td><span class="cellcontent">10:10</span></td>
                                  <td><span class="cellcontent">343</span></td>
                                </tr>
                                <tr>
                                  <td><span class="cellcontent"><input type="checkbox" class="checkboxes" /></span></td>
                                  <td><span class="cellcontent">20122</span></td>
                                  <td><span class="cellcontent">محمد محمود السيد</span></td>
                                  <td><span class="cellcontent">افراد</span></td>
                                  <td><span class="cellcontent">10-9-2019</span></td>
                                  <td><span class="cellcontent">10:10</span></td>
                                  <td><span class="cellcontent">343</span></td>
                                </tr>
                                <tr>
                                  <td><span class="cellcontent"><input type="checkbox" class="checkboxes" /></span></td>
                                  <td><span class="cellcontent">20122</span></td>
                                  <td><span class="cellcontent">محمد محمود السيد</span></td>
                                  <td><span class="cellcontent">افراد</span></td>
                                  <td><span class="cellcontent">10-9-2019</span></td>
                                  <td><span class="cellcontent">10:10</span></td>
                                  <td><span class="cellcontent">343</span></td>
                                </tr>
                                <tr>
                                  <td><span class="cellcontent"><input type="checkbox" class="checkboxes" /></span></td>
                                  <td><span class="cellcontent">20122</span></td>
                                  <td><span class="cellcontent">محمد محمود السيد</span></td>
                                  <td><span class="cellcontent">افراد</span></td>
                                  <td><span class="cellcontent">10-9-2019</span></td>
                                  <td><span class="cellcontent">10:10</span></td>
                                  <td><span class="cellcontent">343</span></td>
                                </tr>
                                <tr>
                                  <td><span class="cellcontent"><input type="checkbox" class="checkboxes" /></span></td>
                                  <td><span class="cellcontent">20122</span></td>
                                  <td><span class="cellcontent">محمد محمود السيد</span></td>
                                  <td><span class="cellcontent">افراد</span></td>
                                  <td><span class="cellcontent">10-9-2019</span></td>
                                  <td><span class="cellcontent">10:10</span></td>
                                  <td><span class="cellcontent">343</span></td>
                                </tr>
                                <tr>
                                  <td><span class="cellcontent"><input type="checkbox" class="checkboxes" /></span></td>
                                  <td><span class="cellcontent">20122</span></td>
                                  <td><span class="cellcontent">محمد محمود السيد</span></td>
                                  <td><span class="cellcontent">افراد</span></td>
                                  <td><span class="cellcontent">10-9-2019</span></td>
                                  <td><span class="cellcontent">10:10</span></td>
                                  <td><span class="cellcontent">343</span></td>
                                </tr>
                                <tr>
                                  <td><span class="cellcontent"><input type="checkbox" class="checkboxes" /></span></td>
                                  <td><span class="cellcontent">20122</span></td>
                                  <td><span class="cellcontent">محمد محمود السيد</span></td>
                                  <td><span class="cellcontent">افراد</span></td>
                                  <td><span class="cellcontent">10-9-2019</span></td>
                                  <td><span class="cellcontent">10:10</span></td>
                                  <td><span class="cellcontent">343</span></td>
                                </tr>
                                <tr>
                                  <td><span class="cellcontent"><input type="checkbox" class="checkboxes" /></span></td>
                                  <td><span class="cellcontent">20122</span></td>
                                  <td><span class="cellcontent">محمد محمود السيد</span></td>
                                  <td><span class="cellcontent">افراد</span></td>
                                  <td><span class="cellcontent">10-9-2019</span></td>
                                  <td><span class="cellcontent">10:10</span></td>
                                  <td><span class="cellcontent">343</span></td>
                                </tr>
                                <tr>
                                  <td><span class="cellcontent"><input type="checkbox" class="checkboxes" /></span></td>
                                  <td><span class="cellcontent">20122</span></td>
                                  <td><span class="cellcontent">محمد محمود السيد</span></td>
                                  <td><span class="cellcontent">افراد</span></td>
                                  <td><span class="cellcontent">10-9-2019</span></td>
                                  <td><span class="cellcontent">10:10</span></td>
                                  <td><span class="cellcontent">343</span></td>
                                </tr>
                              </tbody>
                            </table>
                            <div class="remodal log-custom" data-remodal-id="log_link" role="dialog" aria-labelledby="modal1Title" aria-describedby="modal1Desc">
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
                            <div class="clearfix"></div>
                          </div>
                        </div>
                      </li>
                      <li class="tab__content_item" id="tab6">
                        <div class="cardwrap bgcolor--white bradius--noborder   bshadow--1 padding--small margin--small-top-bottom">
                          <div class="full-table">
                            <div class="remodal-bg">
                              <div class="remodal" data-remodal-id="filtertab6" role="dialog" aria-labelledby="modal1Title" aria-describedby="modal1Desc">
                                <button class="remodal-close" data-remodal-action="close" aria-label="Close"></button>
                                <div>
                                  <h2 id="modal1Title">فلتر</h2>
                                  <div class="col-md-4 col-sm-6 col-xs-12">
                                    <div class="master_field">
                                      <label class="master_label mandatory" for="city">المدينة</label>
                                      <select class="master_input select2" id="city" multiple="multiple" data-placeholder="المدينة" style="width:100%;" ,>
                                        <option>مدينة 1</option>
                                        <option>مدينة 2</option>
                                      </select><span class="master_message color--fadegreen">Message</span>
                                    </div>
                                  </div>
                                  <div class="col-md-4 col-sm-6 col-xs-12">
                                    <div class="master_field">
                                      <label class="master_label mandatory" for="gov"> المحافظة </label>
                                      <select class="master_input select2" id="gov" multiple="multiple" data-placeholder="المحافظة" style="width:100%;" ,>
                                        <option>القاهرة</option>
                                        <option>الجيزة</option>
                                      </select><span class="master_message color--fadegreen">Message</span>
                                    </div>
                                  </div>
                                  <div class="col-md-4 col-sm-6 col-xs-12">
                                    <div class="master_field">
                                      <label class="master_label mandatory" for="court">المحكمة </label>
                                      <select class="master_input select2" id="court" multiple="multiple" data-placeholder="المحكمة" style="width:100%;" ,>
                                        <option>محكمة شرق القاهرة</option>
                                        <option>محكمة غرب القاهرة</option>
                                        <option>محكمة جنوب القاهرة </option>
                                        <option>محكمة الجيزة</option>
                                      </select><span class="master_message color--fadegreen">message</span>
                                    </div>
                                  </div>
                                  <div class="col-md-4 col-sm-6 col-xs-12">
                                    <div class="master_field">
                                      <label class="master_label mandatory" for="circle">الدائرة</label>
                                      <select class="master_input select2" id="circle" multiple="multiple" data-placeholder="الدائرة" style="width:100%;" ,>
                                        <option>دائرة العباسية</option>
                                        <option>دائرة الدقي</option>
                                      </select><span class="master_message color--fadegreen">message</span>
                                    </div>
                                  </div>
                                </div>
                                <div class="clearfix"></div>
                                <button class="remodal-cancel" data-remodal-action="cancel">الغاء</button>
                                <button class="remodal-confirm" data-remodal-action="confirm">فلتر</button>
                              </div>
                            </div>
                            <div class="filter__btns"><a class="master-btn bgcolor--main color--white bradius--small" href="#filtertab6"><i class="fa fa-filter"></i>filters</a></div>
                            <div class="bottomActions__btns"><a class="master-btn bradius--small padding--small bgcolor--fadeblue color--white" href="#">استخراج اكسيل</a><a class="master-btn bradius--small padding--small bgcolor--fadebrown color--white" href="#">حذف المحدد</a>
                            </div>
                            <table class="table-1">
                              <thead>
                                <tr class="bgcolor--gray_mm color--gray_d">
                                  <th><span class="cellcontent">&lt;input type=&quot;checkbox&quot; name=&quot;select-all&quot; id=&quot;select-all&quot; /&gt;</span></th>
                                  <th><span class="cellcontent">المدينة</span></th>
                                  <th><span class="cellcontent">المحافظة</span></th>
                                  <th><span class="cellcontent">المحكمة</span></th>
                                  <th><span class="cellcontent">الدائرة</span></th>
                                  <th><span class="cellcontent">عدد القضايا</span></th>
                                </tr>
                              </thead>
                              <tbody>
                                <tr>
                                  <td><span class="cellcontent"><input type="checkbox" class="checkboxes" /></span></td>
                                  <td><span class="cellcontent">اسم المدينة</span></td>
                                  <td><span class="cellcontent">اسم المحافظة</span></td>
                                  <td><span class="cellcontent">اسم المحكمة</span></td>
                                  <td><span class="cellcontent">اسم الدائرة</span></td>
                                  <td><span class="cellcontent">121</span></td>
                                </tr>
                                <tr>
                                  <td><span class="cellcontent"><input type="checkbox" class="checkboxes" /></span></td>
                                  <td><span class="cellcontent">اسم المدينة</span></td>
                                  <td><span class="cellcontent">اسم المحافظة</span></td>
                                  <td><span class="cellcontent">اسم المحكمة</span></td>
                                  <td><span class="cellcontent">اسم الدائرة</span></td>
                                  <td><span class="cellcontent">121</span></td>
                                </tr>
                                <tr>
                                  <td><span class="cellcontent"><input type="checkbox" class="checkboxes" /></span></td>
                                  <td><span class="cellcontent">اسم المدينة</span></td>
                                  <td><span class="cellcontent">اسم المحافظة</span></td>
                                  <td><span class="cellcontent">اسم المحكمة</span></td>
                                  <td><span class="cellcontent">اسم الدائرة</span></td>
                                  <td><span class="cellcontent">121</span></td>
                                </tr>
                                <tr>
                                  <td><span class="cellcontent"><input type="checkbox" class="checkboxes" /></span></td>
                                  <td><span class="cellcontent">اسم المدينة</span></td>
                                  <td><span class="cellcontent">اسم المحافظة</span></td>
                                  <td><span class="cellcontent">اسم المحكمة</span></td>
                                  <td><span class="cellcontent">اسم الدائرة</span></td>
                                  <td><span class="cellcontent">121</span></td>
                                </tr>
                                <tr>
                                  <td><span class="cellcontent"><input type="checkbox" class="checkboxes" /></span></td>
                                  <td><span class="cellcontent">اسم المدينة</span></td>
                                  <td><span class="cellcontent">اسم المحافظة</span></td>
                                  <td><span class="cellcontent">اسم المحكمة</span></td>
                                  <td><span class="cellcontent">اسم الدائرة</span></td>
                                  <td><span class="cellcontent">121</span></td>
                                </tr>
                                <tr>
                                  <td><span class="cellcontent"><input type="checkbox" class="checkboxes" /></span></td>
                                  <td><span class="cellcontent">اسم المدينة</span></td>
                                  <td><span class="cellcontent">اسم المحافظة</span></td>
                                  <td><span class="cellcontent">اسم المحكمة</span></td>
                                  <td><span class="cellcontent">اسم الدائرة</span></td>
                                  <td><span class="cellcontent">121</span></td>
                                </tr>
                                <tr>
                                  <td><span class="cellcontent"><input type="checkbox" class="checkboxes" /></span></td>
                                  <td><span class="cellcontent">اسم المدينة</span></td>
                                  <td><span class="cellcontent">اسم المحافظة</span></td>
                                  <td><span class="cellcontent">اسم المحكمة</span></td>
                                  <td><span class="cellcontent">اسم الدائرة</span></td>
                                  <td><span class="cellcontent">121</span></td>
                                </tr>
                                <tr>
                                  <td><span class="cellcontent"><input type="checkbox" class="checkboxes" /></span></td>
                                  <td><span class="cellcontent">اسم المدينة</span></td>
                                  <td><span class="cellcontent">اسم المحافظة</span></td>
                                  <td><span class="cellcontent">اسم المحكمة</span></td>
                                  <td><span class="cellcontent">اسم الدائرة</span></td>
                                  <td><span class="cellcontent">121</span></td>
                                </tr>
                                <tr>
                                  <td><span class="cellcontent"><input type="checkbox" class="checkboxes" /></span></td>
                                  <td><span class="cellcontent">اسم المدينة</span></td>
                                  <td><span class="cellcontent">اسم المحافظة</span></td>
                                  <td><span class="cellcontent">اسم المحكمة</span></td>
                                  <td><span class="cellcontent">اسم الدائرة</span></td>
                                  <td><span class="cellcontent">121</span></td>
                                </tr>
                                <tr>
                                  <td><span class="cellcontent"><input type="checkbox" class="checkboxes" /></span></td>
                                  <td><span class="cellcontent">اسم المدينة</span></td>
                                  <td><span class="cellcontent">اسم المحافظة</span></td>
                                  <td><span class="cellcontent">اسم المحكمة</span></td>
                                  <td><span class="cellcontent">اسم الدائرة</span></td>
                                  <td><span class="cellcontent">121</span></td>
                                </tr>
                                <tr>
                                  <td><span class="cellcontent"><input type="checkbox" class="checkboxes" /></span></td>
                                  <td><span class="cellcontent">اسم المدينة</span></td>
                                  <td><span class="cellcontent">اسم المحافظة</span></td>
                                  <td><span class="cellcontent">اسم المحكمة</span></td>
                                  <td><span class="cellcontent">اسم الدائرة</span></td>
                                  <td><span class="cellcontent">121</span></td>
                                </tr>
                                <tr>
                                  <td><span class="cellcontent"><input type="checkbox" class="checkboxes" /></span></td>
                                  <td><span class="cellcontent">اسم المدينة</span></td>
                                  <td><span class="cellcontent">اسم المحافظة</span></td>
                                  <td><span class="cellcontent">اسم المحكمة</span></td>
                                  <td><span class="cellcontent">اسم الدائرة</span></td>
                                  <td><span class="cellcontent">121</span></td>
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
                        </div>
                      </li>
                      <li class="tab__content_item" id="tab7">
                        <div class="cardwrap bgcolor--white bradius--noborder   bshadow--1 padding--small margin--small-top-bottom">
                          <div class="full-table">
                            <div class="remodal-bg">
                              <div class="remodal" data-remodal-id="filtertab7" role="dialog" aria-labelledby="modal1Title" aria-describedby="modal1Desc">
                                <button class="remodal-close" data-remodal-action="close" aria-label="Close"></button>
                                <div>
                                  <h2 id="modal1Title">فلتر</h2>
                                  <div class="col-md-4 col-sm-6 col-xs-12">
                                    <div class="master_field">
                                      <label class="master_label mandatory" for="task_type">نوع المهمة </label>
                                      <select class="master_input select2" id="task_type" multiple="multiple" data-placeholder="نوع المهمة " style="width:100%;" ,>
                                        <option>جلسة محكمة</option>
                                        <option>خدمة</option>
                                        <option>مهمة طارئة</option>
                                      </select><span class="master_message color--fadegreen">Message</span>
                                    </div>
                                  </div>
                                  <div class="col-md-4 col-sm-6 col-xs-12">
                                    <div class="master_field">
                                      <label class="master_label mandatory" for="govern">المحافظة</label>
                                      <select class="master_input select2" id="govern" multiple="multiple" data-placeholder="المحافظة" style="width:100%;" ,>
                                        <option>المحافظة 1</option>
                                        <option>المحافظة 2</option>
                                      </select><span class="master_message color--fadegreen">message</span>
                                    </div>
                                  </div>
                                  <div class="col-md-4 col-sm-6 col-xs-12">
                                    <div class="master_field">
                                      <label class="master_label mandatory" for="city">المدينة</label>
                                      <select class="master_input select2" id="city" multiple="multiple" data-placeholder="المدينة" style="width:100%;" ,>
                                        <option>مدينة 1</option>
                                        <option>مدينة 2</option>
                                      </select><span class="master_message color--fadegreen">message</span>
                                    </div>
                                  </div>
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="master_field">
                                      <label class="master_label mandatory" for="tasks_date_from">تاريخ من</label>
                                      <input class="master_input" type="date" placeholder="من" id="tasks_date_from"><span class="master_message color--fadegreen">message</span>
                                    </div>
                                  </div>
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="master_field">
                                      <label class="master_label mandatory" for="tasks_date_to">تاريخ الى</label>
                                      <input class="master_input" type="date" placeholder=" الى" id="tasks_date_to"><span class="master_message color--fadegreen">message</span>
                                    </div>
                                  </div>
                                </div>
                                <div class="clearfix"></div>
                                <button class="remodal-cancel" data-remodal-action="cancel">الغاء</button>
                                <button class="remodal-confirm" data-remodal-action="confirm">فلتر</button>
                              </div>
                            </div>
                            <div class="filter__btns"><a class="master-btn bgcolor--main color--white bradius--small" href="#filtertab7"><i class="fa fa-filter"></i>filters</a></div>
                            <div class="bottomActions__btns"><a class="master-btn bradius--small padding--small bgcolor--fadeblue color--white" href="#">استخراج اكسيل</a><a class="master-btn bradius--small padding--small bgcolor--fadebrown color--white" href="#">حذف المحدد</a>
                            </div>
                            <table class="table-1">
                              <thead>
                                <tr class="bgcolor--gray_mm color--gray_d">
                                  <th><span class="cellcontent">&lt;input type=&quot;checkbox&quot; name=&quot;select-all&quot; id=&quot;select-all&quot; /&gt;</span></th>
                                  <th><span class="cellcontent">نوع المهمة</span></th>
                                  <th><span class="cellcontent">المحافظة</span></th>
                                  <th><span class="cellcontent">المدينة</span></th>
                                  <th><span class="cellcontent">عددالمهام</span></th>
                                </tr>
                              </thead>
                              <tbody>
                                <tr>
                                  <td><span class="cellcontent"><input type="checkbox" class="checkboxes" /></span></td>
                                  <td><span class="cellcontent">خدمة</span></td>
                                  <td><span class="cellcontent">القاهرة الكبري</span></td>
                                  <td><span class="cellcontent">الجيزة</span></td>
                                  <td><span class="cellcontent">332</span></td>
                                </tr>
                                <tr>
                                  <td><span class="cellcontent"><input type="checkbox" class="checkboxes" /></span></td>
                                  <td><span class="cellcontent">خدمة</span></td>
                                  <td><span class="cellcontent">القاهرة الكبري</span></td>
                                  <td><span class="cellcontent">الجيزة</span></td>
                                  <td><span class="cellcontent">332</span></td>
                                </tr>
                                <tr>
                                  <td><span class="cellcontent"><input type="checkbox" class="checkboxes" /></span></td>
                                  <td><span class="cellcontent">خدمة</span></td>
                                  <td><span class="cellcontent">القاهرة الكبري</span></td>
                                  <td><span class="cellcontent">الجيزة</span></td>
                                  <td><span class="cellcontent">332</span></td>
                                </tr>
                                <tr>
                                  <td><span class="cellcontent"><input type="checkbox" class="checkboxes" /></span></td>
                                  <td><span class="cellcontent">خدمة</span></td>
                                  <td><span class="cellcontent">القاهرة الكبري</span></td>
                                  <td><span class="cellcontent">الجيزة</span></td>
                                  <td><span class="cellcontent">332</span></td>
                                </tr>
                                <tr>
                                  <td><span class="cellcontent"><input type="checkbox" class="checkboxes" /></span></td>
                                  <td><span class="cellcontent">خدمة</span></td>
                                  <td><span class="cellcontent">القاهرة الكبري</span></td>
                                  <td><span class="cellcontent">الجيزة</span></td>
                                  <td><span class="cellcontent">332</span></td>
                                </tr>
                                <tr>
                                  <td><span class="cellcontent"><input type="checkbox" class="checkboxes" /></span></td>
                                  <td><span class="cellcontent">خدمة</span></td>
                                  <td><span class="cellcontent">القاهرة الكبري</span></td>
                                  <td><span class="cellcontent">الجيزة</span></td>
                                  <td><span class="cellcontent">332</span></td>
                                </tr>
                                <tr>
                                  <td><span class="cellcontent"><input type="checkbox" class="checkboxes" /></span></td>
                                  <td><span class="cellcontent">خدمة</span></td>
                                  <td><span class="cellcontent">القاهرة الكبري</span></td>
                                  <td><span class="cellcontent">الجيزة</span></td>
                                  <td><span class="cellcontent">332</span></td>
                                </tr>
                                <tr>
                                  <td><span class="cellcontent"><input type="checkbox" class="checkboxes" /></span></td>
                                  <td><span class="cellcontent">خدمة</span></td>
                                  <td><span class="cellcontent">القاهرة الكبري</span></td>
                                  <td><span class="cellcontent">الجيزة</span></td>
                                  <td><span class="cellcontent">332</span></td>
                                </tr>
                                <tr>
                                  <td><span class="cellcontent"><input type="checkbox" class="checkboxes" /></span></td>
                                  <td><span class="cellcontent">خدمة</span></td>
                                  <td><span class="cellcontent">القاهرة الكبري</span></td>
                                  <td><span class="cellcontent">الجيزة</span></td>
                                  <td><span class="cellcontent">332</span></td>
                                </tr>
                                <tr>
                                  <td><span class="cellcontent"><input type="checkbox" class="checkboxes" /></span></td>
                                  <td><span class="cellcontent">خدمة</span></td>
                                  <td><span class="cellcontent">القاهرة الكبري</span></td>
                                  <td><span class="cellcontent">الجيزة</span></td>
                                  <td><span class="cellcontent">332</span></td>
                                </tr>
                                <tr>
                                  <td><span class="cellcontent"><input type="checkbox" class="checkboxes" /></span></td>
                                  <td><span class="cellcontent">خدمة</span></td>
                                  <td><span class="cellcontent">القاهرة الكبري</span></td>
                                  <td><span class="cellcontent">الجيزة</span></td>
                                  <td><span class="cellcontent">332</span></td>
                                </tr>
                                <tr>
                                  <td><span class="cellcontent"><input type="checkbox" class="checkboxes" /></span></td>
                                  <td><span class="cellcontent">خدمة</span></td>
                                  <td><span class="cellcontent">القاهرة الكبري</span></td>
                                  <td><span class="cellcontent">الجيزة</span></td>
                                  <td><span class="cellcontent">332</span></td>
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
                    </ul>
                  </div>
                </div>
              </div>

@endsection