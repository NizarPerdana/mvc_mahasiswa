<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'MVC Mahasiswa - UNISKA 2026' ?></title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

    <style>
        body { background-color: #f0f4f8; }

        .navbar-brand span { color: #f39c12; }

        .navbar { box-shadow: 0 2px 8px rgba(0,0,0,0.15); }

        .main-content { padding: 30px 0; min-height: calc(100vh - 120px); }

        /* Aktifkan nav item sesuai halaman */
        .nav-link.active { font-weight: bold; border-bottom: 2px solid #f39c12; }
    </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">

        <!-- Brand -->
        <a class="navbar-brand" href="<?= BASEURL ?>">
            <i class="bi bi-mortarboard-fill me-2"></i>MVC <span>UNISKA</span>
        </a>

        <!-- Toggler mobile -->
        <button class="navbar-toggler" type="button"
                data-bs-toggle="collapse" data-bs-target="#navbarMain">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Menu -->
        <div class="collapse navbar-collapse" id="navbarMain">
            <ul class="navbar-nav ms-auto">

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

                <li class="nav-item">
                    <a class="nav-link"
                       href="<?= BASEURL ?>mahasiswa/create">
                        <i class="bi bi-person-plus-fill me-1"></i>Tambah Mahasiswa
                    </a>
                </li>

            </ul>
        </div>
    </div>
</nav>

<!-- Konten utama -->
<div class="main-content">
    <div class="container">