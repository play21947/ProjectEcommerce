<?php include "function.php";

    session_start();

    if(!empty($_SESSION['name'])){
        echo "<script>window.location.href='home.php'</script>";
    }

    $DB_con = new DB_con();

    if(isset($_POST['submit'])){
        $username = $_POST['username'];
        $password = $_POST['password'];

        $data = $DB_con->Login($username);

        $num = mysqli_fetch_array($data);

        if(password_verify($password, $num['password'])){
            $_SESSION['name'] = $num['username'];
            echo "<script>alert('เข้าสู่ระบบ')</script>";
            echo "<script>window.location.href='home.php'</script>";
        }
        else{
            echo "<script>alert('ชื่อผู้ใช้หรือรหัสผ่านผิด')</script>";
        }
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

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <title>ร้านขายของออนไลน์</title>
    <style>
        #write{
            animation: type 1.5s steps(13);
            overflow: hidden;
            white-space: nowrap;
            border-right: 4px solid black;
            width: 13ch;
        }

        @keyframes type{
            0%{
                width: 0ch;
            }
            100%{
                width: 13ch;
            }
        }

        body{
            font-family: 'Prompt', sans-serif;
        }
    </style>
</head>
<body style="background-color: #F8F6F8;">
    <div class="container">
        <h1 id='write' style="margin-top:50px">ร้านขายของออนไลน์</h1>
        <hr>
        <form method="post">
            <input type="text" placeholder="ชื่อผู้ใช้" name="username" class="form-control"><br>
            <input type="text" placeholder="รหัสผ่าน" name="password" class="form-control"><br>
            <button type="submit" name="submit" class="btn btn-outline-success" onclick="">เข้าสู่ระบบ</button>
            <a href="register.php" class="btn btn-outline-danger">สมัครสมาชิก</a>
            <a href="forgot_pass.php">ลืมรหัสผ่าน</a>
        </form>
    </div>
</body>
</html>