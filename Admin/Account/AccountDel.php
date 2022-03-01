<?php
    include '../../connect.php';

    if (isset($_POST['id'])) {
        $id = $_POST['id'];

        $sql = "DELETE FROM account WHERE AccountID = '$id'";
        $result = mysqli_query($conn, $sql);

        if ($result) {
            echo json_encode(array(
                'status' => 1,
                'message' => 'Xoá thành công'
            ));
        } else {
            echo json_encode(array(
                'status' => 0,
                'message' => 'Không thể xoá tài khoản vì tài khoản có ít nhất 1 đơn hàng đăng đặt!'
            ));
        }
    } 
?>