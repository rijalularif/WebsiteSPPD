<?php
$aksi="modul/mod_nppt/aksi_nppt.php";
echo "<h2>Tambah Data Nota Permintaan Perjalanan Dinas</h2>
<div class='box box-solid box-primary'>
	<div class='box-header'><h3 class='box-title'>Form Tambah NPPT</h3></div>
	<div class='box-body'>
		<div align='center'>
			<form method=POST action='$aksi?module=nppt&act=input' onsubmit='return checkForm(this);'>
				<table width=100%>
					<tr align='center'><th><b>PILIH DATA PEGAWAI</b></th></tr>
					<tr><td valign='top' style='padding-left:7px' >
						<div style='overflow:auto;height:400px;' >";
						$sql=mysqli_query($link, "SELECT * FROM pegawai,pangkat,jabatan WHERE pegawai.id_jabatan=jabatan.id_jabatan AND pegawai.id_pangkat=pangkat.id_pangkat");
						$lama= $r['tgl_kembali'] - $r['tgl_pergi'];
						while($r=mysqli_fetch_array($sql)) {
							echo "<input type='checkbox' name='id_pegawai[]' value='$r[id_pegawai]' onclick='isiPegawai()' > <span name='nm_pegawai'>$r[nama] / $r[jabatan] / $r[pangkat]</span><br/>";
						}
						echo "</div></td>
						<div class='box-body'>
						<div align='center'> <form method=POST action='$aksi?module=nppt&act=input' onsubmit='return checkForm(this);'>
						<table width=100%>
						<tr align='center'><th><b>ISI DATA BERIKUT</b></th></tr>
						<td>
						<div align=\"center\" >
						<table class='table2' >
						<tr>
						<td>Pegawai Yang Diperintahkan</td>
						<td>
						<select name='id_pemimpin'></select>
						</td>
						</tr>
						<tr><td >Tujuan Perjalanan</td><td><select name='tujuan'>
						<option value=0 selected>Pilih Kategori</option>";
						$tampil=mysqli_query($link, "SELECT * FROM tujuan");
						while($r=mysqli_fetch_array($tampil)) {
							echo "<option value=$r[id_tujuan]> $r[tujuan]</option></p>";
						}
						echo "</select></td></tr>
						<tr><td>Maksud Perjanalan Dinas</td><td><input type=text name='maksud' size=80 required/></td></tr>
						<tr><td>Tipe Transportasi:</td><td valign='top' >";
						$sql=mysqli_query($link, "SELECT * FROM transportasi");
						while($r=mysqli_fetch_array($sql)) {
							echo "<input type='checkbox' name='id_transportasi[]' value='$r[id_transportasi]' class='flat-red'>$r[transportasi]<br/>";
						}
						echo "</td></tr>
						<tr><td>Tanggal Berangkat</td><td><input type='text' name='tgl_pergi' id='tanggal' size=15 required /><span class='glyphicon glyphicon-calendar'>Thn-Bln-hari</td></tr>
						<tr><td>Tanggal Kembali</td><td><input type='text' name='tgl_kembali' id='tgl_kembali' size=15 required><span class='glyphicon glyphicon-calendar'>Thn-Bln-hari</td></tr>
						<tr><td>Lama Perjalanan</td><td><input type=text name='lama' size=3 id='lama' required/>&nbsp; Hari</td></tr>
						<tr><td></td><td><input type=text name='malam' size=3 id='malam' required/>&nbsp; Malam</td></tr>
						<tr><td>Tanggal Dibuat</td><td><input type='text' name='tgl_dibuat' id='tgl_dibuat' size=15 required><span class='glyphicon glyphicon-calendar'>Thn-Bln-hari</td></tr>
						<tr><td></td><td></br></br><input type=submit name=submit value=Simpan class='btn btn-success'><input type=button value=Batal onclick=self.history.back() class='btn btn-warning'></td></tr>
						</table>
						</div>
					</tr>
				</table>
			</form>
		</div>
	</div>
</div>";
?>

<script>
function isiPegawai(){
	var data = document.getElementsByName("id_pegawai[]");
	var banyak = data.length;
	var pilih_pegawai = document.getElementsByName("id_pemimpin")[0];
	pilih_pegawai.innerHTML = "";
	for(var x = 0;x < banyak; x++){
		if(data[x].checked)
		{
			pilih_pegawai.innerHTML += "<option value='" + data[x].value + "'>" + document.getElementsByName("nm_pegawai")[x].innerHTML + "</option>";
		}
	}
}
<?php
	if(isset($_GET['hasil_cek'])){
		?>
		alert("Tidak Bisa Diinputkan Karena Jadwal Bentrok");
		<?php
	}
?>
var tgl_dibuat = new Pikaday({
	field: document.getElementById('tgl_dibuat'),
	format: 'YYYY-MM-DD',
});
var tanggal = new Pikaday({
	field: document.getElementById('tanggal'),
	format: 'YYYY-MM-DD',
});
var tgl_kembali = new Pikaday({
	field: document.getElementById('tgl_kembali'),
	format: 'YYYY-MM-DD'
});
// Disable date before tanggal 
document.getElementById("tanggal").addEventListener("change", 
function(){
	tgl_kembali.setMinDate(moment(this.value).toDate());
	tgl_dibuat.setMaxDate(moment(this.value).toDate());
})
document.getElementById("tgl_kembali").addEventListener("change", 
function(){
	var tanggal = moment(document.getElementById("tanggal").value);
	var tgl_kembali = moment(this.value);
	var hari = tgl_kembali.diff(tanggal , 'days');
	// lebihkan hari jadi 1
	hari++;
	var malam = hari - 1;
	document.getElementById("lama").value = hari;
	document.getElementById("malam").value = malam;
})
</script>
