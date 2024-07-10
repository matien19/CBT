<?php 
require_once "../database/config.php";
?>
<!DOCTYPE html>
<html>
<head>
</head>
<body>
    <!-- /.sweetalert -->
<script src="../assets_adminlte/js/sweetalert2.js"></script>
<script src="../assets_adminlte/js/sweetalert.js"></script>

<div class="wrapper" style="zoom:90%" !important>
  <?php
  $id = @$_GET['id'];
  $username = @$_GET['username'];
  $pass = md5('admin1234');
  $reset = mysqli_query($con, "UPDATE tbl_user SET password='$pass' WHERE id='$id'") or die (mysqli_error($con));
  if ($reset) {
  echo '
  
<script>
  swal("Berhasil", "Reset Password Data Admin telah berhasil", "success");
  
  setTimeout(function(){ 
   window.location.href = "../admin_administrator";

  }, 1000);
  </script>';
} else {
  echo '
 

  <script>
  Swal.fire({
    title: "Reset Password Gagal",
    text: "",
    icon: "error"
  });
  </script>
  ';
}

    ?>
</body>
</html>
