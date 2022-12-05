@extends('layout.app')
@section('content')
              <!-- =============== Custom Content ===============-->
              <div class="row">
                <div class="col-lg-12">
                  <div class="cover-inside-container margin--small-top-bottom bradius--small bshadow--1" style="background:  url( 'img/covers/dummy2.jpg ' ) no-repeat center center; background-size:cover;">
                    <div class="edit-mode">Editing mode</div>
                    <div class="row">
                      <div class="col-xs-12">
                        <div class="text-xs-center">
                          <div class="text-wraper">
                            <h4 class="cover-inside-title color--gray_d">الاستشارات القانونية</h4>
                          </div>
                        </div>
                      </div>
                      <div class="cover--actions">
                      </div>
                    </div>
                  </div>
                </div>
                <form role="form" action="{{URL('legal_edit_consultation/'.$id)}}" method="post">
                <div class="col-lg-12">
                  <div class="cardwrap bgcolor--white bradius--noborder   bshadow--1 padding--small margin--small-top-bottom">
                   
                    {{-- Missing Edit Elements Bug 1847 --}}
                    {{-- <div class="col-md-4 col-sm-6 col-xs-12">
                      <div class="master_field">
                        <label class="master_label" for="consultation_code">كود الإستشارة</label>
                      <input class="master_input" type="text" placeholder="كود الإستشارة .." id="consultation_code" disabled="true" name="consultation_code" value="{{$consultation->code}}">
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6 col-xs-12">
                      <div class="master_field">
                        <label class="master_label mandatory" for="consultation_cat">تصنيف الاستشارة</label>
                        <select class="master_input select2" id="consultation_cat"  data-placeholder="اختر التصنيف الرئيسي للاستشارات القانونية" style="width:100%;" name="consultation_cat">
                      
                          @foreach($consultation_types as $type)
                             @if ($type->id == $consultation->consultation_type_id)
                          <option value="{{$type->id}}" selected>{{$type->name}}</option>
                          @else
                          <option value="{{$type->id}}">{{$type->name}}</option>
                         @endif
                          @endforeach
                        </select><span class="master_message color--fadegreen">
                          @if ($errors->has('consultation_cat'))
                                    {{ $errors->first('consultation_cat')}}
                                    @endif
                                  </span>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6 col-xs-12">
                      <div class="master_field">
                        <label class="master_label">نوع الاستشارة</label>
                        <div class="radiorobo">
                          @if($consultation->is_paid == 1)
                          <input type="radio" id="rad_1" name="consultation_type" value="0">
                          <label for="rad_1">مجانية</label>
                       
                          <input type="radio" id="rad_2" name="consultation_type" value="1" checked>
                          <label for="rad_2">مدفوع</label>
                          @else
                          <input type="radio" id="rad_1" name="consultation_type" value="0" checked>
                          <label for="rad_1">مجانية</label>
                       
                          <input type="radio" id="rad_2" name="consultation_type" value="1" >
                          <label for="rad_2">مدفوع</label>
                          @endif
                        </div><span class="master_message color--fadegreen">
                           @if ($errors->has('consultation_type'))
                                    {{ $errors->first('consultation_type')}}
                                    @endif
                        </span>
                      </div>
                    </div>

      <div class="col-md-2 col-xs-4">
          <div class="master_field">
            <label class="master_label" for="sitch_1">اللغه</label>
                  <select name="language" class="master_input select2" id="type" data-placeholder="اللغع" style="width:100%;" ,>
                    @foreach($languages as $language)
                    @if($consultation->lang_id == $language->id)
                    <option value="{{$language->id}}" selected >{{$language->name}}</option>
                    @else
                    <option value="{{$language->id}}">{{$language->name}}</option>
                    @endif
                    @endforeach
                  </select>
              
              @if ($errors->has('language'))
                <span class="master_message color--fadegreen">{{ $errors->first('language') }}</span>
              @endif
              
          </div>
        </div> --}}
                    {{--  --}}

                    <div class="col-xs-12">
                      <div class="master_field">
                        <label class="master_label mandatory" for="consultation_question">نص السؤال</label>
                        <input class="master_input" type="text" placeholder="نص السؤال .." id="consultation_question" name="consultation_question" value="{{$consultation->question}}"><span class="master_message color--fadegreen">
                            @if ($errors->has('consultation_question'))
                                    {{ $errors->first('consultation_question')}}
                                    @endif
                        </span>
                      </div>
                    </div>
                    <div class="col-xs-12">
                      <div class="master_field">
                        <label class="master_label mandatory" for="consultation_answer">نص الاجابة</label>
                        <?php $i=0; ?>
                        @foreach($consultation->consultation_reply as $reply)
                        @if($reply->lawyer_id == \Auth::user()->id)
                        <?php $i=1; ?>
                        <textarea class="master_input"  id="consultation_answer" name="consultation_answer" placeholder="نص الاجابة ">{{trim($reply->reply)}}</textarea>
                         
                         @endif
                         @endforeach
                         @if($i==0)
                         <textarea class="master_input"  id="consultation_answer" name="consultation_answer" placeholder="نص الاجابة "></textarea>

                         @endif
                         
                        <span class="master_message color--fadegreen">
                           @if ($errors->has('consultation_answer'))
                                    {{ $errors->first('consultation_answer')}}
                                    @endif
                        </span>
                      </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="col-md-2 col-xs-6">
                      <button class="master-btn undefined btn-block color--white bgcolor--fadepurple bradius--small bshadow--0" type="submit"><i class="fa fa-save"></i><span>حفظ</span>
                      </button>
                    </div>
                    <div class="col-md-2 col-xs-6">
                     <a href="{{route('legal_consultations')}}"> <button class="master-btn undefined btn-block color--white bgcolor--fadebrown bradius--small bshadow--0" type="button" onclick="{{route('legal_consultations')}}"><i class="fa fa-times"></i><span>الغاء</span>
                      </button></a>
                    </div>
                    <div class="clearfix"></div><br>
                  </div>
                </div>
                 <input type="hidden" name="_token" value="{{ csrf_token() }}">
              </form>
                <!-- =============== PAGE VENDOR Triggers ===============-->
              </div>

@stop