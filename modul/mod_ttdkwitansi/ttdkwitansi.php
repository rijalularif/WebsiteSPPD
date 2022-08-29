<?php
$aksi="modul/mod_ttdkwitansi/aksi_ttdkwitansi.php";
switch($_GET[act]) {
  // Tampil Pegawai
  default:
  $tampil = mysqli_query($link, "SELECT * FROM ttdkwitansi");
  echo "<h2 align='center'>DATA PENANDA TANGAN KWITANSI</h2>";
  echo "<table id=\"datatables\" class=\"display\">
    <thead>
      <tr>
        <th> No </th>
        <th> Kadis </th>
        <th> Bendahara </th>
        <th> PPTK </th>
        <th> Aksi </th>
      </tr>
    </thead>"; 
  $no=1;
	echo "<tbody>";
  while ($r=mysqli_fetch_array($tampil)) {
    echo "<tr>
    <td align='center'>$no</td>
    <td align='center'>$r[kadis]<br />$r[nip_kadis]</td>
    <td align='center'>$r[bendahara]<br />$r[nip_bendahara]</td>
		<td align='center'>$r[pptk]<br />$r[nip_pptk]</td>
    <td align='center'><a href=?module=ttdkwitansi&act=editttdkwitansi&id=$r[id]><span class=\"glyphicon glyphicon-edit\" title=\"Edit\"/></a>
		</a></td></tr>";
    $no++;
  }
  echo "</tbody></table>";
  break;
  case "editttdkwitansi":
    $edit=mysqli_query($link, "SELECT * FROM ttdkwitansi WHERE id='$_GET[id]'");
    $r=mysqli_fetch_array($edit);
    echo "<div id='tengah'>
      <h2 align='center'>EDIT DATA PEGAWAI</h2>
      <fieldset>
        <form method=POST action=$aksi?module=ttdkwitansi&act=update>
          <input type=hidden name=id value='$r[id]'>
          <table>
            <tr><td width=150>Kadis</td><td><input type=text name='kadis' value='$r[kadis]' size=45 required/></td></tr>
            <tr><td>Nip Kadis</td><td><input type=text name='nip_kadis' value='$r[nip_kadis]' size=30 required /></td></tr>
            <tr><td width=150>Bendahara</td><td><input type=text name='bendahara' value='$r[bendahara]' size=45 required/></td></tr>
            <tr><td>Nip Bendahara</td><td><input type=text name='nip_bendahara' value='$r[nip_bendahara]' size=30 required/></td></tr>
            <tr><td width=150>PPTK</td><td><input type=text name='pptk' value='$r[pptk]' size=45 required/></td></tr>
            <tr><td>Nip PPTK</td><td><input type=text name='nip_pptk' value='$r[nip_pptk]' size=30 required/></td></tr>
            <tr><td></td><td><input type=submit name=submit value=Update  class='btn btn-success'>
            <input type=button value=Batal onclick=self.history.back()  class='btn btn-warning'></td></tr>
          </table>
        </form>
      </fieldset>
    </div>";
  break;
}
?>