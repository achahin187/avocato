@extends('layout.app')
@section('content')
              <!-- =============== Custom Content ===============-->
              <div class="row">
                <div class="col-md-12">
                  <div class="cover-inside-container margin--small-top-bottom bradius--small bshadow--1" style="background:  url( '../img/covers/dummy2.jpg ' ) no-repeat center center; background-size:cover;">
                    <div class="add-mode">Adding mode</div>
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
                      <div class="cover--actions">
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-12">
                  <form id="horizontal-pill-steps">
                    <h3>معلومات الموكل \ الخصم</h3>
                    <fieldset>
                      <div class="cardwrap bgcolor--white bradius--noborder   bshadow--1 padding--small margin--small-top-bottom">
                        <div class="main-title-conts">
                          <div class="caption">
                            <h3 class="color--main">الموكلين</h3>
                          </div>
                          <div class="actions"><a class="undefined undefined undefined undefined master-btn" type="button" href=""></a>
                          </div><span class="mainseparator bgcolor--main"></span>
                        </div>
                        <div class="col-md-3 col-sm-6 col-xs-12">
                          <div class="master_field">
                            <label class="master_label mandatory" for="client_cade">كود العميل</label>
                            <input class="master_input" type="text" placeholder="كود العميل .." id="client_cade"><span class="master_message color--fadegreen">message</span>
                          </div>
                        </div>
                        <div class="col-md-3 col-sm-6 col-xs-12">
                          <div class="master_field">
                            <label class="master_label mandatory" for="ID_No">اسم الموكل</label>
                            <input class="master_input" type="text" placeholder="اسم الموكل" id="ID_No"><span class="master_message color--fadegreen">بعض النص </span>
                          </div>
                        </div>
                        <div class="col-md-3 col-sm-6 col-xs-12">
                          <div class="master_field">
                            <label class="master_label mandatory" for="ID_No">رقم الهاتف</label>
                            <input class="master_input" type="number" placeholder="رقم الهاتف" id="ID_No"><span class="master_message color--fadegreen">message</span>
                          </div>
                        </div>
                        <div class="col-md-3 col-sm-6 col-xs-12">
                          <div class="master_field">
                            <label class="master_label mandatory" for="ID_No">صفته</label>
                            <select class="master_input select2" id="ID_No" style="width:100%;">
                              <option> الجانى</option>
                              <option>المجنى عليه </option>
                            </select><span class="master_message color--fadegreen">message content</span>
                          </div>
                        </div>
                        <div class="col-md-3 col-sm-6 col-xs-12">
                          <div class="master_field">
                            <label class="master_label mandatory" for="authorization_num">رقم التوكيل</label>
                            <input class="master_input" type="number" placeholder="رقم التوكيل" id="authorization_num"><span class="master_message color--fadegreen">message</span>
                          </div>
                        </div>
                        <div class="col-md-9 col-sm-6 col-xs-12">
                          <div class="master_field">
                            <label class="master_label mandatory" for="ID_No">عنوانه</label>
                            <input class="master_input" type="text" placeholder="عنوانه" id="ID_No"><span class="master_message color--fadegreen">بعض النص </span>
                          </div>
                        </div>
                        <div class="col-md-3 col-md-offset-9">
                          <button class="master-btn undefined btn-block color--white bgcolor--fadebrown bradius--rounded bshadow--0" type="submit"><span>اضافة المزيد</span>
                          </button>
                        </div>
                        <div class="clearfix"></div>
                      </div><br>
                      <div class="cardwrap bgcolor--white bradius--noborder   bshadow--1 padding--small margin--small-top-bottom">
                        <div class="main-title-conts">
                          <div class="caption">
                            <h3 class="color--main">الخصم</h3>
                          </div>
                          <div class="actions"><a class="undefined undefined undefined undefined master-btn" type="button" href=""></a>
                          </div><span class="mainseparator bgcolor--main"></span>
                        </div>
                        <div class="col-md-4 col-sm-6 col-xs-12 col-sm-6 col-xs-12">
                          <div class="master_field">
                            <label class="master_label mandatory" for="enemy_name">اسم الخصم</label>
                            <input class="master_input" type="text" placeholder="اسم الخصم" id="enemy_name"><span class="master_message color--fadegreen">بعض النص </span>
                          </div>
                        </div>
                        <div class="col-md-4 col-sm-6 col-xs-12 col-sm-6 col-xs-12">
                          <div class="master_field">
                            <label class="master_label mandatory" for="enemy_type">صفته</label>
                            <select class="master_input select2" id="enemy_type" style="width:100%;">
                              <option> الجانى</option>
                              <option>المجنى عليه </option>
                            </select><span class="master_message color--fadegreen">message content</span>
                          </div>
                        </div>
                        <div class="col-md-4 col-sm-6 col-xs-12 col-sm-6 col-xs-12">
                          <div class="master_field">
                            <label class="master_label mandatory" for="enemy_lawyer">محاميه</label>
                            <input class="master_input" type="text" placeholder="محاميه" id="enemy_lawyer"><span class="master_message color--fadegreen">بعض النص </span>
                          </div>
                        </div>
                        <div class="col-md-12">
                          <div class="master_field">
                            <label class="master_label mandatory" for="enemy_address">عنوانه</label>
                            <input class="master_input" type="text" placeholder="عنوانه" id="enemy_address"><span class="master_message color--fadegreen">بعض النص </span>
                          </div>
                        </div>
                        <div class="clearfix"></div>
                      </div>
                    </fieldset>
                    <h3>التحقيقات</h3>
                    <fieldset>
                      <div class="row">
                        <div class="col-xs-12">
                          <div class="col-xs-4">
                            <div class="master_field">
                              <label class="master_label" for="investigation_no">رقم المحضر</label>
                              <input class="master_input" type="text" placeholder="رقم المحضر" id="investigation_no"><span class="master_message color--fadegreen">message</span>
                            </div>
                          </div>
                          <div class="col-xs-4">
                            <div class="master_field">
                              <label class="master_label mandatory" for="investigation_type"> نوع المحضر </label>
                              <select class="master_input select2" id="investigation_type" style="width:100%;">
                                <option>شرطة</option>
                                <option>نيابة</option>
                              </select><span class="master_message color--fadegreen">message</span>
                            </div>
                          </div>
                          <div class="col-md-4 col-sm-6 col-xs-12">
                            <div class="master_field">
                              <label class="master_label mandatory">تاريخ</label>
                              <div class="bootstrap-timepicker">
                                <input class="datepicker master_input" type="text" placeholder="تاريخ الاستشارة">
                              </div><span class="master_message color--fadegreen">message content</span>
                            </div>
                          </div>
                          <div class="col-md-12">
                            <div class="master_field">
                              <label class="master_label" for="docs_upload">إرفاق ملفات</label>
                              <div class="file-upload">
                                <div class="file-select">
                                  <div class="file-select-name" id="noFile">إرفاق ملفات</div>
                                  <input class="chooseFile" type="file" name="chooseFile" id="docs_upload">
                                </div>
                              </div><span class="master_message color--fadegreen">message</span>
                            </div>
                          </div>
                          <div class="clearfix"></div>
                        </div>
                      </div>
                    </fieldset>
                    <h3>معلومات القضية </h3>
                    <fieldset>
                      <div class="cardwrap bgcolor--white bradius--noborder   bshadow--1 padding--small margin--small-top-bottom">
                        <div class="col-md-4 col-sm-6 col-xs-12">
                          <div class="master_field">
                            <label class="master_label mandatory" for="folder_num">رقم الملف بالمكتب</label>
                            <input class="master_input" type="number" placeholder="رقم الملف بالمكتب" id="folder_num"><span class="master_message color--fadegreen">message</span>
                          </div>
                        </div>
                        <div class="col-md-4 col-sm-6 col-xs-12">
                          <div class="master_field">
                            <label class="master_label mandatory" for="authorization_num">رقم التوكيل</label>
                            <input class="master_input" type="number" placeholder="رقم التوكيل" id="authorization_num"><span class="master_message color--fadegreen">message</span>
                          </div>
                        </div>
                        <div class="col-md-4 col-sm-6 col-xs-12">
                          <div class="master_field">
                            <label class="master_label mandatory" for="case_fees">رسوم الدعوى</label>
                            <input class="master_input" type="number" placeholder="رسوم الدعوى" id="case_fees"><span class="master_message color--fadegreen">message</span>
                          </div>
                        </div>
                        <div class="col-md-4 col-sm-6 col-xs-12">
                          <div class="master_field">
                            <label class="master_label mandatory" for="case_type">نوع القضية</label>
                            <select class="master_input select2" id="case_type" style="width:100%;">
                              <option>اسرة</option>
                              <option>جنح</option>
                              <option>جنايات</option>
                            </select><span class="master_message color--fadegreen">message</span>
                          </div>
                        </div>
                        <div class="col-md-4 col-sm-6 col-xs-12">
                          <div class="master_field">
                            <label class="master_label mandatory" for="court_name">المحكمة التى تنظر امامها</label>
                            <select class="master_input select2" id="court_name" style="width:100%;">
                              <option>محكمة جنوب القاهرة</option>
                              <option>محكمة شمال القاهرة</option>
                              <option>محكمة الاسرة</option>
                              <option>محكمة الزنانيري</option>
                            </select><span class="master_message color--fadegreen">message</span>
                          </div>
                        </div>
                        <div class="col-md-4 col-sm-6 col-xs-12">
                          <div class="master_field">
                            <label class="master_label mandatory" for="governorate">المحافظة</label>
                            <select class="master_input select2" id="governorate" style="width:100%;">
                              <option>القاهرة</option>
                              <option>الاسكندرية </option>
                              <option>الغربية</option>
                              <option>الشرقية</option>
                            </select><span class="master_message color--fadegreen">message</span>
                          </div>
                        </div>
                        <div class="col-md-4 col-sm-6 col-xs-12">
                          <div class="master_field">
                            <label class="master_label mandatory" for="city">المدينة</label>
                            <select class="master_input select2" id="city" style="width:100%;">
                              <option>مدينة 1</option>
                              <option>مدينة2 </option>
                              <option>مدينة 3</option>
                              <option>مدينة4</option>
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
                        <div class="col-md-4 col-sm-6 col-xs-12">
                          <div class="master_field">
                            <label class="master_label mandatory" for="case_year">السنة</label>
                            <input class="master_input" type="number" placeholder="السنة" id="case_year"><span class="master_message color--fadegreen">message</span>
                          </div>
                        </div>
                        <div class="col-md-4 col-sm-6 col-xs-12">
                          <div class="master_field">
                            <label class="master_label mandatory" for="case_date">تاريخ قيد الدعوى </label>
                            <div class="bootstrap-timepicker">
                              <input class="datepicker master_input" type="text" placeholder="تاريخ قيد الدعوى " id="case_date">
                            </div><span class="master_message color--fadegreen">message</span>
                          </div>
                        </div>
                        <div class="col-md-4 col-sm-6 col-xs-12">
                          <div class="master_field">
                            <label class="master_label mandatory" for="case_dateRang">تاريخ بدء / نهاية القضية</label>
                            <input class="date_range_picker master_input" type="text" placeholder="ex:John Doe" id="case_dateRang"><span class="master_message color--fadegreen">message</span>
                          </div>
                        </div>
                        <div class="col-md-4 col-sm-6 col-xs-12">
                          <div class="master_field">
                            <label class="master_label mandatory" for="case_fees">مصروفات الدعوى</label>
                            <input class="master_input" type="number" placeholder="مصروفات القضية" id="case_fees"><span class="master_message color--fadegreen">message</span>
                          </div>
                        </div>
                        <div class="col-md-4 col-sm-6 col-xs-12">
                          <div class="master_field">
                            <label class="master_label mandatory">صور مستندات القضية</label>
                            <div class="file-upload">
                              <div class="file-select">
                                <div class="file-select-name" id="noFile">صور مستندات القضية </div>
                                <input class="chooseFile" type="file" name="chooseFile">
                              </div>
                            </div><span class="master_message color--fadegreen">message content</span>
                          </div>
                        </div>
                        <div class="col-md-12">
                          <div class="master_field">
                            <label class="master_label mandatory" for="subject">الموضوع</label>
                            <input class="master_input" type="text" placeholder="الموضوع" id="subject"><span class="master_message color--fadegreen">message</span>
                          </div>
                        </div>
                        <div class="col-xs-12">
                          <div class="master_field">
                            <label class="master_label mandatory" for="ID_No">ملاحظات</label>
                            <textarea class="master_input" name="textarea" id="ID_No" placeholder="ملاحظات"></textarea><span class="master_message color--fadegreen">message</span>
                          </div>
                        </div>
                        <div class="clearfix"></div>
                      </div>
                    </fieldset>
                    <h3>المحامي المسئول</h3>
                    <fieldset>
                      <div class="full-table">
                        <div class="remodal-bg">
                          <div class="remodal" data-remodal-id="filterModal_sponsors" role="dialog" aria-labelledby="modal1Title" aria-describedby="modal1Desc">
                            <button class="remodal-close" data-remodal-action="close" aria-label="Close"></button>
                            <div>
                              <h2 id="modal1Title">فلتر</h2>
                              <div class="col-md-6">
                                <div class="master_field">
                                  <label class="master_label mandatory" for="ID_No">كود المحامى</label>
                                  <input class="master_input" type="number" placeholder="كود المحامى" id="ID_No"><span class="master_message color--fadegreen">message</span>
                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="master_field">
                                  <label class="master_label mandatory" for="ID_No">اسم المحامى</label>
                                  <input class="master_input" type="text" placeholder="اسم المحامى" id="ID_No"><span class="master_message color--fadegreen">message</span>
                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="master_field">
                                  <label class="master_label mandatory" for="circle">الدائرة</label>
                                  <select class="master_input select2" id="circle" multiple="multiple" data-placeholder="الدائرة" style="width:100%;" ,>
                                    <option>دائرة العباسية</option>
                                    <option>دائرة الدقي</option>
                                  </select><span class="master_message color--fadegreen">message</span>
                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="master_field">
                                  <label class="master_label mandatory" for="circle">الدائرة</label>
                                  <select class="master_input select2" id="circle" multiple="multiple" data-placeholder="الدائرة" style="width:100%;" ,>
                                    <option>دائرة العباسية</option>
                                    <option>دائرة الدقي</option>
                                  </select><span class="master_message color--fadegreen">message</span>
                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="master_field">
                                  <label class="master_label mandatory" for="ID_No"> التخصص</label>
                                  <select class="master_input select2" id="ID_No" multiple="multiple" data-placeholder="التخصص" style="width:100%;" ,>
                                    <option>تعويضات</option>
                                    <option>تخصص اخر</option>
                                  </select><span class="master_message color--fadegreen">message content</span>
                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="master_field">
                                  <label class="master_label mandatory" for="ID_No">درجة التقاضي</label>
                                  <select class="master_input select2" id="ID_No" multiple="multiple" data-placeholder="درجة التقاضي" style="width:100%;" ,>
                                    <option>محامى تحت التمرين</option>
                                    <option>محامي متمرس</option>
                                  </select><span class="master_message color--fadegreen">message content</span>
                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="master_field">
                                  <label class="master_label mandatory" for="ID_No">الهاتف</label>
                                  <input class="master_input" type="number" placeholder="الهاتف" id="ID_No"><span class="master_message color--fadegreen">message</span>
                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="master_field">
                                  <label class="master_label mandatory" for="ID_No">تاريخ الالتحاق</label>
                                  <div class="bootstrap-timepicker">
                                    <input class="datepicker master_input" type="text" placeholder="تاريخ الالتحاق" id="ID_No">
                                  </div><span class="master_message color--fadegreen">message content</span>
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
                  </form>
                </div>
              </div>
              <!-- =============== PAGE VENDOR Triggers ===============-->
           @endsection