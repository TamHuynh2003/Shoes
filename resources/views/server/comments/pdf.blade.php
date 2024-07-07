<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Đánh Giá Sản Phẩm</title>
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
            <th>Người Đánh Giá </th>
            <th>Sản Phẩm Đánh Giá </th>
            <th>Nội Dung Đánh Giá </th>
            <th>Số Sao Đánh Giá </th>
            <th>Trạng Thái</th>
        </tr>
        @foreach ($comments as $comment)
        <tr>
            <td><strong>{{ $comment->id }}</strong></td>
            <td>{{ $comment->users->fullname }}</td>
            <td>{{ $comment->products->name }}</td>
            <td>{{ $comment->content }}</td>
            <td>{{ $comment->rating }}</td>
            <td>
                <span style="color:forestgreen">Tồn Tại</span>
            </td>
        </tr>
        @endforeach
    </table>

</body>

</html>