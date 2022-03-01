<?php
    include '../../connect.php';

    if (isset($_POST['id'])) {
        $id = $_POST['id'];

        $sql = "DELETE FROM brand WHERE BrandID = '$id'";
        $result = mysqli_query($conn, $sql);

        if ($result) {
            echo json_encode(array(
                'status' => 1,
                'message' => 'Xoá thành công'
            ));
        } else {
            echo json_encode(array(
                'status' => 0,
                'message' => 'Không thể xoá thương hiệu này vì có ít nhất 1 sản phẩm có thương hiệu này!'
            ));
        }
    } 
?> 