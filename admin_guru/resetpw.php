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
  $pass = md5($nip);
      mysqli_query($con, "UPDATE tbl_user SET password='$pass' WHERE username = '$nip'") or die (mysqli_error($con));
    ?>
  <!-- /.sweetalert -->
  <script src="../assets_adminlte/js/sweetalert2.js"></script>
<script src="../assets_adminlte/js/sweetalert.js"></script>
<script>
  swal("Berhasil", "Data Guru telah direset", "success");
  
  setTimeout(function(){ 
   window.location.href = "../admin_guru";

  }, 1000);
</script> 
</body>
</html>
