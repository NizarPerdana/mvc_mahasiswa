<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Data Mahasiswa' ?></title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: Arial, sans-serif;
            background: #f0f4f8;
            padding: 30px;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            background: white;
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.08);
        }

        .nav-link { margin-bottom: 20px; }

        .header-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        h1 { color: #2c3e50; font-size: 1.5em; }

        /* Alert */
        .alert {
            padding: 12px 16px;
            border-radius: 6px;
            margin-bottom: 20px;
            font-size: 0.9em;
            line-height: 1.6;
        }
        .alert-success { background: #d5f5e3; color: #1e8449; border-left: 4px solid #2ecc71; }
        .alert-error   { background: #fadbd8; color: #c0392b; border-left: 4px solid #e74c3c; }

        /* Form Pencarian */
        .search-box {
            display: flex;
            gap: 10px;
            align-items: center;
            flex-wrap: wrap;
            background: #f8f9fa;
            padding: 16px 20px;
            border-radius: 8px;
            margin-bottom: 20px;
            border: 1px solid #e0e0e0;
        }

        .search-box input[type="text"],
        .search-box select {
            padding: 8px 12px;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 0.9em;
        }

        .search-box input[type="text"] { width: 250px; }
        .search-box select             { width: 200px; }

        .search-box input:focus,
        .search-box select:focus {
            outline: none;
            border-color: #3498db;
        }

        /* Tombol */
        .btn {
            display: inline-block;
            padding: 8px 16px;
            border-radius: 6px;
            text-decoration: none;
            font-size: 0.85em;
            font-weight: bold;
            border: none;
            cursor: pointer;
        }
        .btn-home      { background: #95a5a6; color: white; }
        .btn-primary   { background: #3498db; color: white; }
        .btn-success   { background: #2ecc71; color: white; }
        .btn-warning   { background: #e67e22; color: white; }
        .btn-danger    { background: #e74c3c; color: white; }
        .btn-reset     { background: #bdc3c7; color: #333; }
        .btn:hover     { opacity: 0.85; }
        .btn-sm        { padding: 5px 10px; font-size: 0.8em; }

        /* Tabel */
        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 0.87em;
        }

        thead tr {
            background: #2c3e50;
            color: white;
        }

        th, td {
            padding: 10px 12px;
            text-align: left;
            border: 1px solid #ddd;
        }

        tbody tr:nth-child(even) { background: #f8f9fa; }
        tbody tr:hover           { background: #eaf4fb; }

        .badge {
            display: inline-block;
            padding: 3px 10px;
            border-radius: 12px;
            font-size: 0.8em;
            font-weight: bold;
        }
        .badge-aktif    { background: #d5f5e3; color: #1e8449; }
        .badge-nonaktif { background: #fadbd8; color: #c0392b; }

        .aksi-group {
            display: flex;
            gap: 5px;
        }

        .empty-msg {
            text-align: center;
            padding: 40px;
            color: #999;
        }

        /* Info hasil filter */
        .result-info {
            font-size: 0.85em;
            color: #777;
            margin-bottom: 10px;
        }

        .result-info span {
            color: #2980b9;
            font-weight: bold;
        }
    </style>
</head>
<body>
<div class="container">

    <!-- Navigasi -->
    <div class="nav-link">
        <a href="<?= BASEURL ?>" class="btn btn-home">← Beranda</a>
    </div>

    <!-- Flash Message -->
    <?php if (!empty($flash)) : ?>
        <div class="alert alert-<?= $flash['type'] === 'success' ? 'success' : 'error' ?>">
            <?= $flash['message'] ?>
        </div>
    <?php endif; ?>

    <!-- Header -->
    <div class="header-row">
        <h1>📋 Data Mahasiswa</h1>
        <a href="<?= BASEURL ?>mahasiswa/create" class="btn btn-primary">+ Tambah Mahasiswa</a>
    </div>

    <!-- Form Pencarian & Filter -->
    <form action="<?= BASEURL ?>mahasiswa" method="GET" class="search-box">
        <input type="text"
               name="search"
               placeholder="🔍 Cari NPM atau Nama..."
               value="<?= htmlspecialchars($search ?? '') ?>">

        <select name="jurusan">
            <option value="">-- Semua Jurusan --</option>
            <option value="Teknik Informatika"
                <?= (($jurusan ?? '') === 'Teknik Informatika') ? 'selected' : '' ?>>
                Teknik Informatika
            </option>
            <option value="Sistem Informasi"
                <?= (($jurusan ?? '') === 'Sistem Informasi') ? 'selected' : '' ?>>
                Sistem Informasi
            </option>
        </select>

        <button type="submit" class="btn btn-success">🔍 Cari</button>
        <a href="<?= BASEURL ?>mahasiswa" class="btn btn-reset">↺ Reset</a>
    </form>

    <!-- Info hasil pencarian -->
    <?php if (!empty($search) || !empty($jurusan)) : ?>
        <p class="result-info">
            Menampilkan <span><?= count($mahasiswas) ?></span> hasil
            <?php if (!empty($search)) : ?>
                untuk kata kunci "<span><?= htmlspecialchars($search) ?></span>"
            <?php endif; ?>
            <?php if (!empty($jurusan)) : ?>
                — jurusan "<span><?= htmlspecialchars($jurusan) ?></span>"
            <?php endif; ?>
        </p>
    <?php endif; ?>

    <!-- Tabel Data -->
    <?php if (!empty($mahasiswas)) : ?>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>NPM</th>
                <th>Nama Lengkap</th>
                <th>Fakultas</th>
                <th>Jurusan</th>
                <th>Tempat Lahir</th>
                <th>Tanggal Lahir</th>
                <th>Jenis Kelamin</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1; foreach ($mahasiswas as $mhs) : ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= htmlspecialchars($mhs['npm']) ?></td>
                <td><?= htmlspecialchars($mhs['nama_lengkap']) ?></td>
                <td><?= htmlspecialchars($mhs['fakultas']) ?></td>
                <td><?= htmlspecialchars($mhs['jurusan']) ?></td>
                <td><?= htmlspecialchars($mhs['tempat_lahir']) ?></td>
                <td><?= date('d M Y', strtotime($mhs['tanggal_lahir'])) ?></td>
                <td><?= htmlspecialchars($mhs['jenis_kelamin']) ?></td>
                <td>
                    <?php if ($mhs['status_id'] == 1) : ?>
                        <span class="badge badge-aktif">Aktif</span>
                    <?php else : ?>
                        <span class="badge badge-nonaktif">Nonaktif</span>
                    <?php endif; ?>
                </td>
                <td>
                    <div class="aksi-group">
                        <a href="<?= BASEURL ?>mahasiswa/edit/<?= $mhs['id'] ?>"
                           class="btn btn-warning btn-sm">✏️ Edit</a>

                        <form action="<?= BASEURL ?>mahasiswa/delete/<?= $mhs['id'] ?>"
                              method="POST"
                              onsubmit="return confirm('Yakin hapus data <?= htmlspecialchars($mhs['nama_lengkap']) ?>?')">
                            <button type="submit" class="btn btn-danger btn-sm">🗑️ Hapus</button>
                        </form>
                    </div>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <p style="margin-top:12px; color:#777; font-size:0.85em;">
        Total: <strong><?= count($mahasiswas) ?></strong> mahasiswa
    </p>

    <?php else : ?>
    <div class="empty-msg">
        <?php if (!empty($search) || !empty($jurusan)) : ?>
            <p>😕 Tidak ada data yang cocok dengan pencarian.</p>
            <a href="<?= BASEURL ?>mahasiswa" class="btn btn-reset" style="margin-top:15px;">↺ Tampilkan Semua</a>
        <?php else : ?>
            <p>😕 Belum ada data mahasiswa.</p>
            <a href="<?= BASEURL ?>mahasiswa/create" class="btn btn-primary" style="margin-top:15px;">+ Tambah Sekarang</a>
        <?php endif; ?>
    </div>
    <?php endif; ?>

</div>
</body>
</html>