<?php include "function.php";

    session_start();

    print_r($_SESSION);

    if(isset($_POST['submit'])){
        echo "<script>window.location.href='home.php'</script>";
    }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Prompt:wght@300&display=swap" rel="stylesheet">
    <title>รายการอาหาร</title>
    <style>
        body{
            font-family: 'Prompt', sans-serif;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>รายการอาหาร</h1>
        <hr>
    </div>
    <div class="container">
        <table class="table">
            <thead>
                <tr>
                    <td>ชื่อผู้สั่ง</td>
                    <td>ชื่ออาหาร</td>
                    <td>จำนวน</td>
                    <td>เสร็จสิ้น</td>
                </tr>
            </thead>
            <tbody>
            <?php
            
                $DB_con = new DB_con();
                
                
                foreach($_SESSION['cart'] as $id => $qty){ //หาว่า session ไอดี มี กี่ตัว เเล้วเก็บในตัวเเปร qty
                    $data = $DB_con->Get_Product_ID($id); //เอา id ที่หาได้ ไปดึงค่ามาตามไอดี ใน DB
                    $data_name = $DB_con->Get_Account();

                    $row = mysqli_fetch_array($data_name);

                    $num = mysqli_fetch_array($data);

                    if(!empty($row['fname'])){
                        $name_user = $_SESSION['name'];
                    }
                    else{
                        $name_user = $row['fname'];
                    }

                    $name_product = $num['name'];
                    if($qty == 1){
                        $qty_product = 1;
                    }
                    else if($qty == 0){
                        $qty_product = 1;
                    }
                    else{
                        $qty_product = $qty-1;
                    }
    
                    $database = new DB_con();
                    $add_order = $database->Insert_Order($name_user, $name_product, $qty_product);

                    unset($_SESSION['cart']);
                }
            ?>
            <?php

                $mysql = new DB_con();

                $payload = $mysql->Get_Order();

                while($item = mysqli_fetch_array($payload)){
            
            ?>
                <tr>
                    <td><?php echo $item['name_user']?></td>
                    <td><?php echo $item['name_product']?></td>
                    <td><?php echo $item['quantity']?></td>
                    <form method="post" action="delete.php?delete=yes&id=<?php echo $item['id']?>">
                        <td><button class="btn btn-outline-success">เสร็จสิ้น</button></td>
                    </form>
                </tr>
                <?php
                
                }

                ?>
            </tbody>
        </table>
        <div>
            <form method="post">
                <button type="submit" name="submit" class="bnt btn-danger">กลับไปหน้าหลัก</button>
            </form>
        </div>
    </div>
</body>
</html>