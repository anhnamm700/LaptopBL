<?php
    @include("../connect.php");

    if (isset($_SESSION['email'])) {
      $name = $_SESSION['email'];
      $sqlSelect = "select AccountID from account where Email like '$name'";   
      $result = mysqli_query($conn, $sqlSelect);
  
      $row = mysqli_fetch_array($result);
    }
?>

<div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Thêm tin tức</h3>
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
                                    document.querySelector("#logo").src="./assets/image/news/" + cutstring;
                                }
                            </script>
                        ';
                      ?>
                      
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Tiêu đề</label>
                    <input type="text" class="form-control" id="exampleInputPassword1" name="Title">
                  </div>
                  <div class="form-group">
                    <label>Mô tả</label>
                    <textarea class="form-control" rows="4" placeholder="Enter ..." name="Description"></textarea>
                  </div>
                  <div class="form-group col-md-12">
                    <label for="exampleInputEmail1">Nội dung bài viết</label>
                    <textarea name="Content"></textarea>
                  </div> 
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button class="btn btn-primary" type="submit" name="BannerAddeBtn">Add</button>
                  <a href="index.php?page=ShowBanner" class="btn btn-danger">Cancel</a>
                </div>
              </form>
            </div>
        
            <script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
  <script>
    CKEDITOR.replace( 'Content' );
  </script>


<?php
    if(isset($_POST['BannerAddeBtn'])){

        $id = substr(md5(time()), 0, 10);
        $Title = $_POST['Title'];
        $Description = $_POST['Description'];
        $Content = $_POST['Content'];
        $logo = $_FILES['logo']['name'];
        
        $author = $row['AccountID'];

        if ($logo != null) {
          $path = "./assets/image/news/";
          $tmp_name = $_FILES['logo']['tmp_name'];
          $logo = $_FILES['logo']['name'];

          move_uploaded_file($tmp_name, $path.$logo);
          $img = $path.$logo;
          $sql = "INSERT INTO news VALUES ('$id', '$Title', '$Description', '$Content', '$img', NULL, '$author')";
          mysqli_query($conn, $sql);
          echo("<script>alert('Thêm thành công');</script>");
          echo("<script>location.href = 'index.php?page=ShowNews';</script>");
        } else {
          echo("<script>alert('Bạn chưa nhập ảnh');</script>");
        }
    }
    mysqli_close($conn);
?>