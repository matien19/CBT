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
    if (isset($_POST['tambahdata']))
    {
      
      $mapel      = trim(mysqli_real_escape_string($con, $_POST['mapel']));
      $query_mapel = "SELECT * FROM tbl_mapel WHERE nama ='$mapel'";
      $querycek   =  mysqli_query($con, $query_mapel) ;

       if (mysqli_num_rows($querycek) > 0)
       {
           echo '
           
            <script>
              swal("Peringatan", "mapel sudah Ada", "warning");
              
              setTimeout(function(){ 
              window.location.href = "../admin_mapel";

              }, 2000);
            </script>
           ';

       }
      else
       {
           mysqli_query($con, "INSERT INTO tbl_mapel VALUES (NULL,'$mapel')") or die (mysqli_error($con));
           echo '
           
            <script>
              swal("Berhasil", "Data mapel telah berhasil ditambahkan", "success");
              
              setTimeout(function(){ 
              window.location.href = "../admin_mapel";

              }, 1000);
            </script>
           ';
       }
          
    }

    ?>

</body>
</html>