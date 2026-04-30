    <?php
// config/database.php
// Konfigurasi koneksi database menggunakan PDO

define('DB_HOST', 'localhost');
define('DB_NAME', 'uniska_latihan_mvc_2026');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_CHARSET', 'utf8');

/**
 * Mengembalikan koneksi PDO ke database.
 * Menggunakan pola Singleton agar koneksi hanya dibuat sekali.
 */
function getConnection(): PDO
{
    static $pdo = null;

    if ($pdo === null) {
        $dsn = 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=' . DB_CHARSET;
        $options = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ];

        try {
            $pdo = new PDO($dsn, DB_USER, DB_PASS, $options);
        } catch (PDOException $e) {
            // Tampilkan pesan error (hanya untuk development)
            die('Koneksi database gagal: ' . $e->getMessage());
        }
    }

    return $pdo;
}
