<?php
// Pastikan session sudah dimulai
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Cek jika pengguna belum login
if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Panel Mahasiswa - <?php echo $pageTitle ?? 'Dashboard'; ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            background-image: url('../img/istockphoto-956227662-612x612.jpg'); /* Ganti path jika berbeda */
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;
        }

        /* Overlay gelap untuk membuat kontras teks tetap nyaman dibaca */
        .overlay::before {
            content: '';
            position: fixed;
            top: 0; left: 0;
            width: 100%; height: 100%;
            background: rgba(0, 0, 0, 0.4);
            z-index: -1;
        }
    </style>
</head>
<body class="bg-gray-100 font-sans overlay">

<!-- NAVIGASI -->
<nav class="bg-blue-600 shadow-lg bg-opacity-90">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16">

            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <span class="text-white text-2xl font-bold">SIMPRAK</span>
                </div>
                <div class="hidden md:block">
                    <div class="ml-10 flex items-baseline space-x-4">
                        <?php 
                            $activeClass = 'bg-blue-700 text-white';
                            $inactiveClass = 'text-gray-200 hover:bg-blue-700 hover:text-white';
                        ?>
                        <a href="/SistemPengumpulanTugas-main/mahasiswa/dashboard.php" class="<?php echo ($activePage == 'dashboard') ? $activeClass : $inactiveClass; ?> px-3 py-2 rounded-md text-sm font-medium">Dashboard</a>

                        <a href="/SistemPengumpulanTugas-main/mahasiswa/praktikum_saya.php" class="<?php echo ($activePage == 'praktikum_saya') ? $activeClass : $inactiveClass; ?> px-3 py-2 rounded-md text-sm font-medium">Praktikum Saya</a>

                        <a href="/SistemPengumpulanTugas-main/mahasiswa/cari_praktikum.php" class="<?php echo ($activePage == 'cari_praktikum') ? $activeClass : $inactiveClass; ?> px-3 py-2 rounded-md text-sm font-medium">Cari Praktikum</a>
                    </div>
                </div>
            </div>

            <div class="hidden md:block">
                <div class="ml-4 flex items-center md:ml-6">
                    <a href="/SistemPengumpulanTugas-main/logout.php" class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded-md transition-colors duration-300">
                        Logout
                    </a>
                </div>
            </div>

        </div>
    </div>
</nav>

<!-- KONTEN UTAMA -->
<div class="container mx-auto p-6 lg:p-8">
