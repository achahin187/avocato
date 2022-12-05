 @extends('layout.app')             
 @section('content')
 
<script type="text/javascript"> 
  $(document).ready(function(){
        window.setTimeout(function() {
            $(".alert").fadeTo(500, 0).slideUp(500, function(){
                $(this).remove(); 
            });
        }, 4000);
  });
</script>
              <div class="row">
                <div class="col-lg-12">
                  <div class="cover-inside-container margin--small-top-bottom bradius--small bshadow--1" style="background:  url( '{{asset('img/covers/dummy2.jpg')}}' ) no-repeat center center; background-size:cover;">
                    <div class="edit-mode">Editing mode</div>
                    <div class="row">
                      <div class="col-xs-12">
                        <div class="text-xs-center">
                          <div class="text-wraper">
                            <h4 class="cover-inside-title color--gray_d">المستخدمين</h4>
                          </div>
                        </div>
                      </div>
                      <div class="cover--actions">
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-12">
                  @if(\session('success'))
                  <div class="alert alert-success">
                  {{\session('success')}}
                  </div>
                  @endif
              <form role="form" action="{{route('users_list_update',$user->id)}}" method="post" enctype="multipart/form-data" accept-charset="utf-8">
                {{csrf_field()}}
                    <div class="cardwrap bgcolor--white bradius--noborder   bshadow--1 padding--small margin--small-top-bottom">
                      <div class="col-md-4 col-xs-6">
                        <div class="master_field">
                          <label class="master_label mandatory" for="client_name">اسم المستخدم</label>
                          <input name="user_name" value="{{$user->name}}" class="master_input" type="text" placeholder="اسم المستخدم" id="client_name"><span class="master_message color--fadegreen">
                                  @if ($errors->has('user_name'))
                                    {{ $errors->first('user_name')}}
                                    @endif</span>
                        </div>
                      </div>
                      <div class="col-md-4 col-xs-6">
                        <div class="master_field">
                          <label class="master_label mandatory" for="client_full_name">الاسم بالكامل</label>
                          <input name="full_name" value="{{$user->full_name}}" class="master_input" type="text" placeholder="الاسم بالكامل" id="client_full_name"><span class="master_message color--fadegreen"> 
                                    @if ($errors->has('full_name'))
                                    {{ $errors->first('full_name')}}
                                    @endif</span>
                        </div>
                      </div>
                      <div class="col-md-4 col-xs-6">
                        <div class="master_field">
                          <label class="master_label mandatory" for="user_position">دور المستخدم</label>
                          <select name="role" class="master_input select2" id="user_position" style="width:100%;">
                          <option value="choose" disabled>اختر دور المستخدم</option>
                          @foreach($roles as $role)
                          @if($role->id!=1)
                          <option value="{{$role->id}}"
                            @foreach($user->rules as $rule)
                            {{$rule->id==$role->id ? 'selected':''}}
                            @endforeach
                           >{{$role->name_ar}}</option>
                           @endif
                          @endforeach
                          </select><span class="master_message color--fadegreen">
                                    @if ($errors->has('role'))
                                    {{ $errors->first('role')}}
                                    @endif</span>
                        </div>
                      </div>
                      <div class="col-md-4 col-xs-6">
                        <div class="master_field">
                          <label class="master_label mandatory">صورة المستخدم</label>
                          <div class="file-upload">
                            <div class="file-select">
                              <div class="file-select-name" id="noFile">صورة المستخدم</div>
                              <input name="image" class="chooseFile" type="file" name="chooseFile">
                            </div>
                          </div><span class="master_message color--fadegreen"> 
                                  @if ($errors->has('image'))
                                    {{ $errors->first('image')}}
                                    @endif</span>
                        </div>
                      </div>
                      <div class="col-md-4 col-xs-6">
                        <div class="master_field">
                          <label class="master_label mandatory" for="client_email">البريد الالكترونى</label>
                          <input name="email" value="{{$user->email}}" class="master_input" type="email" placeholder="ex:mail@mail.com" id="client_email"><span class="master_message color--fadegreen">
                                    @if ($errors->has('email'))
                                    {{ $errors->first('email')}}
                                    @endif</span>
                        </div>
                      </div>
                      <div class="col-md-4 col-xs-6">
                        <div class="master_field">
                          <label class="master_label mandatory" for="phone">هاتف</label>
                          <input name="phone" value="{{$user->phone}}" class="master_input" type="number" placeholder="مثال : 0123456789" id="phone"><span class="master_message color--fadegreen">          @if ($errors->has('phone'))
                                    {{ $errors->first('phone')}}
                                    @endif</span>
                        </div>
                      </div>
                      <div class="col-md-4 col-xs-6">
                        <div class="master_field">
                          <label class="master_label mandatory" for="mob">موبايل</label>
                          <div class="col-md-3">
                          <select name="tele_code" class="master_input select2" id="tele_code"  style="width:100%;">
                        @foreach($codes as $code)
                        @if($user->tele_code == $code['tele_code'])
                        <option value="{{$code['tele_code']}}" selected>{{$code['tele_code']}}</option>
                        @else
                        <option value="{{$code['tele_code']}}">{{$code['tele_code']}}</option>
                        @endif
                        @endforeach
                        </select>
                        </div>
                        <div class="col-md-9">
                        <input name="cellphone"  class="master_input" type="number" placeholder="مثال : 111111111" id="mob" value="{{$user->cellphone}}"><span class="master_message color--fadegreen">
                                    @if ($errors->has('cellphone'))
                                    {{ $errors->first('cellphone')}}
                                    @endif</span>
                        </div>
                        </div>
                      </div>
                      <div class="col-md-4 col-xs-6">
                        <div class="master_field">
                          <label class="master_label mandatory">كلمة المرور</label>
                          <input name="password" class="master_input" type="password" placeholder="كلمة المرور"><span class="master_message color--fadegreen">
                                    @if ($errors->has('password'))
                                    {{ $errors->first('password')}}
                                    @endif</span>
                        </div>
                      </div>
                      <div class="col-md-4 col-xs-6">
                        <div class="master_field">
                          <label class="master_label mandatory">اعادة كتابة كلمة المرور</label>
                          <input name="confirm_password" class="master_input" type="password" placeholder="اعادة كتابة كلمة المرور"><span class="master_message color--fadegreen">
                                    @if ($errors->has('confirm_password'))
                                    {{ $errors->first('confirm_password')}}
                                    @endif</span>
                        </div>
                      </div>
                      <div class="clearfix"></div>
                      <div class="col-md-4 col-xs-6">
                        <label class="master_label">تفعيل المستخدم</label>
                        <div class="master_field">       
                          <input class="icon" type="radio" name="is_active" value="1" id="radbtn_2" {{$user->is_active ? 'checked':''}}>
                          <label for="radbtn_2">مفعل</label>
                          <input class="icon" type="radio" name="is_active" value="0" id="radbtn_3" {{!$user->is_active ? 'checked':''}}>
                          <label for="radbtn_3">غير مفعل</label>
                        </div>
                      </div>
                      <div class="clearfix"></div>
                      <div class="col-md-2 col-xs-6">
                        <button class="master-btn undefined btn-block color--white bgcolor--fadepurple bradius--small bshadow--0" type="submit"><i class="fa fa-save"></i><span>حفظ</span>
                        </button>
                      </div>
                      <div class="col-md-2 col-xs-6">
                        <button class="master-btn undefined btn-block color--white bgcolor--fadebrown bradius--small bshadow--0" type="submit"><i class="fa fa-times"></i><span>الغاء</span>
                        </button>
                      </div>
                      <div class="clearfix"></div>
                    </div>
                  </form>
                  </div>
                </div>
              </div>
               

 @endsection