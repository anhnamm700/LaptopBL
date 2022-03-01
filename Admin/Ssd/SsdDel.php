<?php
    include_once '../connect.php';
    $id = $_GET['SsdID'];
    
    $sqlDel = "DELETE FROM ssd WHERE SsdID='$id'";
    $result = mysqli_query($conn, $sqlDel); 

    if ($result) {
       echo("<script>location.href = 'index.php?page=ShowSsd';</script>");
    }
?>