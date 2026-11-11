<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Mahasiswa extends Model
{
    /** @use HasFactory<\Database\Factories\MahasiswaFactory> */
    use HasFactory;

    protected $table = 'mahasiswa';

    protected $fillable = [
        'nim',
        'nama',
        'jenis_kelamini',
        'email',
        'angkatan',
        'program_studi',
    ];

    public function krs(): HasMany  
    {
        return $this->hasMany(Krs::class, 'mahasiswa_id');
    }
}
