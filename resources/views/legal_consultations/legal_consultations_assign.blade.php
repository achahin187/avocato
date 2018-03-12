 @extends('layout.app')             
 @section('content')

              <div class="row">
                <div class="col-lg-12">
                  <div class="cover-inside-container margin--small-top-bottom bradius--small bshadow--1" style="background:  url( '{{asset('img/covers/dummy2.jpg')}}' ) no-repeat center center; background-size:cover;">
                    <div class="add-mode">Adding mode</div>
                    <div class="row">
                      <div class="col-xs-12">
                        <div class="text-xs-center">
                          <div class="text-wraper">
                            <h4 class="cover-inside-title color--gray_d">الاستشارات القانونية</h4>
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
                    <div class="cardwrap bgcolor--gray_l bradius--noborder   bshadow--1 padding--small margin--small-top-bottom">
                      <div class="col-md-12"><span class="pull-left"><b>نص السؤال :</b>&nbsp;
                          وريم ايبسوم دولار سيت أميت ,كونسيكتيتور أدايبا يسكينج أليايت,سيت دو أيوسمود تيمبور أنكايديديونتيوت لابوري ات دولار ماجنا أليكيوا . يوت انيم أد مينيم فينايم,كيواس نوستريد أكسير سيتاشن يللأمكو</span>
                        <div class="pull-right">
                          بتاريخ
                          10/10/2018
                          &nbsp;<i class="fa fa-calendar"></i>
                        </div>
                      </div>
                      <div class="clearfix"></div>
                    </div>
                    <div class="full-table">
                      <div class="remodal-bg">
                        <div class="remodal" data-remodal-id="filterModal_sponsors" role="dialog" aria-labelledby="modal1Title" aria-describedby="modal1Desc">
                          <button class="remodal-close" data-remodal-action="close" aria-label="Close"></button>
                          <div>
                            <h2 id="modal1Title">فلتر</h2>
                            <div class="col-md-6">
                              <div class="master_field">
                                <label class="master_label mandatory" for="lawyer_code">كود المحامى</label>
                                <input class="master_input" type="number" placeholder="كود المحامى" id="lawyer_code"><span class="master_message color--fadegreen">message</span>
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="master_field">
                                <label class="master_label mandatory" for="lawyer_name">اسم المحامى</label>
                                <input class="master_input" type="text" placeholder="اسم المحامى" id="lawyer_name"><span class="master_message color--fadegreen">message</span>
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="master_field">
                                <label class="master_label mandatory" for="lawyer_id">الرقم القومي</label>
                                <input class="master_input" type="number" placeholder="الرقم القومي" id="lawyer_id"><span class="master_message color--fadegreen">message</span>
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="master_field">
                                <label class="master_label mandatory" for="lawyer_nationality">الجنسية</label>
                                <input class="master_input" type="text" placeholder="الجنسية" id="lawyer_nationality"><span class="master_message color--fadegreen">message</span>
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="master_field">
                                <label class="master_label mandatory" for="lawyer_spec"> التخصص</label>
                                <select class="master_input select2" id="lawyer_spec" multiple="multiple" data-placeholder="التخصص" style="width:100%;" ,>
                                  <option>تعويضات</option>
                                  <option>تخصص اخر</option>
                                </select><span class="master_message color--fadegreen">message content</span>
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="master_field">
                                <label class="master_label mandatory" for="lawyer_degree">درجة التقاضي</label>
                                <select class="master_input select2" id="lawyer_degree" multiple="multiple" data-placeholder="درجة التقاضي" style="width:100%;" ,>
                                  <option>محامى تحت التمرين</option>
                                  <option>محامي متمرس</option>
                                </select><span class="master_message color--fadegreen">message content</span>
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="master_field">
                                <label class="master_label mandatory" for="lawyer_tel">الهاتف</label>
                                <input class="master_input" type="number" placeholder="الهاتف" id="lawyer_tel"><span class="master_message color--fadegreen">message</span>
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="master_field">
                                <label class="master_label mandatory" for="start_date">تاريخ الالتحاق</label>
                                <div class="bootstrap-timepicker">
                                  <input class="datepicker master_input" type="text" placeholder="تاريخ الالتحاق" id="start_date">
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
                      <div class="bottomActions__btns"><a class="master-btn bradius--small padding--small bgcolor--fadeblue color--white" href="#">إختيار المحامي المحدد </a>
                      </div>
                      <table class="table-1">
                        <thead>
                          <tr class="bgcolor--gray_mm color--gray_d">
                            <th><span class="cellcontent">&lt;input type=&quot;checkbox&quot; name=&quot;select-all&quot; id=&quot;select-all&quot; /&gt;</span></th>
                            <th><span class="cellcontent">كود المحامي</span></th>
                            <th><span class="cellcontent">الاسم</span></th>
                            <th><span class="cellcontent">الرقم القومي</span></th>
                            <th><span class="cellcontent">الجنسية</span></th>
                            <th><span class="cellcontent">التخصص</span></th>
                            <th><span class="cellcontent">درجة التقاضى</span></th>
                            <th><span class="cellcontent">عنوان</span></th>
                            <th><span class="cellcontent">هاتف</span></th>
                            <th><span class="cellcontent">تاريخ الإلتحاق</span></th>
                            <th><span class="cellcontent">تفعيل</span></th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td><span class="cellcontent"><input type="checkbox" class="checkboxes" /></span></td>
                            <td><span class="cellcontent">12558</span></td>
                            <td><span class="cellcontent">مجدي سليم</span></td>
                            <td><span class="cellcontent">134567788899</span></td>
                            <td><span class="cellcontent">مصري</span></td>
                            <td><span class="cellcontent">جنايات</span></td>
                            <td><span class="cellcontent">محامى تحت التمرين</span></td>
                            <td><span class="cellcontent">55 شارة الثورة - ألماظة</span></td>
                            <td><span class="cellcontent">0102345678</span></td>
                            <td><span class="cellcontent">12-2016</span></td>
                            <td><span class="cellcontent"><i class = "fa color--fadegreen fa-check"></i></span></td>
                          </tr>
                          <tr>
                            <td><span class="cellcontent"><input type="checkbox" class="checkboxes" /></span></td>
                            <td><span class="cellcontent">12558</span></td>
                            <td><span class="cellcontent">مجدي سليم</span></td>
                            <td><span class="cellcontent">134567788899</span></td>
                            <td><span class="cellcontent">مصري</span></td>
                            <td><span class="cellcontent">جنايات</span></td>
                            <td><span class="cellcontent">محامى تحت التمرين</span></td>
                            <td><span class="cellcontent">55 شارة الثورة - ألماظة</span></td>
                            <td><span class="cellcontent">0102345678</span></td>
                            <td><span class="cellcontent">12-2016</span></td>
                            <td><span class="cellcontent"><i class = "fa color--fadegreen fa-check"></i></span></td>
                          </tr>
                          <tr>
                            <td><span class="cellcontent"><input type="checkbox" class="checkboxes" /></span></td>
                            <td><span class="cellcontent">12558</span></td>
                            <td><span class="cellcontent">مجدي سليم</span></td>
                            <td><span class="cellcontent">134567788899</span></td>
                            <td><span class="cellcontent">مصري</span></td>
                            <td><span class="cellcontent">جنايات</span></td>
                            <td><span class="cellcontent">محامى تحت التمرين</span></td>
                            <td><span class="cellcontent">55 شارة الثورة - ألماظة</span></td>
                            <td><span class="cellcontent">0102345678</span></td>
                            <td><span class="cellcontent">12-2016</span></td>
                            <td><span class="cellcontent"><i class = "fa color--fadegreen fa-check"></i></span></td>
                          </tr>
                          <tr>
                            <td><span class="cellcontent"><input type="checkbox" class="checkboxes" /></span></td>
                            <td><span class="cellcontent">12558</span></td>
                            <td><span class="cellcontent">مجدي سليم</span></td>
                            <td><span class="cellcontent">134567788899</span></td>
                            <td><span class="cellcontent">مصري</span></td>
                            <td><span class="cellcontent">جنايات</span></td>
                            <td><span class="cellcontent">محامى تحت التمرين</span></td>
                            <td><span class="cellcontent">55 شارة الثورة - ألماظة</span></td>
                            <td><span class="cellcontent">0102345678</span></td>
                            <td><span class="cellcontent">12-2016</span></td>
                            <td><span class="cellcontent"><i class = "fa color--fadegreen fa-check"></i></span></td>
                          </tr>
                          <tr>
                            <td><span class="cellcontent"><input type="checkbox" class="checkboxes" /></span></td>
                            <td><span class="cellcontent">12558</span></td>
                            <td><span class="cellcontent">مجدي سليم</span></td>
                            <td><span class="cellcontent">134567788899</span></td>
                            <td><span class="cellcontent">مصري</span></td>
                            <td><span class="cellcontent">جنايات</span></td>
                            <td><span class="cellcontent">محامى تحت التمرين</span></td>
                            <td><span class="cellcontent">55 شارة الثورة - ألماظة</span></td>
                            <td><span class="cellcontent">0102345678</span></td>
                            <td><span class="cellcontent">12-2016</span></td>
                            <td><span class="cellcontent"><i class = "fa color--fadegreen fa-check"></i></span></td>
                          </tr>
                          <tr>
                            <td><span class="cellcontent"><input type="checkbox" class="checkboxes" /></span></td>
                            <td><span class="cellcontent">12558</span></td>
                            <td><span class="cellcontent">مجدي سليم</span></td>
                            <td><span class="cellcontent">134567788899</span></td>
                            <td><span class="cellcontent">مصري</span></td>
                            <td><span class="cellcontent">جنايات</span></td>
                            <td><span class="cellcontent">محامى تحت التمرين</span></td>
                            <td><span class="cellcontent">55 شارة الثورة - ألماظة</span></td>
                            <td><span class="cellcontent">0102345678</span></td>
                            <td><span class="cellcontent">12-2016</span></td>
                            <td><span class="cellcontent"><i class = "fa color--fadegreen fa-check"></i></span></td>
                          </tr>
                          <tr>
                            <td><span class="cellcontent"><input type="checkbox" class="checkboxes" /></span></td>
                            <td><span class="cellcontent">12558</span></td>
                            <td><span class="cellcontent">مجدي سليم</span></td>
                            <td><span class="cellcontent">134567788899</span></td>
                            <td><span class="cellcontent">مصري</span></td>
                            <td><span class="cellcontent">جنايات</span></td>
                            <td><span class="cellcontent">محامى تحت التمرين</span></td>
                            <td><span class="cellcontent">55 شارة الثورة - ألماظة</span></td>
                            <td><span class="cellcontent">0102345678</span></td>
                            <td><span class="cellcontent">12-2016</span></td>
                            <td><span class="cellcontent"><i class = "fa color--fadegreen fa-check"></i></span></td>
                          </tr>
                          <tr>
                            <td><span class="cellcontent"><input type="checkbox" class="checkboxes" /></span></td>
                            <td><span class="cellcontent">12558</span></td>
                            <td><span class="cellcontent">مجدي سليم</span></td>
                            <td><span class="cellcontent">134567788899</span></td>
                            <td><span class="cellcontent">مصري</span></td>
                            <td><span class="cellcontent">جنايات</span></td>
                            <td><span class="cellcontent">محامى تحت التمرين</span></td>
                            <td><span class="cellcontent">55 شارة الثورة - ألماظة</span></td>
                            <td><span class="cellcontent">0102345678</span></td>
                            <td><span class="cellcontent">12-2016</span></td>
                            <td><span class="cellcontent"><i class = "fa color--fadegreen fa-check"></i></span></td>
                          </tr>
                          <tr>
                            <td><span class="cellcontent"><input type="checkbox" class="checkboxes" /></span></td>
                            <td><span class="cellcontent">12558</span></td>
                            <td><span class="cellcontent">مجدي سليم</span></td>
                            <td><span class="cellcontent">134567788899</span></td>
                            <td><span class="cellcontent">مصري</span></td>
                            <td><span class="cellcontent">جنايات</span></td>
                            <td><span class="cellcontent">محامى تحت التمرين</span></td>
                            <td><span class="cellcontent">55 شارة الثورة - ألماظة</span></td>
                            <td><span class="cellcontent">0102345678</span></td>
                            <td><span class="cellcontent">12-2016</span></td>
                            <td><span class="cellcontent"><i class = "fa color--fadegreen fa-check"></i></span></td>
                          </tr>
                          <tr>
                            <td><span class="cellcontent"><input type="checkbox" class="checkboxes" /></span></td>
                            <td><span class="cellcontent">12558</span></td>
                            <td><span class="cellcontent">مجدي سليم</span></td>
                            <td><span class="cellcontent">134567788899</span></td>
                            <td><span class="cellcontent">مصري</span></td>
                            <td><span class="cellcontent">جنايات</span></td>
                            <td><span class="cellcontent">محامى تحت التمرين</span></td>
                            <td><span class="cellcontent">55 شارة الثورة - ألماظة</span></td>
                            <td><span class="cellcontent">0102345678</span></td>
                            <td><span class="cellcontent">12-2016</span></td>
                            <td><span class="cellcontent"><i class = "fa color--fadegreen fa-check"></i></span></td>
                          </tr>
                          <tr>
                            <td><span class="cellcontent"><input type="checkbox" class="checkboxes" /></span></td>
                            <td><span class="cellcontent">12558</span></td>
                            <td><span class="cellcontent">مجدي سليم</span></td>
                            <td><span class="cellcontent">134567788899</span></td>
                            <td><span class="cellcontent">مصري</span></td>
                            <td><span class="cellcontent">جنايات</span></td>
                            <td><span class="cellcontent">محامى تحت التمرين</span></td>
                            <td><span class="cellcontent">55 شارة الثورة - ألماظة</span></td>
                            <td><span class="cellcontent">0102345678</span></td>
                            <td><span class="cellcontent">12-2016</span></td>
                            <td><span class="cellcontent"><i class = "fa color--fadegreen fa-check"></i></span></td>
                          </tr>
                          <tr>
                            <td><span class="cellcontent"><input type="checkbox" class="checkboxes" /></span></td>
                            <td><span class="cellcontent">12558</span></td>
                            <td><span class="cellcontent">مجدي سليم</span></td>
                            <td><span class="cellcontent">134567788899</span></td>
                            <td><span class="cellcontent">مصري</span></td>
                            <td><span class="cellcontent">جنايات</span></td>
                            <td><span class="cellcontent">محامى تحت التمرين</span></td>
                            <td><span class="cellcontent">55 شارة الثورة - ألماظة</span></td>
                            <td><span class="cellcontent">0102345678</span></td>
                            <td><span class="cellcontent">12-2016</span></td>
                            <td><span class="cellcontent"><i class = "fa color--fadegreen fa-check"></i></span></td>
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