<?php
    @include("../connect.php");

    include './Item.php';

    $sqlSelect = "SELECT orderdetail.StatusID, orderstatus.*, orderz.* FROM orderz INNER JOIN orderdetail ON orderz.OrderID = orderdetail.OrderID INNER JOIN orderstatus ON orderdetail.StatusID = orderstatus.StatusID GROUP BY orderz.OrderID ORDER BY orderz.OrderID DESC LIMIT $item_per_page OFFSET $offset";
    $result = mysqli_query($conn, $sqlSelect);
?>

<section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Danh Sách Giỏ Hàng</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

<div class="col-sm-12">
      <table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
                <thead>
                <tr role="row">
                    <th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending">STT</th>
                    <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1">Mã đơn hàng</th>
                    <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1">Mã tài khoản</th>
                    <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1">Ngày mua hàng</th>
                    <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1">Mô tả</th>
                    <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1">Trạng thái</th>
                    <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1">Tuỳ chọn</th>
                </tr>
                </thead>
                <tbody>
               <?php
               $i = 1;
                while ($row = mysqli_fetch_assoc($result)) {
                    echo '<tr role="row" class="odd">';
                    echo '<td>'.$i++.'</td>';
                    echo '<td>'.$row["OrderID"].'</td>';
                    echo '<td>'.$row["AccountID"].'</td>';
                    echo '<td>'.$row["OrderDate"].'</td>';
                    echo '<td>'.$row["Desription"].'</td>';
                    echo '<td>'.$row["StatusName"].'</td>';
                    echo "<td><a href='index.php?page=OrderDetail&OrderID=".$row['OrderID']."'>Xem chi tiết</a></td>";
                    echo '</tr>';
                }
               ?>
            </tbody>
            <tfoot>
            <?php
                $totalRecord = mysqli_query($conn, "SELECT * FROM orderz");
                $totalRecord = $totalRecord->num_rows;

                $totalPage = ceil($totalRecord / $item_per_page);
            ?>
              <?php include './panigation.php' ?>
            </tfoot>
        </table>

    </div>