<?php 
require_once "../database/config.php";
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
      
      if (isset($_POST['ganti_pw']))
      {
        $id = @$_GET['id'];
        $passwordlama      = trim(mysqli_real_escape_string($con, $_POST['passwordlama']));
        $enc_passwordlama = md5($passwordlama);
        $password      = trim(mysqli_real_escape_string($con, $_POST['password']));
        $repassword   = trim(mysqli_real_escape_string($con, $_POST['repassword']));
        $query_user = mysqli_query($con, "SELECT * FROM tbl_user WHERE id='$id'") or die (mysqli_error($con));
        $data = mysqli_fetch_assoc($query_user);
        $passlama_db = $data['password'];

        if ($enc_passwordlama == $passlama_db) {
          if ($password !== $repassword){
            echo '

            <script>
                swal("Chek Password", "Password baru harus Sama!", "warning");
                setTimeout(function(){ 
                window.location.href = "../ganti_pw";
                }, 2000);
            </script>
            ';
          } else
          {
            $pass  = md5($repassword);
  
            mysqli_query($con, "UPDATE tbl_user SET password='$pass' WHERE id='$id'") or die (mysqli_error($con));
            
            echo '

            <script>
                swal("Berhasil", "Password berhasil diganti! Silahkan login kembali..", "success");
                setTimeout(function(){ 
                window.location.href = "../auth/logout.php";
                }, 3000);
            </script>
            ';
          }          
        } else {
          echo '

            <script>
                swal("Password Lama Salah!", "Silahkan hubungi Admin untuk reset Password jika lupa Password", "warning");
                setTimeout(function(){ 
                window.location.href = "../ganti_pw";
                }, 5000);
            </script>
            ';

        }
        
      }
      
    ?>


</script> 
</body>
</html>