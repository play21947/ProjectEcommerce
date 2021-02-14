<?php

include "function.php";

    session_start();

    if(empty($_SESSION['name'])){
        echo "<script>window.location.href='index.php'</script>";
    }

    if(isset($_POST['logout-btn'])){
        unset($_SESSION['name']);
        echo "<script>window.location.href='index.php'</script>";
    }

    if(isset($_POST['add-product'])){

        $database_con = new DB_con();

        $name_pd = $_POST['name'];
        $price_pd = $_POST['price'];
        $url_pd = $_POST['url'];

        $insert = $database_con->Add_product($name_pd, $price_pd, $url_pd);

        if($insert){
            echo "<script>alert('เพิ่มสินค้าเรียบร้อย')</script>";
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
    <title>Home</title>
    <style>
        body{
            font-family: 'Prompt', sans-serif;
        }
    </style>
</head>
<body>
    <div class="container card" style="background-color: #F8F6F8;">
        <img style="border:1px solid black; border-radius:2px;" class="img-fluid" src="./img/back.jpg">
        <div>
            <form method='post'>
                <?php 

                    $database_con = new DB_con();

                    $check = $_SESSION['name'];

                    $payload = $database_con->switch_name($check);

                    $num = mysqli_fetch_array($payload);

                    if(empty($num['fname'])){
                        $name = $_SESSION['name'];
                    }
                    else{
                        $name = $num['fname'];
                    }
                
                ?>
                <h2 class="mt-3"><?php echo $name?></h2>
                <button type="submit" name="logout-btn" class="btn btn-danger">ออกจากระบบ</button>
                <a href="custom.php" class="btn btn-secondary">ตั้งค่า</a>
                <a href="keep_money.php" class="btn btn-primary">ออมเงิน</a>
                <a href="cart.php"><img class="btn btn-outline-success" width="70px" src="./img/car_cart2.jpg"></a>
            </form>
        </div>

        

     <!-- Button trigger modal -->
    <?php
    
        $database = new DB_con();

        $dat = $database->Check_role($_SESSION['name']);

        while($row = mysqli_fetch_array($dat)){

            if($row['role'] == 1){

    
    ?>

    <button type="button" class="btn btn-success mt-3 mb-3" data-bs-toggle="modal" data-bs-target="#exampleModal">
    เพิ่มสินค้า
    </button>

    <?php
            }

        }
    
    ?>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">เพิ่มสินค้า</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method='post'>
                    <input type="text" placeholder="กรอกชื่อสินค้า" class="form-control" name="name" required><br>
                    <input type="text" placeholder="ราคาสินค้า" class="form-control" name="price" required><br>
                    <input type="text" placeholder="url ของสินค้า(เพื่อเพิ่มรูปภาพ)" class="form-control" name="url" required>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
                <button type="submit" class="btn btn-primary" name="add-product">วางขายสินค้า</button>
                </form>
            </div>
            </div>
        </div>
    </div>
    <!--Modal scope-->
    </div>
    <?php
    
        $DB_con = new DB_con();

        $data = $DB_con->Get_Product();

        if(!empty($data)){
            foreach($data as $num){

    ?>
    <div class="container mt-5">
        <div class="row g-2 container">
                <div class='card container' style="background-color: #F8F6F8;">
                    <div class='card-title'><h3><?php echo $num['name']?></h3></div>
                    <div><h4 style="color:green;">ราคา : <?php echo $num['price']?></h4></div>
                    <div class='card-body'><img class="container img-fluid" src="<?php echo $num['img']?>"></div>
                    <form method="post" action="cart.php?act=add&id=<?php echo $num['id'];?>">
                        <button type="submit" name='buy-btn' class='container btn btn-success mb-3'>สั่งซื้อ</button>
                    </form>
                </div>
        </div>
    </div>
    <?php    
        }
    }
    ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js" integrity="sha384-KsvD1yqQ1/1+IA7gi3P0tyJcT3vR+NdBTt13hSJ2lnve8agRGXTTyNaBYmCR/Nwi" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.min.js" integrity="sha384-nsg8ua9HAw1y0W1btsyWgBklPnCUAFLuTMS2G72MMONqmOymq585AcH49TLBQObG" crossorigin="anonymous"></script>
</body>
</html>