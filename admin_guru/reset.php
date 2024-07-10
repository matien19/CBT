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
      $peran = 'guru';
      mysqli_query($con, "TRUNCATE TABLE tbl_guru") or die (mysqli_error($con));
      mysqli_query($con, "DELETE from tbl_user WHERE peran='$peran'") or die (mysqli_error($con));
    ?>

  <!-- /.sweetalert -->
  <script src="../assets_adminlte/js/sweetalert2.js"></script>
<script src="../assets_adminlte/js/sweetalert.js"></script>
<script>
  swal("Berhasil", "Data guru telah direset", "success");
  
  setTimeout(function(){ 
   window.location.href = "../admin_guru";

  }, 1000);
</script> 
</body>
</html>
