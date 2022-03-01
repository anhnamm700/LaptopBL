<div class="columns-container">
    <div class="container" id="columns">
        <!-- breadcrumb -->
        <div class="breadcrumb clearfix">
            <a class="home" href="idex.php" title="Return to Home">Home</a>
            <span class="navigation-pipe">&nbsp;</span>
            <span class="navigation_page">Đăng kí</span>
        </div>
        <!-- ./breadcrumb -->
        <!-- page heading-->
        <h2 class="page-heading">
            <span class="page-heading-title2">Đăng kí</span>
        </h2>
        <!-- ../page heading-->
        <div class="page-content">
            <!-- <div class="row"> -->
                <div class="col-sm-12">
                    <form class="box-authentication" id="register" method="POST">
                        <div class="col-sm-12">
                            <div class="col-sm-6">
                                <label for="name">Họ tên</label>
                                <input style="width: 100%;" name="name" id="name" type="text" class="form-control">
                            </div>

                            <div class="col-sm-6">
                                <label for="emmail_register">Email</label>
                                <input style="width: 100%;" name="email" id="emmail_register" type="email" class="form-control">
                            </div>

                            <div class="col-sm-6">
                                <label for="password">Mật khẩu</label>
                                <input style="width: 100%;" name="password" id="password" type="password" class="form-control">
                            </div>

                            <div class="col-sm-6">
                                <label for="re_password">Nhập lại mật khẩu</label>
                                <input style="width: 100%;" name="re_password" id="re_password" type="password" class="form-control">
                            </div>

                            <div class="col-sm-6">
                                <label for="address">Địa chỉ</label>
                                <input style="width: 100%;" name="address" id="address" type="text" class="form-control">
                            </div>

                            <div class="col-sm-6">
                                <label for="birthday">Ngày sinh</label>
                                <input style="width: 100%;" name="birthday" id="birthday" type="date" class="form-control">
                            </div>

                            <div class="col-sm-6">
                                <label for="phone">SĐT</label>
                                <input style="width: 100%;" name="phone" id="phone" type="number" class="form-control">
                            </div>
                        </div>
                        <button type="submit" class="button" style="margin-left: 30px;"><i class="fa fa-user"></i> Tạo tài khoản</button>
                    </form>
                </div>
            <!-- </div> -->
        </div>
    </div>
</div>

<script type="text/javascript" src="./assets/js/jquery.validate.min.js"></script>
<script>
    $('#register').validate({
        rules: {
            name: "required",
            email: {
                required: true,
                email: true,
                remote: "./Login_Out/check-email.php"
            },
            password: {
                required: true,
                minlength: 6
            },
            re_password: {
                equalTo: "#password"
            },
            birthday: {
                required: true,
                date: true
            },
            address: "required",
            phone: {
                required: true,
                number: true,
                minlength: 10
            }
        },
        messages: {
            name: "Bạn chưa nhập tên",
            email: {
                required: "Bạn chưa nhập Email",
                email: "Email không đúng định dạng",
                remote: "Email đã tồn tại"
            },
            password: {
                required: "Bạn chưa nhập mật khẩu",
                email: "Mật khẩu tối thiểu là 6 kí tự"
            },
            re_password: {
                equalTo: "Mật khẩu không khớp"
            },
            birthday: {
                required: "Bạn phải nhập ngày sinh",
                date: "Ngày sinh định dạng tháng/ngày/năm"
            },
            address: "Bạn chưa nhập địa chỉ",
            phone: {
                required: "Bạn chưa nhập SĐT",
                number: "Phải là số",
                minlength: "Tối thiêu 10 số",
            }
        },
        submitHandler: function(form) {
            var data = $(form).serializeArray();

            $.ajax({
                type: "POST",
                // dataType: "JSON",
                url: "./Login_Out/reg_action.php",
                data: data,
                success: function(response) {
                    response = JSON.parse(response);
                    if (response.status == 0) {
                        alert(response.message);
                    } else {
                        alert(response.message);
                        // location.reload();
                    }
                }
            });
        }
    });

</script>