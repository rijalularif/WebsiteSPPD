<?php

// Mengaktifkan session pada php
session_start();
error_reporting(0);

// Menghubungkan php dengan koneksi database
include "config/koneksi.php";

// Menangkap data yang dikirim dari form login
if ($_POST['level']=="operator") {
	$username	= $_POST['username'];
	$password	= $_POST['password'];
	$level		= $_POST['level'];
	$login		= mysqli_query($link, "SELECT * FROM admins WHERE username='$username' AND password='$password' AND level='$level'");
	$ketemu		= mysqli_num_rows($login);
	$operator	= mysqli_fetch_array($login);
	// Apabila username dan password operator ditemukan
	if ($ketemu > 0) {
		$_SESSION['namauser']	= $operator['username'];
		$_SESSION['passuser']	= $operator['password'];
		$_SESSION['level']		= $operator['level'];
		header('location:media.php?module=home');
	}
	else {
		header('location:index.php?log=2');
	}
}

elseif ($_POST['level']=="kadis") {
	$username	= $_POST['username'];
	$password	= $_POST['password'];$level=$_POST['level'];
	$login		= mysqli_query($link, "SELECT * FROM admins WHERE username='$username' AND password='$password' AND level='$level'");
	$ketemu		= mysqli_num_rows($login);
	$kadis		= mysqli_fetch_array($login);
	// Apabila username dan password kadis ditemukan
	if ($ketemu > 0) {
		$_SESSION['namauser']	= $kadis['username'];
		$_SESSION['passuser']	= $kadis['password'];
		$_SESSION['level']		= $kadis['level'];
		header('location:media.php?module=home');
	}
	else {
		header('location:index.php?log=2');
	}
}

else {
	$username	= $_POST['username'];
	$password	= $_POST['password'];
	$login		= mysqli_query($link, "SELECT * FROM pegawai WHERE username='$username' AND password='$password'");
	$ketemu		= mysqli_num_rows($login);
	$user		= mysqli_fetch_array($login);
	// Apabila username dan password pegawai ditemukan
	if ($ketemu > 0) {
		session_start();
		$_SESSION['id_pegawai']	= $user['id_pegawai'];
		$_SESSION['namauser']	= $user['username'];
		$_SESSION['passuser']	= $user['password'];
		$_SESSION['level']		= $user['level'];
		header('location:media.php?module=home');
	}
	else {
		header('location:index.php?log=2');
	}
}

?>
