<?php
// core/Database.php
// Kelas Database sebagai wrapper PDO, menggunakan Singleton

class Database
{
    private static ?PDO $instance = null;

    // Tidak bisa di-instantiate dari luar
    private function __construct() {}

    public static function getInstance(): PDO
    {
        if (self::$instance === null) {
            self::$instance = getConnection(); // pakai fungsi dari config/database.php
        }
        return self::$instance;
    }
}