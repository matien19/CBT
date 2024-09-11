<?php
require_once '../database/config.php';
$hal = 'siswa';
if (isset($_SESSION['peran'])) {
  if ($_SESSION['peran'] != 'admin') {
    echo "<script>window.location='../auth/logout.php';</script>";
  }

} else {
  echo "<script>window.location='../auth/logout.php';</script>";
}

// error_reporting(0);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin Panel | Siswa </title>

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
          include '../sidebar_admin.php';
          ?>

          <!-- Content Wrapper. Contains page content -->
          <div class="content-wrapper">
            <br>
            <div class="content">
              <div class="container-fluid">
                <div class="row">
                  <div class="col-lg-12">
                    <div class="card">
                      <div class="card-header" style="background-color:#597445">
                        <font color="ffffff">
                          <h3 class="card-title"> <i class="nav-icon fas fa-users"></i> Data Siswa</h3>
                      </div>
                      </font>
                      <!-- /.card-header -->
                      <div class="card-body">
                        <button type="button" class="btn btn-danger" data-toggle="modal"
                          data-target="#modal-tambahsiswa" style="background-color:#86090f">
                          <i class="nav-icon fas fa-plus"></i> Tambah Data
                        </button>
                        <button type="button" class="btn btn-success" data-toggle="modal"
                          data-target="#modal-importdata">
                          <i class="nav-icon fas fa-file-excel"></i> Import Data
                        </button>
                        <a href="reset.php" class="btn btn-danger"
                          onclick="return confirm('Anda akan menghapus seluruh data Siswa?')">
                          <i class="nav-icon fas fa-times"></i> Reset Data
                        </a>
                        <?php
                        $query_stat = mysqli_query($con, "SELECT stat FROM tbl_siswa WHERE stat = 'T'");

                        if (mysqli_num_rows($query_stat) == 0) { ?>
                          <a href="nonaktifall.php" class="btn btn-warning"
                            onclick="return confirm('Anda akan Me-nonaktifkan seluruh Siswa?')">
                            <i class="nav-icon fas fa-sync"></i> Non-Aktikan Semua
                          </a>
                        <?php } else {
                          ?>
                          <a href="aktifall.php" class="btn btn-primary"
                            onclick="return confirm('Anda akan Mengaktifkan seluruh Siswa?')">
                            <i class="nav-icon fas fa-sync"></i> Aktikan Semua
                          </a>
                        <?php }
                        ?>

                        <table id="example1" class="table table-bordered table-striped table-sm">
                          <thead>
                            <tr>
                              <th>No</th>
                              <th>NIS / Username </th>
                              <th>Nama</th>
                              <th>Kelas - Jurusan</th>
                              <th>Status</th>
                              <th>
                                <center>Aksi</center>
                              </th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php
                            $no = 1;
                            $query_siswa = "SELECT * FROM tbl_siswa";
                            $sql_siswa = mysqli_query($con, $query_siswa) or die(mysqli_error($con));
                            if (mysqli_num_rows($sql_siswa) > 0) {
                              while ($data = mysqli_fetch_array($sql_siswa)) {
                                $stt = $data['stat'];
                                $kd_jurusan = $data['kode_jurusan']
                                  ?>
                                <tr>
                                  <td>
                                    <?= $no++; ?>
                                  </td>

                                  <td>
                                    <h6>
                                      <?= $data['nis']; ?>
                                    </h6>
                                  </td>

                                  <td>
                                    <h6>
                                      <?= $data['nama']; ?>
                                    </h6>
                                  </td>
                                  <td>
                                    <h6>
                                      <?php
                                      $query_jurusan = mysqli_query($con, "SELECT nama FROM tbl_jurusan WHERE kode_jurusan='$kd_jurusan'");
                                      if (mysqli_num_rows($query_jurusan) > 0) {
                                        while ($data_jurusan = mysqli_fetch_assoc($query_jurusan)) {
                                          $nama_jurusan = $data_jurusan['nama'];
                                          echo $data['kelas'] . ' - ' . $nama_jurusan;
                                        }
                                      }
                                      ?>
                                    </h6>
                                  </td>
                                  <td>
                                  <?php
                     
                                  if ($stt=='T')
                                    {
                                     ?>
                                     <center>
                                     <button type="button" class="btn btn-default btn-sm"> 
                                      Tidak Aktif
                                     </button>
                                     </center>
                                     <?php 
                                    }
                                    else
                                    {
                                      ?>
                                    <center>
                                     <button type="button" class="btn btn-success btn-sm"> 
                                      Aktif
                                     </button>
                                     </center>
                                     <?php 
                                    }
                                  ?>
                                 </td>
                                  <td>
                                    <center>
                                      <?php
                                      
                                      if ($stt == 'T') {
                                        ?>
                                        <a href="aktifkan.php?nis=<?= $data['nis']; ?>" class="btn btn-success btn-sm"
                                          onclick="return confirm('Anda akan mengakitfkan siswa [ <?= $data['nis'] . ' - ' . $data['nama']; ?> ]?')">
                                          <i class="fas fa-sync"></i>
                                          Aktifkan
                                        </a>
                                        <?php
                                      } else {
                                        ?>
                                        <a href="nonaktif.php?nis=<?= $data['nis']; ?>" class="btn btn-warning btn-sm"
                                          onclick="return confirm('Anda akan mengakitfkan siswa [ <?= $data['nis'] . ' - ' . $data['nama']; ?> ]?')">
                                          <i class="fas fa-sync"></i>
                                          Non-Aktifkan
                                        </a>
                                        <?php
                                      }
                                      ?>

                                      <button class="btn btn-primary btn-sm" data-toggle="modal"
                                        data-target="#modal-editsiswa" data-nis="<?= $data['nis']; ?>"
                                        data-nama="<?= $data['nama']; ?>" data-kelas="<?= $data['kelas']; ?>"
                                        data-jurusan="<?= $data['kode_jurusan']; ?>" data-stat="<?= $stt ?>">
                                        <i class="fas fa-edit"></i>
                                        Edit
                                      </button>

                                      <a href="delete.php?nis=<?= $data['nis']; ?>" class="btn btn-danger btn-sm"
                                        onclick="return confirm('Anda akan menghapus data Siswa [ <?= $data['nis'] . ' - ' . $data['nama']; ?> ] ?')">
                                        <i class="fas fa-trash"></i>
                                        Hapus
                                      </a>
                                    </center>
                                  </td>

                                </tr>

                                <?php
                              }

                            } else {
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

          <!-- modal tambah data -->
          <div class="modal fade" id="modal-tambahsiswa">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header" style="background-color:#1A5319">
                  <h5 class="modal-title">
                    <font color="ffffff">
                      <i class="nav-icon fas fa-plus"></i>
                      Tambah Data Siswa
                    </font>
                  </h5>

                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <form class="form-horizontal" action="create.php" method="POST">
                  <div class="modal-body">
                    <div class="form-group">
                      <label for="nis">NIS</label>
                      <input type="number" name="nis" class="form-control" placeholder="Masukan NIS" required>
                    </div>
                    <div class="form-group">
                      <label for="Nama">Nama</label>
                      <input type="text" name="nama" class="form-control" placeholder="Masukan Nama" required>
                    </div>

                    <div class="form-group">
                      <label for="tahun akademik">Kelas</label>
                      <select class="form-control" name="kelas" required>
                        <option value="" selected disabled>-- Pilih Kelas --</option>
                        <option>X</option>
                        <option>XI</option>
                        <option>XII</option>
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="matkul">Jurusan</label>

                      <select class="form-control" name="jurusan" required>
                        <option value="" selected disabled>-- Pilih jurusan --</option>
                        <?php
                        $sql_jurusan = mysqli_query($con, "SELECT * FROM tbl_jurusan") or die(mysqli_error($con));
                        while ($data_jurusan = mysqli_fetch_array($sql_jurusan)) {
                          ?>
                          <option value="<?= $data_jurusan['kode_jurusan']; ?>"><b>
                              <?= $data_jurusan['kode_jurusan']; ?></b> - [ <?= $data_jurusan['nama']; ?> ]</option>
                          <?php
                        }
                        ?>
                      </select>
                    </div>
                  </div>
                  <div class="modal-footer pull-right">
                    <button type="submit" class="btn btn-warning" name="tambahdata" style="background-color:#FCDC2A"><i
                        class="nav-icon fas fa-plus"></i>Tambah Data</button>
                </form>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
  </div>
  <!-- modal edit data mhs -->
  <div class="modal fade" id="modal-editsiswa">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header" style="background-color:#1A5319">
          <h5 class="modal-title">
            <font color="ffffff">
              <i class="nav-icon fas fa-edit"></i>
              Edit Data Siswa
            </font>

          </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form class="form-horizontal" action="update.php" method="POST">
          <div class="modal-body">
            <div class="form-group">
              <input type="text" name="stat" class="form-control" hidden>
              <label for="nis">NIS</label>
              <input type="number" name="nis" class="form-control" placeholder="Masukan NIS" disabled>
              <input type="number" name="nis2" class="form-control" placeholder="Masukan NIS" hidden>
            </div>
            <div class="form-group">
              <label for="Nama">Nama</label>
              <input type="text" name="nama" class="form-control" placeholder="Masukan Nama">
            </div>
            <div class="form-group">
              <label for="Kelas">Kelas</label>
              <select class="form-control" name="kelas" required>
                <option>X</option>
                <option>XI</option>
                <option>XII</option>
              </select>
            </div>

            <div class="form-group">
              <label for="matkul">Jurusan</label>
              </select>
              <select class="form-control" name="jurusan">
                <?php
                $sql_jurusan = mysqli_query($con, "SELECT * FROM tbl_jurusan") or die(mysqli_error($con));

                while ($data_jurusan = mysqli_fetch_array($sql_jurusan)) {
                  ?>
                  <option value="<?= $data_jurusan['kode_jurusan']; ?>"><b> <?= $data_jurusan['kode_jurusan']; ?></b> - [
                    <?= $data_jurusan['nama']; ?> ]
                  </option>
                  <?php
                }
                ?>
              </select>
            </div>
          </div>
          <div class="modal-footer pull-right">
            <button type="submit" class="btn btn-warning" name="editdata" style="background-color:#FCDC2A"><i
                class="nav-icon fas fa-edit"></i>Edit Data</button>
        </form>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->

  <!-- modal edit data mhs -->
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
              <a href="download.php?filename=templatesiswa.xls" class="btn btn-success btn-sm">
                <i class="nav-icon fas fa-file-excel"></i> Download
              </a>
              </center>
              </div>
              <div class="col-lg-4">
              <center>

              <h6><b>Data Jurusan</b></h6>
              <a href="export_jurusan.php" class="btn btn-info btn-sm">
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
  <!-- /.modal -->

  </div>
  <!-- ./wrapper -->

  <?php
  include "../script.php";
  ?>

  <script type="text/javascript">
    $('#modal-editsiswa').on('show.bs.modal', function (e) {

      //get data-id attribute of the clicked element
      var nis = $(e.relatedTarget).data('nis');
      var nama = $(e.relatedTarget).data('nama');
      var kelas = $(e.relatedTarget).data('kelas');
      var jurusan = $(e.relatedTarget).data('jurusan');
      var stat = $(e.relatedTarget).data('stat');

      $(e.currentTarget).find('input[name="nis"]').val(nis);
      $(e.currentTarget).find('input[name="nis2"]').val(nis);
      $(e.currentTarget).find('input[name="nama"]').val(nama);
      $(e.currentTarget).find('select[name="kelas"]').val(kelas);
      $(e.currentTarget).find('select[name="jurusan"]').val(jurusan);
      $(e.currentTarget).find('input[name="stat"]').val(stat);

    });
  </script>


</body>

</html>