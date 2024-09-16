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
      $id_guru       = trim(mysqli_real_escape_string($con, $_POST['nip']));
      $id_mapel      = trim(mysqli_real_escape_string($con, $_POST['mapel']));
      $jml_soal      = trim(mysqli_real_escape_string($con, $_POST['soal']));
      $kelas         = trim(mysqli_real_escape_string($con, $_POST['kelas']));

      $sqlsoal      = mysqli_query($con, "SELECT id FROM tbl_soal WHERE id_mapel='$id_mapel' AND kelas='$kelas' LIMIT $jml_soal") or die(mysqli_error($con));
      $jml_soal_db  = mysqli_num_rows($sqlsoal);
      
      if ($jml_soal > $jml_soal_db ) {
        echo '
          <script>
          swal("Chek Jumlah Soal", "Data soal pada bank soal kurang / kosong", "warning");
          
          setTimeout(function(){ 
          window.location.href = "../guru_ujian";

          }, 2000);
          </script>
          ';
      }else {
        $id            = trim(mysqli_real_escape_string($con, $_POST['id']));
        $nama_ujian    = trim(mysqli_real_escape_string($con, $_POST['nama']));
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

        $delete = mysqli_query($con, "DELETE FROM tbl_paket_soal WHERE id_ujian='$id'")or die(mysqli_error($con));

        if ($delete) {

          while ($daftar_soal = mysqli_fetch_array($sqlsoal) ) {
            $id_soalnya = $daftar_soal['id'];
            mysqli_query($con, "INSERT INTO tbl_paket_soal VALUES ('$id', '$id_soalnya')") or die (mysqli_error($con));
          }
        }

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
         
      }
        
    ?>


</body>
</html>