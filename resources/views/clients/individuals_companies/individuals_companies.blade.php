@extends('layout.app')
@section('content')

<div class="row">
  <div class="col-lg-12">
    <div class="cover-inside-container margin--small-top-bottom bradius--small bshadow--1" style="background:  url( '../img/covers/dummy2.jpg ' ) no-repeat center center; background-size:cover;">
      <div class="row">
        <div class="col-xs-12">
          <div class="text-xs-center">
            <div class="text-wraper">
              <h4 class="cover-inside-title color--gray_d">العملاء <i class="fa fa-chevron-circle-right"></i>
                <h4 class="cover-inside-title color--gray_d">محتوى </h4>
                <h3 class="cover-inside-title color--gray_d">افراد - شركات </h3>
              </h4>
            </div>
          </div>
        </div>
        <div class="cover--actions">
          <a class="color--gray_d bordercolor--gray_d bradius--small border-btn master-btn" type="button" href="{{ route('ind.com.create') }}">اضافة عميل أفراد-شركات جديد </a>
        </div>
      </div>
    </div>
  </div>
  <div class="col-lg-12">
    <div class="cardwrap bgcolor--white bradius--noborder   bshadow--1 padding--small margin--small-top-bottom">
      <div class="clearfix"></div>
      <div class="full-table">
        <div class="remodal-bg">
          <div class="remodal" data-remodal-id="filterModal_sponsors" role="dialog" aria-labelledby="modal1Title" aria-describedby="modal1Desc">
            <button class="remodal-close" data-remodal-action="close" aria-label="Close"></button>
            <div>
              <h3 id="modal1Title">فلتر</h3>
              <div class="col-md-6">
                <div class="master_field">
                  <label class="master_label mandatory" for="comp_code">كود الشركة</label>
                  <input class="master_input" type="number" placeholder="كود الشركة" id="comp_code"><span class="master_message color--fadegreen">message</span>
                </div>
              </div>
              <div class="col-md-6">
                <div class="master_field">
                  <label class="master_label mandatory" for="comp_name">اسم الشركة</label>
                  <input class="master_input" type="text" placeholder="اسم الشركة" id="comp_name"><span class="master_message color--fadegreen">message</span>
                </div>
              </div>
              <div class="col-md-6">
                <div class="master_field">
                  <label class="master_label mandatory" for="start_date_from">تاريخ بداية النعاقد من</label>
                  <div class="bootstrap-timepicker">
                    <input class="datepicker master_input" type="text" placeholder="تاريخ بداية النعاقد" id="start_date_from">
                  </div><span class="master_message color--fadegreen">message content</span>
                </div>
              </div>
              <div class="col-md-6">
                <div class="master_field">
                  <label class="master_label mandatory" for="start_date_to">تاريخ بداية النعاقد الى</label>
                  <div class="bootstrap-timepicker">
                    <input class="datepicker master_input" type="text" placeholder="تاريخ بداية النعاقد" id="start_date_to">
                  </div><span class="master_message color--fadegreen">message content</span>
                </div>
              </div>
              <div class="col-md-6">
                <div class="master_field">
                  <label class="master_label mandatory" for="end_date_from">تاريخ نهاية التعاقد من</label>
                  <div class="bootstrap-timepicker">
                    <input class="datepicker master_input" type="text" placeholder="تاريخ نهاية التعاقد" id="end_date_from">
                  </div><span class="master_message color--fadegreen">message content</span>
                </div>
              </div>
              <div class="col-md-6">
                <div class="master_field">
                  <label class="master_label mandatory" for="end_date_to">تاريخ نهاية التعاقد الى</label>
                  <div class="bootstrap-timepicker">
                    <input class="datepicker master_input" type="text" placeholder="تاريخ نهاية التعاقد" id="end_date_to">
                  </div><span class="master_message color--fadegreen">message content</span>
                </div>
              </div>
              <div class="col-md-6">
                <div class="master_field">
                  <label class="master_label mandatory" for="comp_nationality">الجنسية</label>
                  <input class="master_input" type="text" placeholder="الجنسية" id="comp_nationality"><span class="master_message color--fadegreen">message</span>
                </div>
              </div>
              <div class="col-md-6">
                <div class="master_field">
                  <label class="master_label mandatory">التفعيل</label>
                  <div class="radiorobo">
                    <input type="radio" id="rad_1">
                    <label for="rad_1">الكل</label>
                  </div>
                  <div class="radiorobo">
                    <input type="radio" id="rad_2">
                    <label for="rad_2">المفعلين</label>
                  </div>
                  <div class="radiorobo">
                    <input type="radio" id="rad_3">
                    <label for="rad_3">غير المفعلين</label>
                  </div>
                </div>
              </div>
            </div>
            <div class="clearfix"></div>
            <button class="remodal-cancel" data-remodal-action="cancel">الغاء</button>
            <button class="remodal-confirm" data-remodal-action="confirm">فلتر</button>
          </div>
        </div>
        <div class="filter__btns"><a class="master-btn bgcolor--main color--white bradius--small" href="#filterModal_sponsors"><i class="fa fa-filter"></i>filters</a></div>
        <div class="bottomActions__btns"><a class="master-btn bradius--small padding--small bgcolor--fadeblue color--white" href="#">استخراج اكسيل</a><a class="master-btn bradius--small padding--small bgcolor--fadepurple color--white" href="#">طباعة كارت العميل</a><a class="master-btn bradius--small padding--small bgcolor--fadebrown color--white btn-warning-cancel" href="#">حذف المحدد</a>
        </div>
        <table class="table-1">
          <thead>
            <tr class="bgcolor--gray_mm color--gray_d">
              <th><span class="cellcontent">&lt;input type=&quot;checkbox&quot; name=&quot;select-all&quot; id=&quot;select-all&quot; /&gt;</span></th>
              <th><span class="cellcontent">كودالشركة</span></th>
              <th><span class="cellcontent">اسم الشركة</span></th>
              <th><span class="cellcontent">كودالعميل</span></th>
              <th><span class="cellcontent">اسم العميل</span></th>
              <th><span class="cellcontent">عنوان العميل</span></th>
              <th><span class="cellcontent">هاتف</span></th>
              <th><span class="cellcontent">نوع الباقة</span></th>
              <th><span class="cellcontent">نهاية التعاقد</span></th>
              <th><span class="cellcontent">تفعيل</span></th>
              <th><span class="cellcontent">الإجراءات</span></th>
            </tr>
          </thead>
          <tbody>
            
            @foreach ($ind_coms as $ind_com)
              <tr>
                <td><span class="cellcontent"><input type="checkbox" class="checkboxes" /></span></td>
                <td><span class="cellcontent">{{ $ind_com->companyParent->code }}</span></td>
                <td><span class="cellcontent">{{ $ind_com->companyParent->name }}</span></td>
                <td><span class="cellcontent">{{ $ind_com->code }}</span></td>
                <td><span class="cellcontent">{{ $ind_com->full_name }}</span></td>
                <td><span class="cellcontent">{{ $ind_com->address }}</span></td>
                <td><span class="cellcontent">{{ $ind_com->mobile }}</span></td>
                <td><span class="cellcontent">{{ $ind_com->subscription->package_type->name }}</span></td>
                <td><span class="cellcontent">{{ $ind_com->subscription->end_date->format('d - m - Y') }}</span></td>
                <td><span class="cellcontent"><i class="fa {{ $ind_com->is_active ? 'color--fadegreen fa-check' : 'fa-times'}}"></i></span></td>
                <td><span class="cellcontent"><a href= clients_individuals_companies_view.html ,  class= "action-btn bgcolor--main color--white "><i class = "fa  fa-eye"></i></a><a href= clients_individuals_companies_edit.html ,  class= "action-btn bgcolor--fadegreen color--white "><i class = "fa  fa-pencil"></i></a><a href="#"  class= "btn-warning-cancel action-btn bgcolor--fadebrown color--white "><i class = "fa  fa-trash-o"></i></a></span></td>
              </tr>
            @endforeach
            
          </tbody>
        </table>
        <div class="remodal log-custom" data-remodal-id="log_link" role="dialog" aria-labelledby="modal1Title" aria-describedby="modal1Desc">
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