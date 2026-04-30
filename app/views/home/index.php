<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'MVC Mahasiswa' ?></title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-color: #f0f4f8;
        }
        .card {
            background: white;
            padding: 40px 50px;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            text-align: center;
            max-width: 500px;
        }
        h1 { color: #2c3e50; margin-bottom: 10px; }
        p  { color: #555; line-height: 1.6; }
        .badge {
            display: inline-block;
            background: #3498db;
            color: white;
            padding: 6px 16px;
            border-radius: 20px;
            font-size: 0.85em;
            margin-top: 15px;
        }
        a {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 25px;
            background: #2ecc71;
            color: white;
            text-decoration: none;
            border-radius: 6px;
        }
        a:hover { background: #27ae60; }
    </style>
</head>
<body>
    <div class="card">
        <h1>👋 Selamat Datang!</h1>
        <p>Aplikasi MVC Mahasiswa<br>
        <strong>Praktikum FTI UNISKA 2026</strong></p>
        <p>Kelompok kami siap belajar!</p>
        <span class="badge">PHP MVC Tanpa Framework</span>
        <br>
        <a href="<?= BASEURL ?>mahasiswa">📋 Lihat Data Mahasiswa</a>
    </div>
</body>
</html>