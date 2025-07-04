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

<div class="bg-white p-6 rounded-xl shadow-md">
    <h2 class="text-2xl font-bold mb-4">Manajemen Modul</h2>

    <a href="tambah_modul.php" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 mb-4 inline-block">Tambah Modul Baru</a>

    <?php if ($result->num_rows > 0): ?>
        <table class="min-w-full bg-white border mt-4">
            <thead>
                <tr>
                    <th class="py-2 px-4 border-b">No</th>
                    <th class="py-2 px-4 border-b">Nama Modul</th>
                    <th class="py-2 px-4 border-b">Deskripsi</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1; while($row = $result->fetch_assoc()): ?>
                <tr>
                    <td class="py-2 px-4 border-b"><?php echo $no++; ?></td>
                    <td class="py-2 px-4 border-b"><?php echo htmlspecialchars($row['nama']); ?></td>
                    <td class="py-2 px-4 border-b"><?php echo htmlspecialchars($row['deskripsi']); ?></td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>Tidak ada modul tersedia.</p>
    <?php endif; ?>
</div>

<?php
require_once '../templates/footer_asisten.php';
?>
