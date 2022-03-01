<?php
    include '../../connect.php';
    
    $sqlCheckEmail = "SELECT * from account WHERE Email LIKE '".$_GET['email']."'";
    $result = mysqli_query($conn, $sqlCheckEmail);
    
    if ($result !== false && $result->num_rows > 0) { // kiểm tra email tồn tại hay chưa
        echo json_encode(false);
    } else {
        echo json_encode(true);
    }
?>