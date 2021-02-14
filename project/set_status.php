<?php include "function.php";

    $DB_con = new DB_con();

    $id = $_GET['id'];

    $update = $DB_con->Update_btn($id);

    echo "<script>window.location.href='keep_money.php'</script>";

?>