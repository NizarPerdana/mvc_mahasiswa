<?php
// app/models/Mahasiswa.php

class Mahasiswa
{
    private PDO $db;

    public function __construct()
    {
        $this->db = Database::getInstance();
    }

    /**
     * Ambil semua data mahasiswa
     */
    public function getAll(): array
    {
        $stmt = $this->db->query('SELECT * FROM mahasiswa ORDER BY id DESC');
        return $stmt->fetchAll();
    }

    /**
     * Ambil satu data mahasiswa berdasarkan ID
     */
    public function find(int $id): ?array
    {
        $stmt = $this->db->prepare('SELECT * FROM mahasiswa WHERE id = :id LIMIT 1');
        $stmt->execute([':id' => $id]);
        $result = $stmt->fetch();
        return $result ?: null;
    }

    /**
     * Cek apakah NPM sudah ada (exclude id tertentu untuk keperluan edit)
     */
    public function isNpmExist(string $npm, int $excludeId = 0): bool
    {
        $stmt = $this->db->prepare(
            'SELECT COUNT(*) FROM mahasiswa WHERE npm = :npm AND id != :id'
        );
        $stmt->execute([':npm' => $npm, ':id' => $excludeId]);
        return $stmt->fetchColumn() > 0;
    }

    /**
     * Simpan data mahasiswa baru
     */
    public function create(array $data): bool
    {
        $sql = 'INSERT INTO mahasiswa 
                    (npm, nama_lengkap, fakultas, jurusan, tempat_lahir, tanggal_lahir, jenis_kelamin, status_id)
                VALUES 
                    (:npm, :nama_lengkap, :fakultas, :jurusan, :tempat_lahir, :tanggal_lahir, :jenis_kelamin, 1)';

        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            ':npm'           => $data['npm'],
            ':nama_lengkap'  => $data['nama_lengkap'],
            ':fakultas'      => $data['fakultas'],
            ':jurusan'       => $data['jurusan'],
            ':tempat_lahir'  => $data['tempat_lahir'],
            ':tanggal_lahir' => $data['tanggal_lahir'],
            ':jenis_kelamin' => $data['jenis_kelamin'],
        ]);
    }

    /**
     * Update data mahasiswa
     */
    public function update(int $id, array $data): bool
    {
        $sql = 'UPDATE mahasiswa SET
                    npm           = :npm,
                    nama_lengkap  = :nama_lengkap,
                    fakultas      = :fakultas,
                    jurusan       = :jurusan,
                    tempat_lahir  = :tempat_lahir,
                    tanggal_lahir = :tanggal_lahir,
                    jenis_kelamin = :jenis_kelamin
                WHERE id = :id';

        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            ':npm'           => $data['npm'],
            ':nama_lengkap'  => $data['nama_lengkap'],
            ':fakultas'      => $data['fakultas'],
            ':jurusan'       => $data['jurusan'],
            ':tempat_lahir'  => $data['tempat_lahir'],
            ':tanggal_lahir' => $data['tanggal_lahir'],
            ':jenis_kelamin' => $data['jenis_kelamin'],
            ':id'            => $id,
        ]);
    }

    /**
     * Hapus data mahasiswa
     */
    public function delete(int $id): bool
    {
        $stmt = $this->db->prepare('DELETE FROM mahasiswa WHERE id = :id');
        return $stmt->execute([':id' => $id]);
    }
}