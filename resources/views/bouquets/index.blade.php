@extends('layout.app')
@section('content')
 <!-- =============== Custom Content ===============-->
 <div class="row">
                <div class="col-lg-12">
                  <div class="cover-inside-container margin--small-top-bottom bradius--small bshadow--1" style="background:  url( '../img/covers/dummy2.jpg ' ) no-repeat center center; background-size:cover">
                    <div class="row">
                      <div class="col-xs-12">
                        <div class="text-xs-center">
                          <div class="text-wraper">
                            <h4 class="cover-inside-title color--gray_d">البيانات الأساسية <i class="fa fa-chevron-circle-right"></i>
                              <h4 class="cover-inside-title color--gray_d">تعريف الباقات </h4>
                            </h4>
                          </div>
                        </div>
                      </div>
                      <div class="cover--actions"><a class="color--gray_d bordercolor--white bradius--small border-btn master-btn" type="button" href="{{route('bouquets.add')}}">تعريف باقة جديدة</a>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-lg-12">
                  <div class="cardwrap bgcolor--white bradius--noborder   bshadow--1 padding--small margin--small-top-bottom">
                    <div class="full-table">
                      <div class="remodal-bg"></div>
                      <div class="bottomActions__btns"><a class="btn-warning-cancel-all master-btn bradius--small padding--small bgcolor--fadebrown color--white btn-warning-cancel" href="#">حذف المحدد</a>
                      </div>
                      <div class="quick_filter">
                        <div class="dropdown quickfilter_dropb">
                          <button class="dropdown-toggle color--white bgcolor--main bradius--small bshadow--0" type="button" data-toggle="dropdown" id="quick_Filters_2"><small>اللغات  &nbsp;</small><i class="fa fa-angle-down"></i></button>
                          <div class="dropdown-menu" role="menu" aria-labelledby="quick_Filters_2">
                            <div class="quick-filter-title">
                              <p><b>اختار</b></p>
                            </div>
                            <div class="quick-filter-content">
                              <div class="radiorobo">
                                <input type="radio" id="english">
                                <label for="english">English</label>
                              </div>
                              <div class="radiorobo">
                                <input type="radio" id="english">
                                <label for="english">French</label>
                              </div>
                              <!--.qf-column
                              .qf-column-title
                                |status
                              .qf-column-content
                                a.qf-option(href='#')
                                  label.data-label-round.bgcolor--fadegreen.color--white finished
                                  span.qf-number
                                    |5
                                a.qf-option(href='#')
                                  label.data-label-round.bgcolor--fadebrown.color--white closed
                                  span.qf-number
                                    |5
                                a.qf-option(href='#')
                                  label.data-label-round.bgcolor--fadeblue.color--white canceled
                                  span.qf-number
                                    |5
                              
                                a.qf-option(href='#')
                                  label.data-label-round.bgcolor--fadepurple.color--white canceled
                                  span.qf-number
                                    |50
                              
                                a.qf-option(href='#')
                                  label.data-label-round.bgcolor--fadebrown.color--white canceled
                                  span.qf-number
                                    |5
                              -->
                              <!--.qf-column
                              .qf-column-title
                                |active
                              .qf-column-content
                                a.qf-option(href='#')
                                  i.fa.color--fadegreen.fa-check
                                  span.qf-number
                                    |30
                                a.qf-option(href='#')
                                  i.fa.color--black.fa-times
                                  span.qf-number
                                    |5
                              -->
                              <!--.qf-column
                              .qf-column-title
                                |Est. Time
                              .qf-column-content
                                a.qf-option(href='#')
                                  |20Hr
                                  span.qf-number
                                    |30
                                a.qf-option(href='#')
                                  |30Hr
                                  span.qf-number
                                    |5
                                a.qf-option(href='#')
                                  |9Hr
                                  span.qf-number
                                    |15
                                a.qf-option(href='#')
                                  |27Hr
                                  span.qf-number
                                    |11
                                a.qf-option(href='#')
                                  |20Hr
                                  span.qf-number
                                    |30
                                a.qf-option(href='#')
                                  |30Hr
                                  span.qf-number
                                    |5
                                a.qf-option(href='#')
                                  |9Hr
                                  span.qf-number
                                    |15
                                a.qf-option(href='#')
                                  |27Hr
                                  span.qf-number
                                    |11
                                a.qf-option(href='#')
                                  |20Hr
                                  span.qf-number
                                    |30
                                a.qf-option(href='#')
                                  |30Hr
                                  span.qf-number
                                    |5
                                a.qf-option(href='#')
                                  |9Hr
                                  span.qf-number
                                    |15
                                a.qf-option(href='#')
                                  |27Hr
                                  span.qf-number
                                    |11
                                a.qf-option(href='#')
                                  |20Hr
                                  span.qf-number
                                    |130
                                a.qf-option(href='#')
                                  |30Hr
                                  span.qf-number
                                    |5
                                a.qf-option(href='#')
                                  |9Hr
                                  span.qf-number
                                    |15
                                a.qf-option(href='#')
                                  |27Hr
                                  span.qf-number
                                    |11
                              -->
                            </div>
                          </div>
                        </div>
                      </div>
                      <table class="table-1">
                        <thead>
                          <tr class="bgcolor--gray_mm color--gray_d">
                            <th><span class="cellcontent">&lt;input type=&quot;checkbox&quot; name=&quot;select-all&quot; id=&quot;select-all&quot; /&gt;</span></th>
                            <th><span class="cellcontent">اسم الباقة</span></th>
                            <th><span class="cellcontent">دفع الأقساط</span></th>
                            <th><span class="cellcontent">عدد المشتركين</span></th>
                            <th><span class="cellcontent">الاجراءات</span></th>
                          </tr>
                        </thead>
                        <tbody>
                        @foreach($bouquets as $bouquet)
                          <tr>
                            <td><span class="cellcontent"><input type="checkbox" class="checkboxes" /></span></td>
                            <td><span class="cellcontent">{{$bouquet['name']}} </span></td>
                            <td><span class="cellcontent">سنوي - نصف سنوي</span></td>
                            <td><span class="cellcontent">{{count($bouquet->users)}}</span></td>
                            <td><span class="cellcontent"><a href= "{{route('substitution.view')}}" , title="مشاهدة" ,  class= "action-btn bgcolor--main color--white ">
                            <i class = "fa  fa-eye"></i></a>
                            <a href= "{{route('substitution.edit',$bouquet->id)}}" , title="تعديل" ,  class= "action-btn bgcolor--fadegreen color--white ">
                            <i class = "fa  fa-pencil"></i></a>
                            <a href="#"  class= "btn-warning-cancel action-btn bgcolor--fadebrown color--white "><i class = "fa  fa-trash-o"></i></a></span></td>
                          </tr>
                         @endforeach
                        </tbody>
                      </table>
                      <div class="remodal log-custom" role="dialog" aria-labelledby="modal1Title" aria-describedby="modal1Desc">
                        <button class="remodal-close" data-remodal-action="close" aria-label="Close"></button>
                        <div>
                          <h2 class="title">title of the changing log in</h2>
                          <div class="log-content">
                            <div class="log-container">
                              <table class="log-table">
                                <tr class="log-row" data-link="https://www.google.com.eg/">
                                  <th>log title</th>
                                  <th>user</th>
                                  <th>time</th>
                                </tr>
                                <tr class="log-row" data-link="https://www.google.com.eg/">
                                  <td>January</td>
                                  <td>$100</td>
                                  <td>$100</td>
                                </tr>
                                <tr class="log-row" data-link="https://www.google.com.eg/">
                                  <td>February</td>
                                  <td>$80</td>
                                  <td>$80</td>
                                </tr>
                                <tr class="log-row" data-link="https://www.google.com.eg/">
                                  <td>January</td>
                                  <td>$100</td>
                                  <td>$100</td>
                                </tr>
                                <tr class="log-row" data-link="https://www.google.com.eg/">
                                  <td>February</td>
                                  <td>$80</td>
                                  <td>$80</td>
                                </tr>
                                <tr class="log-row" data-link="https://www.google.com.eg/">
                                  <td>January</td>
                                  <td>$100</td>
                                  <td>$100</td>
                                </tr>
                                <tr class="log-row" data-link="https://www.google.com.eg/">
                                  <td>February</td>
                                  <td>$80</td>
                                  <td>$80</td>
                                </tr>
                                <tr class="log-row" data-link="https://www.google.com.eg/">
                                  <td>January</td>
                                  <td>$100</td>
                                  <td>$100</td>
                                </tr>
                                <tr class="log-row" data-link="https://www.google.com.eg/">
                                  <td>February</td>
                                  <td>$80</td>
                                  <td>$80</td>
                                </tr>
                                <tr class="log-row" data-link="https://www.google.com.eg/">
                                  <td>January</td>
                                  <td>$100</td>
                                  <td>$100</td>
                                </tr>
                                <tr class="log-row" data-link="https://www.google.com.eg/">
                                  <td>February</td>
                                  <td>$80</td>
                                  <td>$80</td>
                                </tr>
                                <tr class="log-row" data-link="https://www.google.com.eg/">
                                  <td>January</td>
                                  <td>$100</td>
                                  <td>$100</td>
                                </tr>
                                <tr class="log-row" data-link="https://www.google.com.eg/">
                                  <td>February</td>
                                  <td>$80</td>
                                  <td>$80</td>
                                </tr>
                                <tr class="log-row" data-link="https://www.google.com.eg/">
                                  <td>January</td>
                                  <td>$100</td>
                                  <td>$100</td>
                                </tr>
                                <tr class="log-row" data-link="https://www.google.com.eg/">
                                  <td>February</td>
                                  <td>$80</td>
                                  <td>$80</td>
                                </tr>
                                <tr class="log-row" data-link="https://www.google.com.eg/">
                                  <td>January</td>
                                  <td>$100</td>
                                  <td>$100</td>
                                </tr>
                                <tr class="log-row" data-link="https://www.google.com.eg/">
                                  <td>February</td>
                                  <td>$80</td>
                                  <td>$80</td>
                                </tr>
                                <tr class="log-row" data-link="https://www.google.com.eg/">
                                  <td>January</td>
                                  <td>$100</td>
                                  <td>$100</td>
                                </tr>
                                <tr class="log-row" data-link="https://www.google.com.eg/">
                                  <td>February</td>
                                  <td>$80</td>
                                  <td>$80</td>
                                </tr>
                                <tr class="log-row" data-link="https://www.google.com.eg/">
                                  <td>January</td>
                                  <td>$100</td>
                                  <td>$100</td>
                                </tr>
                                <tr class="log-row" data-link="https://www.google.com.eg/">
                                  <td>February</td>
                                  <td>$80</td>
                                  <td>$80</td>
                                </tr>
                                <tr class="log-row" data-link="https://www.google.com.eg/">
                                  <td>January</td>
                                  <td>$100</td>
                                  <td>$100</td>
                                </tr>
                                <tr class="log-row" data-link="https://www.google.com.eg/">
                                  <td>February</td>
                                  <td>$80</td>
                                  <td>$80</td>
                                </tr>
                                <tr class="log-row" data-link="https://www.google.com.eg/">
                                  <td>January</td>
                                  <td>$100</td>
                                  <td>$100</td>
                                </tr>
                                <tr class="log-row" data-link="https://www.google.com.eg/">
                                  <td>February</td>
                                  <td>$80</td>
                                  <td>$80</td>
                                </tr>
                                <tr class="log-row" data-link="https://www.google.com.eg/">
                                  <td>January</td>
                                  <td>$100</td>
                                  <td>$100</td>
                                </tr>
                                <tr class="log-row" data-link="https://www.google.com.eg/">
                                  <td>February</td>
                                  <td>$80</td>
                                  <td>$80</td>
                                </tr>
                                <tr class="log-row" data-link="https://www.google.com.eg/">
                                  <td>January</td>
                                  <td>$100</td>
                                  <td>$100</td>
                                </tr>
                                <tr class="log-row" data-link="https://www.google.com.eg/">
                                  <td>February</td>
                                  <td>$80</td>
                                  <td>$80</td>
                                </tr>
                              </table>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- =============== PAGE VENDOR Triggers ===============-->
@endsection
@section('js')
<script>
 $('.btn-warning-cancel').click(function(){
          var bouquet_id = $(this).closest('tr').attr('data-bouquet-id');
          var _token = '{{csrf_token()}}';
          swal({
            title: "هل أنت متأكد؟",
            text: "لن تستطيع إسترجاع هذه المعلومة لاحقا",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: '#DD6B55',
            confirmButtonText: 'نعم متأكد!',
            cancelButtonText: "إلغاء",
            closeOnConfirm: false,
            closeOnCancel: false
          },
          function(isConfirm){
            if (isConfirm){
             $.ajax({
               type:'POST',
               url:'{{url('bouquets_delete')}}'+'/'+bouquet_id,
               data:{_token:_token},
               success:function(data){
                $('tr[data-bouquet-id='+bouquet_id+']').fadeOut();
                swal("تم الحذف!", "تم الحذف بنجاح", "success");
               }
            });
              
            } else {
              swal("تم الإلغاء", "المعلومات مازالت موجودة :)", "error");
            }
          });
        });


                $('.btn-warning-cancel-all').click(function(){
          var selectedIds = $("input:checkbox:checked").map(function(){
            return $(this).closest('tr').attr('data-bouquet-id');
          }).get();
          if(selectedIds.length == 0 )
          {
            swal("خطأ", "من فضلك اختر استشاره :)", "error");
          }
          var _token = '{{csrf_token()}}';
          swal({
            title: "هل أنت متأكد؟",
            text: "لن تستطيع إسترجاع هذه المعلومة لاحقا",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: '#DD6B55',
            confirmButtonText: 'نعم متأكد!',
            cancelButtonText: "إلغاء",
            closeOnConfirm: false,
            closeOnCancel: false
          },
          function(isConfirm){
            if (isConfirm){
             $.ajax({
               type:'POST',
               url:'{{route('bouquets.delete_all')}}',
               data:{ids:selectedIds,_token:_token},
               success:function(data){
                $.each( selectedIds, function( key, value ) {
                  $('tr[data-bouquet-id='+value+']').fadeOut();
                });
                swal("تم الحذف!", "تم الحذف بنجاح", "success");
               }
            });
            
            } else {
              swal("تم الإلغاء", "المعلومات مازالت موجودة :)", "error");
            }
          });
        });
</script>
@endsection