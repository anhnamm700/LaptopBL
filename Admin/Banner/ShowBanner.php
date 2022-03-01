<?php
    @include("../connect.php");

    include './Item.php';

    $sqlSelect = "select * from banner ORDER BY BannerID DESC LIMIT $item_per_page OFFSET $offset";
    $result = mysqli_query($conn, $sqlSelect);
?>

<section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Danh Sách Banner</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php?page=AddBanner">Thêm Banner</a></li>
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
                    <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1">Mã banner</th>
                    <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1">Ảnh</th>
                    <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1">Trạng thái kích hoạt</th>
                    <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1">Thứ tự hiển thị</th>
                    <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1">Đường dẫn</th>
                    <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1">Tuỳ chọn</th>
                </tr>
                </thead>
                <tbody>
               <?php
               $i = 1;
                while ($row = mysqli_fetch_assoc($result)) {
                    echo '<tr role="row" class="odd">';
                    echo '<td>'.$i++.'</td>';
                    echo '<td>'.$row["BannerID"].'</td>';
                    echo '<td> <img style="width: 50px; height: 50px;" src="'.$row["Image"].'" alt="abc"/></td>';
                    echo '<td>'.(($row["Is_active"] == 0) ? 'Không kích hoạt' : 'Kích hoạt').'</td>';
                    echo '<td>'.$row["OrderSort"].'</td>';
                    echo '<td>'.$row["Url"].'</td>';
                    echo "<td><a href='index.php?page=BannerRepair&BannerID=".$row['BannerID']."'>Sửa</a> | <a href='index.php?page=BannerDel&BannerID=".$row['BannerID']."'>Xoá</a></td>";
                    echo '</tr>';
                }
               ?>
            </tbody>
            <tfoot>
            <?php
                $totalRecord = mysqli_query($conn, "SELECT * FROM banner");
                $totalRecord = $totalRecord->num_rows;

                $totalPage = ceil($totalRecord / $item_per_page);
            ?>
              <?php include './panigation.php' ?>
            </tfoot>
        </table>

    </div>