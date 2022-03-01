<?php
    include_once '../connect.php';
    $id = $_GET['RamID'];
    
    $sqlDel = "DELETE FROM ram WHERE RamID='$id'";
    $result = mysqli_query($conn, $sqlDel); 

    if ($result) {
       echo("<script>location.href = 'index.php?page=ShowRam';</script>");
    }
?>