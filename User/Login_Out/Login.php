
  <?php
    include_once '../connect.php';
?>

<div style="margin: 0 164px; padding-top: 40px;">
    <form class="box-authentication" method="POST">
        <h3>Đăng Nhập</h3>
        <label for="emmail_login">Email</label>
        <input id="emmail_login" type="text" class="form-control" name="emailAcc">
        <label for="password_login">Mật khẩu</label>
        <input id="password_login" type="password" class="form-control" name="password">
        <p class="forgot-pass"><a href="#">Quên mật khẩu?</a></p>
        <button class="button" name="loginBtn" type="submit">Sign in</button>
    </form>
</div>

<?php
    if (isset($_POST['loginBtn'])) {
       
        if (isset($_POST['emailAcc']) != null && $_POST['password'] != null) {
            // $email = $_POST['email'];
            // $pass = $_POST['password'];

            

            $sql = "SELECT * FROM account WHERE Email = '".$_POST['emailAcc']."' AND Password = MD5('".$_POST['password']."') AND AuthoritiesID = 2 LIMIT 1";
            $row  = mysqli_query($conn, $sql);
            $count = mysqli_num_rows($row);


            if ($count > 0) {
                // $_SESSION['email'] = $acc;
                $_SESSION['emailAcc'] = $_POST['emailAcc']; 
                $_SESSION['password'] = $_POST['password']; 
                echo '<script>alert("Đăng nhập thành công");</script>';
                echo("<script>location.href = 'index.php';</script>");
            } else {
                echo '<script>alert("Tài khoản hoặc mật khẩu sai");</script>';
            }
        } 
        else {
            echo '<script>alert("Bạn chưa nhập tài khoản hoặc mật khẩu");</script>';
        }

    }
?>