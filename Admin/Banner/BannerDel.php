<?php
    include_once '../connect.php';
    $id = $_GET['BannerID'];
    
    $sqlDel = "delete from banner where BannerID='$id'";
    $result = mysqli_query($conn, $sqlDel);

    if ($result) {
        echo("<script>location.href = 'index.php?page=ShowBanner';</script>");
    }
?>