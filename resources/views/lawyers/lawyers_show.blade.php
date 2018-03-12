@extends('layout.app')
@section('content')

              <div class="row">
                <div class="col-lg-12">
                  <div class="coverglobal text-center bshadow--2" style="background:#000 url( '{{asset('img/covers/dummy2.jpg')}}') no-repeat center center; background-size:cover;"><span></span>
                    <div class="container">
                      <div class="row">
                        <div class="col-xs-12">
                          <div class="text-xs-center"><a href="user_profile.html"><img class="coverglobal__avatar" src="{{asset('img/avaters/male.jpg')}}">
                              <h3 class="coverglobal__title color--gray_d">محمد احمد</h3><small class="coverglobal__slogan color--gray_d">مفعل</small></a></div>
                          <div class="coverglobal__actions"><a class="color--gray_d bordercolor-gray_d bradius--small border-btn master-btn" type="button" href="assign_lawyer_task.html">تعيين مهمة للمحامي</a><a class="color--gray_d bordercolor-gray_d bradius--small border-btn master-btn" type="button" href="{{route('lawyers_edit')}}">تعديل البيانات</a><a class="color--gray_d bordercolor-gray_d bradius--small border-btn master-btn" type="button" href="">استبعاد المحامي</a>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-lg-12">
                  <div class="cardwrap bgcolor--white bradius--noborder   bshadow--1 padding--small margin--small-top-bottom">
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <div class="row"><b class="col-xs-3">عنوان المحامى </b>
                        <div class="col-xs-9"> شارع 90 - التجمع الخامس</div>
                      </div>
                      <div class="row"><b class="col-xs-3">الرقم القومى </b>
                        <div class="col-xs-4">1090903840</div>
                        <div class="col-xs-3">(مصري)</div>
                      </div>
                      <div class="row"><b class="col-xs-3">تاريخ الميلاد </b>
                        <div class="col-xs-9">20-12-2019</div>
                      </div>
                      <div class="row"><b class="col-xs-3">هاتف </b>
                        <div class="col-xs-9">9123489</div>
                      </div>
                      <div class="row"><b class="col-xs-3">جوال </b>
                        <div class="col-xs-9">0123456789</div>
                      </div>
                      <div class="row"><b class="col-xs-3">البريد الالكترونى </b>
                        <div class="col-xs-9">mohamed@gmail.com</div>
                      </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12"><img class="img-responsive" src="https://www.taitradio.com/__data/assets/image/0016/114910/location-sol-header.jpg" height="140" width="450"></div>
                    <div class="clearfix"></div>
                  </div>
                  <div class="tabs--wrapper">
                    <div class="clearfix"></div>
                    <ul class="tabs">
                      <li>معلومات أخري</li>
                      <li>جدول المهام الأسبوعي</li>
                      <li>القضايا</li>
                      <li>الخدمات</li>
                      <li>المصاريف</li>
                    </ul>
                    <ul class="tab__content">
                      <li class="tab__content_item active">
                        <div class="cardwrap bgcolor--white bradius--noborder   bshadow--1 padding--small margin--small-top-bottom">
                          <div class="row">
                            <div class="col-xs-6"><b class="col-xs-3">درجة القيد بالنقابة </b>
                              <div class="col-xs-9">محامي تحت التمرين</div>
                            </div>
                            <div class="col-xs-6"><b class="col-xs-3">درجة التقاضي</b>
                              <div class="col-xs-9">محامى تحت التمرين</div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-xs-6"><b class="col-xs-4">الاختصاص المكاني</b>
                              <div class="col-xs-8">text</div>
                            </div>
                            <div class="col-xs-6"><b class="col-xs-4">التخصص </b>
                              <div class="col-xs-8"> جنح</div>
                            </div>
                            <div class="col-xs-6"><b class="col-xs-4">تاريخ الإتحاق بالعمل بالشركة</b>
                              <div class="col-xs-8">12/6/2017</div>
                            </div>
                            <div class="col-xs-6"><b class="col-xs-4">تاريخ انتهاء العمل بالشركة</b>
                              <div class="col-xs-8">12/6/2017</div>
                            </div>
                          </div>
                          <div class="col-md-5">
                            <div class="cardwrap bgcolor--white bradius--noborder   bshadow--1 padding--small margin--small-top-bottom">
                              <div class="card--1"><a class="color--main"><img class="img-responsive bradius--noborder  " src="../img/dynamic/products-categories.jpg">
                                  <h4 class="text-center">كارنيه النقابة</h4></a></div>
                            </div>
                            <div class="clearfix"></div>
                          </div>
                          <div class="col-md-5">
                            <div class="cardwrap bgcolor--white bradius--noborder   bshadow--1 padding--small margin--small-top-bottom">
                              <div class="card--1"><a class="color--main"><img class="img-responsive bradius--noborder  " src="../img/dynamic/products-categories.jpg">
                                  <h4 class="text-center">صورة التوكيل</h4></a></div>
                            </div>
                            <div class="clearfix"></div>
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
                          <div class="panel-collapse collapse" id="collapse-1" role="tabpanel" aria-labelledby="heading-1" aria-expanded="true">
                            <div class="panel-body bgcolor--white bradius--noborder bshadow--1 padding--small margin--small-top-bottom">
                              <div class="col-md-12 right-text"><a href="case_view.html">اسم القضية </a>
                                <div class="pull-right">
                                  <label class="data-label-round bgcolor--fadegreen color--white">4-2-2018</label>
                                </div>
                              </div>
                              <div class="clearfix"></div>
                              <hr>
                              <div class="col-md-12 right-text"><a href="service_view.html">اسم الخدمة</a>
                                <div class="pull-right">
                                  <label class="data-label-round bgcolor--fadegreen color--white">6-2-2018</label>
                                </div>
                              </div>
                              <div class="clearfix"></div>
                              <hr>
                              <div class="col-md-12 right-text"><a href="case_view.html">اسم القضية </a>
                                <div class="pull-right">
                                  <label class="data-label-round bgcolor--fadegreen color--white">4-2-2018</label>
                                </div>
                              </div>
                              <div class="clearfix"></div>
                              <hr>
                              <div class="col-md-12 right-text"><a href="service_view.html">اسم الخدمة</a>
                                <div class="pull-right">
                                  <label class="data-label-round bgcolor--fadegreen color--white">6-2-2018</label>
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
                              <div class="col-md-12 right-text"><a href="case_view.html">اسم القضية </a>
                                <div class="pull-right">
                                  <label class="data-label-round bgcolor--fadegreen color--white">4-2-2018</label>
                                </div>
                              </div>
                              <div class="clearfix"></div>
                              <hr>
                              <div class="col-md-12 right-text"><a href="service_view.html">اسم الخدمة</a>
                                <div class="pull-right">
                                  <label class="data-label-round bgcolor--fadegreen color--white">6-2-2018</label>
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
                        <div class="cardwrap bgcolor--white bradius--noborder   bshadow--1 padding--small margin--small-top-bottom"></div>
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
                      </li>
                    </ul>
                  </div>
                </div>
              </div> 

@endsection