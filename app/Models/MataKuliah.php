<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MataKuliah extends Model
{
    protected $table = 'mata_kuliah';

    protected $fillable = ['kode_mk', 'nama_mk', 'sks'];

    public function krsDetail(): HasMany
    {
        return $this->hasMany(KrsDetail::class, 'mata_kuliah_id');
    }
}
