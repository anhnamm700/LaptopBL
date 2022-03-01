<?php
    include '../../connect.php';

    if (isset($_POST['id'])) {
        $id = $_POST['id'];


        $sql = "DELETE FROM products WHERE ProductID = '$id'";
        $result = mysqli_query($conn, $sql);

        if ($result) {
            echo json_encode(array(
                'status' => 1,
                'message' => 'Xoá thành công'
            ));
        } else {
            echo json_encode(array(
                'status' => 0,
                'message' => 'Không thể xoá sản phẩm này vì sản phẩm có trong ít nhất 1 giỏ hàng!'
            ));
        }
    } 
?>