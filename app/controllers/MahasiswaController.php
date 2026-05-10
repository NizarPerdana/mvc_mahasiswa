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
     * Tampilkan daftar mahasiswa — semua role boleh
     */
    public function index(): void
    {
        $this->requireLogin();

        $search  = trim($_GET['search']  ?? '');
        $jurusan = trim($_GET['jurusan'] ?? '');

        if (!empty($search) || !empty($jurusan)) {
            $mahasiswas = $this->mahasiswaModel->searchAndFilter($search, $jurusan);
        } else {
            $mahasiswas = $this->mahasiswaModel->getAll();
        }

        $data = [
            'title'      => 'Data Mahasiswa - MVC UNISKA',
            'mahasiswas' => $mahasiswas,
            'flash'      => $this->flash(),
            'search'     => $search,
            'jurusan'    => $jurusan,
        ];

        $this->view('mahasiswa/index', $data);
    }

    /**
     * Tampilkan form tambah — hanya admin
     */
    public function create(): void
    {
        $this->requireAdmin();

        $data = [
            'title' => 'Tambah Mahasiswa - MVC UNISKA',
            'flash' => $this->flash(),
            'old'   => [],
        ];

        $this->view('mahasiswa/create', $data);
    }

    /**
     * Proses simpan data baru — hanya admin
     */
    public function store(): void
    {
        $this->requireAdmin();

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
        if (empty($npm))                                   $errors[] = 'NPM tidak boleh kosong.';
        elseif ($this->mahasiswaModel->isNpmExist($npm))   $errors[] = 'NPM sudah terdaftar.';
        if (empty($nama_lengkap))                          $errors[] = 'Nama lengkap tidak boleh kosong.';
        if (empty($fakultas))                              $errors[] = 'Fakultas tidak boleh kosong.';
        if (!in_array($jurusan, $jurusanValid))            $errors[] = 'Jurusan tidak valid.';
        if (empty($tempat_lahir))                          $errors[] = 'Tempat lahir tidak boleh kosong.';
        if (empty($tanggal_lahir))                         $errors[] = 'Tanggal lahir tidak boleh kosong.';
        if (!in_array($jenis_kelamin, $jenisKelaminValid)) $errors[] = 'Jenis kelamin tidak valid.';

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
            $this->setFlash('error', 'Gagal menyimpan data.');
        }

        $this->redirect('mahasiswa');
    }

    /**
     * Tampilkan form edit — hanya admin
     */
    public function edit(int $id): void
    {
        $this->requireAdmin();

        $mahasiswa = $this->mahasiswaModel->find($id);

        if (!$mahasiswa) {
            $this->setFlash('error', 'Data tidak ditemukan.');
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
     * Proses update data — hanya admin
     */
    public function update(int $id): void
    {
        $this->requireAdmin();

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirect('mahasiswa');
            return;
        }

        $mahasiswa = $this->mahasiswaModel->find($id);
        if (!$mahasiswa) {
            $this->setFlash('error', 'Data tidak ditemukan.');
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
        if (empty($npm))                                          $errors[] = 'NPM tidak boleh kosong.';
        elseif ($this->mahasiswaModel->isNpmExist($npm, $id))     $errors[] = 'NPM sudah digunakan mahasiswa lain.';
        if (empty($nama_lengkap))                                 $errors[] = 'Nama lengkap tidak boleh kosong.';
        if (empty($fakultas))                                     $errors[] = 'Fakultas tidak boleh kosong.';
        if (!in_array($jurusan, $jurusanValid))                   $errors[] = 'Jurusan tidak valid.';
        if (empty($tempat_lahir))                                 $errors[] = 'Tempat lahir tidak boleh kosong.';
        if (empty($tanggal_lahir))                                $errors[] = 'Tanggal lahir tidak boleh kosong.';
        if (!in_array($jenis_kelamin, $jenisKelaminValid))        $errors[] = 'Jenis kelamin tidak valid.';

        if (!empty($errors)) {
            $this->setFlash('error', implode('<br>', $errors));
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
            $this->setFlash('error', 'Gagal memperbarui data.');
        }

        $this->redirect('mahasiswa');
    }

    /**
     * Hapus data — hanya admin
     */
    public function delete(int $id): void
    {
        $this->requireAdmin();

        $mahasiswa = $this->mahasiswaModel->find($id);

        if (!$mahasiswa) {
            $this->setFlash('error', 'Data tidak ditemukan.');
            $this->redirect('mahasiswa');
            return;
        }

        $deleted = $this->mahasiswaModel->delete($id);

        if ($deleted) {
            $this->setFlash('success', 'Data <strong>' . htmlspecialchars($mahasiswa['nama_lengkap']) . '</strong> berhasil dihapus!');
        } else {
            $this->setFlash('error', 'Gagal menghapus data.');
        }

        $this->redirect('mahasiswa');
    }

    /**
     * Export CSV — semua role boleh
     */
    public function exportCSV(): void
    {
        $this->requireLogin();

        $search  = trim($_GET['search']  ?? '');
        $jurusan = trim($_GET['jurusan'] ?? '');

        if (!empty($search) || !empty($jurusan)) {
            $mahasiswas = $this->mahasiswaModel->searchAndFilter($search, $jurusan);
        } else {
            $mahasiswas = $this->mahasiswaModel->getAll();
        }

        $filename = 'data_mahasiswa_' . date('Ymd_His') . '.csv';
        header('Content-Type: text/csv; charset=UTF-8');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        header('Pragma: no-cache');
        header('Expires: 0');

        echo "\xEF\xBB\xBF";

        $output = fopen('php://output', 'w');

        fputcsv($output, [
            'ID', 'NPM', 'Nama Lengkap', 'Fakultas', 'Jurusan',
            'Tempat Lahir', 'Tanggal Lahir', 'Jenis Kelamin', 'Status'
        ]);

        foreach ($mahasiswas as $mhs) {
            fputcsv($output, [
                $mhs['id'],
                $mhs['npm'],
                $mhs['nama_lengkap'],
                $mhs['fakultas'],
                $mhs['jurusan'],
                $mhs['tempat_lahir'],
                date('d-m-Y', strtotime($mhs['tanggal_lahir'])),
                $mhs['jenis_kelamin'],
                $mhs['status_id'] == 1 ? 'Aktif' : 'Nonaktif',
            ]);
        }

        fclose($output);
        exit;
    }

    /**
     * Export PDF — semua role boleh
     */
    public function exportPDF(): void
    {
        $this->requireLogin();

        $search  = trim($_GET['search']  ?? '');
        $jurusan = trim($_GET['jurusan'] ?? '');

        if (!empty($search) || !empty($jurusan)) {
            $mahasiswas = $this->mahasiswaModel->searchAndFilter($search, $jurusan);
        } else {
            $mahasiswas = $this->mahasiswaModel->getAll();
        }

        $html  = '<!DOCTYPE html><html><head>';
        $html .= '<meta charset="UTF-8">';
        $html .= '<style>
            body    { font-family: Arial, sans-serif; font-size: 11px; }
            h2      { text-align: center; color: #2c3e50; margin-bottom: 4px; }
            p.sub   { text-align: center; color: #777; margin-top: 0; font-size: 10px; }
            table   { width: 100%; border-collapse: collapse; margin-top: 15px; }
            th      { background: #2c3e50; color: white; padding: 7px 6px; text-align: left; }
            td      { padding: 6px; border-bottom: 1px solid #ddd; }
            tr:nth-child(even) td { background: #f8f9fa; }
            .footer { margin-top: 15px; font-size: 10px; color: #999; text-align: right; }
        </style>';
        $html .= '</head><body>';
        $html .= '<h2>Data Mahasiswa FTI UNISKA</h2>';
        $html .= '<p class="sub">Dicetak pada: ' . date('d M Y H:i:s') . ' | Total: ' . count($mahasiswas) . ' mahasiswa</p>';
        $html .= '<table>';
        $html .= '<thead><tr>
                    <th>No</th><th>NPM</th><th>Nama Lengkap</th>
                    <th>Fakultas</th><th>Jurusan</th><th>Tempat Lahir</th>
                    <th>Tanggal Lahir</th><th>Jenis Kelamin</th><th>Status</th>
                  </tr></thead><tbody>';

        $no = 1;
        foreach ($mahasiswas as $mhs) {
            $html .= '<tr>';
            $html .= '<td>' . $no++ . '</td>';
            $html .= '<td>' . htmlspecialchars($mhs['npm']) . '</td>';
            $html .= '<td>' . htmlspecialchars($mhs['nama_lengkap']) . '</td>';
            $html .= '<td>' . htmlspecialchars($mhs['fakultas']) . '</td>';
            $html .= '<td>' . htmlspecialchars($mhs['jurusan']) . '</td>';
            $html .= '<td>' . htmlspecialchars($mhs['tempat_lahir']) . '</td>';
            $html .= '<td>' . date('d M Y', strtotime($mhs['tanggal_lahir'])) . '</td>';
            $html .= '<td>' . htmlspecialchars($mhs['jenis_kelamin']) . '</td>';
            $html .= '<td>' . ($mhs['status_id'] == 1 ? 'Aktif' : 'Nonaktif') . '</td>';
            $html .= '</tr>';
        }

        $html .= '</tbody></table>';
        $html .= '<p class="footer">Sistem Informasi Mahasiswa &mdash; FTI UNISKA 2026</p>';
        $html .= '</body></html>';

        $options = new \Dompdf\Options();
        $options->set('defaultFont', 'Arial');
        $options->set('isRemoteEnabled', true);

        $dompdf = new \Dompdf\Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();

        $filename = 'data_mahasiswa_' . date('Ymd_His') . '.pdf';
        $dompdf->stream($filename, ['Attachment' => true]);
        exit;
    }
}