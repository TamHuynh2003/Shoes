@extends('client.master')

@section('content')
<!-- Title page -->
<div class="css_update">
    <section class="bg-img1 txt-center p-lr-15 p-tb-92"
        style="background-image: url({{ asset('user_template/images/abouts1.jpg') }});">
        <h2 class="ltext-105 cl0 txt-center">
            Về Chúng Tôi
        </h2>
    </section>
</div>

<!-- Content page -->
<section class="bg0 p-t-75 p-b-120">
    <div class="container">
        @foreach ($about as $item)
        <div class="row p-b-148">
            <div class="col-md-7 col-lg-8">
                <div class="p-t-7 p-r-85 p-r-15-lg p-r-0-md">
                    <h3 class="mtext-111 cl2 p-b-16">
                        {{ $item->title }}
                    </h3>

                    <p class="stext-113 cl6 p-b-26">
                        {{ $item->description }}
                    </p>
                </div>
            </div>

            <div class="col-11 col-md-5 col-lg-4 m-lr-auto">
                <div class="how-bor1 ">
                    <div class="hov-img0">
                        <img src="{{ asset($item->image) }}" alt="IMG-ABOUT">
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</section>
@endsection