<?php
    @include("../connect.php");
    $sqlSelect = "SELECT * FROM hdd";
    $result = mysqli_query($conn, $sqlSelect);
?>

<section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Danh Sách Bộ Nhớ HDD</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php?page=AddHdd">Thêm bộ nhớ HDD</a></li>
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
                    <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1">Mã HDD</th>
                    <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1">Tên HDD</th>
                    <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1">Dung lượng bộ nhớ</th>
                    <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1">Tuỳ chọn</th>
                </tr>
                </thead>
                <tbody>
               <?php
               $i = 1;
                while ($row = mysqli_fetch_assoc($result)) {
                    echo '<tr role="row" class="odd">';
                    echo '<td>'.$i++.'</td>';
                    echo '<td>'.$row["HddID"].'</td>';
                    echo '<td>'.$row["HddName"].'</td>';
                    echo '<td>'.$row["Storage"].'</td>';
                    echo "<td><a href='index.php?page=HddRepair&HddID=".$row['HddID']."'>Xem chi tiết</a> | <a href='index.php?page=HddDel&HddID=".$row['HddID']."'>Xoá</a></td>";
                    echo '</tr>';
                }
               ?>
            </tbody>
        </table>

    </div>