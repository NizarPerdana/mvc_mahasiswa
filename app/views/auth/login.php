<!-- app/views/auth/login.php -->

<div class="row justify-content-center mt-5">
    <div class="col-md-4">
        <div class="card shadow border-0">
            <div class="card-header bg-dark text-white text-center py-3">
                <h5 class="mb-0">
                    <i class="bi bi-mortarboard-fill me-2 text-warning"></i>
                    MVC UNISKA — Login
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

                <form action="<?= BASEURL ?>auth/doLogin" method="POST">

                    <div class="mb-3">
                        <label class="form-label fw-bold">
                            <i class="bi bi-person-fill me-1"></i>Username
                        </label>
                        <input type="text" name="username" class="form-control"
                               placeholder="Masukkan username" autofocus>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-bold">
                            <i class="bi bi-lock-fill me-1"></i>Password
                        </label>
                        <input type="password" name="password" class="form-control"
                               placeholder="Masukkan password">
                    </div>

                    <button type="submit" class="btn btn-dark w-100">
                        <i class="bi bi-box-arrow-in-right me-1"></i>Login
                    </button>

                </form>

                <hr>
                <p class="text-center text-muted small mb-1">Belum punya akun?</p>
                <a href="<?= BASEURL ?>auth/register" class="btn btn-outline-secondary w-100 btn-sm">
                    <i class="bi bi-person-plus me-1"></i>Register
                </a>

            </div>
            <div class="card-footer text-center text-muted small py-2">
                <i class="bi bi-info-circle me-1"></i>
                Default: admin / password &nbsp;|&nbsp; user1 / password
            </div>
        </div>
    </div>
</div>