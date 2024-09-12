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
        $nip              = $data_excel[$j]['B'];
        $mapel            = addslashes($data_excel[$j]['C']);
        $kelas            = $data_excel[$j]['D'];
        $soal             = '<p>'.$data_excel[$j]['E'].'</p>';
        $jawaban_a        = '<p>'.$data_excel[$j]['F'].'</p>';
        $jawaban_b        = '<p>'.$data_excel[$j]['G'].'</p>';
        $jawaban_c        = '<p>'.$data_excel[$j]['H'].'</p>';
        $jawaban_d        = '<p>'.$data_excel[$j]['I'].'</p>';
        $jawaban_e        = '<p>'.$data_excel[$j]['J'].'</p>';
        $kunci_jawaban    = $data_excel[$j]['K'];
        $file             = '-';
        $type_file        = '-';
        $date             = date('Y-m-d H:i:s');
        $kosong           = '';
           
        // echo $nip,$mapel.$kelas.$file.$type_file.$soal.$jawaban_a.$jawaban_b.$jawaban_c.$jawaban_d.$jawaban_e.$kunci_jawaban,$date;
        $query_chek = mysqli_query($con, "SELECT soal FROM tbl_soal WHERE soal = '$soal'") or die(mysqli_error($con));  
        if (mysqli_num_rows($query_chek) == 0){

         $sql  = "INSERT INTO tbl_soal VALUES (null,'$nip','$mapel', '$kelas','$file','$type_file', '$soal', '$jawaban_a', '$jawaban_b', '$jawaban_c', '$jawaban_d', '$jawaban_e', '$kunci_jawaban', '$date')";
              
         mysqli_query($con, $sql) or die(mysqli_error($con));  
         mysqli_query($con, "DELETE FROM tbl_soal WHERE soal ='$kosong'") or die(mysqli_error($con));  
          }
          
        }
    
        unlink($target_file);

        echo 
        '
         
          <script src="../assets_adminlte/js/sweetalert.js"></script>
          <script>
            swal("Berhasil", "Import Data Soal telah berhasil", "success");
            
            setTimeout(function(){ 
            window.location.href = "../guru_soal";

            }, 1000);
          </script>
        ';
    }
    
    ?>


</body>
</html>