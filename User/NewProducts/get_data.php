<?php
    include "../../connect.php";

    session_start();

    // var_dump($_POST); exit;
    $item_per_page = (int)$_POST['item_per_page'];
    $curren_page = (int)$_POST['curren_page'];

    $offset = ($curren_page - 1) * $item_per_page;

    if (isset($_SESSION['emailAcc'])) {
        $email = $_SESSION['emailAcc'];
    }

    if (isset($_POST['action'])) {
        $query = "SELECT * FROM `products` WHERE YearOfProduction = YEAR(NOW()) ";

        if (isset($_POST['brand'])) {
            $brand_filter = implode("', '", $_POST['brand']);
            $query .= "AND BrandID IN('".$brand_filter."')";
        }

        if (isset($_POST['color'])) {
            $color_filter = implode("', '", $_POST['color']);
            $query .= "AND ColorID IN('".$color_filter."')";
        }

        if (isset($_POST['vga'])) {
            $vga_filter = implode("', '", $_POST['vga']);
            $query .= "AND CardID IN('".$vga_filter."')";
        }

        if (isset($_POST['ssd'])) {
            $ssd_filter = implode("', '", $_POST['ssd']);
            $query .= "AND SsdID IN('".$ssd_filter."')";
        }

        if (isset($_POST['ram'])) {
            $ram_filter = implode("', '", $_POST['ram']);
            $query .= "AND RamID IN('".$ram_filter."')";
        }

        if (isset($_POST['minimum_price']) != null && isset($_POST['medium_price']) == null && isset($_POST['max_price']) == null) {
            $query .= "AND Total BETWEEN 5000000 and 20000000"; 
        } 

        if (isset($_POST['minimum_price']) == null && isset($_POST['medium_price']) != null && isset($_POST['max_price']) == null) {
            $query .= "AND Total BETWEEN 21000000 and 40000000";
        }
        
        if (isset($_POST['minimum_price']) != null && isset($_POST['medium_price']) != null && isset($_POST['max_price']) == null) {
            $query .= "AND Total BETWEEN 5000000 and 40000000";
        } 

        if (isset($_POST['minimum_price']) == null && isset($_POST['medium_price']) != null && isset($_POST['max_price']) != null) {
            $query .= "AND Total > 21000000";
        }

        if (isset($_POST['minimum_price']) == null && isset($_POST['medium_price']) == null && isset($_POST['max_price']) != null) {
            $query .= "AND Total > 41000000";
        }

        
        if (isset($_POST['minimum_price']) != null && isset($_POST['medium_price']) != null && isset($_POST['max_price']) != null) {
            $query .= "AND Total BETWEEN 5000000 and 100000000";
        }

        $query .= " ORDER BY products.ProductID ASC LIMIT $item_per_page OFFSET $offset";

        // echo $query; exit;

        

        $statemant = $conn->prepare($query);
        $statemant->execute();
        $resultSet = $statemant->get_result();
        $result = $resultSet->fetch_all();
        $total_row = $resultSet->num_rows;

        $output = '';

        if ($total_row > 0) {
            foreach ($result as $row) {
                $stringLength = strlen($row['1']); 
                $stringCut = substr($row['1'], 50, $stringLength); 
                
                $oldPrice = $row['3'];
                $discount = $row['4'];
                $result = $oldPrice - ($oldPrice * $discount) / 100;

                $string = "alert('B???n c???n ????ng nh???p ????? s??? d???ng ch???c n??ng n??y!')";

                $output .= '
                <li class="col-sx-12 col-sm-4">
                    <div class="product-container">
                        <div class="left-block">
                            <a href="index.php?page=ProductDetail&ProductID='.$row['0'].'">
                                <img class="img-responsive" alt="product" src="../Admin'.$row['2'].'" style="height: 265px;">
                            </a>
                            <form class="add-to-cart">'
                                .(($row['8'] > 0 ) ? ((isset($email)) ? '<input type="hidden" value="1" name="quantity['.$row['0'].']"/><button type="submit" title="Th??m v??o gi??? h??ng" style="display: flex; align-items: center; justify-content: center; width: 100%;"><i class="fas fa-shopping-cart"></i><span style="margin-left: 12px;">Add to Cart</span></button>' : '<button onclick="'.$string.'" style="display: flex; align-items: center; justify-content: center; width: 100%;"><i class="fas fa-shopping-cart"></i><span style="margin-left: 12px;">Add to Cart</span></button>') : '<p title="S???n ph???m ???? h???t h??ng">S???n ph???m ???? h???t h??ng</p>').
                            '</form>
                        </div>
                        <div class="right-block">
                            <h5 class="product-name">
                                <a href="index.php?page=ProductDetail&ProductID='.$row['0'].'" style="display: block; height: 30px; line-height: 20px;">'.str_replace($stringCut, '...', $row['1']).'</a>
                            </h5>
                            <div class="content_price" style="margin-top: 12px;">'
                                .(($row['4'] > 0) ? '<span class="price product-price">'.number_format($result, 0, '', ',').'??'.'</span><span class="price old-price">'.number_format($oldPrice, 0, '', ',').'??'.'</span>' : '<span class="price product-price">'.number_format($result, 0, '', ',').'??'.'</span>').
                            '</div>
                            
                        </div>'
                            .(($row['4'] > 0) ? '<div class="price-percent-reduction2" style="text-align: center; line-height: 36px;">'.$row['4'].'%'.'</div>' : '').
                    '</div>
                </li>';

                
            }
            echo $output;
        } else {
            echo '<p style="margin: 30px;">S???n ph???m kh??ng t???n t???i</p>';
        }
    }
?>

<script>
    $(".add-to-cart").submit(function(event) {
            event.preventDefault();
            
            
            var data = $(this).serializeArray();
            
            $.ajax({
                type: "POST",
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