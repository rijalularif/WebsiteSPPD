<?php
$aksi="modul/mod_lpd/aksi_lpd.php";
$print ="modul/mod_lpd/cetak.php";
switch($_GET['act']) {
	// Tampil lpd
	default:
	echo "<h2>LAPORAN PERJALANAN DINAS</h2>";
	// <input type=button value='Tambah Data lpd' 
	// onclick=\"window.location.href='?module=lpd&act=tambahlpd';\">";
	echo "
	<table id=\"example1\" class=\"table table-bordered table-hover\">
		<thead>
			<tr>
				<th>No</th>
				<th>Nama Pegawai Yang Diperintahkan</th>
				<th>Pangkat</th>
				<th>Jabatan</th>
				<th>Keterangan</th>
				<!-- <th>No SPT</th> -->
				<th>Hasil</th>
				<!-- <th>Tanggal</th> -->
				<th>aksi</th>
			</tr>
		</thead>"; 
	$no_data=1;
	echo "<tbody>";
	$tampil = mysqli_query($link, "SELECT * FROM lpd JOIN spt ON lpd.id_spt = spt.id_spt JOIN nppt ON spt.id_nppt = nppt.id_nppt JOIN tujuan ON nppt.id_tujuan = tujuan.id_tujuan");
	while ($t=mysqli_fetch_array($tampil)) {
		$tanggal = tgl_indo($t['tanggal']);
		echo "<td>$no_data</td>";
		// Kolom nama pegawai
		// ambil data pegawai per nppt 
		echo "<td>";
		$no_pegawai = 1;
		// daftar pegawai
		$data_pegawai = mysqli_query($link, "SELECT detail_nppt.id_pegawai, pegawai.nama, pangkat.pangkat, jabatan.jabatan FROM detail_nppt 
			JOIN pegawai ON detail_nppt.id_pegawai = pegawai.id_pegawai 
			JOIN pangkat ON pegawai.id_pangkat = pangkat.id_pangkat 
			JOIN jabatan ON pegawai.id_jabatan = jabatan.id_jabatan WHERE detail_nppt.id_nppt = $t[id_nppt] ORDER BY detail_nppt.status_perintah ASC");
		while($pegawai = mysqli_fetch_array($data_pegawai)) {
			// detail pangkat dll
			echo "$no_pegawai. $pegawai[nama] <br/>";
			$no_pegawai++;
		}
		echo "</td>";
		// akhir dari kolom pegawai
			
		// Kolom nama pangkat
		// ambil data pegawai per nppt 
		echo "<td>";
		$no_pegawai = 1;
		// daftar pegawai
		$data_pegawai = mysqli_query($link, "SELECT detail_nppt.id_pegawai, pegawai.nama, pangkat.pangkat, jabatan.jabatan FROM detail_nppt 
			JOIN pegawai ON detail_nppt.id_pegawai = pegawai.id_pegawai 
			JOIN pangkat ON pegawai.id_pangkat = pangkat.id_pangkat 
			JOIN jabatan ON pegawai.id_jabatan = jabatan.id_jabatan WHERE detail_nppt.id_nppt = $t[id_nppt] ORDER BY detail_nppt.status_perintah ASC");
		while($pegawai = mysqli_fetch_array($data_pegawai)) {
			// detail pangkat dll
			echo "$no_pegawai. $pegawai[pangkat] <br/>";
			$no_pegawai++;
		}
		echo "</td>";
		// akhir dari kolom pangkat	
		// Kolom nama jabatan
		// ambil data pegawai per nppt 
		echo "<td>";
		$no_pegawai = 1;
		// daftar pegawai
		$data_pegawai = mysqli_query($link, "SELECT detail_nppt.id_pegawai, pegawai.nama, pangkat.pangkat, jabatan.jabatan FROM detail_nppt 
			JOIN pegawai ON detail_nppt.id_pegawai = pegawai.id_pegawai 
			JOIN pangkat ON pegawai.id_pangkat = pangkat.id_pangkat 
			JOIN jabatan ON pegawai.id_jabatan = jabatan.id_jabatan WHERE detail_nppt.id_nppt = $t[id_nppt] ORDER BY detail_nppt.status_perintah ASC");
		while($pegawai = mysqli_fetch_array($data_pegawai)) {
			// detail pangkat dll
			echo "$no_pegawai. $pegawai[jabatan] <br/>";
			$no_pegawai++;
		}
		echo "</td>";
		// akhir dari kolom jabatan
		echo "<td>
		Telah melaksanakan Perjalanan Dinas dalam rangka $t[tugas], berdasarkan Surat Perintah Tugas Nomor : $t[no_spt] , dari tanggal ".tgl_indo($t['tgl_pergi'])." s/d ".tgl_indo($t['tgl_kembali'])." di $t[tujuan]
		</td>";
		echo "<!-- <td>$t[no_spt]</td> -->
			<td>$t[hasil]</td>
			<!-- <td>$tanggal</td> -->
			<td align='center'>
			<a href=$print?&id=$t[id_lpd]><span class=\"glyphicon glyphicon-print\" title=\"Cetak\" target=\"_blank\"/></a> </br>";
			if($_SESSION['level']!="kadis") {
			echo "<a href=?module=lpd&act=editlpd&id=$t[id_lpd]><span class=\"glyphicon glyphicon-edit\" title=\"Edit\"/></a> </br>
				<a href=$aksi?module=lpd&act=hapus&id=$t[id_lpd]><span class=\"glyphicon glyphicon-trash\" title=\"Hapus\" /></a>";
		}
		echo "</td></tr>";
		$no_data++;
	}
	echo "</tbody></table>";
	break;
	case "tambahlpd":
	$t=mysqli_fetch_array(mysqli_query($link, "SELECT * FROM pegawai,jabatan,pangkat WHERE jabatan.id_jabatan=pegawai.id_jabatan AND pangkat.id_pangkat=pegawai.id_pangkat 
	AND pegawai.id_pegawai='".$_SESSION['id_pegawai']."'"));
	echo "
	<h2>BUAT LAPORAN PERJALANAN DINAS</h2>
	<form method=POST action='$aksi?module=lpd&act=input'>
		<table width=50%>
			<tr><td>Nama / NIP</td><td>$t[nama] / $t[nip] <input type='hidden' name='id_pegawai' value='$t[id_pegawai]'></td></tr>
			<tr><td>Jabatan</td><td>$t[jabatan]</td></tr>
			<tr><td>Pangkat </td><td>$t[pangkat] </td></tr>	
			<tr><td>Unit Kerja</td><td>$t[unitkerja]</td></tr>";
			$c = mysqli_fetch_array(mysqli_query($link, "SELECT * FROM spt,nppt,tujuan WHERE spt.id_nppt=nppt.id_nppt AND spt.id_spt='$_GET[id]' AND tujuan.id_tujuan=nppt.id_tujuan"));
			$tgl_pergi = tgl_indo($c['tgl_pergi']);
			$tgl_kembali = tgl_indo($c['tgl_kembali']);
			echo "
			<tr>
				<td>Keterangan</td>
				<td>
					<input type='hidden' name='id_spt' value='$c[id_spt]'>
					<textarea name='dari' style='width:100%;height:60px'>
					Telah melaksanakan Perjalanan Dinas dalam rangka $c[tugas] , berdasarkan
					Surat Perintah Tugas Nomor : $c[no_spt] , dari tanggal $tgl_pergi s/d $tgl_kembali di $c[tujuan]</textarea>
				</td>
			</tr>
			<tr>
				<td>Hasil</td>
				<td>
					<textarea name='hasil'>
					Adapun hasil perjalanan dinas tersebut adalah sebagai berikut : 
					</textarea>
				</td>
			</tr>
			<tr>
				<td colspan=2 align='center'><input type=submit name=submit value=Simpan class='btn btn-success'>
					<input type=button value=Batal onclick=self.history.back() class='btn btn-warning'>
				</td>
			</tr>
		</table>
	</form>";
	break;
	case "editlpd":
	$t=mysqli_fetch_array(mysqli_query($link, "SELECT * FROM pegawai,jabatan,pangkat WHERE jabatan.id_jabatan=pegawai.id_jabatan AND pangkat.id_pangkat=pegawai.id_pangkat 
	AND pegawai.id_pegawai='$_SESSION[id_pegawai]'"));
		$k=mysqli_fetch_array(mysqli_query($link, "SELECT * FROM lpd WHERE id_lpd='$_GET[id]'"));
	echo "
	<h2>BUAT LAPORAN PERJALANAN DINAS</h2>
	<form method=POST action=$aksi?module=lpd&act=update>
		<input type=hidden name=id value='$k[id_lpd]'>
		<table width=50%>
		<tr><td>Nama / NIP </td><td>$t[nama] / $t[nip] <input type='hidden' name='id_pegawai' value='$t[id_pegawai]'></td></tr>
		<tr><td>Jabatan</td><td>$t[jabatan]</td></tr>
		<tr><td>Pangkat </td><td>$t[pangkat] </td></tr>
		<tr><td>Unit Kerja</td><td>$t[unitkerja]</td></tr>";
		$c = mysqli_fetch_array(mysqli_query($link, "SELECT * FROM spt,nppt,tujuan WHERE spt.id_nppt=nppt.id_nppt AND spt.id_spt='$k[id_spt]' AND tujuan.id_tujuan=nppt.id_tujuan"));
		$tgl_pergi = tgl_indo($c['tgl_pergi']);
		$tgl_kembali = tgl_indo($c['tgl_kembali']);
			echo " 
			<tr><td>Keterangan</td>
				<td>
					<input type='hidden' name='id_spt' value='$c[id_spt]'>
					<textarea name='dari' style='width:100%;height:60px'>Telah melaksanakan Perjalanan Dinas dalam rangka $c[tugas], berdasarkan Surat Perintah Tugas Nomor : $c[no_spt] , dari tanggal $tgl_pergi s/d $tgl_kembali di $c[tujuan]</textarea>
			</td></tr>";
			echo "
			<tr><td>Hasil</td>
				<td><textarea name='hasil' style='width:100%;height:100px'>$k[hasil]</textarea></td>
			</tr>
			<tr>
				<td colspan=2 align='center'><input type=submit name=submit value=Update class='btn btn-success'><input type=button value=Batal onclick=self.history.back() class='btn btn-warning'></td>
			</tr>
		</table>
	</form>";
	break;
}
?>