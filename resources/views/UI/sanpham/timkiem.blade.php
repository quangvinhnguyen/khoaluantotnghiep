@extends('UI.layout')
@section('content')
    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> --}}
    {{-- <link rel="stylesheet" type="text/css" href="public/css/menu.css" /> --}}
    
    <div class="content" ng-controller="SearchCtrl">

        <div class="content_bottom">
            <div class="heading">
                <h3>Products</h3>
            </div>
            {{-- <div class="see">
                <p><a href="#">See all Products</a></p>
            </div> --}}
            <div class="clear"></div>
        </div>
        <div class="section group" ng-init="getsearch()" >
            <div class="grid_1_of_4 images_1_of_4" ng-repeat="d in datas">
                <a href="{!! asset('detailsanpham?=<% d.id %>') !!}" ><img src="{!! asset('public/uploads/<% d.hinh_anh %>') !!}" alt="" /></a>
                <div class="price-details">
                    <div class="price-number">
                        <p><span class="rupees"><% d.don_gia %> đ</span></p>
                    </div>
                    <div class="add-cart" >
                        <h4 ><a href=""ng-click="muahang( d.id )">Add to Cart </a></h4>
                    </div>
                    <div class="clear"></div>
                </div>
            </div>

        </div>
        <div class="row">
            <div class="col-md-6 col-md-push-4">
                <posts-paginationt class="text-center"></posts-paginationt>
            </div>
        </div>
    </div>


@endsection()

