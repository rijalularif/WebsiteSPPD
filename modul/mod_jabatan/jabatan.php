<?php

$aksi="modul/mod_jabatan/aksi_jabatan.php";
switch($_GET[act]) {
  // Tampil jabatan
  default:
    $tampil = mysqli_query($link, "SELECT * FROM jabatan");
    echo "
    <h2>DATA JABATAN</h2>
    <input type=button value='Tambah Data' class='btn btn-success'
    onclick=\"window.location.href='?module=jabatan&act=tambahjabatan';\"><br /><br />";
    echo "
    <div style=\"width:450px\">
      <table id=\"example1\" class=\"table table-bordered table-hover\">
        <thead>
          <tr>
            <th>No</th>
            <th>jabatan</th>
            <th>aksi</th>
          </tr>
        </thead>";
        $no=1;
        echo "<tbody>";
        while ($r=mysqli_fetch_array($tampil)){
          $biaya = number_format($r['biaya'],0,'','.');
          echo "<tr><td align='center'>$no</td>
          <td>$r[jabatan]</td>
          <td align='center'>
          <a href=?module=jabatan&act=editjabatan&id=$r[id_jabatan]><span class=\"glyphicon glyphicon-edit\" title=\"Edit\"></a>
          <a href=$aksi?module=jabatan&act=hapus&id=$r[id_jabatan] onClick=\"return confirm('Apakah Anda benar-benar mau menghapusnya?')\"><span class=\"glyphicon glyphicon-trash\" title=\"Hapus\"></a></td></tr>";
          $no++;
        }
        echo "
        </tbody>
      </table>
    </div>";
  break;
  case "tambahjabatan":
    echo "
    <h2>TAMBAH DATA JABATAN</h2>
    <div class='box box-solid box-primary'>
      <div class='box-header' >
        <h3 class='box-title'>Form Tambah Data Jabatan</h3>
      </div>
      <div class='box-body'>
        <div align='center' >
          <form method=POST action='$aksi?module=jabatan&act=input'>
            <table width='100%' class='table2'>
              <tr>
                <td>Jabatan</td>
                <td> <input type=text name='jabatan' size=45 required/></td>
              </tr>
              <tr>
                <td></td>
                <td><input type=submit name=submit value=Simpan class='btn btn-success'>
                <input type=button value=Batal onclick=self.history.back() class='btn btn-warning'></td>
              </tr>
            </table>
          </form>
        </div>
      </div>
    </div>";
  break;
  case "editjabatan":
    $edit=mysqli_query($link, "SELECT * FROM jabatan WHERE id_jabatan='$_GET[id]'");
    $r=mysqli_fetch_array($edit);
    echo "
    <h2>EDIT DATA JABATAN</h2>
    <div class='box box-solid box-primary'>
      <div class='box-header'>
        <h3 class='box-title'>Form Edit Jabatan</h3>
      </div>
      <div class='box-body'>
        <div align='center' class='table2'>
          <form method=POST action=$aksi?module=jabatan&act=update>
            <input type=hidden name=id value='$r[id_jabatan]'>
            <table width='100%' class='table2'>
              <tr><td>Jabatan</td><td>
              <input type=text name='jabatan' size=45 value='$r[jabatan]' required/></td></tr>
              <tr><td></td><td>
              <input type=submit value=Update class='btn btn-success'>
              <input type=button value=Batal onclick=self.history.back() class='btn btn-warning'></td></tr>
            </table>
          </form>
        </div>
      </div>
    </div>";
  break;
}

?>
