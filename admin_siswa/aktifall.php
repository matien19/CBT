<?php 
require_once "../database/config.php";
?>
<!DOCTYPE html>
<html>
<head>
</head>
<body>
<div class="wrapper" style="zoom:90%" !important>
  <?php

        $aktif      = 'A';
        $peran      = 'siswa';
        mysqli_query($con, "UPDATE tbl_siswa SET stat='$aktif'") or die (mysqli_error($con));
        mysqli_query($con, "UPDATE tbl_user SET aktivasi='$aktif' WHERE peran = '$peran'") or die (mysqli_error($con));
 
    ?>

  <!-- /.sweetalert -->
  <script src="../assets_adminlte/js/sweetalert2.js"></script>
<script src="../assets_adminlte/js/sweetalert.js"></script>
<script>
  swal("Berhasil", "Data Siswa telah diaktifkan", "success");
  
  setTimeout(function(){ 
   window.location.href = "../admin_siswa";

  }, 1000);
</script> 
</body>
</html>
