@extends('layout.app')
@section('content')
        
              <!-- =============== Custom Content ===============-->
              <div class="row">
                <div class="col-lg-12">
                  <div class="cover-inside-container margin--small-top-bottom bradius--small bshadow--1" style="background:  url( '../img/covers/dummy2.jpg ' ) no-repeat center center; background-size:cover;">
                    <div class="add-mode">Adding mode</div>
                    <div class="row">
                      <div class="col-xs-12">
                        <div class="text-xs-center">
                          <div class="text-wraper">
                            <h4 class="cover-inside-title color--gray_d">المهام <i class="fa fa-chevron-circle-right"></i>
                              <h4 class="cover-inside-title color--gray_d">المهام العادية </h4>
                            </h4>
                          </div>
                        </div>
                      </div>
                      <div class="cover--actions">
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-lg-12">
                  <div class="cardwrap bgcolor--white bradius--noborder   bshadow--1 padding--small margin--small-top-bottom">
                    <form id="horizontal-pill-steps">
                      <h3>اختيار المحامي</h3>
                      <fieldset>
                        <div class="cardwrap bgcolor--gray_l bradius--noborder   bshadow--1 padding--small margin--small-top-bottom">
                          <div class="col-xs-12"><b class="col-sm-1"> المهمة</b>
                            <div class="col-sm-11">بعض النص</div>
                          </div>
                          <div class="clearfix"> </div>
                        </div>
                        <div class="full-table">
                          <div class="remodal-bg">
                            <div class="remodal" data-remodal-id="filterModal_sponsors" role="dialog" aria-labelledby="modal1Title" aria-describedby="modal1Desc">
                              <button class="remodal-close" data-remodal-action="close" aria-label="Close"></button>
                              <div>
                                <h2 id="modal1Title">فلتر</h2>
                                <div class="col-md-4 col-sm-6 col-xs-12">
                                  <div class="master_field">
                                    <label class="master_label mandatory" for="lawyer_spec"> التخصص</label>
                                    <select class="master_input select2" id="lawyer_spec" multiple="multiple" data-placeholder="التخصص" style="width:100%;" ,>
                                      <option>تعويضات</option>
                                      <option>تخصص اخر</option>
                                    </select><span class="master_message color--fadegreen">message content</span>
                                  </div>
                                </div>
                                <div class="col-md-4 col-sm-6 col-xs-12">
                                  <div class="master_field">
                                    <label class="master_label mandatory" for="lawyer_degree">درجه القيد بالنقابه </label>
                                    <select class="master_input select2" id="lawyer_degree" multiple="multiple" data-placeholder=" درجه القيد بالنقابه" style="width:100%;" ,>
                                      <option>محامى تحت التمرين</option>
                                      <option>محامي متمرس</option>
                                    </select><span class="master_message color--fadegreen">message content</span>
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
                                    <label class="master_label mandatory" for="start_date_from">تاريخ الالتحاق من</label>
                                    <div class="bootstrap-timepicker">
                                      <input class="datepicker master_input" type="text" placeholder="تاريخ الالتحاق" id="start_date_from">
                                    </div><span class="master_message color--fadegreen">message content</span>
                                  </div>
                                </div>
                                <div class="col-md-4 col-sm-6 col-xs-12">
                                  <div class="master_field">
                                    <label class="master_label mandatory" for="start_date_to">تاريخ الالتحاق الى</label>
                                    <div class="bootstrap-timepicker">
                                      <input class="datepicker master_input" type="text" placeholder="تاريخ الالتحاق" id="start_date_to">
                                    </div><span class="master_message color--fadegreen">message content</span>
                                  </div>
                                </div>
                                <div class="col-md-4 col-sm-6 col-xs-12">
                                  <div class="master_field">
                                    <label class="master_label mandatory" for="work_type">نوع العمل</label>
                                    <select class="master_input select2" id="work_type" multiple="multiple" data-placeholder="نوع العمل " style="width:100%;" ,>
                                      <option>الكل</option>
                                      <option>معين بالمكتب</option>
                                      <option>Freelancer</option>
                                    </select><span class="master_message color--fadegreen">message content</span>
                                  </div>
                                </div>
                              </div>
                              <div class="clearfix"></div>
                              <button class="remodal-cancel" data-remodal-action="cancel">الغاء</button>
                              <button class="remodal-confirm" data-remodal-action="confirm">فلتر</button>
                            </div>
                          </div>
                          <div class="filter__btns"><a class="master-btn bgcolor--main color--white bradius--small" href="#filterModal_sponsors"><i class="fa fa-filter"></i>filters</a></div>
                          <table class="table-1">
                            <thead>
                              <tr class="bgcolor--gray_mm color--gray_d">
                                <th><span class="cellcontent">&lt;input type=&quot;checkbox&quot; name=&quot;select-all&quot; id=&quot;select-all&quot; /&gt;</span></th>
                                <th><span class="cellcontent">كود المحامي</span></th>
                                <th><span class="cellcontent">الاسم</span></th>
                                <th><span class="cellcontent">الرقم القومي</span></th>
                                <th><span class="cellcontent">الجنسية</span></th>
                                <th><span class="cellcontent">التخصص</span></th>
                                <th><span class="cellcontent">درجة التقاضى</span></th>
                                <th><span class="cellcontent">عنوان</span></th>
                                <th><span class="cellcontent">هاتف</span></th>
                                <th><span class="cellcontent">تاريخ الإلتحاق</span></th>
                                <th><span class="cellcontent">تفعيل</span></th>
                              </tr>
                            </thead>
                            <tbody>
                              <tr>
                                <td><span class="cellcontent"><input type="checkbox" class="checkboxes" /></span></td>
                                <td><span class="cellcontent">12558</span></td>
                                <td><span class="cellcontent">مجدي سليم</span></td>
                                <td><span class="cellcontent">134567788899</span></td>
                                <td><span class="cellcontent">مصري</span></td>
                                <td><span class="cellcontent">جنايات</span></td>
                                <td><span class="cellcontent">محامى تحت التمرين</span></td>
                                <td><span class="cellcontent">55 شارة الثورة - ألماظة</span></td>
                                <td><span class="cellcontent">0102345678</span></td>
                                <td><span class="cellcontent">12-2016</span></td>
                                <td><span class="cellcontent"><i class = "fa color--fadegreen fa-check"></i></span></td>
                              </tr>
                              <tr>
                                <td><span class="cellcontent"><input type="checkbox" class="checkboxes" /></span></td>
                                <td><span class="cellcontent">12558</span></td>
                                <td><span class="cellcontent">مجدي سليم</span></td>
                                <td><span class="cellcontent">134567788899</span></td>
                                <td><span class="cellcontent">مصري</span></td>
                                <td><span class="cellcontent">جنايات</span></td>
                                <td><span class="cellcontent">محامى تحت التمرين</span></td>
                                <td><span class="cellcontent">55 شارة الثورة - ألماظة</span></td>
                                <td><span class="cellcontent">0102345678</span></td>
                                <td><span class="cellcontent">12-2016</span></td>
                                <td><span class="cellcontent"><i class = "fa color--fadegreen fa-check"></i></span></td>
                              </tr>
                              <tr>
                                <td><span class="cellcontent"><input type="checkbox" class="checkboxes" /></span></td>
                                <td><span class="cellcontent">12558</span></td>
                                <td><span class="cellcontent">مجدي سليم</span></td>
                                <td><span class="cellcontent">134567788899</span></td>
                                <td><span class="cellcontent">مصري</span></td>
                                <td><span class="cellcontent">جنايات</span></td>
                                <td><span class="cellcontent">محامى تحت التمرين</span></td>
                                <td><span class="cellcontent">55 شارة الثورة - ألماظة</span></td>
                                <td><span class="cellcontent">0102345678</span></td>
                                <td><span class="cellcontent">12-2016</span></td>
                                <td><span class="cellcontent"><i class = "fa color--fadegreen fa-check"></i></span></td>
                              </tr>
                              <tr>
                                <td><span class="cellcontent"><input type="checkbox" class="checkboxes" /></span></td>
                                <td><span class="cellcontent">12558</span></td>
                                <td><span class="cellcontent">مجدي سليم</span></td>
                                <td><span class="cellcontent">134567788899</span></td>
                                <td><span class="cellcontent">مصري</span></td>
                                <td><span class="cellcontent">جنايات</span></td>
                                <td><span class="cellcontent">محامى تحت التمرين</span></td>
                                <td><span class="cellcontent">55 شارة الثورة - ألماظة</span></td>
                                <td><span class="cellcontent">0102345678</span></td>
                                <td><span class="cellcontent">12-2016</span></td>
                                <td><span class="cellcontent"><i class = "fa color--fadegreen fa-check"></i></span></td>
                              </tr>
                              <tr>
                                <td><span class="cellcontent"><input type="checkbox" class="checkboxes" /></span></td>
                                <td><span class="cellcontent">12558</span></td>
                                <td><span class="cellcontent">مجدي سليم</span></td>
                                <td><span class="cellcontent">134567788899</span></td>
                                <td><span class="cellcontent">مصري</span></td>
                                <td><span class="cellcontent">جنايات</span></td>
                                <td><span class="cellcontent">محامى تحت التمرين</span></td>
                                <td><span class="cellcontent">55 شارة الثورة - ألماظة</span></td>
                                <td><span class="cellcontent">0102345678</span></td>
                                <td><span class="cellcontent">12-2016</span></td>
                                <td><span class="cellcontent"><i class = "fa color--fadegreen fa-check"></i></span></td>
                              </tr>
                              <tr>
                                <td><span class="cellcontent"><input type="checkbox" class="checkboxes" /></span></td>
                                <td><span class="cellcontent">12558</span></td>
                                <td><span class="cellcontent">مجدي سليم</span></td>
                                <td><span class="cellcontent">134567788899</span></td>
                                <td><span class="cellcontent">مصري</span></td>
                                <td><span class="cellcontent">جنايات</span></td>
                                <td><span class="cellcontent">محامى تحت التمرين</span></td>
                                <td><span class="cellcontent">55 شارة الثورة - ألماظة</span></td>
                                <td><span class="cellcontent">0102345678</span></td>
                                <td><span class="cellcontent">12-2016</span></td>
                                <td><span class="cellcontent"><i class = "fa color--fadegreen fa-check"></i></span></td>
                              </tr>
                              <tr>
                                <td><span class="cellcontent"><input type="checkbox" class="checkboxes" /></span></td>
                                <td><span class="cellcontent">12558</span></td>
                                <td><span class="cellcontent">مجدي سليم</span></td>
                                <td><span class="cellcontent">134567788899</span></td>
                                <td><span class="cellcontent">مصري</span></td>
                                <td><span class="cellcontent">جنايات</span></td>
                                <td><span class="cellcontent">محامى تحت التمرين</span></td>
                                <td><span class="cellcontent">55 شارة الثورة - ألماظة</span></td>
                                <td><span class="cellcontent">0102345678</span></td>
                                <td><span class="cellcontent">12-2016</span></td>
                                <td><span class="cellcontent"><i class = "fa color--fadegreen fa-check"></i></span></td>
                              </tr>
                              <tr>
                                <td><span class="cellcontent"><input type="checkbox" class="checkboxes" /></span></td>
                                <td><span class="cellcontent">12558</span></td>
                                <td><span class="cellcontent">مجدي سليم</span></td>
                                <td><span class="cellcontent">134567788899</span></td>
                                <td><span class="cellcontent">مصري</span></td>
                                <td><span class="cellcontent">جنايات</span></td>
                                <td><span class="cellcontent">محامى تحت التمرين</span></td>
                                <td><span class="cellcontent">55 شارة الثورة - ألماظة</span></td>
                                <td><span class="cellcontent">0102345678</span></td>
                                <td><span class="cellcontent">12-2016</span></td>
                                <td><span class="cellcontent"><i class = "fa color--fadegreen fa-check"></i></span></td>
                              </tr>
                              <tr>
                                <td><span class="cellcontent"><input type="checkbox" class="checkboxes" /></span></td>
                                <td><span class="cellcontent">12558</span></td>
                                <td><span class="cellcontent">مجدي سليم</span></td>
                                <td><span class="cellcontent">134567788899</span></td>
                                <td><span class="cellcontent">مصري</span></td>
                                <td><span class="cellcontent">جنايات</span></td>
                                <td><span class="cellcontent">محامى تحت التمرين</span></td>
                                <td><span class="cellcontent">55 شارة الثورة - ألماظة</span></td>
                                <td><span class="cellcontent">0102345678</span></td>
                                <td><span class="cellcontent">12-2016</span></td>
                                <td><span class="cellcontent"><i class = "fa color--fadegreen fa-check"></i></span></td>
                              </tr>
                              <tr>
                                <td><span class="cellcontent"><input type="checkbox" class="checkboxes" /></span></td>
                                <td><span class="cellcontent">12558</span></td>
                                <td><span class="cellcontent">مجدي سليم</span></td>
                                <td><span class="cellcontent">134567788899</span></td>
                                <td><span class="cellcontent">مصري</span></td>
                                <td><span class="cellcontent">جنايات</span></td>
                                <td><span class="cellcontent">محامى تحت التمرين</span></td>
                                <td><span class="cellcontent">55 شارة الثورة - ألماظة</span></td>
                                <td><span class="cellcontent">0102345678</span></td>
                                <td><span class="cellcontent">12-2016</span></td>
                                <td><span class="cellcontent"><i class = "fa color--fadegreen fa-check"></i></span></td>
                              </tr>
                              <tr>
                                <td><span class="cellcontent"><input type="checkbox" class="checkboxes" /></span></td>
                                <td><span class="cellcontent">12558</span></td>
                                <td><span class="cellcontent">مجدي سليم</span></td>
                                <td><span class="cellcontent">134567788899</span></td>
                                <td><span class="cellcontent">مصري</span></td>
                                <td><span class="cellcontent">جنايات</span></td>
                                <td><span class="cellcontent">محامى تحت التمرين</span></td>
                                <td><span class="cellcontent">55 شارة الثورة - ألماظة</span></td>
                                <td><span class="cellcontent">0102345678</span></td>
                                <td><span class="cellcontent">12-2016</span></td>
                                <td><span class="cellcontent"><i class = "fa color--fadegreen fa-check"></i></span></td>
                              </tr>
                              <tr>
                                <td><span class="cellcontent"><input type="checkbox" class="checkboxes" /></span></td>
                                <td><span class="cellcontent">12558</span></td>
                                <td><span class="cellcontent">مجدي سليم</span></td>
                                <td><span class="cellcontent">134567788899</span></td>
                                <td><span class="cellcontent">مصري</span></td>
                                <td><span class="cellcontent">جنايات</span></td>
                                <td><span class="cellcontent">محامى تحت التمرين</span></td>
                                <td><span class="cellcontent">55 شارة الثورة - ألماظة</span></td>
                                <td><span class="cellcontent">0102345678</span></td>
                                <td><span class="cellcontent">12-2016</span></td>
                                <td><span class="cellcontent"><i class = "fa color--fadegreen fa-check"></i></span></td>
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
                      </fieldset>
                      <h3>تعيين المهمة حسب الجدول الأسبوعي للمحامي</h3>
                      <fieldset>
                        <div class="cardwrap bgcolor--gray_l bradius--noborder   bshadow--1 padding--small margin--small-top-bottom">
                          <div class="col-md-4"><b class="col-xs-4">اسم المحامي</b>
                            <div class="col-xs-8"> أحمد على السيد</div>
                          </div>
                          <div class="col-md-4"><b class="col-xs-4">درجة التقاضي</b>
                            <div class="col-xs-8">محامي جنح</div>
                          </div>
                          <div class="col-md-4"><b class="col-xs-4"> المهمة</b>
                            <div class="col-xs-8">بعض النص</div>
                          </div>
                          <div class="clearfix"> </div><br>
                        </div>
                        <div class="col-md-12">
                          <div class="master_field">
                            <label class="master_label">تاريخ بداية و نهاية المهمة</label>
                            <input class="date_range_picker master_input" type="text" placeholder="placeholder">
                          </div>
                          <div class="col-lg-12">
                            <div class="panel panel-default">
                              <div class="panel-heading" id="heading-1" role="tab">
                                <h4 class="panel-title bgcolor--main_l bradius--noborder bshadow--1 padding--small margin--small-top-bottom"><a class="trigger color--white" role="button" data-toggle="collapse" href="#collapse-1" aria-expanded="true" aria-controls="collapse-1">
                                    <div class="col-xs-11">الاسبوع من الأحد 4-2-2018 الى الخميس 8-2-2018<span class="pull-right color--fadeorange">4 مهمات</span></div>
                                    <div class="clearfix"></div></a></h4>
                              </div>
                            </div>
                            <div class="panel-collapse collapse" id="collapse-1" role="tabpanel" aria-labelledby="heading-1" aria-expanded="true">
                              <div class="panel-body bgcolor--white bradius--noborder bshadow--1 padding--small margin--small-top-bottom">
                                <div class="col-md-12 right-text"><span class="bgcolor--main_l color--white bradius--small importance padding--small">جلسة محكمة</span> &nbsp;<a href="case_view.html">اسم القضية </a>
                                  <div class="pull-right">
                                    <label class="data-label-round bgcolor--fadegreen color--white">4-2-2018</label>
                                  </div>
                                </div>
                                <div class="clearfix"></div>
                                <hr>
                                <div class="col-md-12 right-text"><span class="bgcolor--main_l color--white bradius--small importance padding--small">خدمة</span> &nbsp;<a href="service_view.html">اسم الخدمة</a>
                                  <div class="pull-right">
                                    <label class="data-label-round bgcolor--fadegreen color--white">6-2-2018</label>
                                  </div>
                                </div>
                                <div class="clearfix"></div>
                                <hr>
                                <div class="col-md-12 right-text"><span class="bgcolor--main_l color--white bradius--small importance padding--small">استشارة قانونية</span>  &nbsp;<a href="legal_consultation_view.html">عنوان الإستشارة</a>
                                  <div class="pull-right">
                                    <label class="data-label-round bgcolor--fadegreen color--white">4-2-2018</label>
                                  </div>
                                </div>
                                <div class="clearfix"></div>
                              </div>
                            </div>
                          </div>
                          <div class="col-lg-12">
                            <div class="panel panel-default">
                              <div class="panel-heading" id="heading-2" role="tab">
                                <h4 class="panel-title bgcolor--main_l bradius--noborder bshadow--2 padding--small margin--small-top-bottom"><a class="trigger color--white" role="button" data-toggle="collapse" href="#collapse-2" aria-expanded="true" aria-controls="collapse-2">
                                    <div class="col-xs-11">الاسبوع من الأحد 11-2-2018 الى الخميس 15-2-2018<span class="pull-right color--fadeorange">3 مهمات</span></div>
                                    <div class="clearfix"></div></a></h4>
                              </div>
                            </div>
                            <div class="panel-collapse collapse" id="collapse-2" role="tabpanel" aria-labelledby="heading-2" aria-expanded="true">
                              <div class="panel-body bgcolor--white bradius--noborder bshadow--2 padding--small margin--small-top-bottom">
                                <div class="col-md-12 right-text"><span class="bgcolor--main_l color--white bradius--small importance padding--small">جلسة محكمة</span> &nbsp;<a href="case_view.html">اسم القضية </a>
                                  <div class="pull-right">
                                    <label class="data-label-round bgcolor--fadegreen color--white">4-2-2018</label>
                                  </div>
                                </div>
                                <div class="clearfix"></div>
                                <hr>
                                <div class="col-md-12 right-text"><span class="bgcolor--main_l color--white bradius--small importance padding--small">خدمة</span> &nbsp;<a href="service_view.html">اسم الخدمة</a>
                                  <div class="pull-right">
                                    <label class="data-label-round bgcolor--fadegreen color--white">6-2-2018</label>
                                  </div>
                                </div>
                                <div class="clearfix"></div>
                                <hr>
                                <div class="col-md-12 right-text"><span class="bgcolor--main_l color--white bradius--small importance padding--small">استشارة قانونية</span>  &nbsp;<a href="legal_consultation_view.html">عنوان الإستشارة</a>
                                  <div class="pull-right">
                                    <label class="data-label-round bgcolor--fadegreen color--white">4-2-2018</label>
                                  </div>
                                </div>
                                <div class="clearfix"></div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </fieldset>
                    </form>
                  </div>
                </div>
              </div>
              <!-- =============== PAGE VENDOR Triggers =================-->
                  

@endsection

@section('js')


    <script type="text/javascript">
      var form = $("#horizontal-pill-steps").show();
      form.steps({
        headerTag: "h3",
        bodyTag: "fieldset",
        transitionEffect: "slideLeft",
        onFinishing: function (event, currentIndex)
        {
           // alert("Submitted!");
           
            var form = $(this);

             form.submit();
        },
        onFinished: function (event, currentIndex) {
            // bodyTag: "fieldset"
            // alert("Finish button was clicked");
            }
        });
        
      var form = $("#horizontal-tabs-steps").show();
      form.children("div").steps({
        headerTag: "h3",
        bodyTag: "fieldset",
        transitionEffect: "slideLeft",
        // enableFinishButton: false,
        enablePagination: false,
        enableAllSteps: true,
        titleTemplate: "#title#",
        cssClass: "tabcontrol",
 
  onStepChanging: function (event, currentIndex, newIndex)
            {
if (currentIndex === 5) { //if last step
   //remove default #finish button
   $('#wizard').find('a[href="#finish"]').remove(); 
   //append a submit type button
   $('#wizard .actions li:last-child').append('<button type="submit" id="submit" class="btn-large"><span class="fa fa-chevron-right"></span></button>');
}
                
            },
        onFinishing: function (event, currentIndex)
        {
           alert("Submitted!");
            // var form = $(this);

            //  form.submit();
        },
        onFinished: function (event, currentIndex) {
            // bodyTag: "fieldset"
            alert("Finish button was clicked");
            }
        });

      
    </script>




@endsection