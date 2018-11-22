@extends('layout.app')
@section('content')
 <script>
  $(document).ready(function(){

        $('.btn-warning-cancel').click(function(){
      var noti_id = $(this).closest('tr').attr('data-notification-id');
      var _token = '{{csrf_token()}}';
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
         $.ajax({
           type:'POST',
           url:'{{url('notifications_destroy')}}'+'/'+noti_id,
           data:{_token:_token},
           success:function(data){
            $('tr[data-notification-id='+noti_id+']').fadeOut();
          }
        });
         swal("تم الحذف!", "تم الحذف بنجاح", "success");
       } else {
        swal("تم الإلغاء", "المعلومات مازالت موجودة :)", "error");
      }
    });
    });

          });
</script>

              <div class="row">
                <div class="col-lg-12">
                  <div class="cover-inside-container margin--small-top-bottom bradius--small bshadow--1" style="background:  url( '{{asset('img/covers/dummy2.jpg')}}' ) no-repeat center center; background-size:cover;">
                    <div class="row">
                      <div class="col-xs-12">
                        <div class="text-xs-center">
                          <div class="text-wraper">
                            <h4 class="cover-inside-title color--gray_d">العملاء <i class="fa fa-chevron-circle-right"></i>
                              <h4 class="cover-inside-title color--gray_d">التنبيهات </h4>
                            </h4>
                          </div>
                        </div>
                      </div>
                      <div class="cover--actions"><span></span>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-lg-12">
                  <div class="cardwrap bgcolor--white bradius--noborder   bshadow--1 padding--small margin--small-top-bottom">
                    <div class="full-table">
                      <div class="filter__btns"><a class="master-btn bgcolor--main color--white bradius--small" href="#filterModal_1"><i class="fa fa-filter"></i>filters</a></div>
                      <div class="remodal" data-remodal-id="filterModal_1" role="dialog" aria-labelledby="modal1Title" aria-describedby="modal1Desc">
                <form role="form" action="{{route('notifications_filter')}}" method="post" accept-charset="utf-8">
                    {{csrf_field()}}
                        <button class="remodal-close" data-remodal-action="close" aria-label="Close"></button>
                        <div>
                          <h3 id="modal1Title">فلتر</h3>
                          <div class="row">
                            <div class="col-md-4 col-sm-6 col-xs-12">
                              <div class="master_field">
                                <label class="master_label mandatory" for="governorate">ارسال الى مشتركين الباقات</label>
                                <select class="master_input select2" name="package" id="governorate" style="width:100%;">
                                      <option >choose type .. </option>
                                      @foreach ($subscription_types as $types)
                                      <option value="{{ $types->id }}">{{ Helper::localizations('package_types', 'name', $types->id) }}</option>
                                      @endforeach
                                </select><span class="master_message color--fadegreen"></span>
                              </div>
                            </div>
                            <div class="col-md-4 col-sm-6 col-xs-12">
                              <div class="master_field">
                                <label class="master_label" for="start-date">تاريخ الارسال من</label>
                                <div class="bootstrap-timepicker">
                                  <input name="date_from" class="datepicker master_input" type="text" placeholder="التاريخ من" id="start-date">
                                </div>
                              </div>
                            </div>
                            <div class="col-md-4 col-sm-6 col-xs-12">
                              <div class="master_field">
                                <label class="master_label" for="last-date">تاريخ الارسال الى</label>
                                <div class="bootstrap-timepicker">
                                  <input name="date_to" class="datepicker master_input" type="text" placeholder="التاريخ الى" id="last-date">
                                </div>
                              </div>
                            </div>
                          </div>
                        </div><br>
                        <button class="remodal-cancel" data-remodal-action="cancel">الغاء</button>
                        <button class="remodal-confirm" type="submit">فلتر</button>
                      </form>
                      </div>
                      <table class="table-1">
                        <thead>
                          <tr class="bgcolor--gray_mm color--gray_d">
                            <th><span class="cellcontent">نص التنبية</span></th>
                            <th><span class="cellcontent">ارسال الى مشتركين الباقات</span></th>
                            <th><span class="cellcontent">تاريخ الارسال</span></th>
                            <th><span class="cellcontent">الاجراءات</span></th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach($notifications as $notification)
                          <tr data-notification-id={{$notification->id}}>
                            <td><span class="cellcontent">{{$notification->msg}}</span></td>
                            <td><span class="cellcontent">{{$notification->packages}}</span></td>
                            <td><span class="cellcontent">{{$notification->schedule}}</span></td>
                            <td><span class="cellcontent"><a href="#"  class= "btn-warning-cancel action-btn bgcolor--fadebrown color--white "><i class = "fa  fa-trash-o"></i></a></span></td>
                          </tr>
                          @endforeach
                        </tbody>
                      </table>
                      
                      <div class="col-md-2 col-sm-3 colxs-12"><a class="master-btn color--white bgcolor--main bradius--small bshadow--0 btn-block" href="#add_notification"><i class="fa fa-plus"></i><span>إضافة</span></a>
                        <div class="remodal-bg"></div>
                        <div class="remodal" data-remodal-id="add_notification" role="dialog" aria-labelledby="modal1Title" aria-describedby="modal1Desc">
              <form role="form" action="{{route('notifications.store')}}" method="post" enctype="multipart/form-data" accept-charset="utf-8">
                {{csrf_field()}}
                          <button class="remodal-close" data-remodal-action="close" aria-label="Close"></button>
                          <div>
                            <div class="row">
                              <div class="col-xs-12">
                                <h3>إضافة</h3>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                  <div class="master_field">
                                    <label class="master_label mandatory" for="governorate">ارسال الى مشتركين الباقات</label>
                                    <select name="package_type[]" class="master_input select2" id="governorate" multiple="multiple" data-placeholder="ارسال الى" style="width:100%;" ,>
                                      @foreach ($subscription_types as $types)
                                      <option value="{{ $types->id }}">{{ Helper::localizations('package_types', 'name', $types->id) }}</option>
                                      @endforeach
                                    </select><span class="master_message color--fadegreen">
                                      @if ($errors->has('package_type'))
                                      {{ $errors->first('package_type')}}
                                    @endif</span>
                                  </div>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                  <div class="master_field">
                                    <label class="master_label mandatory" for="send_date">تاريخ الإرسال</label>
                                    <div class="bootstrap-timepicker">
                                      <input name="date" class="datepicker master_input" type="text" placeholder="تاريخ الإرسال" id="send_date">
                                    </div><span class="master_message color--fadegreen">
                                      @if ($errors->has('date'))
                                      {{ $errors->first('date')}}
                                    @endif</span>
                                  </div>
                                </div>
                                <div class="col-xs-12">
                                  <div class="master_field">
                                    <label class="master_label">نص التنبية</label>
                                    <textarea name="notification" class="master_input" name="textarea" placeholder="نص التنبية"></textarea><span class="master_message color--fadegreen">
                                      @if ($errors->has('notification'))
                                      {{ $errors->first('notification')}}
                                    @endif</span>
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
                      </div>
                      <div class="clearfix"></div>
                    </div>
                  </div>
                </div>
              </div>
            

@endsection