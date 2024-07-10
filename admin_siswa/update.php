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
        
        $nis      = trim(mysqli_real_escape_string($con, $_POST['nis2']));
        $nama   = trim(mysqli_real_escape_string($con, $_POST['nama']));
        $kelas   = trim(mysqli_real_escape_string($con, $_POST['kelas']));
        $jurusan   = trim(mysqli_real_escape_string($con, $_POST['jurusan']));
        $status   = trim(mysqli_real_escape_string($con, $_POST['stat']));

      mysqli_query($con, "UPDATE tbl_siswa SET nama='$nama',kelas='$kelas', kode_jurusan='$jurusan', stat ='$status' WHERE nis = '$nis'") or die (mysqli_error($con));
      mysqli_query($con, "UPDATE tbl_user SET nama='$nama' WHERE username='$nis'") or die (mysqli_error($con));

      echo '
      <script>
        swal("Berhasil", "Data Siswa telah diedit", "success");
        
        setTimeout(function(){ 
         window.location.href = "../admin_siswa";
      
        }, 1000);
      </script> ';
      }
      
     
    ?>


</body>
</html>