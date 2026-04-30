<?php
// core/Controller.php
// BaseController — semua controller akan extends kelas ini

class Controller
{
    /**
     * Memuat dan menampilkan file view.
     * $view  : path view relatif dari app/views/, contoh: 'home/index'
     * $data  : array data yang akan di-extract menjadi variabel di view
     */
    public function view(string $view, array $data = []): void
    {
        // Jadikan setiap key array sebagai variabel
        extract($data);

        $viewFile = VIEWPATH . $view . '.php';

        if (file_exists($viewFile)) {
            require_once $viewFile;
        } else {
            die("View tidak ditemukan: <strong>{$viewFile}</strong>");
        }
    }

    /**
     * Memuat file model dari app/models/.
     * Contoh: $this->model('Mahasiswa') → load MahasiswaModel
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
}