@extends('layout.app')
@section('content')
  <!-- =============== Custom Content ===============-->
  <div class="row">
                <div class="col-lg-12">
                  <div class="cover-inside-container margin--small-top-bottom bradius--small bshadow--1" style="background:  url( '../img/covers/dummy2.jpg ' ) no-repeat center center; background-size:cover">
                    <div class="row">
                      <div class="col-xs-12">
                        <div class="text-xs-center">
                          <div class="text-wraper">
                            <h4 class="cover-inside-title color--gray_d">البيانات الأساسية <i class="fa fa-chevron-circle-right"></i>
                              <h4 class="cover-inside-title color--gray_d">تعريف الباقات </h4>
                            </h4>
                          </div>
                        </div>
                      </div>
                      <div class="cover--actions"><a class="color--gray_d bordercolor--white bradius--small border-btn master-btn" type="button" href="{{route('bouquets.edit',$bouquet->id)}}">تعديل</a><a class="color--gray_d bordercolor--white bradius--small border-btn master-btn" type="button" href="{{route('bouquets.delete',$bouquet->id)}}">حذف الباقة</a>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-lg-12">
                  <div class="cardwrap bgcolor--white bradius--noborder   bshadow--1 padding--small margin--small-top-bottom">
                    <div class="main-title-conts">
                      <div class="caption">
                        <h3>اسم الباقة</h3>
                      </div>
                      <div class="actions">
                      </div><span class="mainseparator bgcolor--main"></span>
                    </div>
                    <div class="col-md-7 col-xs-12 no-padding">
                      <div class="col-md-8 col-sm-7 col-xs-12">
                        <table class="table text-left bgcolor--gray_l">
                          <thead>
                            <tr>
                              <th>اسم الباقة</th>
                              <th> اللغه</th>
                            </tr>
                          </thead>
                          <tbody>
                          <tr>
                              <td>{{$bouquet->name}}</td>
                              <td>
                              @if(Session::get('AppLocale') == 1)
                            العربيه
                            @elseif (Session::get('AppLocale') == 2)
                            English
                            @else
                            Francia
                            @endif
                              </td>
                            </tr>
                            <!-- <tr>
                              <td>Package Name</td>
                              <td>English</td>
                            </tr>
                            <tr>
                              <td>Package Name</td>
                              <td>Francais</td>
                            </tr> -->
                          </tbody>
                        </table>
                      </div>
                      <div class="col-md-4 col-sm-5 col-xs-12">
                        <div class="stat-box margin--small-top-bottom bgcolor--white bshadow--1 bradius--small"><span class="stat-box-icon bgcolor--gray_d color--white"><i class="fa fa fa-users"></i></span>
                          <div class="stat-box-content color--gray_d"><span class="stat-box-text">عدد المشتركين</span><span class="stat-box-number">{{$bouquet->users()->count()}}</span></div>
                        </div>
                      </div>
                      <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="main-title-conts">
                          <div class="caption">
                            <h3>مواصفات الباقة</h3>
                          </div>
                          <div class="actions">
                          </div><span class="mainseparator bgcolor--main"></span>
                        </div>
                        <table class="table text-left bgcolor--gray_l">
                          <tbody>
                          @foreach($bouquet['services'] as $service)
                            <tr>
                              <td>
                              @if($service['pivot']['service_active'] == 1)
                                مفعل
                                &nbsp;<i class="fa fa-check color--fadegreen"></i>
                              @else
                              غير مفعل
                                &nbsp;<i class="fa fa-times color--fadebrown"></i>
                              @endif
                              </td>
                              <td>
                                <input class="master_input" type="number" id="feature_count1" placeholder="عدد" value="{{$service['pivot']['service_count']}}" readonly>
                              </td>
                              <td><b>{{$service['service_name']}}</b></td>
                            </tr>
                          @endforeach
                            <!-- <tr>
                              <td>
                                غير مفعل
                                &nbsp;<i class="fa fa-times color--fadebrown"></i>
                              </td>
                              <td>
                                <input class="master_input" type="number" id="feature_count2" placeholder="عدد" value="0" readonly>
                              </td>
                              <td><b>حالات طارئة</b></td>
                            </tr>
                            <tr>
                              <td>
                                مفعل
                                &nbsp;<i class="fa fa-check color--fadegreen"></i>
                              </td>
                              <td>
                                <input class="master_input" type="number" id="feature_count3" placeholder="عدد" value="50" readonly>
                              </td>
                              <td><b>العقود والصيع</b></td>
                            </tr>
                            <tr>
                              <td>
                                مفعل
                                &nbsp;<i class="fa fa-check color--fadegreen"></i>
                              </td>
                              <td>
                                <input class="master_input" type="number" id="feature_count4" placeholder="عدد" value="25" readonly>
                              </td>
                              <td><b>الفيتشر الرابعة</b></td>
                            </tr> -->
                          </tbody>
                        </table>
                      </div>
                    </div>
                    <div class="col-md-5 col-xs-12 no-padding">
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <label class="master_label">دفع القسط</label>
                        @foreach($bouquet['payment'] as $payment)
                        <span class="bgcolor--fadeblue color--white bradius--small importance padding--small"> {{$payment['name']}}</span>
                        &nbsp;
                        @endforeach
                      </div>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <label class="master_label mandatory">نوع العميل</label>
                        @if($bouquet['bouquet_type'] == 1)
                        <input class="icon" type="radio" name="client_type" value="company" id="client_2" checked>
                        <label for="client_2">شركة</label>
                        @else
                        <input class="icon" type="radio" name="client_type" value="individual" id="client_1" checked="true">
                        <label for="client_1">عميل فرد</label>
                        @endif
                      </div>
                      <div class="clearfix"></div>
                      <div class="col-md-12 col-sm-12 col-xs-12" id="cost_individual" @if($bouquet['bouquet_type'] == 1) style="display:none;" @endif>
                        <div class="main-title-conts">
                          <div class="caption">
                            <h3>سعر الباقة</h3>
                          </div>
                          <div class="actions">
                          </div><span class="mainseparator bgcolor--main"></span>
                        </div>
                        <input class="master_input" type="number" id="cost" placeholder="سعر الباقة" @if($bouquet['bouquet_type'] == 0) value="{{$bouquet['price']}}" @endif readonly>
                      </div>
                      <div class="col-md-12 col-sm-12 col-xs-12" id="cost_company"  @if($bouquet['bouquet_type'] == 0) style="display:none;" @endif>
                        <div class="main-title-conts">
                          <div class="caption">
                            <h3>سعر الباقة طبقا لعدد أفراد الشركة</h3>
                          </div>
                          <div class="actions">
                          </div><span class="mainseparator bgcolor--main"></span>
                        </div>
                        <table class="table text-left bgcolor--gray_l">
                          <tbody id="more_cost">
                            <tr>
                              <td></td>
                              <td> سعر الباقة</td>
                              <td> عدد الأفراد من</td>
                              <td> عدد الأفراد الى</td>
                            </tr>
                            @foreach($bouquet['price_relation'] as $price)
                            <tr>
                              <td></td>
                              <td>
                                <input class="master_input" type="number" id="cost1" placeholder="سعر الباقة" value="{{$price['price']}}" readonly>
                              </td>
                              <td>
                                <input class="master_input" type="number" id="cost1_from" placeholder="عدد الأفراد من" value="{{$price['count_from']}}" readonly>
                              </td>
                              <td>
                                <input class="master_input" type="number" id="cost1_to" placeholder="عدد الأفراد الى" value="{{$price['count_to']}}" readonly>
                              </td>
                            </tr>
                            @endforeach
                          </tbody>
                        </table>
                      </div>
                    </div>
                    <div class="col-xs-12">
                      <table class="table text-left bgcolor--gray_l">
                        <thead>
                          <tr>
                            <th>وصف الباقة</th>
                            <th>اللغه</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td>{{$bouquet['description']}}</td>
                            <th>
                            @if(Session::get('AppLocale') == 1)
                            العربيه
                            @elseif (Session::get('AppLocale') == 2)
                            English
                            @else
                            Francia
                            @endif
                            </th>
                          </tr>
                          <!-- <tr>
                            <td>Package Desc Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua</td>
                            <th>English</th>
                          </tr>
                          <tr>
                            <td>Package Desc Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incidid</td>
                            <th>Francais</th>
                          </tr> -->
                        </tbody>
                      </table>
                    </div>
                    <div class="clearfix"></div>
                  </div>
                </div>
              </div>
              <!-- =============== PAGE VENDOR Triggers ===============-->
@endsection
@section('js')
<script type="text/javascript">
      $('.tree ul').fadeIn();
        $(document).on('click', '.tree span', function(e) {
          $(this).next('ul').fadeToggle();
          e.stopPropagation();
        });
        $(document).on('change', '.tree input[type=checkbox]', function(e) {
          $(this).siblings('ul').find("input[type='checkbox']").prop('checked', this.checked);
          $(this).parentsUntil('.tree').children("input[type='checkbox']").prop('checked', this.checked);
          e.stopPropagation();
        });
    </script>
    <script type="text/javascript">
      $(document).ready(function(){
          $('input[type="radio"]').click(function(){
          	  var demovalue = $(this).val();
              if (demovalue == 'individual') {
                $("#cost_individual").show();
                $("#cost_company").hide();
              }
      
              else if (demovalue == 'company') {
                $("#cost_individual").hide();
                $("#cost_company").show();
              }
          });
      });
      
      
    </script>
@endsection