@extends('layouts.app')

@section('title', 'Data Pengguna')

@section('content')
<x-page-header judul="Data Pengguna"
    deskripsi="Akun login SIAKAD (khusus admin)." />

<div class="card border-0 shadow-sm">
    <div class="card-header bg-body fw-semibold">Daftar Pengguna</div>
    <div class="card-body p-0">
        <x-tabel :kolom="$kolom" :baris="$pengguna" />
    </div>
</div>
@endsection