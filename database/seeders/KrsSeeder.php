<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\MOdels\User;
use App\MOdels\Krs;
use App\MOdels\Mahasiswa;
use App\MOdels\MataKuliah;


class KrsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $mahasiswas = Mahasiswa::limit(10)->get();

        foreach ($mahasiswas as $mhs) {
            $krs = Krs::create([
                'mahasiswa_id'   => $mhs->id,
                'tahun_akademik' => '2026/2027',
                'semester'       => 'Ganjil',
                'status'         => 'disetujui',
            ]);

            $mataKuliahIds = MataKuliah::inRandomOrder()->limit(5)->pluck('id');

            $krs->matakuliah()->attach($mataKuliahIds);
        }
    }
}
