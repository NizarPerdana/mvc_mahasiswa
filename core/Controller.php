<?php
// core/Controller.php

class Controller
{
    public function __construct()
    {
        // Mulai session untuk flash message
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    /**
     * Load dan tampilkan view
     */
    public function view(string $view, array $data = []): void
    {
        extract($data);

        $viewFile = VIEWPATH . $view . '.php';

        if (file_exists($viewFile)) {
            require_once $viewFile;
        } else {
            die("View tidak ditemukan: <strong>{$viewFile}</strong>");
        }
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
     * Set flash message ke session
     * $type : 'success' atau 'error'
     */
    public function setFlash(string $type, string $message): void
    {
        $_SESSION['flash'] = [
            'type'    => $type,
            'message' => $message,
        ];
    }

    /**
     * Ambil flash message lalu hapus dari session
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
     * Redirect ke URL tertentu
     */
    public function redirect(string $url): void
    {
        header('Location: ' . BASEURL . $url);
        exit;
    }
}