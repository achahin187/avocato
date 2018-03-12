@extends('layout.app')
@section('content')

              <div class="row">
                <div class="col-lg-12">
                  <div class="cover-inside-container margin--small-top-bottom bradius--small bshadow--1" style="background:  url( '{{asset('img/covers/dummy2.jpg')}}' ) no-repeat center center; background-size:cover;">
                    <div class="row">
                      <div class="col-xs-12">
                        <div class="text-xs-center">
                          <div class="text-wraper">
                            <h4 class="cover-inside-title color--gray_d">دفتر المحضرين</h4>
                          </div>
                        </div>
                      </div>
                      <div class="cover--actions"><a class="color--gray_d bordercolor--white bradius--small border-btn master-btn" type="button" href="{{route('records_create')}}">اضافة</a>
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
                            <div class="col-md-6">
                              <div class="master_field">
                                <label class="master_label mandatory" for="record_num">رقم الاعلان</label>
                                <input class="master_input" type="number" placeholder="رقم الاعلان" id="record_num"><span class="master_message color--fadegreen">message</span>
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="master_field">
                                <label class="master_label mandatory" for="record_pen"> قلم المحضرين </label>
                                <select class="master_input select2" id="record_pen" multiple="multiple" data-placeholder="قلم المحضرين " style="width:100%;" ,>
                                  <option>عابدين</option>
                                  <option>الدقى</option>
                                </select><span class="master_message color--fadegreen">message content</span>
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="master_field">
                                <label class="master_label mandatory" for="client_name">اسم الموكل</label>
                                <input class="master_input" type="text" placeholder="اسم الموكل" id="client_name"><span class="master_message color--fadegreen">message</span>
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="master_field">
                                <label class="master_label mandatory" for="date_from">تاريخ التسليم من</label>
                                <div class="bootstrap-timepicker">
                                  <input class="datepicker master_input" type="text" placeholder="تاريخ التسليم" id="date_from">
                                </div><span class="master_message color--fadegreen">message content</span>
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="master_field">
                                <label class="master_label mandatory" for="date_to">تاريخ التسلم الى</label>
                                <div class="bootstrap-timepicker">
                                  <input class="datepicker master_input" type="text" placeholder="تاريخ التسلم" id="date_to">
                                </div><span class="master_message color--fadegreen">message content</span>
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="master_field">
                                <label class="master_label mandatory" for="session_date">تاريخ الجلسة</label>
                                <div class="bootstrap-timepicker">
                                  <input class="datepicker master_input" type="text" placeholder="تاريخ الجلسة" id="session_date">
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
                      <div class="bottomActions__btns"><a class="master-btn bradius--small padding--small bgcolor--fadeorange color--white" href="#">حذف المحدد</a>
                      </div>
                      <table class="table-1">
                        <thead>
                          <tr class="bgcolor--gray_mm color--gray_d">
                            <th><span class="cellcontent">&lt;input type=&quot;checkbox&quot; name=&quot;select-all&quot; id=&quot;select-all&quot; /&gt;</span></th>
                            <th><span class="cellcontent">رقم الاعلان</span></th>
                            <th><span class="cellcontent">قلم المحضرين</span></th>
                            <th><span class="cellcontent">اسم الموكل</span></th>
                            <th><span class="cellcontent">تاريخ التسليم</span></th>
                            <th><span class="cellcontent">تاريخ التسلم</span></th>
                            <th><span class="cellcontent">تاريخ الجلسة</span></th>
                            <th><span class="cellcontent">ملاحظات</span></th>
                            <th><span class="cellcontent">الإجراءات</span></th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td><span class="cellcontent"><input type="checkbox" class="checkboxes" /></span></td>
                            <td><span class="cellcontent">20122</span></td>
                            <td><span class="cellcontent">عابدين</span></td>
                            <td><span class="cellcontent">محمد حمدي</span></td>
                            <td><span class="cellcontent">09-2015</span></td>
                            <td><span class="cellcontent">09-2015</span></td>
                            <td><span class="cellcontent">09-2015</span></td>
                            <td><span class="cellcontent">تم الاستلام</span></td>
                            <td><span class="cellcontent"><a href="#"  class= "btn-warning-cancel action-btn bgcolor--fadebrown color--white "><i class = "fa  fa-trash-o"></i></a></span></td>
                          </tr>
                          <tr>
                            <td><span class="cellcontent"><input type="checkbox" class="checkboxes" /></span></td>
                            <td><span class="cellcontent">20122</span></td>
                            <td><span class="cellcontent">عابدين</span></td>
                            <td><span class="cellcontent">محمد حمدي</span></td>
                            <td><span class="cellcontent">09-2015</span></td>
                            <td><span class="cellcontent">09-2015</span></td>
                            <td><span class="cellcontent">09-2015</span></td>
                            <td><span class="cellcontent">تم الاستلام</span></td>
                            <td><span class="cellcontent"><a href="#"  class= "btn-warning-cancel action-btn bgcolor--fadebrown color--white "><i class = "fa  fa-trash-o"></i></a></span></td>
                          </tr>
                          <tr>
                            <td><span class="cellcontent"><input type="checkbox" class="checkboxes" /></span></td>
                            <td><span class="cellcontent">20122</span></td>
                            <td><span class="cellcontent">عابدين</span></td>
                            <td><span class="cellcontent">محمد حمدي</span></td>
                            <td><span class="cellcontent">09-2015</span></td>
                            <td><span class="cellcontent">09-2015</span></td>
                            <td><span class="cellcontent">09-2015</span></td>
                            <td><span class="cellcontent">تم الاستلام</span></td>
                            <td><span class="cellcontent"><a href="#"  class= "btn-warning-cancel action-btn bgcolor--fadebrown color--white "><i class = "fa  fa-trash-o"></i></a></span></td>
                          </tr>
                          <tr>
                            <td><span class="cellcontent"><input type="checkbox" class="checkboxes" /></span></td>
                            <td><span class="cellcontent">20122</span></td>
                            <td><span class="cellcontent">عابدين</span></td>
                            <td><span class="cellcontent">محمد حمدي</span></td>
                            <td><span class="cellcontent">09-2015</span></td>
                            <td><span class="cellcontent">09-2015</span></td>
                            <td><span class="cellcontent">09-2015</span></td>
                            <td><span class="cellcontent">تم الاستلام</span></td>
                            <td><span class="cellcontent"><a href="#"  class= "btn-warning-cancel action-btn bgcolor--fadebrown color--white "><i class = "fa  fa-trash-o"></i></a></span></td>
                          </tr>
                          <tr>
                            <td><span class="cellcontent"><input type="checkbox" class="checkboxes" /></span></td>
                            <td><span class="cellcontent">20122</span></td>
                            <td><span class="cellcontent">عابدين</span></td>
                            <td><span class="cellcontent">محمد حمدي</span></td>
                            <td><span class="cellcontent">09-2015</span></td>
                            <td><span class="cellcontent">09-2015</span></td>
                            <td><span class="cellcontent">09-2015</span></td>
                            <td><span class="cellcontent">تم الاستلام</span></td>
                            <td><span class="cellcontent"><a href="#"  class= "btn-warning-cancel action-btn bgcolor--fadebrown color--white "><i class = "fa  fa-trash-o"></i></a></span></td>
                          </tr>
                          <tr>
                            <td><span class="cellcontent"><input type="checkbox" class="checkboxes" /></span></td>
                            <td><span class="cellcontent">20122</span></td>
                            <td><span class="cellcontent">عابدين</span></td>
                            <td><span class="cellcontent">محمد حمدي</span></td>
                            <td><span class="cellcontent">09-2015</span></td>
                            <td><span class="cellcontent">09-2015</span></td>
                            <td><span class="cellcontent">09-2015</span></td>
                            <td><span class="cellcontent">تم الاستلام</span></td>
                            <td><span class="cellcontent"><a href="#"  class= "btn-warning-cancel action-btn bgcolor--fadebrown color--white "><i class = "fa  fa-trash-o"></i></a></span></td>
                          </tr>
                          <tr>
                            <td><span class="cellcontent"><input type="checkbox" class="checkboxes" /></span></td>
                            <td><span class="cellcontent">20122</span></td>
                            <td><span class="cellcontent">عابدين</span></td>
                            <td><span class="cellcontent">محمد حمدي</span></td>
                            <td><span class="cellcontent">09-2015</span></td>
                            <td><span class="cellcontent">09-2015</span></td>
                            <td><span class="cellcontent">09-2015</span></td>
                            <td><span class="cellcontent">تم الاستلام</span></td>
                            <td><span class="cellcontent"><a href="#"  class= "btn-warning-cancel action-btn bgcolor--fadebrown color--white "><i class = "fa  fa-trash-o"></i></a></span></td>
                          </tr>
                          <tr>
                            <td><span class="cellcontent"><input type="checkbox" class="checkboxes" /></span></td>
                            <td><span class="cellcontent">20122</span></td>
                            <td><span class="cellcontent">عابدين</span></td>
                            <td><span class="cellcontent">محمد حمدي</span></td>
                            <td><span class="cellcontent">09-2015</span></td>
                            <td><span class="cellcontent">09-2015</span></td>
                            <td><span class="cellcontent">09-2015</span></td>
                            <td><span class="cellcontent">تم الاستلام</span></td>
                            <td><span class="cellcontent"><a href="#"  class= "btn-warning-cancel action-btn bgcolor--fadebrown color--white "><i class = "fa  fa-trash-o"></i></a></span></td>
                          </tr>
                          <tr>
                            <td><span class="cellcontent"><input type="checkbox" class="checkboxes" /></span></td>
                            <td><span class="cellcontent">20122</span></td>
                            <td><span class="cellcontent">عابدين</span></td>
                            <td><span class="cellcontent">محمد حمدي</span></td>
                            <td><span class="cellcontent">09-2015</span></td>
                            <td><span class="cellcontent">09-2015</span></td>
                            <td><span class="cellcontent">09-2015</span></td>
                            <td><span class="cellcontent">تم الاستلام</span></td>
                            <td><span class="cellcontent"><a href="#"  class= "btn-warning-cancel action-btn bgcolor--fadebrown color--white "><i class = "fa  fa-trash-o"></i></a></span></td>
                          </tr>
                          <tr>
                            <td><span class="cellcontent"><input type="checkbox" class="checkboxes" /></span></td>
                            <td><span class="cellcontent">20122</span></td>
                            <td><span class="cellcontent">عابدين</span></td>
                            <td><span class="cellcontent">محمد حمدي</span></td>
                            <td><span class="cellcontent">09-2015</span></td>
                            <td><span class="cellcontent">09-2015</span></td>
                            <td><span class="cellcontent">09-2015</span></td>
                            <td><span class="cellcontent">تم الاستلام</span></td>
                            <td><span class="cellcontent"><a href="#"  class= "btn-warning-cancel action-btn bgcolor--fadebrown color--white "><i class = "fa  fa-trash-o"></i></a></span></td>
                          </tr>
                          <tr>
                            <td><span class="cellcontent"><input type="checkbox" class="checkboxes" /></span></td>
                            <td><span class="cellcontent">20122</span></td>
                            <td><span class="cellcontent">عابدين</span></td>
                            <td><span class="cellcontent">محمد حمدي</span></td>
                            <td><span class="cellcontent">09-2015</span></td>
                            <td><span class="cellcontent">09-2015</span></td>
                            <td><span class="cellcontent">09-2015</span></td>
                            <td><span class="cellcontent">تم الاستلام</span></td>
                            <td><span class="cellcontent"><a href="#"  class= "btn-warning-cancel action-btn bgcolor--fadebrown color--white "><i class = "fa  fa-trash-o"></i></a></span></td>
                          </tr>
                          <tr>
                            <td><span class="cellcontent"><input type="checkbox" class="checkboxes" /></span></td>
                            <td><span class="cellcontent">20122</span></td>
                            <td><span class="cellcontent">عابدين</span></td>
                            <td><span class="cellcontent">محمد حمدي</span></td>
                            <td><span class="cellcontent">09-2015</span></td>
                            <td><span class="cellcontent">09-2015</span></td>
                            <td><span class="cellcontent">09-2015</span></td>
                            <td><span class="cellcontent">تم الاستلام</span></td>
                            <td><span class="cellcontent"><a href="#"  class= "btn-warning-cancel action-btn bgcolor--fadebrown color--white "><i class = "fa  fa-trash-o"></i></a></span></td>
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