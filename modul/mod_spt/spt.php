<?php
$aksi="modul/mod_spt/aksi_spt.php";
$print ="modul/mod_spt/cetak.php";
switch($_GET[act]) {
	// Tampil Surat Perintah Tugas
	default:
	if ($_SESSION['level']=="operator") {
		$tampil = mysqli_query($link, "SELECT * FROM spt");
		echo "<h2>SURAT PERINTAH TUGAS</h2>";
		echo "<table id=\"example1\" class=\"table table-bordered table-hover\">
		<thead>
			<tr>
				<th>No</th>
				<th>Nama</th>
				<th>Pangkat</th>
				<th>Jabatan</th>
				<th>Pejabat Perintah</th>
				<th>No SPT</th>
				<th>Diperintahkan Untuk</th>
				</th>
				<th>Dasar Surat Perintah</th>
				<th>Tempat</th>
				<th>Dasar Pembebanan Anggaran</th>
				<th>aksi</th>
				<th>SPPD</th>
			</tr>
		</thead>";
		$no=1;
		echo "<tbody>";
		while ($r=mysqli_fetch_array($tampil)) {
			echo "<tr>";
			echo "<td>$no</td>";
			// Kolom Nama Pegawai
			// Ambil Data Pegawai Per nppt 
			echo "<td>";
			$no_pegawai = 1;
			// Daftar Pegawai
			$data_pegawai = mysqli_query($link, "SELECT detail_nppt.id_pegawai, pegawai.nama, pangkat.pangkat, jabatan.jabatan FROM detail_nppt 
				JOIN pegawai ON detail_nppt.id_pegawai = pegawai.id_pegawai 
				JOIN pangkat ON pegawai.id_pangkat = pangkat.id_pangkat 
				JOIN jabatan ON pegawai.id_jabatan = jabatan.id_jabatan WHERE detail_nppt.id_nppt = $r[id_nppt] ORDER BY detail_nppt.status_perintah ASC");
			while($pegawai = mysqli_fetch_array($data_pegawai)) {
				// Detail Pangkat dll
				echo "$no_pegawai. $pegawai[nama] <br/>";
				$no_pegawai++;
			}
			echo "</td>";
			// Akhir dari Kolom pegawai
			// Kolom Nama pangkat
			// Ambil Data pegawai per nppt 
			echo "<td>";
			$no_pegawai = 1;
			// Daftar pegawai
			$data_pegawai = mysqli_query($link, "SELECT detail_nppt.id_pegawai, pegawai.nama, pangkat.pangkat, jabatan.jabatan FROM detail_nppt 
				JOIN pegawai ON detail_nppt.id_pegawai = pegawai.id_pegawai 
				JOIN pangkat ON pegawai.id_pangkat = pangkat.id_pangkat 
				JOIN jabatan ON pegawai.id_jabatan = jabatan.id_jabatan WHERE detail_nppt.id_nppt = $r[id_nppt] ORDER BY detail_nppt.status_perintah ASC");
			while($pegawai = mysqli_fetch_array($data_pegawai)) {
				// Detail pangkat dll
				echo "$no_pegawai. $pegawai[pangkat] <br/>";
				$no_pegawai++;
			}
			echo "</td>";
			// Akhir dari Kolom pangkat
			// Kolom Nama jabatan
			// Ambil Data pegawai per nppt 
			echo "<td>";
			$no_pegawai = 1;
			// Daftar pegawai
			$data_pegawai = mysqli_query($link, "SELECT detail_nppt.id_pegawai, pegawai.nama, pangkat.pangkat, jabatan.jabatan FROM detail_nppt 
				JOIN pegawai ON detail_nppt.id_pegawai = pegawai.id_pegawai 
				JOIN pangkat ON pegawai.id_pangkat = pangkat.id_pangkat 
				JOIN jabatan ON pegawai.id_jabatan = jabatan.id_jabatan WHERE detail_nppt.id_nppt = $r[id_nppt] ORDER BY detail_nppt.status_perintah ASC");
			while($pegawai = mysqli_fetch_array($data_pegawai)) {
				// Detail pangkat dll
				echo "$no_pegawai. $pegawai[jabatan] <br/>";
				$no_pegawai++;
			}
			echo "</td>";
			// Akhir dari Kolom jabatan
			echo "<td>$r[pejabat_perintah]</td>
				<td>$r[no_spt]</td>
				<td>$r[tugas]</td>
				<td>$r[dasar_hukum]</td>
				<td>$r[tempat]</td>
				<td>$r[pembebanan_anggaran]</td>
				<td align='center'>
				<a href=$print?module=spt&act=print&id=$r[id_spt] target=\"_blank\" ><span class=\"glyphicon glyphicon-print\" title=\"Cetak\"></a></br> 
				<a href=?module=spt&act=editspt&id=$r[id_spt]><span class=\"glyphicon glyphicon-edit\" title=\"Edit\"></a></br>
				<a href=$aksi?module=spt&act=hapus&id=$r[id_spt] onClick=\"return confirm('Apakah Anda benar-benar mau menghapusnya?')\"><span class=\"glyphicon glyphicon-trash\" title=\"Hapus\"></a>
				<td>";
			$cek=mysqli_fetch_array(mysqli_query($link, "SELECT * FROM sppd WHERE id_nppt='$r[id_nppt]'"));
			if ($cek > 0) {
				echo "SPPD sudah dibuat";
			}
			elseif ($r['no_spt'] != "") {
				echo "<input type=button value='Buat SPPD'
				onclick=\"window.location.href='?module=sppd&act=tambahsppd&id=$r[id_spt]';\">";
			}
			elseif ($r['no_spt']== "") {
				echo "No SPT Kosong";	 
			}
			echo "</td></tr>";
			$no++;
		}
		echo "</tbody></table>";
	}
	else {
		$tampil = mysqli_query($link, "SELECT * FROM spt,nppt WHERE spt.id_nppt=nppt.id_nppt AND spt.id_pegawai LIKE '%$_SESSION[id_pegawai]%'");
		echo   "<h2>INPUT LAPORAN</h2>
		<table id=\"example1\" class=\"table table-bordered table-hover\">
		<thead>
			<tr>
				<th>No</th>
				<!--
				<th>No SPT</th>
				<th>Tugas</th>
				<th>T.Pergi</th>
				<th>T.Kembali</th>
				<th>Lama</th>
				-->
				<th>Maksud Perjalanan Dinas</th>
				<th>Laporan</th>
			</tr>
		</thead>";
		$no=0;
		echo "<tbody>";
		while ($r=mysqli_fetch_array($tampil)) {
			$no++;
			echo "<tr>
			<td>$no</td>
			<!--
			<td>$r[no_spt]</td>
			<td>$r[tugas]</td>
			<td>$r[tgl_pergi]</td>
			<td>$r[tgl_kembali]</td>
			<td>$r[lama] hari</td>
			-->
			<td>$r[tugas]</td>
			<td>";
			$cek=mysqli_num_rows(mysqli_query($link, "SELECT * FROM lpd WHERE id_spt='$r[id_spt]'"));
			if ($cek > 0 ) {
				echo "<span class=\"glyphicon glyphicon-check\" title=\"Verifikasi\">";
			}
			else {
				echo "<input type=button value='Buat Laporan'
				onclick=\"window.location.href='?module=lpd&act=tambahlpd&id=$r[id_spt]';\">";
			}
			echo "</td></tr>";
		}
		echo "</tbody></table>";
	}
    break;
	case "tambahspt":
		echo "
		<h2>Tambah Data SPT</h2>
		<div class='box box-solid box-primary'>
		<div class='box-header'>
		<h3 class='box-title'>Form Tambah Data SPT</h3>
		</div>
		<div class='box-body'>
		<div align='center'>          
		<form method=POST action='$aksi?module=spt&act=input'>
		<table>
		<tr align='center'><th>Pilih Data Pegawai</th><th>Isi Data Berikut</th></tr>
		<tr><td valign='top' style='padding-left:4px'>";
		$sql=mysqli_query($link, "SELECT * FROM pegawai");
		while($r=mysqli_fetch_array($sql)) {
			echo "<input type='checkbox' name='id_pegawai[]' value='$r[id_pegawai]'> $r[nama]<br/>";
		}
		echo  "</td>
		<td>
		<table width=600px class='table2'>
		<tr>
			<td>No spt</td>
			<td><input type=text name='no_spt' size=45 required /></td>
		</tr>
		<tr><td>Pejabat Perintah<br/><input type=text name='pejabat_perintah' size=45 required /></td></tr>
		<tr><td>Untuk<br /> <textarea name='tugas' style='width: 750px; height: 100px;'></textarea></td></tr>
		<tr><td>Dasar<br /><textarea name='dasar_hukum' style='width:750px;height:150px'></textarea></td></tr>
		<tr><td>Tempat<br/><input type=text name='tempat' size=45 required /></td></tr>
		<tr><td>Pembebanan Anggaran<br /><textarea name='pembebanan_anggaran' style='width:750px;height:150px'></textarea></td></tr>
		</table>
		</td>
		</tr>
		<tr><td></td><td><input type=submit name=submit value=Simpan class='btn btn-success'>
		<input type=button value=Batal onclick=self.history.back() class='btn btn-warning'></td></tr>
		</table></form></div></div></div>";
    break;
	case "editspt":
		$edit=mysqli_query($link, "SELECT a.*, c.tujuan FROM spt a JOIN nppt b ON a.id_nppt = b.id_nppt JOIN tujuan c on b.id_tujuan = c.id_tujuan WHERE id_spt='$_GET[id]'");
		$c=mysqli_fetch_array($edit);
		echo "
		<h2>Edit SPT</h2>
		<div class='box box-solid box-primary'>
		<div class='box-header'>
		<h3 class='box-title'>Form Edit Data SPT</h3>
		</div>
		<div class='box-body'>
		<div align='center'>          <form method=POST action='$aksi?module=spt&act=update' onsubmit='return checkForm(this);'>
		<table width=100%>
		<tr align='center'><th><b>PILIH DATA PEGAWAI</b></th></tr>
		<tr><td valign='top' style='padding-left:4px' >
		<div style='overflow:auto;' >";
		if ($_GET['id']=="") {
			$sql=mysqli_query($link, "SELECT a.*, b.jabatan, c.pangkat FROM pegawai a  
			JOIN pangkat c on a.id_pangkat = c.id_pangkat 
			JOIN jabatan b on a.id_jabatan = b.id_jabatan");
			while ($t=mysqli_fetch_array($sql)) {
				echo "<input type='checkbox' name='id_pegawai[]' value='$r[id_pegawai]' > $t[nama] / $t[jabatan] / $t[pangkat]<br/>"; 
			}
		}
		else {
			$sql=mysqli_query($link, "SELECT c.*, d.pangkat, e.jabatan FROM spt a RIGHT JOIN detail_nppt b on a.id_nppt = b.id_nppt join pegawai c on b.id_pegawai = c.id_pegawai 
			JOIN pangkat d on c.id_pangkat = d.id_pangkat 
			JOIN jabatan e on c.id_jabatan = e.id_jabatan  WHERE a.id_spt = '$_GET[id]'");
			$nomer= 0;
			while($r=mysqli_fetch_array($sql)) {
				$value =explode('-',$r['id_pegawai']);	
				$nomer++;
				echo "<input type='checkbox' name='id_pegawai[]' value='$r[id_pegawai]' checked='checked'> $r[nama] / $r[jabatan] / $r[pangkat] <br/>";  
			}
			echo  "</td>";
		}
		echo"
		<div class='box-body'>
		<div align='center'>          
		<form method=POST action=$aksi?module=spt&act=update>
		<input type=hidden name=id value='$c[id_spt]'>
		<table width='100%'>
		<tr><th><b>Isi Data Berikut</b></th></tr>
		<td align='center'>
		<table width=600px >
		<tr >
			<td>No Spt</td>
			<td><input type=text name='no_spt' size=45 value='$c[no_spt]'></td>
		</tr>
		<tr>
			<td>Pejabat Perintah </td>
			<td><input type=text name='pejabat_perintah' value='Kepala Dinas Komunikasi dan Informatika' size=45 value='$c[pejabat_perintah]'></td>
		</tr>
		<tr>
			<td>Untuk </td>
			<td> <textarea name='tugas' >$c[tugas]</textarea></td>
		</tr>
		<tr>
		<td>Dasar </td>
		<td> <textarea name='dasar_hukum' >$c[dasar_hukum]</textarea></td>
		</tr>
		<tr>
		<td>Tempat</td>
			<td><input type=text name='tempat' size=45 value='$c[tujuan]'></td>
		</tr>
		<tr>
		<td>Pembebanan Anggaran</td>
			<td><textarea name='pembebanan_anggaran'>$c[pembebanan_anggaran]</textarea></td>
		</tr>
					<tr align='center'><td colspan='2'></br><input type=submit name=submit value=Update  class='btn btn-success'>
							<input type=button value=Batal onclick=self.history.back()  class='btn btn-warning'></td></tr>		
		</table>
		</td>
		</tr>
		</table></form></div></div></div>";
    break;
}
?>