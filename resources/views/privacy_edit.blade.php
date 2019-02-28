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
                              <h4 class="cover-inside-title color--gray_d">الشروط و الأحكام </h4>
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
                  <div class="cardwrap bgcolor--white bradius--noborder   bshadow--1 padding--small margin--small-top-bottom">
                      <form action="{{ route('privacy.update') }}" method="POST">
        {{ csrf_field() }}
        {{ method_field('PATCH') }}

       
          <div class="col-lg-12">
            <div class="main-title-conts">
                              <div class="caption">
                                <h3>سياسة الخصوصية</h3>
                              </div>
                              <div class="actions">
                              </div><span class="mainseparator bgcolor--main"></span>
                            </div>
        
             <div class="master_field">
                              <label class="master_label mandatory" for="lang_list">اختار اللغة</label>
                              <select class="master_input" id="lang_privacy" name="lang_privacy">
                                @foreach($languages as $lang)
                                <option value="{{$lang->id}}" {{($lang->id==2)?'selected':''}}>{{$lang->name}}</option>
                                @endforeach
                              </select>
                            </div>
              <div class="actions">
              </div><span class="mainseparator bgcolor--main"></span>

              <textarea name="privacy" id="editor1" cols="30" rows="10">@if(isset($privacy->content)){!! $privacy->content !!}@endif</textarea>
               <hr>
          <div class="clearfix"></div>
                     <div class="col-md-2 col-xs-6">
            <button class="master-btn undefined btn-block color--white bgcolor--fadepurple bradius--small bshadow--0" type="submit"><i class="fa fa-save"></i><span>حفظ</span>
            </button>
          </div>
          <div class="col-md-2 col-xs-6">
            <a class="master-btn undefined btn-block color--white bgcolor--fadeorange bradius--small bshadow--0" href="{{ route('privacy') }}"><i class="fa fa-times"></i><span>الغاء</span>
            </a>
          </div>
          <div class="clearfix"></div>
        </div>
      </form>
    </div>
  </div>
  <script src="{{url('vendor/unisharp/laravel-ckeditor/ckeditor.js')}}"></script>
  <script>
     $(document).ready(function(){
      CKEDITOR.replace( 'editor1' );
            });
  </script>

  <script type="text/javascript">
    $(document).ready(function(){
$('#lang_privacy').on('change', function (e) {
    var optionSelected = $("option:selected", this);
    var valueSelected = this.value;
    $.ajax({
      type:'GET',
      url:'{{url('privacyAjax')}}'+'/'+valueSelected,
      data:{},
      success:function(data){
        CKEDITOR.instances.editor1.setData(data); 
      },
      error: function(xhr, textStatus, errorThrown){
        alert('error');
      }
    });
  });
});

  </script>

  @endsection