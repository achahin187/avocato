@extends('layout.app')
@section('content')

              <!-- =============== Custom Content ===============-->
              <div class="row" id="filter_">
                <div class="col-md-12">
                  <div class="cover-inside-container margin--small-top-bottom bradius--small bshadow--1" style="background:  url( 'img/covers/dummy2.jpg ' ) no-repeat center center; background-size:cover;">
                    <div class="add-mode">Adding mode</div>
                    <div class="row">
                      <div class="col-xs-12">
                        <div class="text-xs-center">
                          <div class="text-wraper">
                            <h4 class="cover-inside-title color--gray_d">القضايا و الخدمات <i class="fa fa-chevron-circle-right"></i>
                              <h4 class="cover-inside-title color--gray_d">القضايا </h4>
                            </h4>
                          </div>
                        </div>
                      </div>
                      <div class="cover--actions">
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-12">
                  <form id="horizontal-pill-steps" action="{{ route('add_new_case') }}" method="post" enctype="multipart/form-data" accept-charset="utf-8">
                    {{ csrf_field() }}
                    <h3>معلومات الموكل \ الخصم</h3>
                    <fieldset>
                      <div class="cardwrap bgcolor--white bradius--noborder   bshadow--1 padding--small margin--small-top-bottom">
                        <div class="main-title-conts">
                          <div class="caption">
                            <h3 class="color--main">الموكلين</h3>
                          </div>
                          <div class="actions"><a class="undefined undefined undefined undefined master-btn" type="button" href=""></a>
                          </div><span class="mainseparator bgcolor--main"></span>
                        </div>
                        <div class="add_new_client" id="add_new_client">
                        <div class="col-md-3 col-sm-6 col-xs-12">
                          <div class="master_field">
                            <label class="master_label mandatory" for="client_code_0">كود العميل</label>                       
                           <select class="master_input select2 required"  id="client_code_0" name="client_code[0]" style="width:100%;" onchange="set_client_data(this.value,0,{{$clients}})" required>
                            <option value="-1" selected disabled hidden>إختر كود العميل</option>
                            @foreach($clients as $client)
                              {{-- <option value="{{$client->id}}">{{$client->code}}</option> --}}
                              <option id="comcode" value="{{ $client->id }}" data-id="{{ $client->id}}">{{ $client->code .' - '. $client->name}}</option>
                            @endforeach
                              
                            </select><span class="master_message color--fadegreen">
                               @if ($errors->has('client_code'))
                                    {{ $errors->first('client_code')}}
                                    @endif
                            </span>
                          </div>
                        </div>
                        <div class="col-md-3 col-sm-6 col-xs-12">
                          <div class="master_field">
                            <label class="master_label mandatory" for="client_name_0">اسم الموكل</label>
                            <input class="master_input"  id="client_name_0" name="client_name[0]"  readonly>
                            
                            <span class="master_message color--fadegreen">بعض النص </span>
                          </div>
                        </div>
                        <div class="col-md-3 col-sm-6 col-xs-12">
                          <div class="master_field">
                            <label class="master_label mandatory" for="client_number_0">رقم الهاتف</label>
                            <input class="master_input" type="text" placeholder="رقم الهاتف" id="client_number_0" name="client_number[0]" readonly><span class="master_message color--fadegreen">message</span>
                          </div>
                        </div>
                        <div class="col-md-3 col-sm-6 col-xs-12">
                          <div class="master_field">
                            <label class="master_label mandatory" for="client_character_0">صفته</label>
                            <select class="master_input select2" id="client_character_0" name="client_character[0]" style="width:100%;" class="required">
                              @foreach($roles as $role)
                              <option value="{{$role->id}}">{{$role->name_ar}}</option>
                              @endforeach
                            </select><span class="master_message color--fadegreen">message content</span>
                          </div>
                        </div>
                        <div class="col-md-3 col-sm-6 col-xs-12">
                          <div class="master_field">
                            <label class="master_label mandatory" for="authorization_num_0">رقم التوكيل</label>
                            <input class="master_input required" type="text" placeholder="رقم التوكيل" id="authorization_num_0" name="authorization_num[0]" required><span class="master_message color--fadegreen">
                               @if ($errors->has('authorization_num'))
                                    {{ $errors->first('authorization_num')}}
                                    @endif
                            </span>
                          </div>
                        </div>
                        <div class="col-md-9 col-sm-6 col-xs-12">
                          <div class="master_field">
                            <label class="master_label mandatory" for="client_address_0">عنوانه</label>
                            <input class="master_input" type="text" placeholder="عنوانه" id="client_address_0" name="client_address[0]" readonly><span class="master_message color--fadegreen">بعض النص </span>
                          </div>
                        </div>
                      </div>
                        <div class="col-md-3 col-md-offset-9">
                          <button class="master-btn undefined btn-block color--white bgcolor--fadebrown bradius--rounded bshadow--0" type="button" onclick="add_more_clients();"><span>اضافة المزيد</span>
                          </button>
                        </div>
                        <div class="clearfix"></div>
                      </div><br>
                      <div class="cardwrap bgcolor--white bradius--noborder   bshadow--1 padding--small margin--small-top-bottom">
                        <div class="main-title-conts">
                          <div class="caption">
                            <h3 class="color--main">الخصم</h3>
                          </div>
                          <div class="actions"><a class="undefined undefined undefined undefined master-btn" type="button" href=""></a>
                          </div><span class="mainseparator bgcolor--main"></span>
                        </div>
                        <div class="col-md-4 col-sm-6 col-xs-12 col-sm-6 col-xs-12">
                          <div class="master_field">
                            <label class="master_label mandatory " for="enemy_name">اسم الخصم</label>
                            <input class="master_input required" type="text" placeholder="اسم الخصم" id="enemy_name" name="enemy_name" required><span class="master_message color--fadegreen">
                              @if ($errors->has('enemy_name'))
                                    {{ $errors->first('enemy_name')}}
                                    @endif
                             </span>
                          </div>
                        </div>
                        <div class="col-md-4 col-sm-6 col-xs-12 col-sm-6 col-xs-12">
                          <div class="master_field">
                            <label class="master_label mandatory " for="enemy_type">صفته</label>
                            <select class="master_input select2 required" id="enemy_type" name="enemy_type" style="width:100%;" required>
                              @foreach($roles as $role)
                              <option value="{{$role->id}}">{{$role->name_ar}}</option>
                              @endforeach
                            </select><span class="master_message color--fadegreen">
                               @if ($errors->has('enemy_type'))
                                    {{ $errors->first('enemy_type')}}
                                    @endif
                            </span>
                          </div>
                        </div>
                        <div class="col-md-4 col-sm-6 col-xs-12 col-sm-6 col-xs-12">
                          <div class="master_field">
                            <label class="master_label mandatory" for="enemy_lawyer">محاميه</label>
                            <input class="master_input required" type="text" placeholder="محاميه" id="enemy_lawyer" name="enemy_lawyer" required><span class="master_message color--fadegreen" >
                              @if ($errors->has('enemy_lawyer'))
                                    {{ $errors->first('enemy_lawyer')}}
                                    @endif
                             </span>
                          </div>
                        </div>
                        <div class="col-md-12">
                          <div class="master_field">
                            <label class="master_label mandatory" for="enemy_address">عنوانه</label>
                            <input class="master_input required" type="text" placeholder="عنوانه" id="enemy_address" name="enemy_address" required><span class="master_message color--fadegreen" >
                              @if ($errors->has('enemy_address'))
                                    {{ $errors->first('enemy_address')}}
                                    @endif
                             </span>
                          </div>
                        </div>
                        <div class="clearfix"></div>
                      </div>
                    </fieldset>
                    <h3>التحقيقات</h3>
                    <fieldset>
                      <div class="row">
                        <div class="col-xs-12">
                          <div class="col-xs-4">
                            <div class="master_field">
                              <label class="master_label" for="investigation_no">رقم المحضر</label>
                              <input class="master_input required" type="text" placeholder="رقم المحضر" id="investigation_no" name="investigation_no" required><span class="master_message color--fadegreen">
                                @if ($errors->has('investigation_no'))
                                    {{ $errors->first('investigation_no')}}
                                    @endif
                              </span>
                            </div>
                          </div>
                          <div class="col-xs-4">
                            <div class="master_field">
                              <label class="master_label mandatory" for="investigation_type"> نوع المحضر </label>
                              <select class="master_input select2 required" id="investigation_type" name="investigation_type" style="width:100%;" required>
      
                                    @foreach($cases_record_types as $type)
                                    <option value="{{$type->id}}">{{$type->name}}</option>
                                    @endforeach
                                          
                              </select><span class="master_message color--fadegreen">
                                @if ($errors->has('investigation_type'))
                                    {{ $errors->first('investigation_type')}}
                                    @endif
                              </span>
                            </div>
                          </div>
                          <div class="col-md-4 col-sm-6 col-xs-12">
                            <div class="master_field">
                              <label class="master_label mandatory">تاريخ</label>
                              <div class="bootstrap-timepicker">
                                <input class="datepicker master_input required" type="text" placeholder="تاريخ المحضر" id="investigation_date" name="investigation_date" required>
                              </div><span class="master_message color--fadegreen">
                                @if ($errors->has('investigation_date'))
                                    {{ $errors->first('investigation_date')}}
                                    @endif
                              </span>
                            </div>
                          </div>
                          <div class="col-md-12">
                            <div class="master_field">
                              <label class="master_label" for="docs_upload">إرفاق ملفات</label>
                              <div class="file-upload">
                                <div class="file-select">
                                  <div class="file-select-name" id="noFile">إرفاق ملفات</div>
                                  <input class="chooseFile" type="file" name="docs_upload[]" id="docs_upload"  multiple="multiple">
                                </div>
                              </div><span class="master_message color--fadegreen">message</span>
                            </div>
                          </div>
                          <div class="clearfix"></div>
                        </div>
                      </div>
                    </fieldset>
                    <h3>معلومات القضية </h3>
                    <fieldset>
                      <div class="cardwrap bgcolor--white bradius--noborder   bshadow--1 padding--small margin--small-top-bottom">
                        <div class="col-md-4 col-sm-6 col-xs-12">
                          <div class="master_field">
                            <label class="master_label mandatory" for="folder_num">رقم الملف بالمكتب</label>
                            <input class="master_input required" type="number" placeholder="رقم الملف بالمكتب" id="folder_num" name="folder_num" required><span class="master_message color--fadegreen">
                              @if ($errors->has('folder_num'))
                                    {{ $errors->first('folder_num')}}
                                    @endif
                            </span>
                          </div>
                        </div>
                        <div class="col-md-4 col-sm-6 col-xs-12">
                          <div class="master_field">
                            <label class="master_label mandatory" for="claim_num">رقم الدعوى</label>
                            <input class="master_input required" type="number" placeholder="رقم الدعوى" id="claim_num" name="claim_num" required><span class="master_message color--fadegreen">
                               @if ($errors->has('claim_num'))
                                    {{ $errors->first('claim_num')}}
                                    @endif
                            </span>
                          </div>
                        </div>
                        <div class="col-md-4 col-sm-6 col-xs-12">
                          <div class="master_field">
                            <label class="master_label mandatory" for="case_fees">رسوم الدعوى</label>
                            <input class="master_input required" type="number" placeholder="رسوم الدعوى" id="case_fees" name="case_fees" required><span class="master_message color--fadegreen">
                               @if ($errors->has('case_fees'))
                                    {{ $errors->first('case_fees')}}
                                    @endif
                            </span>
                          </div>
                        </div>
                        <div class="col-md-4 col-sm-6 col-xs-12">
                          <div class="master_field">
                            <label class="master_label mandatory" for="case_type">نوع القضية</label>
                            <select class="master_input select2 required" id="case_type" name="case_type" style="width:100%;" required>
                              @foreach($cases_types as $type)
                              <option value="{{$type->id}}">{{$type->name}}</option>
                              @endforeach
                            </select><span class="master_message color--fadegreen">
                               @if ($errors->has('case_type'))
                                    {{ $errors->first('case_type')}}
                                    @endif
                            </span>
                          </div>
                        </div>
                        <div class="col-md-4 col-sm-6 col-xs-12">
                          <div class="master_field">
                            <label class="master_label mandatory" for="court_name">المحكمة التى تنظر امامها</label>
                            <select class="master_input select2" id="court_name" name="court_name" style="width:100%;" >
                              @foreach($courts as $court)
                              <option value="{{$court->id}}">{{$court->name}}</option>
                              @endforeach
                            </select><span class="master_message color--fadegreen">
                              @if ($errors->has('court_name'))
                                    {{ $errors->first('court_name')}}
                                    @endif
                            </span>
                          </div>
                        </div>
                        <div class="col-md-4 col-sm-6 col-xs-12">
                          <div class="master_field">
                            <label class="master_label mandatory" for="governorate">المحافظة</label>
                            <select class="master_input select2" id="governorate" name="governorate" style="width:100%;">
                             @foreach($governorates as $governorate)
                              <option value="{{$governorate->id}}">{{$governorate->name}}</option>
                              @endforeach
                            </select><span class="master_message color--fadegreen">
                               @if ($errors->has('governorate'))
                                    {{ $errors->first('governorate')}}
                                    @endif
                            </span>
                          </div>
                        </div>
                        <div class="col-md-4 col-sm-6 col-xs-12">
                          <div class="master_field">
                            <label class="master_label mandatory" for="city">المدينة</label>
                            <select class="master_input select2" id="city" name="city" style="width:100%;">
                              @foreach($cities as $city)
                              <option value="{{$city->id}}">{{$city->name}}</option>
                              @endforeach
                            </select><span class="master_message color--fadegreen">
                              @if ($errors->has('city'))
                                    {{ $errors->first('city')}}
                                    @endif
                            </span>
                          </div>
                        </div>
                        <div class="col-md-4 col-sm-6 col-xs-12">
                          <div class="master_field">
                            <label class="master_label mandatory" for="circle">الدائرة</label>
                            <input class="master_input" id="circle" name="circle" type="text" data-placeholder="الدائرة" style="width:100%;" >
                              <span class="master_message color--fadegreen">
                                @if ($errors->has('circle'))
                                    {{ $errors->first('circle')}}
                                    @endif
                              </span>
                          </div>
                        </div>
                        <div class="col-md-4 col-sm-6 col-xs-12">
                          <div class="master_field">
                            <label class="master_label mandatory" for="case_year">السنة</label>
                            <input class=" master_input required case_year" type="text" placeholder="السنة" id="case_year"  name="case_year" required><span class="master_message color--fadegreen">
                               @if ($errors->has('case_year'))
                                    {{ $errors->first('case_year')}}
                                    @endif
                            </span>
                          </div>
                        </div>
                        <div class="col-md-4 col-sm-6 col-xs-12">
                          <div class="master_field">
                            <label class="master_label mandatory" for="case_date">تاريخ قيد الدعوى </label>
                            <div class="bootstrap-timepicker">
                              <input class="datepicker master_input required" type="text" placeholder="تاريخ قيد الدعوى " id="case_date" name="case_date" required>
                            </div><span class="master_message color--fadegreen">
                              @if ($errors->has('case_date'))
                                    {{ $errors->first('case_date')}}
                                    @endif
                            </span>
                          </div>
                        </div>
                        <div class="col-md-4 col-sm-6 col-xs-12">
                          <div class="master_field">
                            <label class="master_label mandatory" for="case_dateRang">تاريخ بدء / نهاية القضية</label>
                            <input class="date_range_picker master_input required" type="text" placeholder="ex:John Doe" id="case_dateRang" name="case_dateRang" required><span class="master_message color--fadegreen">
                              @if ($errors->has('case_dateRang'))
                                    {{ $errors->first('case_dateRang')}}
                                    @endif
                            </span>
                          </div>
                        </div>
                        <div class="col-md-4 col-sm-6 col-xs-12">
                          <div class="master_field">
                            <label class="master_label mandatory" for="case_fees">مصروفات الدعوى</label>
                            <input class="master_input" type="number" placeholder="مصروفات القضية" id="case_fees" name="case_fees"><span class="master_message color--fadegreen">
                              @if ($errors->has('case_fees'))
                                    {{ $errors->first('case_fees')}}
                                    @endif
                                  </span>
                          </div>
                        </div>
                        <div class="col-md-4 col-sm-6 col-xs-12">
                          <div class="master_field">
                            <label class="master_label mandatory">صور مستندات القضية</label>
                            <div class="file-upload">
                              <div class="file-select">
                                <div class="file-select-name" id="noFile">صور مستندات القضية </div>
                                <input class="chooseFile" type="file" name="chooseFile_case[]" multiple>
                              </div>
                            </div><span class="master_message color--fadegreen">message content</span>
                          </div>
                        </div>
                        <div class="col-md-12">
                          <div class="master_field">
                            <label class="master_label mandatory" for="subject">الموضوع</label>
                            <input class="master_input required" type="text" placeholder="الموضوع" id="subject" name="subject" required><span class="master_message color--fadegreen">@if ($errors->has('subject'))
                                    {{ $errors->first('subject')}}
                                    @endif
                                  </span>
                          </div>
                        </div>
                        <div class="col-xs-12">
                          <div class="master_field">
                            <label class="master_label mandatory" for="notes">ملاحظات</label>
                            <textarea class="master_input" name="notes" id="notes" placeholder="ملاحظات"></textarea><span class="master_message color--fadegreen">message</span>
                          </div>
                        </div>
                        <div class="clearfix"></div>
                      </div>
                    </fieldset>
                    <h3>المحامي المسئول</h3>
                    <fieldset>
                      <div class="full-table">
                        <div class="remodal-bg">
                          <div class="remodal" id="confirm" data-remodal-id="filterModal_sponsors" role="dialog" aria-labelledby="modal1Title" aria-describedby="modal1Desc">
                           
                            <button class="remodal-close" data-remodal-action="close" aria-label="Close"></button>
                          <div>
                            <h2 id="modal1Title">فلتر</h2>
                            <div class="col-md-6">
                              <div class="master_field">
                                <label class="master_label mandatory" for="lawyer_code">كود المحامى</label>
                                <input class="master_input" type="text" placeholder="كود المحامى" id="lawyer_code" name="lawyer_code"><span class="master_message color--fadegreen">message</span>
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="master_field">
                                <label class="master_label mandatory" for="lawyer_name">اسم المحامى</label>
                                <input class="master_input" type="text" placeholder="اسم المحامى" id="lawyer_name" name="lawyer_name"><span class="master_message color--fadegreen">message</span>
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="master_field">
                                <label class="master_label mandatory" for="lawyer_id">الرقم القومي</label>
                                <input class="master_input" type="number" placeholder="الرقم القومي" id="lawyer_national_id" name="lawyer_national_id"><span class="master_message color--fadegreen">message</span>
                              </div>
                            </div>
                            <div class="col-md-6">
                            <div class="master_field">
                              <label class="master_label mandatory" for="nationality">الجنسيه</label>
                              <select name="nationalities" class="master_input select2" id="nationality" data-placeholder="نوع العمل " style="width:100%;" ,>
                                <option value="0" selected="selected">الكل</option>
                                @foreach($nationalities as $nationality)
                                <option value="{{$nationality->item_id}}">{{$nationality->value}}</option>
                                @endforeach
                              </select><span class="master_message color--fadegreen"></span>
                            </div>
                            </div>
                            <div class="col-md-6">
                            <div class="master_field">
                              <label class="master_label" for="work_sector">التخصص</label>
                            <select name="work_sector[]" class="master_input select2" id="lawyer_type" multiple="multiple" data-placeholder="التخصص" style="width:100%" >
                            <option value="0">choose Speification ..</option>
                                      @foreach($work_sectors as $work_sector)
                                      <option value="{{$work_sector->id}}">{{$work_sector->name}}</option>
                                      @endforeach
                                    </select>
                            </div>
                            </div>
                            <div class="col-md-6">
                            <div class="master_field">
                                <label class="master_label" for="lawyer_degree_in">درجة القيد بالنقابة</label>
                                   <select name="syndicate_level_id" class="master_input" id="syndicate_level_id">
                                      <option value="choose" selected disabled>اختر درجه القيد بالنقابه</option>
                                      @foreach($syndicate_levels as $syndicate)
                                      <option value="{{$syndicate->id}}">{{$syndicate->name}}</option>
                                      @endforeach
                                   </select>
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="master_field">
                                <label class="master_label mandatory" for="lawyer_tel">الهاتف</label>
                                <input class="master_input" type="number" placeholder="الهاتف" id="lawyer_tel" name="lawyer_tel"><span class="master_message color--fadegreen">message</span>
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="master_field">
                                <label class="master_label mandatory" for="start_date">تاريخ الالتحاق</label>
                                <div class="bootstrap-timepicker">
                                  <input class="datepicker master_input" type="text" placeholder="تاريخ الالتحاق" id="start_date" name="start_date">
                                </div><span class="master_message color--fadegreen">message content</span>
                              </div>
                            </div>
                          </div>
                          <div class="clearfix"></div>
                          <button class="remodal-cancel" data-remodal-action="cancel">الغاء</button>
                          <button class="remodal-confirm "  value="filter" onclick="filter_lawyers();">فلتر</button>
                           </div>
                        </div>
                        <div class="filter__btns"><a class="master-btn bgcolor--main color--white bradius--small" href="#filterModal_sponsors"><i class="fa fa-filter"></i>filters</a></div>
                        <table class="table-1" id="dataTableTriggerId_001">
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
                             @foreach($lawyers as $lawyer)
                          <tr data-lawyer-id="{{$lawyer->id}}">
                           
                            <td><span class="cellcontent"><input class="input-in-table" type="checkbox"  id="{{$lawyer->id}}" name="lawyer_id[{{$lawyer->id}}]" class="checkboxes" /></span></td>
                            
                            <td><span class="cellcontent">{{$lawyer->code}}</span></td>
                            <td><span class="cellcontent">{{$lawyer->name}}</span></td>
                            <td><span class="cellcontent">{{$lawyer->user_detail->national_id or ''}}</span></td>
                            <td><span class="cellcontent">{{$lawyer->nationality}}</span></td>
                            <td><span class="cellcontent">{{$lawyer->user_detail->work_sector or ''}}</span></td>
                            <td><span class="cellcontent">{{$lawyer->user_detail->litigation_level or ''}}</span></td>
                            <td><span class="cellcontent">{{$lawyer->address}}</span></td>
                            <td><span class="cellcontent">{{$lawyer->mobile}}</span></td>
                            <td><span class="cellcontent">{{$lawyer->user_detail->join_date or ''}}</span></td>
                            @if($lawyer->is_active)
                            <td><span class="cellcontent"><i class = "fa color--fadegreen fa-check"></i></span></td>
                            @else
                            <td><span class="cellcontent"><i class = "fa color--fadebrown fa-times"></i></span></td>
                            @endif
                          </tr>
                          @endforeach
                            
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
                      {{-- <input class="finish-btn sf-right sf-btn" type="submit" value="finish"/> --}}
                   {{--    <input class=" date-own form-control" style="width: 300px;" type="text"> --}}
                    </fieldset>

                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                  </form>
                </div>
              </div>
              <!-- =============== PAGE VENDOR Triggers ===============-->

           @endsection

           @section('js')
              <script type="text/javascript">
                $(function () {
                $('#case_year').datepicker({
                format: "yyyy",
                weekStart: 1,
                orientation: "bottom",
                keyboardNavigation: false,
                viewMode: "years",
                minViewMode: "years"
                });
                });
              </script>
              <script type="text/javascript">
                 
                      
                 
                var i=0;
                function add_more_clients()
                {
                  i++;
                  var div = document.getElementById('add_new_client');
                  // alert(i);
                  // alert("'client_code_"+i"'");
                    div.innerHTML += '<div class="col-md-3 col-sm-6 col-xs-12">  <div class="master_field"><label class="master_label mandatory" for="client_code_'+i+'">كود العميل</label><select class="master_input select2"  id="client_code_'+i+'" name="client_code['+i+']" style="width:100%;" onchange="set_client_data(this.value,'+i+',{{$clients}})"> <option value="-1" selected disabled hidden>إختر كود العميل</option>@foreach($clients as $client) <option  value="{{ $client->id }}" data-id="{{ $client->id}}">{{ $client->code .' - '. $client->name}}</option>@endforeach</select><span class="master_message color--fadegreen">message</span> </div> </div><div class="col-md-3 col-sm-6 col-xs-12"> <div class="master_field"> <label class="master_label mandatory" for="client_name_'+i+'">اسم الموكل</label> <input class="master_input "  id="client_name_'+i+'" name="client_name['+i+']" readonly><span class="master_message color--fadegreen">بعض النص </span> </div> </div> <div class="col-md-3 col-sm-6 col-xs-12"> <div class="master_field"> <label class="master_label mandatory" for="client_number_'+i+'">رقم الهاتف</label><input class="master_input" type="number" placeholder="رقم الهاتف" id="client_number_'+i+'" name="client_number['+i+']" readonly><span class="master_message color--fadegreen">message</span></div> </div> <div class="col-md-3 col-sm-6 col-xs-12"> <div class="master_field"><label class="master_label mandatory" for="client_character_'+i+'">صفته</label> <select class="master_input select2" id="client_character_'+i+'" name="client_character['+i+']" style="width:100%;"> @foreach($roles as $role) <option value="{{$role->id}}">{{$role->name_ar}}</option>@endforeach</select><span class="master_message color--fadegreen">message content</span>  </div> </div><div class="col-md-3 col-sm-6 col-xs-12"> <div class="master_field"> <label class="master_label mandatory" for="authorization_num_'+i+'">رقم التوكيل</label> <input class="master_input" type="text" placeholder="رقم التوكيل" id="authorization_num_'+i+'" name="authorization_num['+i+']"><span class="master_message color--fadegreen">message</span> </div></div> <div class="col-md-9 col-sm-6 col-xs-12"> <div class="master_field"> <label class="master_label mandatory" for="client_address_'+i+'">عنوانه</label> <input class="master_input" type="text" placeholder="عنوانه" id="client_address_'+i+'" name="client_address['+i+']" readonly><span class="master_message color--fadegreen">بعض النص </span> </div> </div>';
                  // alert(i);
                }
                function set_client_data(id , i , clients)
                {
                  var code=document.getElementById('client_code_'+i);
                  var name=document.getElementById('client_name_'+i);
                  var mobile=document.getElementById('client_number_'+i);
                  var address=document.getElementById('client_address_'+i);

                  // alert(code.selectedIndex);
                  // alert(code,name,mobile,address);
                  // code.selectedIndex=code.selectedIndex;
                  // name.selectedIndex=code.selectedIndex;
             // alert(clients);
                for(var client in clients)
                {
                  for(var item in clients[client])
                  {
                    // alert(item);
                    if(item == 'id' && clients[client][item]==id)
                    {
                       // alert(item);
                       name.value=clients[client]['name'];
                      mobile.value=clients[client]['mobile'];
                      address.value=clients[client]['address'];
                    }
                    // alert(clients[client][item]);
                  }
                  // if(client['id']==id)
                  // {
                  //   mobile.value=client['mobile'];

                  // }
                  // 
                  // alert(clients[client]);
                }
                  
                  
                }
               
              </script>
              <script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>

              <script type="text/javascript">
                var form = $("#horizontal-pill-steps").show();
                form.steps({
                  headerTag: "h3",
                  bodyTag: "fieldset",
                  transitionEffect: "slideLeft",
                  onStepChanging: function (event, currentIndex, newIndex)
                  {
                      // Allways allow previous action even if the current form is not valid!
                      if (currentIndex > newIndex)
                      {
                          return true;
                      }
                      
                      // Needed in some cases if the user went back (clean up)
                      if (currentIndex < newIndex)
                      {
                          // To remove error styles
                          form.find(".body:eq(" + newIndex + ") span.error").remove();
                          form.find(".body:eq(" + newIndex + ") .error").removeClass("error");
                      }
                      form.validate().settings.ignore = ":disabled,:hidden";
                      return form.valid();
                  },
                  onStepChanged: function (event, currentIndex, priorIndex)
                  {
                      // // Used to skip the "Warning" step if the user is old enough.
                      // if (currentIndex === 2 && Number($("#age-2").val()) >= 18)
                      // {
                      //     form.steps("next");
                      // }
                      // Used to skip the "Warning" step if the user is old enough and wants to the previous step.
                      if (currentIndex === 2 && priorIndex === 3)
                      {
                          form.steps("previous");
                      }
                  },
                      onFinishing: function (event, currentIndex)
                      {
                        // alert("Submitted!");
                        
                          var form = $(this);

                          form.submit();
                      },
                      onFinished: function (event, currentIndex) {
                          // bodyTag: "fieldset"
                          // alert("Finish button was clicked");
                          }
                      }).validate({
                  errorPlacement: function errorPlacement(error, element) { element.before(error); },
                  rules: {
                      // confirm: {
                      //     equalTo: "#password-2"
                      // }
                  }
              });
        
//       var form = $("#horizontal-tabs-steps").show();
//       form.children("div").steps({
//         headerTag: "h3",
//         bodyTag: "fieldset",
//         transitionEffect: "slideLeft",
//         // enableFinishButton: false,
//         enablePagination: false,
//         enableAllSteps: true,
//         titleTemplate: "#title#",
//         cssClass: "tabcontrol",
 
//   onStepChanging: function (event, currentIndex, newIndex)
//             {
// if (currentIndex === 5) { //if last step
//    //remove default #finish button
//    $('#wizard').find('a[href="#finish"]').remove(); 
//    //append a submit type button
//    $('#wizard .actions li:last-child').append('<button type="submit" id="submit" class="btn-large"><span class="fa fa-chevron-right"></span></button>');
// }
                
//             },
//         onFinishing: function (event, currentIndex)
//         {
//            alert("Submitted!");
//             // var form = $(this);

//             //  form.submit();
//         },
//         onFinished: function (event, currentIndex) {
//             // bodyTag: "fieldset"
//             alert("Finish button was clicked");
//             }
//         });

      function filter_lawyers()
      {
        var filter_data=[];
  filter_data['lawyer_code']=$('#lawyer_code').val();
  filter_data['lawyer_name']=$('#lawyer_name').val();
  filter_data['lawyer_national_id']=$('#lawyer_national_id').val();
  filter_data['lawyer_nationality']=$('#lawyer_nationality').val();
  filter_data['lawyer_work_sector']=$('#lawyer_work_sector').val();
  filter_data['lawyer_level']=$('#lawyer_level').val();
  filter_data['lawyer_tel']=$('#lawyer_tel').val();
  filter_data['start_date']=$('#start_date').val();
// alert(data['lawyer_code']);
$.ajax({
           type:'POST',
           url:'{{url('lawyers_cases_filter')}}',
           data_type:JSON,
           data:{"data":filter_data,"_token": "{{ csrf_token() }}"},
           success:function(data){
             // alert(data);
        // $this.html(data);
      // alert(data);
          },
           error: function (jqXHR, exception) {
        var msg = '';
        if (jqXHR.status === 0) {
            msg = 'Not connect.\n Verify Network.';
        } else if (jqXHR.status == 404) {
            msg = 'Requested page not found. [404]';
        } else if (jqXHR.status == 500) {
            msg = 'Internal Server Error [500].';
        } else if (exception === 'parsererror') {
            msg = 'Requested JSON parse failed.';
        } else if (exception === 'timeout') {
            msg = 'Time out error.';
        } else if (exception === 'abort') {
            msg = 'Ajax request aborted.';
        } else {
            msg = 'Uncaught Error.\n' + jqXHR.responseText;
        }
        $('#post').html(msg);
    },
        });

      }
    </script>
           @endsection