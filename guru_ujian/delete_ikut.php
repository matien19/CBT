<?php 
require_once "../database/config.php";
?>
<!DOCTYPE html>
<html>
<head>
</head>
<body>
<div class="wrapper" style="zoom:90%" !important>
  <?php
      
      $id = @$_GET['id'];
      $nim = @$_GET['nim'];
      mysqli_query($con, "DELETE FROM tbl_ikut_ujian WHERE id_tes='$id' AND id_user='$nim'") or die (mysqli_error($con));
      mysqli_query($con, "DELETE FROM tbl_jawaban WHERE id_tes='$id' AND id_user='$nim'") or die (mysqli_error($con));
    ?>

  <!-- /.sweetalert -->
<script src="../assets_adminlte/js/sweetalert.js"></script>
<script>
  swal("Berhasil", "Data Siswa Ujian telah dihapus", "success");
  
  setTimeout(function(){ 
   window.location.href = '../guru_ujian?id=<?=$id;?>'

  }, 1000);
</script> 
</body>
</html>
