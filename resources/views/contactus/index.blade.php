@extends('layout.app')
@section('content')
    <!-- =============== Custom Content ===============-->
    <div class="row">
                <div class="col-lg-12">
                  <div class="cover-inside-container margin--small-top-bottom bradius--small bshadow--1" style="background:  url( '../img/covers/dummy2.jpg ' ) no-repeat center center; background-size:cover">
                    <div class="row">
                      <div class="col-xs-12">
                        <div class="text-xs-center">
                          <div class="text-wraper">
                            <h4 class="cover-inside-title color--gray_d">البيانات الأساسية <i class="fa fa-chevron-circle-right"></i>
                              <h4 class="cover-inside-title color--gray_d">اتصل بنا </h4>
                            </h4>
                          </div>
                        </div>
                      </div>
                      <div class="cover--actions"><a class="color--gray_d bordercolor--white bradius--small border-btn master-btn" type="button" href="{{route('contactus_add')}}">اضافة</a>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-lg-12">
                  <div class="cardwrap bgcolor--white bradius--noborder   bshadow--1 padding--small margin--small-top-bottom">
                    <div class="full-table">
                      <div class="filter__btns"><a class="master-btn bgcolor--main color--white bradius--small" href="#filterModal_sponsors"><i class="fa fa-filter"></i>filters</a></div>
                      <div class="bottomActions__btns"><a class="master-btn bradius--small padding--small bgcolor--fadebrown color--white btn-warning-cancel" href="#">حذف المحدد</a>
                      </div>
                      <table class="table-1">
                        <thead>
                          <tr class="bgcolor--gray_mm color--gray_d">
                            <th><span class="cellcontent">&lt;input type=&quot;checkbox&quot; name=&quot;select-all&quot; id=&quot;select-all&quot; /&gt;</span></th>
                            <th><span class="cellcontent">اسم الفرع</span></th>
                            <th><span class="cellcontent">تليفون</span></th>
                            <th><span class="cellcontent">ايميل</span></th>
                            <th><span class="cellcontent">العنوان</span></th>
                            <th><span class="cellcontent">فرع رئيسي</span></th>
                            <th><span class="cellcontent">الإجراءات</span></th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td><span class="cellcontent"><input type="checkbox" class="checkboxes" /></span></td>
                            <td><span class="cellcontent">مكتب المروة</span></td>
                            <td><span class="cellcontent">012345678 - 912893478937</span></td>
                            <td><span class="cellcontent">example@googgle.com - example@googgle.com</span></td>
                            <td><span class="cellcontent">55 شارع أحمد تيسير - عمارات المروة - مصر الجديدة</span></td>
                            <td><span class="cellcontent"><i class = "fa color--black fa-times"></i></span></td>
                            <td><span class="cellcontent"><a href= contact_edit.html ,  class= "action-btn bgcolor--fadegreen color--white "><i class = "fa  fa-pencil"></i></a><a href="#"  class= "btn-warning-cancel action-btn bgcolor--fadebrown color--white "><i class = "fa  fa-trash-o"></i></a></span></td>
                          </tr>
                          <tr>
                            <td><span class="cellcontent"><input type="checkbox" class="checkboxes" /></span></td>
                            <td><span class="cellcontent">مكتب المروة</span></td>
                            <td><span class="cellcontent">012345678 - 912893478937</span></td>
                            <td><span class="cellcontent">example@googgle.com - example@googgle.com</span></td>
                            <td><span class="cellcontent">55 شارع أحمد تيسير - عمارات المروة - مصر الجديدة</span></td>
                            <td><span class="cellcontent"><i class = "fa color--black fa-times"></i></span></td>
                            <td><span class="cellcontent"><a href= contact_edit.html ,  class= "action-btn bgcolor--fadegreen color--white "><i class = "fa  fa-pencil"></i></a><a href="#"  class= "btn-warning-cancel action-btn bgcolor--fadebrown color--white "><i class = "fa  fa-trash-o"></i></a></span></td>
                          </tr>
                          <tr>
                            <td><span class="cellcontent"><input type="checkbox" class="checkboxes" /></span></td>
                            <td><span class="cellcontent">مكتب المروة</span></td>
                            <td><span class="cellcontent">012345678 - 912893478937</span></td>
                            <td><span class="cellcontent">example@googgle.com - example@googgle.com</span></td>
                            <td><span class="cellcontent">55 شارع أحمد تيسير - عمارات المروة - مصر الجديدة</span></td>
                            <td><span class="cellcontent"><i class = "fa color--black fa-times"></i></span></td>
                            <td><span class="cellcontent"><a href= contact_edit.html ,  class= "action-btn bgcolor--fadegreen color--white "><i class = "fa  fa-pencil"></i></a><a href="#"  class= "btn-warning-cancel action-btn bgcolor--fadebrown color--white "><i class = "fa  fa-trash-o"></i></a></span></td>
                          </tr>
                          <tr>
                            <td><span class="cellcontent"><input type="checkbox" class="checkboxes" /></span></td>
                            <td><span class="cellcontent">مكتب المروة</span></td>
                            <td><span class="cellcontent">012345678 - 912893478937</span></td>
                            <td><span class="cellcontent">example@googgle.com - example@googgle.com</span></td>
                            <td><span class="cellcontent">55 شارع أحمد تيسير - عمارات المروة - مصر الجديدة</span></td>
                            <td><span class="cellcontent"><i class = "fa color--black fa-times"></i></span></td>
                            <td><span class="cellcontent"><a href= contact_edit.html ,  class= "action-btn bgcolor--fadegreen color--white "><i class = "fa  fa-pencil"></i></a><a href="#"  class= "btn-warning-cancel action-btn bgcolor--fadebrown color--white "><i class = "fa  fa-trash-o"></i></a></span></td>
                          </tr>
                          <tr>
                            <td><span class="cellcontent"><input type="checkbox" class="checkboxes" /></span></td>
                            <td><span class="cellcontent">مكتب المروة</span></td>
                            <td><span class="cellcontent">012345678 - 912893478937</span></td>
                            <td><span class="cellcontent">example@googgle.com - example@googgle.com</span></td>
                            <td><span class="cellcontent">55 شارع أحمد تيسير - عمارات المروة - مصر الجديدة</span></td>
                            <td><span class="cellcontent"><i class = "fa color--black fa-times"></i></span></td>
                            <td><span class="cellcontent"><a href= contact_edit.html ,  class= "action-btn bgcolor--fadegreen color--white "><i class = "fa  fa-pencil"></i></a><a href="#"  class= "btn-warning-cancel action-btn bgcolor--fadebrown color--white "><i class = "fa  fa-trash-o"></i></a></span></td>
                          </tr>
                          <tr>
                            <td><span class="cellcontent"><input type="checkbox" class="checkboxes" /></span></td>
                            <td><span class="cellcontent">مكتب المروة</span></td>
                            <td><span class="cellcontent">012345678 - 912893478937</span></td>
                            <td><span class="cellcontent">example@googgle.com - example@googgle.com</span></td>
                            <td><span class="cellcontent">55 شارع أحمد تيسير - عمارات المروة - مصر الجديدة</span></td>
                            <td><span class="cellcontent"><i class = "fa color--black fa-times"></i></span></td>
                            <td><span class="cellcontent"><a href= contact_edit.html ,  class= "action-btn bgcolor--fadegreen color--white "><i class = "fa  fa-pencil"></i></a><a href="#"  class= "btn-warning-cancel action-btn bgcolor--fadebrown color--white "><i class = "fa  fa-trash-o"></i></a></span></td>
                          </tr>
                          <tr>
                            <td><span class="cellcontent"><input type="checkbox" class="checkboxes" /></span></td>
                            <td><span class="cellcontent">مكتب المروة</span></td>
                            <td><span class="cellcontent">012345678 - 912893478937</span></td>
                            <td><span class="cellcontent">example@googgle.com - example@googgle.com</span></td>
                            <td><span class="cellcontent">55 شارع أحمد تيسير - عمارات المروة - مصر الجديدة</span></td>
                            <td><span class="cellcontent"><i class = "fa color--black fa-times"></i></span></td>
                            <td><span class="cellcontent"><a href= contact_edit.html ,  class= "action-btn bgcolor--fadegreen color--white "><i class = "fa  fa-pencil"></i></a><a href="#"  class= "btn-warning-cancel action-btn bgcolor--fadebrown color--white "><i class = "fa  fa-trash-o"></i></a></span></td>
                          </tr>
                          <tr>
                            <td><span class="cellcontent"><input type="checkbox" class="checkboxes" /></span></td>
                            <td><span class="cellcontent">مكتب المروة</span></td>
                            <td><span class="cellcontent">012345678 - 912893478937</span></td>
                            <td><span class="cellcontent">example@googgle.com - example@googgle.com</span></td>
                            <td><span class="cellcontent">55 شارع أحمد تيسير - عمارات المروة - مصر الجديدة</span></td>
                            <td><span class="cellcontent"><i class = "fa color--black fa-times"></i></span></td>
                            <td><span class="cellcontent"><a href= contact_edit.html ,  class= "action-btn bgcolor--fadegreen color--white "><i class = "fa  fa-pencil"></i></a><a href="#"  class= "btn-warning-cancel action-btn bgcolor--fadebrown color--white "><i class = "fa  fa-trash-o"></i></a></span></td>
                          </tr>
                          <tr>
                            <td><span class="cellcontent"><input type="checkbox" class="checkboxes" /></span></td>
                            <td><span class="cellcontent">مكتب المروة</span></td>
                            <td><span class="cellcontent">012345678 - 912893478937</span></td>
                            <td><span class="cellcontent">example@googgle.com - example@googgle.com</span></td>
                            <td><span class="cellcontent">55 شارع أحمد تيسير - عمارات المروة - مصر الجديدة</span></td>
                            <td><span class="cellcontent"><i class = "fa color--black fa-times"></i></span></td>
                            <td><span class="cellcontent"><a href= contact_edit.html ,  class= "action-btn bgcolor--fadegreen color--white "><i class = "fa  fa-pencil"></i></a><a href="#"  class= "btn-warning-cancel action-btn bgcolor--fadebrown color--white "><i class = "fa  fa-trash-o"></i></a></span></td>
                          </tr>
                          <tr>
                            <td><span class="cellcontent"><input type="checkbox" class="checkboxes" /></span></td>
                            <td><span class="cellcontent">مكتب المروة</span></td>
                            <td><span class="cellcontent">012345678 - 912893478937</span></td>
                            <td><span class="cellcontent">example@googgle.com - example@googgle.com</span></td>
                            <td><span class="cellcontent">55 شارع أحمد تيسير - عمارات المروة - مصر الجديدة</span></td>
                            <td><span class="cellcontent"><i class = "fa color--black fa-times"></i></span></td>
                            <td><span class="cellcontent"><a href= contact_edit.html ,  class= "action-btn bgcolor--fadegreen color--white "><i class = "fa  fa-pencil"></i></a><a href="#"  class= "btn-warning-cancel action-btn bgcolor--fadebrown color--white "><i class = "fa  fa-trash-o"></i></a></span></td>
                          </tr>
                          <tr>
                            <td><span class="cellcontent"><input type="checkbox" class="checkboxes" /></span></td>
                            <td><span class="cellcontent">مكتب المروة</span></td>
                            <td><span class="cellcontent">012345678 - 912893478937</span></td>
                            <td><span class="cellcontent">example@googgle.com - example@googgle.com</span></td>
                            <td><span class="cellcontent">55 شارع أحمد تيسير - عمارات المروة - مصر الجديدة</span></td>
                            <td><span class="cellcontent"><i class = "fa color--black fa-times"></i></span></td>
                            <td><span class="cellcontent"><a href= contact_edit.html ,  class= "action-btn bgcolor--fadegreen color--white "><i class = "fa  fa-pencil"></i></a><a href="#"  class= "btn-warning-cancel action-btn bgcolor--fadebrown color--white "><i class = "fa  fa-trash-o"></i></a></span></td>
                          </tr>
                          <tr>
                            <td><span class="cellcontent"><input type="checkbox" class="checkboxes" /></span></td>
                            <td><span class="cellcontent">مكتب المروة</span></td>
                            <td><span class="cellcontent">012345678 - 912893478937</span></td>
                            <td><span class="cellcontent">example@googgle.com - example@googgle.com</span></td>
                            <td><span class="cellcontent">55 شارع أحمد تيسير - عمارات المروة - مصر الجديدة</span></td>
                            <td><span class="cellcontent"><i class = "fa color--black fa-times"></i></span></td>
                            <td><span class="cellcontent"><a href= contact_edit.html ,  class= "action-btn bgcolor--fadegreen color--white "><i class = "fa  fa-pencil"></i></a><a href="#"  class= "btn-warning-cancel action-btn bgcolor--fadebrown color--white "><i class = "fa  fa-trash-o"></i></a></span></td>
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
                </div>
              </div>
              <!-- =============== PAGE VENDOR Triggers ===============-->
@endsection