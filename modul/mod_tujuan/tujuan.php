<?php
$aksi="modul/mod_tujuan/aksi_tujuan.php";
switch($_GET[act]) {
  // Tampil tujuan
  default:
  $tampil = mysqli_query($link, "SELECT * FROM tujuan");
  echo "<h2>DATA KOTA TUJUAN PERJALANAN DINAS</h2>
  <input type=button value='Tambah Data' class='btn btn-success'
  onclick=\"window.location.href='?module=tujuan&act=tambahtujuan';\"><br /><br />";
  echo "<div style=\"width:450px\">
  <table id=\"example1\" class=\"table table-bordered table-hover\">
    <thead>
      <tr>
        <th>No</th>
        <th>tujuan</th>
        <th>aksi</th>
      </tr>
    </thead>"; 
  $no=1;
	echo "<tbody>";
  while ($r=mysqli_fetch_array($tampil)){
		$biaya = number_format($r['biaya'],0,'','.');
    echo "<tr><td align='center'>$no</td>
    <td>$r[tujuan]</td>
    <td align='center'>
    <a href=?module=tujuan&act=edittujuan&id=$r[id_tujuan]><span class=\"glyphicon glyphicon-edit\" title=\"Edit\"></a>
		<a href=$aksi?module=tujuan&act=hapus&id=$r[id_tujuan] onClick=\"return confirm('Apakah Anda benar-benar mau menghapusnya?')\"><span class=\"glyphicon glyphicon-trash\" title=\"Hapus\"></a></td></tr>";
    $no++;
  }
  echo "</tbody></table></div>";
  break;
  case "tambahtujuan":
    echo "	<h2>TAMBAH DATA KOTA TUJUAN PERJALANAN DINAS</h2>
    <div class='box box-solid box-primary'>
      <div class='box-header'><h3 class='box-title'>Form Tambah Kota Tujuan Perjalan Dinas</h3></div>
      <div class='box-body'>
        <div align='center'>
          <form method=POST action='$aksi?module=tujuan&act=input'>
            <table width='100%' class='table2'>
              <tr><td>Kota Tujuan</td><td> <input type=text name='tujuan' size=45 required/></td></tr>
              <tr><td></td><td><input type=submit name=submit value=Simpan  class='btn btn-success'>
              <input type=button value=Batal onclick=self.history.back()  class='btn btn-warning'></td></tr>
            </table>
          </form>
        </div>
      </div>
    </div>";
  break;
  case "edittujuan":
    $edit=mysqli_query($link, "SELECT * FROM tujuan WHERE id_tujuan='$_GET[id]'");
    $r=mysqli_fetch_array($edit);
    echo "<h2>EDIT DATA KOTA TUJUAN PERJALANAN DINAS</h2>
    <div class='box box-solid box-primary'>
      <div class='box-header'><h3 class='box-title'>Form Edit Kota Tujuan Perjalan Dinas</h3></div>
      <div class='box-body'>
        <div align='center'>
          <form method=POST action=$aksi?module=tujuan&act=update>
            <input type=hidden name=id value='$r[id_tujuan]'>
            <table width='100%' class='table2'>
              <tr><td>Kota Tujuan</td><td>  <input type=text name='tujuan' size=45 value='$r[tujuan]' required/></td></tr>
              <tr><td></td><td><input type=submit value=Update  class='btn btn-success'>
              <input type=button value=Batal onclick=self.history.back()  class='btn btn-warning'></td></tr>
            </table>
          </form>
        </div>
      </div>
    </div>";   
  break;  
}
?>