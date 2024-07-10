<table>
    <thead>
        <tr>
            <th>STT</th>
            <th>Người Dùng</th>
            <th>Địa Chỉ</th>
            <th>Điện Thoại</th>
            <th>Email</th>
            <th>Trạng Thái</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($users as $user)
        <tr>
            <td>{{ $user->id }}</td>
            <td>{{ $user->fullname }}</td>
            <td>{{ $user->address }}</td>
            <td>{{ $user->phone_number }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->status->name }}</td>
        </tr>
        @endforeach
    </tbody>
</table>