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
                              <h4 class="cover-inside-title color--gray_d">محتوى </h4>
                            </h4>
                          </div>
                        </div>
                      </div>
                      <div class="cover--actions"><span></span>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                  <div class="cardwrap bgcolor--white bradius--noborder   bshadow--1 padding--small margin--small-top-bottom">
                    <div class="card--1"><a class="color--main" href="{{route('ind')}}"><img class="img-responsive bradius--noborder  " src="{{asset('img/dynamic/clients-individual.jpg')}}">
                        <h4 class="text-center">الأفراد</h4></a></div>
                  </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                  <div class="cardwrap bgcolor--white bradius--noborder   bshadow--1 padding--small margin--small-top-bottom">
                    <div class="card--1"><a class="color--main" href="{{route('companies')}}"><img class="img-responsive bradius--noborder  " src="{{asset('img/dynamic/clients-company.jpg')}}">
                        <h4 class="text-center">الشركات</h4></a></div>
                  </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                  <div class="cardwrap bgcolor--white bradius--noborder   bshadow--1 padding--small margin--small-top-bottom">
                    <div class="card--1"><a class="color--main" href="{{route('ind.com')}}"><img class="img-responsive bradius--noborder  " src="{{asset('img/dynamic/clients-individual-company.jpg')}}">
                        <h4 class="text-center">افراد - شركات</h4></a></div>
                  </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                  <div class="cardwrap bgcolor--white bradius--noborder   bshadow--1 padding--small margin--small-top-bottom">
                    <div class="card--1"><a class="color--main" href="{{route('mobile')}}"><img class="img-responsive bradius--noborder  " src="{{asset('img/dynamic/clients-mob.jpg')}}">
                        <h4 class="text-center">مشتركين بواسطة الموبايل</h4></a></div>
                  </div>
                </div>
              </div>
            

@endsection