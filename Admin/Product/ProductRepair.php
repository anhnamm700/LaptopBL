<?php
    @include("../connect.php");
    
    $id = $_GET['ProductID'];
    $sqlSelect = "SELECT ram.*, cardvga.*, hdd.*, ssd.*, brand.BrandName, productcolor.ColorName,products.* FROM products INNER JOIN brand on products.BrandID = brand.BrandID INNER JOIN productcolor ON products.ColorID = productcolor.ColorID INNER JOIN ssd ON products.SsdID = ssd.SsdID INNER JOIN hdd ON products.HddID = hdd.HddID INNER JOIN cardvga ON products.CardID = cardvga.CardID INNER JOIN ram ON products.RamID = ram.RamID WHERE products.ProductID='$id' GROUP BY products.ProductID";   
    $result = mysqli_query($conn, $sqlSelect);
    $row = mysqli_fetch_array($result);
?>

<div class="card card-primary card-body">
  <div class="card-header">
    <h3 class="card-title">Chi tiết sản phẩm</h3>
  </div>
  <!-- /.card-header -->
  <!-- form start -->
  <form role="form" method="POST" enctype="multipart/form-data">
    <div class="card-body" style="display: flex; flex-wrap: wrap;">
      <div class="form-group col-md-6">
        <label for="exampleInputEmail1">Mã sản phẩm</label>
        <input type="text" class="form-control" id="exampleInputEmail1" value="<?php echo $row['ProductID'] ?>" name="id" readonly="readonly">
      </div>    
      <div class="form-group col-md-6">
        <label for="exampleInputPassword1">Tên sản phẩm</label>
        <input type="text" class="form-control" id="exampleInputPassword1" value="<?php echo $row['ProductName'] ?>" name="name">
      </div>
      <div class="form-group col-md-6">
        <label for="exampleInputFile">Ảnh</label>
        <div class="input-group" style="display: flex;">
          <div class="custom-file col-md-10">
            <input type="file" class="custom-file-input" id="exampleInputFile" name="logo">
            <label class="custom-file-label" for="exampleInputFile">Choose file</label>
          </div>
          <img class="col-md-2" style="width: 50px; height: 50px;" src="<?php echo $row['Image'] ?>" alt="" id="logo"/> 
          <?php
            echo '
                <script language="javascript">
                    let file = document.querySelector("#exampleInputFile");

                    file.onchange = function() {
                        let cutstring = file.value.substr(12, file.value.length);
                        document.querySelector("#logo").src="./assets/image/imgProduct/" + cutstring;
                    }
                </script>
            ';
          ?>
        </div>
      </div>
      <div class="form-group col-md-6">
        <label>VGA</label>
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
                <option value="<?php echo $key['CardID'] ?>" 
                  <?php if ($row['CardID'] == $key['CardID']) { echo 'selected="selected"'; } ?>><?php echo $key['NameOfCard'] ?></option>;
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
                <option value="<?php echo $key['RamID'] ?>" 
                  <?php if ($row['RamID'] == $key['RamID']) { echo 'selected="selected"'; } ?>><?php echo $key['Storage'].'GB'.'-'.$key['Type'] ?></option>;
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
                <option value="<?php echo $key['SsdID'] ?>" 
                  <?php if ($row['SsdID'] == $key['SsdID']) { echo 'selected="selected"'; } ?>><?php echo $key['Storage'].'-'.$key['Type'] ?></option>;
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
                <option value="<?php echo $key['HddID'] ?>" 
                  <?php if ($row['HddID'] == $key['HddID']) { echo 'selected="selected"'; } ?>><?php echo $key['Storage']; ?></option>;
            <?php } ?>
            
        </select> 
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
                <option value="<?php echo $key['ColorID'] ?>" 
                  <?php if ($row['ColorID'] == $key['ColorID']) { echo 'selected="selected"'; } ?>><?php echo $key['ColorName'] ?></option>;
            <?php } ?>
            
        </select>
      </div>
      <div class="form-group col-md-6">
        <label for="exampleInputPassword1">Số lượng</label>
        <input type="number" class="form-control" id="exampleInputPassword1" value="<?php echo $row['Quantity'] ?>" name="quantity">
      </div>
      <div class="form-group col-md-6">
        <label for="price">Giá</label>
        <input type="number" class="form-control" id="price" value="<?php echo $row['Price'] ?>" name="price">
      </div>
      
      <div class="form-group col-md-6">
        <label for="discount">Khuyến mại</label>
        <input type="number" class="form-control" id="discount" value="<?php echo $row['Discount'] ?>" name="discount">
      </div>  
      <div class="form-group col-md-6">
        <label for="total">Giá sau khuyến mại</label>
        <input type="number" class="form-control" id="total" value="<?php echo $row['Total'] ?>" name="total" readonly="readonly">
      </div>
      <div class="form-group col-md-6">
        <label for="exampleInputPassword1">Năm sản xuất</label>
        <input type="text" class="form-control" id="exampleInputPassword1" value="<?php echo $row['YearOfProduction'] ?>" name="yearOfPro">
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
              <option value="<?php echo $key['BrandID'] ?>" 
                <?php if ($row['BrandID'] == $key['BrandID']) { echo 'selected="selected"'; } ?>><?php echo $key['BrandName'] ?></option>;
                <?php } ?>
                
              </select>
      </div>
      <div class="form-group col-md-12">
        <label for="exampleInputEmail1">Mô tả</label>
        <!-- <input type="text" class="form-control" id="exampleInputEmail1" value="<?php echo $row['Description'] ?>" name="description"> -->
        <textarea name="description"><?php echo $row['Description'] ?></textarea>
      </div>   
             
    </div>
    <!-- /.card-body -->

    <div class="card-footer">
      <button class="btn btn-primary" type="submit" name="ProductUpdateBtn">Edit</button>
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
    if(isset($_POST['ProductUpdateBtn'])){
        $id = $_POST['id'];
        $name = $_POST['name'];
        $logo = $_FILES['logo']['name'];
        $price = $_POST['price'];
        $total = $_POST['total'];
        $quantity = $_POST['quantity'];
        $description = $_POST['description'];
        $discount = $_POST['discount'];
        $yearOfPro = $_POST['yearOfPro'];
        $brandOption = $_POST['brandOption'];
        $colorOption = $_POST['colorOption'];
        $ramOption = $_POST['ramOption'];
        $vgaOption = $_POST['vgaOption'];
        $ssdOption = $_POST['ssdOption'];
        $hddOption = $_POST['hddOption'];
        
        
        if ($logo != null) {
          $path = "./assets/image/imgProduct/";
          $tmp_name = $_FILES['logo']['tmp_name'];
          $logo = $_FILES['logo']['name'];
          
          move_uploaded_file($tmp_name, $path.$logo);
          $img = $path.$logo;
          $sql = "UPDATE products SET ProductName='$name', Image='$img', Price='$price', Discount='$discount', Total='$total', Description='$description', YearOfProduction='$yearOfPro', Quantity='$quantity',BrandID='$brandOption', ColorID='$colorOption', SsdID='$ssdOption', HddID='$hddOption', CardID='$vgaOption', RamID='$ramOption' where ProductID='$id'";
          mysqli_query($conn, $sql);
          echo("<script>location.href = 'index.php?page=ShowProduct';</script>");
        }   else {
          // $sql = "update products set ProductName='$name', Price='$price', Quantity='$quantity', Discount='$discount', Description='$description', YearOfProduction='$yearOfPro', BrandID='$brandOption', ColorID='$colorOption' where ProductID='$id'";
          $sql = "UPDATE products SET ProductName='$name', Price='$price', Discount='$discount', Total='$total', Description='$description', YearOfProduction='$yearOfPro', Quantity='$quantity',BrandID='$brandOption', ColorID='$colorOption', SsdID='$ssdOption', HddID='$hddOption', CardID='$vgaOption', RamID='$ramOption' where ProductID='$id'";
          mysqli_query($conn, $sql);
          echo("<script>location.href = 'index.php?page=ShowProduct';</script>");
        }
    }
    mysqli_close($conn);
?>

