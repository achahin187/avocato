@extends('layout.app')
@section('content')

              <div class="row">
                <div class="col-lg-12">
                  <div class="cover-inside-container margin--small-top-bottom bradius--small bshadow--1" style="background:  url( '{{asset('img/covers/dummy2.jpg')}}' ) no-repeat center center; background-size:cover;">
                    <div class="row">
                      <div class="col-xs-12">
                        <div class="text-xs-center">
                          <div class="text-wraper">
                            <h4 class="cover-inside-title color--gray_d">السادة المحامين</h4>
                          </div>
                        </div>
                      </div>
                      <div class="cover--actions"><a class="color--gray_d bordercolor--gray_d bradius--small border-btn master-btn" type="button" href="lawyer_add.html">إضافة محامي</a><a class="color--gray_d bordercolor--gray_d bradius--small border-btn master-btn" type="button" href="lawyers_follow.html">متابعة أماكن المحامين</a>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-lg-12">
                  <div class="cardwrap bgcolor--white bradius--noborder   bshadow--1 padding--small margin--small-top-bottom">
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
                                <label class="master_label mandatory" for="lawyer_degree_in">درجة القيد بالنقابة </label>
                                <select class="master_input select2" id="lawyer_degree_in" multiple="multiple" data-placeholder="درجة التقاضي" style="width:100%;" ,>
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
                                <label class="master_label mandatory" for="work_from">تاريخ الالتحاق من</label>
                                <div class="bootstrap-timepicker">
                                  <input class="datepicker master_input" type="text" placeholder="تاريخ الالتحاق" id="work_from">
                                </div><span class="master_message color--fadegreen">message content</span>
                              </div>
                            </div>
                            <div class="col-md-4 col-sm-6 col-xs-12">
                              <div class="master_field">
                                <label class="master_label mandatory" for="work_to">تاريخ الالتحاق الى</label>
                                <div class="bootstrap-timepicker">
                                  <input class="datepicker master_input" type="text" placeholder="تاريخ الالتحاق" id="work_to">
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
                      <div class="bottomActions__btns"><a class="master-btn bradius--small padding--small bgcolor--fadeorange color--white" href="#">ارسال تنبية</a><a class="master-btn bradius--small padding--small bgcolor--fadeblue color--white" href="#">استخراج اكسيل</a><a class="master-btn bradius--small padding--small bgcolor--fadebrown color--white btn-warning-cancel" href="#">حذف المحدد</a>
                      </div>
                      <table class="table-1">
                        <thead>
                          <tr class="bgcolor--gray_mm color--gray_d">
                            <th><span class="cellcontent">&lt;input type=&quot;checkbox&quot; name=&quot;select-all&quot; id=&quot;select-all&quot; /&gt;</span></th>
                            <th><span class="cellcontent">كود المحامي</span></th>
                            <th><span class="cellcontent">الاسم</span></th>
                            <th><span class="cellcontent">نوع العمل</span></th>
                            <th><span class="cellcontent">الرقم القومي</span></th>
                            <th><span class="cellcontent">التخصص</span></th>
                            <th><span class="cellcontent">درجة القيد بالنقابة</span></th>
                            <th><span class="cellcontent">عنوان</span></th>
                            <th><span class="cellcontent">رقم الموبايل</span></th>
                            <th><span class="cellcontent">تاريخ الإلتحاق</span></th>
                            <th><span class="cellcontent">الجنسية</span></th>
                            <th><span class="cellcontent">تفعيل</span></th>
                            <th><span class="cellcontent">الاجراءات</span></th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td><span class="cellcontent"><input type="checkbox" class="checkboxes" /></span></td>
                            <td><span class="cellcontent">12558</span></td>
                            <td><span class="cellcontent">مجدي سليم</span></td>
                            <td><span class="cellcontent">معين بالمكتب</span></td>
                            <td><span class="cellcontent">134567788899</span></td>
                            <td><span class="cellcontent">جنايات</span></td>
                            <td><span class="cellcontent">محامى تحت التمرين</span></td>
                            <td><span class="cellcontent">55 شارة الثورة - ألماظة</span></td>
                            <td><span class="cellcontent">0102345678</span></td>
                            <td><span class="cellcontent">12-2016</span></td>
                            <td><span class="cellcontent">مصري</span></td>
                            <td><span class="cellcontent"><i class = "fa color--fadegreen fa-check"></i></span></td>
                            <td><span class="cellcontent"><a href= lawyer_view.html ,  class= "action-btn bgcolor--main color--white "><i class = "fa  fa-eye"></i></a><a href= #lawyer_notification ,  class= "action-btn bgcolor--fadeorange color--white "><i class = "fa  fa-envelope"></i></a><a href= lawyer_edit.html ,  class= "action-btn bgcolor--fadegreen color--white "><i class = "fa  fa-pencil"></i></a><a href="#"  class= "btn-warning-cancel action-btn bgcolor--fadebrown color--white "><i class = "fa  fa-trash-o"></i></a></span></td>
                          </tr>
                          <tr>
                            <td><span class="cellcontent"><input type="checkbox" class="checkboxes" /></span></td>
                            <td><span class="cellcontent">12558</span></td>
                            <td><span class="cellcontent">مجدي سليم</span></td>
                            <td><span class="cellcontent">معين بالمكتب</span></td>
                            <td><span class="cellcontent">134567788899</span></td>
                            <td><span class="cellcontent">جنايات</span></td>
                            <td><span class="cellcontent">محامى تحت التمرين</span></td>
                            <td><span class="cellcontent">55 شارة الثورة - ألماظة</span></td>
                            <td><span class="cellcontent">0102345678</span></td>
                            <td><span class="cellcontent">12-2016</span></td>
                            <td><span class="cellcontent">مصري</span></td>
                            <td><span class="cellcontent"><i class = "fa color--fadegreen fa-check"></i></span></td>
                            <td><span class="cellcontent"><a href= lawyer_view.html ,  class= "action-btn bgcolor--main color--white "><i class = "fa  fa-eye"></i></a><a href= #lawyer_notification ,  class= "action-btn bgcolor--fadeorange color--white "><i class = "fa  fa-envelope"></i></a><a href= lawyer_edit.html ,  class= "action-btn bgcolor--fadegreen color--white "><i class = "fa  fa-pencil"></i></a><a href="#"  class= "btn-warning-cancel action-btn bgcolor--fadebrown color--white "><i class = "fa  fa-trash-o"></i></a></span></td>
                          </tr>
                          <tr>
                            <td><span class="cellcontent"><input type="checkbox" class="checkboxes" /></span></td>
                            <td><span class="cellcontent">12558</span></td>
                            <td><span class="cellcontent">مجدي سليم</span></td>
                            <td><span class="cellcontent">معين بالمكتب</span></td>
                            <td><span class="cellcontent">134567788899</span></td>
                            <td><span class="cellcontent">جنايات</span></td>
                            <td><span class="cellcontent">محامى تحت التمرين</span></td>
                            <td><span class="cellcontent">55 شارة الثورة - ألماظة</span></td>
                            <td><span class="cellcontent">0102345678</span></td>
                            <td><span class="cellcontent">12-2016</span></td>
                            <td><span class="cellcontent">مصري</span></td>
                            <td><span class="cellcontent"><i class = "fa color--fadegreen fa-check"></i></span></td>
                            <td><span class="cellcontent"><a href= lawyer_view.html ,  class= "action-btn bgcolor--main color--white "><i class = "fa  fa-eye"></i></a><a href= #lawyer_notification ,  class= "action-btn bgcolor--fadeorange color--white "><i class = "fa  fa-envelope"></i></a><a href= lawyer_edit.html ,  class= "action-btn bgcolor--fadegreen color--white "><i class = "fa  fa-pencil"></i></a><a href="#"  class= "btn-warning-cancel action-btn bgcolor--fadebrown color--white "><i class = "fa  fa-trash-o"></i></a></span></td>
                          </tr>
                          <tr>
                            <td><span class="cellcontent"><input type="checkbox" class="checkboxes" /></span></td>
                            <td><span class="cellcontent">12558</span></td>
                            <td><span class="cellcontent">مجدي سليم</span></td>
                            <td><span class="cellcontent">معين بالمكتب</span></td>
                            <td><span class="cellcontent">134567788899</span></td>
                            <td><span class="cellcontent">جنايات</span></td>
                            <td><span class="cellcontent">محامى تحت التمرين</span></td>
                            <td><span class="cellcontent">55 شارة الثورة - ألماظة</span></td>
                            <td><span class="cellcontent">0102345678</span></td>
                            <td><span class="cellcontent">12-2016</span></td>
                            <td><span class="cellcontent">مصري</span></td>
                            <td><span class="cellcontent"><i class = "fa color--fadegreen fa-check"></i></span></td>
                            <td><span class="cellcontent"><a href= lawyer_view.html ,  class= "action-btn bgcolor--main color--white "><i class = "fa  fa-eye"></i></a><a href= #lawyer_notification ,  class= "action-btn bgcolor--fadeorange color--white "><i class = "fa  fa-envelope"></i></a><a href= lawyer_edit.html ,  class= "action-btn bgcolor--fadegreen color--white "><i class = "fa  fa-pencil"></i></a><a href="#"  class= "btn-warning-cancel action-btn bgcolor--fadebrown color--white "><i class = "fa  fa-trash-o"></i></a></span></td>
                          </tr>
                          <tr>
                            <td><span class="cellcontent"><input type="checkbox" class="checkboxes" /></span></td>
                            <td><span class="cellcontent">12558</span></td>
                            <td><span class="cellcontent">مجدي سليم</span></td>
                            <td><span class="cellcontent">معين بالمكتب</span></td>
                            <td><span class="cellcontent">134567788899</span></td>
                            <td><span class="cellcontent">جنايات</span></td>
                            <td><span class="cellcontent">محامى تحت التمرين</span></td>
                            <td><span class="cellcontent">55 شارة الثورة - ألماظة</span></td>
                            <td><span class="cellcontent">0102345678</span></td>
                            <td><span class="cellcontent">12-2016</span></td>
                            <td><span class="cellcontent">مصري</span></td>
                            <td><span class="cellcontent"><i class = "fa color--fadegreen fa-check"></i></span></td>
                            <td><span class="cellcontent"><a href= lawyer_view.html ,  class= "action-btn bgcolor--main color--white "><i class = "fa  fa-eye"></i></a><a href= #lawyer_notification ,  class= "action-btn bgcolor--fadeorange color--white "><i class = "fa  fa-envelope"></i></a><a href= lawyer_edit.html ,  class= "action-btn bgcolor--fadegreen color--white "><i class = "fa  fa-pencil"></i></a><a href="#"  class= "btn-warning-cancel action-btn bgcolor--fadebrown color--white "><i class = "fa  fa-trash-o"></i></a></span></td>
                          </tr>
                          <tr>
                            <td><span class="cellcontent"><input type="checkbox" class="checkboxes" /></span></td>
                            <td><span class="cellcontent">12558</span></td>
                            <td><span class="cellcontent">مجدي سليم</span></td>
                            <td><span class="cellcontent">معين بالمكتب</span></td>
                            <td><span class="cellcontent">134567788899</span></td>
                            <td><span class="cellcontent">جنايات</span></td>
                            <td><span class="cellcontent">محامى تحت التمرين</span></td>
                            <td><span class="cellcontent">55 شارة الثورة - ألماظة</span></td>
                            <td><span class="cellcontent">0102345678</span></td>
                            <td><span class="cellcontent">12-2016</span></td>
                            <td><span class="cellcontent">مصري</span></td>
                            <td><span class="cellcontent"><i class = "fa color--fadegreen fa-check"></i></span></td>
                            <td><span class="cellcontent"><a href= lawyer_view.html ,  class= "action-btn bgcolor--main color--white "><i class = "fa  fa-eye"></i></a><a href= #lawyer_notification ,  class= "action-btn bgcolor--fadeorange color--white "><i class = "fa  fa-envelope"></i></a><a href= lawyer_edit.html ,  class= "action-btn bgcolor--fadegreen color--white "><i class = "fa  fa-pencil"></i></a><a href="#"  class= "btn-warning-cancel action-btn bgcolor--fadebrown color--white "><i class = "fa  fa-trash-o"></i></a></span></td>
                          </tr>
                          <tr>
                            <td><span class="cellcontent"><input type="checkbox" class="checkboxes" /></span></td>
                            <td><span class="cellcontent">12558</span></td>
                            <td><span class="cellcontent">مجدي سليم</span></td>
                            <td><span class="cellcontent">معين بالمكتب</span></td>
                            <td><span class="cellcontent">134567788899</span></td>
                            <td><span class="cellcontent">جنايات</span></td>
                            <td><span class="cellcontent">محامى تحت التمرين</span></td>
                            <td><span class="cellcontent">55 شارة الثورة - ألماظة</span></td>
                            <td><span class="cellcontent">0102345678</span></td>
                            <td><span class="cellcontent">12-2016</span></td>
                            <td><span class="cellcontent">مصري</span></td>
                            <td><span class="cellcontent"><i class = "fa color--fadegreen fa-check"></i></span></td>
                            <td><span class="cellcontent"><a href= lawyer_view.html ,  class= "action-btn bgcolor--main color--white "><i class = "fa  fa-eye"></i></a><a href= #lawyer_notification ,  class= "action-btn bgcolor--fadeorange color--white "><i class = "fa  fa-envelope"></i></a><a href= lawyer_edit.html ,  class= "action-btn bgcolor--fadegreen color--white "><i class = "fa  fa-pencil"></i></a><a href="#"  class= "btn-warning-cancel action-btn bgcolor--fadebrown color--white "><i class = "fa  fa-trash-o"></i></a></span></td>
                          </tr>
                          <tr>
                            <td><span class="cellcontent"><input type="checkbox" class="checkboxes" /></span></td>
                            <td><span class="cellcontent">12558</span></td>
                            <td><span class="cellcontent">مجدي سليم</span></td>
                            <td><span class="cellcontent">معين بالمكتب</span></td>
                            <td><span class="cellcontent">134567788899</span></td>
                            <td><span class="cellcontent">جنايات</span></td>
                            <td><span class="cellcontent">محامى تحت التمرين</span></td>
                            <td><span class="cellcontent">55 شارة الثورة - ألماظة</span></td>
                            <td><span class="cellcontent">0102345678</span></td>
                            <td><span class="cellcontent">12-2016</span></td>
                            <td><span class="cellcontent">مصري</span></td>
                            <td><span class="cellcontent"><i class = "fa color--fadegreen fa-check"></i></span></td>
                            <td><span class="cellcontent"><a href= lawyer_view.html ,  class= "action-btn bgcolor--main color--white "><i class = "fa  fa-eye"></i></a><a href= #lawyer_notification ,  class= "action-btn bgcolor--fadeorange color--white "><i class = "fa  fa-envelope"></i></a><a href= lawyer_edit.html ,  class= "action-btn bgcolor--fadegreen color--white "><i class = "fa  fa-pencil"></i></a><a href="#"  class= "btn-warning-cancel action-btn bgcolor--fadebrown color--white "><i class = "fa  fa-trash-o"></i></a></span></td>
                          </tr>
                          <tr>
                            <td><span class="cellcontent"><input type="checkbox" class="checkboxes" /></span></td>
                            <td><span class="cellcontent">12558</span></td>
                            <td><span class="cellcontent">مجدي سليم</span></td>
                            <td><span class="cellcontent">معين بالمكتب</span></td>
                            <td><span class="cellcontent">134567788899</span></td>
                            <td><span class="cellcontent">جنايات</span></td>
                            <td><span class="cellcontent">محامى تحت التمرين</span></td>
                            <td><span class="cellcontent">55 شارة الثورة - ألماظة</span></td>
                            <td><span class="cellcontent">0102345678</span></td>
                            <td><span class="cellcontent">12-2016</span></td>
                            <td><span class="cellcontent">مصري</span></td>
                            <td><span class="cellcontent"><i class = "fa color--fadegreen fa-check"></i></span></td>
                            <td><span class="cellcontent"><a href= lawyer_view.html ,  class= "action-btn bgcolor--main color--white "><i class = "fa  fa-eye"></i></a><a href= #lawyer_notification ,  class= "action-btn bgcolor--fadeorange color--white "><i class = "fa  fa-envelope"></i></a><a href= lawyer_edit.html ,  class= "action-btn bgcolor--fadegreen color--white "><i class = "fa  fa-pencil"></i></a><a href="#"  class= "btn-warning-cancel action-btn bgcolor--fadebrown color--white "><i class = "fa  fa-trash-o"></i></a></span></td>
                          </tr>
                          <tr>
                            <td><span class="cellcontent"><input type="checkbox" class="checkboxes" /></span></td>
                            <td><span class="cellcontent">12558</span></td>
                            <td><span class="cellcontent">مجدي سليم</span></td>
                            <td><span class="cellcontent">معين بالمكتب</span></td>
                            <td><span class="cellcontent">134567788899</span></td>
                            <td><span class="cellcontent">جنايات</span></td>
                            <td><span class="cellcontent">محامى تحت التمرين</span></td>
                            <td><span class="cellcontent">55 شارة الثورة - ألماظة</span></td>
                            <td><span class="cellcontent">0102345678</span></td>
                            <td><span class="cellcontent">12-2016</span></td>
                            <td><span class="cellcontent">مصري</span></td>
                            <td><span class="cellcontent"><i class = "fa color--fadegreen fa-check"></i></span></td>
                            <td><span class="cellcontent"><a href= lawyer_view.html ,  class= "action-btn bgcolor--main color--white "><i class = "fa  fa-eye"></i></a><a href= #lawyer_notification ,  class= "action-btn bgcolor--fadeorange color--white "><i class = "fa  fa-envelope"></i></a><a href= lawyer_edit.html ,  class= "action-btn bgcolor--fadegreen color--white "><i class = "fa  fa-pencil"></i></a><a href="#"  class= "btn-warning-cancel action-btn bgcolor--fadebrown color--white "><i class = "fa  fa-trash-o"></i></a></span></td>
                          </tr>
                          <tr>
                            <td><span class="cellcontent"><input type="checkbox" class="checkboxes" /></span></td>
                            <td><span class="cellcontent">12558</span></td>
                            <td><span class="cellcontent">مجدي سليم</span></td>
                            <td><span class="cellcontent">معين بالمكتب</span></td>
                            <td><span class="cellcontent">134567788899</span></td>
                            <td><span class="cellcontent">جنايات</span></td>
                            <td><span class="cellcontent">محامى تحت التمرين</span></td>
                            <td><span class="cellcontent">55 شارة الثورة - ألماظة</span></td>
                            <td><span class="cellcontent">0102345678</span></td>
                            <td><span class="cellcontent">12-2016</span></td>
                            <td><span class="cellcontent">مصري</span></td>
                            <td><span class="cellcontent"><i class = "fa color--fadegreen fa-check"></i></span></td>
                            <td><span class="cellcontent"><a href= lawyer_view.html ,  class= "action-btn bgcolor--main color--white "><i class = "fa  fa-eye"></i></a><a href= #lawyer_notification ,  class= "action-btn bgcolor--fadeorange color--white "><i class = "fa  fa-envelope"></i></a><a href= lawyer_edit.html ,  class= "action-btn bgcolor--fadegreen color--white "><i class = "fa  fa-pencil"></i></a><a href="#"  class= "btn-warning-cancel action-btn bgcolor--fadebrown color--white "><i class = "fa  fa-trash-o"></i></a></span></td>
                          </tr>
                          <tr>
                            <td><span class="cellcontent"><input type="checkbox" class="checkboxes" /></span></td>
                            <td><span class="cellcontent">12558</span></td>
                            <td><span class="cellcontent">مجدي سليم</span></td>
                            <td><span class="cellcontent">معين بالمكتب</span></td>
                            <td><span class="cellcontent">134567788899</span></td>
                            <td><span class="cellcontent">جنايات</span></td>
                            <td><span class="cellcontent">محامى تحت التمرين</span></td>
                            <td><span class="cellcontent">55 شارة الثورة - ألماظة</span></td>
                            <td><span class="cellcontent">0102345678</span></td>
                            <td><span class="cellcontent">12-2016</span></td>
                            <td><span class="cellcontent">مصري</span></td>
                            <td><span class="cellcontent"><i class = "fa color--fadegreen fa-check"></i></span></td>
                            <td><span class="cellcontent"><a href= lawyer_view.html ,  class= "action-btn bgcolor--main color--white "><i class = "fa  fa-eye"></i></a><a href= #lawyer_notification ,  class= "action-btn bgcolor--fadeorange color--white "><i class = "fa  fa-envelope"></i></a><a href= lawyer_edit.html ,  class= "action-btn bgcolor--fadegreen color--white "><i class = "fa  fa-pencil"></i></a><a href="#"  class= "btn-warning-cancel action-btn bgcolor--fadebrown color--white "><i class = "fa  fa-trash-o"></i></a></span></td>
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
                    <div class="col-md-2 col-sm-3 colxs-12"><a class="master-btn undefined undefined undefined undefined undefined" href="#lawyer_notification"><span></span></a>
                      <div class="remodal-bg"></div>
                      <div class="remodal" data-remodal-id="lawyer_notification" role="dialog" aria-labelledby="modal1Title" aria-describedby="modal1Desc">
                        <button class="remodal-close" data-remodal-action="close" aria-label="Close"></button>
                        <div>
                          <div class="row">
                            <h3>إرسال تنبيه</h3>
                            <div class="col-xs-12">
                              <div class="master_field">
                                <label class="master_label mandatory" for="send_date">تاريخ الإرسال</label>
                                <div class="bootstrap-timepicker">
                                  <input class="datepicker master_input" type="text" placeholder="تاريخ الإرسال" id="send_date">
                                </div><span class="master_message color--fadegreen">message</span>
                              </div>
                            </div>
                            <div class="col-xs-12">
                              <div class="master_field">
                                <label class="master_label">نص التنبية</label>
                                <textarea class="master_input" name="textarea" placeholder="نص التنبية"></textarea>
                              </div>
                            </div>
                            <div class="clearfix"></div>
                          </div>
                        </div><br>
                        <button class="remodal-cancel" data-remodal-action="cancel">إلغاء</button>
                        <button class="remodal-confirm" data-remodal-action="confirm">إرسال</button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            

@endsection