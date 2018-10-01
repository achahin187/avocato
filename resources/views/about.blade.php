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
     
      <div class="clearfix"></div>
    </div>
  </div>
</div>

<!--  -->
            <div class="row">
     
                <div class="col-lg-12">
                  <div class="cardwrap bgcolor--white bradius--noborder   bshadow--1 padding--small margin--small-top-bottom">
                    <div class="tabs--wrapper">
                      <div class="clearfix"></div>
                      <ul class="tabs">
                        @foreach($about as $tab)
                        <li {!!$tab->id==1 ? 'class="test"':''!!} >{{$tab->name}}</li>
                       @endforeach
                      </ul>
                      <ul class="tab__content">
                         @foreach($about as $tabContent)
                        <li class="tab__content_item active">
                          <!--.col-xs-12h4  عنا
                          -->
                          <div class="col-lg-12">
                            <p>
                           {!!$tabContent->content!!}
                            </p>
                          </div>
                          <div class="clearfix"></div>
                        </li>
                          @endforeach
                      </ul>
                    </div>
                  </div>
                </div>
              </div>

<!--  -->

  <script src="{{ url('/vendor/unisharp/laravel-ckeditor/ckeditor.js') }}"></script>
  <script>
      CKEDITOR.replace( 'article-ckeditor' );
  </script>

  <script type="text/javascript">
  $(document).ready(function(){
      
$( ".test" ).on( "click", function() {
  
});
$( ".test" ).trigger( "click" );

});

  </script>
    
@endsection