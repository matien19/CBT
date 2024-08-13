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
      $id            = trim(mysqli_real_escape_string($con, $_POST['id']));
      $id_guru       = trim(mysqli_real_escape_string($con, $_POST['nip']));
      $id_mapel      = trim(mysqli_real_escape_string($con, $_POST['mapel']));
      $nama_ujian    = trim(mysqli_real_escape_string($con, $_POST['nama']));
      $jml_soal      = trim(mysqli_real_escape_string($con, $_POST['soal']));
      $kelas         = trim(mysqli_real_escape_string($con, $_POST['kelas']));
      $jurusan       = trim(mysqli_real_escape_string($con, $_POST['jurusan']));
      $waktu         = trim(mysqli_real_escape_string($con, $_POST['waktu']));
      $jenis         = 'set';

      $tgl_mulai     = trim(mysqli_real_escape_string($con, $_POST['tgl_mulai']));
      $waktu_mulai   = trim(mysqli_real_escape_string($con, $_POST['wkt_mulai']));
      $mulai         = $tgl_mulai. " ". $waktu_mulai;
      
      $tgl_selesai   = trim(mysqli_real_escape_string($con, $_POST['tgl_selesai']));
      $waktu_selesai   = trim(mysqli_real_escape_string($con, $_POST['wkt_selesai']));
      $terlambat = $tgl_selesai. " ". $waktu_selesai;

      $token = substr(str_shuffle("ABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 5);

      // echo $id.'-'.$id_guru.'-'.$id_mapel.'-'.$nama_ujian.'-'.$jml_soal.'-'.$kelas.'-'.$jurusan.'-'.$waktu.'-'.$jenis.'-'.$mulai.'-'.$terlambat;
        $sql =  mysqli_query($con, "UPDATE tbl_guru_tes 
        SET id_guru='$id_guru', 
        id_mapel='$id_mapel', 
        nama_ujian='$nama_ujian', 
        jumlah_soal='$jml_soal', 
        kelas='$kelas', 
        kode_jurusan='$jurusan', 
        waktu='$waktu',
        jenis='$jenis', 
        tgl_mulai='$mulai', 
        terlambat='$terlambat', 
        token='$token' 
        WHERE id='$id'") or die (mysqli_error($con));
         
        if ($sql) {
          echo '
          <script>
         swal("Berhasil", "Data Ujian telah berhasil diedit", "success");
         
         setTimeout(function(){ 
         window.location.href = "../guru_ujian";

         }, 1000);
       </script>
      ';
        } else {
        echo mysqli_error($con);

        }
         
      }
        
    ?>


</body>
</html>