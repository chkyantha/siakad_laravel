@extends('layouts.app')

@section('title', 'Data Dosen')

@section('content')
    <x-page-header judul="Data Dosen"
        deskripsi="Daftar dosen pengampu (data contoh)." />

    <div class="card border-0 shadow-sm">
        <div class="card-header bg-body fw-semibold">Daftar Dosen</div>
        <div class="card-body p-0">
            <x-tabel :kolom="$kolom" :baris="$dosen" />
        </div>
    </div>
@endsection