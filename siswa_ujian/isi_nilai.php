<?php
require_once '../database/config.php';
if (isset($_SESSION['peran'])) {
  if ($_SESSION['peran'] != 'siswa') {
    echo "<script>window.location='../auth/logout.php';</script>";
  }
} else {
  echo "<script>window.location='../auth/logout.php';</script>";
}

$cek_ikut_ujian = mysqli_query($con, "SELECT * FROM tbl_ikut_ujian WHERE id_tes='".$_GET['id']."' AND id_user='".$_SESSION['user']."' ") or die(mysqli_error($con));
if(mysqli_num_rows($cek_ikut_ujian) == 0)
{
  header('Location: '. 'ujian.php?id='.$_GET['id']); 
}

$data_ikut_ujian = mysqli_fetch_assoc($cek_ikut_ujian);

if($data_ikut_ujian['status'] == 'selesai'){
  header('Location: '. 'index.php?id='.$_GET['id']); 
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Siswa Panel | Isi Jawaban</title>

  <?php 
  include "../linksheet.php"; 
  ?>
  
 </head>
<body>

  <?php
  $id = $_GET['id'];
  $quey_tes = "
    SELECT 
      a.*, 
      b.nama AS nama_guru, 
      c.nama AS nama_mapel, 
      CASE
        WHEN NOW() < a.tgl_mulai THEN 0 
        WHEN NOW() BETWEEN a.tgl_mulai AND a.terlambat THEN 1 
        ELSE 2 END AS statuse 
      FROM 
        tbl_guru_tes a INNER JOIN tbl_guru b ON a.id_guru = b.nip 
        INNER JOIN tbl_mapel c ON a.id_mapel = c.id WHERE a.id = '$id'";

  $sql_tes      = mysqli_query($con, $quey_tes) or die(mysqli_error($con));
  $data         = mysqli_fetch_assoc($sql_tes);

  $status       = $data['statuse'];
  $nis          = $_SESSION['user'];
  $query_siswa  = "SELECT * FROM tbl_siswa WHERE nis = '$nis'";
  $sql_siswa    = mysqli_query($con, $query_siswa) or die(mysqli_error($con));
  $data_siswa   = mysqli_fetch_assoc($sql_siswa);

  if($data_ikut_ujian['tgl_mulai'] < $data['terlambat']){
    $tgl_batas_ujian = $data_ikut_ujian['tgl_mulai'];
  }
  else{
    $tgl_batas_ujian = $data['terlambat'];
  }

  $time_out = date('Y-m-d H:i:s', strtotime('+' . $data['waktu'] . ' minutes', strtotime($tgl_batas_ujian)));

  if ($status == 2){
    echo '
    <button class="alert alert-warning"> Jadwal Tes di muai pada tanggal <strong>'.  date('d M Y - H:i', strtotime($data['tgl_mulai'])).' 
    </strong></button>';
  } 
  ?>

  <div class="content">
    <br>
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-4">
          <div class="card">
            <div class="card-header" style="background-color:#365E32">
              <font color="ffffff">
                <h3 class="card-title"><i class="nav-icon fas fa-book-open"></i> Identitas</h3>
            </div>
            </font>
            <div class="card-body">
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
                      <td>Sisa Waktu</td>
                      <td><b id="count_down"></b></td>
                    </tr>
                    <tr>
                      <td colspan="2">
                        <a href="proses.php?proses=selesai_ujian&id_tes=<?= $id ?>" onclick="return confirm('Apakah anda yakin ingin menyelesaikan ujian ini?')">
                          <button type="button" class="btn btn-success btn-block"><i class="fas fa-check"></i> SELESAI UJIAN</button>
                        </a>
                      </td>
                    </tr>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-8">
          <div class="card">
            <div class="card-header" style="background-color:#365E32">
              <font color="ffffff">
                <h3 class="card-title"><i class="nav-icon fas fa-book-open"></i> Soal Ujian</h3>
            </div>
            </font>
            <div class="card-body">
              <?php
              $data_soal = mysqli_query($con, "SELECT * FROM tbl_soal WHERE id_mapel='".$data['id_mapel']."' AND kelas='".$data['kelas']."' ") or die(mysqli_error($con));

              if(mysqli_num_rows($data_soal) > 0)
              {
                $no_soal = 1;
                while ($row_soal = mysqli_fetch_array($data_soal)) 
                {
                  $cek_jawaban = mysqli_query($con, "SELECT * FROM tbl_jawaban WHERE 
                    id_tes='".$id."' 
                    AND id_user='".$nis."' 
                    AND id_soal='".$row_soal['id']."' 
                  ") or die(mysqli_error($con));

                  if(mysqli_num_rows($cek_jawaban) > 0){
                    $data_jawaban = mysqli_fetch_assoc($cek_jawaban);
                    $jawaban = $data_jawaban['jawaban'];
                  }
                  else{
                    $jawaban = '';
                  }
                  ?>
                  <div class="card">
                    <div class="card-header bg-info">
                      <?= $row_soal['soal'] ?>
                    </div>
                    <div class="card-body">
                      <table class="table table-sm">
                        <tr>
                          <td class="pr-3" style="width: 10px;">
                            <button type="button" id="jawaban_A_<?= $row_soal['id'] ?>" onclick="simpan_nilai('<?= $id ?>','<?= $row_soal['id'] ?>', 'A')" class="btn btn-sm btn-<?= $jawaban == 'A' ? 'warning' : 'info' ?> btn-disabled">A</button>
                          </td>
                          <td><?= $row_soal['opsi_a'] ?></td>
                        </tr>
                        <tr>
                          <td class="pr-3">
                            <button type="button" id="jawaban_B_<?= $row_soal['id'] ?>" onclick="simpan_nilai('<?= $id ?>','<?= $row_soal['id'] ?>', 'B')" class="btn btn-sm btn-<?= $jawaban == 'B' ? 'warning' : 'info' ?> btn-disabled">B</button>
                          </td>
                          <td><?= $row_soal['opsi_b'] ?></td>
                        </tr>
                        <tr>
                          <td class="pr-3">
                            <button type="button" id="jawaban_C_<?= $row_soal['id'] ?>" onclick="simpan_nilai('<?= $id ?>','<?= $row_soal['id'] ?>', 'C')" class="btn btn-sm btn-<?= $jawaban == 'C' ? 'warning' : 'info' ?> btn-disabled">C</button>
                          </td>
                          <td><?= $row_soal['opsi_c'] ?></td>
                        </tr>
                        <tr>
                          <td class="pr-3">
                            <button type="button" id="jawaban_D_<?= $row_soal['id'] ?>" onclick="simpan_nilai('<?= $id ?>','<?= $row_soal['id'] ?>', 'D')" class="btn btn-sm btn-<?= $jawaban == 'D' ? 'warning' : 'info' ?> btn-disabled">D</button>
                          </td>
                          <td><?= $row_soal['opsi_d'] ?></td>
                        </tr>
                        <tr>
                          <td class="pr-3">
                            <button type="button" id="jawaban_E_<?= $row_soal['id'] ?>" onclick="simpan_nilai('<?= $id ?>','<?= $row_soal['id'] ?>', 'E')" class="btn btn-sm btn-<?= $jawaban == 'E' ? 'warning' : 'info' ?> btn-disabled">E</button>
                          </td>
                          <td><?= $row_soal['opsi_e'] ?></td>
                        </tr>
                      </table>
                    </div>
                  </div>
              <?php $no_soal++; } } ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script>
    function simpan_nilai(id_tes, id_soal, jawaban) 
    {
      $('#jawaban_'+jawaban+'_'+id_soal).html('<i class="fas fa-spinner fa-pulse"></i>');
      $('.btn-disabled').prop('disabled', true);

      $.ajax({
        url: 'proses.php?proses=simpan_jawaban&id_tes='+id_tes+'&id_soal='+id_soal+'&jawaban='+jawaban,
        type: 'get',
        success: function(response) {
          if(response == 'success')
          {
            document.getElementById("jawaban_A_"+id_soal).classList.replace('btn-warning', 'btn-info');
            document.getElementById("jawaban_B_"+id_soal).classList.replace('btn-warning', 'btn-info');
            document.getElementById("jawaban_C_"+id_soal).classList.replace('btn-warning', 'btn-info');
            document.getElementById("jawaban_D_"+id_soal).classList.replace('btn-warning', 'btn-info');
            document.getElementById("jawaban_E_"+id_soal).classList.replace('btn-warning', 'btn-info');

            setTimeout(function() { 
              var element = document.getElementById("jawaban_"+jawaban+"_"+id_soal);
              element.classList.remove("btn-info");
              element.classList.add("btn-warning");
            }, 100);
          }
          else{
            alert(response);
          }

          $('#jawaban_'+jawaban+'_'+id_soal).html(jawaban);
          $('.btn-disabled').prop('disabled', false);
        }
      });
    }
  </script>


  <script>
    // Set the date we're counting down to
    var countDownDate = new Date("<?= date('M d', strtotime($time_out)).', '.date('Y', strtotime($time_out)).' '.date('H:i:s', strtotime($time_out)) ?>").getTime();

    // Update the count down every 1 second
    var x = setInterval(function() {
      // Get today's date and time
      var now = new Date().getTime();
        
      // Find the distance between now and the count down date
      var distance = countDownDate - now;
        
      // Time calculations for days, hours, minutes and seconds
      var days = Math.floor(distance / (1000 * 60 * 60 * 24));
      var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
      var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
      var seconds = Math.floor((distance % (1000 * 60)) / 1000);
        
      // Output the result in an element with id="count_down"
      // document.getElementById("count_down").innerHTML = days + "d " + hours + "h " + minutes + "m " + seconds + "s ";
      document.getElementById("count_down").innerHTML = hours +':'+ minutes + ':' + seconds;
        
      // If the count down is over, write some text 
      if (distance < 1) {
        clearInterval(x);
        // document.getElementById("count_down").innerHTML = "EXPIRED";
        window.location='proses.php?proses=selesai_ujian&id_tes=<?= $id ?>';
      }
    }, 1000);
  </script>
  <?php 
  include "../script.php"; 
  ?>
</body>
</html>
