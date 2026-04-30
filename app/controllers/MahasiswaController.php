<?php
// app/controllers/MahasiswaController.php

class MahasiswaController extends Controller
{
    private Mahasiswa $mahasiswaModel;

    public function __construct()
    {
        // Load model Mahasiswa dulu sebelum dipakai
        require_once MODELPATH . 'Mahasiswa.php';
        $this->mahasiswaModel = new mahasiswa();
    }

    public function index(): void
    {
        $data = [
            'title'      => 'Data Mahasiswa - MVC UNISKA',
            'mahasiswas' => $this->mahasiswaModel->getAll(),
        ];

        $this->view('mahasiswa/index', $data);
    }
}