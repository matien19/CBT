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
    <!-- /.sweetalert -->
<script src="../assets_adminlte/js/sweetalert2.js"></script>
<script src="../assets_adminlte/js/sweetalert.js"></script>
<div class="wrapper" style="zoom:90%" !important>
  <?php

    if (isset($_POST['impor']))
    {
        $file = $_FILES['file']['name'];
        $ekstensi = explode (".", $file);
        $file_name = "file".round(microtime(true)).".".end($ekstensi);
        $sumber = $_FILES['file']['tmp_name'];
        $target_dir ="template/";
        $target_file = $target_dir.$file_name;
        $upload = move_uploaded_file($sumber, $target_file);      

        $file_excel = PHPExcel_IOFactory::load($target_file);
        $data_excel = $file_excel->getActiveSheet()->toArray(null, true,true,true);

        for ($j=2; $j <= count($data_excel); $j++)
        {
          $nip       = $data_excel[$j]['B'];
          $nama      = addslashes($data_excel[$j]['C']);
          $pass      = md5($nip);
          $peran     = 'guru';
          $stat      = 'A';

          $query_chek = mysqli_query($con, "SELECT nip FROM tbl_guru WHERE nip = '$nip'") or die(mysqli_error($con));  
          if (mysqli_num_rows($query_chek) == 0){
            mysqli_query($con, "INSERT INTO tbl_guru VALUES ('$nip','$nama')") or die(mysqli_error($con));      

            mysqli_query($con, "INSERT INTO tbl_user VALUES ('','$nip','$pass','$peran','$nama','$stat')") or die(mysqli_error($con)); 
            echo '
           
             <script>
               swal("Berhasil", "Data Guru telah ditambahkan", "success");
               
               setTimeout(function(){ 
               window.location.href = "../admin_guru";
   
               }, 1000)'; 
          }
    
        }
    unlink($target_file);
    }
    ?>


</script>
</body>
</html>