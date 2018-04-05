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

      });
</script>

              <div class="row">
                <div class="col-lg-12">
                  <div class="cover-inside-container margin--small-top-bottom bradius--small bshadow--1" style="background:  url( 'img/covers/dummy2.jpg ' ) no-repeat center center; background-size:cover;">
                    <div class="add-mode">Adding mode</div>
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
                  @if(\session('success'))
                  <div class="alert alert-success">
                    {{\session('success')}}
                  </div>
                  @endif
                  <form role="form" action="{{route('services_store')}}" method="post" enctype="multipart/form-data" accept-charset="utf-8">
                    {{csrf_field()}}
                    <div class="cardwrap bgcolor--white bradius--noborder   bshadow--1 padding--small margin--small-top-bottom">
                    <div class="col-md-4 col-sm-6 col-xs-12">
                      <div class="master_field">
                        <label class="master_label mandatory" for="client_code">كود العميل</label>                       
                        <select name="client_code" class="master_input select2"  id="client_code"  style="width:100%;">
                          <option value="choose" selected disabled >اختر كود العميل</option>
                          @foreach($clients as $client)
                          <option value="{{$client->id}}">{{$client->code}}</option>
                          @endforeach

                        </select><span class="master_message color--fadegreen">
                                  @if ($errors->has('client_code'))
                                    {{ $errors->first('client_code')}}
                                    @endif</span></span>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6 col-xs-12">
                      <div class="master_field">
                        <label class="master_label mandatory" for="client_name">اسم العميل</label>
                        <input name="name" readonly class="master_input" type="text" placeholder="اسم العميل .." id="client_name"><span class="master_message color--fadegreen"></span>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6 col-xs-12">
                      <div class="master_field">
                        <label class="master_label mandatory" for="client_name">الرقم القومي</label>
                        <input name="national_id" readonly class="master_input" type="text" placeholder="الرقم القومي .." id="client_name"><span class="master_message color--fadegreen"></span>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6 col-xs-12">
                      <div class="master_field">
                        <label class="master_label mandatory" for="client_address">عنوان العميل</label>
                        <input name="address" readonly class="master_input" type="text" placeholder="عنوان العميل .." id="client_address"><span class="master_message color--fadegreen"></span>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6 col-xs-12">
                      <div class="master_field">
                        <label class="master_label mandatory" for="service_type">نوع الخدمة</label>
                        <select name="service_type" class="master_input select2" id="service_type" style="width:100%;">
                          <option selected disabled> اختر نوع الخدمه</option>
                          @foreach($types as $type)
                          <option value="{{$type->item_id}}">{{$type->value}}</option>
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
                        <input value="{{ old('service_name') }}" name="service_name" class="master_input" type="text" placeholder="اسم الخدمة .." id="service_name"><span class="master_message color--fadegreen">
                                  @if ($errors->has('service_name'))
                                    {{ $errors->first('service_name')}}
                                    @endif</span>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6 col-xs-12">
                      <div class="master_field">
                        <label class="master_label mandatory" for="fees">رسوم الخدمة</label>
                        <input value="{{ old('service_expenses') }}" name="service_expenses" class="master_input" type="text" placeholder="رسوم الخدمة" id="fees"><span class="master_message color--fadegreen">
                                  @if ($errors->has('service_expenses'))
                                    {{ $errors->first('service_expenses')}}
                                    @endif</span>
                      </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="col-md-2 col-sm-6 col-xs-6">
                      <button class="master-btn undefined btn-block color--white bgcolor--fadepurple bradius--small bshadow--0" type="submit"><i class="fa fa-save"></i><span>حفظ</span>
                      </button>
                    </div>
                    <div class="col-md-2 col-sm-6 col-xs-6">
                      <a href="{{route('services')}}" class="master-btn undefined btn-block color--white bgcolor--fadebrown bradius--small bshadow--0" ><i class="fa fa-times"></i><span>الغاء</span>
                      </a>
                    </div>
                    <div class="clearfix"></div><br>
                  </div>
                </form>
                </div>
              </div>        

@endsection