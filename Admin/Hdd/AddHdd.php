<?php
    @include("../connect.php");
?>

<div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Thêm HDD</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" method="POST" enctype="multipart/form-data">
                <div class="card-body" style="display: flex; flex-wrap: wrap;">  
                  <div class="form-group col-md-6">
                    <label for="exampleInputPassword1">Tên HDD</label>
                    <input type="text" class="form-control" id="exampleInputPassword1" name="name">
                  </div>
                  <div class="form-group col-md-6">
                    <label for="exampleInputEmail1">Dung lượng bộ nhớ</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" name="storage">
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button class="btn btn-primary" type="submit" name="HddAddBtn">Add</button>
                  <a href="index.php?page=ShowHdd" class="btn btn-danger">Cancel</a>
                </div>
              </form>
            </div>


<?php
    if(isset($_POST['HddAddBtn'])){
      $id = substr(md5(time()), 0, 10);
      $name = $_POST['name'];
      $storage = $_POST['storage'];

      
      if ($name != null && $storage != null) {
        $sql = "insert into hdd values ('$id', '$name', '$storage')";
        mysqli_query($conn, $sql);
        echo("<script>location.href = 'index.php?page=ShowHdd';</script>");
      } else {
        echo("<script>alert('Bạn chưa nhập đủ thông tin!');</script>");
      }
    } 
    mysqli_close($conn);
?>