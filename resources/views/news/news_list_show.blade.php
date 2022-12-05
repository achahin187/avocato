 @extends('layout.app')             
 @section('content')

<div class="row">
  <div class="col-lg-12">
    <div class="cardwrap bgcolor--white bradius--noborder   bshadow--1 padding--small margin--small-top-bottom">
      <div class="main-title-conts">
        <div class="caption">
          <h3>{{ $news->name }}</h3>
        </div>
        <div class="actions">
          <a class="color--white bgcolor--fadeorange bradius--small bshadow--0 master-btn" type="button" href=""> بتاريخ {{ $news->created_at->format('Y-m-d') }}</a>
        </div><span class="mainseparator bgcolor--main"></span>
      </div>
      <div class="col-lg-12"><img src="{{ asset($news->photo) }}" alt="لا توجد صورة لهذا الخبر"><br><br>
        <p>
          {!! $news->body !!}
        </p>
        <div class="clearfix"></div>
        <div class="col-md-2 col-xs-6">
          <a href="{{ route('news.edit', ['id' => $news->id]) }}" class="master-btn undefined btn-block color--white bgcolor--fadegreen bradius--small bshadow--0"><i class="fa fa-edit"></i><span>تعديل</span>
          </a>
        </div>
        <div class="col-md-2 col-xs-6">
          <a class="master-btn undefined btn-block color--white bgcolor--fadebrown bradius--small bshadow--0 deleteRecord" data-id="{{ $news->id }}"><i class="fa fa-times"></i><span>حذف</span>
          </a>
          <div class="clearfix"></div>
        </div>
      </div>
      <div class="clearfix"></div>
    </div>
  </div>
</div>
                      
<script>
  $(document).ready(function() {
    // delete a row
      $('.deleteRecord').click(function(){
        
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
                    url: "{{ url('/news_list/destroy') }}" +"/"+ id,
                    type: 'GET',
                    dataType: "JSON",
                    data: {
                        "id": id,
                        "_method": 'GET',
                    },
                    success: function ()
                    {
                        swal("تم الحذف!", "تم الحذف بنجاح", "success");
                        window.location.href = '{{ route('news_list') }}';
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