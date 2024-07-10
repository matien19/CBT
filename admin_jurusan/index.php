<?php 
require_once '../database/config.php';
$hal = 'jurusan';
if (isset($_SESSION['peran']))
{
  if ($_SESSION['peran']!='admin') 
  {
  echo "<script>window.location='../auth/logout.php';</script>";
  }
  
}
else
{
  echo "<script>window.location='../auth/logout.php';</script>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin Panel | Jurusan </title>

<?php 
include "../linksheet.php";
?>
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
include '../sidebar_admin.php';
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
                <h3 class="card-title"><i class="nav-icon fas fa-project-diagram"></i> Data jurusan</h3>
                </div>
                </font>
                <!-- /.card-header -->
                <div class="card-body">
                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal-tambahdata" style="background-color:#86090f">
                <i class="nav-icon fas fa-plus"></i>  Tambah Data
                </button>

                  <table id="example1" class="table table-bordered table-striped table-sm">
                    <thead>
                    <tr>
                    <th style="width : 10%"; >No</th>
                    <th><center>Kode Jurusan</center></th>
                    <th><center>jurusan</center></th>
                    <th style="width : 40%"; ><center>Aksi</center></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                      $no = 1;
                      $query = "SELECT * FROM tbl_jurusan";
                      $sql_jurusan = mysqli_query($con, $query) or die (mysqli_error($con));
                          if (mysqli_num_rows($sql_jurusan) > 0)
                          {
                            while($data = mysqli_fetch_array($sql_jurusan))
                            {
                              $kd_jurusan = $data['kode_jurusan'];
                                ?>
                            <tr>
                                 <td>
                                  <?=$no++;?>
                                  </td>
                                  <td>
                                 <center>
                                   <h6>
                                   <?=$kd_jurusan; ?>
                                   
                                 </center>
                                  <td>
                                 <center>
                                   <h6>
                                   <?=$data['nama'];?>
                                   
                                 </center>
                                 </td>
                                <td>
                                  <center>
                                <button class="btn btn-primary btn-sm"  data-toggle="modal" data-target="#modal-editdata" data-kd_jurusan="<?=$kd_jurusan;?>" data-jurusan="<?=$data['nama'];?>">
                                  <i class="fas fa-edit"></i>
                                   Edit 
                                </button> 
                                   
                                <a href="delete.php?id=<?=$kd_jurusan;?>" class="btn btn-danger btn-sm" onclick="return confirm('Anda akan menghapus data Jurusan [ <?=$data['nama']; ?> ] ?')">
                                  <i class="fas fa-trash"></i>
                                   Hapus
                                </a> 
                              </center>
                                </td>
                                   
                              </tr>

                            <?php
                          }

                        }
                        else
                        {
                          echo "<tr><td colspan=\"3\" align=\"center\"><h6>Data Tidak Ditemukan!</h6></td></tr>";
                        }

                    ?>

                   </tbody>
                    <tfoot>

                    </tfoot>
                  </table>
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

<!-- modal tambah data -->
<div class="modal fade" id="modal-tambahdata">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header" style="background-color:#86090f">
              <h5 class="modal-title">
              <font color="ffffff">
              <i class="nav-icon fas fa-plus"></i> 
                Tambah Data Jurusan
              </font>
              </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form class="form-horizontal" action="add.php" method="POST" >
            <div class="modal-body">
              <div class="form-group">
                <label for="kd_jurusan">Kode Jurusan</label>
                <input type="text" name="kd_jurusan" class="form-control"  placeholder="Masukan kode jurusan">
              </div>
              <div class="form-group">
                <label for="jurusan">Jurusan</label>
                <input type="text" name="jurusan" class="form-control"  placeholder="Masukan jurusan">
              </div>
            </div>
            <div class="modal-footer pull-right">
              <button type="submit" class="btn btn-danger" name="tambahdata" style="background-color:#86090f"><i class="nav-icon fas fa-plus"></i>Tambah Data</button>
              </form>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
</div>

<!-- modal edit data mhs -->
<div class="modal fade" id="modal-editdata">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header" style="background-color:#86090f">
              <h5 class="modal-title">
              <font color="ffffff">
              <i class="nav-icon fas fa-edit"></i> 
                Edit Data Jurusan
              </font>

              </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form class="form-horizontal" action="update.php" method="POST" >
            <div class="modal-body">
            <div class="form-group">
            <input type="text" name="kd_jurusan" class="form-control" hidden>
                <label for="jurusan">Kode Jurusan</label>
                <input type="text" name="kode" class="form-control" disabled>
              </div>
            <div class="form-group">
                <label for="jurusan">Jurusan</label>
                <input type="text" name="jurusan" class="form-control">
              </div>
              
            </div>
            <div class="modal-footer pull-right">
              <button type="submit" class="btn btn-danger" name="editdata" style="background-color:#86090f"><i class="nav-icon fas fa-edit"></i>Edit Data</button>
              </form>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
</div>
      <!-- /.modal -->

     
</div>
<!-- ./wrapper -->

<?php 
include "../script.php";
?>

<script type="text/javascript">
$('#modal-editdata').on('show.bs.modal', function(e) {

    //get data-id attribute of the clicked element
     var id           = $(e.relatedTarget).data('id');
     var kd_jurusan         = $(e.relatedTarget).data('kd_jurusan');
     var jurusan         = $(e.relatedTarget).data('jurusan');
    
     
     $(e.currentTarget).find('input[name="id"]').val(id);
     $(e.currentTarget).find('input[name="kd_jurusan"]').val(kd_jurusan);
     $(e.currentTarget).find('input[name="kode"]').val(kd_jurusan);
     $(e.currentTarget).find('input[name="jurusan"]').val(jurusan);
   

});
</script>

</body>
</html>
