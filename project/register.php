<?php include "function.php";

    if(isset($_POST['submit'])){
        $username = $_POST['username'];
        $password1 = $_POST['password1'];
        $password2 = $_POST['password2'];
        $email = $_POST['email'];

        if(!$username || !$password1 || !$password2 || !$email){
            echo "<script>alert('กรุณากรอกข้อมูลให้ครบ')</script>";
        }
        else{
            $DB_con = new DB_con();

            $check = $DB_con->Check_Register($username);

            $num = mysqli_fetch_array($check);

            if($num > 0){
                echo "<script>alert('มีไอดีผู้ใช้นี้แล้ว')</script>";
            }
            else{
                if($password1 == $password2){
                    $password = password_hash($password1, PASSWORD_DEFAULT);

                    $insert = $DB_con->Register($username, $password, $email);

                    if($insert){
                        echo "<script>alert('สมัครสมาชิกเสร็จสิ้น')</script>";
                        echo "<script>window.location.href='index.php'</script>";
                    }
                }
                else{
                    echo "<script>alert('รหัสผ่านไม่ตรงกัน')</script>";
                }
            }
        }
    }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Prompt:wght@300&display=swap" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body{
            font-family: 'Prompt', sans-serif;
        }
    </style>
    <title>Document</title>
</head>
<body style="background-color: #F8F6F8;">
    <div class="container" style="margin-top: 50px;">
        <h1>สมัครสมาชิก</h1>
        <hr>
        <form method="post">
            <input type="text" placeholder="ชื่อผู้ใช้" name="username" class='form-control'><br>
            <input type="text" placeholder="รหัสผ่าน" name="password1" class='form-control'><br>
            <input type="text" placeholder="ยืนยันรหัสผ่าน" name="password2" class='form-control'><br>
            <input type="email" placeholder="อีเมลล์" name="email" class='form-control'><br>
            <button type="submit" name="submit" class="btn btn-success">ยืนยัน</button>
            <a href="index.php" class="btn btn-danger">กลับไปหน้าหลัก</a>
        </form>
    </div>
</body>
</html>