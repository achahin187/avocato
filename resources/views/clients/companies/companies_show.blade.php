@extends('layout.app')
@section('content')


              <div class="row">
                <div class="col-lg-12">
                  <div class="coverglobal text-center bshadow--2" style="background:#000 url( '{{asset('img/covers/dummy2.jpg')}}') no-repeat center center; background-size:cover;"><span></span>
                    <div class="container">
                      <div class="row">
                        <div class="col-xs-12">
                          <div class="text-xs-center"><a href="user_profile.html"><img class="coverglobal__avatar" src="../img/avatars/male.jpg">
                              <h3 class="coverglobal__title color--gray_d">شركة خالدة للبترول </h3><small class="coverglobal__slogan color--gray_d">مفعل</small></a></div>
                          <div class="coverglobal__actions"><a class="color--gray_d bordercolor-gray_d bradius--small border-btn master-btn" type="button" href="clients_companies_edit.html">تعديل بيانات العميل</a><a class="color--gray_d bordercolor-gray_d bradius--small border-btn master-btn" type="button" href="">كارت العميل</a><a class="color--gray_d bordercolor-gray_d bradius--small border-btn master-btn" type="button" href="">استبعاد العميل</a>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-lg-12">
                  <div class="cardwrap bgcolor--white bradius--noborder   bshadow--1 padding--small margin--small-top-bottom">
                    <div class="col-md-6 col-sm-6 col-xs-6">
                      <div class="row"><b class="col-xs-4">العنوان </b>
                        <div class="col-xs-8">24 المعادي</div>
                      </div>
                      <div class="row"><b class="col-xs-4">كود الشركة </b>
                        <div class="col-xs-8">754338</div>
                      </div>
                      <div class="row"><b class="col-xs-4">البريد الالكترونى </b>
                        <div class="col-xs-8">company@info.com</div>
                      </div>
                      <div class="row"><b class="col-xs-4">رقم السجل التجارى </b>
                        <div class="col-xs-8">1837494</div>
                      </div>
                      <div class="row"><b class="col-xs-4">اسم الممثل القانونى </b>
                        <div class="col-xs-8">محمد احمد السيد</div>
                      </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-6">
                      <div class="row"><b class="col-xs-4">الهاتف </b>
                        <div class="col-xs-8">01234567890</div>
                      </div>
                      <div class="row"><b class="col-xs-4">جوال </b>
                        <div class="col-xs-8">01234567890</div>
                      </div>
                      <div class="row"><b class="col-xs-4">فاكس </b>
                        <div class="col-xs-8">01234567890</div>
                      </div>
                      <div class="row"><b class="col-xs-4">موقع الكترونى </b>
                        <div class="col-xs-8">www.company.com</div>
                      </div>
                      <div class="row"><b class="col-xs-4">تليفون الممثل القانونى </b>
                        <div class="col-xs-8">01234567890</div>
                      </div>
                    </div>
                    <div class="clearfix"></div>
                  </div>
                </div>
                <div class="col-lg-12">
                  <div class="tabs--wrapper">
                    <div class="clearfix"></div>
                    <ul class="tabs">
                      <li>معلومات التعاقد</li>
                      <li>القضايا</li>
                      <li>الخدمات </li>
                      <li>الطلبات الطارئة</li>
                      <li>فهرس التوكيلات</li>
                    </ul>
                    <ul class="tab__content">
                      <li class="tab__content_item active">
                        <div class="cardwrap bgcolor--white bradius--noborder   bshadow--1 padding--small margin--small-top-bottom">
                          <div class="row">
                            <div class="col-xs-6"><b class="col-xs-3">تاريخ بدء التعاقد </b>
                              <div class="col-xs-9">20-12-2019</div>
                            </div>
                            <div class="col-xs-6"><b class="col-xs-3">مدة التعاقد </b>
                              <div class="col-xs-9">3 سنوات</div>
                            </div>
                            <div class="col-xs-6"><b class="col-xs-3">قيمة التعاقد </b>
                              <div class="col-xs-9">1090</div>
                            </div>
                            <div class="col-xs-6"><b class="col-xs-3">تاريخ نهاية التعاقد </b>
                              <div class="col-xs-9">20-12-2019</div>
                            </div>
                            <div class="col-xs-6"><b class="col-xs-3">نوع الباقة  </b>
                              <div class="col-xs-9"><span class="bgcolor--fadeorange color--white bradius--small importance padding--small">ذهبي</span></div>
                            </div>
                            <div class="col-xs-6"><b class="col-xs-3">عدد الاقساط </b>
                              <div class="col-xs-9">10</div>
                            </div>
                          </div>
                          <div class="col-lg-12">
                            <table class="table-1">
                              <thead>
                                <tr class="bgcolor--gray_mm color--gray_d">
                                  <th><span class="cellcontent">ترتيب القسط</span></th>
                                  <th><span class="cellcontent"> قيمة القسط</span></th>
                                  <th><span class="cellcontent">تاريخ السداد</span></th>
                                  <th><span class="cellcontent">حالة السداد</span></th>
                                  <th><span class="cellcontent">تعديل حالة السداد</span></th>
                                </tr>
                              </thead>
                              <tbody>
                                <tr>
                                  <td><span class="cellcontent">القسط الاول</span></td>
                                  <td><span class="cellcontent"> 1000</span></td>
                                  <td><span class="cellcontent">7-10-2010 </span></td>
                                  <td><span class="cellcontent"><i class = "fa color--fadegreen fa-check"></i></span></td>
                                  <td><span class="cellcontent"><a href= #payment_status ,  class= "action-btn bgcolor--fadegreen color--white "> <i class = "fa  fa-edit"></i></a></span></td>
                                </tr>
                                <tr>
                                  <td><span class="cellcontent">القسط الاول</span></td>
                                  <td><span class="cellcontent"> 1000</span></td>
                                  <td><span class="cellcontent">7-10-2010 </span></td>
                                  <td><span class="cellcontent"><i class = "fa color--fadegreen fa-check"></i></span></td>
                                  <td><span class="cellcontent"><a href= #payment_status ,  class= "action-btn bgcolor--fadegreen color--white "> <i class = "fa  fa-edit"></i></a></span></td>
                                </tr>
                                <tr>
                                  <td><span class="cellcontent">القسط الاول</span></td>
                                  <td><span class="cellcontent"> 1000</span></td>
                                  <td><span class="cellcontent">7-10-2010 </span></td>
                                  <td><span class="cellcontent"><i class = "fa color--fadegreen fa-check"></i></span></td>
                                  <td><span class="cellcontent"><a href= #payment_status ,  class= "action-btn bgcolor--fadegreen color--white "> <i class = "fa  fa-edit"></i></a></span></td>
                                </tr>
                                <tr>
                                  <td><span class="cellcontent">القسط الاول</span></td>
                                  <td><span class="cellcontent"> 1000</span></td>
                                  <td><span class="cellcontent">7-10-2010 </span></td>
                                  <td><span class="cellcontent"><i class = "fa color--fadegreen fa-check"></i></span></td>
                                  <td><span class="cellcontent"><a href= #payment_status ,  class= "action-btn bgcolor--fadegreen color--white "> <i class = "fa  fa-edit"></i></a></span></td>
                                </tr>
                                <tr>
                                  <td><span class="cellcontent">القسط الاول</span></td>
                                  <td><span class="cellcontent"> 1000</span></td>
                                  <td><span class="cellcontent">7-10-2010 </span></td>
                                  <td><span class="cellcontent"><i class = "fa color--fadegreen fa-check"></i></span></td>
                                  <td><span class="cellcontent"><a href= #payment_status ,  class= "action-btn bgcolor--fadegreen color--white "> <i class = "fa  fa-edit"></i></a></span></td>
                                </tr>
                                <tr>
                                  <td><span class="cellcontent">القسط الاول</span></td>
                                  <td><span class="cellcontent"> 1000</span></td>
                                  <td><span class="cellcontent">7-10-2010 </span></td>
                                  <td><span class="cellcontent"><i class = "fa color--fadegreen fa-check"></i></span></td>
                                  <td><span class="cellcontent"><a href= #payment_status ,  class= "action-btn bgcolor--fadegreen color--white "> <i class = "fa  fa-edit"></i></a></span></td>
                                </tr>
                                <tr>
                                  <td><span class="cellcontent">القسط الاول</span></td>
                                  <td><span class="cellcontent"> 1000</span></td>
                                  <td><span class="cellcontent">7-10-2010 </span></td>
                                  <td><span class="cellcontent"><i class = "fa color--fadegreen fa-check"></i></span></td>
                                  <td><span class="cellcontent"><a href= #payment_status ,  class= "action-btn bgcolor--fadegreen color--white "> <i class = "fa  fa-edit"></i></a></span></td>
                                </tr>
                                <tr>
                                  <td><span class="cellcontent">القسط الاول</span></td>
                                  <td><span class="cellcontent"> 1000</span></td>
                                  <td><span class="cellcontent">7-10-2010 </span></td>
                                  <td><span class="cellcontent"><i class = "fa color--fadegreen fa-check"></i></span></td>
                                  <td><span class="cellcontent"><a href= #payment_status ,  class= "action-btn bgcolor--fadegreen color--white "> <i class = "fa  fa-edit"></i></a></span></td>
                                </tr>
                                <tr>
                                  <td><span class="cellcontent">القسط الاول</span></td>
                                  <td><span class="cellcontent"> 1000</span></td>
                                  <td><span class="cellcontent">7-10-2010 </span></td>
                                  <td><span class="cellcontent"><i class = "fa color--fadegreen fa-check"></i></span></td>
                                  <td><span class="cellcontent"><a href= #payment_status ,  class= "action-btn bgcolor--fadegreen color--white "> <i class = "fa  fa-edit"></i></a></span></td>
                                </tr>
                                <tr>
                                  <td><span class="cellcontent">القسط الاول</span></td>
                                  <td><span class="cellcontent"> 1000</span></td>
                                  <td><span class="cellcontent">7-10-2010 </span></td>
                                  <td><span class="cellcontent"><i class = "fa color--fadegreen fa-check"></i></span></td>
                                  <td><span class="cellcontent"><a href= #payment_status ,  class= "action-btn bgcolor--fadegreen color--white "> <i class = "fa  fa-edit"></i></a></span></td>
                                </tr>
                                <tr>
                                  <td><span class="cellcontent">القسط الاول</span></td>
                                  <td><span class="cellcontent"> 1000</span></td>
                                  <td><span class="cellcontent">7-10-2010 </span></td>
                                  <td><span class="cellcontent"><i class = "fa color--fadegreen fa-check"></i></span></td>
                                  <td><span class="cellcontent"><a href= #payment_status ,  class= "action-btn bgcolor--fadegreen color--white "> <i class = "fa  fa-edit"></i></a></span></td>
                                </tr>
                                <tr>
                                  <td><span class="cellcontent">القسط الاول</span></td>
                                  <td><span class="cellcontent"> 1000</span></td>
                                  <td><span class="cellcontent">7-10-2010 </span></td>
                                  <td><span class="cellcontent"><i class = "fa color--fadegreen fa-check"></i></span></td>
                                  <td><span class="cellcontent"><a href= #payment_status ,  class= "action-btn bgcolor--fadegreen color--white "> <i class = "fa  fa-edit"></i></a></span></td>
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
                          <div class="col-md-2"><a class="master-btn undefined undefined undefined undefined undefined" href="#payment_status"><span></span></a>
                            <div class="remodal-bg"></div>
                            <div class="remodal" data-remodal-id="payment_status" role="dialog" aria-labelledby="modal1Title" aria-describedby="modal1Desc">
                              <button class="remodal-close" data-remodal-action="close" aria-label="Close"></button>
                              <div>
                                <div class="row">
                                  <div class="col-xs-12">
                                    <h3>تغيير حالة القسط</h3>
                                    <div class="master_field">       
                                      <input class="icon" type="radio" name="icon" id="done" checked="true">
                                      <label for="done">تم الدفع</label>
                                      <input class="icon" type="radio" name="icon" id="not_done">
                                      <label for="not_done">لم يتم الدفع</label>
                                    </div>
                                  </div>
                                </div>
                              </div><br>
                              <button class="remodal-cancel" data-remodal-action="cancel">إلغاء</button>
                              <button class="remodal-confirm" data-remodal-action="confirm">تغيير حالة القسط</button>
                            </div>
                          </div>
                          <div class="clearfix"> </div>
                        </div>
                      </li>
                      <li class="tab__content_item">
                        <div class="cardwrap bgcolor--white bradius--noborder   bshadow--1 padding--small margin--small-top-bottom">
                          <table class="table-1">
                            <thead>
                              <tr class="bgcolor--gray_mm color--gray_d">
                                <th><span class="cellcontent">نوع القضية</span></th>
                                <th><span class="cellcontent">المحكمة</span></th>
                                <th><span class="cellcontent">الدائرة</span></th>
                                <th><span class="cellcontent">رقم الدعوى</span></th>
                                <th><span class="cellcontent">لسنة</span></th>
                                <th><span class="cellcontent">تاريخ قيد الدعوى</span></th>
                                <th><span class="cellcontent">رقم الملف بالمكتب</span></th>
                                <th><span class="cellcontent">رقم التوكيل</span></th>
                              </tr>
                            </thead>
                            <tbody>
                              <tr>
                                <td><span class="cellcontent">جنايات</span></td>
                                <td><span class="cellcontent">اسم المحكمة</span></td>
                                <td><span class="cellcontent">اسم الدائرة</span></td>
                                <td><span class="cellcontent">100230</span></td>
                                <td><span class="cellcontent">2017</span></td>
                                <td><span class="cellcontent">29-10-2019</span></td>
                                <td><span class="cellcontent">100900</span></td>
                                <td><span class="cellcontent">400910</span></td>
                              </tr>
                              <tr>
                                <td><span class="cellcontent">جنايات</span></td>
                                <td><span class="cellcontent">اسم المحكمة</span></td>
                                <td><span class="cellcontent">اسم الدائرة</span></td>
                                <td><span class="cellcontent">100230</span></td>
                                <td><span class="cellcontent">2017</span></td>
                                <td><span class="cellcontent">29-10-2019</span></td>
                                <td><span class="cellcontent">100900</span></td>
                                <td><span class="cellcontent">400910</span></td>
                              </tr>
                              <tr>
                                <td><span class="cellcontent">جنايات</span></td>
                                <td><span class="cellcontent">اسم المحكمة</span></td>
                                <td><span class="cellcontent">اسم الدائرة</span></td>
                                <td><span class="cellcontent">100230</span></td>
                                <td><span class="cellcontent">2017</span></td>
                                <td><span class="cellcontent">29-10-2019</span></td>
                                <td><span class="cellcontent">100900</span></td>
                                <td><span class="cellcontent">400910</span></td>
                              </tr>
                              <tr>
                                <td><span class="cellcontent">جنايات</span></td>
                                <td><span class="cellcontent">اسم المحكمة</span></td>
                                <td><span class="cellcontent">اسم الدائرة</span></td>
                                <td><span class="cellcontent">100230</span></td>
                                <td><span class="cellcontent">2017</span></td>
                                <td><span class="cellcontent">29-10-2019</span></td>
                                <td><span class="cellcontent">100900</span></td>
                                <td><span class="cellcontent">400910</span></td>
                              </tr>
                              <tr>
                                <td><span class="cellcontent">جنايات</span></td>
                                <td><span class="cellcontent">اسم المحكمة</span></td>
                                <td><span class="cellcontent">اسم الدائرة</span></td>
                                <td><span class="cellcontent">100230</span></td>
                                <td><span class="cellcontent">2017</span></td>
                                <td><span class="cellcontent">29-10-2019</span></td>
                                <td><span class="cellcontent">100900</span></td>
                                <td><span class="cellcontent">400910</span></td>
                              </tr>
                              <tr>
                                <td><span class="cellcontent">جنايات</span></td>
                                <td><span class="cellcontent">اسم المحكمة</span></td>
                                <td><span class="cellcontent">اسم الدائرة</span></td>
                                <td><span class="cellcontent">100230</span></td>
                                <td><span class="cellcontent">2017</span></td>
                                <td><span class="cellcontent">29-10-2019</span></td>
                                <td><span class="cellcontent">100900</span></td>
                                <td><span class="cellcontent">400910</span></td>
                              </tr>
                              <tr>
                                <td><span class="cellcontent">جنايات</span></td>
                                <td><span class="cellcontent">اسم المحكمة</span></td>
                                <td><span class="cellcontent">اسم الدائرة</span></td>
                                <td><span class="cellcontent">100230</span></td>
                                <td><span class="cellcontent">2017</span></td>
                                <td><span class="cellcontent">29-10-2019</span></td>
                                <td><span class="cellcontent">100900</span></td>
                                <td><span class="cellcontent">400910</span></td>
                              </tr>
                              <tr>
                                <td><span class="cellcontent">جنايات</span></td>
                                <td><span class="cellcontent">اسم المحكمة</span></td>
                                <td><span class="cellcontent">اسم الدائرة</span></td>
                                <td><span class="cellcontent">100230</span></td>
                                <td><span class="cellcontent">2017</span></td>
                                <td><span class="cellcontent">29-10-2019</span></td>
                                <td><span class="cellcontent">100900</span></td>
                                <td><span class="cellcontent">400910</span></td>
                              </tr>
                              <tr>
                                <td><span class="cellcontent">جنايات</span></td>
                                <td><span class="cellcontent">اسم المحكمة</span></td>
                                <td><span class="cellcontent">اسم الدائرة</span></td>
                                <td><span class="cellcontent">100230</span></td>
                                <td><span class="cellcontent">2017</span></td>
                                <td><span class="cellcontent">29-10-2019</span></td>
                                <td><span class="cellcontent">100900</span></td>
                                <td><span class="cellcontent">400910</span></td>
                              </tr>
                              <tr>
                                <td><span class="cellcontent">جنايات</span></td>
                                <td><span class="cellcontent">اسم المحكمة</span></td>
                                <td><span class="cellcontent">اسم الدائرة</span></td>
                                <td><span class="cellcontent">100230</span></td>
                                <td><span class="cellcontent">2017</span></td>
                                <td><span class="cellcontent">29-10-2019</span></td>
                                <td><span class="cellcontent">100900</span></td>
                                <td><span class="cellcontent">400910</span></td>
                              </tr>
                              <tr>
                                <td><span class="cellcontent">جنايات</span></td>
                                <td><span class="cellcontent">اسم المحكمة</span></td>
                                <td><span class="cellcontent">اسم الدائرة</span></td>
                                <td><span class="cellcontent">100230</span></td>
                                <td><span class="cellcontent">2017</span></td>
                                <td><span class="cellcontent">29-10-2019</span></td>
                                <td><span class="cellcontent">100900</span></td>
                                <td><span class="cellcontent">400910</span></td>
                              </tr>
                              <tr>
                                <td><span class="cellcontent">جنايات</span></td>
                                <td><span class="cellcontent">اسم المحكمة</span></td>
                                <td><span class="cellcontent">اسم الدائرة</span></td>
                                <td><span class="cellcontent">100230</span></td>
                                <td><span class="cellcontent">2017</span></td>
                                <td><span class="cellcontent">29-10-2019</span></td>
                                <td><span class="cellcontent">100900</span></td>
                                <td><span class="cellcontent">400910</span></td>
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
                                <th><span class="cellcontent">نوع الخدمة</span></th>
                                <th><span class="cellcontent">القائم بالاجراء</span></th>
                              </tr>
                            </thead>
                            <tbody>
                              <tr>
                                <td><span class="cellcontent">نوع الخدمة</span></td>
                                <td><span class="cellcontent">حسن احمد</span></td>
                              </tr>
                              <tr>
                                <td><span class="cellcontent">نوع الخدمة</span></td>
                                <td><span class="cellcontent">حسن احمد</span></td>
                              </tr>
                              <tr>
                                <td><span class="cellcontent">نوع الخدمة</span></td>
                                <td><span class="cellcontent">حسن احمد</span></td>
                              </tr>
                              <tr>
                                <td><span class="cellcontent">نوع الخدمة</span></td>
                                <td><span class="cellcontent">حسن احمد</span></td>
                              </tr>
                              <tr>
                                <td><span class="cellcontent">نوع الخدمة</span></td>
                                <td><span class="cellcontent">حسن احمد</span></td>
                              </tr>
                              <tr>
                                <td><span class="cellcontent">نوع الخدمة</span></td>
                                <td><span class="cellcontent">حسن احمد</span></td>
                              </tr>
                              <tr>
                                <td><span class="cellcontent">نوع الخدمة</span></td>
                                <td><span class="cellcontent">حسن احمد</span></td>
                              </tr>
                              <tr>
                                <td><span class="cellcontent">نوع الخدمة</span></td>
                                <td><span class="cellcontent">حسن احمد</span></td>
                              </tr>
                              <tr>
                                <td><span class="cellcontent">نوع الخدمة</span></td>
                                <td><span class="cellcontent">حسن احمد</span></td>
                              </tr>
                              <tr>
                                <td><span class="cellcontent">نوع الخدمة</span></td>
                                <td><span class="cellcontent">حسن احمد</span></td>
                              </tr>
                              <tr>
                                <td><span class="cellcontent">نوع الخدمة</span></td>
                                <td><span class="cellcontent">حسن احمد</span></td>
                              </tr>
                              <tr>
                                <td><span class="cellcontent">نوع الخدمة</span></td>
                                <td><span class="cellcontent">حسن احمد</span></td>
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
                                <th><span class="cellcontent">عنوان الطلب</span></th>
                                <th><span class="cellcontent">تفاصيل الطلب</span></th>
                                <th><span class="cellcontent">الحالة</span></th>
                                <th><span class="cellcontent"> التاريخ</span></th>
                                <th><span class="cellcontent">الوقت</span></th>
                              </tr>
                            </thead>
                            <tbody>
                              <tr>
                                <td><span class="cellcontent">العنوان يوجد نص</span></td>
                                <td><span class="cellcontent">بعض النص بعض النص</span></td>
                                <td><span class="cellcontent"><i class = "fa color--fadegreen fa-check"></i></span></td>
                                <td><span class="cellcontent">10-9-2019</span></td>
                                <td><span class="cellcontent">10:10</span></td>
                              </tr>
                              <tr>
                                <td><span class="cellcontent">العنوان يوجد نص</span></td>
                                <td><span class="cellcontent">بعض النص بعض النص</span></td>
                                <td><span class="cellcontent"><i class = "fa color--fadegreen fa-check"></i></span></td>
                                <td><span class="cellcontent">10-9-2019</span></td>
                                <td><span class="cellcontent">10:10</span></td>
                              </tr>
                              <tr>
                                <td><span class="cellcontent">العنوان يوجد نص</span></td>
                                <td><span class="cellcontent">بعض النص بعض النص</span></td>
                                <td><span class="cellcontent"><i class = "fa color--fadegreen fa-check"></i></span></td>
                                <td><span class="cellcontent">10-9-2019</span></td>
                                <td><span class="cellcontent">10:10</span></td>
                              </tr>
                              <tr>
                                <td><span class="cellcontent">العنوان يوجد نص</span></td>
                                <td><span class="cellcontent">بعض النص بعض النص</span></td>
                                <td><span class="cellcontent"><i class = "fa color--fadegreen fa-check"></i></span></td>
                                <td><span class="cellcontent">10-9-2019</span></td>
                                <td><span class="cellcontent">10:10</span></td>
                              </tr>
                              <tr>
                                <td><span class="cellcontent">العنوان يوجد نص</span></td>
                                <td><span class="cellcontent">بعض النص بعض النص</span></td>
                                <td><span class="cellcontent"><i class = "fa color--fadegreen fa-check"></i></span></td>
                                <td><span class="cellcontent">10-9-2019</span></td>
                                <td><span class="cellcontent">10:10</span></td>
                              </tr>
                              <tr>
                                <td><span class="cellcontent">العنوان يوجد نص</span></td>
                                <td><span class="cellcontent">بعض النص بعض النص</span></td>
                                <td><span class="cellcontent"><i class = "fa color--fadegreen fa-check"></i></span></td>
                                <td><span class="cellcontent">10-9-2019</span></td>
                                <td><span class="cellcontent">10:10</span></td>
                              </tr>
                              <tr>
                                <td><span class="cellcontent">العنوان يوجد نص</span></td>
                                <td><span class="cellcontent">بعض النص بعض النص</span></td>
                                <td><span class="cellcontent"><i class = "fa color--fadegreen fa-check"></i></span></td>
                                <td><span class="cellcontent">10-9-2019</span></td>
                                <td><span class="cellcontent">10:10</span></td>
                              </tr>
                              <tr>
                                <td><span class="cellcontent">العنوان يوجد نص</span></td>
                                <td><span class="cellcontent">بعض النص بعض النص</span></td>
                                <td><span class="cellcontent"><i class = "fa color--fadegreen fa-check"></i></span></td>
                                <td><span class="cellcontent">10-9-2019</span></td>
                                <td><span class="cellcontent">10:10</span></td>
                              </tr>
                              <tr>
                                <td><span class="cellcontent">العنوان يوجد نص</span></td>
                                <td><span class="cellcontent">بعض النص بعض النص</span></td>
                                <td><span class="cellcontent"><i class = "fa color--fadegreen fa-check"></i></span></td>
                                <td><span class="cellcontent">10-9-2019</span></td>
                                <td><span class="cellcontent">10:10</span></td>
                              </tr>
                              <tr>
                                <td><span class="cellcontent">العنوان يوجد نص</span></td>
                                <td><span class="cellcontent">بعض النص بعض النص</span></td>
                                <td><span class="cellcontent"><i class = "fa color--fadegreen fa-check"></i></span></td>
                                <td><span class="cellcontent">10-9-2019</span></td>
                                <td><span class="cellcontent">10:10</span></td>
                              </tr>
                              <tr>
                                <td><span class="cellcontent">العنوان يوجد نص</span></td>
                                <td><span class="cellcontent">بعض النص بعض النص</span></td>
                                <td><span class="cellcontent"><i class = "fa color--fadegreen fa-check"></i></span></td>
                                <td><span class="cellcontent">10-9-2019</span></td>
                                <td><span class="cellcontent">10:10</span></td>
                              </tr>
                              <tr>
                                <td><span class="cellcontent">العنوان يوجد نص</span></td>
                                <td><span class="cellcontent">بعض النص بعض النص</span></td>
                                <td><span class="cellcontent"><i class = "fa color--fadegreen fa-check"></i></span></td>
                                <td><span class="cellcontent">10-9-2019</span></td>
                                <td><span class="cellcontent">10:10</span></td>
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
                                <th><span class="cellcontent">م</span></th>
                                <th><span class="cellcontent">رقم التوكيل</span></th>
                                <th><span class="cellcontent">مكتب التوثيق</span></th>
                                <th><span class="cellcontent">نوعه</span></th>
                                <th><span class="cellcontent"> التاريخ</span></th>
                              </tr>
                            </thead>
                            <tbody>
                              <tr>
                                <td><span class="cellcontent"> 1001</span></td>
                                <td><span class="cellcontent">6589 لسنة2018</span></td>
                                <td><span class="cellcontent">مكتب الشهرالعقاري</span></td>
                                <td><span class="cellcontent">توكيل عام بالبيع و الشراء</span></td>
                                <td><span class="cellcontent">10-9-2019</span></td>
                              </tr>
                              <tr>
                                <td><span class="cellcontent"> 1001</span></td>
                                <td><span class="cellcontent">6589 لسنة2018</span></td>
                                <td><span class="cellcontent">مكتب الشهرالعقاري</span></td>
                                <td><span class="cellcontent">توكيل عام بالبيع و الشراء</span></td>
                                <td><span class="cellcontent">10-9-2019</span></td>
                              </tr>
                              <tr>
                                <td><span class="cellcontent"> 1001</span></td>
                                <td><span class="cellcontent">6589 لسنة2018</span></td>
                                <td><span class="cellcontent">مكتب الشهرالعقاري</span></td>
                                <td><span class="cellcontent">توكيل عام بالبيع و الشراء</span></td>
                                <td><span class="cellcontent">10-9-2019</span></td>
                              </tr>
                              <tr>
                                <td><span class="cellcontent"> 1001</span></td>
                                <td><span class="cellcontent">6589 لسنة2018</span></td>
                                <td><span class="cellcontent">مكتب الشهرالعقاري</span></td>
                                <td><span class="cellcontent">توكيل عام بالبيع و الشراء</span></td>
                                <td><span class="cellcontent">10-9-2019</span></td>
                              </tr>
                              <tr>
                                <td><span class="cellcontent"> 1001</span></td>
                                <td><span class="cellcontent">6589 لسنة2018</span></td>
                                <td><span class="cellcontent">مكتب الشهرالعقاري</span></td>
                                <td><span class="cellcontent">توكيل عام بالبيع و الشراء</span></td>
                                <td><span class="cellcontent">10-9-2019</span></td>
                              </tr>
                              <tr>
                                <td><span class="cellcontent"> 1001</span></td>
                                <td><span class="cellcontent">6589 لسنة2018</span></td>
                                <td><span class="cellcontent">مكتب الشهرالعقاري</span></td>
                                <td><span class="cellcontent">توكيل عام بالبيع و الشراء</span></td>
                                <td><span class="cellcontent">10-9-2019</span></td>
                              </tr>
                              <tr>
                                <td><span class="cellcontent"> 1001</span></td>
                                <td><span class="cellcontent">6589 لسنة2018</span></td>
                                <td><span class="cellcontent">مكتب الشهرالعقاري</span></td>
                                <td><span class="cellcontent">توكيل عام بالبيع و الشراء</span></td>
                                <td><span class="cellcontent">10-9-2019</span></td>
                              </tr>
                              <tr>
                                <td><span class="cellcontent"> 1001</span></td>
                                <td><span class="cellcontent">6589 لسنة2018</span></td>
                                <td><span class="cellcontent">مكتب الشهرالعقاري</span></td>
                                <td><span class="cellcontent">توكيل عام بالبيع و الشراء</span></td>
                                <td><span class="cellcontent">10-9-2019</span></td>
                              </tr>
                              <tr>
                                <td><span class="cellcontent"> 1001</span></td>
                                <td><span class="cellcontent">6589 لسنة2018</span></td>
                                <td><span class="cellcontent">مكتب الشهرالعقاري</span></td>
                                <td><span class="cellcontent">توكيل عام بالبيع و الشراء</span></td>
                                <td><span class="cellcontent">10-9-2019</span></td>
                              </tr>
                              <tr>
                                <td><span class="cellcontent"> 1001</span></td>
                                <td><span class="cellcontent">6589 لسنة2018</span></td>
                                <td><span class="cellcontent">مكتب الشهرالعقاري</span></td>
                                <td><span class="cellcontent">توكيل عام بالبيع و الشراء</span></td>
                                <td><span class="cellcontent">10-9-2019</span></td>
                              </tr>
                              <tr>
                                <td><span class="cellcontent"> 1001</span></td>
                                <td><span class="cellcontent">6589 لسنة2018</span></td>
                                <td><span class="cellcontent">مكتب الشهرالعقاري</span></td>
                                <td><span class="cellcontent">توكيل عام بالبيع و الشراء</span></td>
                                <td><span class="cellcontent">10-9-2019</span></td>
                              </tr>
                              <tr>
                                <td><span class="cellcontent"> 1001</span></td>
                                <td><span class="cellcontent">6589 لسنة2018</span></td>
                                <td><span class="cellcontent">مكتب الشهرالعقاري</span></td>
                                <td><span class="cellcontent">توكيل عام بالبيع و الشراء</span></td>
                                <td><span class="cellcontent">10-9-2019</span></td>
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
                          <div class="col-md-2 col-sm-6 col-xs-12"><a class="master-btn color--white bgcolor--main bradius--small bshadow--0 btn-block" href="#popupModal_2"><i class="fa fa-plus"></i><span>اضافة</span></a>
                            <div class="remodal-bg"></div>
                            <div class="remodal" data-remodal-id="popupModal_2" role="dialog" aria-labelledby="modal1Title" aria-describedby="modal2Desc">
                              <button class="remodal-close" data-remodal-action="close" aria-label="Close"></button>
                              <div>
                                <div class="row">
                                  <div class="col-xs-12">
                                    <h3>اضافة</h3>
                                  </div>
                                  <div class="col-xs-6">
                                    <div class="master_field">
                                      <label class="master_label mandatory" for="ID_No">رقم التوكيل</label>
                                      <input class="master_input" type="number" placeholder="رقم التوكيل" id="ID_No"><span class="master_message color--fadegreen">message</span>
                                    </div>
                                  </div>
                                  <div class="col-xs-6">
                                    <div class="master_field">
                                      <label class="master_label mandatory" for="ID_No">مكتب التوثيق</label>
                                      <input class="master_input" type="text" placeholder="مكتب التوثيق" id="ID_No"><span class="master_message color--fadegreen">message</span>
                                    </div>
                                  </div>
                                  <div class="col-xs-6">
                                    <div class="master_field">
                                      <label class="master_label mandatory" for="ID_No">نوعه</label>
                                      <input class="master_input" type="text" placeholder="نوعه" id="ID_No">
                                    </div>
                                  </div>
                                  <div class="col-xs-6">
                                    <div class="master_field">
                                      <label class="master_label mandatory" for="ID_No">التاريخ</label>
                                      <input class="datepicker-popup master_input" type="text" placeholder="التاريخ" id="ID_No">
                                    </div>
                                  </div>
                                  <div class="col-xs-12">
                                    <div class="master_field">
                                      <label class="master_label mandatory" for="ID_No-11">صورة التوكيل </label>
                                      <div class="file-upload">
                                        <div class="file-select">
                                          <div class="file-select-name" id="noFile">صورة التوكيل </div>
                                          <input class="chooseFile" type="file" name="chooseFile" id="ID_No-11">
                                        </div>
                                      </div><span class="master_message color--fadegreen">message</span>
                                    </div>
                                  </div>
                                </div>
                              </div><br>
                              <button class="remodal-cancel" data-remodal-action="cancel">الغاء</button>
                              <button class="remodal-confirm" data-remodal-action="confirm">اضافة</button>
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