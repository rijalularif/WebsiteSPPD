<style>
	h2, h1, h3 {
		padding:0;
		margin:0;
	}
	h1 {
		font-size:22px;
		font-weight:bold
	}
	h2 {
		font-size:22px;
		font-weight:normal
	}
	#wrapper {
		width:780px;
		margin:0 auto;
	}
	#ol {
		margin:0
	}
	#logo {
		width:90px;
		float:left;	
	}
	hr {
		border-bottom: 5px double #000;
	}
	#cop {
		float:left;
		width:600px;
		text-align:center;
	}
	#kodepos {
		clear:both;
		text-align:right
	}
	#header {
		clear:both;
		text-align:center
	}
	.style1 {
		font-size: 16
	}
	.style2 {
		font-size: 24px;
	}
</style>

<body onLoad="window.print()">
<div id="wrapper">
	<div id="logo"><img src="../../logosurat.png" width="90" height="107" img alt="Logo Surat" ></div>
	<div id="cop">
		<h2 class="style1">PEMERINTAH KABUPATEN PASAMAN</h2>
		<h1 class="style2">DINAS KOMUNIKASI DAN INFORMATIKA</h1>
		Jln. Jendral Soedirman No.40 Lb.sikaping Pos 26311 Telp - (0753) 20202 - 20281<br>
	</div>
	<div id="kodepos"></div>
	<hr />
	<?php
	include "../../config/koneksi.php";
	include "../../config/fungsi_indotgl.php";
	$qr=mysqli_query($link, "Select * FROM spt WHERE id_spt='$_GET[id]'");
	$r=mysqli_fetch_array($qr);
	echo "<div id='header'>
		<h2><u>SURAT PERINTAH TUGAS</u></h2>
		NOMOR : &nbsp;&nbsp;&nbsp;$r[no_spt]
		<div id='isi'>
		<table>
			<tr><td width='180' valign='top'>1. Pejabat Memerintahkan</td><td>: $r[pejabat_perintah]</td></tr><br></br>
		</table>
		</br><div style='float:left'>2. Pegawai Yang Memerintah	:</div>";
	$value= explode("-",$r['id_pegawai']);
	$no=0;
	echo "<ol>";
		$qs=mysqli_query($link, "SELECT detail_nppt.id_detail,detail_nppt.id_nppt,detail_nppt.id_pegawai, pegawai.nip, pegawai.unitkerja, pegawai.nama, pangkat.pangkat, jabatan.jabatan FROM detail_nppt 
				JOIN pegawai ON detail_nppt.id_pegawai = pegawai.id_pegawai 
				JOIN pangkat ON pegawai.id_pangkat = pangkat.id_pangkat 
				JOIN jabatan ON pegawai.id_jabatan = jabatan.id_jabatan where detail_nppt.id_nppt= $r[id_nppt] ORDER BY detail_nppt.status_perintah ASC");
		while($t = mysqli_fetch_array($qs)) {
		$no++;
		echo "<table><br>
				<tr><td>&nbsp;&nbsp;&nbsp;Nama / NIP				</td><td>: $t[nama] / $t[nip]</td></tr>
				<tr><td>&nbsp; &nbsp;Jabatan					</td><td>: $t[jabatan]</td></tr>
				<tr><td>&nbsp; &nbsp;Pangkat					</td><td>: $t[pangkat]</td></tr></table>";
	}
	echo "</ol>";
	echo "<table>
			<tr><td width='180' valign='top'>3. Diperintahkan Untuk</td><td>: $r[tugas]</td></tr>
			<tr><td width='180' valign='top'>4. Dasar Surat Perintah</td><td>: $r[dasar_hukum]</td></tr>
			<tr><td width='180' valign='top'>5. Tempat/Lokasi</td><td>: $r[tempat]</td></tr><br></br>
			<tr><td width='180' valign='top'>6. Pembebanan Anggaran</td><td>: $r[pembebanan_anggaran]</td></tr>
			</td></tr>
		</table>
		<div style='float:left'></div><br>";
	echo "</ol>";
		?>
	</div>
	<div style="width:300px;float:right;margin-top:10px;">
		<p>&nbsp;</p>
		<p>Dikeluarkan di: Lubuk Sikaping<br>
		<?php
		$qry=mysqli_query($link, "SELECT * FROM spt,nppt,pegawai,tujuan,jabatan,pangkat WHERE id_spt='$_GET[id]' AND spt.id_pegawai=pegawai.id_pegawai AND spt.id_nppt=nppt.id_nppt AND nppt.id_tujuan=tujuan.id_tujuan AND jabatan.id_jabatan=pegawai.id_jabatan AND pangkat.id_pangkat=pangkat.id_pangkat");
		$r=mysqli_fetch_array($qry);
		$tgldibuat= tgl_indo ($r['tgl_dibuat']);
		echo" <tr><td>Pada Tanggal	</td><td>: $tgldibuat</td></tr>";
		?>
		</p>
		<div style="text-align:center;font-weight:bold">Kepala Dinas Komunikasi dan Informatika<br>
			<p>&nbsp;</p>
			<p><u>WILLIYAM HUTABARAT, S.Kom.</u><br>
			(Pembina TK. I)<br />
			NIP. 197111181997011001</p>
		</div>
	</div>
</div>