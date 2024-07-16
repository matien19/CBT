<?php 
require_once '../database/config.php';
$hal = 'ujian';
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
  <title>Guru Panel | Ujian </title>

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
                <h3 class="card-title"><i class="nav-icon fas fa-book-open"></i>  Ujian</h3>
                </div>
                </font>
                <!-- /.card-header -->
                <div class="card-body">
                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal-tambahadmin" style="background-color:#86090f">
                <i class="nav-icon fas fa-plus"></i>  Tambah Tes
                </button>
                  <table id="example1" class="table table-bordered table-striped table-sm">
                    <thead>
                    <tr>
                    <th style="width:5%";>No</th>
                    <th style="width:20%";><center>Nama Tes</center></th>
                    <th ><center>Mata Pelajaran</center></th>
                    <th style="width:15%";><center>Jumlah Soal </center></th>
                    <th ><center>Kelas / Jurusan</center></th>
                    <th ><center>Waktu</center></th>
                    <th><center>Aksi</center></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                      $no = 1;
                      $nip = $_SESSION['user'];
                      $quey_tes = "SELECT * FROM tbl_guru_tes WHERE id_guru = '$nip'";
                      $sql_tes = mysqli_query($con, $quey_tes) or die(mysqli_error($con));
                      $row_db = mysqli_num_rows($sql_tes);
                          if ($row_db > 0)
                          {
                            while($data = mysqli_fetch_array($sql_tes))
                            {
                              $id_mapel = $data['id_mapel'];
                                ?>
                            <tr>
                                 <td>
                                  <?=$no++;?>
                                  </td>
                                  <td>
                                   <h6>
                                   <?=$data['nama_ujian'].'<br> Token : '. $data['token'];?>
                                   <a href="refresh.php?id=<?= $data['id']; ?>" class="btn btn-light-red btn-sm" onclick="return confirm('Anda akan merefresh Token [ <?= $data['nama_ujian']; ?> ]?')" style="color:green;">
                                   <i class="fas fa-sync"></i>
                                   
                              </a> 
                                   </h6>  
                                  </td>
                                  <td>
                                    <?php 
                                    $query_mapel = "SELECT * FROM tbl_mapel WHERE id = '$id_mapel'";
                                    $sql_mapel = mysqli_query($con, $query_mapel) or die(mysqli_error($con));
                                    $data_mapel = mysqli_fetch_array($sql_mapel);
                                    $mapel = $data_mapel['nama'];
                                    ?>
                                   <h6>
                                   <?=$mapel;?>
                                   </h6>                                  
                                 </td>
                                 <td>
                                  <center>
                                   <h6>
                                   <?=$data['jumlah_soal'];?>
                                   </h6>  
                              </center>
                                  </td>
                                  
                                 <td>
                                  <center>
                                   <h6>
                                   <?=$data['kelas'] .' - '. $data['jurusan'] ;?>
                                   </h6>  
                              </center>
                                  </td>

                                 <td>
                                  
                                   <h6>
                                   <?=date('d F Y  [H:i]', strtotime($data['tgl_mulai'])) .' <br> ( '. $data['waktu'] .' menit )';?>
                                   </h6>  
                               
                                  </td>

                                <td>
                                <center>
                                <button class="btn btn-primary btn-sm"  data-toggle="modal" data-target="#modal-editdata" data-id="<?=$id;?>" data-kelas="<?=$data['kelas'];?>">
                                  <i class="fas fa-edit"></i>
                                   Edit 
                                </button> 
                                  <a href="delete.php?id=<?=$id?>" class="btn btn-danger btn-sm" onclick="return confirm('Anda akan menghapus data Ujian [ <?=$data['username'] ?> ]?')">
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
                          echo "<tr><td colspan=\"7\" align=\"center\"><h6>Data Tidak Ditemukan!</h6></td></tr>";
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

<!-- modal tambah data -->
<div class="modal fade" id="modal-tambahadmin">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header" style="background-color:#86090f">
              <h5 class="modal-title">
              <font color="ffffff">
              <i class="nav-icon fas fa-plus"></i> 
                Tambah Data Ujian
              </font>
              </h5>
              
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form class="form-horizontal" action="create.php" method="POST" >
            <div class="modal-body">
            <input type="number" name="nip" value="<?=$nip;?>" class="form-control" hidden>
             
              <div class="form-group">
                <label for="nama">Nama Tes</label>
                <input type="text" name="nama" class="form-control"  placeholder="Masukan Username" required>
              </div>

              <div class="form-group">
                <label for="mapel">Mata Pelajaran</label>
                    <select class="form-control" name="mapel" required>
                    <option value="" selected disabled > -- Pilih Mata Pelajaran --</option>
                    <?php
                    $sql_mapel =  mysqli_query($con, "SELECT * FROM tbl_mapel, tbl_guru_mapel WHERE nip_guru = $nip AND tbl_mapel.id = tbl_guru_mapel.id_mapel") or die (mysqli_error($con));
                    while($data_mapel = mysqli_fetch_array($sql_mapel)){
                      ?>
                      <option value = "<?=$data_mapel['nama'];?>"><?=$data_mapel['nama'];?> </option>
                      <?php
                    }
                    ?>
                    </select>             
               </div>
               <div class="form-group">
                <label for="kelas">Kelas</label>
                        <select class="form-control" name="kelas" required>
                          <option value="" selected disabled>-- Pilih Kelas --</option>
                          <option>X</option>
                          <option>XI</option>
                          <option>XII</option>
                        </select>
              </div>
              <div class="form-group">
                <label for="jurusan">Jurusan</label>
                        <select class="form-control" name="jurusan" required>
                        <option value="" selected disabled>-- Pilih jurusan --</option>
                    <?php
                    $sql_jurusan =  mysqli_query($con, "SELECT * FROM tbl_jurusan") or die (mysqli_error($con));
                    while($data_jurusan = mysqli_fetch_array($sql_jurusan)){
                      ?>
                      <option value = "<?=$data_jurusan['kode_jurusan'];?>"><b> <?=$data_jurusan['kode_jurusan'];?></b> - [ <?=$data_jurusan['nama'];?> ]</option>
                      <?php
                    }
                    ?>
                    </select>
               </div>
               <div class="form-group">
                <label for="soal">Jumlah Soal</label>
                <input type="number" name="soal" class="form-control"  placeholder="Masukan Jumlah Soal" required>
              </div>
            </div>
            <div class="modal-footer pull-right">
              <button type="submit" class="btn btn-danger" name="tambahdata" style="background-color:#86090f"><i class="nav-icon fas fa-plus"></i>Tambah Data</button>
              </form>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
      <!-- modal edit data mhs -->
<div class="modal fade" id="modal-editdata">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header" style="background-color:#86090f">
              <h5 class="modal-title">
              <font color="ffffff">
              <i class="nav-icon fas fa-edit"></i> 
                Edit Data Kelas
              </font>

              </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form class="form-horizontal" action="update.php" method="POST" >
            <div class="modal-body">
            <div class="form-group">
                <input type="text" name="id" class="form-control"  value="<?=$id?>" hidden>
              </div>
            <div class="form-group">
                <label for="kelas">Kelas</label>
                <input type="text" name="kelas" class="form-control">
              </div>
              
            </div>
            <div class="modal-footer pull-right">
              <button type="submit" class="btn btn-danger" name="editdata" style="background-color:#86090f"><i class="nav-icon fas fa-edit"></i>Edit Data</button>
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
