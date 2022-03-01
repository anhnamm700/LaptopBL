<?php
    @include("../connect.php");
    
    $id = $_GET['VgaID'];
    $sqlSelect = "SELECT * FROM cardvga WHERE CardID='$id'";   
    $result = mysqli_query($conn, $sqlSelect);
    $row = mysqli_fetch_array($result);
?>

<div class="card card-primary card-body">
  <div class="card-header">
    <h3 class="card-title">Chi tiết VGA</h3>
  </div>
  <!-- /.card-header -->
  <!-- form start -->
  <form role="form" method="POST" enctype="multipart/form-data">
    <div class="card-body" style="display: flex; flex-wrap: wrap;">
      <div class="form-group col-md-6">
        <label for="exampleInputEmail1">Mã sản phẩm</label>
        <input type="text" class="form-control" id="exampleInputEmail1" value="<?php echo $row['CardID'] ?>" name="id" readonly="readonly">
      </div>    
      <div class="form-group col-md-6">
        <label for="exampleInputPassword1">Tên VGA</label>
        <input type="text" class="form-control" id="exampleInputPassword1" value="<?php echo $row['NameOfCard'] ?>" name="name">
      </div>
      <div class="form-group">
        <label>Loại VGA</label>
        <select name="vgaOption" class="form-control select2 select2-hidden-accessible" style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true">
          <option selected="<?php if ($row['TypeOfCard'] == 0) { echo 'selected'; } else { echo ''; }?>" value="0">Card đồ hoạ tích hợp</option>
          <option selected="<?php if ($row['TypeOfCard'] == 1) { echo 'selected'; } else { echo ''; }?>" value="1">Card đồ hoạ rời</option>
        </select>
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
        $vgaOption = $_POST['vgaOption'];

        echo $vgaOption; die;
        
        if ($name != null) {
          $sql = "UPDATE ssd SET NameOfCard='$name', TypeOfCard='$vgaOption' where CardID='$id'";
          mysqli_query($conn, $sql);
          echo("<script>location.href = 'index.php?page=ShowVga';</script>");
        }   else {
          echo("<script>alert('Bạn chưa nhập đủ thông tin!');</script>");
        }
    }
    mysqli_close($conn);
?>

