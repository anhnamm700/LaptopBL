<?php
    @include("../connect.php");

    include './Item.php';

    $sqlSelect = "select * from brand ORDER BY BrandID DESC LIMIT $item_per_page OFFSET $offset";
    $result = mysqli_query($conn, $sqlSelect);
?>

<section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Danh Sách Thương Hiệu</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php?page=AddBrand">Thêm thương hiệu</a></li>
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
                    <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1">Mã thương hiệu</th>
                    <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1">Tên thương hiệu</th>
                    <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1">Logo</th>
                    <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1">Tuỳ chọn</th>
                </tr>
                </thead>
                <tbody>
               <?php
               $i = 1;
               $data = [];
                while ($row = mysqli_fetch_array($result)) {
                    $data[] = $row;
                }

                foreach ($data as $key) {
               ?>
                <tr role="row" class="odd">
                  <td><?php echo $i++; ?></td>
                  <td><?php echo $key["BrandID"]; ?></td>
                  <td><?php echo $key["BrandName"]; ?></td>
                  <td> <img style="width: 50px; height: 50px;" src="<?php echo $key["Avatar"]; ?>" alt="abc"/></td>
                  <td><a href='index.php?page=BrandRepair&BrandID=<?php echo $key['BrandID']; ?>' class="btn btn-block btn-primary btn-sm">Sửa</a><a style="cursor: pointer; color: #fff;" class="btn btn-block btn-danger btn-sm" onclick="delBtn('<?php echo $key['BrandID']; ?>');">Xoá</a></td>
                </tr>

                <?php } ?>
            </tbody>
            <tfoot>
            <?php
                $totalRecord = mysqli_query($conn, "SELECT * FROM brand");
                $totalRecord = $totalRecord->num_rows;

                $totalPage = ceil($totalRecord / $item_per_page);
            ?>
              <?php include './panigation.php' ?>
            </tfoot>
        </table>

        <script>
          function delBtn(id) {
            let confirmDel = confirm("Bạn có muốn xoá trường này");
            //  data = {}
              if (confirmDel) {
                $.ajax({
                  type: 'POST',
                  url: './Brand/BrandDel.php',
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
    </div>