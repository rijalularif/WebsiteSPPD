<?php
session_start();
include "../../config/koneksi.php";
$module=$_GET['module'];
$act=$_GET['act'];
if ($module=='sppd' AND $act=='hapus') {
	mysqli_query($link, "DELETE FROM sppd WHERE id_sppd='$_GET[id]'");
	header('location:../../media.php?module='.$module);
}
elseif ($module=='sppd' AND $act=='input') {
	$no_sppd= '../sppd/';
	$tanggal= date("d/m/Y");
	$value = (count($_POST['id_pegawai']) > 0) ? implode('-', $_POST['id_pegawai']) : ""; 
	mysqli_query($link, "INSERT INTO sppd(id_pegawai,id_nppt,no_sppd,pemberi_perintah,instansi,mata_anggaran,keterangan,tgl_sppd) 
	VALUES('$value','$_POST[id_nppt]','$_POST[no_sppd]','$_POST[pemberi_perintah]','$_POST[instansi]','$_POST[mata_anggaran]','$_POST[keterangan]','$tanggal')");
	header('location:../../media.php?module='.$module);
}
elseif ($module=='sppd' AND $act=='update') {
	echo "tes";
	//header('location:../../media.php?module='.$module);	
}
?>