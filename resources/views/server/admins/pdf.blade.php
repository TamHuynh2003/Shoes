<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Quản Trị Viên PDF</title>
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
            <th>Quản Trị </th>
            <th>Địa Chỉ</th>
            <th>Điện Thoại</th>
            <th>Email</th>
            <th>Trạng Thái</th>
        </tr>
        @foreach ($admins as $admin)
        <tr>
            <td><strong>{{ $admin->id }}</strong></td>
            <td>{{ $admin->fullname }}</td>
            <td>{{ $admin->address }}</td>
            <td><strong>{{ $admin->phone_number }}</strong></td>
            <td class="underline">{{ $admin->email }}</td>
            <td>
                <span style="color:forestgreen">{{ $admin->status->name }}</span>
            </td>
        </tr>
        @endforeach
    </table>

</body>

</html>