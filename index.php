<?php
session_start();

if (isset($_SESSION['role'])) {
    if ($_SESSION['role'] === 'asisten') {
        header("Location: asisten/dashboard.php");
        exit;
    } elseif ($_SESSION['role'] === 'mahasiswa') {
        header("Location: mahasiswa/dashboard.php");
        exit;
    }
} else {
    header("Location: login.php");
    exit;
}
?>
