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
      
      $token = substr(str_shuffle("ABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 5);
      mysqli_query($con, "UPDATE tbl_guru_tes SET token ='$token' WHERE id = '$id'") or die (mysqli_error($con));
      ?>

  <!-- /.sweetalert -->
<script src="../assets_adminlte/js/sweetalert.js"></script>
<script>
  swal("Berhasil", "Token telah berhasil direfresh", "success");
  
  setTimeout(function(){ 
   window.location.href = "../guru_ujian";

  }, 1000);
</script> 
</body>
</html>
