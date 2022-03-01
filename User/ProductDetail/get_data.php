<?php
    // include_once '../User/PromoProducts/connect.php';
    // @include("../connect.php");
    $conn = mysqli_connect('localhost', 'root', '', 'laptopphp') or die ('Kết nối thất bại');

    if (isset($_POST['request'])) {
        $request = $_POST['request'];
        $id = $_GET['ProductID'];
        $getName = "SLECT ProductName from products WHERE ProductID = '$id'";
        $res = mysqli_query($conn, $getName);

        $row = mysqli_fetch_array($res);
        $name = $row['ProductName'];
        $query = "SELECT productcolor.*, products.ProductName,products.Quantity, products.YearOfProduction, products.ProductID FROM products INNER JOIN productcolor ON products.ColorID = productcolor.ColorID WHERE ProductName LIKE '$name' GROUP BY products.ProductID";
        $result = mysqli_query($conn, $query);
        $count = mysqli_num_rows($result);

        // echo $query; die;
    }
?>

<?php
    $rows = mysqli_fetch_assoc($result);
    if ($count) {
?>
<div class="attributes">
    <div class="attribute-label">Số lượng:</div>
    <div class="attribute-list product-qty">
        <div class="qty">
            <input id="option-product-qty" type="text" value="1" min=1>
        </div>
    </div>
</div>
<div class="info-orther">
    <p>Item Code: <?php echo $rows['ProductID']; ?></p>
    <p>Availability: <span class="in-stock"><?php echo $rows['Quantity']; ?></span></p>
    <p>Condition: <?php echo $rows['YearOfProduction']; ?></p>
</div>
<?php } else { ?> 
    <p>Không tồn tại tuỳ chọn màu này</p>
    <?php } ?>