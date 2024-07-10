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
      
      $nis = @$_GET['nis'];
      mysqli_query($con, "DELETE FROM tbl_siswa WHERE nis='$nis'") or die (mysqli_error($con));
    ?>

  <!-- /.sweetalert -->
  <script src="../assets_adminlte/js/sweetalert2.js"></script>
<script src="../assets_adminlte/js/sweetalert.js"></script>
<script>
  swal("Berhasil", "Data Siswa telah dihapus", "success");
  
  setTimeout(function(){ 
   window.location.href = "../admin_siswa";

  }, 1000);
</script> 
</body>
</html>
