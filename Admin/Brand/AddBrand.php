<?php
    @include("../connect.php");
?>

<div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Thêm thương hiệu</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" method="POST" enctype="multipart/form-data">
                <div class="card-body">  
                  <div class="form-group">
                    <label for="exampleInputPassword1">Tên thương hiệu</label>
                    <input type="text" class="form-control" id="exampleInputPassword1" name="name">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputFile">Logo</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" id="exampleInputFile" name="logo">
                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                      </div>
                      <img style="width: 50px; height: 50px; display: none;" src="" alt="" id="logo"/> 
                      <?php
                        echo '
                            <script language="javascript">
                                let file = document.querySelector("#exampleInputFile");

                                file.onchange = function() {
                                    let cutstring = file.value.substr(12, file.value.length);
                                    document.querySelector("#logo").style.display = "block";
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
                  <button class="btn btn-primary" type="submit" name="BrandAddeBtn">Add</button>
                  <a href="index.php?page=ShowBrand" class="btn btn-danger">Cancel</a>
                </div>
              </form>
            </div>

<?php
    if(isset($_POST['BrandAddeBtn'])){
        $id = substr(md5(time()), 0, 10);
        $name = $_POST['name'];
        $logo = $_FILES['logo']['name'];

        if ($logo != null) {
          $path = "./assets/image/logo/";
          $tmp_name = $_FILES['logo']['tmp_name'];
          $logo = $_FILES['logo']['name'];

          move_uploaded_file($tmp_name, $path.$logo);
          $img = $path.$logo;
          $sql = "insert into brand values ('$id', '$name', '$img')";
          mysqli_query($conn, $sql);
          echo("<script>location.href = 'index.php?page=ShowBrand';</script>");
        }   header("location: ShowBrand.php");
    }
    mysqli_close($conn);
?>