<!-- app/views/mahasiswa/index.php -->

<!-- Flash Message -->
<?php if (!empty($flash)) : ?>
    <div class="alert alert-<?= $flash['type'] === 'success' ? 'success' : 'danger' ?> alert-dismissible fade show" role="alert">
        <i class="bi bi-<?= $flash['type'] === 'success' ? 'check-circle' : 'exclamation-triangle' ?>-fill me-2"></i>
        <?= $flash['message'] ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
<?php endif; ?>

<!-- Header -->
<div class="d-flex justify-content-between align-items-center mb-3">
    <h4 class="fw-bold mb-0">
        <i class="bi bi-people-fill me-2 text-primary"></i>Data Mahasiswa
    </h4>
</div>

<!-- Form Pencarian & Filter -->
<form action="<?= BASEURL ?>mahasiswa" method="GET"
      class="row g-2 align-items-center bg-light p-3 rounded mb-3 border">

    <div class="col-md-5">
        <div class="input-group">
            <span class="input-group-text"><i class="bi bi-search"></i></span>
            <input type="text" name="search" class="form-control"
                   placeholder="Cari NPM atau Nama..."
                   value="<?= htmlspecialchars($search ?? '') ?>">
        </div>
    </div>

    <div class="col-md-4">
        <select name="jurusan" class="form-select">
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
    </div>

    <div class="col-md-3 d-flex gap-2">
        <button type="submit" class="btn btn-success w-100">
            <i class="bi bi-search me-1"></i>Cari
        </button>
        <a href="<?= BASEURL ?>mahasiswa" class="btn btn-secondary w-100">
            <i class="bi bi-arrow-counterclockwise me-1"></i>Reset
        </a>
    </div>

</form>

<!-- Info hasil filter -->
<?php if (!empty($search) || !empty($jurusan)) : ?>
    <p class="text-muted small mb-2">
        Menampilkan <strong><?= count($mahasiswas) ?></strong> hasil
        <?php if (!empty($search)) : ?>
            untuk "<strong><?= htmlspecialchars($search) ?></strong>"
        <?php endif; ?>
        <?php if (!empty($jurusan)) : ?>
            — jurusan "<strong><?= htmlspecialchars($jurusan) ?></strong>"
        <?php endif; ?>
    </p>
<?php endif; ?>

<!-- Tabel -->
<?php if (!empty($mahasiswas)) : ?>
<div class="table-responsive">
    <table class="table table-striped table-bordered table-hover align-middle">
        <thead class="table-dark">
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
                <td><code><?= htmlspecialchars($mhs['npm']) ?></code></td>
                <td><?= htmlspecialchars($mhs['nama_lengkap']) ?></td>
                <td><?= htmlspecialchars($mhs['fakultas']) ?></td>
                <td>
                    <span class="badge <?= $mhs['jurusan'] === 'Teknik Informatika' ? 'bg-primary' : 'bg-info text-dark' ?>">
                        <?= htmlspecialchars($mhs['jurusan']) ?>
                    </span>
                </td>
                <td><?= htmlspecialchars($mhs['tempat_lahir']) ?></td>
                <td><?= date('d M Y', strtotime($mhs['tanggal_lahir'])) ?></td>
                <td>
                    <i class="bi bi-<?= $mhs['jenis_kelamin'] === 'Laki-laki' ? 'gender-male text-primary' : 'gender-female text-danger' ?> me-1"></i>
                    <?= htmlspecialchars($mhs['jenis_kelamin']) ?>
                </td>
                <td>
                    <?php if ($mhs['status_id'] == 1) : ?>
                        <span class="badge bg-success">Aktif</span>
                    <?php else : ?>
                        <span class="badge bg-secondary">Nonaktif</span>
                    <?php endif; ?>
                </td>
                <td>
                    <div class="d-flex gap-1">
                        <a href="<?= BASEURL ?>mahasiswa/edit/<?= $mhs['id'] ?>"
                           class="btn btn-warning btn-sm">
                            <i class="bi bi-pencil-fill"></i>
                        </a>
                        <form action="<?= BASEURL ?>mahasiswa/delete/<?= $mhs['id'] ?>"
                              method="POST"
                              onsubmit="return confirm('Yakin hapus data <?= htmlspecialchars($mhs['nama_lengkap']) ?>?')">
                            <button type="submit" class="btn btn-danger btn-sm">
                                <i class="bi bi-trash-fill"></i>
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<p class="text-muted small">Total: <strong><?= count($mahasiswas) ?></strong> mahasiswa</p>

<?php else : ?>
<div class="text-center py-5 text-muted">
    <?php if (!empty($search) || !empty($jurusan)) : ?>
        <i class="bi bi-search" style="font-size:2rem;"></i>
        <p class="mt-2">Tidak ada data yang cocok.</p>
        <a href="<?= BASEURL ?>mahasiswa" class="btn btn-secondary btn-sm">↺ Tampilkan Semua</a>
    <?php else : ?>
        <i class="bi bi-inbox" style="font-size:2rem;"></i>
        <p class="mt-2">Belum ada data mahasiswa.</p>
        <a href="<?= BASEURL ?>mahasiswa/create" class="btn btn-primary btn-sm">+ Tambah Sekarang</a>
    <?php endif; ?>
</div>
<?php endif; ?>