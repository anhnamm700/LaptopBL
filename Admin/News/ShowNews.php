<?php
    @include("../connect.php");

    include './Item.php';

    $sqlSelect = "SELECT * FROM news INNER JOIN account ON news.AccountID = account.AccountID ORDER BY news.NewsID DESC LIMIT $item_per_page OFFSET $offset";
    $result = mysqli_query($conn, $sqlSelect);
?>

<section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Danh Sách Tin Tức</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php?page=AddNews">Thêm Tin Tức</a></li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

<div class="col-sm-12">
      <table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
                <thead>
                <tr role="row">
                    <th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending">STT</th>
                    <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1">Mã tin tức</th>
                    <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1">Tiêu đề</th>
                    <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1">Mô tả</th>
                    <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1">Ảnh hiển thị</th>
                    <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1">Người viết</th>
                    <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1">Tuỳ chọn</th>
                </tr>
                </thead>
                <tbody>
               <?php
               $i = 1;
                while ($row = mysqli_fetch_assoc($result)) {
                    echo '<tr role="row" class="odd">';
                    echo '<td>'.$i++.'</td>';
                    echo '<td>'.$row["NewsID"].'</td>';
                    echo '<td>'.$row["Title"].'</td>';
                    echo '<td>'.$row["Description"].'</td>';
                    echo '<td> <img style="width: 50px; height: 50px;" src="'.$row["ImageBackground"].'" alt="abc"/></td>';
                    echo '<td>'.$row["AccountName"].'</td>';
                    echo "<td><a href='index.php?page=NewsRepair&NewsID=".$row['NewsID']."'>Xem chi tiết</a> | <a href='index.php?page=NewsDel&NewsID=".$row['NewsID']."'>Xoá</a></td>";
                    echo '</tr>';
                }
               ?>
            </tbody>
            <tfoot>
            <?php
                $totalRecord = mysqli_query($conn, "SELECT * FROM news");
                $totalRecord = $totalRecord->num_rows;

                $totalPage = ceil($totalRecord / $item_per_page);
            ?>
              <?php include './panigation.php' ?>
            </tfoot>
        </table>

    </div>