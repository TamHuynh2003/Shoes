@extends('server.master')

@section('content')

<div class="page-header">

    <div class="ms-auto pageheader-btn">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Đơn Hàng</a></li>
            <li class="breadcrumb-item active" aria-current="page">Thùng Rác</li>
        </ol>
    </div>

</div>

<div class="row">
    <div class="col-12 col-sm-12">
        <div class="card product-sales-main">
            <div class="card-header border-bottom d-flex justify-content-between align-items-center">
                <div>
                    <a href="{{route('orders.index')}}" class="btn btn-primary me-2">Trở Lại</a>
                </div>

            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="data-table" class="table text-nowrap mb-0 table-bordered">
                        <thead class="table-head">
                            <tr>
                                <th>STT</th>
                                <th>Ngày Đặt Hàng</th>
                                {{-- <th>Tổng Tiền</th> --}}
                                <th>Người Đặt</th>
                                <th>Mã giảm Giá</th>
                                <th>Thanh Toán</th>
                                <th>Trạng Thái</th>
                                <th>Chức Năng</th>
                            </tr>
                        </thead>
                        <tbody class="table-body">
                            @foreach ($listOrders as $orders)
                            <tr>
                                <td><strong>{{ $loop->iteration }}</strong></td>

                                <td><span>{{ $orders->order_date }}</span></td>
                                {{-- <td><span>{{ number_format($orders->selling_price*$orders->quantity) }}</span></td>
                                --}}

                                <td><span>{{ $orders->users->fullname }}</span></td>

                                <td>
                                    <span>
                                        @if ($orders->discount)
                                        {{ $orders->discount->name }}
                                        @else
                                        Không có mã!
                                        @endif
                                    </span>
                                </td>

                                <td><span>{{ $orders->payment_methods->name }}</span></td>
                                {{-- <td>
                                    <span>{{ $orders->status->name }}</span>
                                </td> --}}
                                <td>
                                    <span style="color: red;">
                                        {{ $orders->status->name }}
                                    </span>
                                </td>
                                <td>
                                    <div class="d-flex align-items-stretch">
                                        <!--Verify-->
                                        @if ($orders->status_id == 1)
                                        <a data-id="{{ $orders->id }}"
                                            class="btn btn-sm btn-outline-primary border me-2" data-bs-toggle="tooltip"
                                            data-action="cập nhập trạng thái đơn hàng thành đã duyệt"
                                            href="{{ route('orders.status', ['id' => $orders->id, 'status' => '2']) }}"
                                            data-bs-original-title="Duyệt">

                                            <i class="fe fe-edit-2 "></i>
                                        </a>
                                        @elseif ($orders->status_id == 2)
                                        <a data-id="{{ $orders->id }}"
                                            class="btn btn-sm btn-outline-primary border me-2" data-bs-toggle="tooltip"
                                            data-action="cập nhập trạng thái đơn hàng thành đang giao"
                                            href="{{ route('orders.status', ['id' => $orders->id, 'status' => '4']) }}"
                                            data-bs-original-title=" Duyệt">

                                            <i class="fe fe-edit-2 "></i>
                                        </a>
                                        @elseif($orders->status_id == 4)
                                        <a data-id="{{ $orders->id }}"
                                            class="btn btn-sm btn-outline-primary border me-2" data-bs-toggle="tooltip"
                                            data-action="cập nhập trạng thái đơn hàng thành đã giao"
                                            href="{{ route('orders.status', ['id' => $orders->id, 'status' => '5']) }}"
                                            data-bs-original-title="Duyệt ">

                                            <i class="fe fe-edit-2 "></i>
                                        </a>
                                        @endif

                                        <!--Details-->
                                        <a class=" btn btn-sm btn-outline-info border me-2"
                                            data-bs-original-title=" Chi Tiết"
                                            href="{{route('orders.show',['id' => $orders->id])}}"
                                            data-bs-toggle="tooltip">
                                            <i class="fe fe-info"></i>
                                        </a>

                                        <!--Delete-->
                                        {{-- <a data-id="{{ $orders->id }}" data-action="xóa"
                                            data-bs-original-title="Xóa"
                                            href="{{ route('orders.delete', ['id' => $orders->id]) }}"
                                            data-bs-toggle="tooltip"
                                            class="btn btn-sm btn-outline-secondary border me-2 delete-link">

                                            <i class="fe fe-trash-2 "></i>
                                        </a> --}}
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.delete-link').forEach(function (link) {
            link.addEventListener('click', function (event) {
                event.preventDefault();

                var route = this.getAttribute('data-route');
                var name = this.getAttribute('data-name');

                Swal.fire({
                    title: 'Xác Nhận Xóa Mã Giảm Giá?',
                    text: 'Bạn có chắc muốn xóa mã giảm giá ' + " '" + name + "' " + ' không?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Xóa',
                    cancelButtonText: 'Hủy',
                }).then(function (result) {
                    if (result.isConfirmed) {
                        window.location.href = route;
                    }
                });
            });
        });
    });
</script>

@endsection