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
   
  

  <!--  -->

            
                
                <div class="col-lg-12">
                  <div class="cardwrap bgcolor--white bradius--noborder   bshadow--1 padding--small margin--small-top-bottom">
                    <div class="tabs--wrapper">
                      <div class="clearfix"></div>
                      <ul class="tabs">
                        <li>عنا</li>
                        <li>الرؤية</li>
                        <li>الأهداف</li>
                      </ul>
                      <ul class="tab__content">
                        <li class="tab__content_item active">
                          <div class="col-lg-12">     
         <form action="{{ route('about.update') }}" method="POST">
        {{ csrf_field() }}
        {{ method_field('PATCH') }}

       
          <div class="col-lg-12">
            <div class="main-title-conts">
                              <div class="caption">
                                <h3>تعريف عن جسر الأمان</h3>
                              </div>
                              <div class="actions">
                              </div><span class="mainseparator bgcolor--main"></span>
                            </div>
        
             <div class="master_field">
                              <label class="master_label mandatory" for="lang_list">اختار اللغة</label>
                              <select class="master_input" id="lang_about" name="lang_about">
                                @foreach($languages as $lang)
                                <option value="{{$lang->id}}">{{$lang->name}}</option>
                                @endforeach
                              </select>
                            </div>
              <div class="actions">
              </div><span class="mainseparator bgcolor--main"></span>

              <textarea name="about" id="article-ckeditor-about" cols="30" rows="10">@if(isset($about->content)){!! $about->content !!}@endif</textarea>

         
          <hr>
        
                    
                          <div class="clearfix"></div>
                        </li>
                        <li class="tab__content_item">
                          <div class="col-lg-12">
                            <div class="main-title-conts">
                              <div class="caption">
                                <h3>الرؤية</h3>
                              </div>
                              <div class="actions">
                              </div><span class="mainseparator bgcolor--main"></span>
                            </div>
                             <div class="master_field">
                              <label class="master_label mandatory" for="lang_list">اختار اللغة</label>
                              <select class="master_input" id="lang_vision" name="lang_vision">
                                @foreach($languages as $lang)
                                <option value="{{$lang->id}}">{{$lang->name}}</option>
                                @endforeach
                              </select>
                            </div>
              <div class="actions">
              </div><span class="mainseparator bgcolor--main"></span>

              <textarea name="vision" id="article-ckeditor-vision" cols="30" rows="10">@if(isset($vision->content)){!! $vision->content !!}@endif</textarea>

         
          <hr>
                         
                          <div class="clearfix"></div>
                        </li>
                        <li class="tab__content_item">
                          <div class="col-lg-12">
                            <div class="main-title-conts">
                              <div class="caption">
                                <h3>الرسالة</h3>
                              </div>
                              <div class="actions">
                              </div><span class="mainseparator bgcolor--main"></span>
                            </div>
                                    <div class="master_field">
                              <label class="master_label mandatory" for="lang_list">اختار اللغة</label>
                              <select class="master_input" id="lang_mission" name="lang_mission">
                                @foreach($languages as $lang)
                                <option value="{{$lang->id}}">{{$lang->name}}</option>
                                @endforeach
                              </select>
                            </div>
              <div class="actions">
              </div><span class="mainseparator bgcolor--main"></span>

              <textarea name="mission" id="article-ckeditor-mission" cols="30" rows="10">@if(isset($mission->content)){!! $mission->content !!}@endif</textarea>
     
         
          <hr>
          <div class="clearfix"></div>
                        </li>
                      </ul>
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
                </div>
           

</div>

  <!--  -->

  <script src="{{url('vendor/unisharp/laravel-ckeditor/ckeditor.js')}}"></script>
  <script>
     $(document).ready(function(){
      CKEDITOR.replace( 'article-ckeditor-about' );
      CKEDITOR.replace( 'article-ckeditor-vision' );
      CKEDITOR.replace( 'article-ckeditor-mission' );
            });
  </script>
@endsection