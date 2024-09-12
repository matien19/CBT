<?php 
require_once '../database/config.php';
$hal = 'paket_soal';
if (isset($_SESSION['peran']))
{
  if ($_SESSION['peran']!='guru') 
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
  <title>Guru Panel | Soal </title>

<?php 
include "../linksheet.php";
?>
</head>

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
include '../sidebar_guru.php';
?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <br>
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-12">
            <div class="card">
                <div class="card-header" style="background-color:#365E32">
               <font color="ffffff">
                <h3 class="card-title"><i class="nav-icon fas fa-folder"></i> Bank Soal</h3>
                </div>
                </font>
                <!-- /.card-header -->
                <div class="card-body">
                <a href="add.php" class="btn btn-danger" style="background-color:#86090f">
                <i class="nav-icon fas fa-plus"></i>  Tambah Data
                </a>
                 <a href="reset.php" class="btn btn-danger" onclick="return confirm('Anda akan menghapus seluruh data soal ?')">
                  <i class="nav-icon fas fa-times"></i> Reset Data
                </a>
                <button type="button" class="btn btn-success" data-toggle="modal"data-target="#modal-importdata"><i class="nav-icon fas fa-file-excel"></i> Import Data
                </button>
                  <table id="example1" class="table table-bordered table-striped table-sm">
                    <thead>
                    <tr>
                    <th>No</th>
                    <th>Soal </th>
                    <th>kelas - Mapel </th>
                    <th>Kunci Jawaban </th>
                    <th><center>Aksi</center></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                      $no = 1;
                      $query = "SELECT a.*, b.nama FROM tbl_soal AS a INNER JOIN tbl_mapel AS b ON a.id_mapel = b.id";
                      $sql_soal = mysqli_query($con, $query) or die (mysqli_error($con));
                          if (mysqli_num_rows($sql_soal) > 0)
                          {
                            while($data = mysqli_fetch_array($sql_soal))
                            {
                                ?>
                            <tr>
                                 <td>
                                  <?=$no++;?>
                                  </td>

                                  <td>
                                   <h6>
                                   <?=$data['soal'];?>
                                   </h6>  
                                  </td>

                                  <td>
                                   <h6>
                                    <?php 
                                    $mapel = $data['nama'];
                                    echo $data['kelas'].' - '.$mapel;
                                    ?>
                                   </h6>
                                 </td>

                                  <td>
                                   <h6>
                                    <?php 
                                    $kunci = $data['jawaban'];
                                    $jawaban = '';
                                    if ($kunci == 'A') {
                                      $jawaban = $data['opsi_a'];
                                    } elseif ($kunci == 'B') {
                                      $jawaban = $data['opsi_b'];
                                    } elseif ($kunci == 'C') {
                                      $jawaban = $data['opsi_c'];
                                    } elseif ($kunci == 'D') {
                                      $jawaban = $data['opsi_d'];
                                    } elseif ($kunci == 'E') {
                                      $jawaban = $data['opsi_e'];
                                    }
                                    echo '[ '.$kunci.' ] :'.$jawaban;
                                    ?>
                                   </h6>
                                 </td>
                                 
                                <td>
                                  <center>
                               
                                <a href="update.php?id=<?=$data['id'];?>" class="btn btn-primary btn-sm">
                                  <i class="fas fa-edit"></i>
                                   Edit 
                                </a>    
                                <a href="delete.php?id=<?=$data['id'];?>" class="btn btn-danger btn-sm" onclick="return confirm('Anda akan menghapus Data Soal ?')">
                                  <i class="fas fa-trash"></i>
                                   Hapus
                              </a> 
                              </center>
                                </td>
                                   
                              </tr>

                            <?php
                          }

                        }
                        else
                        {
                          echo "<tr><td colspan=\"4\" align=\"center\"><h6>Data Tidak Ditemukan!</h6></td></tr>";
                        }

                          ?>

                  </tbody>
                    <tfoot>

                    </tfoot>
                  </table>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
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

      <!-- modal import data Soal -->
<div class="modal fade" id="modal-importdata">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header" style="background-color:#1A5319">
          <h5 class="modal-title">
            <font color="ffffff">
              <i class="nav-icon fas fa-file-excel"></i>
              Import Data Siswa
            </font>

          </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form class="form-horizontal" action="impor.php" method="POST" id="import" enctype="multipart/form-data">
          <div class="modal-body">
            <div class="form-group">
              <label for="Nama">Ambil file Excel</label>
              <input type="file" id="file" name="file" class="form-control" accept=".xls,.xlsx" required>
            </div>
            <div class="row">
              <div class="col-lg-4">
              <center>

              <h6><b>Template Excel</b></h6>
              <a href="download.php?filename=template_soal.xls" class="btn btn-success btn-sm">
                <i class="nav-icon fas fa-file-excel"></i> Download
              </a>
              </center>
              </div>
              <div class="col-lg-4">
              <center>

              <h6><b>Data Guru</b></h6>
              <a href="export_guru.php" class="btn btn-warning btn-sm">
                <i class="nav-icon fas fa-file-excel"></i> export
              </a>
              </center>
              </div>
              <div class="col-lg-4">
              <center>

              <h6><b>Data Mapel</b></h6>
              <a href="export_mapel.php" class="btn btn-info btn-sm">
                <i class="nav-icon fas fa-file-excel"></i> export
              </a>
              </center>
              </div>
            </div>
           
          </div>
          <div class="modal-footer pull-right">
            <button type="submit" class="btn btn-warning" name="impor" style="background-color:#FCDC2A"><i
                class="nav-icon fas fa-file-excel"></i>Import Data</button>
        </form>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- ./wrapper -->

<?php 
include "../script.php";
?>
</body>
</html>
