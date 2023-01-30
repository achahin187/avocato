@extends('layout.app')
@section('content')
    <!-- =============== Custom Content ===============-->
    <div class="row">
        <div class="col-md-12">
            <div class="cover-inside-container margin--small-top-bottom bradius--small bshadow--1"
                style="background:  url( 'img/covers/dummy2.jpg ' ) no-repeat center center; background-size:cover;">
                <div class="edit-mode">Editing mode</div>
                <div class="row">
                    <div class="col-xs-12">
                        <div class="text-xs-center">
                            <div class="text-wraper">
                                <h4 class="cover-inside-title color--gray_d">القضايا و الخدمات <i
                                        class="fa fa-chevron-circle-right"></i>
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
            <form action="{{ URL('edit_case/' . $case->id) }}" method="post" enctype="multipart/form-data"
                accept-charset="utf-8">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="tabs--wrapper">
                    <div class="clearfix"></div>
                    <ul class="tabs">
                        <li>معلومات الموكل</li>
                        <li>التحقيقات</li>
                        <li>معلومات القضية </li>
                        <li> تغيير المحامي</li>
                    </ul>
                    <ul class="tab__content">
                        <li class="tab__content_item active">
                            <div
                                class="cardwrap bgcolor--white bradius--noborder   bshadow--1 padding--small margin--small-top-bottom">
                                <div class="main-title-conts">
                                    <div class="caption">
                                        <h3 class="color--main">الموكلين</h3>
                                    </div>
                                    <div class="actions"><a class="undefined undefined undefined undefined master-btn"
                                            type="button" href=""></a>
                                    </div><span class="mainseparator bgcolor--main"></span>
                                </div>
                                <div class="add_new_client" id="add_new_client">

                                    <?php $i = 0; ?>
                                    @foreach ($case->case_clients as $case_client)
                                        <div class="col-md-3 col-sm-6 col-xs-12">
                                            <div class="master_field">
                                                <label class="master_label mandatory"
                                                    for="client_code_{{ $i }}">كود العميل</label>
                                                <select class="master_input select2" id="client_code_{{ $i }}"
                                                    name="client_code[{{ $i }}]" style="width:100%;"
                                                    onchange="set_client_data(this.value,{{ $i }},{{ $clients }})">
                                                    <option value="-1" selected disabled hidden>إختر كود العميل</option>
                                                    @dd($clients)
                                                    @foreach ($clients as $client)
                                                        @if ($client->id == $case_client->client_id)
                                                            <option id="comcode" value="{{ $client->id }}"
                                                                data-id="{{ $client->id }}" selected>
                                                                {{ $client->code . ' - ' . $client->name }}</option>
                                                        @else
                                                            <option id="comcode" value="{{ $client->id }}"
                                                                data-id="{{ $client->id }}">
                                                                {{ $client->code . ' - ' . $client->name }}</option>
                                                        @endif
                                                    @endforeach

                                                </select><span class="master_message color--fadegreen">
                                                    @if ($errors->has('client_code'))
                                                        {{ $errors->first('client_code') }}
                                                    @endif
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-sm-6 col-xs-12">
                                            <div class="master_field">
                                                <label class="master_label mandatory"
                                                    for="client_name_{{ $i }}">اسم الموكل</label>
                                                <input class="master_input" id="client_name_{{ $i }}"
                                                    name="client_name[{{ $i }}]" readonly><span
                                                    class="master_message color--fadegreen">بعض النص </span>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-sm-6 col-xs-12">
                                            <div class="master_field">
                                                <label class="master_label mandatory"
                                                    for="client_number_{{ $i }}">رقم الهاتف</label>
                                                <input class="master_input" type="text" placeholder="رقم الهاتف"
                                                    id="client_number_{{ $i }}"
                                                    name="client_number[{{ $i }}]" readonly><span
                                                    class="master_message color--fadegreen">message</span>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-sm-6 col-xs-12">
                                            <div class="master_field">
                                                <label class="master_label mandatory"
                                                    for="client_character_{{ $i }}">صفته</label>
                                                <select class="master_input select2"
                                                    id="client_character_{{ $i }}"
                                                    name="client_character[{{ $i }}]" style="width:100%;">
                                                    @foreach ($roles as $role)
                                                        @if ($role->id == $case_client->case_client_role_id)
                                                            <option value="{{ $role->id }}" selected>
                                                                {{ $role->name_ar }}</option>
                                                        @else
                                                            <option value="{{ $role->id }}">{{ $role->name_ar }}
                                                            </option>
                                                        @endif
                                                    @endforeach
                                                </select><span class="master_message color--fadegreen">message
                                                    content</span>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-sm-6 col-xs-12">
                                            <div class="master_field">
                                                <label class="master_label mandatory"
                                                    for="authorization_num_{{ $i }}">رقم التوكيل</label>
                                                <input class="master_input" type="number" placeholder="رقم التوكيل"
                                                    id="authorization_num_{{ $i }}"
                                                    name="authorization_num[{{ $i }}]"
                                                    value="{{ $case_client->attorney_number }}"><span
                                                    class="master_message color--fadegreen">
                                                    @if ($errors->has('authorization_num'))
                                                        {{ $errors->first('authorization_num') }}
                                                    @endif
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-md-9 col-sm-6 col-xs-12">
                                            <div class="master_field">
                                                <label class="master_label mandatory"
                                                    for="client_address_{{ $i }}">عنوانه</label>
                                                <input class="master_input" type="text" placeholder="عنوانه"
                                                    id="client_address_{{ $i }}"
                                                    name="client_address[{{ $i }}]" readonly><span
                                                    class="master_message color--fadegreen">بعض النص </span>
                                            </div>
                                        </div>
                                    @endforeach


                                </div>
                                <div class="col-md-3 col-md-offset-9">
                                    <button
                                        class="master-btn undefined btn-block color--white bgcolor--fadebrown bradius--rounded bshadow--0"
                                        type="button" onclick="add_more_clients();"><span>اضافة المزيد</span>
                                    </button>

                                </div>
                                <div class="clearfix"></div>
                            </div><br>
                            <div
                                class="cardwrap bgcolor--white bradius--noborder   bshadow--1 padding--small margin--small-top-bottom">
                                <div class="main-title-conts">
                                    <div class="caption">
                                        <h3 class="color--main">الخصم</h3>
                                    </div>
                                    <div class="actions"><a class="undefined undefined undefined undefined master-btn"
                                            type="button" href=""></a>
                                    </div><span class="mainseparator bgcolor--main"></span>
                                </div>
                                <div class="col-md-6">
                                    <div class="master_field">
                                        <label class="master_label mandatory" for="enemy_name">اسم الخصم</label>
                                        <input class="master_input" type="text" placeholder="اسم الخصم"
                                            id="enemy_name" name="enemy_name" value="{{ $case->contender_name }}"><span
                                            class="master_message color--fadegreen">
                                            @if ($errors->has('enemy_name'))
                                                {{ $errors->first('enemy_name') }}
                                            @endif
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="master_field">
                                        <label class="master_label mandatory" for="enemy_type">صفته</label>
                                        <select class="master_input select2" id="enemy_type" name="enemy_type"
                                            style="width:100%;">
                                            @foreach ($roles as $role)
                                                @if ($role->id == $case->contender_case_client_role_id)
                                                    <option value="{{ $role->id }}" selected>{{ $role->name_ar }}
                                                    </option>
                                                @else
                                                    <option value="{{ $role->id }}">{{ $role->name_ar }}</option>
                                                @endif
                                            @endforeach
                                        </select><span class="master_message color--fadegreen">
                                            @if ($errors->has('enemy_type'))
                                                {{ $errors->first('enemy_type') }}
                                            @endif
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="master_field">
                                        <label class="master_label mandatory" for="enemy_address">عنوانه</label>
                                        <input class="master_input" type="text" placeholder="عنوانه"
                                            id="enemy_address" name="enemy_address"
                                            value="{{ $case->contender_address }}"><span
                                            class="master_message color--fadegreen">
                                            @if ($errors->has('enemy_address'))
                                                {{ $errors->first('enemy_address') }}
                                            @endif
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="master_field">
                                        <label class="master_label mandatory" for="enemy_lawyer">محاميه</label>
                                        <input class="master_input" type="text" placeholder="محاميه"
                                            id="enemy_lawyer" name="enemy_lawyer"
                                            value="{{ $case->contender_laywer }}"><span
                                            class="master_message color--fadegreen">
                                            @if ($errors->has('enemy_lawyer'))
                                                {{ $errors->first('enemy_lawyer') }}
                                            @endif
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="master_field">
                                        <label class="master_label mandatory" for="authorization_num">رقم التوكيل</label>
                                        <input class="master_input" type="number" placeholder="رقم التوكيل"
                                            id="authorization_num"><span class="master_message color--fadegreen">

                                        </span>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        </li>
                        <li class="tab__content_item">
                            <div
                                class="cardwrap bgcolor--white bradius--noborder   bshadow--1 padding--small margin--small-top-bottom">
                                <div class="col-lg-12">
                                    <table class="table-1">
                                        <thead>
                                            <tr class="bgcolor--gray_mm color--gray_d">
                                                <th><span class="cellcontent">رقم المحضر</span></th>
                                                <th><span class="cellcontent">نوع المحضر</span></th>
                                                <th><span class="cellcontent">تاريخ المحضر</span></th>
                                                <th><span class="cellcontent">الملفات المرفقة</span></th>
                                                <th><span class="cellcontent">الإجراءات</span></th>
                                            </tr>
                                        </thead>
                                        <tbody>


                                            @foreach ($case->case_records as $record)
                                                <tr data-record-id="{{ $record->id }}">

                                                    <td><span class="cellcontent">{{ $record->record_number }}</span></td>
                                                    <td><span class="cellcontent">{{ $record->record_type_id }}</span>
                                                    </td>
                                                    <td><span class="cellcontent">{{ $record->record_date }}</span></td>
                                                    <td><span class="cellcontent"><a
                                                                href="#investigation_attachment/{{ $record->id }}" ,
                                                                class="action-btn bgcolor--main color--white "> الملفات
                                                                المرفقة &nbsp; <i class="fa  fa-paperclip"></i></a></span>
                                                    </td>
                                                    <td><span class="cellcontent"><a href="#"
                                                                class="btn-warning-cancel action-btn bgcolor--fadebrown color--white "><i
                                                                    class="fa  fa-trash-o"></i></a></span></td>



                                                    <a class="master-btn undefined undefined undefined undefined undefined"
                                                        href="#investigation_attachment/{{ $record->id }}"
                                                        style="display: none;"><span></span></a>
                                                    <div class="remodal-bg"></div>
                                                    <div class="remodal"
                                                        data-remodal-id="investigation_attachment/{{ $record->id }}"
                                                        role="dialog" aria-labelledby="modal1Title"
                                                        aria-describedby="modal1Desc">

                                                        <input type="hidden" name="_token"
                                                            value="{{ csrf_token() }}">
                                                        <button class="remodal-close" data-remodal-action="close"
                                                            aria-label="Close"></button>
                                                        <div>
                                                            <div class="row">
                                                                <div class="col-xs-12">
                                                                    <h3>الملفات المرفقة للتحقيق بتاريخ 12/12/2018</h3>
                                                                    <ul class="mailbox-attachments clearfix right-text">
                                                                        @foreach ($record->case_record_documents as $document)
                                                                            <li><span class="mailbox-attachment-icon"><i
                                                                                        class="fa fa-file-pdf-o"></i></span>

                                                                                <div class="mailbox-attachment-info"><a
                                                                                        class="mailbox-attachment-name"
                                                                                        href="{{ asset($document->file) }}"><i
                                                                                            class="fa fa-paperclip"></i>&nbsp;
                                                                                        {{ $document->name }}<br></a><span
                                                                                        class="mailbox-attachment-size"><a
                                                                                            class="pull-right"
                                                                                            href="{{ URL('download_document/' . $document->id) }}'"><i
                                                                                                class="fa fa-cloud-download"></i></a></span>
                                                                                </div>
                                                                            </li>
                                                                        @endforeach

                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div><br>
                                                        <button class="remodal-cancel"
                                                            data-remodal-action="cancel">إلغاء</button>
                                                        <button class="remodal-confirm"><a
                                                                href="{{ URL('download_all_documents/' . $record->id) }}">تحميل
                                                                الكل</a></button>

                                                    </div>


                                                </tr>
                                            @endforeach



                                        </tbody>
                                    </table>
                                    <div class="remodal log-custom" role="dialog" aria-labelledby="modal1Title"
                                        aria-describedby="modal1Desc">
                                        <button class="remodal-close" data-remodal-action="close"
                                            aria-label="Close"></button>
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
                                    <div class="col-md-2 col-sm-3 colxs-12"><a
                                            class="master-btn color--white bgcolor--main bradius--small bshadow--0 btn-block"
                                            href="#new_investigation"><i class="fa fa-plus"></i><span>إضافة</span></a>
                                        <div class="remodal-bg"></div>
                                        {{-- <div class="remodal" data-remodal-id="new_investigation" role="dialog" aria-labelledby="modal1Title" aria-describedby="modal1Desc">
                                <button class="remodal-close" data-remodal-action="close" aria-label="Close"></button>
                                <div>
                                  <div class="row">
                                    <div class="col-xs-12">
                                      <h3>إضافة محضر</h3>
                                      <div class="col-xs-4">
                                        <div class="master_field">
                                          <label class="master_label" for="investigation_no">رقم المحضر</label>
                                          <input class="master_input" type="text" placeholder="رقم المحضر" id="investigation_no" name="investigation_no"><span class="master_message color--fadegreen">message</span>
                                        </div>
                                      </div>
                                      <div class="col-xs-4">
                                        <div class="master_field">
                                          <label class="master_label mandatory" for="investigation_type"> نوع المحضر </label>
                                          <select class="master_input select2" id="investigation_type" name="investigation_type" style="width:100%;">
                                            @foreach ($cases_record_types as $type)
                                            <option value="{{$type->id}}">{{$type->name_ar}}</option>
                                            @endforeach
                                          </select><span class="master_message color--fadegreen">message</span>
                                        </div>
                                      </div>
                                      <div class="col-md-4 col-sm-6 col-xs-12">
                                        <div class="master_field">
                                          <label class="master_label mandatory">تاريخ</label>
                                          <div class="bootstrap-timepicker">
                                            <input class="datepicker master_input" type="text" placeholder="تاريخ الاستشارة" name="record_date" id="investigation_date">
                                          </div><span class="master_message color--fadegreen">message content</span>
                                        </div>
                                      </div>
                                      <div class="col-md-12">
                                        <div class="master_field">
                                          <label class="master_label" for="record_documents">إرفاق ملفات</label>
                                          <div class="file-upload">
                                            <div class="file-select">
                                              <div class="file-select-name" id="noFile">إرفاق ملفات</div>
                                              <input class="chooseFile" type="file" name="record_documents[]" id="record_documents" multiple>
                                            </div>
                                          </div><span class="master_message color--fadegreen">message</span>
                                        </div>
                                      </div>
                                      <div class="clearfix"></div>
                                    </div>
                                  </div>
                                </div><br>
                                <button class="remodal-cancel" data-remodal-action="cancel">إلغاء</button>
                                <button class="remodal-confirm" onclick="add_record({{$case->id}})">حفظ</button>
                              </div> --}}
                                    </div>
                                    <a class="master-btn undefined undefined undefined undefined undefined"
                                        href="#investigation_attachment"><span></span></a>
                                    <div class="remodal-bg"></div>
                                    <div class="remodal" data-remodal-id="investigation_attachment" role="dialog"
                                        aria-labelledby="modal1Title" aria-describedby="modal1Desc">
                                        <button class="remodal-close" data-remodal-action="close"
                                            aria-label="Close"></button>
                                        <div>
                                            <div class="row">
                                                <div class="col-xs-12">
                                                    <h3>الملفات المرفقة للتحقيق بتاريخ 12/12/2018</h3>
                                                    <ul class="mailbox-attachments clearfix right-text">
                                                        <li><span class="mailbox-attachment-icon"><i
                                                                    class="fa fa-file-pdf-o"></i></span>
                                                            <div class="mailbox-attachment-info"><a
                                                                    class="mailbox-attachment-name" href="#"><i
                                                                        class="fa fa-paperclip"></i>&nbsp;
                                                                    report.pdf<br></a><span
                                                                    class="mailbox-attachment-size">1,245 KB<a
                                                                        class="pull-right" href="#"><i
                                                                            class="fa fa-cloud-download"></i></a></span>
                                                            </div>
                                                        </li>
                                                        <li><span class="mailbox-attachment-icon"><i
                                                                    class="fa fa-file-word-o"></i></span>
                                                            <div class="mailbox-attachment-info"><a
                                                                    class="mailbox-attachment-name" href="#"><i
                                                                        class="fa fa-paperclip"></i>&nbsp;
                                                                    App_Desc.docx<br></a><span
                                                                    class="mailbox-attachment-size">1,245 KB<a
                                                                        class="pull-right" href="#"><i
                                                                            class="fa fa-cloud-download"></i></a></span>
                                                            </div>
                                                        </li>
                                                        <li><span class="mailbox-attachment-icon has-img"><img
                                                                    src="https://unsplash.it/300/300/?random"
                                                                    alt="Attachment"></span>
                                                            <div class="mailbox-attachment-info"><a
                                                                    class="mailbox-attachment-name" href="#"><i
                                                                        class="fa fa-camera"></i>&nbsp;
                                                                    photo1.png<br></a><span
                                                                    class="mailbox-attachment-size">2.67 MB<a
                                                                        class="pull-right" href="#"><i
                                                                            class="fa fa-cloud-download"></i></a></span>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div><br>
                                        <button class="remodal-cancel" data-remodal-action="cancel">إلغاء</button>
                                        <button class="remodal-confirm" data-remodal-action="confirm">تحميل الكل</button>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        </li>
                        <li class="tab__content_item">
                            <div
                                class="cardwrap bgcolor--white bradius--noborder   bshadow--1 padding--small margin--small-top-bottom">
                                <div class="col-md-4">
                                    <div class="master_field">
                                        <label class="master_label mandatory" for="folder_num">رقم الملف بالمكتب</label>
                                        <input class="master_input" type="number" placeholder="رقم الملف بالمكتب"
                                            id="folder_num" name="folder_num"
                                            value="{{ $case->office_file_number }}"><span
                                            class="master_message color--fadegreen">
                                            @if ($errors->has('folder_num'))
                                                {{ $errors->first('folder_num') }}
                                            @endif
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="master_field">
                                        <label class="master_label mandatory" for="claim_num">رقم الدعوى</label>
                                        <input class="master_input" type="number" placeholder="رقم الدعوى"
                                            id="claim_num" name="claim_num" value="{{ $case->claim_number }}"><span
                                            class="master_message color--fadegreen">
                                            @if ($errors->has('claim_num'))
                                                {{ $errors->first('claim_num') }}
                                            @endif
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="master_field">
                                        <label class="master_label mandatory" for="case_fees">رسوم الدعوى</label>
                                        <input class="master_input" type="number" placeholder="رسوم الدعوى"
                                            id="case_fees" name="case_fees" value="{{ $case->claim_expenses }}"><span
                                            class="master_message color--fadegreen">
                                            @if ($errors->has('case_fees'))
                                                {{ $errors->first('case_fees') }}
                                            @endif
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-6 col-xs-12">
                                    <div class="master_field">
                                        <label class="master_label mandatory" for="case_type">نوع القضية</label>
                                        <select class="master_input select2" id="case_type" name="case_type"
                                            style="width:100%;">
                                            @foreach ($cases_types as $type)
                                                @if ($type->id == $case->case_type_id)
                                                    <option value="{{ $type->id }}" selected>{{ $type->name }}
                                                    </option>
                                                @else
                                                    <option value="{{ $type->id }}">{{ $type->name }}</option>
                                                @endif
                                            @endforeach
                                        </select><span class="master_message color--fadegreen">
                                            @if ($errors->has('case_type'))
                                                {{ $errors->first('case_type') }}
                                            @endif
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-6 col-xs-12">
                                    <div class="master_field">
                                        <label class="master_label mandatory" for="court_name">المحكمة التى تنظر
                                            امامها</label>
                                        <select class="master_input select2" id="court_name" name="court_name"
                                            style="width:100%;">
                                            @foreach ($courts as $court)
                                                @if ($court->id == $case->court_id)
                                                    <option value="{{ $court->id }}" selected>{{ $court->name }}
                                                    </option>
                                                @else
                                                    <option value="{{ $court->id }}">{{ $court->name }}</option>
                                                @endif
                                            @endforeach
                                        </select><span class="master_message color--fadegreen">
                                            @if ($errors->has('court_name'))
                                                {{ $errors->first('court_name') }}
                                            @endif
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-6 col-xs-12">
                                    <div class="master_field">
                                        <label class="master_label mandatory" for="governorate">المحافظة</label>
                                        <select class="master_input select2" id="governorate" name="governorate"
                                            style="width:100%;">
                                            @foreach ($governorates as $governorate)
                                                @if ($governorate->id == $case->geo_governorate_id)
                                                    <option value="{{ $governorate->id }}" selected>
                                                        {{ $governorate->name }}</option>
                                                @else
                                                    <option value="{{ $governorate->id }}">{{ $governorate->name }}
                                                    </option>
                                                @endif
                                            @endforeach
                                        </select><span class="master_message color--fadegreen">
                                            @if ($errors->has('governorate'))
                                                {{ $errors->first('governorate') }}
                                            @endif
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-6 col-xs-12">
                                    <div class="master_field">
                                        <label class="master_label mandatory" for="city">المدينة</label>
                                        <select class="master_input select2" id="city" name="city"
                                            style="width:100%;">
                                            @foreach ($cities as $city)
                                                @if ($city->id == $case->geo_city_id)
                                                    <option value="{{ $city->id }}" selected>{{ $city->name }}
                                                    </option>
                                                @else
                                                    <option value="{{ $city->id }}">{{ $city->name }}</option>
                                                @endif
                                            @endforeach
                                        </select><span class="master_message color--fadegreen">
                                            @if ($errors->has('city'))
                                                {{ $errors->first('city') }}
                                            @endif
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-6 col-xs-12">
                                    <div class="master_field">
                                        <label class="master_label mandatory" for="circle">الدائرة</label>
                                        <input class="master_input" id="circle" name="circle" type="text"
                                            data-placeholder="الدائرة" style="width:100%;"
                                            value="{{ $case->region }}"><span class="master_message color--fadegreen">
                                            @if ($errors->has('circle'))
                                                {{ $errors->first('circle') }}
                                            @endif
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-6 col-xs-12">
                                    <div class="master_field">
                                        <label class="master_label mandatory" for="case_year">السنة</label>
                                        <input class="master_input" type="number" placeholder="السنة" id="case_year"
                                            name="case_year" value="{{ $case->claim_year }}"><span
                                            class="master_message color--fadegreen">
                                            @if ($errors->has('case_year'))
                                                {{ $errors->first('case_year') }}
                                            @endif
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-6 col-xs-12">
                                    <div class="master_field">
                                        <label class="master_label mandatory" for="case_date">تاريخ قيد الدعوى </label>
                                        <div class="bootstrap-timepicker">
                                            <input class="datepicker master_input" type="text"
                                                placeholder="تاريخ قيد الدعوى " id="case_date" name="case_date"
                                                value="{{ $case->claim_date }}">
                                        </div><span class="master_message color--fadegreen">
                                            @if ($errors->has('case_date'))
                                                {{ $errors->first('case_date') }}
                                            @endif
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-6 col-xs-12">
                                    <div class="master_field">
                                        <label class="master_label mandatory" for="case_dateRang">تاريخ بدء / نهاية
                                            القضية</label>
                                        <input class="date_range_picker master_input" type="text"
                                            placeholder="ex:John Doe" id="case_dateRang" name="case_dateRang"
                                            value="{{ $case->case_startdate }}-{{ $case->case_enddate }}"><span
                                            class="master_message color--fadegreen">
                                            @if ($errors->has('case_dateRang'))
                                                {{ $errors->first('case_dateRang') }}
                                            @endif
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-6 col-xs-12">
                                    <div class="master_field">
                                        <label class="master_label mandatory" for="case_fees">مصروفات الدعوى</label>
                                        <input class="master_input" type="number" placeholder="مصروفات القضية"><span
                                            class="master_message color--fadegreen">

                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-6 col-xs-12">
                                    <div class="master_field">
                                        <label class="master_label mandatory">صور مستندات القضية</label>
                                        <div class="file-upload">
                                            <div class="file-select">
                                                <div class="file-select-name" id="noFile">صور مستندات القضية </div>
                                                <input class="chooseFile" type="file" name="chooseFile_case[]"
                                                    multiple>
                                            </div>
                                        </div><span class="master_message color--fadegreen">message content</span>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="master_field">
                                        <label class="master_label mandatory" for="subject">الموضوع</label>
                                        <input class="master_input" type="text" placeholder="الموضوع" id="subject"
                                            name="subject" value="{{ $case->case_body }}"><span
                                            class="master_message color--fadegreen">
                                            @if ($errors->has('subject'))
                                                {{ $errors->first('subject') }}
                                            @endif
                                        </span>
                                    </div>
                                </div>
                                <div class="col-xs-12">
                                    <div class="master_field">
                                        <label class="master_label mandatory" for="notes">ملاحظات</label>
                                        <textarea class="master_input" name="notes" id="notes" placeholder="ملاحظات"
                                            value="{{ $case->case_notes }}"></textarea><span
                                            class="master_message color--fadegreen">message</span>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        </li>
                        <li class="tab__content_item">
                            <div
                                class="cardwrap bgcolor--white bradius--noborder   bshadow--1 padding--small margin--small-top-bottom">
                                <br>
                                <div class="col-md-12"><b class="col-xs-2"> المحامي المسئول</b>
                                    <div class="col-xs-10">

                                        @foreach ($lawyers as $lawyer)
                                            @foreach ($case->lawyers as $case_lawyer)
                                                @if ($lawyer->id == $case_lawyer->id)
                                                    <a
                                                        href="{{ URL('lawyers_show/' . $lawyer->id) }}">{{ $lawyer->name }}</a>&nbsp;
                                                    &amp; &nbsp;
                                                @endif
                                            @endforeach
                                        @endforeach

                                    </div>
                                </div>
                                <div class="clearfix"> </div>
                                <div class="full-table">
                                    <div class="remodal-bg">
                                        <div class="remodal" data-remodal-id="filterModal_sponsors" role="dialog"
                                            aria-labelledby="modal1Title" aria-describedby="modal1Desc">
                                            <button class="remodal-close" data-remodal-action="close"
                                                aria-label="Close"></button>
                                            <div>
                                                <h2 id="modal1Title">فلتر</h2>
                                                <div class="col-md-6">
                                                    <div class="master_field">
                                                        <label class="master_label mandatory" for="ID_No">كود
                                                            المحامى</label>
                                                        <input class="master_input" type="number"
                                                            placeholder="كود المحامى" id="ID_No"><span
                                                            class="master_message color--fadegreen">message</span>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="master_field">
                                                        <label class="master_label mandatory" for="ID_No">اسم
                                                            المحامى</label>
                                                        <input class="master_input" type="text"
                                                            placeholder="اسم المحامى" id="ID_No"><span
                                                            class="master_message color--fadegreen">message</span>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="master_field">
                                                        <label class="master_label mandatory"
                                                            for="circle">الدائرة</label>
                                                        <select class="master_input select2" id="circle"
                                                            multiple="multiple" data-placeholder="الدائرة"
                                                            style="width:100%;" ,>
                                                            <option>دائرة العباسية</option>
                                                            <option>دائرة الدقي</option>
                                                        </select><span
                                                            class="master_message color--fadegreen">message</span>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="master_field">
                                                        <label class="master_label mandatory"
                                                            for="circle">الدائرة</label>
                                                        <select class="master_input select2" id="circle"
                                                            multiple="multiple" data-placeholder="الدائرة"
                                                            style="width:100%;" ,>
                                                            <option>دائرة العباسية</option>
                                                            <option>دائرة الدقي</option>
                                                        </select><span
                                                            class="master_message color--fadegreen">message</span>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="master_field">
                                                        <label class="master_label mandatory" for="ID_No">
                                                            التخصص</label>
                                                        <select class="master_input select2" id="ID_No"
                                                            multiple="multiple" data-placeholder="التخصص"
                                                            style="width:100%;" ,>
                                                            <option>تعويضات</option>
                                                            <option>تخصص اخر</option>
                                                        </select><span class="master_message color--fadegreen">message
                                                            content</span>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="master_field">
                                                        <label class="master_label mandatory" for="ID_No">درجة
                                                            التقاضي</label>
                                                        <select class="master_input select2" id="ID_No"
                                                            multiple="multiple" data-placeholder="درجة التقاضي"
                                                            style="width:100%;" ,>
                                                            <option>محامى تحت التمرين</option>
                                                            <option>محامي متمرس</option>
                                                        </select><span class="master_message color--fadegreen">message
                                                            content</span>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="master_field">
                                                        <label class="master_label mandatory"
                                                            for="ID_No">الهاتف</label>
                                                        <input class="master_input" type="number" placeholder="الهاتف"
                                                            id="ID_No"><span
                                                            class="master_message color--fadegreen">message</span>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="master_field">
                                                        <label class="master_label mandatory" for="ID_No">تاريخ
                                                            الالتحاق</label>
                                                        <div class="bootstrap-timepicker">
                                                            <input class="datepicker master_input" type="text"
                                                                placeholder="تاريخ الالتحاق" id="ID_No">
                                                        </div><span class="master_message color--fadegreen">message
                                                            content</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="clearfix"></div>
                                            <button class="remodal-cancel" data-remodal-action="cancel">الغاء</button>
                                            <button class="remodal-confirm" data-remodal-action="confirm">فلتر</button>
                                        </div>
                                    </div>
                                    <div class="filter__btns"><a
                                            class="master-btn bgcolor--main color--white bradius--small"
                                            href="#filterModal_sponsors"><i class="fa fa-filter"></i>filters</a></div>
                                    <table class="table-1">
                                        <thead>
                                            <tr class="bgcolor--gray_mm color--gray_d">
                                                <th><span class="cellcontent">&lt;input type=&quot;checkbox&quot;
                                                        name=&quot;select-all&quot; id=&quot;select-all&quot; /&gt;</span>
                                                </th>
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
                                            @foreach ($lawyers as $lawyer)
                                                <tr data-lawyer-id="{{ $lawyer->id }}">

                                                    <td><span class="cellcontent"><input class="input-in-table"
                                                                type="checkbox" id="{{ $lawyer->id }}"
                                                                name="lawyer_id[{{ $lawyer->id }}]"
                                                                class="checkboxes" /></span></td>

                                                    <td><span class="cellcontent">{{ $lawyer->code }}</span></td>
                                                    <td><span class="cellcontent">{{ $lawyer->name }}</span></td>
                                                    <td><span
                                                            class="cellcontent">{{ $lawyer->user_detail->national_id or '' }}</span>
                                                    </td>
                                                    <td><span class="cellcontent">{{ $lawyer->nationality or '' }}</span>
                                                    </td>
                                                    <td><span
                                                            class="cellcontent">{{ $lawyer->user_detail->work_sector or '' }}</span>
                                                    </td>
                                                    <td><span
                                                            class="cellcontent">{{ $lawyer->user_detail->litigation_level or '' }}</span>
                                                    </td>
                                                    <td><span class="cellcontent">{{ $lawyer->address }}</span></td>
                                                    <td><span class="cellcontent">{{ $lawyer->mobile }}</span></td>
                                                    <td><span
                                                            class="cellcontent">{{ $lawyer->user_detail->join_date or '' }}</span>
                                                    </td>
                                                    @if ($lawyer->is_active)
                                                        <td><span class="cellcontent"><i
                                                                    class="fa color--fadegreen fa-check"></i></span></td>
                                                    @else
                                                        <td><span class="cellcontent"><i
                                                                    class="fa color--fadebrown fa-times"></i></span></td>
                                                    @endif
                                                </tr>
                                            @endforeach

                                        </tbody>
                                    </table>
                                    <div class="remodal log-custom" role="dialog" aria-labelledby="modal1Title"
                                        aria-describedby="modal1Desc">
                                        <button class="remodal-close" data-remodal-action="close"
                                            aria-label="Close"></button>
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
                        </li>
                    </ul>
                </div>
                <div class="clearfix"></div>
                <div class="col-md-2 col-xs-6">
                    <button
                        class="master-btn undefined btn-block color--white bgcolor--fadepurple bradius--small bshadow--0"
                        type="submit"><i class="fa fa-save"></i><span>حفظ</span>
                    </button>
                </div>
                <div class="col-md-2 col-xs-6">
                    <button
                        class="master-btn undefined btn-block color--white bgcolor--fadebrown bradius--small bshadow--0"
                        type="submit"><i class="fa fa-times"></i><span>الغاء</span>
                    </button>
                </div>
                <div class="clearfix"></div><br>
            </form>
        </div>
    </div>
    <!-- =============== PAGE VENDOR Triggers ===============-->
    <div class="remodal" data-remodal-id="new_investigation" role="dialog" aria-labelledby="modal1Title"
        aria-describedby="modal1Desc">
        <form action="{{ URL('add_record_ajax/' . $case->id) }}" method="post" enctype="multipart/form-data"
            accept-charset="utf-8">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <button class="remodal-close" data-remodal-action="close" aria-label="Close"></button>
            <div>
                <div class="row">
                    <div class="col-xs-12">
                        <h3>إضافة محضر</h3>
                        <div class="col-xs-4">
                            <div class="master_field">
                                <label class="master_label" for="investigation_no">رقم المحضر</label>
                                <input class="master_input" type="text" placeholder="رقم المحضر"
                                    id="investigation_no" name="investigation_no"><span
                                    class="master_message color--fadegreen">message</span>
                            </div>
                        </div>
                        <div class="col-xs-4">
                            <div class="master_field">
                                <label class="master_label mandatory" for="investigation_type"> نوع المحضر </label>
                                <select class="master_input select2" id="investigation_type" name="investigation_type"
                                    style="width:100%;">
                                    @foreach ($cases_record_types as $type)
                                        <option value="{{ $type->id }}">{{ $type->name_ar }}</option>
                                    @endforeach
                                </select><span class="master_message color--fadegreen">message</span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="master_field">
                                <label class="master_label mandatory">تاريخ</label>
                                <div class="bootstrap-timepicker">
                                    <input class="datepicker master_input" type="text" placeholder="تاريخ الاستشارة"
                                        name="record_date">
                                </div><span class="master_message color--fadegreen">message content</span>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="master_field">
                                <label class="master_label" for="docs_upload">إرفاق ملفات</label>
                                <div class="file-upload">
                                    <div class="file-select">
                                        <div class="file-select-name" id="noFile">إرفاق ملفات</div>
                                        <input class="chooseFile" type="file" name="record_documents[]"
                                            id="docs_upload" multiple>
                                    </div>
                                </div><span class="master_message color--fadegreen">message</span>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div><br>
            <button class="remodal-cancel" data-remodal-action="cancel">إلغاء</button>
            <button class="remodal-confirm" type="submit">حفظ</button>
        </form>
    </div>
@endsection


@section('js')
    <script type="text/javascript">
        $(document).ready(function() {

            /*         var i={{ $client_count }};
                        function add_more_clients()
                                  {
                              i++;
                              var div = document.getElementById('add_new_client');
                              // alert(i);
                              // alert("'client_code_"+i"'");
                                div.innerHTML += '<div class="col-md-3 col-sm-6 col-xs-12">  <div class="master_field"><label class="master_label mandatory" for="client_code_'+i+'">كود العميل</label><select class="master_input select2"  id="client_code_'+i+'" name="client_code['+i+']" style="width:100%;" onchange="set_client_data('+this.value+' ,'+i+',{{ $clients }})"><option value="-1" selected disabled hidden>إختر كود العميل</option>@foreach ($clients as $client)
                    < option value = "{{ $role->id }}" > {{ $role->name_ar }} < /option>/ ** *
                        script_placeholder ** * /} / * ___directives_script_3___ * /</select > < span class =
                        "master_message color--fadegreen" > message content < /span>  </div > <
                        /div><div class="col-md-3 col-sm-6 col-xs-12"> <div class="master_field"> <label class="master_label mandatory" for="authorization_num_'+i+'">رقم التوكيل</label >
                        < input class = "master_input"
                    type = "number"
                    placeholder = "رقم التوكيل"
                    id = "authorization_num_'+i+'"
                    name = "authorization_num['+i+']" > < span class = "master_message color--fadegreen" > message <
                        /span> </div > <
                        /div> <div class="col-md-9 col-sm-6 col-xs-12"> <div class="master_field"> <label class="master_label mandatory" for="client_address_'+i+'">عنوانه</label >
                        < input class = "master_input"
                    type = "text"
                    placeholder = "عنوانه"
                    id = "client_address_'+i+'"
                    name = "client_address['+i+']"
                    readonly > < span class = "master_message color--fadegreen" > بعض النص < /span> </div > <
                        /div>';
                    // alert(i);
                }
                */


            function set_client_data(id, i, clients) {
                var code = document.getElementById('client_code_' + i);
                var name = document.getElementById('client_name_' + i);
                var mobile = document.getElementById('client_number_' + i);
                var address = document.getElementById('client_address_' + i);
                code.selectedIndex = code.selectedIndex;
                name.selectedIndex = code.selectedIndex;
                for (var client in clients) {
                    for (var item in clients[client]) {
                        if (item == 'id' && clients[client][item] == id) {
                            // alert(item);
                            name.value = clients[client]['name'];
                            mobile.value = clients[client]['mobile'];
                            address.value = clients[client]['address'];
                        }
                    }

                }

            }



            $('.btn-warning-cancel').click(function() {
                var record_id = $(this).closest('tr').attr('data-record-id');
                var _token = '{{ csrf_token() }}';
                swal({
                        title: "هل أنت متأكد؟",
                        text: "لن تستطيع إسترجاع هذه المعلومة لاحقا",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonColor: '#DD6B55',
                        confirmButtonText: 'نعم متأكد!',
                        cancelButtonText: "إلغاء",
                        closeOnConfirm: false,
                        closeOnCancel: false
                    },
                    function(isConfirm) {
                        // alert();
                        if (isConfirm) {
                            $.ajax({
                                type: 'GET',
                                url: '{{ url('case_record_destroy/$case->id') }}' + '/' +
                                    record_id,
                                data: {
                                    _token: _token
                                },
                                success: function(data) {
                                    $('tr[data-record-id=' + record_id + ']').fadeOut();
                                }
                            });
                            swal("تم الحذف!", "تم الحذف بنجاح", "success");
                        } else {
                            swal("تم الإلغاء", "المعلومات مازالت موجودة :)", "error");
                        }
                    });
            });
            var files;

            function prepareUpload(event) {
                files = event.target.files;
                // console.log(files);
            }
            $('input#record_documents').on('change', prepareUpload);
        });







        // Grab the files and set them to our variable


        // var record_data =[];
        //     function add_record(case_id)
        //     {
        //       record_data['investigation_no']= $('#investigation_no').val();
        //       record_data['investigation_type']= $('#investigation_type').val();
        //       record_data['investigation_date']= $('#investigation_date').val();

        //       var data = new FormData();
        //     $.each(files, function(key, value)
        //     {

        //         data.append(key, value);

        //     });
        //     //  var result ;
        // var files_arr = [];
        //     for (var key of data.entries()) {
        //         // console.log(key[1])
        //         files_arr.push(key[1].name);
        //     }

        //      console.log(files_arr);
        //     // console.log(result);
        //        // record_data['record_documents']= $('#record_documents').val();
        //        //  $('input[name="record_documents"]').each(function(){
        //        //     record_data['record_documents'] = $(this).val();
        //        // });

        // // alert(record_data['investigation_no']);
        //     //   $.ajax({
        //     //        type:'POST',
        //     //        url:'{{ url('add_record_ajax/' . $case->id) }}',
        //     //        processData: false, // Don't process the files
        //     //        contentType: false,
        //     //        data:{'files':result
        //     //        ,'investigation_no':record_data['investigation_no']
        //     //        ,'investigation_type':record_data['investigation_type']
        //     //        ,'investigation_date':record_data['investigation_date']
        //     //        ,'_token':"{{ csrf_token() }}"},
        //     //        success:function(data){
        //     //           alert(data);
        //     //     // $this.html(data);
        //     //   // alert(data);
        //     //       },
        //     //        error: function (jqXHR, exception) {
        //     //     var msg = '';
        //     //     if (jqXHR.status === 0) {
        //     //         msg = 'Not connect.\n Verify Network.';
        //     //     } else if (jqXHR.status == 404) {
        //     //         msg = 'Requested page not found. [404]';
        //     //     } else if (jqXHR.status == 500) {
        //     //         msg = 'Internal Server Error [500].';
        //     //     } else if (exception === 'parsererror') {
        //     //         msg = 'Requested JSON parse failed.';
        //     //     } else if (exception === 'timeout') {
        //     //         msg = 'Time out error.';
        //     //     } else if (exception === 'abort') {
        //     //         msg = 'Ajax request aborted.';
        //     //     } else {
        //     //         msg = 'Uncaught Error.\n' + jqXHR.responseText;
        //     //     }
        //     //     $('#post').html(msg);
        //     // },
        //     //     });

        //     $.ajax({
        //       type: 'post',
        //       url: "{{ URL('add_record_ajax/' . $case->id . '?files=') }}"+files_arr,
        //       data: {
        //         _token: "{{ csrf_token() }}",
        //         // files:files_arr,
        //         investigation_no:record_data['investigation_no']
        //        ,investigation_type:record_data['investigation_type']
        //         ,investigation_date:record_data['investigation_date']
        //       },
        //       success: function(data)
        //       {
        //         if(typeof data.error === 'undefined')
        //             {
        //                 // Success so call function to process the form
        //                 alert(data);
        //             }
        //             else
        //             {
        //                 // Handle errors here
        //                 console.log('ERRORS: ' + data.error);
        //             }
        //       }
        //     });
        //     }
    </script>
@endsection
