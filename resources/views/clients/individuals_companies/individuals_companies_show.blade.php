@extends('layout.app')
@section('content')


<div class="row">
  <div class="col-lg-12">
    <div class="coverglobal text-center bshadow--2" style="background:#000 url( '{{asset('img/covers/dummy2.jpg')}}') no-repeat center center; background-size:cover;"><span></span>
      <div class="container">
        <div class="row">
          <div class="col-xs-12">
            <div class="text-xs-center"><a href=""><img class="coverglobal__avatar" src="{{asset(''.$user->image)}}">
              <h3 class="coverglobal__title color--gray_d">{{$user->full_name}}</h3><small class="coverglobal__slogan color--gray_d">{{$user->is_active ? 'مفعل':'غير مفعل'}}</small></a></div>
              <div class="coverglobal__actions"><a class="color--gray_d bordercolor-gray_d bradius--small border-btn master-btn" type="button" href="{{route('ind.com.edit',$user->id)}}">تعديل بيانات العميل</a>
                <a class="color--gray_d bordercolor-gray_d bradius--small border-btn master-btn" type="button" href="{{ route('ind.edit', $user->id) }}">التحويل لعميل أفراد</a>
                <a class="color--gray_d bordercolor-gray_d bradius--small border-btn master-btn" type="button" href="">كارت العميل</a>
                <a class="color--gray_d bordercolor-gray_d bradius--small border-btn master-btn" type="button" href="">استبعاد العميل</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-12">
      <div class="cardwrap bgcolor--white bradius--noborder   bshadow--1 padding--small margin--small-top-bottom">
        <div class="col-md-6 col-sm-6 col-xs-6">
          <div class="row"><b class="col-xs-4">اسم الشركة </b>
            <div class="col-xs-8">{{$user->companyParent->full_name}}</div>
          </div>
          <div class="row"><b class="col-xs-4">كود الشركة </b>
            <div class="col-xs-8">{{$user->companyParent->code}}</div>
          </div>
          <div class="row"><b class="col-xs-4">الهاتف </b>
            <div class="col-xs-8">{{$user->phone}}</div>
          </div>
          <div class="row"><b class="col-xs-4">جوال </b>
            <div class="col-xs-8">{{$user->mobile}}</div>
          </div>
        </div>
        <div class="col-md-6 col-sm-6 col-xs-6">
          <div class="row"><b class="col-xs-4">كود العميل</b>
            <div class="col-xs-8">{{$user->code}}</div>
          </div>
          <div class="row"><b class="col-xs-4">الرقم القومى </b>
            <div class="col-xs-8">{{$user->user_detail->national_id}}</div>
          </div>
          <div class="row"><b class="col-xs-4">عنوان العميل</b>
            <div class="col-xs-8">{{$user->address}}</div>
          </div>
          <div class="row"><b class="col-xs-4">البريد الالكترونى </b>
            <div class="col-xs-8"><span>{{$user->email}}</span></div>
          </div>
          <div class="row"><b class="col-xs-4">تاريخ الميلاد </b>
            <div class="col-xs-8">{{$user->birthdate}}</div>
          </div>
        </div>
        <div class="clearfix"></div>
      </div>
    </div>
    <div class="col-lg-12">
      <div class="tabs--wrapper">
        <div class="clearfix"></div>
        <ul class="tabs">
          <li>معلومات التعاقد</li>
          <li>القضايا</li>
          <li>الخدمات </li>
          <li>الطلبات الطارئة</li>
          <li>فهرس التوكيلات</li>
        </ul>
        <ul class="tab__content">
          <li class="tab__content_item active">
            <div class="cardwrap bgcolor--white bradius--noborder   bshadow--1 padding--small margin--small-top-bottom">
              <div class="row">
                <div class="col-xs-6"><b class="col-xs-3">تاريخ بدء التعاقد</b>
                  <div class="col-xs-9">@isset($user->subscription->start_date)
                    {{$user->subscription->start_date->format("Y - m - d")}} @endisset</div>
                  </div>
                  <div class="col-xs-6"><b class="col-xs-3">مدة التعاقد </b>
                    <div class="col-xs-9">{{$user->subscription->duration}}</div>
                  </div>
                  <div class="col-xs-6"><b class="col-xs-3">قيمة التعاقد </b>
                    <div class="col-xs-9">{{$user->subscription->value}}</div>
                  </div>
                  <div class="col-xs-6"><b class="col-xs-3">تاريخ نهاية التعاقد</b>
                    <div class="col-xs-9">@isset($user->subscription->end_date){{$user->subscription->end_date->format("Y - m - d ")}}@endisset</div>
                  </div>
                  <div class="col-xs-6"><b class="col-xs-3">نوع الباقة </b>
                    <div class="col-xs-9"> <span class="bgcolor--main_l color--white bradius--small importance padding--small">@foreach($packages as $package)
                      @if($package->item_id == $user->subscription->package_type_id)
                      {{$package->value}}
                      @endif
                    @endforeach</span></div>
                  </div>
                  <div class="col-xs-6"><b class="col-xs-3">عدد الاقساط</b>
                    <div class="col-xs-9">{{$user->subscription->number_of_installments}}</div>
                  </div>
                </div>
                <div class="col-lg-12">
                  <table class="table-1" >
                    <thead>
                      <tr class="bgcolor--gray_mm color--gray_d">
                        <th><span class="cellcontent">ترتيب القسط</span></th>
                        <th><span class="cellcontent"> قيمة القسط</span></th>
                        <th><span class="cellcontent">تاريخ السداد</span></th>
                        <th><span class="cellcontent">حالة السداد</span></th>
                        <th><span class="cellcontent">تعديل حالة السداد</span></th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($user->subscription->installments as $installment)
                      <tr>
                        <td><span class="cellcontent">ا{{$installment->installment_number}}</span></td>
                        <td><span class="cellcontent">{{$installment->value}}</span></td>
                        <td><span class="cellcontent">{{$installment->payment_date}}</span></td>
                        <td><span class="cellcontent"><i class = "fa {{$installment->is_paid ? 'color--fadegreen fa-check': 'color--fadebrown fa-times'}}"></i></span></td>
                        <td><span class="cellcontent"><a href= "#payment_status{{$installment->id}}" ,  class= "action-btn bgcolor--fadegreen color--white "> <i class = "fa  fa-edit"></i></a></span></td>
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

                @foreach($user->subscription->installments as $installment)
                <div class="col-md-2"><a class="master-btn undefined undefined undefined undefined undefined" href="#payment_status"><span></span></a>
                  <div class="remodal-bg"></div>
                  <div class="remodal" data-remodal-id="payment_status{{$installment->id}}" role="dialog" aria-labelledby="modal1Title" aria-describedby="modal1Desc">
                    <form role="form" action="{{route('ind_comp_update',$installment->id)}}" method="post" accept-charset="utf-8">
                      {{csrf_field()}}
                      <button class="remodal-close" data-remodal-action="close" aria-label="Close"></button>
                      <div>
                        <div class="row">
                          <div class="col-xs-12">
                            <h3>تغيير حالة القسط</h3>
                            <div class="master_field"> 

                                @if($installment->is_paid==1)       
                                  <input class="icon" type="radio" name="installment" id="done{{$installment->id}}" value="1" checked="true">
                                  <label for="done{{$installment->id}}">تم الدفع</label>

                                  <input class="icon" type="radio" name="installment" id="not_done{{$installment->id}}" value="0" >
                                  <label for="not_done{{$installment->id}}">لم يتم الدفع</label>

                                   
                                  @else
                                   <input class="icon" type="radio" name="installment" id="done{{$installment->id}}" value="1" >
                                  <label for="done{{$installment->id}}">تم الدفع</label>

                                  <input class="icon" type="radio" name="installment" id="not_done{{$installment->id}}" value="0" checked="true">
                                  <label for="not_done{{$installment->id}}">لم يتم الدفع</label>

                                  @endif

                            </div>
                          </div>
                        </div>
                      </div><br>
                      <button class="remodal-cancel" data-remodal-action="cancel">إلغاء</button>
                      <button class="remodal-confirm" type="submit">تغيير حالة القسط</button>
                    </form>
                  </div>
                </div>
                @endforeach
                <div class="clearfix"> </div>
              </div>
            </li>
            <li class="tab__content_item">
              <div class="cardwrap bgcolor--white bradius--noborder   bshadow--1 padding--small margin--small-top-bottom">
                <table class="table-1">
                  <thead>
                    <tr class="bgcolor--gray_mm color--gray_d">
                      <th><span class="cellcontent">نوع القضية</span></th>
                      <th><span class="cellcontent">المحكمة</span></th>
                      <th><span class="cellcontent">الدائرة</span></th>
                      <th><span class="cellcontent">رقم الدعوى</span></th>
                      <th><span class="cellcontent">لسنة</span></th>
                      <th><span class="cellcontent">تاريخ قيد الدعوى</span></th>
                      <th><span class="cellcontent">رقم الملف بالمكتب</span></th>
                      <th><span class="cellcontent">رقم التوكيل</span></th>
                    </tr>
                  </thead>
                  <tbody>
                    @if (isset($cases) && !empty($cases))
                        @foreach ($cases as $case)
                        <tr>
                          <td><span class="cellcontent">{{ ($case->cases->case_types) ? $case->cases->case_types->name : 'لا يوجد' }}</span></td>
                          <td><span class="cellcontent">{{ ($case->cases->courts) ? $case->cases->courts->name : 'لا يوجد' }}</span></td>
                          <td><span class="cellcontent">{{ ($case->cases->region) ? $case->cases->region : 'لا يوجد' }}</span></td>
                          <td><span class="cellcontent">{{ ($case->cases->claim_number) ? $case->cases->claim_number : 'لا يوجد' }}</span></td>
                          <td><span class="cellcontent">{{ ($case->cases->claim_year) ? $case->cases->claim_year : 'لا يوجد' }}</span></td>
                          <td><span class="cellcontent">{{ ($case->cases->claim_date) ? $case->cases->claim_date->format('d/m/Y') : 'لا يوجد' }}</span></td>
                          <td><span class="cellcontent">{{ ($case->cases->office_file_number) ? $case->cases->office_file_number : 'لا يوجد' }}</span></td>
                          <td><span class="cellcontent">{{ ($case->attorney_number) ? $case->attorney_number : 'لا يوجد' }}</span></td>
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
            </li>
            <li class="tab__content_item">
              <div class="cardwrap bgcolor--white bradius--noborder   bshadow--1 padding--small margin--small-top-bottom">
                <table class="table-1">
                  <thead>
                    <tr class="bgcolor--gray_mm color--gray_d">
                      <th><span class="cellcontent">نوع الخدمة</span></th>
                      <th><span class="cellcontent">القائم بالاجراء</span></th>
                    </tr>
                  </thead>
                  <tbody>
                    @if (isset($services) && !empty($services))
                        @foreach ($services as $service)
                        <tr>
                          <td><span class="cellcontent">{{ ($service->task_payment_status_id) ? Helper::localizations('task_payment_statuses', 'name', $service->task_payment_status_id) : 'لا يوجد' }}</span></td>
                          <td><span class="cellcontent">{{ ($service->assigned_lawyer_id) ? Helper::getUserDetails($service->assigned_lawyer_id)->full_name : 'لا يوجد' }}</span></td>
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
            </li>
            <li class="tab__content_item">
              <div class="cardwrap bgcolor--white bradius--noborder   bshadow--1 padding--small margin--small-top-bottom">
                <table class="table-1">
                  <thead>
                    <tr class="bgcolor--gray_mm color--gray_d">
                      <th><span class="cellcontent">عنوان الطلب</span></th>
                      <th><span class="cellcontent">تفاصيل الطلب</span></th>
                      <th><span class="cellcontent">الحالة</span></th>
                      <th><span class="cellcontent"> التاريخ</span></th>
                      <th><span class="cellcontent">الوقت</span></th>
                    </tr>
                  </thead>
                  <tbody>
                    @if (isset($urgents) && !empty($urgents))
                        @foreach ($urgents as $urgent)
                        <tr>
                          <td><span class="cellcontent">{{ ($urgent->task_address) ? $urgent->task_address : 'لا يوجد' }}</span></td>
                          <td><span class="cellcontent">{{ ($urgent->description)  ? $urgent->description  : 'لا يوجد' }}</span></td>
                          <td><span class="cellcontent"><i class = "fa {{ ($urgent->task_status_id == 2) ? 'color--fadegreen fa-check' : 'fa-times' }}"></i></span></td>
                          <td><span class="cellcontent">{{ ($urgent->start_datetime) ? $urgent->start_datetime->format('d-m-Y') : 'لا يوجد' }}</span></td>
                          <td><span class="cellcontent">{{ ($urgent->start_datetime) ? $urgent->start_datetime->format('h:m')   : 'لا يوجد' }}</span></td>
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
            </li>
            <li class="tab__content_item">
              <div class="cardwrap bgcolor--white bradius--noborder   bshadow--1 padding--small margin--small-top-bottom">
                <table class="table-1">
                  <thead>
                    <tr class="bgcolor--gray_mm color--gray_d">
                      <th><span class="cellcontent">م</span></th>
                      <th><span class="cellcontent">رقم التوكيل</span></th>
                      <th><span class="cellcontent">مكتب التوثيق</span></th>
                      <th><span class="cellcontent">نوعه</span></th>
                      <th><span class="cellcontent"> التاريخ</span></th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td><span class="cellcontent"> 1001</span></td>
                      <td><span class="cellcontent">6589 لسنة2018</span></td>
                      <td><span class="cellcontent">مكتب الشهرالعقاري</span></td>
                      <td><span class="cellcontent">توكيل عام بالبيع و الشراء</span></td>
                      <td><span class="cellcontent">10-9-2019</span></td>
                    </tr>
                    <tr>
                      <td><span class="cellcontent"> 1001</span></td>
                      <td><span class="cellcontent">6589 لسنة2018</span></td>
                      <td><span class="cellcontent">مكتب الشهرالعقاري</span></td>
                      <td><span class="cellcontent">توكيل عام بالبيع و الشراء</span></td>
                      <td><span class="cellcontent">10-9-2019</span></td>
                    </tr>
                    <tr>
                      <td><span class="cellcontent"> 1001</span></td>
                      <td><span class="cellcontent">6589 لسنة2018</span></td>
                      <td><span class="cellcontent">مكتب الشهرالعقاري</span></td>
                      <td><span class="cellcontent">توكيل عام بالبيع و الشراء</span></td>
                      <td><span class="cellcontent">10-9-2019</span></td>
                    </tr>
                    <tr>
                      <td><span class="cellcontent"> 1001</span></td>
                      <td><span class="cellcontent">6589 لسنة2018</span></td>
                      <td><span class="cellcontent">مكتب الشهرالعقاري</span></td>
                      <td><span class="cellcontent">توكيل عام بالبيع و الشراء</span></td>
                      <td><span class="cellcontent">10-9-2019</span></td>
                    </tr>
                    <tr>
                      <td><span class="cellcontent"> 1001</span></td>
                      <td><span class="cellcontent">6589 لسنة2018</span></td>
                      <td><span class="cellcontent">مكتب الشهرالعقاري</span></td>
                      <td><span class="cellcontent">توكيل عام بالبيع و الشراء</span></td>
                      <td><span class="cellcontent">10-9-2019</span></td>
                    </tr>
                    <tr>
                      <td><span class="cellcontent"> 1001</span></td>
                      <td><span class="cellcontent">6589 لسنة2018</span></td>
                      <td><span class="cellcontent">مكتب الشهرالعقاري</span></td>
                      <td><span class="cellcontent">توكيل عام بالبيع و الشراء</span></td>
                      <td><span class="cellcontent">10-9-2019</span></td>
                    </tr>
                    <tr>
                      <td><span class="cellcontent"> 1001</span></td>
                      <td><span class="cellcontent">6589 لسنة2018</span></td>
                      <td><span class="cellcontent">مكتب الشهرالعقاري</span></td>
                      <td><span class="cellcontent">توكيل عام بالبيع و الشراء</span></td>
                      <td><span class="cellcontent">10-9-2019</span></td>
                    </tr>
                    <tr>
                      <td><span class="cellcontent"> 1001</span></td>
                      <td><span class="cellcontent">6589 لسنة2018</span></td>
                      <td><span class="cellcontent">مكتب الشهرالعقاري</span></td>
                      <td><span class="cellcontent">توكيل عام بالبيع و الشراء</span></td>
                      <td><span class="cellcontent">10-9-2019</span></td>
                    </tr>
                    <tr>
                      <td><span class="cellcontent"> 1001</span></td>
                      <td><span class="cellcontent">6589 لسنة2018</span></td>
                      <td><span class="cellcontent">مكتب الشهرالعقاري</span></td>
                      <td><span class="cellcontent">توكيل عام بالبيع و الشراء</span></td>
                      <td><span class="cellcontent">10-9-2019</span></td>
                    </tr>
                    <tr>
                      <td><span class="cellcontent"> 1001</span></td>
                      <td><span class="cellcontent">6589 لسنة2018</span></td>
                      <td><span class="cellcontent">مكتب الشهرالعقاري</span></td>
                      <td><span class="cellcontent">توكيل عام بالبيع و الشراء</span></td>
                      <td><span class="cellcontent">10-9-2019</span></td>
                    </tr>
                    <tr>
                      <td><span class="cellcontent"> 1001</span></td>
                      <td><span class="cellcontent">6589 لسنة2018</span></td>
                      <td><span class="cellcontent">مكتب الشهرالعقاري</span></td>
                      <td><span class="cellcontent">توكيل عام بالبيع و الشراء</span></td>
                      <td><span class="cellcontent">10-9-2019</span></td>
                    </tr>
                    <tr>
                      <td><span class="cellcontent"> 1001</span></td>
                      <td><span class="cellcontent">6589 لسنة2018</span></td>
                      <td><span class="cellcontent">مكتب الشهرالعقاري</span></td>
                      <td><span class="cellcontent">توكيل عام بالبيع و الشراء</span></td>
                      <td><span class="cellcontent">10-9-2019</span></td>
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
                <div class="col-md-2 col-sm-6 col-xs-12"><a class="master-btn color--white bgcolor--main bradius--small bshadow--0 btn-block" href="#popupModal_2"><i class="fa fa-plus"></i><span>اضافة</span></a>
                  <div class="remodal-bg"></div>
                  <div class="remodal" data-remodal-id="popupModal_2" role="dialog" aria-labelledby="modal1Title" aria-describedby="modal2Desc">
                    <button class="remodal-close" data-remodal-action="close" aria-label="Close"></button>
                    <div>
                      <div class="row">
                        <div class="col-xs-12">
                          <h3>اضافة</h3>
                        </div>
                        <div class="col-xs-6">
                          <div class="master_field">
                            <label class="master_label mandatory" for="ID_No">رقم التوكيل</label>
                            <input class="master_input" type="number" placeholder="رقم التوكيل" id="ID_No">
                          </div>
                        </div>
                        <div class="col-xs-6">
                          <div class="master_field">
                            <label class="master_label mandatory" for="ID_No">مكتب التوثيق</label>
                            <input class="master_input" type="text" placeholder="مكتب التوثيق" id="ID_No">
                          </div>
                        </div>
                        <div class="col-xs-6">
                          <div class="master_field">
                            <label class="master_label mandatory" for="ID_No">نوعه</label>
                            <input class="master_input" type="text" placeholder="نوعه" id="ID_No">
                          </div>
                        </div>
                        <div class="col-xs-6">
                          <div class="master_field">
                            <label class="master_label mandatory" for="ID_No">التاريخ</label>
                            <input class="datepicker-popup master_input" type="text" placeholder="التاريخ" id="ID_No">
                          </div>
                        </div>
                        <div class="col-xs-12">
                          <div class="master_field">
                            <label class="master_label mandatory" for="ID_No-11">صورة التوكيل </label>
                            <div class="file-upload">
                              <div class="file-select">
                                <div class="file-select-name" id="noFile">صورة التوكيل </div>
                                <input class="chooseFile" type="file" name="chooseFile" id="ID_No-11">
                              </div>
                            </div><span class="master_message color--fadegreen">message</span>
                          </div>
                        </div>
                      </div>
                    </div><br>
                    <button class="remodal-cancel" data-remodal-action="cancel">الغاء</button>
                    <button class="remodal-confirm" data-remodal-action="confirm">اضافة</button>
                  </div>
                </div>
                <div class="clearfix"></div>
              </div>
            </li>
          </ul>
        </div>
      </div>
    </div>

    @endsection