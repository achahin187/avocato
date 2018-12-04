@extends('layout.app')
@section('content')

<div class="row">
  <div class="col-lg-12">
    <div class="cover-inside-container margin--small-top-bottom bradius--small bshadow--1" style="background:  url( '../img/covers/dummy2.jpg ' ) no-repeat center center; background-size:cover;">
      <div class="row">
        <div class="col-xs-12">
          <div class="text-xs-center">
            <div class="text-wraper">
              <h4 class="cover-inside-title color--gray_d">تقارير و احصائيات</h4>
            </div>
          </div>
        </div>
        <div class="cover--actions">
        </div>
      </div>
    </div>
  </div>
<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
    <div class="stat-box stat-box-3 margin--small-top-bottom bgcolor--white bshadow--1 bradius--small">
    <div class="c100 p{{ round($percentage_individuals) }} rad_progress_size_small"><span>{{ $percentage_individuals }}%</span>
        <div class="slice">
        <div class="bar"></div>
        <div class="fill"></div>
        </div>
    </div>
    <div class="stat-box-content color--fadeblue"><span class="stat-box-text">عملاء افراد</span><span class="stat-box-number">{{ $count_individuals }}</span></div>
    </div>
</div>
<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
    <div class="stat-box stat-box-3 margin--small-top-bottom bgcolor--white bshadow--1 bradius--small">
    <div class="c100 p{{ round($percentage_companies) }} rad_progress_size_small"><span>{{ $percentage_companies }}%</span>
        <div class="slice">
        <div class="bar"></div>
        <div class="fill"></div>
        </div>
    </div>
    <div class="stat-box-content color--fadeblue"><span class="stat-box-text">عملاء شركات</span><span class="stat-box-number">{{ $count_companies }}</span></div>
    </div>
</div>
<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
    <div class="stat-box stat-box-3 margin--small-top-bottom bgcolor--white bshadow--1 bradius--small">
    <div class="c100 p{{ round($percentage_indcom) }} rad_progress_size_small"><span>{{ $percentage_indcom }}%</span>
        <div class="slice">
        <div class="bar"></div>
        <div class="fill"></div>
        </div>
    </div>
    <div class="stat-box-content color--fadeblue"><span class="stat-box-text">عملاء افراد - شركات</span><span class="stat-box-number">{{ $count_indcom }}</span></div>
    </div>
</div>
<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
    <div class="stat-box stat-box-3 margin--small-top-bottom bgcolor--white bshadow--1 bradius--small">
    <div class="c100 p{{ round($percentage_mobile) }} rad_progress_size_small"><span>{{ $percentage_mobile }}%</span>
        <div class="slice">
        <div class="bar"></div>
        <div class="fill"></div>
        </div>
    </div>
    <div class="stat-box-content color--fadeblue"><span class="stat-box-text">عملاء استشارات عبر التطبيق</span><span class="stat-box-number">{{ $count_mobile }}</span></div>
    </div>
</div>
<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
    <div class="stat-box margin--small-top-bottom bgcolor--white bshadow--1 bradius--small"><span class="stat-box-icon bgcolor--fadeorange color--white"><i class="fa fa fa-gavel"></i></span>
    <div class="stat-box-content color--fadeorange"><span class="stat-box-text">عدد القضايا</span><span class="stat-box-number">{{ $count_case }}</span></div>
    </div>
</div>
<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
    <div class="stat-box margin--small-top-bottom bgcolor--white bshadow--1 bradius--small"><span class="stat-box-icon bgcolor--gray_d color--white"><i class="fa fa fa-tag"></i></span>
    <div class="stat-box-content color--gray_d"><span class="stat-box-text">عدد الخدمات المدفوعة</span><span class="stat-box-number">{{ $count_paid_services }}</span></div>
    </div>
</div>
<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
    <div class="stat-box margin--small-top-bottom bgcolor--white bshadow--1 bradius--small"><span class="stat-box-icon bgcolor--fadebrown color--white"><i class="fa fa fa-gift"></i></span>
    <div class="stat-box-content color--fadebrown"><span class="stat-box-text">عدد الخدمات المجانية</span><span class="stat-box-number">{{ $count_free_services }}</span></div>
    </div>
</div>
<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
  <div class="stat-box margin--small-top-bottom bgcolor--white bshadow--1 bradius--small"><span class="stat-box-icon bgcolor--fadepurple color--white"><i class="fa fa fa-phone"></i></span>
    <div class="stat-box-content color--fadepurple"><span class="stat-box-text">عدد المكالمات من التطبيق</span><span class="stat-box-number">{{$call_services}}</span></div>
  </div>
</div>
  <div class="col-md-12">
    <div class="tabs--wrapper">
      <div class="clearfix"></div>
      <ul class="tabs">
        <li>القضايا</li>
        <li>المحاميين</li>
        <li>الشركات</li>
        <li>الاقساط</li>
        <li>الطوارئ</li>
        <li>المحاكم</li>
        <li>المهام</li>
        <li>انواع القضايا</li>
      </ul>
      <ul class="tab__content">
        <li class="tab__content_item active">
          <div class="cardwrap bgcolor--white bradius--noborder   bshadow--1 padding--small margin--small-top-bottom">
            <div class="full-table">
              <div class="remodal-bg">
                <div class="remodal" data-remodal-id="filtertab1" role="dialog" aria-labelledby="modal1Title" aria-describedby="modal1Desc">
                  <button class="remodal-close" data-remodal-action="close" aria-label="Close"></button>
                  <form action="{{ route('report.filter') }}" method="POST">
                    {{ csrf_field() }}
      
                    <div>
                      <h2 id="modal1Title">فلتر</h2>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <div class="master_field">
                          <label class="master_label mandatory" for="govern">المحافظة</label>
                          <select name="gov[]" class="master_input select2" id="govern" multiple="multiple" data-placeholder="المحافظة" style="width:100%;">
                            @if ( isset($governorates) && !empty($governorates) )
                                @foreach ($governorates as $gov)
                                  <option value="{{ $gov->id }}">{{ $gov->name }}</option>
                                @endforeach
                            @endif
                          </select>
                        </div>
                      </div>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <div class="master_field">
                          <label class="master_label mandatory" for="city">المدينة</label>
                          <select name="city[]" class="master_input select2" id="city" multiple="multiple" data-placeholder="المدينة" style="width:100%;" ,>
                            @if ( isset($cities) && !empty($cities) )
                              @foreach ($cities as $city)
                                <option value="{{ $city->id }}">{{ $city->name }}</option>
                              @endforeach
                            @endif
                          </select>
                        </div>
                      </div>
                    </div>
                    <div class="clearfix"></div>
                    <button class="remodal-cancel" data-remodal-action="cancel">الغاء</button>
                    <button type="submit" class="remodal-confirm">فلتر</button>
                  </form>
                </div>
              </div>
              <div class="filter__btns"><a class="master-btn bgcolor--main color--white bradius--small" href="#filtertab1"><i class="fa fa-filter"></i>filters</a></div>
              <div class="bottomActions__btns"><a class="cases-btn master-btn bradius--small padding--small bgcolor--fadeblue color--white" href="#">استخراج اكسيل</a>
              </div>
              <table class="table-1">
                <thead>
                  <tr class="bgcolor--gray_mm color--gray_d">
                    <th><span class="cellcontent">&lt;input type=&quot;checkbox&quot; name=&quot;select-all&quot; id=&quot;select-all&quot; onclick=&quot;checkAll(this)&quot; /&gt;</span></th>
                    <th><span class="cellcontent">المحافظة</span></th>
                    <th><span class="cellcontent">المدينة</span></th>
                    <th><span class="cellcontent">إجمالي عدد القضايا</span></th>
                  </tr>
                </thead>
                <tbody>
                  @if (isset($cases) && !empty($cases))
                    @foreach ($cases as $case)
                    <tr data-case-id="{{ $case->geo_city_id }}">
                        <td><span class="cellcontent"><input type="checkbox" class="checkboxes" data-id="{{ $case->geo_city_id }}" /></span></td>
                        <td><span class="cellcontent">{{ ($case->governorates) ? $case->governorates->name : 'لا يوجد' }}</span></td>
                        <td><span class="cellcontent">{{ ($case->cities) ? $case->cities->name : 'لا يوجد' }}</span></td>
                        <td><span class="cellcontent">{{ $case->total ? $case->total : 0 }}</span></td>
                    </tr>
                    @endforeach
                  @endif
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
        </li>
        <li class="tab__content_item">
          <div class="cardwrap bgcolor--white bradius--noborder   bshadow--1 padding--small margin--small-top-bottom">
            <div class="full-table">
              <div class="remodal-bg">
                <div class="remodal" data-remodal-id="filtertab2" role="dialog" aria-labelledby="modal1Title" aria-describedby="modal1Desc">
                  <button class="remodal-close" data-remodal-action="close" aria-label="Close"></button>

                  <form action="{{ route('report.filter') }}" method="POST">
                    {{ csrf_field() }}

                    <div> 
                      <h2 id="modal1Title">فلتر</h2>
                      <div class="col-md-4 col-sm-6 col-xs-12">
                        <div class="master_field">
                          <label class="master_label mandatory" for="lawyer_spec"> تخصص المحامي</label>
                          <select name="workSector" class="master_input select2" id="lawyer_spec" data-placeholder="التخصص" style="width:100%;" ,>
                              <option value="-1" selected disabled hidden>اختر التخصص</option>
                            @if ( isset($lawyers_) && !empty($lawyers_) )
                              @foreach ($lawyers_ as $lawyer)
                                <option value="{{ ($lawyer->user_detail) ? $lawyer->user_detail->work_sector : 0 }}">{{ ($lawyer->user_detail) ? $lawyer->user_detail->work_sector : 'غير معرف' }}</option>
                              @endforeach
                            @endif
                          </select>
                        </div>
                      </div>
                      <div class="col-md-4 col-sm-6 col-xs-12">
                        <div class="master_field">
                          <label class="master_label mandatory" for="lawyer_degree_in">درجة التقاضي</label>
                          <select name="level" class="master_input select2" id="lawyer_degree_in" data-placeholder="درجة التقاضي" style="width:100%;" ,>
                              <option value="-1" selected disabled hidden>اختر درجة التقاضي</option>
                            @if ( isset($lawyers_) && !empty($lawyers_) )
                              @foreach ($lawyers_ as $lawyer)
                                <option value="{{ ($lawyer->user_detail) ? $lawyer->user_detail->litigation_level : 0 }}">{{ ($lawyer->user_detail) ? $lawyer->user_detail->litigation_level : 'غير معرف' }}</option>
                              @endforeach
                            @endif
                          </select>
                        </div>
                      </div>
                      <div class="col-md-4 col-sm-6 col-xs-12">
                        <div class="master_field">
                          <label class="master_label mandatory" for="lawyer_nationality">الجنسية</label>
                            <select name="nationality" class="master_input select2" id="license_type" style="width:100%;">
                
                              <option value="-1" selected disabled hidden>اختر الجنسية</option>
                              
                              @foreach ($nationalities as $nat)
                                <option value="{{ $nat->id }}">{{ Helper::localizations('geo_countries', 'nationality', $nat->id) }}</option>
                              @endforeach
                              
                            </select>  
                        </div>
                      </div>
                      <div class="col-md-4 col-sm-6 col-xs-12">
                        <div class="master_field">
                          <label class="master_label mandatory" for="work_type">نوع العمل</label>
                          <select name="workTitle" class="master_input select2" id="work_type" data-placeholder="نوع العمل " style="width:100%;" ,>
                              <option value="-1" selected disabled hidden>اختر نوع العمل</option>
                            @if ( isset($lawyers_) && !empty($lawyers_) )
                              @foreach ($lawyers_ as $lawyer)
                                <option value="{{ ($lawyer->user_detail) ? $lawyer->user_detail->job_title : 0 }}">{{ ($lawyer->user_detail) ? $lawyer->user_detail->job_title : 'غير معرف' }}</option>
                              @endforeach
                            @endif
                          </select>
                        </div>
                      </div>
                      <div class="col-md-4 col-sm-6 col-xs-12">
                        <div class="master_field">
                          <label class="master_label mandatory" for="lawyer_place">الإختصاص المكاني</label>
                          <select name="workSectorType" class="master_input select2" id="lawyer_place"  data-placeholder="التخصص" style="width:100%;" ,>
                              <option value="-1" selected disabled hidden>اختر الاختصاص المكاني</option>
                            @if ( isset($lawyers_) && !empty($lawyers_) )
                              @foreach ($lawyers_ as $lawyer)
                                <option value="{{ ($lawyer->user_detail) ? $lawyer->user_detail->work_sector_type : 0 }}">{{ ($lawyer->user_detail) ? $lawyer->user_detail->work_sector_type : 'غير معرف' }}</option>
                              @endforeach
                            @endif
                          </select>
                        </div>
                      </div>
                    </div>
                    <div class="clearfix"></div>
                    <button class="remodal-cancel" data-remodal-action="cancel">الغاء</button>
                    <button type="submit" class="remodal-confirm">فلتر</button>
                  </form>

                </div>
              </div>
              <div class="filter__btns"><a class="master-btn bgcolor--main color--white bradius--small" href="#filtertab2"><i class="fa fa-filter"></i>filters</a></div>
              <div class="bottomActions__btns"><a class="master-btn bradius--small padding--small bgcolor--fadeblue color--white excel-btn-lawyers" href="#">استخراج اكسيل</a>
              </div>
              <table class="table-1">
                <thead>
                  <tr class="bgcolor--gray_mm color--gray_d">
                    <th><span class="cellcontent">&lt;input type=&quot;checkbox&quot; name=&quot;select-all&quot; id=&quot;select-all&quot; onclick=&quot;checkAll(this)&quot; /&gt;</span></th>
                    <th><span class="cellcontent">الاسم</span></th>
                    <th><span class="cellcontent">التخصص</span></th>
                    <th><span class="cellcontent">درجة التقاضي</span></th>
                    <th><span class="cellcontent">الجنسية</span></th>
                    <th><span class="cellcontent">نوع العمل</span></th>
                    <th><span class="cellcontent">الإختصاص المكاني</span></th>
                    <th><span class="cellcontent">عدد المهام</span></th>
                    <th><span class="cellcontent">عدد القضايا</span></th>
                  </tr>
                </thead>
                <tbody>
                  @if ( isset($lawyers) && !empty($lawyers) )
                    @foreach ($lawyers as $lawyer)
                    <tr data-lawyer-id="{{ $lawyer->id }}"> 
                      <td><span class="cellcontent"><input type="checkbox" class="checkboxes" /></span></td>
                      <td><span class="cellcontent">{{ ($lawyer->full_name) ? $lawyer->full_name : 'لا يوجد' }}</span></td>
                      <td><span class="cellcontent">{{ ($lawyer->user_detail) ? $lawyer->user_detail->work_sector : 'لا يوجد' }}</span></td>
                      <td><span class="cellcontent">{{ ($lawyer->user_detail) ? ($lawyer->user_detail->litigation_level ? $lawyer->user_detail->litigation_level :'لا يوجد') : 'لا يوجد' }}</span></td>
                      <td><span class="cellcontent">{{ ($lawyer->user_detail) ? Helper::localizations('geo_countries', 'nationality', $lawyer->user_detail->nationality_id) : 'لا يوجد' }}</span></td>
                      <td><span class="cellcontent">{{ (isset($lawyer->user_detail)) ? $lawyer->user_detail->job_title : 'لا يوجد' }}</span></td>
                      <td><span class="cellcontent">{{ ($lawyer->user_detail) ? $lawyer->user_detail->work_sector_type : 'لا يوجد' }}</span></td>
                      <td><span class="cellcontent">{{ ($lawyer->tasks) ? $lawyer->tasks->count() : 0 }}</span></td>
                      <td><span class="cellcontent">{{ ($lawyer->cases) ? $lawyer->cases->count() : 0 }}</span></td>
                    </tr>
                    @endforeach
                  @endif
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
            <div class="clearfix"></div>
          </div>
        </li>
        <li class="tab__content_item">
          <div class="cardwrap bgcolor--white bradius--noborder   bshadow--1 padding--small margin--small-top-bottom">
            <div class="full-table">
              <div class="remodal-bg">
                <div class="remodal" data-remodal-id="filtertab3" role="dialog" aria-labelledby="modal1Title" aria-describedby="modal1Desc">
                  <button class="remodal-close" data-remodal-action="close" aria-label="Close"></button>

                  <form action="{{ route('report.filter') }}" method="POST">
                    {{ csrf_field() }}

                    <div>
                      <h3 id="modal1Title">فلتر</h3>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <div class="master_field">
                          <label class="master_label mandatory" for="license_code">الشركة</label>
                          <select name="company" class="master_input select2" id="lawyer_spec" data-placeholder="اسم وكود الشركة" style="width:100%;" ,>
                              <option value="-1" selected disabled hidden>اختر الشركة</option>
                              @if ( isset($companies_) && !empty($companies_) )
                                @foreach ($companies_ as $com)
                                  <option value="{{ $com->id }}">{{ $com->full_name .' - '. $com->code }}</option>
                                @endforeach
                              @endif
                          </select>
                        </div>
                      </div>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <div class="master_field">
                          <label class="master_label mandatory" for="license_type"> نوع التعاقد </label>
                          <select name="packages[]" class="master_input select2" id="license_type" multiple="multiple" data-placeholder="نوع التعاقد" style="width:100%;" ,>
                              @if ( isset($packages_) && !empty($packages_) )
                                @foreach ($packages_ as $pck)
                                  <option value="{{ $pck->id }}">{{ Helper::localizations('package_types', 'name', $pck->id) }}</option>
                                @endforeach
                              @endif
                          </select>
                        </div>
                      </div>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <div class="master_field">
                          <label class="master_label mandatory">التفعيل</label>
                          <div class="radiorobo">
                            <input name="activate" value="1" type="radio" id="rad_1" checked>
                            <label for="rad_1">الكل</label>
                          </div>
                          <div class="radiorobo">
                            <input name="activate" value="2" type="radio" id="rad_2">
                            <label for="rad_2">المفعلين</label>
                          </div>
                          <div class="radiorobo">
                            <input name="activate" value="3" type="radio" id="rad_3">
                            <label for="rad_3">غير المفعلين</label>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="clearfix"></div>
                    <button class="remodal-cancel" data-remodal-action="cancel">الغاء</button>
                    <button type="submit" class="remodal-confirm">فلتر</button>
                  </form>
                </div>
              </div>
              <div class="filter__btns"><a class="master-btn bgcolor--main color--white bradius--small" href="#filtertab3"><i class="fa fa-filter"></i>filters</a></div>
              <div class="bottomActions__btns"><a class="master-btn bradius--small padding--small bgcolor--fadeblue color--white excel-btn-companies" href="#">استخراج اكسيل</a>
              </div>
              <table class="table-1">
                <thead>
                  <tr class="bgcolor--gray_mm color--gray_d">
                    <th><span class="cellcontent">&lt;input type=&quot;checkbox&quot; name=&quot;select-all&quot; id=&quot;select-all&quot; onclick=&quot;checkAll(this)&quot; /&gt;</span></th>
                    <th><span class="cellcontent">كودالشركة</span></th>
                    <th><span class="cellcontent">اسم الشركة</span></th>
                    <th><span class="cellcontent">نوع التعاقد</span></th>
                    <th><span class="cellcontent">عدد العملاء</span></th>
                    <th><span class="cellcontent">عدد القضايا</span></th>
                  </tr>
                </thead>
                <tbody>
                    
                  @foreach ($companies as $company)
                    <tr data-company-id= "{{$company->id}}">
                      <td><span class="cellcontent"><input type="checkbox" class="checkboxes" /></span></td>
                      <td><span class="cellcontent">{{ ($company->code) ? $company->code : 'لا يوجد' }}</span></td>
                      <td><span class="cellcontent">{{ ($company->full_name) ? $company->full_name : 'لا يوجد' }}</span></td>
                      <td><span class="cellcontent">{{ ($company->subscription) ? Helper::localizations('package_types', 'name', $company->subscription->package_type_id) : 'لا يوجد' }}</span></td>
                      <td><span class="cellcontent">{{ ($company->companyChildren) ? $company->companyChildren->count() : 0 }}</span></td>
                      <td><span class="cellcontent">{{ ($company->clients) ? $company->clients->count() : 0 }}</span></td>
                    </tr>
                  @endforeach
                 
                </tbody>
              </table>
              <div class="remodal log-custom" data-remodal-id="log_link" role="dialog" aria-labelledby="modal1Title" aria-describedby="modal1Desc">
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
              <div class="clearfix"></div>
            </div>
          </div>
        </li>
        <li class="tab__content_item">
          <div class="cardwrap bgcolor--white bradius--noborder   bshadow--1 padding--small margin--small-top-bottom">
            <div class="full-table">
              <div class="remodal-bg">
                <div class="remodal" data-remodal-id="filtertab4" role="dialog" aria-labelledby="modal1Title" aria-describedby="modal1Desc">
                  <button class="remodal-close" data-remodal-action="close" aria-label="Close"></button>

                  <form action="{{ route('report.filter') }}" method="POST">
                    {{ csrf_field() }}

                    <div>
                      <h2 id="modal1Title">فلتر</h2>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <div class="master_field">
                          <label class="master_label mandatory" for="ID_No">كود العميل</label>
                          <select name="code" class="master_input select2" id="lawyer_spec" data-placeholder="كود العميل" style="width:100%;" ,>
                            <option value="-1" selected disabled hidden>اختر كود العميل</option>
                            @if ( isset($installments_) && !empty($installments_) )
                              @foreach ($installments_ as $ins)
                                <option value="{{ $ins->subscription_id }}">{{ $ins->subscription ? (Helper::getUserDetails($ins->subscription->user_id) ? Helper::getUserDetails($ins->subscription->user_id)->full_name .' - '. Helper::getUserDetails($ins->subscription->user_id)->code : 'لا يوجد' ) : 'لا يوجد' }}</option>
                              @endforeach
                            @endif
                        </select>
                        </div>
                      </div>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                      </div>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <div class="master_field">
                          <label class="master_label mandatory" for="license_date">التاريخ</label>
                          <div class="bootstrap-timepicker">
                            <input name="startDate" class="datepicker master_input" type="text" placeholder="تاريخ بداية النعاقد" id="license_date">
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <div class="master_field">
                          <label class="master_label mandatory">حالة الدفع</label>
                          <div class="radiorobo">
                            <input name="activate1" value="1" type="radio" id="payment_all" checked>
                            <label for="payment_all">الكل</label>
                          </div>
                          <div class="radiorobo">
                            <input name="activate1" value="2" type="radio" id="payment_true">
                            <label for="payment_true">تم دفعه</label>
                          </div>
                          <div class="radiorobo">
                            <input name="activate1" value="3" type="radio" id="payment_false">
                            <label for="payment_false">لم يتم دفعه</label>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="clearfix"></div>
                    <button class="remodal-cancel" data-remodal-action="cancel">الغاء</button>
                    <button type="submit" class="remodal-confirm">فلتر</button>
                  </form>
                </div>
              </div>
              <div class="filter__btns"><a class="master-btn bgcolor--main color--white bradius--small" href="#filtertab4"><i class="fa fa-filter"></i>filters</a></div>
              <div class="bottomActions__btns"><a class="master-btn bradius--small padding--small bgcolor--fadeblue color--white excel-btn-installments" href="#">استخراج اكسيل</a>
              </div>
              <table class="table-1">
                <thead>
                  <tr class="bgcolor--gray_mm color--gray_d">
                    <th><span class="cellcontent">&lt;input type=&quot;checkbox&quot; name=&quot;select-all&quot; id=&quot;select-all&quot; onclick=&quot;checkAll(this)&quot; /&gt;</span></th>
                    <th><span class="cellcontent">كود العميل </span></th>
                    <th><span class="cellcontent">نوع التعاقد</span></th>
                    <th><span class="cellcontent">ترتيب القسط</span></th>
                    <th><span class="cellcontent">التاريخ</span></th>
                    <th><span class="cellcontent">القيمة</span></th>
                    <th><span class="cellcontent">حالة الدفع</span></th>
                  </tr>
                </thead>
                <tbody>
                    @if ( isset($installments) && !empty($installments) )
                        @foreach ($installments as $ins)
                          <tr data-installment-id="{{ $ins->id }}">
                            <td><span class="cellcontent"><input type="checkbox" class="checkboxes" /></span></td>
                            <td><span class="cellcontent">{{ ($ins->subscription) ? (Helper::getUserDetails($ins->subscription->user_id) ? Helper::getUserDetails($ins->subscription->user_id)->code : 'لا يوجد')  : 'لا يوجد' }}</span></td>
                            <td><span class="cellcontent">{{ ($ins->subscription) ? ($ins->subscription->package_type ? Helper::localizations('package_types', 'name', $ins->subscription->package_type->id) : 'لا يوجد') : 'لا يوجد' }}</span></td>
                            <td><span class="cellcontent">{{ ($ins->installment_number) ? $ins->installment_number : 'لا يوجد' }}</span></td>
                            <td><span class="cellcontent">{{ ($ins->payment_date) ? $ins->payment_date->format('d-m-Y') : 'لا يوجد' }}</span></td>
                            <td><span class="cellcontent">{{ ($ins->value) ? $ins->value : 'لا يوجد' }}</span></td>
                            <td><span class="cellcontent">
                              @if ($ins->is_paid)
                                <label class= "data-label bgcolor--fadegreen color--white  ">تم</label>
                              @endif  
                            </span></td>
                          </tr>
                        @endforeach
                    @endif
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
            <div class="clearfix"></div>
          </div>
        </li>
        <li class="tab__content_item">
          <div class="cardwrap bgcolor--white bradius--noborder   bshadow--1 padding--small margin--small-top-bottom">
            <div class="full-table">
              <div class="remodal-bg">
                <div class="remodal" data-remodal-id="filtertab5" role="dialog" aria-labelledby="modal1Title" aria-describedby="modal1Desc">
                  <button class="remodal-close" data-remodal-action="close" aria-label="Close"></button>
                  <form action="{{ route('report.filter') }}" method="POST">
                    {{ csrf_field() }}
                    <div>
                      <h3 id="modal1Title">فلتر</h3>
                      <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="master_field">
                          <label class="master_label mandatory" for="client_type"> نوع العميل</label>
                            <select name="userType[]" class="master_input select2" id="client_type" multiple="multiple" data-placeholder="نوع العميل" style="width:100%;" ,>
                              <option value="9">شركات</option>
                              <option value="8">افراد</option>
                              <option value="10">شركات-أفراد</option>
                              <option value="7">موبايل</option>
                            </select>
                        </div>
                      </div>
                    </div>
                    <div class="clearfix"></div>
                    <button class="remodal-cancel" data-remodal-action="cancel">الغاء</button>
                    <button type="submit" class="remodal-confirm">فلتر</button>
                  </form>
                </div>
              </div>
              <div class="filter__btns"><a class="master-btn bgcolor--main color--white bradius--small" href="#filtertab5"><i class="fa fa-filter"></i>filters</a></div>
              <div class="bottomActions__btns"><a class="master-btn bradius--small padding--small bgcolor--fadeblue color--white excel-btn-urgents" href="#">استخراج اكسيل</a>
              </div>
              <table class="table-1">
                <thead>
                  <tr class="bgcolor--gray_mm color--gray_d">
                    <th><span class="cellcontent">&lt;input type=&quot;checkbox&quot; name=&quot;select-all&quot; id=&quot;select-all&quot; onclick=&quot;checkAll(this)&quot; /&gt;</span></th>
                    <th><span class="cellcontent">كودالعميل</span></th>
                    <th><span class="cellcontent">اسم العميل</span></th>
                    <th><span class="cellcontent">نوع العميل</span></th>
                    <th><span class="cellcontent">عدد حالات الطوارئ</span></th>
                  </tr>
                </thead>
                <tbody>
                    @if ( isset($urgents) && !empty($urgents) )
                        @foreach ($urgents as $urgent)
                          <tr data-urgent-id="{{ $urgent->id }}">
                            <td><span class="cellcontent"><input type="checkbox" class="checkboxes" /></span></td>
                            <td><span class="cellcontent">{{ ($urgent->code) ? $urgent->code : 'لا يوجد' }}</span></td>
                            <td><span class="cellcontent">{{ ($urgent->full_name) ? $urgent->full_name : 'لا يوجد' }}</span></td>
                            <td><span class="cellcontent">{{ ($urgent->rules) ? $urgent->rules->last()->name_ar : 'لا يوجد' }}</span></td>
                            <td><span class="cellcontent">{{ ($urgent->tasks) ? Helper::countTasks($urgent->id, [1]) : 'لا يوجد' }}</span></td>
                          </tr>
                        @endforeach
                    @endif
                </tbody>
              </table>
              <div class="remodal log-custom" data-remodal-id="log_link" role="dialog" aria-labelledby="modal1Title" aria-describedby="modal1Desc">
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
              <div class="clearfix"></div>
            </div>
          </div>
        </li>
        <li class="tab__content_item">
          <div class="cardwrap bgcolor--white bradius--noborder   bshadow--1 padding--small margin--small-top-bottom">
            <div class="full-table">
              <div class="remodal-bg">
                <div class="remodal" data-remodal-id="filtertab6" role="dialog" aria-labelledby="modal1Title" aria-describedby="modal1Desc">
                  <button class="remodal-close" data-remodal-action="close" aria-label="Close"></button>

                  <form action="{{ route('report.filter') }}" method="POST">
                    {{ csrf_field() }}

                  <div>
                    <h2 id="modal1Title">فلتر</h2>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <div class="master_field">
                        <label class="master_label mandatory" for="city">المدينة</label>
                        <select name="cities[]" class="master_input select2" id="city" multiple="multiple" data-placeholder="المدينة" style="width:100%;" ,>
                            @if ( isset($cities) && !empty($cities) )
                              @foreach ($cities as $city)
                                <option value="{{ $city->id }}">{{ $city->name }}</option>
                              @endforeach
                            @endif
                        </select>
                      </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <div class="master_field">
                        <label class="master_label mandatory" for="gov"> المحافظة </label>
                        <select name="govs[]" class="master_input select2" id="gov" multiple="multiple" data-placeholder="المحافظة" style="width:100%;" ,>
                          @if ( isset($governorates) && !empty($governorates) )
                            @foreach ($governorates as $gov)
                              <option value="{{ $gov->id }}">{{ $gov->name }}</option>
                            @endforeach
                          @endif
                        </select>
                      </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <div class="master_field">
                        <label class="master_label mandatory" for="court">المحكمة </label>
                        <select name="courts[]" class="master_input select2" id="court" multiple="multiple" data-placeholder="المحكمة" style="width:100%;" ,>
                          @if ( isset($courts_) && !empty($courts_) )
                            @foreach ($courts_ as $court)
                              <option value="{{ $court->id }}">{{ $court->name }}</option>
                            @endforeach
                          @endif
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="clearfix"></div>
                  <button class="remodal-cancel" data-remodal-action="cancel">الغاء</button>
                  <button type="submit" class="remodal-confirm">فلتر</button>
                  </form>
                </div>
              </div>
              <div class="filter__btns"><a class="master-btn bgcolor--main color--white bradius--small" href="#filtertab6"><i class="fa fa-filter"></i>filters</a></div>
              <div class="bottomActions__btns"><a class="master-btn bradius--small padding--small bgcolor--fadeblue color--white excel-btn-courts" href="#">استخراج اكسيل</a>
              </div>
              <table class="table-1">
                <thead>
                  <tr class="bgcolor--gray_mm color--gray_d">
                    <th><span class="cellcontent">&lt;input type=&quot;checkbox&quot; name=&quot;select-all&quot; id=&quot;select-all&quot; onclick=&quot;checkAll(this)&quot; /&gt;</span></th>
                    <th><span class="cellcontent">المدينة</span></th>
                    <th><span class="cellcontent">المحافظة</span></th>
                    <th><span class="cellcontent">المحكمة</span></th>
                    <th><span class="cellcontent">عدد القضايا</span></th>
                  </tr>
                </thead>
                <tbody>
                  @if ( isset($courts) && !empty($courts) )
                      @foreach ($courts as $court)
                      <tr data-court-id="{{ $court->name }}">
                        <td><span class="cellcontent"><input type="checkbox" class="checkboxes" /></span></td>
                        <td><span class="cellcontent">{{ ($court->city) ? $court->city->name : 'لا يوجد'  }}</span></td>
                        <td><span class="cellcontent">{{ ($court->city) ? (($court->city->governorate) ? $court->city->governorate->name : 'لا يوجد') : 'لا يوجد'  }}</span></td>
                        <td><span class="cellcontent">{{ ($court->name) ? $court->name : 'لا يوجد'}}</span></td>
                        <td><span class="cellcontent">{{ ($court->cases) ? $court->total : 0 }}</span></td>
                      </tr>
                      @endforeach
                  @endif
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
        </li>
        <li class="tab__content_item">
          <div class="cardwrap bgcolor--white bradius--noborder   bshadow--1 padding--small margin--small-top-bottom">
            <div class="full-table">
              <div class="remodal-bg">
                <div class="remodal" data-remodal-id="filtertab7" role="dialog" aria-labelledby="modal1Title" aria-describedby="modal1Desc">
                  <button class="remodal-close" data-remodal-action="close" aria-label="Close"></button>

                  <form action="{{ route('report.filter') }}" method="POST">
                    {{ csrf_field() }}

                    <div>
                      <h2 id="modal1Title">فلتر</h2>
                      <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="master_field">
                          <label class="master_label mandatory" for="task_type">نوع المهمة </label>
                          <select name="taskType[]" class="master_input select2" id="task_type" multiple="multiple" data-placeholder="نوع المهمة " style="width:100%;" ,>
                            @if ( isset($tasks_) && !empty($tasks_) )
                              @foreach ($tasks_ as $task)
                                <option value="{{ $task->id }}">{{ Helper::localizations('task_types', 'name', $task->id) }}</option>
                              @endforeach
                            @endif
                          </select>
                        </div>
                      </div>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <div class="master_field">
                          <label class="master_label mandatory" for="tasks_date_from">تاريخ من</label>
                          <input name="dateFrom" class="datepicker master_input" type="text" placeholder="التاريخ من">
                        </div>
                      </div>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <div class="master_field">
                          <label class="master_label mandatory" for="tasks_date_to">تاريخ الى</label>
                          <input name="dateTo" class="datepicker master_input" type="text" placeholder="التاريخ الي">
                        </div>
                      </div>
                    </div>
                    <div class="clearfix"></div>
                    <button class="remodal-cancel" data-remodal-action="cancel">الغاء</button>
                    <button type="submit" class="remodal-confirm">فلتر</button>
                  </form>

                </div>
              </div>
              <div class="filter__btns"><a class="master-btn bgcolor--main color--white bradius--small" href="#filtertab7"><i class="fa fa-filter"></i>filters</a></div>
              <div class="bottomActions__btns"><a class="master-btn bradius--small padding--small bgcolor--fadeblue color--white excel-btn-tasks" href="#">استخراج اكسيل</a>
              </div>
              <table class="table-1">
                <thead>
                  <tr class="bgcolor--gray_mm color--gray_d">
                    <th><span class="cellcontent">&lt;input type=&quot;checkbox&quot; name=&quot;select-all&quot; id=&quot;select-all&quot; onclick=&quot;checkAll(this)&quot; /&gt;</span></th>
                    <th><span class="cellcontent">نوع المهمة</span></th>
                    <th><span class="cellcontent">عددالمهام</span></th>
                  </tr>
                </thead>
                <tbody>
                  @if ( isset($tasks) && !empty($tasks) )
                      @foreach ($tasks as $task)
                      <tr data-task-id="{{ $task->id }}">
                        <td><span class="cellcontent"><input type="checkbox" class="checkboxes" /></span></td>
                        <td><span class="cellcontent">{{ ($task->name) ? Helper::localizations('task_types', 'name', $task->id) : 'لا يوجد' }}</span></td>
                        <td><span class="cellcontent">{{ ($task->tasks) ? $task->tasks->count() : 0 }}</span></td>
                      </tr>
                      @endforeach
                  @endif
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
            <div class="clearfix"></div>
          </div>
        </li>
        <li class="tab__content_item">
          <div class="cardwrap bgcolor--white bradius--noborder   bshadow--1 padding--small margin--small-top-bottom">
            <div class="full-table">
              <div class="remodal-bg">
                <div class="remodal" data-remodal-id="filtertab8" role="dialog" aria-labelledby="modal1Title" aria-describedby="modal1Desc">
                  <button class="remodal-close" data-remodal-action="close" aria-label="Close"></button>

                  <form action="{{ route('report.filter') }}" method="POST">
                    {{ csrf_field() }}
                  <div>
                    <h2 id="modal1Title">فلتر</h2>
                    <div class="col-md-4 col-sm-6 col-xs-12">
                      <div class="master_field">
                        <label class="master_label mandatory" for="case_govern">المحافظة</label>
                        <select name="govs1[]" class="master_input select2" id="case_govern" multiple="multiple" data-placeholder="المحافظة" style="width:100%;" ,>
                          @if ( isset($governorates) && !empty($governorates) )
                            @foreach ($governorates as $gov)
                              <option value="{{ $gov->id }}">{{ $gov->name }}</option>
                            @endforeach
                          @endif
                        </select>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6 col-xs-12">
                      <div class="master_field">
                        <label class="master_label mandatory" for="case_city">المدينة</label>
                        <select name="cities1[]" class="master_input select2" id="case_city" multiple="multiple" data-placeholder="المدينة" style="width:100%;" ,>
                          @if ( isset($cities) && !empty($cities) )
                            @foreach ($cities as $city)
                              <option value="{{ $city->id }}">{{ $city->name }}</option>
                            @endforeach
                          @endif
                        </select>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6 col-xs-12">
                      <div class="master_field">
                        <label class="master_label mandatory" for="case_type">نوع القضية</label>
                          <select name="caseType[]" class="master_input select2" id="case_type" multiple="multiple" data-placeholder="نوع القضية" style="width:100%;" ,>
                          @if ( isset($caseTypes) && !empty($caseTypes) )
                            @foreach ($caseTypes as $type)
                              <option value="{{ $type->id }}">{{ $type->name }}</option>
                            @endforeach
                          @endif
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="clearfix"></div>
                  <button class="remodal-cancel" data-remodal-action="cancel">الغاء</button>
                  <button type="submit" class="remodal-confirm">فلتر</button>
                  </form>
                </div>
              </div>
              <div class="filter__btns"><a class="master-btn bgcolor--main color--white bradius--small" href="#filtertab8"><i class="fa fa-filter"></i>filters</a></div>
              <div class="bottomActions__btns"><a class=" master-btn bradius--small padding--small bgcolor--fadeblue color--white excel-btn-casetype" href="">استخراج اكسيل</a>
              </div>
              <table class="table-1">
                <thead>
                  <tr class="bgcolor--gray_mm color--gray_d">
                    <th><span class="cellcontent">&lt;input type=&quot;checkbox&quot; name=&quot;select-all&quot; id=&quot;select-all&quot; onclick=&quot;checkAll(this)&quot; /&gt;</span></th>
                    <th><span class="cellcontent">نوع القضية</span></th>
                    <th><span class="cellcontent">المحافظة</span></th>
                    <th><span class="cellcontent">المدينة</span></th>
                    <th><span class="cellcontent">إجمالي عدد القضايا</span></th>
                  </tr>
                </thead>
                <tbody>
                  @if (isset($cases1) && !empty($cases1))
                    @foreach ($cases1 as $case)
                    <tr data-casetype-id="{{ $case->id }}">
                        <td><span class="cellcontent"><input type="checkbox" class="checkboxes" data-id="{{ $case->id }}" /></span></td>
                        <td><span class="cellcontent">{{ ($case->case_types) ? $case->case_types->name  : 'لا يوجد' }}</span></td>
                        <td><span class="cellcontent">{{ $case->governorates ? $case->governorates->name : 'لا يوجد' }}</span></td>
                        <td><span class="cellcontent">{{ $case->cities ? $case->cities->name : 'لا يوجد' }}</span></td>
                        <td><span class="cellcontent">{{ Helper::countCases($case->case_type_id, $case->cities->id, $case->governorates->id) }}</span></td>
                    </tr>
                    @endforeach
                  @endif
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
        </li>
      </ul>
    </div>
  </div>
</div>

@endsection
@section('js')
<script LANGUAGE="JavaScript">
function checkAll(bx) {
var cbs = document.getElementsByClassName('checkboxes');
for(var i=0; i < cbs.length; i++) {
cbs[i].checked = bx.checked;
}
}
</script>
<script>
$('.cases-btn').click(function(){
    // alert('1');
     var filter='@if(\session('filter_cases_ids')){{json_encode(\session('filter_cases_ids'))}}@endif';
     var selectedIds = $("input:checkbox:checked").map(function(){
      return $(this).closest('tr').attr('data-case-id');
    }).get();
       console.log(selectedIds);
     $.ajax({
       type:'GET',
       url:'{{route('reports_cases_export')}}',
       data:{ids:selectedIds,filters:filter,type:0},
       success:function(response){
        alert(2);
        swal("تمت العملية بنجاح!", "تم استخراج الجدول علي هيئة ملف اكسيل", "success");
        // var a = document.createElement("a");
        // a.href = response.file; 
        // a.download = response.name+'.xlsx';
        // document.body.appendChild(a);
        // a.click();
        // a.remove();
        location.href = response;
      }
    });
   });

//lawyers

 $('.excel-btn-lawyers').click(function(){
  var is_report = 1;
     var filter='@if(\session('filter_lawyers_ids')){{json_encode(\session('filter_lawyers_ids'))}}@endif';
     var selectedIds = $("input:checkbox:checked").map(function(){
      return $(this).closest('tr').attr('data-lawyer-id');
    }).get();
     $.ajax({
       type:'GET',
       url:'{{route('lawyers_excel')}}',
       data:{ids:selectedIds,filters:filter,is_report:is_report},
       success:function(response){
        swal("تمت العملية بنجاح!", "تم استخراج الجدول علي هيئة ملف اكسيل", "success");
        location.href = response;
      }
    });
   });

 //companies

  $('.excel-btn-companies').click(function(){
        
     var is_report = 1;
     var filter='@if(\session('filter_companies_ids')){{json_encode(\session('filter_companies_ids'))}}@endif';
     var ids = $("input:checkbox:checked").map(function(){
      return $(this).closest('tr').attr('data-company-id');
    }).get();  
          $.ajax(
          {
            url: "{{ route('clients.exportXLS') }}",
            type: 'GET',
            data: {
                "ids": ids,
                "userType": 'Companies',
                "userRule": 9,
                "_method": 'GET',
                "filters":filter,
                "is_report":is_report,
            },
            success:function(response){
              swal("تمت العملية بنجاح!", "تم استخراج الجدول علي هيئة ملف اكسيل", "success");
              location.href = response;
            }
          });

        });

//dont forget installments
  //tasks urgent  \\ not the same emergencytasks_excel
   $('.excel-btn-urgents').click(function(){
     var is_report = 1;
     var filter='@if(\session('filter_urgents_ids')){{json_encode(\session('filter_urgents_ids'))}}@endif';
     var selectedIds = $("input:checkbox:checked").map(function(){
      return $(this).closest('tr').attr('data-urgent-id');
    }).get();
     console.log(selectedIds);
     $.ajax({
       type:'GET',
       url:'{{route('emergencytasks_excel')}}',
       data:{ids:selectedIds,filters:filter,is_report:is_report},
       success:function(response){

        swal("تمت العملية بنجاح!", "تم استخراج الجدول علي هيئة ملف اكسيل", "success");

        location.href = response;
      }
    });
   });

   // courts  

   $('.excel-btn-courts').click(function(){
        
     var is_report = 1;
     var filter='@if(\session('filter_courts_ids')){{json_encode(\session('filter_courts_ids'))}}@endif';
     var ids = $("input:checkbox:checked").map(function(){
      return $(this).closest('tr').attr('data-court-id');
    }).get();  
     console.log(ids);
          $.ajax(
          {
            url: "{{ route('courts_list_excel') }}",
            type: 'GET',
            data: {
                "ids": ids,
                "_method": 'GET',
                "filters":filter,
                "is_report":is_report,
            },
            success:function(response){
              swal("تمت العملية بنجاح!", "تم استخراج الجدول علي هيئة ملف اكسيل", "success");
              location.href = response;
            }
          });

        });

   // tasks 
   $('.excel-btn-tasks').click(function(){
    var is_report = 1;
     var filter='@if(\session('filter_tasks_ids')){{json_encode(\session('filter_tasks_ids'))}}@endif';
     var selectedIds = $("input:checkbox:checked").map(function(){
      return $(this).closest('tr').attr('data-task-id');
    }).get();
     $.ajax({
       type:'GET',
       url:'{{route('services_excel2')}}',
       data:{ids:selectedIds,filters:filter,is_report:is_report},
       success:function(response){
        swal("تمت العملية بنجاح!", "تم استخراج الجدول علي هيئة ملف اكسيل", "success");
        location.href = response;
      }
    });
   });

   //issues types (cases1)
    $('.excel-btn-casetype').click(function(){
      var is_report = 1;
       var filter='@if(\session('filter_cases1_ids')){{json_encode(\session('filter_cases1_ids'))}}@endif';
          var selectedIds = $("input:checkbox:checked").map(function(){
            return $(this).closest('tr').attr('data-issue-id');
          }).get();
           console.log(selectedIds);
          $.ajax({
           type:'GET',
           url:'{{url('issues_types_excel')}}',
           data:{ids:selectedIds,filters:filter,is_report:is_report},
           success:function(response){
                  swal("تمت العملية بنجاح!", "تم استخراج الجدول علي هيئة ملف اكسيل", "success");
     
                    location.href = response;

          }
            });
        });



</script>


@endsection