<?php
    @include("../connect.php");
    $sqlSelect = "SELECT * FROM ssd";
    $result = mysqli_query($conn, $sqlSelect);
?>

<section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Danh Sách Bộ Nhớ SSD</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php?page=AddSsd">Thêm bộ nhớ SSD</a></li>
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
                    <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1">Mã SSD</th>
                    <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1">Tên SSD</th>
                    <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1">Loại</th>
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
                    echo '<td>'.$row["SsdID"].'</td>';
                    echo '<td>'.$row["SsdName"].'</td>';
                    echo '<td>'.$row["Type"].'</td>';
                    echo '<td>'.$row["Storage"].'</td>';
                    echo "<td><a href='index.php?page=SsdRepair&SsdID=".$row['SsdID']."'>Xem chi tiết</a> | <a href='index.php?page=SsdDel&SsdID=".$row['SsdID']."'>Xoá</a></td>";
                    echo '</tr>';
                }
               ?>
            </tbody>
        </table>

    </div>