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
      mysqli_query($con, "TRUNCATE TABLE tbl_soal") or die (mysqli_error($con));
    ?>

  <!-- /.sweetalert -->
<script src="../assets_adminlte/js/sweetalert.js"></script>
<script>
  swal("Berhasil", "Data soal telah direset", "success");
  
  setTimeout(function(){ 
   window.location.href = "../guru_soal";

  }, 1000);
</script> 
</body>
</html>
