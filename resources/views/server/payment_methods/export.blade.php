<table>
    <thead>
        <tr>
            <th>STT</th>
            <th>Phương Thức Thanh Toán </th>
            <th>Trạng Thái</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($payments as $payment)
        <tr>
            <td>{{ $payment->id }}</td>
            <td>{{ $payment->name }}</td>
            <td>Đang áp dụng</td>
        </tr>
        @endforeach
    </tbody>
</table>