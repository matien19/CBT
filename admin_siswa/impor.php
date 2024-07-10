<?php 
require_once "../database/config.php";
require "../assets_adminlte/dist/phpexcel-xls-library/vendor/phpoffice/phpexcel/Classes/PHPExcel.php";
error_reporting(0);
?>
<!DOCTYPE html>
<html>
<head>
</head>
<body>
<div class="wrapper" style="zoom:90%" !important>
  <?php

    if (isset($_POST['impor']))
    {
        $file = $_FILES['file']['name'];
        $ekstensi = explode (".", $file);
        $file_name = "file".round(microtime(true)).".".end($ekstensi);
        $sumber = $_FILES['file']['tmp_name'];
        $target_dir ="template/import/";
        $target_file = $target_dir.$file_name;
        $upload = move_uploaded_file($sumber, $target_file);      

        $file_excel = PHPExcel_IOFactory::load($target_file);
        $data_excel = $file_excel->getActiveSheet()->toArray(null, true,true,true);

        for ($j=2; $j <= count($data_excel); $j++)
        {
       $nis       = $data_excel[$j]['B'];
       $nama      = addslashes($data_excel[$j]['C']);
       $kelas      = $data_excel[$j]['D'];
       $jurusan   = $data_excel[$j]['E'];
       $stat      = 'T';
       $pass      = md5($nis);
       $peran     = 'siswa';
       $kosong = '';
    
       $query_chek = mysqli_query($con, "SELECT nis FROM tbl_siswa WHERE nis = '$nis'") or die(mysqli_error($con));  
       if (mysqli_num_rows($query_chek) == 0){

         mysqli_query($con, "INSERT INTO tbl_siswa VALUES ('$nis','$nama','$kelas','$jurusan','$stat')");      
         mysqli_query($con, "DELETE FROM tbl_siswa WHERE nis ='$kosong'");      

         $query_pengguna = mysqli_query($con, "SELECT username FROM tbl_user WHERE username='$nis'") or die(mysqli_error($con));
         
         if (mysqli_num_rows($query_pengguna) == 0){
          mysqli_query($con, "INSERT INTO tbl_user VALUES ('','$nis','$pass','$peran','$nama','$stat')") or die(mysqli_error($con)); 
          mysqli_query($con, "DELETE FROM tbl_user WHERE username = '$kosong'") or die(mysqli_error($con)); 

         }
        }
        }
    
        unlink($target_file);
    }
    
    ?>

  <!-- /.sweetalert -->
  <script src="../assets_adminlte/js/sweetalert2.js"></script>
<script src="../assets_adminlte/js/sweetalert.js"></script>
<script>
  swal("Berhasil", "Import Data Siswa telah berhasil", "success");
  
  setTimeout(function(){ 
   window.location.href = "../admin_siswa";

  }, 1000);
</script>
</body>
</html>