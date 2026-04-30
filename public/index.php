<?php
// public/index.php
// Front Controller - titik masuk utama aplikasi MVC

// ==================================================
// 1. DEFINISI KONSTANTA
// ==================================================
define('BASEPATH', dirname(__DIR__) . DIRECTORY_SEPARATOR);
define('BASEURL', 'http://' . $_SERVER['HTTP_HOST'] . '/mvc_mahasiswa/public/');
define('APPPATH', BASEPATH . 'app' . DIRECTORY_SEPARATOR);
define('COREPATH', BASEPATH . 'core' . DIRECTORY_SEPARATOR);
define('VIEWPATH', APPPATH . 'views' . DIRECTORY_SEPARATOR);
define('CONTROLLERPATH', APPPATH . 'controllers' . DIRECTORY_SEPARATOR);
define('MODELPATH', APPPATH . 'models' . DIRECTORY_SEPARATOR);

// ==================================================
// 2. REQUIRE KONFIGURASI
// ==================================================
require_once BASEPATH . 'config' . DIRECTORY_SEPARATOR . 'database.php';

// ==================================================
// 3. ROUTER SEDERHANA
// ==================================================

// Ambil URL dari parameter GET, bersihkan slash di awal/akhir
$url = isset($_GET['url']) ? trim($_GET['url'], '/') : '';

// Pecah URL menjadi array: [controller, method, param1, param2, ...]
$urlParts = $url ? explode('/', $url) : [];

// Tentukan controller (default: HomeController)
$controllerName = !empty($urlParts[0])
    ? ucfirst(strtolower($urlParts[0])) . 'Controller'
    : 'HomeController';

// Tentukan method (default: index)
$methodName = !empty($urlParts[1]) ? $urlParts[1] : 'index';

// Parameter tambahan (misalnya: /mahasiswa/edit/5 → params = [5])
$params = array_slice($urlParts, 2);

// ==================================================
// 4. LOAD FILE CONTROLLER
// ==================================================
$controllerFile = CONTROLLERPATH . $controllerName . '.php';

if (file_exists($controllerFile)) {
    require_once $controllerFile;

    // Buat instance controller
    $controller = new $controllerName();

    // Cek apakah method ada
    if (method_exists($controller, $methodName)) {
        call_user_func_array([$controller, $methodName], $params);
    } else {
        // Method tidak ditemukan
        http_response_code(404);
        echo "<h1>404 - Method tidak ditemukan</h1>";
        echo "<p>Method <strong>{$methodName}</strong> tidak ada di controller <strong>{$controllerName}</strong>.</p>";
    }
} else {
    // Controller tidak ditemukan
    http_response_code(404);
    echo "<h1>404 - Halaman Tidak Ditemukan</h1>";
    echo "<p>Controller <strong>{$controllerName}</strong> tidak ditemukan.</p>";
    echo "<p>File yang dicari: <code>{$controllerFile}</code></p>";
}
