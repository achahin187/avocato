@extends('layout.app')
@section('content')
  <!-- =============== Custom Content ===============-->
  <div class="row">
                <div class="col-lg-12">
                  <div class="cover-inside-container margin--small-top-bottom bradius--small bshadow--1" style="background:  url( '../img/covers/dummy2.jpg ' ) no-repeat center center; background-size:cover">
                    <div class="edit-mode">Editing mode</div>
                    <div class="row">
                      <div class="col-xs-12">
                        <div class="text-xs-center">
                          <div class="text-wraper">
                            <h4 class="cover-inside-title color--gray_d">البيانات الأساسية <i class="fa fa-chevron-circle-right"></i>
                              <h4 class="cover-inside-title color--gray_d">اتصل بنا </h4>
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
                @if ( Session::has('success') )
                      <div class="alert alert-success text-center">{{ Session::get('success') }}</div>
                  @endif
              
                  @if ( Session::has('error') )
                      <div class="alert alert-warning text-center">{{ Session::get('error') }}</div>
                  @endif
                  <div class="cardwrap bgcolor--white bradius--noborder   bshadow--1 padding--small margin--small-top-bottom">
                    <div class="row">
                      <div class="col-xs-12">
                        <div class="main-title-conts">
                          <div class="caption">
                            <h3>بيانات الفرع</h3>
                          </div>
                          <div class="actions">
                          </div><span class="mainseparator bgcolor--main"></span>
                        </div>
                      </div>
                      <form  action="{{ route('contactus_create') }}" method="post" enctype="multipart/form-data" accept-charset="utf-8">
                    {{ csrf_field() }}
                      <div class="col-md-4 col-sm-12" id="right">
                        <div class="col-md-10 col-xs-12">
                          <div class="master_field">
                            <label class="master_label mandatory" for="lang_list">اختار اللغة</label>
                            <select class="master_input" id="lang_list" name="lang_id"> 
                            <option id="lang_2"  class="lang_option" VALUE="2" data-selected="2">English</option>
                            <option id="lang_1" class="lang_option"  value="1" data-selected="1">العربية</option>
                            <option id="lang_3"  class="lang_option" value="3" data-selected="3">French</option>
                          </select>
                          </div>
                        </div>
                        <div class="col-md-10 col-xs-10 has-add">
                          <div class="master_field">
                            <label class="master_label mandatory" for="branch_name">اسم الفرع</label>
                            <input class="master_input" type="text" placeholder="اسم الفرع..." id="branch_name"  name="name" required>
                            <span class="master_message color--fadegreen">message</span>
                          </div>
                        </div>
                        <div class="has-add">
                          <div class="col-md-10 col-xs-10 has-add">
                            <div class="master_field">
                              <label class="master_label mandatory" for="email1">الايميل</label>
                              <input class="master_input" type="email" placeholder="الايميل..." id="email1"  name="email[0]" required>
                              <span class="master_message color--fadegreen">message</span>
                            </div>
                            <div id="more_email"></div>
                          </div>
                          <div class="col-md-2 col-xs-2">
                            <a class="input-btn" id="add_email"><i class="fa fa-plus-circle"></i></a>
                          </div>
                        </div>
                        <div class="has-add">
                          <div class="col-md-10 col-xs-10">
                          <div class="col-xs-3">
                            <select name="code[0]" class="master_input select2" id="tele_code"  style="width:100%;">
                            @foreach($codes as $code)
                          
                            <option value="{{$code['tele_code']}}">{{$code['tele_code']}}</option>
                            
                            @endforeach
                            </select>
                            </div>
                            <div class="master_field col-xs-7">
                              <label class="master_label mandatory" for="tel1">التليفون</label>
                              <input class="master_input" type="number" placeholder="التليفون..." id="tel1" value="value" name="mobile[0]" required>
                              <span class="master_message color--fadegreen">message</span>
                            </div>
                            <div id="more_tel"></div>
                          </div>
                          <div class="col-md-2 col-xs-2">
                            <a class="input-btn" id="add_tel"><i class="fa fa-plus-circle"></i></a>
                          </div>
                        </div>
                        <div class="col-md-10 col-xs-12"><br>
                          <div class="funkyradio">
                            <input type="checkbox" name="is_main" id="main_branch" value="1">
                            <label for="main_branch">الفرع الرئيسي</label>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-8 col-sm-12">
                        <!-- <div class="col-md-6 col-xs-12">
                          <div class="master_field">
                            <label class="master_label mandatory" for="address">العنوان</label>
                            <input class="master_input" type="text" placeholder="العنوان..." id="address" value="value" name="address">
                            <span class="master_message color--fadegreen">message</span>
                          </div>
                        </div> -->
                        <div class="col-md-6 col-xs-12">
                          <div class="master_field">
                            <label class="master_label" for="address">الموقع</label>
                            <input class="master_input" type="text" placeholder="اختر الموقع من الخريطة..." id="pac-input" name="address" required>
                           
                          </div>
                        </div><br>
                        <div class="col-xs-12">
                        <div id="map" style="width: 100%; height: 400px !important;"></div>
                        <input class="master_input" type="text"  id="lng" name="longitude" hidden>
                        <input class="master_input" type="text"  id="lat" name="latitude" hidden>
                        <!-- <img class="img-responsive" id="left" src="../img/map2.jpg"> -->
                        </div>
                      </div>
                      
                    </div>
                    <div class="clearfix"></div><br>
                    <div class="col-md-2 col-xs-6">
                      <button class="master-btn undefined btn-block color--white bgcolor--fadepurple bradius--small bshadow--0" type="submit"><i class="fa fa-save"></i><span>حفظ</span>
                      </button>
                    </div>
                    <div class="col-md-2 col-xs-6">
                      <button class="master-btn undefined btn-block color--white bgcolor--fadebrown bradius--small bshadow--0" ><i class="fa fa-times"></i><span>الغاء</span>
                      </button>
                    </div>
                    </form>
                    <div class="clearfix"></div>
                  </div>
                </div>
              </div>
              <!-- =============== PAGE VENDOR Triggers ===============-->
@endsection
@section('js')
<!-- <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCknR0jhKTIB33f2CLFhBzgp0mj2Tn2q5k&libraries=places"></script> -->
<script type="text/javascript">
      var i=0;
      var j=0;
      $("#add_email").click(function(){
        i+=1;
        $("#more_email").append(`
            <input class="master_input" type="email" placeholder="الايميل..." id="email`+i+`" name="email[`+i+`]"><span class="master_message color--fadegreen">message</span>
        `);
      });
      
      $("#add_tel").click(function(){
        j+=1;
        $("#more_tel").append(`
                           <div class="col-md-3">
                            <select name="code[`+j+`]" class="master_input select2" id="tele_code"  style="width:100%;">
                            @foreach($codes as $code)
                          
                            <option value="{{$code['tele_code']}}">{{$code['tele_code']}}</option>
                            
                            @endforeach
                            </select>
                            </div> <input class="master_input" type="number" placeholder="تليفون..." id="tel`+j+`"  name="mobile[`+j+`]"><span class="master_message color--fadegreen">message</span>
        `);
      });
      
      $("#add_branch").click(function(){
        i+=1;
        $("#branches").append(`
            <input class="master_input" type="email" placeholder="الايميل..." id="email`+x+`_`+i+`" ><span class="master_message color--fadegreen">message</span>
        `);
      });
    </script>
  <!-- <script>
/* script */
function initialize() {
   var latlng = new google.maps.LatLng(28.5355161,77.39102649999995);
    var map = new google.maps.Map(document.getElementById('map'), {
      center: latlng,
      zoom: 13
    });
    var marker = new google.maps.Marker({
      map: map,
      position: latlng,
      draggable: true,
      anchorPoint: new google.maps.Point(0, -29)
   });
    var input = document.getElementById('address');
    map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);
    var geocoder = new google.maps.Geocoder();
    var autocomplete = new google.maps.places.Autocomplete(input);
    autocomplete.bindTo('bounds', map);
    var infowindow = new google.maps.InfoWindow();   
    autocomplete.addListener('place_changed', function() {
        infowindow.close();
        marker.setVisible(false);
        var place = autocomplete.getPlace();
        if (!place.geometry) {
            window.alert("Autocomplete's returned place contains no geometry");
            return;
        }
  
        // If the place has a geometry, then present it on a map.
        if (place.geometry.viewport) {
            map.fitBounds(place.geometry.viewport);
        } else {
            map.setCenter(place.geometry.location);
            map.setZoom(17);
        }
       
        marker.setPosition(place.geometry.location);
        marker.setVisible(true);          
    
        bindDataToForm(place.formatted_address,place.geometry.location.lat(),place.geometry.location.lng());
        infowindow.setContent(place.formatted_address);
        infowindow.open(, marker);
       
    });
    // this function will work on marker move event into map 
    google.maps.event.addListener(marker, 'dragend', function() {
        geocoder.geocode({'latLng': marker.getPosition()}, function(results, status) {
        if (status == google.maps.GeocoderStatus.OK) {
          if (results[0]) {        
              bindDataToForm(results[0].formatted_address,marker.getPosition().lat(),marker.getPosition().lng());
              infowindow.setContent(results[0].formatted_address);
              infowindow.open(map, marker);
          }
        }
        });
    });
}
function bindDataToForm(address,lat,lng){
   document.getElementById('address').value = address;
   document.getElementById('latitude').value = lat;
   document.getElementById('longtiude').value = lng;
}
google.maps.event.addDomListener(window, 'load', initialize);
</script> -->
@endsection