<?php

// Mengaktifkan session php
session_start();
// Menghapus semua session
session_destroy();
// Mengalihkan halaman ke halaman login
header('location:index.php');

?>
