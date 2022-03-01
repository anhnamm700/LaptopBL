<?php
    @include("../connect.php");
    
    $id = $_GET['AccountID'];
    $sqlSelect = "select * from account where AccountID='$id'";   
    $result = mysqli_query($conn, $sqlSelect);
    $row = mysqli_fetch_array($result);

?>

<div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Chi tiết tài khoản</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" method="POST">
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Mã tài khoản</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" value="<?php echo $row['AccountID'] ?>" name="id" readonly="readonly">
                  </div>    
                  <div class="form-group">
                    <label for="exampleInputPassword1">Tên tài khoản</label>
                    <input type="text" class="form-control" id="exampleInputPassword1" value="<?php echo $row['AccountName'] ?>" name="name">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Email</label>
                    <input type="text" class="form-control" id="exampleInputPassword1" value="<?php echo $row['Email'] ?>" name="email">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Password</label>
                    <input type="password" class="form-control" id="exampleInputPassword1" value="<?php echo $row['Password'] ?>" name="pass">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Ngày sinh</label>
                    <input type="date" class="form-control" id="exampleInputPassword1" value="<?php echo $row['Birthday'] ?>" name="birthday">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Địa chỉ</label>
                    <input type="text" class="form-control" id="exampleInputPassword1" value="<?php echo $row['Address'] ?>" name="address">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">SĐT</label>
                    <input type="number" class="form-control" id="exampleInputPassword1" value="<?php echo $row['Phone'] ?>" name="phone">
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
                          <option value="<?php echo $key['AuthoritiesID'] ?>" 
                            <?php if ($row['AuthoritiesID'] == $key['AuthoritiesID']) { echo 'selected="selected"'; } ?>><?php echo $key['AuthoritiesName'] ?></option>;
                      <?php } ?>
                     
                  </select>
                </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button class="btn btn-primary" type="submit" name="AccountUpdateBtn">Edit</button>
                  <a href="index.php?page=ShowOrder" class="btn btn-danger">Cancel</a>
                </div>
              </form>
            </div>

<?php
    if(isset($_POST['AccountUpdateBtn'])){
        $id = $_POST['id'];
        $name = $_POST['name'];
        $password = $_POST['pass'];
        $address = $_POST['address'];
        $birthday = $_POST['birthday'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];
        $authoriesOption = $_POST['authoriesOption'];

        // create connection and execute sql query
        $sql1 = "Update account set AccountName = '$name', Password = '$password', Address = '$address', Birthday = '$birthday',
        Phone = '$phone', Email = '$email',AuthoritiesID = '$authoriesOption' where AccountID = '$id'";
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