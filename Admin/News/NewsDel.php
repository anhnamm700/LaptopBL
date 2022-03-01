<?php
    include_once '../connect.php';
    $id = $_GET['NewsID'];
    
    $sqlDel = "delete from news where NewsID='$id'";
    $result = mysqli_query($conn, $sqlDel);

    if ($result) {
        echo("<script>location.href = 'index.php?page=ShowNews';</script>");
    }
?>