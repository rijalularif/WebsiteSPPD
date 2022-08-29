<?php

session_start();
include "../../config/koneksi.php";
include "../../config/library.php";
$module=$_GET[module];
$act=$_GET[act];

if ($module=='lpd' AND $act=='hapus') {
	mysqli_query($link, "DELETE FROM lpd WHERE id_lpd='$_GET[id]'");
	header('location:../../media.php?module='.$module);
}

elseif ($module=='lpd' AND $act=='input') {
	mysqli_query($link, "INSERT INTO lpd(id_spt,id_pegawai,id_pangkat,id_jabatan,hasil,hari,tanggal) VALUES(
		'$_POST[id_spt]',
		'$_POST[id_pegawai]',
		'$_POST[id_pangkat]',
		'$_POST[id_jabatan]',
		'$_POST[hasil]',
		'$hari_ini',
		'$tgl_sekarang')");
	header('location:../../media.php?module='.$module);
}

elseif ($module=='lpd' AND $act=='update') {
	mysqli_query($link, "UPDATE lpd SET 
		hasil	= '$_POST[hasil]',
		hari	= '$hari_ini',
		tanggal	= '$tgl_sekarang'
	WHERE
	id_lpd		= '$_POST[id]'");
	header('location:../../media.php?module='.$module);
}

?>
