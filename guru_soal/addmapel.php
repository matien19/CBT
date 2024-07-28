<!DOCTYPE html>
<html>
<head>
</head>
<body>
<div class="wrapper" style="zoom:90%" !important></div>
<?php

require_once '../database/config.php'; 

if ( isset($_POST['addmapel'])) {
    $nip_guru = $_POST['nip'];
    $mapel_ids = $_POST['mapel'];

    // Hapus mapel yang sudah ada untuk guru ini
    $delete_query = "DELETE FROM tbl_guru_mapel WHERE nip_guru = '$nip_guru'";
    mysqli_query($con, $delete_query) or die(mysqli_error($con));

    // Masukkan kembali mapel yang dipilih
    foreach ($mapel_ids as $mapel_id) {
        $insert_query = "INSERT INTO tbl_guru_mapel (nip_guru, id_mapel) VALUES ('$nip_guru', '$mapel_id')";
        mysqli_query($con, $insert_query) or die(mysqli_error($con));
    }

   echo ' <script src="../assets_adminlte/js/sweetalert2.js"></script>
<script src="../assets_adminlte/js/sweetalert.js"></script>
<script>
  swal("Berhasil", "Data Mapel guru telah ditambahkan", "success");
  
  setTimeout(function(){ 
   window.location.href = "../admin_guru";

  }, 1000);
</script>'; 
  
}
?>
</body>
</html>