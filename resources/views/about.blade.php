 @extends('layout.app')             
 @section('content')

<div class="row">
  <div class="col-lg-12">
    <div class="cover-inside-container margin--small-top-bottom bradius--small bshadow--1" style="background:  url( '{{asset('img/covers/dummy2.jpg')}}' ) no-repeat center center; background-size:cover;">
      <div class="row">
        <div class="col-xs-12">
          <div class="text-xs-center">
            <div class="text-wraper">
              <h4 class="cover-inside-title color--gray_d">البيانات الأساسية <i class="fa fa-chevron-circle-right"></i>
                <h4 class="cover-inside-title color--gray_d">عن جسر الأمان </h4>
              </h4>
            </div>
          </div>
        </div>
        <div class="cover--actions"><a class="color--gray_d bordercolor--white bradius--small border-btn master-btn" type="button" href="{{route('about_edit')}}">تعديل </a>
        </div>
      </div>
    </div>
  </div>
  <div class="col-lg-12">
    <div class="cardwrap bgcolor--white bradius--noborder   bshadow--1 padding--small margin--small-top-bottom">
      <div class="col-lg-12">
        
        @if (isset($about->content) && $about->content != null)
          {!! $about->content !!}
        @else
          لا يوجد معلومات كافية!
        @endif
        
      </div>
      <div class="clearfix"></div>
    </div>
  </div>
</div>

  <script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
  <script>
      CKEDITOR.replace( 'article-ckeditor' );
  </script>
    
@endsection