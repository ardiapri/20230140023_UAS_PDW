<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'asisten') {
    header("Location: ../login.php");
    exit();
}

require_once '../config.php';

$pageTitle = 'Laporan Masuk';
$activePage = 'laporan_masuk';

// Menggunakan header.php dari dalam folder asisten/templates
require_once __DIR__ . '/templates/header.php';

// Query laporan masuk
$query = "
    SELECT l.id, m.nama AS mahasiswa, mo.nama AS modul, l.nama_file, l.tanggal_upload
    FROM laporan l
    JOIN mahasiswa m ON l.mahasiswa_id = m.id
    JOIN modul mo ON l.modul_id = mo.id
    ORDER BY l.tanggal_upload DESC
";
$result = $conn->query($query);
?>

<div class="bg-white p-6 rounded-xl shadow-md">
    <h2 class="text-2xl font-bold mb-4">Laporan Masuk</h2>

    <?php if ($result && $result->num_rows > 0): ?>
        <table class="min-w-full bg-white border">
            <thead>
                <tr>
                    <th class="py-2 px-4 border-b">Mahasiswa</th>
                    <th class="py-2 px-4 border-b">Modul</th>
                    <th class="py-2 px-4 border-b">File</th>
                    <th class="py-2 px-4 border-b">Tanggal Upload</th>
                </tr>
            </thead>
            <tbody>
                <?php while($row = $result->fetch_assoc()): ?>
                <tr>
                    <td class="py-2 px-4 border-b"><?= htmlspecialchars($row['mahasiswa']); ?></td>
                    <td class="py-2 px-4 border-b"><?= htmlspecialchars($row['modul']); ?></td>
                    <td class="py-2 px-4 border-b">
                        <a href="../uploads/<?= htmlspecialchars($row['nama_file']); ?>" target="_blank" class="text-blue-600 hover:underline">
                            <?= htmlspecialchars($row['nama_file']); ?>
                        </a>
                    </td>
                    <td class="py-2 px-4 border-b"><?= $row['tanggal_upload']; ?></td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p class="text-gray-600">Belum ada laporan masuk.</p>
    <?php endif; ?>
</div>

<?php
// Menggunakan footer.php dari dalam folder asisten/templates
require_once __DIR__ . '/templates/footer.php';
?>
