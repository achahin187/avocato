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
                <h4 class="cover-inside-title color--gray_d">الشروط و الأحكام</h4>
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
                    <div class="col-xs-12">
                      <h4> الشروط و الأحكام</h4>
                    </div>
                    <div class="col-lg-12">
                      {!!$terms->content!!}
                    </div>
                    <div class="clearfix"></div>
                  </div>
                </div>
              </div>

              @endsection