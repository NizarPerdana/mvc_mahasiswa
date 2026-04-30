-- ============================================================
-- SESI 1 - SQL Setup
-- Proyek: mvc_mahasiswa (Praktikum FTI UNISKA 2026)
-- ============================================================

-- 1. Buat database
CREATE DATABASE IF NOT EXISTS `uniska_latihan_mvc_2026`
    CHARACTER SET utf8mb4
    COLLATE utf8mb4_unicode_ci;

USE `uniska_latihan_mvc_2026`;

-- 2. Buat tabel mahasiswa
CREATE TABLE IF NOT EXISTS `mahasiswa` (
    `id`            INT             NOT NULL AUTO_INCREMENT,
    `created_at`    TIMESTAMP       NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at`    TIMESTAMP       NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    `status_id`     INT             NOT NULL DEFAULT 1 COMMENT '1=Aktif, 0=Nonaktif',
    `npm`           VARCHAR(20)     NOT NULL UNIQUE,
    `nama_lengkap`  VARCHAR(100)    NOT NULL,
    `fakultas`      VARCHAR(100)    NOT NULL,
    `jurusan`       ENUM('Teknik Informatika','Sistem Informasi') NOT NULL,
    `tempat_lahir`  VARCHAR(50)     NOT NULL,
    `tanggal_lahir` DATE            NOT NULL,
    `jenis_kelamin` ENUM('Laki-laki','Perempuan') NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 3. Insert 3 data dummy awal (untuk tes Sesi 1)
INSERT INTO `mahasiswa`
    (`npm`, `nama_lengkap`, `fakultas`, `jurusan`, `tempat_lahir`, `tanggal_lahir`, `jenis_kelamin`, `status_id`)
VALUES
    ('2300101001', 'Ahmad Fauzi',      'Fakultas Teknologi Informasi', 'Teknik Informatika', 'Banjarmasin',  '2003-05-12', 'Laki-laki',  1),
    ('2300101002', 'Siti Rahayu',      'Fakultas Teknologi Informasi', 'Sistem Informasi',   'Banjarbaru',   '2003-08-20', 'Perempuan',  1),
    ('2300101003', 'Muhammad Rizky',   'Fakultas Teknologi Informasi', 'Teknik Informatika', 'Martapura',    '2002-11-03', 'Laki-laki',  1);

-- Catatan: Data dummy lengkap (5 mahasiswa) akan ditambahkan di Sesi 3
-- ============================================================
