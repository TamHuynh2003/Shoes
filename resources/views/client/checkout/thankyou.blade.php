@extends('client.master')

@include('client.designs.thankyou_css')

@section('content')
<div class="site-wrap">
    <div class="site-section">
        <div class="container">
            <div class="row" style="padding-top: 100px">
                <div class="col-md-12 text-center">
                    <span class="icon-check_circle display-3 text-success"></span>
                    <h2 class="display-3 text-black">Thank You</h2>
                    <br>
                    <br>
                    <p class="lead mb-5">Cảm ơn bạn đã đặt hàng ở website chúng tôi</p>
                    <p class="lead mb-5">Đơn hàng sẽ sớm được giao tới bạn</p>
                    <p><a href="{{ route('products') }}" class="btn btn-sm btn-primary">Tiếp Tục Mua Sắm</a></p>
                </div>
            </div>
        </div>
    </div>
</div>

@include('client.designs.thankyou_js')

@endsection