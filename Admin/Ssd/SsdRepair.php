<?php
    @include("../connect.php");
    
    $id = $_GET['SsdID'];
    $sqlSelect = "SELECT * FROM ssd WHERE SsdID='$id'";   
    $result = mysqli_query($conn, $sqlSelect);
    $row = mysqli_fetch_array($result);
?>

<div class="card card-primary card-body">
  <div class="card-header">
    <h3 class="card-title">Chi tiết SSD</h3>
  </div>
  <!-- /.card-header -->
  <!-- form start -->
  <form role="form" method="POST" enctype="multipart/form-data">
    <div class="card-body" style="display: flex; flex-wrap: wrap;">
      <div class="form-group col-md-6">
        <label for="exampleInputEmail1">Mã sản phẩm</label>
        <input type="text" class="form-control" id="exampleInputEmail1" value="<?php echo $row['SsdID'] ?>" name="id" readonly="readonly">
      </div>    
      <div class="form-group col-md-6">
        <label for="exampleInputPassword1">Tên SSD</label>
        <input type="text" class="form-control" id="exampleInputPassword1" value="<?php echo $row['SsdName'] ?>" name="name">
      </div>
      <div class="form-group col-md-6">
        <label for="exampleInputPassword1">Loại SSD</label>
        <input type="text" class="form-control" id="exampleInputPassword1" value="<?php echo $row['Type'] ?>" name="type">
      </div>
      <div class="form-group col-md-6">
        <label for="exampleInputEmail1">Dung lượng bộ nhớ</label>
        <input type="text" class="form-control" id="exampleInputEmail1" value="<?php echo $row['Storage'] ?>" name="storage">
      </div>
    </div>
    <!-- /.card-body -->

    <div class="card-footer">
      <button class="btn btn-primary" type="submit" name="SsdUpdateBtn">Edit</button>
      <a href="index.php?page=ShowSsd" class="btn btn-danger">Cancel</a>
    </div>
    
  </form>
</div>
<?php
    if(isset($_POST['SsdUpdateBtn'])){
        $id = $_POST['id'];
        $name = $_POST['name'];
        $type = $_POST['type'];
        $storage = $_POST['storage'];
        
        if ($name != null && $type != null && $storage != null) {
          $sql = "UPDATE ssd SET SsdName='$name', Storage='$storage', Type='$type'  where SsdID='$id'";
          mysqli_query($conn, $sql);
          echo("<script>location.href = 'index.php?page=ShowSsd';</script>");
        }   else {
          echo("<script>alert('Bạn chưa nhập đủ thông tin!');</script>");
        }
    }
    mysqli_close($conn);
?>

