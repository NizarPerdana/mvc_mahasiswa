<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Tambah Mahasiswa' ?></title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: Arial, sans-serif;
            background: #f0f4f8;
            padding: 30px;
        }

        .container {
            max-width: 650px;
            margin: 0 auto;
            background: white;
            border-radius: 10px;
            padding: 35px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.08);
        }

        .nav-link { margin-bottom: 20px; }

        h1 { color: #2c3e50; font-size: 1.4em; margin-bottom: 25px; }

        .alert {
            padding: 12px 16px;
            border-radius: 6px;
            margin-bottom: 20px;
            font-size: 0.9em;
            line-height: 1.6;
        }
        .alert-success { background: #d5f5e3; color: #1e8449; border-left: 4px solid #2ecc71; }
        .alert-error   { background: #fadbd8; color: #c0392b; border-left: 4px solid #e74c3c; }

        .form-group {
            margin-bottom: 18px;
        }

        label {
            display: block;
            font-size: 0.88em;
            font-weight: bold;
            color: #444;
            margin-bottom: 6px;
        }

        input[type="text"],
        input[type="date"],
        select {
            width: 100%;
            padding: 9px 12px;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 0.92em;
            transition: border 0.2s;
        }

        input:focus, select:focus {
            outline: none;
            border-color: #3498db;
        }

        .radio-group {
            display: flex;
            gap: 20px;
            margin-top: 5px;
        }

        .radio-group label {
            font-weight: normal;
            display: flex;
            align-items: center;
            gap: 6px;
            cursor: pointer;
        }

        .btn-row {
            display: flex;
            gap: 10px;
            margin-top: 25px;
        }

        .btn {
            padding: 10px 24px;
            border: none;
            border-radius: 6px;
            font-size: 0.92em;
            font-weight: bold;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
        }
        .btn-primary { background: #3498db; color: white; }
        .btn-secondary { background: #95a5a6; color: white; }
        .btn:hover { opacity: 0.85; }

        .required { color: #e74c3c; }
    </style>
</head>
<body>
<div class="container">

    <div class="nav-link">
        <a href="<?= BASEURL ?>mahasiswa" class="btn btn-secondary">← Kembali ke Daftar</a>
    </div>

    <h1>➕ Tambah Data Mahasiswa</h1>

    <!-- Flash Message -->
    <?php if (!empty($flash)) : ?>
        <div class="alert alert-<?= $flash['type'] === 'success' ? 'success' : 'error' ?>">
            <?= $flash['message'] ?>
        </div>
    <?php endif; ?>

    <!-- Form -->
    <form action="<?= BASEURL ?>mahasiswa/store" method="POST">

        <div class="form-group">
            <label>NPM <span class="required">*</span></label>
            <input type="text" name="npm" placeholder="Contoh: 2300101009"
                   value="<?= htmlspecialchars($old['npm'] ?? '') ?>">
        </div>

        <div class="form-group">
            <label>Nama Lengkap <span class="required">*</span></label>
            <input type="text" name="nama_lengkap" placeholder="Nama lengkap mahasiswa"
                   value="<?= htmlspecialchars($old['nama_lengkap'] ?? '') ?>">
        </div>

        <div class="form-group">
            <label>Fakultas <span class="required">*</span></label>
            <input type="text" name="fakultas" placeholder="Contoh: Fakultas Teknologi Informasi"
                   value="<?= htmlspecialchars($old['fakultas'] ?? '') ?>">
        </div>

        <div class="form-group">
            <label>Jurusan <span class="required">*</span></label>
            <select name="jurusan">
                <option value="">-- Pilih Jurusan --</option>
                <option value="Teknik Informatika"
                    <?= (($old['jurusan'] ?? '') === 'Teknik Informatika') ? 'selected' : '' ?>>
                    Teknik Informatika
                </option>
                <option value="Sistem Informasi"
                    <?= (($old['jurusan'] ?? '') === 'Sistem Informasi') ? 'selected' : '' ?>>
                    Sistem Informasi
                </option>
            </select>
        </div>

        <div class="form-group">
            <label>Tempat Lahir <span class="required">*</span></label>
            <input type="text" name="tempat_lahir" placeholder="Contoh: Banjarmasin"
                   value="<?= htmlspecialchars($old['tempat_lahir'] ?? '') ?>">
        </div>

        <div class="form-group">
            <label>Tanggal Lahir <span class="required">*</span></label>
            <input type="date" name="tanggal_lahir"
                   value="<?= htmlspecialchars($old['tanggal_lahir'] ?? '') ?>">
        </div>

        <div class="form-group">
            <label>Jenis Kelamin <span class="required">*</span></label>
            <div class="radio-group">
                <label>
                    <input type="radio" name="jenis_kelamin" value="Laki-laki"
                        <?= (($old['jenis_kelamin'] ?? '') === 'Laki-laki') ? 'checked' : '' ?>>
                    Laki-laki
                </label>
                <label>
                    <input type="radio" name="jenis_kelamin" value="Perempuan"
                        <?= (($old['jenis_kelamin'] ?? '') === 'Perempuan') ? 'checked' : '' ?>>
                    Perempuan
                </label>
            </div>
        </div>

        <div class="btn-row">
            <button type="submit" class="btn btn-primary">💾 Simpan Data</button>
            <a href="<?= BASEURL ?>mahasiswa" class="btn btn-secondary">Batal</a>
        </div>

    </form>
</div>
</body>
</html>