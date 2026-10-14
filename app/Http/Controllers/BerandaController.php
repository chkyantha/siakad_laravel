<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class BerandaController extends Controller
{
    public function index(): View
    {
        $versiMysql = DB::selectOne('select version() as versi')->versi;

        return view('beranda', [
            'namaAplikasi' => config('app.name'),
            'versiLaravel' => app()->version(),
            'versiPhp' => PHP_VERSION,
            'versiMysql' => $versiMysql,
            'namaDatabase' => DB::getDatabaseName(),
            'waktu' => now()->translatedFormat('l, d F Y H:i'),
            'pesan' => '<script>alert("Halo saya choky");</script>',
        ]);
    }
}
