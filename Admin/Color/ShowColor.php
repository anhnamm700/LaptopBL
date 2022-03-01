<?php
    include_once '../connect.php';

    include './Item.php';

    $sql = "select * from productcolor ORDER BY ColorID DESC LIMIT $item_per_page OFFSET $offset";
    $result = mysqli_query($conn, $sql);

    $data = [];

    while ($row = mysqli_fetch_array($result)) {
      $data[] = $row;
    }
?>

<section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Danh Sách Màu</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php?page=AddColor">Thêm màu</a></li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

<div class="col-sm-12 " id="load_data">
      <table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
                <thead>
                <tr role="row">
                    <th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending">STT</th>
                    <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1">Mã màu</th>
                    <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1">Tên màu</th>
                </tr>
                </thead>
                <tbody>
                <?php
                  $i = 1;
                  foreach ($data as $key) {
                ?>
                  <tr role="row" class="odd">
                  <td><?php echo $i++; ?></td>
                  <td><?php echo $key["ColorID"]; ?></td>
                  <td><?php echo $key["ColorName"]; ?></td>
                  <td><a class="btn btn-block btn-primary btn-sm" href='index.php?page=ColorRepair&ColorID=<?php echo $key['ColorID']; ?>'>Sửa</a><a style="cursor: pointer; color: #fff;" class="btn btn-block btn-danger btn-sm" onclick="delBtn('<?php echo $key['ColorID']; ?>');" >Xoá</a></td>
                  </tr>
               <?php } ?>
            </tbody>
            <tfoot>
            <?php
                $totalRecord = mysqli_query($conn, "SELECT * FROM productcolor");
                $totalRecord = $totalRecord->num_rows;

                $totalPage = ceil($totalRecord / $item_per_page);
            ?>
              <?php include './panigation.php' ?>
            </tfoot>
        </table>

    </div>

    <!-- href='index.php?page=ColorDel&ColorID=".$row['ColorID']."' -->
<script>
     function delBtn(id) {
       let confirmDel = confirm("Bạn có muốn xoá trường này");
      //  data = {}
        if (confirmDel) {
          $.ajax({
            type: 'POST',
            url: './Color/ColorDel.php',
            data: {
              "id": id
            },
            success: function(response) {
              response = JSON.parse(response);
              if (response.status == 0) {
                alert(response.message);
              } else {
                alert(response.message);
                location.reload();
              }
            }
          });
        }
     }
</script>