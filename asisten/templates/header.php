<?php
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
</head>
<body class="bg-gray-100">

<div class="flex h-screen">
    <!-- Sidebar -->
    <aside class="w-64 bg-gray-800 text-white flex flex-col">
        <div class="p-6 text-center border-b border-gray-700">
            <h3 class="text-xl font-bold">Panel Asisten</h3>
            <p class="text-sm text-gray-400 mt-1"><?= htmlspecialchars($_SESSION['nama'] ?? 'Asisten'); ?></p>
        </div>
        <nav class="flex-grow">
            <ul class="space-y-2 p-4">
                <li>
                    <a href="dashboard.php" class="<?= ($activePage == 'dashboard') ? 'bg-gray-900 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' ?> flex items-center px-4 py-3 rounded-md">🏠 Dashboard</a>
                </li>
                <li>
                    <a href="modul.php" class="<?= ($activePage == 'modul') ? 'bg-gray-900 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' ?> flex items-center px-4 py-3 rounded-md">📚 Manajemen Modul</a>
                </li>
                <li>
                    <a href="laporan_masuk.php" class="<?= ($activePage == 'laporan_masuk') ? 'bg-gray-900 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' ?> flex items-center px-4 py-3 rounded-md">📄 Laporan Masuk</a>
                </li>
            </ul>
        </nav>
    </aside>

    <main class="flex-1 p-6">
