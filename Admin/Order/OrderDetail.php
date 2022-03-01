<?php
    @include("../connect.php");
?>

<?php

    if (isset($_GET['OrderID'])) {
    $id = $_GET['OrderID'];
    $sqlSelect = "SELECT products.ProductName, products.Price,productcolor.*,orderdetail.* FROM orderdetail INNER JOIN products on orderdetail.ProductID = products.ProductID INNER JOIN productcolor ON products.ColorID = productcolor.ColorID WHERE orderdetail.OrderID = '$id' GROUP BY orderdetail.ProductID";   
    $result = mysqli_query($conn, $sqlSelect);

    $data = [];
    while ($row = mysqli_fetch_array($result)) {
      $data[] = $row;
    }
?>

<div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                <h3 class="card-title">Chi tiết đơn hàng <strong><?php echo $id; ?></strong></h3>

                <a href="index.php?page=ShowOrder">Quay lại</a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table class="table table-bordered">
                  <thead>                  
                    <tr>
                      <th style="width: 10px">STT</th>
                      <th style="width: 120px">Mã chi tiết đơn hàng</th>
                      <th style="width: 320px">Tên sản phẩm</th>
                      <th style="width: 80px">Trạng thái</th>
                      <th style="width: 40px">Hành động</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                      $i = 0;
                      foreach ($data as $val) { 
                    ?>
                      <tr>
                        <td><?php echo ++$i; ?></td>
                        <td><?php echo $val['DetailID']; ?></td>
                        <td><?php echo $val['ProductName']; ?></td>
                        <td>
                          <?php 
                            if ($val['StatusID'] == 1) { 
                              echo 'Huỷ bỏ';
                            } elseif ($val['StatusID'] == 2) {
                              echo 'Đang chờ';
                            } elseif ($val['StatusID'] == 3) {
                              echo 'Hoàn thành';
                            } elseif ($val['StatusID'] == 4) {
                              echo 'Đang xử lí';
                            }
                          ?>
                        </td>
                        <td><a href="index.php?page=OrderDetail&DetailID=<?php echo $val['DetailID']; ?>">Sửa</a></td>
                      </tr>
                    <?php } ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
<?php } elseif (isset($_GET['DetailID'])) { ?>

  
  <?php
    $detailID = $_GET['DetailID'];

    $getDetail = mysqli_query($conn, "SELECT orderstatus.*, products.ProductName, products.Price,productcolor.*,orderdetail.* FROM orderdetail INNER JOIN products on orderdetail.ProductID = products.ProductID INNER JOIN productcolor ON products.ColorID = productcolor.ColorID INNER JOIN orderstatus ON orderdetail.StatusID = orderstatus.StatusID WHERE orderdetail.DetailID = '$detailID' GROUP BY orderdetail.ProductID"); 

    $rowDetail = mysqli_fetch_array($getDetail);

    // var_dump($dataDetail); exit;

  ?>

<div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Chi tiết đơn hàng</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" method="POST">
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputPassword1">Tên sản phẩm</label>
                    <input type="text" class="form-control" id="exampleInputPassword1" value="<?php echo $rowDetail['ProductName'] ?>" name="productName" readonly="readonly">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Đơn giá</label>
                    <input type="number" class="form-control" id="unitPrice" value="<?php echo $rowDetail['Price'] ?>" name="unitPrice" readonly="readonly">
                  </div>
                  <div class="form-group">
                  <label>Màu sắc</label>
                  <select name="colorOption" class="form-control select2 select2-hidden-accessible" style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true" disabled>
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
                            <?php if ($rowDetail['ColorID'] == $key['ColorID']) { echo 'selected="selected"'; }  ?> ><?php echo $key['ColorName'] ?></option>;
                      <?php } ?>
                     
                  </select>
                </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Số lượng</label>
                    <input type="number" class="form-control" id="quantity" value="<?php echo $rowDetail['Quantity'] ?>" name="quantity">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Phiếu giảm giá</label>
                    <input type="number" class="form-control" id="discount" value="<?php echo $rowDetail['Counpons'] ?>" name="discount">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Thành tiền</label>
                    <input type="number" class="form-control" id="total" value="<?php echo $rowDetail['TotalPrice'] ?>" name="total" readonly="readonly">
                  </div>
                  <div class="form-group">
                  <label>Trạng thái</label>
                  <select name="statusOption" class="form-control select2 select2-hidden-accessible" style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true">
                     <?php
                        $sqlStatus = "select * from orderstatus";
                        $val = mysqli_query($conn, $sqlStatus);

                        $data = [];
                        while ($rows = mysqli_fetch_array($val)) {
                          $data[] = $rows;
                        }
                      ?>

                      <?php foreach ($data as $key) { ?>
                          <option value="<?php echo $key['StatusID'] ?>" 
                            <?php if ($rowDetail['StatusID'] == $key['StatusID']) { echo 'selected="selected"'; } ?>><?php echo $key['StatusName'] ?></option>;
                      <?php } ?>
                     
                  </select>
                  <input type="hidden" class="form-control" id="id" value="<?php echo $rowDetail['OrderID'] ?>" name="id">
                </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button name="updateOrderBtn" class="btn btn-primary" type="submit">Edit</button>
                  <a href="index.php?page=ShowOrder" class="btn btn-danger">Cancel</a>
                </div>
              </form>
            </div>

            <script>
              let unitPrice = document.getElementById("unitPrice");
              let quantity = document.getElementById("quantity");
              let discount = document.getElementById("discount");

              quantity.oninput = function() {
                let total = (Number(unitPrice.value) * Number(quantity.value)) - ((Number(unitPrice.value) * Number(quantity.value)) * (Number(discount.value) / 100));
                document.getElementById("total").value = total;
              };
            </script>
  <?php
    if(isset($_POST['updateOrderBtn'])){
      $id = $_POST['id'];
      $name = $_POST['productName'];
      $quantity = $_POST['quantity'];
      $discount = $_POST['discount'];
      $total = $_POST['total'];
      $statusOption = $_POST['statusOption'];

      
      $checkQuantity = mysqli_query($conn, "SELECT Quantity FROM orderdetail WHERE DetailID='$detailID'");
      $row = mysqli_fetch_assoc($checkQuantity);

    $sqlDisplay = '';

    if ($quantity != $row['Quantity']) {
        $checkName = mysqli_query($conn, "SELECT Quantity FROM products WHERE ProductName LIKE '$name' LIMIT 1");
        $rowProduct = mysqli_fetch_assoc($checkName);
        $quantityPro = 0;
        if ($quantity > $row['Quantity']) {
          $quantityPro = $rowProduct['Quantity'] - ($quantity - (int)$row['Quantity']);
          $sqlDisplay = "UPDATE orderdetail, products set orderdetail.Quantity='$quantity', orderdetail.Counpons='$discount', orderdetail.TotalPrice='$total', orderdetail.StatusID='$statusOption', products.Quantity='$quantityPro' WHERE orderdetail.ProductID=products.ProductID AND DetailID='$detailID'";
        } else {
          $quantityPro = $rowProduct['Quantity'] + ((int)$row['Quantity'] - $quantity);
          $sqlDisplay = "UPDATE orderdetail, products set orderdetail.Quantity='$quantity', orderdetail.Counpons='$discount', orderdetail.TotalPrice='$total', orderdetail.StatusID='$statusOption', products.Quantity='$quantityPro' WHERE orderdetail.ProductID=products.ProductID AND DetailID='$detailID'";
        }
        
        // echo $sqlDisplay; exit;

        
    } else {
        $sqlDisplay = "UPDATE orderdetail set Quantity='$quantity', Counpons='$discount', TotalPrice='$total', StatusID='$statusOption' WHERE DetailID='$detailID'";
    }
    
    // echo $sqlDisplay; exit;
    $result = mysqli_query($conn, $sqlDisplay);

    if ($result) {
        echo("<script>alert('Cập nhật thành công!');</script>");
        echo("<script>location.href = 'index.php?page=OrderDetail&OrderID=$id';</script>");
    } else {
        echo("<script>alert('Có lỗi xảy ra!');</script>");
    }

    mysqli_close($conn);
  ?>

<?php } ?>
<?php } ?>