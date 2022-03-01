<?php
    $item_per_page = !empty($_GET['per_page']) ? $_GET['per_page'] : 4;
    $curren_page = !empty($_GET['cur_page']) ? $_GET['cur_page'] : 1;
    $offset = ($curren_page - 1) * $item_per_page;
?>