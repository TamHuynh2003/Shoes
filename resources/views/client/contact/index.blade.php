@extends('client.master')

@section('content')
<!-- Title page -->
<div class="css_update">
    <section class="bg-img1 txt-center p-lr-15 p-tb-92"
        style="background-image: url({{ asset('user_template/images/bg-01.jpg') }});">

        <h2 class="ltext-105 cl0 txt-center">
            Liên Hệ
        </h2>
    </section>
</div>

<!-- Content page -->
<section class="bg0 p-t-104 p-b-116">
    <div class="container">
        <div class="flex-w flex-tr">
            <div class="size-210 bor10 p-lr-70 p-t-55 p-b-70 p-lr-15-lg w-full-md">
                <form action="{{ route('contact_handle') }}" method="POST">
                    @csrf
                    <h4 class="mtext-105 cl2 txt-center p-b-30">
                        Góp Ý Cho Chúng Tôi
                    </h4>

                    <div class="bor8 m-b-20 how-pos4-parent">
                        <input class="stext-111 cl2 plh3 size-116 p-l-62 p-r-30" type="text" name="email"
                            placeholder=" Email Của Bạn" value="{{ auth('users')->user()->email }}" readonly>
                        <img class="how-pos4 pointer-none" src="{{ asset('images/products/icons/icon-email.png') }}"
                            alt="ICON">
                    </div>

                    <div class="bor8 m-b-30">
                        <textarea class="stext-111 cl2 plh3 size-120 p-lr-28 p-tb-25" name="description"
                            placeholder="Chúng Tôi Giúp Gì Được Cho Bạn?"></textarea>
                    </div>

                    <button class="flex-c-m stext-101 cl0 size-121 bg3 bor1 hov-btn3 p-lr-15 trans-04 pointer"
                        type="submit">
                        Gửi
                    </button>
                </form>

            </div>



            <div class="size-210 bor10 flex-w flex-col-m p-lr-93 p-tb-30 p-lr-15-lg w-full-md">
                <div class="flex-w w-full p-b-42">
                    <span class="fs-18 cl5 txt-center size-211">
                        <span class="lnr lnr-map-marker"></span>
                    </span>

                    <div class="size-212 p-t-2">
                        <span class="mtext-110 cl2">
                            Địa Chỉ
                        </span>

                        <p class="stext-115 cl6 size-213 p-t-18">
                            65 Huỳnh Thúc Kháng. Phường Bến Nghé, Quận 1
                        </p>
                    </div>
                </div>

                <div class="flex-w w-full p-b-42">
                    <span class="fs-18 cl5 txt-center size-211">
                        <span class="lnr lnr-phone-handset"></span>
                    </span>

                    <div class="size-212 p-t-2">
                        <span class="mtext-110 cl2">
                            Số Điện Thoại
                        </span>

                        <p class="stext-115 cl1 size-213 p-t-18">
                            0963651899
                        </p>
                    </div>
                </div>

                <div class="flex-w w-full">
                    <span class="fs-18 cl5 txt-center size-211">
                        <span class="lnr lnr-envelope"></span>
                    </span>

                    <div class="size-212 p-t-2">
                        <span class="mtext-110 cl2">
                            Email Hỗ Trợ
                        </span>

                        <p class="stext-115 cl1 size-213 p-t-18">
                            minhtruzz.hotro@gmail.com
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection