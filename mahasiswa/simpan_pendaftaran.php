<?php
session_start();
require_once '../config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit;
}

$mahasiswa_id = $_SESSION['user_id'];
$praktikum_id = intval($_POST['praktikum_id'] ?? 0);

if (!$praktikum_id) {
    echo "❌ Praktikum belum dipilih.";
    exit;
}

// Cek apakah sudah terdaftar
$stmt = $conn->prepare("SELECT * FROM pendaftaran_praktikum WHERE mahasiswa_id = ? AND praktikum_id = ?");
$stmt->bind_param("ii", $mahasiswa_id, $praktikum_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    echo "❌ Kamu sudah terdaftar pada praktikum ini.";
} else {
    $insert = $conn->prepare("INSERT INTO pendaftaran_praktikum (mahasiswa_id, praktikum_id) VALUES (?, ?)");
    $insert->bind_param("ii", $mahasiswa_id, $praktikum_id);

    if ($insert->execute()) {
        echo "✅ Berhasil mendaftar ke praktikum!";
    } else {
        echo "❌ Gagal mendaftar.";
    }
}
?>
<br><a href="form_daftar_praktikum.php" class="text-blue-500 underline">Kembali</a>
