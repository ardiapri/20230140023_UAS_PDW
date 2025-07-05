<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'asisten') {
    header("Location: ../login.php");
    exit();
}

require_once '../config.php';
$pageTitle = 'Manajemen Modul';
$activePage = 'manajemen_modul';
require_once '../templates/header_asisten.php';

// Ambil daftar modul
$query = "SELECT * FROM modul";
$result = $conn->query($query);
?>

<!-- CONTAINER HEADER -->
<div class="bg-purple-800/70 text-white p-6 rounded-xl shadow-lg mb-6">
    <h2 class="text-2xl font-bold mb-2">📚 Manajemen Modul</h2>
    <p class="opacity-90">Kelola data modul untuk setiap praktikum yang tersedia.</p>
</div>

<!-- CONTAINER TABEL (MENYATU DENGAN LAPORAN MASUK) -->
<div class="bg-purple-700/60 text-white p-6 rounded-xl shadow-lg">
    <?php if ($result->num_rows > 0): ?>
        <div class="overflow-x-auto">
            <table class="min-w-full table-auto border-collapse">
                <thead>
                    <tr class="border-b border-purple-300">
                        <th class="py-2 px-4 text-left">No</th>
                        <th class="py-2 px-4 text-left">Nama Modul</th>
                        <th class="py-2 px-4 text-left">Deskripsi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; while($row = $result->fetch_assoc()): ?>
                    <tr class="border-b border-purple-400 hover:bg-purple-600/40 transition">
                        <td class="py-2 px-4"><?= $no++; ?></td>
                        <td class="py-2 px-4"><?= htmlspecialchars($row['nama']); ?></td>
                        <td class="py-2 px-4"><?= htmlspecialchars($row['deskripsi']); ?></td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    <?php else: ?>
        <p class="text-purple-100">Tidak ada modul tersedia.</p>
    <?php endif; ?>

    <!-- Tombol Tambah Modul -->
    <div class="mt-6">
        <a href="tambah_modul.php" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded font-semibold inline-block transition">
            ➕ Tambah Modul Baru
        </a>
    </div>
</div>

<?php require_once '../templates/footer_asisten.php'; ?>
