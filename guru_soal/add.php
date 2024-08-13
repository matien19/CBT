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
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <br>
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
              <div class="card-header" style="background-color:#86090f">
              <font color="ffffff">
              <h3 class="card-title"><i class="nav-icon fas fa-folder"></i> Input Soal</h3>
              </font>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
              <form action="" method="POST">
              <div class="form-group">
              <input type="text" name="nip" class="form-control" value="<?= $nip;?>"  hidden>
              </div>

                <div class="form-group">
                <label for="mapel">Mata Pelajaran</label>
                <select class="form-control" name="mapel" id="mapel" required>
                  <option value="" selected disabled> -- Pilih Mata Pelajaran --</option>
                  <?php
                  $sql_mapel = mysqli_query($con, "SELECT * FROM tbl_mapel, tbl_guru_mapel WHERE nip_guru = $nip AND tbl_mapel.id = tbl_guru_mapel.id_mapel") or die(mysqli_error($con));
                  while ($data_mapel = mysqli_fetch_array($sql_mapel)) {
                    ?>
                    <option value="<?= $data_mapel['id_mapel']; ?>"><?= $data_mapel['nama']; ?> </option>
                    <?php
                  }
                  ?>
                </select>
              </div>
              <div class="form-group">

                <label for="kelas">Kelas</label>
                <select class="form-control" name="kelas" id="kelas" required>
                  <option value="" selected disabled>-- Pilih Kelas --</option>
                  <option>X</option>
                  <option>XI</option>
                  <option>XII</option>
                </select>
              </div>
              
              <div class="form-group">
                <div class="row">
                  <div class="col-lg-3">
                    <label for="soal">Soal</label>
                  </div>
                  <div class="col-lg-9">
                    <div id="editor-soal"></div>
                    <textarea name="soal" id="soal" style="display:none;"></textarea>
                  </div>
                </div>
              </div>

              <div class="form-group">
                <div class="row">
                  <div class="col-lg-3">
                    <label for="jawaban_a">Jawaban A</label>
                  </div>
                  <div class="col-lg-9">
                    <div id="editor-a"></div>
                    <textarea name="jawaban_a" id="jawaban_a" style="display:none;"></textarea>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <div class="row">
                  <div class="col-lg-3">
                    <label for="jawaban_b">Jawaban B</label>
                  </div>
                  <div class="col-lg-9">
                    <div id="editor-b"></div>
                    <textarea name="jawaban_b" id="jawaban_b" style="display:none;"></textarea>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <div class="row">
                  <div class="col-lg-3">
                    <label for="jawaban_c">Jawaban C</label>
                  </div>
                  <div class="col-lg-9">
                    <div id="editor-c"></div>
                    <textarea name="jawaban_c" id="jawaban_c" style="display:none;"></textarea>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <div class="row">
                  <div class="col-lg-3">
                    <label for="jawaban_d">Jawaban D</label>
                  </div>
                  <div class="col-lg-9">
                    <div id="editor-d"></div>
                    <textarea name="jawaban_d" id="jawaban_d" style="display:none;"></textarea>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <div class="row">
                  <div class="col-lg-3">
                    <label for="jawaban_e">Jawaban E</label>
                  </div>
                  <div class="col-lg-9">
                    <div id="editor-e"></div>
                    <textarea name="jawaban_e" id="jawaban_e" style="display:none;"></textarea>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <div class="row">
                <div class="col-lg-3">
                  <label for="jawaban">Kunci Jawaban</label>
                </div>
                <div class="col-lg-6">
                  <select class="form-control" name="jawaban" id="jawaban" required>
                    <option value="" selected disabled>-- Pilih kunci jawaban --</option>
                    <option>A</option>
                    <option>B</option>
                    <option>C</option>
                    <option>D</option>
                    <option>E</option>
                  </select>
                </div>
                <div class="col-lg-3">
                <button type="submit" class="btn btn-danger" name="tambahdata" style="background-color:#86090f"><i class="nav-icon fas fa-plus"></i>Tambah Data</button>
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
if(isset($_POST['tambahdata'])) {
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

 
  // Simpan data ke database (tambah query insert di sini)
  $sql       = "INSERT INTO tbl_soal VALUES (null,'$nip','$mapel', '$kelas','$file','$type_file', '$soal', '$jawaban_a', '$jawaban_b', '$jawaban_c', '$jawaban_d', '$jawaban_e', '$kunci_jawaban', '$date')";
  
  if(mysqli_query($con, $sql)) {
    echo '
    <script>
      swal("Berhasil", "Data soal berhasil ditambahkan", "success");
      
      setTimeout(function(){ 
      window.location.href = "../guru_soal";

      }, 1000);
    </script>
    ';
  } else {
    echo '
    <script>
    swal("Gagal", "Data soal gagal ditambahkan "'.mysqli_error($con).', "error");
    
    setTimeout(function(){ 
    window.location.href = "../guru_soal/add.php";

    }, 1000)
  </script>';
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
