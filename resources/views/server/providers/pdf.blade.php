<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Nhà Cung Cấp</title>
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

        .underline {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <table class="table table-hover">
        <tr>
            <th>STT</th>
            <th>Nhà Cung Cấp</th>
            <th>Địa Chỉ</th>
            <th>Email</th>
            <th>Điện Thoại</th>
            <th>Mô Tả</th>
            <th>Trạng Thái</th>
        </tr>
        @foreach ($providers as $provider)
        <tr>
            <td><strong>{{ $provider->id }}</strong></td>
            <td>{{ $provider->name }}</td>
            <td>{{ $provider->address }}</td>
            <td class="underline">{{ $provider->email }}</td>
            <td><strong>{{ $provider->phone_number }}</strong></td>
            <td>{{ $provider->descriptions}}</td>
            <td>
                <span style="color:forestgreen">Đang cung cấp</span>
            </td>
        </tr>
        @endforeach
    </table>

</body>

</html>