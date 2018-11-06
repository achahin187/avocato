 @extends('layout.app')             
 @section('content')
<div class="row">
  <div class="col-lg-12">
    <div class="cover-inside-container margin--small-top-bottom bradius--small bshadow--1" style="background:  url({{ asset('/img/covers/dummy2.jpg ') }}) no-repeat center center; background-size:cover;">
      <div class="add-mode">Adding mode</div>
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

{{-- Start alert messages --}}
    <div class="col-lg-12">
      @if (Session::has('success'))
        <div class="alert alert-success text-center">{{ Session::get('success') }}</div>
      @endif

      @if (Session::has('warning'))
        <div class="alert alert-warning text-center">{{ Session::get('warning') }}</div>
      @endif
    </div>
    {{-- End alert --}}

  <form action="{{ route('news.store') }}" method="POST" enctype="multipart/form-data">
    {{ csrf_field() }}
  <div class="col-lg-12">
    <div class="cardwrap bgcolor--white bradius--noborder   bshadow--1 padding--small margin--small-top-bottom">
      <div class="col-xs-12">

      {{--  Start Name  --}}
        <div class="col-md-6 col-xs-12">
          <div class="master_field">
            <label class="master_label mandatory" for="ID_No">عنوان الخبر</label>
            <input name="newsName" class="master_input" type="text" placeholder="عنوان الخبر ..." id="ID_No" value="{{ old('newsName') }}">
              
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
            <input id="box" type="checkbox" checked data-on-text="نعم" data-off-text="لا" value="1" name="activate">
              
              @if ($errors->has('activate'))
                <span class="master_message color--fadegreen">{{ $errors->first('activate') }}</span>
              @endif
              
          </div>
        </div>
        {{--  End Activate  --}}

                <div class="col-md-2 col-xs-4">
          <div class="master_field">
            <label class="master_label" for="sitch_1">اللغه</label>
                  <select name="language" class="master_input select2" id="type" data-placeholder="اللغع" style="width:100%;" ,>
                    @foreach($languages as $language)
                    <option value="{{$language->id}}" >{{$language->name}}</option>
                    @endforeach
                  </select>
              
              @if ($errors->has('language'))
                <span class="master_message color--fadegreen">{{ $errors->first('language') }}</span>
              @endif
              
          </div>
        </div>

      {{--  Start Content  --}}
        <div class="col-xs-12">
          <div class="main-title-conts">
            <div class="caption">
              <h3>تفاصيل الخبر</h3>
            </div>
            <div class="actions">
            </div><span class="mainseparator bgcolor--main"></span>
          </div>
          <textarea name="newsContent" id="article-ckeditor" cols="30" rows="10">{!! old('newsContent') !!}</textarea>
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
        <button id="reset" class="master-btn undefined btn-block color--white bgcolor--fadebrown bradius--small bshadow--0" type="reset"><i class="fa fa-times"></i><span>الغاء</span>
        </button>
      </div>
      <div class="clearfix"></div><br>
    </div>
  </div>
  </form>
</div>

  <script src="{{ url('/vendor/unisharp/laravel-ckeditor/ckeditor.js') }}"></script>
  <script>
      CKEDITOR.replace( 'article-ckeditor' );

      $('#reset').click(function() {
        $('#box').attr('checked', false);
        CKEDITOR.instances['article-ckeditor'].setData('');
      });
  </script>

 @endsection