<table>
    <thead>
        <tr>
            <th>STT</th>
            <th>Mã Giảm Giá </th>
            <th>Phần Trăm Giảm Giá </th>
            <th>Loại Giảm Giá </th>
            <th>Ngày Áp Dụng </th>
            <th>Ngày Hết Hạn </th>
            <th>Trạng Thái</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($discounts as $discount)
        <tr>
            <td>{{ $discount->id }}</td>
            <td>{{ $discount->name }}</td>
            <td>{{ $discount->amount }}</td>
            <td>{{ $discount->type_discounts->name }}</td>
            <td>{{ $discount->start_date }}</td>
            <td>{{ $discount->end_date }}</td>
            <td>Đang áp dụng</td>
        </tr>
        @endforeach
    </tbody>
</table>