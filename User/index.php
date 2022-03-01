<?php
    session_start();
    include_once '../connect.php';

    if (isset($_SESSION['emailAcc'])) {
        $email = $_SESSION['emailAcc'];
    }
    
    $sqlGetConfig = "SELECT * FROM config";
    $condfig = mysqli_query($conn, $sqlGetConfig);

    $rowCon = mysqli_fetch_assoc($condfig);
?>

<!DOCTYPE html>
<html>

<!-- Mirrored from kutethemes.com/demo/kuteshop/html/index4.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 21 Jul 2015 07:22:27 GMT -->
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <script src="https://kit.fontawesome.com/8862f54ebe.js" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <link rel="stylesheet" type="text/css" href="assets/lib/bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="assets/lib/font-awesome/css/font-awesome.min.css" />
    <link rel="stylesheet" type="text/css" href="assets/lib/select2/css/select2.min.css" />
    <link rel="stylesheet" type="text/css" href="assets/lib/jquery.bxslider/jquery.bxslider.css" />
    <link rel="stylesheet" type="text/css" href="assets/lib/owl.carousel/owl.carousel.css" />
    <link rel="stylesheet" type="text/css" href="assets/lib/jquery-ui/jquery-ui.css" />
    <link rel="stylesheet" type="text/css" href="assets/css/animate.css" />
    <link rel="stylesheet" type="text/css" href="assets/css/reset.css" />
    <link rel="stylesheet" type="text/css" href="assets/css/style.css" />
    <link rel="stylesheet" type="text/css" href="assets/css/responsive.css" />
    <link rel="stylesheet" type="text/css" href="assets/css/option4.css" />
    
    <title>Option4 - Kute shop</title>
</head>
<body class="home option4">


<!-- HEADER -->
<div id="header" class="header">
    <div class="top-header">
        <div class="container">
            <div class="nav-top-links">
                <a class="first-item" href="#">Welcome to <?php echo $rowCon['NameOfCompany']; ?></a>
                <a href="#">Call Us: <?php echo $rowCon['Phone_1']; ?> - <?php echo $rowCon['Phone_2']; ?></a>
            </div>
            <a class="btn-fb-login" href="#">Login fb</a>
            <div class="support-link">
                <a href="#">Services</a>
                <a href="#">Support</a>
            </div>
            <div id="user-info-top" class="user-info pull-right">
                <div class="dropdown">
                    <?php
                         if (isset($email)) {
                             $sql = "SELECT AccountName FROM account WHERE Email = '$email'";
                             $result = mysqli_query($conn, $sql);
                             $row = mysqli_fetch_assoc($result);
                    ?>
                    <a class="current-open" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" href="#"><span><?php echo $row['AccountName']; ?></span></a>
                    <ul class="dropdown-menu mega_dropdown" role="menu">
                        <li><a href="index.php?page=Logout">Đăng xuất</a></li>
                        <li><a href="index.php?page=UserInfo">Thông tin tài khoản</a></li>
                    </ul>
                    <?php } else { ?>
                        <a class="current-open" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" href="#"><span>My Account</span></a>
                        <ul class="dropdown-menu mega_dropdown" role="menu">
                            <li><a href="index.php?page=Login">Đăng nhập</a></li>
                            <li><a href="index.php?page=Register">Đăng kí</a></li>
                        </ul>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
    <!--/.top-header -->
    <!-- MAIN HEADER -->
    <div id="main-header">
        <div class="container main-header">
            <div class="row">
                <div class="col-xs-12 col-sm-3 logo" style="margin-top: 20px;">
                    <a href="index.php"><img alt="Kute Shop" src="../Admin<?php echo $rowCon['Logo']; ?>" /></a>
                </div>
                <div id="main-menu" class="col-sm-12 col-md-8 main-menu">
                    <nav class="navbar navbar-default">
                        <div class="container-fluid">
                            <div class="navbar-header">
                                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                                    <i class="fa fa-bars"></i>
                                </button>
                                <a class="navbar-brand" href="#">MENU</a>
                            </div>
                            <div id="navbar" class="navbar-collapse collapse">
                                <ul class="nav navbar-nav">
                                    <li class="active"><a href="index.php">Trang chủ</a></li>
                                    <li class="active"><a href="index.php?page=PromoProducts">Sản phẩm khuyến mại</a></li>
                                    <li class="active"><a href="index.php?page=NewProducts">Sản phẩm mới</a></li>
                                    <li class="active"><a href="index.php?page=SellingProducts">Sản phẩm bán chạy</a></li>
                                    <li class="active"><a href="index.php?page=Contact">Liên hệ</a></li>
                                    <li class="active"><a href="index.php?page=News">Tin tức</a></li>
                                </ul>
                            </div><!--/.nav-collapse -->
                        </div>
                    </nav>
                </div>
                <div class="col-sm-2 col-md-1 group-button-header">
                    <div class="btn-cart" id="cart-block">
                        <a title="My cart" href="index.php?page=Cart">My Cart</a>
                        <span class="notify notify-right">10</span>
                        <!-- <div class="cart-block">
                            <div class="cart-block-content">
                                <h5 class="cart-title">2 Items in my cart</h5>
                                <div class="cart-block-list">
                                    <ul>
                                        <li class="product-info">
                                            <div class="p-left">
                                                <a href="#" class="remove_link"></a>
                                                <a href="#">
                                                <img class="img-responsive" src="assets/data/product-100x122.jpg" alt="p10">
                                                </a>
                                            </div>
                                            <div class="p-right">
                                                <p class="p-name">Donec Ac Tempus</p>
                                                <p class="p-rice">61,19 €</p>
                                                <p>Qty: 1</p>
                                            </div>
                                        </li>
                                        <li class="product-info">
                                            <div class="p-left">
                                                <a href="#" class="remove_link"></a>
                                                <a href="#">
                                                <img class="img-responsive" src="assets/data/product-s5-100x122.jpg" alt="p10">
                                                </a>
                                            </div>
                                            <div class="p-right">
                                                <p class="p-name">Donec Ac Tempus</p>
                                                <p class="p-rice">61,19 €</p>
                                                <p>Qty: 1</p>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                                <div class="toal-cart">
                                    <span>Total</span>
                                    <span class="toal-price pull-right">122.38 €</span>
                                </div>
                                <div class="cart-buttons">
                                    <a href="order.html" class="btn-check-out">Checkout</a>
                                </div>
                            </div>
                        </div> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END MANIN HEADER -->
    <div class="nav-top-menu">
        <div class="container">
            <div class="row">
                <div class="col-sm-3" id="box-vertical-megamenus">
                    <div class="box-vertical-megamenus">
                    <h4 class="title">
                        <span class="title-menu">Categories</span>
                        <span class="btn-open-mobile pull-right home-page"><i class="fa fa-bars"></i></span>
                    </h4>
                    <div class="vertical-menu-content is-home checkDisplay">
                        <ul class="vertical-menu-list">
                            <?php
                                $sql = "select * from brand";
                                $result = mysqli_query($conn, $sql);

                                while ($row = mysqli_fetch_array($result)) {
                                    echo '<li><a href="index.php?page='.$row['BrandName'].'"><img class="icon-menu" alt="Funky roots" src="assets/data/12.png">'.$row['BrandName'].'</a></li>';
                                }
                            ?>
                            
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-sm-5 col-md-9 formsearch-option4" style="display: block !important;">
                    <form id="formSearch" class="form-inline" style="width: 884px;" method="GET">
                          <div class="form-group input-serach" style="line-height: 30px; padding: 5px 12px; width: 230px;">
                            <input value="<?php isset($_GET['name']) ? $_GET['name'] : ''; ?>" type="text" name="name" placeholder="Type Your Keyword..." style="width: 100%;" id="formInput">
                          </div>
                          <button type="submit" class="pull-right btn-search"><i class="fa fa-search"></i></button>
                    </form>
                </div>
        </div>
    </div>
</div>
<!-- end header -->
    
 <?php
        // var_dump($_GET); exit;
        if (isset($_GET['name'])) {
            echo "<script>
                        document.querySelector('.checkDisplay').classList.add('closeNav');
                        document.querySelector('.title').onclick = function() {
                            document.querySelector('.checkDisplay').classList.toggle('openNav');
                        }

                        // document.querySelector('.title').onmouseout = function() {
                        //     // document.querySelector('.checkDisplay').classList.add('closeNav');
                        //     document.querySelector('.checkDisplay').style.display = 'none';
                        // }

                        // document.querySelector('.title').onmouseover = function() {
                        //     // document.querySelector('.checkDisplay').classList.add('openNav');
                        //     document.querySelector('.checkDisplay').style.display = 'block';
                        // }


                        window.onclick = function() {
                            document.querySelector('.checkDisplay').classList.add('closeNav');
                        }
                    </script>";
            $search = $_GET['name'];
            
            if ($search) {
                $item_per_page = !empty($_GET['per_page']) ? $_GET['per_page'] : 8;
                $curren_page = !empty($_GET['cur_page']) ? $_GET['cur_page'] : 1;
                $offset = ($curren_page - 1) * $item_per_page;
                $sqlSearch = "SELECT * FROM products WHERE ProductName LIKE '%".$search."%' ORDER BY ProductID ASC LIMIT $item_per_page OFFSET $offset";
                // echo $sqlSearch; exit;
                $resultSearch = mysqli_query($conn, $sqlSearch);

                $totalRecord = mysqli_query($conn, "SELECT * FROM products");
                $totalRecord = $totalRecord->num_rows;

                $totalPage = ceil($totalRecord / $item_per_page);

                $data = [];
                while ($row = mysqli_fetch_array($resultSearch)) {
                    $data[] = $row;
                }

                // var_dump($data); exit;
                ?>
               
               
                <div class="columns-container">
                    <div class="container" id="columns">
                    <div class="row">
                        <div class="center_column col-xs-12 col-sm-12" id="center_column">
                            <!-- view-product-list-->
                            <div id="view-product-list" class="view-product-list">
                                <h2 class="page-heading">
                                    <span class="page-heading-title">Từ khoá "<?php echo $search; ?>"</span>
                                </h2>
                                <!-- PRODUCT LIST -->
                                <ul class="row product-list grid">
                                <?php foreach ($data as $val) { ?>
                                    <li class="col-sx-12 col-sm-3">
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
                                                    <?php echo number_format($val['Total'], 0, '', ',').'đ'; ?>
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

                            <?php include './panigation.php' ?>
                        </div>
                    </div>
                    </div>
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
                    
            <?php }
        } else {
            if (isset($_GET['page'])) {
                echo "<script>
                        document.querySelector('.checkDisplay').classList.add('closeNav');
                        document.querySelector('.title').onclick = function() {
                            document.querySelector('.checkDisplay').classList.toggle('openNav');
                        }

                        // document.querySelector('.title').onmouseout = function() {
                        //     // document.querySelector('.checkDisplay').classList.add('closeNav');
                        //     document.querySelector('.checkDisplay').style.display = 'none';
                        // }

                        // document.querySelector('.title').onmouseover = function() {
                        //     // document.querySelector('.checkDisplay').classList.add('openNav');
                        //     document.querySelector('.checkDisplay').style.display = 'block';
                        // }


                        window.onclick = function() {
                            document.querySelector('.checkDisplay').classList.add('closeNav');
                        }
                    </script>";
                switch ($_GET['page']) {
                    case 'NewProducts': 
                        include_once './NewProducts/NewProducts.php';
                        break;
                    case 'PromoProducts': 
                        include_once './PromoProducts/PromoProducts.php';
                        break;
                    case 'SellingProducts': 
                        include_once './SellingProducts/SellingProducts.php';
                        break;
                    case 'Contact': 
                        include_once './Contact/Contact.php';
                        break;
                    case 'News': 
                        include_once './News/News.php';
                        break;
                    case 'ProductDetail': 
                        include_once './ProductDetail/ProductDetail.php';
                        break;
                    case 'Login': 
                        include_once './Login_Out/Login.php';
                        break;
                    case 'Logout': 
                        include_once './Login_Out/Logout.php';
                        break;
                    case 'Register': 
                        include_once './Login_Out/Register.php';
                        break;
                    case 'CartProcess': 
                        include_once './Cart/cart_process.php';
                        break;
                    case 'Cart': 
                        include_once './Cart/cart.php';
                        break;
                    case 'Dell': 
                        include_once './Brand/Dell.php';
                        break;
                    case 'Apple': 
                        include_once './Brand/Apple.php';
                        break;
                    case 'Asus': 
                        include_once './Brand/Asus.php';
                        break;
                    case 'Lenovo': 
                        include_once './Brand/Lenovo.php';
                        break;
                    case 'MSI': 
                        include_once './Brand/MSI.php';
                        break;
                    case 'Search': 
                        include_once './Search.php';
                        break;
                    case 'News': 
                        include_once './News/News.php';
                        break;
                    case 'NewsDetail': 
                        include_once './News/NewsDetail.php';
                        break;
                }
            } else {
                
                include_once './Home/Home.php';
            }
        }
 ?>

<!-- Footer -->
<footer id="footer2">
    
     <!-- footer paralax-->
     <div class="footer-paralax">
         <div class="footer-row">
             <div class="container">
                 <div class="row">
                     <div class="col-sm-3">
                         <div class="widget-container">
                             <h3 class="widget-title">Thông tin</h3>
                             <div class="widget-body">
                                 <ul>
                                     <li><span style="display: inline-flex; justify-content: center; align-items: center; width: 30px; margin-top: 8px;"><i class="fas fa-map-marker-alt"></i></span><?php echo $rowCon['Address'] ?></li>
                                     <li><span style="display: inline-flex; justify-content: center; align-items: center; width: 30px; margin-top: 8px;"><i class="fas fa-phone"></span></i><?php echo $rowCon['Phone_1'] ?></li>
                                     <li><span style="display: inline-flex; justify-content: center; align-items: center; width: 30px; margin-top: 8px;"><i class="fas fa-envelope"></span></i><?php echo $rowCon['Email'] ?></li>
                                     <li><span style="display: inline-flex; justify-content: center; align-items: center; width: 30px; margin-top: 8px;"><i class="fas fa-mobile-alt"></span></i><?php echo $rowCon['Phone_2'] ?></li>
                                     <li><span style="display: inline-flex; justify-content: center; align-items: center; width: 30px; margin-top: 8px;"><i class="fas fa-fax"></span></i><?php echo $rowCon['FaxNumber'] ?></li>
                                 </ul>
                             </div>
                         </div>
                     </div>
                     <div class="col-sm-3">
                         <div class="widget-container">
                             <h3 class="widget-title">COMPANY</h3>
                             <div class="widget-body">
                                 <ul>
                                     <li><a href="#">About Us</a></li>
                                     <li><a href="#">Testimonials</a></li>
                                     <li><a href="#">Affiliate Program</a></li>
                                     <li><a href="#">Terms & Conditions</a></li>
                                     <li><a href="#">Contact Us</a></li>
                                 </ul>
                             </div>
                         </div>
                     </div>
                     <div class="col-sm-3">
                         <div class="widget-container">
                             <h3 class="widget-title">my account</h3>
                             <div class="widget-body">
                                 <ul>
                                     <li><a href="#">My Orders</a></li>
                                     <li><a href="#">My Credit Slips</a></li>
                                     <li><a href="#">My Addresses</a></li>
                                     <li><a href="#">My Personal Info</a></li>
                                     <li><a href="#">Specials</a></li>
                                 </ul>
                             </div>
                         </div>
                     </div>
                     <div class="col-sm-3">
                         <div class="widget-container">
                             <h3 class="widget-title">SUPPORT</h3>
                             <div class="widget-body">
                                 <ul>
                                     <li><a href="#">Payments & My Vouchers</a></li>
                                     <li><a href="#">Saved Cards</a></li>
                                     <li><a href="#">Shipping Free</a></li>
                                     <li><a href="#">Cancellation & Returns</a></li>
                                     <li><a href="#">FAQ & Support Online</a></li>
                                 </ul>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
         <div class="footer-bottom">
             <div class="container">
                 <div class="footer-bottom-wapper">
                     <div class="row">
                         <div class="col-sm-8">
                             <div class="footer-coppyright">
                                 Copyright © 2015 KuteShop. All Rights Reserved. Designed by: KuteThemes
                             </div>

                         </div>
                         <div class="col-sm-4">
                             <div class="footer-payment-logo">
                                 <img src="assets/data/option4/payment-logo.png" alt="payment logo">
                             </div>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
     </div>
     <!-- ./footer paralax-->
</footer>

<a href="#" class="scroll_top" title="Scroll to Top" style="display: inline;">Scroll</a>
<!-- Script-->

<!-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script> -->


<script type="text/javascript" src="assets/lib/jquery/jquery-1.11.2.min.js"></script>
<script type="text/javascript" src="assets/lib/bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="assets/lib/select2/js/select2.min.js"></script>
<script type="text/javascript" src="assets/lib/jquery.bxslider/jquery.bxslider.min.js"></script>
<script type="text/javascript" src="assets/lib/owl.carousel/owl.carousel.min.js"></script>
<!-- COUNTDOWN -->
<script type="text/javascript" src="assets/lib/countdown/jquery.plugin.js"></script>
<script type="text/javascript" src="assets/lib/countdown/jquery.countdown.js"></script>
<!-- ./COUNTDOWN -->
<script type="text/javascript" src="assets/js/jquery.actual.min.js"></script>
<script type="text/javascript" src="assets/js/theme-script.js"></script>
<script type="text/javascript" src="assets/js/option4.js"></script>

<script>
    function deleteCart(productID) {
        $.ajax({
            type: "POST",
            // dataType: "JSON",
            url: "./Cart/cart_process.php?action=delete",
            data: {
                "id": productID
            },
            success: function(response) {
                response = JSON.parse(response);
                if (response.status == 0) {
                    alert(response.message);
                } else {
                    // $.get('./Cart/cart.php', function(cartContentHTML) {
                    //     // $('#cartForm').html();
                    //     console.log(cartContentHTML);
                    // });
                    var el = document.getElementById(productID);
                    el.remove();
                    alert(response.message);
                }
            }
        });
    }

    function updateQuantity(quantityValue) {
       if (quantityValue != '') {
            $.ajax({
                type: "POST",
                // dataType: "JSON",
                url: "./Cart/cart_process.php?action=update",
                data: $('.order-detail-content').serializeArray(),
                success: function(response) {
                    response = JSON.parse(response);
                    if (response.status == 0) {
                        alert(response.message);
                    } else {
                        // $.get('./Cart/cart_content.php', function(cartContentHTML) {
                        //     // $('#cartForm').html(cartContentHTML);
                        //     console.log(cartContentHTML);
                        //     // $("#content_cart").load('./Cart/cart.php'); 
                        // });
                        // var el = document.getElementById(productID);
                        // el.remove();
                        alert(response.message);
                        location.reload();
                    }
                }
            });
       }
    }

    $("#formSearch").click(function() {
        $("#formInput").focus();
    });

</script>
</body>

<!-- Mirrored from kutethemes.com/demo/kuteshop/html/index4.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 21 Jul 2015 07:25:14 GMT -->
</html>