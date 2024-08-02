@extends('client.master')

@section('content')
<!-- Shoping Cart -->
<div class="bg0 p-t-200 p-b-85">
    <div class="container">
        <div class="row">

            <div class="col-lg-8 col-xl-9">
                <div class="m-r--30">
                    <div class="wrap-table-shopping-cart">
                        <table class="table-shopping-cart">
                            <tr class="table_head">
                                <th class="column-1">Ảnh</th>
                                <th class="column-1">Giày</th>
                                <th class="column-3">Màu</th>
                                <th class="column-3">Size</th>
                                <th class="column-3">Số Lượng</th>
                                <th class="column-6">Giá</th>
                                <th class="column-7">Xóa</th>
                            </tr>
                            @foreach ($cart as $item)
                            <tr class="table_row">
                                <td class="column-1">
                                    <div class="itemcart1">
                                        <img src="{{ asset($item->product_detail->product->images[0]->url) }}"
                                            alt="IMG-PRODUCT" style="width: 80px;height: 100px;">
                                    </div>
                                </td>
                                <td class="column-2"> {{ $item->product_detail->product->name }}</td>
                                <td class="column-3">{{ $item->product_detail->color->name }}</td>
                                <td class="column-3">{{ $item->product_detail->size->name }}</td>
                                <td class="column-3">
                                    <div class="wrap-num-product flex-w m-r-40">
                                        <form action="{{ route('giam-so-luong') }}" method="POST">
                                            @csrf
                                            <div class="btn-num-product-down cl8 hov-btn3 trans-04 flex-c-m">

                                                <button name="giam" value="{{ $item->id }}">
                                                    <i class="fs-16 zmdi zmdi-minus"></i>
                                                </button>
                                            </div>
                                        </form>

                                        <input class="mtext-104 cl3 txt-center num-product" type="number"
                                            name="quantity" readonly value="{{ $item->quantity }}">

                                        <form action="{{ route('tang-so-luong') }}" method="POST">
                                            @csrf
                                            <div class="btn-num-product-down cl8 hov-btn3 trans-04 flex-c-m">
                                                <button name="tang" value="{{ $item->id }}">
                                                    <i class="fs-16 zmdi zmdi-plus"></i>
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </td>
                                <td class="column-6"> {{ number_format($item->total_price) }}</td>
                                <td class="column-7">
                                    <form action="{{ route('delete_cart') }}" method="POST">
                                        @csrf
                                        <button type="submit" name="id" value="{{ $item->id }}">X</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </table>
                    </div>

                    <div class="flex-w flex-sb-m bor15 p-t-18 p-b-15 p-lr-40 p-lr-15-sm">
                        <div class="flex-w flex-m m-r-20 m-tb-5">
                            <input class="stext-104 cl2 plh4 size-117 bor13 p-lr-20 m-r-10 m-tb-5" type="text"
                                name="coupon" placeholder="Mã Giảm Giá">

                            <div
                                class="flex-c-m stext-101 cl2 size-118 bg8 bor13 hov-btn3 p-lr-15 trans-04 pointer m-tb-5">
                                Áp Dụng
                            </div>
                        </div>
                        <div class="form-group">
                            <a href="{{ route('products') }}"
                                class="flex-c-m stext-101 cl2 size-119 bg8 bor13 hov-btn3 p-lr-15 trans-04 pointer m-tb-10">
                                Tiếp Tục Mua Hàng
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class=" col-lg-4 col-xl-3">
                <div class="bor10 p-lr-30 p-t-20 p-b-40 m-r-5">
                    <h4 class="mtext-109 cl2 p-b-30">
                        Đơn Hàng
                    </h4>

                    <div class="flex-w flex-t bor12 p-b-13">
                        <div class="size-208">
                            <span class="stext-110 cl2">
                                Tổng :
                            </span>
                        </div>

                        <div class="size-209">
                            <span class="mtext-110 cl2">
                                {{ number_format($total, 2, ',', '.') }} VND
                            </span>
                        </div>
                    </div>

                    <div class="flex-w flex-t bor12 p-t-15 p-b-30">
                        <div class="size-208 w-full-ssm">
                            <span class="stext-110 cl2">
                                Vận Chuyển:
                            </span>
                        </div>

                        <div class="size-209 p-r-18 p-r-0-sm w-full-ssm">
                            <p class="stext-111 cl6 p-t-2">
                                There are no shipping methods available. Please double check your address, or contact us
                                if you need any help.
                            </p>
                        </div>
                    </div>

                    <div class="flex-w flex-t p-t-27 p-b-33">
                        <div class="size-208">
                            <span class="mtext-101 cl2">
                                Tổng :
                            </span>
                        </div>

                        <div class="size-209 p-t-1">
                            <span class="mtext-110 cl2">
                                {{ number_format($total, 2, ',', '.') }} VND
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <a href="{{ route('checkout') }}"
                            class="flex-c-m stext-101 cl0 size-116 bg3 bor14 hov-btn3 p-lr-15 trans-04 pointer">
                            Đặt Hàng
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection