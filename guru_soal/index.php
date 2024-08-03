<?php 
require_once '../database/config.php';
$hal = 'soal';
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
                <div class="card-header" style="background-color:#86090f">
               <font color="ffffff">
                <h3 class="card-title"><i class="nav-icon fas fa-folder"></i> Bank Soal</h3>
                </div>
                </font>
                <!-- /.card-header -->
                <div class="card-body">
                <a href="add.php" class="btn btn-danger" style="background-color:#86090f">
                <i class="nav-icon fas fa-plus"></i>  Tambah Data
                </a>
                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-importdata">
                  <i class="nav-icon fas fa-file-excel"></i> Import Data
                </button>
                 <a href="reset.php" class="btn btn-danger" onclick="return confirm('Anda akan menghapus seluruh data Guru ?')">
                  <i class="nav-icon fas fa-times"></i> Reset Data
                </a>
                  <table id="example1" class="table table-bordered table-striped table-sm">
                    <thead>
                    <tr>
                    <th>No</th>
                    <th>Soal </th>
                    <th>kelas - Mapel </th>
                    <th><center>Aksi</center></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                      $no = 1;
                      $query = "SELECT * FROM tbl_soal";
                      $sql_soal = mysqli_query($con, $query) or die (mysqli_error($con));
                          if (mysqli_num_rows($sql_soal) > 0)
                          {
                            while($data = mysqli_fetch_array($sql_soal))
                            {
                              $id_mapel = $data['id_mapel']; 
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
                                    $query_mapel = "SELECT nama FROM tbl_mapel WHERE id = '$id_mapel'";
                                    $sql_mapel = mysqli_query($con, $query_mapel) or die (mysqli_error($con));
                                    $data_mapel = mysqli_fetch_assoc($sql_mapel);
                                    $mapel = $data_mapel['nama'];
                                    echo $data['kelas'].' - '.$mapel;
                                    ?>
                                   </h6>
                                 </td>
                                 
                                <td>
                                  <center>
                               
                                <button class="btn btn-primary btn-sm"  data-toggle="modal" data-target="#modal-editdata" data-nip="<?=$data['nip'];?>" data-nama="<?=$data['nama'];?>">
                                  <i class="fas fa-edit"></i>
                                   Edit 
                                </button>    
                                <a href="delete.php?nip=<?=$data['nip'];?>" class="btn btn-danger btn-sm" onclick="return confirm('Anda akan menghapus Data Guru [ <?=$data['nip'] .' - '. $data['nama']; ?> ] ?')">
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
                          echo "<tr><td colspan=\"8\" align=\"center\"><h6>Data Tidak Ditemukan!</h6></td></tr>";
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
            <div class="modal-header" style="background-color:#86090f">
              <h5 class="modal-title">
              <font color="ffffff">
              <i class="nav-icon fas fa-file-excel"></i> 
                Import Data Soal
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
             <h6>Template Excel</h6>
              <a href="download.php?filename=templateguru.xls" class="btn btn-success btn-sm">
                  <i class="nav-icon fas fa-file-excel"></i> Download
                </a>
            </div>
            <div class="modal-footer pull-right">
              <button type="submit" class="btn btn-danger" name="impor" style="background-color:#86090f"><i class="nav-icon fas fa-file-excel"></i>Import Data</button>
              </form>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
</div>
<!-- ./wrapper -->

<?php 
include "../script.php";
?>
</body>
</html>
