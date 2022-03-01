<?php  
    include_once '../connect.php';
?>

<div class="columns-container">
    <div class="container" id="columns">
        <!-- breadcrumb -->
        <div class="breadcrumb clearfix">
            <a class="home" href="index.php" title="Return to Home">Trang chủ</a>
            <span class="navigation-pipe">&nbsp;</span>
            <span class="navigation_page">Sản phẩm bán chạy</span>
        </div>
        <!-- ./breadcrumb -->
        <!-- row -->
        <div class="row">
            <!-- Left colunm -->
            <div class="column col-xs-12 col-sm-3" id="left_column">
                <!-- block filter -->
                <div class="block left-module">
                    <p class="title_block">Bộ lọc sản phẩm</p>
                    <div class="block_content">
                        <!-- layered -->
                        <div class="layered layered-filter-price">
                            <div class="layered_subtitle">Thương hiệu</div>
                            <div class="layered-content filter-brand">
                                <ul class="check-box-list">
                                    <?php
                                        $sql = "SELECT * FROM brand";
                                        $result = mysqli_query($conn, $sql);

                                        $data = [];
                                        while ($row = mysqli_fetch_array($result)) {
                                            $data[] = $row;
                                        }

                                        foreach ($data as $val) {
                                    ?>
                                    <li>
                                        <input type="checkbox" id="<?php echo $val['BrandID'].'-'.$val['BrandName'] ?>" name="<?php echo $val['BrandID'] ?>" value="<?php echo $val['BrandID'] ?>" class="common_selector brand">
                                        <label for="<?php echo $val['BrandID'].'-'.$val['BrandName'] ?>">
                                        <span class="button"></span>
                                            <?php echo $val['BrandName'] ?>
                                        </label>   
                                    </li>
                                    <?php } ?>
                                </ul>
                            </div>
                            <!-- ./filter categgory -->
                            <!-- filter price -->
                            <div class="layered_subtitle">Giá tiền</div>
                            <div class="layered-content slider-range">
                                <ul class="check-box-list">
                                    <li>
                                        <input type="checkbox" id="p1" name="min-price" class="common_selector min-price">
                                        <label for="p1">
                                        <span class="button"></span>
                                        Từ 5 đến 20 triệu
                                        </label>   
                                    </li>
                                    <li>
                                        <input type="checkbox" id="p2" name="medium-price" class="common_selector medium-price">
                                        <label for="p2">
                                        <span class="button"></span>
                                        Từ 21 đến 40 triệu
                                        </label>   
                                    </li>
                                    <li>
                                        <input type="checkbox" id="p3" name="max-price" class="common_selector max-price">
                                        <label for="p3">
                                        <span class="button"></span>
                                        Trên 41 triệu
                                        </label>   
                                    </li>
                                </ul>
                            </div>
                            <!-- ./filter price -->
                            <div class="layered_subtitle">Màu sắc</div>
                            <div class="layered-content filter-brand">
                                <ul class="check-box-list">
                                <?php
                                        $sql = "SELECT * FROM productcolor";
                                        $result = mysqli_query($conn, $sql);

                                        $data = [];
                                        while ($row = mysqli_fetch_array($result)) {
                                            $data[] = $row;
                                        }

                                        foreach ($data as $val) {
                                    ?>
                                    <li>
                                        <input type="checkbox" id="<?php echo $val['ColorID'].'-color' ?>" value="<?php echo $val['ColorID'] ?>" name="<?php echo $val['ColorID'] ?>" class="common_selector color"/>
                                        <label for="<?php echo $val['ColorID'].'-color' ?>">
                                        <span class="button"></span>
                                            <?php echo $val['ColorName'] ?>
                                        </label>   
                                    </li>
                                    <?php } ?>
                                </ul>
                            </div>
                            <div class="layered_subtitle">VGA</div>
                            <div class="layered-content filter-brand">
                                <ul class="check-box-list">
                                <?php
                                        $sql = "SELECT * FROM cardvga";
                                        $result = mysqli_query($conn, $sql);

                                        $data = [];
                                        while ($row = mysqli_fetch_array($result)) {
                                            $data[] = $row;
                                        }

                                        foreach ($data as $val) {
                                    ?>
                                    <li>
                                        <input type="checkbox" id="<?php echo $val['CardID'].'-'.$val['TypeOfCard'] ?>" name="<?php echo $val['CardID'] ?>" value="<?php echo $val['CardID'] ?>" class="common_selector vga">
                                        <label for="<?php echo $val['CardID'].'-'.$val['TypeOfCard'] ?>">
                                        <span class="button"></span>
                                            <?php
                                                if ($val['TypeOfCard'] == 0) {
                                                    echo $val['NameOfCard'].'-'.'Card tích hợp';
                                                } elseif ($val['TypeOfCard'] == 1) {
                                                    echo $val['NameOfCard'].'-'.'Card rời';
                                                }
                                            ?>
                                        </label>   
                                    </li>
                                    <?php } ?>
                                </ul>
                            </div>
                            <div class="layered_subtitle">SSD</div>
                            <div class="layered-content filter-brand">
                                <ul class="check-box-list">
                                <?php
                                        $sql = "SELECT * FROM ssd";
                                        $result = mysqli_query($conn, $sql);

                                        $data = [];
                                        while ($row = mysqli_fetch_array($result)) {
                                            $data[] = $row;
                                        }

                                        foreach ($data as $val) {
                                    ?>
                                    <li>
                                        <input type="checkbox" id="<?php echo $val['SsdID'].'-'.$val['Type'] ?>" value="<?php echo $val['SsdID']?>" name="<?php echo $val['SsdID']?>" class="common_selector ssd">
                                        <label for="<?php echo $val['SsdID'].'-'.$val['Type'] ?>">
                                        <span class="button"></span>
                                            <?php echo $val['SsdName'].'-'.$val['Type'] ?>
                                        </label> 
                                        </label>   
                                    </li>
                                    <?php } ?>
                                </ul>
                            </div>
                            <div class="layered_subtitle">RAM</div>
                            <div class="layered-content filter-brand">
                                <ul class="check-box-list">
                                <?php
                                        $sql = "SELECT * FROM ram";
                                        $result = mysqli_query($conn, $sql);

                                        $data = [];
                                        while ($row = mysqli_fetch_array($result)) {
                                            $data[] = $row;
                                        }
                                        
                                        foreach ($data as $val) {
                                    ?>
                                    <li>
                                        <input type="checkbox" id="<?php echo $val['RamID'].'-'.$val['Type'] ?>" value="<?php echo $val['RamID'] ?>" name="<?php echo $val['RamID'] ?>" class="common_selector ram">
                                        <label for="<?php echo $val['RamID'].'-'.$val['Type'] ?>">
                                        <span class="button"></span>
                                            <?php echo $val['Storage'].'-'.$val['Type'] ?>
                                        </label>  
                                        </label>   
                                    </li>
                                    <?php } ?>
                                </ul>
                            </div>
                        </div>

                        <!-- ./layered -->

                    </div>
                </div>
                <!--./left silde-->
            </div>
            <!-- ./left colunm -->
            <!-- Center colunm-->
            <div class="center_column col-xs-12 col-sm-9" id="center_column">
                <!-- view-product-list-->
                <div id="view-product-list" class="view-product-list">
                    <h2 class="page-heading">
                        <span class="page-heading-title">Sản phẩm bán chạy</span>
                    </h2>
                    <!-- PRODUCT LIST -->
                    <ul class="row product-list grid filter_data">
                        

                    
                    </ul>
                    <?php 

                        $item_per_page = !empty($_GET['per_page']) ? $_GET['per_page'] : 6;
                        $curren_page = !empty($_GET['cur_page']) ? $_GET['cur_page'] : 1;
                    
                        $totalRecord = mysqli_query($conn, "SELECT products.*, COUNT(orderdetail.ProductID) FROM orderdetail INNER JOIN products ON products.ProductID = orderdetail.ProductID WHERE orderdetail.StatusID IN (2, 3)");
                        $totalRecord = $totalRecord->num_rows;
                    
                        $totalPage = ceil($totalRecord / $item_per_page);
                    ?>
                    <input type="hidden" value="<?php echo $item_per_page; ?>" id="item_per_page"/>
                    <input type="hidden" value="<?php echo $curren_page; ?>" id="curren_page"/>
                </div>
                <!-- ./view-product-list-->
                <div class="sortPagiBar">
                    <div class="bottom-pagination">
                        <?php include './panigation.php'  ?>
                    </div>
                </div>
            </div>
            <!-- ./ Center colunm -->
        </div>
        <!-- ./row-->
    </div>
</div>

<script>
    $(document).ready(function() {
        filter_data();

        function get_filter(className) {
            var filter = [];
            $('.'+className+':checked').each(function() {
                filter.push($(this).val());
            });
            return filter;
        }

        function filter_data() {
            var action = 'get_data';
            var min_price = get_filter('min-price');
            var medium_price = get_filter('medium-price');
            var max_price = get_filter('max-price');
            var brand = get_filter('brand');
            var vga = get_filter('vga');
            var ram = get_filter('ram');
            var color = get_filter('color');
            var ssd = get_filter('ssd');
            var curren_page = Number(document.querySelector("#curren_page").value);
            var item_per_page = Number(document.querySelector("#item_per_page").value);


            $.ajax({
                url: "./SellingProducts/get_data.php",
                method: "POST",
                data: {
                    action: action,
                    minimum_price: min_price,
                    medium_price: medium_price,
                    max_price: max_price,
                    brand: brand,
                    vga: vga,
                    ram: ram,
                    ssd: ssd,
                    color: color,
                    item_per_page: item_per_page,
                    curren_page: curren_page
                },
                success: function(data) {
                    $('.filter_data').html(data);
                }
            });
        }


        $('.common_selector').click(function() {
            filter_data();  
        });
    });

</script>
<!-- SELECT products.*, COUNT(orderdetail.ProductID) FROM orderdetail INNER JOIN products ON products.ProductID = orderdetail.ProductID WHERE orderdetail.StatusID IN (2, 3) GROUP BY products.ProductID -->