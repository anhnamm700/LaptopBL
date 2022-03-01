<?php
    @include("../connect.php");
?>

<div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Thêm VGA</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" method="POST" enctype="multipart/form-data">
                <div class="card-body" style="display: flex; flex-wrap: wrap;">  
                  <div class="form-group col-md-6">
                    <label for="exampleInputPassword1">Tên VGA</label>
                    <input type="text" class="form-control" id="exampleInputPassword1" name="name">
                  </div>
                  <div class="form-group">
                    <label>Loại VGA</label>
                    <select name="vgaOption" class="form-control select2 select2-hidden-accessible" style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true">
                      <option selected="selected" value="0">Card đồ hoạ tích hợp</option>
                      <option value="1">Card đồ hoạ rời</option>
                    </select>
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button class="btn btn-primary" type="submit" name="SsdAddBtn">Add</button>
                  <a href="index.php?page=ShowSsd" class="btn btn-danger">Cancel</a>
                </div>
              </form>
            </div>


<?php
    if(isset($_POST['SsdAddBtn'])){
      $id = substr(md5(time()), 0, 10);
      $name = $_POST['name'];
      $vgaOption = $_POST['vgaOption'];

      if ($name != null) {
        $sql = "insert into cardvga values ('$id', '$name', '$vgaOption')";
        mysqli_query($conn, $sql);
        echo("<script>location.href = 'index.php?page=ShowVga';</script>");
      } else {
        echo("<script>alert('Bạn chưa nhập đủ thông tin!');</script>");
      }
    } 
    mysqli_close($conn);
?>