@extends('layout.app')
@section('content')
              <!-- =============== Custom Content ===============-->
              <div class="row">
                <div class="col-lg-12">
                  <div class="cover-inside-container margin--small-top-bottom bradius--small bshadow--1" style="background:  url( 'img/covers/dummy2.jpg ' ) no-repeat center center; background-size:cover;">
                    <div class="row">
                      <div class="col-xs-12">
                        <div class="text-xs-center">
                          <div class="text-wraper">
                            <h4 class="cover-inside-title color--gray_d">الاستشارات القانونية</h4>
                          </div>
                        </div>
                      </div>
                      @if($consultation->direct_assigned == 0)
                      <div class="cover--actions"><a class="color--gray_d bordercolor--white bradius--small border-btn master-btn" type="button" href="{{URL('legal_consultation_assign/'.$consultation->id)}}">ارسال الإستشارة لمحامي</a>
                      </div>
                      @endif
                    </div>
                  </div>
                  <div class="cardwrap bgcolor--white bradius--noborder   bshadow--1 padding--small margin--small-top-bottom">
                    <div class="main-title-conts">
                      <div class="caption">
                        <h3>كود الإستشارة: {{$consultation->code}}</h3>
                      </div>
                      @if($consultation->direct_assigned == 0)
                      <div class="actions"><a class="color--white bgcolor--fadegreen bradius--small bshadow--0 master-btn" type="button" href="{{URL('legal_consultation_edit/'.$consultation->id)}}">أضافه رد</a>
                     @endif
                      <div class="actions"><a class="color--white bgcolor--fadegreen bradius--small bshadow--0 master-btn" type="button" href="{{URL('legal_consultation_category/'.$consultation->id)}}">أضافه تصنيف</a>
                      </div><span class="mainseparator bgcolor--main"></span>
                    </div>
                    <div class="col-md-12">
                      <div class="cardwrap bgcolor--gray_l bradius--noborder   bshadow--1 padding--small margin--small-top-bottom">
                        <div class="col-md-12"><span ><b>نص السؤال :</b>&nbsp;
                            {{$consultation->question}}</span>
                            <hr><span class="pull-left"><b>مرسل الاستشارة</b>&nbsp;<b>
                            @if(isset($consultation->client))
                            @if(Helper::is_client_individual($consultation->client->id))
                            <a href="{{route('ind.show',$consultation->client->id)}}">{{($consultation->client)?$consultation->client->name:''}}</a>
                            @elseif(Helper::is_client_company($consultation->client->id))
                            <a href="{{route('companies.show',$consultation->client->id)}}">{{($consultation->client)?$consultation->client->name:''}}</a>
                            @elseif(Helper::is_client_individual_company($consultation->client->id))
                            <a href="{{route('ind.com.show',$consultation->client->id)}}">{{($consultation->client)?$consultation->client->name:''}}</a>
                            @elseif(Helper::is_client_mobile($consultation->client->id))
                            <a href="{{route('mobile.show',$consultation->client->id)}}">{{($consultation->client)?$consultation->client->name:''}}</a>
                            @elseif(Helper::is_admin_superadmin($consultation->client->id))
                            <a href="#">{{($consultation->client)?$consultation->client->name:''}}</a>
                            @elseif(Helper::is_lawyer_mobile($consultation->client->id))
                            <a href="{{route('lawyers_show',$consultation->client->id)}}">{{($consultation->client)?$consultation->client->name:''}}</a>
                            @endif
                            @endif
                            </b>&nbsp;</span>
                          <div class="pull-right">
                            بتاريخ
                            {{$consultation->created_at}}
                            &nbsp;<i class="fa fa-calendar"></i>
                          </div>
                        </div>
                        <div class="clearfix"></div>
                      </div>
                      @foreach($consultation->consultation_reply as $lawyer_reply)
                      <div class="cardwrap bgcolor--white bradius--noborder   bshadow--1 padding--small margin--small-top-bottom" id="lawyer_div.{{$lawyer_reply->id}}">
                        <div class="col-md-12">
                          <div class="pull-left">
                            رد المحامي
                            &nbsp;<b><a href="{{route('lawyers_show',$lawyer_reply->id)}}">{{$lawyer_reply->lawyer_name}}</a></b>&nbsp;<i class="fa fa-user"></i>&nbsp; &nbsp;
                          </div>
                          
                          <div class="pull-right">
                            بتاريخ
                            {{$lawyer_reply->created_at}}
                            &nbsp;<i class="fa fa-calendar"></i>
                          </div>
                        </div>
                        <div class="clearfix"></div>
                        <hr>
                        <div class="col-md-12">
                           <span id="original_reply.{{$lawyer_reply->id}}">{{$lawyer_reply->reply}}</span>
                        </div>
                        <div class="col-md-8 col-sm-8 col-xs-12 color--fadebrown bold">
                          <div class="radiorobo" id="radio_group">
                            @if($lawyer_reply->is_perfect_answer)
                            <input type="radio"  class="perfect_answer" checked name="perfect_answer" id="{{$lawyer_reply->id}}">
                            <label for="{{$lawyer_reply->id}}">الرد الأمثل</label>
                            @else
                            <input type="radio"  class="perfect_answer" name="perfect_answer" id="{{$lawyer_reply->id}}">
                            <label for="{{$lawyer_reply->id}}">الرد الأمثل</label>
                            @endif
                            
                          </div>
                        </div>
                        <div class="col-lg-2 col-md-2 col-sm-6 col-xs-6"><a class="master-btn color--white bgcolor--fadegreen bradius--small bshadow--0 btn-block" href="#edit_individual_reply.{{$lawyer_reply->id}}"><i class="fa fa-edit"></i><span>تعديل الرد</span></a>
                          <div class="remodal-bg"></div>
                          <div class="remodal" data-remodal-id="edit_individual_reply.{{$lawyer_reply->id}}" role="dialog" aria-labelledby="modal2Title" aria-describedby="modal2Desc">
                            <button class="remodal-close" data-remodal-action="close" aria-label="Close"></button>
                            <div>
                              <div class="row">
                                <div class="col-xs-12">
                                  <h3>تعديل رد المحامي </h3><a href="lawyer_view.html">{{$lawyer_reply->lawyer_name}}</a>
                                  <div class="col-xs-12">
                                    <div class="master_field">
                                      <label class="master_label mandatory" for="individual_reply.{{$lawyer_reply->id}}">نص الرد</label>
                                      <textarea class="master_input" name="textarea" id="individual_reply.{{$lawyer_reply->id}}" placeholder="نص الرد" >{{$lawyer_reply->reply}}</textarea><span class="master_message color--fadegreen">message</span>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div><br>
                            <button class="remodal-cancel" data-remodal-action="cancel">إغلاق</button>
                            <button class="remodal-confirm" data-remodal-action="confirm" onclick="edit_reply({{$lawyer_reply->id}})">إضافة</button>
                          </div>
                        </div>
                        <div class="col-lg-2 col-md-2 col-sm-6 col-xs-6">
                          <button class="master-btn undefined btn-block color--white bgcolor--fadebrown bradius--small bshadow--0" type="submit" onclick="delete_reply({{$lawyer_reply->id}})"><i class="fa fa-trash"></i><span>حذف</span>
                          </button>
                        </div>
                        <div class="clearfix"></div>
                      </div>
                      @endforeach
                      
                      <div class="col-lg-2 col-md-2 col-sm-6 col-xs-6">
                        <button class="master-btn undefined btn-block color--white bgcolor--fadepurple bradius--small bshadow--0" type="" onclick="set_perfect_answer({{$consultation->id}});"><i class="fa fa-save"></i><span>حفظ</span>
                        </button>
                      </div>
                      <div class="col-lg-2 col-md-2 col-sm-6 col-xs-6">
                       <a href="{{route('legal_consultations')}}"><button class="master-btn undefined btn-block color--white bgcolor--fadebrown bradius--small bshadow--0" type="button" onclick="{{route('legal_consultations')}}"><i class="fa fa-times" ></i><span>الغاء</span>
                      </button></a>
                      </div>
                    </div>
                    <div class="clearfix"></div><a class="master-btn undefined undefined undefined undefined undefined" href="#edit_reply"><span></span></a>
                    <div class="remodal-bg"></div>
                    <div class="remodal" data-remodal-id="edit_reply" role="dialog" aria-labelledby="modal1Title" aria-describedby="modal1Desc">
                      <button class="remodal-close" data-remodal-action="close" aria-label="Close"></button>
                      <div>
                        <div class="row">
                          <h3>تعديل رد على الإستشارة</h3>
                          <div class="col-xs-12">
                            <div class="master_field">
                              <label class="master_label">نص الرد</label>
                              <textarea class="master_input" name="textarea" placeholder="نص الرد"></textarea>
                            </div>
                          </div>
                          <div class="clearfix"></div>
                        </div>
                      </div><br>
                      <button class="remodal-cancel" data-remodal-action="cancel">إلغاء</button>
                      <button class="remodal-confirm" data-remodal-action="confirm" id="consultation_button" >حفظ</button>
                    </div>
                  </div>
                </div>
              </div>
              <!-- =============== PAGE VENDOR Triggers ===============-->
              
           @endsection
           <script type="text/javascript">
            function set_perfect_answer(consultation_id)
            {
            var selected = $("#radio_group input[type='radio']:checked");
                if (selected.length > 0) {
                   var perfect_answer = selected.attr('id') ;
                    // alert(consultation_id + perfect_answer);
                    $.ajax({
                        
                        url: '{{route("set_perfect_response")}}',
                        dataType : 'json',
                        type: 'POST',

                        data: { 'consultation_id' : consultation_id,'perfect_answer' : perfect_answer , '_token':"{{ csrf_token() }}"},
                        success: function(data)
                        {
                          swal("تم", "تم تسجيل الرد الامثل:)", "success");
                          // alert(data);
                            // alert("Settings has been updated successfully.");
                        }
                    });
                }
                else
                {
                  swal("خطأ", "لم يتم اختيار الرد الامثل :)", "error");
                }
                // alert('no item selected') ;
            }
             function edit_reply(id)
             {

              var new_reply=document.getElementById("individual_reply."+id).value;
              document.getElementById("original_reply."+id).innerHTML =new_reply;
              

              $.ajax({
                        
                        url: '{{route("edit_lawyer_response")}}',
                        dataType : 'json',
                        type: 'POST',

                        data: { 'id' : id,'reply' : new_reply , '_token':"{{ csrf_token() }}"},
                        success: function()
                        {
                            // alert("Settings has been updated successfully.");
                        }
                    });
              // alert(new_reply);
             }
             function delete_reply(id)
             {
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
           var elem = document.getElementById("lawyer_div."+id);
                   elem.parentNode.removeChild(elem);
              
              $.ajax({
                        
                        url: '{{route("delete_lawyer_response")}}',
                        dataType : 'json',
                        type: 'POST',

                        data: { 'id' : id, '_token':"{{ csrf_token() }}"},
                        success: function()
                        {
                            // alert("Reply Deleted Successfully.");
                        }
                    });
         swal("تم الحذف!", "تم الحذف بنجاح", "success");
       } else {
        swal("تم الإلغاء", "المعلومات مازالت موجودة :)", "error");
      }
    });
            
              
              }
           </script>