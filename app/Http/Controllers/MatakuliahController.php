<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class MataKuliahController extends Controller
{
    public function index(): View
    {
        $kolom = [
            'kode' => 'Kode', 'nama' => 'Mata Kuliah', 'sks' => 'SKS',
            'semester' => 'Semester', 'jenis' => 'Jenis',
        ];

        $matakuliah = [
            ['kode' => 'TIF201', 'nama' => 'Pemrograman Web', 'sks' => 3, 'semester' => 3, 'jenis' => 'Praktik'],
            ['kode' => 'TIF202', 'nama' => 'Basis Data', 'sks' => 3, 'semester' => 2, 'jenis' => 'Praktik'],
            ['kode' => 'TIF301', 'nama' => 'Rekayasa Perangkat Lunak', 'sks' => 3, 'semester' => 4, 'jenis' => 'Teori'],
            ['kode' => 'TIF203', 'nama' => 'Jaringan Komputer', 'sks' => 2, 'semester' => 3, 'jenis' => 'Teori'],
        ];

        return view('matakuliah.index', compact('kolom', 'matakuliah'));
    }
}