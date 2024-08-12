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
      
      $nip = @$_GET['nip'];
      mysqli_query($con, "DELETE FROM tbl_guru WHERE nip='$nip'") or die (mysqli_error($con));
    ?>

  <!-- /.sweetalert -->
<script src="../assets_adminlte/js/sweetalert.js"></script>
<script>
  swal("Berhasil", "Data Guru telah dihapus", "success");
  
  setTimeout(function(){ 
   window.location.href = "../admin_guru";

  }, 1000);
</script> 
</body>
</html>
