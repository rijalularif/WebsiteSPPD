<?php

require 'phpmailer/Exception.php';
require 'phpmailer/PHPMailer.php';
require 'phpmailer/SMTP.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

function generateRandomString($length = 10) {
    $characters         = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength   = strlen($characters);
    $randomString       = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

// Cek email apakah ada atau tidak
require "config/koneksi.php";
$cek_email = mysqli_query($link, "SELECT * FROM admins WHERE email = '$_POST[email]'");
$email = mysqli_fetch_array($cek_email);
if(empty($email) == FALSE) {
    // Buat password baru
    $password_baru = generateRandomString();
	// Update password lama dengan yang baru
	mysqli_query($link, "UPDATE admins SET password = '$password_baru' WHERE email = '$_POST[email]'");
	// Jika email ditemukan, maka kirim password ke email
	// The message
    $msg = "Password Baru Anda Sudah Siap Digunakan. Password Baru Anda Adalah <b>'.$password_baru.'</b>.";
    // Use wordwrap() if lines are longer than 70 characters
    $msg = wordwrap($msg,70);
    // Send email
    mail($_POST['email'],"Lupa Password", $msg);
}
header("Location: lupapassword.php?log=1");

?>
