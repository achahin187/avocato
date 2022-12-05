@extends('layout.app')

@section('content')
<div class="row">
    <div class="col-lg-12" id="dontPrint">
      <div class="cover-inside-container margin--small-top-bottom bradius--small bshadow--1" style="background:  {{ asset('img/covers/dummy2.jpg') }} no-repeat center center; background-size:cover;">
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
            <div class="cover--actions" id="dontPrint">
                <a id="printNow" class="color--gray_d bordercolor--gray_d bradius--small border-btn master-btn" type="button" href="#">طباعة </a>
            </div>
        </div>
      </div>
    </div>
      <style>
        .page {
            width: 21cm;
            min-height: 29.7cm;
            margin: 1cm auto;
            border-radius: 5px;
            background: white;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        }
        .subpage {
/*                        padding: 1cm;*/
/*                        border: 5px red solid;*/
            height: 256mm;
        }
          .card{
              border: 1px #eee dashed;
              padding: 0.5cm;
          }

        
        @media print {
            /* on print, don't show cover. */
            #dontPrint, .fa, .footer--1 {
                display: none;
            }

            #book {
                display: block;
            }
            .page {
                margin: 0;
                border: initial;
                border-radius: initial;
                width: initial;
                min-height: initial;
                box-shadow: initial;
                background: initial;
                page-break-after: always;
            }
        }
      </style>
    <div class="col-lg-12">
      {{-- <div class="cardwrap bgcolor--white bradius--noborder   bshadow--1 padding--small margin--small-top-bottom"> --}}
        <div class="clearfix"></div>
            <div class="book" id="book">
                <div class="page">
                    <div class="subpage">
                        @if(isset($users) && !empty($users)) 
                            @foreach ($users as $user)
                                <div class="col-md-6 col-sm-6 col-xs-6 card">
                                    <div class="row"><b class="col-xs-5">اسم العميل </b>
                                      <div class="col-xs-7">{{ $user->full_name }}</div>
                                    </div>
                                    <div class="row"><b class="col-xs-5">كود العميل </b>
                                      <div class="col-xs-7">{{ $user->code }}</div>
                                    </div>
                                    <div class="row"><b class="col-xs-5">كلمة المرور </b>
                                      <div class="col-xs-7">{{ $user->client_password ? $user->client_password->password : '' }}</div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>   
                </div>
                
              
            </div>
          
        <div class="clearfix"></div>
      </div>
    </div>
  </div>

  <script>

      // print the content of the div
      $("#printNow").click(function() {
          $(".page").show();
          window.print();
      });
  </script>
@endsection