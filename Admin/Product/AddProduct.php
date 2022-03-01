<?php
    @include("../connect.php");
?>

<div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Thêm sản phẩm</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" method="POST" enctype="multipart/form-data">
                <div class="card-body" style="display: flex; flex-wrap: wrap;">  
                  <div class="form-group col-md-6">
                    <label for="exampleInputPassword1">Tên sản phẩm</label>
                    <input type="text" class="form-control" id="exampleInputPassword1" name="name">
                  </div>
                  <div class="form-group col-md-6">
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
                                    document.querySelector("#logo").src="./assets/image/imgProduct/" + cutstring;
                                }
                            </script>
                        ';
                      ?>
                      
                    </div>
                  </div>
                  <div class="form-group col-md-6">
                    <label for="price">Giá</label>
                    <input type="number" class="form-control" id="price" name="price">
                  </div>
                  
                <div class="form-group col-md-6">
                    <label for="discount">Khuyến mại</label>
                    <input type="number" class="form-control" id="discount" name="discount">
                  </div> 
                  <div class="form-group col-md-6">
                    <label for="total">Giá sau khuyến mại</label>
                    <input type="number" class="form-control" id="total" name="total" readonly="readonly">
                  </div>
                  <div class="form-group col-md-6">
                  <label>Màu sắc</label>
                  <select name="colorOption" class="form-control select2 select2-hidden-accessible" style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true">
                     <?php
                        $sqlColor = "select * from productcolor";
                        $val = mysqli_query($conn, $sqlColor);

                        $data = [];
                        while ($rows = mysqli_fetch_array($val)) {
                          $data[] = $rows;
                        }
                      ?>

                      <?php foreach ($data as $key) { ?>
                          <option value="<?php echo $key['ColorID'] ?>"><?php echo $key['ColorName'] ?></option>;
                      <?php } ?>
                     
                  </select>
                </div>
                  <div class="form-group col-md-6">
                    <label for="exampleInputPassword1">Năm sản xuất</label>
                    <input type="number" class="form-control" id="exampleInputPassword1" name="yearOfPro">
                  </div>
                  <div class="form-group col-md-6">
                    <label for="exampleInputPassword1">Số lượng</label>
                    <input type="number" class="form-control" id="exampleInputPassword1" name="quantity">
                  </div>
                  <div class="form-group col-md-6">
                    <label>Thương hiệu</label>
                    <select name="brandOption" class="form-control select2 select2-hidden-accessible" style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true">
                      <?php
                          $sqlBrand = "select * from brand";
                          $val = mysqli_query($conn, $sqlBrand);

                          $data = [];
                          while ($rows = mysqli_fetch_array($val)) {
                            $data[] = $rows;
                          }
                        ?>

                        <?php foreach ($data as $key) { ?>
                            <option value="<?php echo $key['BrandID'] ?>"><?php echo $key['BrandName'] ?></option>;
                        <?php } ?>
                      
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label>SSD</label>
                    <select name="ssdOption" class="form-control select2 select2-hidden-accessible" style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true">
                      <?php
                          $sqlBrand = "select * from ssd";
                          $val = mysqli_query($conn, $sqlBrand);

                          $data = [];
                          while ($rows = mysqli_fetch_array($val)) {
                            $data[] = $rows;
                          }
                        ?>

                        <?php foreach ($data as $key) { ?>
                            <option value="<?php echo $key['SsdID'] ?>"><?php echo $key['SsdName'].'-'.$key['Storage']; ?></option>;
                        <?php } ?>
                      
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label>HDD</label>
                    <select name="hddOption" class="form-control select2 select2-hidden-accessible" style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true">
                      <?php
                          $sqlBrand = "select * from hdd";
                          $val = mysqli_query($conn, $sqlBrand);

                          $data = [];
                          while ($rows = mysqli_fetch_array($val)) {
                            $data[] = $rows;
                          }
                        ?>

                        <?php foreach ($data as $key) { ?>
                            <option value="<?php echo $key['HddID'] ?>"><?php echo $key['HddName'].'-'.$key['Storage']; ?></option>;
                        <?php } ?>
                      
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label>Card đồ hoạ</label>
                    <select name="vgaOption" class="form-control select2 select2-hidden-accessible" style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true">
                      <?php
                          $sqlBrand = "select * from cardvga";
                          $val = mysqli_query($conn, $sqlBrand);

                          $data = [];
                          while ($rows = mysqli_fetch_array($val)) {
                            $data[] = $rows;
                          }
                        ?>

                        <?php foreach ($data as $key) { ?>
                            <option value="<?php echo $key['CardID'] ?>"><?php echo $key['NameOfCard'] ?></option>;
                        <?php } ?>
                      
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label>RAM</label>
                    <select name="ramOption" class="form-control select2 select2-hidden-accessible" style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true">
                      <?php
                          $sqlBrand = "select * from ram";
                          $val = mysqli_query($conn, $sqlBrand);

                          $data = [];
                          while ($rows = mysqli_fetch_array($val)) {
                            $data[] = $rows;
                          }
                        ?>

                        <?php foreach ($data as $key) { ?>
                            <option value="<?php echo $key['RamID'] ?>"><?php echo $key['Storage'].'-'.$key['Type']; ?></option>;
                        <?php } ?>
                      
                    </select>
                </div>
                <div class="form-group col-md-12">
                  <label for="exampleInputEmail1">Mô tả</label>
                  <textarea name="description"></textarea>
                </div> 
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button class="btn btn-primary" type="submit" name="ProductAddBtn">Add</button>
                  <a href="index.php?page=ShowProduct" class="btn btn-danger">Cancel</a>
                </div>
              </form>
            </div>
  <script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
  <script>
    CKEDITOR.replace( 'description' );
  </script>

<script>
    let totalPrice = document.querySelector("#total");
    let price = document.querySelector("#price");
    let discount = document.querySelector("#discount");

    price.oninput = function() {
      totalPrice.value = Number(price.value) - (Number(price.value) * Number(discount.value)) / 100;
    }

    discount.oninput = function() {
      totalPrice.value = Number(price.value) - (Number(price.value) * Number(discount.value)) / 100;
    }

  </script>

<?php
    if(isset($_POST['ProductAddBtn'])){
      $id = substr(md5(time()), 0, 10);
      $name = $_POST['name'];
      $logo = $_FILES['logo']['name'];
      $price = $_POST['price'];
      $quantity = $_POST['quantity'];
      $total = $_POST['total'];
      $color = $_POST['color'];
      $discount = $_POST['discount'];
      $description = $_POST['description'];
      $yearOfPro = $_POST['yearOfPro'];
      $brandOption = $_POST['brandOption'];
      $colorOption = $_POST['colorOption'];
      $ssdOption = $_POST['ssdOption'];
      $ramOption = $_POST['ramOption'];
      $vgaOption = $_POST['vgaOption'];
      $hddOption = $_POST['hddOption'];

      
      if ($logo != null) {
        $path = "./assets/image/imgProduct/";
        $tmp_name = $_FILES['logo']['tmp_name'];
        
        move_uploaded_file($tmp_name, $path.$logo);
        $img = $path.$logo;
        
        $sql = "insert into products values ('$id', '$name', '$img', '$price', '$discount', '$total', '$description', '$yearOfPro', '$quantity', '$brandOption', '$colorOption', '$ssdOption', '$hddOption', '$vgaOption', '$ramOption')";
        mysqli_query($conn, $sql);
        echo("<script>alert('Thêm sản phẩm thành công!');</script>");
        echo("<script>location.href = 'index.php?page=ShowProduct';</script>");
      } else {
        echo("<script>alert('Bạn chưa nhập ảnh');</script>");
      }
      
    }
    mysqli_close($conn);
?>