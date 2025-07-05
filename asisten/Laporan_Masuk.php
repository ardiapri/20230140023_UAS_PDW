<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'asisten') {
    header("Location: ../login.php");
    exit();
}

require_once '../config.php';

$pageTitle = 'Laporan Masuk';
$activePage = 'laporan_masuk';

// Header asisten
require_once __DIR__ . '/templates/header.php';

// Ambil data laporan
$query = "
    SELECT l.id, m.nama AS mahasiswa, mo.nama AS modul, l.nama_file, l.tanggal_upload
    FROM laporan l
    JOIN mahasiswa m ON l.mahasiswa_id = m.id
    JOIN modul mo ON l.modul_id = mo.id
    ORDER BY l.tanggal_upload DESC
";
$result = $conn->query($query);
?>

<!-- CONTAINER UTAMA -->
<div class="bg-purple-800/70 text-white p-6 rounded-xl shadow-lg mb-6">
    <h2 class="text-2xl font-bold mb-2">📥 Laporan Masuk</h2>
    <p class="opacity-90">Berikut adalah daftar laporan dari mahasiswa yang sudah diunggah.</p>
</div>

<!-- CONTAINER TABEL -->
<div class="bg-purple-700/60 p-6 rounded-xl shadow-md text-white overflow-x-auto">
    <?php if ($result && $result->num_rows > 0): ?>
        <table class="min-w-full table-auto border-collapse">
            <thead>
                <tr class="border-b border-purple-400">
                    <th class="py-2 px-4 text-left">Mahasiswa</th>
                    <th class="py-2 px-4 text-left">Modul</th>
                    <th class="py-2 px-4 text-left">File</th>
                    <th class="py-2 px-4 text-left">Tanggal Upload</th>
                </tr>
            </thead>
            <tbody>
                <?php while($row = $result->fetch_assoc()): ?>
                <tr class="border-b border-purple-400 hover:bg-purple-600/50 transition">
                    <td class="py-2 px-4"><?= htmlspecialchars($row['mahasiswa']); ?></td>
                    <td class="py-2 px-4"><?= htmlspecialchars($row['modul']); ?></td>
                    <td class="py-2 px-4">
                        <a href="../uploads/<?= htmlspecialchars($row['nama_file']); ?>" target="_blank" class="text-blue-200 hover:underline">
                            <?= htmlspecialchars($row['nama_file']); ?>
                        </a>
                    </td>
                    <td class="py-2 px-4"><?= $row['tanggal_upload']; ?></td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p class="text-purple-100">Belum ada laporan masuk.</p>
    <?php endif; ?>
</div>

<?php require_once __DIR__ . '/templates/footer.php'; ?>
