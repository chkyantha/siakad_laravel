<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use App\Models\Mahasiswa;
use App\Models\Dosen;
use App\Models\MataKuliah;
use App\Models\Krs;

class DashboardController extends Controller
{
    public function index(): View
    {
        // 1. STATISTIK UTAMA
        $jumlahMahasiswa = Mahasiswa::count();
        $jumlahDosen = Dosen::count();
        $jumlahMataKuliah = MataKuliah::count();
        $jumlahKrs = Krs::count();
        
        $rataSks = 0;
        $semuaKrs = Krs::with('matakuliah')->get();
        if ($semuaKrs->count() > 0) {
            $totalSksSemua = $semuaKrs->sum(function ($krsItem) {
                return $krsItem->matakuliah->sum('sks');
            });
            $rataSks = round($totalSksSemua / $semuaKrs->count());
        }

        $statistik = [
            ['judul' => 'Mahasiswa', 'jumlah' => $jumlahMahasiswa, 'ikon' => 'bi-mortarboard-fill', 'warna' => 'primary'],
            ['judul' => 'Dosen', 'jumlah' => $jumlahDosen, 'ikon' => 'bi-person-badge-fill', 'warna' => 'success'],
            ['judul' => 'Mata Kuliah', 'jumlah' => $jumlahMataKuliah, 'ikon' => 'bi-book-fill', 'warna' => 'warning'],
            ['judul' => 'KRS Aktif', 'jumlah' => $jumlahKrs, 'ikon' => 'bi-journal-check', 'warna' => 'info'],
            ['judul' => 'Rata-rata SKS per KRS', 'jumlah' => $rataSks, 'ikon' => 'bi-calculator-fill', 'warna' => 'danger'],
        ];

        $kolomKrs = [
            'nim' => 'NIM', 'nama' => 'Nama Mahasiswa',
            'sks' => 'SKS', 'status' => 'Status',
        ];

        // 2. KRS TERBARU (Diambil 5 data terbaru dari database)
        $krsTerbaruData = Krs::with(['mahasiswa', 'matakuliah'])->latest()->take(5)->get();
        
        $krsTerbaru = $krsTerbaruData->map(function ($item) {
            // Menghitung total SKS dari mata kuliah yang diambil pada KRS tersebut
            $totalSks = $item->matakuliah->sum('sks');
            
            // Menentukan warna badge status
            $badgeColor = 'secondary';
            if (strtolower($item->status) === 'disetujui') $badgeColor = 'success';
            elseif (in_array(strtolower($item->status), ['menunggu', 'diajukan'])) $badgeColor = 'warning';
            elseif (strtolower($item->status) === 'ditolak') $badgeColor = 'danger';

            return [
                'nim' => $item->mahasiswa->nim ?? '-',
                'nama' => $item->mahasiswa->nama ?? '-',
                'sks' => $totalSks,
                'status' => ucfirst($item->status),
            ];
        })->toArray();

        // 3. STATUS KRS (Dihitung persentasenya secara dinamis dari database)
        $totalKrsCount = Krs::count() > 0 ? Krs::count() : 1; 
        
        $disetujuiCount = Krs::where('status', 'disetujui')->count();
        $menungguCount = Krs::whereIn('status', ['diajukan', 'menunggu', 'draft'])->count();
        $ditolakCount = Krs::where('status', 'ditolak')->count();

        $statusKrs = [
            ['label' => 'Disetujui', 'persen' => round(($disetujuiCount / $totalKrsCount) * 100), 'warna' => 'success'],
            ['label' => 'Menunggu', 'persen' => round(($menungguCount / $totalKrsCount) * 100), 'warna' => 'warning'],
            ['label' => 'Ditolak', 'persen' => round(($ditolakCount / $totalKrsCount) * 100), 'warna' => 'danger'],
        ];

        return view('dashboard', compact(
            'statistik', 'kolomKrs', 'krsTerbaru', 'statusKrs'
        ));
    }
}