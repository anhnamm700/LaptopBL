<?php
    @include("../connect.php");
    
    $sqlSelect = "select * from config";   
    $result = mysqli_query($conn, $sqlSelect);
    $row = mysqli_fetch_array($result);
?>

<div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Chi tiết website</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" method="POST" enctype="multipart/form-data">
                <div class="card-body">   
                  <div class="form-group">
                    <label for="exampleInputPassword1">Tên công ty</label>
                    <input type="text" class="form-control" id="exampleInputPassword1" value="<?php echo $row['NameOfCompany'] ?>" name="name">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputFile">Logo</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" id="exampleInputFile" name="logo">
                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                      </div>
                      <img style="width: 50px; height: 50px;" src="<?php echo $row['Logo'] ?>" alt="" id="logo"/> 
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
                  <div class="form-group">
                    <label for="exampleInputPassword1">Địa chỉ</label>
                    <input type="text" class="form-control" id="exampleInputPassword1" value="<?php echo $row['Address'] ?>" name="address">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Số điện thoại 1</label>
                    <input type="number" class="form-control" id="exampleInputPassword1" value="<?php echo $row['Phone_1'] ?>" name="phone_1">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Số điện thoại 2</label>
                    <input type="number" class="form-control" id="exampleInputPassword1" value="<?php echo $row['Phone_2'] ?>" name="phone_2">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Số FAX</label>
                    <input type="number" class="form-control" id="exampleInputPassword1" value="<?php echo $row['FaxNumber'] ?>" name="FaxNumber">
                  </div>
                  <div class="form-group col-md-12">
                    <label for="exampleInputEmail1">Mô tả</label>
                    <textarea name="description"><?php echo $row['Description'] ?></textarea>
                    </div> 
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button class="btn btn-primary" type="submit" name="BrandUpdateBtn">Edit</button>
                  <a href="index.php?page=ShowBrand" class="btn btn-danger">Cancel</a>
                </div>
              </form>
            </div>

<script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
  <script>
    CKEDITOR.replace( 'description' );
  </script>

<?php
    if(isset($_POST['BrandUpdateBtn'])){
        $name = $_POST['name'];
        $address = $_POST['address'];
        $phone_1 = $_POST['phone_1'];
        $phone_2 = $_POST['phone_2'];
        $FaxNumber = $_POST['FaxNumber'];
        $description = $_POST['description'];
        $logo = $_FILES['logo']['name'];

        // echo $description; exit;

        if ($logo != null) {
          $path = "./assets/image/logo/";
          $tmp_name = $_FILES['logo']['tmp_name'];
          $logo = $_FILES['logo']['name'];

          move_uploaded_file($tmp_name, $path.$logo);
          $img = $path.$logo;
          $sql = "UPDATE config SET Logo='$img', NameOfCompany='$name', Address='$address', Phone_1='$phone_1', Phone_2='$phone_2', FaxNumber='$FaxNumber', Description='$description' WHERE config.ConfiID = 1";
          mysqli_query($conn, $sql);
          echo("<script>alert('Cập nhật thành công!')</script>");
          echo("<script>location.href = 'index.php';</script>");
        } else {
            $sql = "UPDATE config SET NameOfCompany='$name', Address='$address', Phone_1='$phone_1', Phone_2='$phone_2', FaxNumber='$FaxNumber', Description='$description' WHERE config.ConfiID = 1";
            mysqli_query($conn, $sql);
            echo("<script>alert('Cập nhật thành công!')</script>");
          echo("<script>location.href = 'index.php';</script>");
        }
    }
    mysqli_close($conn);
?>