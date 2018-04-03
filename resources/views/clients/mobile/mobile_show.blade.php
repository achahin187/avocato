@extends('layout.app')
@section('content')

              <div class="row">
                <div class="col-lg-12">
                  <div class="coverglobal text-center bshadow--2" style="background:#000 url( '{{asset('img/covers/dummy2.jpg')}}') no-repeat center center; background-size:cover;"><span></span>
                    <div class="container">
                      <div class="row">
                        <div class="col-xs-12">
                          <div class="text-xs-center"><a href=""><img class="coverglobal__avatar" src="{{asset('img/avatars/male.jpg')}}">
                              <h3 class="coverglobal__title color--gray_d">محمد احمد</h3><small class="coverglobal__slogan color--gray_d">مفعل</small></a></div>
                          <div class="coverglobal__actions"><a class="color--gray_d bordercolor-gray_d bradius--small border-btn master-btn" type="button" href="{{route('individuals_create')}}">التحويل لعميل أفراد</a><a class="color--gray_d bordercolor-gray_d bradius--small border-btn master-btn" type="button" href="{{route('companies_create')}}">التحويل لعميل شركات</a><a class="color--gray_d bordercolor-gray_d bradius--small border-btn master-btn" type="button" href="{{route('individuals_companies_create')}}">التحويل لعميل شركات – افراد</a>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-lg-12">
                  <div class="cardwrap bgcolor--white bradius--noborder   bshadow--1 padding--small margin--small-top-bottom">
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <div class="row"><b class="col-xs-3">كود العميل</b>
                        <div class="col-xs-9">04567890</div>
                      </div>
                      <div class="row"><b class="col-xs-3">العنوان </b>
                        <div class="col-xs-9">شارع ال 90 التجمع الخامس</div>
                      </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <div class="row"><b class="col-xs-3">البريد الالكترونى </b>
                        <div class="col-xs-9">company@info.com</div>
                      </div>
                      <div class="row"><b class="col-xs-3">جوال </b>
                        <div class="col-xs-9">01234567890</div>
                      </div>
                    </div>
                    <div class="clearfix"></div>
                  </div>
                  <div class="cardwrap bgcolor--white bradius--noborder   bshadow--1 padding--small margin--small-top-bottom">
                    <div class="main-title-conts">
                      <div class="caption">
                        <h3>الإستشارات القانونية</h3>
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
                                <label class="master_label mandatory" for="type">التصنيف</label>
                                <select class="master_input select2" id="type" multiple="multiple" data-placeholder="التصنيف" style="width:100%;" ,>
                                  <option>تصنيف 1</option>
                                  <option>تصنيف2</option>
                                </select><span class="master_message color--fadegreen">message content</span>
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="master_field">
                                <label class="master_label mandatory" for="date_from">تاريخ الاستشارة من</label>
                                <div class="bootstrap-timepicker">
                                  <input class="datepicker master_input" type="text" placeholder="تاريخ الاستشارة" id="date_from">
                                </div><span class="master_message color--fadegreen">message content</span>
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="master_field">
                                <label class="master_label mandatory" for="date_to">تاريخ الاستشارة الى</label>
                                <div class="bootstrap-timepicker">
                                  <input class="datepicker master_input" type="text" placeholder="تاريخ الاستشارة" id="date_to">
                                </div><span class="master_message color--fadegreen">message content</span>
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="master_field">
                                <label class="master_label mandatory">الحالة</label>
                                <div class="radiorobo">
                                  <input type="radio" id="rad_1">
                                  <label for="rad_1">الكل</label>
                                </div>
                                <div class="radiorobo">
                                  <input type="radio" id="rad_2">
                                  <label for="rad_2">تم الرد</label>
                                </div>
                                <div class="radiorobo">
                                  <input type="radio" id="rad_3">
                                  <label for="rad_3">لم يتم الرد</label>
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
                            <th><span class="cellcontent">كود</span></th>
                            <th><span class="cellcontent">تصنيف</span></th>
                            <th><span class="cellcontent">سؤال الاستشارة</span></th>
                            <th><span class="cellcontent">تاريخ الاستشارة</span></th>
                            <th><span class="cellcontent">تم الرد</span></th>
                            <th><span class="cellcontent">الاجراءات</span></th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td><span class="cellcontent"><input type="checkbox" class="checkboxes" /></span></td>
                            <td><span class="cellcontent">32135</span></td>
                            <td><span class="cellcontent">التصنيف</span></td>
                            <td><span class="cellcontent">نص السؤال</span></td>
                            <td><span class="cellcontent">20-9-2014</span></td>
                            <td><span class="cellcontent"><i class = "fa color--fadegreen fa-check"></i></span></td>
                            <td><span class="cellcontent"><a href= "{{route('legal_consultations_show')}}" ,  class= "action-btn bgcolor--main color--white "><i class = "fa  fa-eye"></i></a><a href= "{{route('legal_consultations_edit')}}" ,  class= "action-btn bgcolor--fadegreen color--white "><i class = "fa  fa-pencil"></i></a><a href="#"  class= "btn-warning-cancel action-btn bgcolor--fadebrown color--white "><i class = "fa  fa-trash-o"></i></a></span></td>
                          </tr>
                          <tr>
                            <td><span class="cellcontent"><input type="checkbox" class="checkboxes" /></span></td>
                            <td><span class="cellcontent">32135</span></td>
                            <td><span class="cellcontent">التصنيف</span></td>
                            <td><span class="cellcontent">نص السؤال</span></td>
                            <td><span class="cellcontent">20-9-2014</span></td>
                            <td><span class="cellcontent"><i class = "fa color--fadegreen fa-check"></i></span></td>
                            <td><span class="cellcontent"><a href= "{{route('legal_consultations_show')}}" ,  class= "action-btn bgcolor--main color--white "><i class = "fa  fa-eye"></i></a><a href= "{{route('legal_consultations_edit')}}" ,  class= "action-btn bgcolor--fadegreen color--white "><i class = "fa  fa-pencil"></i></a><a href="#"  class= "btn-warning-cancel action-btn bgcolor--fadebrown color--white "><i class = "fa  fa-trash-o"></i></a></span></td>
                          </tr>
                          <tr>
                            <td><span class="cellcontent"><input type="checkbox" class="checkboxes" /></span></td>
                            <td><span class="cellcontent">32135</span></td>
                            <td><span class="cellcontent">التصنيف</span></td>
                            <td><span class="cellcontent">نص السؤال</span></td>
                            <td><span class="cellcontent">20-9-2014</span></td>
                            <td><span class="cellcontent"><i class = "fa color--fadegreen fa-check"></i></span></td>
                            <td><span class="cellcontent"><a href= "{{route('legal_consultations_show')}}" ,  class= "action-btn bgcolor--main color--white "><i class = "fa  fa-eye"></i></a><a href= "{{route('legal_consultations_edit')}}" ,  class= "action-btn bgcolor--fadegreen color--white "><i class = "fa  fa-pencil"></i></a><a href="#"  class= "btn-warning-cancel action-btn bgcolor--fadebrown color--white "><i class = "fa  fa-trash-o"></i></a></span></td>
                          </tr>
                          <tr>
                            <td><span class="cellcontent"><input type="checkbox" class="checkboxes" /></span></td>
                            <td><span class="cellcontent">32135</span></td>
                            <td><span class="cellcontent">التصنيف</span></td>
                            <td><span class="cellcontent">نص السؤال</span></td>
                            <td><span class="cellcontent">20-9-2014</span></td>
                            <td><span class="cellcontent"><i class = "fa color--fadegreen fa-check"></i></span></td>
                            <td><span class="cellcontent"><a href= "{{route('legal_consultations_show')}}" ,  class= "action-btn bgcolor--main color--white "><i class = "fa  fa-eye"></i></a><a href= "{{route('legal_consultations_edit')}}" ,  class= "action-btn bgcolor--fadegreen color--white "><i class = "fa  fa-pencil"></i></a><a href="#"  class= "btn-warning-cancel action-btn bgcolor--fadebrown color--white "><i class = "fa  fa-trash-o"></i></a></span></td>
                          </tr>
                          <tr>
                            <td><span class="cellcontent"><input type="checkbox" class="checkboxes" /></span></td>
                            <td><span class="cellcontent">32135</span></td>
                            <td><span class="cellcontent">التصنيف</span></td>
                            <td><span class="cellcontent">نص السؤال</span></td>
                            <td><span class="cellcontent">20-9-2014</span></td>
                            <td><span class="cellcontent"><i class = "fa color--fadegreen fa-check"></i></span></td>
                            <td><span class="cellcontent"><a href= "{{route('legal_consultations_show')}}" ,  class= "action-btn bgcolor--main color--white "><i class = "fa  fa-eye"></i></a><a href= "{{route('legal_consultations_edit')}}" ,  class= "action-btn bgcolor--fadegreen color--white "><i class = "fa  fa-pencil"></i></a><a href="#"  class= "btn-warning-cancel action-btn bgcolor--fadebrown color--white "><i class = "fa  fa-trash-o"></i></a></span></td>
                          </tr>
                          <tr>
                            <td><span class="cellcontent"><input type="checkbox" class="checkboxes" /></span></td>
                            <td><span class="cellcontent">32135</span></td>
                            <td><span class="cellcontent">التصنيف</span></td>
                            <td><span class="cellcontent">نص السؤال</span></td>
                            <td><span class="cellcontent">20-9-2014</span></td>
                            <td><span class="cellcontent"><i class = "fa color--fadegreen fa-check"></i></span></td>
                            <td><span class="cellcontent"><a href= "{{route('legal_consultations_show')}}" ,  class= "action-btn bgcolor--main color--white "><i class = "fa  fa-eye"></i></a><a href= "{{route('legal_consultations_edit')}}" ,  class= "action-btn bgcolor--fadegreen color--white "><i class = "fa  fa-pencil"></i></a><a href="#"  class= "btn-warning-cancel action-btn bgcolor--fadebrown color--white "><i class = "fa  fa-trash-o"></i></a></span></td>
                          </tr>
                          <tr>
                            <td><span class="cellcontent"><input type="checkbox" class="checkboxes" /></span></td>
                            <td><span class="cellcontent">32135</span></td>
                            <td><span class="cellcontent">التصنيف</span></td>
                            <td><span class="cellcontent">نص السؤال</span></td>
                            <td><span class="cellcontent">20-9-2014</span></td>
                            <td><span class="cellcontent"><i class = "fa color--fadegreen fa-check"></i></span></td>
                            <td><span class="cellcontent"><a href= "{{route('legal_consultations_show')}}" ,  class= "action-btn bgcolor--main color--white "><i class = "fa  fa-eye"></i></a><a href= "{{route('legal_consultations_edit')}}" ,  class= "action-btn bgcolor--fadegreen color--white "><i class = "fa  fa-pencil"></i></a><a href="#"  class= "btn-warning-cancel action-btn bgcolor--fadebrown color--white "><i class = "fa  fa-trash-o"></i></a></span></td>
                          </tr>
                          <tr>
                            <td><span class="cellcontent"><input type="checkbox" class="checkboxes" /></span></td>
                            <td><span class="cellcontent">32135</span></td>
                            <td><span class="cellcontent">التصنيف</span></td>
                            <td><span class="cellcontent">نص السؤال</span></td>
                            <td><span class="cellcontent">20-9-2014</span></td>
                            <td><span class="cellcontent"><i class = "fa color--fadegreen fa-check"></i></span></td>
                            <td><span class="cellcontent"><a href= "{{route('legal_consultations_show')}}" ,  class= "action-btn bgcolor--main color--white "><i class = "fa  fa-eye"></i></a><a href= "{{route('legal_consultations_edit')}}" ,  class= "action-btn bgcolor--fadegreen color--white "><i class = "fa  fa-pencil"></i></a><a href="#"  class= "btn-warning-cancel action-btn bgcolor--fadebrown color--white "><i class = "fa  fa-trash-o"></i></a></span></td>
                          </tr>
                          <tr>
                            <td><span class="cellcontent"><input type="checkbox" class="checkboxes" /></span></td>
                            <td><span class="cellcontent">32135</span></td>
                            <td><span class="cellcontent">التصنيف</span></td>
                            <td><span class="cellcontent">نص السؤال</span></td>
                            <td><span class="cellcontent">20-9-2014</span></td>
                            <td><span class="cellcontent"><i class = "fa color--fadegreen fa-check"></i></span></td>
                            <td><span class="cellcontent"><a href= "{{route('legal_consultations_show')}}" ,  class= "action-btn bgcolor--main color--white "><i class = "fa  fa-eye"></i></a><a href= "{{route('legal_consultations_edit')}}" ,  class= "action-btn bgcolor--fadegreen color--white "><i class = "fa  fa-pencil"></i></a><a href="#"  class= "btn-warning-cancel action-btn bgcolor--fadebrown color--white "><i class = "fa  fa-trash-o"></i></a></span></td>
                          </tr>
                          <tr>
                            <td><span class="cellcontent"><input type="checkbox" class="checkboxes" /></span></td>
                            <td><span class="cellcontent">32135</span></td>
                            <td><span class="cellcontent">التصنيف</span></td>
                            <td><span class="cellcontent">نص السؤال</span></td>
                            <td><span class="cellcontent">20-9-2014</span></td>
                            <td><span class="cellcontent"><i class = "fa color--fadegreen fa-check"></i></span></td>
                            <td><span class="cellcontent"><a href= "{{route('legal_consultations_show')}}" ,  class= "action-btn bgcolor--main color--white "><i class = "fa  fa-eye"></i></a><a href= "{{route('legal_consultations_edit')}}" ,  class= "action-btn bgcolor--fadegreen color--white "><i class = "fa  fa-pencil"></i></a><a href="#"  class= "btn-warning-cancel action-btn bgcolor--fadebrown color--white "><i class = "fa  fa-trash-o"></i></a></span></td>
                          </tr>
                          <tr>
                            <td><span class="cellcontent"><input type="checkbox" class="checkboxes" /></span></td>
                            <td><span class="cellcontent">32135</span></td>
                            <td><span class="cellcontent">التصنيف</span></td>
                            <td><span class="cellcontent">نص السؤال</span></td>
                            <td><span class="cellcontent">20-9-2014</span></td>
                            <td><span class="cellcontent"><i class = "fa color--fadegreen fa-check"></i></span></td>
                            <td><span class="cellcontent"><a href= "{{route('legal_consultations_show')}}" ,  class= "action-btn bgcolor--main color--white "><i class = "fa  fa-eye"></i></a><a href= "{{route('legal_consultations_edit')}}" ,  class= "action-btn bgcolor--fadegreen color--white "><i class = "fa  fa-pencil"></i></a><a href="#"  class= "btn-warning-cancel action-btn bgcolor--fadebrown color--white "><i class = "fa  fa-trash-o"></i></a></span></td>
                          </tr>
                          <tr>
                            <td><span class="cellcontent"><input type="checkbox" class="checkboxes" /></span></td>
                            <td><span class="cellcontent">32135</span></td>
                            <td><span class="cellcontent">التصنيف</span></td>
                            <td><span class="cellcontent">نص السؤال</span></td>
                            <td><span class="cellcontent">20-9-2014</span></td>
                            <td><span class="cellcontent"><i class = "fa color--fadegreen fa-check"></i></span></td>
                            <td><span class="cellcontent"><a href= "{{route('legal_consultations_show')}}" ,  class= "action-btn bgcolor--main color--white "><i class = "fa  fa-eye"></i></a><a href= "{{route('legal_consultations_edit')}}" ,  class= "action-btn bgcolor--fadegreen color--white "><i class = "fa  fa-pencil"></i></a><a href="#"  class= "btn-warning-cancel action-btn bgcolor--fadebrown color--white "><i class = "fa  fa-trash-o"></i></a></span></td>
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