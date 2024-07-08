@foreach ($listOrders as $orders)
<tr>
    <td><strong>{{ $loop->iteration }}</strong></td>

    <td><span>{{ $orders->order_date }}</span></td>
    <td><span>{{ number_format($orders->total_price )}}</span></td>

    <td><span>{{ $orders->users->fullname }}</span></td>
    {{-- <td><span>{{ $orders->discounts->name }}</span></td> --}}

    <td><span>{{ $orders->payment_methods->name }}</span></td>
    {{-- <td>
        <span>{{ $orders->status->name }}</span>
    </td> --}}
    <td>
        <span @if($orders->status_id == 1)
            style="color: rgb(232, 186, 17);"
            @elseif($orders->status_id == 2)
            style="color: rgb(239, 116, 14)"
            @elseif($orders->status_id == 3)
            style="color: red;"
            @elseif($orders->status_id == 4)
            style="color: rgb(15, 127, 224);"
            @elseif($orders->status_id == 5)
            style="color:forestgreen"
            @endif
            >
            {{ $orders->status->name }}
        </span>
    </td>
    <td>
        <div class="d-flex align-items-stretch">
            <!--Verify-->
            @if($orders->status_id == 1)
            <a data-id="{{ $orders->id }}" class="btn btn-sm btn-outline-primary border me-2" data-bs-toggle="tooltip"
                data-action="cập nhập trạng thái đơn hàng thành đã duyệt"
                href="{{ route('orders.status', ['id' => $orders->id, 'status' => '2']) }}"
                data-bs-original-title="Duyệt">

                <i class="fe fe-edit-2 "></i>
            </a>
            @elseif ($orders->status_id == 2)
            <a data-id="{{ $orders->id }}" class="btn btn-sm btn-outline-primary border me-2" data-bs-toggle="tooltip"
                data-action="cập nhập trạng thái đơn hàng thành đang giao"
                href="{{ route('orders.status', ['id' => $orders->id, 'status' => '4']) }}"
                data-bs-original-title=" Duyệt">

                <i class="fe fe-edit-2 "></i>
            </a>
            @elseif($orders->status_id == 4)
            <a data-id="{{ $orders->id }}" class="btn btn-sm btn-outline-primary border me-2" data-bs-toggle="tooltip"
                data-action="cập nhập trạng thái đơn hàng thành đã giao"
                href="{{ route('orders.status', ['id' => $orders->id, 'status' => '5']) }}"
                data-bs-original-title="Duyệt ">

                <i class="fe fe-edit-2 "></i>
            </a>
            @endif

            <!--Details-->
            <a class=" btn btn-sm btn-outline-info border me-2" data-bs-original-title=" Chi Tiết"
                href="{{route('orders.show',['id' => $orders->id])}}" data-bs-toggle="tooltip">

                <i class="fe fe-info"></i>
            </a>

            <!--Delete-->
            <a data-id="{{ $orders->id }}" data-action="xóa" data-bs-original-title="Xóa"
                href="{{ route('orders.delete', ['id' => $orders->id]) }}" data-bs-toggle="tooltip"
                class="btn btn-sm btn-outline-secondary border me-2 delete-link">

                <i class="fe fe-trash-2 "></i>
            </a>
        </div>
    </td>
</tr>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.delete-link').forEach(function(link) {
            link.addEventListener('click', function(event) {
                event.preventDefault();

                var route = this.getAttribute('data-route');
                var id = this.getAttribute('data-id');
                var action = this.getAttribute('data-action');

                Swal.fire({
                    title: 'Xác nhận?',
                    text: 'Bạn có chắc muốn ' + action + ' hóa đơn ' + id + ' không?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Đồng ý',
                    cancelButtonText: 'Hủy bỏ',
                }).then(function(result) {
                    if (result.isConfirmed) {
                        window.location.href = route;
                    }
                });
            });
        });
    });
</script>

@endforeach