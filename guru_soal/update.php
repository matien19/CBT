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
      
      if (isset($_POST['editdata']))
      {
        
        $nip      = trim(mysqli_real_escape_string($con, $_POST['nip2']));
        $nama   = trim(mysqli_real_escape_string($con, $_POST['nama']));

        mysqli_query($con, "UPDATE tbl_guru SET nama='$nama' WHERE nip='$nip'") or die (mysqli_error($con));
        mysqli_query($con, "UPDATE tbl_user SET nama='$nama' WHERE username='$nip'") or die (mysqli_error($con));
      }
      
    ?>
      <!-- /.sweetalert -->
<script src="../assets_adminlte/js/sweetalert2.js"></script>
<script src="../assets_adminlte/js/sweetalert.js"></script>
<script>
  swal("Berhasil", "Data Guru telah diedit", "success");
  
  setTimeout(function(){ 
   window.location.href = "../admin_guru";

  }, 2000);
</script> 
</body>
</html>