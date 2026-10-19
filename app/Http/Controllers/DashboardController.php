<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        // Data sementara. Akan diganti query Eloquent pada jobsheet lanjutan.
        $statistik = [
            ['judul' => 'Mahasiswa', 'jumlah' => 1250,
             'ikon' => 'bi-mortarboard-fill', 'warna' => 'primary'],
            ['judul' => 'Dosen', 'jumlah' => 68,
             'ikon' => 'bi-person-badge-fill', 'warna' => 'success'],
            ['judul' => 'Mata Kuliah', 'jumlah' => 94,
             'ikon' => 'bi-book-fill', 'warna' => 'warning'],
            ['judul' => 'KRS Aktif', 'jumlah' => 842,
             'ikon' => 'bi-journal-check', 'warna' => 'info'],
        ];

        $kolomKrs = [
            'nim' => 'NIM', 'nama' => 'Nama Mahasiswa',
            'sks' => 'SKS', 'status' => 'Status',
        ];

        $krsTerbaru = [
            ['nim' => '2401001', 'nama' => 'Ahmad Fauzi',
             'sks' => 22, 'status' => 'Disetujui'],
            ['nim' => '2401002', 'nama' => 'Siti Rahmawati',
             'sks' => 20, 'status' => 'Disetujui'],
            ['nim' => '2301005', 'nama' => 'Budi Santoso',
             'sks' => 24, 'status' => 'Menunggu'],
            ['nim' => '2301012', 'nama' => 'Dewi Lestari',
             'sks' => 18, 'status' => 'Menunggu'],
            ['nim' => '2201020', 'nama' => 'Rizky Pratama',
             'sks' => 21, 'status' => 'Disetujui'],
        ];

        $statusKrs = [
            ['label' => 'Disetujui', 'persen' => 70, 'warna' => 'success'],
            ['label' => 'Menunggu', 'persen' => 22, 'warna' => 'warning'],
            ['label' => 'Ditolak', 'persen' => 8, 'warna' => 'danger'],
        ];

        return view('dashboard', compact(
            'statistik', 'kolomKrs', 'krsTerbaru', 'statusKrs'
        ));
    }
}