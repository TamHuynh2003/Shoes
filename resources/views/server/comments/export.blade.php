<table>
    <thead>
        <tr>
            <th>STT</th>
            <th>Người Đánh Giá</th>
            <th>Sản Phẩm Đánh Giá</th>
            <th>Nội Dung Đánh Giá</th>
            <th>Số Sao Đánh Giá</th>
            <th>Trạng Thái</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($comments as $comment)
        <tr>
            <td>{{ $comment->id }}</td>
            <td>{{ $comment->users->fullname }}</td>
            <td>{{ $comment->products->name }}</td>
            <td>{{ $comment->content }}</td>
            <td>{{ $comment->rating }}</td>
            <td>Tồn Tại</td>
        </tr>
        @endforeach
    </tbody>
</table>