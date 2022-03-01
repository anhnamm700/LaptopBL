<?php
    @include("../connect.php");
    $sqlSelect = "SELECT * FROM cardvga";
    $result = mysqli_query($conn, $sqlSelect);
?>

<section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Danh Sách VGA</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php?page=AddVga">Thêm VGA</a></li>
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
                    <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1">Mã VGA</th>
                    <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1">Tên VGA</th>
                    <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1">Loại</th>
                    <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1">Tuỳ chọn</th>
                </tr>
                </thead>
                <tbody>
               <?php
               $i = 1;
                while ($row = mysqli_fetch_assoc($result)) {
                    echo '<tr role="row" class="odd">';
                    echo '<td>'.$i++.'</td>';
                    echo '<td>'.$row["CardID"].'</td>';
                    echo '<td>'.$row["NameOfCard"].'</td>';
                    if ($row["TypeOfCard"] == 0) {
                      echo '<td>Card đồ hoạ tích hợp</td>';
                    } elseif ($row["TypeOfCard"] == 1) {
                      echo '<td>Card đồ hoạ rời</td>';
                    }
                    echo "<td><a href='index.php?page=VgaRepair&VgaID=".$row['CardID']."'>Xem chi tiết</a> | <a href='index.php?page=VgaDel&VgaID=".$row['CardID']."'>Xoá</a></td>";
                    echo '</tr>';
                }
               ?>
            </tbody>
        </table>

    </div>