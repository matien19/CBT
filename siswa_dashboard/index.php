<?php 
require_once '../database/config.php';

$hal = 'dasbor';
if (isset($_SESSION['peran']))

{
  if ($_SESSION['peran']!='siswa') 
  {
  echo "<script>window.location='../auth/logout.php';</script>";
  }
}
else
{
  echo "<script>window.location='../auth/logout.php';</script>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Siswa Panel | Dashboard </title>

<?php 
include "../linksheet.php";
?>
</head>
<!--
`body` tag options:

  Apply one or more of the following classes to to the body tag
  to get the desired effect

  * sidebar-collapse
  * sidebar-mini
-->
<body class="hold-transition sidebar-mini">
<div class="wrapper">
<?php
include '../navbar.php';
?>
    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

<?php
include '../sidebar_siswa.php';

$query_ujian = mysqli_query($con, "SELECT * FROM tbl_guru_tes");
$total_ujian = mysqli_num_rows($query_ujian);
?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <br>
  <div class="content">
      <div class="container-fluid">
      <div class="row">
          <div class="col-lg-12">
            <div class="col-lg-4 col-6">
            <!-- small card -->
              <div class="small-box bg-warning">
                <div class="inner">
                  <h3><?= $total_ujian;?></h3>

                  <p>Ujian</p>
                </div>
                <div class="icon">
                  <i class="ion ion-stats-bars"></i>
                </div>
                <a href="../siswa_ujian" class="small-box-footer">
                  More info <i class="fas fa-arrow-circle-right"></i>
                </a>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-12">
            <div class="col-lg-12 col-6">
            <!-- small card -->
              <div class="small-box bg-success">
                <div class="inner">
                  <h5> <i class="fas fa-school"></i> SELAMAT DATANG DI DASHBOARD SISWA APLIKASI TEST CBT BERBASIS WEB</h5>
                  <h5>   SMK MA'ARIF NU 01 PAGUYANGAN </h5> 
                </div>
                
                <a href="#" class="small-box-footer">
                  <hr>
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- /.container-fluid -->
    </div>
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  <?php 
include "../footer.php";
?>
</div>
<!-- ./wrapper -->
<?php 
include "../script.php";
?>
</body>
</html>
