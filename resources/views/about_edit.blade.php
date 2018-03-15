 @extends('layout.app')             
 @section('content')

  <div class="row">
    <div class="col-lg-12">
      <div class="cover-inside-container margin--small-top-bottom bradius--small bshadow--1" style="background:  url( '{{asset('img/covers/dummy2.jpg')}}' ) no-repeat center center; background-size:cover;">
        <div class="edit-mode">Editing mode</div>
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
          <div class="cover--actions">
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-12">
      <form action="{{ route('about.update') }}" method="POST">
        {{ csrf_field() }}
        {{ method_field('PATCH') }}
        <div class="cardwrap bgcolor--white bradius--noborder   bshadow--1 padding--small margin--small-top-bottom">
          <div class="col-lg-12">
            <div class="main-title-conts">
              <div class="caption">
                <h3>تعريف عن جسر الأمان</h3>
              </div>
              <div class="actions">
              </div><span class="mainseparator bgcolor--main"></span>

              <textarea name="about" id="article-ckeditor" cols="30" rows="10">{!! $about->content !!}</textarea>

          </div>
          <hr>
          <div class="col-md-2 col-xs-6">
            <button class="master-btn undefined btn-block color--white bgcolor--fadepurple bradius--small bshadow--0" type="submit"><i class="fa fa-save"></i><span>حفظ</span>
            </button>
          </div>
          <div class="col-md-2 col-xs-6">
            <a class="master-btn undefined btn-block color--white bgcolor--fadeorange bradius--small bshadow--0" href="{{ route('about') }}"><i class="fa fa-times"></i><span>الغاء</span>
            </a>
          </div>
          <div class="clearfix"></div>
        </div>
      </form>
    </div>
  </div>

  <script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
  <script>
      CKEDITOR.replace( 'article-ckeditor' );
      
  </script>
@endsection