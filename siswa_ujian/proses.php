<?php
require_once '../database/config.php';
if (isset($_SESSION['peran'])) {
  if ($_SESSION['peran'] != 'siswa') {
    echo "<script>window.location='../auth/logout.php';</script>";
  }
} 
else {
  echo "<script>window.location='../auth/logout.php';</script>";
}

if(!empty($_GET['proses']))
{
	$proses = $_GET['proses'];

	#==PROSES
	if($proses == 'mulai_ujian')
	{
		$token 		= @$_GET['token'];
		$id_tes 	= @$_GET['id_tes'];
		$id_user 	= $_SESSION['user'];

		$cek_token = mysqli_query($con, "SELECT id FROM tbl_guru_tes WHERE token='".$token."' AND id='".$id_tes."' ") or die(mysqli_error($con));
		if(mysqli_num_rows($cek_token) > 0)
		{
			$data_ujian = mysqli_fetch_assoc($cek_token);

			$cek_ikut_ujian = mysqli_query($con, "SELECT * FROM tbl_ikut_ujian WHERE id_tes='".$id_tes."' AND id_user='".$id_user."' ") or die(mysqli_error($con));
			if(mysqli_num_rows($cek_ikut_ujian) == 0)
			{
				$tambah = mysqli_query($con, "INSERT INTO tbl_ikut_ujian SET 
					id_tes = '$id_tes',
					id_user = '$id_user',
					tgl_mulai = '".date('Y-m-d H:i:s')."',
					status = 'ujian'
				") or die(mysqli_error($con));
			}

			header('Location: '. 'isi_nilai.php?id='.$id_tes); 
		}
		else{

			header('Location: '. 'ujian.php?id='.$id_tes); 
		}
	}










	#==PROSES
	else if($proses == 'simpan_jawaban')
	{
		$id_tes  	= @$_GET['id_tes'];
		$id_soal 	= @$_GET['id_soal'];
		$jawaban 	= @$_GET['jawaban'];
		$id_user 	= $_SESSION['user'];

		$cek_jawaban = mysqli_query($con, "SELECT * FROM tbl_jawaban WHERE 
			id_tes='$id_tes' 
			AND id_user='$id_user' 
			AND id_soal='$id_soal' 
		");

		if(mysqli_num_rows($cek_jawaban) == 0)
		{
			$sql = mysqli_query($con, "INSERT INTO tbl_jawaban SET 
				id_tes = '$id_tes',
				id_user = '$id_user',
				id_soal = '$id_soal',
				jawaban = '$jawaban'
			");
		}
		else{
			
			$data_jawaban = mysqli_fetch_assoc($cek_jawaban);
			$sql = mysqli_query($con, "UPDATE tbl_jawaban SET jawaban='$jawaban' WHERE id='".$data_jawaban['id']."' ");
		}

		if($sql){
			echo 'success';
		}
		else{
			echo mysqli_error($con);
		}
	}










	#==PROSES
	else if($proses == 'selesai_ujian')
	{
		$id_tes  	 	= @$_GET['id_tes'];
		$id_user  		= $_SESSION['user'];
		$selesai 		= 'selesai';
		$tgl_selesai	= date('Y-m-d H:i:s');

		$benar = 0;

		$sql_soaljawab = mysqli_query($con, "SELECT a.id AS id, a.jawaban AS jawaban, c.jawaban AS kunci 
		FROM tbl_jawaban AS a 
		INNER JOIN tbl_guru_tes AS b ON a.id_tes = b.id 
		INNER JOIN tbl_soal AS c ON a.id_soal = c.id
		WHERE a.id_user = '$id_user' AND a.id_tes = '$id_tes' 
		GROUP BY a.id") or die(mysqli_error($con));

		while ($row = mysqli_fetch_assoc($sql_soaljawab)) {
			if ($row['jawaban'] == $row['kunci']) {
				$benar++;
			}
		}
		$row_data 	= mysqli_num_rows($sql_soaljawab);
		$nilai 		= ($benar / $row_data ) * 100;

		$sql   = mysqli_query($con, "UPDATE tbl_ikut_ujian SET jml_benar = '$benar',nilai = '$nilai', status = '$selesai', tgl_selesai = '$tgl_selesai' WHERE id_tes='$id_tes' AND id_user='$id_user' ");


		if($sql){
			header('Location: '. 'ujian.php?id='.$id_tes); 
		}
		else{
			echo mysqli_error($con);
		}
	}
}
else{
	echo "<script>window.location='ujian.php';</script>";
}
?>