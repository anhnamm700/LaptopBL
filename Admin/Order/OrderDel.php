<?php
    $id = $_GET['OrderID'];

    @include('../connect.php');
    $sql = "delete from orderz where OrderID='$id'";
    $sql1 = "delete from orderdetail where OrderID='$id'";
    $result = mysqli_query($conn, $sql);
    $result2 = mysqli_query($conn, $sql1);
    
    if ($result && $result2) {
        echo("<script>location.href = 'index.php?page=ShowOrder';</script>");
    }
?>