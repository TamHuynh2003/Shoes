@extends('client.master')

@section('content')
<div class="css_update">
    <div class="site-section">
        <div class="container">
            <form action="{{ route('process_payment') }}" method="post"> @csrf
                <div class="row mb-5">
                    <div class="col-md-12">
                        {{-- <div class="border p-4 rounded" role="alert">
                            Returning customer? <a href="#">Click here</a> to login
                        </div> --}}
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-5 mb-md-0">
                        <h2 class="h3 mb-3 text-black">Thông Tin Khách Hàng</h2>
                        <div class="p-3 p-lg-5 border">

                            <div class="form-group row">
                                <div class="col-md-6">
                                    <label class="text-black">Họ Và Tên <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="fullname"
                                        value="{{ auth('users')->user()->fullname }}" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="text-black">Số Điện Thoại <span class="text-danger">*</span></label>
                                    <input required type="number" class="form-control" name="phone"
                                        value="{{ auth('users')->user()->phone_number }}">
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-12">
                                    <label class="text-black">Địa Chỉ Nhận Hàng <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="address"
                                        value="{{ auth('users')->user()->address }}" required>
                                </div>
                            </div>

                            <div class="form-group row mb-5">
                                <div class="col-md-6">
                                    <label class="text-black">Email liên hệ <span class="text-danger">*</span></label>
                                    <input type="email" class="form-control" name="email" required
                                        value="{{ auth('users')->user()->email }}">
                                </div>

                            </div>

                            <div class="form-group">
                                <label class="text-black">Lời Nhắn Tới Shop</label>
                                <textarea name="order_notes" cols="30" rows="5" class="form-control"
                                    placeholder=""></textarea>
                            </div>
                            <div class="flex-w flex-sb-m">
                                <div class="form-group">
                                    <a href="{{ route('cart') }}"
                                        class="flex-c-m stext-101 cl0 size-119 bg3 bor14 hov-btn3 p-lr-15 trans-04 pointer m-tb-10">
                                        Trở Lại
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">

                        <div class="row mb-5">
                            <div class="col-md-12">
                                <h2 class="h3 mb-3 text-black">Chi Tiết Đơn Hàng</h2>
                                <div class="p-3 p-lg-5 border">
                                    <table class="table site-block-order-table mb-5">
                                        <thead>
                                            <th>Giày</th>
                                            <th> Giá</th>
                                        </thead>
                                        <tbody>
                                            @foreach ($carts as $item)
                                            <tr>
                                                <td>{{ $item->product_detail->product->name }} <strong
                                                        class="mx-2">x</strong> {{ $item->quantity }}</td>
                                                <td>{{ number_format($item->product_detail->product->selling_price *
                                                    $item->quantity)
                                                    }}
                                                    VND</td>
                                            </tr>
                                            @endforeach
                                            <tr>
                                                <td>Tổng Cộng:
                                                </td>
                                                <td>{{ number_format($total) }}
                                                    VND</td>
                                            </tr>
                                        </tbody>
                                    </table>



                                    <div class="border p-3 mb-5">
                                        <select class="form-select" aria-label="Default select example"
                                            name="payment_method_id">
                                            @foreach ($paymentMethods as $item)
                                            <option selected value="{{ $item->id }}">{{ $item->name }}
                                            </option>
                                            @endforeach

                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <button type="submit"
                                            class="flex-c-m stext-101 cl0 size-116 bg3 bor14 hov-btn3 p-lr-15 trans-04 pointer">Thanh
                                            Toán</button>
                                    </div>

                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </form>
            <!-- </form> -->
        </div>
    </div>
</div>
@endsection