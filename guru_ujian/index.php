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
                      <div class="card-header" style="background-color:#365E32">
                        <font color="ffffff">
                          <h3 class="card-title"><i class="nav-icon fas fa-book-open"></i> Ujian</h3>
                      </div>
                      </font>
                      <!-- /.card-header -->
                      <div class="card-body">
                        <button type="button" class="btn btn-danger" data-toggle="modal"
                          data-target="#modal-tambahadmin" style="background-color:#86090f">
                          <i class="nav-icon fas fa-plus"></i> Tambah Tes
                        </button>
                        <table id="example1" class="table table-bordered table-striped table-sm">
                          <thead>
                            <tr>
                              <th style="width:5%" ;>No</th>
                              <th style="width:20%" ;>
                                <center>Nama Tes</center>
                              </th>
                              <th>
                                <center>Mata Pelajaran</center>
                              </th>
                              <th style="width:15%" ;>
                                <center>Jumlah Soal </center>
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
                            $nip = $_SESSION['user'];
                            $quey_tes = "SELECT a.id, a.id_mapel, a.kelas, a.nama_ujian, a.kode_jurusan, a.jumlah_soal, a.waktu, a.token, a.tgl_mulai, a.terlambat,
                            b.nip, b.nama AS guru, c.nama AS mapel, d.nama AS jurusan
                            FROM tbl_guru_tes AS a INNER JOIN tbl_guru AS b ON a.id_guru = b.nip 
                            INNER JOIN tbl_mapel AS c ON a.id_mapel = c.id 
                            INNER JOIN tbl_jurusan AS d ON a.kode_jurusan = d.kode_jurusan
                            WHERE a.id_guru = '$nip'";
                            $sql_tes = mysqli_query($con, $quey_tes) or die(mysqli_error($con));
                            $row_db = mysqli_num_rows($sql_tes);
                            if ($row_db > 0) {
                              while ($data = mysqli_fetch_array($sql_tes)) {
                                $id = $data['id'];
                                $id_mapel = $data['id_mapel'];
                                ?>
                                <tr>
                                  <td>
                                    <?= $no++; ?>
                                  </td>
                                  <td>
                                    <h6>
                                      <?= $data['nama_ujian'] . '<br> Token : ' . $data['token']; ?>
                                      <a href="refresh.php?id=<?= $id; ?>" class="btn btn-light-red btn-sm"
                                        onclick="return confirm('Anda akan merefresh Token [ <?= $data['nama_ujian']; ?> ]?')"
                                        style="color:green;">
                                        <i class="fas fa-sync"></i>

                                      </a>
                                    </h6>
                                  </td>
                                  <td>
                                    <?php
                                    ?>
                                    <h6>
                                      <?= $data['mapel'];; ?>
                                    </h6>
                                  </td>
                                  <td>
                                    <center>
                                      <h6>
                                        <?= $data['jumlah_soal']; ?>
                                      </h6>
                                    </center>
                                  </td>

                                  <td>
                                    <center>
                                      <h6>
                                        <?php
                                         echo $data['kelas'] . ' - ' . $data['jurusan']; ?>
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
                                      <button class="btn btn-primary btn-sm" data-toggle="modal"
                                        data-target="#modal-editdata" data-id="<?= $id; ?>" data-nip="<?= $data['nip']; ?>" data-nama="<?= $data['nama_ujian']; ?>" data-mapel="<?= $id_mapel; ?>" data-kelas="<?= $data['kelas']; ?>" data-jurusan="<?= $data['kode_jurusan']; ?>" data-jumlah="<?= $data['jumlah_soal'];  ?>" data-mulai="<?= $data['tgl_mulai']; ?>" data-terlambat="<?= $data['terlambat']; ?>"  data-waktu="<?= $data['waktu']; ?>" >
                                        <i class="fas fa-edit"></i>
                                        Edit
                                      </button>
                                      <a href="delete.php?id=<?= $id ?>" class="btn btn-danger btn-sm"
                                        onclick="return confirm('Anda akan menghapus data ujian [ <?= $data['nama_ujian'] ?> ]?')">
                                        <i class="fas fa-trash"></i>
                                        Hapus
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

          <!-- modal tambah data -->
          <div class="modal fade" id="modal-tambahadmin">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header" style="background-color:#1A5319">
                  <h5 class="modal-title">
                    <font color="ffffff">
                      <i class="nav-icon fas fa-plus"></i>
                      Edit Data Soal
                    </font>
                  </h5>

                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <form class="form-horizontal" action="create.php" method="POST">
                  <div class="modal-body">
                    <input type="number" name="nip" value="<?= $nip; ?>" class="form-control" hidden>

                    <div class="form-group">
                      <label for="nama">Nama Tes</label>
                      <input type="text" name="nama" class="form-control" placeholder="Masukan Nama Tes" required>
                    </div>

                    <div class="form-group">
                      <label for="mapel">Mata Pelajaran</label>
                      <select class="form-control" name="mapel" required>
                        <option value="" selected disabled> -- Pilih Mata Pelajaran --</option>
                        <?php
                        $sql_mapel = mysqli_query($con, "SELECT * FROM tbl_mapel, tbl_guru_mapel WHERE nip_guru = $nip AND tbl_mapel.id = tbl_guru_mapel.id_mapel") or die(mysqli_error($con));
                        while ($data_mapel = mysqli_fetch_array($sql_mapel)) {
                          ?>
                          <option value="<?= $data_mapel['id_mapel']; ?>"><?= $data_mapel['nama']; ?> </option>
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
                    <div class="form-group">
                      <label for="soal">Jumlah Soal</label>
                      <input type="number" name="soal" class="form-control" placeholder="Masukan Jumlah Soal" required>
                      <p class="text-danger" style="font-size: 12px;">*Masukan jumlah soal tidak melebihi bank soal
                        mapel</p>
                    </div>
                    <div class="form-group">
                      <label for="tgl">Tanggal Mulai</label>
                      <div class="d-flex ">
                        <input type="date" name='tgl_mulai' class="form-control w-50 me-2" placeholder="Tgl" required>
                        <input type="time" name='wkt_mulai' class="form-control w-25  mx-2" placeholder="Waktu"
                          required>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="tgl">Tanggal Selesai</label>
                      <div class="d-flex ">
                        <input type="date" name='tgl_selesai' class="form-control w-50 me-2" placeholder="Tgl" required>
                        <input type="time" name='wkt_selesai' class="form-control w-25 mx-2" placeholder="Waktu"
                          required>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="wktu">Waktu</label>
                      <div class="d-flex ">
                        <input type="number" name="waktu" class="form-control w-25" placeholder="Menit" required>
                        <label for="wktu" class="m-2"><b>menit</b></label>
                      </div>
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
    <!-- modal edit data mhs -->
    <div class="modal fade" id="modal-editdata">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header" style="background-color:#1A5319">
            <h5 class="modal-title">
              <font color="ffffff">
                <i class="nav-icon fas fa-edit"></i>
                Edit Data Ujian
              </font>

            </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form class="form-horizontal" action="update.php" method="POST">
            <div class="modal-body">
              <input type="number" name="id" value="<?= $id; ?>" class="form-control" hidden>
              <input type="number" name="nip" value="<?= $nip; ?>" class="form-control" hidden>

              <div class="form-group">
                <label for="nama">Nama Tes</label>
                <input type="text" name="nama" class="form-control" placeholder="Masukan Nama Tes" required>
              </div>

              <div class="form-group">
                <label for="mapel">Mata Pelajaran</label>
                <select class="form-control" name="mapel" required>
                  <option value="" selected disabled> -- Pilih Mata Pelajaran --</option>
                  <?php
                  $sql_mapel = mysqli_query($con, "SELECT * FROM tbl_mapel, tbl_guru_mapel WHERE nip_guru = $nip AND tbl_mapel.id = tbl_guru_mapel.id_mapel") or die(mysqli_error($con));
                  while ($data_mapel = mysqli_fetch_array($sql_mapel)) {
                    ?>
                    <option value="<?= $data_mapel['id_mapel']; ?>"><?= $data_mapel['nama']; ?> </option>
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
              <div class="form-group">
                <label for="soal">Jumlah Soal</label>
                <input type="number" name="soal" class="form-control" placeholder="Masukan Jumlah Soal" required>
                <p class="text-danger" style="font-size: 12px;">*Masukan jumlah soal tidak melebihi bank soal mapel</p>
              </div>
              <div class="form-group">
                <label for="tgl">Tanggal Mulai</label>
                <div class="d-flex ">
                  <input type="date" name='tgl_mulai' class="form-control w-50 me-2" placeholder="Tgl" required>
                  <input type="time" name='wkt_mulai' class="form-control w-25  mx-2" placeholder="Waktu" required>
                </div>
              </div>
              <div class="form-group">
                <label for="tgl">Tanggal Selesai</label>
                <div class="d-flex ">
                  <input type="date" name='tgl_selesai' class="form-control w-50 me-2" placeholder="Tgl" required>
                  <input type="time" name='wkt_selesai' class="form-control w-25 mx-2" placeholder="Waktu" required>
                </div>
              </div>
              <div class="form-group">
                <label for="wktu">Waktu</label>
                <div class="d-flex ">
                  <input type="number" name="waktu" class="form-control w-25" placeholder="Menit" required>
                  <label for="wktu" class="m-2"><b>menit</b></label>
                </div>
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
  </div>

  <!-- ./wrapper -->

  <?php
  include "../script.php";
  ?>
  <script type="text/javascript">
    $('#modal-editdata').on('show.bs.modal', function (e) {

      //get data-id attribute of the clicked element
      var id        = $(e.relatedTarget).data('id');
      var nip       = $(e.relatedTarget).data('nip');
      var nama      = $(e.relatedTarget).data('nama');
      var mapel     = $(e.relatedTarget).data('mapel');
      var kelas     = $(e.relatedTarget).data('kelas');
      var jurusan   = $(e.relatedTarget).data('jurusan');
      var jumlah    = $(e.relatedTarget).data('jumlah');
      var waktu     = $(e.relatedTarget).data('waktu');
      var tglMulai  = $(e.relatedTarget).data('mulai');
      var terlambat = $(e.relatedTarget).data('terlambat');

      var tglMulaiDate  = tglMulai.split(' ')[0];
      var tglMulaiTime  = tglMulai.split(' ')[1];
      var terlambatDate = terlambat.split(' ')[0];
      var terlambatTime = terlambat.split(' ')[1];
      console.log(jurusan);

      $(e.currentTarget).find('input[name="id"]').val(id);
      $(e.currentTarget).find('input[name="nip"]').val(nip);
      $(e.currentTarget).find('input[name="nama"]').val(nama);
      $(e.currentTarget).find('select[name="mapel"]').val(mapel);
      $(e.currentTarget).find('select[name="kelas"]').val(kelas);
      $(e.currentTarget).find('select[name="jurusan"]').val(jurusan);
      $(e.currentTarget).find('input[name="soal"]').val(jumlah);
      $(e.currentTarget).find('input[name="waktu"]').val(waktu);

      $(e.currentTarget).find('input[name="tgl_mulai"]').val(tglMulaiDate);
      $(e.currentTarget).find('input[name="wkt_mulai"]').val(tglMulaiTime);
      $(e.currentTarget).find('input[name="tgl_selesai"]').val(terlambatDate);
      $(e.currentTarget).find('input[name="wkt_selesai"]').val(terlambatTime);

    });
  </script>
</body>

</html>