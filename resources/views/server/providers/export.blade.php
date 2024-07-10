<table>
    <thead>
        <tr>
            <th>STT</th>
            <th>Nhà Cung Cấp</th>
            <th>Địa Chỉ</th>
            <th>Email</th>
            <th>Điện Thoại</th>
            <th>Mô Tả</th>
            <th>Trạng Thái</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($providers as $provider)
        <tr>
            <td>{{ $provider->id }}</td>
            <td>{{ $provider->name }}</td>
            <td>{{ $provider->address }}</td>
            <td>{{ $provider->email }}</td>
            <td>{{ $provider->phone_number }}</td>
            <td>{{ $provider->descriptions}}</td>
            <td>Đang cung cấp</td>
        </tr>
        @endforeach
    </tbody>
</table>