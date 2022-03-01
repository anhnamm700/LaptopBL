<?php
    @include("../connect.php");
?>

<div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Thêm banner</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" method="POST" enctype="multipart/form-data">
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputFile">Ảnh</label>
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
                  <div class="form-group">
                    <label>Trạng thái</label>
                    <select name="statusOption" class="form-control select2 select2-hidden-accessible statusOption" style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true">
                        <option value="0">Không kích hoạt</option>
                        <option value="1">Kích hoạt</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Thứ tự</label>
                    <input type="text" class="form-control" id="exampleInputPassword1" name="OrderSort">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">URL</label>
                    <input type="text" class="form-control" id="exampleInputPassword1" name="Url">
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button class="btn btn-primary" type="submit" name="BannerAddeBtn">Add</button>
                  <a href="index.php?page=ShowBanner" class="btn btn-danger">Cancel</a>
                </div>
              </form>
            </div>

<?php
    if(isset($_POST['BannerAddeBtn'])){
        $id = substr(md5(time()), 0, 10);
        $statusOption = $_POST['statusOption'];
        $Url = $_POST['Url'];
        $OrderSort = $_POST['OrderSort'];
        $logo = $_FILES['logo']['name'];

        if ($logo != null) {
          $path = "./assets/image/banner/";
          $tmp_name = $_FILES['logo']['tmp_name'];
          $logo = $_FILES['logo']['name'];

          move_uploaded_file($tmp_name, $path.$logo);
          $img = $path.$logo;
          $sql = "insert into banner values ('$id', '$img', '$statusOption', '$OrderSort', '$Url')";
          mysqli_query($conn, $sql);
          echo("<script>alert('Thêm thành công');</script>");
          echo("<script>location.href = 'index.php?page=ShowBanner';</script>");
        }   header("location: ShowBanner.php");
    }
    mysqli_close($conn);
?>