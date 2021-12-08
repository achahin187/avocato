@extends('layout.app')
@section('content')

<div class="row">
  <div class="col-lg-12">
    <div class="cover-inside-container margin--small-top-bottom bradius--small bshadow--1" style="background:  url( '{{asset('img/covers/dummy2.jpg')}}' ) no-repeat center center; background-size:cover;">
      <div class="row">
        <div class="col-xs-12">
          <div class="text-xs-center">
            <div class="text-wraper">
              <h4 class="cover-inside-title color--gray_d">العملاء <i class="fa fa-chevron-circle-right"></i>
                <h4 class="cover-inside-title color--gray_d">الشكاوى و الاستفسارات </h4>
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
      @if(Session::has('message'))
      <div class="alert alert-warning text-center">{{ Session::get('message') }}</div>
      @endif
    </div>
  <div class="col-md-12">
    <div class="cardwrap bgcolor--white bradius--noborder   bshadow--1 padding--small margin--small-top-bottom">
      <div class="cardwrap bgcolor--gray_l bradius--noborder   bshadow--1 padding--small margin--small-top-bottom">
        <div class="col-md-12">
          <div class="pull-left">
           <div class="pull-left">
               : اسم العميل 
           </div>
            <b>&nbsp;&nbsp;
            @if(Helper::getUserDetails($complain->user_id))
            <a href="{{route('mobile.show',Helper::getUserDetails($complain->user_id)->id)}}">
              {{ $complain->user_id ? (Helper::getUserDetails($complain->user_id) ? Helper::getUserDetails($complain->user_id)->full_name : ($complain->name ? $complain->name : 'لا يوجد')) : ($complain->name ? $complain->name : 'لا يوجد') }}  
            </a>
            @else
            {{$complain->name}}
            @endif
            </b>
          </div>
          <div class="pull-left">
           <div class="pull-left">
               : البريد الالكترونى 
           </div>
            <b>&nbsp;&nbsp;
            @if(Helper::getUserDetails($complain->user_id))
            <a href="{{route('mobile.show',Helper::getUserDetails($complain->user_id)->id)}}">
              {{ $complain->user_id ? (Helper::getUserDetails($complain->user_id) ? Helper::getUserDetails($complain->user_id)->email : ($complain->name ? $complain->name : 'لا يوجد')) : ($complain->name ? $complain->name : 'لا يوجد') }}  
            </a>
            @else
            {{$complain->name}}
            @endif
            </b>
          </div>
          <div class="pull-left">
           <div class="pull-left">
               : رقم الموبايل 
           </div>
            <b>&nbsp;&nbsp;
            @if(Helper::getUserDetails($complain->user_id))
            <a href="{{route('mobile.show',Helper::getUserDetails($complain->user_id)->id)}}">
              {{ $complain->user_id ? (Helper::getUserDetails($complain->user_id) ? Helper::getUserDetails($complain->user_id)->mobile  : ($complain->name ? $complain->name : 'لا يوجد')) : ($complain->name ? $complain->name : 'لا يوجد') }}  
            </a>
            @else
            {{$complain->name}}
            @endif
            </b>
          </div>
          <div class="pull-right">
            بتاريخ
            {{ $complain->created_at ? $complain->created_at->format('d/m/Y') : 'لا يوجد' }}
            &nbsp;<i class="fa fa-calendar"></i>
          </div>
        </div>
        <div class="clearfix"></div>
        <hr>
        <div class="col-md-12"><b class="pull-left">:نص الشكوى</b>&nbsp;
          <br>
          {{ $complain->body ? $complain->body : 'لا يوجد' }}
        </div>
        <div class="clearfix"></div>
      </div>
      <div class="clearfix"></div>

      {{-- Reply section --}}
      <div class="cardwrap bgcolor--white bradius--noborder   bshadow--1 padding--small margin--small-top-bottom">
        @if(isset($complain->feedbackReplies))
          
          @foreach ($complain->feedbackReplies as $reply)

            <div class="col-xs-12">
              {{-- Replied_by --}}
              <div class="pull-left">
                تم الرد على الشكوى بواسطة
                
              </div>
                &nbsp;<b><a href="{{route('user_profile',Helper::getUserDetails($reply->created_by)->id)}}">
                  {{ Helper::getUserDetails($reply->created_by) ? Helper::getUserDetails($reply->created_by)->full_name : 'لا يوجد' }}  
                </a></b>&nbsp;<i class="fa fa-user"></i>&nbsp; &nbsp;
  
              {{-- Reply date --}}
              <div class="pull-right">
                <div class="pull-left">&nbsp; بتاريخ </div>
                {{ $reply->created_at ? $reply->created_at->diffForHumans() : 'لا يوجد' }}
                &nbsp; <i class="fa fa-calendar"></i> 
              </div>
            </div>
            <div class="clearfix"></div>
            <hr>
  
            {{-- Reply_body --}}
            <div class="col-md-12">
              <p>
                {{ $reply->reply ? $reply->reply : 'لا يوجد رد' }}
              </p>
            </div>
            
            <div class="clearfix"></div>
            <hr>
          @endforeach

          
        @else
          لا يوجد اي رد بعد
        @endif
      </div>

      {{-- Start Reply form --}}
      <div class="cardwrap bgcolor--white bradius--noborder   bshadow--1 padding--small margin--small-top-bottom">
        <form action="{{ route('complains.addReply', $complain->id) }}" method="post">
          {{ csrf_field() }}
            <div class="col-xs-12">
              <div class="master_field">
                <label class="master_label mandatory" for="compain_reply">نص الرد</label>
                <textarea name="newReply" class="master_input" name="textarea" id="compain_reply" placeholder="نص الرد">{{ old('newReply') }}</textarea>
                
                @if ($errors->has('newReply'))
                  <span class="master_message color--fadegreen">{{ $errors->first('newReply') }}</span>
                @endif
              </div>
            </div>
    
            {{-- Submit --}}
            <div class="col-lg-2 col-md-2 col-sm-6 col-xs-6">
              <button class="master-btn undefined btn-block color--white bgcolor--fadeorange bradius--small bshadow--0" type="submit">
                <i class="fa fa-envelope"></i><span>إرسال</span>
              </button>
            </div>
    
            {{-- Cancel --}}
            <div class="col-lg-2 col-md-2 col-sm-6 col-xs-6">
              <a href="{{ route('complains') }}" class="master-btn undefined btn-block color--white bgcolor--fadebrown bradius--small bshadow--0" type="submit"><span>إلغاء</span>
              </a>
            </div>
        </form>
        
        <div class="clearfix"></div>
      </div>
      {{-- End Reply form --}}

      <div class="clearfix"></div>
    </div>
  </div>
</div>

@endsection