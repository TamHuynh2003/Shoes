<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Sản Phẩm</title>
    <style>
        * {
            font-family: DejaVu Sans, sans-serif;
        }

        body {
            font-size: 14px;
        }

        td,
        th {
            vertical-align: middle;
            text-align: center;
            padding: 5px;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }
    </style>
</head>

<body>
    <table class="table table-hover">
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
        @foreach ($products as $product)
        <tr>
            <td><strong>{{ $product->id }}</strong></td>
            <td>{{ $product->name }}</td>
            <td>{{ $product->descriptions }}</td>
            <td>{{ number_format($product->purchase_price) }}</td>
            <td>{{ number_format($product->selling_price)}}</td>
            <td>{{ $product->rating}}</td>
            <td>{{ $product->categories->name }}</td>
            <td>{{ $product->providers->name }}</td>
            <td>
                <span style="color:forestgreen">Còn hàng</span>
            </td>
        </tr>
        @endforeach
    </table>

</body>

</html>