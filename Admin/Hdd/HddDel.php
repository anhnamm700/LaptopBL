<?php
    include_once '../connect.php';
    $id = $_GET['HddID'];
    
    $sqlDel = "DELETE FROM hdd WHERE HddID='$id'";
    $result = mysqli_query($conn, $sqlDel); 

    if ($result) {
       echo("<script>location.href = 'index.php?page=ShowHdd';</script>");
    }
?>