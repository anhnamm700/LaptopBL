<?php
    @include("../connect.php");
    
    $id = $_GET['ColorID'];
    $sqlSelect = "SELECT * FROM productcolor WHERE ColorID = '$id'";   
    $result = mysqli_query($conn, $sqlSelect);
    $row = mysqli_fetch_array($result);
?>

<div class="card card-primary card-body">
              <div class="card-header">
                <h3 class="card-title">Chi tiết màu</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" method="POST" enctype="multipart/form-data">
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Mã màu</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" value="<?php echo $row['ColorID'] ?>" name="id" readonly="readonly">
                  </div>    
                  <div class="form-group">
                    <label for="exampleInputPassword1">Tên màu</label>
                    <input type="text" class="form-control" id="exampleInputPassword1" value="<?php echo $row['ColorName'] ?>" name="name">
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button class="btn btn-primary" type="submit" name="ColorUpdateBtn">Edit</button>
                  <a href="index.php?page=ShowColor" class="btn btn-danger">Cancel</a>
                </div>
              </form>
            </div>

<?php
    if(isset($_POST['ColorUpdateBtn'])){
        $id = $_POST['id'];
        $name = $_POST['name'];

        if ($name != '') {
            $sql = "update productcolor set ColorName='$name' where ColorID='$id'";
            mysqli_query($conn, $sql);
            echo("<script>location.href = 'index.php?page=ShowColor';</script>");
        } else {
            echo "<script>alert('Bạn chưa nhập đủ thông tin');</script>";
        }
    }
    mysqli_close($conn);
?>

