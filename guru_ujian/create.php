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
      $id_guru     = trim(mysqli_real_escape_string($con, $_POST['nip']));
      $id_mapel     = trim(mysqli_real_escape_string($con, $_POST['mapel']));
      $nama_ujian   = trim(mysqli_real_escape_string($con, $_POST['nama']));
      $jml_soal   = trim(mysqli_real_escape_string($con, $_POST['soal']));
      $kelas   = trim(mysqli_real_escape_string($con, $_POST['kelas']));
      $jurusan   = trim(mysqli_real_escape_string($con, $_POST['jurusan']));
      $waktu   = trim(mysqli_real_escape_string($con, $_POST['waktu']));
      $jenis   = 'set';

      $tgl_mulai   = trim(mysqli_real_escape_string($con, $_POST['tgl_mulai']));
      $waktu_mulai   = trim(mysqli_real_escape_string($con, $_POST['wkt_mulai']));
      $mulai = $tgl_mulai. " ". $waktu_mulai;
      
      $tgl_selesai   = trim(mysqli_real_escape_string($con, $_POST['tgl_selesai']));
      $waktu_selesai   = trim(mysqli_real_escape_string($con, $_POST['wkt_selesai']));
      $terlambat = $tgl_selesai. " ". $waktu_selesai;

      $token = substr(str_shuffle("ABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 5);

          mysqli_query($con, "INSERT INTO tbl_guru_tes VALUES ('','$id_guru','$id_mapel','$nama_ujian','$jml_soal','$kelas','$jurusan','$waktu','$jenis','$mulai','$terlambat','$token')") or die (mysqli_error($con));
         
          echo '
              <script>
             swal("Berhasil", "Data Ujian telah ditambahkan", "success");
             
             setTimeout(function(){ 
             window.location.href = "../guru_ujian";

             }, 1000);
           </script>
          ';
      }
        
    ?>


</body>
</html>