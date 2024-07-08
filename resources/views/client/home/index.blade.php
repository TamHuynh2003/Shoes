@extends('client.master')

@section('content')
<!-- Slider -->
<section class="section-slide">
    <div class="wrap-slick1">
        <div class="slick1">
            @foreach ($listSlides as $slide)
            <div class="item-slick1" style="background-image: url({{ asset($slide->url) }});">
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Banner -->
<div class="sec-banner bg0 p-t-80 p-b-50">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-xl-4 p-b-30 m-lr-auto">
                <div class="block1 wrap-pic-w">
                    <img src="{{ asset('images/products/banner1.png') }}" alt="IMG-BANNER">
                    <a href="{{ route('products') }}"
                        class="block1-txt ab-t-l s-full flex-col-l-sb p-lr-38 p-tb-34 trans-03 respon3">
                        <div class="block1-txt-child1 flex-col-l">
                            <span class="block1-name ltext-102 trans-04 p-b-8">
                                Nike Air Force
                            </span>
                            <span class="block1-info stext-102 trans-04">
                                Spring 2024
                            </span>
                        </div>
                        <div class="block1-txt-child2 p-b-4 trans-05">
                            <div class="block1-link stext-101 cl0 trans-09">
                                Mua Ngay
                            </div>
                        </div>
                    </a>
                </div>
            </div>

            <div class="col-md-6 col-xl-4 p-b-30 m-lr-auto">
                <div class="block1 wrap-pic-w">
                    <img src="{{ asset('images/products/banner2.png') }}" alt="IMG-BANNER">
                    <a href="{{ route('products') }}"
                        class="block1-txt ab-t-l s-full flex-col-l-sb p-lr-38 p-tb-34 trans-03 respon3">
                        <div class="block1-txt-child1 flex-col-l">
                            <span class="block1-name ltext-102 trans-04 p-b-8">
                                Adidas Supper Star
                            </span>
                            <span class="block1-info stext-102 trans-04">
                                Spring 2024
                            </span>
                        </div>
                        <div class="block1-txt-child2 p-b-4 trans-05">
                            <div class="block1-link stext-101 cl0 trans-09">
                                Mua Ngay
                            </div>
                        </div>
                    </a>
                </div>
            </div>

            <div class="col-md-6 col-xl-4 p-b-30 m-lr-auto">
                <div class="block1 wrap-pic-w">
                    <img src="{{ asset('images/products/banner3.png') }}" alt="IMG-BANNER">
                    <a href="{{ route('products') }}"
                        class="block1-txt ab-t-l s-full flex-col-l-sb p-lr-38 p-tb-34 trans-03 respon3">
                        <div class="block1-txt-child1 flex-col-l">
                            <span class="block1-name ltext-102 trans-04 p-b-8">
                                Vans Old Skool Classic
                            </span>
                            <span class="block1-info stext-102 trans-04">
                                Spring 2024
                            </span>
                        </div>
                        <div class="block1-txt-child2 p-b-4 trans-05">
                            <div class="block1-link stext-101 cl0 trans-09">
                                Mua Ngay
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Product -->
<section class="bg0 p-t-50 p-b-150">
    <title>Sản Phẩm Bán Chạy</title>
    <div class="container">
        <div class="row isotope-grid">

            @foreach ($list_products as $item)
            <div class="col-sm-6 col-md-4 col-lg-3 p-b-35 isotope-item women">
                <!-- Block2 -->
                <div class="block2">
                    <div class="block2-pic hov-img0">
                        <a href="{{ route('product_detail', ['id' => $item->id]) }}">
                            <img src="{{ asset($item->images->first()->url) }}" alt="IMG-PRODUCT">
                            <a href="{{ route('product_detail', ['id' => $item->id]) }}"
                                class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04 js-show-modal1">
                                Xem Giày
                            </a>
                        </a>
                    </div>

                    <div class="block2-txt flex-w flex-t p-t-14">
                        <div class="block2-txt-child1 flex-col-l ">
                            <a href="{{ route('product_detail', ['id' => $item->id]) }}"
                                class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
                                {{ $item->name }}
                            </a>

                            <span class="stext-105 cl3">
                                {{ number_format($item->selling_price) }}
                            </span>
                        </div>

                        <div class="block2-txt-child2 flex-r p-t-3">
                            <a href="{{ route('wishlist_add', ['id' => $item->id]) }}"
                                class="btn-addwish-b2 dis-block pos-relative js-addwish-b2">
                                <img class="icon-heart1 dis-block trans-04"
                                    src="{{ asset('images/products/icons/icon-heart-01.png') }}" alt="ICON">
                                <img class="icon-heart2 dis-block trans-04 ab-t-l"
                                    src="{{ asset('images/products/icons/icon-heart-02.png') }}" alt="ICON">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach

        </div>
    </div>
</section>
@endsection