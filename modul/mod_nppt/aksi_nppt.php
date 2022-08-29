<?php
session_start();
error_reporting(0);
include "../../config/koneksi.php";
$module=$_GET['module'];
$act=$_GET['act'];
if ($module=='nppt' AND $act=='hapus') {
	mysqli_query($link, "DELETE FROM nppt WHERE id_nppt='$_GET[id]'");
	mysqli_query($link, "DELETE FROM detail_nppt WHERE id_nppt = $_GET[id]");
	header('location:../../media.php?module='.$module);
}
elseif ($module=='nppt' AND $act=='editstatus') {
	if($_GET['status']=='Y') {
		$sql=mysqli_query($link, "SELECT * FROM nppt WHERE id_nppt='$_GET[id]'");
		$r=mysqli_fetch_array($sql);
		$no_spt= '../SPT/Dis-Kominfo-';
		$tanggal= date("d/m/Y");
		$dasar_hukum = "....";
		mysqli_query($link, "INSERT INTO spt (id_nppt,no_spt,id_pegawai,tugas,tgl_spt,dasar_hukum)
		values ('$_GET[id]',
				'$no_spt',
				'$r[id_pegawai]',
				'$r[maksud]',
				'$tanggal',
				'$dasar_hukum')");
		mysqli_query($link, "UPDATE nppt SET status='Y' WHERE id_nppt='$_GET[id]'");
	}
	else {
		mysqli_query($link, "UPDATE nppt SET status='N' WHERE id_nppt='$_GET[id]'");
	}
	header('location:../../media.php?module='.$module);
}
elseif ($module=='nppt' AND $act=='input') {
	$banyak_pegawai = count($_POST['id_pegawai']);
	$hasil_cek = 0;
	$error = 1;
	$cek_tabel_pegawai = mysqli_query($link, "SELECT COUNT(id_detail) AS id FROM detail_nppt");
	$hasil_perhitungan = mysqli_fetch_array($cek_tabel_pegawai);
	if($hasil_perhitungan['id'] == 0) {
		$hasil_cek = 1;
		$banyak_pegawai = 1;
	}
	else {
		foreach($_POST['id_pegawai'] as $p) {
			$query_cek = mysqli_query($link, "SELECT * 
			FROM nppt a
			JOIN detail_nppt b ON a.id_nppt = b.id_nppt
			WHERE b.id_pegawai = $p
			AND DATE('".$_POST['tgl_pergi']."') <= a.tgl_kembali
			AND DATE('".$_POST['tgl_pergi']."') >= a.tgl_pergi");
			$baris = mysqli_num_rows($query_cek);
			if($baris != 1) {
				$hasil_cek ++;
			}
		}
	}
	if($hasil_cek == $banyak_pegawai) {
		$error = 0;
		$value = (count($_POST['id_pegawai']) > 0) ? implode('-', $_POST['id_pegawai']) : ""; 
		$transportasi = (count($_POST['id_transportasi']) > 0) ? implode('-', $_POST['id_transportasi']) : ""; 
		//Cek Pegawai Yang Berangkat Pada Tanggal Yang Sama
		$t=mysqli_fetch_array(mysqli_query($link, "SELECT * FROM nppt WHERE id_pegawai Like '%$value%' ORDER BY tgl_kembali DESC"));
		$tanggal3 = "$_POST[tgl_pergi]";
		$tanggal1 = "$t[tgl_pergi]";
		$tanggal2 = "$t[tgl_kembali]";
		if ($transportasi == "") {
		echo "<script>alert('Pilih Transportasi Yang digunakan');window.location='../../media.php?module=tambahnppt'</script>";
		}
		else {
			mysqli_query($link, "INSERT INTO nppt(id_pegawai,id_tujuan,maksud,id_transportasi,lama,tgl_pergi,tgl_kembali,tgl_dibuat, id_pegawai_perintah) 
			VALUES(	'$value',
					'$_POST[tujuan]',
					'$_POST[maksud]',
					'$transportasi',
					'$_POST[lama]',
					'$_POST[tgl_pergi]',
					'$_POST[tgl_kembali]',
					'$_POST[tgl_dibuat]', 
					$_POST[id_pemimpin])");
			$id_nppt = mysqli_insert_id();
			foreach($_POST['id_pegawai'] as $d) {
				if($_POST['id_pemimpin'] == $d) {
					mysqli_query($link, "INSERT INTO detail_nppt (id_nppt, id_pegawai, status_perintah) VALUES ($id_nppt, $d, 'Perintah')");
				}
				else {
					mysqli_query($link, "INSERT INTO detail_nppt (id_nppt, id_pegawai, status_perintah) VALUES ($id_nppt, $d, 'Pengikut')");
				}
			}
		}
	}
	if($error == 1) {
		header('location:../../media.php?module=tambahnppt&hasil_cek=1');
	}
	else {
		header('location:../../media.php?module='.$module);
	}
}
elseif ($module=='nppt' AND $act=='update') {
	// Proses cek pegawai
	$banyak_pegawai = count($_POST['id_pegawai']);
	$hasil_cek = 0;
	$error = 1;
	foreach($_POST['id_pegawai'] as $p) {
		$query_cek = mysqli_query($link, "SELECT * 
		FROM nppt a
		JOIN detail_nppt b ON a.id_nppt = b.id_nppt
		WHERE b.id_pegawai = $p
		AND DATE('".$_POST['tgl_pergi']."') <= a.tgl_kembali
		AND DATE('".$_POST['tgl_pergi']."') >= a.tgl_pergi AND detail_nppt.id_nppt != $_POST[id]");
		$baris = mysqli_num_rows($query_cek);
		if($baris != 1) {
			$hasil_cek++;
		}
	}
	// akhir dari proses cek pegawai
	if($hasil_cek == $banyak_pegawai) {
	$error = 0;
	// proses simpan data
	$value = (count($_POST['id_pegawai']) > 0) ? implode('-', $_POST['id_pegawai']) : ""; 
	$transportasi = (count($_POST['id_transportasi']) > 0) ? implode('-', $_POST['id_transportasi']) : ""; 
	mysqli_query($link, "UPDATE nppt SET	id_pegawai			='$value',
									id_tujuan			='$_POST[tujuan]',
									maksud				='$_POST[maksud]',
									id_transportasi		='$transportasi',
									lama				='$_POST[lama]',
									tgl_pergi			='$_POST[tgl_pergi]',
									tgl_kembali			='$_POST[tgl_kembali]',
									tgl_dibuat			='$_POST[tgl_dibuat]',
									id_pegawai_perintah	= $_POST[id_pemimpin] 
									WHERE id_nppt		='$_POST[id]'");
	mysqli_query($link, "DELETE FROM detail_nppt WHERE id_nppt = $_POST[id]");
	foreach($_POST['id_pegawai'] as $d) {
		if($_POST['id_pemimpin'] == $d) {
			mysqli_query($link, "INSERT INTO detail_nppt (id_nppt, id_pegawai, status_perintah) VALUES ($_POST[id], $d, 'Perintah')");
		}
		else {
			mysqli_query($link, "INSERT INTO detail_nppt (id_nppt, id_pegawai, status_perintah) VALUES ($_POST[id], $d, 'Pengikut')");
		}
	}
	// akhir dari proses simpan data
	}	
	if($error == 1) {
		header('location:../../media.php?module=nppt&act=editnppt&id='.$_POST['id'].'&hasil_cek=1');
	}
	else {
		header('location:../../media.php?module='.$module);
	}
}
?>