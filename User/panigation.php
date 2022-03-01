
<div class="bottom-pagination">
    <nav>
        <ul class="pagination" style="float: right;">
            <?php for ($num = 1; $num <= $totalPage; $num++) { ?>
                    <?php if (isset($_GET['name'])) { ?>
                        <?php if ($num != $curren_page) { ?>
                            <li><a href="?name=<?php echo $search; ?>&per_page=<?php echo $item_per_page; ?>&cur_page=<?php echo $num; ?>" class="link"><?php echo $num; ?></a></li>
                        <?php } else { ?>
                            <li class="active"><a href="" class="link"><?php echo $num; ?></a></li>
                        <?php } ?>
                    <?php } elseif (isset($_GET['page'])) { ?>
                        <?php if ($num != $curren_page) { ?>
                            <li><a href="?page=<?php echo $_GET['page']; ?>&per_page=<?php echo $item_per_page; ?>&cur_page=<?php echo $num; ?>" class="link"><?php echo $num; ?></a></li>
                        <?php } else { ?>
                            <li class="active"><a href="" class="link"><?php echo $num; ?></a></li>
                        <?php } ?>
                    <?php } ?>
            <?php } ?>
        </ul>
    </nav>
</div>