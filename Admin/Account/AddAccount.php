<?php
    @include("../connect.php");

    $getAcc = $_SESSION['email'];

    $sqlGetAcc = mysqli_query($conn, "SELECT * FROM account WHERE Email LIKE '$getAcc'");
    $row = mysqli_fetch_assoc($sqlGetAcc);

    if ($row['AuthoritiesID'] == 1) { 
?>

<div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Thêm tài khoản</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" method="POST">
                <div class="card-body">
                  <!-- <div class="form-group">
                    <label for="exampleInputEmail1">Mã tài khoản</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" name="id" readonly="readonly">
                  </div>     -->
                  <div class="form-group">
                    <label for="exampleInputPassword1">Tên tài khoản</label>
                    <input type="text" class="form-control" id="exampleInputPassword1" name="name">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Email</label>
                    <input type="text" class="form-control" id="exampleInputPassword1" name="email">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Password</label>
                    <input type="password" class="form-control" id="exampleInputPassword1" name="pass">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Ngày sinh</label>
                    <input type="date" class="form-control" id="exampleInputPassword1" name="birthday">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Địa chỉ</label>
                    <input type="text" class="form-control" id="exampleInputPassword1" name="address">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">SĐT</label>
                    <input type="number" class="form-control" id="exampleInputPassword1" name="phone">
                  </div>
                  <div class="form-group">
                  <label>Quyền</label>
                  <select name="authoriesOption" class="form-control select2 select2-hidden-accessible" style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true">
                     <?php
                        $sqlAu = "select * from authorities";
                        $val = mysqli_query($conn, $sqlAu);

                        $data = [];
                        while ($rows = mysqli_fetch_array($val)) {
                          $data[] = $rows;
                        }
                      ?>

                      <?php foreach ($data as $key) { ?>
                          <option value="<?php echo $key['AuthoritiesID'] ?>"><?php echo $key['AuthoritiesName'] ?></option>;
                      <?php } ?>
                     
                  </select>
                </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button class="btn btn-primary" type="submit" name="AddAccountBtn">Add</button>
                  <a href="index.php?page=ShowOrder" class="btn btn-danger">Cancel</a>
                </div>
              </form>
            </div>

<?php
    if(isset($_POST['AddAccountBtn'])){
        $id = substr(md5(time()), 0, 10);
        $name = $_POST['name'];
        $password = $_POST['pass'];
        $address = $_POST['address'];
        $birthday = $_POST['birthday'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];
        $authoriesOption = $_POST['authoriesOption'];

        // create connection and execute sql query
        $sql1 = "insert into account values ('$id', '$name', '$password', '$address', '$birthday', $phone, '$email', $authoriesOption)";
        // echo $sql1; exit;
        $qr = mysqli_query($conn, $sql1);
        if($qr == true){
            echo "<script language='javascript'>alert('Record update successfully');";
            echo "location.href='index.php?page=ShowAccount';</script>";
        } else {
            echo "<script language:'javascript'>alert('Error updating record')</script>";
        }
    }
    mysqli_close($conn);
?>

<?php } else { ?>
  <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Thêm tài khoản</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" method="POST">
                <div class="card-body">
                  <!-- <div class="form-group">
                    <label for="exampleInputEmail1">Mã tài khoản</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" name="id" readonly="readonly">
                  </div>     -->
                  <div class="form-group">
                    <label for="exampleInputPassword1">Tên tài khoản</label>
                    <input type="text" class="form-control" id="exampleInputPassword1" name="name">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Email</label>
                    <input type="text" class="form-control" id="exampleInputPassword1" name="email">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Password</label>
                    <input type="password" class="form-control" id="exampleInputPassword1" name="pass">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Ngày sinh</label>
                    <input type="date" class="form-control" id="exampleInputPassword1" name="birthday">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Địa chỉ</label>
                    <input type="text" class="form-control" id="exampleInputPassword1" name="address">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">SĐT</label>
                    <input type="number" class="form-control" id="exampleInputPassword1" name="phone">
                  </div>
                  <div class="form-group">
                  <label>Quyền</label>
                  <input type="text" value="Khách hàng" class="form-control" id="exampleInputPassword1" name="aithories" readonly="readonly">
                </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button class="btn btn-primary" type="submit" name="AddAccountBtn">Add</button>
                  <a href="index.php?page=ShowOrder" class="btn btn-danger">Cancel</a>
                </div>
              </form>
            </div>

<?php
    if(isset($_POST['AddAccountBtn'])){
        $id = substr(md5(time()), 0, 10);
        $name = $_POST['name'];
        $password = $_POST['pass'];
        $address = $_POST['address'];
        $birthday = $_POST['birthday'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];
        // $aithories = $_POST['aithories'];


        // create connection and execute sql query
        $sql1 = "insert into account values ('$id', '$name', '$password', '$address', '$birthday', $phone, '$email', 2)";
        $qr = mysqli_query($conn, $sql1);
        if($qr == true){
            echo "<script language='javascript'>alert('Record update successfully');";
            echo "location.href='index.php?page=ShowAccount';</script>";
        } else {
            echo "<script language:'javascript'>alert('Error updating record')</script>";
        }
    }
    mysqli_close($conn);
?>
  <?php } ?>