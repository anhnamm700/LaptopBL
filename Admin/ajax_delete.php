<?php
    include '../connect.php';
    include './Item.php';

    $output = '';

    $sql = mysqli_query($conn, "select * from productcolor ORDER BY ColorID DESC LIMIT $item_per_page OFFSET $offset");
?>