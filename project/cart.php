<?php

    include("function.php");

    session_start();

    $id = $_GET['id'];
    $act = $_GET['act'];

    if($act == 'add' && !empty($id)){
        if(isset($_SESSION['cart'][$id])){
            $_SESSION['cart'][$id]++;
        }
        else{
            $_SESSION['cart'][$id] = 1;
        }
    }

    if(isset($_POST['btn-clear'])){
        unset($_SESSION['cart']);
    }

    if(isset($_POST['btn-confirm'])){
        echo "<script>alert('สั่งสินค้าเรียบร้อยกรุณารอสักครู่...')</script>";
        echo "<script>window.location.href='order_page.php'</script>";
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
    <style>
        body{
            font-family: 'Prompt', sans-serif;
        }
    </style>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
</head>
<body>
<table class="table">
        <thead>
            <tr>
                <td></td>
                <td>ชื่อ</td>
                <td>ราคา/หน่วย</td>
                <td>จำนวน</td>
                <td>ทั้งหมด(บาท)</td>
            </tr>
        <tbody>
    <?php

        $total = 0;
        if(!empty($_SESSION['cart'])){

            //include("function.php");

            $DB_con = new DB_con();

            foreach($_SESSION['cart'] as $id=>$qty){
                $data = $DB_con->Get_Product_ID($id);

                while($num = mysqli_fetch_array($data)){

                    $price = $qty * $num['price'];
                    $total = $total + $price;

    ?>
            <tr>
                <td><img class="img-fluid" style="border: 1px solid black; border-radius: 3px" width="300px" src="<?php echo $num['img']?>"></td>
                <td><h3><?php echo $num['name']?></h3></td>
                <td><h3><?php echo $num['price']?></h3></td>
                <td><h3><?php echo $qty?></h3></td>
                <td><h3 style="color:green"><?php echo $price?></h3></td>
            </tr>
    <?php
                }
            }
        }
        else{
            echo "<h1>ไม่พบสินค้าที่เลือก!</h1>";
        }
    ?>
    </tbody>
    </table>
    <form style="margin:20px" method='post'>
        <button class="btn btn-warning" type="submit" name="btn-clear">ลบสิ้นค้าในตะกร้าทั้งหมด</button>
        <a href="home.php" class='btn btn-danger'>เลือกดูสินค้าต่อ</a>
    </form>
    <form method="post" style="margin:20px">
            <button class="btn btn-success" type="submit" name="btn-confirm">ยืนยันการสั่งซื้อ</button>
    </form>
    
    <h1 style="margin:20px">ราคารวมทั้งสิ้น : <?php echo $total?> บาท</h1>
</body>
</html>