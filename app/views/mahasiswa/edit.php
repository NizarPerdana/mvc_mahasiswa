<!-- app/views/mahasiswa/edit.php -->

<div class="row justify-content-center">
    <div class="col-md-7">

        <div class="card shadow-sm border-0">
            <div class="card-header bg-warning text-dark">
                <h5 class="mb-0">
                    <i class="bi bi-pencil-fill me-2"></i>Edit Data Mahasiswa
                    <span class="badge bg-dark ms-2">ID: <?= $mahasiswa['id'] ?></span>
                </h5>
            </div>
            <div class="card-body p-4">

                <!-- Flash Message -->
                <?php if (!empty($flash)) : ?>
                    <div class="alert alert-<?= $flash['type'] === 'success' ? 'success' : 'danger' ?> alert-dismissible fade show">
                        <?= $flash['message'] ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                <?php endif; ?>

                <form action="<?= BASEURL ?>mahasiswa/update/<?= $mahasiswa['id'] ?>" method="POST">

                    <div class="mb-3">
                        <label class="form-label fw-bold">NPM <span class="text-danger">*</span></label>
                        <input type="text" name="npm" class="form-control"
                               value="<?= htmlspecialchars($mahasiswa['npm']) ?>">
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Nama Lengkap <span class="text-danger">*</span></label>
                        <input type="text" name="nama_lengkap" class="form-control"
                               value="<?= htmlspecialchars($mahasiswa['nama_lengkap']) ?>">
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Fakultas <span class="text-danger">*</span></label>
                        <input type="text" name="fakultas" class="form-control"
                               value="<?= htmlspecialchars($mahasiswa['fakultas']) ?>">
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Jurusan <span class="text-danger">*</span></label>
                        <select name="jurusan" class="form-select">
                            <option value="">-- Pilih Jurusan --</option>
                            <option value="Teknik Informatika"
                                <?= $mahasiswa['jurusan'] === 'Teknik Informatika' ? 'selected' : '' ?>>
                                Teknik Informatika
                            </option>
                            <option value="Sistem Informasi"
                                <?= $mahasiswa['jurusan'] === 'Sistem Informasi' ? 'selected' : '' ?>>
                                Sistem Informasi
                            </option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Tempat Lahir <span class="text-danger">*</span></label>
                        <input type="text" name="tempat_lahir" class="form-control"
                               value="<?= htmlspecialchars($mahasiswa['tempat_lahir']) ?>">
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Tanggal Lahir <span class="text-danger">*</span></label>
                        <input type="date" name="tanggal_lahir" class="form-control"
                               value="<?= htmlspecialchars($mahasiswa['tanggal_lahir']) ?>">
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-bold">Jenis Kelamin <span class="text-danger">*</span></label>
                        <div class="d-flex gap-4 mt-1">
                            <div class="form-check">
                                <input class="form-check-input" type="radio"
                                       name="jenis_kelamin" value="Laki-laki" id="lakiLaki"
                                       <?= $mahasiswa['jenis_kelamin'] === 'Laki-laki' ? 'checked' : '' ?>>
                                <label class="form-check-label" for="lakiLaki">
                                    <i class="bi bi-gender-male text-primary me-1"></i>Laki-laki
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio"
                                       name="jenis_kelamin" value="Perempuan" id="perempuan"
                                       <?= $mahasiswa['jenis_kelamin'] === 'Perempuan' ? 'checked' : '' ?>>
                                <label class="form-check-label" for="perempuan">
                                    <i class="bi bi-gender-female text-danger me-1"></i>Perempuan
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-warning">
                            <i class="bi bi-save-fill me-1"></i>Simpan Perubahan
                        </button>
                        <a href="<?= BASEURL ?>mahasiswa" class="btn btn-secondary">
                            <i class="bi bi-arrow-left me-1"></i>Batal
                        </a>
                    </div>

                </form>
            </div>
        </div>

    </div>
</div>