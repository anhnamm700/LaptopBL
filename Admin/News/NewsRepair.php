<?php
    @include("../connect.php");
    
    $id = $_GET['NewsID'];
    $sqlSelect = "select * from news where NewsID='$id'";   
    $result = mysqli_query($conn, $sqlSelect);
    $row = mysqli_fetch_array($result);
?>

<div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Chi tiết tin tức</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" method="POST" enctype="multipart/form-data">
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Mã tin tức</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" value="<?php echo $row['NewsID'] ?>" name="id" readonly="readonly">
                  </div>    
                  
                  <div class="form-group">
                    <label for="exampleInputFile">Ảnh</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" id="exampleInputFile" name="logo">
                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                      </div>
                      <img style="width: 50px; height: 50px;" src="<?php echo $row['ImageBackground'] ?>" alt="" id="logo"/> 
                      <?php
                        echo '
                            <script language="javascript">
                                let file = document.querySelector("#exampleInputFile");

                                file.onchange = function() {
                                    let cutstring = file.value.substr(12, file.value.length);
                                    document.querySelector("#logo").src="./assets/image/news/" + cutstring;
                                }
                            </script>
                        ';
                      ?>
                      
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Tiêu đề</label>
                    <input type="text" class="form-control" id="exampleInputPassword1" value="<?php echo $row['Title'] ?>" name="Title">
                  </div>
                  <div class="form-group">
                    <label>Mô tả</label>
                    <textarea class="form-control" rows="4" placeholder="Enter ..." name="Description"><?php echo $row['Description'] ?></textarea>
                  </div>
                  <div class="form-group col-md-12">
                    <label for="exampleInputEmail1">Nội dung bài viết</label>
                    <textarea name="Content"><?php echo $row['Content'] ?></textarea>
                  </div> 
                <div class="card-footer">
                  <button class="btn btn-primary" type="submit" name="BannerUpdateBtn">Edit</button>
                  <a href="index.php?page=ShowBanner" class="btn btn-danger">Cancel</a>
                </div>
              </form>
            </div>

  <script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
  <script>
    CKEDITOR.replace( 'Content' );
  </script>

<?php
    if(isset($_POST['BannerUpdateBtn'])){
        $id = $_POST['id']; 
        $logo = $_FILES['logo']['name'];
        $Title = $_POST['Title'];
        $Description = $_POST['Description'];
        $Content = $_POST['Content'];

        


        if ($logo != null) {
          $path = "./assets/image/news/";
          $tmp_name = $_FILES['logo']['tmp_name'];
          $logo = $_FILES['logo']['name'];
          
          move_uploaded_file($tmp_name, $path.$logo);
          $img = $path.$logo;
          $sql = "update news set Title='$Title', Description='$Description', Content='$Content', ImageBackground='$img' where NewsID='$id'";
          // echo $sql; exit;
          mysqli_query($conn, $sql);
          // echo $result; exit;
          echo("<script>location.href = 'index.php?page=ShowNews';</script>");
        } else {
          $sql = "update news set Title='$Title', Description='$Description', Content='$Content' where NewsID='$id'";
          // echo $sql; exit;
          mysqli_query($conn, $sql);
          // $result = mysqli_query($conn, $sql);
          // echo $result; exit;
          echo("<script>location.href = 'index.php?page=ShowNews';</script>");
        }
    }
    mysqli_close($conn);
?>