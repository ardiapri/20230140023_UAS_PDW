<?php
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'mahasiswa') {
    header("Location: ../login.php");
    exit;
}

require_once '../config.php';

$pageTitle = 'Praktikum Saya';
$activePage = 'praktikum_saya';
require_once 'templates/header_mahasiswa.php';

$mahasiswa_id = $_SESSION['user_id'];
$sql = "SELECT p.id, p.nama, p.deskripsi 
        FROM pendaftaran_praktikum pp 
        JOIN praktikum p ON pp.praktikum_id = p.id 
        WHERE pp.mahasiswa_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $mahasiswa_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<div class="bg-white p-6 rounded-xl shadow-md">
    <h2 class="text-2xl font-bold mb-4">Praktikum yang Diikuti</h2>

    <?php if ($result->num_rows > 0): ?>
        <ul class="space-y-4">
            <?php while ($row = $result->fetch_assoc()): ?>
                <li class="p-4 border rounded-md hover:bg-gray-50">
                    <h3 class="text-xl font-semibold text-blue-600"><?= htmlspecialchars($row['nama']) ?></h3>
                    <p class="text-gray-600"><?= htmlspecialchars($row['deskripsi']) ?></p>
                    <a href="detail_praktikum.php?id=<?= $row['id'] ?>" class="text-sm text-white bg-blue-500 px-3 py-1 rounded mt-2 inline-block">Lihat Detail</a>
                </li>
            <?php endwhile; ?>
        </ul>
    <?php else: ?>
        <p class="text-gray-600">Kamu belum mendaftar ke praktikum manapun.</p>
    <?php endif; ?>
</div>

<?php require_once 'templates/footer_mahasiswa.php'; ?>
