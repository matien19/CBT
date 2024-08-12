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
      
    
      
        $nis         = @$_GET['nis'];
        $aktif       = 'A';

        mysqli_query($con, "UPDATE tbl_siswa SET stat='$aktif' WHERE nis = '$nis'") or die (mysqli_error($con));
        mysqli_query($con, "UPDATE tbl_user SET aktivasi='$aktif' WHERE username = '$nis'") or die (mysqli_error($con));
 
    ?>

  <!-- /.sweetalert -->
<script src="../assets_adminlte/js/sweetalert.js"></script>
<script>
  swal("Berhasil", "Data Siswa telah diaktifkan", "success");
  
  setTimeout(function(){ 
   window.location.href = "../admin_siswa";

  }, 1000);
</script> 
</body>
</html>
