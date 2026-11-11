<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Akun uji berpassword lemah tidak boleh ada di server sebenarnya.
        if (app()->isProduction()) {
            $this->command?->warn('UserSeeder dilewati di production.');
            return;
        }

        $akun = [
            ['dosen@siakad.test', 'Dosen Uji', 'Dosen@12345', 'dosen'],
            ['mahasiswa@siakad.test', 'Mahasiswa Uji', 'Mahasiswa@12345', 'mahasiswa'],
        ];

        foreach ($akun as [$email, $nama, $password, $role]) {
            User::updateOrCreate(
                ['email' => $email],
                [
                    'name' => $nama,
                    'password' => Hash::make($password),
                    'role' => $role,
                ]
            );
        }
    }
}