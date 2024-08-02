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
                                <th class="column-2">Giày</th>
                                <th class="column-3">Giá</th>
                                <th class="column-3">Xóa</th>
                            </tr>
                            @foreach ($wishlist as $item)
                            <tr class="table_row">
                                <td class="column-1">
                                    <div class="itemcart1">
                                        <img src="{{ asset($item->product->images[0]->url) }}" alt="IMG-PRODUCT"
                                            style="width: 100px;height: 100px;">
                                    </div>
                                </td>
                                <td class="column-2">{{ $item->product->name }}</td>
                                <td class="column-3">{{ number_format($item->selling_price) }} VND</td>
                                <td class="column-3">
                                    <form action="{{ route('wishlist_delete') }}" method="POST">
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

        </div>
    </div>
</div>
@endsection