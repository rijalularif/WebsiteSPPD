<?php
$aksi="modul/mod_pegawai/aksi_pegawai.php";
$aksi2="modul/mod_pegawai/cetak.php";
switch($_GET[act]) {
  // Tampil Pegawai
  default:
  $tampil = mysqli_query($link, "SELECT * FROM pegawai,pangkat,jabatan WHERE pegawai.id_pangkat=pangkat.id_pangkat AND pegawai.id_jabatan=jabatan.id_jabatan"); 
  echo "<h2>DATA PEGAWAI</h2>
    <input type=button value='Tambah Data Pegawai' class='btn btn-success'onclick=\"window.location.href='?module=pegawai&act=tambahPegawai';\">
		<br /><br />
    <table id=\"example1\" class=\"table table-bordered table-hover\"> 
    <thead>
      <tr>
        <th>No</th>
        <th>NIP</th>
        <th>Nama</th>
        <th>Pangkat</th>
        <th>Jabatan</th>
        <th>Unit Kerja</th>
        <th>Username</th>
        <th>Password</th>
        <th>aksi</th>
      </tr>
    </thead>"; 
  $no=1;
	echo "<tbody>";
  while ($r=mysqli_fetch_array($tampil)) {
    echo "<tr>
      <td>$no</td>
      <td>$r[nip]</td>
      <td>$r[nama]</td>
      <td>$r[pangkat]</td>
      <td>$r[jabatan]</td>
			<td>$r[unitkerja]</td>	 
			<td>$r[username]</td>
			<td>$r[password]</td>
			<td align='center'>
      <a href=?module=pegawai&act=editPegawai&id=$r[id_pegawai]><span class=\"glyphicon glyphicon-edit\" title=\"Edit\"></a>
			<a href=$aksi?module=pegawai&act=hapus&id=$r[id_pegawai] onClick=\"return confirm('Apakah Anda benar-benar mau menghapusnya?')\"><span class=\"glyphicon glyphicon-trash\" title=\"Hapus\"></a></td></tr>";
      $no++;
    }
  echo "</tbody></table>";
  break;
  case "tambahPegawai":
  echo "<h2>TAMBAH DATA PEGAWAI</h2>
    <div class='box box-solid box-primary'>
      <div class='box-header'><h3 class='box-title'>Form Input Pegawai</h3></div>
      <div class='box-body'>
      <div align='center'>
        <form method=POST action='$aksi?module=pegawai&act=input' >
          <table class='table2'>
            <tr><td width='150'>NIP</td><td><input type=text name='nip' size=45 required /></td></tr>
            <tr><td>Nama</td><td><input type=text name='nama' size=30 required/></td></tr>
            </select></td></tr>
            <tr><td>Pangkat</td><td><select name='id_pangkat' required/>
            <option value=0 selected>Pilih Kategori</option>";
	$tampil=mysqli_query($link, "SELECT * FROM pangkat");
	while($r=mysqli_fetch_array($tampil)) {
    echo "<option value=$r[id_pangkat]>$r[pangkat]</option></p>";
  }
  echo "</select></td></tr>
		<tr><td>Jabatan</td><td><select name='id_jabatan' required/>
		<option value=0 selected>Pilih Kategori</option>";
	$tampil=mysqli_query($link, "SELECT * FROM jabatan");
	while($r=mysqli_fetch_array($tampil)) {
		echo "<option value=$r[id_jabatan]>$r[jabatan]</option></p>";
  }
  echo "</select>";
  echo "      <tr><td>Unit Kerja</td><td><input type=text name='unitkerja' value='Dinas Komunikasi dan Informatika Kabupaten Pasaman' size=65 required/></td></tr>
              <tr><td></td><td><input type=submit name=submit value=Simpan class='btn btn-danger'>
              <input type=button value=Batal onclick=self.history.back() class='btn btn-warning'></td></tr>
            </table>
          </form>
        </div>
      </div>
    </div>";
  break;
  case "editPegawai":
  $edit=mysqli_query($link, "SELECT * FROM Pegawai WHERE id_Pegawai='$_GET[id]'");
  $r=mysqli_fetch_array($edit);
  echo "<h2>EDIT DATA PEGAWAI</h2>
    <div class='box box-solid box-primary'>
      <div class='box-header'><h3 class='box-title'>Form Edit Pegawai</h3></div>
      <div class='box-body'>
        <div align='center'>
          <form method=POST action=$aksi?module=pegawai&act=update>
            <input type=hidden name=id value='$r[id_pegawai]'>
            <table class='table2'>
            <tr><td width=150>NIP</td><td><input type=text name='nip' value='$r[nip]' size=45 required/></td></tr>
            <tr><td>Nama</td><td><input type=text name='nama' value='$r[nama]' size=30 required/></td></tr>
            <td>
            <tr><td>Pangkat</td><td><select name='id_pangkat'>";
  $tampil=mysqli_query($link, "SELECT * FROM pangkat");
  if ($r[id_pangkat]==0) {
    echo "<option value=0 selected>- Pilih Kategori -</option>";
  }
	while($w=mysqli_fetch_array($tampil)) {
    if ($r[id_pangkat]==$w[id_pangkat]) {
      echo "<option value=$w[id_pangkat] selected>$w[pangkat]</option>";
    }
    else {
      echo "<option value=$w[id_pangkat]>$w[pangkat]</option> </p> ";
    }
  }
  echo "</select>";
	echo "</td><td>
		<tr><td>Jabatan</td><td><select name='id_jabatan'>";
		$tampil=mysqli_query($link, "SELECT * FROM jabatan");
		if ($r[id_jabatan]==0) {
      echo "<option value=0 selected>- Pilih Kategori -</option>";
    }
    while($w=mysqli_fetch_array($tampil)) {
      if ($r[id_jabatan]==$w[id_jabatan]) {
        echo "<option value=$w[id_jabatan] selected>$w[jabatan]</option>";
      }
      else {
        echo "<option value=$w[id_jabatan]>$w[jabatan]</option> </p> ";
      }
    }
  echo "</select>";
  echo "      <tr><td>Unit Kerja</td><td>
              <input type=text name='unitkerja' value='$r[unitkerja]' size=65 required/></td></tr>
              <tr><td></td><td><input type=submit value=Update class='btn btn-danger'>
              <input type=button value=Batal onclick=self.history.back() class='btn btn-warning'></td></tr>
            </table>
          </form>
        </div>
      </div>
    </div>";
  break;
}
?>