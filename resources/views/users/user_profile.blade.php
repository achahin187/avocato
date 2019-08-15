 @extends('layout.app')             
 @section('content')
              <div class="row">
                <div class="col-lg-12">
                  <div class="coverglobal text-center bshadow--2" style="background:#000 url( '{{asset('img/covers/dummy2.jpg')}}' ) no-repeat center center; background-size:cover;"><span></span>
                    <div class="container">
                      <div class="row">
                        <div class="col-xs-12">
                          <div class="text-xs-center"><a href=""><img class="coverglobal__avatar" src="{{asset(''.$user->image)}}">
                              <h3 class="coverglobal__title color--gray_d">{{$user->full_name}}</h3><small class="coverglobal__slogan color--gray_d">{{$user->is_active ? 'مفعل':'غير مفعل'}}</small></a></div>
                          <div class="coverglobal__actions">
                              <a class="color--gray_d bordercolor-gray_d bradius--small border-btn master-btn" type="button" href="{{route('users_list_edit',$user->id)}}">تعديل البيانات</a>
                              <!-- <a class="color--gray_d bordercolor-gray_d bradius--small border-btn master-btn" type="button" href="{{route('users_list_destroy_get',$user->id)}}">استبعاد المستخدم</a> -->
                              <a class=" color--gray_d bordercolor-gray_d bradius--small border-btn master-btn" href="{{route('users_list_destroy_get',$user->id)}}">استبعاد المستخدم</a>
                              <br>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-lg-12">
                  <div class="cardwrap bgcolor--white bradius--noborder   bshadow--1 padding--small margin--small-top-bottom">
                    
                    <div class="col-md-6">
                      <div class="full-table">
                        <table class="verticaltable">
                          <tr>
                            <th class=" color--gray_d"><span class="cellcontent">الاسم بالكامل</span></th>
                            <td><span class="cellcontent">{{$user->full_name}}</span></td>
                          </tr>
                          <tr>
                            <th class=" color--gray_d"><span class="cellcontent"> دور المستخدم</span></th>
                            <td><span class="cellcontent">
                              @foreach($user->rules as $rule)
                              @if($rule->id!=13)
                              {{$rule->name_ar}}
                              @endif
                            @endforeach</span></td>
                          </tr>
                          <tr>
                            <th class=" color--gray_d"><span class="cellcontent">البريد الالكترونى</span></th>
                            <td><span class="cellcontent">{{$user->email}}</span></td>
                          </tr>
                        </table>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="full-table">
                        <table class="verticaltable">
                          <tr>
                            <th class=" color--gray_d"><span class="cellcontent">رقم الهاتف</span></th>
                            <td><span class="cellcontent">{{$user->phone}}</span></td>
                          </tr>
                          <tr>
                            <th class=" color--gray_d"><span class="cellcontent">رقم الموبايل</span></th>
                            <td><span class="cellcontent">{{$user->mobile}}</span></td>
                          </tr>
                          <tr>
                            <th class=" color--gray_d"><span class="cellcontent">تاريخ التسجيل</span></th>
                            <td><span class="cellcontent">{{$user->created_at}}</span></td>
                          </tr>
                        </table>
                      </div>
                    </div>
                    <div class="clearfix"></div>
                  </div>
                  <div class="main-title-conts">
                    <div class="caption">
                      <h3 class="color--main">حركات المستخدم</h3>
                    </div>
                    <div class="actions">
                    </div><span class="mainseparator bgcolor--main"></span>
                  </div>
                  <div class="cardwrap bgcolor--white bradius--noborder   bshadow--1 padding--small margin--small-top-bottom">
                   <form action="{{ route('filter_logs',$user->id) }}" method="post" enctype="multipart/form-data" accept-charset="utf-8">
                   {{ csrf_field() }}
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <div class="master_field">
                        <label class="master_label" for="from">من</label>
                        <div class="bootstrap-timepicker">
                          <input class="datepicker master_input" type="text" placeholder="من" id="from" name='from' required>
                        </div>
                        <span class="master_message color--fadegreen">
                          
                        </span>
                      </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <div class="master_field">
                        <label class="master_label" for="to">الى</label>
                        <div class="bootstrap-timepicker">
                          <input class="datepicker master_input" type="text" placeholder="الى" id="to" name='to' required>
                        </div>
                        <span class="master_message color--fadegreen">
                          
                        </span>
                      </div>
                      </div>
                      <div class="col-md-2 col-sm-2 col-xs-2">
                      <div class="master_field">
                        
                        <div class="bootstrap">
                          <input class="button" type="submit" value="filter">
                        </div>
                      </div>
                    </div>
                    </form>
                    <div class="clearfix"></div>
                    <ul class="log padding--nopadding">
                    @foreach($logs as $log)
                    
                      <li><i class="fa fa-user bgcolor--fadeblue color--white bradius--circle"></i>
                        <div class="log-item padding--nopadding color--gary_d">
                          <span class="time padding--medium">
                            <i class="fa fa-clock-o"></i>
                              {{$log->created_at}}</span>
                          <h3 class="log-header no-border margin--nomargin color--main_l padding--medium">
                            قام المستخدم   
                            {{$log['user']['name']}}
                            بعمل
                          @if($log['action_id'] == 3 || $log['action_id'] == 4 || $log['action_id'] == 5)
                               &nbsp;<a href="#">{{ str_limit($log['actions']['name_ar'], 100) }}</a>
                              {{ str_limit($log['entity']['display_name_ar'],  100) }}
                            @if($log['item_id'] == NUll)
                                &nbsp;<a href="#">
                              @if($log['name'] == '' || $log['name'] == NULL )
                                  اضغط هنا 
                              @else
                                  {{ str_limit($log['name'],  100) }}
                              @endif
                              </a>
                            @else
                                  &nbsp;<a href="{{$log['entity']['base_url']}}">
                                @if($log['name'] == '' || $log['name'] == NULL )
                                    اضغط هنا 
                                @else
                                    {{ str_limit($log['name'],  100) }}
                                @endif
                                </a>
                            @endif
                          @else
                          &nbsp;<a href="#">{{ str_limit($log['actions']['name_ar'],  100) }}</a>
                          @endif
                            
                          </h3>
                        </div>
                      </li>
                      @endforeach
                      <li><i class="fa fa-clock-o bgcolor--fadebrown color--white bradius--circle"></i></li>
                    </ul>
                  </div>
                </div>
              </div>
 
  <a href="#"  class= "btn-warning-cancel action-btn bgcolor--fadebrown color--white "><i class = "fa  fa-trash-o"></i></a>
                    
  <script type="text/javascript">
    $(document).ready(function(){
      $('.btn-warning-cancel').click(function(){
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
                swal("تم الحذف!", "تم الحذف بنجاح", "success");
              } else {
                swal("تم الإلغاء", "المعلومات مازالت موجودة :)", "error");
              }
            });
          });
    });
  </script>
 @endsection
 