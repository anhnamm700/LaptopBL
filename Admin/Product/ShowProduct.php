<?php
    @include("../connect.php");
    // $sqlSelect = "select * from products";
    include './Item.php';

    $sqlSelect = "SELECT brand.BrandName, productcolor.ColorName,products.* FROM products INNER JOIN brand on products.BrandID = brand.BrandID INNER JOIN productcolor ON products.ColorID = productcolor.ColorID GROUP BY products.ProductID ORDER BY products.ProductID DESC LIMIT $item_per_page OFFSET $offset";
    $result = mysqli_query($conn, $sqlSelect);
?>

<section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Danh Sách Sản Phẩm</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php?page=AddProduct">Thêm sản phẩm</a></li>
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
                    <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1">Mã sản phẩm</th>
                    <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1">Tên sản phẩm</th>
                    <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1">Ảnh</th>
                    <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1">Màu sắc</th>
                    <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1">Giá</th>
                    <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1">Số lượng</th>
                    <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1">Năm sản xuất</th>
                    <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1">Thương hiệu</th>
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
                  <td><?php echo $key["ProductID"]; ?></td>
                  <td><?php echo $key["ProductName"]; ?></td>
                  <td><img style="width: 50px; height: 50px;" src="<?php echo $key["Image"]; ?>" alt="<?php echo $key["ProductName"]; ?>"/></td>
                  <td><?php echo $key["ColorName"]; ?></td>
                  <td><?php echo $key["Total"]; ?></td>
                  <td><?php echo $key["Quantity"]; ?></td>
                  <td><?php echo $key["YearOfProduction"]; ?></td>
                  <td><?php echo $key["BrandName"]; ?></td>
                  <td><a class="btn btn-block btn-primary btn-sm" href='index.php?page=ProductRepair&ProductID=<?php echo $key['ProductID']; ?>'>Xem chi tiết</a><a style="cursor: pointer; color: #fff;" class="btn btn-block btn-danger btn-sm" onclick="delBtn('<?php echo $key['ProductID']; ?>');">Xoá</a></td>
                </tr>

                    <?php } ?>
            </tbody>

            <tfoot>
            <?php
                $totalRecord = mysqli_query($conn, "SELECT * FROM products");
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
                  url: './Product/ProductDel.php',
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