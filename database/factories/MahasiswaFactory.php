<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class MahasiswaFactory extends Factory
{
    public function definition(): array
    {
        $jenisKelamin = fake()->randomElement(['L', 'P']);
        $gender = $jenisKelamin === 'L' ? 'male' : 'female';
        $angkatan = fake()->numberBetween(2022, 2025);
        $nama = fake()->firstName($gender) . ' ' . fake()->lastName();

        // NIM contoh: 2 digit angkatan + kode prodi (contoh) + 4 digit unik
        $nim = substr((string) $angkatan, -2) . '0303' . 
             fake()->unique()->numerify('####');

        return [
            'nim' => $nim,
            'nama' => $nama,
            'jenis_kelamin' => $jenisKelamin,
            'email' => $nim . '@mhs.example.com',
            'angkatan' => $angkatan,
            'program_studi' => 'D3 Teknik Informatika',
        ];
    }
}