<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit;
}

$modul_id = isset($_GET['modul_id']) ? (int)$_GET['modul_id'] : 0;
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Unggah Laporan</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-6">
    <div class="max-w-lg mx-auto bg-white p-6 rounded shadow">
        <h2 class="text-xl font-bold text-gray-800 mb-4">Unggah Laporan Modul <?= $modul_id ?></h2>
        <form action="proses_unggah.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="modul_id" value="<?= $modul_id ?>">
            <div class="mb-4">
                <label for="laporan" class="block text-gray-700">File Laporan (PDF)</label>
                <input type="file" name="laporan" accept="application/pdf" class="mt-1 block w-full border p-2 rounded" required>
            </div>
            <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">Unggah</button>
        </form>
        <a href="dashboard.php" class="block mt-4 text-blue-500 hover:underline">← Kembali ke Dashboard</a>
    </div>
</body>
</html>
