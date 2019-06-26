@extends('layout.app')
@section('content')
<script>
  $(document).ready(function(){
            $("select[name='mains[]']").change(function () {
              var main_id = $("select[name='mains[]']").val();
              if (main_id !== '' && main_id !== null) {
                $("select[name='subs[]']").prop('disabled',
                  false).find('option[value]').remove();
                $.ajax({
                  type: 'GET',
        url: '{{route('formulas_get_subs')}}', // do not forget to register your route
        data: {ids: main_id},
        }).done(function (data) {
          $.each(data, function (key, value) {
            $("select[name='subs[]']")
            .append($("<option></option>")
              .attr("value", key)
              .text(value));
          });
        }).fail(function(jqXHR, textStatus){
          console.log(jqXHR);
        });
        } else {
          $("select[name='subs[]']").prop('disabled',
            true).find("option[value]").remove();
        }
        });

        $('.btn-warning-cancel').click(function(){
          var contract_id = $(this).closest('tr').attr('data-contract-id');
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
               url:'{{url('formulas_destroy')}}'+'/'+contract_id,
               data:{_token:_token},
               success:function(data){
                $('tr[data-contract-id='+contract_id+']').fadeOut();
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
            return $(this).closest('tr').attr('data-contract-id');
          }).get();
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
               url:'{{route('formulas_destroy_all')}}',
               data:{ids:selectedIds,_token:_token},
               success:function(data){
                $.each( selectedIds, function( key, value ) {
                  $('tr[data-contract-id='+value+']').fadeOut();
                });
                swal("تم الحذف!", "تم الحذف بنجاح", "success");
               }
            });
            
            } else {
              swal("تم الإلغاء", "المعلومات مازالت موجودة :)", "error");
            }
          });
        });

        $('.excel-btn').click(function(){
         var filter='@if(\session('filter_ids')){{json_encode(\session('filter_ids'))}}@endif';
          var selectedIds = $("input:checkbox:checked").map(function(){
            return $(this).closest('tr').attr('data-contract-id');
          }).get();
          $.ajax({
           type:'GET',
           url:'{{route('formulas_excel')}}',
           data:{ids:selectedIds,filters:filter},
           success:function(response){
                    swal("تمت العملية بنجاح!", "تم استخراج الجدول علي هيئة ملف اكسيل", "success");
                    // var a = document.createElement("a");
                    // a.href = response.file; 
                    // a.download = response.name+'.xlsx';
                    // document.body.appendChild(a);
                    // a.click();
                    // a.remove();
                    location.href = response;
          }
            });
        });

        window.setTimeout(function() {
            $(".alert").fadeTo(500, 0).slideUp(500, function(){
                $(this).remove(); 
            });
        }, 4000);
        
      });
</script>
              <div class="row">
                <div class="col-lg-12">
                  <div class="cover-inside-container margin--small-top-bottom bradius--small bshadow--1" style="background:  url( '{{asset('img/covers/dummy2.jpg')}}' ) no-repeat center center; background-size:cover;">
                    <div class="row">
                      <div class="col-xs-12">
                        <div class="text-xs-center">
                          <div class="text-wraper">
                            <h4 class="cover-inside-title color--gray_d">العقود و الصيغ</h4>
                          </div>
                        </div>
                      </div>
                      <div class="cover--actions"><a class="color--gray_d bordercolor--white bradius--small border-btn master-btn" type="button" href="{{route('formulas_create')}}">اضافة</a>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-lg-12">
                  @if ( Session::has('success') )
                      <div class="alert alert-success text-center">{{ Session::get('success') }}</div>
                  @endif

                  @if ( Session::has('warning') )
                      <div class="alert alert-warning text-center">{{ Session::get('warning') }}</div>
                  @endif
                  
                  <div class="cardwrap bgcolor--white bradius--noborder   bshadow--1 padding--small margin--small-top-bottom">
                    <div class="full-table">
                      <div class="remodal-bg">
                        <div class="remodal" data-remodal-id="filterModal_sponsors" role="dialog" aria-labelledby="modal1Title" aria-describedby="modal1Desc">
                      <form role="form" action="{{route('formulas_filter')}}" method="post" accept-charset="utf-8">
                        {{csrf_field()}}
                          <button class="remodal-close" data-remodal-action="close" aria-label="Close"></button>
                          <div>
                            <h2 id="modal1Title">فلتر</h2>
                            <div class="col-md-6">
                              <div class="master_field">
                                <label class="master_label mandatory" for="main_type"> التصنيف الرئيسي </label>
                                <select name="mains[]" class="master_input select2" id="main_type" multiple="multiple" data-placeholder="نوع الصيغة" style="width:100%;" ,>
                                  @foreach($main_contracts as $main_contract)
                                  <option value="{{$main_contract->id}}">{{$main_contract->name}}</option>
                                  @endforeach
                                </select><span class="master_message color--fadegreen"></span>
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="master_field">
                                <label class="master_label mandatory" for="sec_type"> التصنيف الفرعي </label>
                                <select name="subs[]" class="master_input select2" id="sec_type" multiple="multiple" data-placeholder="نوع الصيغة" style="width:100%;" ,>
                                </select><span class="master_message color--fadegreen"></span>
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="master_field">
                                <label class="master_label mandatory" for="date_from">تاريخ الإضافة من </label>
                                <div class="bootstrap-timepicker">
                                  <input name="date_from" class="datepicker master_input" type="text" placeholder="تاريخ الانشاء" id="date_from">
                                </div><span class="master_message color--fadegreen"></span>
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="master_field">
                                <label class="master_label mandatory" for="date_to">تاريخ الإضافة الى </label>
                                <div class="bootstrap-timepicker">
                                  <input name="date_to" class="datepicker master_input" type="text" placeholder="تاريخ الانشاء" id="date_to">
                                </div><span class="master_message color--fadegreen"></span>
                              </div>
                            </div>
                          </div>
                            <div class="col-md-2 col-xs-8">
          <div class="master_field">
            <label class="master_label" for="sitch_1">اللغه</label>
                  <select name="language" class="master_input select2" id="type" data-placeholder="اللغة" >
                    <option value="" selected>اختر اللغة</option>
                    @foreach($languages as $language)
                    <option value="{{$language->id}}" >{{$language->name}}</option>
                    @endforeach
                  </select>
              
              @if ($errors->has('language'))
                <span class="master_message color--fadegreen">{{ $errors->first('language') }}</span>
              @endif
              
          </div>
                          </div>
                          <div class="clearfix"></div>
                          <button class="remodal-cancel" data-remodal-action="cancel">الغاء</button>
                          <button class="remodal-confirm" type="submit">فلتر</button>
                    </form>
                        </div>
                      </div>
                      <div class="filter__btns"><a class="master-btn bgcolor--main color--white bradius--small" href="#filterModal_sponsors"><i class="fa fa-filter"></i>filters</a></div>
                      <div class="bottomActions__btns"><a class="excel-btn master-btn bradius--small padding--small bgcolor--fadeblue color--white" href="#">استخراج اكسيل</a><a class="master-btn bradius--small padding--small bgcolor--fadebrown color--white btn-warning-cancel-all" href="#">حذف المحدد</a>
                      </div>
                      <table class="table-1" id="dataTableTriggerId_001">
                        <thead>
                          <tr class="bgcolor--gray_mm color--gray_d">
                            <th><span class="cellcontent">&lt;input type=&quot;checkbox&quot; name=&quot;select-all&quot; id=&quot;select-all&quot; /&gt;</span></th>
                            <th><span class="cellcontent">اسم العقد - الصيغة</span></th>
                            <th><span class="cellcontent">التصنيف الرئيسي</span></th>
                            <th><span class="cellcontent">التصنيف الفرعي</span></th>
                            <th><span class="cellcontent">النوع</span></th>
                            <th><span class="cellcontent">تاريخ الانشاء</span></th>
                            <th><span class="cellcontent">الاجراءات</span></th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach($contracts as $contract)
                          <tr data-contract-id="{{$contract->id}}">
                            <td><span class="cellcontent"><input type="checkbox" class="checkboxes input-in-table" /></span></td>
                            <td><span class="cellcontent">{{$contract->name or 'N/A'}}</span></td>
                            <td><span class="cellcontent">{{$contract->sub->parent->name or 'N/A'}}</span></td>
                  
                            <td><span class="cellcontent">{{$contract->sub->name or 'N/A'}}</span></td>
                            <td><span class="cellcontent">@if($contract->is_contract==1)عقد@else صيغه @endif</span></td>
                            <td><span class="cellcontent">{{$contract->created_at}}</span></td>
                            <td><span class="cellcontent"><a href= "{{route('formulas_edit',$contract->id)}}" ,  class= "action-btn bgcolor--fadegreen color--white "><i class = "fa  fa-pencil"></i></a><a href="#"  class= "btn-warning-cancel action-btn bgcolor--fadebrown color--white "><i class = "fa  fa-trash-o"></i></a></span></td>
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

@endsection