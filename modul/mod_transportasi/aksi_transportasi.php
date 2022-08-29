<?php
session_start();
include "../../config/koneksi.php";
$module=$_GET[module];
$act=$_GET[act];
// Update transportasi
if ($module=='transportasi' AND $act=='update') {
  mysqli_query($link, "UPDATE transportasi SET transportasi  = '$_POST[transportasi]'
                          WHERE  id_transportasi     = '$_POST[id]'");
  header('location:../../media.php?module='.$module);
}
elseif ($module=='transportasi' AND $act=='hapus') {
	mysqli_query($link, "DELETE FROM transportasi WHERE id_transportasi='$_GET[id]'");
  header('location:../../media.php?module='.$module);
}
elseif ($module=='transportasi' AND $act=='input') {
	mysqli_query($link, "INSERT INTO transportasi(transportasi) 
	VALUES('$_POST[transportasi]')");
  header('location:../../media.php?module='.$module);
}
?>