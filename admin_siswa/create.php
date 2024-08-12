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
      
      $nis      = trim(mysqli_real_escape_string($con, $_POST['nis']));
      $nama     = trim(mysqli_real_escape_string($con, $_POST['nama']));
      $kelas    = trim(mysqli_real_escape_string($con, $_POST['kelas']));
      $jurusan  = trim(mysqli_real_escape_string($con, $_POST['jurusan']));
      $status   = 'T';
      $pass     = md5($nis);
      $peran    = 'siswa';

      $querycek   =  mysqli_query($con, "SELECT * FROM tbl_siswa WHERE nis ='$nis'") or die (mysqli_error($con));

       if (mysqli_num_rows($querycek) > 0)
       {
           echo '
           <script>
                swal("Error!", "NIM sudah digunakan / data sudah ada!", "warning");
                
                setTimeout(function(){ 
                window.location.href = "../admin_siswa";
                }, 2000);
            </script>
            ';
       }
      else
       {
           mysqli_query($con, "INSERT INTO tbl_siswa VALUES ('$nis','$nama','$kelas','$jurusan','$status')") or die (mysqli_error($con));
           mysqli_query($con, "INSERT INTO tbl_user VALUES ('','$nis','$pass','$peran','$nama','$status')") or die (mysqli_error($con));

           echo '
            <script>
                swal("Berhasil", "Data Siswa telah ditambahkan", "success");
                
                setTimeout(function(){ 
                window.location.href = "../admin_siswa";

                }, 1000);
            </script>
            ';
       }
          
    }

    ?>


</body>
</html>