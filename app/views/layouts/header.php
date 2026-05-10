<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'MVC Mahasiswa - UNISKA 2026' ?></title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <style>
        body { background-color: #f0f4f8; }
        .navbar-brand span { color: #f39c12; }
        .navbar { box-shadow: 0 2px 8px rgba(0,0,0,0.15); }
        .main-content { padding: 30px 0; min-height: calc(100vh - 120px); }
        .nav-link.active { font-weight: bold; border-bottom: 2px solid #f39c12; }
        .badge-role { font-size: 0.7em; vertical-align: middle; }
    </style>
</head>
<body>

<?php
// Ambil data session untuk navbar
$_currentUser = null;
if (!empty($_SESSION['user_id'])) {
    $_currentUser = [
        'username' => $_SESSION['user_username'],
        'role'     => $_SESSION['user_role'],
    ];
}
?>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">

        <a class="navbar-brand" href="<?= BASEURL ?>">
            <i class="bi bi-mortarboard-fill me-2"></i>MVC <span>UNISKA</span>
        </a>

        <button class="navbar-toggler" type="button"
                data-bs-toggle="collapse" data-bs-target="#navbarMain">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarMain">
            <ul class="navbar-nav me-auto">

                <?php if ($_currentUser) : ?>

                    <li class="nav-item">
                        <a class="nav-link <?= (strpos($_SERVER['REQUEST_URI'], 'mahasiswa') === false) ? 'active' : '' ?>"
                           href="<?= BASEURL ?>">
                            <i class="bi bi-house-fill me-1"></i>Home
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link <?= (strpos($_SERVER['REQUEST_URI'], 'mahasiswa') !== false) ? 'active' : '' ?>"
                           href="<?= BASEURL ?>mahasiswa">
                            <i class="bi bi-people-fill me-1"></i>Data Mahasiswa
                        </a>
                    </li>

                    <!-- Hanya admin yang lihat menu Tambah -->
                    <?php if ($_currentUser['role'] === 'admin') : ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= BASEURL ?>mahasiswa/create">
                            <i class="bi bi-person-plus-fill me-1"></i>Tambah Mahasiswa
                        </a>
                    </li>
                    <?php endif; ?>

                <?php endif; ?>

            </ul>

            <!-- Kanan navbar: info user & logout -->
            <ul class="navbar-nav ms-auto">
                <?php if ($_currentUser) : ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#"
                           data-bs-toggle="dropdown">
                            <i class="bi bi-person-circle me-1"></i>
                            <?= htmlspecialchars($_currentUser['username']) ?>
                            <?php if ($_currentUser['role'] === 'admin') : ?>
                                <span class="badge bg-warning text-dark badge-role">Admin</span>
                            <?php else : ?>
                                <span class="badge bg-secondary badge-role">User</span>
                            <?php endif; ?>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                                <span class="dropdown-item-text text-muted small">
                                    Login sebagai <strong><?= htmlspecialchars($_currentUser['role']) ?></strong>
                                </span>
                            </li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <a class="dropdown-item text-danger"
                                   href="<?= BASEURL ?>auth/logout"
                                   onclick="return confirm('Yakin ingin logout?')">
                                    <i class="bi bi-box-arrow-right me-1"></i>Logout
                                </a>
                            </li>
                        </ul>
                    </li>
                <?php else : ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= BASEURL ?>auth/login">
                            <i class="bi bi-box-arrow-in-right me-1"></i>Login
                        </a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>

<div class="main-content">
    <div class="container">