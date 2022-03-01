<?php
    @include("../connect.php");
    
    $id = $_GET['BannerID'];
    $sqlSelect = "select * from banner where BannerID='$id'";   
    $result = mysqli_query($conn, $sqlSelect);
    $row = mysqli_fetch_array($result);
?>

<div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Chi tiết banner</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" method="POST" enctype="multipart/form-data">
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Mã banner</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" value="<?php echo $row['BannerID'] ?>" name="id" readonly="readonly">
                  </div>    
                  
                  <div class="form-group">
                    <label for="exampleInputFile">Ảnh</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" id="exampleInputFile" name="logo">
                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                      </div>
                      <img style="width: 50px; height: 50px;" src="<?php echo $row['Image'] ?>" alt="" id="logo"/> 
                      <?php
                        echo '
                            <script language="javascript">
                                let file = document.querySelector("#exampleInputFile");

                                file.onchange = function() {
                                    let cutstring = file.value.substr(12, file.value.length);
                                    document.querySelector("#logo").src="./assets/image/banner/" + cutstring;
                                }
                            </script>
                        ';
                      ?>
                      
                    </div>
                  </div>
                  <div class="form-group">
                    <label>Trạng thái</label>
                    <select name="statusOption" class="form-control select2 select2-hidden-accessible statusOption" style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true">
                        <option value="0" <?php if ($row['Is_active'] == 0) { echo 'selected="selected"'; } ?>>Không kích hoạt</option>
                        <option value="1" <?php if ($row['Is_active'] == 1) { echo 'selected="selected"'; } ?>>Kích hoạt</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Thứ tự</label>
                    <input type="text" class="form-control" id="exampleInputPassword1" value="<?php echo $row['OrderSort'] ?>" name="OrderSort">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">URL</label>
                    <input type="text" class="form-control" id="exampleInputPassword1" value="<?php echo $row['Url'] ?>" name="Url">
                  </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button class="btn btn-primary" type="submit" name="BannerUpdateBtn">Edit</button>
                  <a href="index.php?page=ShowBanner" class="btn btn-danger">Cancel</a>
                </div>
              </form>
            </div>

<?php
    if(isset($_POST['BannerUpdateBtn'])){
        $id = $_POST['id'];
        $logo = $_FILES['logo']['name'];
        $OrderSort = $_POST['OrderSort'];
        $statusOption = $_POST['statusOption'];
        $Url = $_POST['Url'];

        


        if ($logo != null) {
          $path = "./assets/image/banner/";
          $tmp_name = $_FILES['logo']['tmp_name'];
          $logo = $_FILES['logo']['name'];
          
          move_uploaded_file($tmp_name, $path.$logo);
          $img = $path.$logo;
          $sql = "update banner set Image='$img', Is_active='$statusOption', OrderSort='$OrderSort', Url='$Url' where BannerID='$id'";
          mysqli_query($conn, $sql);
          echo("<script>location.href = 'index.php?page=ShowBanner';</script>");
        } else {
          $sql = "update banner set Is_active='$statusOption', OrderSort='$OrderSort', Url='$Url' where BannerID='$id'";
          mysqli_query($conn, $sql);
          echo("<script>location.href = 'index.php?page=ShowBanner';</script>");
        }
    }
    mysqli_close($conn);
?>