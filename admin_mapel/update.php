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
        $mapel      = trim(mysqli_real_escape_string($con, $_POST['mapel']));
        $query_update = mysqli_query($con, "UPDATE tbl_mapel SET nama='$mapel' WHERE id='$id'") or die (mysqli_error($con));
        if ($query_update) {
          echo '

          <script>
            swal("Berhasil", "Data Mata Pelajaran telah diedit", "success");
            
            setTimeout(function(){ 
            window.location.href = "../admin_mapel";

            }, 1000);
          </script> ';
        } else {
          echo '

          <script>
            swal("Berhasil", "Data Mata Pelajaran telah diedit", "success");
            
            setTimeout(function(){ 
            window.location.href = "../admin_mapel";

            }, 1000);
          </script> '; 
        }
        
      }
      
  ?>


</body>
</html>