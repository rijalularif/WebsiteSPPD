<?php
session_start();
include "../../config/koneksi.php";
$module=$_GET[module];
$act=$_GET[act];
// Update pegawai
if ($module=='ttdkwitansi' AND $act=='update') {
    mysqli_query($link, "UPDATE ttdkwitansi SET kadis			= '$_POST[kadis]',
										nip_kadis		= '$_POST[nip_kadis]',
										bendahara		= '$_POST[bendahara]',
										nip_bendahara	= '$_POST[nip_bendahara]',
										pptk			= '$_POST[pptk]',
										nip_pptk		= '$_POST[nip_pptk]'
								WHERE 	id				= '$_POST[id]'");
	header('location:../../media.php?module='.$module);
}
?>