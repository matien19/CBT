<?php
require_once '../database/config.php';

$nip = $_POST['nip'];
$output = '<div class="d-flex flex-wrap justify-content-around">
<input type="number" name="nip" class="form-control" value="'.$nip.'" hidden>
';

$mapel = mysqli_query($con, "SELECT * FROM tbl_mapel") or die(mysqli_error($con));
while($data = mysqli_fetch_array($mapel)) {
  $checked = mysqli_query($con, "SELECT * FROM tbl_guru_mapel WHERE nip_guru = '$nip' AND id_mapel = '".$data['id']."'") or die(mysqli_error($con));
  $isChecked = mysqli_num_rows($checked) > 0 ? 'checked' : '';
  $output .= '

    <div class="form-check">
      <input class="form-check-input" type="checkbox" name="mapel[]" value="'.$data['id'].'" '.$isChecked.'>
      <label class="form-check-label">'.$data['nama'].'</label>
    </div>';
}

$output .= '</div>';
echo $output;
?>
