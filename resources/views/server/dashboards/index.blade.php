@extends('server.master')

@section('content')

<div class="page-header">
    <div>
        <h1 class="page-title">Thống Kê</h1>
    </div>
</div>

<div class="main">
    <div class="row " style="display: flex;flex-wrap:nowrap ">

        <label for="dateStart">Ngày Bắt Đầu</label>
        <div class="col-3">
            <div class="input-group date datePicker">
                <input type="text" class="form-control" id="dateStart" />
                <span class="input-group-append">
                    <span class="input-group-text bg-light d-block">
                        <i class="fa fa-calendar"></i>
                    </span>
                </span>
            </div>
        </div>

        <label for="dateEnd">Ngày Kết Thúc</label>
        <div class="col-3">
            <div class="input-group date datePicker">
                <input type="text" class="form-control" id="dateEnd" />
                <span class="input-group-append">
                    <span class="input-group-text bg-light d-block">
                        <i class="fa fa-calendar"></i>
                    </span>
                </span>
            </div>
        </div>

        <div class="col-2">
            <button class="btn btn-primary" id="btnSearch">Tìm</button>
        </div>
    </div>
</div>

<div class="row">

    <div class="col-md-12 col-lg-6 col-xl-3">
        <div class="card overflow-hidden">
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <h3 class="mb-2 fw-semibold" id="count_order"></h3>
                        <p class="text-muted fs-13 mb-0">Số Lượng Đơn Đặt Hàng</p>
                    </div>
                    <div class="col col-auto top-icn dash">
                        <div class="counter-icon bg-secondary dash ms-auto box-shadow-secondary">
                            <svg xmlns="http://www.w3.org/2000/svg" class="fill-white" enable-background="new 0 0 24 24"
                                viewBox="0 0 24 24">
                                <path
                                    d="M19.5,7H16V5.9169922c0-2.2091064-1.7908325-4-4-4s-4,1.7908936-4,4V7H4.5C4.4998169,7,4.4996338,7,4.4993896,7C4.2234497,7.0001831,3.9998169,7.223999,4,7.5V19c0.0018311,1.6561279,1.3438721,2.9981689,3,3h10c1.6561279-0.0018311,2.9981689-1.3438721,3-3V7.5c0-0.0001831,0-0.0003662,0-0.0006104C19.9998169,7.2234497,19.776001,6.9998169,19.5,7z M9,5.9169922c0-1.6568604,1.3431396-3,3-3s3,1.3431396,3,3V7H9V5.9169922z M19,19c-0.0014038,1.1040039-0.8959961,1.9985962-2,2H7c-1.1040039-0.0014038-1.9985962-0.8959961-2-2V8h3v2.5C8,10.776123,8.223877,11,8.5,11S9,10.776123,9,10.5V8h6v2.5c0,0.0001831,0,0.0003662,0,0.0005493C15.0001831,10.7765503,15.223999,11.0001831,15.5,11c0.0001831,0,0.0003662,0,0.0006104,0C15.7765503,10.9998169,16.0001831,10.776001,16,10.5V8h3V19z" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12 col-lg-6 col-xl-3">
        <div class="card overflow-hidden">
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <h3 class="mb-2 fw-semibold" id="count_purchase_order"></h3>
                        <p class="text-muted fs-13 mb-0">Số Lượng Đơn Nhập Hàng</p>
                    </div>
                    <div class="col col-auto top-icn dash">
                        <div class="counter-icon bg-info dash ms-auto box-shadow-info">
                            <svg xmlns="http://www.w3.org/2000/svg" class="fill-white" enable-background="new 0 0 24 24"
                                viewBox="0 0 24 24">
                                <path
                                    d="M7.5,12C7.223877,12,7,12.223877,7,12.5v5.0005493C7.0001831,17.7765503,7.223999,18.0001831,7.5,18h0.0006104C7.7765503,17.9998169,8.0001831,17.776001,8,17.5v-5C8,12.223877,7.776123,12,7.5,12z M19,2H5C3.3438721,2.0018311,2.0018311,3.3438721,2,5v14c0.0018311,1.6561279,1.3438721,2.9981689,3,3h14c1.6561279-0.0018311,2.9981689-1.3438721,3-3V5C21.9981689,3.3438721,20.6561279,2.0018311,19,2z M21,19c-0.0014038,1.1040039-0.8959961,1.9985962-2,2H5c-1.1040039-0.0014038-1.9985962-0.8959961-2-2V5c0.0014038-1.1040039,0.8959961-1.9985962,2-2h14c1.1040039,0.0014038,1.9985962,0.8959961,2,2V19z M12,6c-0.276123,0-0.5,0.223877-0.5,0.5v11.0005493C11.5001831,17.7765503,11.723999,18.0001831,12,18h0.0006104c0.2759399-0.0001831,0.4995728-0.223999,0.4993896-0.5v-11C12.5,6.223877,12.276123,6,12,6z M16.5,10c-0.276123,0-0.5,0.223877-0.5,0.5v7.0005493C16.0001831,17.7765503,16.223999,18.0001831,16.5,18h0.0006104C16.7765503,17.9998169,17.0001831,17.776001,17,17.5v-7C17,10.223877,16.776123,10,16.5,10z" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12 col-lg-6 col-xl-3">
        <div class="card overflow-hidden">
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <h3 class="mb-2 fw-semibold" id="revenue"></h3>
                        <p class="text-muted fs-13 mb-0">Doanh Thu</p>
                    </div>
                    <div class="col col-auto top-icn dash">
                        <div class="counter-icon bg-warning dash ms-auto box-shadow-warning">
                            <svg xmlns="http://www.w3.org/2000/svg" class="fill-white" enable-background="new 0 0 24 24"
                                viewBox="0 0 24 24">
                                <path
                                    d="M9,10h2.5c0.276123,0,0.5-0.223877,0.5-0.5S11.776123,9,11.5,9H10V8c0-0.276123-0.223877-0.5-0.5-0.5S9,7.723877,9,8v1c-1.1045532,0-2,0.8954468-2,2s0.8954468,2,2,2h1c0.5523071,0,1,0.4476929,1,1s-0.4476929,1-1,1H7.5C7.223877,15,7,15.223877,7,15.5S7.223877,16,7.5,16H9v1.0005493C9.0001831,17.2765503,9.223999,17.5001831,9.5,17.5h0.0006104C9.7765503,17.4998169,10.0001831,17.276001,10,17v-1c1.1045532,0,2-0.8954468,2-2s-0.8954468-2-2-2H9c-0.5523071,0-1-0.4476929-1-1S8.4476929,10,9,10z M21.5,12H17V2.5c0.000061-0.0875244-0.0228882-0.1735229-0.0665283-0.2493896c-0.1375732-0.2393188-0.4431152-0.3217773-0.6824951-0.1842041l-3.2460327,1.8603516L9.7481079,2.0654297c-0.1536865-0.0878906-0.3424072-0.0878906-0.4960938,0l-3.256897,1.8613281L2.7490234,2.0664062C2.6731567,2.0227661,2.5871582,1.9998779,2.4996338,1.9998779C2.2235718,2.000061,1.9998779,2.223938,2,2.5v17c0.0012817,1.380188,1.119812,2.4987183,2.5,2.5H19c1.6561279-0.0018311,2.9981689-1.3438721,3-3v-6.5006104C21.9998169,12.2234497,21.776001,11.9998169,21.5,12z M4.5,21c-0.828064-0.0009155-1.4990845-0.671936-1.5-1.5V3.3623047l2.7412109,1.5712891c0.1575928,0.0872192,0.348877,0.0875854,0.5068359,0.0009766L9.5,3.0761719l3.2519531,1.8583984c0.157959,0.0866089,0.3492432,0.0862427,0.5068359-0.0009766L16,3.3623047V19c0.0008545,0.7719116,0.3010864,1.4684448,0.7803345,2H4.5z M21,19c0,1.1045532-0.8954468,2-2,2s-2-0.8954468-2-2v-6h4V19z" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- <div class="col-md-12 col-lg-6 col-xl-3">
        <div class="card overflow-hidden">
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <h3 class="mb-2 fw-semibold">112,324 VND</h3>
                        <p class="text-muted fs-13 mb-0">Lợi Nhuận</p>
                    </div>
                    <div class="col col-auto top-icn dash">
                        <div class="counter-icon bg-primary dash ms-auto box-shadow-primary">
                            <svg xmlns="http://www.w3.org/2000/svg" class="fill-white" enable-background="new 0 0 24 24"
                                viewBox="0 0 24 24">

                                <path
                                    d="M12,8c-2.2091675,0-4,1.7908325-4,4s1.7908325,4,4,4c2.208252-0.0021973,3.9978027-1.791748,4-4C16,9.7908325,14.2091675,8,12,8z M12,15c-1.6568604,0-3-1.3431396-3-3s1.3431396-3,3-3c1.6561279,0.0018311,2.9981689,1.3438721,3,3C15,13.6568604,13.6568604,15,12,15z M21.960022,11.8046875C19.9189453,6.9902344,16.1025391,4,12,4s-7.9189453,2.9902344-9.960022,7.8046875c-0.0537109,0.1246948-0.0537109,0.2659302,0,0.390625C4.0810547,17.0097656,7.8974609,20,12,20s7.9190063-2.9902344,9.960022-7.8046875C22.0137329,12.0706177,22.0137329,11.9293823,21.960022,11.8046875z M12,19c-3.6396484,0-7.0556641-2.6767578-8.9550781-7C4.9443359,7.6767578,8.3603516,5,12,5s7.0556641,2.6767578,8.9550781,7C19.0556641,16.3232422,15.6396484,19,12,19z" />

                            </svg>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}


    <div class="col-md-12 col-lg-6 col-xl-3">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-8">
                        <h4>Đơn Hàng Đã Hủy</h4>
                        <p id="count_cancel_order"></p>
                    </div>
                    <div class="col-4">
                        <div
                            class="hpx-50 wpx-50 br-5 d-flex align-items-center justify-content-center bg-secondary ms-auto">
                            <svg xmlns="http://www.w3.org/2000/svg" class="text-white w-icn"
                                enable-background="new 0 0 24 24" viewBox="0 0 24 24">
                                <path
                                    d="M17,4h-1.1846313C15.4013672,2.8383179,14.3035889,2.0014648,13,2h-2C9.6964111,2.0014648,8.5986328,2.8383179,8.1846313,4H7C5.3438721,4.0018311,4.0018311,5.3438721,4,7v12c0.0018311,1.6561279,1.3438721,2.9981689,3,3h10c1.6561279-0.0018311,2.9981689-1.3438721,3-3V7C19.9981689,5.3438721,18.6561279,4.0018311,17,4z M9,5c0.0014038-1.1040039,0.8959961-1.9985962,2-2h2c1.1040039,0.0014038,1.9985962,0.8959961,2,2v2H9V5z M19,19c-0.0014038,1.1040039-0.8959961,1.9985962-2,2H7c-1.1040039-0.0014038-1.9985962-0.8959961-2-2V7c0.0014038-1.1040039,0.8959961-1.9985962,2-2h1v2.5006104C8.0001831,7.7765503,8.223999,8.0001831,8.5,8h7.0006104C15.7765503,7.9998169,16.0001831,7.776001,16,7.5V5h1c1.1040039,0.0014038,1.9985962,0.8959961,2,2V19z">
                                </path>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12 col-lg-6 col-xl-3">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-8">
                        <h4>Đơn Hàng Đã Duyệt</h4>
                        <p id="count_approve_order"></p>
                    </div>
                    <div class="col-4">
                        <div
                            class="hpx-50 wpx-50 br-5 d-flex align-items-center justify-content-center bg-warning ms-auto">
                            <svg xmlns="http://www.w3.org/2000/svg" class="text-white w-icn"
                                enable-background="new 0 0 24 24" viewBox="0 0 24 24">
                                <path
                                    d="M17,4h-1.1846313C15.4013672,2.8383179,14.3035889,2.0014648,13,2h-2C9.6964111,2.0014648,8.5986328,2.8383179,8.1846313,4H7C5.3438721,4.0018311,4.0018311,5.3438721,4,7v12c0.0018311,1.6561279,1.3438721,2.9981689,3,3h10c1.6561279-0.0018311,2.9981689-1.3438721,3-3V7C19.9981689,5.3438721,18.6561279,4.0018311,17,4z M9,5c0.0014038-1.1040039,0.8959961-1.9985962,2-2h2c1.1040039,0.0014038,1.9985962,0.8959961,2,2v2H9V5z M19,19c-0.0014038,1.1040039-0.8959961,1.9985962-2,2H7c-1.1040039-0.0014038-1.9985962-0.8959961-2-2V7c0.0014038-1.1040039,0.8959961-1.9985962,2-2h1v2.5006104C8.0001831,7.7765503,8.223999,8.0001831,8.5,8h7.0006104C15.7765503,7.9998169,16.0001831,7.776001,16,7.5V5h1c1.1040039,0.0014038,1.9985962,0.8959961,2,2V19z">
                                </path>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12 col-lg-6 col-xl-3">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-8">
                        <h4>Đơn Hàng Đang Giao</h4>
                        <p id="count_delivering_order"></p>
                    </div>
                    <div class="col-4">
                        <div
                            class="hpx-50 wpx-50 br-5 d-flex align-items-center justify-content-center bg-info ms-auto">
                            <svg xmlns="http://www.w3.org/2000/svg" class="text-white w-icn"
                                enable-background="new 0 0 24 24" viewBox="0 0 24 24">
                                <path
                                    d="M17,4h-1.1846313C15.4013672,2.8383179,14.3035889,2.0014648,13,2h-2C9.6964111,2.0014648,8.5986328,2.8383179,8.1846313,4H7C5.3438721,4.0018311,4.0018311,5.3438721,4,7v12c0.0018311,1.6561279,1.3438721,2.9981689,3,3h10c1.6561279-0.0018311,2.9981689-1.3438721,3-3V7C19.9981689,5.3438721,18.6561279,4.0018311,17,4z M9,5c0.0014038-1.1040039,0.8959961-1.9985962,2-2h2c1.1040039,0.0014038,1.9985962,0.8959961,2,2v2H9V5z M19,19c-0.0014038,1.1040039-0.8959961,1.9985962-2,2H7c-1.1040039-0.0014038-1.9985962-0.8959961-2-2V7c0.0014038-1.1040039,0.8959961-1.9985962,2-2h1v2.5006104C8.0001831,7.7765503,8.223999,8.0001831,8.5,8h7.0006104C15.7765503,7.9998169,16.0001831,7.776001,16,7.5V5h1c1.1040039,0.0014038,1.9985962,0.8959961,2,2V19z">
                                </path>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12 col-lg-6 col-xl-3">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-8">
                        <h4>Đơn Hàng Đã Giao</h4>
                        <p id="count_delivered_order"></p>
                    </div>
                    <div class="col-4">
                        <div
                            class="hpx-50 wpx-50 bg-primary br-5 d-flex align-items-center justify-content-center ms-auto">
                            <svg xmlns="http://www.w3.org/2000/svg" class="text-white w-icn"
                                enable-background="new 0 0 24 24" viewBox="0 0 24 24">
                                <path
                                    d="M17,4h-1.1846313C15.4013672,2.8383179,14.3035889,2.0014648,13,2h-2C9.6964111,2.0014648,8.5986328,2.8383179,8.1846313,4H7C5.3438721,4.0018311,4.0018311,5.3438721,4,7v12c0.0018311,1.6561279,1.3438721,2.9981689,3,3h10c1.6561279-0.0018311,2.9981689-1.3438721,3-3V7C19.9981689,5.3438721,18.6561279,4.0018311,17,4z M9,5c0.0014038-1.1040039,0.8959961-1.9985962,2-2h2c1.1040039,0.0014038,1.9985962,0.8959961,2,2v2H9V5z M19,19c-0.0014038,1.1040039-0.8959961,1.9985962-2,2H7c-1.1040039-0.0014038-1.9985962-0.8959961-2-2V7c0.0014038-1.1040039,0.8959961-1.9985962,2-2h1v2.5006104C8.0001831,7.7765503,8.223999,8.0001831,8.5,8h7.0006104C15.7765503,7.9998169,16.0001831,7.776001,16,7.5V5h1c1.1040039,0.0014038,1.9985962,0.8959961,2,2V19z">
                                </path>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<script src="{{ asset('admin_template/assets/jquery-3.7.1.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
<script src="https://momentjs.com/downloads/moment-with-locales.js"></script>
<script>
    var $j = jQuery.noConflict();

    $j(document).ready(function(){
        $j('.datePicker').datepicker({
            format: 'dd/mm/yyyy'
        });
        $j('#btnSearch').click(function(){
            var dateStart = moment($j('#dateStart').val(),'DD-MM-YYYY').format('YYYY-MM-DD');
            console.log($j('#dateStart').val());
            console.log($j('#dateEnd').val());
            var dateEnd = moment($j('#dateEnd').val(),'DD-MM-YYYY').format('YYYY-MM-DD');
            $j.ajax({
                url:"{{route('search-dashboard')}}",
                data:{
                    dateStart:dateStart,
                    dateEnd:dateEnd
                },
                success: function($response) {
                    // console.log($response);
                    $('#count_cancel_order').html($response.statistics.count_cancel_order);
                    $('#count_approve_order').html($response.statistics.count_approve_order);
                    $('#count_delivered_order').html($response.statistics.count_delivered_order);
                    $('#count_delivering_order').html($response.statistics.count_delivering_order);
                    $('#count_order').html($response.statistics.count_order);
                    $('#count_purchase_order').html($response.statistics.count_purchase_order);
                    $('#revenue').html(Number($response.statistics.revenue).toLocaleString('vi') +" VNĐ");
                }
            });
        })
    })
</script>

@endsection