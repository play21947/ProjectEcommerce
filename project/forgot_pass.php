<?php


    if(isset($_POST['submit'])){
        $number_phone = $_POST['number-phone'];
    }


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Prompt:wght@300&display=swap" rel="stylesheet">
    <title>ลืมรหัสผ่าน</title>
    <style>
        body{
            font-family: 'Prompt', sans-serif;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>กู้รหัสผ่าน</h1>
        <hr>
        <form method="post">
            <label>เบอร์โทรศัพท์</label><br>
            <input type="number" name="number-phone" class="form-control" placeholder="098-765-4321"><br>
            <button type="submit" name="submit" class="btn btn-success">ส่ง OTP</button>
        </form>
    </div>
</body>
</html>