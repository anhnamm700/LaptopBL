
<div class="bottom-pagination">
    <nav>
        <ul class="pagination" style="float: right;">
            <?php for ($num = 1; $num <= $totalPage; $num++) { ?>
                <?php if (isset($_GET['page'])) { ?>
                    <?php if ($num != $curren_page) { ?>
                        <li class="link"><a href="?page=<?php echo $_GET['page']; ?>&per_page=<?php echo $item_per_page; ?>&cur_page=<?php echo $num; ?>" class="link"><?php echo $num; ?></a></li>
                    <?php } else { ?>
                        <li class="active link"><a href=""><?php echo $num; ?></a></li>
                    <?php } ?>
                <?php } ?>
            <?php } ?>
        </ul>
    </nav>
</div>

<style>
    .link {
        padding: 8px 12px;
        background: #333;
        color: #fff;
        margin-right: 2px;
    }
</style>