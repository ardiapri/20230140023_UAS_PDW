<?php
session_start();
require_once '../config.php'; // koneksi database
$pageTitle = 'Cari Praktikum';
$activePage = 'cari_praktikum';
require_once 'templates/header_mahasiswa.php';
?>

<div class="bg-white p-6 rounded-xl shadow-md">
    <h2 class="text-2xl font-bold mb-4"><a href="daftar_praktikum.php?id=1" class="text-sm text-white bg-green-500 px-3 py-1 rounded mt-2 inline-block">Daftar</a>
</h2>

    <?php
    // Ambil daftar praktikum dari database
    $query = "SELECT * FROM mata_praktikum";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        echo '<ul class="space-y-4">';
        while ($row = $result->fetch_assoc()) {
            echo '<li class="p-4 border rounded-md hover:bg-gray-50">';
            echo '<h3 class="text-xl font-semibold text-gray-800">' . htmlspecialchars($row['nama_praktikum']) . '</h3>';
            echo '<p class="text-gray-600">' . htmlspecialchars($row['deskripsi']) . '</p>';
            echo '<a href="daftar_praktikum.php?id=' . $row['id'] . '" class="text-sm text-white bg-green-500 px-3 py-1 rounded mt-2 inline-block">Daftar</a>';
            echo '</li>';
        }
        echo '</ul>';
    } else {
        echo '<p class="text-gray-600">Belum ada data praktikum.</p>';
    }

    ?>
</div>

<?php require_once 'templates/footer_mahasiswa.php'; ?>
