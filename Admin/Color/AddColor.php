<?php
    @include("../connect.php");
?>

<div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Thêm màu</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" method="POST" enctype="multipart/form-data">
                <div class="card-body">  
                  <div class="form-group">
                    <label for="exampleInputPassword1">Tên màu</label>
                    <input type="text" class="form-control" id="exampleInputPassword1" name="name">
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button class="btn btn-primary" type="submit" name="ColorAddBtn">Add</button>
                  <a href="index.php?page=ShowColor" class="btn btn-danger">Cancel</a>
                </div>
              </form>
            </div>

<?php
    if(isset($_POST['ColorAddBtn'])){
        $id = substr(md5(time()), 0, 10);
        $name = $_POST['name'];

        
        if ($name != null) {
            $sql = "insert into productcolor values ('$id', '$name')";
            mysqli_query($conn, $sql);
            echo("<script>alert('Thêm màu thành công!');</script>");
            echo("<script>location.href = 'index.php?page=ShowColor';</script>");
        } else {
            echo("<script>alert('Bạn nhập thiếu thông tin');</script>");
        }
    }
    mysqli_close($conn);
?>