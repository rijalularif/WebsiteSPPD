<?php
session_start();
include "../../config/koneksi.php";
$module=$_GET[module];
$act=$_GET[act];
// Update pegawai
if ($module=='pegawai' AND $act=='update') {
	mysqli_query($link, "UPDATE pegawai SET
		nip			= '$_POST[nip]',
		nama		= '$_POST[nama]',
		id_pangkat	= '$_POST[id_pangkat]',
		id_jabatan	= '$_POST[id_jabatan]',
		unitkerja	= '$_POST[unitkerja]'
	WHERE	id_pegawai	= '$_POST[id]'");
	header('location:../../media.php?module='.$module);
}
elseif ($module=='pegawai' AND $act=='hapus') {
	mysqli_query($link, "DELETE FROM pegawai WHERE id_pegawai='$_GET[id]'");
	header('location:../../media.php?module='.$module);
}
elseif ($module=='pegawai' AND $act=='input') {
	mysqli_query($link, "INSERT INTO pegawai(nip,nama,id_pangkat,id_jabatan,unitkerja,username,password)
	VALUES(	'$_POST[nip]',
			'$_POST[nama]',
			'$_POST[id_pangkat]',
			'$_POST[id_jabatan]',
			'$_POST[unitkerja]',
			'$_POST[nip]',
			'$_POST[nip]')");
	header('location:../../media.php?module='.$module);
}
?>