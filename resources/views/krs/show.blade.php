@extends('layouts.app')

@section('title', 'Detail KRS')

@section('content')
    <x-page-header judul="Detail KRS" deskripsi="Informasi lengkap satu data KRS." />

    <div class="card border-0 shadow-sm">
        <div class="card-header bg-body fw-semibold">Detail KRS ID: {{ $kr->id }}</div>
        <div class="card-body">
            <dl class="row mb-3">
                <dt class="col-sm-3">ID Mahasiswa</dt>
                <dd class="col-sm-9">{{ $kr->mahasiswa_id }}</dd>

                <dt class="col-sm-3">Tahun Akademik</dt>
                <dd class="col-sm-9">{{ $kr->tahun_akademik }}</dd>

                <dt class="col-sm-3">Semester</dt>
                <dd class="col-sm-9">{{ $kr->semester }}</dd>

                <dt class="col-sm-3">Status</dt>
                <dd class="col-sm-9">{{ $kr->status }}</dd>
            </dl>

            <a href="{{ route('krs.index') }}" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left"></i> Kembali
            </a>
            @if (Auth::user()->role === 'admin')
                <a href="{{ route('krs.edit', $kr) }}" class="btn btn-warning">
                    <i class="bi bi-pencil-square"></i> Ubah
                </a>
            @endif
        </div>
    </div>
@endsection