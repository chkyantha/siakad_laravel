<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class DosenFactory extends Factory
{
    public function definition(): array
    {
        $gelar = fake()->randomElement([
            'S.Kom., M.Kom.', 'S.T., M.T.', 'S.Kom., M.Eng.', 'S.Si., M.Cs.',
        ]);
        $nama = fake()->firstName() . ' ' . fake()->lastName();

        return [
            'nidn' => fake()->unique()->numerify('08########'),
            'nama' => $nama . ', ' . $gelar,
            'email' => fake()->unique()->safeEmail(),
            'telepon' => fake()->numerify('08#########'),
            'alamat' => fake()->address(),
        ];
    }
}