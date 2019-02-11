@extends('layout.app')
@section('content')

<div class="row">
  <div class="col-lg-12">
    <div class="coverglobal text-center bshadow--2" style="background:#000 url( '{{ asset('img/covers/dummy2.jpg') }}') no-repeat center center; background-size:cover;"><span></span>
      <div class="container">
        <div class="row">
            @if(\session('success'))
                  <div class="alert alert-success">
                  {{\session('success')}}
                  </div>
                  @endif
          <div class="col-xs-12">
            <div class="text-xs-center"><a href="#"><img class="coverglobal__avatar" src="{{  $user->image ? asset($user->image) : ''  }}">
                <h3 class="coverglobal__title color--gray_d">{{ $user->full_name }} </h3><small class="coverglobal__slogan color--gray_d">{{  $user->is_active ? 'مفعل':'غير مفعل'  }}</small></a></div>
            <div class="coverglobal__actions">
              <a class="color--gray_d bordercolor-gray_d bradius--small border-btn master-btn" type="button" href="{{  route('companies.edit',$user->id)  }}">تعديل بيانات العميل</a>
              <a class="color--gray_d bordercolor-gray_d bradius--small border-btn master-btn" type="button" href="{{  route('printUsers', $user->id)  }}">كارت العميل</a>
              <a class="color--gray_d bordercolor-gray_d bradius--small border-btn master-btn" type="button" href="#" id="deleteRecord">استبعاد العميل</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-lg-12">
    <div class="cardwrap bgcolor--white bradius--noborder   bshadow--1 padding--small margin--small-top-bottom">
      <div class="col-md-6 col-sm-6 col-xs-6">
        <div class="row"><b class="col-xs-4">العنوان </b>
          <div class="col-xs-8">{{  $user->address ? $user->address : 'لا يوجد عنوان'  }}</div>
        </div>
        <div class="row"><b class="col-xs-4">كود الشركة </b>
          <div class="col-xs-8">{{ $user->code ? $user->code : 'لا يوجد كود' }}</div>
        </div>
        <div class="row"><b class="col-xs-4">البريد الالكترونى </b>
          <div class="col-xs-8">{{ $user->email ? $user->email : 'لا يوجد بريد الكتروني' }}</div>
        </div>
        <div class="row"><b class="col-xs-4">رقم السجل التجارى </b>
          <div class="col-xs-8">{{ $user->user_company_detail ? $user->user_company_detail->commercial_registration_number : 'لا يوجد' }}</div>
        </div>
        <div class="row"><b class="col-xs-4">اسم الممثل القانونى </b>
          <div class="col-xs-8">{{ $user->user_company_detail ? $user->user_company_detail->legal_representative_name : 'لا يوجد' }}</div>
        </div>
      </div>
      <div class="col-md-6 col-sm-6 col-xs-6">
        <div class="row"><b class="col-xs-4">الهاتف </b>
          <div class="col-xs-8">{{ $user->phone ? $user->phone : 'لا يوجد' }}</div>
        </div>
        <div class="row"><b class="col-xs-4">جوال </b>
          <div class="col-xs-8">{{ $user->mobile ? $user->mobil : 'لا يوجد' }}</div>
        </div>
        <div class="row"><b class="col-xs-4">فاكس </b>
          <div class="col-xs-8">{{ $user->user_company_detail ? $user->user_company_detail->fax : 'لا يوجد'  }}</div>
        </div>
        <div class="row"><b class="col-xs-4">موقع الكترونى </b>
          <div class="col-xs-8">{{ $user->user_company_detail ? $user->user_company_detail->website : 'لا يوجد' }}</div>
        </div>
        <div class="row"><b class="col-xs-4">تليفون الممثل القانونى </b>
          <div class="col-xs-8">{{ $user->user_company_detail ? $user->user_company_detail->legal_representative_mobile : 'لا يوجد'  }}</div>
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
              <div class="col-xs-6"><b class="col-xs-3">تاريخ بدء التعاقد </b>
                <div class="col-xs-9">@isset($user->subscription->start_date)
                  {{ $user->subscription ? ( $user->subscription->start_date ? $user->subscription->start_date->format("Y - m - d") : 'لا يوجد' ) : 'لا يوجد' }} @endisset
                </div>
              </div>
              <div class="col-xs-6"><b class="col-xs-3">مدة التعاقد </b>
                <div class="col-xs-9">{{ $user->subscription ? $user->subscription->duration : 'لا يوجد' }}</div>
              </div>
              <div class="col-xs-6"><b class="col-xs-3">قيمة التعاقد </b>
                <div class="col-xs-9">{{ $user->subscription ? $user->subscription->value : 'لا يوجد' }}</div>
              </div>
              <div class="col-xs-6"><b class="col-xs-3">تاريخ نهاية التعاقد </b>
                <div class="col-xs-9">{{ $user->subscription ? ( $user->subscription ? $user->subscription->end_date->format("Y - m - d ") : 'لا يوجد' ) : 'لا يوجد' }}</div>
              </div>
                
              <div class="col-xs-6"><b class="col-xs-3">نوع الباقة  </b>
                <div class="col-xs-9">
                  <span class="bgcolor--fadeorange color--white bradius--small importance padding--small">
                @if( isset($packages) && !empty($packages) )
                    @foreach($packages as $package)
                      @if(isset($package->item_id) && isset($user->subscription->package_type_id) && $package->item_id == $user->subscription->package_type_id)
                        {{ $package->value ? $package->value : 'لا يوجد' }}
                      @endif
                    @endforeach
                @endif
                </span>
                </div>
              </div>
              
              <div class="col-xs-6"><b class="col-xs-3">عدد الاقساط </b>
                <div class="col-xs-9">{{ $user->subscription ? $user->subscription->number_of_installments : 'لا يوجد' }}</div>
              </div>
            </div>
            <div class="col-lg-12">
              <table class="table-1">
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
                @if ( isset($user->subscription->installments) && !empty($user->subscription->installments) )  
                  @foreach($user->subscription->installments as $installment)
                    <tr>
                      <td><span class="cellcontent">{{ $installment->installment_number ? $installment->installment_number : 'لا يوجد' }}</span></td>
                      <td><span class="cellcontent">{{ $installment->value ? $installment->value : 'لا يوجد' }}</span></td>
                      <td><span class="cellcontent">{{ $installment->payment_date ? $installment->payment_date->format('d/m/Y') : 'لا يوجد' }} </span></td>
                      <td><span class="cellcontent"><i class = "fa {{ $installment->is_paid ? 'color--fadegreen fa-check': 'color--fadebrown fa-times' }}"></i></span></td>
                      <td><span class="cellcontent"><a href= "#payment_status{{ $installment->id }}" ,  class= "action-btn bgcolor--fadegreen color--white "> <i class = "fa  fa-edit"></i></a></span></td>
                    </tr>
                  @endforeach
                @endif
                </tbody>
              </table>
            </div>

            @if ( isset($user->subscription->installments) && !empty($user->subscription->installments) )
              @foreach($user->subscription->installments as $installment)
                <div class="col-md-2"><a class="master-btn undefined undefined undefined undefined undefined" href="#payment_status"><span></span></a>
                  <div class="remodal-bg"></div>
                  <div class="remodal" data-remodal-id="payment_status{{ $installment->id }}" role="dialog" aria-labelledby="modal1Title" aria-describedby="modal1Desc">
                  
                    <form role="form" action="{{ route('companies.comp_update',$installment->id) }}" method="post" accept-charset="utf-8">
                      {{ csrf_field() }}
                    <button class="remodal-close" data-remodal-action="close" aria-label="Close"></button>
                    <div>
                      <div class="row">
                        <div class="col-xs-12">
                          <h3>تغيير حالة القسط</h3>
                          <div class="master_field">

                        @if($installment->is_paid==1)       
                          <input class="icon" type="radio" name="installment" id="done{{ $installment->id }}" value="1" checked="true">
                          <label for="done{{ $installment->id }}">تم الدفع</label>

                          <input class="icon" type="radio" name="installment" id="not_done{{ $installment->id }}" value="0" >
                          <label for="not_done{{ $installment->id }}">لم يتم الدفع</label>

                            
                          @else
                            <input class="icon" type="radio" name="installment" id="done{{ $installment->id }}" value="1" >
                          <label for="done{{ $installment->id }}">تم الدفع</label>

                          <input class="icon" type="radio" name="installment" id="not_done{{ $installment->id }}" value="0" checked="true">
                          <label for="not_done{{ $installment->id }}">لم يتم الدفع</label>

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
            @endif

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
                      <td><span class="cellcontent">{{  ($case->cases->case_types) ? $case->cases->case_types->name : 'لا يوجد'  }}</span></td>
                      <td><span class="cellcontent">{{  ($case->cases->courts) ? $case->cases->courts->name : 'لا يوجد'  }}</span></td>
                      <td><span class="cellcontent">{{  ($case->cases->region) ? $case->cases->region : 'لا يوجد'  }}</span></td>
                      <td><span class="cellcontent">{{  ($case->cases->claim_number) ? $case->cases->claim_number : 'لا يوجد'  }}</span></td>
                      <td><span class="cellcontent">{{  ($case->cases->claim_year) ? $case->cases->claim_year : 'لا يوجد'  }}</span></td>
                      <td><span class="cellcontent">{{  ($case->cases->claim_date) ? $case->cases->claim_date->format('d/m/Y') : 'لا يوجد'  }}</span></td>
                      <td><span class="cellcontent">{{  ($case->cases->office_file_number) ? $case->cases->office_file_number : 'لا يوجد'  }}</span></td>
                      <td><span class="cellcontent">{{  ($case->attorney_number) ? $case->attorney_number : 'لا يوجد'  }}</span></td>
                    </tr>
                    @endforeach
                @endif
              </tbody>
            </table>
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
                      <td><span class="cellcontent">{{  ($service->task_payment_status_id) ? Helper::localizations('task_payment_statuses', 'name', $service->task_payment_status_id) : 'لا يوجد'  }}</span></td>
                      <td><span class="cellcontent">{{  ($service->assigned_lawyer_id) ? Helper::getUserDetails($service->assigned_lawyer_id)->full_name : 'لا يوجد'  }}</span></td>
                    </tr>
                    @endforeach
                @endif
              </tbody>
            </table>
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
                      <td><span class="cellcontent">{{  ($urgent->task_address) ? $urgent->task_address : 'لا يوجد'  }}</span></td>
                      <td><span class="cellcontent">{{  ($urgent->description)  ? $urgent->description  : 'لا يوجد'  }}</span></td>
                      <td><span class="cellcontent"><i class = "fa {{  ($urgent->task_status_id == 2) ? 'color--fadegreen fa-check' : 'fa-times'  }}"></i></span></td>
                      <td><span class="cellcontent">{{  ($urgent->start_datetime) ? $urgent->start_datetime->format('d-m-Y') : 'لا يوجد'  }}</span></td>
                      <td><span class="cellcontent">{{  ($urgent->start_datetime) ? $urgent->start_datetime->format('h:m')   : 'لا يوجد'  }}</span></td>
                    </tr>
                    @endforeach
                @endif
              </tbody>
            </table>
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
                 @foreach($procurations as $procuration)
                    <tr>
                      <td><span class="cellcontent">{{$procuration->id}}</span></td>
                      <td><span class="cellcontent">{{$procuration->procuration_number}}</span></td>
                      <td><span class="cellcontent">{{$procuration->office}}</span></td>
                      <td><span class="cellcontent">{{$procuration->procuration_type}}</span></td>
                      <td><span class="cellcontent">{{$procuration->issue_date}}</span></td>
                    </tr>
                    @endforeach
              </tbody>
            </table>
            
            <div class="col-md-2 col-sm-6 col-xs-12"><a class="master-btn color--white bgcolor--main bradius--small bshadow--0 btn-block" href="#popupModal_2"><i class="fa fa-plus"></i><span>اضافة</span></a>
              <div class="remodal-bg"></div>
              <div class="remodal" data-remodal-id="popupModal_2" role="dialog" aria-labelledby="modal1Title" aria-describedby="modal2Desc">
                 <form role="form" action="{{route('procuration.store')}}" method="post" accept-charset="utf-8">
                          {{csrf_field()}}
                          <!-- id   client_id   procuration_number  procuration_type    issue_date  office  photo   created_at  updated_at  created_by  updated_by -->
                    <button class="remodal-close" data-remodal-action="close" aria-label="Close"></button>
                    <div>
                      <div class="row">
                       <input  type="hidden" name="client_id" value="{{$user->id}}">
                             <input  type="hidden" name="route_name" value="companies.show">
                        <div class="col-xs-12">
                          <h3>اضافة</h3>
                        </div>
                        <div class="col-xs-6">
                          <div class="master_field">
                            <label class="master_label mandatory" for="ID_No">رقم التوكيل</label>
                            <input class="master_input" type="number" placeholder="رقم التوكيل" id="ID_No" name="procuration_number">
                          </div><span class="master_message color--fadegreen">  @if ($errors->has('procuration_number'))
                                      {{ $errors->first('procuration_number')}}
                                    @endif</span>
                        </div>
                        <div class="col-xs-6">
                          <div class="master_field">
                            <label class="master_label mandatory" for="ID_No">مكتب التوثيق</label>
                            <input class="master_input" type="text" placeholder="مكتب التوثيق" id="ID_No" name="office">
                          </div><span class="master_message color--fadegreen">  @if ($errors->has('office'))
                                      {{ $errors->first('office')}}
                                    @endif</span>
                        </div>
                        <div class="col-xs-6">
                          <div class="master_field">
                            <label class="master_label mandatory" for="ID_No">نوعه</label>
                            <input class="master_input" type="text" placeholder="نوعه" id="ID_No" name="procuration_type">
                          </div><span class="master_message color--fadegreen">  @if ($errors->has('procuration_type'))
                                      {{ $errors->first('procuration_type')}}
                                    @endif</span>
                        </div>
                        <div class="col-xs-6">
                          <div class="master_field">
                            <label class="master_label mandatory" for="ID_No">التاريخ</label>
                            <input class="datepicker-popup master_input" type="text" placeholder="التاريخ" id="issue_date" name="issue_date">
                          </div><span class="master_message color--fadegreen">  @if ($errors->has('issue_date'))
                                      {{ $errors->first('issue_date')}}
                                    @endif</span>
                        </div>
                        <div class="col-xs-12">
                          <div class="master_field">
                            <label class="master_label mandatory" for="ID_No-11">صورة التوكيل </label>
                            <div class="file-upload">
                              <div class="file-select">
                                <div class="file-select-name" id="noFile">صورة التوكيل </div>
                                 <input name="image" class="chooseFile" type="file" name="chooseFile" id="lawyer_img">
                            </div>
                            </div><span class="master_message color--fadegreen">  @if ($errors->has('photo'))
                                      {{ $errors->first('photo')}}
                                    @endif</span>
                          </div>
                        </div>
                      </div>
                    </div><br>
                    <button class="remodal-cancel" data-remodal-action="cancel">الغاء</button>
                    <button class="remodal-confirm"  type="submit">اضافة</button>
                  </form>
              </div>
            </div>
            <div class="clearfix"></div>
          </div>
        </li>
      </ul>
    </div>
  </div>
</div>

<script>
    $(document).ready(function() {

      // delete a row
      $('#deleteRecord').click(function(){
        
        var id = $(this).data("id");

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
        function(isConfirm){
          if (isConfirm){
                $.ajax(
                {
                    url: "{{ url('/companies/destroy') }}" +"/"+ id,
                    type: 'GET',
                    dataType: "JSON",
                    data: {
                        "id": id,
                        "_method": 'GET',
                    },
                    success: function ()
                    {
                        swal("تم الحذف!", "تم الحذف بنجاح", "success");
                        $('tr[data-user='+id+']').fadeOut();
                        location.href = "{{ route('companies') }}";
                    }
                });
            
          } else {
            swal("تم الإلغاء", "المعلومات مازالت موجودة :)", "error");
          }
        });
      });

    });
  </script>
  
@endsection