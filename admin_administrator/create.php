<?php 
require_once "../database/config.php";
?>
<!DOCTYPE html>
<html>
<head>
</head>
<body>
  <!-- /.sweetalert -->
<script src="../assets_adminlte/js/sweetalert2.js"></script>
<script src="../assets_adminlte/js/sweetalert.js"></script>

<div class="wrapper" style="zoom:90%" !important>
  <?php
    if (isset($_POST['tambahdata']))
    {
      $username     = trim(mysqli_real_escape_string($con, $_POST['username']));
      $usernamefix     = strtolower($username);
      $password   = trim(mysqli_real_escape_string($con, $_POST['password']));
      $repassword   = trim(mysqli_real_escape_string($con, $_POST['repassword']));
      $aktivasi = 1;
      if ($password !== $repassword){
        echo '
        
        <script>
            swal("Chek Password", "Password harus Sama!", "warning");
            setTimeout(function(){ 
            window.location.href = "../admin_administrator";
            }, 2000);
        </script>
        ';
      } else
      {
        $pass         = md5($repassword);
        $nama         = trim(mysqli_real_escape_string($con, $_POST['nama']));
        $peran        = 'admin';
        
        mysqli_query($con, "INSERT INTO tbl_user VALUES (NULL,'$usernamefix','$pass','$peran','$nama','$aktivasi')") or die (mysqli_error($con));
        
        echo '
        
        <script>
          swal("Berhasil", "Data Admin telah ditambahkan", "success");
          
          setTimeout(function(){ 
          window.location.href = "../admin_administrator";

          }, 1000);
        </script>
        ';
      }
      
    }
    ?>


</body>
</html>