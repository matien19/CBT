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
      
      $id = @$_GET['id'];
      mysqli_query($con, "DELETE FROM tbl_soal WHERE id='$id'") or die (mysqli_error($con));
    ?>

  <!-- /.sweetalert -->
<script src="../assets_adminlte/js/sweetalert.js"></script>
<script>
  swal("Berhasil", "Data soal telah dihapus", "success");
  
  setTimeout(function(){ 
   window.location.href = "../guru_soal";

  }, 1000);
</script> 
</body>
</html>
