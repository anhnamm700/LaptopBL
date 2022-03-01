<?php
    $id = $_GET['NewsID'];

    include '../connect.php';

    $getNewsById = mysqli_query($conn, "SELECT * FROM `news` INNER JOIN account ON news.AccountID = account.AccountID WHERE NewsID = '$id'");
    $row = mysqli_fetch_assoc($getNewsById);
?>

<div class="columns-container">
    <div class="container" id="columns">
        <!-- breadcrumb -->
        <div class="breadcrumb clearfix">
            <a class="home" href="index.php" title="Return to Home">Home</a>
            <span class="navigation-pipe">&nbsp;</span>
            <a class="home" href="index.php?page=News" title="Blog">Tin tức</a>
            <span class="navigation-pipe">&nbsp;</span>
            <span> <?php echo $row['Title']; ?></span>
        </div>
        <!-- ./breadcrumb -->
        <!-- row -->
        <div class="row">
            <!-- Left colunm -->
            <div class="column col-xs-12 col-sm-3" id="left_column">
                <!-- Popular Posts -->
                <div class="block left-module">
                    <p class="title_block">Đọc Thêm</p>
                    <div class="block_content">
                        <!-- layered -->
                        <div class="layered">
                            <div class="layered-content">
                                <ul class="blog-list-sidebar clearfix">
                                    <?php
                                        $ramdomNews = mysqli_query($conn, "SELECT * FROM news ORDER BY RAND() LIMIT 4");
                                        $dataRan = [];
                                        
                                        while ($rowran = mysqli_fetch_array($ramdomNews)) {
                                            $dataRan[] = $rowran;
                                        } 

                                        foreach ($dataRan as $key) {
                                    ?>
                                        <li>
                                            <div class="post-thumb">
                                                <a href="index.php?page=NewsDetail&NewsID=<?php echo $key['NewsID']; ?>"><img src="../Admin.<?php echo $key['ImageBackground']; ?>" alt="Blog"></a>
                                            </div>
                                            <div class="post-info">
                                                <h5 class="entry_title"><a href="index.php?page=NewsDetail&NewsID=<?php echo $key['NewsID']; ?>">
                                                    <?php   
                                                        $stringLength = strlen($key['Title']); 
                                                        $stringCut = substr($key['Title'], 36, $stringLength); 
                                                        echo str_replace($stringCut, '...', $key['Title']);
                                                    ?>
                                                </a></h5>
                                                <div class="post-meta">
                                                    <span class="date"><i class="fa fa-calendar"></i> <?php echo $key['Upload_at'] ?></span>
                                                </div>
                                            </div>
                                        </li>
                                    <?php } ?>
                                </ul>
                            </div>
                        </div>
                        <!-- ./layered -->
                    </div>
                </div>
            </div>
            <!-- ./left colunm -->
            <!-- Center colunm-->
            <div class="center_column col-xs-12 col-sm-9" id="center_column">
                <h1 class="page-heading">
                    <span class="page-heading-title2"><?php echo $row['Title']; ?></span>
                </h1>
                <article class="entry-detail">
                    <div class="entry-meta-data">
                        <span class="author">
                        <i class="fa fa-user"></i> 
                        by: <a href="#"><?php echo $row['AccountName']; ?></a></span>
                        <span class="date"><i class="fa fa-calendar"></i> <?php echo $row['Upload_at']; ?></span>
                    </div>
                    <div class="content-text clearfix">
                        <strong><?php echo $row['Description']; ?></strong>
                    </div>
                    <div class="entry-photo">
                        <img src="../Admin.<?php echo $row['ImageBackground']; ?>" alt="Blog" style="width: 870px; height: 614px;">
                    </div>
                    <div class="content-text clearfix">
                        <?php echo $row['Content']; ?>
                    </div>

                    <div style="float: right;">
                        <i>Theo: <?php echo $row['AccountName']; ?></i>
                    </div>
                </article>
            </div>
            <!-- ./ Center colunm -->
        </div>
        <!-- ./row-->
    </div>
</div>