<?php

ob_start();
error_reporting(0);
$mod = $_GET['module'];

// Bagian Home
if ($mod=='home') {

    // echo "<div class=\"callout callout-info \">
    // <h4>Selamat Datang</h4>
    // <p>Hai <b>$_SESSION[namauser]</b>, selamat datang di Sistem Informasi SPPD Dinas KOMINFO Kabupaten Pasaman.<br>
    // Silahkan klik menu pilihan yang berada dikiri atau bawah untuk mengelola content website.</p></div>";

    if ($_SESSION['level']=="operator") {
        echo "<div align='center' class='callout callout-info'>
            <h4 align='left'>Selamat Datang</h4>
            <p align='left'>Hai <b>$_SESSION[namauser]</b>, selamat datang di Sistem Informasi SPPD Dinas KOMINFO Kabupaten Pasaman.<br>
            Silahkan klik menu pilihan yang berada dikiri atau bawah untuk mengelola content website.</br></br></br></br></br></br></br></p>
            <table>
                <thead>
                    <th class='center' colspan=10></br><center>Control Panel</center></br></th>
                </thead>
                </br>
                <tr>
                    <td width=150 align=center>
                        </br>
                        <a href=media.php?module=pegawai  style='text-decoration: none'>
                            <img src=images/pegawai.png width=70px img alt='Icon Pegawai' border=none><br />
                            <b><font color='#00BFFF'>Data Pegawai</font></b>
                        </a>
                    </td>
                    <td width=150 align=center>
                        </br>
                        <a href=media.php?module=nppt style='text-decoration: none'>
                            <img src=images/nota.png width=70px img alt='Icon NPPD' border=none><br />
                            <b><font color='#00BFFF'>NPPD</font></b>
                        </a>
                    </td>
                    <td width=150 align=center>
                        </br>
                        <a href=media.php?module=spt style='text-decoration: none'>
                            <img src=images/tugas.png width=70px img alt='Icon SPT' border=none><br />
                            <b><font color='#00BFFF'>SPT</font></b>
                        </a>
                    </td>
                    <td width=150 align=center>
                        </br>
                        <a href=media.php?module=sppd style='text-decoration: none'>
                            <img src=images/dinas.png width=70px img alt='Icon SPPD' border=none><br />
                            <b><font color='#00BFFF'>SPPD</font></b>
                        </a>
                    </td>
                    <td width=150 align=center>
                        </br>
                        <a href=media.php?module=kwitansi style='text-decoration: none'>
                            <img src=images/kwitansi.png width=70px img alt='Icon Kwitansi' border=none><br />
                            <b><font color='#00BFFF'>Kwitansi</font></b>
                        </a>
                    </td>
                    <td width=150 align=center>
                        </br>
                        <a href=media.php?module=lpd style='text-decoration: none'>
                            <img src=images/laporan.png width=70px img alt='Icon Laporan' border=none><br />
                            <b><font color='#00BFFF'>Laporan Perjalanan Dinas</font></b></br></br>
                        </a>
                    </td>
                    <td width=150 align=center>
                        </br>
                        <a href=media.php?module=password style='text-decoration: none'>
                            <img src=images/pass.png width=70px img alt='Icon Password' border=none><br />
                            <b><font color='#00BFFF'>Ganti Password</font></b>
                        </a>
                    </td>
                </tr>
            </table>
            </br>
            </br>
            </br>
            </br>
            </br>
            </br>
            </br>
            </br>
            </br>
            </br>
            </br>
        </div>";
        echo "</br></br></br><p align=right>Login : $hari_ini, ";
        echo tgl_indo(date("Y m d")); 
        echo " | "; 
        echo date("H:i:s");
        echo " WIB</p>";
    }

    elseif($_SESSION['level']=="kadis") {
        echo "<div align='center' class='callout callout-info'>
            <h4 align='left'>Selamat Datang</h4>
            <p align='left'>Hai <b>$_SESSION[namauser]</b>, selamat datang di Sistem Informasi SPPD Dinas KOMINFO Kabupaten Pasaman.<br>
            Silahkan klik menu pilihan yang berada dikiri atau bawah untuk mengelola content website.</br></br></br></br></br></br></br></p>
            <table>
                <thead>
                    <th class='center' colspan=10></br><center>Control Panel</center></br></th>
                </thead>
                </br>
                <tr>
                    <td width=150 align=center>
                        </br>
                        <a href=media.php?module=nppt style='text-decoration: none'>
                            <img src=images/nota.png width=70px img alt='nota' border=none><br />
                            <b><font color='#00BFFF'>Nota Permintaan Perjalanan Dinas</font></b></br></br>
                        </a>
                    </td>
                    <td width=150 align=center>
                        </br>
                        <a href=media.php?module=lpd style='text-decoration: none'>
                            <img src=images/laporan.png width=70px img alt='laporan' border=none><br />
                            <b><font color='#00BFFF'>Laporan Perjalanan Dinas</font></b>
                        </a>
                    </td>
                    <td width=150 align=center>
                        </br>
                        <a href=media.php?module=kwitansi style='text-decoration: none'>
                            <img src=images/kwitansi.png width=70px img alt='kwitansi' border=none><br />
                            <b><font color='#00BFFF'>Manajemen Kwitansi</font></b>
                        </a>
                    </td>
                    <td width=150 align=center>
                        </br>
                        <a href=media.php?module=password style='text-decoration: none'>
                            <img src=images/pass.png width=70px img alt='password' border=none><br />
                            <b><font color='#00BFFF'>Ganti Password</font></b>
                        </a>
                    </td>
                </tr>
            </table>
            </br>
            </br>
            </br>
            </br>
            </br>
            </br>
            </br>
            </br>
            </br>
            </br>
            </br>
        </div>";
        echo "</br></br></br><p align=right>Login : $hari_ini, ";
        echo tgl_indo(date("Y m d"));
        echo " | ";
        echo date("H:i:s");
        echo " WIB</p>";
    }

    else {
        echo "<div align='center' class='callout callout-info'>
            <h4 align='left'>Selamat Datang</h4>
            <p align='left'>Hai <b>$_SESSION[namauser]</b>, selamat datang di Sistem Informasi SPPD Dinas KOMINFO Kabupaten Pasaman.<br>
            Silahkan klik menu pilihan yang berada dikiri atau bawah untuk mengelola content website.</br></br></br></br></br></br></br></p>
            <table>
                <thead>
                    <th class='center' colspan=10></br><center>Control Panel</center></br></th>
                </thead>
                </br>
                <tr>
                    <td width=150 align=center>
                        </br>
                        <a href=media.php?module=spt style='text-decoration: none'>
                            <img src=images/tugas.png width=70px img alt='SPT' border=none><br />
                            <b><font color='#00BFFF'>Manajemen SPT</font></b>
                        </a>
                    </td>
                    <td width=150 align=center>
                        </br>
                        <a href=media.php?module=lpd style='text-decoration: none'>
                            <img src=images/laporan.png width=70px img alt='LPD' border=none><br />
                            <b><font color='#00BFFF'>Laporan Perjalanan Dinas</font></b></br></br>
                        </a>
                    </td>
                    <td width=150 align=center>
                        </br>
                        <a href=media.php?module=password style='text-decoration: none'>
                            <img src=images/pass.png width=70px img alt='Ganti Password' border=none><br />
                            <b><font color='#00BFFF'>Ganti Password</font></b>
                        </a>
                    </td>
                    <td width=150 align=center>
                        </br>
                        <a href=logout.php style='text-decoration: none'>
                            <img src=images/logout.png width=70px img alt='Logout' border=none><br />
                            <b><font color='#00BFFF'>Keluar</font></b>
                        </a>
                    </td>
                </tr>
            </table>
            </br>
            </br>
            </br>
            </br>
            </br>
            </br>
            </br>
            </br>
            </br>
            </br>
            </br>
        </div>";
        echo "</br></br></br><p align=right>Login : $hari_ini, ";
        echo tgl_indo(date("Y m d")); 
        echo " | ";
        echo date("H:i:s");
        echo " WIB</p>";
    }
}

// Users
elseif ($mod=='pegawai') {
    include "modul/mod_pegawai/pegawai.php";
}
elseif ($mod=='spt') {
    include "modul/mod_spt/spt.php";
}
// Supplier
elseif ($mod=='nppt') {
    include "modul/mod_nppt/nppt.php";
}
elseif ($mod=='tambahnppt') {
    include "modul/mod_nppt/tambahnppt.php";
}
elseif ($mod=='sppd') {
    include "modul/mod_sppd/sppd.php";
	}
elseif ($mod=='pangkat') {
    include "modul/mod_pangkat/pangkat.php";
}
elseif ($mod=='jabatan') {
    include "modul/mod_jabatan/jabatan.php";
}
// Biaya
elseif ($mod=='biaya') {
    include "modul/mod_biaya/biaya.php";
}
elseif ($mod=='tujuan') {
    include "modul/mod_tujuan/tujuan.php";
}
elseif ($mod=='transportasi') {
    include "modul/mod_transportasi/transportasi.php";
}
elseif ($mod=='kwitansi') {
    include "modul/mod_kwitansi/kwitansi.php";
}
elseif ($mod=='ttdkwitansi') {
    include "modul/mod_ttdkwitansi/ttdkwitansi.php";
}
elseif ($mod=='lpd'){
    include "modul/mod_lpd/lpd.php";
}
elseif ($mod=='password') {
    include "modul/mod_password/password.php";
}
// Input
elseif ($mod=='input_nppt') {
    include "modul/mod_input_nppt/input_nppt.php";
}

// Apabila modul tidak ditemukan
else {
    echo "<b>MODUL BELUM ADA ATAU BELUM LENGKAP</b>";
}

?>
