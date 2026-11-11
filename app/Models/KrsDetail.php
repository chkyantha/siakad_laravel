<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class KrsDetail extends Model
{
    protected $table = 'krs_detail';

    protected $fillable = ['krs_id', 'mata_kuliah_id'];

    public function krs(): BelongsTo
    {
        return $this->belongsTo(Krs::class, 'krs_id');
    }

    public function matakuliah(): BelongsTo
    {
        return $this->belongsTo(Matakuliah::class, 'mata_kuliah_id');
    }
}