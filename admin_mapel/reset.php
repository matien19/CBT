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
      mysqli_query($con, "TRUNCATE TABLE tbl_mapel") or die (mysqli_error($con));
    ?>

  <!-- /.sweetalert -->
  <script src="../assets_adminlte/js/sweetalert2.js"></script>
<script src="../assets_adminlte/js/sweetalert.js"></script>
<script>
  swal("Berhasil", "Data Kelas Mata Pelajaran telah direset", "success");
  
  setTimeout(function(){ 
   window.location.href = "../admin_mapel";

  }, 1000);
</script> 
</body>
</html>
