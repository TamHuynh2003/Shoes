<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Danh Mục Giày</title>
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
            <th>Danh Mục </th>
            <th>Trạng Thái</th>
        </tr>
        @foreach ($categories as $category)
        <tr>
            <td><strong>{{ $category->id }}</strong></td>
            <td>{{ $category->name }}</td>
            <td>
                <span style="color:forestgreen">Đang còn</span>
            </td>
        </tr>
        @endforeach
    </table>

</body>

</html>