<?php 
require_once "../database/config.php"; 
error_reporting(0);


 ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>CBT | Login</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../assets_adminlte/plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="../assets_adminlte/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Theme style -->
  <link rel="stylesheet" href="../assets_adminlte/dist/css/adminlte.min.css">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <!-- /.login-logo -->
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="./" class="h1"><b>C</b>omputer  <b>B</b>assed <b>T</b>est</a>
    </div>
    <div class="card-body">
      <p class="login-box-msg"><?=$aktivasil;?> Login menggunakan informasi akun anda</p>

      <form action="" method="post">
        <div class="input-group mb-3">
          <input type="text" class="form-control" name="username" placeholder="Username" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" name="password" placeholder="Password" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
            
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" name="login" class="btn btn-primary btn-block">Login</button>
          </div>
          <!-- /.col -->
        </div>
      </form>
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>
<!-- /.login-box -->

<!-- /.sweetalert -->
<script src="../assets_adminlte/js/sweetalert2.js"></script>
<script src="../assets_adminlte/js/sweetalert.js"></script>
<!-- jQuery -->
<script src="../assets_adminlte/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../assets_adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../assets_adminlte/dist/js/adminlte.min.js"></script>
</body>
</html>
<?php 

if (isset($_POST['login']))
{
  $username = trim(mysqli_real_escape_string($con, $_POST['username']));
  $password = md5(trim(mysqli_real_escape_string($con, $_POST['password'])));
  $sql_login = mysqli_query($con, "SELECT * FROM tbl_user WHERE username = '$username' AND password = '$password'") or die(mysqli_error($con));
 
    if(mysqli_num_rows($sql_login) > 0 )
    {
       $datanya = mysqli_fetch_assoc($sql_login);
       $aktivasi = $datanya['aktivasi'];
       $id = $datanya['id'];
       $peran = $datanya['peran'];
       $nama = $datanya['nama'];
       
       session_start();
       $_SESSION['user'] = $username;
       $_SESSION['id'] = $id;
       $_SESSION['peran'] = $peran;
       $_SESSION['nama'] = $nama;
       switch($datanya['peran']) {
         case 'admin':
           echo '
           
           <script>
             swal("Berhasil", "Login Sukses", "success");
             
             setTimeout(function(){ 
             window.location.href = "../admin_dashboard";

             }, 1000);
           </script>
           ';
           break;
         case 'guru':
           echo '
           <script>
             swal("Berhasil", "Login Sukses", "success");
             
             setTimeout(function(){ 
             window.location.href = "../guru_dashboard";

             }, 1000);
           </script>
           ';
           break;
         case 'siswa':
          if ($aktivasi == 'A') {
            echo '
            <script>
              swal("Berhasil", "Login Sukses", "success");
              
              setTimeout(function(){ 
              window.location.href = "../siswa_dashboard";

              }, 1000);
            </script>
            ';
          } else {
            
            echo '
            <script>
              swal("Aktivasi Akun !", "Silahkan hubungi Admin untuk aktivasi akun", "warning");
              
              setTimeout(function(){ 
              window.location.href = "./logout.php";

              }, 1000);
            </script>
            ';
          }
          
           break;
       }

    }
    else
    {
      echo '
      <script>
      Swal.fire({
        title: "Akun tidak ditemukan!",
        text: "",
        icon: "error"
      });
      window.location.href = "./logout.php";
      </script>
      ';

    }
 }
 ?>