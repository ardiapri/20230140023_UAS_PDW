<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit;
}

require_once '../config.php';

$praktikum_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

// Ambil detail praktikum dari database
$query = $conn->prepare("SELECT * FROM praktikum WHERE id = ?");
$query->bind_param("i", $praktikum_id);
$query->execute();
$result = $query->get_result();

if ($result->num_rows === 0) {
    echo "Praktikum tidak ditemukan.";
    exit;
}

$data = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Detail Praktikum</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-6">
    <div class="max-w-3xl mx-auto bg-white p-6 rounded shadow">
        <h2 class="text-2xl font-bold text-blue-600 mb-2"><?= htmlspecialchars($data['nama']) ?></h2>
        <p><?= nl2br(htmlspecialchars($data['deskripsi'])) ?></p>
        <a href="praktikum_saya.php" class="mt-4 inline-block bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Kembali ke Praktikum Saya</a>
    </div>
</body>
</html>
