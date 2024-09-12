<?php 
require_once '../database/config.php';
require_once '../assets_adminlte/dist/fpdf/fpdf.php';

class PDF extends FPDF
{
// Page header
function Header()
{
    // Logo
    $this->Image('../img/maarif.jpg',10,10,20);
    // Arial bold 15
    $this->SetFont('Arial','',14);
    // Move to the right
    $this->Cell(80);
    // Title
    $this->Cell(30,6,"Lembaga Pendidikan Ma'arif NU Kab. Brebes",0,1,"C");
    $this->SetFont('Arial','B',16);
    $this->Cell(80);
    $this->Cell(30,6,"SMK MA'ARIF NU 01 PAGUYANGAN",0,1,'C');
    $this->Cell(80);
    $this->SetFont('Arial','',8);
    $this->Cell(30,6,'JL.RAYA WINDUAJI PAGUYANGAN, Winduaji, Kec. Paguyangan, Kab. Brebes Prov. Jawa Tengah',0,1,'C');
    $this->Cell(80);
    $this->SetFont('Arial','',8);
    $this->Cell(30,4,'email: maarif@maarif.ac.id, IG: -, twitter: -,',0,1,'C');
    //line
    $this->SetLineWidth(0.6);
    $this->Line(10,40,200,40);
    // Line break
    $this->Ln(10);
}

// Page footer
function Footer()
{
    // Position at 1.5 cm from bottom
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Page number
    $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
}
}
$id = @$_GET['id_ujian'];
$quey_tes = "SELECT a.id, a.kelas, a.nama_ujian, a.jumlah_soal, a.waktu, a.token, a.tgl_mulai, a.terlambat,b.nip, b.nama AS guru, c.nama AS mapel, d.nama AS jurusan FROM tbl_guru_tes AS a INNER JOIN tbl_guru AS b ON a.id_guru = b.nip INNER JOIN tbl_mapel AS c ON a.id_mapel = c.id INNER JOIN tbl_jurusan AS d ON a.kode_jurusan = d.kode_jurusan WHERE a.id = '$id'";
$sql_tes = mysqli_query($con, $quey_tes) or die(mysqli_error($con));


while ($data = mysqli_fetch_array($sql_tes)){
    $kelas = $data['kelas'];
    $nama = $data['nama_ujian'];
    $jumlah_soal = $data['jumlah_soal'];
    $waktu = $data['waktu'];
    $token = $data['token'];
    $tgl_mulai = $data['tgl_mulai'];
    $terlambat = $data['terlambat'];
    $nip = $data['nip'];
    $guru = $data['guru'];
    $mapel = $data['mapel'];
    $jurusan = $data['jurusan'];
}

$tanggal = 'Paguyangan, '. date('d F Y');
// Instanciation of inherited class

    // memanggil library php qrcode
    include "./phpqrcode/qrlib.php"; 

    // nama folder tempat penyimpanan file qrcode
    $penyimpanan = "../guru_pengesahan/qr_pengabsahan/";

    // membuat folder dengan nama "temp"
    if (!file_exists($penyimpanan))
    mkdir($penyimpanan);

    // perintah untuk membuat qrcode dan menyimpannya dalam folder temp
    // atur level pemulihan datanya dengan QR_ECLEVEL_L | QR_ECLEVEL_M | QR_ECLEVEL_Q | QR_ECLEVEL_H
    // atur pixel qrcode pada parameter ke 4
    // atur jarak frame pada parameter ke 5
    $link = 'http://localhost/cbt/guru_pengesahan/keabsahan.php?nama='.$guru.'&nama='.$nama.'&mapel='.$mapel.'&tanggal='.$tanggal;
    $nama_qr = $guru.'-'.$mapel.'-'.$kelas.'-'.$tanggal.'.png';

    QRcode::png($link, $penyimpanan.$nama_qr, QR_ECLEVEL_L, 10, 5); 

    // menampilkan qrcode
    $file_qr = $penyimpanan.$nama_qr;

// Instanciation of inherited class
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial','B',10);
$pdf->Cell(150);
$pdf->Cell(30,8,$tanggal,0,1,'C');
// Title
$pdf->Cell(80);
$pdf->SetFont('Arial','B',14);
$pdf->Cell(30,8,'Laporan Ujian Siswa',0,1,'C');
$pdf->Ln(5);
//tahun akademik
$pdf->SetFont('Arial','B',10);
$pdf->Cell(40,6,'Guru Mapel',0,0,'L');
$pdf->Cell(35,6,': '.$guru.' / '.$nip,0,1,'L');
$pdf->Cell(40,6,'Mata Pelajaran',0,0,'L');
$pdf->Cell(35,6,': '.$mapel,0,1,'L');
$pdf->Cell(40,6,'Kelas',0,0,'L');
$pdf->Cell(35,6,': '.$kelas,0,1,'L');
$pdf->Cell(40,6,'Jurusan',0,0,'L');
$pdf->Cell(35,6,': '.$jurusan,0,1,'L');
$pdf->Ln(7);
//table presensi
$pdf->SetFont('Arial','B',12);
$pdf->Cell(10,6,'No.',1,0,'C');
$pdf->Cell(30,6,'NIM',1,0,'C');
$pdf->Cell(80,6,'Nama Mahasiswa',1,0,'C');
$pdf->Cell(30,6,'Jml Benar',1,0,'C');
$pdf->Cell(25,6,'Nilai',1,1,'C');

$pdf->SetFont('Arial','',12);
$no = 1;
$query_nilai = "SELECT MAX(nilai) AS nilai_tertinggi, MIN(nilai) AS nilai_terendah FROM tbl_ikut_ujian WHERE id_tes = '$id'";
$sql_nilai = mysqli_query($con, $query_nilai) or die(mysqli_error($con));
$data_nilai = mysqli_fetch_array($sql_nilai);

$quey_ikut_ujian = "SELECT a.id_user, a.jml_benar, a.nilai, b.nama FROM tbl_ikut_ujian AS a INNER JOIN tbl_siswa AS b ON a.id_user = b.nis WHERE  a.id_tes = '$id'";
$sql_ikut_ujian = mysqli_query($con, $quey_ikut_ujian) or die(mysqli_error($con));
$rows_ikut_ujian = mysqli_num_rows($sql_ikut_ujian);
if (mysqli_num_rows($sql_ikut_ujian) > 0)
{
    while ($data_peserta = mysqli_fetch_array($sql_ikut_ujian))
    {
        $nim = $data_peserta['id_user'];
        $pdf->Cell(10,6,$no++,1,0,'C');
        $pdf->Cell(30,6,$nim,1,0,'C');     
        $pdf->Cell(80,6,$data_peserta['nama'],1,0,'L');
        $pdf->Cell(30,6,$data_peserta['jml_benar'],1,0,'C');
        $pdf->Cell(25,6,$data_peserta['nilai'],1,1,'C');

        $ket = 'Y';

    }
}
$pdf->Ln();
$pdf->Image($file_qr,160,60,25);
$pdf->Output();
?>
