<?php
require_once '../database/config.php';
$hal = 'administrator';
if (isset($_SESSION['peran'])) {
  if ($_SESSION['peran'] != 'admin') {
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
  <title>Admin Panel | Administartor </title>

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
                          <h3 class="card-title"><i class="nav-icon fas fa-user-lock"></i> Administartor</h3>
                      </div>
                      </font>
                      <!-- /.card-header -->
                      <div class="card-body">
                        <button type="button" class="btn" data-toggle="modal" data-target="#modal-tambahadmin"
                          style="background-color: #86090f; color:white;">
                          <i class="nav-icon fas fa-plus"></i> Tambah Data
                        </button>
                        <table id="example1" class="table table-bordered table-striped table-sm">
                          <thead>
                            <tr>
                              <th style="width:5%" ;>No</th>
                              <th style="width:25%" ;>
                                <center>Username</center>
                              </th>
                              <th style="width:35%" ;>
                                <center>Nama</center>
                              </th>
                              <th>
                                <center>Aksi</center>
                              </th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php
                            $no = 1;
                            $adm = 'Admin';
                            $sessi = $_SESSION['id'];
                            $query = "SELECT * FROM tbl_user WHERE peran='$adm' AND Id!='$sessi' ORDER BY Id desc";
                            $sql_admin = mysqli_query($con, $query) or die(mysqli_error($con));
                            $row_db = mysqli_num_rows($sql_admin);

                            if ($row_db > 0) {
                              while ($data = mysqli_fetch_array($sql_admin)) {
                                $id = $data['id'];
                                $username = $data['username'];
                                ?>
                                <tr>
                                  <td>
                                    <?= $no++; ?>
                                  </td>

                                  <td>
                                    <h6>
                                      <?= $data['username']; ?>
                                    </h6>
                                  </td>

                                  <td>
                                    <h6>
                                      <?= $data['nama']; ?>
                                    </h6>
                                  </td>


                                  <td>

                                    <center>
                                      <?php
                                      if ($row_db == 1 && $sql_admin) { ?>
                                        <a href="resetpw.php?id=<?= $id; ?>" class="btn btn-warning btn-sm,"
                                          onclick="return confirm('Anda akan mereset password Admin [ <?= $data['nama']; ?> ]?')">
                                          <i class="fas fa-edit"></i>
                                          Reset Password
                                        </a>
                                        <?php
                                      } else { ?>
                                        <a href="resetpw.php?id=<?= $id; ?>" class="btn btn-warning btn-sm"
                                          onclick="return confirm('Anda akan mereset password Admin [ <?= $data['nama']; ?> ]?')">
                                          <i class="fas fa-edit"></i>
                                          Reset Password
                                        </a>
                                        <a href="delete.php?id=<?= $id ?>" class="btn btn-danger btn-sm"
                                          onclick="return confirm('Anda akan menghapus data Admin [ <?= $data['username'] ?> ]?')">
                                          <i class="fas fa-trash"></i>
                                          Hapus
                                        </a>
                                      <?php }
                                      ?>

                                    </center>
                                  </td>

                                </tr>

                                <?php
                              }

                            } else {
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

          <!-- modal tambah data -->
          <div class="modal fade" id="modal-tambahadmin">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header" style="background-color:#1A5319">
                  <h5 class="modal-title">
                    <font color="ffffff">
                      <i class="nav-icon fas fa-plus"></i>
                      Tambah Data Administartor
                    </font>
                  </h5>

                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <form class="form-horizontal" action="create.php" method="POST">
                  <div class="modal-body">
                    <div class="form-group">
                      <input type="text" name="id" class="form-control" value="<?= $id ?>" hidden>
                    </div>
                    <div class="form-group">
                      <label for="username">Username</label>
                      <input type="text" name="username" class="form-control" placeholder="Masukan Username" required>
                    </div>

                    <div class="form-group">
                      <label for="nama">Nama</label>
                      <input type="text" name="nama" class="form-control" placeholder="Masukan Nama" required>
                    </div>
                    <div class="form-group">
                      <label for="password">Password</label>
                      <input type="password" name="password" class="form-control" placeholder="Masukan Password"
                        required>
                    </div>
                    <div class="form-group">
                      <label for="password">Re-Password</label>
                      <input type="password" name="repassword" class="form-control" placeholder="Masukan Ulang Password"
                        required>
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

  <!-- ./wrapper -->

  <?php
  include "../script.php";
  ?>

</body>

</html>