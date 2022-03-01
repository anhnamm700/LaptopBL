<?php
    include '../../connect.php';

    $error = false;

    if (isset($_POST['name']) && !empty($_POST['name']) && 
        isset($_POST['email']) && !empty($_POST['email']) && 
        isset($_POST['password']) && !empty($_POST['password']) && 
        isset($_POST['birthday']) && !empty($_POST['birthday']) && 
        isset($_POST['address']) && !empty($_POST['address']) && 
        isset($_POST['phone']) && !empty($_POST['phone'])) {
            $id = substr(md5(time()), 0, 10); 
            $name = $_POST['name'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $birthday = $_POST['birthday'];
            $address = $_POST['address'];
            $phone = $_POST['phone'];
            $insertSql = "INSERT INTO account VALUES ('$id', '$name', MD5('$password'), '$address', '$birthday', '$phone', '$email', 2)";
            
            $result = mysqli_query($conn, $insertSql);


            if (!$result) {
                if (strpos(mysqli_error($conn), "Duplicate entry") !== FALSE) {
                    echo json_encode(array(
                        'status' => 0,
                        'message' => 'Email đã tồn tại'
                    ));

                    exit;
                }
            }

            mysqli_close($conn);

            if ($error !== false) {
                echo json_encode(array(
                    'status' => 0,
                    'message' => 'Có lỗi khi đăng kí, vui lòng thử lại!'
                ));
                exit;
            } else {
                echo json_encode(array(
                    'status' => 1,
                    'message' => 'Đăng kí thành công!'
                ));
                exit;
            }
    } else {
        echo json_encode(array(
            'status' => 0,
            'message' => 'Bạn chưa nhập thông tin!'
        ));
        exit;
    }
?>