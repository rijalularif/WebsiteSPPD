<?php
session_start();
include "../../config/koneksi.php";
$module=$_GET[module];
$act=$_GET[act];
// Update pangkat
if ($module=='pangkat' AND $act=='update') {
  mysqli_query($link, "UPDATE pangkat SET pangkat    = '$_POST[pangkat]'
                WHERE            id_pangkat  = '$_POST[id]'");
  header('location:../../media.php?module='.$module);
}
elseif ($module=='pangkat' AND $act=='hapus') {
	mysqli_query($link, "DELETE FROM pangkat WHERE id_pangkat='$_GET[id]'");
  header('location:../../media.php?module='.$module);
}
elseif ($module=='pangkat' AND $act=='input') {
	mysqli_query($link, "INSERT INTO pangkat(pangkat) 
	VALUES('$_POST[pangkat]')");
  header('location:../../media.php?module='.$module);
}
?>