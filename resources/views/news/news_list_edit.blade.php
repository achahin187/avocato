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
                <h4 class="cover-inside-title color--gray_d">الاخبار</h4>
              </div>
            </div>
          </div>
          <div class="cover--actions">
          </div>
        </div>
      </div>
    </div>

    <form action="{{ route('news.update', ['id' => $news->id]) }}" method="POST" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="col-lg-12">
          <div class="cardwrap bgcolor--white bradius--noborder   bshadow--1 padding--small margin--small-top-bottom">
            <div class="col-xs-12">

            {{--  Start Name  --}}
              <div class="col-md-6 col-xs-12">
                <div class="master_field">
                  <label class="master_label mandatory" for="ID_No">عنوان الخبر</label>
                  <input name="newsName" class="master_input" type="text" placeholder="عنوان الخبر ..." id="ID_No" value="{{ $news->name }}">
                    
                    @if ($errors->has('newsName'))
                      <span class="master_message color--fadegreen">{{ $errors->first('newsName') }}</span>
                    @endif
                    
                </div>
              </div>
            {{--  End Name  --}}

            {{--  Start Image  --}}
              <div class="col-md-4 col-xs-8">
                <div class="master_field">
                  <label class="master_label mandatory" for="newsImg">صورة الخبر </label>
                  <div class="file-upload">
                    <div class="file-select">
                      <div class="file-select-name" id="noFile">اضغط لرفع الصورة الرئيسية للخبر</div>
                      <input class="chooseFile" type="file" name="newsImg" id="ID_No">
                    </div>
                  </div>
                    
                    @if ($errors->has('newsImg'))
                      <span class="master_message color--fadegreen">{{ $errors->first('newsImg') }}</span>
                    @endif
                    
                </div>
              </div>
            {{--  End Image  --}}

              {{--  Start Activate  --}}
              <div class="col-md-2 col-xs-4">
                <div class="master_field">
                  <label class="master_label" for="sitch_1">تفعيل </label>
                  <input class="" type="checkbox"  data-on-text="نعم" data-off-text="لا" value="1" name="activate">
                    
                    @if ($errors->has('activate'))
                      <span class="master_message color--fadegreen">{{ $errors->first('activate') }}</span>
                    @endif
                    
                </div>
              </div>
              {{--  End Activate  --}}

            {{--  Start Content  --}}
              <div class="col-xs-12">
                <div class="main-title-conts">
                  <div class="caption">
                    <h3>تفاصيل الخبر</h3>
                  </div>
                  <div class="actions">
                  </div><span class="mainseparator bgcolor--main"></span>
                </div>
                <textarea name="newsContent" id="article-ckeditor" cols="30" rows="10">{!! $news->body !!}</textarea>
                    @if ($errors->has('newsContent'))
                      <span class="master_message color--fadegreen">{{ $errors->first('newsContent') }}</span>
                    @endif
              </div>
            {{--  End Content  --}}

            </div>
            <div class="clearfix"></div>
            <hr>
            <div class="col-md-2 col-xs-6">
              <button class="master-btn undefined btn-block color--white bgcolor--fadepurple bradius--small bshadow--0" type="submit"><i class="fa fa-save"></i><span>حفظ</span>
              </button>
            </div>
            <div class="col-md-2 col-xs-6">
              <a href="{{ route('news_list') }}" class="master-btn undefined btn-block color--white bgcolor--fadebrown bradius--small bshadow--0"><i class="fa fa-times"></i><span>الغاء</span>
              </a>
            </div>
            <div class="clearfix"></div><br>
          </div>
        </div>
      </form>
    </div>
            
  <script src="{{ url('/vendor/unisharp/laravel-ckeditor/ckeditor.js') }}"></script>
  <script>
      CKEDITOR.replace( 'article-ckeditor' );
  </script>

 @endsection