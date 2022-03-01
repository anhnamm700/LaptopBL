<?php
    include '../../connect.php';
    session_start();
    
    $id = array_keys($_POST['quantity'])[0];
    $quantity = $_POST['quantity'][$id];
  
    $quantityPro = mysqli_query($conn, "SELECT Quantity FROM products WHERE ProductID = '$id'");
    $quantityAs = mysqli_fetch_assoc($quantityPro);

    if (isset($_SESSION['cart'][$id])) {
        $quantity += $_SESSION['cart'][$id];
    }

    if ( $quantity > $quantityAs['Quantity']) {
       echo json_encode('Số lượng sản phẩm không đủ, bạn chỉ có thể mua tối đa là '.$quantityAs['Quantity'].' sản phẩm, vui lòng nhập lại số lượng ở trong giỏ hàng!');
    } else {
        echo json_encode(true);
    }
?>