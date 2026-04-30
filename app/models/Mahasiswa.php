<?php
// app/models/Mahasiswa.php

class Mahasiswa
{
    private PDO $db;

    public function __construct()
    {
        $this->db = Database::getInstance();
    }

    public function getAll(): array
    {
        $stmt = $this->db->query('SELECT * FROM mahasiswa ORDER BY id DESC');
        return $stmt->fetchAll();
    }
}