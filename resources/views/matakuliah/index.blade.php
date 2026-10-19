@extends('layouts.app')

@section('title', 'Data Mata Kuliah')

@section('content')
    <x-page-header judul="Data Mata Kuliah"
        deskripsi="Daftar mata kuliah (data contoh)." />

    <div class="card border-0 shadow-sm">
        <div class="card-header bg-body fw-semibold">Daftar Mata Kuliah</div>
        <div class="card-body p-0">
            <x-tabel :kolom="$kolom" :baris="$matakuliah" />
        </div>
    </div>
@endsection