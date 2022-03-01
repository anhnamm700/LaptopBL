<?php
    @include("../connect.php");
    
    $id = $_GET['HddID'];
    $sqlSelect = "SELECT * FROM hdd WHERE HddID='$id'";   
    $result = mysqli_query($conn, $sqlSelect);
    $row = mysqli_fetch_array($result);
?>

<div class="card card-primary card-body">
  <div class="card-header">
    <h3 class="card-title">Chi tiết HDD</h3>
  </div>
  <!-- /.card-header -->
  <!-- form start -->
  <form role="form" method="POST" enctype="multipart/form-data">
    <div class="card-body" style="display: flex; flex-wrap: wrap;">
      <div class="form-group col-md-6">
        <label for="exampleInputEmail1">Mã sản phẩm</label>
        <input type="text" class="form-control" id="exampleInputEmail1" value="<?php echo $row['HddID'] ?>" name="id" readonly="readonly">
      </div>    
      <div class="form-group col-md-6">
        <label for="exampleInputPassword1">Tên HDD</label>
        <input type="text" class="form-control" id="exampleInputPassword1" value="<?php echo $row['HddName'] ?>" name="name">
      </div>
      <div class="form-group col-md-6">
        <label for="exampleInputEmail1">Dung lượng bộ nhớ</label>
        <input type="text" class="form-control" id="exampleInputEmail1" value="<?php echo $row['Storage'] ?>" name="storage">
      </div>
    </div>
    <!-- /.card-body -->

    <div class="card-footer">
      <button class="btn btn-primary" type="submit" name="HddUpdateBtn">Edit</button>
      <a href="index.php?page=ShowHdd" class="btn btn-danger">Cancel</a>
    </div>
    
  </form>
</div>
<?php
    if(isset($_POST['HddUpdateBtn'])){
        $id = $_POST['id'];
        $name = $_POST['name'];
        $storage = $_POST['storage'];
        
        if ($name != null && $storage != null) {
          $sql = "UPDATE ssd SET SsdName='$name', Storage='$storage' where SsdID='$id'";
          mysqli_query($conn, $sql);
          echo("<script>location.href = 'index.php?page=ShowHdd';</script>");
        }   else {
          echo("<script>alert('Bạn chưa nhập đủ thông tin!');</script>");
        }
    }
    mysqli_close($conn);
?>

