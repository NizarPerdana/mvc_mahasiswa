<!-- app/views/home/index.php -->

<div class="row justify-content-center mt-4">
    <div class="col-md-7">
        <div class="card shadow-sm border-0 text-center p-4">
            <div class="card-body">
                <i class="bi bi-mortarboard-fill text-warning" style="font-size: 3.5rem;"></i>
                <h2 class="card-title mt-3 fw-bold">Selamat Datang!</h2>
                <p class="card-text text-muted">
                    Aplikasi CRUD Mahasiswa berbasis <strong>PHP MVC</strong><br>
                    Praktikum FTI UNISKA 2026
                </p>
                <p class="text-muted">Kelompok kami siap belajar! 🚀</p>
                <hr>
                <a href="<?= BASEURL ?>mahasiswa" class="btn btn-primary me-2">
                    <i class="bi bi-people-fill me-1"></i>Lihat Data Mahasiswa
                </a>
                <a href="<?= BASEURL ?>mahasiswa/create" class="btn btn-success">
                    <i class="bi bi-person-plus-fill me-1"></i>Tambah Mahasiswa
                </a>
            </div>
        </div>
    </div>
</div>