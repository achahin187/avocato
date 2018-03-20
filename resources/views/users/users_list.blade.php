 @extends('layout.app')             
 @section('content')


              <div class="row">
                <div class="col-lg-12">
                  <div class="cover-inside-container margin--small-top-bottom bradius--small bshadow--1" style="background:  url( '../img/covers/dummy2.jpg ' ) no-repeat center center; background-size:cover;">
                    <div class="row">
                      <div class="col-xs-12">
                        <div class="text-xs-center">
                          <div class="text-wraper">
                            <h4 class="cover-inside-title color--gray_d">المستخدمين</h4>
                          </div>
                        </div>
                      </div>
                      <div class="cover--actions"><a class="color--gray_d bordercolor--gray_d bradius--small border-btn master-btn" type="button" href="users_list_add.html">اضافة مستخدم </a>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-lg-12">
                  <div class="cardwrap bgcolor--white bradius--noborder   bshadow--1 padding--small margin--small-top-bottom">
                    <div class="full-table">
                      <div class="filter__btns"><a class="master-btn bgcolor--main color--white bradius--small" href="#filterModal_client_list"><i class="fa fa-filter"></i>filters</a></div>
                      <div class="bottomActions__btns"><a class="master-btn bradius--small padding--small bgcolor--fadeblue color--white" href="#">استخراج اكسيل</a><a class="master-btn bradius--small padding--small bgcolor--fadebrown color--white btn-warning-cancel" href="#">حذف المحدد</a>
                      </div>
                      <div class="remodal" data-remodal-id="filterModal_client_list" role="dialog" aria-labelledby="modal1Title" aria-describedby="modal1Desc">
                        <button class="remodal-close" data-remodal-action="close" aria-label="Close"></button>
                        <div>
                          <h3 id="modal1Title">فلتر</h3>
                          <div class="row">
                            <div class="col-xs-6">
                              <div class="master_field">
                                <label class="master_label" for="type">نوع العضوية</label>
                                <select class="master_input select2" id="type" multiple="multiple" data-placeholder="نوع العضوية" style="width:100%;" ,>
                                  <option>ادمن</option>
                                  <option>خدمة عملاء</option>
                                </select><span class="master_message color--fadegreen">message</span>
                              </div>
                            </div>
                            <div class="col-md-6">
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
                            <div class="col-xs-12">
                              <label class="master_label mandatory">فترة تاريخ اخر مشاركة</label>
                            </div>
                            <div class="col-xs-6">
                              <div class="master_field">
                                <label class="master_label" for="last_activity-filter_from">من</label>
                                <input class="datepicker-popup master_input" type="text" placeholder="تاريخ اخر مشاركة" id="last_activity-filter_from">
                              </div>
                            </div>
                            <div class="col-xs-6">
                              <div class="master_field">
                                <label class="master_label" for="last_activity-filter_to">الى</label>
                                <input class="datepicker-popup master_input" type="text" placeholder="تاريخ اخر مشاركة" id="last_activity-filter_to">
                              </div>
                            </div>
                          </div>
                        </div><br>
                        <button class="remodal-cancel" data-remodal-action="cancel">إلغاء</button>
                        <button class="remodal-confirm" data-remodal-action="confirm">تطبيق الفلاتر</button>
                      </div>
                      <table class="table-1">
                        <thead>
                          <tr class="bgcolor--gray_mm color--gray_d">
                            <th><span class="cellcontent">&lt;input type=&quot;checkbox&quot; name=&quot;select-all&quot; id=&quot;select-all&quot; /&gt;</span></th>
                            <th><span class="cellcontent">م</span></th>
                            <th><span class="cellcontent">اسم الموظف</span></th>
                            <th><span class="cellcontent">البريد الالكترونى</span></th>
                            <th><span class="cellcontent">نوع العضوية</span></th>
                            <th><span class="cellcontent">هاتف</span></th>
                            <th><span class="cellcontent">فعال</span></th>
                            <th><span class="cellcontent">تاريخ التسجيل</span></th>
                            <th><span class="cellcontent">اخر مشاركة</span></th>
                            <th><span class="cellcontent">الإجراءات</span></th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td><span class="cellcontent"><input type="checkbox" class="checkboxes" /></span></td>
                            <td><span class="cellcontent">215</span></td>
                            <td><span class="cellcontent">جون دو</span></td>
                            <td><span class="cellcontent">mail@mail.com</span></td>
                            <td><span class="cellcontent">خدمة عملاء</span></td>
                            <td><span class="cellcontent">0123456789</span></td>
                            <td><span class="cellcontent"><i class = "fa color--fadegreen fa-check"></i></span></td>
                            <td><span class="cellcontent">09-2015</span></td>
                            <td><span class="cellcontent">31-09-2017</span></td>
                            <td><span class="cellcontent"><a href= user_profile.html ,  class= "action-btn bgcolor--main color--white "><i class = "fa  fa-eye"></i></a><a href= users_list_edit.html ,  class= "action-btn bgcolor--fadegreen color--white "><i class = "fa  fa-pencil"></i></a><a href="#"  class= "btn-warning-confirm action-btn bgcolor--fadebrown color--white "><i class = "fa  fa-trash-o"></i></a></span></td>
                          </tr>
                          <tr>
                            <td><span class="cellcontent"><input type="checkbox" class="checkboxes" /></span></td>
                            <td><span class="cellcontent">215</span></td>
                            <td><span class="cellcontent">جون دو</span></td>
                            <td><span class="cellcontent">mail@mail.com</span></td>
                            <td><span class="cellcontent">خدمة عملاء</span></td>
                            <td><span class="cellcontent">0123456789</span></td>
                            <td><span class="cellcontent"><i class = "fa color--fadegreen fa-check"></i></span></td>
                            <td><span class="cellcontent">09-2015</span></td>
                            <td><span class="cellcontent">31-09-2017</span></td>
                            <td><span class="cellcontent"><a href= user_profile.html ,  class= "action-btn bgcolor--main color--white "><i class = "fa  fa-eye"></i></a><a href= users_list_edit.html ,  class= "action-btn bgcolor--fadegreen color--white "><i class = "fa  fa-pencil"></i></a><a href="#"  class= "btn-warning-confirm action-btn bgcolor--fadebrown color--white "><i class = "fa  fa-trash-o"></i></a></span></td>
                          </tr>
                          <tr>
                            <td><span class="cellcontent"><input type="checkbox" class="checkboxes" /></span></td>
                            <td><span class="cellcontent">215</span></td>
                            <td><span class="cellcontent">جون دو</span></td>
                            <td><span class="cellcontent">mail@mail.com</span></td>
                            <td><span class="cellcontent">خدمة عملاء</span></td>
                            <td><span class="cellcontent">0123456789</span></td>
                            <td><span class="cellcontent"><i class = "fa color--fadegreen fa-check"></i></span></td>
                            <td><span class="cellcontent">09-2015</span></td>
                            <td><span class="cellcontent">31-09-2017</span></td>
                            <td><span class="cellcontent"><a href= user_profile.html ,  class= "action-btn bgcolor--main color--white "><i class = "fa  fa-eye"></i></a><a href= users_list_edit.html ,  class= "action-btn bgcolor--fadegreen color--white "><i class = "fa  fa-pencil"></i></a><a href="#"  class= "btn-warning-confirm action-btn bgcolor--fadebrown color--white "><i class = "fa  fa-trash-o"></i></a></span></td>
                          </tr>
                          <tr>
                            <td><span class="cellcontent"><input type="checkbox" class="checkboxes" /></span></td>
                            <td><span class="cellcontent">215</span></td>
                            <td><span class="cellcontent">جون دو</span></td>
                            <td><span class="cellcontent">mail@mail.com</span></td>
                            <td><span class="cellcontent">خدمة عملاء</span></td>
                            <td><span class="cellcontent">0123456789</span></td>
                            <td><span class="cellcontent"><i class = "fa color--fadegreen fa-check"></i></span></td>
                            <td><span class="cellcontent">09-2015</span></td>
                            <td><span class="cellcontent">31-09-2017</span></td>
                            <td><span class="cellcontent"><a href= user_profile.html ,  class= "action-btn bgcolor--main color--white "><i class = "fa  fa-eye"></i></a><a href= users_list_edit.html ,  class= "action-btn bgcolor--fadegreen color--white "><i class = "fa  fa-pencil"></i></a><a href="#"  class= "btn-warning-confirm action-btn bgcolor--fadebrown color--white "><i class = "fa  fa-trash-o"></i></a></span></td>
                          </tr>
                          <tr>
                            <td><span class="cellcontent"><input type="checkbox" class="checkboxes" /></span></td>
                            <td><span class="cellcontent">215</span></td>
                            <td><span class="cellcontent">جون دو</span></td>
                            <td><span class="cellcontent">mail@mail.com</span></td>
                            <td><span class="cellcontent">خدمة عملاء</span></td>
                            <td><span class="cellcontent">0123456789</span></td>
                            <td><span class="cellcontent"><i class = "fa color--fadegreen fa-check"></i></span></td>
                            <td><span class="cellcontent">09-2015</span></td>
                            <td><span class="cellcontent">31-09-2017</span></td>
                            <td><span class="cellcontent"><a href= user_profile.html ,  class= "action-btn bgcolor--main color--white "><i class = "fa  fa-eye"></i></a><a href= users_list_edit.html ,  class= "action-btn bgcolor--fadegreen color--white "><i class = "fa  fa-pencil"></i></a><a href="#"  class= "btn-warning-confirm action-btn bgcolor--fadebrown color--white "><i class = "fa  fa-trash-o"></i></a></span></td>
                          </tr>
                          <tr>
                            <td><span class="cellcontent"><input type="checkbox" class="checkboxes" /></span></td>
                            <td><span class="cellcontent">215</span></td>
                            <td><span class="cellcontent">جون دو</span></td>
                            <td><span class="cellcontent">mail@mail.com</span></td>
                            <td><span class="cellcontent">خدمة عملاء</span></td>
                            <td><span class="cellcontent">0123456789</span></td>
                            <td><span class="cellcontent"><i class = "fa color--fadegreen fa-check"></i></span></td>
                            <td><span class="cellcontent">09-2015</span></td>
                            <td><span class="cellcontent">31-09-2017</span></td>
                            <td><span class="cellcontent"><a href= user_profile.html ,  class= "action-btn bgcolor--main color--white "><i class = "fa  fa-eye"></i></a><a href= users_list_edit.html ,  class= "action-btn bgcolor--fadegreen color--white "><i class = "fa  fa-pencil"></i></a><a href="#"  class= "btn-warning-confirm action-btn bgcolor--fadebrown color--white "><i class = "fa  fa-trash-o"></i></a></span></td>
                          </tr>
                          <tr>
                            <td><span class="cellcontent"><input type="checkbox" class="checkboxes" /></span></td>
                            <td><span class="cellcontent">215</span></td>
                            <td><span class="cellcontent">جون دو</span></td>
                            <td><span class="cellcontent">mail@mail.com</span></td>
                            <td><span class="cellcontent">خدمة عملاء</span></td>
                            <td><span class="cellcontent">0123456789</span></td>
                            <td><span class="cellcontent"><i class = "fa color--fadegreen fa-check"></i></span></td>
                            <td><span class="cellcontent">09-2015</span></td>
                            <td><span class="cellcontent">31-09-2017</span></td>
                            <td><span class="cellcontent"><a href= user_profile.html ,  class= "action-btn bgcolor--main color--white "><i class = "fa  fa-eye"></i></a><a href= users_list_edit.html ,  class= "action-btn bgcolor--fadegreen color--white "><i class = "fa  fa-pencil"></i></a><a href="#"  class= "btn-warning-confirm action-btn bgcolor--fadebrown color--white "><i class = "fa  fa-trash-o"></i></a></span></td>
                          </tr>
                          <tr>
                            <td><span class="cellcontent"><input type="checkbox" class="checkboxes" /></span></td>
                            <td><span class="cellcontent">215</span></td>
                            <td><span class="cellcontent">جون دو</span></td>
                            <td><span class="cellcontent">mail@mail.com</span></td>
                            <td><span class="cellcontent">خدمة عملاء</span></td>
                            <td><span class="cellcontent">0123456789</span></td>
                            <td><span class="cellcontent"><i class = "fa color--fadegreen fa-check"></i></span></td>
                            <td><span class="cellcontent">09-2015</span></td>
                            <td><span class="cellcontent">31-09-2017</span></td>
                            <td><span class="cellcontent"><a href= user_profile.html ,  class= "action-btn bgcolor--main color--white "><i class = "fa  fa-eye"></i></a><a href= users_list_edit.html ,  class= "action-btn bgcolor--fadegreen color--white "><i class = "fa  fa-pencil"></i></a><a href="#"  class= "btn-warning-confirm action-btn bgcolor--fadebrown color--white "><i class = "fa  fa-trash-o"></i></a></span></td>
                          </tr>
                          <tr>
                            <td><span class="cellcontent"><input type="checkbox" class="checkboxes" /></span></td>
                            <td><span class="cellcontent">215</span></td>
                            <td><span class="cellcontent">جون دو</span></td>
                            <td><span class="cellcontent">mail@mail.com</span></td>
                            <td><span class="cellcontent">خدمة عملاء</span></td>
                            <td><span class="cellcontent">0123456789</span></td>
                            <td><span class="cellcontent"><i class = "fa color--fadegreen fa-check"></i></span></td>
                            <td><span class="cellcontent">09-2015</span></td>
                            <td><span class="cellcontent">31-09-2017</span></td>
                            <td><span class="cellcontent"><a href= user_profile.html ,  class= "action-btn bgcolor--main color--white "><i class = "fa  fa-eye"></i></a><a href= users_list_edit.html ,  class= "action-btn bgcolor--fadegreen color--white "><i class = "fa  fa-pencil"></i></a><a href="#"  class= "btn-warning-confirm action-btn bgcolor--fadebrown color--white "><i class = "fa  fa-trash-o"></i></a></span></td>
                          </tr>
                          <tr>
                            <td><span class="cellcontent"><input type="checkbox" class="checkboxes" /></span></td>
                            <td><span class="cellcontent">215</span></td>
                            <td><span class="cellcontent">جون دو</span></td>
                            <td><span class="cellcontent">mail@mail.com</span></td>
                            <td><span class="cellcontent">خدمة عملاء</span></td>
                            <td><span class="cellcontent">0123456789</span></td>
                            <td><span class="cellcontent"><i class = "fa color--fadegreen fa-check"></i></span></td>
                            <td><span class="cellcontent">09-2015</span></td>
                            <td><span class="cellcontent">31-09-2017</span></td>
                            <td><span class="cellcontent"><a href= user_profile.html ,  class= "action-btn bgcolor--main color--white "><i class = "fa  fa-eye"></i></a><a href= users_list_edit.html ,  class= "action-btn bgcolor--fadegreen color--white "><i class = "fa  fa-pencil"></i></a><a href="#"  class= "btn-warning-confirm action-btn bgcolor--fadebrown color--white "><i class = "fa  fa-trash-o"></i></a></span></td>
                          </tr>
                          <tr>
                            <td><span class="cellcontent"><input type="checkbox" class="checkboxes" /></span></td>
                            <td><span class="cellcontent">215</span></td>
                            <td><span class="cellcontent">جون دو</span></td>
                            <td><span class="cellcontent">mail@mail.com</span></td>
                            <td><span class="cellcontent">خدمة عملاء</span></td>
                            <td><span class="cellcontent">0123456789</span></td>
                            <td><span class="cellcontent"><i class = "fa color--fadegreen fa-check"></i></span></td>
                            <td><span class="cellcontent">09-2015</span></td>
                            <td><span class="cellcontent">31-09-2017</span></td>
                            <td><span class="cellcontent"><a href= user_profile.html ,  class= "action-btn bgcolor--main color--white "><i class = "fa  fa-eye"></i></a><a href= users_list_edit.html ,  class= "action-btn bgcolor--fadegreen color--white "><i class = "fa  fa-pencil"></i></a><a href="#"  class= "btn-warning-confirm action-btn bgcolor--fadebrown color--white "><i class = "fa  fa-trash-o"></i></a></span></td>
                          </tr>
                          <tr>
                            <td><span class="cellcontent"><input type="checkbox" class="checkboxes" /></span></td>
                            <td><span class="cellcontent">215</span></td>
                            <td><span class="cellcontent">جون دو</span></td>
                            <td><span class="cellcontent">mail@mail.com</span></td>
                            <td><span class="cellcontent">خدمة عملاء</span></td>
                            <td><span class="cellcontent">0123456789</span></td>
                            <td><span class="cellcontent"><i class = "fa color--fadegreen fa-check"></i></span></td>
                            <td><span class="cellcontent">09-2015</span></td>
                            <td><span class="cellcontent">31-09-2017</span></td>
                            <td><span class="cellcontent"><a href= user_profile.html ,  class= "action-btn bgcolor--main color--white "><i class = "fa  fa-eye"></i></a><a href= users_list_edit.html ,  class= "action-btn bgcolor--fadegreen color--white "><i class = "fa  fa-pencil"></i></a><a href="#"  class= "btn-warning-confirm action-btn bgcolor--fadebrown color--white "><i class = "fa  fa-trash-o"></i></a></span></td>
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
                    </div>
                  </div>
                </div>
              </div>
            

 @endsection