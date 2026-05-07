<?php
// app/controllers/MahasiswaController.php

class MahasiswaController extends Controller
{
    private Mahasiswa $mahasiswaModel;

    public function __construct()
    {
        parent::__construct();
        require_once MODELPATH . 'Mahasiswa.php';
        $this->mahasiswaModel = new Mahasiswa();
    }

    /**
     * Tampilkan daftar mahasiswa
     */
    public function index(): void
    {
        $data = [
            'title'      => 'Data Mahasiswa - MVC UNISKA',
            'mahasiswas' => $this->mahasiswaModel->getAll(),
            'flash'      => $this->flash(),
        ];
        $this->view('mahasiswa/index', $data);
    }

    /**
     * Tampilkan form tambah
     */
    public function create(): void
    {
        $data = [
            'title' => 'Tambah Mahasiswa - MVC UNISKA',
            'flash' => $this->flash(),
            'old'   => [],
        ];
        $this->view('mahasiswa/create', $data);
    }

    /**
     * Proses simpan data baru
     */
    public function store(): void
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirect('mahasiswa');
            return;
        }

        $npm           = trim($_POST['npm']           ?? '');
        $nama_lengkap  = trim($_POST['nama_lengkap']  ?? '');
        $fakultas      = trim($_POST['fakultas']      ?? '');
        $jurusan       = trim($_POST['jurusan']       ?? '');
        $tempat_lahir  = trim($_POST['tempat_lahir']  ?? '');
        $tanggal_lahir = trim($_POST['tanggal_lahir'] ?? '');
        $jenis_kelamin = trim($_POST['jenis_kelamin'] ?? '');

        $jurusanValid      = ['Teknik Informatika', 'Sistem Informasi'];
        $jenisKelaminValid = ['Laki-laki', 'Perempuan'];

        $errors = [];
        if (empty($npm))                                     $errors[] = 'NPM tidak boleh kosong.';
        elseif ($this->mahasiswaModel->isNpmExist($npm))     $errors[] = 'NPM <strong>' . htmlspecialchars($npm) . '</strong> sudah terdaftar.';
        if (empty($nama_lengkap))                            $errors[] = 'Nama lengkap tidak boleh kosong.';
        if (empty($fakultas))                                $errors[] = 'Fakultas tidak boleh kosong.';
        if (!in_array($jurusan, $jurusanValid))              $errors[] = 'Jurusan tidak valid.';
        if (empty($tempat_lahir))                            $errors[] = 'Tempat lahir tidak boleh kosong.';
        if (empty($tanggal_lahir))                           $errors[] = 'Tanggal lahir tidak boleh kosong.';
        if (!in_array($jenis_kelamin, $jenisKelaminValid))   $errors[] = 'Jenis kelamin tidak valid.';

        if (!empty($errors)) {
            $this->setFlash('error', implode('<br>', $errors));
            $data = [
                'title' => 'Tambah Mahasiswa - MVC UNISKA',
                'flash' => $this->flash(),
                'old'   => $_POST,
            ];
            $this->view('mahasiswa/create', $data);
            return;
        }

        $saved = $this->mahasiswaModel->create([
            'npm'           => $npm,
            'nama_lengkap'  => $nama_lengkap,
            'fakultas'      => $fakultas,
            'jurusan'       => $jurusan,
            'tempat_lahir'  => $tempat_lahir,
            'tanggal_lahir' => $tanggal_lahir,
            'jenis_kelamin' => $jenis_kelamin,
        ]);

        if ($saved) {
            $this->setFlash('success', 'Data <strong>' . htmlspecialchars($nama_lengkap) . '</strong> berhasil ditambahkan!');
        } else {
            $this->setFlash('error', 'Gagal menyimpan data. Silakan coba lagi.');
        }

        $this->redirect('mahasiswa');
    }

    /**
     * Tampilkan form edit
     */
    public function edit(int $id): void
    {
        $mahasiswa = $this->mahasiswaModel->find($id);

        if (!$mahasiswa) {
            $this->setFlash('error', 'Data mahasiswa tidak ditemukan.');
            $this->redirect('mahasiswa');
            return;
        }

        $data = [
            'title'     => 'Edit Mahasiswa - MVC UNISKA',
            'flash'     => $this->flash(),
            'mahasiswa' => $mahasiswa,
        ];
        $this->view('mahasiswa/edit', $data);
    }

    /**
     * Proses update data
     */
    public function update(int $id): void
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirect('mahasiswa');
            return;
        }

        // Cek data ada
        $mahasiswa = $this->mahasiswaModel->find($id);
        if (!$mahasiswa) {
            $this->setFlash('error', 'Data mahasiswa tidak ditemukan.');
            $this->redirect('mahasiswa');
            return;
        }

        $npm           = trim($_POST['npm']           ?? '');
        $nama_lengkap  = trim($_POST['nama_lengkap']  ?? '');
        $fakultas      = trim($_POST['fakultas']      ?? '');
        $jurusan       = trim($_POST['jurusan']       ?? '');
        $tempat_lahir  = trim($_POST['tempat_lahir']  ?? '');
        $tanggal_lahir = trim($_POST['tanggal_lahir'] ?? '');
        $jenis_kelamin = trim($_POST['jenis_kelamin'] ?? '');

        $jurusanValid      = ['Teknik Informatika', 'Sistem Informasi'];
        $jenisKelaminValid = ['Laki-laki', 'Perempuan'];

        $errors = [];
        if (empty($npm))                                              $errors[] = 'NPM tidak boleh kosong.';
        elseif ($this->mahasiswaModel->isNpmExist($npm, $id))         $errors[] = 'NPM <strong>' . htmlspecialchars($npm) . '</strong> sudah digunakan mahasiswa lain.';
        if (empty($nama_lengkap))                                     $errors[] = 'Nama lengkap tidak boleh kosong.';
        if (empty($fakultas))                                         $errors[] = 'Fakultas tidak boleh kosong.';
        if (!in_array($jurusan, $jurusanValid))                       $errors[] = 'Jurusan tidak valid.';
        if (empty($tempat_lahir))                                     $errors[] = 'Tempat lahir tidak boleh kosong.';
        if (empty($tanggal_lahir))                                    $errors[] = 'Tanggal lahir tidak boleh kosong.';
        if (!in_array($jenis_kelamin, $jenisKelaminValid))            $errors[] = 'Jenis kelamin tidak valid.';

        if (!empty($errors)) {
            $this->setFlash('error', implode('<br>', $errors));
            // Kembalikan ke form edit dengan data yang diisi
            $data = [
                'title'     => 'Edit Mahasiswa - MVC UNISKA',
                'flash'     => $this->flash(),
                'mahasiswa' => array_merge($mahasiswa, $_POST),
            ];
            $this->view('mahasiswa/edit', $data);
            return;
        }

        $updated = $this->mahasiswaModel->update($id, [
            'npm'           => $npm,
            'nama_lengkap'  => $nama_lengkap,
            'fakultas'      => $fakultas,
            'jurusan'       => $jurusan,
            'tempat_lahir'  => $tempat_lahir,
            'tanggal_lahir' => $tanggal_lahir,
            'jenis_kelamin' => $jenis_kelamin,
        ]);

        if ($updated) {
            $this->setFlash('success', 'Data <strong>' . htmlspecialchars($nama_lengkap) . '</strong> berhasil diperbarui!');
        } else {
            $this->setFlash('error', 'Gagal memperbarui data. Silakan coba lagi.');
        }

        $this->redirect('mahasiswa');
    }

    /**
     * Hapus data mahasiswa
     */
    public function delete(int $id): void
    {
        $mahasiswa = $this->mahasiswaModel->find($id);

        if (!$mahasiswa) {
            $this->setFlash('error', 'Data mahasiswa tidak ditemukan.');
            $this->redirect('mahasiswa');
            return;
        }

        $deleted = $this->mahasiswaModel->delete($id);

        if ($deleted) {
            $this->setFlash('success', 'Data <strong>' . htmlspecialchars($mahasiswa['nama_lengkap']) . '</strong> berhasil dihapus!');
        } else {
            $this->setFlash('error', 'Gagal menghapus data. Silakan coba lagi.');
        }

        $this->redirect('mahasiswa');
    }
}