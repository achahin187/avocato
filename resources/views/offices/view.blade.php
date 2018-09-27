 @extends('layout.app')             
 @section('content')

 <div class="row">
                <div class="col-lg-12">
                  <div class="coverglobal text-center bshadow--2" style="background:#000 url( '../img/covers/dummy2.jpg') no-repeat center center; background-size:cover"><span></span>
                    <div class="container">
                      <div class="row">
                        <div class="col-xs-12">
                          <div class="text-xs-center"><a href="user_profile.html"><img class="coverglobal__avatar" src="../img/avaters/male.jpg">
                              <h3 class="coverglobal__title color--gray_d">مكتب محمد احمد</h3><small class="coverglobal__slogan color--gray_d">مفعل</small></a></div>
                          <div class="coverglobal__actions"><a class="color--gray_d bordercolor-gray_d bradius--small border-btn master-btn" type="button" href="assign_lawyer_task.html">تعيين مهمة للمكتب</a><a class="color--gray_d bordercolor-gray_d bradius--small border-btn master-btn" type="button" href="users_list_edit.html">تعديل البيانات</a><a class="color--gray_d bordercolor-gray_d bradius--small border-btn master-btn" type="button" href="">استبعاد المكتب</a>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-lg-12">
                  <div class="cardwrap bgcolor--white bradius--noborder   bshadow--1 padding--small margin--small-top-bottom">
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <div class="row"><b class="col-md-3 col-sm-5 col-xs-12">عنوان المكتب</b>
                        <div class="col-md-9 col-sm-7 col-xs-12"> شارع 90 - التجمع الخامس</div>
                      </div>
                      <div class="row"><b class="col-md-3 col-sm-5 col-xs-12">رقم الهاتف</b>
                        <div class="col-md-9 col-sm-7 col-xs-12">9123489</div>
                      </div>
                      <div class="row"><b class="col-md-3 col-sm-5 col-xs-12">البريد الالكترونى</b>
                        <div class="col-md-9 col-sm-7 col-xs-12">mohamed@gmail.com</div>
                      </div>
                      <div class="row"><b class="col-md-3 col-sm-5 col-xs-12">العنوان</b>
                        <div class="col-md-9 col-sm-7 col-xs-12">55 شارع 99 المعادي</div>
                      </div>
                      <div class="row"><b class="col-md-3 col-sm-5 col-xs-12">المدينة</b>
                        <div class="col-md-9 col-sm-7 col-xs-12">القاهرة</div>
                      </div>
                      <div class="row"><b class="col-md-3 col-sm-5 col-xs-12">نبذة عن المكتب</b>
                        <div class="col-md-9 col-sm-7 col-xs-12">بعض النص</div>
                      </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12"><img class="img-responsive" src="https://www.taitradio.com/__data/assets/image/0016/114910/location-sol-header.jpg" height="140" width="450"></div>
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
                            <div class="col-md-2 col-sm-3 text-center"><img class="coverglobal__avatar img-responsive" src="../img/avaters/male.jpg"></div>
                            <div class="col-md-10 col-sm-9">
                              <div class="col-xs-6"><b class="col-xs-4">اسم الممثل القانوني</b>
                                <div class="col-xs-8"> محمد أحمد</div>
                              </div>
                              <div class="col-xs-6"><b class="col-xs-4"> تاريخ الميلاد</b>
                                <div class="col-xs-8">12/12/1950</div>
                              </div>
                              <div class="col-xs-6"><b class="col-xs-4">الرقم القومي</b>
                                <div class="col-xs-8">4849494665456465</div>
                              </div>
                              <div class="col-xs-6"><b class="col-xs-4">الجنسية</b>
                                <div class="col-xs-8">مصري</div>
                              </div>
                              <div class="col-xs-6"><b class="col-xs-4"> العنوان</b>
                                <div class="col-xs-8">55 شارع 9 - المقطم - القاهرة</div>
                              </div>
                              <div class="col-xs-6"><b class="col-xs-4">الاختصاص المكاني</b>
                                <div class="col-xs-8">القاهرة</div>
                              </div>
                              <div class="col-xs-6"><b class="col-xs-4">التخصص</b>
                                <div class="col-xs-8">عام</div>
                              </div>
                              <div class="col-xs-6"><b class="col-xs-4">درجة القيد بالنقابة</b>
                                <div class="col-xs-8">درجة</div>
                              </div>
                            </div>
                          </div>
                          <div class="col-sm-6">
                            <div class="cardwrap bgcolor--white bradius--noborder   bshadow--1 padding--small margin--small-top-bottom">
                              <div class="card--1"><a class="color--main"><img class="img-responsive bradius--noborder  " src="../imghttps://printifycards.com/assets/templates/40000_legal/100_legal/legal_015_1_f_black_large.jpg">
                                  <h4 class="text-center">كارنيه النقابة</h4></a></div>
                            </div>
                            <div class="clearfix"></div>
                          </div>
                          <div class="col-sm-6">
                            <div class="cardwrap bgcolor--white bradius--noborder   bshadow--1 padding--small margin--small-top-bottom">
                              <div class="card--1"><a class="color--main"><img class="img-responsive bradius--noborder  " src="../imghttps://printifycards.com/assets/templates/40000_legal/100_legal/legal_003_1_f_white_large.jpg">
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
                                    <h3>اضافة / تعديل فرع</h3>
                                    <div class="col-md-4 col-sm-6 col-xs-12">
                                      <div class="master_field">
                                        <label class="master_label mandatory" for="branch_name">اسم الفرع</label>
                                        <input class="master_input" type="text" placeholder="اسم الفرع..." id="branch_name"><span class="master_message color--fadegreen">message </span>
                                      </div>
                                    </div>
                                    <div class="col-md-4 col-sm-6 col-xs-12">
                                      <div class="master_field">
                                        <label class="master_label mandatory" for="branch_address">عنوان الفرع</label>
                                        <input class="master_input" type="text" placeholder="عنوان الفرع..." id="branch_address"><span class="master_message color--fadegreen">message </span>
                                      </div>
                                    </div>
                                    <div class="col-md-4 col-sm-6 col-xs-12">
                                      <div class="master_field">
                                        <label class="master_label mandatory" for="lawyer_type">الدولة</label>
                                        <select class="master_input" id="lawyer_type">
                                          <option>القاهرة</option>
                                          <option>الأسكندرية</option>
                                        </select><span class="master_message color--fadegreen">message</span>
                                      </div>
                                    </div>
                                    <div class="col-md-4 col-sm-6 col-xs-12">
                                      <div class="master_field">
                                        <label class="master_label mandatory" for="branch_city">المدينة </label>
                                        <input class="master_input" type="text" placeholder="المدينة .." id="branch_city"><span class="master_message color--fadegreen">message </span>
                                      </div>
                                    </div>
                                    <div class="col-md-4 col-sm-6 col-xs-12">
                                      <div class="master_field">
                                        <label class="master_label mandatory" for="branch_tel">رقم الهاتف</label>
                                        <input class="master_input" type="number" placeholder="رقم الهاتف" id="branch_tel"><span class="master_message color--fadegreen">message</span>
                                      </div>
                                    </div>
                                    <div class="col-md-4 col-sm-6 col-xs-12">
                                      <div class="master_field">
                                        <label class="master_label" for="branch_email">البريد الالكترونى</label>
                                        <input class="master_input" type="email" placeholder="البريد الالكترونى" id="branch_email"><span class="master_message color--fadegreen">message</span>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div><br>
                              <button class="remodal-cancel" data-remodal-action="cancel">إغلاق</button>
                              <button class="remodal-confirm" data-remodal-action="confirm">إضافة</button>
                            </div>
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
                              <tr>
                                <td><span class="cellcontent">فرع وسط البلد</span></td>
                                <td><span class="cellcontent"> 12312323 </span></td>
                                <td><span class="cellcontent">example@example.com</span></td>
                                <td><span class="cellcontent">55 شارع 9 المعادي</span></td>
                                <td><span class="cellcontent">مصر</span></td>
                                <td><span class="cellcontent">القاهرة</span></td>
                                <td><span class="cellcontent"><a href= #add_branch ,  class= "action-btn bgcolor--fadegreen color--white "><i class = "fa  fa-pencil"></i></a><a href="#"  class= "btn-warning-cancel action-btn bgcolor--fadebrown color--white "><i class = "fa  fa-trash-o"></i></a></span></td>
                              </tr>
                              <tr>
                                <td><span class="cellcontent">فرع وسط البلد</span></td>
                                <td><span class="cellcontent"> 12312323 </span></td>
                                <td><span class="cellcontent">example@example.com</span></td>
                                <td><span class="cellcontent">55 شارع 9 المعادي</span></td>
                                <td><span class="cellcontent">مصر</span></td>
                                <td><span class="cellcontent">القاهرة</span></td>
                                <td><span class="cellcontent"><a href= #add_branch ,  class= "action-btn bgcolor--fadegreen color--white "><i class = "fa  fa-pencil"></i></a><a href="#"  class= "btn-warning-cancel action-btn bgcolor--fadebrown color--white "><i class = "fa  fa-trash-o"></i></a></span></td>
                              </tr>
                              <tr>
                                <td><span class="cellcontent">فرع وسط البلد</span></td>
                                <td><span class="cellcontent"> 12312323 </span></td>
                                <td><span class="cellcontent">example@example.com</span></td>
                                <td><span class="cellcontent">55 شارع 9 المعادي</span></td>
                                <td><span class="cellcontent">مصر</span></td>
                                <td><span class="cellcontent">القاهرة</span></td>
                                <td><span class="cellcontent"><a href= #add_branch ,  class= "action-btn bgcolor--fadegreen color--white "><i class = "fa  fa-pencil"></i></a><a href="#"  class= "btn-warning-cancel action-btn bgcolor--fadebrown color--white "><i class = "fa  fa-trash-o"></i></a></span></td>
                              </tr>
                              <tr>
                                <td><span class="cellcontent">فرع وسط البلد</span></td>
                                <td><span class="cellcontent"> 12312323 </span></td>
                                <td><span class="cellcontent">example@example.com</span></td>
                                <td><span class="cellcontent">55 شارع 9 المعادي</span></td>
                                <td><span class="cellcontent">مصر</span></td>
                                <td><span class="cellcontent">القاهرة</span></td>
                                <td><span class="cellcontent"><a href= #add_branch ,  class= "action-btn bgcolor--fadegreen color--white "><i class = "fa  fa-pencil"></i></a><a href="#"  class= "btn-warning-cancel action-btn bgcolor--fadebrown color--white "><i class = "fa  fa-trash-o"></i></a></span></td>
                              </tr>
                              <tr>
                                <td><span class="cellcontent">فرع وسط البلد</span></td>
                                <td><span class="cellcontent"> 12312323 </span></td>
                                <td><span class="cellcontent">example@example.com</span></td>
                                <td><span class="cellcontent">55 شارع 9 المعادي</span></td>
                                <td><span class="cellcontent">مصر</span></td>
                                <td><span class="cellcontent">القاهرة</span></td>
                                <td><span class="cellcontent"><a href= #add_branch ,  class= "action-btn bgcolor--fadegreen color--white "><i class = "fa  fa-pencil"></i></a><a href="#"  class= "btn-warning-cancel action-btn bgcolor--fadebrown color--white "><i class = "fa  fa-trash-o"></i></a></span></td>
                              </tr>
                              <tr>
                                <td><span class="cellcontent">فرع وسط البلد</span></td>
                                <td><span class="cellcontent"> 12312323 </span></td>
                                <td><span class="cellcontent">example@example.com</span></td>
                                <td><span class="cellcontent">55 شارع 9 المعادي</span></td>
                                <td><span class="cellcontent">مصر</span></td>
                                <td><span class="cellcontent">القاهرة</span></td>
                                <td><span class="cellcontent"><a href= #add_branch ,  class= "action-btn bgcolor--fadegreen color--white "><i class = "fa  fa-pencil"></i></a><a href="#"  class= "btn-warning-cancel action-btn bgcolor--fadebrown color--white "><i class = "fa  fa-trash-o"></i></a></span></td>
                              </tr>
                              <tr>
                                <td><span class="cellcontent">فرع وسط البلد</span></td>
                                <td><span class="cellcontent"> 12312323 </span></td>
                                <td><span class="cellcontent">example@example.com</span></td>
                                <td><span class="cellcontent">55 شارع 9 المعادي</span></td>
                                <td><span class="cellcontent">مصر</span></td>
                                <td><span class="cellcontent">القاهرة</span></td>
                                <td><span class="cellcontent"><a href= #add_branch ,  class= "action-btn bgcolor--fadegreen color--white "><i class = "fa  fa-pencil"></i></a><a href="#"  class= "btn-warning-cancel action-btn bgcolor--fadebrown color--white "><i class = "fa  fa-trash-o"></i></a></span></td>
                              </tr>
                              <tr>
                                <td><span class="cellcontent">فرع وسط البلد</span></td>
                                <td><span class="cellcontent"> 12312323 </span></td>
                                <td><span class="cellcontent">example@example.com</span></td>
                                <td><span class="cellcontent">55 شارع 9 المعادي</span></td>
                                <td><span class="cellcontent">مصر</span></td>
                                <td><span class="cellcontent">القاهرة</span></td>
                                <td><span class="cellcontent"><a href= #add_branch ,  class= "action-btn bgcolor--fadegreen color--white "><i class = "fa  fa-pencil"></i></a><a href="#"  class= "btn-warning-cancel action-btn bgcolor--fadebrown color--white "><i class = "fa  fa-trash-o"></i></a></span></td>
                              </tr>
                              <tr>
                                <td><span class="cellcontent">فرع وسط البلد</span></td>
                                <td><span class="cellcontent"> 12312323 </span></td>
                                <td><span class="cellcontent">example@example.com</span></td>
                                <td><span class="cellcontent">55 شارع 9 المعادي</span></td>
                                <td><span class="cellcontent">مصر</span></td>
                                <td><span class="cellcontent">القاهرة</span></td>
                                <td><span class="cellcontent"><a href= #add_branch ,  class= "action-btn bgcolor--fadegreen color--white "><i class = "fa  fa-pencil"></i></a><a href="#"  class= "btn-warning-cancel action-btn bgcolor--fadebrown color--white "><i class = "fa  fa-trash-o"></i></a></span></td>
                              </tr>
                              <tr>
                                <td><span class="cellcontent">فرع وسط البلد</span></td>
                                <td><span class="cellcontent"> 12312323 </span></td>
                                <td><span class="cellcontent">example@example.com</span></td>
                                <td><span class="cellcontent">55 شارع 9 المعادي</span></td>
                                <td><span class="cellcontent">مصر</span></td>
                                <td><span class="cellcontent">القاهرة</span></td>
                                <td><span class="cellcontent"><a href= #add_branch ,  class= "action-btn bgcolor--fadegreen color--white "><i class = "fa  fa-pencil"></i></a><a href="#"  class= "btn-warning-cancel action-btn bgcolor--fadebrown color--white "><i class = "fa  fa-trash-o"></i></a></span></td>
                              </tr>
                              <tr>
                                <td><span class="cellcontent">فرع وسط البلد</span></td>
                                <td><span class="cellcontent"> 12312323 </span></td>
                                <td><span class="cellcontent">example@example.com</span></td>
                                <td><span class="cellcontent">55 شارع 9 المعادي</span></td>
                                <td><span class="cellcontent">مصر</span></td>
                                <td><span class="cellcontent">القاهرة</span></td>
                                <td><span class="cellcontent"><a href= #add_branch ,  class= "action-btn bgcolor--fadegreen color--white "><i class = "fa  fa-pencil"></i></a><a href="#"  class= "btn-warning-cancel action-btn bgcolor--fadebrown color--white "><i class = "fa  fa-trash-o"></i></a></span></td>
                              </tr>
                              <tr>
                                <td><span class="cellcontent">فرع وسط البلد</span></td>
                                <td><span class="cellcontent"> 12312323 </span></td>
                                <td><span class="cellcontent">example@example.com</span></td>
                                <td><span class="cellcontent">55 شارع 9 المعادي</span></td>
                                <td><span class="cellcontent">مصر</span></td>
                                <td><span class="cellcontent">القاهرة</span></td>
                                <td><span class="cellcontent"><a href= #add_branch ,  class= "action-btn bgcolor--fadegreen color--white "><i class = "fa  fa-pencil"></i></a><a href="#"  class= "btn-warning-cancel action-btn bgcolor--fadebrown color--white "><i class = "fa  fa-trash-o"></i></a></span></td>
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
                      </li>
                      <li class="tab__content_item">
                        <div class="col-lg-12">
                          <div class="panel panel-default">
                            <div class="panel-heading" id="heading-1" role="tab">
                              <h4 class="panel-title bgcolor--main_l bradius--noborder bshadow--1 padding--small margin--small-top-bottom"><a class="trigger color--white" role="button" data-toggle="collapse" href="#collapse-1" aria-expanded="true" aria-controls="collapse-1">
                                  <div class="col-xs-11">الاسبوع من الأحد 4-2-2018 الى الخميس 8-2-2018<span class="pull-right color--fadeorange">4 مهمات</span></div>
                                  <div class="clearfix"></div></a></h4>
                            </div>
                          </div>
                          <div class="panel-collapse show collapse" id="collapse-1" role="tabpanel" aria-labelledby="heading-1" aria-expanded="true">
                            <div class="panel-body bgcolor--white bradius--noborder bshadow--1 padding--small margin--small-top-bottom">
                              <div class="col-md-12 right-text"><span class="bgcolor--main_l color--white bradius--small importance padding--small">جلسة محكمة</span>	&nbsp;<a href="case_view.html">اسم القضية</a>
                                <div class="pull-right">
                                  <label class="data-label-round bgcolor--fadegreen color--white">4-2-2018</label>
                                </div>
                              </div>
                              <div class="clearfix"></div>
                              <hr>
                              <div class="col-md-12 right-text"><span class="bgcolor--main_l color--white bradius--small importance padding--small">خدمة</span>	&nbsp;<a href="service_view.html">اسم الخدمة</a>
                                <div class="pull-right">
                                  <label class="data-label-round bgcolor--fadegreen color--white">6-2-2018</label>
                                </div>
                              </div>
                              <div class="clearfix"></div>
                              <hr>
                              <div class="col-md-12 right-text"><span class="bgcolor--main_l color--white bradius--small importance padding--small">استشارة قانونية</span>	&nbsp;<a href="legal_consultation_view.html">عنوان الإستشارة</a>
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
                              <div class="col-md-12 right-text"><span class="bgcolor--main_l color--white bradius--small importance padding--small">جلسة محكمة</span>	&nbsp;<a href="case_view.html">اسم القضية</a>
                                <div class="pull-right">
                                  <label class="data-label-round bgcolor--fadegreen color--white">4-2-2018</label>
                                </div>
                              </div>
                              <div class="clearfix"></div>
                              <hr>
                              <div class="col-md-12 right-text"><span class="bgcolor--main_l color--white bradius--small importance padding--small">خدمة</span>	&nbsp;<a href="service_view.html">اسم الخدمة</a>
                                <div class="pull-right">
                                  <label class="data-label-round bgcolor--fadegreen color--white">6-2-2018</label>
                                </div>
                              </div>
                              <div class="clearfix"></div>
                              <hr>
                              <div class="col-md-12 right-text"><span class="bgcolor--main_l color--white bradius--small importance padding--small">استشارة قانونية</span>	&nbsp;<a href="legal_consultation_view.html">عنوان الإستشارة</a>
                                <div class="pull-right">
                                  <label class="data-label-round bgcolor--fadegreen color--white">4-2-2018</label>
                                </div>
                              </div>
                              <div class="clearfix"></div>
                            </div>
                          </div>
                        </div>
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
                                <th><span class="cellcontent">رقم التوكيل</span></th>
                                <th><span class="cellcontent">الإجراءات</span></th>
                              </tr>
                            </thead>
                            <tbody>
                              <tr>
                                <td><span class="cellcontent"><input type="checkbox" class="checkboxes" /></span></td>
                                <td><span class="cellcontent">جنايات</span></td>
                                <td><span class="cellcontent">اسم المحكمة</span></td>
                                <td><span class="cellcontent">اسم الدائرة</span></td>
                                <td><span class="cellcontent">100230</span></td>
                                <td><span class="cellcontent">2017</span></td>
                                <td><span class="cellcontent">29-10-2019</span></td>
                                <td><span class="cellcontent">100900</span></td>
                                <td><span class="cellcontent">400910</span></td>
                                <td><span class="cellcontent"><a href= case_view.html ,  class= "action-btn bgcolor--main color--white "><i class = "fa  fa-eye"></i></a><a href= newlink.html ,  class= "action-btn bgcolor--fadegreen color--white "><i class = "fa  fa-pencil"></i></a><a href="#"  class= "btn-warning-cancel action-btn bgcolor--fadebrown color--white "><i class = "fa  fa-trash-o"></i></a></span></td>
                              </tr>
                              <tr>
                                <td><span class="cellcontent"><input type="checkbox" class="checkboxes" /></span></td>
                                <td><span class="cellcontent">جنايات</span></td>
                                <td><span class="cellcontent">اسم المحكمة</span></td>
                                <td><span class="cellcontent">اسم الدائرة</span></td>
                                <td><span class="cellcontent">100230</span></td>
                                <td><span class="cellcontent">2017</span></td>
                                <td><span class="cellcontent">29-10-2019</span></td>
                                <td><span class="cellcontent">100900</span></td>
                                <td><span class="cellcontent">400910</span></td>
                                <td><span class="cellcontent"><a href= case_view.html ,  class= "action-btn bgcolor--main color--white "><i class = "fa  fa-eye"></i></a><a href= newlink.html ,  class= "action-btn bgcolor--fadegreen color--white "><i class = "fa  fa-pencil"></i></a><a href="#"  class= "btn-warning-cancel action-btn bgcolor--fadebrown color--white "><i class = "fa  fa-trash-o"></i></a></span></td>
                              </tr>
                              <tr>
                                <td><span class="cellcontent"><input type="checkbox" class="checkboxes" /></span></td>
                                <td><span class="cellcontent">جنايات</span></td>
                                <td><span class="cellcontent">اسم المحكمة</span></td>
                                <td><span class="cellcontent">اسم الدائرة</span></td>
                                <td><span class="cellcontent">100230</span></td>
                                <td><span class="cellcontent">2017</span></td>
                                <td><span class="cellcontent">29-10-2019</span></td>
                                <td><span class="cellcontent">100900</span></td>
                                <td><span class="cellcontent">400910</span></td>
                                <td><span class="cellcontent"><a href= case_view.html ,  class= "action-btn bgcolor--main color--white "><i class = "fa  fa-eye"></i></a><a href= newlink.html ,  class= "action-btn bgcolor--fadegreen color--white "><i class = "fa  fa-pencil"></i></a><a href="#"  class= "btn-warning-cancel action-btn bgcolor--fadebrown color--white "><i class = "fa  fa-trash-o"></i></a></span></td>
                              </tr>
                              <tr>
                                <td><span class="cellcontent"><input type="checkbox" class="checkboxes" /></span></td>
                                <td><span class="cellcontent">جنايات</span></td>
                                <td><span class="cellcontent">اسم المحكمة</span></td>
                                <td><span class="cellcontent">اسم الدائرة</span></td>
                                <td><span class="cellcontent">100230</span></td>
                                <td><span class="cellcontent">2017</span></td>
                                <td><span class="cellcontent">29-10-2019</span></td>
                                <td><span class="cellcontent">100900</span></td>
                                <td><span class="cellcontent">400910</span></td>
                                <td><span class="cellcontent"><a href= case_view.html ,  class= "action-btn bgcolor--main color--white "><i class = "fa  fa-eye"></i></a><a href= newlink.html ,  class= "action-btn bgcolor--fadegreen color--white "><i class = "fa  fa-pencil"></i></a><a href="#"  class= "btn-warning-cancel action-btn bgcolor--fadebrown color--white "><i class = "fa  fa-trash-o"></i></a></span></td>
                              </tr>
                              <tr>
                                <td><span class="cellcontent"><input type="checkbox" class="checkboxes" /></span></td>
                                <td><span class="cellcontent">جنايات</span></td>
                                <td><span class="cellcontent">اسم المحكمة</span></td>
                                <td><span class="cellcontent">اسم الدائرة</span></td>
                                <td><span class="cellcontent">100230</span></td>
                                <td><span class="cellcontent">2017</span></td>
                                <td><span class="cellcontent">29-10-2019</span></td>
                                <td><span class="cellcontent">100900</span></td>
                                <td><span class="cellcontent">400910</span></td>
                                <td><span class="cellcontent"><a href= case_view.html ,  class= "action-btn bgcolor--main color--white "><i class = "fa  fa-eye"></i></a><a href= newlink.html ,  class= "action-btn bgcolor--fadegreen color--white "><i class = "fa  fa-pencil"></i></a><a href="#"  class= "btn-warning-cancel action-btn bgcolor--fadebrown color--white "><i class = "fa  fa-trash-o"></i></a></span></td>
                              </tr>
                              <tr>
                                <td><span class="cellcontent"><input type="checkbox" class="checkboxes" /></span></td>
                                <td><span class="cellcontent">جنايات</span></td>
                                <td><span class="cellcontent">اسم المحكمة</span></td>
                                <td><span class="cellcontent">اسم الدائرة</span></td>
                                <td><span class="cellcontent">100230</span></td>
                                <td><span class="cellcontent">2017</span></td>
                                <td><span class="cellcontent">29-10-2019</span></td>
                                <td><span class="cellcontent">100900</span></td>
                                <td><span class="cellcontent">400910</span></td>
                                <td><span class="cellcontent"><a href= case_view.html ,  class= "action-btn bgcolor--main color--white "><i class = "fa  fa-eye"></i></a><a href= newlink.html ,  class= "action-btn bgcolor--fadegreen color--white "><i class = "fa  fa-pencil"></i></a><a href="#"  class= "btn-warning-cancel action-btn bgcolor--fadebrown color--white "><i class = "fa  fa-trash-o"></i></a></span></td>
                              </tr>
                              <tr>
                                <td><span class="cellcontent"><input type="checkbox" class="checkboxes" /></span></td>
                                <td><span class="cellcontent">جنايات</span></td>
                                <td><span class="cellcontent">اسم المحكمة</span></td>
                                <td><span class="cellcontent">اسم الدائرة</span></td>
                                <td><span class="cellcontent">100230</span></td>
                                <td><span class="cellcontent">2017</span></td>
                                <td><span class="cellcontent">29-10-2019</span></td>
                                <td><span class="cellcontent">100900</span></td>
                                <td><span class="cellcontent">400910</span></td>
                                <td><span class="cellcontent"><a href= case_view.html ,  class= "action-btn bgcolor--main color--white "><i class = "fa  fa-eye"></i></a><a href= newlink.html ,  class= "action-btn bgcolor--fadegreen color--white "><i class = "fa  fa-pencil"></i></a><a href="#"  class= "btn-warning-cancel action-btn bgcolor--fadebrown color--white "><i class = "fa  fa-trash-o"></i></a></span></td>
                              </tr>
                              <tr>
                                <td><span class="cellcontent"><input type="checkbox" class="checkboxes" /></span></td>
                                <td><span class="cellcontent">جنايات</span></td>
                                <td><span class="cellcontent">اسم المحكمة</span></td>
                                <td><span class="cellcontent">اسم الدائرة</span></td>
                                <td><span class="cellcontent">100230</span></td>
                                <td><span class="cellcontent">2017</span></td>
                                <td><span class="cellcontent">29-10-2019</span></td>
                                <td><span class="cellcontent">100900</span></td>
                                <td><span class="cellcontent">400910</span></td>
                                <td><span class="cellcontent"><a href= case_view.html ,  class= "action-btn bgcolor--main color--white "><i class = "fa  fa-eye"></i></a><a href= newlink.html ,  class= "action-btn bgcolor--fadegreen color--white "><i class = "fa  fa-pencil"></i></a><a href="#"  class= "btn-warning-cancel action-btn bgcolor--fadebrown color--white "><i class = "fa  fa-trash-o"></i></a></span></td>
                              </tr>
                              <tr>
                                <td><span class="cellcontent"><input type="checkbox" class="checkboxes" /></span></td>
                                <td><span class="cellcontent">جنايات</span></td>
                                <td><span class="cellcontent">اسم المحكمة</span></td>
                                <td><span class="cellcontent">اسم الدائرة</span></td>
                                <td><span class="cellcontent">100230</span></td>
                                <td><span class="cellcontent">2017</span></td>
                                <td><span class="cellcontent">29-10-2019</span></td>
                                <td><span class="cellcontent">100900</span></td>
                                <td><span class="cellcontent">400910</span></td>
                                <td><span class="cellcontent"><a href= case_view.html ,  class= "action-btn bgcolor--main color--white "><i class = "fa  fa-eye"></i></a><a href= newlink.html ,  class= "action-btn bgcolor--fadegreen color--white "><i class = "fa  fa-pencil"></i></a><a href="#"  class= "btn-warning-cancel action-btn bgcolor--fadebrown color--white "><i class = "fa  fa-trash-o"></i></a></span></td>
                              </tr>
                              <tr>
                                <td><span class="cellcontent"><input type="checkbox" class="checkboxes" /></span></td>
                                <td><span class="cellcontent">جنايات</span></td>
                                <td><span class="cellcontent">اسم المحكمة</span></td>
                                <td><span class="cellcontent">اسم الدائرة</span></td>
                                <td><span class="cellcontent">100230</span></td>
                                <td><span class="cellcontent">2017</span></td>
                                <td><span class="cellcontent">29-10-2019</span></td>
                                <td><span class="cellcontent">100900</span></td>
                                <td><span class="cellcontent">400910</span></td>
                                <td><span class="cellcontent"><a href= case_view.html ,  class= "action-btn bgcolor--main color--white "><i class = "fa  fa-eye"></i></a><a href= newlink.html ,  class= "action-btn bgcolor--fadegreen color--white "><i class = "fa  fa-pencil"></i></a><a href="#"  class= "btn-warning-cancel action-btn bgcolor--fadebrown color--white "><i class = "fa  fa-trash-o"></i></a></span></td>
                              </tr>
                              <tr>
                                <td><span class="cellcontent"><input type="checkbox" class="checkboxes" /></span></td>
                                <td><span class="cellcontent">جنايات</span></td>
                                <td><span class="cellcontent">اسم المحكمة</span></td>
                                <td><span class="cellcontent">اسم الدائرة</span></td>
                                <td><span class="cellcontent">100230</span></td>
                                <td><span class="cellcontent">2017</span></td>
                                <td><span class="cellcontent">29-10-2019</span></td>
                                <td><span class="cellcontent">100900</span></td>
                                <td><span class="cellcontent">400910</span></td>
                                <td><span class="cellcontent"><a href= case_view.html ,  class= "action-btn bgcolor--main color--white "><i class = "fa  fa-eye"></i></a><a href= newlink.html ,  class= "action-btn bgcolor--fadegreen color--white "><i class = "fa  fa-pencil"></i></a><a href="#"  class= "btn-warning-cancel action-btn bgcolor--fadebrown color--white "><i class = "fa  fa-trash-o"></i></a></span></td>
                              </tr>
                              <tr>
                                <td><span class="cellcontent"><input type="checkbox" class="checkboxes" /></span></td>
                                <td><span class="cellcontent">جنايات</span></td>
                                <td><span class="cellcontent">اسم المحكمة</span></td>
                                <td><span class="cellcontent">اسم الدائرة</span></td>
                                <td><span class="cellcontent">100230</span></td>
                                <td><span class="cellcontent">2017</span></td>
                                <td><span class="cellcontent">29-10-2019</span></td>
                                <td><span class="cellcontent">100900</span></td>
                                <td><span class="cellcontent">400910</span></td>
                                <td><span class="cellcontent"><a href= case_view.html ,  class= "action-btn bgcolor--main color--white "><i class = "fa  fa-eye"></i></a><a href= newlink.html ,  class= "action-btn bgcolor--fadegreen color--white "><i class = "fa  fa-pencil"></i></a><a href="#"  class= "btn-warning-cancel action-btn bgcolor--fadebrown color--white "><i class = "fa  fa-trash-o"></i></a></span></td>
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
                              <tr>
                                <td><span class="cellcontent"><input type="checkbox" class="checkboxes" /></span></td>
                                <td><span class="cellcontent">20122</span></td>
                                <td><span class="cellcontent">محمد محمود السيد</span></td>
                                <td><span class="cellcontent">24 شارع 90 - التجمع الخامس</span></td>
                                <td><span class="cellcontent">نوع الخدمة</span></td>
                                <td><span class="cellcontent"><i class = "fa color--fadegreen fa-check"></i></span></td>
                                <td><span class="cellcontent"><a href= service_view.html ,  class= "action-btn bgcolor--main color--white "><i class = "fa  fa-eye"></i></a><a href= newlink.html ,  class= "action-btn bgcolor--fadegreen color--white "><i class = "fa  fa-pencil"></i></a><a href="#"  class= "btn-warning-cancel action-btn bgcolor--fadebrown color--white "><i class = "fa  fa-trash-o"></i></a></span></td>
                              </tr>
                              <tr>
                                <td><span class="cellcontent"><input type="checkbox" class="checkboxes" /></span></td>
                                <td><span class="cellcontent">20122</span></td>
                                <td><span class="cellcontent">محمد محمود السيد</span></td>
                                <td><span class="cellcontent">24 شارع 90 - التجمع الخامس</span></td>
                                <td><span class="cellcontent">نوع الخدمة</span></td>
                                <td><span class="cellcontent"><i class = "fa color--fadegreen fa-check"></i></span></td>
                                <td><span class="cellcontent"><a href= service_view.html ,  class= "action-btn bgcolor--main color--white "><i class = "fa  fa-eye"></i></a><a href= newlink.html ,  class= "action-btn bgcolor--fadegreen color--white "><i class = "fa  fa-pencil"></i></a><a href="#"  class= "btn-warning-cancel action-btn bgcolor--fadebrown color--white "><i class = "fa  fa-trash-o"></i></a></span></td>
                              </tr>
                              <tr>
                                <td><span class="cellcontent"><input type="checkbox" class="checkboxes" /></span></td>
                                <td><span class="cellcontent">20122</span></td>
                                <td><span class="cellcontent">محمد محمود السيد</span></td>
                                <td><span class="cellcontent">24 شارع 90 - التجمع الخامس</span></td>
                                <td><span class="cellcontent">نوع الخدمة</span></td>
                                <td><span class="cellcontent"><i class = "fa color--fadegreen fa-check"></i></span></td>
                                <td><span class="cellcontent"><a href= service_view.html ,  class= "action-btn bgcolor--main color--white "><i class = "fa  fa-eye"></i></a><a href= newlink.html ,  class= "action-btn bgcolor--fadegreen color--white "><i class = "fa  fa-pencil"></i></a><a href="#"  class= "btn-warning-cancel action-btn bgcolor--fadebrown color--white "><i class = "fa  fa-trash-o"></i></a></span></td>
                              </tr>
                              <tr>
                                <td><span class="cellcontent"><input type="checkbox" class="checkboxes" /></span></td>
                                <td><span class="cellcontent">20122</span></td>
                                <td><span class="cellcontent">محمد محمود السيد</span></td>
                                <td><span class="cellcontent">24 شارع 90 - التجمع الخامس</span></td>
                                <td><span class="cellcontent">نوع الخدمة</span></td>
                                <td><span class="cellcontent"><i class = "fa color--fadegreen fa-check"></i></span></td>
                                <td><span class="cellcontent"><a href= service_view.html ,  class= "action-btn bgcolor--main color--white "><i class = "fa  fa-eye"></i></a><a href= newlink.html ,  class= "action-btn bgcolor--fadegreen color--white "><i class = "fa  fa-pencil"></i></a><a href="#"  class= "btn-warning-cancel action-btn bgcolor--fadebrown color--white "><i class = "fa  fa-trash-o"></i></a></span></td>
                              </tr>
                              <tr>
                                <td><span class="cellcontent"><input type="checkbox" class="checkboxes" /></span></td>
                                <td><span class="cellcontent">20122</span></td>
                                <td><span class="cellcontent">محمد محمود السيد</span></td>
                                <td><span class="cellcontent">24 شارع 90 - التجمع الخامس</span></td>
                                <td><span class="cellcontent">نوع الخدمة</span></td>
                                <td><span class="cellcontent"><i class = "fa color--fadegreen fa-check"></i></span></td>
                                <td><span class="cellcontent"><a href= service_view.html ,  class= "action-btn bgcolor--main color--white "><i class = "fa  fa-eye"></i></a><a href= newlink.html ,  class= "action-btn bgcolor--fadegreen color--white "><i class = "fa  fa-pencil"></i></a><a href="#"  class= "btn-warning-cancel action-btn bgcolor--fadebrown color--white "><i class = "fa  fa-trash-o"></i></a></span></td>
                              </tr>
                              <tr>
                                <td><span class="cellcontent"><input type="checkbox" class="checkboxes" /></span></td>
                                <td><span class="cellcontent">20122</span></td>
                                <td><span class="cellcontent">محمد محمود السيد</span></td>
                                <td><span class="cellcontent">24 شارع 90 - التجمع الخامس</span></td>
                                <td><span class="cellcontent">نوع الخدمة</span></td>
                                <td><span class="cellcontent"><i class = "fa color--fadegreen fa-check"></i></span></td>
                                <td><span class="cellcontent"><a href= service_view.html ,  class= "action-btn bgcolor--main color--white "><i class = "fa  fa-eye"></i></a><a href= newlink.html ,  class= "action-btn bgcolor--fadegreen color--white "><i class = "fa  fa-pencil"></i></a><a href="#"  class= "btn-warning-cancel action-btn bgcolor--fadebrown color--white "><i class = "fa  fa-trash-o"></i></a></span></td>
                              </tr>
                              <tr>
                                <td><span class="cellcontent"><input type="checkbox" class="checkboxes" /></span></td>
                                <td><span class="cellcontent">20122</span></td>
                                <td><span class="cellcontent">محمد محمود السيد</span></td>
                                <td><span class="cellcontent">24 شارع 90 - التجمع الخامس</span></td>
                                <td><span class="cellcontent">نوع الخدمة</span></td>
                                <td><span class="cellcontent"><i class = "fa color--fadegreen fa-check"></i></span></td>
                                <td><span class="cellcontent"><a href= service_view.html ,  class= "action-btn bgcolor--main color--white "><i class = "fa  fa-eye"></i></a><a href= newlink.html ,  class= "action-btn bgcolor--fadegreen color--white "><i class = "fa  fa-pencil"></i></a><a href="#"  class= "btn-warning-cancel action-btn bgcolor--fadebrown color--white "><i class = "fa  fa-trash-o"></i></a></span></td>
                              </tr>
                              <tr>
                                <td><span class="cellcontent"><input type="checkbox" class="checkboxes" /></span></td>
                                <td><span class="cellcontent">20122</span></td>
                                <td><span class="cellcontent">محمد محمود السيد</span></td>
                                <td><span class="cellcontent">24 شارع 90 - التجمع الخامس</span></td>
                                <td><span class="cellcontent">نوع الخدمة</span></td>
                                <td><span class="cellcontent"><i class = "fa color--fadegreen fa-check"></i></span></td>
                                <td><span class="cellcontent"><a href= service_view.html ,  class= "action-btn bgcolor--main color--white "><i class = "fa  fa-eye"></i></a><a href= newlink.html ,  class= "action-btn bgcolor--fadegreen color--white "><i class = "fa  fa-pencil"></i></a><a href="#"  class= "btn-warning-cancel action-btn bgcolor--fadebrown color--white "><i class = "fa  fa-trash-o"></i></a></span></td>
                              </tr>
                              <tr>
                                <td><span class="cellcontent"><input type="checkbox" class="checkboxes" /></span></td>
                                <td><span class="cellcontent">20122</span></td>
                                <td><span class="cellcontent">محمد محمود السيد</span></td>
                                <td><span class="cellcontent">24 شارع 90 - التجمع الخامس</span></td>
                                <td><span class="cellcontent">نوع الخدمة</span></td>
                                <td><span class="cellcontent"><i class = "fa color--fadegreen fa-check"></i></span></td>
                                <td><span class="cellcontent"><a href= service_view.html ,  class= "action-btn bgcolor--main color--white "><i class = "fa  fa-eye"></i></a><a href= newlink.html ,  class= "action-btn bgcolor--fadegreen color--white "><i class = "fa  fa-pencil"></i></a><a href="#"  class= "btn-warning-cancel action-btn bgcolor--fadebrown color--white "><i class = "fa  fa-trash-o"></i></a></span></td>
                              </tr>
                              <tr>
                                <td><span class="cellcontent"><input type="checkbox" class="checkboxes" /></span></td>
                                <td><span class="cellcontent">20122</span></td>
                                <td><span class="cellcontent">محمد محمود السيد</span></td>
                                <td><span class="cellcontent">24 شارع 90 - التجمع الخامس</span></td>
                                <td><span class="cellcontent">نوع الخدمة</span></td>
                                <td><span class="cellcontent"><i class = "fa color--fadegreen fa-check"></i></span></td>
                                <td><span class="cellcontent"><a href= service_view.html ,  class= "action-btn bgcolor--main color--white "><i class = "fa  fa-eye"></i></a><a href= newlink.html ,  class= "action-btn bgcolor--fadegreen color--white "><i class = "fa  fa-pencil"></i></a><a href="#"  class= "btn-warning-cancel action-btn bgcolor--fadebrown color--white "><i class = "fa  fa-trash-o"></i></a></span></td>
                              </tr>
                              <tr>
                                <td><span class="cellcontent"><input type="checkbox" class="checkboxes" /></span></td>
                                <td><span class="cellcontent">20122</span></td>
                                <td><span class="cellcontent">محمد محمود السيد</span></td>
                                <td><span class="cellcontent">24 شارع 90 - التجمع الخامس</span></td>
                                <td><span class="cellcontent">نوع الخدمة</span></td>
                                <td><span class="cellcontent"><i class = "fa color--fadegreen fa-check"></i></span></td>
                                <td><span class="cellcontent"><a href= service_view.html ,  class= "action-btn bgcolor--main color--white "><i class = "fa  fa-eye"></i></a><a href= newlink.html ,  class= "action-btn bgcolor--fadegreen color--white "><i class = "fa  fa-pencil"></i></a><a href="#"  class= "btn-warning-cancel action-btn bgcolor--fadebrown color--white "><i class = "fa  fa-trash-o"></i></a></span></td>
                              </tr>
                              <tr>
                                <td><span class="cellcontent"><input type="checkbox" class="checkboxes" /></span></td>
                                <td><span class="cellcontent">20122</span></td>
                                <td><span class="cellcontent">محمد محمود السيد</span></td>
                                <td><span class="cellcontent">24 شارع 90 - التجمع الخامس</span></td>
                                <td><span class="cellcontent">نوع الخدمة</span></td>
                                <td><span class="cellcontent"><i class = "fa color--fadegreen fa-check"></i></span></td>
                                <td><span class="cellcontent"><a href= service_view.html ,  class= "action-btn bgcolor--main color--white "><i class = "fa  fa-eye"></i></a><a href= newlink.html ,  class= "action-btn bgcolor--fadegreen color--white "><i class = "fa  fa-pencil"></i></a><a href="#"  class= "btn-warning-cancel action-btn bgcolor--fadebrown color--white "><i class = "fa  fa-trash-o"></i></a></span></td>
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
                              <tr>
                                <td><span class="cellcontent">20-11-2017</span></td>
                                <td><span class="cellcontent">10290</span></td>
                                <td><span class="cellcontent">بعض النص بعض النص </span></td>
                              </tr>
                              <tr>
                                <td><span class="cellcontent">20-11-2017</span></td>
                                <td><span class="cellcontent">10290</span></td>
                                <td><span class="cellcontent">بعض النص بعض النص </span></td>
                              </tr>
                              <tr>
                                <td><span class="cellcontent">20-11-2017</span></td>
                                <td><span class="cellcontent">10290</span></td>
                                <td><span class="cellcontent">بعض النص بعض النص </span></td>
                              </tr>
                              <tr>
                                <td><span class="cellcontent">20-11-2017</span></td>
                                <td><span class="cellcontent">10290</span></td>
                                <td><span class="cellcontent">بعض النص بعض النص </span></td>
                              </tr>
                              <tr>
                                <td><span class="cellcontent">20-11-2017</span></td>
                                <td><span class="cellcontent">10290</span></td>
                                <td><span class="cellcontent">بعض النص بعض النص </span></td>
                              </tr>
                              <tr>
                                <td><span class="cellcontent">20-11-2017</span></td>
                                <td><span class="cellcontent">10290</span></td>
                                <td><span class="cellcontent">بعض النص بعض النص </span></td>
                              </tr>
                              <tr>
                                <td><span class="cellcontent">20-11-2017</span></td>
                                <td><span class="cellcontent">10290</span></td>
                                <td><span class="cellcontent">بعض النص بعض النص </span></td>
                              </tr>
                              <tr>
                                <td><span class="cellcontent">20-11-2017</span></td>
                                <td><span class="cellcontent">10290</span></td>
                                <td><span class="cellcontent">بعض النص بعض النص </span></td>
                              </tr>
                              <tr>
                                <td><span class="cellcontent">20-11-2017</span></td>
                                <td><span class="cellcontent">10290</span></td>
                                <td><span class="cellcontent">بعض النص بعض النص </span></td>
                              </tr>
                              <tr>
                                <td><span class="cellcontent">20-11-2017</span></td>
                                <td><span class="cellcontent">10290</span></td>
                                <td><span class="cellcontent">بعض النص بعض النص </span></td>
                              </tr>
                              <tr>
                                <td><span class="cellcontent">20-11-2017</span></td>
                                <td><span class="cellcontent">10290</span></td>
                                <td><span class="cellcontent">بعض النص بعض النص </span></td>
                              </tr>
                              <tr>
                                <td><span class="cellcontent">20-11-2017</span></td>
                                <td><span class="cellcontent">10290</span></td>
                                <td><span class="cellcontent">بعض النص بعض النص </span></td>
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
                              <tr>
                                <td><span class="cellcontent">محمود محروس محمد</span></td>
                                <td><span class="cellcontent"><span class= stars , data-rating= 2.5 ,  data-num-stars=5 ></span></span></td>
                                <td><span class="cellcontent">لا توجد ملاحظات</span></td>
                                <td><span class="cellcontent">20-11-2017</span></td>
                              </tr>
                              <tr>
                                <td><span class="cellcontent">محمود محروس محمد</span></td>
                                <td><span class="cellcontent"><span class= stars , data-rating= 2.5 ,  data-num-stars=5 ></span></span></td>
                                <td><span class="cellcontent">لا توجد ملاحظات</span></td>
                                <td><span class="cellcontent">20-11-2017</span></td>
                              </tr>
                              <tr>
                                <td><span class="cellcontent">محمود محروس محمد</span></td>
                                <td><span class="cellcontent"><span class= stars , data-rating= 2.5 ,  data-num-stars=5 ></span></span></td>
                                <td><span class="cellcontent">لا توجد ملاحظات</span></td>
                                <td><span class="cellcontent">20-11-2017</span></td>
                              </tr>
                              <tr>
                                <td><span class="cellcontent">محمود محروس محمد</span></td>
                                <td><span class="cellcontent"><span class= stars , data-rating= 2.5 ,  data-num-stars=5 ></span></span></td>
                                <td><span class="cellcontent">لا توجد ملاحظات</span></td>
                                <td><span class="cellcontent">20-11-2017</span></td>
                              </tr>
                              <tr>
                                <td><span class="cellcontent">محمود محروس محمد</span></td>
                                <td><span class="cellcontent"><span class= stars , data-rating= 2.5 ,  data-num-stars=5 ></span></span></td>
                                <td><span class="cellcontent">لا توجد ملاحظات</span></td>
                                <td><span class="cellcontent">20-11-2017</span></td>
                              </tr>
                              <tr>
                                <td><span class="cellcontent">محمود محروس محمد</span></td>
                                <td><span class="cellcontent"><span class= stars , data-rating= 2.5 ,  data-num-stars=5 ></span></span></td>
                                <td><span class="cellcontent">لا توجد ملاحظات</span></td>
                                <td><span class="cellcontent">20-11-2017</span></td>
                              </tr>
                              <tr>
                                <td><span class="cellcontent">محمود محروس محمد</span></td>
                                <td><span class="cellcontent"><span class= stars , data-rating= 2.5 ,  data-num-stars=5 ></span></span></td>
                                <td><span class="cellcontent">لا توجد ملاحظات</span></td>
                                <td><span class="cellcontent">20-11-2017</span></td>
                              </tr>
                              <tr>
                                <td><span class="cellcontent">محمود محروس محمد</span></td>
                                <td><span class="cellcontent"><span class= stars , data-rating= 2.5 ,  data-num-stars=5 ></span></span></td>
                                <td><span class="cellcontent">لا توجد ملاحظات</span></td>
                                <td><span class="cellcontent">20-11-2017</span></td>
                              </tr>
                              <tr>
                                <td><span class="cellcontent">محمود محروس محمد</span></td>
                                <td><span class="cellcontent"><span class= stars , data-rating= 2.5 ,  data-num-stars=5 ></span></span></td>
                                <td><span class="cellcontent">لا توجد ملاحظات</span></td>
                                <td><span class="cellcontent">20-11-2017</span></td>
                              </tr>
                              <tr>
                                <td><span class="cellcontent">محمود محروس محمد</span></td>
                                <td><span class="cellcontent"><span class= stars , data-rating= 2.5 ,  data-num-stars=5 ></span></span></td>
                                <td><span class="cellcontent">لا توجد ملاحظات</span></td>
                                <td><span class="cellcontent">20-11-2017</span></td>
                              </tr>
                              <tr>
                                <td><span class="cellcontent">محمود محروس محمد</span></td>
                                <td><span class="cellcontent"><span class= stars , data-rating= 2.5 ,  data-num-stars=5 ></span></span></td>
                                <td><span class="cellcontent">لا توجد ملاحظات</span></td>
                                <td><span class="cellcontent">20-11-2017</span></td>
                              </tr>
                              <tr>
                                <td><span class="cellcontent">محمود محروس محمد</span></td>
                                <td><span class="cellcontent"><span class= stars , data-rating= 2.5 ,  data-num-stars=5 ></span></span></td>
                                <td><span class="cellcontent">لا توجد ملاحظات</span></td>
                                <td><span class="cellcontent">20-11-2017</span></td>
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
                      </li>
                      <li class="tab__content_item">
                        <div class="cardwrap bgcolor--white bradius--noborder   bshadow--1 padding--small margin--small-top-bottom">
                          <div class="col-md-2 col-sm-3 col-xs-12 pull-right"><a class="master-btn color--white bgcolor--fadeblue bradius--small bshadow--0 btn-block" href="#add_evaluation"><i class="fa fa-plus"></i><span>إضافة تقييم</span></a>
                            <div class="remodal-bg"></div>
                            <div class="remodal" data-remodal-id="add_evaluation" role="dialog" aria-labelledby="modal2Title" aria-describedby="modal2Desc">
                              <button class="remodal-close" data-remodal-action="close" aria-label="Close"></button>
                              <div>
                                <div class="row">
                                  <div class="col-xs-12">
                                    <h3>إضافة تقييم</h3>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                      <div class="master_field">
                                        <label class="master_label mandatory" for="backend_evaluation_date">التاريخ</label>
                                        <div class="bootstrap-timepicker">
                                          <input class="datepicker master_input" type="text" placeholder="التاريخ من" id="backend_evaluation_date">
                                        </div><span class="master_message color--fadegreen">message</span>
                                      </div>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                      <div class="master_field">
                                        <label class="master_label mandatory" for="backend_evaluation_lawyer_evaluation">التقييم </label>
                                        <select class="master_input select2" id="backend_evaluation_lawyer_evaluation" style="width:100%">
                                          <option>ممتاز</option>
                                          <option>جيد جدا </option>
                                          <option>جيد </option>
                                          <option>مقبول</option>
                                        </select><span class="master_message color--fadegreen">message</span>
                                      </div>
                                    </div>
                                    <div class="col-xs-12">
                                      <div class="master_field">
                                        <label class="master_label mandatory" for="backend_evaluation_notes">ملاحظات الإدارة</label>
                                        <textarea class="master_input" name="textarea" id="backend_evaluation_notes" placeholder="ملاحظات الإدارة"></textarea><span class="master_message color--fadegreen">message</span>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div><br>
                              <button class="remodal-cancel" data-remodal-action="cancel">إغلاق</button>
                              <button class="remodal-confirm" data-remodal-action="confirm">إضافة</button>
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
                              <tr>
                                <td><span class="cellcontent">ممتاز</span></td>
                                <td><span class="cellcontent">لا توجد ملاحظات</span></td>
                                <td><span class="cellcontent">20-11-2017</span></td>
                              </tr>
                              <tr>
                                <td><span class="cellcontent">ممتاز</span></td>
                                <td><span class="cellcontent">لا توجد ملاحظات</span></td>
                                <td><span class="cellcontent">20-11-2017</span></td>
                              </tr>
                              <tr>
                                <td><span class="cellcontent">ممتاز</span></td>
                                <td><span class="cellcontent">لا توجد ملاحظات</span></td>
                                <td><span class="cellcontent">20-11-2017</span></td>
                              </tr>
                              <tr>
                                <td><span class="cellcontent">ممتاز</span></td>
                                <td><span class="cellcontent">لا توجد ملاحظات</span></td>
                                <td><span class="cellcontent">20-11-2017</span></td>
                              </tr>
                              <tr>
                                <td><span class="cellcontent">ممتاز</span></td>
                                <td><span class="cellcontent">لا توجد ملاحظات</span></td>
                                <td><span class="cellcontent">20-11-2017</span></td>
                              </tr>
                              <tr>
                                <td><span class="cellcontent">ممتاز</span></td>
                                <td><span class="cellcontent">لا توجد ملاحظات</span></td>
                                <td><span class="cellcontent">20-11-2017</span></td>
                              </tr>
                              <tr>
                                <td><span class="cellcontent">ممتاز</span></td>
                                <td><span class="cellcontent">لا توجد ملاحظات</span></td>
                                <td><span class="cellcontent">20-11-2017</span></td>
                              </tr>
                              <tr>
                                <td><span class="cellcontent">ممتاز</span></td>
                                <td><span class="cellcontent">لا توجد ملاحظات</span></td>
                                <td><span class="cellcontent">20-11-2017</span></td>
                              </tr>
                              <tr>
                                <td><span class="cellcontent">ممتاز</span></td>
                                <td><span class="cellcontent">لا توجد ملاحظات</span></td>
                                <td><span class="cellcontent">20-11-2017</span></td>
                              </tr>
                              <tr>
                                <td><span class="cellcontent">ممتاز</span></td>
                                <td><span class="cellcontent">لا توجد ملاحظات</span></td>
                                <td><span class="cellcontent">20-11-2017</span></td>
                              </tr>
                              <tr>
                                <td><span class="cellcontent">ممتاز</span></td>
                                <td><span class="cellcontent">لا توجد ملاحظات</span></td>
                                <td><span class="cellcontent">20-11-2017</span></td>
                              </tr>
                              <tr>
                                <td><span class="cellcontent">ممتاز</span></td>
                                <td><span class="cellcontent">لا توجد ملاحظات</span></td>
                                <td><span class="cellcontent">20-11-2017</span></td>
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
                      </li>
                    </ul>
                  </div>
                </div>
              </div>

 @endsection