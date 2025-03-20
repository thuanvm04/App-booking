<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
            max-width: 600px;
            margin: auto;
        }
        h1 {
            color: #333;
        }
        p {
            color: #666;
        }
        .button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 20px;
            display: inline-block;
        }
    </style>
</head>
<body>
    


<div class="mt-5">
    <div class="container  ">
        <h1>Cảm ơn bạn đã đặt phòng!</h1>
        <p>Chúng tôi đã nhận được yêu cầu đặt phòng của bạn và sẽ liên hệ lại với bạn sớm nhất có thể.</p>
        <p>Thông tin đặt phòng của bạn:</p>
        <ul class="list-unstyled" >
            <li>Tên khách hàng: <strong>{{ Auth::user()->name }}</strong></li>
            <li>Email: <strong>{{ $booking->email }}</strong></li>
            <li>Số điện thoại: <strong>{{ $booking->phone }}</strong></li>
           
            <li>Ngày nhận phòng: <strong>{{ $booking->check_in_date }}</strong></li>
            <li>Ngày trả phòng: <strong>{{ $booking->check_out_date }}</strong></li>
        </ul>
        <a href="{{ route('home') }}" class="btn btn-primary">Quay lại trang chủ</a>
    </div>
</div>


</body>
</html>