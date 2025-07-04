<?php
// Hindari pendefinisian ulang jika file ini dipanggil lebih dari sekali
if (!defined('DB_SERVER')) define('DB_SERVER', '127.0.0.1');
if (!defined('DB_USERNAME')) define('DB_USERNAME', 'root');
if (!defined('DB_PASSWORD')) define('DB_PASSWORD', '');
if (!defined('DB_NAME')) define('DB_NAME', 'pengumpulantugas'); // Ganti sesuai nama DB kamu

// Cek apakah koneksi sudah ada sebelumnya
if (!isset($conn)) {
    $conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

    // Cek koneksi
    if ($conn->connect_error) {
        die("Koneksi ke database gagal: " . $conn->connect_error);
    }
}
?>
