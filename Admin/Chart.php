<?php
  include_once '../connect.php';

  $sql = "select OrderDate from orderz";
  $result = mysqli_query($conn, $sql);


  
?>

<div class="row">
  <div class="col-lg-3 col-6">
    <!-- small box -->
    <div class="small-box bg-info">
      <div class="inner">
        <?php 
          $getOrder = mysqli_query($conn, "SELECT COUNT(*) AS NumberOrder FROM orderz ORDER BY OrderID");
          $row = mysqli_fetch_assoc($getOrder);
        ?>
        <h3><?php echo $row['NumberOrder']; ?></h3>

        <p>New Orders</p>
      </div>
      <div class="icon">
        <i class="ion ion-bag"></i>
      </div>
      <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
    </div>
  </div>
  <!-- ./col -->
  <div class="col-lg-3 col-6">
    <!-- small box -->
    <div class="small-box bg-success">
      <div class="inner">
        <?php 
          $getProduct = mysqli_query($conn, "SELECT COUNT(*) AS NumberProduct FROM products ORDER BY ProductID");
          $row = mysqli_fetch_assoc($getProduct);
        ?>
        <h3><?php echo $row['NumberProduct']; ?></h3>

        <p>Bounce Rate</p>
      </div>
      <div class="icon">
        <i class="ion ion-stats-bars"></i>
      </div>
      <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
    </div>
  </div>
  <!-- ./col -->
  <div class="col-lg-3 col-6">
    <!-- small box -->
    <div class="small-box bg-warning">
      <div class="inner">
        <?php 
          $getUser = mysqli_query($conn, "SELECT COUNT(*) AS NumberUser FROM account WHERE AuthoritiesID =  2 ORDER BY AccountID ");
          $row = mysqli_fetch_assoc($getUser);
        ?>
        <h3><?php echo $row['NumberUser']; ?></h3>

        <p>User Registrations</p>
      </div>
      <div class="icon">
        <i class="ion ion-person-add"></i>
      </div>
      <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
    </div>
  </div>
  <!-- ./col -->
  <div class="col-lg-3 col-6">
    <!-- small box -->
    <div class="small-box bg-danger">
      <div class="inner">
        <?php 
          $getUser = mysqli_query($conn, "SELECT COUNT(*) AS NumberUser FROM account WHERE AuthoritiesID =  2 ORDER BY AccountID ");
          $row = mysqli_fetch_assoc($getUser);
        ?>
        <h3><?php echo $row['NumberUser']; ?></h3>

        <p>Unique Visitors</p>
      </div>
      <div class="icon">
        <i class="ion ion-pie-graph"></i>
      </div>
      <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
    </div>
  </div>
  <!-- ./col -->
</div>

<div class="row">
  <div class="col-12 col-sm-8 col-lg-8">
    <div class="card card-primary card-tabs">
      <div class="card-header p-0 pt-1">
        <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
          <li class="nav-item">
            <a class="nav-link active" id="custom-tabs-one-home-tab" data-toggle="pill" href="#custom-tabs-one-home" role="tab" aria-controls="custom-tabs-one-home" aria-selected="true">Số đơn hàng tháng</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="custom-tabs-one-profile-tab" data-toggle="pill" href="#custom-tabs-one-profile" role="tab" aria-controls="custom-tabs-one-profile" aria-selected="false">Số đơn hàng năm</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="custom-tabs-one-messages-tab" data-toggle="pill" href="#custom-tabs-one-messages" role="tab" aria-controls="custom-tabs-one-messages" aria-selected="false">Thống kê sản phẩm</a>
          </li>
        </ul>
      </div>
      <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>  
      <div class="card-body">
        <div class="tab-content" id="custom-tabs-one-tabContent">
          <div class="tab-pane fade active show" id="custom-tabs-one-home" role="tabpanel" aria-labelledby="custom-tabs-one-home-tab">
            <?php
              $sqlMonth = "SELECT MONTH(OrderDate) AS 'Thang', COUNT(MONTH(OrderDate)) AS 'SoDon' from orderz INNER JOIN account on orderz.AccountID = account.AccountID GROUP BY MONTH(OrderDate)";
              $result2 = mysqli_query($conn, $sqlMonth);
            
              $data = [];
              while ($row = mysqli_fetch_array($result2)) {
                $data[] = $row;
              }
            ?>
            
            <div id="piechart"></div>  
            
            <script type="text/javascript">
            // Load google charts
            google.charts.load('current', {'packages':['corechart']});
            google.charts.setOnLoadCallback(drawChart);

            // Draw the chart and set the chart values
            function drawChart() {
              var data = google.visualization.arrayToDataTable([
              ['Thang', 'SoDon'],
              <?php
                foreach ($data as $val) {
                  echo "['Tháng ".$val['Thang']."', ".$val['SoDon']."],";
                }
              ?>

            ]);

              // Optional; add a title and set the width and height of the chart
              var options = {'title':'Số đơn hàng tháng', 'width':550, 'height':400};

              // Display the chart inside the <div> element with id="piechart"
              var chart = new google.visualization.PieChart(document.getElementById('piechart'));
              chart.draw(data, options);
            }
            </script>
          </div>
          <div class="tab-pane fade" id="custom-tabs-one-profile" role="tabpanel" aria-labelledby="custom-tabs-one-profile-tab">
          <?php
              $sqlMonth = "SELECT YEAR(OrderDate) AS 'Nam', COUNT(YEAR(OrderDate)) AS 'SoDon' from orderz INNER JOIN account on orderz.AccountID = account.AccountID GROUP BY YEAR(OrderDate)";
              $result2 = mysqli_query($conn, $sqlMonth);
            
              $data = [];
              while ($row = mysqli_fetch_array($result2)) {
                $data[] = $row;
              }
            ?>
            
            <div id="piechart2"></div>  
            
            <script type="text/javascript">
            // Load google charts
            google.charts.load('current', {'packages':['corechart']});
            google.charts.setOnLoadCallback(drawChart);

            // Draw the chart and set the chart values
            function drawChart() {
              var data = google.visualization.arrayToDataTable([
              ['Nam', 'SoDon'],
              <?php
                foreach ($data as $val) {
                  echo "['Năm ".$val['Nam']."', ".$val['SoDon']."],";
                }
              ?>

            ]);

              // Optional; add a title and set the width and height of the chart
              var options = {'title':'Số đơn hàng năm', 'width':550, 'height':400};

              // Display the chart inside the <div> element with id="piechart2"
              var chart = new google.visualization.PieChart(document.getElementById('piechart2'));
              chart.draw(data, options);
            }
            </script>
          </div>
          <div class="tab-pane fade" id="custom-tabs-one-messages" role="tabpanel" aria-labelledby="custom-tabs-one-messages-tab">
          <?php
              $sqlProduct = "SELECT brand.BrandName, COUNT(products.BrandID) AS 'number_brand' FROM products INNER JOIN brand on products.BrandID = brand.BrandID GROUP BY products.BrandID";
              $result3 = mysqli_query($conn, $sqlProduct);
            
              $data = [];
              while ($row = mysqli_fetch_array($result3)) {
                $data[] = $row;
              }
            ?>
            
            <div id="piechart3"></div> 
            
            <script type="text/javascript">
            // Load google charts
            google.charts.load('current', {'packages':['corechart']});
            google.charts.setOnLoadCallback(drawChart);

            // Draw the chart and set the chart values
            function drawChart() {
              var data = google.visualization.arrayToDataTable([
              ['BrandName', 'Số lượng'],
              <?php
                foreach ($data as $val) {
                  echo "['".$val['BrandName']."', ".$val['number_brand']."],";
                }
              ?>

            ]);

              // Optional; add a title and set the width and height of the chart
              var options = {'title':'Thống kê sản phẩm', 'width':550, 'height':400};

              // Display the chart inside the <div> element with id="piechart3"
              var chart = new google.visualization.BarChart(document.getElementById('piechart3'));
              chart.draw(data, options);
            }
            </script>
          </div>
        </div>
      </div>
      <!-- /.card -->
    </div>
  </div>

  
</div>





