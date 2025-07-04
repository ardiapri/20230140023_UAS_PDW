<?php
session_start();
require_once '../config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit;
}

// Ambil semua data praktikum dari DB
$result = $conn->query("SELECT * FROM praktikum");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Form Pendaftaran Praktikum</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-8">
    <div class="max-w-xl mx-auto bg-white p-6 rounded-lg shadow-md">
        <h2 class="text-2xl font-bold text-blue-600 mb-6">Form Pendaftaran Praktikum</h2>

        <form action="simpan_pendaftaran.php" method="POST">
            <label class="block mb-2 text-gray-700 font-medium">Pilih Praktikum:</label>
            <select name="praktikum_id" required class="w-full p-2 border rounded mb-6">
                <option value="">-- Pilih Praktikum --</option>
                <?php while($row = $result->fetch_assoc()): ?>
                    <option value="<?= $row['id'] ?>"><?= htmlspecialchars($row['nama']) ?></option>
                <?php endwhile; ?>
            </select>

            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                Daftar Praktikum
            </button>
        </form>

        <div class="mt-4">
            <a href="dashboard.php" class="text-sm text-blue-500 hover:underline">← Kembali ke Dashboard</a>
        </div>
    </div>
</body>
</html>
