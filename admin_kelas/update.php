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
      
      if (isset($_POST['editdata']))
      {
        
        $id         = trim(mysqli_real_escape_string($con, $_POST['id']));
        $kelas  = trim(mysqli_real_escape_string($con, $_POST['kelas']));
        $query_update = mysqli_query($con, "UPDATE tbl_kelas SET kelas='$kelas' WHERE id='$id'") or die (mysqli_error($con));
        if ($query_update) {
          echo '
          
          <script>
            swal("Berhasil", "Data Kelas telah diedit", "success");
            
            setTimeout(function(){ 
            window.location.href = "../admin_kelas";

            }, 1000);
          </script> ';
        } else {
          echo '
          
          <script>
            swal("Berhasil", "Error!", "error");
            
            setTimeout(function(){ 
            window.location.href = "../admin_kelas";

            }, 2000);
          </script> '; 
        }
        
      }
      
  ?>


</body>
</html>