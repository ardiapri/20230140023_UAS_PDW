<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit;
}

$modul_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

require_once '../config.php'; // koneksi ke database

// Query modul berdasarkan ID
$query = $conn->prepare("SELECT * FROM modul WHERE id = ?");
$query->bind_param("i", $modul_id);
$query->execute();
$result = $query->get_result();

if ($result->num_rows == 0) {
    echo "Modul tidak ditemukan.";
    exit;
}

$modul = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Detail Modul</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-6">
    <div class="max-w-3xl mx-auto bg-white shadow p-6 rounded">
        <h2 class="text-2xl font-bold text-blue-600 mb-4"><?= htmlspecialchars($modul['judul']) ?></h2>
        <p><?= nl2br(htmlspecialchars($modul['deskripsi'])) ?></p>
        <a href="dashboard.php" class="mt-4 inline-block text-white bg-blue-500 px-4 py-2 rounded hover:bg-blue-600">Kembali</a>
    </div>
</body>
</html>
