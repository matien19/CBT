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
      
      $nip      = trim(mysqli_real_escape_string($con, $_POST['nip']));
      $nama     = trim(mysqli_real_escape_string($con, $_POST['nama']));
      $encpass  = $nip;
      $pass     = md5($encpass);
      $peran    = 'guru';
      $aktif    = 'A';

      $querycek  =  mysqli_query($con, "SELECT * FROM tbl_guru WHERE nip ='$nip'") or die (mysqli_error($con));

       if (mysqli_num_rows($querycek) > 0)
       {
        echo '
        <script src="../assets_adminlte/js/sweetalert.js"></script>
          <script>
          swal("Error!", "NIP sudah digunakan / data sudah ada!", "warning");
          
          setTimeout(function(){ 
          window.location.href = "../admin_guru";

          }, 2000)
       </script>';
        
       }
      else
       {
        mysqli_query($con, "INSERT INTO tbl_guru VALUES ('$nip','$nama')") or die (mysqli_error($con));
        mysqli_query($con, "INSERT INTO tbl_user VALUES (NULL,'$nip','$pass','$peran','$nama','$aktif')") or die (mysqli_error($con));

        echo '
          <script src="../assets_adminlte/js/sweetalert.js"></script>
          <script>
            swal("Berhasil", "Data Guru telah ditambahkan", "success");
            
            setTimeout(function(){ 
            window.location.href = "../admin_guru";

            }, 1000)
          </script>';
       }
          
    }

    ?>

</body>
</html>