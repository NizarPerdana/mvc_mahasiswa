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
            max-width: 1100px;
            margin: 0 auto;
            background: white;
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.08);
        }

        .header-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        h1 { color: #2c3e50; font-size: 1.5em; }

        .btn {
            display: inline-block;
            padding: 8px 18px;
            border-radius: 6px;
            text-decoration: none;
            font-size: 0.9em;
            font-weight: bold;
        }
        .btn-home    { background: #95a5a6; color: white; }
        .btn-primary { background: #3498db; color: white; }
        .btn:hover   { opacity: 0.85; }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 0.88em;
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

        .empty-msg {
            text-align: center;
            padding: 40px;
            color: #999;
        }

        .nav-link {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
<div class="container">

    <!-- Navigasi atas -->
    <div class="nav-link">
        <a href="<?= BASEURL ?>" class="btn btn-home">← Beranda</a>
    </div>

    <!-- Header -->
    <div class="header-row">
        <h1>📋 Data Mahasiswa</h1>
        <a href="<?= BASEURL ?>mahasiswa/create" class="btn btn-primary">+ Tambah Mahasiswa</a>
    </div>

    <!-- Tabel -->
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
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <p style="margin-top:12px; color:#777; font-size:0.85em;">
        Total: <strong><?= count($mahasiswas) ?></strong> mahasiswa
    </p>

    <?php else : ?>
    <div class="empty-msg">
        <p>😕 Belum ada data mahasiswa.</p>
        <a href="<?= BASEURL ?>mahasiswa/create" class="btn btn-primary" style="margin-top:15px;">+ Tambah Sekarang</a>
    </div>
    <?php endif; ?>

</div>
</body>
</html>