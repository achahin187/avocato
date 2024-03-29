@extends('layout.app')
@section('content')

<script>
  $(document).ready(function(){

            $("select[name='client_code']").change(function () {
              @foreach($clients as $client)
              if({{$client->id}} == $("select[name='client_code']").val())
              {
              $("input[name=name]").val('{{$client->full_name}}');
              $("input[name=address]").val('{{$client->address}}');
              $("input[name=national_id]").val('{{$client->user_detail->national_id}}');
              }
              @endforeach

        });

            $("select[name='client_code']").trigger('change');
        window.setTimeout(function() {
            $(".alert").fadeTo(500, 0).slideUp(500, function(){
                $(this).remove(); 
            });
        }, 4000);
      });
</script>

              <div class="row">
                <div class="col-lg-12">
                  <div class="cover-inside-container margin--small-top-bottom bradius--small bshadow--1" style="background:  url( 'img/covers/dummy2.jpg ' ) no-repeat center center; background-size:cover;">
                    <div class="edit-mode">Editing mode</div>
                    <div class="row">
                      <div class="col-xs-12">
                        <div class="text-xs-center">
                          <div class="text-wraper">
                            <h4 class="cover-inside-title color--gray_d">القضايا و الخدمات <i class="fa fa-chevron-circle-right"></i>
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
                <div class="col-lg-12">
                  <form role="form" action="{{route('services_update',$service->id)}}" method="post" enctype="multipart/form-data" accept-charset="utf-8">
                    {{csrf_field()}}
                  <div class="cardwrap bgcolor--white bradius--noborder   bshadow--1 padding--small margin--small-top-bottom">
                    <div class="col-xs-6">
                      <div class="master_field">
                      <label class="master_label mandatory" for="client_code">كود العميل</label>                       
                        <select name="client_code" class="master_input select2"  id="client_code"  style="width:100%;">
                          <option value="choose" disabled >اختر كود العميل</option>
                          @foreach($clients as $client)
                          <option @if($client->id == $service->client_id) selected @endif value="{{$client->id}}">{{$client->code}}</option>
                          @endforeach

                        </select><span class="master_message color--fadegreen">
                                  @if ($errors->has('client_code'))
                                    {{ $errors->first('client_code')}}
                                    @endif</span></span>
                      </div>
                    </div>
                    <div class="col-xs-6">
                      <div class="master_field">
                        <label class="master_label mandatory" for="client_name">اسم العميل</label>
                        <input name="name" readonly class="master_input" type="text" placeholder="اسم العميل .." id="client_name"><span class="master_message color--fadegreen"></span>
                      </div>
                    </div>
                    <div class="col-xs-6">
                      <div class="master_field">
                        <label class="master_label mandatory" for="client_name">الرقم القومي</label>
                        <input name="national_id" readonly class="master_input" type="number" placeholder="الرقم القومي .." id="client_name"><span class="master_message color--fadegreen"></span>
                      </div>
                    </div>
                    <div class="col-xs-6">
                      <div class="master_field">
                        <label class="master_label mandatory" for="client_address">عنوان العميل</label>
                        <input name="address" readonly class="master_input" type="text" placeholder="عنوان العميل .." id="client_address"><span class="master_message color--fadegreen"></span>
                      </div>
                    </div>
                    <div class="col-xs-6">
                      <div class="master_field">
                        <label class="master_label mandatory" for="service_type">نوع الخدمة</label>
                        <select name="service_type" class="master_input select2" id="service_type" style="width:100%;">
                          <option disabled> اختر نوع الخدمه</option>
                          @foreach($types as $type)
                          <option @if($service->task_payment_status_id == $type->item_id) 
                            selected @endif value="{{$type->item_id}}">{{$type->value}}</option>
                          @endforeach
                        </select><span class="master_message color--fadegreen">
                                  @if ($errors->has('service_type'))
                                    {{ $errors->first('service_type')}}
                                    @endif</span>
                      </div>
                    </div>
                                        <div class="col-md-4 col-sm-6 col-xs-12">
                      <div class="master_field">
                        <label class="master_label mandatory" for="service_name">اسم الخدمة</label>
                        <input name="service_name" value="{{ $service->name }}"  class="master_input" type="text" placeholder="اسم الخدمة .." id="service_name"><span class="master_message color--fadegreen">
                                  @if ($errors->has('service_name'))
                                    {{ $errors->first('service_name')}}
                                    @endif</span>
                      </div>
                    </div>
                    <div class="col-xs-6">
                      <div class="master_field">
                        <label class="master_label mandatory" for="fees">رسوم الخدمة</label>
                        <input name="service_expenses" value="{{ $service->expenses }}" class="master_input" type="text" placeholder="رسوم الدعوى" id="fees"><span class="master_message color--fadegreen">
                                @if ($errors->has('service_expenses'))
                                    {{ $errors->first('service_expenses')}}
                                    @endif</span>
                      </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="col-md-2 col-xs-6">
                      <button class="master-btn undefined btn-block color--white bgcolor--fadepurple bradius--small bshadow--0" type="submit"><i class="fa fa-save"></i><span>حفظ</span>
                      </button>
                    </div>
                    <div class="col-md-2 col-xs-6">
                      <a href="{{route('services')}}" class="master-btn undefined btn-block color--white bgcolor--fadebrown bradius--small bshadow--0"><i class="fa fa-times"></i><span>الغاء</span>
                      </a>
                    </div>
                    <div class="clearfix"></div><br>
                  </div>
                </form>
                </div>
              </div>


@endsection