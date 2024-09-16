<?php
require_once '../database/config.php';
$hal = 'ujian';
if (isset($_SESSION['peran'])) {
  if ($_SESSION['peran'] != 'siswa') {
    echo "<script>window.location='../auth/logout.php';</script>";
  }
} else {
  echo "<script>window.location='../auth/logout.php';</script>";
}


$cek_ikut_ujian = mysqli_query($con, "SELECT * FROM tbl_ikut_ujian WHERE id_tes='".$_GET['id']."' AND id_user='".$_SESSION['user']."' ") or die(mysqli_error($con));
if(mysqli_num_rows($cek_ikut_ujian) > 0)
{
  $data_ikut_ujian = mysqli_fetch_assoc($cek_ikut_ujian);
  
  if($data_ikut_ujian['status'] == 'selesai'){
    header('Location: '. 'index.php?id='.$_GET['id']); 
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Siswa Panel | Ujian</title>

  <?php 
  include "../linksheet.php"; 
  ?>
  
 </head>
<body>

  <?php
  $id = $_GET['id'];
  $quey_tes = "SELECT a.id AS id_tes_token, a.id_guru, a.tgl_mulai, a.terlambat, a.token, a.nama_ujian, a.jumlah_soal, a.waktu, b.nama AS nama_guru, c.nama AS nama_mapel, CASE
  WHEN NOW() < a.tgl_mulai THEN 0 
  WHEN NOW() BETWEEN a.tgl_mulai AND a.terlambat THEN 1 
  ELSE 2 END AS statuse 
  FROM tbl_guru_tes a INNER JOIN tbl_guru b ON a.id_guru = b.nip 
  INNER JOIN tbl_mapel c ON a.id_mapel = c.id WHERE a.id = '$id'";

  $sql_tes = mysqli_query($con, $quey_tes) or die(mysqli_error($con));
  $data = mysqli_fetch_assoc($sql_tes);

  $status = $data['statuse'];
  $nis = $_SESSION['user'];
  $query_siswa = "SELECT * FROM tbl_siswa WHERE nis = '$nis'";
  $sql_siswa = mysqli_query($con, $query_siswa) or die(mysqli_error($con));
  $data_siswa = mysqli_fetch_assoc($sql_siswa);
  if ($status == 2){

    $query_ikut = "SELECT id_user FROM tbl_ikut_ujian WHERE id_user = '$nis' AND id_tes ='$id'";
    $sql_ikut_uji = mysqli_query($con, $query_ikut)or die(mysqli_error($con));
    if (mysqli_num_rows($sql_ikut_uji) == 0) {
      
      $sql_telat = mysqli_query($con, "INSERT INTO tbl_ikut_ujian SET 
      id_tes = '$id',
      id_user = '$nis',
      tgl_mulai = '".date('Y-m-d H:i:s')."',
      status = 'terlambat'
    ")or die(mysqli_error($con));
      if ($sql_telat) { 
        echo '
      <script src="../assets_adminlte/js/sweetalert.js"></script>
      <script>
        swal("Peringatan!", "Anda sudah terlambat untuk mengikuti Ujian ini", "warning");
        
        setTimeout(function(){ 
        window.location.href = "../siswa_ujian";

        }, 2000);
      </script> ';
      }
    }

    
  } else {
  ?>

  <div class="content">
    <br>
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-header" style="background-color:#365E32">
              <font color="ffffff">
                <h3 class="card-title"><i class="nav-icon fas fa-book-open"></i> Ujian</h3>
            </div>
            </font>
            <div class="card-body">
              <div class="row">
                <div class="col-md-12">
                  <a href="../siswa_ujian/" class="btn btn-danger btn-sm"> <i class="fas fa-arrow-alt-circle-left"></i> <strong> kembali </strong> </a>
                </div>
                <br>
                <br>
              </div>
              <div class="row">
                <div class="col-md-7">
               
                  <div class="panel panel-default">
                    <div class="panel-body">
                     
                      <table class="table table-bordered">
                        <tr>
                          <td width="35%">NAMA</td>
                          <td width="65%"><?php echo $data_siswa['nama']; ?></td>
                        </tr>
                        <tr>
                          <td>NIM</td>
                          <td><?php echo $data_siswa['nis']; ?></td>
                        </tr>
                        <tr>
                          <td>GURU/MAPEL</td>
                          <td><?php echo $data['nama_guru'] . "/" . $data['nama_mapel']; ?></td>
                        </tr>
                        <tr>
                          <td>UJIAN</td>
                          <td><?php echo $data['nama_ujian']; ?></td>
                        </tr>
                        <tr>
                          <td>SOAL</td>
                          <td><?php echo $data['jumlah_soal']; ?></td>
                        </tr>
                        <tr>
                          <td>WAKTU</td>
                          <td><?php echo $data['waktu']; ?> menit</td>
                        </tr>
                        <tr>
                          <td>TOKEN</td>
                          <td><input type="text" name="token" id="token_ujian" required="true" class="form-control col-md-3"></td>
                        </tr>
                      </table>
                    </div>
                  </div>
                </div>
                <div class="col-md-5">
                  <div class="panel panel-default">
                    <div class="panel-body">
                      <div class="alert alert-success">
                        WAKTU MENGERJAKAN UJIAN PADA SAAT TOMBOL <b>"MULAI"</b> BERWARNA HIJAU!</br>
                        <hr>
                        <b>DAN, HARAP DIPERHATIKAN JADWAL UJIAN SERTA PEMILIHAN UJIAN!</b>
                      </div>

                      <?php 
                      if ($status == 0){
                        echo '
                        <button class="alert alert-warning"> Jadwal Tes di muai pada tanggal <strong>'.  date('d M Y - H:i', strtotime($data['tgl_mulai'])).' 
                        </strong></button>';
                      } else if ($status == 1){
                        echo '<button onclick="mulai_ujian()" class="btn btn-success btn-lg">  <strong> mulai </strong>  </button>';
                      }
                      
                    
                      ?>

                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script>
    function mulai_ujian()
    {
      if(confirm('Anda yakin ingin memulai ujian ini?'))
      {
        var token = $('#token_ujian').val();
        window.location="proses.php?proses=mulai_ujian&token="+token+"&id_tes=<?= $data['id_tes_token'] ?>"
      }
    }
  </script>

  

  <?php 
  include "../script.php"; 
}
  ?>
</body>
</html>
