# mvc_mahasiswa - Praktikum FTI UNISKA 2026

Aplikasi CRUD Mahasiswa berbasis PHP MVC tanpa framework.

## Anggota Kelompok
| No | Nama | Peran |
|----|------|-------|
| 1  | (isi nama) | Backend Engineer (BE) |
| 2  | (isi nama) | Frontend Engineer (FE) |
| 3  | (isi nama) | Documentation & Debugging Officer (DDO) |

## Cara Menjalankan

1. Pastikan XAMPP sudah berjalan (Apache + MySQL aktif).
2. Clone/salin folder `mvc_mahasiswa` ke `C:/xampp/htdocs/`.
3. Buka **phpMyAdmin**, import file `docs/sesi1_database.sql`.
4. Buka browser, akses: `http://localhost/mvc_mahasiswa/public/test_db.php`
5. Jika muncul **"Koneksi berhasil"**, setup selesai ✅

## Struktur Folder

```
mvc_mahasiswa/
├── app/
│   ├── controllers/
│   ├── models/
│   └── views/
│       ├── layouts/
│       ├── home/
│       └── mahasiswa/
├── config/
│   └── database.php
├── core/
├── public/
│   ├── index.php
│   ├── test_db.php
│   └── .htaccess
├── docs/
│   └── sesi1_database.sql
└── .htaccess
```

## Progress Sesi
- [x] Sesi 1 - Persiapan proyek & struktur MVC
- [ ] Sesi 2 - Routing & BaseController
- [ ] Sesi 3 - Model & tampil data
- [ ] Sesi 4 - Tambah data (Create)
- [ ] Sesi 5 - Edit & Hapus (Update & Delete)
- [ ] Sesi 6 - Pencarian & Filter
- [ ] Sesi 7 - Layout Bootstrap
- [ ] Sesi 8 - Export CSV & PDF
