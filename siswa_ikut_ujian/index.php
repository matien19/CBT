<?php
require_once '../database/config.php';
$hal = 'ujian';
if (isset($_SESSION['peran'])) {
  if ($_SESSION['peran'] != 'siswa') {
    echo "<script>window.location='../auth/logout.php';</script>";
  }

} else {
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
          include '../sidebar_siswa.php';
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
                          <h3 class="card-title"><i class="nav-icon fas fa-book-open"></i> Ujian</h3>
                      </div>
                      </font>
                      <!-- /.card-header -->
                      <div class="card-body">
                      
                        <table id="example1" class="table table-bordered table-striped table-sm">
                          <thead>
                            <tr>
                              <th style="width:5%" ;>No</th>
                              <th style="width:20%" ;>
                                <center>Nama Tes</center>
                              </th>
                              <th>
                                <center>Mata Pelajaran - [guru]</center>
                              </th>
                              
                              <th>
                                <center>Kelas - Jurusan</center>
                              </th>
                              <th>
                                <center>Waktu</center>
                              </th>
                              <th>
                                <center>Aksi</center>
                              </th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php
                            $no = 1;
                            $nis = $_SESSION['user'];
                            $quey_tes = "SELECT * FROM tbl_guru_tes, tbl_siswa WHERE tbl_siswa.nis = '$nis' And tbl_siswa.kode_jurusan = tbl_guru_tes.kode_jurusan AND tbl_siswa.kelas = tbl_guru_tes.kelas;";
                            $sql_tes = mysqli_query($con, $quey_tes) or die(mysqli_error($con));
                            $row_db = mysqli_num_rows($sql_tes);
                            if ($row_db > 0) {
                              while ($data = mysqli_fetch_array($sql_tes)) {
                                $id = $data['id'];
                                $nip = $data['id_guru'];
                                $id_mapel = $data['id_mapel'];
                                $kd_jurusan = $data['kode_jurusan'];

                                ?>
                                <tr>
                                  <td>
                                    <?= $no++; ?>
                                  </td>
                                  <td>
                                    <h6>
                                      <?= $data['nama_ujian'] ?>
                                      
                                    </h6>
                                  </td>
                                  <td>
                                    <?php
                                    $query_mapel_guru = "SELECT tbl_mapel.nama as mapel, tbl_guru.nama as guru FROM tbl_mapel, tbl_guru WHERE tbl_mapel.id = '$id_mapel' AND tbl_guru.nip = '$nip'";
                                    $sql_mapel = mysqli_query($con, $query_mapel_guru) or die(mysqli_error($con));
                                    $data_mapel = mysqli_fetch_array($sql_mapel);
                                    $mapel = $data_mapel['mapel'];
                                    $guru = $data_mapel['guru'];
                                    ?>
                                    <h6>
                                      <?= $mapel . ' - ['.$guru.' ]' ; ?>
                                    </h6>
                                  </td>
                                 <td>
                                    <center>
                                      <h6>
                                        <?php
                                        $query_jurusan = "SELECT nama FROM tbl_jurusan WHERE kode_jurusan = '$kd_jurusan'";
                                        $sql_jurusan = mysqli_query($con, $query_jurusan) or die(mysqli_error($con));
                                        $data_jurusan = mysqli_fetch_array($sql_jurusan);
                                        $jurusan = $data_jurusan['nama'];
                                         echo $data['kelas'] . ' - ' . $jurusan;
                                        ?>
                                         
                                      </h6>
                                    </center>
                                  </td>

                                  <td>

                                    <h6>
                                      <?= date('d F Y  [H:i]', strtotime($data['tgl_mulai'])) . ' <br> ( ' . $data['waktu'] . ' menit )'; ?>
                                    </h6>

                                  </td>

                                  <td>
                                    <center>
                                      <a href="./ujian.php?id=<?= $id; ?>" class="btn btn-primary btn-sm" target="_blank" rel="noopener noreferrer">
                                        <i class="fas fa-edit"></i>
                                        Ikut Ujian
                                      </a>
                                      

                                    </center>
                                  </td>

                                </tr>

                                <?php
                              }

                            } else {
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

         
  </div>

  <!-- ./wrapper -->

  <?php
  include "../script.php";
  ?>

  </body>

</html>