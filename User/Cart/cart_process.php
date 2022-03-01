<?php
    include "../../connect.php";
    session_start();
    
    $GLOBALS['connection'] = $conn;

    switch ($_GET['action']) {
        case 'add':  
            $result = updateCart(true); 
            echo json_encode($result);
            break;

        case 'delete': 
            if (isset($_POST['id'])) {
                unset($_SESSION['cart'][$_POST['id']]);
            }

            echo json_encode(array(
                'status' => 1,
                'message' => 'Xoá sản phẩm thành công'
            ));
            // echo("<script>location.href = 'index.php?page=Cart';</script>");
            break;

        case 'update': 
            $result = updateCart();
            echo json_encode($result);
            break;

        default: 
            break;
    }

    function updateCart($add = false) {
        $changeQuantity = false;
        
        foreach ($_POST['quantity'] as $id => $quantity) {
            if ($quantity == 0) {
                unset( $_SESSION['cart'][$id]);
            } else {
                if (!isset( $_SESSION['cart'][$id])) {
                    $_SESSION['cart'][$id] = 0;
                }
    
                if ($add) {
                    $_SESSION['cart'][$id] += $quantity;
                } else {
                    $_SESSION['cart'][$id] = $quantity;
                }
    
                $quantityPro = mysqli_query($GLOBALS['connection'], "SELECT Quantity FROM products WHERE ProductID = '$id'");
                $quantityAs = mysqli_fetch_assoc($quantityPro);
    
                if ( $_SESSION['cart'][$id] > $quantityAs['Quantity']) {
                    $_SESSION['cart'][$id] = $quantityAs['Quantity'];
    
                    if ($add) {
                        return array(
                            'status' => 0,
                            'message' => 'Số lượng tồn kho chỉ còn: '.$quantityAs['Quantity'].' sản phẩm, vui lòng nhập lại số lượng ở trong giỏ hàng!'
                        );
                    } else {
                        $changeQuantity = true;
                    }
    
                }
    
                if ($add) {
                    return array(
                        'status' => 1,
                        'message' => 'Thêm sản phẩm thành công, vui lòng kiểm tra tại giỏ hàng!'
                    );
                }
            }
        }

        if ($changeQuantity) {
            return array(
                'status' => 1,
                'message' => 'Số lượng tồn kho không đủ, vui lòng kiểm tra lại!'
            );
        } else {
            return array(
                'status' => 1,
                'message' => 'Cập nhật giỏ hàng thành công!'
            );
        }
    }
?>