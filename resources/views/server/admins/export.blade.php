<table>
    <thead>
        <tr>
            <th>STT</th>
            <th>Quản Trị </th>
            <th>Địa Chỉ</th>
            <th>Điện Thoại</th>
            <th>Email</th>
            <th>Trạng Thái</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($admins as $admin)
        <tr>
            <td>{{ $admin->id }}</td>
            <td>{{ $admin->fullname }}</td>
            <td>{{ $admin->address }}</td>
            <td>{{ $admin->phone_number }}</td>
            <td>{{ $admin->email }}</td>
            <td>{{ $admin->status->name }}</td>
        </tr>
        @endforeach
    </tbody>
</table>