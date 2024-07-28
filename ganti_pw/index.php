<?php
require_once '../database/config.php';
$hal = 'gantipassword';
$peran = $_SESSION['peran'];
//data pengguna
$id = $_SESSION['id'];
$user = $_SESSION['user'];
$nama = $_SESSION['nama'];
?>

<?php
switch ($peran) {
  case 'admin':
    ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>Admin Panel | Ganti Password </title>
      <?php
      break;
  case 'guru':
    ?>
      <!DOCTYPE html>
      <html lang="en">

      <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Dosen Panel | Ganti Password </title>
        <?php
        break;
  case 'siswa':
    ?>
        <!DOCTYPE html>
        <html lang="en">

        <head>
          <meta charset="utf-8">
          <meta name="viewport" content="width=device-width, initial-scale=1">
          <title>Mahasiswa Panel | Ganti Password </title>
          <?php
          break;
  default:
    echo "<script>window.location= '../auth/logout.php';</script>";
    break;
}
?>

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
            switch ($peran) {
              case 'admin':
                include '../sidebar_admin.php';
                break;
              case 'guru':
                include '../sidebar_guru.php';
                break;
              case 'siswa':
                include '../sidebar_siswa.php';
                break;
            }
            ?>
            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
              <br>
              <div class="content">
                <div class="container-fluid">
                  <div class="row">
                    <div class="col-lg-12">
                      <div class="card card-primary">
                        <div class="card-header" style="background-color:#597445">
                          <h3 class="card-title">Ganti Password</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->

                        <div class="card-body">
                          <div class="row">
                            <?php
                            switch ($peran) {
                              case 'admin':
                                echo '<div class="col-lg-6">
                          <label for="pass">Username</label>
                          <input type="text" name="password" class="form-control" value="' . $user . '" disabled>
                        </div>
                        <div class="col-lg-6">
                          <label for="pass">Nama</label>
                          <input type="text" name="password" class="form-control" value="' . $nama . '" disabled>
                        </div>';
                                break;
                              case 'guru':
                                echo '<div class="col-lg-6">
                          <label for="pass">NID</label>
                          <input type="text" name="password" class="form-control" value="' . $user . '" disabled>
                        </div>
                        <div class="col-lg-6">
                          <label for="pass">Nama Guru</label>
                          <input type="text" name="password" class="form-control" value="' . $nama . '" disabled>
                        </div>';
                                break;
                              case 'siswa':
                                echo '<div class="col-lg-6">
                          <label for="pass">NIS</label>
                          <input type="text" name="password" class="form-control" value="' . $user . '" disabled>
                        </div>
                        <div class="col-lg-6">
                          <label for="pass">Nama Siswa</label>
                          <input type="text" name="password" class="form-control" value="' . $nama . '" disabled>
                        </div>';
                                break;
                            }
                            ?>


                          </div>

                          <form class="form-horizontal" action="update.php?id=<?= $id; ?>" method="POST">
                            <div class="form-group">
                              <input type="number" name="id" class="form-control" value="<?= $id; ?>" hidden>
                            </div>
                            <div class="form-group">
                              <label for="pass">Password Lama</label>
                              <input type="password" name="passwordlama" class="form-control"
                                placeholder="Masukan Password" required>
                            </div>

                            <div class="form-group">
                              <label for="pass">Password Baru</label>
                              <input type="password" name="password" class="form-control" placeholder="Masukan Password"
                                required>
                            </div>
                            <div class="form-group">
                              <label for="pass">Konfirmasi Password</label>
                              <input type="password" name="repassword" class="form-control"
                                placeholder="Masukan Ulang Password" required>
                            </div>
                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                          <button type="submit" class="btn btn-warning" name="ganti_pw"
                            style="background-color:#FCDC2A">Ganti Password</button>
                        </div>
                        </form>
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

            <!-- ./wrapper -->

            <?php
            include "../script.php";
            ?>

  </body>

  </html>