<?php
// public/test_db.php
// File ini hanya untuk menguji koneksi database.
// HAPUS atau AMANKAN file ini setelah selesai testing di production!

require_once dirname(__DIR__) . '/config/database.php';

try {
    $pdo = getConnection();

    // Coba query sederhana
    $stmt = $pdo->query('SELECT 1');

    echo '<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Test Koneksi Database</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; }
        .success { color: green; font-size: 1.5em; font-weight: bold; }
        .info { color: #555; margin-top: 10px; }
    </style>
</head>
<body>
    <h2>🔌 Test Koneksi Database</h2>
    <p class="success">✅ Koneksi berhasil!</p>
    <p class="info">Terhubung ke database: <strong>' . DB_NAME . '</strong></p>
    <p class="info">Host: <strong>' . DB_HOST . '</strong></p>
    <p class="info">User: <strong>' . DB_USER . '</strong></p>
</body>
</html>';

} catch (Exception $e) {
    echo '<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Test Koneksi Database</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; }
        .error { color: red; font-size: 1.5em; font-weight: bold; }
    </style>
</head>
<body>
    <h2>🔌 Test Koneksi Database</h2>
    <p class="error">❌ Koneksi gagal!</p>
    <p>Error: ' . htmlspecialchars($e->getMessage()) . '</p>
</body>
</html>';
}
