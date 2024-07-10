<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Người Dùng</title>
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
            <th>Người Dùng</th>
            <th>Địa Chỉ</th>
            <th>Điện Thoại</th>
            <th>Email</th>
            <th>Trạng Thái</th>
        </tr>
        @foreach ($users as $user)
        <tr>
            <td><strong>{{ $user->id }}</strong></td>
            <td>{{ $user->fullname }}</td>
            <td>{{ $user->address }}</td>
            <td><strong>{{ $user->phone_number }}</strong></td>
            <td class="underline">{{ $user->email }}</td>
            <td>
                <span style="color:forestgreen">{{ $user->status->name }}</span>
            </td>
        </tr>
        @endforeach
    </table>

</body>

</html>