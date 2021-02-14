<?php include('function.php');

    $id = $_GET['id'];
    $delete = $_GET['delete'];

    if($delete == 'yes' && !empty($id)){
        $DB_con = new DB_con();

        $done = $DB_con->Done_Order($id);
        echo "<script>window.location.href='order_page.php'</script>";
    }


?>