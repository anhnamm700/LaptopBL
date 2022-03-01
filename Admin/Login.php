<?php   
    ob_start();
    session_start();
    include_once '../connect.php';

    if (isset($_POST['email'])) {
        $email = $_POST['email'];
        $pass = $_POST['pass'];

        $sql = "select * from account where Email='".$email."' and Password='".$pass."' and AuthoritiesID IN (1, 3) limit 1";

        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) == 1) {
            $_SESSION['email'] = $email;
            $_SESSION['pass'] = $pass;
            header('location: index.php');
        } else {
            echo '
                <script language="javascript">
                    alert("Bạn không có quyền truy cập");
                </script>
            ';
        }
    }

    // if (isset($_POST['submit'])) {
    //     $email = $_POST['email'];
    //     $pass = $_POST['pass'];

    //     $sql = "select * from account where Email='".$email."' and Password='".$pass."' and AuthoritiesID=1 limit 1";
    //     $result = mysqli_query($conn, $sql);
    //     $rows = mysqli_num_rows($result);

    //     if ($rows > 0) {
    //         $_SESSION['email'] = $email;
    //         $_SESSION['pass'] = $pass;
    //         header('location: index.php');
    //     } else {
            // echo '
            //     <div class="col-md-3">
            //     <div class="card bg-danger">
            //     <div class="card-header">
            //         <h3 class="card-title">Danger</h3>
            //     </div>
            //     <div class="card-body">
            //        Bạn không có quyền truy cập
            //     </div>
            //     <!-- /.card-body -->
            //     </div>
            //     <!-- /.card -->
            // </div>
            // ';
    //     }
    // }
?>


<!DOCTYPE html>
<html lang="en">
<head>
	<title>Login V1</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="./assets/login/images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="./assets/login/vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="./assets/login/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="./assets/login/vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="./assets/login/vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="./assets/login/vendor/select2/select2.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="./assets/login/css/util.css">
	<link rel="stylesheet" type="text/css" href="./assets/login/css/main.css">
<!--===============================================================================================-->
</head>
<body>
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<div class="login100-pic js-tilt" data-tilt>
					<img src="./assets/login/images/img-01.png" alt="IMG">
				</div>

				<form class="login100-form validate-form" method="POST">
					<span class="login100-form-title">
						Member Login
					</span>

					<div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
						<input class="input100" type="text" name="email" placeholder="Email">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-envelope" aria-hidden="true"></i>
						</span>
					</div>

					<div class="wrap-input100 validate-input" data-validate = "Password is required">
						<input class="input100" type="password" name="pass" placeholder="Password">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
					</div>
					
					<div class="container-login100-form-btn">
						<button class="login100-form-btn">
							Login
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	
	

	
<!--===============================================================================================-->	
	<script src="./assets/login/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="./assets/login/vendor/bootstrap/js/popper.js"></script>
	<script src="./assets/login/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="./assets/login/vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="./assets/login/vendor/tilt/tilt.jquery.min.js"></script>
	<script >
		$('.js-tilt').tilt({
			scale: 1.1
		})
	</script>
<!--===============================================================================================-->
	<script src="./assets/login/js/main.js"></script>

</body>
</html>