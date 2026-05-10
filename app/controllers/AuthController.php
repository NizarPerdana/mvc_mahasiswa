<?php
// app/controllers/AuthController.php

class AuthController extends Controller
{
    private User $userModel;

    public function __construct()
    {
        parent::__construct();
        require_once MODELPATH . 'User.php';
        $this->userModel = new User();
    }

    /**
     * Tampilkan form login
     */
    public function login(): void
    {
        // Kalau sudah login, langsung ke mahasiswa
        if ($this->isLoggedIn()) {
            $this->redirect('mahasiswa');
            return;
        }

        $data = [
            'title' => 'Login - MVC UNISKA',
            'flash' => $this->flash(),
        ];

        $this->view('auth/login', $data);
    }

    /**
     * Proses login
     */
    public function doLogin(): void
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirect('auth/login');
            return;
        }

        $username = trim($_POST['username'] ?? '');
        $password = trim($_POST['password'] ?? '');

        // Validasi input
        if (empty($username) || empty($password)) {
            $this->setFlash('error', 'Username dan password wajib diisi.');
            $this->redirect('auth/login');
            return;
        }

        // Cari user di database
        $user = $this->userModel->findByUsername($username);

        // Verifikasi password
        if (!$user || !password_verify($password, $user['password'])) {
            $this->setFlash('error', 'Username atau password salah.');
            $this->redirect('auth/login');
            return;
        }

        // Simpan ke session
        $_SESSION['user_id']       = $user['id'];
        $_SESSION['user_username'] = $user['username'];
        $_SESSION['user_role']     = $user['role'];

        $this->setFlash('success', 'Selamat datang, <strong>' . htmlspecialchars($user['username']) . '</strong>!');
        $this->redirect('mahasiswa');
    }

    /**
     * Logout
     */
    public function logout(): void
    {
        // Hapus semua session
        $_SESSION = [];
        session_destroy();

        $this->redirect('auth/login');
    }

    /**
     * Tampilkan form register (opsional)
     */
    public function register(): void
    {
        if ($this->isLoggedIn()) {
            $this->redirect('mahasiswa');
            return;
        }

        $data = [
            'title' => 'Register - MVC UNISKA',
            'flash' => $this->flash(),
        ];

        $this->view('auth/register', $data);
    }

    /**
     * Proses register
     */
    public function doRegister(): void
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirect('auth/register');
            return;
        }

        $username = trim($_POST['username'] ?? '');
        $password = trim($_POST['password'] ?? '');
        $confirm  = trim($_POST['confirm']  ?? '');

        $errors = [];
        if (empty($username))                              $errors[] = 'Username tidak boleh kosong.';
        elseif (strlen($username) < 4)                    $errors[] = 'Username minimal 4 karakter.';
        elseif ($this->userModel->isUsernameExist($username)) $errors[] = 'Username sudah digunakan.';
        if (empty($password))                              $errors[] = 'Password tidak boleh kosong.';
        elseif (strlen($password) < 6)                    $errors[] = 'Password minimal 6 karakter.';
        elseif ($password !== $confirm)                   $errors[] = 'Konfirmasi password tidak cocok.';

        if (!empty($errors)) {
            $this->setFlash('error', implode('<br>', $errors));
            $this->redirect('auth/register');
            return;
        }

        $created = $this->userModel->create($username, $password, 'user');

        if ($created) {
            $this->setFlash('success', 'Akun berhasil dibuat! Silakan login.');
            $this->redirect('auth/login');
        } else {
            $this->setFlash('error', 'Gagal membuat akun. Coba lagi.');
            $this->redirect('auth/register');
        }
    }
}