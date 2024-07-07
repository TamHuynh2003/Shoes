<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Mã Giảm Giá Giày</title>
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
            <th>Mã Giảm Giá </th>
            <th>Phẩn Trăm Giảm Giá </th>
            <th>Loại Giảm Giá </th>
            <th>Ngày Áp Dụng </th>
            <th>Ngày Hết Hạn </th>
            <th>Trạng Thái</th>
        </tr>
        @foreach ($discounts as $discount)
        <tr>
            <td><strong>{{ $discount->id }}</strong></td>
            <td>{{ $discount->name }}</td>
            <td>{{ $discount->amount }}</td>
            <td>{{ $discount->type_discounts->name }}</td>
            <td>
                <span style="color:gold">{{ $discount->start_date }}</span>
            </td>
            <td>
                <span style="color:gold">{{ $discount->end_date}}</span>
            </td>
            <td>
                <span style="color:forestgreen">Đang còn</span>
            </td>
        </tr>
        @endforeach
    </table>

</body>

</html>