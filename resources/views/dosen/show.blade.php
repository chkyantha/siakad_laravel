@extends('layouts.app')

@section('title', 'Detail Dosen')

@section('content')
    <x-page-header judul="Detail Dosen" deskripsi="Informasi lengkap satu dosen." />

    <div class="card border-0 shadow-sm">
        <div class="card-header bg-body fw-semibold">{{ $dosen->nama }}</div>
        <div class="card-body">
            <dl class="row mb-3">
                <dt class="col-sm-3">NIDN</dt>
                <dd class="col-sm-9">{{ $dosen->nidn }}</dd>

                <dt class="col-sm-3">Nama</dt>
                <dd class="col-sm-9">{{ $dosen->nama }}</dd>

                <dt class="col-sm-3">Jabatan Fungsional</dt>
                <dd class="col-sm-9">{{ $dosen->jabatan_fungsional ?: '-' }}</dd>

                <dt class="col-sm-3">Email</dt>
                <dd class="col-sm-9">{{ $dosen->email }}</dd>

                <dt class="col-sm-3">Telepon</dt>
                <dd class="col-sm-9">{{ $dosen->telepon ?: '-' }}</dd>

                <dt class="col-sm-3">Alamat</dt>
                <dd class="col-sm-9">{{ $dosen->alamat ?: '-' }}</dd>
            </dl>

            <a href="{{ route('dosen.index') }}" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left"></i> Kembali
            </a>
            @if (Auth::user()?->role === 'admin')
                <a href="{{ route('dosen.edit', $dosen) }}" class="btn btn-warning">
                    <i class="bi bi-pencil-square"></i> Ubah
                </a>
            @endif
        </div>
    </div>
@endsection