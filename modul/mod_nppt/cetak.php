<style>
h2,
h1,
h3 { 
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
	text-align:center;
	margin-top:60px;
}
.style1 {
	font-size: 16
}
</style>
<body onLoad="window.print(0)">
<div id="wrapper">
	<div id="logo"><img src="../../logosurat.png" alt="" width="90" height="107" /></div>
	<div id="cop">
		<h2 class="style1"><strong>PEMERINTAH KABUPATEN PASAMAN</strong></h2>
		<h1 class="style1"><strong>DINAS KOMUNIKASI DAN INFORMATIKA</strong></h1>
		Jln. Jendral Soedirman No.40 Lb.sikaping Pos 26311 Telp - (0753) 20202 - 20281<br />
		Lubuk Sikaping</div>
	<div id="kodepos">Kode Pos : 26311</div>
</div>
<div id="header">
	<hr />
	<h1><u>NOTA PERMINTAAN PERJALANAN DINAS</u></h1>
</div>
<?php
include "../../config/koneksi.php";
include "../../config/fungsi_indotgl.php";
$qry=mysqli_query($link, "Select * FROM nppt WHERE id_nppt='$_GET[id]'");
$r=mysqli_fetch_array($qry);
$value= explode("-",$r['id_pegawai']);
$no=0;
echo "<ol>";
	$qs=mysqli_query($link, "SELECT detail_nppt.id_detail,detail_nppt.id_nppt,detail_nppt.id_pegawai, pegawai.nip, pegawai.unitkerja, pegawai.nama, pangkat.pangkat, jabatan.jabatan FROM detail_nppt 
			JOIN pegawai ON detail_nppt.id_pegawai = pegawai.id_pegawai 
			JOIN pangkat ON pegawai.id_pangkat = pangkat.id_pangkat 
			JOIN jabatan ON pegawai.id_jabatan = jabatan.id_jabatan where detail_nppt.id_nppt=$_GET[id] ORDER BY detail_nppt.status_perintah ASC");
	while($t = mysqli_fetch_array($qs)){
		$no++;
		echo "<table>
			<tr><td width=250>$no.NIP					</td><td>: <b> $t[nip]</td></tr>
			<tr><td>&nbsp; &nbsp;Nama					</td><td>:<b> $t[nama]</td></tr>
			<tr><td>&nbsp; &nbsp;Pangkat					</td><td>: $t[pangkat]</td></tr>
			<tr><td>&nbsp; &nbsp;Jabatan					</td><td>: $t[jabatan]</td></tr>
			<tr><td>&nbsp; &nbsp;Unit Kerja				</td><td>: $t[unitkerja]</td></tr>
			<tr></tr></table>";		
	}
echo "<br>Mohon diberikan surat Perintah Tugas & Surat Perintah Perjalanan Dinas</ol>";
$qry=mysqli_query($link, "Select * FROM nppt,tujuan,transportasi WHERE id_nppt='$_GET[id]' AND nppt.id_tujuan=tujuan.id_tujuan
AND nppt.id_transportasi=transportasi.id_transportasi");
$t=mysqli_fetch_array($qry);
$tglpergi= tgl_indo ($t['tgl_pergi']);
$tglkembali= tgl_indo ($t['tgl_kembali']);
$tgldibuat= tgl_indo ($t['tgl_dibuat']);
$lama= $t['lama'];
echo "<ol><table>
	<tr><td width=250>1. Tempat Tujuan		</td><td>: <b> $t[tujuan]</td></tr>
	<tr><td>2. Maksud Perjalanan Dinas		</td><td>: $t[maksud]</td></tr>
	<tr><td>3. Alat Angkutan Yang Dipergunakan </td><td>:";
$value =explode('-',$r['id_transportasi']);
$nomer= 0;
for($i=0;$i<count($value);$i++) { 
	$data=$value[$i];
	$nomer++;
	$sql=mysqli_query($link, "SELECT * FROM transportasi WHERE id_transportasi='$data'");
	$t=mysqli_fetch_array($sql);
	echo " $t[transportasi], ";
	echo "&nbsp;";
}
echo"</td></tr>
	<tr><td>4.	Lama Perjalanan				</td><td>: $lama hari</td></tr>
	<tr><td>&nbsp;&nbsp;&nbsp;a. Tanggal Berangkat	</td><td>: $tglpergi</td></tr>
	<tr><td>&nbsp;&nbsp;&nbsp;b. Tanggal Kembali	</td><td>: $tglkembali</td></tr>
	</table></ol>";	
?>
<div style="width:300px;float:right;">Dikeluarkan di: Lubuk Sikaping<br>
	<?php
	echo" <tr><td>Pada Tanggal	</td><td>: $tgldibuat</td></tr>";
	?>
	<div style="font-weight:bold;text-align:center"><p>Kepala Dinas Komunikasi dan Informatika<br/>
		</p>
		<p>&nbsp;</p>
		<p><u>WILLIYAM HUTABARAT, S.Kom.</u><br/>
		(Pembina TK. I)<br/>
		NIP. 197111181997011001</p>
	</div>
</div>