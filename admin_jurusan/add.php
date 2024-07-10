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
      
      $jurusan      = trim(mysqli_real_escape_string($con, $_POST['jurusan']));
      $kd_jurusan      = trim(mysqli_real_escape_string($con, $_POST['kd_jurusan']));
      $query_jurusan = "SELECT * FROM tbl_jurusan WHERE kode_jurusan ='$kd_jurusan'";
      $querycek   =  mysqli_query($con, $query_jurusan) ;

       if (mysqli_num_rows($querycek) > 0)
       {
           echo '
           \
            <script>
              swal("Peringatan", "Kode jurusan telah digunagan", "warning");
              
              setTimeout(function(){ 
              window.location.href = "../admin_jurusan";

              }, 2000);
            </script>
           ';

       }
      else
       {
           mysqli_query($con, "INSERT INTO tbl_jurusan VALUES ('$kd_jurusan','$jurusan')") or die (mysqli_error($con));
           echo '
           \
            <script>
              swal("Berhasil", "Data jurusan telah berhasil ditambahkan", "success");
              
              setTimeout(function(){ 
              window.location.href = "../admin_jurusan";

              }, 1000);
            </script>
           ';
       }
          
    }

    ?>

</body>
</html>