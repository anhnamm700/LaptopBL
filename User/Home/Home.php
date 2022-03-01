<?php
    if (isset($_SESSION['email'])) {
        $email = $_SESSION['email'];
    }
?>
    <!-- Home slideder-->
    <div id="home-slider">
        <div class="container">
            <div class="row">
                <div class="col-sm-3 slider-left"></div>
                <div class="col-sm-9 header-top-right">
                    <div class="header-top-right-wapper">
                        <div class="homeslider">
                            <div class="content-slide">
                                <ul id="contenhomeslider">
                                    <?php
                                        $sqlBanner = "SELECT * FROM banner ORDER BY OrderSort ASC";
                                        $result = mysqli_query($conn, $sqlBanner);

                                        $data = [];
                                        while ($rowbanner = mysqli_fetch_array($result)) {
                                            $data[] = $rowbanner;
                                        }
                                        
                                        foreach ($data as $val) {
                                    ?>
                                    <li><a href="<?php echo $val['Url'] ?>"><img alt="Funky roots" src="../Admin.<?php echo $val['Image'] ?>" title="Funky roots" /></a></li>
                                  <?php } ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END Home slideder-->
    <!-- box product new arrivals -->
    <div class="box-products new-arrivals">
        <!-- Sale Products -->
        <?php
            $getProductsQuery = "SELECT * FROM products WHERE Discount > 0 LIMIT 6";
            $resultSale = mysqli_query($conn, $getProductsQuery);

            if ($resultSale) {
        ?>
            <div class="container">
                <div class="box-product-head">
                    <span class="box-title">Sản phẩm khuyến mãi</span>
                    <ul class="box-tabs nav-tab">
                        <li><a  href="index.php?page=PromoProducts">Xem thêm</a></li>
                    </ul>
                </div>
                <div class="box-product-content">
                    <div class="box-product-list">
                        <div class="tab-container">
                            <div id="tab-1" class="tab-panel active">
                                <ul class="product-list owl-carousel nav-center" data-dots="false" data-loop="true" data-nav = "true" data-margin = "10" data-responsive='{"0":{"items":1},"600":{"items":3},"1000":{"items":4}}'>
                                    <?php
                                        
        
                                        $data = [];
                                        while ($row = mysqli_fetch_array($resultSale)) {
                                            $data[] = $row;
                                        }

                                        // var_dump($data); exit;
                                        
                                        foreach ($data as $val) {
                                    ?>
                                    <li class="border">
                                        <div class="left-block">
                                            <a href="index.php?page=ProductDetail&ProductID=<?php echo $val['ProductID']; ?>"><img class="img-responsive" alt="product" src="../Admin.<?php echo $val['Image'] ?>" style="height: 265px;"/></a>
                                            <form class="add-to-cart">
                                                <?php 
                                                    if ($val['Quantity'] > 0) {
                                                        if (isset($email)) {
                                                ?>  
                                                    
                                                        <input type="hidden" value="1" name="quantity[<?php echo $val['ProductID']; ?>]"/>
                                                        <button title="Add to Cart" type="submit" style="display: flex; align-items: center; justify-content: center; width: 100%;"><i class="fas fa-shopping-cart"></i><span style="margin-left: 12px;">Add to Cart</span></button>
                                                    
                                                <?php   } else { ?>
                                                        <button title="Add to Cart" onclick="alert('Bạn cần đăng nhập để sử dụng chức năng này!');" style="display: flex; align-items: center; justify-content: center; width: 100%;"><i class="fas fa-shopping-cart"></i><span style="margin-left: 12px;">Add to Cart</span></button>
                                                <?php } 
                                                } else { ?>
                                                        <p title="Sản phẩm đã hết hàng">Sản phẩm đã hết hàng</p>
                                                <?php } ?>
                                            </form>
                                        </div>
                                        <div class="right-block">
                                            <h5 class="product-name">
                                                <a href="index.php?page=ProductDetail&ProductID=<?php echo $val['ProductID']; ?>" style="display: block; height: 30px;">
                                                    <?php 
                                                        $stringLength = strlen($val['ProductName']); 
                                                        $stringCut = substr($val['ProductName'], 50, $stringLength); 
                                                        
                                                        // echo $stringLength; exit;
                                                        
                                                        echo str_replace($stringCut, '...', $val['ProductName']);
                                                    ?>
                                                </a>
                                            </h5>
                                            <div class="content_price">
                                                <span class="price product-price">
                                                    <?php 
                                                        echo number_format($val['Total'], 0, '', ',').'đ';
                                                    ?>
                                                </span>
                                                <span class="price old-price"><?php echo number_format($val['Price'], 0, '', ',').'đ'; ?></span>
                                            </div>
                                        </div>
                                        <div class="price-percent-reduction2">
                                            <?php echo $val['Discount'] ?>%
                                        </div>
                                    </li>
                                    <?php } ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>


        <!-- New Products -->
        <?php
            $getProductsQuery = "SELECT * FROM `products` WHERE YearOfProduction = YEAR(NOW()) LIMIT 6";
            $resultNew = mysqli_query($conn, $getProductsQuery);

            if ($resultNew) {
        ?>

            <div class="container" style="margin-top: 80px;">
                <div class="box-product-head">
                    <span class="box-title">Sản phẩm mới</span>
                    <ul class="box-tabs nav-tab">
                        <li><a  href="index.php?page=NewProducts">Xem thêm</a></li>
                    </ul>
                </div>
                <div class="box-product-content">
                    <div class="box-product-list">
                        <div class="tab-container">
                            <div id="tab-1" class="tab-panel active">
                                <ul class="product-list owl-carousel nav-center" data-dots="false" data-loop="true" data-nav = "true" data-margin = "10" data-responsive='{"0":{"items":1},"600":{"items":3},"1000":{"items":4}}'>
                                    <?php
                                    
        
                                        $data = [];
                                        while ($row = mysqli_fetch_array($resultNew)) {
                                            $data[] = $row;
                                        }

                                        // var_dump($data); exit;
                                        
                                        foreach ($data as $val) {
                                    ?>
                                    <li class="border">
                                        <div class="left-block">
                                            <a href="index.php?page=ProductDetail&ProductID=<?php echo $val['ProductID']; ?>"><img class="img-responsive" alt="product" src="../Admin.<?php echo $val['Image'] ?>" style="height: 265px;"/></a>
                                            <form class="add-to-cart">
                                                <?php 
                                                    if ($val['Quantity'] > 0) {
                                                        if (isset($email)) {
                                                ?>  
                                                    
                                                        <input type="hidden" value="1" name="quantity[<?php echo $val['ProductID']; ?>]"/>
                                                        <button title="Add to Cart" type="submit" style="display: flex; align-items: center; justify-content: center; width: 100%;"><i class="fas fa-shopping-cart"></i><span style="margin-left: 12px;">Add to Cart</span></button>
                                                    
                                                <?php   } else { ?>
                                                        <button title="Add to Cart" onclick="alert('Bạn cần đăng nhập để sử dụng chức năng này!');" style="display: flex; align-items: center; justify-content: center; width: 100%;"><i class="fas fa-shopping-cart"></i><span style="margin-left: 12px;">Add to Cart</span></button>
                                                <?php } 
                                                } else { ?>
                                                        <p title="Sản phẩm đã hết hàng">Sản phẩm đã hết hàng</p>
                                                <?php } ?>
                                            </form>
                                        </div>
                                        <div class="right-block">
                                            <h5 class="product-name">
                                                <a href="index.php?page=ProductDetail&ProductID=<?php echo $val['ProductID']; ?>" style="display: block; height: 30px;">
                                                    <?php 
                                                        $stringLength = strlen($val['ProductName']); 
                                                        $stringCut = substr($val['ProductName'], 50, $stringLength); 
                                                        
                                                        // echo $stringLength; exit;
                                                        
                                                        echo str_replace($stringCut, '...', $val['ProductName']);
                                                    ?>
                                                </a>
                                            </h5>
                                            <div class="content_price">
                                                <span class="price product-price">
                                                    <?php 
                                                        echo number_format($val['Total'], 0, '', ',').'đ';
                                                    ?>
                                                </span>
                                                <span class="price old-price"><?php echo number_format($val['Price'], 0, '', ',').'đ'; ?></span>
                                            </div>
                                        </div>
                                        <?php if ($val['Discount'] > 0) { ?>
                                            <div class="price-percent-reduction2">
                                                <?php echo $val['Discount'] ?>%
                                            </div>
                                        <?php } ?>
                                    </li>
                                    <?php } ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        <?php } ?>

        <!-- Selling Products -->
        <?php 
             $getProductsQuery = "SELECT products.*, COUNT(orderdetail.ProductID) FROM orderdetail INNER JOIN products ON products.ProductID = orderdetail.ProductID WHERE orderdetail.StatusID IN (2, 3) GROUP BY products.ProductID LIMIT 6";
             $result = mysqli_query($conn, $getProductsQuery);

             if ($result) {
        ?>
            <div class="container" style="margin-top: 80px;">
                <div class="box-product-head">
                    <span class="box-title">Sản phẩm bán chạy</span>
                    <ul class="box-tabs nav-tab">
                        <li><a  href="index.php?page=SellingProducts">Xem thêm</a></li>
                    </ul>
                </div>
                <div class="box-product-content">
                    <div class="box-product-list">
                        <div class="tab-container">
                            <div id="tab-1" class="tab-panel active">
                                <ul class="product-list owl-carousel nav-center" data-dots="false" data-loop="true" data-nav = "true" data-margin = "10" data-responsive='{"0":{"items":1},"600":{"items":3},"1000":{"items":4}}'>
                                    <?php
                                    
        
                                        $data = [];
                                        while ($row = mysqli_fetch_array($result)) {
                                            $data[] = $row;
                                        }

                                        // var_dump($data); exit;
                                        
                                        foreach ($data as $val) {
                                    ?>
                                    <li class="border">
                                        <div class="left-block">
                                            <a href="index.php?page=ProductDetail&ProductID=<?php echo $val['ProductID']; ?>"><img class="img-responsive" alt="product" src="../Admin.<?php echo $val['Image'] ?>" style="height: 265px;"/></a>
                                            <form class="add-to-cart">
                                                <?php 
                                                    if ($val['Quantity'] > 0) {
                                                        if (isset($email)) {
                                                ?>  
                                                    
                                                        <input type="hidden" value="1" name="quantity[<?php echo $val['ProductID']; ?>]"/>
                                                        <button title="Add to Cart" type="submit" style="display: flex; align-items: center; justify-content: center; width: 100%;"><i class="fas fa-shopping-cart"></i><span style="margin-left: 12px;">Add to Cart</span></button>
                                                    
                                                <?php   } else { ?>
                                                        <button title="Add to Cart" onclick="alert('Bạn cần đăng nhập để sử dụng chức năng này!');" style="display: flex; align-items: center; justify-content: center; width: 100%;"><i class="fas fa-shopping-cart"></i><span style="margin-left: 12px;">Add to Cart</span></button>
                                                <?php } 
                                                } else { ?>
                                                        <p title="Sản phẩm đã hết hàng">Sản phẩm đã hết hàng</p>
                                                <?php } ?>
                                            </form>
                                        </div>
                                        <div class="right-block">
                                            <h5 class="product-name">
                                                <a href="index.php?page=ProductDetail&ProductID=<?php echo $val['ProductID']; ?>" style="display: block; height: 30px;">
                                                    <?php 
                                                        $stringLength = strlen($val['ProductName']); 
                                                        $stringCut = substr($val['ProductName'], 50, $stringLength); 
                                                        
                                                        // echo $stringLength; exit;
                                                        
                                                        echo str_replace($stringCut, '...', $val['ProductName']);
                                                    ?>
                                                </a>
                                            </h5>
                                            <div class="content_price">
                                                <span class="price product-price">
                                                    <?php 
                                                        echo number_format($val['Total'], 0, '', ',').'đ';
                                                    ?>
                                                </span>
                                                <span class="price old-price"><?php echo number_format($val['Price'], 0, '', ',').'đ'; ?></span>
                                            </div>
                                        </div>
                                        <?php if ($val['Discount'] > 0) { ?>
                                            <div class="price-percent-reduction2">
                                                <?php echo $val['Discount'] ?>%
                                            </div>
                                        <?php } ?>
                                    </li>
                                    <?php } ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>

    <script>
        $(".add-to-cart").submit(function(event) {
            event.preventDefault();
            
            var data = $(this).serializeArray();
            
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
        });

    </script>