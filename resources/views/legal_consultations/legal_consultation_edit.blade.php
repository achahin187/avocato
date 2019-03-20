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