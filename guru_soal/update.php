<?php 
require_once '../database/config.php';
$hal = 'soal';
if (isset($_SESSION['peran']))
{
  if ($_SESSION['peran']!='guru') 
  {
  echo "<script>window.location='../auth/logout.php';</script>";
  }
  
}
else
{
  echo "<script>window.location='../auth/logout.php';</script>";
}

$nip = $_SESSION['user'];


?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Guru Panel | Soal </title>

<?php 
include "../linksheet.php";
?>
<link rel="stylesheet" href="../assets_adminlte/dist/ckeditor/css.css">

</head>

<body class="hold-transition sidebar-mini">
<div class="wrapper">
<?php
include '../navbar.php';
?>

<!-- Sidebar -->
<div class="sidebar">
  <!-- Sidebar Menu -->
  <nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

<?php
include '../sidebar_guru.php';

$id         = $_GET['id'];
$nip        = $_SESSION['user'];
$query      = "SELECT * FROM tbl_soal WHERE id = '$id'";
$sql_soal   = mysqli_query($con, $query) or die(mysqli_error($con));
$data_soal  = mysqli_fetch_array($sql_soal);
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <br>
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
              <div class="card-header"  style="background-color:#365E32">
              <font color="ffffff">
              <h3 class="card-title"><i class="nav-icon fas fa-folder"></i> Edit Soal</h3>
              </font>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
              <form action="" method="POST">
                  <div class="form-group">
                    <input type="text" name="nip" class="form-control" value="<?= $nip;?>" hidden>
                  </div>

                  <div class="form-group">
                    <label for="mapel">Mata Pelajaran</label>
                    <select class="form-control" name="mapel" id="mapel" required>
                      <option value="" selected disabled>-- Pilih Mata Pelajaran --</option>
                      <?php
                      $sql_mapel = mysqli_query($con, "SELECT * FROM tbl_mapel, tbl_guru_mapel WHERE nip_guru = $nip AND tbl_mapel.id = tbl_guru_mapel.id_mapel") or die(mysqli_error($con));
                      while ($data_mapel = mysqli_fetch_array($sql_mapel)) {
                        $selected = ($data_mapel['id_mapel'] == $data_soal['id_mapel']) ? 'selected' : '';
                        ?>
                        <option value="<?= $data_mapel['id_mapel']; ?>" <?= $selected; ?>><?= $data_mapel['nama']; ?></option>
                        <?php
                      }
                      ?>
                    </select>
                  </div>

                  <div class="form-group">
                    <label for="kelas">Kelas</label>
                    <select class="form-control" name="kelas" id="kelas" required>
                      <option value="" selected disabled>-- Pilih Kelas --</option>
                      <option value="X" <?= ($data_soal['kelas'] == 'X') ? 'selected' : ''; ?>>X</option>
                      <option value="XI" <?= ($data_soal['kelas'] == 'XI') ? 'selected' : ''; ?>>XI</option>
                      <option value="XII" <?= ($data_soal['kelas'] == 'XII') ? 'selected' : ''; ?>>XII</option>
                    </select>
                  </div>

                  <div class="form-group">
                    <div class="row">
                      <div class="col-lg-3">
                        <label for="soal">Soal</label>
                      </div>
                      <div class="col-lg-9">
                        <div id="editor-soal"><?= $data_soal['soal']; ?></div>
                        <textarea name="soal" id="soal" style="display:none;"><?= $data_soal['soal']; ?></textarea>
                      </div>
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="row">
                      <div class="col-lg-3">
                        <label for="jawaban_a">Jawaban A</label>
                      </div>
                      <div class="col-lg-9">
                        <div id="editor-a"><?= $data_soal['opsi_a']; ?></div>
                        <textarea name="jawaban_a" id="jawaban_a" style="display:none;"><?= $data_soal['opsi_a']; ?></textarea>
                      </div>
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="row">
                      <div class="col-lg-3">
                        <label for="jawaban_b">Jawaban B</label>
                      </div>
                      <div class="col-lg-9">
                        <div id="editor-b"><?= $data_soal['opsi_b']; ?></div>
                        <textarea name="jawaban_b" id="jawaban_b" style="display:none;"><?= $data_soal['opsi_b']; ?></textarea>
                      </div>
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="row">
                      <div class="col-lg-3">
                        <label for="jawaban_c">Jawaban C</label>
                      </div>
                      <div class="col-lg-9">
                        <div id="editor-c"><?= $data_soal['opsi_c']; ?></div>
                        <textarea name="jawaban_c" id="jawaban_c" style="display:none;"><?= $data_soal['opsi_c']; ?></textarea>
                      </div>
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="row">
                      <div class="col-lg-3">
                        <label for="jawaban_d">Jawaban D</label>
                      </div>
                      <div class="col-lg-9">
                        <div id="editor-d"><?= $data_soal['opsi_d']; ?></div>
                        <textarea name="jawaban_d" id="jawaban_d" style="display:none;"><?= $data_soal['opsi_d']; ?></textarea>
                      </div>
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="row">
                      <div class="col-lg-3">
                        <label for="jawaban_e">Jawaban E</label>
                      </div>
                      <div class="col-lg-9">
                        <div id="editor-e"><?= $data_soal['opsi_e']; ?></div>
                        <textarea name="jawaban_e" id="jawaban_e" style="display:none;"><?= $data_soal['opsi_e']; ?></textarea>
                      </div>
                    </div>
                  </div>

                  <!-- Ulangi pola ini untuk jawaban B, C, D, dan E -->

                  <div class="form-group">
                    <div class="row">
                      <div class="col-lg-3">
                        <label for="jawaban">Kunci Jawaban</label>
                      </div>
                      <div class="col-lg-6">
                        <select class="form-control" name="jawaban" id="jawaban" required>
                          <option value="" selected disabled>-- Pilih kunci jawaban --</option>
                          <option value="A" <?= ($data_soal['jawaban'] == 'A') ? 'selected' : ''; ?>>A</option>
                          <option value="B" <?= ($data_soal['jawaban'] == 'B') ? 'selected' : ''; ?>>B</option>
                          <option value="C" <?= ($data_soal['jawaban'] == 'C') ? 'selected' : ''; ?>>C</option>
                          <option value="D" <?= ($data_soal['jawaban'] == 'D') ? 'selected' : ''; ?>>D</option>
                          <option value="E" <?= ($data_soal['jawaban'] == 'E') ? 'selected' : ''; ?>>E</option>
                        </select>
                      </div>
                      <div class="col-lg-3">
                        <button type="submit" class="btn btn-primary" name="editdata"><i class="nav-icon fas fa-plus"></i>Edit Data</button>
                      </div>
                    </div>
                  </div>
                </form>
              </div>
              <!-- /.card-body -->
              </div>
              <!-- /.card -->
            </div>
            </div>
      </div>
      <!-- /.container-fluid -->
    </div>
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  <?php 
include "../footer.php";
?>

</div>
<!-- ./wrapper -->

<?php 
include "../script.php";

?>
 <script src="../assets_adminlte/js/sweetalert.js"></script>
<?php
if(isset($_POST['editdata'])) {
  $nip   = trim(mysqli_real_escape_string($con, $_POST['nip']));
  $mapel = trim(mysqli_real_escape_string($con, $_POST['mapel']));
  $kelas = trim(mysqli_real_escape_string($con, $_POST['kelas']));
  $soal  = trim(mysqli_real_escape_string($con, $_POST['soal']));
  $jawaban_a = trim(mysqli_real_escape_string($con, $_POST['jawaban_a']));
  $jawaban_b = trim(mysqli_real_escape_string($con, $_POST['jawaban_b']));
  $jawaban_c = trim(mysqli_real_escape_string($con, $_POST['jawaban_c']));
  $jawaban_d = trim(mysqli_real_escape_string($con, $_POST['jawaban_d']));
  $jawaban_e = trim(mysqli_real_escape_string($con, $_POST['jawaban_e']));
  $kunci_jawaban = trim(mysqli_real_escape_string($con, $_POST['jawaban']));

  $file      = '-';
  $type_file = '-';
  $date      = date('Y-m-d H:i:s');
  $benar     = 0;
  $salah     = 0;

  $query_update = "UPDATE tbl_soal SET
  id_guru = '$nip',
  id_mapel='$mapel', 
  kelas='$kelas',
  file ='$file',
  tipe_file ='$type_file', 
  soal='$soal', 
  opsi_a='$jawaban_a', 
  opsi_b='$jawaban_b', 
  opsi_c='$jawaban_c', 
  opsi_d='$jawaban_d', 
  opsi_e='$jawaban_e', 
  jawaban='$kunci_jawaban', 
  tgl_input='$date' WHERE id = '$id'";
  $sql_update   = mysqli_query($con, $query_update) or die(mysqli_error($con));
  if ($sql_update) {
    echo '
              <script>
             swal("Berhasil", "Data soal telah berhasil diedit", "success");
             
             setTimeout(function(){ 
             window.location.href = "../guru_soal";

             }, 1000);
           </script>
          ';
      
  } else {
    echo '
              <script>
             swal("Gagal", "Data soal gagal diedit", "error");
             
             setTimeout(function(){ 
             window.location.href = "../update.php?id=";

             }, 1000);
           </script>
          ';
      
  }
   
}
?>
<script type="importmap">
            {
                "imports": {
                  "ckeditor5": "https://cdn.ckeditor.com/ckeditor5/42.0.2/ckeditor5.js"
                }
            }
        </script>

        <script type="module">
            import {
                ClassicEditor,
                Essentials,
                Bold,
                Italic,
                Font,
                Paragraph
            } from 'ckeditor5';

            const editors = [
                {selector: '#editor-soal', name: 'soal'},
                {selector: '#editor-a', name: 'jawaban_a'},
                {selector: '#editor-b', name: 'jawaban_b'},
                {selector: '#editor-c', name: 'jawaban_c'},
                {selector: '#editor-d', name: 'jawaban_d'},
                {selector: '#editor-e', name: 'jawaban_e'}
            ];

            editors.forEach(editor => {
                ClassicEditor
                    .create(document.querySelector(editor.selector), {
                        plugins: [Essentials, Bold, Italic, Font, Paragraph],
                        toolbar: {
                            items: [
                                'undo', 'redo', '|', 'bold', 'italic', '|',
                                'fontSize', 'fontFamily', 'fontColor', 'fontBackgroundColor'
                            ]
                        }
                    })
                    .then(editorInstance => {
                        window[editor.name] = editorInstance;

                        // Update hidden textarea when content changes
                        editorInstance.model.document.on('change:data', () => {
                            document.getElementById(editor.name).value = editorInstance.getData();
                        });
                    })
                    .catch(error => {
                        console.error(error);
                    });
            });
        </script>

</body>
</html>
