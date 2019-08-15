@extends('layout.app')
@section('content')

<div class="row">
  <div class="col-lg-12">
    <div class="coverglobal text-center bshadow--2" style="background:#000 url( '{{asset('img/covers/dummy2.jpg')}}') no-repeat center center; background-size:cover;"><span></span>
      <div class="container">
        <div class="row">

                  @if(\session('success'))
                  <div class="alert alert-success">
                  {{\session('success')}}
                  </div>
                  @endif
          <div class="col-xs-12">
            <div class="text-xs-center"><a href=""><img class="coverglobal__avatar" src="{{asset($user->image ? $user->image : '')}}">
              <h3 class="coverglobal__title color--gray_d">{{$user->full_name}}</h3><small class="coverglobal__slogan color--gray_d">{{$user->is_active ? 'مفعل':'غير مفعل'}}</small></a></div>
              <div class="coverglobal__actions">
                <a class="color--gray_d bordercolor-gray_d bradius--small border-btn master-btn" type="button" href="{{route('ind.edit',$user->id)}}">تعديل بيانات العميل</a>
                <a class="color--gray_d bordercolor-gray_d bradius--small border-btn master-btn" type="button" href="{{route('ind.com.edit', ['id'=>$user->id])}}">التحويل لعميل أفراد-شركات</a>
                <a class="color--gray_d bordercolor-gray_d bradius--small border-btn master-btn" type="button" href="{{ route('printUsers', $user->id) }}">كارت العميل</a>
                <a class="color--gray_d bordercolor-gray_d bradius--small border-btn master-btn" type="button" href="#" data-id="{{ $user->id }}" id="deleteRecord">استبعاد العميل</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-12">
      <div class="cardwrap bgcolor--white bradius--noborder   bshadow--1 padding--small margin--small-top-bottom">
        <div class="col-md-6 col-sm-6 col-xs-6">
          <div class="row"><b class="col-xs-4">كود العميل </b>
            <div class="col-xs-8">{{$user->code}}</div>
          </div>
          <div class="row"><b class="col-xs-4">الرقم القومى </b>
            <div class="col-xs-8">{{$user->user_detail->national_id}}</div>
          </div>
          <div class="row"><b class="col-xs-4">الهاتف </b>
            <div class="col-xs-8">{{$user->phone}}</div>
          </div>
          <div class="row"><b class="col-xs-4">جوال </b>
            <div class="col-xs-8">{{$user->mobile}}</div>
          </div>
        </div>
        <div class="col-md-6 col-sm-6 col-xs-6">
          <div class="row"><b class="col-xs-4">عنوان العميل</b>
            <div class="col-xs-8">{{$user->address}}</div>
          </div>
          <div class="row"><b class="col-xs-4">البريد الالكترونى </b>
            <div class="col-xs-8"> <span>{{$user->email}}</span></div>
          </div>
          <div class="row"><b class="col-xs-4">تاريخ الميلاد </b>
            <div class="col-xs-8">{{$user->birthdate}}</div>
          </div>
        </div>
        <div class="clearfix"></div>
      </div>
    </div>
 

    <script>
      $(document).ready(function() {

        // delete a row
        $('#deleteRecord').click(function(){
          
          var id = $(this).data("id");

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
                  $.ajax(
                  {
                      url: "{{ url('/individuals/destroy') }}" +"/"+ id,
                      type: 'GET',
                      dataType: "JSON",
                      data: {
                          "id": id,
                          "_method": 'GET',
                      },
                      success: function ()
                      {
                          swal("تم الحذف!", "تم الحذف بنجاح", "success");
                          $('tr[data-user='+id+']').fadeOut();
                          location.href = "{{ route('ind') }}";
                      }
                  });
              
            } else {
              swal("تم الإلغاء", "المعلومات مازالت موجودة :)", "error");
            }
          });
        });

      });
    </script>
    
    @endsection