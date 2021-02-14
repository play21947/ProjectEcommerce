<?php include "function.php";

    session_start();

    if(isset($_POST['custom-btn'])){
        $fname = $_POST['fname'];
        $age = $_POST['age'];
        $email = $_POST['email'];
        $name2 = $_SESSION['name'];
        $phone = $_POST['phone'];

        $DB_con = new DB_con();

        $update = $DB_con->Update_Accounts($fname, $age, $email, $name2, $phone);

        if($update){
            echo "<script>alert('เเก้ไขข้อมูลเสร็จสิ้น')</script>";
            echo "<script>window.location.href='home.php'</script>";
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
    <style>
        body{
            font-family: 'Prompt', sans-serif;
        }
    </style>
</head>
<body style="background-color: #F8F6F8;">
    <div class="container">
        <h1 id='write' style="margin-top:50px">Ecommerce</h1>
        <hr>
        <?php

            $name = $_SESSION['name'];
            
            $DB_con = new DB_con();

            $payload = $DB_con->Get_Information($name);

            $num = mysqli_fetch_array($payload);
        
        ?>
        <form method="post">
            <input type="text" placeholder="ชื่อเล่น" name="fname" class="form-control" value="<?php echo $num['fname']?>"><br>
            <input type="text" placeholder="อายุ" name="age" class="form-control" value="<?php echo $num['age']?>"><br>
            <input type="text" placeholder="098-765-4321" name="phone" class="form-control" value="<?php echo $num['phone']?>"><br>
            <input type="text" placeholder="อีเมลล์" name="email" class="form-control" value="<?php echo $num['email']?>"><br>
            <button type="submit" name="custom-btn" class="btn btn-success">ปรับเเต่ง</button>
            <a href="home.php" class="btn btn-danger">ย้อนกลับ</a>
        </form>
    </div>
</body>
</html>