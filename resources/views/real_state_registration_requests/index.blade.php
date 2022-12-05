@extends('layout.app')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="cover-inside-container margin--small-top-bottom bradius--small bshadow--1" style="background:  url( '{{asset('img/covers/dummy2.jpg')}}' ) no-repeat center center; background-size:cover;">
            <div class="row">
                <div class="col-xs-12">
                    <div class="text-xs-center">
                        <div class="text-wraper">
                            <h4 class="cover-inside-title color--gray_d">طلبات معرفة تكلفه التسجيل العقاري</h4>
                        </div>
                    </div>
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
            <div class="full-table hide-datatable-pagination">
                </div>

                <table class="table-1 hide-datatable-pagination" id="dataTableTriggerId_001">
                    <thead>
                    <tr class="bgcolor--gray_mm color--gray_d">
                        <th><span class="cellcontent">&lt;input type=&quot;checkbox&quot; name=&quot;select-all&quot; id=&quot;select-all&quot; /&gt;</span></th>
                        <th><span class="cellcontent">م</span></th>
                        <th><span class="cellcontent">الاسم</span></th>
                        <th><span class="cellcontent">رقم التليفون</span></th>
                        <th><span class="cellcontent">مساحة الشقة</span></th>
                        <th><span class="cellcontent">المنطقة السكنيه</span></th>
                        <th><span class="cellcontent">سعر الشقة</span></th>
                        <th><span class="cellcontent">تسجيل الارض</span></th>
                        <th><span class="cellcontent">التاريخ</span></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($requests as $request)
                    <tr data-request-id="{{$request->id}}">
                        <td><span class="cellcontent"><input type="checkbox" class="checkboxes input-in-table" /></span></td>
                        <td><span class="cellcontent">{{$request->id}}</span></td>
                        <td><span class="cellcontent">{{$request->name}}</span></td>
                        <td><span class="cellcontent">{{$request->phone}}</span></td>
                        <td><span class="cellcontent">{{$request->space}}</span></td>
                        <td><span class="cellcontent">{{$request->area}}</span></td>
                        <td><span class="cellcontent">{{$request->price}}</span></td>
                        <td><span class="cellcontent">@if($request->is_registered_land==1)<i class = "fa color--fadegreen fa-check"></i>@else <i class = "fa color--fadebrown fa-times"></i> @endif</span></td>
                        <td><span class="cellcontent">{{$request->created_at}}</span></td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
                {{$requests->links()}}
        </div>
    </div>

@endsection