<?php
    include  '../../connect.php';
    // $id = $_GET['ColorID'];

    if (isset($_POST['id'])) {
        $id = $_POST['id'];

        $sql = "DELETE FROM productcolor WHERE ColorID = '$id'";
        $result = mysqli_query($conn, $sql);

        if ($result) {
            echo json_encode(array(
                'status' => 1,
                'message' => 'Xoá thành công'
            ));
        } else {
            echo json_encode(array(
                'status' => 0,
                'message' => 'Không thể xoá vì có ít nhất 1 sản phẩm có màu này!'
            ));
        }
    } 

?>