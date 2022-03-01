<?php
    include '../connect.php';
?>

<div class="columns-container">
    <div class="container" id="columns">
        <!-- breadcrumb -->
        <div class="breadcrumb clearfix">
            <a class="home" href="index.php" title="Return to Home">Home</a>
            <span class="navigation-pipe">&nbsp;</span>
            <span class="navigation_page">Tin tức</span>
        </div>
        <!-- ./breadcrumb -->
        <!-- row -->
        <div class="row">
            <!-- Center colunm-->
            <div class="center_column col-xs-12 col-sm-12" id="center_column">
                <h2 class="page-heading">
                    <span class="page-heading-title2">Tin tức</span>
                </h2>
                <div class="sortPagiBar clearfix">
                    <?php
                        $namePage = $_GET['page'];

                        $item_per_page = !empty($_GET['per_page']) ? $_GET['per_page'] : 4;
                        $curren_page = !empty($_GET['cur_page']) ? $_GET['cur_page'] : 1;
                        $offset = ($curren_page - 1) * $item_per_page;
                        $resultGetNews = mysqli_query($conn, "SELECT * FROM `news` INNER JOIN account ON news.AccountID = account.AccountID ORDER BY NewsID ASC LIMIT $item_per_page OFFSET $offset");
                        
                        // $resultNews = mysqli_query($conn, $sqlGetNews);

                        $totalRecord = mysqli_query($conn, "SELECT * FROM news");
                        $totalRecord = $totalRecord->num_rows;
        
                        $totalPage = ceil($totalRecord / $item_per_page);
                    ?>
                    <?php include './panigation.php' ?>
                </div>
                <ul class="blog-posts">
                    <?php
                        $data = [];

                        while ($row = mysqli_fetch_array($resultGetNews)) {
                            $data[] = $row;
                        }

                        foreach ($data as $key) {
                    ?>
                        <li class="post-item">
                            <article class="entry">
                                <div class="row">
                                    <div class="col-sm-5">
                                        <div class="entry-thumb image-hover2">
                                            <a href="index.php?page=NewsDetail&NewsID=<?php echo $key['NewsID'] ?>">
                                                <img src="../Admin.<?php echo $key['ImageBackground']; ?>" alt="Blog" style="width: 600px; height: 200px; object-fit: cover;">
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-sm-7">
                                        <div class="entry-ci">
                                            <h3 class="entry-title"><a href="index.php?page=NewsDetail&NewsID=<?php echo $key['NewsID'] ?>"><?php echo $key['Title'] ?></a></h3>
                                            <div class="entry-meta-data">
                                                <span class="author">
                                                <i class="fa fa-user"></i> 
                                                by: <a href="#"><?php echo $key['AccountName'] ?></a></span>
                                                <span class="date"><i class="fa fa-calendar"></i> <?php echo $key['Upload_at'] ?></span>
                                            </div>
                                            <div class="entry-excerpt">
                                                <?php echo $key['Description'] ?>
                                            </div>
                                            <div class="entry-more">
                                                <a href="index.php?page=NewsDetail&NewsID=<?php echo $key['NewsID'] ?>">Read more</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </article>
                        </li>
                    <?php } ?>
                </ul>
                <div class="sortPagiBar clearfix">
                    <?php include './panigation.php' ?>
                </div>
            </div>
            <!-- ./ Center colunm -->
        </div>
        <!-- ./row-->
    </div>
</div>