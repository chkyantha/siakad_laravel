@extends('layouts.app')

@section('title', 'Detail Mahasiswa')

@section('content')
    <x-page-header judul="Detail Mahasiswa" deskripsi="Informasi lengkap satu mahasiswa." />

    <div class="card border-0 shadow-sm">
        <div class="card-header bg-body fw-semibold">{{ $mahasiswa->nama }}</div>
        <div class="card-body">
            <dl class="row mb-3">
                <dt class="col-sm-3">NIM</dt>
                <dd class="col-sm-9">{{ $mahasiswa->nim }}</dd>

                <dt class="col-sm-3">Nama</dt>
                <dd class="col-sm-9">{{ $mahasiswa->nama }}</dd>

                <dt class="col-sm-3">Jenis Kelamin</dt>
                <dd class="col-sm-9">{{ $mahasiswa->jenis_kelamin === 'L' ? 'Laki-laki' : 'Perempuan' }}</dd>

                <dt class="col-sm-3">Email</dt>
                <dd class="col-sm-9">{{ $mahasiswa->email }}</dd>

                <dt class="col-sm-3">Angkatan</dt>
                <dd class="col-sm-9">{{ $mahasiswa->angkatan }}</dd>

                <dt class="col-sm-3">Program Studi</dt>
                <dd class="col-sm-9">{{ $mahasiswa->program_studi }}</dd>
            </dl>

            <a href="{{ route('mahasiswa.index') }}" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left"></i> Kembali
            </a>

            @if (Auth::user()->role === 'admin')
                <a href="{{ route('mahasiswa.edit', $mahasiswa) }}" class="btn btn-warning">
                    <i class="bi bi-pencil-square"></i> Ubah
                </a>
            @endif
        </div>
    </div>
@endsection