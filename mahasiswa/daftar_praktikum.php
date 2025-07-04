<?php
session_start();
require_once '../config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit;
}

$mahasiswa_id = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $praktikum_id = intval($_POST['praktikum_id']);

    // Cek apakah sudah terdaftar sebelumnya
    $cek = $conn->prepare("SELECT * FROM pendaftaran_praktikum WHERE mahasiswa_id = ? AND praktikum_id = ?");
    $cek->bind_param("ii", $mahasiswa_id, $praktikum_id);
    $cek->execute();
    $result = $cek->get_result();

    if ($result->num_rows > 0) {
        echo "❌ Kamu sudah terdaftar pada praktikum ini.";
    } else {
        $daftar = $conn->prepare("INSERT INTO pendaftaran_praktikum (mahasiswa_id, praktikum_id) VALUES (?, ?)");
        $daftar->bind_param("ii", $mahasiswa_id, $praktikum_id);

        if ($daftar->execute()) {
            echo "✅ Berhasil mendaftar praktikum!";
        } else {
            echo "❌ Gagal mendaftar. Silakan coba lagi.";
        }
    }

    echo '<br><a href="cari_praktikum.php" class="text-blue-600 underline">Kembali</a>';
    exit;
}

// Jika GET, tampilkan konfirmasi
if (!isset($_GET['id'])) {
    echo "ID praktikum tidak ditemukan.";
    exit;
}

$praktikum_id = intval($_GET['id']);
$praktikum = $conn->prepare("SELECT * FROM praktikum WHERE id = ?");
$praktikum->bind_param("i", $praktikum_id);
$praktikum->execute();
$data = $praktikum->get_result()->fetch_assoc();

if (!$data) {
    echo "Praktikum tidak ditemukan.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Konfirmasi Pendaftaran</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-6">
    <div class="max-w-xl mx-auto bg-white p-6 rounded shadow">
        <h2 class="text-2xl font-bold mb-4 text-blue-600">Konfirmasi Pendaftaran</h2>
        <p>Apakah kamu yakin ingin mendaftar ke praktikum berikut?</p>

        <div class="mt-4 mb-6">
            <h3 class="text-xl font-semibold"><?= htmlspecialchars($data['nama']) ?></h3>
            <p><?= htmlspecialchars($data['deskripsi']) ?></p>
        </div>

        <form method="post">
            <input type="hidden" name="praktikum_id" value="<?= $praktikum_id ?>">
            <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">Ya, Daftar</button>
            <a href="cari_praktikum.php" class="ml-4 text-blue-500 hover:underline">Batal</a>
        </form>
    </div>
</body>
</html>
