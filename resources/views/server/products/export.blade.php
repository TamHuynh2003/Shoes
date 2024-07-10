<table>
    <thead>
        <tr>
            <th>STT</th>
            <th>Giày</th>
            <th>Mô Tả </th>
            <th>Giá Nhập</th>
            <th>Giá Bán</th>
            <th>Số Sao </th>
            <th>Danh Mục Sản Phẩm</th>
            <th>Nhà Cung Cấp</th>
            <th>Trạng Thái</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($products as $product)
        <tr>
            <td>{{ $product->id }} </td>
            <td>{{ $product->name }}</td>
            <td>{{ $product->descriptions }}</td>
            <td>{{ $product->purchase_price }}</td>
            <td>{{ $product->selling_price }}</td>
            <td>{{ $product->rating}}</td>
            <td>{{ $product->categories->name }}</td>
            <td>{{ $product->providers->name }}</td>
            <td>Còn hàng</td>
        </tr>
        @endforeach
    </tbody>
</table>