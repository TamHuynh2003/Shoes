<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VNPay Payment</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .payment-form {
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
        }

        .payment-form h2 {
            margin-bottom: 20px;
            color: #333;
        }

        .payment-form .form-group {
            margin-bottom: 15px;
        }

        .payment-form label {
            display: block;
            margin-bottom: 5px;
            color: #555;
        }

        .payment-form input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        .payment-form button {
            width: 100%;
            padding: 10px;
            background: #28a745;
            border: none;
            border-radius: 4px;
            color: #fff;
            font-size: 16px;
            cursor: pointer;
        }

        .payment-form button:hover {
            background: #218838;
        }
    </style>
</head>

<body>
    <div class="payment-form">
        <h2>Thanh toán VNPay</h2>
        <form action="{{ route('create_payment') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="amount">Số tiền:</label>
                <input type="number" id="amount" name="amount" value="{{ $total }}" required>
            </div>
            <button type="submit">Thanh toán</button>
        </form>
    </div>
</body>

</html>
