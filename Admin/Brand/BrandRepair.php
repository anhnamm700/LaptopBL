<?php
    @include("../connect.php");
    
    $id = $_GET['BrandID'];
    $sqlSelect = "select * from brand where BrandID='$id'";   
    $result = mysqli_query($conn, $sqlSelect);
    $row = mysqli_fetch_array($result);
?>

<div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Chi tiết thương hiệu</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" method="POST" enctype="multipart/form-data">
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Mã thương hiệu</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" value="<?php echo $row['BrandID'] ?>" name="id" readonly="readonly">
                  </div>    
                  <div class="form-group">
                    <label for="exampleInputPassword1">Tên thương hiệu</label>
                    <input type="text" class="form-control" id="exampleInputPassword1" value="<?php echo $row['BrandName'] ?>" name="name">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputFile">Logo</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" id="exampleInputFile" name="logo">
                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                      </div>
                      <img style="width: 50px; height: 50px;" src="<?php echo $row['Avatar'] ?>" alt="" id="logo"/> 
                      <?php
                        echo '
                            <script language="javascript">
                                let file = document.querySelector("#exampleInputFile");

                                file.onchange = function() {
                                    let cutstring = file.value.substr(12, file.value.length);
                                    document.querySelector("#logo").src="./assets/image/logo/" + cutstring;
                                }
                            </script>
                        ';
                      ?>
                      
                    </div>
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button class="btn btn-primary" type="submit" name="BrandUpdateBtn">Edit</button>
                  <a href="index.php?page=ShowBrand" class="btn btn-danger">Cancel</a>
                </div>
              </form>
            </div>

<?php
    if(isset($_POST['BrandUpdateBtn'])){
        $id = $_POST['id'];
        $name = $_POST['name'];
        $logo = $_FILES['logo']['name'];

        if ($logo != null) {
          $path = "./assets/image/logo/";
          $tmp_name = $_FILES['logo']['tmp_name'];
          $logo = $_FILES['logo']['name'];

          move_uploaded_file($tmp_name, $path.$logo);
          $img = $path.$logo;
          $sql = "update brand set BrandName='$name', Avatar='$img' where BrandID='$id'";
          $re = mysqli_query($conn, $sql);
          if ($re) {
            echo("<script>alert('Cập nhật thành công');</script>");
          } else {
            echo("<script>alert('Có lỗi xảy ra');</script>");
          }
          echo("<script>location.href = 'index.php?page=ShowBrand';</script>");
        } else {
          $sql = "update brand set BrandName='$name' where BrandID='$id'";
          $re = mysqli_query($conn, $sql);
          if ($re) {
            echo("<script>alert('Cập nhật thành công');</script>");
          } else {
            echo("<script>alert('Có lỗi xảy ra');</script>");
          }
          echo("<script>location.href = 'index.php?page=ShowBrand';</script>");
        }
    }
    mysqli_close($conn);
?>