<?php
require_once '../database/config.php';
$hal = 'ujian';
if (isset($_SESSION['peran'])) {
  if ($_SESSION['peran'] != 'guru') {
    echo "<script>window.location='../auth/logout.php';</script>";
  }

} else {
  echo "<script>window.location='../auth/logout.php';</script>";
}

$id = @$_GET['id'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Guru Panel | Detail Ujian </title>

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
                      <div class="card-header" style="background-color:#365E32">
                        <font color="ffffff">
                          <h3 class="card-title"><i class="nav-icon fas fa-book-open"> </i> Detail Ujian</h3>
                      </div>
                      </font>
                      <!-- /.card-header -->
                      <div class="card-body">
                        <div class="col-md-12">
                          <a href="../guru_ujian/" class="btn btn-primary btn-sm"> <i class="fas fa-arrow-alt-circle-left"></i> <strong> kembali </strong> </a>
                          <a href="eksporpdf.php?id_ujian=<?= $id;?>" target="_blank" class="btn btn-danger btn-sm"> <i class="fas fa-file"></i> <strong> Ekspor PDF </strong> </a>
                        </div>
                        <br>
                      <div class="row">
                      <?php
                      $quey_tes = "SELECT a.id, a.kelas, a.nama_ujian, a.jumlah_soal, a.waktu, a.token, a.tgl_mulai, a.terlambat,b.nip, b.nama AS guru, c.nama AS mapel, d.nama AS jurusan FROM tbl_guru_tes AS a INNER JOIN tbl_guru AS b ON a.id_guru = b.nip INNER JOIN tbl_mapel AS c ON a.id_mapel = c.id INNER JOIN tbl_jurusan AS d ON a.kode_jurusan = d.kode_jurusan WHERE a.id = '$id'";
                      $sql_tes = mysqli_query($con, $quey_tes) or die(mysqli_error($con));
                      $data = mysqli_fetch_array($sql_tes);
                      $row_db = mysqli_num_rows($sql_tes);
                      ?>
                        <div class="col-lg-6">
                          <table class="table table-bordered table-sm">  
                            <tbody>
                             
                            <tr>
                                <td><b>Nama Ujian</b></td>
                                <td><?= $data['nama_ujian'];?></td>
                            </tr>
                            <tr>
                              <td><b>Guru</b></td>
                              <td><?= $data['guru'] . ' - [ '. $data['nip'].' ]' ; ?></td>
                            </tr>
                            <tr>
                              <td><b>Mata Pelajaran</b></td>
                              <td><?= $data['mapel'];?></td>
                            </tr>
                            <tr>
                              <td><b>Kelas</b> </td>
                              <td><?= $data['kelas'];?></td>
                            </tr>
                            </tbody>
                          </table>
                        </div>

                        <div class="col-lg-6">
                          <table class="table table-bordered table-sm">
                            <tbody>
                            <tr>
                              <td width=50%;><b>Jurusan</b></td>
                              <td><?= $data['jurusan'];?></td>
                            </tr>
                            <tr>
                              <td width=50%;><b>Tanggal ujian</b></td>
                              <td><?= date('d F Y  [H:i]', strtotime($data['tgl_mulai'])) .' - '.date('d F Y  [H:i]', strtotime($data['terlambat']))  ;?></td>
                            </tr>
                            <tr>
                              <td width=50%;><b>Waktu Ujian</b></td>
                              <td><?= $data['waktu'] . ' menit.';?></td>
                            </tr>
                            </tbody>
                          </table>
                        </div>
                      </div>
                      <h4 class="title"><b>Siswa Ikut Ujian </b></h4>
                      <div class="row">
                      <?php
                      $query_nilai = "SELECT MAX(nilai) AS nilai_tertinggi, MIN(nilai) AS nilai_terendah FROM tbl_ikut_ujian WHERE id_tes = '$id'";
                      $sql_nilai = mysqli_query($con, $query_nilai) or die(mysqli_error($con));
                      $data_nilai = mysqli_fetch_array($sql_nilai);
                      
                      $quey_ikut_ujian = "SELECT a.id_user, a.jml_benar, a.nilai, b.nama FROM tbl_ikut_ujian AS a INNER JOIN tbl_siswa AS b ON a.id_user = b.nis WHERE  a.id_tes = '$id'";
                      $sql_ikut_ujian = mysqli_query($con, $quey_ikut_ujian) or die(mysqli_error($con));
                      $rows_ikut_ujian = mysqli_num_rows($sql_ikut_ujian);
                      ?>
                        <div class="col-lg-6">
                          <table class="table table-bordered table-sm">  
                            <tbody>
                             
                            <tr>
                                <td><b>Total ikut Ujian</b></td>
                                <td><?= $rows_ikut_ujian;?></td>
                            </tr>
                            <tr>
                              <td><b>jumlah soal</b></td>
                              <td><?= $data['jumlah_soal']; ?></td>
                            </tr>
                            
                            </tbody>
                          </table>
                        </div>

                        <div class="col-lg-6">
                          <table class="table table-bordered table-sm">
                            <tbody>
                            <tr>
                              <td width=50%;><b>Nilai Tertinggi</b></td>
                              <td><?= $data_nilai['nilai_tertinggi']  ;?></td>
                            </tr>
                            <tr>
                              <td width=50%;><b>Nilai Terendah</b></td>
                              <td><?= $data_nilai['nilai_terendah'];?></td>
                            </tr>
                            
                            </tbody>
                          </table>
                        </div>
                      </div>
                        <table id="example1" class="table table-bordered table-striped table-sm">
                          <thead>
                            <tr>
                              <th style="width:5%" ;>No</th>
                              <th style="width:10%" ;>
                                <center>NIM</center>
                              </th>
                              <th>
                                <center>Nama</center>
                              </th>
                              <th >
                                <center>Jumlah benar </center>
                              </th>
                              <th>
                                <center>Nilai</center>
                              </th>
                              <th>
                                <center>Aksi</center>
                              </th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php
                            $no = 1;
                            
                            if ($rows_ikut_ujian > 0) {
                              while ($data_ikut = mysqli_fetch_array($sql_ikut_ujian)) {
                                ?>
                                <tr>
                                  <td>
                                    <?= $no++; ?>
                                  </td>
                                  <td >
                                    <h6>
                                    <center>
                                      <?= $data_ikut['id_user']; ?>
                                    </center>
                                    </h6>
                                  </td>
                                  <td>
                                    <?php
                                    ?>
                                    <h6>
                                      <?= $data_ikut['nama']; ?>
                                    </h6>
                                  </td>
                                  <td>
                                    <center>
                                      <h6>
                                        <?= $data_ikut['jml_benar']; ?>
                                      </h6>
                                    </center>
                                  </td>

                                  <td>
                                    <center>
                                      <h6>
                                        <?php
                                         echo $data_ikut['nilai'] ; ?>
                                      </h6>
                                    </center>
                                  </td>

                                  <td>
                                    <center>
                                      <a href="detail.php?id=<?= $id ?>" class="btn btn-warning btn-sm">
                                        <i class="fas fa-search"></i>
                                        Lihat hasil Ujian
                                      </a>
                                     
                                      <a href="delete_ikut.php?id=<?= $id;?>&nim=<?= $data_ikut['id_user'];?>" class="btn btn-danger btn-sm"
                                        onclick="return confirm('Anda akan menghapus siswa ikut ujian [ <?= $data_ikut['id_user'].' - '.$data_ikut['nama'] ?> ]?')">
                                        <i class="fas fa-trash"></i>
                                        Batalkan Ujian
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

  </div>

  <!-- ./wrapper -->

  <?php
  include "../script.php";
  ?>
</body>

</html>