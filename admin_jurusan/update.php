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
        $jurusan      = trim(mysqli_real_escape_string($con, $_POST['jurusan']));
        $kd_jurusan      = trim(mysqli_real_escape_string($con, $_POST['kd_jurusan']));
        $query_jurusan = "SELECT * FROM tbl_jurusan WHERE kode_jurusan ='$kd_jurusan'";
       
        $query_update = mysqli_query($con, "UPDATE tbl_jurusan SET nama = '$jurusan' WHERE kode_jurusan='$kd_jurusan'") or die (mysqli_error($con));
        if ($query_update) {
          echo '
          
          <script>
            swal("Berhasil", "Data Jurusan telah diedit", "success");
            
            setTimeout(function(){ 
            window.location.href = "../admin_jurusan";

            }, 1000);
          </script> ';
        } else {
          echo '
          
          <script>
            swal("Berhasil", "Data Jurusan telah diedit", "success");
            
            setTimeout(function(){ 
            window.location.href = "../admin_jurusan";

            }, 1000);
          </script> '; 
        }
        
      }
      
  ?>


</body>
</html>