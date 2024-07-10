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
      
      $kelas      = trim(mysqli_real_escape_string($con, $_POST['kelas']));
      $query_kelas = "SELECT * FROM tbl_kelas WHERE kelas ='$kelas'";
      $querycek   =  mysqli_query($con, $query_kelas) ;

       if (mysqli_num_rows($querycek) > 0)
       {
           echo '
           
            <script>
              swal("Peringatan", "Kelas sudah Ada", "warning");
              
              setTimeout(function(){ 
              window.location.href = "../admin_kelas";

              }, 2000);
            </script>
           ';

       }
      else
       {
           mysqli_query($con, "INSERT INTO tbl_kelas VALUES ('','$kelas')") or die (mysqli_error($con));
           echo '
           
            <script>
              swal("Berhasil", "Data kelas telah berhasil ditambahkan", "success");
              
              setTimeout(function(){ 
              window.location.href = "../admin_kelas";

              }, 1000);
            </script>
           ';
       }
          
    }

    ?>

</body>
</html>