<?php include '../connect.php' ?>
<section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Danh Sách Tài Khoản Customers</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php?page=AddAccount">Thêm tài khoản</a></li>
              <li class="breadcrumb-item"><a href="index.php?page=ModeratorsList">Tài khoản MOD</a></li>
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
                    <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1">Mã tài khoản</th>
                    <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1">Tên tài khoản</th>
                    <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1">Email</th>
                    <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1">Ngày sinh</th>
                    <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1">Địa chỉ</th>
                    <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1">SĐT</th>
                    <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1">Quyền</th>
                    <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1">Hành động</th>
                </tr>
                </thead>
                <tbody>
               <?php
               $i = 1;
                $sqlGetAcc = mysqli_query($conn, "SELECT * FROM account INNER JOIN authorities ON account.AuthoritiesID = authorities.AuthoritiesID WHERE account.AuthoritiesID = 2");
                // $row = mysqli_fetch_assoc($sqlGetAcc);
                $data = [];

                while ($row = mysqli_fetch_array($sqlGetAcc)) {
                    $data[] = $row;
                }

                foreach ($data as $key) {
               ?>
                  <tr role="row" class="odd">
                    <td><?php echo $i++; ?></td>
                    <td><?php echo $key["AccountID"]; ?></td>
                    <td><?php echo $key["AccountName"]; ?></td>
                    <td><?php echo $key["Email"]; ?></td>
                    <td><?php echo $key["Birthday"]; ?></td>
                    <td><?php echo $key["Address"]; ?></td>
                    <td><?php echo $key["Phone"]; ?></td>
                    <td><?php echo $key["AuthoritiesName"]; ?></td>
                  <td><a href='index.php?page=AccountRepair&AccountID=<?php echo $key['AccountID']; ?>' class="btn btn-block btn-primary btn-sm">Sửa</a><a style="cursor: pointer; color: #fff;" class="btn btn-block btn-danger btn-sm" onclick="delBtn('<?php echo $key['AccountID']; ?>');">Xoá</a></td>
                <?php } ?>
            </tbody>
        </table>

        <script>
          function delBtn(id) {
            let confirmDel = confirm("Bạn có muốn xoá trường này");
            //  data = {}
              if (confirmDel) {
                $.ajax({
                  type: 'POST',
                  url: './Account/AccountDel.php',
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