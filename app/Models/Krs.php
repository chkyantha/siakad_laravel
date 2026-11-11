<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Krs extends Model
{
    protected $table = 'krs';

    protected $fillable = [
        'mahasiswa_id',
        'tahun_akademik',
        'semester',
        'status',
    ];

    public function mahasiswa(): BelongsTo
    {
        return $this->belongsTo(Mahasiswa::class, 'mahasiswa_id');
    }

    public function krsDetail(): HasMany
    {
        return $this->hasMany(KrsDetail::class, 'krs_id');
    }

    public function matakuliah(): BelongsToMany
    {
        return $this->belongsToMany(
            Matakuliah::class, 'krs_detail', 'krs_id', 'mata_kuliah_id'
        )->withTimestamps();
    }
}