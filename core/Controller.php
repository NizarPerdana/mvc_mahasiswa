<?php
// core/Controller.php

class Controller
{
    public function __construct()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    /**
     * Load dan tampilkan view — otomatis dibungkus header & footer
     */
    public function view(string $view, array $data = []): void
    {
        extract($data);

        $viewFile = VIEWPATH . $view . '.php';

        if (!file_exists($viewFile)) {
            die("View tidak ditemukan: <strong>{$viewFile}</strong>");
        }

        // Tangkap konten view ke variabel $content
        ob_start();
        require_once $viewFile;
        $content = ob_get_clean();

        // Tampilkan: header → konten → footer
        require_once VIEWPATH . 'layouts/header.php';
        echo $content;
        require_once VIEWPATH . 'layouts/footer.php';
    }

    /**
     * Load model
     */
    public function model(string $model): object
    {
        $modelFile = MODELPATH . $model . '.php';

        if (file_exists($modelFile)) {
            require_once $modelFile;
            return new $model();
        } else {
            die("Model tidak ditemukan: <strong>{$modelFile}</strong>");
        }
    }

    /**
     * Set flash message
     */
    public function setFlash(string $type, string $message): void
    {
        $_SESSION['flash'] = [
            'type'    => $type,
            'message' => $message,
        ];
    }

    /**
     * Ambil & hapus flash message
     */
    public function flash(): ?array
    {
        if (isset($_SESSION['flash'])) {
            $flash = $_SESSION['flash'];
            unset($_SESSION['flash']);
            return $flash;
        }
        return null;
    }

    /**
     * Redirect ke URL
     */
    public function redirect(string $url): void
    {
        header('Location: ' . BASEURL . $url);
        exit;
    }
}