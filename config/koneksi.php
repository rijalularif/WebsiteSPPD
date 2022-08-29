<?php

// Database dan koneksi
$link       = mysqli_connect("localhost","root","") or die("Koneksi gagal");
$database   = mysqli_select_db($link, "db_sppd") or die("Database tidak bisa dibuka");

?>
