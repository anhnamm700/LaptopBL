<?php
    // include '../../connect.php';
    $conn = mysqli_connect('localhost', 'root', '', 'laptopphp') or die ('Kết nối thất bại');

    $GLOBALS['changed_cart'] = false;
    $error = false;
    $success = false;
    
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = array();
    }

    if (isset($_GET['action'])) {

        function updateCart($conn, $add = false) {

            foreach ($_POST['quantity'] as $id => $quantity) {
                if ($quantity == 0) {
                    unset( $_SESSION['cart'][$id]);
                } else {
                    if (!isset( $_SESSION['cart'][$id])) {
                        $_SESSION['cart'][$id] = 0;
                    }
    
                    if ($add) {
                        $_SESSION['cart'][$id] += $quantity;
                    } else {
                        $_SESSION['cart'][$id] = $quantity;
                    }
    
                    $quantityPro = mysqli_query($conn, "SELECT Quantity FROM products WHERE ProductID = '$id'");
                    $quantityAs = mysqli_fetch_assoc($quantityPro);
    
                    if ( $_SESSION['cart'][$id] > $quantityAs['Quantity']) {
                        $_SESSION['cart'][$id] = $quantityAs['Quantity'];
                        $GLOBALS['changed_cart'] = true;
                    }
                }
            }
        }

        switch ($_GET['action']) {
            case 'add': 
                updateCart($conn, true);
                if ($GLOBALS['changed_cart'] == false) {
                    echo("<script>location.href = 'index.php?page=Cart';</script>");
                }
                break;

            case 'delete': 
                if (isset($_GET['ProductID'])) {
                    unset($_SESSION['cart'][$_GET['ProductID']]);
                }
                echo("<script>location.href = 'index.php?page=Cart';</script>");
                break;
            case 'submit':
                if (isset($_POST['update_btn'])) {
                    updateCart($conn);
                    echo("<script>location.href = 'index.php?page=Cart';</script>");
                } elseif (isset($_POST['order_btn'])) {
                    if (!empty($_POST['quantity'])) {
                        date_default_timezone_set('Asia/Ho_Chi_Minh');
                        $sql = "SELECT * FROM account WHERE Email = '".$_SESSION['email']."' LIMIT 1";
                        $getID = mysqli_query($conn, $sql);
                        $id = mysqli_fetch_array($getID);

                        $total = 0;
                        $getID = implode("', '", array_keys($_POST['quantity']));
                        $products = mysqli_query($conn, "SELECT * FROM products WHERE ProductID IN ('".$getID."')");
                        
                        $orderProducts = array();
                        $updateString = "";
                        while ($row = mysqli_fetch_array($products)) {
                            $orderProducts[] = $row;
                            if ($_POST['quantity'][$row['ProductID']] > $row['Quantity']) {
                                $_SESSION['cart'][$row['ProductID']] = $row['Quantity'];
                                $GLOBALS['changed_cart'] = true;
                            } else {
                                $total += ($row['Price'] - ($row['Price'] * $row['Discount']) / 100) * $_POST['quantity'][$row['ProductID']];
                                $updateString .= " WHEN ProductID = '".$row['ProductID']."' THEN Quantity - ".$_POST['quantity'][$row['ProductID']]."";
                            }
                        }

                        

                        if ($GLOBALS['changed_cart'] == false) {
                            $productID = implode("', '", array_keys($_POST['quantity']));
                            $updateQuantity = mysqli_query($conn, "UPDATE products SET Quantity = CASE".$updateString." END WHERE ProductID IN ('".$productID."')");
                            // echo "UPDATE products SET Quantity = CASE".$updateString." END WHERE ProductID IN ('".$productID."')"; exit;
                            $idOrder = substr(md5(time()), 0, 10);
                            
                            mysqli_query($conn, "INSERT INTO orderz VALUES ('$idOrder', '".$id['AccountID']."', NULL, '".$_POST['message']."')");
                            

                            $getOrderID = mysqli_query($conn, "SELECT * FROM orderz ORDER BY OrderDate DESC LIMIT 1");
                            $orderID = mysqli_fetch_array($getOrderID);
                            $insertString = "";
                            foreach ($orderProducts as $key => $products) {
                                $pricePerPro = ($products['Price'] - ($products['Price'] * $products['Discount']) / 100) * $_POST['quantity'][$products['ProductID']];

                                $insertString .= "('NULL', '".$orderID['OrderID']."', '".$products['ProductID']."', '".$_POST['quantity'][$products['ProductID']]."', '$pricePerPro', 0, $pricePerPro, 2)";

                                if ($key != count($orderProducts) - 1) {
                                    $insertString .= ", ";
                                }
                            }

                            
                            $insertOrder = mysqli_query($conn, "INSERT INTO orderdetail VALUES ".$insertString."");

                            $success = "Đặt hàng thành công";

                            unset($_SESSION['cart']);
                        } 
                    } else {
                        $error = 'Không thể đặt hàng khi bạn không có sản phẩm';
                    }
                }
                break;
        }
    }
?>



<div class="columns-container">
    <?php if (!empty($success)) echo "<script>alert('".$success."')</script>";?>
    <div class="container" id="columns">
        <!-- breadcrumb -->
        <div class="breadcrumb clearfix">
            <a class="home" href="#" title="Return to Home">Home</a>
            <span class="navigation-pipe">&nbsp;</span>
            <span class="navigation_page">Giỏ hàng</span>
        </div>
        <!-- ./breadcrumb -->
        <!-- page heading-->
        <h2 class="page-heading no-line">
            <span class="page-heading-title2">Giỏ hàng của bạn</span>
        </h2>

        <?php if ($GLOBALS['changed_cart']) { ?>
            <h4>Số lượng tồn kho không đủ, <a href="index.php?page=Cart" style="color: blue;">Tải lại giỏ hàng</a></h4>
        <?php } else { ?>
        <!-- ../page heading-->
            <div class="page-content page-order" id="cartForm">
                <form class="order-detail-content" method="POST" action="index.php?page=Cart&action=submit">
                    <table class="table table-bordered table-responsive cart_summary">
                        <thead>
                            <tr>
                                <th>STT</th>
                                <th class="cart_product">Ảnh sản phẩm</th>
                                <th>Mô tả</th>
                                <th>Số lượng</th>
                                <th>Giá tiền</th>
                                <th>Giảm giá</th>
                                <th>Tổng tiền</th>
                                <th class="action"><i class="fa fa-trash-o"></i></th>
                            </tr>
                        </thead>
                        <tbody id="content_cart">
                            <?php
                                if (!empty($_SESSION['cart'])) {
                                    $productID = implode("', '", array_keys($_SESSION['cart']));
                                    $sql = "SELECT products.*, productcolor.*, brand.* FROM products INNER JOIN productcolor ON products.ColorID = productcolor.ColorID INNER JOIN brand ON products.BrandID = brand.BrandID WHERE ProductID IN ('".$productID."') GROUP BY ProductID";
                                    $result = mysqli_query($conn, $sql);
                                }
                                
                                if (!empty($result)) {
                                    $total = 0;
                                    $i = 0;
                                    while ($row = mysqli_fetch_array($result)) {
                            ?>
                                    <tr id="<?php echo $row['ProductID'] ?>">
                                        <td class="qty"><?php echo ++$i; ?></td>
                                        <td class="cart_product">
                                            <a href="#"><img style="width: 100px; height: 100px;" src="../Admin.<?php echo $row['Image'] ?>" alt="Product"></a>
                                        </td>
                                        <td class="cart_description">
                                            <p class="product-name"><a href="#">Tên sản phẩm: <?php echo $row['ProductName'] ?></a></p>
                                            <small><a href="#">Nhãn hiệu : <?php echo $row['BrandName'] ?></a></small><br>   
                                            <small class="cart_ref">Màu sắc: <?php echo $row['ColorName'] ?></small><br>
                                        </td>
                                        <td class="cart_avail"><input class="form-control input-sm" oninput="javascript:updateQuantity(this.value)" type="number" value="<?php echo $_SESSION['cart'][$row['ProductID']] ?>" min="1" name="quantity[<?php echo $row['ProductID'] ?>]"></td>
                                        <td class="price"><span><?php echo number_format($row['Price'], 0, '', ',').'đ'; ?></span></td>
                                        <td class="qty">
                                        <span><?php echo $row['Discount'] ?></span>
                                        </td>
                                        <td class="price">
                                            <span>
                                                <?php 
                                                echo number_format(($row['Price'] - ($row['Price'] * $row['Discount']) / 100) * $_SESSION['cart'][$row['ProductID']], 0, '', ',').'đ';
                                                ?>
                                            </span>
                                        </td>
                                        <td class="delete">
                                            <a style="width: 20px; display: block; text-align: center;" href="javascript:deleteCart('<?php echo $row['ProductID'] ?>')"><i class="fas fa-trash-alt"></i></a>
                                        </td>
                                    </tr>
                                    <?php $total += ($row['Price'] - ($row['Price'] * $row['Discount']) / 100) * $_SESSION['cart'][$row['ProductID']]; ?>
                            <?php } ?>
                            <tr>
                                <!-- <td colspan="2" rowspan="2"></td> -->
                                <td colspan="5"><strong>Total</strong></td>
                                <td colspan="2"><strong><?php echo number_format($total, 0, '', ',').'đ'; ?></strong></td>
                            </tr>
                        <?php } ?>
                            
                        </tbody>
                        <tfoot>
                            
                            <?php
                                if (empty($_POST['quantity'])) {
                            ?>
                                <p style="font-size: 20px; color: red;"><?php echo $error; ?></p>
                            <?php } ?>
                            <!-- <tr>
                                <td colspan="2" rowspan="2"></td>
                                <td colspan="3">Total products (tax incl.)</td>
                                <td colspan="2">122.38 €</td>
                            </tr> -->
                        
                        </tfoot>    
                    </table>
                    <div class="form-selector">
                        <label>Ghi chú</label>
                        <textarea class="form-control input-sm" rows="10" id="message" name="message"></textarea>
                    </div>
                    <div class="cart_navigation" style="display: flex; justify-content: space-around;">
                        <button type="submit" name="update_btn" title="Cập nhật" style="cursor: pointer; padding: 12px 20px; background-color: #2ecc71; color: #fff;">Cập nhật lại giỏ hàng</button>
                        <button type="submit" name="order_btn" title="Đặt hàng" style="cursor: pointer; padding: 12px 20px; background-color: #e74c3c; color: #fff;">Đặt hàng</button>
                    </div>
                </form>
            </div>
        <?php } ?>
    </div>
</div>