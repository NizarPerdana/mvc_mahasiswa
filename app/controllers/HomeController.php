<?php
// app/controllers/HomeController.php

class HomeController extends Controller
{
    public function index(): void
    {
        $data = [
            'title' => 'Beranda - Aplikasi MVC Mahasiswa'
        ];

        $this->view('home/index', $data);
    }
}