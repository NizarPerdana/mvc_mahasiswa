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

        ob_start();
        require_once $viewFile;
        $content = ob_get_clean();

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

    /**
     * Cek apakah user sudah login
     * Jika belum, redirect ke halaman login
     */
    public function requireLogin(): void
    {
        if (empty($_SESSION['user_id'])) {
            $this->setFlash('error', 'Silakan login terlebih dahulu.');
            $this->redirect('auth/login');
        }
    }

    /**
     * Cek apakah user adalah admin
     * Jika bukan, redirect ke index dengan pesan error
     */
    public function requireAdmin(): void
    {
        $this->requireLogin();
        if ($_SESSION['user_role'] !== 'admin') {
            $this->setFlash('error', 'Akses ditolak. Hanya admin yang bisa melakukan aksi ini.');
            $this->redirect('mahasiswa');
        }
    }

    /**
     * Ambil data user yang sedang login
     */
    public function currentUser(): ?array
    {
        if (!empty($_SESSION['user_id'])) {
            return [
                'id'       => $_SESSION['user_id'],
                'username' => $_SESSION['user_username'],
                'role'     => $_SESSION['user_role'],
            ];
        }
        return null;
    }

    /**
     * Cek apakah sudah login (return bool)
     */
    public function isLoggedIn(): bool
    {
        return !empty($_SESSION['user_id']);
    }

    /**
     * Cek apakah role admin (return bool)
     */
    public function isAdmin(): bool
    {
        return isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin';
    }
}