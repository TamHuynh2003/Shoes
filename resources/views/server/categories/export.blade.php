<table>
    <thead>
        <tr>
            <th>STT</th>
            <th>Danh Mục </th>
            <th>Trạng Thái</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($categories as $category)
        <tr>
            <td>{{ $category->id }}</td>
            <td>{{ $category->name }}</td>
            <td>Đang còn</td>
        </tr>
        @endforeach
    </tbody>
</table>