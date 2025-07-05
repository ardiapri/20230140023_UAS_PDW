<?php
// Mulai session jika belum dimulai
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title><?= $pageTitle ?? 'Panel Asisten'; ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .bg-dashboard-asisten {
            background-image: url('../img/pexels-steve-12537428.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;
        }

        .overlay {
            background-color: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(4px);
            border-radius: 12px;
            padding: 1.5rem;
        }
    </style>
</head>
<body class="bg-gray-100">

<div class="flex min-h-screen">
    <!-- Sidebar -->
    <aside class="w-64 bg-gray-800 text-white flex flex-col">
        <div class="p-6 text-center border-b border-gray-700">
            <h3 class="text-xl font-bold">Panel Asisten</h3>
            <p class="text-sm text-gray-400 mt-1"><?= htmlspecialchars($_SESSION['nama'] ?? 'Asisten'); ?></p>
        </div>
        <nav class="flex-grow">
            <ul class="space-y-2 p-4">
                <?php 
                    $activeClass = 'bg-gray-900 text-white';
                    $inactiveClass = 'text-gray-300 hover:bg-gray-700 hover:text-white';
                ?>
                <li>
                    <a href="dashboard.php" class="<?= ($activePage == 'dashboard') ? $activeClass : $inactiveClass ?> flex items-center px-4 py-3 rounded-md transition">
                        🏠 <span class="ml-2">Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="modul.php" class="<?= ($activePage == 'modul') ? $activeClass : $inactiveClass ?> flex items-center px-4 py-3 rounded-md transition">
                        📚 <span class="ml-2">Manajemen Modul</span>
                    </a>
                </li>
                <li>
                    <a href="laporan_masuk.php" class="<?= ($activePage == 'laporan_masuk') ? $activeClass : $inactiveClass ?> flex items-center px-4 py-3 rounded-md transition">
                        📄 <span class="ml-2">Laporan Masuk</span>
                    </a>
                </li>
                <li>
                    <a href="../logout.php" class="text-red-400 hover:bg-red-700 hover:text-white flex items-center px-4 py-3 rounded-md transition">
                        🔓 <span class="ml-2">Logout</span>
                    </a>
                </li>
            </ul>
        </nav>
    </aside>

    <!-- Konten Utama -->
    <main class="flex-1 p-6 bg-dashboard-asisten">
        <div class="overlay">
            <header class="flex items-center justify-between mb-6">
                <h1 class="text-3xl font-bold text-gray-800"><?= $pageTitle ?? ''; ?></h1>
                <a href="../logout.php" class="bg-red-500 hover:bg-red-600 text-white font-semibold py-2 px-4 rounded-lg transition">
                    Logout
                </a>
            </header>
