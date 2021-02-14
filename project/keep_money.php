<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <title>ออมเงิน</title>
</head>
<body>
    <div class="container">
        <h1>ออมเงิน</h1>
        <a class="btn btn-danger" href="home.php">ย้อนกลับ</a>
        <hr>
    </div>
    <?php include "function.php";

        $DB_con = new DB_con();

        $data = $DB_con->Get_btn();

        $total = 0;

        while($num = mysqli_fetch_array($data)){

            if($num['status'] == 1){
    
    ?>
    <form method="post" action="set_status.php?id=<?php echo $num['id']?>">
    <div class="container">
        <div class="row g-2">
            <div class="col-6">
                <div class="p-3 border bg-light"><button class="btn btn-outline-success container"><?php echo $num['id']?></button></div>
            </div>
        </div>
    </div>
    </form>

    <?php
        }
        else if($num['status'] == 0){
            $total = $total + $num['id'];
        }
    }
    
    ?>

    <h1 class="container"><?php echo $total?></h1>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js" integrity="sha384-KsvD1yqQ1/1+IA7gi3P0tyJcT3vR+NdBTt13hSJ2lnve8agRGXTTyNaBYmCR/Nwi" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.min.js" integrity="sha384-nsg8ua9HAw1y0W1btsyWgBklPnCUAFLuTMS2G72MMONqmOymq585AcH49TLBQObG" crossorigin="anonymous"></script>
</body>
</html>