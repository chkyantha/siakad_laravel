@extends('layouts.app')

@section('title', 'Data Mahasiswa')

@section('content')
    <x-page-header judul="Data Mahasiswa"
        deskripsi="Daftar mahasiswa (data contoh).">
        <button type="button" class="btn btn-primary"
            data-bs-toggle="collapse" data-bs-target="#formMahasiswa">
            <i class="bi bi-plus-lg"></i> Tambah Mahasiswa
        </button>
    </x-page-header>

    <div class="collapse mb-4" id="formMahasiswa">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-body fw-semibold">Form Mahasiswa</div>
            <div class="card-body">
                @include('mahasiswa._form')
            </div>
        </div>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-header bg-body fw-semibold">Daftar Mahasiswa</div>
        <div class="card-body p-0">
            <x-tabel :kolom="$kolom" :baris="$mahasiswa" />
        </div>
    </div>
@endsection