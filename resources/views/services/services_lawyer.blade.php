@extends('layout.app')
@section('content')
        
              <!-- =============== Custom Content ===============-->
              <div class="row">
                <div class="col-lg-12">
                  <div class="cover-inside-container margin--small-top-bottom bradius--small bshadow--1" style="background:  url( '../img/covers/dummy2.jpg ' ) no-repeat center center; background-size:cover;">
                    <div class="add-mode">Adding mode</div>
                    <div class="row">
                      <div class="col-xs-12">
                        <div class="text-xs-center">
                          <div class="text-wraper">
                            <h4 class="cover-inside-title color--gray_d">الخدمات <i class="fa fa-chevron-circle-right"></i>
                              <h4 class="cover-inside-title color--gray_d">الخدمات </h4>
                            </h4>
                          </div>
                        </div>
                      </div>
                      <div class="cover--actions">
                      </div>
                    </div>
                  </div>
                </div>
                          @foreach($months as $month)
                          {{Date::parse($month->start_datetime)->format('F')}}
                          {{-- {{$month->start_datetime}} --}}
                          {{$month->missions}}
                          @endforeach
                <div class="col-lg-12">
                @if(\session('success'))
                  <div class="alert alert-success">
                  {{\session('success')}}
                  </div>
                  @endif

                @if ($errors->has('lawyer'))
                <div class="alert alert-danger">
                {{ $errors->first('lawyer')}}
                </div>
                @endif
                  <div class="cardwrap bgcolor--white bradius--noborder   bshadow--1 padding--small margin--small-top-bottom">
                    <form id="horizontal-pill-steps" action="{{route('services_lawyer_assign',$service->id)}}" method="post" enctype="multipart/form-data" accept-charset="utf-8">
                      {{ csrf_field() }}
                      <h3>اختيار المحامي</h3>
                      <fieldset>
                        <div class="cardwrap bgcolor--gray_l bradius--noborder   bshadow--1 padding--small margin--small-top-bottom">
                          <div class="col-xs-12"><b class="col-sm-1"> الخدمه</b>
                            <div class="col-sm-11">{{$service->name}}</div>
                          </div>
                          <div class="clearfix"> </div>
                        </div>
                        <div class="full-table">
                          <div class="remodal-bg">
<div class="remodal" data-remodal-id="filterModal_sponsors" role="dialog" aria-labelledby="modal1Title" aria-describedby="modal1Desc">

              <button class="remodal-close" data-remodal-action="close" aria-label="Close"></button>
              <div>
                <h2 id="modal1Title">فلتر</h2>
                <div class="col-md-4 col-sm-6 col-xs-12">
                  <div class="master_field">
                    <label class="master_label" for="work_sector">التخصص</label>
                    <input name="work_sector" class="master_input" type="text" placeholder="التخصص .." id="work_sector">
                  </div>
                </div>
                <div class="col-md-4 col-sm-6 col-xs-12">
                  <div class="master_field">
                    <label class="master_label" for="lawyer_degree_in">درجة القيد بالنقابة</label>
                    <input name="syndicate_level" class="master_input" type="text" placeholder="درجة القيد بالنقابة .." id="lawyer_degree_in">
                  </div>
                </div>
                <div class="col-md-4 col-sm-6 col-xs-12">
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
                <div class="col-md-4 col-sm-6 col-xs-12">
                  <div class="master_field">
                    <label class="master_label mandatory" for="work_from">تاريخ الالتحاق من</label>
                    <div class="bootstrap-timepicker">
                      <input name="date_from" class="datepicker master_input" type="text" placeholder="تاريخ الالتحاق" id="work_from">
                    </div><span class="master_message color--fadegreen"></span>
                  </div>
                </div>
                <div class="col-md-4 col-sm-6 col-xs-12">
                  <div class="master_field">
                    <label class="master_label mandatory" for="work_to">تاريخ الالتحاق الى</label>
                    <div class="bootstrap-timepicker">
                      <input name="date_to" class="datepicker master_input" type="text" placeholder="تاريخ الالتحاق" id="work_to">
                    </div><span class="master_message color--fadegreen"></span>
                  </div>
                </div>
                <div class="col-md-4 col-sm-6 col-xs-12">
                  <div class="master_field">
                    <label class="master_label mandatory" for="work_type">نوع العمل</label>
                    <select name="types" class="master_input select2" id="work_type" data-placeholder="نوع العمل " style="width:100%;" ,>
                      <option value="0" selected="selected">الكل</option>
                      @foreach($types as $type)
                      <option value="{{$type->id}}">{{$type->name_ar}}</option>
                      @endforeach
                    </select><span class="master_message color--fadegreen"></span>
                  </div>
                </div>
              </div>
              <div class="clearfix"></div>
              <button class="remodal-cancel" data-remodal-action="cancel">الغاء</button>
              <button class="remodal-confirm"  type="submit">فلتر</button>
                          </div>
                          <div class="filter__btns"><a class="master-btn bgcolor--main color--white bradius--small" href="#filterModal_sponsors"><i class="fa fa-filter"></i>filters</a></div>
                          <table class="table-1">
                            <thead>
                              <tr class="bgcolor--gray_mm color--gray_d">
                                <th><span class="cellcontent"></span></th>
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
                              <tr>
                                <td><span class="cellcontent"><input type="radio" name="lawyer" {{$lawyer->id==$service->assigned_lawyer_id ?'checked':''}} value="{{$lawyer->id}}"></span></td>
                                <td><span class="cellcontent">{{$lawyer->code}}</span></td>
                                <td><span class="cellcontent full_name">{{$lawyer->full_name}}</span></td>
                                <td><span class="cellcontent">{{$lawyer->user_detail->national_id}}</span></td>
                                <td><span class="cellcontent">
                                  @foreach($nationalities as $nationality)
                  @if($lawyer->user_detail->nationality->id == $nationality->item_id)
                  {{$nationality->value}}
                  @endif
                  @endforeach
                                </span></td>
                                <td><span class="cellcontent">{{$lawyer->user_detail->work_sector}}</span></td>
                                <td><span class="cellcontent syndicate_level">{{$lawyer->user_detail->syndicate_level}}</span></td>
                                <td><span class="cellcontent">{{$lawyer->address}}</span></td>
                                <td><span class="cellcontent">{{$lawyer->mobile}}</span></td>
                                <td><span class="cellcontent">{{$lawyer->user_detail->join_date}}</span></td>
                                <td><span class="cellcontent">@if($lawyer->is_active==1)<i class = "fa color--fadegreen fa-check"></i>@else <i class = "fa color--fadebrown fa-times"> @endif</span></td>
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
                      </fieldset>
                      <h3>تعيين الخدمه حسب الجدول الأسبوعي للمحامي</h3>
                      <fieldset>
                        <div class="cardwrap bgcolor--gray_l bradius--noborder   bshadow--1 padding--small margin--small-top-bottom">
                          <div class="col-md-4"><b class="col-xs-4">اسم المحامي</b>
                            <div class="col-xs-8 full_name2"> لا يوجد </div>
                          </div>
                          <div class="col-md-4"><b class="col-xs-4">درجة التقاضي</b>
                            <div class="col-xs-8 syndicate_level2">لا يوجد</div>
                          </div>
                          <div class="col-md-4"><b class="col-xs-4"> الخدمه</b>
                            <div class="col-xs-8">{{$service->name}}</div>
                          </div>
                          <div class="clearfix"> </div><br>
                        </div>
                        <div class="col-md-12">
                          <div class="master_field">
                            <label class="master_label">تاريخ بداية و نهاية المهمة</label>
                            <input name="start_end" class="date_range_picker master_input" type="text" placeholder="placeholder">
                          </div>
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
                                <div class="col-md-12 right-text"><span class="bgcolor--main_l color--white bradius--small importance padding--small">جلسة محكمة</span> &nbsp;<a href="case_view.html">اسم القضية </a>
                                  <div class="pull-right">
                                    <label class="data-label-round bgcolor--fadegreen color--white">4-2-2018</label>
                                  </div>
                                </div>
                                <div class="clearfix"></div>
                                <hr>
                                <div class="col-md-12 right-text"><span class="bgcolor--main_l color--white bradius--small importance padding--small">خدمة</span> &nbsp;<a href="service_view.html">اسم الخدمة</a>
                                  <div class="pull-right">
                                    <label class="data-label-round bgcolor--fadegreen color--white">6-2-2018</label>
                                  </div>
                                </div>
                                <div class="clearfix"></div>
                                <hr>
                                <div class="col-md-12 right-text"><span class="bgcolor--main_l color--white bradius--small importance padding--small">استشارة قانونية</span>  &nbsp;<a href="legal_consultation_view.html">عنوان الإستشارة</a>
                                  <div class="pull-right">
                                    <label class="data-label-round bgcolor--fadegreen color--white">4-2-2018</label>
                                  </div>
                                </div>
                                <div class="clearfix"></div>
                              </div>
                            </div>
                          </div>
{{--                           <div class="col-lg-12">
                            <div class="panel panel-default">
                              <div class="panel-heading" id="heading-2" role="tab">
                                <h4 class="panel-title bgcolor--main_l bradius--noborder bshadow--2 padding--small margin--small-top-bottom"><a class="trigger color--white" role="button" data-toggle="collapse" href="#collapse-2" aria-expanded="true" aria-controls="collapse-2">
                                    <div class="col-xs-11">الاسبوع من الأحد 11-2-2018 الى الخميس 15-2-2018<span class="pull-right color--fadeorange">3 مهمات</span></div>
                                    <div class="clearfix"></div></a></h4>
                              </div>
                            </div>
                            <div class="panel-collapse collapse" id="collapse-2" role="tabpanel" aria-labelledby="heading-2" aria-expanded="true">
                              <div class="panel-body bgcolor--white bradius--noborder bshadow--2 padding--small margin--small-top-bottom">
                                <div class="col-md-12 right-text"><span class="bgcolor--main_l color--white bradius--small importance padding--small">جلسة محكمة</span> &nbsp;<a href="case_view.html">اسم القضية </a>
                                  <div class="pull-right">
                                    <label class="data-label-round bgcolor--fadegreen color--white">4-2-2018</label>
                                  </div>
                                </div>
                                <div class="clearfix"></div>
                                <hr>
                                <div class="col-md-12 right-text"><span class="bgcolor--main_l color--white bradius--small importance padding--small">خدمة</span> &nbsp;<a href="service_view.html">اسم الخدمة</a>
                                  <div class="pull-right">
                                    <label class="data-label-round bgcolor--fadegreen color--white">6-2-2018</label>
                                  </div>
                                </div>
                                <div class="clearfix"></div>
                                <hr>
                                <div class="col-md-12 right-text"><span class="bgcolor--main_l color--white bradius--small importance padding--small">استشارة قانونية</span>  &nbsp;<a href="legal_consultation_view.html">عنوان الإستشارة</a>
                                  <div class="pull-right">
                                    <label class="data-label-round bgcolor--fadegreen color--white">4-2-2018</label>
                                  </div>
                                </div>
                                <div class="clearfix"></div>
                              </div>
                            </div>
                          </div> --}}
                        </div>
                      </fieldset>
                    </form>
                  </div>
                </div>
              </div>
              <!-- =============== PAGE VENDOR Triggers =================-->
                  

@endsection

@section('js')
<script>
  $(document).ready(function(){

    $('input:radio[name="lawyer"]').change(
    function(){
    var full_name = $(this).closest('tr').find('.full_name').text();
    var syndicate_level = $(this).closest('tr').find('.syndicate_level').text();
    $('.full_name2').text(full_name);
    $('.syndicate_level2').text(syndicate_level);
    });
    $('input:radio[name="lawyer"]:checked').trigger('change');



  });
</script>

    <script type="text/javascript">
      var form = $("#horizontal-pill-steps").show();
      form.steps({
        headerTag: "h3",
        bodyTag: "fieldset",
        transitionEffect: "slideLeft",
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
        });
        
      var form = $("#horizontal-tabs-steps").show();
      form.children("div").steps({
        headerTag: "h3",
        bodyTag: "fieldset",
        transitionEffect: "slideLeft",
        // enableFinishButton: false,
        enablePagination: false,
        enableAllSteps: true,
        titleTemplate: "#title#",
        cssClass: "tabcontrol",
 
  onStepChanging: function (event, currentIndex, newIndex)
            {
if (currentIndex === 5) { //if last step
   //remove default #finish button
   $('#wizard').find('a[href="#finish"]').remove(); 
   //append a submit type button
   $('#wizard .actions li:last-child').append('<button type="submit" id="submit" class="btn-large"><span class="fa fa-chevron-right"></span></button>');
}
                
            },
        onFinishing: function (event, currentIndex)
        {
           alert("Submitted!");
            // var form = $(this);

            //  form.submit();
        },
        onFinished: function (event, currentIndex) {
            // bodyTag: "fieldset"
            alert("Finish button was clicked");
            }
        });

      
    </script>




@endsection