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
                      <div class="cover--actions"><span></span>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-lg-12">
                  <div class="cardwrap bgcolor--white bradius--noborder   bshadow--1 padding--small margin--small-top-bottom">
                    <div class="main-title-conts">
                      <div class="caption">
                        <h3> متابعة أماكن السادة المحامين</h3>
                      </div>
                      <div class="actions"><a class="color--white bgcolor--fadeorange bradius--small bshadow--0 master-btn" type="button" href="">13 - 2 - 2018  |  12:00 pm</a>
                      </div><span class="mainseparator bgcolor--main"></span>
                    </div>
                    <div class="cardwrap bgcolor--white bradius--noborder   bshadow--1 padding--small margin--small-top-bottom"> <img src="{{asset('img/map2.jpg')}}" width="1150">
                      <hr>
                      <div class="main-title-conts">
                        <div class="caption">
                          <h3>التفاصيل</h3>
                        </div>
                        <div class="actions">
                        </div><span class="mainseparator bgcolor--main"></span>
                      </div>
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
                            </div>
                            <div class="clearfix"></div>
                            <button class="remodal-cancel" data-remodal-action="cancel">الغاء</button>
                            <button class="remodal-confirm" data-remodal-action="confirm">فلتر</button>
                          </div>
                        </div>
                        <table class="table-1">
                          <thead>
                            <tr class="bgcolor--gray_mm color--gray_d">
                              <th><span class="cellcontent">كود المحامي</span></th>
                              <th><span class="cellcontent">الاسم</span></th>
                              <th><span class="cellcontent">هاتف</span></th>
                              <th><span class="cellcontent">تفعيل</span></th>
                              <th><span class="cellcontent">المكان الحالي</span></th>
                              <th><span class="cellcontent">الاجراءات</span></th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                              <td><span class="cellcontent">12558</span></td>
                              <td><span class="cellcontent">مجدي سليم</span></td>
                              <td><span class="cellcontent">0102345678</span></td>
                              <td><span class="cellcontent"><i class = "fa color--fadegreen fa-check"></i></span></td>
                              <td><span class="cellcontent">55 شارع الثورة - مدينة نصر</span></td>
                              <td><span class="cellcontent"><a href= "{{route('lawyers_show')}}" ,  class= "action-btn bgcolor--main color--white "><i class = "fa  fa-eye"></i></a></span></td>
                            </tr>
                            <tr>
                              <td><span class="cellcontent">12558</span></td>
                              <td><span class="cellcontent">مجدي سليم</span></td>
                              <td><span class="cellcontent">0102345678</span></td>
                              <td><span class="cellcontent"><i class = "fa color--fadegreen fa-check"></i></span></td>
                              <td><span class="cellcontent">55 شارع الثورة - مدينة نصر</span></td>
                              <td><span class="cellcontent"><a href= "{{route('lawyers_show')}}" ,  class= "action-btn bgcolor--main color--white "><i class = "fa  fa-eye"></i></a></span></td>
                            </tr>
                            <tr>
                              <td><span class="cellcontent">12558</span></td>
                              <td><span class="cellcontent">مجدي سليم</span></td>
                              <td><span class="cellcontent">0102345678</span></td>
                              <td><span class="cellcontent"><i class = "fa color--fadegreen fa-check"></i></span></td>
                              <td><span class="cellcontent">55 شارع الثورة - مدينة نصر</span></td>
                              <td><span class="cellcontent"><a href= "{{route('lawyers_show')}}" ,  class= "action-btn bgcolor--main color--white "><i class = "fa  fa-eye"></i></a></span></td>
                            </tr>
                            <tr>
                              <td><span class="cellcontent">12558</span></td>
                              <td><span class="cellcontent">مجدي سليم</span></td>
                              <td><span class="cellcontent">0102345678</span></td>
                              <td><span class="cellcontent"><i class = "fa color--fadegreen fa-check"></i></span></td>
                              <td><span class="cellcontent">55 شارع الثورة - مدينة نصر</span></td>
                              <td><span class="cellcontent"><a href= "{{route('lawyers_show')}}" ,  class= "action-btn bgcolor--main color--white "><i class = "fa  fa-eye"></i></a></span></td>
                            </tr>
                            <tr>
                              <td><span class="cellcontent">12558</span></td>
                              <td><span class="cellcontent">مجدي سليم</span></td>
                              <td><span class="cellcontent">0102345678</span></td>
                              <td><span class="cellcontent"><i class = "fa color--fadegreen fa-check"></i></span></td>
                              <td><span class="cellcontent">55 شارع الثورة - مدينة نصر</span></td>
                              <td><span class="cellcontent"><a href= "{{route('lawyers_show')}}" ,  class= "action-btn bgcolor--main color--white "><i class = "fa  fa-eye"></i></a></span></td>
                            </tr>
                            <tr>
                              <td><span class="cellcontent">12558</span></td>
                              <td><span class="cellcontent">مجدي سليم</span></td>
                              <td><span class="cellcontent">0102345678</span></td>
                              <td><span class="cellcontent"><i class = "fa color--fadegreen fa-check"></i></span></td>
                              <td><span class="cellcontent">55 شارع الثورة - مدينة نصر</span></td>
                              <td><span class="cellcontent"><a href= "{{route('lawyers_show')}}" ,  class= "action-btn bgcolor--main color--white "><i class = "fa  fa-eye"></i></a></span></td>
                            </tr>
                            <tr>
                              <td><span class="cellcontent">12558</span></td>
                              <td><span class="cellcontent">مجدي سليم</span></td>
                              <td><span class="cellcontent">0102345678</span></td>
                              <td><span class="cellcontent"><i class = "fa color--fadegreen fa-check"></i></span></td>
                              <td><span class="cellcontent">55 شارع الثورة - مدينة نصر</span></td>
                              <td><span class="cellcontent"><a href= "{{route('lawyers_show')}}" ,  class= "action-btn bgcolor--main color--white "><i class = "fa  fa-eye"></i></a></span></td>
                            </tr>
                            <tr>
                              <td><span class="cellcontent">12558</span></td>
                              <td><span class="cellcontent">مجدي سليم</span></td>
                              <td><span class="cellcontent">0102345678</span></td>
                              <td><span class="cellcontent"><i class = "fa color--fadegreen fa-check"></i></span></td>
                              <td><span class="cellcontent">55 شارع الثورة - مدينة نصر</span></td>
                              <td><span class="cellcontent"><a href= "{{route('lawyers_show')}}" ,  class= "action-btn bgcolor--main color--white "><i class = "fa  fa-eye"></i></a></span></td>
                            </tr>
                            <tr>
                              <td><span class="cellcontent">12558</span></td>
                              <td><span class="cellcontent">مجدي سليم</span></td>
                              <td><span class="cellcontent">0102345678</span></td>
                              <td><span class="cellcontent"><i class = "fa color--fadegreen fa-check"></i></span></td>
                              <td><span class="cellcontent">55 شارع الثورة - مدينة نصر</span></td>
                              <td><span class="cellcontent"><a href= "{{route('lawyers_show')}}" ,  class= "action-btn bgcolor--main color--white "><i class = "fa  fa-eye"></i></a></span></td>
                            </tr>
                            <tr>
                              <td><span class="cellcontent">12558</span></td>
                              <td><span class="cellcontent">مجدي سليم</span></td>
                              <td><span class="cellcontent">0102345678</span></td>
                              <td><span class="cellcontent"><i class = "fa color--fadegreen fa-check"></i></span></td>
                              <td><span class="cellcontent">55 شارع الثورة - مدينة نصر</span></td>
                              <td><span class="cellcontent"><a href= "{{route('lawyers_show')}}" ,  class= "action-btn bgcolor--main color--white "><i class = "fa  fa-eye"></i></a></span></td>
                            </tr>
                            <tr>
                              <td><span class="cellcontent">12558</span></td>
                              <td><span class="cellcontent">مجدي سليم</span></td>
                              <td><span class="cellcontent">0102345678</span></td>
                              <td><span class="cellcontent"><i class = "fa color--fadegreen fa-check"></i></span></td>
                              <td><span class="cellcontent">55 شارع الثورة - مدينة نصر</span></td>
                              <td><span class="cellcontent"><a href= "{{route('lawyers_show')}}" ,  class= "action-btn bgcolor--main color--white "><i class = "fa  fa-eye"></i></a></span></td>
                            </tr>
                            <tr>
                              <td><span class="cellcontent">12558</span></td>
                              <td><span class="cellcontent">مجدي سليم</span></td>
                              <td><span class="cellcontent">0102345678</span></td>
                              <td><span class="cellcontent"><i class = "fa color--fadegreen fa-check"></i></span></td>
                              <td><span class="cellcontent">55 شارع الثورة - مدينة نصر</span></td>
                              <td><span class="cellcontent"><a href= "{{route('lawyers_show')}}" ,  class= "action-btn bgcolor--main color--white "><i class = "fa  fa-eye"></i></a></span></td>
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
              </div>

@endsection