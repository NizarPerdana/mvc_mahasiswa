<?php
// public/index.php

// 1. Konstanta
define('BASEPATH',       dirname(__DIR__) . DIRECTORY_SEPARATOR);
define('BASEURL',        'http://' . $_SERVER['HTTP_HOST'] . '/mvc_mahasiswa/public/');
define('APPPATH',        BASEPATH . 'app'         . DIRECTORY_SEPARATOR);
define('COREPATH',       BASEPATH . 'core'        . DIRECTORY_SEPARATOR);
define('VIEWPATH',       APPPATH  . 'views'       . DIRECTORY_SEPARATOR);
define('CONTROLLERPATH', APPPATH  . 'controllers' . DIRECTORY_SEPARATOR);
define('MODELPATH',      APPPATH  . 'models'      . DIRECTORY_SEPARATOR);

// 2. Load Composer autoload (untuk Dompdf)
if (file_exists(BASEPATH . 'vendor/autoload.php')) {
    require_once BASEPATH . 'vendor/autoload.php';
}

// 3. Load config & core
require_once BASEPATH . 'config' . DIRECTORY_SEPARATOR . 'database.php';
require_once COREPATH . 'Database.php';
require_once COREPATH . 'Router.php';

// 4. Jalankan router
$router = new Router();
$router->run();