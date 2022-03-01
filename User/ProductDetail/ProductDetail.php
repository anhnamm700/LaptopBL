<?php
    $id = $_GET['ProductID'];
    include_once '../connect.php';

    if (isset($_SESSION['emailAcc'])) {
        $email = $_SESSION['emailAcc'];
    }
    
?>

<script type="text/javascript" src="./assets/js/jquery.validate.min.js"></script>

<div class="columns-container">
    <div class="container" id="columns">
        <!-- breadcrumb -->
        <div class="breadcrumb clearfix">
            <a class="home" href="index.php" title="Return to Home">Home</a>
            <span class="navigation-pipe">Chi tiết sản phẩm</span>
        </div>
        <!-- ./breadcrumb -->
        <!-- row -->
        <div class="row">
            <div class="column col-xs-12 col-sm-3" id="left_column">
                <!-- block best sellers -->
                <div class="block left-module">
                    <p class="title_block">Sản phẩm mới</p>
                    <div class="block_content">
                        <ul class="products-block best-sell">
                                <?php
                                    $sql ="SELECT products.Image AS Img, products.ProductName AS NamePro, products.Price AS Prc, products.Discount AS Dis, products.ProductID AS ID FROM products WHERE YearOfProduction = YEAR(NOW()) ORDER BY RAND() LIMIT 4";
                                    $result = mysqli_query($conn, $sql);

                                    $data = [];
                                    while ($row = mysqli_fetch_array($result)) {
                                        $data[] = $row;
                                    }

                                    foreach ($data as $key) {
                                ?>
                                <li>
                                    <div class="products-block-left">
                                        <a href="index.php?page=ProductDetail&ProductID=<?php echo $key['ID']; ?>">
                                            <img src="../Admin.<?php echo $key['Img'] ?>" alt="SPECIAL PRODUCTS" style="width: 75px; height: 75px; object-fit: cover;">
                                        </a>
                                    </div>
                                    <div class="products-block-right">
                                        <p class="product-name">
                                            <a href="index.php?page=ProductDetail&ProductID=<?php echo $key['ID']; ?>">
                                                <?php 
                                                    $stringLength = strlen($key['NamePro']); 
                                                    $stringCut = substr($key['NamePro'], 40, $stringLength); 
                                                    
                                                    
                                                    echo str_replace($stringCut, '...', $key['NamePro']);
                                                ?>
                                            </a>
                                        </p>
                                        <p class="product-price">
                                            <?php
                                                if ($key['Dis'] > 0) {
                                                    $oldPrice = $key['Prc'];
                                                    $discount = $key['Dis'];
    
                                                    $result = $oldPrice - ($oldPrice * $discount) / 100;
                                                    echo number_format($result, 0, '', ',').'đ';
                                                } else {
                                                    echo number_format($key['Prc'], 0, '', ',').'đ';
                                                }
                                            ?>
                                        </p>
                                    </div>
                                </li>
                                <?php } ?>
                            </ul>
                    </div>
                </div>
            </div>
            <div class="center_column col-xs-12 col-sm-9" id="center_column">
                <!-- Product -->
                    <?php  
                        $sqlGetPro = "SELECT ram.Type AS RamType, ram.Storage AS RamStorage, ram.RamName, brand.BrandName, ssd.SsdName, ssd.Type AS SsdType, ssd.Storage AS SsdStorage, hdd.HddName, hdd.Storage AS HddStorage, cardvga.*,productcolor.ColorName, products.* FROM products INNER JOIN productcolor ON products.ColorID = productcolor.ColorID INNER JOIN ram ON products.RamID = ram.RamID INNER JOIN brand ON products.BrandID = brand.BrandID INNER JOIN ssd ON products.SsdID = ssd.SsdID INNER JOIN hdd ON products.HddID = hdd.HddID INNER JOIN cardvga ON products.CardID = cardvga.CardID WHERE products.ProductID = '$id' GROUP BY products.ProductID";
                        // echo $sql; die;
                        $result2 = mysqli_query($conn, $sqlGetPro);
                    
                        $row = mysqli_fetch_array($result2);

                    ?>
                    <div id="product">
                        <?php  ?>
                        <div class="primary-box row">
                            <div class="pb-left-column col-xs-12 col-sm-6">
                                <!-- product-imge-->
                                <div class="product-image">
                                    <div class="product-full">
                                        <img style="width: 400px; height: 400px; object-fit: cover;" id="product-zoom" src="../Admin/<?php echo substr($row['Image'], 2, strlen($row['Image'])); ?>" data-zoom-image="../Admin/<?php echo substr($row['Image'], 2, strlen($row['Image'])); ?>">
                                    </div>
                                </div>
                                <!-- product-imge-->
                            </div>
                            <div class="pb-right-column col-xs-12 col-sm-6">
                                
                                <h1 class="product-name"><?php echo $row['ProductName'] ?></h1>
                                <div class="product-price-group" style="margin: 20px 0;">
                                    <?php
                                        if ($row['Discount'] > 0) {
                                            $oldPrice = $row['Price'];
                                            $discount = $row['Discount'];

                                            $result = $oldPrice - ($oldPrice * $discount) / 100;
                                            echo '
                                                <span class="price">'.number_format($result, 0, '', ',').'đ'.'</span>
                                                <span class="old-price">'.number_format($row['Price'], 0, '', ',').'đ'.'</span>
                                                <span class="discount">'.$row['Discount'].'%</span>
                                            ';
                                        } else {
                                            echo '
                                                <span class="price">'.number_format($row['Price'], 0, '', ',').'đ'.'</span>
                                            ';
                                        }
                                    ?>
                                    
                                </div>
                                <div class="info-orther">
                                    <p>Mã sản phẩm: <?php echo $row['ProductID'] ?></p>
                                    <p>Màu sắc: <?php echo $row['ColorName']; ?></p>
                                    <p>Tình trạng: <?php if ($row['Quantity'] > 0) { echo '<span class="in-stock" style="color: green;">Còn hàng</span>'; } else { echo '<span class="in-stock" style="color: red;">Hết hàng</span>'; } ?></p>
                                    <p>Năm sản xuất: <?php echo $row['YearOfProduction'] ?></p>
                                </div>
                                
                                <div class="form-action">
                                    <form id="addCart">
                                        
                                        <div class="qty" style="margin-bottom: 20px;">
                                            <label for="quantity">Số lượng: </label>
                                            <input id="option-product-qty" type="number" min=1 value="1" name="quantity[<?php echo $row['ProductID']; ?>]" id="quantity" style="border: 1px #999 solid; padding-left: 12px; line-height: 26px;">
                                        </div>
                                        <?php 
                                            if ($row['Quantity'] > 0) {
                                                if (isset($email)) {
                                        ?>
                                              <button type="submit" id="btn-add-cart" class="btn-add-cart" title="Add to Cart" style="cursor: pointer;">Thêm vào giỏ hàng</button>
                                    </form>
                                        <?php   } else { ?>
                                                <p style="cursor: pointer;" title="Add to Cart" class="btn-add-cart" onclick="alert('Bạn cần đăng nhập để sử dụng chức năng này!');">Add to Cart</p>
                                        <?php } 
                                        } else { ?>
                                                <p title="Sản phẩm đã hết hàng">Sản phẩm đã hết hàng</p>
                                        <?php } ?>

                                    
                                </div>
                            </div>
                        </div>
                        <!-- tab product -->
                        <div class="product-tab">
                            <ul class="nav-tab">
                                <li class="active">
                                    <a aria-expanded="false" data-toggle="tab" href="#product-detail">Giới thiệu sản phẩm</a>
                                </li>
                                <li>
                                    <a aria-expanded="true" data-toggle="tab" href="#information">Chi tiết sản phẩm</a>
                                </li>
                            </ul>
                            <div class="tab-container">
                                <div id="product-detail" class="tab-panel active">
                                    <p><?php echo $row['Description']; ?></p>
                                </div>
                                <div id="information" class="tab-panel">
                                    <p>Tên sản phẩm: <?php echo $row['ProductName'] ?></p>
                                    <p>Hãng sản xuất: <?php echo $row['BrandName'] ?></p>
                                    <p>Dung lượng ram: <?php echo $row['RamName'].'-'.$row['RamType'].'-'.$row['RamStorage'] ?></p>
                                    <p>Ổ cứng SSD: <?php echo $row['SsdName'].'-'.$row['SsdType'].'-'.$row['SsdStorage'] ?></p>
                                    <p>Ổ cứng HDD: <?php echo $row['HddName'].'-'.$row['HddStorage'] ?></p>
                                    <p>VGA: <?php if ($row['TypeOfCard'] == 0) { echo $row['NameOfCard'].'-'.'Card tích hợp'; } else { echo $row['NameOfCard'].'-'.'Card rời'; } ?></p>
                                    <p>Năm sản xuất: <?php echo $row['YearOfProduction'] ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                <!-- Product -->
            </div>
            <!-- ./ Center colunm -->
        </div>
        <!-- ./row-->
    </div>
</div>

<script>
    $('#addCart').validate({
        rules: {
            "quantity[<?php echo $row['ProductID']; ?>]": {
                required: true,
                remote: {
                    url: "ProductDetail/check_quantity.php",
                    type: "POST"
                }
            }
        },
        submitHandler: function(form) {
            console.log($(form).serializeArray());

            var data = $(form).serializeArray();
            $.ajax({
                type: "POST",
                // dataType: "JSON",
                url: "./Cart/cart_process.php?action=add",
                data: data,
                success: function(response) {
                    response = JSON.parse(response);
                    if (response.status == 0) {
                        alert(response.message);
                    } else {
                        alert(response.message);
                        // location.reload();
                    }
                }
            });
        }
    });
</script>