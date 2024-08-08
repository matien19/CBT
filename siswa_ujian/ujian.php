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
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Guru Panel | Ujian</title>

  <?php 
  include "../linksheet.php"; 
  ?>
  
 </head>
<body>

  <?php
  $id = $_GET['id'];
  $quey_tes = "SELECT a.id_guru, a.tgl_mulai, a.terlambat, a.token, a.nama_ujian, a.jumlah_soal, a.waktu, b.nama AS nama_guru, c.nama AS nama_mapel, CASE
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
    echo '
    <button class="alert alert-warning"> Jadwal Tes di muai pada tanggal <strong>'.  $data['tgl_mulai'].' 
    </strong></button>';
  } 
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
              
            
              <input type="hidden" name="id_ujian" id="id_ujian" value="<?php echo $id; ?>">
              <input type="hidden" name="_token" id="_token" value="<?php echo $data['token']; ?>">
              <input type="hidden" name="_tgl_sekarang" id="_tgl_sekarang" value="<?php echo date('Y-m-d H:i:s'); ?>">
              <input type="hidden" name="_tgl_mulai" id="_tgl_mulai" value="<?php echo $data['tgl_mulai']; ?>">
              <input type="hidden" name="_terlambat" id="_terlambat" value="<?php echo $data['terlambat']; ?>">
              <input type="hidden" name="_statuse" id="_statuse" value="<?php echo $status; ?>">
              <div class="row">
                <div class="col-md-7">
                <a href="../siswa_ujian/" class="btn btn-danger btn-sm"> <i class=""></i> <strong> kembali </strong> </a>
                <br>
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
                          <td><input type="text" name="token" id="token" required="true" class="form-control col-md-3"></td>
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
                        <button class="alert alert-warning"> Jadwal Tes di muai pada tanggal <strong>'.  $data['tgl_mulai'].' 
                        </strong></button>';
                      } else if ($status == 1){
                        echo '
                        <button class="btn btn-success btn-lg">  <strong> mulai </strong>  </button>';
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

  

  <?php 
  include "../script.php"; 
  ?>
</body>
</html>
