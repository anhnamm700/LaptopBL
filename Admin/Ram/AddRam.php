<?php
    @include("../connect.php");
?>

<div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Thêm RAM</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" method="POST" enctype="multipart/form-data">
                <div class="card-body" style="display: flex; flex-wrap: wrap;">  
                  <div class="form-group col-md-6">
                    <label for="exampleInputPassword1">Tên RAM</label>
                    <input type="text" class="form-control" id="exampleInputPassword1" name="name">
                  </div>
                  <div class="form-group col-md-6">
                    <label for="exampleInputPassword1">Loại RAM</label>
                    <input type="text" class="form-control" id="exampleInputPassword1" name="type">
                  </div>
                  <div class="form-group col-md-6">
                    <label for="exampleInputEmail1">Dung lượng bộ nhớ</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" name="storage">
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button class="btn btn-primary" type="submit" name="ramAddBtn">Add</button>
                  <a href="index.php?page=Showram" class="btn btn-danger">Cancel</a>
                </div>
              </form>
            </div>


<?php
    if(isset($_POST['ramAddBtn'])){
      $id = substr(md5(time()), 0, 10);
      $name = $_POST['name'];
      $type = $_POST['type'];
      $storage = $_POST['storage'];

      
      if ($name != null && $type != null && $storage != null) {
        $sql = "insert into ram values ('$id', '$name', '$type', '$storage')";
        mysqli_query($conn, $sql);
        echo("<script>location.href = 'index.php?page=ShowRam';</script>");
      } else {
        echo("<script>alert('Bạn chưa nhập đủ thông tin!');</script>");
      }
    } 
    mysqli_close($conn);
?>