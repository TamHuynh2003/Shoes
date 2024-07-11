@extends('client.master')

@section('content')
    <section class="bg0 p-t-150 p-b-150">
        <div class="container">

            <!-- Filter Search -->
            <div class="flex-w flex-sb-m p-b-52">
                <div class="flex-w flex-l-m filter-tope-group m-tb-10">
                    <h3>Tìm kiếm với từ khoá: {{ $search }}</h3>
                </div>
            </div>
            @if (count($products) == 0)
                <section class="bg0 p-t-50 p-b-150">
                    <div class="container">
                        <h3>Không có sản phẩm </h3>
                    </div>
                </section>
            @else
                <!-- Product -->
                <section class="bg0 p-t-50 p-b-150">
                    <div class="container">
                        <div class="row isotope-grid">
                            @foreach ($products as $item)
                                <div class="col-sm-6 col-md-4 col-lg-3 p-b-35 isotope-item women">
                                    <div class="block2">
                                        <p class="block2-pic hov-img0">
                                            <a href="{{ route('product_detail', ['id' => $item->id]) }}">
                                                <img src="{{ asset($item->images->first()->url) }}" alt="IMG-PRODUCT">
                                                <a href="{{ route('product_detail', ['id' => $item->id]) }}"
                                                    class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04 js-show-modal1">
                                                    Xem Giày
                                                </a>
                                            </a>
                                        </p>
                                        <div class="block2-txt flex-w flex-t p-t-14">
                                            <div class="block2-txt-child1 flex-col-l ">
                                                <a href="{{ route('product_detail', $item->id) }}"
                                                    class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
                                                    {{ $item->name }}
                                                </a>
                                                <span class="stext-105 cl3">
                                                    {{ number_format($item->selling_price) }} VND
                                                </span>
                                                <div>
                                                    @for ($i = 0; $i < 5; $i++)
                                                        @if ($i < $item->rating)
                                                            <i class="ion ion-ios7-star"
                                                                style="color:rgb(244, 244, 14)"></i>
                                                        @else
                                                            <i class="ion ion-ios7-star-outline"
                                                                style="color:rgb(244, 244, 14)"></i>
                                                        @endif
                                                    @endfor
                                                </div>
                                            </div>
                                            <div class="block2-txt-child2 flex-r p-t-3">
                                                <a href="#"
                                                    class="btn-addwish-b2 dis-block pos-relative js-addwish-b2">
                                                    <img class="icon-heart1 dis-block trans-04"
                                                        src="{{ asset('images/products/icons/icon-heart-01.png') }}"
                                                        alt="ICON">
                                                    <img class="icon-heart2 dis-block trans-04 ab-t-l"
                                                        src="{{ asset('images/products/icons/icon-heart-02.png') }}"
                                                        alt="ICON">
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </section>
            @endif

        </div>
    </section>
@endsection
