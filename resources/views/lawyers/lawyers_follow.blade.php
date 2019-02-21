@extends('layout.app')
@section('content')


<!-- <script async defer
src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAlXHCCfSGKzPquzvLKcFB37DBoPudNqgU&callback=initMap&language=ar">
</script> -->
              <div class="row">
                <div class="col-lg-12">
                  <div class="cover-inside-container margin--small-top-bottom bradius--small bshadow--1" style="background:  url( '{{asset('img/covers/dummy2.jpg')}}' ) no-repeat center center; background-size:cover;">
                    <div class="row">
                      <div class="col-xs-12">
                        <div class="text-xs-center">
                          <div class="text-wraper">
                            <h4 class="cover-inside-title color--gray_d">السادة المحامين</h4>
                          </div>
                        </div>
                      </div>
                      <div class="cover--actions"><span></span>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-lg-12">
                  <div class="cardwrap bgcolor--white bradius--noborder   bshadow--1 padding--small margin--small-top-bottom">
                    <div class="main-title-conts">
                      <div class="caption">
                        <h3> متابعة أماكن السادة المحامين</h3>
                      </div>
                      <div class="actions"><a class="color--white bgcolor--fadeorange bradius--small bshadow--0 master-btn" type="button" href="">{{date('Y - m - d  H:i:s')}}</a>
                      </div><span class="mainseparator bgcolor--main"></span>
                    </div>
                    <div class="cardwrap bgcolor--white bradius--noborder   bshadow--1 padding--small margin--small-top-bottom"> 
                    <div id="map_subscribtion" hidden style="font-color:red;"> لقد تم انتهاء اشتراكك فى خرائط جوجل برجاء تجديد الاشتراك</div>
                    <div id="map" style="height: 140px;width:1140px;"></div>
                      <hr>
                      <div class="main-title-conts">
                        <div class="caption">
                          <h3>التفاصيل</h3>
                        </div>
                        <div class="actions">
                        </div><span class="mainseparator bgcolor--main"></span>
                      </div>
                      <div class="full-table">
                        <div class="remodal-bg">
                          <div class="remodal" data-remodal-id="filterModal_sponsors" role="dialog" aria-labelledby="modal1Title" aria-describedby="modal1Desc">
                            <button class="remodal-close" data-remodal-action="close" aria-label="Close"></button>
                            <div>
                              <h2 id="modal1Title">فلتر</h2>
                              <div class="col-md-6">
                                <div class="master_field">
                                  <label class="master_label mandatory" for="ID_No">كود المحامى</label>
                                  <input class="master_input" type="number" placeholder="كود المحامى" id="ID_No"><span class="master_message color--fadegreen">message</span>
                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="master_field">
                                  <label class="master_label mandatory" for="ID_No">اسم المحامى</label>
                                  <input class="master_input" type="text" placeholder="اسم المحامى" id="ID_No"><span class="master_message color--fadegreen">message</span>
                                </div>
                              </div>
                            </div>
                            <div class="clearfix"></div>
                            <button class="remodal-cancel" data-remodal-action="cancel">الغاء</button>
                            <button class="remodal-confirm" data-remodal-action="confirm">فلتر</button>
                          </div>
                        </div>
                        <table class="table-1">
                          <thead>
                            <tr class="bgcolor--gray_mm color--gray_d">
                              <th><span class="cellcontent">كود المحامي</span></th>
                              <th><span class="cellcontent">الاسم</span></th>
                              <th><span class="cellcontent">هاتف</span></th>
                              <th><span class="cellcontent">تفعيل</span></th>
                              <th><span class="cellcontent">المكان الحالي</span></th>
                              <th><span class="cellcontent">الاجراءات</span></th>
                            </tr>
                          </thead>
                          <tbody>
                            @foreach($lawyers as $lawyer)
                            <tr data-lawyer-id="{{$lawyer->id}}">
                              <td><span class="cellcontent">{{$lawyer->code}}</span></td>
                              <td><span class="cellcontent">{{$lawyer->full_name}}</span></td>
                              <td><span class="cellcontent">{{$lawyer->phone}}</span></td>
                              <td><span class="cellcontent">@if($lawyer->is_active)<i class = "fa color--fadegreen fa-check"></i> @else <i class = "fa color--fadebrown fa-times"></i>@endif</span></td>
                              <td><span class="cellcontent location"></span></td>
                              <td><span class="cellcontent"><a href= "{{route('lawyers_show',$lawyer->id)}}" ,  class= "action-btn bgcolor--main color--white "><i class = "fa  fa-eye"></i></a></span></td>
                            </tr>
                            @endforeach
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
@endsection

@section('js')
<script>

function initMap() {
  var giza = {lat: 30.042701, lng: 31.432662};
          map = new google.maps.Map(document.getElementById('map'), {
            center: giza,
            zoom: 11,
            mapTypeId: 'roadmap',
            mapTypeControlOptions: {style: google.maps.MapTypeControlStyle.DROPDOWN_MENU}
          })

//  @foreach($lawyers as $lawyer)
//   var geocoder = new google.maps.Geocoder;
//   @if($lawyer->latitude == null )
  
//     $('tr[data-lawyer-id="{{$lawyer->id}}"].location').text('لا يوجد مكان محالى');
  
//   @else
//     geocoder.geocode({'location': new google.maps.LatLng("{{$lawyer->latitude}}","{{$lawyer->longtuide}}")}, function(results, status) {
// $('tr[data-lawyer-id="{{$lawyer->id}}"].location').text(results.formatted_address);
// });
  
//   @endif

// @endforeach



  var uluru = [];
  @foreach($lawyers as $lawyer)
  var geocoder = new google.maps.Geocoder;
  
  geocoder.geocode({'location': new google.maps.LatLng("{{$lawyer->latitude}}","{{$lawyer->longtuide}}")}, function(results, status) {
    if (status == 'OK') {
      if (results[0]) {
$('tr[data-lawyer-id="{{$lawyer->id}}"].location').text(results[0].formatted_address);
      }
      else {
        window.alert('No results found');
      }
    }
    else {
      if(status == 'OVER_QUERY_LIMIT')
      {
        $('#map_subscribtion').show();
      }
      // window.alert('Geocoder failed due to: ' + status);
    }
});
@if($lawyer->latitude != null )
 uluru.push({latlng: new google.maps.LatLng({{$lawyer->latitude}},{{$lawyer->longtuide}})});
  
  var map = new google.maps.Map(document.getElementById('map'), {
    zoom: 10,
    center: new google.maps.LatLng({{$lawyer->latitude}},{{$lawyer->longtuide}})
  });
@endif
  // var marker = new google.maps.Marker({
  //   position: new google.maps.LatLng({{$lawyer->latitude}},{{$lawyer->longtuide}}),
  //   map: map
  // });

 

@endforeach
  // @foreach($lawyers as $lawyer)
  // @if($lawyer->latitude != null )
  // var marker = new google.maps.Marker({
  //   position: uluru[i].latlng,
  //   map: map
  // });
  // i++;
  // @endif
  // @endforeach

  var infowindow = new google.maps.InfoWindow({});

var marker, i;

for (i = 0; i < uluru.length; i++) {
  marker = new google.maps.Marker({
    position: uluru[i].latlng,
    map: map
  });

  google.maps.event.addListener(marker, 'click', (function (marker, i) {
    return function () {
      infowindow.setContent(locations[i][0]);
      infowindow.open(map, marker);
    }
  })(marker, i));
}


}





</script>
@endsection