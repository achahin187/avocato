@extends('layout.app')
@section('content')


              <div class="row">
                <div class="col-lg-12">
                  <div class="cover-inside-container margin--small-top-bottom bradius--small bshadow--1" style="background:  url( '{{asset('img/covers/dummy2.jpg')}}' ) no-repeat center center; background-size:cover;">
                    <div class="row">
                      <div class="col-xs-12">
                        <div class="text-xs-center">
                          <div class="text-wraper">
                            <h4 class="cover-inside-title color--gray_d">العملاء <i class="fa fa-chevron-circle-right"></i>
                              <h4 class="cover-inside-title color--gray_d">الشكاوى و الاستفسارات </h4>
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
                    <div class="full-table">
                      <div class="remodal-bg">
                        <div class="remodal" data-remodal-id="filterModal_sponsors" role="dialog" aria-labelledby="modal1Title" aria-describedby="modal1Desc">
                          <button class="remodal-close" data-remodal-action="close" aria-label="Close"></button>
                          <div>
                            <h2 id="modal1Title">فلتر</h2>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                              <div class="master_field">
                                <label class="master_label mandatory" for="ID_No">كودالعميل</label>
                                <input class="master_input" type="number" placeholder="كودالعميل" id="ID_No"><span class="master_message color--fadegreen">message</span>
                              </div>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                              <div class="master_field">
                                <label class="master_label mandatory" for="ID_No">اسم العميل</label>
                                <input class="master_input" type="text" placeholder="اسم العميل" id="ID_No"><span class="master_message color--fadegreen">message</span>
                              </div>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                              <div class="master_field">
                                <label class="master_label mandatory" for="complain_date_from">تاريخ من</label>
                                <div class="bootstrap-timepicker">
                                  <input class="datepicker master_input" type="text" placeholder="تاريخ من" id="complain_date_from">
                                </div>
                              </div>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                              <div class="master_field">
                                <label class="master_label mandatory" for="complain_date_to">تاريخ الى </label>
                                <div class="bootstrap-timepicker">
                                  <input class="datepicker master_input" type="text" placeholder="تاريخ الى" id="complain_date_to">
                                </div><span class="master_message color--fadegreen">message content</span>
                              </div>
                            </div>
                            <div class="col-md-12">
                              <div class="master_field">
                                <label class="master_label mandatory">حالة الشكوى</label>
                                <div class="radiorobo">
                                  <input type="radio" id="status_1">
                                  <label for="status_1">الكل</label>
                                </div>
                                <div class="radiorobo">
                                  <input type="radio" id="status_2">
                                  <label for="status_2">تم حلها</label>
                                </div>
                                <div class="radiorobo">
                                  <input type="radio" id="status_3">
                                  <label for="status_3">لم يتم حلها</label>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="clearfix"></div>
                          <button class="remodal-cancel" data-remodal-action="cancel">الغاء</button>
                          <button class="remodal-confirm" data-remodal-action="confirm">فلتر</button>
                        </div>
                      </div>
                      <div class="filter__btns"><a class="master-btn bgcolor--main color--white bradius--small" href="#filterModal_sponsors"><i class="fa fa-filter"></i>filters</a></div>
                      <div class="bottomActions__btns"><a class="master-btn bradius--small padding--small bgcolor--fadeblue color--white" href="#">استخراج اكسيل</a><a class="master-btn bradius--small padding--small bgcolor--fadebrown color--white" href="#">حذف المحدد</a>
                      </div>
                      <table class="table-1">
                        <thead>
                          <tr class="bgcolor--gray_mm color--gray_d">
                            <th><span class="cellcontent">&lt;input type=&quot;checkbox&quot; name=&quot;select-all&quot; id=&quot;select-all&quot; /&gt;</span></th>
                            <th><span class="cellcontent">كود العميل </span></th>
                            <th><span class="cellcontent">اسم العميل</span></th>
                            <th><span class="cellcontent">نص الشكوى</span></th>
                            <th><span class="cellcontent">تاريخ الشكوى</span></th>
                            <th><span class="cellcontent">تم الرد</span></th>
                            <th><span class="cellcontent">الاجراءات</span></th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td><span class="cellcontent"><input type="checkbox" class="checkboxes" /></span></td>
                            <td><span class="cellcontent">215</span></td>
                            <td><span class="cellcontent">محمد احمد</span></td>
                            <td><span class="cellcontent">بعض النص بعض النص</span></td>
                            <td><span class="cellcontent">31-09-2017</span></td>
                            <td><span class="cellcontent"><i class = "fa color--fadegreen fa-check"></i></span></td>
                            <td><span class="cellcontent"><a href= "{{route('complains_edit')}}" ,  class= "action-btn bgcolor--fadegreen color--white "><i class = "fa  fa-pencil"></i></a><a href="#"  class= "btn-warning-cancel action-btn bgcolor--fadebrown color--white "><i class = "fa  fa-trash-o"></i></a></span></td>
                          </tr>
                          <tr>
                            <td><span class="cellcontent"><input type="checkbox" class="checkboxes" /></span></td>
                            <td><span class="cellcontent">215</span></td>
                            <td><span class="cellcontent">محمد احمد</span></td>
                            <td><span class="cellcontent">بعض النص بعض النص</span></td>
                            <td><span class="cellcontent">31-09-2017</span></td>
                            <td><span class="cellcontent"><i class = "fa color--fadegreen fa-check"></i></span></td>
                            <td><span class="cellcontent"><a href= "{{route('complains_edit')}}" ,  class= "action-btn bgcolor--fadegreen color--white "><i class = "fa  fa-pencil"></i></a><a href="#"  class= "btn-warning-cancel action-btn bgcolor--fadebrown color--white "><i class = "fa  fa-trash-o"></i></a></span></td>
                          </tr>
                          <tr>
                            <td><span class="cellcontent"><input type="checkbox" class="checkboxes" /></span></td>
                            <td><span class="cellcontent">215</span></td>
                            <td><span class="cellcontent">محمد احمد</span></td>
                            <td><span class="cellcontent">بعض النص بعض النص</span></td>
                            <td><span class="cellcontent">31-09-2017</span></td>
                            <td><span class="cellcontent"><i class = "fa color--fadegreen fa-check"></i></span></td>
                            <td><span class="cellcontent"><a href= "{{route('complains_edit')}}" ,  class= "action-btn bgcolor--fadegreen color--white "><i class = "fa  fa-pencil"></i></a><a href="#"  class= "btn-warning-cancel action-btn bgcolor--fadebrown color--white "><i class = "fa  fa-trash-o"></i></a></span></td>
                          </tr>
                          <tr>
                            <td><span class="cellcontent"><input type="checkbox" class="checkboxes" /></span></td>
                            <td><span class="cellcontent">215</span></td>
                            <td><span class="cellcontent">محمد احمد</span></td>
                            <td><span class="cellcontent">بعض النص بعض النص</span></td>
                            <td><span class="cellcontent">31-09-2017</span></td>
                            <td><span class="cellcontent"><i class = "fa color--fadegreen fa-check"></i></span></td>
                            <td><span class="cellcontent"><a href= "{{route('complains_edit')}}" ,  class= "action-btn bgcolor--fadegreen color--white "><i class = "fa  fa-pencil"></i></a><a href="#"  class= "btn-warning-cancel action-btn bgcolor--fadebrown color--white "><i class = "fa  fa-trash-o"></i></a></span></td>
                          </tr>
                          <tr>
                            <td><span class="cellcontent"><input type="checkbox" class="checkboxes" /></span></td>
                            <td><span class="cellcontent">215</span></td>
                            <td><span class="cellcontent">محمد احمد</span></td>
                            <td><span class="cellcontent">بعض النص بعض النص</span></td>
                            <td><span class="cellcontent">31-09-2017</span></td>
                            <td><span class="cellcontent"><i class = "fa color--fadegreen fa-check"></i></span></td>
                            <td><span class="cellcontent"><a href= "{{route('complains_edit')}}" ,  class= "action-btn bgcolor--fadegreen color--white "><i class = "fa  fa-pencil"></i></a><a href="#"  class= "btn-warning-cancel action-btn bgcolor--fadebrown color--white "><i class = "fa  fa-trash-o"></i></a></span></td>
                          </tr>
                          <tr>
                            <td><span class="cellcontent"><input type="checkbox" class="checkboxes" /></span></td>
                            <td><span class="cellcontent">215</span></td>
                            <td><span class="cellcontent">محمد احمد</span></td>
                            <td><span class="cellcontent">بعض النص بعض النص</span></td>
                            <td><span class="cellcontent">31-09-2017</span></td>
                            <td><span class="cellcontent"><i class = "fa color--fadegreen fa-check"></i></span></td>
                            <td><span class="cellcontent"><a href= "{{route('complains_edit')}}" ,  class= "action-btn bgcolor--fadegreen color--white "><i class = "fa  fa-pencil"></i></a><a href="#"  class= "btn-warning-cancel action-btn bgcolor--fadebrown color--white "><i class = "fa  fa-trash-o"></i></a></span></td>
                          </tr>
                          <tr>
                            <td><span class="cellcontent"><input type="checkbox" class="checkboxes" /></span></td>
                            <td><span class="cellcontent">215</span></td>
                            <td><span class="cellcontent">محمد احمد</span></td>
                            <td><span class="cellcontent">بعض النص بعض النص</span></td>
                            <td><span class="cellcontent">31-09-2017</span></td>
                            <td><span class="cellcontent"><i class = "fa color--fadegreen fa-check"></i></span></td>
                            <td><span class="cellcontent"><a href= "{{route('complains_edit')}}" ,  class= "action-btn bgcolor--fadegreen color--white "><i class = "fa  fa-pencil"></i></a><a href="#"  class= "btn-warning-cancel action-btn bgcolor--fadebrown color--white "><i class = "fa  fa-trash-o"></i></a></span></td>
                          </tr>
                          <tr>
                            <td><span class="cellcontent"><input type="checkbox" class="checkboxes" /></span></td>
                            <td><span class="cellcontent">215</span></td>
                            <td><span class="cellcontent">محمد احمد</span></td>
                            <td><span class="cellcontent">بعض النص بعض النص</span></td>
                            <td><span class="cellcontent">31-09-2017</span></td>
                            <td><span class="cellcontent"><i class = "fa color--fadegreen fa-check"></i></span></td>
                            <td><span class="cellcontent"><a href= "{{route('complains_edit')}}" ,  class= "action-btn bgcolor--fadegreen color--white "><i class = "fa  fa-pencil"></i></a><a href="#"  class= "btn-warning-cancel action-btn bgcolor--fadebrown color--white "><i class = "fa  fa-trash-o"></i></a></span></td>
                          </tr>
                          <tr>
                            <td><span class="cellcontent"><input type="checkbox" class="checkboxes" /></span></td>
                            <td><span class="cellcontent">215</span></td>
                            <td><span class="cellcontent">محمد احمد</span></td>
                            <td><span class="cellcontent">بعض النص بعض النص</span></td>
                            <td><span class="cellcontent">31-09-2017</span></td>
                            <td><span class="cellcontent"><i class = "fa color--fadegreen fa-check"></i></span></td>
                            <td><span class="cellcontent"><a href= "{{route('complains_edit')}}" ,  class= "action-btn bgcolor--fadegreen color--white "><i class = "fa  fa-pencil"></i></a><a href="#"  class= "btn-warning-cancel action-btn bgcolor--fadebrown color--white "><i class = "fa  fa-trash-o"></i></a></span></td>
                          </tr>
                          <tr>
                            <td><span class="cellcontent"><input type="checkbox" class="checkboxes" /></span></td>
                            <td><span class="cellcontent">215</span></td>
                            <td><span class="cellcontent">محمد احمد</span></td>
                            <td><span class="cellcontent">بعض النص بعض النص</span></td>
                            <td><span class="cellcontent">31-09-2017</span></td>
                            <td><span class="cellcontent"><i class = "fa color--fadegreen fa-check"></i></span></td>
                            <td><span class="cellcontent"><a href= "{{route('complains_edit')}}" ,  class= "action-btn bgcolor--fadegreen color--white "><i class = "fa  fa-pencil"></i></a><a href="#"  class= "btn-warning-cancel action-btn bgcolor--fadebrown color--white "><i class = "fa  fa-trash-o"></i></a></span></td>
                          </tr>
                          <tr>
                            <td><span class="cellcontent"><input type="checkbox" class="checkboxes" /></span></td>
                            <td><span class="cellcontent">215</span></td>
                            <td><span class="cellcontent">محمد احمد</span></td>
                            <td><span class="cellcontent">بعض النص بعض النص</span></td>
                            <td><span class="cellcontent">31-09-2017</span></td>
                            <td><span class="cellcontent"><i class = "fa color--fadegreen fa-check"></i></span></td>
                            <td><span class="cellcontent"><a href= "{{route('complains_edit')}}" ,  class= "action-btn bgcolor--fadegreen color--white "><i class = "fa  fa-pencil"></i></a><a href="#"  class= "btn-warning-cancel action-btn bgcolor--fadebrown color--white "><i class = "fa  fa-trash-o"></i></a></span></td>
                          </tr>
                          <tr>
                            <td><span class="cellcontent"><input type="checkbox" class="checkboxes" /></span></td>
                            <td><span class="cellcontent">215</span></td>
                            <td><span class="cellcontent">محمد احمد</span></td>
                            <td><span class="cellcontent">بعض النص بعض النص</span></td>
                            <td><span class="cellcontent">31-09-2017</span></td>
                            <td><span class="cellcontent"><i class = "fa color--fadegreen fa-check"></i></span></td>
                            <td><span class="cellcontent"><a href= "{{route('complains_edit')}}" ,  class= "action-btn bgcolor--fadegreen color--white "><i class = "fa  fa-pencil"></i></a><a href="#"  class= "btn-warning-cancel action-btn bgcolor--fadebrown color--white "><i class = "fa  fa-trash-o"></i></a></span></td>
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


@endsection