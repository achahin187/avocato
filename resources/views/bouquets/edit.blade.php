@extends('layout.app')
@section('content')
<!-- =============== Custom Content ===============-->
<div class="row">
                <div class="col-lg-12">
                  <div class="cover-inside-container margin--small-top-bottom bradius--small bshadow--1" style="background:  url( '../img/covers/dummy2.jpg ' ) no-repeat center center; background-size:cover">
                    <div class="add-mode">Editing mode</div>
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
                      <div class="cover--actions"><span></span>
                      </div>
                    </div>
                  </div>
                </div>
                <form method="post" action="{{route('bouquets.update',$bouquet->id)}}">
                {{csrf_field()}}
                <div class="col-lg-12">
                  <div class="cardwrap bgcolor--white bradius--noborder   bshadow--1 padding--small margin--small-top-bottom">
                    <div class="col-md-7 col-xs-12 no-padding">
                      <!-- <div class="col-md-3 col-sm-3 col-xs-4">
                        <div class="master_field">
                          <label class="master_label mandatory" for="lang_list">اختار اللغة</label>
                          <select class="master_input" id="lang_list" name="name_language">
                            <option value="2">العربية</option>
                            <option value="1">English</option>
                            <option value="3">French</option>
                          </select>
                        </div>
                      </div> -->
                      <div class="col-md-9 col-sm-9 col-xs-8">
                        <div class="master_field">
                          <label class="master_label" for="package_name">اسم الباقة</label>
                          <input class="master_input" type="text" placeholder="اسم الباقة" id="package_name" name="name" value="{{$bouquet['name']}}">
                          <span class="master_message color--fadegreen">message</span>
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
                          @foreach($services as $service)
                          <?php $se=0; ?>
                          @foreach($bouquet['services'] as $value)
                          @if($value['pivot']['bouquet_service_id'] == $service['id'])
                          <?php $se=1; ?>
                            <tr>
                              <td>
                                <div class="funkyradio">
                                <input type="number"  hidden name="service[{{$service['id']}}][id]" value="{{$service['id']}}">
                                  <input type="checkbox"  id="p1_feature_{{$service['id']}}"  name="service[{{$service['id']}}][active]" @if($value['pivot']['service_active']) checked="true" @endif>
                                  <label for="p1_feature_{{$service['id']}}">تفعيل</label>
                                </div>
                              </td>
                              <td>
                                <input class="master_input" type="number" id="feature_count{{$service['id']}}" placeholder="عدد" mandatory name="service[{{$service['id']}}][count]"  value="{{$value['pivot']['service_count']}}" >
                              </td>
                              <td><b>{{$service['service_name']}}</b></td>
                            </tr>
                            @endif
                            @endforeach
                            @if($se == 0)
                            <tr>
                              <td>
                                <div class="funkyradio">
                                <input type="number"  hidden name="service[{{$service['id']}}][id]" value="{{$service['id']}}">
                                  <input type="checkbox"  id="p1_feature_{{$service['id']}}"  name="service[{{$service['id']}}][active]" >
                                  <label for="p1_feature_{{$service['id']}}">تفعيل</label>
                                </div>
                              </td>
                              <td>
                                <input class="master_input" type="number" id="feature_count{{$service['id']}}" placeholder="عدد" mandatory name="service[{{$service['id']}}][count]"   >
                              </td>
                              <td><b>{{$service['service_name']}}</b></td>
                            </tr>
                            @endif
                          @endforeach
                            <!-- <tr>
                              <td>
                                <div class="funkyradio">
                                  <input type="checkbox" name="radio" id="p1_feature_2" checked="true" name="service_count[5]">
                                  <label for="p1_feature_2">تفعيل</label>
                                </div>
                              </td>
                              <td>
                                <input class="master_input" type="number" id="feature_count2" placeholder="عدد" mandatory name="service_active[5]">
                              </td>
                              <td><b>حالات طارئة</b></td>
                            </tr>
                            <tr>
                              <td>
                                <div class="funkyradio">
                                  <input type="checkbox" name="radio" id="p1_feature_3" checked="true"name="service_count[3]">
                                  <label for="p1_feature_3">تفعيل</label>
                                </div>
                              </td>
                              <td>
                                <input class="master_input" type="number" id="feature_count3" placeholder="عدد" mandatory name="service_active[3]">
                              </td>
                              <td><b>العقود والصيع</b></td>
                            </tr>
                            <tr>
                              <td>
                                <div class="funkyradio">
                                  <input type="checkbox" name="radio" id="p1_feature_4" checked="true" name="service_count[4]">
                                  <label for="p1_feature_4">تفعيل</label>
                                </div>
                              </td>
                              <td>
                                <input class="master_input" type="number" id="feature_count4" placeholder="عدد" mandatory name="service_active[4]">
                              </td>
                              <td><b>الخدمات </b></td>
                            </tr> -->
                          </tbody>
                        </table>
                      </div>
                    </div>
                    <div class="col-md-5 col-xs-12 no-padding">
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <div class="master_field">
                          <label class="master_label mandatory" for="payment">دفع القسط</label>
                          <select class="master_input select2" id="payment" multiple="multiple" data-placeholder="" style="width:100%" name="payment_method[]">
                            @foreach($payment_methods as $method)
                            <?php $i=0; ?>
                            @foreach($bouquet['payment'] as $payment)
                            @if($payment['id'] == $method['id'])
                            <?php $i=1; ?>
                            <option value="{{$method['id']}}" selected>{{$method['name']}}</option>
                            @endif
                            @endforeach
                            @if($i==0)
                            <option value="{{$method['id']}}" >{{$method['name']}}</option>
                            @endif
                            @endforeach
                          </select><span class="master_message color--fadegreen">message content</span>
                        </div>
                      </div>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <label class="master_label mandatory">نوع العميل</label>
                        <input class="icon" type="radio" name="bouquet_type"  id="client_2" value="1" name="bouquet_type" @if($bouquet['bouquet_type'] == 1) checked="true" @endif>
                        <label for="client_2">شركة</label>
                        <input class="icon" type="radio" name="bouquet_type" value="0" id="client_1"  name="bouquet_type" @if($bouquet['bouquet_type'] == 0) checked="true" @endif>
                        <label for="client_1">عميل فرد</label>
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
                        <input class="master_input" type="number" id="cost" placeholder="سعر الباقة" mandatory name="price" @if($bouquet['bouquet_type'] == 0) value="{{$bouquet['price']}}" @endif>
                      </div>
                      <div class="col-md-12 col-sm-12 col-xs-12" id="cost_company" @if($bouquet['bouquet_type'] == 0) style="display:none;" @endif>
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
                              <td> عدد الأفراد الى</td>
                              <td> عدد الأفراد من</td>
                            </tr>
                            @if($bouquet['bouquet_type'] == 1)

                            @for( $i=0 ; $i<$bouquet->price_relation()->count() ; $i++)
                            <tr>
                              <td></td>
                              <td>
                                <input class="master_input" type="number" id="cost1" placeholder="سعر الباقة" mandatory name="bouquet[{{$i}}][price]" value="{{$bouquet['price_relation'][$i]['price']}}">
                              </td>
                              <td>
                                <input class="master_input" type="number" id="cost1_to" placeholder="عدد الأفراد الى" mandatory name="bouquet[{{$i}}][count_to]" value="{{$bouquet['price_relation'][$i]['count_to']}}">
                              </td>
                              <td>
                                <input class="master_input" type="number" id="cost1_from" placeholder="عدد الأفراد من" mandatory name="bouquet[{{$i}}][count_from]" value="{{$bouquet['price_relation'][$i]['count_from']}}">
                              </td>
                            </tr>
                            @endfor
                            @endif
                          </tbody>
                        </table>
                        <div class="col-md-12 text-right no-padding">
                          <a class="input-btn" id="add_cost"><b>إضافة نطاق</b><i class="fa fa-plus-circle"></i></a>
                        </div>
                      </div>
                    </div>
                    <div class="clearfix"></div>
                    <!-- <div class="col-md-2 col-sm-3 col-xs-3">
                      <div class="master_field">
                        <label class="master_label mandatory" for="lang_list">اختار اللغة</label>
                        <select class="master_input" id="lang_list" name="description_language">
                          <option value="2">العربية</option>
                          <option value="1">English</option>
                          <option value="3">French</option>
                        </select>
                      </div>
                    </div> -->
                    <div class="col-md-10 col-sm-9 col-xs-9">
                      <div class="master_field">
                        <label class="master_label mandatory" for="package_deac">وصف الباقة</label>
                        <textarea class="master_input" name="description" id="package_deac" placeholder="وصف الباقة">{{$bouquet['description']}}</textarea>
                        <span class="master_message color--fadegreen">message</span>
                      </div>
                    </div>
                    <div class="clearfix"></div><br>
                    <div class="col-md-2 col-xs-6">
                      <button class="master-btn undefined btn-block color--white bgcolor--fadepurple bradius--small bshadow--0" type="submit"><i class="fa fa-save"></i><span>حفظ</span>
                      </button>
                    </div>
                    <div class="col-md-2 col-xs-6">
                      <a class="master-btn undefined btn-block color--white bgcolor--fadebrown bradius--small bshadow--0" href="{{route('bouquets')}}"><i class="fa fa-times"></i><span>الغاء</span>
                      </a>
                    </div>
                    <div class="clearfix"></div>
                  </div>
                </div>
                </form>
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
              if (demovalue == '0') {
                $("#cost_individual").show();
                $("#cost_company").hide();
              }
      
              else if (demovalue == '1') {
                $("#cost_individual").hide();
                $("#cost_company").show();
              }
          });
      });
      
    </script>
    <script type="text/javascript">
    
    if( {{$bouquet['bouquet_type']}} == 0)
    {
      var i=0;
    }
    else if( {{$bouquet['bouquet_type']}} == 1)
    {
      var i={{$bouquet['price_relation']->count()}};
    }

      $("#add_cost").click(function(){
        i+=1;
        $("#more_cost").append(`
          <tr>
            <td>
              <button class="del-btn" id="del_cost" onclick="getElementById('cost`+i+`').parentElement.parentElement.remove()">
                <i class="fa fa-times-circle"></i>
              </button>
            </td>
            <td>
              <input class="master_input" type="number" id="cost`+i+`" placeholder="سعر الباقة" mandatory="yes" name="bouquet[`+i+`][price]">
            </td>
            <td>
              <input class="master_input" type="number" id="cost`+i+`_to" placeholder="عدد الأفراد الى" mandatory="yes" name="bouquet[`+i+`][count_to]">
            </td>
            <td>
              <input class="master_input" type="number" id="cost`+i+`_from" placeholder="عدد الأفراد من" mandatory="yes" name="bouquet[`+i+`][count_from]">
            </td>
          </tr>
        `);
      });
      
    </script>
@endsection