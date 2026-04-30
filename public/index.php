<?php
// public/index.php — Front Controller (diperbarui di Sesi 2)

// 1. Definisi konstanta
define('BASEPATH',       dirname(__DIR__) . DIRECTORY_SEPARATOR);
define('BASEURL',        'http://' . $_SERVER['HTTP_HOST'] . '/mvc_mahasiswa/public/');
define('APPPATH',        BASEPATH . 'app'         . DIRECTORY_SEPARATOR);
define('COREPATH',       BASEPATH . 'core'        . DIRECTORY_SEPARATOR);
define('VIEWPATH',       APPPATH  . 'views'       . DIRECTORY_SEPARATOR);
define('CONTROLLERPATH', APPPATH  . 'controllers' . DIRECTORY_SEPARATOR);
define('MODELPATH',      APPPATH  . 'models'      . DIRECTORY_SEPARATOR);

// 2. Load konfigurasi database & core files
require_once BASEPATH . 'config' . DIRECTORY_SEPARATOR . 'database.php';
require_once COREPATH . 'Database.php';

// 3. Jalankan Router
require_once COREPATH . 'Router.php';

$router = new Router();
$router->run();